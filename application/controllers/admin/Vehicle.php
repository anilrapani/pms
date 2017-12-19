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
        $this->load->model('k_master_vehicle_type_model');
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
        
        if ($this->isAdmin() == TRUE) {
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

            $this->loadViews("admin/vehicle/type/list", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to load the add new form
     */
    function addTypeView() {
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $data = array();


            $this->global['pageTitle'] = PROJECT_NAME . ' : Add New Vehicle Type';
            $data['title'] = "Vehicle Type";

            $data['sub_title'] = "Add";
            $this->loadViews("admin/vehicle/type/add", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to load the add new form
     */
    function addType() {
        if ($this->isAdmin() == TRUE) {
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
               $fromMinutesArray = $this->input->post('from_minutes');
               $toMinutesArray = $this->input->post('to_minutes');
               $amountArray =  $this->input->post('amount');
                
                $insertData = array(
                    'name' => $name,
                    'number_of_wheels' => $number_of_wheels,
                    'status' => 1,
                    'deleted' => 2,
                    'created_by' => $this->vendorId,
                    'created_time' => date('Y-m-d H:i:s')
                );

                $vehicle_type_id = $this->k_master_vehicle_type_model->insert($insertData);
                
                
                for($i=0; $i<count($fromMinutesArray);$i++) {
                    $finalArray[] = array('from_minutes' => $fromMinutesArray[$i], 
                                          'to_minutes' => $toMinutesArray[$i],
                                          'amount' => $amountArray[$i],
                                          'vehicle_type_id' => $vehicle_type_id,
                                          'status' => 1,
                                            'deleted' => 2,
                                            'created_by' => $this->vendorId,
                                            'created_time' => date('Y-m-d H:i:s')
                        
                            );
                }
       

                $this->load->model('k_master_price_model');
                $this->k_master_price_model->insertMultiplePricesByVehicleTypeId($finalArray);


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
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            if ($id == null) {
                redirect('admin/vehicle/typelist');
            }
            $this->load->model('k_master_price_model');
            $data['resultInfo'] = $this->k_master_vehicle_type_model->getDetails($id);
            $data['priceListArray'] = $this->k_master_price_model->getPriceListByVehicleType($id);
            
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
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');

            $id = $this->input->post('id');

            $this->form_validation->set_rules('name', 'Name', 'trim|required|max_length[128]');
            $this->form_validation->set_rules('number_of_wheels', 'Number of wheels', 'trim|required|max_length[128]');
            

            if ($this->form_validation->run() == FALSE) {

                redirect("admin/vehicle/edit/type/$id");
            } else {
                $name = ucwords(strtolower($this->input->post('name')));
                $number_of_wheels = $this->input->post('number_of_wheels');
                $status = $this->input->post('status');
                $fromMinutesArray = $this->input->post('from_minutes');
                $toMinutesArray = $this->input->post('to_minutes');
                $amountArray =  $this->input->post('amount');

                $updateInfo = array(
                    'name' => $name,
                    'number_of_wheels' => $number_of_wheels,
                    'status' => $status,
                    'updated_by' => $this->vendorId,
                    'updated_time' => date('Y-m-d H:i:s')
                );
                
                
                for($i=0; $i<count($fromMinutesArray);$i++) {
                    $finalArray[] = array('from_minutes' => $fromMinutesArray[$i], 
                                          'to_minutes' => $toMinutesArray[$i],
                                          'amount' => $amountArray[$i],
                                          'vehicle_type_id' => $id,
                                          'status' => 1,
                                            'deleted' => 2,
                                            'created_by' => $this->vendorId,
                                            'created_time' => date('Y-m-d H:i:s')
                        
                            );
                }
                
                
                $this->load->model('k_master_price_model');
                $deleteArray = array('deleted' => 1); 
                $this->k_master_price_model->deletingPricesExistingByVehicleTypeID($deleteArray,$id);
                $this->k_master_price_model->insertMultiplePricesByVehicleTypeId($finalArray);

                
                
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

        if ($this->isAdmin() == TRUE) {
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

