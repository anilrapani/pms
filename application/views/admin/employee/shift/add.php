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

                    <form role="form" id="addGovtProofType" action="<?php echo base_url() ?>admin/employee/addShift" method="post" role="form">
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
                            <div class="row">
                                <div class="col-md-6 bootstrap-timepicker">                                
                                    <div class="form-group">
                                        <label for="start time">Start Time (HH:MM:SS)</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control required timepicker" id="start_time" name="start_time"  placeholder="HH:MM:SS" >
                                            <div class="input-group-addon">
                                                <i class="fa fa-clock-o"></i>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="col-md-6 bootstrap-timepicker">                                
                                    <div class="form-group">
                                        <label for="end time">End Time (HH:MM:SS)</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control required timepicker" id="end_time" name="end_time" placeholder="HH:MM:SS" >
                                            <div class="input-group-addon">
                                                <i class="fa fa-clock-o"></i>
                                            </div>
                                        </div>
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
<script type="text/javascript">
//    $(document).ready(function () {
//        $('.timepicker').timepicker({
//        });
//    });
</script>
    
<script src="<?php echo base_url(); ?>assets/js/admin/common.js" type="text/javascript"></script>