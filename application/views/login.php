<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>PMS | Admin System Log in</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <style type="text/css">
        .error{
            color : red;
            font-weight: normal;
        }
    </style>
    <script src="<?php echo base_url(); ?>assets/js/jQuery-2.1.4.min.js"></script>
  </head>
  <body class="login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href="#"><b>PMS</b></a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Login</p>
        <?php $this->load->helper('form'); ?>
        <div class="row">
            <div class="col-md-12">
                <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
            </div>
        </div>
        <?php
        $this->load->helper('form');
        $error = $this->session->flashdata('error');
        if($error)
        {
            ?>
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $error; ?>                    
            </div>
        <?php }
        $success = $this->session->flashdata('success');
        if($success)
        {
            ?>
            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $success; ?>                    
            </div>
        <?php } ?>
        
        <form action="<?php echo base_url(); ?>loginMe" method="post" id="login">
          <div class="form-group has-feedback">
<!--            <input type="email" class="form-control" placeholder="Email" name="email" required />-->
              <input type="text" class="form-control required" placeholder="User Name" name="user_name" id="user_name"  />
<!--            <span class="glyphicon glyphicon-user-circle form-control-feedback"></span>-->
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control required" placeholder="Password" name="password" />
<!--            <span class="glyphicon glyphicon-lock form-control-feedback"></span>-->
          </div>
         <div class="form-group has-feedback" id="gate_id_details">
               
               <select name="gate_id" class="form-control required">
                   <option value="">Select Gate</option>
                   <?php foreach($gatesList as $gate){
                       ?>
                   <option value="<?php echo $gate->id; ?>" ><?php echo $gate->name; ?></option>
                   <?php
                   } ?>
               </select>
               
          </div>  
          <div class="row">
            <div class="col-xs-8">    
              <!-- <div class="checkbox icheck">
                <label>
                  <input type="checkbox"> Remember Me
                </label>
              </div>  -->                       
            </div><!-- /.col -->
            <div class="col-xs-4">
              <input type="submit" class="btn btn-primary btn-block btn-flat" value="Sign In" />
            </div><!-- /.col -->
          </div>
        </form>

<!--        <a href="<?php echo base_url() ?>forgotPassword">Forgot Password</a><br>-->
<!--        <a href="<?php echo base_url() ?>registerNow">Not yet registered?</a><br>-->
        
      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->
    
    <script src="<?php echo base_url(); ?>assets/js/login.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.validate.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/js/validation.js" type="text/javascript"></script>
    <?php if($this->config->item('enable_admin_no_gate_restriction')) { ?>
    <script>
     /*   $( "#user_name" ).keyup(function() {
            if($.trim($( "#user_name" ).val()).toLowerCase() == "admin"){
                $( "#gate_id_details" ).css("display","none");
            }else{
                $( "#gate_id_details" ).css("display","block");
            }
        });
        */
    </script>
    <?php } ?>
    
  </body>
</html>