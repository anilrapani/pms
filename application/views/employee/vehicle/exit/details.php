<style type="text/css">
    .printTicket{
        border: 1px solid black; 
    }
    .printTicketMain{
        padding-bottom: 10%;
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
        #display_image{
            width: auto !important;
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
        #display_image{
            width: auto !important;
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
                <form action="<?php echo base_url() ?>employee/vehicle/generateExitReciept" method="POST" id="formBarcodeScanner">
                    <div class="input-group">
                        <input type="text" name="entryId" id="barcodeEntryId" autofocus class="form-control input-sm pull-left" style="width: 150px;" placeholder="Scan Barcode" value="" >
                        <div class="input-group-btn pull-left " >
                            <button class="btn btn-sm btn-default searchList"><i class="fa fa-barcode"></i></button>
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
                <form action="<?php echo base_url() ?>employee/vehicle/generateExitReciept" method="POST" id="formBarcodeScanner">
                    <div class="input-group">
                        <input type="text" name="entryId" id="entryId" class="form-control input-sm pull-left" style="width: 150px;" placeholder="Ticket Id" value="" >
                        <div class="input-group-btn pull-left">
                            <button class="btn btn-sm btn-default searchList"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </form>
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
                                <form role="form" id="addEntry" action="<?php echo base_url() ?>employee/vehicle/generateexitreciept" method="post" enctype="multipart/form-data" novalidate="novalidate">
                                <div class="box-footer" style="float:right;" >
                                                                    <input type="hidden" id="entryId" name="entryId" value="<?php echo $entryDetails->id; ?>" />
                                                                    <?php if($isNotExited == true) { ?>
                                        <input type="submit" class="btn btn-primary"  value="Submit">
                                                                    <?php } ?>
                                        <?php if ($isNewEntry == false) { ?><input type="reset" class="btn btn-primary float-right" value="Print" onclick="printPage()" ><?php } ?>
                                </div>
                                </form>
                                 <h3 class="box-title">Preview Details<?php //echo $sub_title . ' No : ' . $entryId; ?></h3> 
<!--                                <br>
                                <br>
                                <h3 class="box-title">Preview Details</h3>-->
                            </div> 
                            <div class="box-body printTicket" >
                                <?php if($isNotExited == false) { ?>
                                
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
                                    <h4><b>Total Amount: <span><?php echo $entryDetails->total_amount; ?></span></b></h4>
                                    <?php } ?>
                                    <h4>Vehicle : <span><?php echo $entryDetails->number_of_wheels; ?>W</span></h4>
                                    <?php if(!empty($entryDetails->vehicle_company)) { ?><h4>Company Name: <span><?php echo $entryDetails->vehicle_company; ?></span></h4><?php } ?>
                                    <?php if(!empty($entryDetails->vehicle_number)) { ?><h4>Vehicle No: <span><?php echo $entryDetails->vehicle_number; ?></span></h4><?php } ?>
                                <?php if(!empty($entryDetails->driver_name) || !empty($entryDetails->driving_license_number) || !empty($entryDetails->rc)) { ?>
                                    <h3><b>Driver Details</b> </h3>
                                <?php if(!empty($entryDetails->driver_name)) { ?>    <h4><?php echo $entryDetails->driver_name; ?></h4><?php } ?>
                                    <?php if(!empty($entryDetails->driving_license_number)) { ?><h4>DL : <span><?php echo $entryDetails->driving_license_number; ?></span></h4><?php } ?>
                                    <?php if(!empty($entryDetails->rc)) { ?><h4>RC : <span><?php echo $entryDetails->rc ?></span></h4><?php } ?>
                                    <?php } ?>
                                    <h3><b>Parking Charges</b> </h3>
                                    <?php
                                    
                                foreach ($vehicleTypePrices as $key => $value) {
                                        ?>
                                        <h4><?php echo $value->from_minutes; ?>-<?php echo $value->to_minutes; ?>mins : Rs. <?php echo $value->amount; ?></h4>
                                    <?php
                                  }
                                    ?>
                                        <?php if($this->config->item('enable_more_than_minutes_per_hour_amount')) { ?>
                                        <h4>Beyond this per hour : Rs. <?php echo $masterPriceDetails->more_than_minutes_per_hour_amount; ?></h4>
                                        <?php } ?>
                                        
                                    <h3><b>No Horn</b> </h3>
                                    <h3><b>Speed Limit : <span>10Km/Hr</span></b></h3>
                                </div>
                            </div>
                            <div id="printTicketData" class="box-body" style="/*width: 21%;background: red; */line-height: 5px;font-size: 12px;font-family: sans-serif;display:none;">
        <div class="ticketHeader" style="font-size: 13px;" >

            <p><b><?php echo $login_user_company_name; ?></b></p>
            <p style="margin-left: 70px;"><?php echo $exitGateDetails->name; ?></p>
            <p style="margin-left: 30px;"><img src="<?php echo base_url() . '/barcode/' . $entryDetails->barcode . '.png'; ?>" /> 
            <p style="margin-left: 70px;"><?php echo ($exitGateDetails->type == 1) ? 'Entry Ticket' : 'Exit Ticket'; ?></p>
            </p>
            <div class="ticketLine"><p><img id="display_image" src="<?php echo base_url() ?>/assets/images/upload/numberplate/<?php echo $entryDetails->image_vehicle_number_plate; ?>" alt="" style="width:240px"></p></div>
        </div>
        <div style="ticketBody" style="margin-top:100px;">
            <div class="ticketLine"><p><b><span class="ticketLineLeft">Ticket Number</span>: <span><?php echo $entryDetails->id; ?></span></b></p></div>
            <div class="ticketLine"><p><span style="float: left;width: 115px;">Entry Date and Time</span>: <span><?php echo date("d-m-Y H:i:s", strtotime($entryDetails->entry_time)); ?></span></p></div>
            <?php if ($isNotExited == false) { ?>
                <div class="ticketLine"><p><span style="float: left;width: 115px;">Exit Date and Time</span>: <span><?php echo date("d-m-Y H:i:s", strtotime($entryDetails->exit_time)); ?></span></p></div>
                <div class="ticketLine"><p><span style="float: left;width: 115px;">Total Amount</span>:  <span><?php echo $entryDetails->total_amount; ?></span></p></div>
            <?php } ?>
                        <?php if (!empty($entryDetails->vehicle_number)) { ?><div class="ticketLine"><p><span style="float: left;width: 115px;">Vehicle Number</span>: <span><?php echo $entryDetails->vehicle_number; ?></span></div><?php } ?>
            <div class="ticketLine"><p><span style="float: left;width: 115px;">Vehicle Type</span>: <span><?php echo $entryDetails->number_of_wheels; ?>W</span></p></div>


            <?php if (!empty($entryDetails->vehicle_company)) { ?><div class="ticketLine"><p><span style="float: left;width: 115px;">Company Name</span>: <span><?php echo $entryDetails->vehicle_company; ?></span></div><?php } ?>
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

        </div>
        <div class="ticketFooter" style="margin-top:15px;">
            <!--                            <h4>Beyond this per hour : Rs. 20.00</h4>-->
            <div class="ticketLine"><p><b>No Horn </b></p></div>
            <div class="ticketLine"><p><b>Speed Limit : <span>10Km/Hr</span></b></div>

        </div>    
    </div>


                        </div>
                    </div>
                    <?php if(!$this->config->item('disable_uploadimage_exit')) { ?>
            <div class="col-md-6">
                    <div class="box box-primary">
                        <div class="box-body">
                                        <label id="display_label">Preview Exit Number Plate</label>
                                         <img id="display_number_plate_image_exit" src="<?php echo base_url() ?>/assets/images/upload/numberplate/exit/<?php echo $entryDetails->image_vehicle_number_plate_exit; ?>" alt="" style="width:500px" />
                                         
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

                                <img id="display_image" src="<?php echo base_url() ?>/assets/images/upload/numberplate/<?php echo $entryDetails->image_vehicle_number_plate; ?>" alt="" style="width:400px">
                                <div id="display_ticket" style="width: 100%; height: 30%"></div>



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
                                         <img src="<?php echo base_url() ?>/assets/images/upload/drivinglicense/<?php echo $entryDetails->image_driving_license_number; ?>" alt="" style="width:400px" />
                                         
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
                                    <img id="display_image" src="" alt="" style="width:500px" />
                                    <div id="display_ticket" style="width: 100%; height: 30%"></div>



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
</script>
<script src="<?php echo base_url(); ?>assets/js/employee/common.js" type="text/javascript"></script>