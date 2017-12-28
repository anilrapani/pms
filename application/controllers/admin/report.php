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
    function reportchart(){
        
        $data = array();
        $this->load->model(array('k_parking_model','k_report_model'));
        $data['group_by'] = array('gate_id');
        $data['paid_to_admin'] = array(1,2);
        $data['allTerminalAmount'] = $this->k_report_model->getReportSummaryData($data);
        
        $inputData['fromDateTime'] = date('Y-m-00 00:00:00');        
        $data['amount']['currentMonthTotalAmount'] = $this->k_report_model->getReportSummaryData($inputData);
        $data['amount']['currentMonthTotalAmount'] = isset($data['amount']['currentMonthTotalAmount'][0]->total_amount)?$data['amount']['currentMonthTotalAmount'][0]->total_amount:0;
        $inputData['paid_to_admin'] = array(1,2);
        $data['amount']['currentMonthPendingAmount'] = $this->k_report_model->getReportSummaryData($inputData);
        $data['amount']['currentMonthPendingAmount'] = isset($data['amount']['currentMonthPendingAmount'][0]->total_amount)?$data['amount']['currentMonthPendingAmount'][0]->total_amount:0;
        $inputData['paid_to_admin'] = array(3);
        $data['amount']['currentMonthAdminCollected'] = $this->k_report_model->getReportSummaryData($inputData);
        $data['amount']['currentMonthAdminCollected'] = isset($data['amount']['currentMonthAdminCollected'][0]->total_amount)?$data['amount']['currentMonthAdminCollected'][0]->total_amount:0;
        $data['amount']['currentMonth'] = date('F');
        
/* Old code for chart
        $inputData = array('start_date_time' => date('Y-m-d H:i:s',strtotime('-330 minutes',strtotime(date('Y-m-00 00:00:00')))));
        $data['amount']['totalAmount'] = $this->k_parking_model->getTotalAmountFromDate($inputData)->total_amount;
        $inputData = array('paid_to_admin' => 1,'start_date_time' => date('Y-m-00 00:00:00'));
        $data['amount']['totalAmountCollected'] = $this->k_parking_model->getTotalAmountFromDate($inputData)->total_amount;
        $inputData = array('paid_to_admin' => 2,'start_date_time' => date('Y-m-00 00:00:00'));
        $data['amount']['totalAmountPending'] = $this->k_parking_model->getTotalAmountFromDate($inputData)->total_amount;
        $data['amount']['currentMonth'] = date('F');
*/


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
         
        $this->load->model(array('k_parking_model','k_report_model','user_model','k_master_vehicle_gate_model'));
        $data['gate_id'] = $data['user_id'] = '';
        $gate_id = $this->input->get('gate_id');
        
        $inputData['gate_id'] = $inputData['user_id'] = array();
        if(isset($gate_id)){
            $data['gate_id'] = $inputData['gate_id'] = array($gate_id);
            $data['gate_id'] = $gate_id;
        } 
        $user_id = $this->input->get('user_id');
         
        if(isset($user_id) && $user_id!=0){
            $inputData['user_id'] = array($user_id);
            $data['user_id'] = $user_id;
        } 
        
        $inputData['paid_to_admin'] = array(1,2);
        $data['submittedReportArray'] = $this->k_report_model->getReportData($inputData);
        
        /* start report */
          // echo "<pre>";
        if(isset($user_id) && $user_id!=0){
        
//        $data['userListArray'] = $this->user_model->getUserList();
//         
//         echo "<pre>";
//         var_dump($data['userListArray']);
//         exit;
         
        if(isset($user_id) && $user_id!=0){
            $userReportCount = $this->k_report_model->getNumberOfRecordsByUserId($user_id);
        }
         
        
        
        
        $isTotalReportCountZero = FALSE;
        if($userReportCount->total_count == 0)
        $isTotalReportCountZero = TRUE;
        
        
        $inputData['isTotalReportCountZero'] = $isTotalReportCountZero;
        $inputData['vendorId'] = $user_id;
        
        $data['currentReportArray'] = $this->k_parking_model->getReport($inputData);
      
        }else{
            $userListArray = $this->user_model->getUserList();
            
            foreach($userListArray as $user){
                        
                            if(isset($user->id) && $user->id!=0){
                       $userReportCount = $this->k_report_model->getNumberOfRecordsByUserId($user->id);
                   }




                   $isTotalReportCountZero = FALSE;
                   if($userReportCount->total_count == 0)
                   $isTotalReportCountZero = TRUE;


                   $inputData['isTotalReportCountZero'] = $isTotalReportCountZero;
                   $inputData['vendorId'] = $user->id;
                   
                   $onGoingResultArray = $this->k_parking_model->getReport($inputData);
                   foreach($onGoingResultArray as $onGoingResult){
                       $data['currentReportArray'][] = $onGoingResult;
                   }
                   
                   
        
                // var_dump($data['currentReportArray']);
                
            }
        }
      
//        var_dump($data['currentReportArray']);
//        exit;
        
        /* end report */
        
        
        
        
        $data['userListArray'] = $this->user_model->getUserList();
        $data['gateListArray'] = $this->k_master_vehicle_gate_model->getGatesList();
        
        
        
        
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
        $this->loadViews("admin/report/summary", $this->global, $data, NULL);
    }
    function approveEmployeeReport(){
         if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
                $report_id = $this->input->get('report_id');
                
                 $updatedInfo = array(
                    'paid_to_admin' => 3,
                    'updated_by' => $this->vendorId,
                    'updated_time' => date('Y-m-d H:i:s')
                );
                 $this->load->model('k_report_model');
                $result = $this->k_report_model->update($updatedInfo, $report_id);
          
                if ($result == true) {
                    $this->session->set_flashdata('success', 'Updated successfully');
                } else {
                    $this->session->set_flashdata('error', 'Updation failed');
                }
                $gate_id = $this->input->get('gate_id');
                $gate_id = (isset($gate_id) && $gate_id > 0)?$gate_id:0;
                $url_params.= 'gate_id='.$gate_id;
                $user_id = $this->input->get('user_id');
                $user_id = (isset($user_id) && $user_id > 0)?$user_id:0;
                $url_params.= '&user_id='.$user_id;
                redirect('admin/report/summary/?'.$url_params);
        }
         
    }
    
    
       /**
     * This function is used to load the company list
     */
    function collectedList() {
            
        
        $this->global['pageTitle'] = PROJECT_NAME . ' : Report';
        $data['title'] = 'Collected Report';
        
        
        $this->load->model(array('k_report_model'));
        
       
            
      
            $searchText = $this->input->post('searchText');
            $data['searchText'] = $searchText;

            $data['totalCount'] = true;
            $data['searchText'] = $searchText;
            $this->load->model(array('k_report_model'));
            $result = $this->k_report_model->getList($data);
        
            
            $count = $result['count'];
            $data['totalCount'] = false;
            $segment = 5;
            $returns = $this->paginationCompress("admin/report/collected/list/", $count, PER_PAGE_RECORDS, $segment);

            $data['page'] = $returns['page'];
            $data['offset'] = $returns['offset'];

            $data['currentReportArray'] = $this->k_report_model->getList($data);

            $this->global['pageTitle'] = PROJECT_NAME . ' : Employee Report';
            $data['title'] = 'Total Collected Report';
            $data['sub_title'] = 'List';

            $this->loadViews("admin/report/collectedlist", $this->global, $data, NULL);
        
    }
    
    
    
    function pageNotFound() {
        $this->global['pageTitle'] = 'Pms : 404 - Page Not Found';

        $this->loadViews("404", $this->global, NULL, NULL);
    }

}
?>

