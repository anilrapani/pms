<?php

$userId = '';
$name = '';
$email = '';
$mobile = '';
$roleId = '';
$government_proof_type_id = '';
$government_id_number = '';
$user_company_id = '';
$shift_id = '';
$status = '';
$user_name = '';

if(!empty($userInfo))
{
    foreach ($userInfo as $uf)
    {
        $userId = $uf->id;
        $name = $uf->name;
        $email = $uf->email;
        $mobile = $uf->mobile;
        $roleId = $uf->role_id;
        
        $government_proof_type_id = $uf->government_proof_type_id;
        $government_id_number = $uf->government_id_number;
        $user_company_id = $uf->user_company_id;
        $shift_id = $uf->shift_id;
        $status = $uf->status;
        $user_name = $uf->user_name;
    }
}


?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
         User Management
        <small>Add / Edit User</small>
      </h1>
    </section>
    
    <section class="content">
    
        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
              <!-- general form elements -->
                
                
                
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Enter User Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    
                    <form role="form" action="<?php echo base_url() ?>editUser" method="post" id="user" role="form">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="fname">Full Name<span class="color-red">*</span></label>
                                        <input type="text" class="form-control" id="fname" placeholder="Full Name" name="fname" value="<?php echo $name; ?>" maxlength="128">
                                        <input type="hidden" value="<?php echo $userId; ?>" name="userId" id="userId" />    
                                    </div>
                                    
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email address<span class="color-red">*</span></label>
                                        <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" value="<?php echo $email; ?>" maxlength="128">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password">Password<span class="color-red">*</span></label>
                                        <input type="password" class="form-control" id="password" placeholder="Password" name="password" maxlength="10">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="cpassword">Confirm Password<span class="color-red">*</span></label>
                                        <input type="password" class="form-control" id="cpassword" placeholder="Confirm Password" name="cpassword" maxlength="10">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="mobile">Mobile Number<span class="color-red">*</span></label>
                                        <input type="text" class="form-control" id="mobile" placeholder="Mobile Number" name="mobile" value="<?php echo $mobile; ?>" maxlength="10">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="role">Role<span class="color-red">*</span></label>
                                        <select class="form-control" id="role" name="role">
                                            <option value="0">Select Role</option>
                                            <?php
                                            if(!empty($roles))
                                            {
                                                foreach ($roles as $rl)
                                                {
                                                    ?>
                                                    <option value="<?php echo $rl->id; ?>" <?php if($rl->id == $roleId) {echo "selected=selected";} ?>><?php echo $rl->name ?></option>
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
                                        <label for="government_proof_type_id">Govt Proof Type<span class="color-red">*</span></label>
                                        <select class="form-control required" id="government_proof_type_id" name="government_proof_type_id">
                                            <option value="0">Select Govt Proof Type</option>
                                            <?php
                                            if(!empty($governmentProofTypes))
                                            {
                                                foreach ($governmentProofTypes as $rl)
                                                {
                                                    ?>
                                                    <option value="<?php echo $rl->id ?>" <?php if($rl->id == $government_proof_type_id) {echo "selected=selected";} ?> ><?php echo $rl->name ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>    
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="government_id_number">Government Id Number<span class="color-red">*</span></label>
                                        <input type="text" class="form-control required digits" id="government_id_number" name="government_id_number" maxlength="10" value="<?php echo $government_id_number; ?>">
                                    </div>
                                </div>
                              
                            </div>
                            
                            
                             <div class="row">
                                  <div class="col-md-6" style="display: none;">
                                    <div class="form-group">
                                        <label for="user_company_id">Employee Company<span class="color-red">*</span></label>
                                        <select class="form-control required" id="user_company_id" name="user_company_id">
                                            <option value="0">Select Employee Company</option>
                                            <?php
                                            if(!empty($employeeCompanies))
                                            {
                                                foreach ($employeeCompanies as $rl)
                                                {
                                                    ?>
                                                    <option value="<?php echo $rl->id ?>" <?php if($rl->id == $user_company_id) {echo "selected=selected";} ?> ><?php echo $rl->name ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>    
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
                                                    <option value="<?php echo $key; ?>" <?php if($key == $status) {echo "selected=selected";} ?> ><?php echo $value; ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                      <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="user_name">User Name<span class="color-red">*</span></label>
                                        <input type="text" class="form-control required user_name" id="user_name" name="user_name" value="<?php echo $user_name; ?>">
                                    </div>
                                </div>
                              
                              
                            </div>
                            <div class="row">
                                    <div class="col-md-6" style="display: none;">
                                      
                                    <div class="form-group">
                                        <label for="shift_id">Employee Shift<span class="color-red">*</span></label>
                                        <select class="form-control required" id="shift_id" name="shift_id">
                                            <option value="0">Select Employee Shift</option>
                                            <?php
                                            if(!empty($employeeShifts))
                                            {
                                                foreach ($employeeShifts as $rl)
                                                {
                                                    ?>
                                                    <option value="<?php echo $rl->id ?>" <?php if($rl->id == $shift_id) {echo "selected=selected";} ?> ><?php echo $rl->name.' : '.$rl->start_time.' - '.$rl->end_time ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>  
                            
                            </div>
                        </div><!-- /.box-body -->
    
                        <div class="box-footer">
                            <input type="submit" class="btn btn-primary" value="Submit" />
                            <input type="reset" class="btn btn-default" value="Reset" />
                        </div>
                    </form>
                </div>
            </div>
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
    </section>
</div>

<script src="<?php echo base_url(); ?>assets/js/admin/edit_user.js" type="text/javascript"></script>