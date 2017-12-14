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
        $this->load->model('k_master_vehicle_company_model');
        $this->load->model('k_master_vehicle_type_model');
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
    function typeList() {
        
        if ($this->isAdmin() == TRUE && $this->session->userdata('role') != 3 ) {
            $this->loadThis();
        } else {

            $searchText = $this->input->post('searchText');
            $data['searchText'] = $searchText;

            $data['totalCount'] = true;
            $data['searchText'] = $searchText;

            $result = $this->k_master_vehicle_type_model->getlist($data);
            $count = $result['count'];
            $data['totalCount'] = false;
            $segment = 5;
            $returns = $this->paginationCompress("employee/vehicle/type/list/", $count, PER_PAGE_RECORDS, $segment);

            $data['page'] = $returns['page'];
            $data['offset'] = $returns['offset'];

            $data['records'] = $this->k_master_vehicle_type_model->getList($data);

            $this->global['pageTitle'] = PROJECT_NAME . ' : Vehicle Type List';
            $data['title'] = 'Vehicle Type';
            $data['sub_title'] = 'List';

            $this->loadViews("employee/vehicle/type/list", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to load the add new form
     */
    function addTypeView() {
        if ($this->isAdmin() == TRUE && $this->session->userdata('role') != 3 ) {
            $this->loadThis();
        } else {
            $data = array();


            $this->global['pageTitle'] = PROJECT_NAME . ' : Add New Vehicle Type';
            $data['title'] = "Vehicle Type";

            $data['sub_title'] = "Add";
            $this->loadViews("employee/vehicle/type/add", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to load the add new form
     */
    function addType() {
        if ($this->isAdmin() == TRUE && $this->session->userdata('role') != 3) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('name', 'Name', 'trim|required|max_length[128]');
            $this->form_validation->set_rules('number_of_wheels', 'Number of wheels', 'trim|required|max_length[128]');

            if ($this->form_validation->run() == FALSE) {
                $this->addCompanyView();
            } else {
                $name = ucwords(strtolower($this->input->post('name')));
                $number_of_wheels = $this->input->post('number_of_wheels');
               

                $insertData = array(
                    'name' => $name,
                    'number_of_wheels' => $number_of_wheels,
                    'status' => 1,
                    'deleted' => 2,
                    'created_by' => $this->vendorId,
                    'created_time' => date('Y-m-d H:i:s')
                );

                $result = $this->k_master_vehicle_type_model->insert($insertData);

                if ($result > 0) {
                    $this->session->set_flashdata('success', 'New vehicle type created successfully');
                } else {
                    $this->session->set_flashdata('error', 'Vehicle type creation failed');
                }

                $this->global['pageTitle'] = PROJECT_NAME . ' : Add new vehicle type';
                $data['title'] = "Vehicle type";

                $data['sub_title'] = "Add";
                $this->loadViews("employee/vehicle/type/add", $this->global, $data, NULL);
            }
        }
    }

    /**
     * This function is used to load type edit information
     * @param number $id : Optional : This is type id
     */
    function editTypeView($id = NULL) {
        if ($this->isAdmin() == TRUE && $this->session->userdata('role') != 3) {
            $this->loadThis();
        } else {
            if ($id == null) {
                redirect('employee/vehicle/typelist');
            }

            $data['resultInfo'] = $this->k_master_vehicle_type_model->getDetails($id);

            $this->global['pageTitle'] = PROJECT_NAME . ' : Edit vehicle type';
            $data['title'] = "Vehicle type";

            $data['sub_title'] = "Edit";

            $this->loadViews("employee/vehicle/type/edit", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to edit the type information
     */
    function editType() {
        if ($this->isAdmin() == TRUE && $this->session->userdata('role') != 3 ) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');

            $id = $this->input->post('id');

            $this->form_validation->set_rules('name', 'Name', 'trim|required|max_length[128]');
            $this->form_validation->set_rules('number_of_wheels', 'Number of wheels', 'trim|required|max_length[128]');


            if ($this->form_validation->run() == FALSE) {

                redirect("employee/vehicle/edit/type/$id");
            } else {
                $name = ucwords(strtolower($this->input->post('name')));
                $number_of_wheels = $this->input->post('number_of_wheels');
                $updateInfo = $this->input->post('status');

                $updateInfo = array(
                    'name' => $name,
                    'number_of_wheels' => $number_of_wheels,
                    'status' => $status,
                    'updated_by' => $this->vendorId,
                    'updated_time' => date('Y-m-d H:i:s')
                );

                $result = $this->k_master_vehicle_type_model->update($updateInfo, $id);

                if ($result == true) {
                    $this->session->set_flashdata('success', 'Company updated successfully');
                } else {
                    $this->session->set_flashdata('error', 'Company updation failed');
                }

                redirect("employee/vehicle/edit/type/$id");
            }
        }
    }

    /**
     * This function is used to delete the the record using id
     * @return boolean $result : TRUE / FALSE
     */
    function deleteType() {

        if ($this->isAdmin() == TRUE && $this->session->userdata('role') != 3 ) {
            echo(json_encode(array('status' => 'access')));
        } else {
            $id = $this->input->post('id');
            $data = array('deleted' => 1, 'updated_by' => $this->vendorId, 'updated_time' => date('Y-m-d H:i:s'));
            $result = $this->k_master_vehicle_type_model->delete($id, $data);
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

