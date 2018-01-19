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
            <div class="col-md-10">
                <!-- general form elements -->



                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title"><?php echo $sub_title; ?></h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->

                    <form role="form" id="addPrice" action="<?php echo base_url() ?>admin/vehicle/addPrice" method="post" role="form">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-4">                                
                                    <div class="form-group">
                                        <label for="name">Name<span class="color-red">*</span></label>
                                        <input type="text" class="form-control required" id="name" name="name" maxlength="128">
                                    </div>

                                </div>
                                <div class="col-md-4">
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
        <div class="col-md-12">
            <div data-role="dynamic-fields">
                <div class="form-inline">
                    <div class="form-group">
                        <label class="sr-only" for="field-name">Field Name</label>
                        <input type="text" class="form-control required" id="field-name" name="from_minutes[]" placeholder="From Minutes">
                    </div>
                    <span>-</span>
                    <div class="form-group">
                        <label class="sr-only" for="field-value">Field Value</label>
                        <input type="text" class="form-control required" id="field-value" name="to_minutes[]" placeholder="To Minutes">
                    </div>
                    <div class="form-group">
                        <label class="sr-only" for="field-value">Field Value</label>
                        <input type="text" class="form-control required" id="field-value" name="amount[]" placeholder="Amount">
                    </div>
                    <button class="btn btn-danger" data-role="remove">
                        <span class="glyphicon glyphicon-remove"></span>
                    </button>
                    <button class="btn btn-primary" data-role="add">
                        <span class="glyphicon glyphicon-plus"></span>
                    </button>
                </div>  <!-- /div.form-inline -->
            </div>  <!-- /div[data-role="dynamic-fields"] -->
        <?php if($this->config->item('enable_more_than_minutes_per_hour_amount')) { ?>
            <div class="form-inline" style="padding-top: 8px;">
                    <div class="form-group">
                        <label for="status">Beyond this per hour price<span class="color-red">*</span>
                        </label> <input type="text" class="form-control required" id="more_than_minutes_per_hour_amount" name="more_than_minutes_per_hour_amount" value="">

                        
                    </div>
            </div>
        <?php } ?>    
            
        </div>  <!-- /div.col-md-12 -->
    </div>  <!-- /div.row -->



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