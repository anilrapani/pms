<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> <?php echo $title; ?>
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
                        <h3 class="box-title"><?php echo $sub_title; ?></h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    
                    <form role="form" action="<?php echo base_url() ?>admin/employee/editcompany" method="post" id="editCompany" role="form">
                        <div class="box-body">
                              <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control required" id="name" name="name" maxlength="128" value="<?php echo $companyInfo->name; ?>">
                                    </div>

                                </div>
                                <div class="col-md-6">                                

                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="text" class="form-control required" id="email" name="email" maxlength="150" value="<?php echo $companyInfo->email; ?>" >
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="phone">Phone</label>
                                        <input type="text" class="form-control required" id="phone" name="phone" maxlength="10" value="<?php echo $companyInfo->phone; ?>">
                                    </div>

                                </div>
                                <div class="col-md-6">                                

                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <textarea class="form-control" name="address" ><?php echo $companyInfo->address; ?></textarea>

                                    </div>
                                </div>

                            </div>

                              <input type="hidden" value="<?php echo $companyInfo->id; ?>" name="id" id="id" />    
                            
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

<script src="<?php echo base_url(); ?>assets/js/employee/company.js" type="text/javascript"></script>