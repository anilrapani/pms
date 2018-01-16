<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-users"></i> <?php echo $title; ?>
            <small></small>
        </h1>
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
            <div class="col-md-8">
                <!-- general form elements -->



                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title"><?php echo $sub_title; ?></h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->

                    <form role="form" id="addCompany" action="<?php echo base_url() ?>admin/employee/addRole" method="post" role="form">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control required" id="name" name="name" maxlength="128">
                                    </div>

                                </div>
                                
                            </div>
                            <div class="row">
                                <div class="col-md-6">    
                                    <div class="form-group">
                                        <?php 
                                        $role_privileges_array = json_decode(ROLE_PRIVILEGES_ARRAY,true);
                                            
                                        foreach ($role_privileges_array as $key => $value) {
                                    ?>  
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="privilege[<?php echo $key; ?>]">
                                                <?php echo "$value"; ?>
                                            </label>
                                        </div>    
                                <?php }?>
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
<script src="<?php echo base_url(); ?>assets/js/admin/common.js" type="text/javascript"></script>
<script type="text/javascript">
//    $(function () {
//        $('input[type="checkbox"].minimal').iCheck({
//          checkboxClass: 'icheckbox_minimal-blue'
//        });
//    });
</script>    