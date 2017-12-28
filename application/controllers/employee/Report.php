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

class Report extends BaseController {

    /**
     * This is default constructor of the class
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('k_master_vehicle_type_model');
        $this->isLoggedIn();
    }
    
    function currentlist(){
        $this->global['pageTitle'] = PROJECT_NAME . ' : Report';
        $data['title'] = 'Pending Report';
        
        
        $this->load->model(array('k_parking_model','k_report_model'));
        $userReportCount = $this->k_report_model->getNumberOfRecordsByUserId($this->vendorId);
        $isTotalReportCountZero = FALSE;
        if($userReportCount->total_count == 0)
        $isTotalReportCountZero = TRUE;
        
        
        $inputData['isTotalReportCountZero'] = $isTotalReportCountZero;
        $inputData['vendorId'] = $this->vendorId;
        
        $data['currentReportArray'] = $this->k_parking_model->getReport($inputData);
     
        // $data['currentReportArray'] = array();
        $this->loadViews("employee/report/currentlist", $this->global, $data, NULL);
        
    }
    
    
     function currentReportSubmission(){
        $this->global['pageTitle'] = PROJECT_NAME . ' : Report';
        $data['title'] = 'Current Report';
        
        
        $this->load->model(array('k_parking_model','k_report_model'));
        $userReportCount = $this->k_report_model->getNumberOfRecordsByUserId($this->vendorId);
        $isTotalReportCountZero = FALSE;
        if($userReportCount->total_count == 0)
            $isTotalReportCountZero = TRUE;
        
        
        $inputData['isTotalReportCountZero'] = $isTotalReportCountZero;
        $inputData['vendorId'] = $this->vendorId;
        
        $currentReportArray = $this->k_parking_model->getReport($inputData);
        
                foreach($currentReportArray as $key => $record) {
                    $finalArray[] = array('user_id' => $this->vendorId, 
                                          'cash_amount' => $record->cash_amount,
                                          'card_amount' => $record->card_amount,
                                          // 'card_start_transaction_id' => $card_start_transaction_id,
                                          // 'card_end_transaction_id' => $card_end_transaction_id,
                                          'total_amount' => $record->total_amount,
                                          'gate_id' => $record->gate_id_exit,
                                          'paid_to_admin' => 1,
                                            'first_parking_id_time_after_login' => $record->first_parking_id_time_after_login,
                                            'last_parking_id_time_after_login' => $record->last_parking_id_time_after_login,
                                            'parking_id_from' => $record->parking_id_from,
                                            'parking_id_to' => $record->parking_id_to,
                                          'status' => 1,
                                            'deleted' => 2,
                                            'created_by' => $this->vendorId,
                                            'created_time' => date('Y-m-d H:i:s')
                        
                            );
                }
//                echo "<pre>";
//       echo $this->db->last_query();
//       var_dump($finalArray);
//       exit;
       $this->k_report_model->createReport($finalArray);

            
          //  exit;
       redirect("employee/report/current/list");
        $this->loadViews("employee/report/currentlist", $this->global, $data, NULL);
        
    }
    
    
    /**
     * This function is used to load the company list
     */
    function submittedList() {
            
        
        $this->global['pageTitle'] = PROJECT_NAME . ' : Report';
        $data['title'] = 'Submitted Report';
        
        
        $this->load->model(array('k_report_model'));
        
        $data['user_id'] = $this->vendorId;
        
        
            
      
            $searchText = $this->input->post('searchText');
            $data['searchText'] = $searchText;

            $data['totalCount'] = true;
            $data['searchText'] = $searchText;
            $this->load->model(array('k_report_model'));
            $result = $this->k_report_model->getList($data);
        
            
            $count = $result['count'];
            $data['totalCount'] = false;
            $segment = 5;
            $returns = $this->paginationCompress("employee/report/submitted/list/", $count, PER_PAGE_RECORDS, $segment);

            $data['page'] = $returns['page'];
            $data['offset'] = $returns['offset'];

            $data['currentReportArray'] = $this->k_report_model->getList($data);

            $this->global['pageTitle'] = PROJECT_NAME . ' : Employee Report';
            $data['title'] = 'Submitted Report';
            $data['sub_title'] = 'List';

            $this->loadViews("employee/report/submittedlist", $this->global, $data, NULL);
        
    }
    
    function generateReport(){
        $this->load->model('k_parking_model');
        
        
        $this->k_parking_model->getReport($this->vendorId);
    }
    function myReport(){
        $data = array();
        $this->load->model('k_parking_model');
       
        $inputData = array('start_date_time' => date('Y-m-d H:i:s',strtotime('-330 minutes',strtotime(date('Y-m-00 00:00:00')))));
        $data['amount']['totalAmount'] = $this->k_parking_model->getTotalAmountFromDate($inputData)->total_amount;
        // echo $this->db->last_query();
        // exit;
        
        // $totalAmountArray = array('start_date_time' => date('Y-m-d H:i:s',strtotime('-330 minutes',strtotime(date('Y-m-00 00:00:00')))));
        $inputData = array('paid_to_admin' => 1,'start_date_time' => date('Y-m-d H:i:s',strtotime('-330 minutes',strtotime(date('Y-m-00 00:00:00')))));
        $data['amount']['totalAmountCollected'] = $this->k_parking_model->getTotalAmountFromDate($inputData)->total_amount;
        $inputData = array('paid_to_admin' => 2,'start_date_time' => date('Y-m-d H:i:s',strtotime('-330 minutes',strtotime(date('Y-m-00 00:00:00')))));
        $data['amount']['totalAmountPending'] = $this->k_parking_model->getTotalAmountFromDate($inputData)->total_amount;
        $data['amount']['currentMonth'] = date('F');
//        echo date('F');
//        exit;
        // echo date('Y-m-d H:i:s',strtotime('-330 minutes',strtotime(date('Y-m-00 00:00:00'))));
        
//         echo "<pre>";
//         var_dump($data);
//         exit;
        // $data['totalAmount'] = 
//        // var_dump($totalPendingAmountArray);
//        // exit;
//        var_dump($totalAmountArray);
//        exit;
        // $totalAmountArray = $this->k_parking_model->getPendingAmountFromDate($inputData);
        
        
        
        $this->global['assets'] = array(
                                        'cssTopArray'     => array(),
                                        'cssBottomArray'  => array(),
                                        'jsTopArray'      => array(base_url() . 'assets/plugins/chartjs/chart'),
                                        'jsBottomArray'   => array()
                                        );
        
        $this->loadViews("admin/report/reportchart", $this->global, $data, NULL);
    }
    function amountcollection(){
        $this->loadViews("admin/report/amountcollection", $this->global, NULL, NULL);
    }
    function summary(){
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
        $this->loadViews("admin/report/summary", $this->global, NULL, NULL);
    }
    function pageNotFound() {
        $this->global['pageTitle'] = 'Pms : 404 - Page Not Found';

        $this->loadViews("404", $this->global, NULL, NULL);
    }

}