<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
<!--        <h1>
            <i class="fa fa-users"></i> <?php echo $title; ?>
            <small></small>
        </h1>-->
    </section>

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
            <!-- left column -->
            <form role="form" id="addEntry" action="<?php echo base_url() ?>employee/vehicle/addEntry" method="post" role="form" enctype="multipart/form-data">
            <div class="col-md-6">
                <!-- general form elements -->



                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title"><?php echo $sub_title; ?></h3>
                        <h3 class="box-title"><?php echo $sub_title; ?></h3>
                    </div> 
                    <!-- form start -->

                    
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
                                        <input type="text" class="form-control required" id="vehicle_company" name="vehicle_company" value="">
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
                                        <input type="text" class="form-control required" id="driving_license_number" name="driving_license_number" value="">
                                    </div>
                                </div>
                                
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="image_driving_license_number">Driving License Number</label>
                                        <input type="file" class="form-control required" id="image_driving_license_number" name="image_driving_license_number" value="">
                                        
                                    </div>
                                </div>
                            </div>
                            



                        </div><!-- /.box-body -->

                        <div class="box-footer">
                            <input type="submit" class="btn btn-primary" value="Submit" />
                            <input type="reset" class="btn btn-default" value="Reset" />
                        </div>
                    
                </div>
            </div>
                <div class="col-md-6">
                    <div class="box box-primary">
                        <div class="box-body">
                        <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="image_vehicle_number_plate">Preview number plate</label>
                                         <img id="preview_image_vehicle_number_plate" src="" alt="" style="width:500px" />
                                    </div>
                                </div>
                        </div>
                        <!-- <img id="preview_image_driving_license_number" src="#" alt="" style="width:auto" /> -->
                    </div>
                </div>
         </form>       
        </div>    
    </section>

</div>
<script type="text/javascript">
    function readURL(input) {

  if (input.files && input.files[0]) {
    var reader = new FileReader();

var clicked_id = $(input).attr("id");
    reader.onload = function(e) {
      $('#preview_'+clicked_id).attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
  }
}

$("#image_vehicle_number_plate,#image_driving_license_number").change(function() {
  readURL(this);
});
</script>
<script src="<?php echo base_url(); ?>assets/js/admin/common.js" type="text/javascript"></script>