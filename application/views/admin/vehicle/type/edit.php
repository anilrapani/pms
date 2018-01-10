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
            <div class="col-md-10">
              <!-- general form elements -->
                
                
                
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title"><?php echo $sub_title; ?></h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    
                    <form role="form" action="<?php echo base_url() ?>admin/vehicle/edittype" method="post" id="editCompany" role="form">
                        <div class="box-body">
                              <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <input type="text" class="form-control required" id="name" name="name" maxlength="128" value="<?php echo $resultInfo->name; ?>">
                                    </div>

                                </div>
                                <div class="col-md-6">                                

                                    <div class="form-group">
                                        <label for="number_of_wheels">Number of wheels</label>
                                        <input type="text" class="form-control required" id="number_of_wheels" name="number_of_wheels" maxlength="150" value="<?php echo $resultInfo->number_of_wheels; ?>" >
                                    </div>

                                </div>
                            </div>
<!--                            
                               <div class="row">
                  
                              
                            </div>-->
                            
                            
<!--                                   <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="price_type" id="price_type" value="1" checked="">
                                                Custom Price
                                            </label>
                                        </div>


                                    </div>
                                </div>
                                <div class="col-md-6">   
                                    <div class="form-group">


                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="price_type" id="price_type" value="2">
                                                Flat Price
                                            </label>
                                        </div>


                                    </div>  
                                </div>


                            </div>-->
                            
                         
<div class="row">
    
    
                               <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="price_id">Price List</label>
                                        <select class="form-control required" id="pricePerTimeListByPriceId" name="price_id">
                                                         <option value="" >Select Price</option>
                                            <?php
                                            
                                            if(!empty($priceListArray && count($priceListArray) > 0))
                                            {
                                                foreach ($priceListArray as $value)
                                                {
                                                    ?>
                                                    <option value="<?php echo $value->id; ?>" <?php if($value->id == $resultInfo->price_id) {echo "selected=selected";} ?> ><?php echo $value->name; ?></option>
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
                                                    <option value="<?php echo $key; ?>" <?php if($key == $resultInfo->status) {echo "selected=selected";} ?> ><?php echo $value; ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                              
<!--                              <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="name">&nbsp;</label>
                                        <input type="text" class="form-control required" id="name" name="name" maxlength="128">
                                    </div>

                                </div>-->
    
        
    </div>  <!-- /div.row -->
    
    <div class="row">
                                <div class="col-md-6">
                                    <div class="box pricePerTimeList" >
                                        <!-- /.box-header -->
                                        <div class="box-body table-responsive no-padding">
                                            <table class="table table-hover">
                                                <tbody id="pricePerTimeList">
                                                    
                                                    <tr>
                                                        <th>From Time</th>
                                                        <th>To Time</th>
                                                        <th>Amount</th>
                                                    </tr>
                                                     <?php
                                            
                                            if(!empty($pricePerTimeArray && count($pricePerTimeArray) > 0))
                                            {
                                                foreach ($pricePerTimeArray as $value)
                                                {
                                                    echo "<tr>
                                                        <td>$value->from_minutes M</td>
                                                        <td>$value->to_minutes M</td>
                                                        <td>$value->amount</td>
                                                    </tr>";
                                                    ?>
                                                    
                                                    
                                                    <?php
                                                }
                                            }
                                            echo "<tr>
                                                        <td colspan=2>Beyond this per hour</td>
                                                        <td>$priceDetails->more_than_minutes_per_hour_amount</td>
                                                        
                                                    </tr>";
                                            ?>
                                                    
                                                    
                                                </tbody>
                                            </table>

                                        </div><!-- /.box-body -->

                                    </div>    
                                </div>
                                
                            </div>
                            

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


 $('#pricePerTimeListByPriceId').change(getPricePerTimeList);

    function getPricePerTimeList(){
        pricePerTimeListByPriceId = $('#pricePerTimeListByPriceId').val();
        content = '';
        console.log('t1');
        
         $.ajax({
        type: 'POST', 
    url: '<?php echo base_url() . 'admin/vehicle/getPricePerTimeList'; ?>', 
    data: { priceId : pricePerTimeListByPriceId },
    dataType: 'json',
    success: function (data) { 
        
        content += "<tr><th>From Time</th><th>To Time</th><th>Amount</th></tr>";
        
        $.each(data.pricePerTime, function(index, element) {
            content += "<tr><td>"+element.from_minutes+"</td>"+"<td>"+element.to_minutes+"</td>"+"<td>"+element.amount+"</td></tr>";
   
        });
   
        if( data.priceDetails !== null)
            content += "<tr><td colspan=2 >Beyond this per hour</td>"+"<td>"+data.priceDetails.more_than_minutes_per_hour_amount+"</td></tr>";
        
        $("#pricePerTimeList").html(content);
        
    }
    });
    }
    

</script>
<script src="<?php echo base_url(); ?>assets/js/admin/common.js" type="text/javascript"></script>