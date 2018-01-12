<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> <?php echo $title; ?>
        <small> </small>
      </h1>
    </section>
    <section class="content">
        <div class="row ">
            <form role="form" action="<?php echo base_url() ?>admin/reports/tariffsummary/list" method="get" role="form">
                
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="status">Select Vehicle Type</label>
                        <select class="form-control required" id="vehicle_type_id" name="vehicle_type_id">
                            <option value="">Select Vehicle Type</option>
                            <?php
                            if (!empty($vehicleTypeListArray)) {
                                foreach ($vehicleTypeListArray as $value) {
                                    ?>

                                    <option value="<?php echo $value->id; ?>" <?php if ($value->id == $vehicle_type_id) {
                                echo "selected=selected";
                            } ?> ><?php echo $value->name; ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>


                <div class="col-md-2">
                    <div class="form-group">
                        <label for="status">Select Gate</label>
                        <select class="form-control required" id="gate_id" name="gate_id">
                            <option value="">Select Gate</option>
                            <?php
                            if (!empty($gateListArray)) {
                                foreach ($gateListArray as $value) {
                                    ?>

                                    <option value="<?php echo $value->id; ?>" <?php if ($value->id == $gate_id) {
                                echo "selected=selected";
                            } ?> ><?php echo $value->name; ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>


                <div class="col-xs-2">

                    <div class="form-group">
                        <label for="role">From Date</label>
                        <div class="input-group date" data-provide="datepicker">
                            <input type="text" class="form-control" name="from_date" value="<?php echo $from_date; ?>">
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="col-xs-2">

                    <div class="form-group">
                        <label for="role">From Time(hh:mm:ss)</label>
                            <input type="text" class="form-control" name="from_time" value="<?php echo $from_time; ?>" >
                    </div>


                </div>

                <div class="col-xs-2">

                    <div class="form-group">
                        <label for="role">To Date</label>
                        <div class="input-group date" data-provide="datepicker">
                            <input type="text" class="form-control" name="to_date" value="<?php echo $to_date; ?>">
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </div>
                        </div>
                    </div>


                </div>

                <div class="col-xs-2">

                    <div class="form-group">
                        <label for="role">To Time(hh:mm:ss)</label>
                            <input type="text" class="form-control" name="to_time" value="<?php echo $to_time; ?>" >
                    </div>


                </div>
                <div class="col-xs-2">
                    <div class="form-group">
                        <label for="role">&nbsp;</label>
                        <div class="input-group" >
                            <input type="submit" class="btn btn-primary" value="Submit">
                        </div>
                    </div>


                </div>      
            </form>         
               <div class="col-xs-2 pull-right">
                    <div class="form-group">
                        <label for="role">&nbsp;</label>
                        <div class="input-group" >
                            <input type="submit" id="download" class="btn btn-primary" value="Download">
                        </div>
                    </div>


                </div>      
        </div>
            
          
        
        
        
        
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
  
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tr>
                      <th>Parking Amount</th>
                      <th>Vehicles Exited</th>
                      <th>Total Amount</th>
                    </tr>
                    <?php
                    if(!empty($records))
                    {
                        foreach($records as $record)
                        {
                           
                    ?>
                    <tr>
                      <td><?php echo $record->amount; ?></td>
                      <td><?php echo $record->total_vehicles_exited; ?></td>
                      <td><?php echo $record->total_amount; ?></td>
                    
                    </tr>
                    <?php
                        }
                    }
                    ?>
                  </table>
                  
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                    <?php echo $this->pagination->create_links(); ?>
                </div>
                
                
              </div><!-- /.box -->
            </div>
        </div>
        <div class="row ">
            <div class="col-md-6 pull-right">
                                    <div class="box pricePerTimeList">
                                        <!-- /.box-header -->
                                        <div class="box-body table-responsive no-padding">
                                            <table class="table table-hover">
                                                <tbody id="pricePerTimeList">
                                                    
                                                    <tr>
                                                        
                                                        <th>Total No Of Vehicles</th>
                                                        <th>Total Amount</th>
                                                    </tr>
                                                    
                                                    <tr>
                                                        <td><?php echo $final_total_vehicles_exited; ?></td>
                                                        <td><?php echo $final_total_amount; ?></td>
                                                    </tr>
                                                                                                    
                                                    
                                                </tbody>
                                            </table>

                                        </div><!-- /.box-body -->

                                    </div>    
                                </div>
        </div>
    </section>
</div>
<script type="text/javascript">
    deleteUrl = "admin/vehicle/deleteType";
    $( document ).ready(function() {
     //   $(document).off('.datepicker.data-api');
     $.fn.datepicker.defaults.format = "yyyy-mm-dd";
$('.datepicker').datepicker({
      
    // startDate: '-3d'
});


  $( "#download" ).click( function(){
      
window.location="<?php $params   = $_SERVER['QUERY_STRING'];


$fullURL = current_url() . '?' . $params.'&download=true'; echo $fullURL; //current_url(); //base_url().uri_string()?>";


  });

});
   
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/admin/common.js" charset="utf-8"></script>
