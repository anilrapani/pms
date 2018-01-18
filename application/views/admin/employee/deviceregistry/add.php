<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?php echo $title; ?>
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

                    <form role="form" id="addCompany" action="<?php echo base_url() ?>admin/employee/addDeviceRegistry" method="post" role="form">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control required" id="name" name="name" maxlength="128">
                                    </div>

                                </div>
                                 <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="ipaddress">Ip Address</label>
                                        <input type="text" class="form-control required" id="ipaddress" name="ipaddress" maxlength="128">
                                    </div>

                                </div>
                             </div>
                            <div class="row">
                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="type">Belongs to user</label>
                                        <select class="form-control required" id="user_id" name="user_id">
                                            <option value='' >Select User</option>
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