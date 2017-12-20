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
        $this->load->model(array('k_master_vehicle_company_model','k_parking_model','k_master_vehicle_type_model','k_master_price_model'));
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
        
        if ($this->isAdmin() == TRUE && $this->session->userdata('role') != 3 ) {
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

            $this->global['pageTitle'] = PROJECT_NAME . ' : Vehicle Company List';
            $data['title'] = 'Vehicle Company';
            $data['sub_title'] = 'List';

            $this->loadViews("employee/vehicle/company/list", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to load the add new form
     */
    function addCompanyView() {
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $data = array();


            $this->global['pageTitle'] = PROJECT_NAME . ' : Add New Company';
            $data['title'] = "Vehicle Company";

            $data['sub_title'] = "Add";
            $this->loadViews("employee/vehicle/company/add", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to load the add new form
     */
    function addCompany() {
        if ($this->isAdmin() == TRUE && $this->session->userdata('role') != 3) {
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
                
                
                
                $userCompanyInfo = array(
                    'name' => $name,
                    'email' => $email,
                    'phone' => $phone,
                    'address' => $address,
                    
                    'status' => 1,
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
                $data['title'] = "Vehicle Company";

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
        if ($this->isAdmin() == TRUE && $this->session->userdata('role') != 3) {
            $this->loadThis();
        } else {
            if ($companyId == null) {
                redirect('employee/vehicle/companylist');
            }

            $data['companyInfo'] = $this->k_master_vehicle_company_model->getDetails($companyId);

            $this->global['pageTitle'] = PROJECT_NAME . ' : Edit Company';
            $data['title'] = "Vehicle Company";

            $data['sub_title'] = "Edit";

            $this->loadViews("employee/vehicle/company/edit", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to edit the company information
     */
    function editCompany() {
        if ($this->isAdmin() == TRUE && $this->session->userdata('role') != 3 ) {
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

        if ($this->isAdmin() == TRUE && $this->session->userdata('role') != 3 ) {
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
    

    /**
     * This function is used to load the company list
     */
    function entryList() {
        
        if ($this->isAdmin() == TRUE && $this->session->userdata('role') != 3 ) {
            $this->loadThis();
        } else {

            $searchText = $this->input->post('searchText');
            $data['searchText'] = $searchText;

            $data['totalCount'] = true;
            $data['searchText'] = $searchText;

            $result = $this->k_parking_model->getlist($data);
            $count = $result['count'];
            $data['totalCount'] = false;
            $segment = 5;
            $returns = $this->paginationCompress("employee/vehicle/entry/list/", $count, PER_PAGE_RECORDS, $segment);

            $data['page'] = $returns['page'];
            $data['offset'] = $returns['offset'];

            $data['records'] = $this->k_parking_model->getList($data);

            $this->global['pageTitle'] = PROJECT_NAME . ' : Vehicle Entry List';
            $data['title'] = 'Vehicle Entry';
            $data['sub_title'] = 'List';

            $this->loadViews("employee/vehicle/entry/list", $this->global, $data, NULL);
        }
    }

    
     /**
     * This function is used to load the add new form
     */
    function addEntryId() {
        if ($this->isAdmin() == TRUE && $this->session->userdata('role') != 3) {
            $this->loadThis();
        } else {
             $isNewTicketCreated = $this->k_parking_model->isNewTicketCreated();
             if($isNewTicketCreated != NULL && count($isNewTicketCreated)){
                redirect('employee/vehicle/add/entry/'.$isNewTicketCreated->id);
             }
             
             $vehicleEntryInfo = array(
                    'status' => 1,
                    'deleted' => 2,
                    'created_by' => $this->vendorId,
                    'created_time' => date('Y-m-d H:i:s')
                 );
            $entry_id = $this->k_parking_model->insert($vehicleEntryInfo);
            redirect('employee/vehicle/add/entry/'.$entry_id);
            // $this->loadViews("employee/vehicle/entry/add", $this->global, $data, NULL);
        }
    }
    
    
    
    
    /**
     * This function is used to load the add new form
     */
    function addEntryView($entryId) {
        if ($this->isAdmin() == TRUE && $this->session->userdata('role') != 3) {
            $this->loadThis();
        } else {
            $data = array();
            $this->global['pageTitle'] = PROJECT_NAME . ' : Vehicle Entry';
            $data['title'] = "Entry No";

            $data['sub_title'] = "Entry";
            $data['entryId'] = $entryId;
            $entryDetails = $this->k_parking_model->getDetails($entryId);
            
            
            if(isset($entryDetails->vehicle_type_id)){
                $vehicleTypeDetails = $this->k_master_vehicle_type_model->getDetails($entryDetails->vehicle_type_id);
                if(isset($vehicleTypeDetails->number_of_wheels)){
                $entryDetails->number_of_wheels = $vehicleTypeDetails->number_of_wheels;
                }
                
                 $vehicleTypePrices = $this->k_master_price_model->getPriceListByVehicleType($entryDetails->vehicle_type_id);
            
                        
                        $data['vehicleTypePrices'] = $vehicleTypePrices;
                        
                        
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

    /**
     * This function is used to load the add new form
     */
    function addEntry($entryId) {
        if ($this->isAdmin() == TRUE && $this->session->userdata('role') != 3) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');

           $this->form_validation->set_rules('vehicle_type_id', 'Vehicle Type', 'trim|required|max_length[128]');
            // $this->form_validation->set_rules('email', 'Email', 'trim|valid_email|max_length[128]');
                
            if ($this->form_validation->run() == FALSE) {
                $this->addEntryView($entryId);
            } else {
                $data =array();
                
                $vehicle_type_id = $this->input->post('vehicle_type_id');
                $vehicle_company = ucwords($this->input->post('vehicle_company'));
                $vehicle_number = strtoupper($this->input->post('vehicle_number'));
                $driving_license_number = strtoupper($this->input->post('driving_license_number'));
                $driver_name = ucwords($this->input->post('driver_name'));
                $rc = strtoupper($this->input->post('rc'));
                $image_vehicle_number_plate = $image_driving_license_number = '';
                
                
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 2000;
                $config['max_width']            = 1024;
                $config['max_height']           = 768; 
                $config['max_height']           = 768; 
                
                $config['upload_path']          = 'G:\xampp\htdocs\pms\assets\images\upload\numberplate';
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
                
                
                $config['upload_path']          = 'G:\xampp\htdocs\pms\assets\images\upload\drivinglicense';
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
                           //load library
		$this->load->library('zend');
		//load in folder Zend
		$this->zend->load('Zend/Barcode');
		//generate barcode
                $code = time().'1222';
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
                    'rc' => $rc,
                    'entry_time' => date('Y-m-d H:i:s'),
                    'barcode' =>  $code, 
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

    
    function searchEntry(){
             if ($this->isAdmin() == TRUE && $this->session->userdata('role') != 3) {
            $this->loadThis();
        } else {
            $entryId = $this->input->post('entryId');
            redirect('/employee/vehicle/add/entry/'.$entryId);
            
        }
                  
                
    }
    
    function exitDetailsView(){
        if ($this->isAdmin() == TRUE && $this->session->userdata('role') != 3) {
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
           $this->loadViews($view, $this->global, $data, NULL);
                    
            
            
        }    
    }
    
    function exitDetails(){
        if ($this->isAdmin() == TRUE && $this->session->userdata('role') != 3) {
            $this->loadThis();
        } else {
            $data = array();
            $this->global['pageTitle'] = PROJECT_NAME . ' : Vehicle Exit Details';
            $data['title'] = "Entry No";
          
            $this->load->library('form_validation');

            $this->form_validation->set_rules('entryId', 'Vehicle Entry Id', 'trim|required|max_length[128]');
            // $this->form_validation->set_rules('email', 'Email', 'trim|valid_email|max_length[128]');
                
            if ($this->form_validation->run() == FALSE) {
                $this->exitDetailsView();
            } else {
                  $entryId = $this->input->post('entryId');
                     $data['onlysearchView'] = false;
                    $data['sub_title'] = "Exit Details";
                    $data['entryId'] = $entryId;
                    $entryDetails = $this->k_parking_model->getDetails($entryId);


                    if(isset($entryDetails->vehicle_type_id)){
                        $vehicleTypeDetails = $this->k_master_vehicle_type_model->getDetails($entryDetails->vehicle_type_id);
                        if(isset($vehicleTypeDetails->number_of_wheels)){
                        $entryDetails->number_of_wheels = $vehicleTypeDetails->number_of_wheels;
                        }
                        
                        
                        
                        
                        
                        $vehicleTypePrices = $this->k_master_price_model->getPriceListByVehicleType($entryDetails->vehicle_type_id);
            
                        
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
                        redirect('employee/vehicle/exitdetails/'.$entryId);
                    }
                    
                    
                    
                    
            
            }
           
            
            
        }    
    }
    
    
    function exitDetailsById($entryId){
        
        if ($this->isAdmin() == TRUE && $this->session->userdata('role') != 3) {
            $this->loadThis();
        } else {
            $data = array();
            $this->global['pageTitle'] = PROJECT_NAME . ' : Vehicle Exit Details';
            $data['title'] = "Barcode";
                     $data['titleScannerEntry'] = "Scanner entry";
           $data['titleManualEntry']  = "Manual entry";
       
                     $data['onlysearchView'] = false;
                    $data['sub_title'] = "Exit Details";
                    $data['entryId'] = $entryId;
                    $entryDetails = $this->k_parking_model->getDetails($entryId);
                    if(isset($entryDetails->vehicle_type_id)){
                        $vehicleTypeDetails = $this->k_master_vehicle_type_model->getDetails($entryDetails->vehicle_type_id);
                        if(isset($vehicleTypeDetails->number_of_wheels)){
                        $entryDetails->number_of_wheels = $vehicleTypeDetails->number_of_wheels;
                        }
                        
                        
                        
                        
                        
                        $vehicleTypePrices = $this->k_master_price_model->getPriceListByVehicleType($entryDetails->vehicle_type_id);
            
                        
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
                    if(count($entryDetails) != 1){
                             $this->session->set_flashdata('error', 'Invalid Entry');
                             $view = 'employee/vehicle/entry/invalid';
                    }
                    $data['entryDetails'] = $entryDetails;
                    $this->loadViews($view, $this->global, $data, NULL);
                    
        }    
    }
    
    function generateExitReciept(){
           if ($this->isAdmin() == TRUE && $this->session->userdata('role') != 3) {
            $this->loadThis();
        } else {
            $data = array();
            $this->global['pageTitle'] = PROJECT_NAME . ' : Vehicle Exit Bill';
            $data['title'] = "Exit Bill - Entry No : ";
            $data['sub_title'] = "Exit Bill - Entry No : ";
            
            $this->load->library('form_validation');
            
            
            $this->form_validation->set_rules('entryId', 'Vehicle Entry Id', 'trim|required|max_length[128]');
            // $this->form_validation->set_rules('email', 'Email', 'trim|valid_email|max_length[128]');
                
            if ($this->form_validation->run() == FALSE) {
                $this->exitDetailsView();
            } else {
                $entryId = $this->input->post('entryId');
            }
            $data['entryId'] = $entryId;
            $entryDetails = $this->k_parking_model->getDetails($entryId);
            
            // echo strtotime(convertTime(date('Y-m-d H:i:s'), $timeZoneName ='')) - strtotime(convertTime($entryDetails->entry_time, $timeZoneName =''));
            
            if(isset($entryDetails->vehicle_type_id)){
                
                
                $vehicleTypePrices = $this->k_master_price_model->getPriceListByVehicleType($entryDetails->vehicle_type_id);
                if(isset($entryDetails->entry_time)){
                    $total_number_of_seconds = strtotime(date('Y-m-d H:i:s')) - strtotime($entryDetails->entry_time);
                }
            }
//            echo date('Y-m-d H:i:s').'<br>';
//            echo strtotime(date('Y-m-d H:i:s')).'<br>';
//            echo $entryDetails->entry_time.'<br>';
//            echo strtotime($entryDetails->entry_time).'<br>';
//            // echo $entryDetails->id.'<br>';
//            echo $total_number_of_seconds."<br>";
//            echo gmdate("H:i:s", $total_number_of_seconds);
//            
            foreach ($vehicleTypePrices as $key => $value) {
              //  echo $value->from_minutes.'--'.$value->to_minutes."<br>";
                    if($total_number_of_seconds > ($value->from_minutes*60) && $total_number_of_seconds <= ($value->to_minutes*60)){
                        $amount = $value->amount;
                        break;
                    }
            }
            
            
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 2000;
                $config['max_width']            = 1024;
                $config['max_height']           = 768; 
                $config['max_height']           = 768; 
                
                $config['upload_path']          = 'G:\xampp\htdocs\pms\assets\images\upload\numberplate\exit';
                $config['file_name']            = mt_rand(100,1000).chr(64+rand(1,25)).mt_rand();
                $this->load->library('upload', $config, 'number_plate_upload'); // Create custom object for cover upload
                $this->number_plate_upload->initialize($config);
                $image_error = false;
                if ( ! $this->number_plate_upload->do_upload('image_vehicle_number_plate_exit'))
                {
                       $this->session->set_flashdata('error','Number Plate Image: '.$this->number_plate_upload->display_errors());
                       $image_error = true;
                       
                }  else
                {
                        $upload_data_image_vehicle_number_plate_exit = array('upload_data' => $this->number_plate_upload->data());
                        $image_vehicle_number_plate_exit = $upload_data_image_vehicle_number_plate_exit['upload_data']['file_name'];
                        
                    
                }
            
            
               if($image_error == false){
                   $vehicleExitInfo = array(
                    'total_amount' => $amount,
                    'exit_time' => date('Y-m-d H:i:s'),
                    'updated_by' => $this->vendorId,
                    'updated_time' => date('Y-m-d H:i:s'),
                    'image_vehicle_number_plate_exit' => $image_vehicle_number_plate_exit
                    
                );
                   $result = $this->k_parking_model->update($vehicleExitInfo, $entryId);
                   if($result){
                   redirect('employee/vehicle/exitdetails/'.$entryId);
                   }
                   
               }
               $entryDetails = $this->k_parking_model->getDetails($entryId);
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
         if ($this->isAdmin() == TRUE && $this->session->userdata('role') != 3) {
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



    
    function pageNotFound() {
        $this->global['pageTitle'] = 'Pms : 404 - Page Not Found';

        $this->loadViews("404", $this->global, NULL, NULL);
    }

}
?>

