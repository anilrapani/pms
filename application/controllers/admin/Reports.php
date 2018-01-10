<?php
require APPPATH . '/libraries/BaseController.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;

use PhpOffice\PhpSpreadsheet\Writer\Xls;
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
        $this->load->model(array('k_parking_model','k_master_vehicle_type_model'));
        $this->isLoggedIn();
    }
       
     
    /**
     * This function is used to load the company list
     */
    function entryList() {

        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $data['entryDate'] = '';
            // $entryDate = '';
            $entryDate = $this->input->get("entryDate");
            // $download = false;
            $download = $this->input->get("download");
            $vehicle_type_id = $this->input->get("vehicle_type_id");
             $data['totalCount'] = false;
            $data['entryDate'] = $entryDate;
            $data['download'] = $download;
            $data['vehicle_type_id'] = $vehicle_type_id;
              
                 $entryListByVehicleType = $this->k_parking_model->getEntrylistByVehicleType($data);   
            if($download == true){
               
                $resultEntryList = $this->k_parking_model->getEntrylist($data);
          
//                echo "<pre>";
//                var_dump($resultEntryList);
//                exit;
                
               //  $this->entryListDownload();
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
               foreach ($entryListByVehicleType as $value) {
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

                    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                    header('Content-Disposition: attachment;filename="anil.xls"');
                    header('Cache-Control: max-age=0');
            // If you're serving to IE 9, then the following may be needed
                    header('Cache-Control: max-age=1');

            // If you're serving to IE over SSL, then the following may be needed
                    header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
                    header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
                    header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
                    header('Pragma: public'); // HTTP/1.0

                    $writer = new Xls($spreadsheet);

                    $writer->save('php://output');
                
                
                
                
            }
         
              $data['entryListByVehicleType'] = $entryListByVehicleType;
            
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
            $data['title'] = 'Parking Entry List';
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

    function entryListDownload() {

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        for ($index = 0; $index < 100; $index++) {
            $sheet->setCellValue('A' . $index, 'Hi Anil!' . $index);
        }

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="subscribers_sheet.xlsx"');
        header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $writer = new Xlsx($spreadsheet);

        $writer->save('php://output');
// $writer->save('anil4.xlsx'); // for cron current location and sending to email
    }

    function pageNotFound() {
        $this->global['pageTitle'] = 'Pms : 404 - Page Not Found';

        $this->loadViews("404", $this->global, NULL, NULL);
    }

}