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
</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="box-header col-md-6">
            <h1 class="box-title"><i class="fa "></i> <?php echo ($isNewEntry == true)?'New ':''; echo $title.' : '.$entryId; ?></h1>
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



                <div class="box box-primary ">
                    <div class="box-header">
                        <h3 class="box-title"><?php echo $sub_title.' No : '.$entryId; ?></h3> <?php if($isNewEntry == false) {?><input type="submit" class="btn btn-primary float-right" style="float:right;"value="Print"><?php } ?>
                        <br>
                        <br> 
<!--                        <h3 class="box-title">Print Preview</h3>-->
                        <div class="box-body printTicket" >
                            <div style="text-align: center; ">
                            <h2>Employee Company</h2>
                            <h3>Cargo Terminal 1?</h3>
                            <h3>Bangalore International Airport?</h3>
                            <h3>Entry Ticket</h3>
                            <h3><img src="<?php echo base_url().'/barcode/'.$entryDetails->barcode.'.png';?>"</h3>
                            
                            </div>
                            <div style="text-align: left;">
                           
                            
                            
                            <h4>Ticket Number: <span><?php echo $entryId; ?></span></h4>
                            <h4>Entry Date : <span><?php echo date("d- m- Y", strtotime(convertTime($entryDetails->entry_time, $timeZoneName ='')));  ?></span></h4>
                            <h4>Entry Time: <span><?php echo date("H : i : s", strtotime(convertTime($entryDetails->entry_time, $timeZoneName =''))); ?></span></h4>
                            <h4>Vehicle : <span><?php echo $entryDetails->number_of_wheels; ?>W</span></h4>
                            <h4>Company Name: <span><?php echo $entryDetails->vehicle_company; ?></span></h4>
                            <h4>Vehicle No: <span><?php echo $entryDetails->vehicle_number; ?></span></h4>
                           
                            <h3>Driver Details </h3>
                            <h4><?php echo $entryDetails->driver_name; ?></h4>
                            <h4>DL : <span><?php echo $entryDetails->driving_license_number; ?></span></h4>
                            <h4>RC : <span><?php echo $entryDetails->rc?></span></h4>
                            
                             <h3>Parking Charges </h3>
    <?php
                                    
                                foreach ($vehicleTypePrices as $key => $value) {
                                        ?>
                                        <h4><?php echo $value->from_minutes; ?>-<?php echo $value->to_minutes; ?>mins : Rs. <?php echo $value->amount; ?></h4>
                                    <?php
                                  }
                                    ?>
                             
                            <h3>No Horn </h3>
                            <h3>Speed Limit : <span>10Km/Hr</span></h3>
                            <h3>Kastech India Pvt. Ltd. </h3>
                            </div>
                        </div>
                            
                    </div> 
                    
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
                                        <label for="vehicle_type_id">Vehicle Type</label>
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
            <?php } ?>
        </div>    
    </section>

</div>
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
</script>
<script src="<?php echo base_url(); ?>assets/js/employee/common.js" type="text/javascript"></script>