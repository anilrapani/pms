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

class Employee extends BaseController {

    /**
     * This is default constructor of the class
     */
    public function __construct() {
        parent::__construct();
        $this->load->model(array(   'k_master_user_company_model',
                                    'k_master_government_proof_type_model',
                                    'k_master_user_shift_model',
                                    'k_master_device_registry_model',
                                    'user_model'    )
                           );
        $this->isLoggedIn();
    }

    /**
     * This function used to load the first screen of the user
     */
    public function index() {
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        }
        
        $this->companyList();
    }

    /**
     * This function is used to load the company list
     */
    function companyList() {
        
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {

            $searchText = $this->input->post('searchText');
            $data['searchText'] = $searchText;

            $data['totalCount'] = true;
            $data['searchText'] = $searchText;

            $result = $this->k_master_user_company_model->getlist($data);
            $count = $result['count'];
            $data['totalCount'] = false;
            $segment = 5;
            $returns = $this->paginationCompress("admin/employee/company/list/", $count, PER_PAGE_RECORDS, $segment);

            $data['page'] = $returns['page'];
            $data['offset'] = $returns['offset'];

            $data['records'] = $this->k_master_user_company_model->getList($data);

            $this->global['pageTitle'] = PROJECT_NAME . ' : Company Listing';
            $data['title'] = 'Employee Company';
            $data['sub_title'] = 'List';

            $this->loadViews("admin/employee/company/list", $this->global, $data, NULL);
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
            $data['title'] = "Employee Company";

            $data['sub_title'] = "Add";
            $this->loadViews("admin/employee/company/add", $this->global, $data, NULL);
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

                $result = $this->k_master_user_company_model->insert($userCompanyInfo);

                if ($result > 0) {
                    $this->session->set_flashdata('success', 'New Company created successfully');
                } else {
                    $this->session->set_flashdata('error', 'Company creation failed');
                }

                $this->global['pageTitle'] = PROJECT_NAME . ' : Add New Company';
                $data['title'] = "Employee Company";

                $data['sub_title'] = "Add";
                $this->loadViews("admin/employee/company/add", $this->global, $data, NULL);
            }
        }
    }

    /**
     * This function is used to load company edit information
     * @param number $companyId : Optional : This is company id
     */
    function editCompanyView($companyId = NULL) {
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            if ($companyId == null) {
                redirect('admin/employee/companylist');
            }

            $data['companyInfo'] = $this->k_master_user_company_model->getDetails($companyId);

            $this->global['pageTitle'] = PROJECT_NAME . ' : Edit Company';
            $data['title'] = "Employee Company";

            $data['sub_title'] = "Edit";

            $this->loadViews("admin/employee/company/edit", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to edit the company information
     */
    function editCompany() {
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');

            $companyId = $this->input->post('id');

            $this->form_validation->set_rules('name', 'Name', 'trim|required|max_length[128]');
            $this->form_validation->set_rules('email', 'Email', 'trim|valid_email|max_length[128]');
            


            if ($this->form_validation->run() == FALSE) {

                redirect("admin/employee/edit/company/$companyId");
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

                $result = $this->k_master_user_company_model->update($userCompanyInfo, $companyId);

                if ($result == true) {
                    $this->session->set_flashdata('success', 'Company updated successfully');
                } else {
                    $this->session->set_flashdata('error', 'Company updation failed');
                }

                redirect("admin/employee/edit/company/$companyId");
            }
        }
    }

    /**
     * This function is used to delete the company using id
     * @return boolean $result : TRUE / FALSE
     */
    function deleteCompany() {

        if ($this->isAdmin() == TRUE) {
            echo(json_encode(array('status' => 'access')));
        } else {
            $id = $this->input->post('id');
            $data = array('deleted' => 1, 'updated_by' => $this->vendorId, 'updated_time' => date('Y-m-d H:i:s'));
            $result = $this->k_master_user_company_model->delete($id, $data);
            if ($result > 0) {
                echo(json_encode(array('status' => TRUE)));
            } else {
                echo(json_encode(array('status' => FALSE)));
            }
        }
    }
    
    
    
    /**
     * This function is used to load the Govt Proof Type list
     */
    function govtProofTypeList() {
       
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {

            $searchText = $this->input->post('searchText');
            $data['searchText'] = $searchText;

            $data['totalCount'] = true;
            $data['searchText'] = $searchText;

            $result = $this->k_master_government_proof_type_model->getlist($data);
            $count = $result['count'];
            $data['totalCount'] = false;
            $segment = 5;
            $returns = $this->paginationCompress("admin/employee/govtprooftype/list/", $count, PER_PAGE_RECORDS, $segment);

            $data['page'] = $returns['page'];
            $data['offset'] = $returns['offset'];

            $data['records'] = $this->k_master_government_proof_type_model->getList($data);

            $this->global['pageTitle'] = PROJECT_NAME . ' : Government proof type list';
            $data['title'] = 'Employee Government Proof Type';
            $data['sub_title'] = 'List';

            $this->loadViews("admin/employee/govtprooftype/list", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to load the add new form
     */
    function addGovtProofTypeView() {
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $data = array();


            $this->global['pageTitle'] = PROJECT_NAME . ' : Add New Government Proof Type';
            $data['title'] = "Employee Government Proof Type";

            $data['sub_title'] = "Add";
            $this->loadViews("admin/employee/govtprooftype/add", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to load the add new form
     */
    function addGovtProofType() {
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('name', 'Name', 'trim|required|max_length[128]');
            
            if ($this->form_validation->run() == FALSE) {
                $this->addGovtProofTypeView();
            } else {
                $name = ucwords(strtolower($this->input->post('name')));
                
                $inputData = array(
                    'name' => $name,
                    'status' => 1,
                    'deleted' => 2,
                    'created_by' => $this->vendorId,
                    'created_time' => date('Y-m-d H:i:s')
                );

                $result = $this->k_master_government_proof_type_model->insert($inputData);

                if ($result > 0) {
                    $this->session->set_flashdata('success', 'New record created successfully');
                } else {
                    $this->session->set_flashdata('error', ' Record insertion failed');
                }

                $this->global['pageTitle'] = PROJECT_NAME . ' : Add New Government Proof Type';
                $data['title'] = "Employee Government Proof Type";

                $data['sub_title'] = "Add";
                $this->loadViews("admin/employee/govtprooftype/add", $this->global, $data, NULL);
            }
        }
    }

    /**
     * This function is used to load company edit information
     * @param number $govtprooftypeId : Optional : This is govt proof type id
     */
    function editGovtProofTypeView($govtprooftypeId = NULL) {
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            if ($govtprooftypeId == null) {
                redirect('admin/employee/govtprooftype/list');
            }

            $data['resultInfo'] = $this->k_master_government_proof_type_model->getDetails($govtprooftypeId);

            $this->global['pageTitle'] = PROJECT_NAME . ' : Edit Government Proof Type';
            $data['title'] = "Employee Government Proof Type";

            $data['sub_title'] = "Edit";

            $this->loadViews("admin/employee/govtprooftype/edit", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to edit the Govt proof type information
     */
    function editGovtProofType() {
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');

            $companyId = $this->input->post('id');

            $this->form_validation->set_rules('name', 'Name', 'trim|required|max_length[128]');


            if ($this->form_validation->run() == FALSE) {

                redirect("admin/employee/edit/govtprooftype/$companyId");
            } else {
                $name = ucwords(strtolower($this->input->post('name')));
                $status = $this->input->post('status');

                $updatedInfo = array(
                    'name' => $name,
                    'status' => $status,
                    'updated_by' => $this->vendorId,
                    'updated_time' => date('Y-m-d H:i:s')
                );

                $result = $this->k_master_government_proof_type_model->update($updatedInfo, $companyId);

                if ($result == true) {
                    $this->session->set_flashdata('success', 'Updated successfully');
                } else {
                    $this->session->set_flashdata('error', 'Updation failed');
                }

                redirect("admin/employee/edit/govtprooftype/$companyId");
            }
        }
    }

    /**
     * This function is used to delete the govt proof type using id
     * @return boolean $result : TRUE / FALSE
     */
    function deleteGovtProofType() {

        if ($this->isAdmin() == TRUE) {
            echo(json_encode(array('status' => 'access')));
        } else {
            $id = $this->input->post('id');
            $data = array('deleted' => 1, 'updated_by' => $this->vendorId, 'updated_time' => date('Y-m-d H:i:s'));
            $result = $this->k_master_government_proof_type_model->delete($id, $data);
            if ($result > 0) {
                echo(json_encode(array('status' => TRUE)));
            } else {
                echo(json_encode(array('status' => FALSE)));
            }
        }
    }

    
    /**
     * This function is used to load the Shift list
     */
    function shiftList() {
       
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {

            $searchText = $this->input->post('searchText');
            $data['searchText'] = $searchText;

            $data['totalCount'] = true;
            $data['searchText'] = $searchText;

            $result = $this->k_master_user_shift_model->getlist($data);
            $count = $result['count'];
            $data['totalCount'] = false;
            $segment = 5;
            $returns = $this->paginationCompress("admin/employee/shift/list/", $count, PER_PAGE_RECORDS, $segment);

            $data['page'] = $returns['page'];
            $data['offset'] = $returns['offset'];

            $data['records'] = $this->k_master_user_shift_model->getList($data);

            $this->global['pageTitle'] = PROJECT_NAME . ' : Employee Shift list';
            $data['title'] = 'Employee Shift';
            $data['sub_title'] = 'List';

            $this->loadViews("admin/employee/shift/list", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to load the add new form
     */
    function addShiftView() {
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $data = array();


            $this->global['pageTitle'] = PROJECT_NAME . ' : Add New Employee Shift';
            $data['title'] = "Employee Shift";

            $data['sub_title'] = "Add";
             $this->global['assets'] = array('cssTopArray'     => array(base_url() . 'assets/plugins/timepicker/bootstrap-timepicker'),
                              'cssBottomArray'  => array(),
                              'jsTopArray'      => array(),
                              'jsBottomArray'   => array(base_url() . 'assets/plugins/timepicker/bootstrap-timepicker')
                              
                    );
            $this->loadViews("admin/employee/shift/add", $this->global, $data, $this->global);
        }
    }

    /**
     * This function is used to load the add new form
     */
    function addShift() {
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('name', 'Name', 'trim|required|max_length[128]');
            
            if ($this->form_validation->run() == FALSE) {
                $this->addShiftView();
            } else {
                $name = ucwords(strtolower($this->input->post('name')));
                $start_time = $this->input->post('start_time');
                $end_time = $this->input->post('end_time');
                $inputData = array(
                    'name' => $name,
                    'start_time' => $start_time,
                    'end_time' => $end_time,
                    'status' => 1,
                    'deleted' => 2,
                    'created_by' => $this->vendorId,
                    'created_time' => date('Y-m-d H:i:s')
                );

                $result = $this->k_master_user_shift_model->insert($inputData);

                if ($result > 0) {
                    $this->session->set_flashdata('success', 'New record created successfully');
                } else {
                    $this->session->set_flashdata('error', ' Record insertion failed');
                }

                $this->global['pageTitle'] = PROJECT_NAME . ' : Add New Shift';
                $data['title'] = "Employee Shift";

                $data['sub_title'] = "Add";
                
               
                
                $this->loadViews("admin/employee/shift/add", $this->global, $data, $this->global);
            }
        }
    }

    /**
     * This function is used to load shift edit information
     * @param number $id : Optional : This is shift id
     */
    function editShiftView($id = NULL) {
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            if ($id == null) {
                redirect('admin/employee/shift/list');
            }

            $data['resultInfo'] = $this->k_master_user_shift_model->getDetails($id);

            $this->global['pageTitle'] = PROJECT_NAME . ' : Edit Shift';
            $data['title'] = "Employee Shift";

            $data['sub_title'] = "Edit";

            $this->loadViews("admin/employee/shift/edit", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to edit the Govt proof type information
     */
    function editShift() {
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');

            $companyId = $this->input->post('id');

            $this->form_validation->set_rules('name', 'Name', 'trim|required|max_length[128]');


            if ($this->form_validation->run() == FALSE) {

                redirect("admin/employee/edit/shift/$companyId");
            } else {
                $name = ucwords(strtolower($this->input->post('name')));
                $status = $this->input->post('status');
                $start_time = $this->input->post('start_time');
                $end_time = $this->input->post('end_time');
                

                $updatedInfo = array(
                    'name' => $name,
                    'start_time' => $start_time,
                    'end_time' => $end_time,
                    'status' => $status,
                    'updated_by' => $this->vendorId,
                    'updated_time' => date('Y-m-d H:i:s')
                );

                $result = $this->k_master_user_shift_model->update($updatedInfo, $companyId);

                if ($result == true) {
                    $this->session->set_flashdata('success', 'Updated successfully');
                } else {
                    $this->session->set_flashdata('error', 'Updation failed');
                }

                redirect("admin/employee/edit/shift/$companyId");
            }
        }
    }

    /**
     * This function is used to delete the govt proof type using id
     * @return boolean $result : TRUE / FALSE
     */
    function deleteShift() {

        if ($this->isAdmin() == TRUE) {
            echo(json_encode(array('status' => 'access')));
        } else {
            $id = $this->input->post('id');
            $data = array('deleted' => 1, 'updated_by' => $this->vendorId, 'updated_time' => date('Y-m-d H:i:s'));
            $result = $this->k_master_user_shift_model->delete($id, $data);
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
    function deviceRegistryList() {
        
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {

            $searchText = $this->input->post('searchText');
            $data['searchText'] = $searchText;

            $data['totalCount'] = true;
            $data['searchText'] = $searchText;

            $result = $this->k_master_device_registry_model->getlist($data);
            $count = $result['count'];
            $data['totalCount'] = false;
            $segment = 5;
            $returns = $this->paginationCompress("admin/employee/deviceregistry/list/", $count, PER_PAGE_RECORDS, $segment);

            $data['page'] = $returns['page'];
            $data['offset'] = $returns['offset'];

            $data['records'] = $this->k_master_device_registry_model->getList($data);
            $this->global['pageTitle'] = PROJECT_NAME . ' : Device Registry List';
            $data['title'] = 'Device Registry';
            $data['sub_title'] = 'List';

            $this->loadViews("admin/employee/deviceregistry/list", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to load the add new form
     */
    function addDeviceRegistryView() {
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $data = array();


            $this->global['pageTitle'] = PROJECT_NAME . ' : Add New Device';
            $data['title'] = "Device Registry";
            $data['userListArray'] = $this->user_model->getUserList();
            

            $data['sub_title'] = "Add";
            $this->loadViews("admin/employee/deviceregistry/add", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to load the add new form
     */
    function addDeviceRegistry() {
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('name', 'Name', 'trim|required|max_length[128]');
            $this->form_validation->set_rules('ipaddress', 'Ipaddress', 'trim|required|max_length[128]');
            $this->form_validation->set_rules('user_id', 'User', 'trim|required|max_length[128]');
           
            if ($this->form_validation->run() == FALSE) {
                $this->addDeviceRegistryView();
            } else {
                $name = ucwords($this->input->post('name'));
                $ipaddress = $this->input->post('ipaddress');
                $user_id = $this->input->post('user_id');
                
                
                $insertData = array(
                    'name' => $name,
                    'ipaddress' => $ipaddress,
                    'user_id' => $user_id,
                    'status' => 1,
                    'deleted' => 2,
                    'created_by' => $this->vendorId,
                    'created_time' => date('Y-m-d H:i:s')
                );

                $vehicle_deviceregistry_id = $this->k_master_device_registry_model->insert($insertData);

                if ($vehicle_deviceregistry_id > 0) {
                    $this->session->set_flashdata('success', 'New device registry successfully');
                } else {
                    $this->session->set_flashdata('error', 'Device Registry failed');
                }

                $this->global['pageTitle'] = PROJECT_NAME . ' : Device Registry';
                $data['title'] = "Device Registry";

                $data['sub_title'] = "Add";
                redirect('admin/employee/deviceregistry/list');
                            }
        }
    }

    /**
     * This function is used to load Device Registry edit information
     * @param number $id : Optional : This is gate id
     */
    function editDeviceRegistryView($id = NULL) {
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            if ($id == null) {
                redirect('admin/employee/deviceregistrylist');
            }
            
            $data['resultInfo'] = $this->k_master_device_registry_model->getDetails($id);
            $data['userListArray'] = $this->user_model->getUserList();
            $this->global['pageTitle'] = PROJECT_NAME . ' : Edit Device Registry';
            $data['title'] = "Device Registry";

            $data['sub_title'] = "Edit";

            $this->loadViews("admin/employee/deviceregistry/edit", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to edit the gate information
     */
    function editDeviceRegistry() {
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
           
            
            $this->load->library('form_validation');

            $id = $this->input->post('id');

            $this->form_validation->set_rules('name', 'Name', 'trim|required|max_length[128]');
            $this->form_validation->set_rules('ipaddress', 'Ipaddress', 'trim|required|max_length[128]');
            $this->form_validation->set_rules('user_id', 'User', 'trim|required|max_length[128]');
            

            if ($this->form_validation->run() == FALSE) {
                
                redirect("admin/employee/edit/deviceregistry/$id");
            } else {
                $name = ucwords($this->input->post('name'));
                $ipaddress = $this->input->post('ipaddress');
                $user_id = $this->input->post('user_id');
                $status = $this->input->post('status');
                
                $updateInfo = array(
                    'name' => $name,
                    'ipaddress' => $ipaddress,
                    'user_id' => $user_id,
                    'status' => $status,
                    'updated_by' => $this->vendorId,
                    'updated_time' => date('Y-m-d H:i:s')
                );
                
                $result = $this->k_master_device_registry_model->update($updateInfo, $id);
                
                if ($result == true) {
                    $this->session->set_flashdata('success', 'Deveice Registry updated successfully');
                } else {
                    $this->session->set_flashdata('error', 'Device Registry updation failed');
                }

                redirect("admin/employee/edit/deviceregistry/$id");
            }
        }
    }

    /**
     * This function is used to delete the the record using id
     * @return boolean $result : TRUE / FALSE
     */
    function deleteDeviceRegistry() {

        if ($this->isAdmin() == TRUE) {
            echo(json_encode(array('status' => 'access')));
        } else {
            $id = $this->input->post('id');
            $data = array('deleted' => 1, 'updated_by' => $this->vendorId, 'updated_time' => date('Y-m-d H:i:s'));
            $result = $this->k_master_device_registry_model->delete($id, $data);
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

