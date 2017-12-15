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
        $this->load->model(array('k_master_vehicle_company_model','k_parking_model','k_master_vehicle_type_model'));
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
    function addEntryView() {
        if ($this->isAdmin() == TRUE && $this->session->userdata('role') != 3) {
            $this->loadThis();
        } else {
            $data = array();

            $this->load->model('k_master_price_model');
            $data['vehicleTypeListArray'] = $this->k_master_vehicle_type_model->get();
            $data['masterPriceListArray'] = $this->k_master_price_model->get();
            $data['vehicleCompanyListArray'] = $this->k_master_vehicle_company_model->get();
            
            $this->global['pageTitle'] = PROJECT_NAME . ' : Vehicle Entry';
            $data['title'] = "Entry";

            $data['sub_title'] = "Entry";
            $this->loadViews("employee/vehicle/entry/add", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to load the add new form
     */
    function addEntry() {
        if ($this->isAdmin() == TRUE && $this->session->userdata('role') != 3) {
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
                $vehicle_company = $this->input->post('vehicle_company');
                $vehicle_number = $this->input->post('vehicle_number');
                $driving_license_number = $this->input->post('driving_license_number');
                $image_vehicle_number_plate = $image_driving_license_number = '';
                
                
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 100;
                $config['max_width']            = 1024;
                $config['max_height']           = 768; 
                $config['max_height']           = 768; 
                
                $config['upload_path']          = 'G:\xampp\htdocs\pms\assets\images\upload\numberplate';
                $image_vehicle_number_plate = $config['file_name']            = mt_rand(10,100).chr(64+rand(0,26)).mt_rand();
                $this->load->library('upload', $config);
                
                
                if ( ! $this->upload->do_upload('image_vehicle_number_plate'))
                {
                       $this->session->set_flashdata('error',$this->upload->display_errors());
                       $this->loadViews("employee/vehicle/entry/add", $this->global, $data, NULL);
                       
                }  else
                {
                        $upload_data_image_vehicle_number_plate = array('upload_data' => $this->upload->data());
                    
                }
                
                $config['upload_path']          = 'G:\xampp\htdocs\pms\assets\images\upload\drivinglicense';
                $image_driving_license_number = $config['file_name']            = mt_rand(10,100).chr(64+rand(0,26)).mt_rand();
                $this->load->library('upload', $config);
                
                if ( ! $this->upload->do_upload('image_driving_license_number') )
                {
                       $this->session->set_flashdata('error',$this->upload->display_errors());
                       $this->loadViews("employee/vehicle/entry/add", $this->global, $data, NULL);
                       
                } else
                {
                        $upload_data_image_driving_license_number = array('upload_data' => $this->upload->data());
                    
                }
                
                $vehicleEntryInfo = array(
                    'vehicle_type_id' => $vehicle_type_id,
                    'vehicle_company' => $vehicle_company,
                    'vehicle_number'  => $vehicle_number,
                    'driving_license_number' => $driving_license_number,
                    'image_vehicle_number_plate' => $image_vehicle_number_plate,
                    'image_driving_license_number' => $image_driving_license_number,
                    'vehicle_company_id' => 1,
                    'entry_time' => date('Y-m-d H:i:s'),
                    'status' => 1,
                    'deleted' => 2,
                    'created_by' => $this->vendorId,
                    'created_time' => date('Y-m-d H:i:s')
                    
                );

                $result = $this->k_parking_model->insert($vehicleEntryInfo);

                if ($result > 0) {
                    $this->session->set_flashdata('success', 'New Company created successfully');
                } else {
                    $this->session->set_flashdata('error', 'Company creation failed');
                }

                $this->global['pageTitle'] = PROJECT_NAME . ' : Add New Vehicle Entry';
                $data['title'] = "Vehicle Company";

                $data['sub_title'] = "Entry";
                $this->loadViews("employee/vehicle/entry/add", $this->global, $data, NULL);
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

