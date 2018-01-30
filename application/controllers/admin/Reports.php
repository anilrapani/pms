<?php
require APPPATH . '/libraries/BaseController.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;

use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Writer\Pdf\Tcpdf;
/*
 * Copyright (C) 2017 Kastech
 * @project : pms
 * @author : Anil Rapani
 * @email : arapani@kastechindia.com
 * @since : Dec 11, 2017
 * @version : 
 */

class Reports extends BaseController {

    /**
     * This is default constructor of the class
     */
    public function __construct() {
        parent::__construct();
        $this->load->model(array('k_parking_model','k_master_vehicle_type_model','k_master_user_shift_model','k_master_vehicle_gate_model'));
        $this->isLoggedIn();
    }
       
     
    /**
     * This function is used to load the company list
     */
    function entryList() {
        if(!array_key_exists(7,$this->role_privileges)){
            $this->loadThis();
        } else {
            $data['entryDate'] = '';
            // $entryDate = '';
            $entryDate = $this->input->get("entryDate");
            // $download = false;
            $download = $this->input->get("download");
            $vehicle_type_id = $this->input->get("vehicle_type_id");
            $pdf = $this->input->get("pdf");
             $data['totalCount'] = false;
            $data['entryDate'] = $entryDate;
            $data['download'] = $download;
            $data['vehicle_type_id'] = $vehicle_type_id;
              
                 $entryListSummaryByVehicleType = $this->k_parking_model->getEntryListSummaryByVehicleType($data);   
            if($download == true){
               
                $resultEntryList = $this->k_parking_model->getEntrylist($data);
                $spreadsheet = new Spreadsheet();
                $sheet = $spreadsheet->getActiveSheet();
                $vehicle_type_name = "All Vehicles";
                            if(isset($vehicle_type_id) && !empty($vehicle_type_id)){
                                $vehicle_type_details = $this->k_master_vehicle_type_model->getDetails($vehicle_type_id);
                                $vehicle_type_name = $vehicle_type_details->name; 
                            }    
                   $sheet->setCellValue('B1', 'Vehicle Type :'.$vehicle_type_name );
                   $sheet->setCellValue('C1', 'Date :'.$entryDate);
                   $sheet->setCellValue('D1', 'Report Date :'.date('Y-m-d H:i:s'));
                   
                    $sheet->setCellValue('A3', 'Ticket No.');
                   $sheet->setCellValue('B3', 'Entry Date & Time');
                   $sheet->setCellValue('C3', 'Vehicle No.');
                   $sheet->setCellValue('D3', 'Vehicle Type');
                   $sheet->setCellValue('E3', 'Company Name');
                   $sheet->setCellValue('F3', 'Gate No');
                     $count = 4;  
               foreach ($resultEntryList as $value) {
                    $sheet->setCellValue('A' . $count, $value->ticket_no);
                   $sheet->setCellValue('B' . $count, $value->entry_time);
                   $sheet->setCellValue('C' . $count, $value->vehicle_number);
                   $sheet->setCellValue('D' . $count, $value->vehicle_type_name);
                   $sheet->setCellValue('E' . $count, $value->vehicle_company);
                   $sheet->setCellValue('F' . $count, $value->gate_entry_name);
                   $count++;
               }
             
              $count = $count+2;
               $totalVehiclesCount = 0;
               foreach ($entryListSummaryByVehicleType as $value) {
                   $sheet->setCellValue('E' . $count, "No. of ".$value->vehicle_type_name);
                   $sheet->setCellValue('F' . $count, $value->type_count);
                   $totalVehiclesCount = $totalVehiclesCount+$value->type_count;
                   
                   $count++;
                   
               }
               
               $sheet->setCellValue('E' . $count, "Total No. of Vehicles  Entered");
               $sheet->setCellValue('F' . $count, $totalVehiclesCount);
               
                   
//             for ($index = 0; $index < 100; $index++) {
//                        $sheet->setCellValue('A' . $index, 'Hi Anil' . $index);
//                    }
                  $downloaded_name = "daily_exit_report";
                  if($pdf == true){
                        header("Content-type:application/pdf");
                        header("Content-Disposition:attachment;filename=".$downloaded_name.".pdf");
                    }else{ 
                    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                    header("Content-Disposition:attachment;filename=".$downloaded_name.".xls");
                    }
                    header('Cache-Control: max-age=0');
            // If you're serving to IE 9, then the following may be needed
                    header('Cache-Control: max-age=1');

            // If you're serving to IE over SSL, then the following may be needed
                    header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
                    header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
                    header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
                    header('Pragma: public'); // HTTP/1.0
                       if($pdf == true){
                           $writer = new Tcpdf($spreadsheet);
                        
                    }else{ 
                        $writer = new Xls($spreadsheet);
                    }
                    $writer->save('php://output');
                    exit;
                
                
            }
         
              $data['entryListSummaryByVehicleType'] = $entryListSummaryByVehicleType;
            
//            if (isset($postEntryDate) && empty($postEntryDate)) {
//                $entryDate = '';
//                $this->session->set_userdata('entryDate', $entryDate);
//            } else if ($postEntryDate) {
//                // use the term from POST and set it to session
//                $entryDate = $postEntryDate;
//                $this->session->set_userdata('entryDate', $entryDate);
//            } else if ($this->session->userdata('entryDate')) {
//                // if term is not in POST use existing term from session
//                $entryDate = $this->session->userdata('entryDate');
//            }

            

            $data['totalCount'] = true;

            $this->load->model('k_parking_model');
            $result = $this->k_parking_model->getEntrylist($data);

            $count = $result['count'];
            $data['totalCount'] = false;
            $segment = 5;

            $returns = $this->paginationCompress("admin/reports/entry/list", $count, 100, $segment);

            $data['page'] = $returns['page'];
            $data['offset'] = $returns['offset'];

            $data['records'] = $this->k_parking_model->getEntrylist($data);

            $this->global['pageTitle'] = PROJECT_NAME . ' : Vehicle Entry List';
            $data['title'] = 'Daily Entry Report';
            $data['sub_title'] = 'List';
            $this->global['assets'] = array('cssTopArray' => array(
                    base_url() . 'assets/plugins/datepicker/datepicker3',
                    base_url() . 'assets/plugins/timepicker/bootstrap-timepicker',
                    base_url() . 'assets/plugins/daterangepicker/daterangepicker-bs3',
                ),
                'cssBottomArray' => array(),
                'jsTopArray' => array(),
                'jsBottomArray' => array(
                    base_url() . 'assets/plugins/datepicker/bootstrap-datepicker',
                    base_url() . 'assets/plugins/daterangepicker/moment',
                    base_url() . 'assets/plugins/daterangepicker/daterangepicker',
                    base_url() . 'assets/plugins/timepicker/bootstrap-timepicker'
                )
            );
            
            $data['vehicleTypeListArray'] = $this->k_master_vehicle_type_model->get();

            $this->loadViews("admin/reports/entrylist", $this->global, $data, NULL);
        }
    }
    
        /**
     * This function is used to load the company list
     */
    function exitList() {

        if(!array_key_exists(9,$this->role_privileges)){
            $this->loadThis();
        } else {
            $data['exitDate'] = '';
            // $entryDate = '';
            $exitDate = $this->input->get("exitDate");
            // $download = false;
            $download = $this->input->get("download");
            $vehicle_type_id = $this->input->get("vehicle_type_id");
            $pdf = $this->input->get("pdf");
             $data['totalCount'] = false;
            $data['exitDate'] = $exitDate;
            $data['download'] = $download;
            $data['vehicle_type_id'] = $vehicle_type_id;
              
                 $exitListSummaryByVehicleType = $this->k_parking_model->getExitListSummaryByVehicleType($data);   
            if($download == true){
               
                $resultExitList = $this->k_parking_model->getExitlist($data);
                $spreadsheet = new Spreadsheet();
                $sheet = $spreadsheet->getActiveSheet();
                $vehicle_type_name = "All Vehicles";
                            if(isset($vehicle_type_id) && !empty($vehicle_type_id)){
                                $vehicle_type_details = $this->k_master_vehicle_type_model->getDetails($vehicle_type_id);
                                $vehicle_type_name = $vehicle_type_details->name; 
                            }    
                   $sheet->setCellValue('B1', 'Vehicle Type :'.$vehicle_type_name );
                   $sheet->setCellValue('C1', 'Date :'.$exitDate);
                   $sheet->setCellValue('D1', 'Report Date :'.date('Y-m-d H:i:s'));
                   
                   $sheet->setCellValue('A3', 'Ticket No.');
                   $sheet->setCellValue('B3', 'Entry Date & Time');
                   $sheet->setCellValue('C3', 'Vehicle No.');
                   $sheet->setCellValue('D3', 'Vehicle Type');
                   $sheet->setCellValue('E3', 'Exit Time');
                   $sheet->setCellValue('F3', 'Parked Hours');
                   $sheet->setCellValue('G3', 'Parked Amount');
                   $sheet->setCellValue('H3', 'Company Name');
                   $sheet->setCellValue('I3', 'Gate No');
                     $count = 4;  
               foreach ($resultExitList as $value) {
                   $sheet->setCellValue('A' . $count, $value->ticket_no);
                   $sheet->setCellValue('B' . $count, $value->entry_time);
                   $sheet->setCellValue('C' . $count, $value->vehicle_number);
                   $sheet->setCellValue('D' . $count, $value->vehicle_type_name);
                   $sheet->setCellValue('E' . $count, $value->exit_time);
                   $sheet->setCellValue('F' . $count, $value->parked_hours);
                   $sheet->setCellValue('G' . $count, $value->total_amount);
                   $sheet->setCellValue('H' . $count, $value->vehicle_company);
                   $sheet->setCellValue('I' . $count, $value->gate_entry_name);
                   $count++;
               }
             
               $count = $count+2;
               $sheet->setCellValue('F' . $count, "Vehicle Type");
               $sheet->setCellValue('G' . $count, "No. of Vehicles");
               $sheet->setCellValue('H' . $count, "Amount");
               
               
               $count++;
               $totalVehiclesCount = 0;
               $totalAmount = 0;
               foreach ($exitListSummaryByVehicleType as $value) {
                   $sheet->setCellValue('F' . $count, $value->vehicle_type_name);
                   $sheet->setCellValue('G' . $count, $value->type_count);
                   $sheet->setCellValue('H' . $count, $value->amount);
                   $totalVehiclesCount = $totalVehiclesCount+$value->type_count;
                   $totalAmount = $totalAmount+$value->amount;
                   $count++;
               }
               
               $sheet->setCellValue('E' . $count, "Total");
               
               $sheet->setCellValue('G' . $count, $totalVehiclesCount);
               $sheet->setCellValue('H' . $count, $totalAmount);
               
                   
//             for ($index = 0; $index < 100; $index++) {
//                        $sheet->setCellValue('A' . $index, 'Hi Anil' . $index);
//                    }
                    $downloaded_name = "daily_exit_report";
                    if($pdf == true){
                        header("Content-type:application/pdf");
                        header("Content-Disposition:attachment;filename=".$downloaded_name.".pdf");
                    }else{ 
                        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                        header("Content-Disposition: attachment;filename=".$downloaded_name.".xls");
                    }
                    header('Cache-Control: max-age=0');
            // If you're serving to IE 9, then the following may be needed
                    header('Cache-Control: max-age=1');

            // If you're serving to IE over SSL, then the following may be needed
                    header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
                    header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
                    header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
                    header('Pragma: public'); // HTTP/1.0
                    if($pdf == true){
                        $writer = new Tcpdf($spreadsheet);
                    }else{
                        $writer = new Xls($spreadsheet);
                    }
                    $writer->save('php://output');
                    exit;
                
                
            }
         
              $data['exitListSummaryByVehicleType'] = $exitListSummaryByVehicleType;
            
//            if (isset($postEntryDate) && empty($postEntryDate)) {
//                $entryDate = '';
//                $this->session->set_userdata('entryDate', $entryDate);
//            } else if ($postEntryDate) {
//                // use the term from POST and set it to session
//                $entryDate = $postEntryDate;
//                $this->session->set_userdata('entryDate', $entryDate);
//            } else if ($this->session->userdata('entryDate')) {
//                // if term is not in POST use existing term from session
//                $entryDate = $this->session->userdata('entryDate');
//            }

            

            $data['totalCount'] = true;

            $this->load->model('k_parking_model');
            $result = $this->k_parking_model->getExitList($data);
           
            $count = $result['count'];
            $data['totalCount'] = false;
            $segment = 5;

            $returns = $this->paginationCompress("admin/reports/exit/list", $count, 100, $segment);

            $data['page'] = $returns['page'];
            $data['offset'] = $returns['offset'];

            $data['records'] = $this->k_parking_model->getExitList($data);
//             echo $this->db->last_query();
//            exit;
            $this->global['pageTitle'] = PROJECT_NAME . ' : Vehicle Exit List';
            $data['title'] = 'Daily Exit Report';
            $data['sub_title'] = 'List';
            $this->global['assets'] = array('cssTopArray' => array(
                    base_url() . 'assets/plugins/datepicker/datepicker3',
                    base_url() . 'assets/plugins/timepicker/bootstrap-timepicker',
                    base_url() . 'assets/plugins/daterangepicker/daterangepicker-bs3',
                ),
                'cssBottomArray' => array(),
                'jsTopArray' => array(),
                'jsBottomArray' => array(
                    base_url() . 'assets/plugins/datepicker/bootstrap-datepicker',
                    base_url() . 'assets/plugins/daterangepicker/moment',
                    base_url() . 'assets/plugins/daterangepicker/daterangepicker',
                    base_url() . 'assets/plugins/timepicker/bootstrap-timepicker'
                )
            );
            
            $data['vehicleTypeListArray'] = $this->k_master_vehicle_type_model->get();

            $this->loadViews("admin/reports/exitlist", $this->global, $data, NULL);
        }
    }
    
    
    function remainingList() {

        if(!array_key_exists(10,$this->role_privileges)){
            $this->loadThis();
        } else {
            $data['entryDate'] = '';
            // $entryDate = '';
            $entryDate = $this->input->get("entryDate");
            // $download = false;
            $download = $this->input->get("download");
            $vehicle_type_id = $this->input->get("vehicle_type_id");
            $pdf = $this->input->get("pdf");
             $data['totalCount'] = false;
            $data['entryDate'] = $entryDate;
            $data['download'] = $download;
            $data['vehicle_type_id'] = $vehicle_type_id;
              
                 $entryListSummaryByVehicleType = $this->k_parking_model->getRemainingListSummaryByVehicleType($data);   
            if($download == true){
               
                $resultEntryList = $this->k_parking_model->getRemaininglist($data);
                $spreadsheet = new Spreadsheet();
                $sheet = $spreadsheet->getActiveSheet();
                $vehicle_type_name = "All Vehicles";
                            if(isset($vehicle_type_id) && !empty($vehicle_type_id)){
                                $vehicle_type_details = $this->k_master_vehicle_type_model->getDetails($vehicle_type_id);
                                $vehicle_type_name = $vehicle_type_details->name; 
                            }    
                   $sheet->setCellValue('B1', 'Vehicle Type :'.$vehicle_type_name );
                   $sheet->setCellValue('C1', 'Date :'.$entryDate);
                   $sheet->setCellValue('D1', 'Report Date :'.date('Y-m-d H:i:s'));
                   
                    $sheet->setCellValue('A3', 'Ticket No.');
                   $sheet->setCellValue('B3', 'Entry Date & Time');
                   $sheet->setCellValue('C3', 'Vehicle No.');
                   $sheet->setCellValue('D3', 'Vehicle Type');
                   $sheet->setCellValue('E3', 'Company Name');
                   $sheet->setCellValue('F3', 'Gate No');
                     $count = 4;  
               foreach ($resultEntryList as $value) {
                    $sheet->setCellValue('A' . $count, $value->ticket_no);
                   $sheet->setCellValue('B' . $count, $value->entry_time);
                   $sheet->setCellValue('C' . $count, $value->vehicle_number);
                   $sheet->setCellValue('D' . $count, $value->vehicle_type_name);
                   $sheet->setCellValue('E' . $count, $value->vehicle_company);
                   $sheet->setCellValue('F' . $count, $value->gate_entry_name);
                   $count++;
               }
             
              $count = $count+2;
               $totalVehiclesCount = 0;
               foreach ($entryListSummaryByVehicleType as $value) {
                   $sheet->setCellValue('E' . $count, "No. of ".$value->vehicle_type_name);
                   $sheet->setCellValue('F' . $count, $value->type_count);
                   $totalVehiclesCount = $totalVehiclesCount+$value->type_count;
                   
                   $count++;
                   
               }
               
               $sheet->setCellValue('E' . $count, "Total No. of Vehicles  Entered");
               $sheet->setCellValue('F' . $count, $totalVehiclesCount);
               
                   
//             for ($index = 0; $index < 100; $index++) {
//                        $sheet->setCellValue('A' . $index, 'Hi Anil' . $index);
//                    }
               $downloaded_name = "daily_remaining_report";
                    if($pdf == true){
                        header("Content-type:application/pdf");
                        header("Content-Disposition:attachment;filename=".$downloaded_name.".pdf");
                    }else{ 
                        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                        header("Content-Disposition: attachment;filename=".$downloaded_name.".xls");
                    }
                    
                    header('Cache-Control: max-age=0');
            // If you're serving to IE 9, then the following may be needed
                    header('Cache-Control: max-age=1');

            // If you're serving to IE over SSL, then the following may be needed
                    header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
                    header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
                    header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
                    header('Pragma: public'); // HTTP/1.0
                     if($pdf == true){
                        $writer = new Tcpdf($spreadsheet);
                     }else{
                        $writer = new Xls($spreadsheet);
                     }
                    $writer->save('php://output');
                    exit;
                
                
            }
         
              $data['entryListSummaryByVehicleType'] = $entryListSummaryByVehicleType;
            
//            if (isset($postEntryDate) && empty($postEntryDate)) {
//                $entryDate = '';
//                $this->session->set_userdata('entryDate', $entryDate);
//            } else if ($postEntryDate) {
//                // use the term from POST and set it to session
//                $entryDate = $postEntryDate;
//                $this->session->set_userdata('entryDate', $entryDate);
//            } else if ($this->session->userdata('entryDate')) {
//                // if term is not in POST use existing term from session
//                $entryDate = $this->session->userdata('entryDate');
//            }

            

            $data['totalCount'] = true;

            $this->load->model('k_parking_model');
            $result = $this->k_parking_model->getRemaininglist($data);

            $count = $result['count'];
            $data['totalCount'] = false;
            $segment = 5;

            $returns = $this->paginationCompress("admin/reports/remaining/list", $count, 100, $segment);

            $data['page'] = $returns['page'];
            $data['offset'] = $returns['offset'];

            $data['records'] = $this->k_parking_model->getRemaininglist($data);

            $this->global['pageTitle'] = PROJECT_NAME . ' : Vehicle Remaining List';
            $data['title'] = 'Daily Remaining Vehicles Report';
            $data['sub_title'] = 'List';
            $this->global['assets'] = array('cssTopArray' => array(
                    base_url() . 'assets/plugins/datepicker/datepicker3',
                    base_url() . 'assets/plugins/timepicker/bootstrap-timepicker',
                    base_url() . 'assets/plugins/daterangepicker/daterangepicker-bs3',
                ),
                'cssBottomArray' => array(),
                'jsTopArray' => array(),
                'jsBottomArray' => array(
                    base_url() . 'assets/plugins/datepicker/bootstrap-datepicker',
                    base_url() . 'assets/plugins/daterangepicker/moment',
                    base_url() . 'assets/plugins/daterangepicker/daterangepicker',
                    base_url() . 'assets/plugins/timepicker/bootstrap-timepicker'
                )
            );
            
            $data['vehicleTypeListArray'] = $this->k_master_vehicle_type_model->get();

            $this->loadViews("admin/reports/remaininglist", $this->global, $data, NULL);
        }
    }
    
    
    function monthlyList() {

        if(!array_key_exists(11,$this->role_privileges)){
            $this->loadThis();
        } else {
            
            $year = $this->input->get("year");
            $month = $this->input->get("month");
            $download = $this->input->get("download");
            $pdf = $this->input->get("pdf");
            
            $data['totalCount'] = false;
            $data['download'] = $download;
            $data['year'] = $year;
            $data['month'] = $month;
            
            if($download == true){
               $monthlySummaryByVehicleType = $this->k_parking_model->getMonthlySummaryByVehicleTypeList($data);   
                $spreadsheet = new Spreadsheet();
                $sheet = $spreadsheet->getActiveSheet();
                $sheet->setCellValue('B1', 'Year :'.$year);
                $sheet->setCellValue('C1', 'Month :'.$month);
                $sheet->setCellValue('D1', 'Report Date :'.date('Y-m-d H:i:s'));
                
                
                $sheet->setCellValue('A3', 'Vehicle Type');
                $sheet->setCellValue('B3', 'Exit Date');
                $sheet->setCellValue('C3', 'Total Vehicles Exited');
                $sheet->setCellValue('D3', 'Total Amount');
                $count = 4;  
                
                $final_total_vehicles_exited = $final_total_amount = 0;
                
               foreach ($monthlySummaryByVehicleType as $value) {
                    $sheet->setCellValue('A' . $count, $value->vehicle_type_name);
                    $sheet->setCellValue('B' . $count, $value->each_date);
                    $sheet->setCellValue('C' . $count, $value->total_vehicles_exited);
                    $final_total_vehicles_exited = $final_total_vehicles_exited+$value->total_vehicles_exited;
                    $sheet->setCellValue('D' . $count, $value->total_amount);
                    $final_total_amount = $final_total_amount+$value->total_amount;
                    $count++;
               }
             
              $count = $count+1;
              $sheet->setCellValue('B' . $count, 'Total');
              $sheet->setCellValue('C' . $count, $final_total_vehicles_exited);
              $sheet->setCellValue('D' . $count, $final_total_amount);
               
           
                $downloaded_name = "monthly_report";
                    if($pdf == true){
                        header("Content-type:application/pdf");
                        header("Content-Disposition:attachment;filename=".$downloaded_name.".pdf");
                    }else{ 
                        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                        header("Content-Disposition: attachment;filename=".$downloaded_name.".xls");
                    }
                    
                    header('Cache-Control: max-age=0');
            // If you're serving to IE 9, then the following may be needed
                    header('Cache-Control: max-age=1');

            // If you're serving to IE over SSL, then the following may be needed
                    header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
                    header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
                    header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
                    header('Pragma: public'); // HTTP/1.0
                    if($pdf == true){
                        $writer = new Tcpdf($spreadsheet);
                    }else{
                        $writer = new Xls($spreadsheet);
                    }
                    $writer->save('php://output');
                    exit;
                
                
            }
         
            $data['totalCount'] = true;

            $this->load->model('k_parking_model');
            $result = $this->k_parking_model->getMonthlySummaryByVehicleTypeList($data);

            $count = $result['count'];
            $data['totalCount'] = false;
            $segment = 5;
             
            $final_total_vehicles_exited = $final_total_amount = 0;
            
            foreach ($result as $value) {
                if(isset($value->total_vehicles_exited)){
                        $final_total_vehicles_exited = $final_total_vehicles_exited+$value->total_vehicles_exited;
                        $final_total_amount = $final_total_amount+$value->total_amount;

                }
            }
            
            $data['final_total_vehicles_exited'] = $final_total_vehicles_exited;
            $data['final_total_amount'] = $final_total_amount;
            
               
            $returns = $this->paginationCompress("admin/reports/monthly/list", $count, 100, $segment);

            $data['page'] = $returns['page'];
            $data['offset'] = $returns['offset'];

            $data['records'] = $this->k_parking_model->getMonthlySummaryByVehicleTypeList($data);

            $this->global['pageTitle'] = PROJECT_NAME . ' : Monthly Report';
            $data['title'] = 'Monthly Report';
            $data['sub_title'] = 'List';
            $this->global['assets'] = array('cssTopArray' => array(
                    base_url() . 'assets/plugins/datepicker/datepicker3',
                    base_url() . 'assets/plugins/timepicker/bootstrap-timepicker',
                    base_url() . 'assets/plugins/daterangepicker/daterangepicker-bs3',
                ),
                'cssBottomArray' => array(),
                'jsTopArray' => array(),
                'jsBottomArray' => array(
                    base_url() . 'assets/plugins/datepicker/bootstrap-datepicker',
                    base_url() . 'assets/plugins/daterangepicker/moment',
                    base_url() . 'assets/plugins/daterangepicker/daterangepicker',
                    base_url() . 'assets/plugins/timepicker/bootstrap-timepicker'
                )
            );
            
            $this->loadViews("admin/reports/monthly_report", $this->global, $data, NULL);
        }
    }
    
    function shiftList() {
        if(!array_key_exists(6,$this->role_privileges)){
            $this->loadThis();
        } else {
            
            $shift_id = $this->input->get("shift_id");
            $exitDate = $this->input->get("exitDate");
            $download = $this->input->get("download");
            $pdf = $this->input->get("pdf");
            
            $data['totalCount'] = false;
            $data['download'] = $download;
            if($shift_id){
                $shift_details = $this->k_master_user_shift_model->getDetails($shift_id);
                $data['start_time'] = $shift_details->start_time;
                $data['end_time'] = $shift_details->end_time;
            }
            
            $data['exitDate'] = $exitDate;
            $data['shift_id'] = $shift_id;
            
            
            
            if($download == true){
               $monthlySummaryByVehicleType = $this->k_parking_model->getShiftSummaryByVehicleTypeList($data);   
                $spreadsheet = new Spreadsheet();
                $sheet = $spreadsheet->getActiveSheet();
                if($shift_id){
                $sheet->setCellValue('B1', 'Shift :'.$data['start_time'].'-'.$data['end_time']);
                }else{
                    $sheet->setCellValue('B1', 'Shift : All');
                }
                $sheet->setCellValue('C1', 'Exit Date :'.$data['exitDate']);
                $sheet->setCellValue('D1', 'Report Date :'.date('Y-m-d H:i:s'));
                
                
                $sheet->setCellValue('A3', 'Vehicle Type');
                $sheet->setCellValue('B3', 'Gate Name');
                $sheet->setCellValue('C3', 'Total Vehicles Exited');
                $sheet->setCellValue('D3', 'Total Amount');
                $count = 4;  
                
                $final_total_vehicles_exited = $final_total_amount = 0;
                
               foreach ($monthlySummaryByVehicleType as $value) {
                    $sheet->setCellValue('A' . $count, $value->vehicle_type_name);
                    $sheet->setCellValue('B' . $count, $value->gate_name);
                    $sheet->setCellValue('C' . $count, $value->total_vehicles_exited);
                    $final_total_vehicles_exited = $final_total_vehicles_exited+$value->total_vehicles_exited;
                    $sheet->setCellValue('D' . $count, $value->total_amount);
                    $final_total_amount = $final_total_amount+$value->total_amount;
                    $count++;
               }
             
              $count = $count+1;
              $sheet->setCellValue('B' . $count, 'Total');
              $sheet->setCellValue('C' . $count, $final_total_vehicles_exited);
              $sheet->setCellValue('D' . $count, $final_total_amount);
               
             $downloaded_name = "shift_report";
                    if($pdf == true){
                        header("Content-type:application/pdf");
                        header("Content-Disposition:attachment;filename=".$downloaded_name.".pdf");
                    }else{ 
                        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                        header("Content-Disposition: attachment;filename=".$downloaded_name.".xls");
                    }
                    
                    header('Cache-Control: max-age=0');
            // If you're serving to IE 9, then the following may be needed
                    header('Cache-Control: max-age=1');

            // If you're serving to IE over SSL, then the following may be needed
                    header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
                    header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
                    header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
                    header('Pragma: public'); // HTTP/1.0
                    if($pdf == true){
                        $writer = new Tcpdf($spreadsheet);
                    }else{
                        $writer = new Xls($spreadsheet);
                    }
                    $writer->save('php://output');
                    exit;
                
                
            }
         
            $data['totalCount'] = true;

            $this->load->model('k_parking_model');
            $result = $this->k_parking_model->getShiftSummaryByVehicleTypeList($data);
//            echo $this->db->last_query();
//            exit;
            $count = $result['count'];
            $data['totalCount'] = false;
            $segment = 5;
             
            $final_total_vehicles_exited = $final_total_amount = 0;
            
            foreach ($result as $value) {
                if(isset($value->total_vehicles_exited)){
                        $final_total_vehicles_exited = $final_total_vehicles_exited+$value->total_vehicles_exited;
                        $final_total_amount = $final_total_amount+$value->total_amount;

                }
            }
            
            $data['final_total_vehicles_exited'] = $final_total_vehicles_exited;
            $data['final_total_amount'] = $final_total_amount;
            
               
            $returns = $this->paginationCompress("admin/reports/shift/list", $count, 100, $segment);

            $data['page'] = $returns['page'];
            $data['offset'] = $returns['offset'];

            $data['records'] = $this->k_parking_model->getShiftSummaryByVehicleTypeList($data);
            
            $this->global['pageTitle'] = PROJECT_NAME . ' : Shift Report';
            $data['title'] = 'Shift Report';
            $data['sub_title'] = 'List';
            $this->global['assets'] = array('cssTopArray' => array(
                    base_url() . 'assets/plugins/datepicker/datepicker3',
                    base_url() . 'assets/plugins/timepicker/bootstrap-timepicker',
                    base_url() . 'assets/plugins/daterangepicker/daterangepicker-bs3',
                ),
                'cssBottomArray' => array(),
                'jsTopArray' => array(),
                'jsBottomArray' => array(
                    base_url() . 'assets/plugins/datepicker/bootstrap-datepicker',
                    base_url() . 'assets/plugins/daterangepicker/moment',
                    base_url() . 'assets/plugins/daterangepicker/daterangepicker',
                    base_url() . 'assets/plugins/timepicker/bootstrap-timepicker'
                )
            );
            
            $data['shiftListArray'] = $this->k_master_user_shift_model->getShiftList();
            
            $this->loadViews("admin/reports/shift_report", $this->global, $data, NULL);
        }
    }
    
    
    function tariffSummaryList() {

        if(!array_key_exists(14,$this->role_privileges)){
            $this->loadThis();
        } else {
            
            $from_date = $this->input->get("from_date");
            $to_date = $this->input->get("to_date");
            $from_time = $this->input->get("from_time");
            $to_time = $this->input->get("to_time");
            $vehicle_type_id = $this->input->get("vehicle_type_id");
            $gate_id = $this->input->get("gate_id");
            $pdf = $this->input->get("pdf");
            
            $download = $this->input->get("download");
            $data['from_date'] = $from_date;
            $data['to_date'] = $to_date;
            $data['from_time'] = $from_time;
            $data['to_time'] = $to_time;
            $data['vehicle_type_id'] = $vehicle_type_id;
            $data['gate_id'] = $gate_id;
            
            $data['totalCount'] = false;
            $data['download'] = $download;
            
            if($download == true){
               $tariffSummaryArray = $this->k_parking_model->getTariffSummaryList($data);   
                $spreadsheet = new Spreadsheet();
                $sheet = $spreadsheet->getActiveSheet();
                
                $vehicle_type_name = "All Vehicles";
                if(isset($vehicle_type_id) && !empty($vehicle_type_id)){
                    $vehicle_type_details = $this->k_master_vehicle_type_model->getDetails($vehicle_type_id);
                    $vehicle_type_name = $vehicle_type_details->name; 
                }    
                
                $gate_name = "All Vehicles";
                if(isset($gate_id) && !empty($gate_id)){
                    $gate_details = $this->k_master_vehicle_gate_model->getDetails($gate_id);
                    $gate_name = $gate_details->name; 
                }    
                
                $sheet->setCellValue('B1', 'Vehicle Type :'.$vehicle_type_name );
                $sheet->setCellValue('C1', 'Gate :'.$gate_name );
                $sheet->setCellValue('D1', 'From Date :'.$from_date );
                $sheet->setCellValue('E1', 'From Time :'.$from_time );
                $sheet->setCellValue('F1', 'To Date :'.$to_date );
                $sheet->setCellValue('G1', 'To Time :'.$to_time );
                
                $sheet->setCellValue('A3', 'Parking Amount');
                $sheet->setCellValue('B3', 'Vehicles Exited');
                $sheet->setCellValue('C3', 'Total Amount');
                $count = 4;  
                
                $final_total_vehicles_exited = $final_total_amount = 0;
                
               foreach ($tariffSummaryArray as $value) {
                    $sheet->setCellValue('A' . $count, $value->amount);
                    $sheet->setCellValue('B' . $count, $value->total_vehicles_exited);
                    $final_total_vehicles_exited = $final_total_vehicles_exited+$value->total_vehicles_exited;
                    $sheet->setCellValue('C' . $count, $value->total_amount);
                    $final_total_amount = $final_total_amount+$value->total_amount;
                    $count++;
               }
             
              $count = $count+1;
              $sheet->setCellValue('A' . $count, 'Total');
              $sheet->setCellValue('B' . $count, $final_total_vehicles_exited);
              $sheet->setCellValue('C' . $count, $final_total_amount);
               
           
  $downloaded_name = "summary_tariff_excel_report";
                    if($pdf == true){
                        header("Content-type:application/pdf");
                        header("Content-Disposition:attachment;filename=".$downloaded_name.".pdf");
                    }else{ 
                        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                        header("Content-Disposition: attachment;filename=".$downloaded_name.".xls");
                    }
                    
                    header('Cache-Control: max-age=0');
            // If you're serving to IE 9, then the following may be needed
                    header('Cache-Control: max-age=1');

            // If you're serving to IE over SSL, then the following may be needed
                    header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
                    header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
                    header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
                    header('Pragma: public'); // HTTP/1.0
                    if($pdf == true){
                        $writer = new Tcpdf($spreadsheet);
                        $writer->save('php://output');
                    }else{
                        $writer = new Xls($spreadsheet);
                        $writer->save('php://output');
                    }
                    exit;
                
                
            }
         
            $data['totalCount'] = true;

            $this->load->model('k_parking_model');
            $result = $this->k_parking_model->getTariffSummaryList($data);
//            echo $this->db->last_query();
//            exit;
            $count = $result['count'];
            $data['totalCount'] = false;
            $segment = 5;
             
            $final_total_vehicles_exited = $final_total_amount = 0;
            
            foreach ($result as $value) {
                if(isset($value->total_vehicles_exited)){
                        $final_total_vehicles_exited = $final_total_vehicles_exited+$value->total_vehicles_exited;
                        $final_total_amount = $final_total_amount+$value->total_amount;

                }
            }
            
            $data['final_total_vehicles_exited'] = $final_total_vehicles_exited;
            $data['final_total_amount'] = $final_total_amount;
            
               
            $returns = $this->paginationCompress("admin/reports/tariffsummary/list", $count, 100, $segment);

            $data['page'] = $returns['page'];
            $data['offset'] = $returns['offset'];

            $data['records'] = $this->k_parking_model->getTariffSummaryList($data);

            $this->global['pageTitle'] = PROJECT_NAME . ' : Summary Report - Tariff';
            $data['title'] = 'Summary Report - Tariff';
            $data['sub_title'] = 'List';
            $this->global['assets'] = array('cssTopArray' => array(
                    base_url() . 'assets/plugins/datepicker/datepicker3',
                    base_url() . 'assets/plugins/timepicker/bootstrap-timepicker',
                    base_url() . 'assets/plugins/daterangepicker/daterangepicker-bs3',
                ),
                'cssBottomArray' => array(),
                'jsTopArray' => array(),
                'jsBottomArray' => array(
                    base_url() . 'assets/plugins/datepicker/bootstrap-datepicker',
                    base_url() . 'assets/plugins/daterangepicker/moment',
                    base_url() . 'assets/plugins/daterangepicker/daterangepicker',
                    base_url() . 'assets/plugins/timepicker/bootstrap-timepicker'
                )
            );
            
//            echo $this->db->last_query();
//            exit;
//            echo "<pre>";
//            var_dump($data['records']);
//            exit;
            $data['vehicleTypeListArray'] = $this->k_master_vehicle_type_model->get();
            $data['gateListArray'] = $this->k_master_vehicle_gate_model->get();
            $this->loadViews("admin/reports/tariff_summary_report", $this->global, $data, NULL);
        }
    }
    
    function supervisorSummaryList() {

        if(!array_key_exists(27,$this->role_privileges)){
            $this->loadThis();
        } else {
            
            $from_date = $this->input->get("from_date");
            $to_date = $this->input->get("to_date");
            $from_time = $this->input->get("from_time");
            $to_time = $this->input->get("to_time");
            $vehicle_type_id = $this->input->get("vehicle_type_id");
            $gate_id = $this->input->get("gate_id");
            $pdf = $this->input->get("pdf");
            
            $download = $this->input->get("download");
            $data['from_date'] = $from_date;
            $data['to_date'] = $to_date;
            $data['from_time'] = $from_time;
            $data['to_time'] = $to_time;
            $data['vehicle_type_id'] = $vehicle_type_id;
            $data['gate_id'] = $gate_id;
            
            $data['totalCount'] = false;
            $data['download'] = $download;
            
            if($download == true){
               $tariffSummaryArray = $this->k_parking_model->getSupervisorSummaryList($data);   
                $spreadsheet = new Spreadsheet();
                $sheet = $spreadsheet->getActiveSheet();
                
                $vehicle_type_name = "All Vehicles";
                if(isset($vehicle_type_id) && !empty($vehicle_type_id)){
                    $vehicle_type_details = $this->k_master_vehicle_type_model->getDetails($vehicle_type_id);
                    $vehicle_type_name = $vehicle_type_details->name; 
                }    
                
                $gate_name = "All Vehicles";
                if(isset($gate_id) && !empty($gate_id)){
                    $gate_details = $this->k_master_vehicle_gate_model->getDetails($gate_id);
                    $gate_name = $gate_details->name; 
                }    
                
                $sheet->setCellValue('B1', 'Vehicle Type :'.$vehicle_type_name );
                $sheet->setCellValue('C1', 'Gate :'.$gate_name );
                $sheet->setCellValue('D1', 'From Date :'.$from_date );
                $sheet->setCellValue('E1', 'From Time :'.$from_time );
                $sheet->setCellValue('F1', 'To Date :'.$to_date );
                $sheet->setCellValue('G1', 'To Time :'.$to_time );
                
                $sheet->setCellValue('A3', 'Serial No');
                $sheet->setCellValue('B3', 'Ticket number');
                $sheet->setCellValue('C3', 'Parking Amount');
                $count = 4;  
                
                $final_total_vehicles_exited = $final_total_amount = 0;
                
               foreach ($tariffSummaryArray as $key => $value) {
                    $sheet->setCellValue('A' . $count, $key+1);
                    $sheet->setCellValue('B' . $count, $value->id);
                    $sheet->setCellValue('C' . $count, $value->total_amount);
                    $final_total_amount = $final_total_amount+$value->total_amount;
                    $count++;
               }
             
              $count = $count+1;
              $sheet->setCellValue('B' . $count, 'Total Amount Collected');
              $sheet->setCellValue('C' . $count, $final_total_amount);
               
           
                    $downloaded_name = "summary_supervisor_excel_report";
                    if($pdf == true){
                        header("Content-type:application/pdf");
                        header("Content-Disposition:attachment;filename=".$downloaded_name.".pdf");
                    }else{ 
                        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                        header("Content-Disposition: attachment;filename=".$downloaded_name.".xls");
                    }
                    
                    header('Cache-Control: max-age=0');
            // If you're serving to IE 9, then the following may be needed
                    header('Cache-Control: max-age=1');

            // If you're serving to IE over SSL, then the following may be needed
                    header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
                    header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
                    header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
                    header('Pragma: public'); // HTTP/1.0
                    if($pdf == true){
                        $writer = new Tcpdf($spreadsheet);
                    }else{
                        $writer = new Xls($spreadsheet);
                    }
                    $writer->save('php://output');
                    exit;
                
            }
         
            $data['totalCount'] = true;

            $this->load->model('k_parking_model');
            $result = $this->k_parking_model->getSupervisorSummaryList($data);
            $count = $result['count'];
            $data['totalCount'] = false;
            $segment = 5;
             
            $final_total_vehicles_exited = $final_total_amount = 0;
            
            foreach ($result as $value) {
                if(isset($value->total_amount)){
                        $final_total_amount = $final_total_amount+$value->total_amount;

                }
            }
            
            $data['final_total_vehicles_exited'] = $final_total_vehicles_exited;
            $data['final_total_amount'] = $final_total_amount;
            
               
            $returns = $this->paginationCompress("admin/reports/supervisorsummary/list", $count, 100, $segment);

            $data['page'] = $returns['page'];
            $data['offset'] = $returns['offset'];

            $data['records'] = $this->k_parking_model->getSupervisorSummaryList($data);

            $this->global['pageTitle'] = PROJECT_NAME . ' : Summary Report for Supervisor';
            $data['title'] = 'Summary Report for Supervisor';
            $data['sub_title'] = 'List';
            $this->global['assets'] = array('cssTopArray' => array(
                    base_url() . 'assets/plugins/datepicker/datepicker3',
                    base_url() . 'assets/plugins/timepicker/bootstrap-timepicker',
                    base_url() . 'assets/plugins/daterangepicker/daterangepicker-bs3',
                ),
                'cssBottomArray' => array(),
                'jsTopArray' => array(),
                'jsBottomArray' => array(
                    base_url() . 'assets/plugins/datepicker/bootstrap-datepicker',
                    base_url() . 'assets/plugins/daterangepicker/moment',
                    base_url() . 'assets/plugins/daterangepicker/daterangepicker',
                    base_url() . 'assets/plugins/timepicker/bootstrap-timepicker'
                )
            );

            $data['vehicleTypeListArray'] = $this->k_master_vehicle_type_model->get();
            $data['gateListArray'] = $this->k_master_vehicle_gate_model->get();
            $this->loadViews("admin/reports/summary_supervisor_report", $this->global, $data, NULL);
        }
    }
    
    
    function timebasedList() {

        if(!array_key_exists(13,$this->role_privileges)){
            $this->loadThis();
        } else {
            
            $from_date = $this->input->get("from_date");
            $to_date = $this->input->get("to_date");
            $from_time = $this->input->get("from_time");
            $to_time = $this->input->get("to_time");
            $pdf = $this->input->get("pdf");
            
            $data['from_date'] = $from_date;
            $data['to_date'] = $to_date;
            $data['from_time'] = $from_time;
            $data['to_time'] = $to_time;
            
            
            $download = $this->input->get("download");
            $data['totalCount'] = false;
            $data['download'] = $download;
              
                 $exitListSummaryByVehicleType = $this->k_parking_model->getExitListSummaryByDateTime($data);   
            if($download == true){
               
                $resultExitList = $this->k_parking_model->getExitlistByDateTime($data);
                $spreadsheet = new Spreadsheet();
                $sheet = $spreadsheet->getActiveSheet();
                $vehicle_type_name = "All Vehicles";
                            if(isset($vehicle_type_id) && !empty($vehicle_type_id)){
                                $vehicle_type_details = $this->k_master_vehicle_type_model->getDetails($vehicle_type_id);
                                $vehicle_type_name = $vehicle_type_details->name; 
                            }    
                    $sheet->setCellValue('D1', 'From Date :'.$from_date );
                    $sheet->setCellValue('E1', 'From Time :'.$from_time );
                    $sheet->setCellValue('F1', 'To Date :'.$to_date );
                    $sheet->setCellValue('G1', 'To Time :'.$to_time );
                    $sheet->setCellValue('D1', 'Report Date :'.date('Y-m-d H:i:s'));
                   
                   
                   
                   
                   $sheet->setCellValue('A3', 'Ticket No.');
                   $sheet->setCellValue('B3', 'Entry Date & Time');
                   $sheet->setCellValue('C3', 'Vehicle No.');
                   $sheet->setCellValue('D3', 'Vehicle Type');
                   $sheet->setCellValue('E3', 'Exit Time');
                   $sheet->setCellValue('F3', 'Parked Hours');
                   $sheet->setCellValue('G3', 'Parked Amount');
                   $sheet->setCellValue('H3', 'Company Name');
                   $sheet->setCellValue('I3', 'Gate No');
                     $count = 4;  
               foreach ($resultExitList as $value) {
                   $sheet->setCellValue('A' . $count, $value->ticket_no);
                   $sheet->setCellValue('B' . $count, $value->entry_time);
                   $sheet->setCellValue('C' . $count, $value->vehicle_number);
                   $sheet->setCellValue('D' . $count, $value->vehicle_type_name);
                   $sheet->setCellValue('E' . $count, $value->exit_time);
                   $sheet->setCellValue('F' . $count, $value->parked_hours);
                   $sheet->setCellValue('G' . $count, $value->total_amount);
                   $sheet->setCellValue('H' . $count, $value->vehicle_company);
                   $sheet->setCellValue('I' . $count, $value->gate_entry_name);
                   $count++;
               }
             
               $count = $count+2;
               $sheet->setCellValue('F' . $count, "Vehicle Type");
               $sheet->setCellValue('G' . $count, "No. of Vehicles");
               $sheet->setCellValue('H' . $count, "Amount");
               
               
               $count++;
               $totalVehiclesCount = 0;
               $totalAmount = 0;
               foreach ($exitListSummaryByVehicleType as $value) {
                   $sheet->setCellValue('F' . $count, $value->vehicle_type_name);
                   $sheet->setCellValue('G' . $count, $value->type_count);
                   $sheet->setCellValue('H' . $count, $value->amount);
                   $totalVehiclesCount = $totalVehiclesCount+$value->type_count;
                   $totalAmount = $totalAmount+$value->amount;
                   $count++;
               }
               
               $sheet->setCellValue('E' . $count, "Total");
               
               $sheet->setCellValue('G' . $count, $totalVehiclesCount);
               $sheet->setCellValue('H' . $count, $totalAmount);
               
                   
//             for ($index = 0; $index < 100; $index++) {
//                        $sheet->setCellValue('A' . $index, 'Hi Anil' . $index);
//                    }
  $downloaded_name = "time_based_report";
                    if($pdf == true){
                        header("Content-type:application/pdf");
                        header("Content-Disposition:attachment;filename=".$downloaded_name.".pdf");
                    }else{ 
                        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                        header("Content-Disposition: attachment;filename=".$downloaded_name.".xls");
                    }
                    
                    header('Cache-Control: max-age=0');
            // If you're serving to IE 9, then the following may be needed
                    header('Cache-Control: max-age=1');

            // If you're serving to IE over SSL, then the following may be needed
                    header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
                    header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
                    header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
                    header('Pragma: public'); // HTTP/1.0
                    if($pdf == true){
                        $writer = new Tcpdf($spreadsheet);
                    }else{
                        $writer = new Xls($spreadsheet);
                    }
                    
                    $writer->save('php://output');
                    exit;
                
                
            }
         
              $data['exitListSummaryByVehicleType'] = $exitListSummaryByVehicleType;
            
//            if (isset($postEntryDate) && empty($postEntryDate)) {
//                $entryDate = '';
//                $this->session->set_userdata('entryDate', $entryDate);
//            } else if ($postEntryDate) {
//                // use the term from POST and set it to session
//                $entryDate = $postEntryDate;
//                $this->session->set_userdata('entryDate', $entryDate);
//            } else if ($this->session->userdata('entryDate')) {
//                // if term is not in POST use existing term from session
//                $entryDate = $this->session->userdata('entryDate');
//            }

            

            $data['totalCount'] = true;

            $this->load->model('k_parking_model');
            $result = $this->k_parking_model->getExitlistByDateTime($data);
           
            $count = $result['count'];
            $data['totalCount'] = false;
            $segment = 5;

            $returns = $this->paginationCompress("admin/reports/timebased/list", $count, 100, $segment);

            $data['page'] = $returns['page'];
            $data['offset'] = $returns['offset'];

            $data['records'] = $this->k_parking_model->getExitlistByDateTime($data);
//             echo $this->db->last_query();
//            exit;
            $this->global['pageTitle'] = PROJECT_NAME . ' : Time Based Report';
            $data['title'] = 'Time Based Report';
            $data['sub_title'] = 'List';
            $this->global['assets'] = array('cssTopArray' => array(
                    base_url() . 'assets/plugins/datepicker/datepicker3',
                    base_url() . 'assets/plugins/timepicker/bootstrap-timepicker',
                    base_url() . 'assets/plugins/daterangepicker/daterangepicker-bs3',
                ),
                'cssBottomArray' => array(),
                'jsTopArray' => array(),
                'jsBottomArray' => array(
                    base_url() . 'assets/plugins/datepicker/bootstrap-datepicker',
                    base_url() . 'assets/plugins/daterangepicker/moment',
                    base_url() . 'assets/plugins/daterangepicker/daterangepicker',
                    base_url() . 'assets/plugins/timepicker/bootstrap-timepicker'
                )
            );
            
            $data['vehicleTypeListArray'] = $this->k_master_vehicle_type_model->get();

            $this->loadViews("admin/reports/timebased_report", $this->global, $data, NULL);
        }
    }
    
    function companywiseList() {
        
        if(!array_key_exists(20,$this->role_privileges)){
            $this->loadThis();
        } else {
            
            $date = $this->input->get("date");
            $report_type = $this->input->get("report_type");
            $vehicle_company = $this->input->get("vehicle_company");
            $download = $this->input->get("download");
            $pdf = $this->input->get("pdf");
            
            $data['date'] = $date;
            $data['report_type'] = $report_type;
            $data['vehicle_company'] = $vehicle_company;
            $data['totalCount'] = false;
            $data['download'] = $download;
              
            $exitListSummaryByVehicleType = $this->k_parking_model->getExitListSummaryByVehicleCompany($data);   
            if($download == true){
               
                $resultExitList = $this->k_parking_model->getExitListByVehicleCompany($data);
                $spreadsheet = new Spreadsheet();
                $sheet = $spreadsheet->getActiveSheet();
                    if(empty($vehicle_company)){
                        $vehicle_company = "All Vehicles";
                    }    
                    $report_type_name = '';
                    $report_type_array = json_decode(REPORT_TYPE_ARRAY,true);
                    if(isset($report_type) && !empty($report_type))
                        $report_type_name = $report_type_array[$report_type];
                    
                    $sheet->setCellValue('A1', 'Vehicle Company :'.$vehicle_company );
                    $sheet->setCellValue('B1', 'Report Type :'.$report_type_name );
                    $sheet->setCellValue('C1', 'Date :'.$date );
                    $sheet->setCellValue('D1', 'Report Date :'.date('Y-m-d H:i:s'));
                   
                   
                   
                   
                   $sheet->setCellValue('A3', 'Ticket No.');
                   $sheet->setCellValue('B3', 'Entry Date & Time');
                   $sheet->setCellValue('C3', 'Vehicle No.');
                   $sheet->setCellValue('D3', 'Vehicle Type');
                   $sheet->setCellValue('E3', 'Exit Time');
                   $sheet->setCellValue('F3', 'Parked Hours');
                   $sheet->setCellValue('G3', 'Parked Amount');
                   $sheet->setCellValue('H3', 'Company Name');
                   $sheet->setCellValue('I3', 'Gate No');
                     $count = 4;  
               foreach ($resultExitList as $value) {
                   $sheet->setCellValue('A' . $count, $value->ticket_no);
                   $sheet->setCellValue('B' . $count, $value->entry_time);
                   $sheet->setCellValue('C' . $count, $value->vehicle_number);
                   $sheet->setCellValue('D' . $count, $value->vehicle_type_name);
                   $sheet->setCellValue('E' . $count, $value->exit_time);
                   $sheet->setCellValue('F' . $count, $value->parked_hours);
                   $sheet->setCellValue('G' . $count, $value->total_amount);
                   $sheet->setCellValue('H' . $count, $value->vehicle_company);
                   $sheet->setCellValue('I' . $count, $value->gate_entry_name);
                   $count++;
               }
             
               $count = $count+2;
               $sheet->setCellValue('F' . $count, "Vehicle Type");
               $sheet->setCellValue('G' . $count, "No. of Vehicles");
               $sheet->setCellValue('H' . $count, "Amount");
               
               
               $count++;
               $totalVehiclesCount = 0;
               $totalAmount = 0;
               foreach ($exitListSummaryByVehicleType as $value) {
                   $sheet->setCellValue('F' . $count, $value->vehicle_type_name);
                   $sheet->setCellValue('G' . $count, $value->type_count);
                   $sheet->setCellValue('H' . $count, $value->amount);
                   $totalVehiclesCount = $totalVehiclesCount+$value->type_count;
                   $totalAmount = $totalAmount+$value->amount;
                   $count++;
               }
               
               $sheet->setCellValue('E' . $count, "Total");
               
               $sheet->setCellValue('G' . $count, $totalVehiclesCount);
               $sheet->setCellValue('H' . $count, $totalAmount);
               
                   
//             for ($index = 0; $index < 100; $index++) {
//                        $sheet->setCellValue('A' . $index, 'Hi Anil' . $index);
//                    }
                      $downloaded_name = "companywise_report";
                    if($pdf == true){
                        header("Content-type:application/pdf");
                        header("Content-Disposition:attachment;filename=".$downloaded_name.".pdf");
                    }else{ 
                        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                        header("Content-Disposition: attachment;filename=".$downloaded_name.".xls");
                    }
                    
                    header('Cache-Control: max-age=0');
            // If you're serving to IE 9, then the following may be needed
                    header('Cache-Control: max-age=1');

            // If you're serving to IE over SSL, then the following may be needed
                    header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
                    header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
                    header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
                    header('Pragma: public'); // HTTP/1.0
                    if($pdf == true){
                        $writer = new Tcpdf($spreadsheet);
                    }else{
                        $writer = new Xls($spreadsheet);
                    }    
                    $writer->save('php://output');
                    exit;
                
                
            }
         
              $data['exitListSummaryByVehicleType'] = $exitListSummaryByVehicleType;
            
//            if (isset($postEntryDate) && empty($postEntryDate)) {
//                $entryDate = '';
//                $this->session->set_userdata('entryDate', $entryDate);
//            } else if ($postEntryDate) {
//                // use the term from POST and set it to session
//                $entryDate = $postEntryDate;
//                $this->session->set_userdata('entryDate', $entryDate);
//            } else if ($this->session->userdata('entryDate')) {
//                // if term is not in POST use existing term from session
//                $entryDate = $this->session->userdata('entryDate');
//            }

            

            $data['totalCount'] = true;

            $this->load->model('k_parking_model');
            $result = $this->k_parking_model->getExitListByVehicleCompany($data);
           
            $count = $result['count'];
            $data['totalCount'] = false;
            $segment = 5;

            $returns = $this->paginationCompress("admin/reports/companywise/list", $count, 100, $segment);

            $data['page'] = $returns['page'];
            $data['offset'] = $returns['offset'];

            $data['records'] = $this->k_parking_model->getExitListByVehicleCompany($data);
//             echo $this->db->last_query();
//            exit;
            $this->global['pageTitle'] = PROJECT_NAME . ' : Company wise report';
            $data['title'] = 'Company wise report';
            $data['sub_title'] = 'List';
            $this->global['assets'] = array('cssTopArray' => array(
                    base_url() . 'assets/plugins/datepicker/datepicker3',
                    base_url() . 'assets/plugins/timepicker/bootstrap-timepicker',
                    base_url() . 'assets/plugins/daterangepicker/daterangepicker-bs3',
                ),
                'cssBottomArray' => array(),
                'jsTopArray' => array(),
                'jsBottomArray' => array(
                    base_url() . 'assets/plugins/datepicker/bootstrap-datepicker',
                    base_url() . 'assets/plugins/daterangepicker/moment',
                    base_url() . 'assets/plugins/daterangepicker/daterangepicker',
                    base_url() . 'assets/plugins/timepicker/bootstrap-timepicker'
                )
            );
            
            $data['vehicleCompanyListArray'] = $this->k_parking_model->getExitedVehicleCompanyList();
            $this->loadViews("admin/reports/companywise_report", $this->global, $data, NULL);
        }
    }
    

    function pageNotFound() {
        $this->global['pageTitle'] = 'Pms : 404 - Page Not Found';

        $this->loadViews("404", $this->global, NULL, NULL);
    }

}