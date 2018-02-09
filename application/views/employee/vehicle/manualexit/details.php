<style type="text/css">
    .printTicket{
        border: 1px solid black; 
    }
    .printTicketMain{
        padding-bottom: 10%;
    }
    canvas.drawing, canvas.drawingBuffer {
            position: absolute;
            left: 0;
            top: 0;
    }
    @media (max-width:320px)  { /* smartphones, iPhone, portrait 480x320 phones */ 

        .printTicket{
            width: 82%;
            margin-left: 15%;
        }
        .printTicket h4{
            font-size: 10px !important;
        }
        .printTicket h3{
            font-size: 12px !important;
        }

        h1, h2, h3, h4, h5, h6 {
            line-height: 3px;
        }
  

    }
    @media (min-width:320px)  { /* smartphones, iPhone, portrait 480x320 phones */ 
        .printTicket{
            width: 80%;
            margin-left: 15%;
        }
        .printTicket h4{
            font-size: 10px !important;

        }
        .printTicket h3{
            font-size: 12px !important;
        }
        h1, h2, h3, h4, h5, h6 {
            line-height: 3px;
        }
    

    }
    @media (min-width:481px)  { /* portrait e-readers (Nook/Kindle), smaller tablets @ 600 or @ 640 wide. */ 
        .printTicket{
            width: 60%;
        }
        .printTicket h4{
            font-size: 14px !important;
        }
        .printTicket h3{
            font-size: 12px !important;
        }
        h1, h2, h3, h4, h5, h6 {
            line-height: 6px;
        }
    }
    @media (min-width:641px)  { /* portrait tablets, portrait iPad, landscape e-readers, landscape 800x480 or 854x480 phones */ 
        .printTicket{
            width: 60%;
        }
        .printTicket h4{
            font-size: 14px !important;
        }
        .printTicket h3{
            font-size: 12px !important;
        }
        h1, h2, h3, h4, h5, h6 {
            line-height: 12px;
        }
    }
    @media (min-width:961px)  { /* tablet, landscape iPad, lo-res laptops ands desktops */ 
        .printTicket{
            width: 60%;
        }
        .printTicket h4{
            font-size: 16px !important;
        }
        .printTicket h3{
            font-size: 14px !important;
        }
        h1, h2, h3, h4, h5, h6 {
            line-height: 12px;
        }
    }
    @media (min-width:1025px) { /* big landscape tablets, laptops, and desktops */
        .printTicket{
            width: 82%;
        }
        .printTicket h4{
            font-size: 17px !important;
        }
        .printTicket h3{
            font-size: 15px !important;
        }
        h1, h2, h3, h4, h5, h6 {
            line-height: 12px;
        }
    }
    @media (min-width:1281px) { /* hi-res laptops and desktops */ 
        .printTicket{
            width: 70%;
        }
        .printTicket h4{
            font-size: 18px !important;
        }
        .printTicket h3{
            font-size: 16px !important;
        }
        h1, h2, h3, h4, h5, h6 {
            line-height: 12px;
        }
    }  
</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row">
        <div class="box-header col-md-3">
                  <h1 class="box-title"><i class="fa "><?php if (isset($barcode)) {
    echo  $title.' : ' . $barcode;
} else {
    echo $title.' : ';
} ?></i> </h1>
           
         
        </div>
               <div class="box-tools" style="padding-left: 10px;">
                <form action="<?php echo base_url() ?>employee/vehicle/manualexitdetails" method="POST" id="formBarcodeScanner">
                    <div class="input-group">
                        <input type="text" name="barcode" id="barcodeEntryId" autofocus class="form-control input-sm pull-left" style="width: 150px;" placeholder="Scan Barcode" value="" >
                        <div class="input-group-btn pull-left" id="triggerScanner">
                            <span class="btn btn-sm btn-default searchList"><i class="fa fa-barcode"></i></span>
                        </div>
                    </div>
                </form>
                   
            </div>
            </div>

        
        <div class="row">
        <div class="box-header col-md-3">
                  <h1 class="box-title"><i class="fa "><?php if (isset($entryDetails->id)) {
    echo  'Ticket Id : ' . $entryDetails->id;
} else {
    echo 'Ticket Id : ';
} ?></i> </h1>
           
        </div>
            
            <div class="box-tools" style="padding-left: 10px;">
                <form action="<?php echo base_url() ?>employee/vehicle/manualexitdetails" method="POST" id="formBarcodeScanner">
                    <div class="input-group">
                        <input type="text" name="entryId" id="entryId" class="form-control input-sm pull-left" style="width: 150px;" placeholder="Ticket Id" value="" >
                        <div class="input-group-btn pull-left">
                            <button class="btn btn-sm btn-default searchList"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>
            </div>
        

        <div class="row" id="scannerBlock" style="display:none">  
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-body">
                        <div style="position: relative; " id="scanner-container"></div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="clearfix"></div>
                <?php if ($onlysearchView == false) { ?>
        <section class="content">
            <div class="row">
                <div class="col-md-4">
                    <?php
                    $this->load->helper('form');
                    $error = $this->session->flashdata('error');
                    if ($error) {
                        ?>
                        <div class="alert alert-danger alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <?php echo $this->session->flashdata('error'); ?>                    
                        </div>
                    <?php } ?>
    <?php
    $success = $this->session->flashdata('success');
    if ($success) {
        ?>
                        <div class="alert alert-success alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <?php echo $this->session->flashdata('success'); ?>
                        </div>
                            <?php } ?>

                    <div class="row">
                        <div class="col-md-12">
    <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                        </div>
                    </div>
                </div>
            </div>

    <?php if ($isNewEntry == false) { ?>
                <div class="row">
                    <div class="col-md-6">
                        <!-- general form elements -->


        <?php if ($isNewEntry == false && $isNotExited == true) { ?>
<!--                            <form role="form" id="addEntry" action="<?php echo base_url() ?>employee/vehicle/generateexitreciept" method="post" role="form" enctype="multipart/form-data">
                                <input type="hidden" id="entryId" name="entryId" value="<?php echo $entryDetails->id; ?>" />
                                <div class="box box-primary ">
                                    <div class="box-header">
                                        <h3 class="box-title">Preview Details</h3>
                                    </div>
                                    <div class="box-body " >
                                        <?php      if(!$this->config->item('disable_cashtype_exit')) {  ?>
                                          <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="status">Cash or Card</label>
                                        <select class="form-control required" id="customer_paid_by_cash_or_card" name="customer_paid_by_cash_or_card">
                                            <option value="" >Select Cash or Card</option>
                                            <?php
                                            $customer_paid_by_cash_or_card = json_decode(CUSTOMER_PAID_BY_CASH_OR_CARD_ARRAY,TRUE);
                                            if(!empty($customer_paid_by_cash_or_card))
                                            {
                                                foreach ($customer_paid_by_cash_or_card as $key => $value)
                                                {
                                                    ?>
                                                    <option value="<?php echo $key; ?>"  ><?php echo $value; ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                        <?php } ?>
                                        <?php      if(!$this->config->item('disable_uploadimage_exit')) {  ?>
                                        <div class="col-md-6">                                
                                            <div class="form-group">
                                                <label for="image_vehicle_number_plate_exit">Exit Vehicle Number Plate Image</label>
                                                <input type="file" class="form-control required" id="image_vehicle_number_plate_exit" name="image_vehicle_number_plate_exit" value="">

                                            </div>
                                        </div>
                                        <?php } ?>
                                    </div>
                                    <div class="box-footer">
                                        <input type="submit" class="btn btn-primary" value="Submit" />
                                        <input type="reset" class="btn btn-default" value="Reset" />
                                    </div>
                                </div>
                            </form>-->
        <?php } ?>
                        <div class="box box-primary printTicketMain">
                            
                            <div class="box-header">
<!--                                <h3 class="box-title">Preview Details<?php //echo $sub_title . ' No : ' . $entryId; ?></h3> -->
                                <form role="form" id="addEntry" action="<?php echo base_url() ?>employee/vehicle/addManualExit" method="post" enctype="multipart/form-data" novalidate="novalidate">
                                <?php if($isNotExited == true) { ?>
                                <div class="box-body">
                                      <?php 
                                          $exitTerminalCount = 0;
                                                foreach ($terminalListArray as $value)
                                                {
                                                    if($value->type == 2 && in_array($value->id,array_keys($role_privileges))){
                                                        $exitTerminalCount++;
                                                    } 
                                                }
//                                               
                                      // if($isNotExited == true && $role == 2 && $this->config->item('enable_admin_no_gate_restriction')) { ?>
                                    <div class="row" <?php if(($exitTerminalCount == 1 || count(array_intersect($exitGateIdsArray, array_keys($role_privileges))) == 1) || $isNotExited == false){ ?> style="display:none;" <?php } ?> >
<!--                                <div class="col-md-6">
                                       <div class="form-group" >
                                        <label for="gate_id">Terminal<span class="color-red">*</span></label>
                                        <select class="form-control required" id="gate_id" name="gate_id">
                                            <option value="" >Select Terminal</option>
                                            <?php
                                           $data['terminalListArray'] = $this->k_master_vehicle_gate_model->get(); 
                                            if(!empty($terminalListArray))
                                            {
                                            
                                                foreach ($terminalListArray as $value)
                                                {
                                                    if($value->type == 2 && in_array($value->id,array_keys($role_privileges))){
                                                    ?>
                                                    <option value="<?php echo $value->id;  ?>" <?php if($exitTerminalCount == 1 || (count(array_intersect($exitGateIdsArray, array_keys($role_privileges))) == 1 && in_array($value->id,array_keys($role_privileges)) ) ){ echo 'selected=selected'; } ?> ><?php echo $value->name; ?></option>
                                                    <?php
                                                    }
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>-->
                            </div>
                            <div class="row">
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                                <label for="role">Date</label>
<!--                                                <div class="input-group date" data-provide="datepicker">-->
                                                    <input type="text" class="form-control required" disabled name="created_date" value="<?php echo date("d-m-Y", time());?>">
<!--                                                    <div class="input-group-addon">
                                                        <span class="glyphicon glyphicon-calendar"></span>
                                                    </div>
                                                </div>-->
                                    </div>
                                </div>
                                        <div class="col-md-6">                                
                                                    <div class="form-group">
                                                        <label for="vehicle_number">Vehicle Number</label>

                                                        <input disabled type="text" class="form-control <?php if (!$this->config->item('disable_mandatory_field_entry')) { ?>required <?php } ?>" id="vehicle_number" name="vehicle_number" value="<?php echo $entryDetails->vehicle_number;?>">
                                                    </div>
                                                </div>
                                
                                     
                            </div>
                                     <input type="hidden" name="entryId" value="<?php echo $entryDetails->id;?>">
                                     <input type="hidden" name="code" value="<?php echo $entryDetails->barcode;?>">
                                    <div class="row">
                                        <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="vehicle_type_id">Vehicle Type<span class="color-red">*</span></label>
                                        <select class="form-control required" disabled id="vehicle_type_id" name="vehicle_type_id">
                                            <option value="" >Select Vehicle Type</option>
                                            <?php
                                            
                                            if(!empty($vehicleTypeListArray))
                                            {
                                                foreach ($vehicleTypeListArray as $value)
                                                {
                                                    ?>
                                                    <option value="<?php echo $value->id; ?>" <?php if($value->id == $entryDetails->vehicle_type_id){ echo 'selected=selected'; }?> ><?php echo $value->name; ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                         <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="vehicle_company">Vehicle Company</label>
                                        <input type="text" class="form-control" disabled id="vehicle_company" name="vehicle_company" placeholder="New Company" value="<?php echo $entryDetails->vehicle_company;?>">
                                    </div>
                                </div>
                                 
                                    </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                                <label for="role">Entry Date</label>
<!--                                                <div class="input-group date" data-provide="datepicker">-->
                                                    <input type="text" disabled class="form-control required" name="entry_date" value="<?php echo date("d-m-Y", strtotime($entryDetails->entry_time));?>">
<!--                                                    <div class="input-group-addon">
                                                        <span class="glyphicon glyphicon-calendar"></span>
                                                    </div>
                                                </div>-->
                                    </div>
                                </div>
                                <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="role">Entry Time(hh:mm)</label>
                                                <input type="text" disabled class="form-control required" name="entry_time" value="<?php echo date("H:i", strtotime($entryDetails->entry_time));?>">
                                            </div>
                                </div>
                            </div>
                                    
                                      <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                                <label for="role">Exit Date</label>
                                                <div class="input-group date" data-provide="datepicker">
                                                    <input type="text" class="form-control required" name="exit_date" value="<?php //echo date("d-m-Y", strtotime($entryDetails->exit_time));?>">
                                                    <div class="input-group-addon">
                                                        <span class="glyphicon glyphicon-calendar"></span>
                                                    </div>
                                                </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="role">Exit Time(24 hours format hh:mm)</label>
                                                <input type="text" class="form-control required" name="exit_time" value="<?php //echo date("H:i", strtotime($entryDetails->exit_time));?>">
                                            </div>
                                </div>
                            </div>
                                    
                                    
                                    <?php 
                                    $parked_hours = minutes_to_hours_n_minutes($entryDetails->total_minutes,60);
                                    ?>
                                    
                                    <div class="row">
                                           <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="role">Parked Hours(hh:mm)</label>
                                                <input type="text" class="form-control required" name="parked_hours" value="<?php //echo $parked_hours['hours'].":".$parked_hours['minutes']; ?>" style="color:red;">
                                            </div>
                                </div>
                                <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="role">Amount</label>
                                                <input type="text" class="form-control required" name="amount" value="<?php //echo $entryDetails->amount;?>" style="color:red;">
                                            </div>
                                </div>
                             
                            
                                
                            </div>
                                    
                                </div><!-- /.box-body -->    
                                    
                                 
                                                <div class="box-footer">
                                        <input type="submit" class="btn btn-primary" value="Submit" />
                                        <input type="reset" class="btn btn-default" value="Reset" />
                                    </div>
                               
                                   <?php } ?>
<!--                            <div class="box-footer" style="float:right;" >
                                    
                                                                    <input type="hidden" id="entryId" name="entryId" value="<?php echo $entryDetails->id; ?>" />
                                                                    <?php if($isNotExited == true) { ?>
                                                                    
                                        <input type="submit" class="btn btn-primary"  value="Confirm">
                                                                    <?php } ?>
                                        <?php if ($isNewEntry == false && $isNotExited == false) { ?>
                                            <input type="reset" class="btn btn-primary float-right" value="Print" onclick="printPage()" >
                                        <?php } ?>
                                </div>-->
                            
                            
                            
                            
                                    
                                     
                                </form>
                                 
<!--                                <br>
                                <br>
                                <h3 class="box-title">Preview Details</h3>-->
                            </div> 
                            <div class="box-body printTicket" <?php if($isNotExited == true){ echo 'style="display:none;"'; }?> >
                                <?php if($isNotExited == false) { 
                                    $parked_hours = minutes_to_hours_n_minutes($entryDetails->total_minutes,60);
                                    ?>
                                
                                <div style="text-align: center; ">
                                    <h3><b><?php echo $login_user_company_name; ?></b></h3>
                                    <h3><b><?php echo $exitGateDetails->name; ?></b></h3>
                                    <h3><img src="<?php echo base_url().'/barcode/'.$entryDetails->barcode.'.png';?>"</h3>
                                    <h3><b><?php echo ($exitGateDetails->type == 1)?'Entry Ticket':'Exit Ticket'; ?></b></h3>
                                </div>
                                <?php } ?>
                                <div style="text-align: left;">



                                    <h4>Ticket Number: <span><?php echo $entryDetails->id; ?></span></h4>
                                    <h4>Entry Date and Time: <span><?php echo date("d-m-Y H:i:s", strtotime($entryDetails->entry_time)); // date("d- m- Y H : i : s", strtotime(convertTime($entryDetails->entry_time, $timeZoneName = 'IST'))); ?></span></h4>
                                    <?php if($isNotExited == false) { ?>
                                    <h4>Exit Date and Time: <span><?php echo date("d-m-Y H:i:s", strtotime($entryDetails->exit_time)); //  date("d- m- Y H : i : s", strtotime(convertTime($entryDetails->exit_time, $timeZoneName = 'IST'))); ?></span></h4>
                                    <h4>Parked Hours: <span><?php echo $parked_hours['hours'].":".$parked_hours['minutes']; ?></span></h4>
                                    <h4><b>Total Amount: <span><?php echo $entryDetails->total_amount; ?></span></b></h4>
                                    <?php } ?>
                                    <h4>Vehicle Type: <span><?php echo $entryDetails->number_of_wheels; ?>W</span></h4>
                                    <?php if(!empty($entryDetails->vehicle_company)) { ?><h4>Company Name: <span><?php echo $entryDetails->vehicle_company; ?></span></h4><?php } ?>
                                    <?php if(!empty($entryDetails->vehicle_number)) { ?><h4>Vehicle No: <span><?php echo $entryDetails->vehicle_number; ?></span></h4><?php } ?>
                                <?php if(!empty($entryDetails->driver_name) || !empty($entryDetails->driving_license_number) || !empty($entryDetails->rc)) { ?>
                                    <h3><b>Driver Details</b> </h3>
                                <?php if(!empty($entryDetails->driver_name)) { ?>    <h4><?php echo $entryDetails->driver_name; ?></h4><?php } ?>
                                    <?php if(!empty($entryDetails->driving_license_number)) { ?><h4>DL : <span><?php echo $entryDetails->driving_license_number; ?></span></h4><?php } ?>
                                    <?php if(!empty($entryDetails->rc)) { ?><h4>RC : <span><?php echo $entryDetails->rc ?></span></h4><?php } ?>
                                    <?php } 
                                    if($entryDetails->manual_exit == 2){
                                    ?>
                                    <h3><b>Parking Charges</b> </h3>
                                    <?php
                                    
                                foreach ($vehicleTypePrices as $key => $value) {
                                        ?>
                                        <h4><?php echo $value->from_minutes; ?>-<?php echo $value->to_minutes; ?>mins : Rs. <?php echo $value->amount; ?></h4>
                                    <?php
                                  }
                                }
                                    ?>
                                        
                                        <?php if($this->config->item('enable_more_than_minutes_per_hour_amount')) { ?>
                                        <h4>Beyond this per hour : Rs. <?php echo $masterPriceDetails->more_than_minutes_per_hour_amount; ?></h4>
                                        <?php } ?>
                                        
<!--                                    <h3><b>No Horn</b> </h3>
                                    <h3><b>Speed Limit : <span>10Km/Hr</span></b></h3>-->
                                </div>
                            </div>
                            <div id="printTicketData" class="box-body" style="/*width: 21%;background: red; */line-height: 5px;font-size: 12px;font-family: sans-serif;display:none;">
        <div class="ticketHeader" style="font-size: 13px;" >

            <p><b><?php echo $login_user_company_name; ?></b></p>
            <p style="margin-left: 70px;"><?php echo @$exitGateDetails->name; ?></p>
            <p style="margin-left: 30px;"><img src="<?php echo base_url() . '/barcode/' . $entryDetails->barcode . '.png'; ?>" /> 
            <p style="margin-left: 70px;"><?php echo ($exitGateDetails->type == 1) ? 'Entry Ticket' : 'Exit Ticket'; ?></p>
            </p>
            
        </div>
        <div style="ticketBody" style="margin-top:100px;">
            <div class="ticketLine"><p><b><span class="ticketLineLeft">Ticket Number</span>: <span><?php echo $entryDetails->id; ?></span></b></p></div>
            <div class="ticketLine"><p><span style="float: left;width: 115px;">Entry Date and Time</span>: <span><?php echo date("d-m-Y H:i", strtotime($entryDetails->entry_time)); ?></span></p></div>
            <?php if ($isNotExited == false) { ?>
                <div class="ticketLine"><p><span style="float: left;width: 115px;">Exit Date and Time</span>: <span><?php echo date("d-m-Y H:i", strtotime($entryDetails->exit_time)); ?></span></p></div>
            <?php } ?>
                        
            <div class="ticketLine"><p><span style="float: left;width: 115px;">Vehicle Type</span>: <span><?php echo $entryDetails->number_of_wheels; ?>W</span></p></div>
            
            
         <!--    <?php if (!empty($entryDetails->vehicle_number)) { ?><div class="ticketLine"><p><span style="float: left;width: 115px;">Vehicle Number</span>: <span><?php echo $entryDetails->vehicle_number; ?></span></div><?php } ?>

            
         -->
         
         <?php if ($isNotExited == false) { 
             
             ?>
                <div class="ticketLine"><p><span style="float: left;width: 115px;">Parked Hours</span>: <span><?php echo $parked_hours['hours'].":".$parked_hours['minutes'];  ?></span></div>
                <div class="ticketLine"><p><span style="float: left;width: 115px;">Total Amount</span>:  <span><?php echo $entryDetails->total_amount; ?></span></p></div>
        <?php } ?>
                <?php if (!empty($entryDetails->vehicle_company)) { ?><div class="ticketLine"><p><span style="float: left;width: 115px;">Company Name</span>: <span><?php echo $entryDetails->vehicle_company; ?></span></div><?php } ?>
         <!--
            <?php if (!empty($entryDetails->driver_name) || !empty($entryDetails->driving_license_number) || !empty($entryDetails->rc)) { ?>
                <div class="ticketLineHeading" style="margin-top:15px;"><p><b>Driver Details</b></p></div>
                <?php if (!empty($entryDetails->driver_name)) { ?><div class="ticketLine"><p><span style="float: left;width: 115px;">Name</span> : <?php echo $entryDetails->driver_name; ?></p></div><?php } ?>
                <?php if (!empty($entryDetails->driving_license_number)) { ?><div class="ticketLine"><p><span style="float: left;width: 115px;">License No</span>: <span><?php echo $entryDetails->driving_license_number; ?></span></div><?php } ?>
                <?php if (!empty($entryDetails->rc)) { ?><div class="ticketLine"><p><span style="float: left;width: 115px;">RC</span>: <span><?php echo $entryDetails->rc; ?></span></div><?php } ?>
            <?php } ?>
            <div class="ticketLineHeading" style="margin-top:15px;"><p><b>Parking Charges </b></p></div>
            <?php
            foreach ($vehicleTypePrices as $key => $value) {
                ?>
                <div class="ticketLine"><p><span style="float: left;width: 115px;"><?php echo $value->from_minutes; ?>-<?php echo $value->to_minutes; ?>mins</span> : Rs. <?php echo $value->amount; ?></p></div>
                <?php
            }
            ?>
                -->
        </div>
        <div class="ticketFooter" style="margin-top:15px;">
            <!--                            <h4>Beyond this per hour : Rs. 20.00</h4>-->
<!--            <div class="ticketLine"><p><b>No Horn </b></p></div>
            <div class="ticketLine"><p><b>Speed Limit : <span>10Km/Hr</span></b></div>-->
            <div class="ticketLine"><p><img id="display_image" style="width: 240px !important;" src="<?php echo base_url() ?>/assets/images/upload/numberplate/240/<?php echo $entryDetails->image_vehicle_number_plate; ?>" alt="" class="img-responsive"></p></div>
        </div>    
    </div>


                        </div>
                    </div>
                    <?php if(!$this->config->item('disable_uploadimage_exit')) { ?>
            <div class="col-md-6">
                    <div class="box box-primary">
                        <div class="box-body">
                                        <label id="display_label">Preview Exit Number Plate</label>
                                         <img id="display_number_plate_image_exit" src="<?php echo base_url() ?>/assets/images/upload/numberplate/exit/640/<?php echo $entryDetails->image_vehicle_number_plate_exit; ?>" alt="" class="img-responsive" />
                                         
                        </div>
                         <img id="preview_image_driving_license_number" src="#" alt="" style="width:auto" /> 
                    </div>
                </div>
                    <?php } ?>
                    <div class="col-md-6">
                        <div class="box box-primary">
                            <div class="box-body">

                                <div class="clearfix" >
                                    <label id="display_label">Preview Entry Number Plate</label>
                                </div>

                                <img id="display_image" src="<?php echo base_url() ?>/assets/images/upload/numberplate/640/<?php echo $entryDetails->image_vehicle_number_plate; ?>" alt="" class="img-responsive" >
                                <div id="display_ticket" class="img-responsive" ></div>



                            </div>
                            <!-- <img id="preview_image_driving_license_number" src="#" alt="" style="width:auto" /> -->
                        </div>
                    </div>
                     <?php if(!$this->config->item('enable_image_driving_license_number') && !empty($entryDetails->image_driving_license_number)) { ?>
            <div class="col-md-6">
                    <div class="box box-primary">
                        <div class="box-body">
                                            <div class="clearfix" >
                                    <label id="display_label">Preview Driving License</label>
                                </div>
                                         <img src="<?php echo base_url() ?>/assets/images/upload/drivinglicense/640/<?php echo $entryDetails->image_driving_license_number; ?>" alt=""   class="img-responsive"  />
                                         
                        </div>
                         <img id="preview_image_driving_license_number" src="#" alt="" style="width:auto" /> 
                    </div>
                </div>
                    <?php } ?>
                </div>
    <?php } else { ?>
                <div class="row">
                    <!-- left column -->
                    <form role="form" id="addEntry" action="<?php echo base_url() ?>employee/vehicle/addEntry/<?php echo $entryId; ?>" method="post" role="form" enctype="multipart/form-data">
                        <div class="col-md-6">
                            <!-- general form elements -->



                            <div class="box box-primary">

                                <!-- form start -->

        <?php if ($isNewEntry == true) { ?>
                                    <div class="box-body">
                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="vehicle_type_id">Vehicle Type</label>
                                                    <select class="form-control required" id="vehicle_type_id" name="vehicle_type_id">
                                                        <option value="" >Select Vehicle Type</option>
                                                        <?php
                                                        if (!empty($vehicleTypeListArray)) {
                                                            foreach ($vehicleTypeListArray as $value) {
                                                                ?>
                                                                <option value="<?php echo $value->id; ?>" ><?php echo $value->name; ?></option>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">                                
                                                <div class="form-group">
                                                    <label for="vehicle_company">Vehicle Company</label>
                                                    <input type="text" class="form-control" id="vehicle_company" name="vehicle_company" value="">
                                                </div>
                                            </div>


                                        </div>
                                        <div class="row">

                                            <div class="col-md-6">                                
                                                <div class="form-group">
                                                    <label for="vehicle_number">Vehicle Number</label>
                                                    <input type="text" class="form-control required" id="vehicle_number" name="vehicle_number" value="">
                                                </div>
                                            </div>

                                            <div class="col-md-6">                                
                                                <div class="form-group">
                                                    <label for="image_vehicle_number_plate">Vehicle Number Plate Image</label>
                                                    <input type="file" class="form-control required" id="image_vehicle_number_plate" name="image_vehicle_number_plate" value="">

                                                </div>
                                            </div>




                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">                                
                                                <div class="form-group">
                                                    <label for="driving_license_number">Driving License Number</label>
                                                    <input type="text" class="form-control" id="driving_license_number" name="driving_license_number" value="">
                                                </div>
                                            </div>

                                            <div class="col-md-6">                                
                                                <div class="form-group">
                                                    <label for="image_driving_license_number">Driving License Number Image</label>
                                                    <input type="file" class="form-control required" id="image_driving_license_number" name="image_driving_license_number" value="">

                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">                                
                                                <div class="form-group">
                                                    <label for="driver_name">Driver Name</label>
                                                    <input type="text" class="form-control" id="driver_name" name="driver_name" value="">
                                                </div>
                                            </div>

                                            <div class="col-md-6">                                
                                                <div class="form-group">
                                                    <label for="rc">RC</label>
                                                    <input type="text" class="form-control" id="rc" name="rc" value="">
                                                </div>
                                            </div>

                                        </div>




                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <input type="submit" class="btn btn-primary" value="Submit" />
                                        <input type="reset" class="btn btn-default" value="Reset" />
                                    </div>
        <?php } ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="box box-primary">
                                <div class="box-body">


                                    <label id="display_label"></label>
                                    <img id="display_image" src="" alt="" class="img-responsive" />
                                    <div id="display_ticket" class="img-responsive" ></div>



                                </div>
                                <!-- <img id="preview_image_driving_license_number" src="#" alt="" style="width:auto" /> -->
                            </div>
                        </div>


                    </form>      
                </div>
    <?php } ?>


        </section>
<?php } ?>
</div>
<script type="text/javascript">
    function DoValidate(){
// check your validate here, 
//if all field pass: return true, if not : return false;

//ex: return $('input[name="part_barcode"]).val().length>10;
return true;
}
$("#barcodeEntryId").on("paste", function () {
        setTimeout(function() {
        if(DoValidate()) $('#formBarcodeScanner').submit();
        $('[name=submit]').trigger('click')
    });
});
//$('#barcodeEntryId').keypress(function(){
//    if(DoValidate()) $('#formBarcodeScanner').submit();
//   //or: $('input[type="submit"]').trigger('click');
//});
    
    function readURL(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            var clicked_id = $(input).attr("id");

            reader.onload = function (e) {

                $('#display_number_plate_image_exit').attr('src', e.target.result);

            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#image_vehicle_number_plate_exit").change(function () {
        readURL(this);
    });
function printPage(){
    $("#printTicketData").css("display", "block");
    var options = {mode:"popup",popHt: 500, popWd: 400, popX: 500,   popY: 600,popTitle:"",popClose: false};
    $("#printTicketData").printArea( options ); 
    $("#printTicketData").css("display", "none");
}

    var _scannerIsRunning = false;

        function startScanner() {
            Quagga.init({
                inputStream: {
                    name: "Live",
                    type: "LiveStream",
                    target: document.querySelector('#scanner-container'),
                    constraints: {
                        width: 480, //240,
                        height: 320, //160,
                        facingMode: "environment"
                    },
                },
              locator: {

                        patchSize: "large",

                        halfSample: false

                      },


                decoder: {
                    readers: [
                        "code_128_reader",
//                        "ean_reader",
//                        "ean_8_reader",
//                        "code_39_reader",
//                        "code_39_vin_reader",
//                        "codabar_reader",
//                        "upc_reader",
//                        "upc_e_reader",
//                        "i2of5_reader"
                    ],
                    debug: {
                        showCanvas: true,
                        showPatches: true,
                        showFoundPatches: true,
                        showSkeleton: true,
                        showLabels: true,
                        showPatchLabels: true,
                        showRemainingPatchLabels: true,
                        boxFromPatches: {
                            showTransformed: true,
                            showTransformedBox: true,
                            showBB: true
                        }
                    }
                },

            }, function (err) {
                if (err) {
                    console.log(err);
                    return
                }

                console.log("Initialization finished. Ready to start");
                Quagga.start();

                // Set flag to is running
                _scannerIsRunning = true;
            });

            Quagga.onProcessed(function (result) {
                var drawingCtx = Quagga.canvas.ctx.overlay,
                drawingCanvas = Quagga.canvas.dom.overlay;

                if (result) {
                    if (result.boxes) {
                        drawingCtx.clearRect(0, 0, parseInt(drawingCanvas.getAttribute("width")), parseInt(drawingCanvas.getAttribute("height")));
                        result.boxes.filter(function (box) {
                            return box !== result.box;
                        }).forEach(function (box) {
                            Quagga.ImageDebug.drawPath(box, { x: 0, y: 1 }, drawingCtx, { color: "green", lineWidth: 2 });
                        });
                    }

                    if (result.box) {
                        Quagga.ImageDebug.drawPath(result.box, { x: 0, y: 1 }, drawingCtx, { color: "#00F", lineWidth: 2 });
                    }

                    if (result.codeResult && result.codeResult.code) {
                        Quagga.ImageDebug.drawPath(result.line, { x: 'x', y: 'y' }, drawingCtx, { color: 'red', lineWidth: 3 });
                    }
                }
            });


            Quagga.onDetected(function (result) {
                // $("#detected_code").append("<p>"+result.codeResult.code+"<p>");
                $("#barcodeEntryId").val(result.codeResult.code);
                setTimeout(function() {
                    if(result.codeResult.code.length >= 18){
                console.log("Barcode detected and processed : [" + result.codeResult.code + "]", result);        
                // return false;
        if(DoValidate()) $('#formBarcodeScanner').submit();
     //   $('[name=submit]').trigger('click')
    }
    });
                // console.log("Barcode detected and processed : [" + result.codeResult.code + "]", result);
                console.log("Barcode detected and processed : [" + result.codeResult.code + "]", result);
            });
        }


        // Start/stop scanner
        document.getElementById("triggerScanner").addEventListener("click", function () {
            if (_scannerIsRunning) {
                Quagga.stop();
            } else {
                $('#scannerBlock').css('display', 'block');
                startScanner();
            }
        }, false);
        
<?php if($isNotExited){ ?>
$( document ).ready(function() {
     //   $(document).off('.datepicker.data-api');
     $.fn.datepicker.defaults.format = "yyyy-mm-dd";
        $('.datepicker').datepicker({
        });   
});   
<?php } ?>
</script>
<script src="<?php echo base_url(); ?>assets/js/employee/common.js" type="text/javascript"></script>