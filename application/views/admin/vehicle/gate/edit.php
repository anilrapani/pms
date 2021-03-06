<style type="text/css">
    [data-role="dynamic-fields"] > .form-inline + .form-inline {
    margin-top: 0.5em;
}

[data-role="dynamic-fields"] > .form-inline [data-role="add"] {
    display: none;
}

[data-role="dynamic-fields"] > .form-inline:last-child [data-role="add"] {
    display: inline-block;
}

[data-role="dynamic-fields"] > .form-inline:last-child [data-role="remove"] {
    display: none;
}
</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
         <?php echo $title; ?>
      </h1>
    </section>
    
    <section class="content">
        <div class="row">
            <div class="col-md-4">
                <?php
                    $this->load->helper('form');
                    $error = $this->session->flashdata('error');
                    if($error)
                    {
                ?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('error'); ?>                    
                </div>
                <?php } ?>
                <?php  
                    $success = $this->session->flashdata('success');
                    if($success)
                    {
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
            <div class="col-md-10">
              <!-- general form elements -->
                
                
                
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title"><?php echo $sub_title; ?></h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    
                    <form role="form" action="<?php echo base_url() ?>admin/vehicle/editgate" method="post" id="editGate" role="form" >
                        <div class="box-body">
                              <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="name">Name<span class="color-red">*</span></label>
                                        <input type="text" class="form-control required" id="name" name="name" maxlength="128" value="<?php echo $resultInfo->name; ?>">
                                    </div>

                                </div>
                                     <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="type">Type<span class="color-red">*</span></label>
                                        <select class="form-control required" id="type" name="type">
                                            <option value="">Select Type</option>
                                            <?php
                                            $gate_type_array = json_decode(GATE_TYPE_ARRAY,TRUE);
                                            if(!empty($gate_type_array))
                                            {
                                                foreach ($gate_type_array as $key => $value)
                                                {
                                                    ?>
                                                    <option value="<?php echo $key; ?>" <?php if($key == $resultInfo->type) {echo "selected=selected";} ?> ><?php echo $value; ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                
                            </div>
                            
                            
                            <div class="row">
                             
                                  <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select class="form-control required" id="status" name="status">
                                            <?php
                                            $status_array = json_decode(STATUS_ARRAY,true);
                                            if(!empty($status_array))
                                            {
                                                foreach ($status_array as $key => $value)
                                                {
                                                    ?>
                                                    <option value="<?php echo $key; ?>" <?php if($key == $resultInfo->status) {echo "selected=selected";} ?> ><?php echo $value; ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
        <div class="col-md-12">
            <div data-role="dynamic-fields">
                     <?php foreach ($userListAtGateArray as $userListAtGate) {
                        ?>
                <div class="form-inline">
                   
                        
                    <div class="form-group">
                        <label class="sr-only" for="field-name">Select Employee</label>
                        
                               <select class="form-control required" id="user_id" name="user_id[]">
                                   
                                            <option value='0' <?php if($userListAtGate->user_id == 0) echo "selected=selected"; ?> >All Users</option>
                                   
                                            <?php
                                            
                                            if(!empty($userListArray))
                                            {
                                                foreach ($userListArray as $user)
                                                {
                                                    ?>
                                                    <option value="<?php echo $user->id; ?>" <?php if($userListAtGate->user_id == $user->id) echo "selected=selected"; ?> ><?php echo $user->name.' - '.$user->id; ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                        
                    </div>
                      <div class="form-group">
                        <label class="sr-only" for="field-value">Select Shift</label>
                                 <select class="form-control required" id="shift_id" name="shift_id[]">
                                            <option value='0' >All Shifts</option>
                                            <?php
                                            
                                            if(!empty($shiftListArray))
                                            {
                                                foreach ($shiftListArray as $shift)
                                                {
                                                    ?>
                                                    
                                                    <option value="<?php echo $shift->id; ?>" <?php if($userListAtGate->shift_id == $shift->id) echo "selected=selected"; ?> ><?php echo $shift->name.' : '.$shift->start_time.' - '.$shift->end_time; ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                        
                    </div>
                                       
                    
<!--                     <div class="form-group">
                        <label class="sr-only" for="field-name">Field Name</label>
                        <input type="text" class="form-control required timepicker3" id="field-name" name="from_time[]" placeholder="From Time - 00:00:00" value="<?php echo $userListAtGate->from_time; ?>" >
                    </div>
                    <span>-</span>
                    <div class="form-group">
                        <label class="sr-only" for="field-value">Field Value</label>
                        <input type="text" class="form-control required timepicker3" id="field-value" name="to_time[]" placeholder="To Time - 00:00:00" value="<?php echo $userListAtGate->to_time; ?>" >
                    </div>-->
                    
                    
<!--                    <div class="form-group">
                        <label class="sr-only" for="field-name">Select Device</label>
                        
                               <select class="form-control required" id="device_registry_id" name="device_registry_id[]">
                                            <option value='0' <?php if($userListAtGate->device_registry_id == 0) echo "selected=selected"; ?> >All Devices</option>
                                            <?php
                                            
                                            if(!empty($deviceRegistryListArray))
                                            {
                                                foreach ($deviceRegistryListArray as $device)
                                                {
                                                    ?>
                                                    <option value="<?php echo $device->id; ?>" <?php if($userListAtGate->device_registry_id == $device->id) echo "selected=selected"; ?> ><?php echo $device->name.' - '.$device->ipaddress; ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                        
                        
                      </div>-->
                    <button class="btn btn-danger" data-role="remove">
                        <span class="glyphicon glyphicon-minus"></span>
                    </button>
                    <button class="btn btn-primary" data-role="add">
                        <span class="glyphicon glyphicon-plus"></span>
                    </button>
                </div>  <!-- /div.form-inline -->
                   <?php
                      }
                       if(count($userListAtGateArray) == 0 ){
                          ?>
                 <div class="form-inline">
                   
                        
                    <div class="form-group">
                        <label class="sr-only" for="field-name">Select Employee</label>
                        
                               <select class="form-control required" id="user_id" name="user_id[]">
                                            <option value='0' >All Users</option>
                                            <?php
                                            
                                            if(!empty($userListArray))
                                            {
                                                foreach ($userListArray as $user)
                                                {
                                                    ?>
                                                    <option value="<?php echo $user->id; ?>" ><?php echo $user->name.' - '.$user->id; ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                        
                    </div>
<!--                    
                     <div class="form-group">
                        <label class="sr-only" for="field-name">Field Name</label>
                        <input type="text" class="form-control required timepicker3" id="field-name" name="from_time[]" placeholder="From Time - 00:00:00">
                    </div>
                    <span>-</span>
                    <div class="form-group">
                        <label class="sr-only" for="field-value">Field Value</label>
                        <input type="text" class="form-control required timepicker3" id="field-value" name="to_time[]" placeholder="To Time - 00:00:00">
                    </div>-->
                     <div class="form-group">
                        <label class="sr-only" for="field-value">Select Shift</label>
                                 <select class="form-control required" id="shift_id" name="shift_id[]">
                                            <option value='0' >All Shifts</option>
                                            <?php
                                            
                                            if(!empty($shiftListArray))
                                            {
                                                foreach ($shiftListArray as $shift)
                                                {
                                                    ?>
                                                    
                                                    <option value="<?php echo $shift->id; ?>"  ><?php echo $shift->name.' : '.$shift->start_time.' - '.$shift->end_time; ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                        
                    </div>
<!--                    <div class="form-group">
                        <label class="sr-only" for="field-name">Select Device</label>
                        
                               <select class="form-control required" id="device_registry_id" name="device_registry_id[]">
                                            <option value='0' >All Devices</option>
                                            <?php
                                            
                                            if(!empty($deviceRegistryListArray))
                                            {
                                                foreach ($deviceRegistryListArray as $device)
                                                {
                                                    ?>
                                                    <option value="<?php echo $device->id; ?>" ><?php echo $device->name.' - '.$device->ipaddress; ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                        
                        
                      </div>-->
                    <button class="btn btn-danger" data-role="remove">
                        <span class="glyphicon glyphicon-remove"></span>
                    </button>
                    <button class="btn btn-primary" data-role="add">
                        <span class="glyphicon glyphicon-plus"></span>
                    </button>
                </div>  <!-- /div.form-inline -->
                <?php
                      }
                                                            
                ?>
                
            </div>  <!-- /div[data-role="dynamic-fields"] -->
        </div>  <!-- /div.col-md-12 -->




                        </div><!-- /.box-body -->
                              
                            

                              <input type="hidden" value="<?php echo $resultInfo->id; ?>" name="id" id="id" />    
                            
                        </div><!-- /.box-body -->
    
                        <div class="box-footer">
                            <input type="submit" class="btn btn-primary" value="Submit" />
                            <input type="reset" class="btn btn-default" value="Reset" />
                        </div>
                    </form>
                </div>
            </div>
            
        </div>    
    </section>
</div>
<script type="text/javascript">
    $(function() {
    // Remove button click
    $(document).on(
        'click',
        '[data-role="dynamic-fields"] > .form-inline [data-role="remove"]',
        function(e) {
            e.preventDefault();
            $(this).closest('.form-inline').remove();
        }
    );
    // Add button click
    $(document).on(
        'click',
        '[data-role="dynamic-fields"] > .form-inline [data-role="add"]',
        function(e) {
            e.preventDefault();
            var container = $(this).closest('[data-role="dynamic-fields"]');
            new_field_group = container.children().filter('.form-inline:first-child').clone();
            new_field_group.find('input').each(function(){
                $(this).val('');
            });
            container.append(new_field_group);
        }
    );
    
  
});

</script>
<script src="<?php echo base_url(); ?>assets/js/admin/common.js" type="text/javascript"></script>