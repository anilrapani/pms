<style type="text/css">
    .printTicket{
        width: 60%;
        margin-left: 20%;
        border: 1px solid black;
        
    }
    .printTicket h2{
        font-size: 22px !important;
        line-height: 10px;
        
    }
    .printTicket h3{
        line-height: 10px;
        font-size: 18px !important;
    }
    .printTicket h4{
        line-height: 10px;
        font-size: 14px !important;
    }
    .ticketLineLeft{
        
    }
</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="box-header col-md-6">
            <h1 class="box-title"><i class="fa "></i> <?php echo ($isNewEntry == true)?'New Entry':'';  ?></h1>
                    <div class="box-tools">
                        <form action="<?php echo base_url() ?>employee/vehicle/searchEntry" method="POST">
                            <div class="input-group">
                                <input type="text" name="entryId" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search Entry No" value="<?php echo $entryId;?>" >
                              <div class="input-group-btn">
                                <button class="btn btn-sm btn-default searchList"><i class="fa fa-search"></i></button>
                              </div>
                            </div>
                        </form>
                    </div>
        </div>
        
        
    </section>
    <div class="clearfix"></div>
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
        <div class="row">
            <?php if($isNewEntry == false) {?>
                <div class="col-md-6">
                <!-- general form elements -->
                


                <div class="box box-primary " >
                    <div class="box-header">
                        <h3 class="box-title"><?php echo $sub_title.' No : '.$entryId; ?></h3> <?php if($isNewEntry == false) {?><input type="submit" class="btn btn-primary float-right" onclick="printPage()" style="float:right;"value="Print"><?php } ?>
                        <br>
                        <br> 
                        <div id="printTicket1" class="box-body printTicket" style="
    /*width: 21%;*/
    /* background: red; */
    line-height: 5px;
    font-size: 12px;
    font-family: sans-serif;
    display:none;
">
    <div class="ticketHeader" style="font-size: 14px;" >
        
        <p><b>Menzies Aviation Bobba (B'lor) Pvt Ltd</b></p>
        <p style="margin-left: 70px;">Entry Gate1</p>
        <p style="margin-left: 30px;"><img src="http://localhost/pms//barcode/625915163736864018.png" <="" h3="">

        </p></div>
    <div style="ticketBody">
        <div class="ticketLine"><p><b><span class="ticketLineLeft">Ticket Number</span>: <span>50</span></b></p></div>
        <div class="ticketLine"><p><span style="float: left;width: 115px;">Entry Date and Time</span>: <span>2018-01-19 20:24:46</span></p></div>
        <div class="ticketLine"><p><span style="float: left;width: 115px;">Exit Date and Time</span>: <span>2018-01-19 20:24:46</span></p></div>
        <div class="ticketLine"><p><span style="float: left;width: 115px;">Total Amount</span>:  <span>30.00</span></p></div>
        <div class="ticketLine"><p><span style="float: left;width: 115px;">Vehicle Type</span>: <span>7W</span></p></div>
        <div class="ticketLine"><p><span style="float: left;width: 115px;">Company Name</span>: <span>New Company</span></div>
        <div class="ticketLineHeading" style="margin-top:15px;"><p><b>Driver Details</b></p></div>
        <div class="ticketLine"><p><span style="float: left;width: 115px;">Name</span> : Aravind</p></div>
        <div class="ticketLine"><p><span style="float: left;width: 115px;">License No</span>: <span>TS12345781234564</span></div>
        <div class="ticketLine"><p><span style="float: left;width: 115px;">RC</span>: <span>AP12345685</span></div>
        <div class="ticketLineHeading" style="margin-top:15px;"><p><b>Parking Charges </b></p></div>
        <div class="ticketLine"><p><span style="float: left;width: 115px;">0-45mins</span>     : Rs. 0.00</p></div>
        <div class="ticketLine"><p><span style="float: left;width: 115px;">30-60mins</span>    : Rs. 30.00</p></div>
        <div class="ticketLine"><p><span style="float: left;width: 115px;">60-120mins</span>   : Rs. 70.00</p></div>
        <div class="ticketLine"><p><span style="float: left;width: 115px;">120-180mins</span>  : Rs. 90.00</p></div>
        <div class="ticketLine"><p><span style="float: left;width: 115px;">180-210mins</span>  : Rs. 100.00</p></div>
    
    </div>
    
    <div class="ticketFooter" style="margin-top:15px;">
        <!--                            <h4>Beyond this per hour : Rs. 20.00</h4>-->
        <div class="ticketLine"><p><b>No Horn </b></p></div>
        <div class="ticketLine"><p><b>Speed Limit : <span>10Km/Hr</span></b></div>
      
    </div>    
</div>
<!--                        <h3 class="box-title">Print Preview</h3>-->
                        <div class="box-body printTicket" id="printTicket">
                            <div style="text-align: center; ">
                                <a href="javascript:window.print()">Print</a>
                            <h2><?php echo $login_user_company_name; ?></h2>
                            <h3><?php echo $gateDetails->name; ?></h3>
                            <h3><img src="<?php echo base_url().'/barcode/'.$entryDetails->barcode.'.png';?>"</h3>
                                <h3><?php echo ($gateDetails->type == 1)?'Entry Ticket':'Exit Ticket'; ?></h3>
                            </div>
                            <div style="text-align: left;">
                           
                            <h4>Ticket Number: <span><?php echo $entryId; ?></span></h4>
                              <h4>Entry Date and Time: <span><?php echo $entryDetails->entry_time; // date("d- m- Y H : i : s", strtotime(convertTime($entryDetails->entry_time, $timeZoneName = 'IST'))); ?></span></h4>
                             <?php if($isNotExited == false) { ?>
                                    
                          
                            <h4>Exit Date and Time: <span><?php echo $entryDetails->exit_time; //  date("d- m- Y H : i : s", strtotime(convertTime($entryDetails->exit_time, $timeZoneName = 'IST'))); ?></span></h4>
                           
                                    <h4>Total Amount: <span><?php echo $entryDetails->total_amount; ?></span></h4>
                                    
                                    <?php } ?>
                            <h4>Vehicle : <span><?php echo $entryDetails->number_of_wheels; ?>W</span></h4>
                            <?php if(!empty($entryDetails->vehicle_company)) { ?><h4>Company Name: <span><?php echo $entryDetails->vehicle_company; ?></span></h4> <?php } ?>
                            <?php if(!empty($entryDetails->vehicle_number)) { ?><h4>Vehicle No: <span><?php echo $entryDetails->vehicle_number; ?></span></h4><?php } ?>
                           
                            <?php if(!empty($entryDetails->driver_name) || !empty($entryDetails->driving_license_number) || !empty($entryDetails->rc)) { ?>
                            <h3>Driver Details </h3>
                            <?php if(!empty($entryDetails->driver_name)) { ?><h4><?php echo $entryDetails->driver_name; ?></h4><?php } ?>
                            <?php if(!empty($entryDetails->driving_license_number)) { ?><h4>DL : <span><?php echo $entryDetails->driving_license_number; ?></span></h4><?php } ?>
                            <?php if(!empty($entryDetails->rc)) { ?><h4>RC : <span><?php echo $entryDetails->rc; ?></span></h4><?php } ?>
                            <?php } ?>
                             <h3>Parking Charges </h3>
    <?php
                                    
                                foreach ($vehicleTypePrices as $key => $value) {
                                        ?>
                                        <h4><?php echo $value->from_minutes; ?>-<?php echo $value->to_minutes; ?>mins : Rs. <?php echo $value->amount; ?></h4>
                                    <?php
                                  }
                                    ?>
<!--                            <h4>Beyond this per hour : Rs. <?php echo $masterPriceDetails->more_than_minutes_per_hour_amount; ?></h4>-->
                            <h3>No Horn </h3>
                            <h3>Speed Limit : <span>10Km/Hr</span></h3>
<!--                            <h3>Kastech India Pvt. Ltd. </h3>-->
                            </div>
                        </div>
                            
                    </div> 
                    
                </div>
                
                </div>
            <?php if($isNotExited == false && !$this->config->item('disable_uploadimage_exit')) {
                
                ?>
            <div class="col-md-6">
                        <div class="box box-primary">
                            <div class="box-body">

                                <div class="clearfix" >
                                    <label id="display_label">Preview Exit Number Plate</label>
                                </div>

                                <img id="display_image" src="<?php echo base_url() ?>/assets/images/upload/numberplate/exit/<?php echo $entryDetails->image_vehicle_number_plate_exit; ?>" alt="" style="width:400px">
                                <div id="display_ticket" style="width: 100%; height: 30%"></div>



                            </div>
                            <!-- <img id="preview_image_driving_license_number" src="#" alt="" style="width:auto" /> -->
                        </div>
                    </div>
            <?php 
            }
?>
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
                    
            
            <?php }else { ?>
            
            <!-- left column -->
            <form role="form" id="addEntry" action="<?php echo base_url() ?>employee/vehicle/addEntry/<?php echo $entryId; ?>" method="post" role="form" enctype="multipart/form-data">
            <div class="col-md-6">
                <!-- general form elements -->



                <div class="box box-primary">
                   
                    <!-- form start -->

                    <?php if($isNewEntry == true) { ?>
                        <div class="box-body">
                            <div class="row">
                                 
                               <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="vehicle_type_id">Vehicle Type<span class="color-red">*</span></label>
                                        <select class="form-control required" id="vehicle_type_id" name="vehicle_type_id">
                                            <option value="" >Select Vehicle Type</option>
                                            <?php
                                            
                                            if(!empty($vehicleTypeListArray))
                                            {
                                                foreach ($vehicleTypeListArray as $value)
                                                {
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
                                        <input type="text" class="form-control" id="vehicle_company" name="vehicle_company" value="New Company">
                                    </div>
                                </div>
                                 
                                
                            </div>
                            <div class="row">
                                
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="vehicle_number">Vehicle Number</label>
                                        
                    <input type="text" class="form-control <?php if(!$this->config->item('disable_mandatory_field_entry')) { ?>required <?php } ?>" id="vehicle_number" name="vehicle_number" value="">
                                    </div>
                                </div>
                                
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="image_vehicle_number_plate">Vehicle Number Plate Image<span class="color-red">*</span></label>
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
                                        <input type="file" class="form-control <?php if(!$this->config->item('disable_mandatory_field_entry')) { ?>required<?php } ?>" id="image_driving_license_number" name="image_driving_license_number" value="">
                                        
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
            <?php } ?>
        </div>    
    </section>

</div>


<script src='http://www.jqueryscript.net/demo/Print-Specified-Area-Of-A-Page-PrintArea/demo/jquery.PrintArea.js'></script>
<script type="text/javascript">
    
    function readURL(input) {

  if (input.files && input.files[0]) {
    var reader = new FileReader();

var clicked_id = $(input).attr("id");

    reader.onload = function(e) {
        // clicked_id
if(clicked_id == 'image_vehicle_number_plate'){
      $('#display_label').text('Preview Number Plate');
}else if(clicked_id == 'image_driving_license_number'){
    $('#display_label').text('Preview License Number');
}   

$('#display_image').attr('src', e.target.result);

    }

    reader.readAsDataURL(input.files[0]);
  }
}

$("#image_vehicle_number_plate,#image_driving_license_number").change(function() {
  readURL(this);
});
function printPage(){
    
     var mywindow = window.open('', 'PRINT', 'height=400,width=600');

    mywindow.document.write('<html><head><title>' + document.title  + '</title>');
    mywindow.document.write('</head><body >');
    mywindow.document.write('<h1>' + document.title  + '</h1>');
    mywindow.document.write(document.getElementById("#printTicket1").innerHTML);
    mywindow.document.write('</body></html>');

    mywindow.document.close(); // necessary for IE >= 10
    mywindow.focus(); // necessary for IE >= 10*/

    mywindow.print();
    mywindow.close();

    return true;
    
    
    
    $("#printTicket1").css("display", "block");
     var options = {mode:"popup",popHt: 500,   popWd: 400, popX: 500,   popY: 600,popTitle:"",popClose: false};
    $("#printTicket1").printArea( options ); 
    $("#printTicket1").css("display", "none");
}
</script>
<script src="<?php echo base_url(); ?>assets/js/employee/common.js" type="text/javascript"></script>