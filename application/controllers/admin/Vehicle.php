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
        $this->load->model(array(   'k_master_vehicle_type_model',
                                    'k_master_vehicle_gate_model',
                                    'user_model',
                                    'k_master_device_registry_model',
                                    'k_master_vehicle_gate_employee_model',
                                    'k_master_price_model',
                                    'k_master_price_per_time_model',
                                    'k_master_user_shift_model'
                                )
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
        
        $this->typeList();
    }


    
    /**
     * This function is used to load the company list
     */
    function typeList() {
        
        if(!array_key_exists(36,$this->role_privileges)){
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
            $returns = $this->paginationCompress("admin/vehicle/type/list/", $count, PER_PAGE_RECORDS, $segment);

            $data['page'] = $returns['page'];
            $data['offset'] = $returns['offset'];
    

            $data['records'] = $this->k_master_vehicle_type_model->getList($data);

            $this->global['pageTitle'] = PROJECT_NAME . ' : Vehicle Type List';
            $data['title'] = 'Vehicle Type';
            $data['sub_title'] = 'List';
            $this->global['assets'] = array('cssTopArray'     => array(base_url() . 'assets/plugins/iCheck/all'),
                         'cssBottomArray'  => array(),
                         'jsTopArray'      => array(),
                         'jsBottomArray'   => array(base_url() . 'assets/plugins/iCheck/icheck')

            );
            $this->loadViews("admin/vehicle/type/list", $this->global, $data, $this->global);
        }
    }

    /**
     * This function is used to load the add new form
     */
    function addTypeView() {
        if(!array_key_exists(36,$this->role_privileges)){
            $this->loadThis();
        } else {
            $data = array();


            $this->global['pageTitle'] = PROJECT_NAME . ' : Add New Vehicle Type';
            $data['title'] = "Vehicle Type";
            $data['priceListArray'] = $this->k_master_price_model->getPriceList();
            
        
            $data['sub_title'] = "Add";
            $this->loadViews("admin/vehicle/type/add", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to load the add new form
     */
    function addType() {
        if(!array_key_exists(36,$this->role_privileges)){
            $this->loadThis();
        } else {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('name', 'Name', 'trim|required|max_length[128]');
            $this->form_validation->set_rules('number_of_wheels', 'Number of wheels', 'trim|required|max_length[128]');

            if ($this->form_validation->run() == FALSE) {
                $this->addTypeView();
            } else {
                $name = ucwords(strtolower($this->input->post('name')));
                $number_of_wheels = $this->input->post('number_of_wheels');
      
                $fromMinutesArray = $this->input->post('from_minutes');
                $toMinutesArray = $this->input->post('to_minutes');
                $amountArray =  $this->input->post('amount');
                $price_id = $this->input->post('price_id');
                $status = $this->input->post('status');
               
                
                $insertData = array(
                    'name' => $name,
                    'number_of_wheels' => $number_of_wheels,
                    'price_id' => $price_id,
                    'status' => $status,
                    'deleted' => 2,
                    'created_by' => $this->vendorId,
                    'created_time' => date('Y-m-d H:i:s')
                );

                $vehicle_type_id = $this->k_master_vehicle_type_model->insert($insertData);
                
                
//                for($i=0; $i<count($fromMinutesArray);$i++) {
//                    $finalArray[] = array('from_minutes' => $fromMinutesArray[$i], 
//                                          'to_minutes' => $toMinutesArray[$i],
//                                          'amount' => $amountArray[$i],
//                                          'vehicle_type_id' => $vehicle_type_id,
//                                          'status' => 1,
//                                            'deleted' => 2,
//                                            'created_by' => $this->vendorId,
//                                            'created_time' => date('Y-m-d H:i:s')
//                        
//                            );
//                }
//       
//
//                
//                $this->k_master_price_model->insertMultiplePricesByVehicleTypeId($finalArray);


                if ($vehicle_type_id > 0) {
                    $this->session->set_flashdata('success', 'New vehicle type created successfully');
                } else {
                    $this->session->set_flashdata('error', 'Vehicle type creation failed');
                }

                $this->global['pageTitle'] = PROJECT_NAME . ' : Add new vehicle type';
                $data['title'] = "Vehicle type";

                $data['sub_title'] = "Add";
                $this->loadViews("admin/vehicle/type/add", $this->global, $data, NULL);
            }
        }
    }

    /**
     * This function is used to load type edit information
     * @param number $id : Optional : This is type id
     */
    function editTypeView($id = NULL) {
        if(!array_key_exists(36,$this->role_privileges)){
            $this->loadThis();
        } else {
            if ($id == null) {
                redirect('admin/vehicle/typelist');
            }
            $data['resultInfo'] = $this->k_master_vehicle_type_model->getDetails($id);
            $data['priceListArray'] = $this->k_master_price_model->getPriceList();
            $data['priceDetails'] = $this->k_master_price_model->getDetails($data['resultInfo']->price_id);
            
        
            $data['pricePerTimeArray'] =  $this->k_master_price_per_time_model->getPricePerTimesByPriceId($data['resultInfo']->price_id);

        
            $this->global['pageTitle'] = PROJECT_NAME . ' : Edit vehicle type';
            $data['title'] = "Vehicle type";

            $data['sub_title'] = "Edit";

            $this->loadViews("admin/vehicle/type/edit", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to edit the type information
     */
    function editType() {
        if(!array_key_exists(36,$this->role_privileges)){
            $this->loadThis();
        } else {
            $this->load->library('form_validation');

            $id = $this->input->post('id');

            $this->form_validation->set_rules('name', 'Name', 'trim|required|max_length[128]');
            $this->form_validation->set_rules('number_of_wheels', 'Number of wheels', 'trim|required|max_length[128]');
            $this->form_validation->set_rules('price_id', 'Price', 'trim|required|max_length[128]');
            

            if ($this->form_validation->run() == FALSE) {

                redirect("admin/vehicle/edit/type/$id");
            } else {
                $name = ucwords(strtolower($this->input->post('name')));
                $number_of_wheels = $this->input->post('number_of_wheels');
                $price_id = $this->input->post('price_id');
                $status = $this->input->post('status');
                $fromMinutesArray = $this->input->post('from_minutes');
                $toMinutesArray = $this->input->post('to_minutes');
                $amountArray =  $this->input->post('amount');

                $updateInfo = array(
                    'name' => $name,
                    'number_of_wheels' => $number_of_wheels,
                    'price_id' => $price_id,
                    'status' => $status,
                    'updated_by' => $this->vendorId,
                    'updated_time' => date('Y-m-d H:i:s')
                );
                
                
//                for($i=0; $i<count($fromMinutesArray);$i++) {
//                    $finalArray[] = array('from_minutes' => $fromMinutesArray[$i], 
//                                          'to_minutes' => $toMinutesArray[$i],
//                                          'amount' => $amountArray[$i],
//                                          'vehicle_type_id' => $id,
//                                          'status' => 1,
//                                            'deleted' => 2,
//                                            'created_by' => $this->vendorId,
//                                            'created_time' => date('Y-m-d H:i:s')
//                        
//                            );
//                }
//                
//                
//                $this->load->model('k_master_price_model');
//                $deleteArray = array('deleted' => 1); 
//                $this->k_master_price_model->deletingPricesExistingByVehicleTypeID($deleteArray,$id);
//                $this->k_master_price_model->insertMultiplePricesByVehicleTypeId($finalArray);

                
                
                $result = $this->k_master_vehicle_type_model->update($updateInfo, $id);
          
                if ($result == true) {
                    $this->session->set_flashdata('success', 'Company updated successfully');
                } else {
                    $this->session->set_flashdata('error', 'Company updation failed');
                }

                redirect("admin/vehicle/edit/type/$id");
            }
        }
    }

    /**
     * This function is used to delete the the record using id
     * @return boolean $result : TRUE / FALSE
     */
    function deleteType() {

        if(!array_key_exists(36,$this->role_privileges)){
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
    
    
    function updateTypeStatus() {

        if(!array_key_exists(36,$this->role_privileges)){
            echo(json_encode(array('status' => 'access')));
        } else {
            $id = $this->input->post('id');
            $status = $this->input->post('status');
            $data = array('status' => $status, 'updated_by' => $this->vendorId, 'updated_time' => date('Y-m-d H:i:s'));
            $result = $this->k_master_vehicle_type_model->update($data, $id);
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
    function gateList() {
        if(!array_key_exists(37,$this->role_privileges)){
            $this->loadThis();
        } else {

            $searchText = $this->input->post('searchText');
            $data['searchText'] = $searchText;

            $data['totalCount'] = true;
            $data['searchText'] = $searchText;

            $result = $this->k_master_vehicle_gate_model->getlist($data);
            $count = $result['count'];
            $data['totalCount'] = false;
            $segment = 5;
            $returns = $this->paginationCompress("admin/vehicle/gate/list/", $count, PER_PAGE_RECORDS, $segment);

            $data['page'] = $returns['page'];
            $data['offset'] = $returns['offset'];

            $data['records'] = $this->k_master_vehicle_gate_model->getList($data);

            $this->global['pageTitle'] = PROJECT_NAME . ' : Vehicle Gate List';
            $data['title'] = 'Vehicle Gate';
            $data['sub_title'] = 'List';
            $this->global['assets'] = array('cssTopArray'     => array(base_url() . 'assets/plugins/iCheck/all'),
                         'cssBottomArray'  => array(),
                         'jsTopArray'      => array(),
                         'jsBottomArray'   => array(base_url() . 'assets/plugins/iCheck/icheck')

            );
            $this->loadViews("admin/vehicle/gate/list", $this->global, $data, $this->global);
        }
    }

    /**
     * This function is used to load the add new form
     */
    function addGateView() {
        if(!array_key_exists(37,$this->role_privileges)){
            $this->loadThis();
        } else {
            $data = array();
            $this->global['pageTitle'] = PROJECT_NAME . ' : Add New Vehicle Gate';
            $data['userListArray'] = $this->user_model->getUserList();
            $data['deviceRegistryListArray'] = $this->k_master_device_registry_model->getDeviceRegistryList();
            $data['shiftListArray'] = $this->k_master_user_shift_model->getShiftList();
            
               $this->global['assets'] = array('cssTopArray'     => array(
                                                                base_url() . 'assets/plugins/timepicker/bootstrap-timepicker',
                                                ),
                
                                                'cssBottomArray'  => array(),
                                                'jsTopArray'      => array(
                                                                    base_url() . 'assets/plugins/timepicker/bootstrap-timepicker'
                                                ),
                                                'jsBottomArray'   => array(
                                                    
                                                    )
                              
                    );
            
            $data['title'] = "Vehicle Gate";
            $data['userListArray'] = $this->user_model->getUserList();
            $data['sub_title'] = "Add";
            $this->loadViews("admin/vehicle/gate/add", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to load the add new form
     */
    function addgate() {
        if(!array_key_exists(37,$this->role_privileges)){
            $this->loadThis();
        } else {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('name', 'Name', 'trim|required|max_length[128]');
            $this->form_validation->set_rules('type', 'Type', 'trim|required|max_length[128]');
           
            if ($this->form_validation->run() == FALSE) {
                $this->addGateView();
            } else {
                $name = ucwords($this->input->post('name'));
                $type = $this->input->post('type');
                $user_id_Array = $this->input->post('user_id');
                $shift_id_Array = $this->input->post('shift_id');
                $device_registry_id_Array = $this->input->post('device_registry_id');
                $status = $this->input->post('status');
                
                $insertData = array(
                    'name' => $name,
                    'type' => $type,
                    'status' => $status,
                    'deleted' => 2,
                    'created_by' => $this->vendorId,
                    'created_time' => date('Y-m-d H:i:s')
                );

                $vehicle_gate_id = $this->k_master_vehicle_gate_model->insert($insertData);
                
                
                // gate employees logic start
                
                
                       for($i=0; $i<count($user_id_Array);$i++) {
                    $finalArray[] = array('user_id' => $user_id_Array[$i], 
                                          // 'device_registry_id' => $device_registry_id_Array[$i],
                                          'device_registry_id' => 1,
                                          'shift_id' => $shift_id_Array[$i],
                                          'vehicle_gate_id' => $vehicle_gate_id,
                                          'status' => 1,
                                            'deleted' => 2,
                                            'created_by' => $this->vendorId,
                                            'created_time' => date('Y-m-d H:i:s')
                        
                            );
                }
       

                $this->load->model('k_master_price_model');
                $this->k_master_vehicle_gate_employee_model->insertEmployeesAtGate($finalArray);
                if ($vehicle_gate_id > 0) {
                    $this->session->set_flashdata('success', 'New vehicle gate created successfully');
                } else {
                    $this->session->set_flashdata('error', 'Vehicle gate creation failed');
                }

                $this->global['pageTitle'] = PROJECT_NAME . ' : Add new vehicle gate';
                $data['title'] = "Vehicle gate";

                $data['sub_title'] = "Add";
                // $this->gateList();
                redirect('admin/vehicle/gate/list');
                //$this->loadViews("admin/vehicle/gate/list", $this->global, $data, NULL);
            }
        }
    }

    /**
     * This function is used to load gate edit information
     * @param number $id : Optional : This is gate id
     */
    function editGateView($id = NULL) {
        
        if(!array_key_exists(37,$this->role_privileges)){
            $this->loadThis();
        } else {
            if ($id == null) {
                redirect('admin/vehicle/gatelist');
            }
            $this->load->model('k_master_price_model');
            $data['resultInfo'] = $this->k_master_vehicle_gate_model->getDetails($id);
            $data['userListAtGateArray'] = $this->k_master_vehicle_gate_employee_model->getUserListbyGateID($id);
            
            $data['userListArray'] = $this->user_model->getUserList();
            $data['shiftListArray'] = $this->k_master_user_shift_model->getShiftList();
            $data['deviceRegistryListArray'] = $this->k_master_device_registry_model->getDeviceRegistryList();
            
               $this->global['assets'] = array('cssTopArray'     => array(
                                                                base_url() . 'assets/plugins/timepicker/bootstrap-timepicker',
                                                ),
                
                                                'cssBottomArray'  => array(),
                                                'jsTopArray'      => array(
                                                                    base_url() . 'assets/plugins/timepicker/bootstrap-timepicker'
                                                ),
                                                'jsBottomArray'   => array(
                                                    
                                                    )
                              
                    );
               
               
            $this->global['pageTitle'] = PROJECT_NAME . ' : Edit vehicle gate';
            $data['title'] = "Vehicle gate";

            $data['sub_title'] = "Edit";

            $this->loadViews("admin/vehicle/gate/edit", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to edit the gate information
     */
    function editGate() {
        
        if(!array_key_exists(37,$this->role_privileges)){
            $this->loadThis();
        } else {
           
            
            $this->load->library('form_validation');

            $id = $this->input->post('id');

            $this->form_validation->set_rules('name', 'Name', 'trim|required|max_length[128]');
            $this->form_validation->set_rules('type', 'Type', 'trim|required|max_length[128]');
            

            if ($this->form_validation->run() == FALSE) {

                redirect("admin/vehicle/edit/gate/$id");
            } else {
                $name = ucwords($this->input->post('name'));
                $type = $this->input->post('type');
                $status = $this->input->post('status');
                
                $user_id_Array = $this->input->post('user_id');
                $shift_id_Array = $this->input->post('shift_id');
            //    $device_registry_id_Array = $this->input->post('device_registry_id');
                
                
                $updateInfo = array(
                    'name' => $name,
                    'type' => $type,
                    'status' => $status,
                    'updated_by' => $this->vendorId,
                    'updated_time' => date('Y-m-d H:i:s')
                );
                
             
                       for($i=0; $i<count($user_id_Array);$i++) {
                    $finalArray[] = array('user_id' => $user_id_Array[$i], 

                                      //      'device_registry_id' => $device_registry_id_Array[$i],
                                          'shift_id'  => $shift_id_Array[$i],
                                          'vehicle_gate_id' => $id,
                                          'status' => 1,
                                            'deleted' => 2,
                                            'created_by' => $this->vendorId,
                                            'created_time' => date('Y-m-d H:i:s')
                        
                            );
                }
                
                
                $deleteArray = array('deleted' => 1); 
                $this->k_master_vehicle_gate_employee_model->deleteEmployeesAtGate($deleteArray,$id);
                $this->k_master_vehicle_gate_employee_model->insertEmployeesAtGate($finalArray);

                
                
                
                $result = $this->k_master_vehicle_gate_model->update($updateInfo, $id);
                
                if ($result == true) {
                    $this->session->set_flashdata('success', 'Gate updated successfully');
                } else {
                    $this->session->set_flashdata('error', 'Gate updation failed');
                }

                redirect("admin/vehicle/edit/gate/$id");
            }
        }
    }

    /**
     * This function is used to delete the the record using id
     * @return boolean $result : TRUE / FALSE
     */
    function deleteGate() {

        if(!array_key_exists(37,$this->role_privileges)){
            echo(json_encode(array('status' => 'access')));
        } else {
            $id = $this->input->post('id');
            $data = array('deleted' => 1, 'updated_by' => $this->vendorId, 'updated_time' => date('Y-m-d H:i:s'));
            $result = $this->k_master_vehicle_gate_model->delete($id, $data);
            if ($result > 0) {
                echo(json_encode(array('status' => TRUE)));
            } else {
                echo(json_encode(array('status' => FALSE)));
            }
        }
    }
    
    
    
    
    function updateGateStatus() {

        if(!array_key_exists(1,$this->role_privileges)){
            echo(json_encode(array('status' => 'access')));
        } else {
            $id = $this->input->post('id');
            $status = $this->input->post('status');
            $data = array('status' => $status, 'updated_by' => $this->vendorId, 'updated_time' => date('Y-m-d H:i:s'));
            $result = $this->k_master_vehicle_gate_model->update($data, $id);
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
    function parkingList() {
        
        if(!array_key_exists(42,$this->role_privileges)){
            $this->loadThis();
        } else {
            
            $searchText = ''; // default when no term in session or POST
            $postSearchText = $this->input->post("searchText");
            if(isset($postSearchText) && empty($postSearchText)){
                $searchText = '';
                $this->session->set_userdata('searchText', $searchText);
            } else if ($postSearchText)
            {
                // use the term from POST and set it to session
                $searchText = $postSearchText;
                $this->session->set_userdata('searchText', $searchText);
            }else if ($this->session->userdata('searchText'))
            {
                // if term is not in POST use existing term from session
                $searchText = $this->session->userdata('searchText');
            }

            $data['totalCount'] = true;
            $data['searchText'] = $searchText;
            $this->load->model('k_parking_model');
            $result = $this->k_parking_model->getlist($data);
            $count = $result['count'];
            $data['totalCount'] = false;
            $segment = 5;
            $returns = $this->paginationCompress("admin/vehicle/parking/list/", $count, PER_PAGE_RECORDS, $segment);

            $data['page'] = $returns['page'];
            $data['offset'] = $returns['offset'];

            $data['records'] = $this->k_parking_model->getList($data);

            $this->global['pageTitle'] = PROJECT_NAME . ' : Vehicle Entry List';
            $data['title'] = 'Parking List';
            $data['sub_title'] = 'List';

            $this->loadViews("admin/vehicle/parking/list", $this->global, $data, NULL);
        }
    }
    
    
    /**
     * This function is used to load the company list
     */
    function report() {
        
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {

            $this->global['pageTitle'] = PROJECT_NAME . ' : Vehicle Report';
            $data['title'] = 'Vehicle Report';
            $data['sub_title'] = 'Report';
            // G:\xampp\htdocs\pms\assets\plugins\daterangepicker\daterangepicker.js
            $this->global['assets'] = array('cssTopArray'     => array(
                                                base_url() . 'assets/plugins/datepicker/datepicker3',
                                                base_url() . 'assets/plugins/timepicker/bootstrap-timepicker',
                                                base_url() . 'assets/plugins/daterangepicker/daterangepicker-bs3',
                                 
                
                ),
                
                              'cssBottomArray'  => array(),
                              'jsTopArray'      => array(),
                              'jsBottomArray'   => array(
                                                        base_url() . 'assets/plugins/datepicker/bootstrap-datepicker',
                                                        base_url() . 'assets/plugins/daterangepicker/moment',
                                                        base_url() . 'assets/plugins/daterangepicker/daterangepicker',
                                                        base_url() . 'assets/plugins/timepicker/bootstrap-timepicker'
                                                        
                                                    )
                              
                    );
            $this->loadViews("admin/vehicle/report", $this->global, $data, NULL);
        }
    }
    
    
    
    
    
     
    /**
     * This function is used to load the company list
     */
    function priceList() {
        
        if(!array_key_exists(35,$this->role_privileges)){
            $this->loadThis();
        } else {

            $searchText = $this->input->post('searchText');
            $data['searchText'] = $searchText;

            $data['totalCount'] = true;
            $data['searchText'] = $searchText;

            $result = $this->k_master_price_model->getlist($data);
            $count = $result['count'];
            $data['totalCount'] = false;
            $segment = 5;
            $returns = $this->paginationCompress("admin/vehicle/price/list/", $count, PER_PAGE_RECORDS, $segment);

            $data['page'] = $returns['page'];
            $data['offset'] = $returns['offset'];

            $data['records'] = $this->k_master_price_model->getList($data);

            $this->global['pageTitle'] = PROJECT_NAME . ' : Price List';
            $data['title'] = 'Price';
            $data['sub_title'] = 'List';
              $this->global['assets'] = array('cssTopArray'     => array(base_url() . 'assets/plugins/iCheck/all'),
                              'cssBottomArray'  => array(),
                              'jsTopArray'      => array(),
                              'jsBottomArray'   => array(base_url() . 'assets/plugins/iCheck/icheck')
                              
                    );

            $this->loadViews("admin/vehicle/price/list", $this->global, $data, $this->global);
        }
    }

    /**
     * This function is used to load the add new form
     */
    function addPriceView() {
        if(!array_key_exists(35,$this->role_privileges)){
            $this->loadThis();
        } else {
            $data = array();


            $this->global['pageTitle'] = PROJECT_NAME . ' : Add New Price';
            $data['title'] = "Price";

            $data['sub_title'] = "Add";
            $this->loadViews("admin/vehicle/price/add", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to load the add new form
     */
    function addPrice() {
        if(!array_key_exists(35,$this->role_privileges)){
            $this->loadThis();
        } else {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('name', 'Name', 'trim|required|max_length[128]');
           
            if ($this->form_validation->run() == FALSE) {
                $this->addPriceView();
            } else {
               $name = ucwords(strtolower($this->input->post('name')));
           //    $more_than_minutes = $this->input->post('more_than_minutes');
               $more_than_minutes_per_hour_amount =  $this->input->post('more_than_minutes_per_hour_amount');
               $fromMinutesArray = $this->input->post('from_minutes');
               $toMinutesArray = $this->input->post('to_minutes');
               $amountArray =  $this->input->post('amount');
               $status =  $this->input->post('status');
                
                $insertData = array(
                    'name' => $name,
                 //   'more_than_minutes' => $more_than_minutes,
                    'more_than_minutes_per_hour_amount' => $more_than_minutes_per_hour_amount,
                    'status' => $status,
                    'deleted' => 2,
                    'created_by' => $this->vendorId,
                    'created_time' => date('Y-m-d H:i:s')
                );

                $price_id = $this->k_master_price_model->insert($insertData);
                
                
                for($i=0; $i<count($fromMinutesArray);$i++) {
                    $finalArray[] = array('from_minutes' => $fromMinutesArray[$i], 
                                          'to_minutes' => $toMinutesArray[$i],
                                          'amount' => $amountArray[$i],
                                          'price_id' => $price_id,
                                          'status' => 1,
                                            'deleted' => 2,
                                            'created_by' => $this->vendorId,
                                            'created_time' => date('Y-m-d H:i:s')
                        
                            );
                }
       
                
                $this->load->model('k_master_price_model');
                $this->k_master_price_per_time_model->insertMultiplePricesByPriceId($finalArray);


                if ($price_id > 0) {
                    $this->session->set_flashdata('success', 'New price successfully');
                } else {
                    $this->session->set_flashdata('error', 'Price creation failed');
                }

                $this->global['pageTitle'] = PROJECT_NAME . ' : Add new price';
                $data['title'] = "price";

                $data['sub_title'] = "Add";
                $this->loadViews("admin/vehicle/price/add", $this->global, $data, NULL);
            }
        }
    }

    /**
     * This function is used to load type edit information
     * @param number $id : Optional : This is type id
     */
    function editPriceView($id = NULL) {
        if(!array_key_exists(35,$this->role_privileges)){
            $this->loadThis();
        } else {
            if ($id == null) {
                redirect('admin/vehicle/pricelist');
            }
            $data['resultInfo'] = $this->k_master_price_model->getDetails($id);
            $data['priceListArray'] = $this->k_master_price_per_time_model->getPriceListByPriceId($id);
            
            $this->global['pageTitle'] = PROJECT_NAME . ' : Edit Price';
            $data['title'] = "Price";

            $data['sub_title'] = "Edit";

            $this->loadViews("admin/vehicle/price/edit", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to edit the type information
     */
    function editPrice() {
        if(!array_key_exists(35,$this->role_privileges)){
            $this->loadThis();
        } else {
            $this->load->library('form_validation');

            $id = $this->input->post('id');

            $this->form_validation->set_rules('name', 'Name', 'trim|required|max_length[128]');
            

            if ($this->form_validation->run() == FALSE) {

                redirect("admin/vehicle/edit/price/$id");
            } else {
                $name = ucwords(strtolower($this->input->post('name')));
               //  $more_than_minutes = $this->input->post('more_than_minutes');
                $more_than_minutes_per_hour_amount =  $this->input->post('more_than_minutes_per_hour_amount');
                $status = $this->input->post('status');
                $fromMinutesArray = $this->input->post('from_minutes');
                $toMinutesArray = $this->input->post('to_minutes');
                $amountArray =  $this->input->post('amount');
                
               
                $updateInfo = array(
                    'name' => $name,
                   //  'more_than_minutes' => $more_than_minutes,
                    'more_than_minutes_per_hour_amount' => $more_than_minutes_per_hour_amount,
                    'status' => $status,
                    'updated_by' => $this->vendorId,
                    'updated_time' => date('Y-m-d H:i:s')
                );
                
                
                for($i=0; $i<count($fromMinutesArray);$i++) {
                    $finalArray[] = array('from_minutes' => $fromMinutesArray[$i], 
                                          'to_minutes' => $toMinutesArray[$i],
                                          'amount' => $amountArray[$i],
                                          'price_id' => $id,
                                          'status' => 1,
                                            'deleted' => 2,
                                            'created_by' => $this->vendorId,
                                            'created_time' => date('Y-m-d H:i:s')
                        
                            );
                }
                
                
                
                $deleteArray = array('deleted' => 1); 
                $this->k_master_price_per_time_model->deletingPricesExistingByPriceId($deleteArray,$id);
                $this->k_master_price_per_time_model->insertMultiplePricesByPriceId($finalArray);

                
                
                $result = $this->k_master_price_model->update($updateInfo, $id);

                if ($result == true) {
                    $this->session->set_flashdata('success', 'Price updated successfully');
                } else {
                    $this->session->set_flashdata('error', 'Price updation failed');
                }

                redirect("admin/vehicle/edit/price/$id");
            }
        }
    }

    /**
     * This function is used to delete the the record using id
     * @return boolean $result : TRUE / FALSE
     */
    function deletePrice() {

        if(!array_key_exists(35,$this->role_privileges)){
            echo(json_encode(array('status' => 'access')));
        } else {
            $id = $this->input->post('id');
            $data = array('deleted' => 1, 'updated_by' => $this->vendorId, 'updated_time' => date('Y-m-d H:i:s'));
            $result = $this->k_master_price_model->delete($id, $data);
            if ($result > 0) {
                echo(json_encode(array('status' => TRUE)));
            } else {
                echo(json_encode(array('status' => FALSE)));
            }
        }
    }
      function updatePriceStatus() {

        if(!array_key_exists(35,$this->role_privileges)){
            echo(json_encode(array('status' => 'access')));
        } else {
            $id = $this->input->post('id');
            $status = $this->input->post('status');
            $data = array('status' => $status, 'updated_by' => $this->vendorId, 'updated_time' => date('Y-m-d H:i:s'));
            $result = $this->k_master_price_model->update($data, $id);
            if ($result > 0) {
                echo(json_encode(array('status' => TRUE)));
            } else {
                echo(json_encode(array('status' => FALSE)));
            }
        }
    }
    
    function getPricePerTimeList(){
        $priceId = $this->input->post('priceId');
        $priceDetails = $this->k_master_price_model->getDetails($priceId);
        
        $pricePerTime =  $this->k_master_price_per_time_model->getPricePerTimesByPriceId($priceId);
        $finalArray = array( 'priceDetails' => $priceDetails, 'pricePerTime' => $pricePerTime );

        echo json_encode($finalArray);
        exit;
        
    }
    
  
    
    
    function pageNotFound() {
        $this->global['pageTitle'] = 'Pms : 404 - Page Not Found';

        $this->loadViews("404", $this->global, NULL, NULL);
    }

}