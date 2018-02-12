<?php
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Writer\Pdf\Tcpdf;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

Class Crons extends CI_Controller{
    
    public function __construct() {
        parent::__construct();
        // $this->load->model(array('k_parking_model','k_master_vehicle_type_model','k_master_user_shift_model','k_master_vehicle_gate_model'));
        $this->load->model(array('k_parking_model','k_master_user_shift_model'));
        
    }
        
    function exitList() {
        
        
        $day_before = strtotime("yesterday", time());
        $yesterday = date('Y-m-d', $day_before);
        $downloaded_name = "daily_exit_report_".$yesterday;
            $download = true;
            $pdf = true;
            $data['totalCount'] = false;
            $data['exitDate'] = $yesterday;
            $data['download'] = $download;
              
            $exitListSummaryByVehicleType = $this->k_parking_model->getExitListSummary($data);   
//            echo $this->db->last_query();
//                exit;
//            var_dump($exitListSummaryByVehicleType);
//            exit;
            if($download == true){
               
                $resultExitList = $this->k_parking_model->getExitlist($data);
                
                $spreadsheet = new Spreadsheet();
                $sheet = $spreadsheet->getActiveSheet();
                
                $cell_width = 20;
                if($pdf == true){
                    $cell_width=$cell_width+5;
                }
                $sheet->getColumnDimension('B')->setWidth($cell_width);
                
                $sheet->getColumnDimension('C')->setWidth(30);
                $sheet->getColumnDimension('D')->setWidth($cell_width);
                $sheet->getColumnDimension('E')->setWidth($cell_width);
                $sheet->getColumnDimension('F')->setWidth(15);
                $sheet->getColumnDimension('G')->setWidth(20);
                $sheet->getColumnDimension('H')->setWidth($cell_width+10);
                $sheet->getColumnDimension('I')->setWidth($cell_width);
                $vehicle_type_name = "All Vehicles";
                            if(isset($vehicle_type_id) && !empty($vehicle_type_id)){
                                $vehicle_type_details = $this->k_master_vehicle_type_model->getDetails($vehicle_type_id);
                                $vehicle_type_name = $vehicle_type_details->name; 
                            }    
                   $sheet->setCellValue('B1', 'Vehicle Type :'.$vehicle_type_name );
                   $sheet->setCellValue('C1', 'Date :'.$yesterday);  
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
                          if(!empty(trim($value->vehicle_number))){
                        $sheet->setCellValue('C' . $count, $value->vehicle_number);
                   }else if(empty($value->vehicle_number)){
                         $fpath = FCPATH;
                        $fpath =  str_replace('\\', '/', $fpath);
                       if(!empty(trim($value->image_vehicle_number_plate)) && file_exists($fpath.'assets/images/upload/numberplate/240/'.$value->image_vehicle_number_plate)){
                        $drawing = new Drawing();
                        $drawing->setName('Logo');
                        $drawing->setDescription('Logo');
                      
                        $final_path = $fpath."assets/images/upload/numberplate/240/$value->image_vehicle_number_plate";
                        
                            
                        try {
                            $drawing->setPath($final_path);
                            $drawing->setWidth(200);
                            $sheet->getRowDimension($count)->setRowHeight(140);
                            $drawing->setOffsetY(300);
                            $drawing->getShadow()->setDirection(45);
                            $drawing->setCoordinates('C' . $count);
                            $drawing->getShadow()->setVisible(true);
                            $drawing->setWorksheet($sheet);
                        } catch (Exception $exc) {
                            $sheet->setCellValue('C' . $count, '');
                        }

                        
                       }else{
                           $sheet->setCellValue('C' . $count, '');
                       }
                        
                   }

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
                    
//                    if($pdf == true){
//                        header("Content-type:application/pdf");
//                        header("Content-Disposition:attachment;filename=".$downloaded_name.".pdf");
//                    }else{ 
//                        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
//                        header("Content-Disposition: attachment;filename=".$downloaded_name.".xls");
//                    }
//                    header('Cache-Control: max-age=0');
//            // If you're serving to IE 9, then the following may be needed
//                    header('Cache-Control: max-age=1');
//
//            // If you're serving to IE over SSL, then the following may be needed
//                    header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
//                    header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
//                    header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
//                    header('Pragma: public'); // HTTP/1.0
                    if($pdf == true){
                        $sheet->getPageSetup()->setPaperSize(PageSetup::PAPERSIZE_A2_PAPER);
                        $writer = new Tcpdf($spreadsheet);
                    }else{
                        $writer = new Xls($spreadsheet);
                    }
                    
                    $writer->save(fc_path_forward()."attachments/cron/daily_exit/".$downloaded_name.".pdf");
                    exit;
//                    }else{
//                        echo 't2';
//                        exit;
//                    }
                
                
            }
         
              
        }
        
        

       function exitListEmail(){
        // $to=array('anil.rapani@gmail.com','test.webap@gmail.com'); 
                       $to='anil.rapani@gmail.com'; 
        // $to = 'test.webap@gmail.com';
                       $subject='Daily Exit Report';
                       $message='All vehicles report and full collection at bottom of excel sheet';
                       
                       $day_before = strtotime("yesterday", time());
                       $yesterday = date('Y-m-d', $day_before);
                       $downloaded_name = "daily_exit_report_".$yesterday;
                       $attachment = fc_path_forward()."attachments/cron/daily_exit/$downloaded_name.pdf";
                       $this->send_email($to,$subject,$message,$attachment); 
       
       }
       
       
       
       function monthlyList() {
        
        
            $pdf = true;
            $data['download'] = true;
            $year = $data['year'] = date('Y');
            $month = $previous_month = date("m", strtotime("first day of previous month"));
            $current_month = date("m");
            $data['month'] = $previous_month;
            
            $previous_month_full = date("M", strtotime("first day of previous month"));
            $year_month = date('Y').'_'.$previous_month_full;
            $downloaded_file_name = "monthly_report_".$year_month;
            $download = true;
                     $data['totalCount'] = false;
            if($download == true){
               $monthlySummaryByVehicleType = $this->k_parking_model->getMonthlySummaryByVehicleTypeList($data);   
                $spreadsheet = new Spreadsheet();
                $sheet = $spreadsheet->getActiveSheet();
                
                $cell_width = 25;
                $sheet->getColumnDimension('A')->setWidth($cell_width);
                $sheet->getColumnDimension('B')->setWidth($cell_width);
                $sheet->getColumnDimension('C')->setWidth($cell_width);
                $sheet->getColumnDimension('D')->setWidth($cell_width);
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
               
           
                    if($pdf == true){
                        $writer = new Tcpdf($spreadsheet);
                    }else{
                        $writer = new Xls($spreadsheet);
                    }
                    $writer->save(fc_path_forward()."attachments/cron/monthly/".$downloaded_file_name.".pdf");
                    exit;
                
                
            }
         
        
    }
    
      function monthlyListEmail(){
        // $to=array('anil.rapani@gmail.com','test.webap@gmail.com'); 
                       $to='anil.rapani@gmail.com'; 
        // $to = 'test.webap@gmail.com';
                       
                       $subject='Monthly Report';
                       $message='All vehicles report and full collection at bottom of excel sheet';
                       
                     
                        $previous_month_full = date("M", strtotime("first day of previous month"));
                        $year_month = date('Y').'_'.$previous_month_full;
                        $downloaded_file_name = "monthly_report_".$year_month;
            
                       $attachment = fc_path_forward()."attachments/cron/monthly/$downloaded_file_name.pdf";
                       $this->send_email($to,$subject,$message,$attachment); 
       
       }
    
    function shiftList() {
            $data['totalCount'] = false;
            $data['download'] = true;
            
            $pdf = $download = true;
            if($download == true){
                
                $shifts = $this->k_master_user_shift_model->get();
            foreach ($shifts as $key => $shift_details) {
                $start_time =  $data['start_time'] = $shift_details->start_time;
                $end_time = $data['end_time'] = $shift_details->end_time;
                $exit_date = $data['exitDate'] = date('Y-m-d',strtotime("-1 days"));
                $data['two_days'] = false;
                if($start_time == '21:00:00'){
                    $data['two_days'] = true;
                    $exit_date = $data['exitDate'] = date('Y-m-d');
                }
                
                $shift_id = $data['shift_id'] = $shift_details->id;
                $start_time = str_replace(":", '-', $start_time).'_';
                $end_time = str_replace(":", '-', $end_time);
                $attachment = fc_path_forward()."attachments/cron/shift/shift_report_$exit_date".$shift_details->name."_$start_time$end_time.pdf";
                
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
                
                $cell_width = 20;
                if($pdf == true){
                    $cell_width=$cell_width+5;
                }
                $sheet->getColumnDimension('A')->setWidth($cell_width);
                $sheet->getColumnDimension('B')->setWidth($cell_width);
                $sheet->getColumnDimension('C')->setWidth($cell_width);
                $sheet->getColumnDimension('D')->setWidth($cell_width);
            
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
               
         
                    if($pdf == true){
                        $writer = new Tcpdf($spreadsheet);
                    }else{
                        $writer = new Xls($spreadsheet);
                    }
                    $writer->save($attachment);
              }  
            }
         
           
        }
    
       function shiftListEmail(){
        // $to=array('anil.rapani@gmail.com','test.webap@gmail.com'); 
                       $to='anil.rapani@gmail.com'; 
        // $to = 'test.webap@gmail.com';
        foreach ($shifts as $key => $shift_details) {
                $start_time = $data['start_time'] = $shift_details->start_time;
                $end_time = $data['end_time'] = $shift_details->end_time;
                $exit_date = $data['exitDate'] = date('Y-m-d',strtotime("-1 days"));
                $data['shift_id'] = $shift_details->id;
                $attachment = fc_path_forward()."attachments/cron/shift/shift_report_".$shift_details->name."$exit_date.pdf";

                $subject='Shift Report';
                $message="Shift Report $shift_details->name.$exit_date.$start_time.$end_time";
                $this->send_email($to,$subject,$message,$attachment); 
           }
       }
       
       
       function send_email($to,$subject,$message,$attachment) {
        
        $this->load->library('email');
        $config = $this->config->item('emailConf1');
        $this->email->initialize($config);

        $this->email->set_mailtype("html");
        $this->email->set_newline("\r\n");
        $this->email->from('test.webap@gmail.com');
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($message);
        $this->email->attach($attachment);
        //Send email
        if ($this->email->send()) {
          //  var_dump($this->email->send());
            exit;
            return true;
        } else {
            echo 'not sent'; exit;
            
            return false;
        }
    }
    
    
    
    
    
        
}