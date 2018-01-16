<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> User Management
        <small>Add / Edit User</small>
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
            <div class="col-md-8">
              <!-- general form elements -->
                
                
                
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Enter User Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    
                    <form role="form" id="addUser" action="<?php echo base_url() ?>addNewUser" method="post" role="form">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="fname">Full Name</label>
                                        <input type="text" class="form-control required" id="fname" name="fname" maxlength="128">
                                    </div>
                                    
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email address</label>
                                        <input type="text" class="form-control required email" id="email"  name="email" maxlength="128">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control required" id="password"  name="password" maxlength="10">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="cpassword">Confirm Password</label>
                                        <input type="password" class="form-control required equalTo" id="cpassword" name="cpassword" maxlength="10">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="mobile">Mobile Number</label>
                                        <input type="text" class="form-control required digits" id="mobile" name="mobile" maxlength="10">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="role">Role</label>
                                        <select class="form-control required" id="role" name="role">
                                            <option value="0">Select Role</option>
                                            <?php
                                            if(!empty($roles))
                                            {
                                                foreach ($roles as $rl)
                                                {
                                                    ?>
                                                    <option value="<?php echo $rl->id ?>"><?php echo $rl->name ?></option>
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
                                        <label for="government_proof_type_id">Govt Proof Type</label>
                                        <select class="form-control required" id="government_proof_type_id" name="government_proof_type_id">
                                            <option value="0">Select Govt Proof Type</option>
                                            <?php
                                            if(!empty($governmentProofTypes))
                                            {
                                                foreach ($governmentProofTypes as $rl)
                                                {
                                                    ?>
                                                    <option value="<?php echo $rl->id ?>"><?php echo $rl->name ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>    
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="government_id_number">Government Id Number</label>
                                        <input type="text" class="form-control required digits" id="government_id_number" name="government_id_number" maxlength="10">
                                    </div>
                                </div>
                              
                            </div>
                            
                            
                             <div class="row">
                                  <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="user_company_id">Employee Company</label>
                                        <select class="form-control required" id="user_company_id" name="user_company_id">
                                            <option value="0">Select Employee Company</option>
                                            <?php
                                            if(!empty($employeeCompanies))
                                            {
                                                foreach ($employeeCompanies as $rl)
                                                {
                                                    ?>
                                                    <option value="<?php echo $rl->id ?>"><?php echo $rl->name ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>    
                                  <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="shift_id">Employee Shift</label>
                                        <select class="form-control required" id="shift_id" name="shift_id">
                                            <option value="0">Select Employee Shift</option>
                                            <?php
                                            if(!empty($employeeShifts))
                                            {
                                                foreach ($employeeShifts as $rl)
                                                {
                                           ?>
                                                    <option value="<?php echo $rl->id ?>"  ><?php echo $rl->name.' : '.$rl->start_time.' - '.$rl->end_time ?></option>
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
                                                                                <option value="<?php echo $key; ?>" ><?php echo $value; ?></option>
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
            
        </div>    
    </section>
    
</div>
<script src="<?php echo base_url(); ?>assets/js/addUser.js" type="text/javascript"></script>