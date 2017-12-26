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
        $this->k_report_model->
        
        
        $inputData = array('start_date_time' => date('Y-m-d H:i:s',strtotime('-330 minutes',strtotime(date('Y-m-00 00:00:00')))));
        $data['amount']['totalAmount'] = $this->k_parking_model->getTotalAmountFromDate($inputData)->total_amount;
        // echo $this->db->last_query();
        // exit;
        
        // $totalAmountArray = array('start_date_time' => date('Y-m-d H:i:s',strtotime('-330 minutes',strtotime(date('Y-m-00 00:00:00')))));
        // $inputData = array('paid_to_admin' => 1,'start_date_time' => date('Y-m-d H:i:s',strtotime('-330 minutes',strtotime(date('Y-m-00 00:00:00')))));
        $inputData = array('paid_to_admin' => 1,'start_date_time' => date('Y-m-00 00:00:00'));
        $data['amount']['totalAmountCollected'] = $this->k_parking_model->getTotalAmountFromDate($inputData)->total_amount;
        $inputData = array('paid_to_admin' => 2,'start_date_time' => date('Y-m-00 00:00:00'));
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
?>

