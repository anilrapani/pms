<?php
require APPPATH . '/libraries/BaseController.php';
/*
 * Copyright (C) 2017 Kastech
 * @project : pms
 * @author : Anil Rapani
 * @email : arapani@kastechindia.com
 * @since : Dec 11, 2017
 * @version : 
 */

class Vehicle extends BaseController {

    /**
     * This is default constructor of the class
     */
    public function __construct() {
        parent::__construct();
        $this->load->model(array('k_master_vehicle_company_model','k_parking_model','k_master_vehicle_type_model','k_master_price_model','k_master_price_per_time_model','k_master_vehicle_gate_model'));
        $this->isLoggedIn();
    }

    /**
     * This function used to load the first screen of the user
     */
    public function index() {
        if ($this->isAdmin() == TRUE && $this->session->userdata('role') != 3 ) {
            $this->loadThis();
        }
        
        $this->companyList();
    }

    /**
     * This function is used to load the company list
     */
    function companyList() {
        
        if (!array_key_exists(19,$this->role_privileges))
        {        
            $this->loadThis();
        } else {

            $searchText = $this->input->post('searchText');
            $data['searchText'] = $searchText;

            $data['totalCount'] = true;
            $data['searchText'] = $searchText;

            $result = $this->k_master_vehicle_company_model->getlist($data);
            $count = $result['count'];
            $data['totalCount'] = false;
            $segment = 5;
            $returns = $this->paginationCompress("employee/vehicle/company/list/", $count, PER_PAGE_RECORDS, $segment);

            $data['page'] = $returns['page'];
            $data['offset'] = $returns['offset'];

            $data['records'] = $this->k_master_vehicle_company_model->getList($data);

            $this->global['pageTitle'] = PROJECT_NAME . ' : Vendor Company List';
            $data['title'] = 'Vendor Company';
            $data['sub_title'] = 'List';
                 $this->global['assets'] = array('cssTopArray'     => array(base_url() . 'assets/plugins/iCheck/all'),
                              'cssBottomArray'  => array(),
                              'jsTopArray'      => array(),
                              'jsBottomArray'   => array(base_url() . 'assets/plugins/iCheck/icheck')
                              
                    );
            $this->loadViews("employee/vehicle/company/list", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to load the add new form
     */
    function addCompanyView() {
        if (!array_key_exists(19,$this->role_privileges)) {
            $this->loadThis();
        } else {
            $data = array();


            $this->global['pageTitle'] = PROJECT_NAME . ' : Add New Company';
            $data['title'] = "Vendor Company";

            $data['sub_title'] = "Add";
            $this->loadViews("employee/vehicle/company/add", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to load the add new form
     */
    function addCompany() {
        if (!array_key_exists(19,$this->role_privileges)) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('name', 'Name', 'trim|required|max_length[128]');
            $this->form_validation->set_rules('email', 'Email', 'trim|valid_email|max_length[128]');

            if ($this->form_validation->run() == FALSE) {
                $this->addCompanyView();
            } else {
                $name = ucwords(strtolower($this->input->post('name')));
                $email = strtolower($this->input->post('email'));
                $phone = $this->input->post('phone');
                $address = $this->input->post('address');
                $status = $this->input->post('status');
                
                
                
                $userCompanyInfo = array(
                    'name' => $name,
                    'email' => $email,
                    'phone' => $phone,
                    'address' => $address,
                    'status' => $status,
                    'deleted' => 2,
                    'created_by' => $this->vendorId,
                    'created_time' => date('Y-m-d H:i:s')
                );
                
                $result = $this->k_master_vehicle_company_model->insert($userCompanyInfo);

                if ($result > 0) {
                    $this->session->set_flashdata('success', 'New Company created successfully');
                } else {
                    $this->session->set_flashdata('error', 'Company creation failed');
                }

                $this->global['pageTitle'] = PROJECT_NAME . ' : Add New Company';
                $data['title'] = "Vendor Company";

                $data['sub_title'] = "Add";
                $this->loadViews("employee/vehicle/company/add", $this->global, $data, NULL);
            }
        }
    }

    /**
     * This function is used to load company edit information
     * @param number $companyId : Optional : This is company id
     */
    function editCompanyView($companyId = NULL) {
        if (!array_key_exists(19,$this->role_privileges)) {
            $this->loadThis();
        } else {
            if ($companyId == null) {
                redirect('employee/vehicle/companylist');
            }

            $data['companyInfo'] = $this->k_master_vehicle_company_model->getDetails($companyId);

            $this->global['pageTitle'] = PROJECT_NAME . ' : Edit Company';
            $data['title'] = "Vendor Company";

            $data['sub_title'] = "Edit";

            $this->loadViews("employee/vehicle/company/edit", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to edit the company information
     */
    function editCompany() {
        if (!array_key_exists(19,$this->role_privileges)) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');

            $companyId = $this->input->post('id');

            $this->form_validation->set_rules('name', 'Name', 'trim|required|max_length[128]');
            $this->form_validation->set_rules('email', 'Email', 'trim|valid_email|max_length[128]');
            


            if ($this->form_validation->run() == FALSE) {

                redirect("employee/vehicle/edit/company/$companyId");
            } else {
                $name = ucwords(strtolower($this->input->post('name')));
                $email = strtolower($this->input->post('email'));
                $phone = $this->input->post('phone');
                $address = $this->input->post('address');
                $status = $this->input->post('status');

                $userCompanyInfo = array(
                    'name' => $name,
                    'email' => $email,
                    'phone' => $phone,
                    'address' => $address,
                    'status' => $status,
                    'updated_by' => $this->vendorId,
                    'updated_time' => date('Y-m-d H:i:s')
                );

                $result = $this->k_master_vehicle_company_model->update($userCompanyInfo, $companyId);

                if ($result == true) {
                    $this->session->set_flashdata('success', 'Company updated successfully');
                } else {
                    $this->session->set_flashdata('error', 'Company updation failed');
                }

                redirect("employee/vehicle/edit/company/$companyId");
            }
        }
    }

    /**
     * This function is used to delete the company using id
     * @return boolean $result : TRUE / FALSE
     */
    function deleteCompany() {

        if (!array_key_exists(19,$this->role_privileges)) {
            echo(json_encode(array('status' => 'access')));
        } else {
            $id = $this->input->post('id');
            $data = array('deleted' => 1, 'updated_by' => $this->vendorId, 'updated_time' => date('Y-m-d H:i:s'));
            $result = $this->k_master_vehicle_company_model->delete($id, $data);
            if ($result > 0) {
                echo(json_encode(array('status' => TRUE)));
            } else {
                echo(json_encode(array('status' => FALSE)));
            }
        }
    }
    
    function updateVehicleCompanyStatus() {

        if(!array_key_exists(19,$this->role_privileges)){
            echo(json_encode(array('status' => 'access')));
        } else {
            $id = $this->input->post('id');
            $status = $this->input->post('status');
            $data = array('status' => $status, 'updated_by' => $this->vendorId, 'updated_time' => date('Y-m-d H:i:s'));
            $result = $this->k_master_vehicle_company_model->update($data, $id);
            if ($result > 0) {
                echo(json_encode(array('status' => TRUE)));
            } else {
                echo(json_encode(array('status' => FALSE)));
            }
        }
    }
    

    
    /**
     * This function is used to load the add new form
     */
    function addEntryView($entryId = 0) {
       
        if (count(array_intersect($this->session->userdata('entryGateIdsArray'), array_keys($this->role_privileges))) == 0) {
        // if ($this->isAdmin() == TRUE && ($this->session->userdata('role') == 3 && $this->session->userdata('gateDetails')->type_name != 'entry')) {
            $this->loadThis();
        } else {
            $data = array();
            $this->global['pageTitle'] = PROJECT_NAME . ' : Vehicle Entry';
            $data['title'] = "Entry";

            $data['sub_title'] = "Entry";
            $view = "employee/vehicle/entry/add";
                $isNewEntry = true;
                $data['entryId'] ='';
                $isNotExited = true;
            if($entryId != 0){
                $data['entryId'] = $entryId;
                $entryDetails = $this->k_parking_model->getDetails($entryId);
                if(isset($entryDetails->vehicle_type_id)){
                    $vehicleTypeDetails = $this->k_master_vehicle_type_model->getDetails($entryDetails->vehicle_type_id);
                    if(isset($vehicleTypeDetails->number_of_wheels)){
                    $entryDetails->number_of_wheels = $vehicleTypeDetails->number_of_wheels;
                    $vehicleTypePrices = $this->k_master_price_per_time_model->getPricePerTimesByPriceId($vehicleTypeDetails->price_id);
                    $data['vehicleTypePrices'] = $vehicleTypePrices;
                    $data['masterPriceDetails'] = $this->k_master_price_model->getDetails($vehicleTypeDetails->price_id);
                    }

                    
                }
                
                if(isset($entryDetails->gate_id_entry)){
                    $entryGateDetails = $this->k_master_vehicle_gate_model->getDetails($entryDetails->gate_id_entry);
                    $data['entryGateDetails']= $entryGateDetails;
                }
                
                
                
                if(count($entryDetails) != 1){
                    $this->session->set_flashdata('error', 'Invalid Entry');
                }
            
                if(isset($entryDetails->entry_time) && strtotime($entryDetails->entry_time) > 0){
                    $isNewEntry = false;
                }
                
                if(isset($entryDetails->exit_time) && strtotime($entryDetails->exit_time) > 0){
                    $isNotExited = false;
                }
                
                $data['masterPriceListArray'] = $this->k_master_price_model->get();
              
                $data['entryDetails'] = $entryDetails;
            
            }
            $data['isNewEntry'] = $isNewEntry;
            $data['isNotExited'] = $isNotExited;
            
            $this->load->model('k_master_price_model');
            $data['vehicleTypeListArray'] = $this->k_master_vehicle_type_model->get();
            $data['terminalListArray'] = $this->k_master_vehicle_gate_model->get();
            
            
            // $data['vehicleCompanyListArray'] = $this->k_master_vehicle_company_model->get();
                  $this->global['assets'] = array('cssTopArray'     => array(),
                              'cssBottomArray'  => array(),
                              'jsTopArray'      => array(base_url() . 'assets/js/employee/jquery.PrintArea'),
                              'jsBottomArray'   => array()
                              
                    );
            
            $this->loadViews($view, $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to load the add new form
     */
    function addEntry() {
       if (count(array_intersect($this->session->userdata('entryGateIdsArray'), array_keys($this->role_privileges))) == 0) {
        // if ($this->isAdmin() == TRUE && ($this->session->userdata('role') == 3 && $this->session->userdata('gateDetails')->type_name != 'entry')) {
        
            $this->loadThis();
        } else {
            $this->load->library('form_validation');

           $this->form_validation->set_rules('vehicle_type_id', 'Vehicle Type', 'trim|required|max_length[128]');
           
            // $this->form_validation->set_rules('email', 'Email', 'trim|valid_email|max_length[128]');
                
            if ($this->form_validation->run() == FALSE) {
                $this->addEntryView();
            } else {
                $data =array();
                
                $vehicle_type_id = $this->input->post('vehicle_type_id');
                $vehicle_company = ucwords(trim($this->input->post('vehicle_company')));
                $vehicle_number = strtoupper(trim($this->input->post('vehicle_number')));
                $driving_license_number = strtoupper(trim($this->input->post('driving_license_number')));
                $driver_name = ucwords(trim($this->input->post('driver_name')));
                // $rc = strtoupper(trim($this->input->post('rc')));
                $image_vehicle_number_plate = $image_driving_license_number = '';
                
                $gate_id = $this->input->post('gate_id');
                /*if($this->session->userdata('role') == 2 && $this->config->item('enable_admin_no_gate_restriction')){
                    $gate_id = $this->input->post('gate_id');
                }else{
                    $gate_id = $this->global['gateDetails']->id;
                } */   
                
                $vehicle_company = (!empty($vehicle_company))?$vehicle_company:'New Company';
        /*        
                $config['allowed_types']        = 'gif|jpg|png';
//                $config['max_size']             = 2000;
//                $config['max_width']            = 1024;
//                $config['max_height']           = 768; 
//                $config['max_height']           = 768; 
                $config['upload_path'] = './assets/images/upload/numberplate/';
                // $config['upload_path']          = 'G:\xampp\htdocs\pms\assets\images\upload\numberplate';
                $config['file_name']            = mt_rand(100,1000).chr(64+rand(1,25)).mt_rand();
                $this->load->library('upload', $config, 'number_plate_upload'); // Create custom object for cover upload
                $this->number_plate_upload->initialize($config);
                $image_error = false;
          */      

$image_vehicle_number_plate = $this->input->post('image_vehicle_number_plate');
if(empty(trim($image_vehicle_number_plate))){
$image_vehicle_number_plate = '';
}else{
    
     
    $data       = file_get_contents($image_vehicle_number_plate);
// $size_info2 = getimagesizefromstring($data);

$WIDTH                  = 300; // The size of your new image
$HEIGHT                 = 50;  // The size of your new image
list($width_orig, $height_orig) = getimagesizefromstring($data);

$ratio_orig = $width_orig/$height_orig;
if ($WIDTH/$HEIGHT > $ratio_orig) {
    $WIDTH = $HEIGHT*$ratio_orig;
} else {
    $HEIGHT = $WIDTH/$ratio_orig;
}

$image_vehicle_number_plate = str_replace('data:image/png;base64,', '', $image_vehicle_number_plate);
$image_vehicle_number_plate = str_replace(' ', '+', $image_vehicle_number_plate);
$image_vehicle_number_plate_filedata = base64_decode($image_vehicle_number_plate);



$theme_image_little = imagecreatefromstring(base64_decode($image_vehicle_number_plate));

$image_little = imagecreatetruecolor($WIDTH, $HEIGHT);
// $org_w and org_h depends of your image, in your case, i guess 800 and 600
imagecopyresampled($image_little, $theme_image_little, 0, 0, 0, 0, $WIDTH, $HEIGHT, $width_orig, $height_orig);

// Thanks to Michael Robinson
// start buffering
ob_start();
imagepng($image_little);
$contents =  ob_get_contents();
ob_end_clean();


$image_vehicle_number_plate = mt_rand(100,1000).chr(64+rand(1,25)).mt_rand().'.png';
file_put_contents(APPPATH . '../assets/images/upload/numberplate/'.$image_vehicle_number_plate,$contents);


}

$image_driving_license_number = $this->input->post('image_driving_license_number');
if(empty(trim($image_driving_license_number))){
$image_driving_license_number = '';
}else{
$image_driving_license_number = str_replace('data:image/png;base64,', '', $image_driving_license_number);
$image_driving_license_number = str_replace(' ', '+', $image_driving_license_number);
$image_driving_license_number_filedata = base64_decode($image_driving_license_number);

$image_driving_license_number = mt_rand(100,1000).chr(64+rand(1,25)).mt_rand().'.png';
file_put_contents(APPPATH . '../assets/images/upload/drivinglicense/'.$image_driving_license_number,$image_driving_license_number_filedata);
}

//saving



//                if ( ! $this->number_plate_upload->do_upload('image_vehicle_number_plate'))
//                {
//                       $this->session->set_flashdata('error','Number Plate Image: '.$this->number_plate_upload->display_errors());
//                       $image_error = true;
//                       
//                }  else
//                {
//                        $upload_data_image_vehicle_number_plate = array('upload_data' => $this->number_plate_upload->data());
//                        $image_vehicle_number_plate = $upload_data_image_vehicle_number_plate['upload_data']['file_name'];
//                        
//                    
//                }
//                
//                $config['upload_path'] = './assets/images/upload/drivinglicense/';
//                // $config['upload_path']          = 'G:\xampp\htdocs\pms\assets\images\upload\drivinglicense';
//                $config['file_name']            = mt_rand(100,1000).chr(64+rand(1,26)).mt_rand();
//                $this->load->library('upload', $config, 'dl_upload'); // Create custom object for cover upload
//                $this->dl_upload->initialize($config);
//                
//    
//                if ( ! $this->dl_upload->do_upload('image_driving_license_number') )
//                {
//                    if(!$this->config->item('disable_mandatory_field_entry')) { 
//                       $this->session->set_flashdata('error','Driving License Image: '. $this->dl_upload->display_errors());
//                       $image_error = true;
//                    } 
//                       
//                } else
//                {
//                        $upload_data_image_driving_license_number = array('upload_data' => $this->dl_upload->data());
//                        $image_driving_license_number = $upload_data_image_driving_license_number['upload_data']['file_name'];
//                }
                
                if($image_error == false){
                           //load library
		$this->load->library('zend');
		//load in folder Zend
		$this->zend->load('Zend/Barcode');
		//generate barcode
                $code = mt_rand(1000,10000).time().mt_rand(1000,10000);
		$file = Zend_Barcode::draw('code128', 'image', array('text'=>$code), array());
                
                //$code = time().'1222';
        imagepng($file,"barcode/{$code}.png");
       // $data['barcode'] = $code.'.png';
        // $data['bar'] = $bar;
       // $this->load->view('anil',$data);
                
         
                    
                   $vehicleEntryInfo = array(
                    'vehicle_type_id' => $vehicle_type_id,
                    'vehicle_company' => $vehicle_company,
                    'vehicle_number'  => $vehicle_number,
                    'driving_license_number' => $driving_license_number,
                    'image_vehicle_number_plate' => $image_vehicle_number_plate,
                    'image_driving_license_number' => $image_driving_license_number,
                    'driver_name' => $driver_name,
                    'gate_id_entry' => $gate_id,
                  //   'rc' => $rc,
                    'entry_time' => date('Y-m-d H:i:s'),
                    'barcode' =>  $code, 
                    'status' => 1,
                    'deleted' => 2,
                    'created_by' => $this->vendorId,
                    'created_time' => date('Y-m-d H:i:s')
                    
                );
                   
                $inserted_id = $this->k_parking_model->insert($vehicleEntryInfo);
                // $result = $this->k_parking_model->update($vehicleEntryInfo, $entryId);
                $this->global['pageTitle'] = PROJECT_NAME . ' : Add New Vehicle Entry';
                $data['title'] = "Vehicle Company";
                $data['sub_title'] = "Entry";
                
                if ($inserted_id > 0) {
                        
                        $this->session->set_flashdata('success', 'Entry Successful');
                
                    } else {
                        $this->session->set_flashdata('error', 'Entry failed');
                
                        
                    }
                }
            
                redirect('/employee/vehicle/add/entry/'.$inserted_id);
                // $this->addEntryView();
                 $this->loadViews($view, $this->global, $data, NULL);
            }
        }
    }

    
    
    
    function exitDetailsView(){
        if (count(array_intersect($this->session->userdata('exitGateIdsArray'), array_keys($this->role_privileges))) == 0) {
        // if ($this->isAdmin() == TRUE && ($this->session->userdata('role') == 3 && $this->session->userdata('gateDetails')->type_name != 'exit')) {
            $this->loadThis();
        } else {
            
           $data = array();
           $this->global['pageTitle'] = PROJECT_NAME . ' : Vehicle Exit';
           $data['titleScannerEntry'] = "Scanner entry";
           $data['titleManualEntry']  = "Manual entry";
           $data['title'] = "Barcode";
           
           $view = 'employee/vehicle/exit/details';
           $data['onlysearchView'] = true;
           $data['isNewEntry'] = false;
           $data['isNotExited'] = false;
                 $this->global['assets'] = array('cssTopArray'     => array(),
                              'cssBottomArray'  => array(),
                              'jsTopArray'      => array(base_url() . 'assets/js/employee/quagga.min'),
                              'jsBottomArray'   => array()
                              
                    );
           $this->loadViews($view, $this->global, $data, NULL);
                    
            
            
        }    
    }
    
    function exitDetails(){
       if (count(array_intersect($this->session->userdata('exitGateIdsArray'), array_keys($this->role_privileges))) == 0) {
        // if ($this->isAdmin() == TRUE && ($this->session->userdata('role') == 3 && $this->session->userdata('gateDetails')->type_name != 'exit')) {
            $this->loadThis();
        } else {
            
            $data = array();
            $this->global['pageTitle'] = PROJECT_NAME . ' : Vehicle Exit Details';
            $data['title'] = "Entry No";
          
            $this->load->library('form_validation');

           $this->form_validation->set_rules('barcode', 'Barcode', 'trim|max_length[128]');
           // $this->form_validation->set_rules('entryId', 'Email', 'trim|valid_email|max_length[128]');
                 
            if ($this->form_validation->run() == FALSE) {
                $this->exitDetailsView();
            } else {
                 $entryId = $this->input->post('entryId');
                  $id = (isset($barcode))?$barcode:$entryId;
                  
                  $barcode = $this->input->post('barcode');
                  $entryId = $this->input->post('entryId');
                  $id = (isset($barcode))?$barcode:$entryId;
                  
                     $data['onlysearchView'] = false;
                    $data['sub_title'] = "Exit Details";
                    
                    $entryDetails = $this->k_parking_model->getDetailsByBarcodeOrId($id);
                    
                    if(isset($entryDetails->vehicle_type_id)){
                        $data['barcode'] = $entryDetails->barcode;
                        $vehicleTypeDetails = $this->k_master_vehicle_type_model->getDetails($entryDetails->vehicle_type_id);
                        if(isset($vehicleTypeDetails->number_of_wheels)){
                        $entryDetails->number_of_wheels = $vehicleTypeDetails->number_of_wheels;
                        }
                    
                    $vehicleTypePrices = $this->k_master_price_per_time_model->getPricePerTimesByPriceId($vehicleTypeDetails->price_id);
                    $data['vehicleTypePrices'] = $vehicleTypePrices;
                    $data['masterPriceDetails'] = $this->k_master_price_model->getDetails($vehicleTypeDetails->price_id);
        
                        
                        $data['vehicleTypePrices'] = $vehicleTypePrices;
                        
                        
                        
                    }
                    

                     $isNotExited = $isNewEntry = true;
            if(isset($entryDetails->entry_time) && strtotime($entryDetails->entry_time) > 0){
                $isNewEntry = false;
            }
            
            if(isset($entryDetails->exit_time) && strtotime($entryDetails->exit_time) > 0){
                $isNotExited = false;
            }
            $data['isNewEntry'] = $isNewEntry;
            $data['isNotExited'] = $isNotExited;
            
                    $view = "employee/vehicle/exit/details";
                    $data['entryDetails'] = $entryDetails;
                    if(count($entryDetails) != 1){
                             $this->session->set_flashdata('error', 'Invalid Entry');
                             $view = 'employee/vehicle/entry/invalid';
                             $this->loadViews($view, $this->global, $data, NULL);
                    }else{
                        redirect('employee/vehicle/exitdetails/'.$entryDetails->barcode);
                    }
                    
                    
                    
                    
            
            }
           
            
            
        }    
    }

    
    function exitDetailsByBarcode($barcode){
        
        if (count(array_intersect($this->session->userdata('exitGateIdsArray'), array_keys($this->role_privileges))) == 0) {
        // if ($this->isAdmin() == TRUE && ($this->session->userdata('role') == 3 && $this->session->userdata('gateDetails')->type_name != 'exit')) {
            $this->loadThis();
        } else {
            $data = array();
            $this->global['pageTitle'] = PROJECT_NAME . ' : Vehicle Exit Details';
            $data['title'] = "Barcode";
                     $data['titleScannerEntry'] = "Scanner entry";
           $data['titleManualEntry']  = "Manual entry";
       
                     $data['onlysearchView'] = false;
                    $data['sub_title'] = "Exit Details";
                    $data['barcode'] = $barcode;
                    $entryDetails = $this->k_parking_model->getDetailsByBarcode($barcode);
                   
                    if(isset($entryDetails->vehicle_type_id)){
                        $vehicleTypeDetails = $this->k_master_vehicle_type_model->getDetails($entryDetails->vehicle_type_id);
                        $entryDetails->vehicle_type_id;
//                         echo "<pre>";
//                         echo $this->db->last_query();
//                         exit;
//                    var_dump($vehicleTypeDetails);
//                    exit;
                        if(isset($vehicleTypeDetails->number_of_wheels)){
                        $entryDetails->number_of_wheels = $vehicleTypeDetails->number_of_wheels;
                        }
                        
                        
                        
                        
                        
                        
              $vehicleTypePrices = $this->k_master_price_per_time_model->getPricePerTimesByPriceId($vehicleTypeDetails->price_id);
              
                    $data['vehicleTypePrices'] = $vehicleTypePrices;
                    $data['masterPriceDetails'] = $this->k_master_price_model->getDetails($vehicleTypeDetails->price_id);
                    
                    
                        
                        $data['vehicleTypePrices'] = $vehicleTypePrices;
                        
                        //$data['entryId'] = $entryDetails->id;
                        
                    }
                    
                             if(isset($entryDetails->gate_id_entry)){
                    $entryGateDetails = $this->k_master_vehicle_gate_model->getDetails($entryDetails->gate_id_entry);
                    $data['entryGateDetails']= $entryGateDetails;
                }
                
                 if(isset($entryDetails->gate_id_exit)){
                    $entryGateDetails = $this->k_master_vehicle_gate_model->getDetails($entryDetails->gate_id_exit);
                    $data['exitGateDetails']= $entryGateDetails;
                }

                     $isNotExited = $isNewEntry = true;
            if(isset($entryDetails->entry_time) && strtotime($entryDetails->entry_time) > 0){
                $isNewEntry = false;
            }
            
            if(isset($entryDetails->exit_time) && strtotime($entryDetails->exit_time) > 0){
                $isNotExited = false;
            }
            $data['isNewEntry'] = $isNewEntry;
            $data['isNotExited'] = $isNotExited;
        
                    $view = "employee/vehicle/exit/details";
                    if(count($entryDetails) != 1){
                             $this->session->set_flashdata('error', 'Invalid Entry');
                             $view = 'employee/vehicle/entry/invalid';
                    }
                    
                    $data['entryDetails'] = $entryDetails;
                       $this->global['assets'] = array('cssTopArray'     => array(),
                              'cssBottomArray'  => array(),
                              'jsTopArray'      => array(base_url() . 'assets/js/employee/jquery.PrintArea',base_url() . 'assets/js/employee/quagga.min'),
                              'jsBottomArray'   => array()
                              
                    );
                    
                    $data['terminalListArray'] = $this->k_master_vehicle_gate_model->get();
                    $this->loadViews($view, $this->global, $data, NULL);
                    
        }    
    }
    
    function generateExitReciept(){
       if (count(array_intersect($this->session->userdata('exitGateIdsArray'), array_keys($this->role_privileges))) == 0) {
        // if ($this->isAdmin() == TRUE && ($this->session->userdata('role') == 3 && $this->session->userdata('gateDetails')->type_name != 'exit')) {
            $this->loadThis();
        } else {
            $data = array();
            $this->global['pageTitle'] = PROJECT_NAME . ' : Vehicle Exit Bill';
            $data['title'] = "Exit Bill - Entry No : ";
            $data['sub_title'] = "Exit Bill - Entry No : ";
            
            $this->load->library('form_validation');
            
            
            $this->form_validation->set_rules('entryId', 'Vehicle Entry Id', 'trim|required|max_length[128]');
             if(!$this->config->item('disable_uploadimage_exit')) {
                $this->form_validation->set_rules('customer_paid_by_cash_or_card', 'Cash or Card', 'trim|required|max_length[128]');
             }
             
               $allGateList = $this->k_master_vehicle_gate_model->get();
               $gate_id = '';
                foreach ($allGateList as $key => $value) {
                    
                    if($value->type == 2){
                        $random_gate_id = $value->id;
                        if(in_array($value->id,array_keys($this->global['role_privileges']))){
                            $gate_id = $value->id;
                            }
                        }   
                }
                
                $gate_id = (empty($gate_id))?$random_gate_id:$gate_id;
                  
                /*if($this->session->userdata('role') == 2 && $this->config->item('enable_admin_no_gate_restriction')){
                
                }else{
                    $gate_id = $this->global['gateDetails']->id;
                } */  
            // $this->form_validation->set_rules('email', 'Email', 'trim|valid_email|max_length[128]');
                
            if ($this->form_validation->run() == FALSE) {
                $this->exitDetailsView();
            } else {
                
                $entryId = $this->input->post('entryId');
                $customer_paid_by_cash_or_card = $this->input->post('customer_paid_by_cash_or_card');
                $image_vehicle_number_plate_exit = '';
            }
            
            $data['entryId'] = $entryId;
            $entryDetails = $this->k_parking_model->getDetailsByBarcodeOrId($entryId);
            if($entryDetails == NULL){
                redirect('/employee/vehicle/exit/details');
            }else if($entryDetails->exit_time != '0000-00-00 00:00:00'){
                redirect("employee/vehicle/exitdetails/".$entryDetails->barcode);
            }
            
            if(isset($entryDetails->vehicle_type_id)){
                
                $vehicleTypeDetails = $this->k_master_vehicle_type_model->getDetails($entryDetails->vehicle_type_id);
                $vehicleTypePrices = $this->k_master_price_per_time_model->getPricePerTimesByPriceId($vehicleTypeDetails->price_id);
                $resultMaximumToMinutesByPriceId = $this->k_master_price_per_time_model->getMaximumToMinutesByPriceId($vehicleTypeDetails->price_id);
                
                $maximumToMinutesByPriceId = $resultMaximumToMinutesByPriceId->maxToMinutes;
                
                $priceDetails = $this->k_master_price_model->getDetails($vehicleTypeDetails->price_id);
        
                if(isset($entryDetails->entry_time)){
                    $total_number_of_seconds = strtotime(date('Y-m-d H:i:s')) - strtotime($entryDetails->entry_time);
                    
                }
            }

            $amount = 0;
            
            //if total number of minutes cross this max minutes write logic here to get final amount
            
            $total_number_of_minutes = ceil($total_number_of_seconds/60);
            
            if($total_number_of_minutes > $maximumToMinutesByPriceId){
                if($this->config->item('enable_more_than_minutes_per_hour_amount')) {
                    $total_number_of_hours = ceil($total_number_of_seconds/3600);
                    $amount = $priceDetails->more_than_minutes_per_hour_amount*$total_number_of_hours;
                }else{
                    $amount = (ceil($total_number_of_minutes/$maximumToMinutesByPriceId))*$resultMaximumToMinutesByPriceId->amount; 
                }
            }{ 
                
                /* seconds logic
            foreach ($vehicleTypePrices as $key => $value) {
                 if($total_number_of_seconds > ($value->from_minutes*60) && $total_number_of_seconds <= ($value->to_minutes*60)){
                        $amount = $value->amount;
                        break;
                    }
                }
                 * 
                 */
                foreach ($vehicleTypePrices as $key => $value) {
                 if($total_number_of_minutes > $value->from_minutes && $total_number_of_minutes <= $value->to_minutes){
                        $amount = $value->amount;
                        break;
                    }
                }    
            }
                
                $config['allowed_types']        = 'gif|jpg|png';
//                $config['max_size']             = 2000;
//                $config['max_width']            = 1024;
//                $config['max_height']           = 768; 
//                $config['max_height']           = 768; 
                                $config['upload_path'] = './assets/images/upload/numberplate/exit/';
                // $config['upload_path']          = 'G:\xampp\htdocs\pms\assets\images\upload\numberplate\exit';
                $config['file_name']            = mt_rand(100,1000).chr(64+rand(1,25)).mt_rand();
                $this->load->library('upload', $config, 'number_plate_upload'); // Create custom object for cover upload
                $this->number_plate_upload->initialize($config);
                $image_error = false;
                if ( ! $this->number_plate_upload->do_upload('image_vehicle_number_plate_exit'))
                {
                         if(!$this->config->item('disable_uploadimage_exit')) { 
//                            $this->session->set_flashdata('error','Number Plate Image: '.$this->number_plate_upload->display_errors());
//                            $image_error = true;
                         }
                }  else
                {
                        $upload_data_image_vehicle_number_plate_exit = array('upload_data' => $this->number_plate_upload->data());
                        $image_vehicle_number_plate_exit = $upload_data_image_vehicle_number_plate_exit['upload_data']['file_name'];
                }
            
            
               if($image_error == false){
                   $vehicleExitInfo = array(
                    'total_amount' => $amount,
                    'exit_time' => date('Y-m-d H:i:s'),
                    'customer_paid_by_cash_or_card' => $customer_paid_by_cash_or_card,   
                    'gate_id_exit' => $gate_id,
                    'exited_by' => $this->vendorId,
                    'updated_by' => $this->vendorId,
                    'updated_time' => date('Y-m-d H:i:s'),
                    'image_vehicle_number_plate_exit' => $image_vehicle_number_plate_exit,
                    'total_minutes' => $total_number_of_minutes   
                    
                );
                   
                   $result = $this->k_parking_model->update($vehicleExitInfo, $entryDetails->id);
                   if($result){
                       if(isset($entryDetails->barcode))
                            redirect('employee/vehicle/exitdetails/'.$entryDetails->barcode);
                   }
                   
               }
               $entryDetails = $this->k_parking_model->getDetails($entryDetails->id);
             
            $data['entryDetails'] =  $entryDetails;
                    if(isset($entryDetails->vehicle_type_id)){
                        $vehicleTypeDetails = $this->k_master_vehicle_type_model->getDetails($entryDetails->vehicle_type_id);
                        if(isset($vehicleTypeDetails->number_of_wheels)){
                        $data['entryDetails']->number_of_wheels = $vehicleTypeDetails->number_of_wheels;
                        } 
                            
                        $vehicleTypePrices = $this->k_master_price_model->getPriceListByVehicleType($entryDetails->vehicle_type_id);
            
                        
                        $data['vehicleTypePrices'] = $vehicleTypePrices;
                       
                    }
                    
                $data['onlysearchView'] = false;
                $data['isNewEntry'] = false;
                $data['isNotExited'] = false;
                
            
                
                $this->loadViews('employee/vehicle/exit/details', $this->global, $data, NULL);
            
                }
}
    


        function searchEntry(){
             if ($this->isAdmin() == TRUE && $this->session->userdata('role') != 3) {
            $this->loadThis();
        } else {
            $entryId = $this->input->post('entryId');
            redirect('/employee/vehicle/add/entry/'.$entryId);
            
        }
                  
                
    }
    // removable code below
    
    function vehicleExitUpdate(){
        if ($this->isAdmin() == TRUE && $this->session->userdata('role') != 3) {
            $this->loadThis();
        } else {
            $data = array();
            $this->global['pageTitle'] = PROJECT_NAME . ' : Vehicle Exit';
            $data['title'] = "Entry No";
            $entryId = $this->input->post('entryId');
             $this->load->library('form_validation');

           $this->form_validation->set_rules('entryId', 'Vehicle Entry Id', 'trim|required|max_length[128]');
            // $this->form_validation->set_rules('email', 'Email', 'trim|valid_email|max_length[128]');
                
            if ($this->form_validation->run() == FALSE) {
                $this->addEntryView($entryId);
            } else {
                
            }
            
            
            $data['sub_title'] = "Entry";
            $data['entryId'] = $entryId;
            $entryDetails = $this->k_parking_model->getDetails($entryId);
            
            
            if(isset($entryDetails->vehicle_type_id)){
                $vehicleTypeDetails = $this->k_master_vehicle_type_model->getDetails($entryDetails->vehicle_type_id);
                if(isset($vehicleTypeDetails->number_of_wheels)){
                $entryDetails->number_of_wheels = $vehicleTypeDetails->number_of_wheels;
                }
            }
            
            $view = "employee/vehicle/entry/add";
            if(count($entryDetails) != 1){
                $this->session->set_flashdata('error', 'Invalid Entry');
                $view = 'employee/vehicle/entry/invalid';
            }
            $isNewEntry = true;
            if(isset($entryDetails->entry_time) && strtotime($entryDetails->entry_time) > 0){
                $isNewEntry = false;
            }
            $data['isNewEntry'] = $isNewEntry;

            $this->load->model('k_master_price_model');
            $data['vehicleTypeListArray'] = $this->k_master_vehicle_type_model->get();
            $data['masterPriceListArray'] = $this->k_master_price_model->get();
            $data['vehicleCompanyListArray'] = $this->k_master_vehicle_company_model->get();
            $data['entryDetails'] = $entryDetails;
            $this->loadViews($view, $this->global, $data, NULL);
        }
    }
    
    
    function manualExit(){
        if (count(array_intersect($this->session->userdata('exitGateIdsArray'), array_keys($this->role_privileges))) == 0 && !array_key_exists(28,$this->role_privileges)) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');

           $this->form_validation->set_rules('id', 'Vehicle Type', 'trim|required|max_length[128]');
            // $this->form_validation->set_rules('email', 'Email', 'trim|valid_email|max_length[128]');
                
            if ($this->form_validation->run() == FALSE) {
                // $this->exitView($entryId);
            } else {
                $data =array();
                $entry_id = $this->input->post('entry_id');
                
                
                
                
                $vehicle_company = ucwords($this->input->post('vehicle_company'));
                $vehicle_number = strtoupper($this->input->post('vehicle_number'));
                $driving_license_number = strtoupper($this->input->post('driving_license_number'));
                $driver_name = ucwords($this->input->post('driver_name'));
                $rc = strtoupper($this->input->post('rc'));
                $image_vehicle_number_plate = $image_driving_license_number = '';
                
                
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 100;
                $config['max_width']            = 1024;
                $config['max_height']           = 768; 
                $config['max_height']           = 768; 
                
                $config['upload_path']          = 'F:\work_softwares\xampp_php7\htdocs\pms\assets\images\upload\numberplate';
                $config['file_name']            = mt_rand(100,1000).chr(64+rand(1,25)).mt_rand();
                $this->load->library('upload', $config, 'number_plate_upload'); // Create custom object for cover upload
                $this->number_plate_upload->initialize($config);
                $image_error = false;
                if ( ! $this->number_plate_upload->do_upload('image_vehicle_number_plate'))
                {
                       $this->session->set_flashdata('error','Number Plate Image: '.$this->number_plate_upload->display_errors());
                       $image_error = true;
                       
                }  else
                {
                        $upload_data_image_vehicle_number_plate = array('upload_data' => $this->number_plate_upload->data());
                        $image_vehicle_number_plate = $upload_data_image_vehicle_number_plate['upload_data']['file_name'];
                        
                    
                }
                
                
                $config['upload_path']          = 'F:\work_softwares\xampp_php7\htdocs\pms\assets\images\upload\drivinglicense';
                $config['file_name']            = mt_rand(100,1000).chr(64+rand(1,26)).mt_rand();
                $this->load->library('upload', $config, 'dl_upload'); // Create custom object for cover upload
                $this->dl_upload->initialize($config);
                
    
                if ( ! $this->dl_upload->do_upload('image_driving_license_number') )
                {
                       $this->session->set_flashdata('error','Driving License Image: '. $this->dl_upload->display_errors());
                       $image_error = true;
                       
                } else
                {
                        $upload_data_image_driving_license_number = array('upload_data' => $this->dl_upload->data());
                        $image_driving_license_number = $upload_data_image_driving_license_number['upload_data']['file_name'];
                }
                
                if($image_error == false){
                   $vehicleEntryInfo = array(
                    'vehicle_type_id' => $vehicle_type_id,
                    'vehicle_company' => $vehicle_company,
                    'vehicle_number'  => $vehicle_number,
                    'driving_license_number' => $driving_license_number,
                    'image_vehicle_number_plate' => $image_vehicle_number_plate,
                    'image_driving_license_number' => $image_driving_license_number,
                    'driver_name' => $driver_name,
                    'rc' => $rc,
                    'entry_time' => date('Y-m-d H:i:s'),
                    'status' => 1,
                    'deleted' => 2,
                    'updated_by' => $this->vendorId,
                    'updated_time' => date('Y-m-d H:i:s')
                    
                );
                   
                // $result = $this->k_parking_model->insert($vehicleEntryInfo);
                $result = $this->k_parking_model->update($vehicleEntryInfo, $entryId);
                $this->global['pageTitle'] = PROJECT_NAME . ' : Add New Vehicle Entry';
                $data['title'] = "Vehicle Company";
                $data['sub_title'] = "Entry";
                
                if ($result > 0) {
                        
                        $this->session->set_flashdata('success', 'Entry Successful');
                
                    } else {
                        $this->session->set_flashdata('error', 'Entry failed');
                
                        
                    }
                }
            
                redirect('/employee/vehicle/add/entry/'.$entryId);
                // $this->addEntryView();
                 $this->loadViews($view, $this->global, $data, NULL);
            }
        }
    }
    
    /**
     * This function is used to load company edit information
     * @param number $companyId : Optional : This is company id
     */
    function editEntryView($companyId = NULL) {
        if ($this->isAdmin() == TRUE && $this->session->userdata('role') != 3) {
            $this->loadThis();
        } else {
            if ($companyId == null) {
                redirect('employee/vehicle/entrylist');
            }

            $data['companyInfo'] = $this->k_parking_model->getDetails($companyId);

            $this->global['pageTitle'] = PROJECT_NAME . ' : Edit Company';
            $data['title'] = "Vehicle Company";

            $data['sub_title'] = "Edit";

            $this->loadViews("employee/vehicle/entry/edit", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to edit the company information
     */
    function editEntry() {
        if ($this->isAdmin() == TRUE && $this->session->userdata('role') != 3 ) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');

            $companyId = $this->input->post('id');

            $this->form_validation->set_rules('name', 'Name', 'trim|required|max_length[128]');
            $this->form_validation->set_rules('email', 'Email', 'trim|valid_email|max_length[128]');
            


            if ($this->form_validation->run() == FALSE) {

                redirect("employee/vehicle/edit/entry/$companyId");
            } else {
                $name = ucwords(strtolower($this->input->post('name')));
                $email = strtolower($this->input->post('email'));
                $phone = $this->input->post('phone');
                $address = $this->input->post('address');
                $status = $this->input->post('status');

                $userCompanyInfo = array(
                    'name' => $name,
                    'email' => $email,
                    'phone' => $phone,
                    'address' => $address,
                    'status' => $status,
                    'updated_by' => $this->vendorId,
                    'updated_time' => date('Y-m-d H:i:s')
                );

                $result = $this->k_parking_model->update($userCompanyInfo, $companyId);

                if ($result == true) {
                    $this->session->set_flashdata('success', 'Entry updated successfully');
                } else {
                    $this->session->set_flashdata('error', 'Entry updation failed');
                }

                redirect("employee/vehicle/edit/entry/$companyId");
            }
        }
    }

    /**
     * This function is used to delete the company using id
     * @return boolean $result : TRUE / FALSE
     */
    function deleteEntry() {

        if ($this->isAdmin() == TRUE && $this->session->userdata('role') != 3 ) {
            echo(json_encode(array('status' => 'access')));
        } else {
            $id = $this->input->post('id');
            $data = array('deleted' => 1, 'updated_by' => $this->vendorId, 'updated_time' => date('Y-m-d H:i:s'));
            $result = $this->k_parking_model->delete($id, $data);
            if ($result > 0) {
                echo(json_encode(array('status' => TRUE)));
            } else {
                echo(json_encode(array('status' => FALSE)));
            }
        }
    }

    
      /**
     * This function is used to load the add new form
     */
    function addManualExitView($entryId = 0) {
        if (count(array_intersect($this->session->userdata('exitGateIdsArray'), array_keys($this->role_privileges))) == 0 && !array_key_exists(28,$this->role_privileges)) {
            $this->loadThis();
        } else {
            $data = array();
            $this->global['pageTitle'] = PROJECT_NAME . ' : Manual Exit';
            $data['title'] = "Manual Exit";

            $data['sub_title'] = "Exit";
            $view = "employee/vehicle/manualexit/add";
                $isNewEntry = true;
                $data['entryId'] ='';
                $isNotExited = true;
            if($entryId != 0){
                $data['entryId'] = $entryId;
                $entryDetails = $this->k_parking_model->getDetails($entryId);
                if(isset($entryDetails->vehicle_type_id)){
                    $vehicleTypeDetails = $this->k_master_vehicle_type_model->getDetails($entryDetails->vehicle_type_id);
                    if(isset($vehicleTypeDetails->number_of_wheels)){
                    $entryDetails->number_of_wheels = $vehicleTypeDetails->number_of_wheels;
                    $vehicleTypePrices = $this->k_master_price_per_time_model->getPricePerTimesByPriceId($vehicleTypeDetails->price_id);
                    $data['vehicleTypePrices'] = $vehicleTypePrices;
                    $data['masterPriceDetails'] = $this->k_master_price_model->getDetails($vehicleTypeDetails->price_id);
                    }

                    
                }
                
                if(isset($entryDetails->gate_id_entry)){
                    $entryGateDetails = $this->k_master_vehicle_gate_model->getDetails($entryDetails->gate_id_entry);
                    $data['entryGateDetails']= $entryGateDetails;
                }
                
                
                
                if(count($entryDetails) != 1){
                    $this->session->set_flashdata('error', 'Invalid Entry');
                }
            
                if(isset($entryDetails->entry_time) && strtotime($entryDetails->entry_time) > 0){
                    $isNewEntry = false;
                }
                
                if(isset($entryDetails->exit_time) && strtotime($entryDetails->exit_time) > 0){
                    $isNotExited = false;
                }
                
                $data['masterPriceListArray'] = $this->k_master_price_model->get();
              
                $data['entryDetails'] = $entryDetails;
            
            }
            $data['isNewEntry'] = $isNewEntry;
            $data['isNotExited'] = $isNotExited;
            
            $this->load->model('k_master_price_model');
            $data['vehicleTypeListArray'] = $this->k_master_vehicle_type_model->get();
            $data['terminalListArray'] = $this->k_master_vehicle_gate_model->get();
            
            
            // $data['vehicleCompanyListArray'] = $this->k_master_vehicle_company_model->get();
                  $this->global['assets'] = array('cssTopArray'     => array(base_url() . 'assets/plugins/datepicker/datepicker3'),
                              'cssBottomArray'  => array(),
                              'jsTopArray'      => array(),
                              'jsBottomArray'   => array(base_url() . 'assets/plugins/datepicker/bootstrap-datepicker')
                              
                    );
            
            $this->loadViews($view, $this->global, $data, NULL);
        }
    }
    
    
    function addManualExit() {
        if (count(array_intersect($this->session->userdata('exitGateIdsArray'), array_keys($this->role_privileges))) == 0 && !array_key_exists(28,$this->role_privileges)) {
        // if ($this->isAdmin() == TRUE && ($this->session->userdata('role') == 3 && $this->session->userdata('gateDetails')->type_name != 'entry')) {
        
            $this->loadThis();
        } else {
            $this->load->library('form_validation');

           $this->form_validation->set_rules('vehicle_type_id', 'Vehicle Type', 'trim|required|max_length[128]');
           
            // $this->form_validation->set_rules('email', 'Email', 'trim|valid_email|max_length[128]');
                
            if ($this->form_validation->run() == FALSE) {
                $this->addEntryView();
            } else {
                $data =array();
                
                $vehicle_type_id = $this->input->post('vehicle_type_id');
                $entry_date = $this->input->post('entry_date');
                $entry_time = $this->input->post('entry_time');
                $exit_date = $this->input->post('exit_date');
                
                $exit_time = $this->input->post('exit_time');
                $amount = $this->input->post('amount');
                
                $entry_date_time = $entry_date.' '.$entry_time.':00';
                $exit_date_time = $exit_date.' '.$exit_time.':00';
                
                $vehicle_company = ucwords(trim($this->input->post('vehicle_company')));
                $vehicle_number = strtoupper(trim($this->input->post('vehicle_number')));
                $driving_license_number = strtoupper(trim($this->input->post('driving_license_number')));
                $driver_name = ucwords(trim($this->input->post('driver_name')));
              //  $rc = strtoupper(trim($this->input->post('rc')));
                $image_vehicle_number_plate = $image_driving_license_number = '';
                $gate_id = $this->input->post('gate_id');
                
                
                
            if(isset($exit_date_time) && isset($entry_date_time)){
                    $total_number_of_seconds = strtotime($exit_date_time) - strtotime($entry_date_time);
            }
            
            
            //if total number of minutes cross this max minutes write logic here to get final amount
            $total_number_of_minutes = ceil($total_number_of_seconds/60);
            
                
                
                
                
                /*
                if($this->session->userdata('role') == 2 && $this->config->item('enable_admin_no_gate_restriction')){
                    $gate_id = $this->input->post('gate_id');
                }else{
                    $gate_id = $this->global['gateDetails']->id;
                } */   
                
                $vehicle_company = (!empty($vehicle_company))?$vehicle_company:'New Company';
                
                $config['allowed_types']        = 'gif|jpg|png';
//                $config['max_size']             = 2000;
//                $config['max_width']            = 1024;
//                $config['max_height']           = 768; 
//                $config['max_height']           = 768; 
                $config['upload_path'] = './assets/images/upload/numberplate/';
                // $config['upload_path']          = 'G:\xampp\htdocs\pms\assets\images\upload\numberplate';
                $config['file_name']            = mt_rand(100,1000).chr(64+rand(1,25)).mt_rand();
                $this->load->library('upload', $config, 'number_plate_upload'); // Create custom object for cover upload
                $this->number_plate_upload->initialize($config);
                $image_error = false;
                if ( ! $this->number_plate_upload->do_upload('image_vehicle_number_plate'))
                {
                       $this->session->set_flashdata('error','Number Plate Image: '.$this->number_plate_upload->display_errors());
                       $image_error = true;
                       
                }  else
                {
                        $upload_data_image_vehicle_number_plate = array('upload_data' => $this->number_plate_upload->data());
                        $image_vehicle_number_plate = $upload_data_image_vehicle_number_plate['upload_data']['file_name'];
                        
                    
                }
                
                $config['upload_path'] = './assets/images/upload/drivinglicense/';
                // $config['upload_path']          = 'G:\xampp\htdocs\pms\assets\images\upload\drivinglicense';
                $config['file_name']            = mt_rand(100,1000).chr(64+rand(1,26)).mt_rand();
                $this->load->library('upload', $config, 'dl_upload'); // Create custom object for cover upload
                $this->dl_upload->initialize($config);
                
    
                if ( ! $this->dl_upload->do_upload('image_driving_license_number') )
                {
                    if(!$this->config->item('disable_mandatory_field_entry')) { 
                       $this->session->set_flashdata('error','Driving License Image: '. $this->dl_upload->display_errors());
                       $image_error = true;
                    } 
                       
                } else
                {
                        $upload_data_image_driving_license_number = array('upload_data' => $this->dl_upload->data());
                        $image_driving_license_number = $upload_data_image_driving_license_number['upload_data']['file_name'];
                }
                
                if($image_error == false){
                           //load library
		$this->load->library('zend');
		//load in folder Zend
		$this->zend->load('Zend/Barcode');
		//generate barcode
                $code = mt_rand(1000,10000).time().mt_rand(1000,10000);
		$file = Zend_Barcode::draw('code128', 'image', array('text'=>$code), array());
                
                //$code = time().'1222';
        imagepng($file,"barcode/{$code}.png");
       // $data['barcode'] = $code.'.png';
        // $data['bar'] = $bar;
       // $this->load->view('anil',$data);
                
         
                    
                   $vehicleEntryInfo = array(
                    'vehicle_type_id' => $vehicle_type_id,
                    'vehicle_company' => $vehicle_company,
                    'vehicle_number'  => $vehicle_number,
                    'driving_license_number' => $driving_license_number,
                    'image_vehicle_number_plate' => $image_vehicle_number_plate,
                    'image_driving_license_number' => $image_driving_license_number,
                    'driver_name' => $driver_name,
                    'gate_id_entry' => $gate_id,
                    'gate_id_exit' => $gate_id,
                 //   'rc' => $rc,
                    'entry_time' => $entry_date_time,
                    'exit_time' => $exit_date_time,
                    'manual_exit' => 1,
                    'total_minutes' =>   $total_number_of_minutes,
                    'total_amount' => $amount,   
                    'barcode' =>  $code, 
                    'status' => 1,
                    'deleted' => 2,
                    'created_by' => $this->vendorId,
                    'created_time' => date('Y-m-d H:i:s')
                    
                );
                   
                $inserted_id = $this->k_parking_model->insert($vehicleEntryInfo);
//                echo $this->db->last_query();
//                echo $inserted_id;
//                exit;
                // $result = $this->k_parking_model->update($vehicleEntryInfo, $entryId);
                $this->global['pageTitle'] = PROJECT_NAME . ' : Manual Exit';
                $data['title'] = "Manual Exit";
                $data['sub_title'] = "Exit";
                
                if ($inserted_id > 0) {
                        
                        $this->session->set_flashdata('success', 'Entry Successful');
                
                    } else {
                        $this->session->set_flashdata('error', 'Entry failed');
                
                        
                    }
                }
            
                redirect('/employee/vehicle/exitdetails/'.$code);
                // $this->addEntryView();
              //   $this->loadViews($view, $this->global, $data, NULL);
            }
        }
    }
    
    function entryPrintStatus(){
         /**
     * This function is used to delete the company using id
     * @return boolean $result : TRUE / FALSE
     */
     if(!array_key_exists(23,$this->role_privileges)){
            echo(json_encode(array('status' => 'access')));
        } else {
            $id = $this->input->post('id');
            $data = array('entry_printed' => 1, 'updated_by' => $this->vendorId, 'updated_time' => date('Y-m-d H:i:s'));
            $result = $this->k_parking_model->update($data, $id);
            if ($result > 0) {
                echo(json_encode(array('status' => TRUE)));
            } else {
                echo(json_encode(array('status' => FALSE)));
            }
        }
    
    }
   
    
    function pageNotFound() {
        $this->global['pageTitle'] = 'Pms : 404 - Page Not Found';

        $this->loadViews("404", $this->global, NULL, NULL);
    }

}