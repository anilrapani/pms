<?php
require APPPATH . '/libraries/BaseController.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
// http://localhost/excel/vendor/phpoffice/phpspreadsheet

// https://phpspreadsheet.readthedocs.io/en/develop/
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
// http://localhost/excel/vendor/phpoffice/phpspreadsheet

// https://phpspreadsheet.readthedocs.io/en/develop/
//require_once __DIR__ . '/Bootstrap.php';
//// __DIR__
// $excel = new \SimpleExcel\SimpleExcel('xml'); 
// $excel = new \third_party\SimpleExcel('xml'); 
// use PhpOffice\PhpSpreadsheet\Spreadsheet;


/* 
 * Copyright (C) 2017 Kastech
 * @project : touba316
 * @author : Anil Rapani
 * @email : arapani@kastechindia.com
 * @since : Dec 2, 2017
 * @version : 
 */

class Excel extends BaseController
{
    
//
    function download(){

//
        // new \SimpleExcel\SimpleExcel('xml')
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
for ($index = 0; $index < 100000; $index++) {
$sheet->setCellValue('A'.$index, 'Hello World8 !'.$index);    
}

//


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
}
