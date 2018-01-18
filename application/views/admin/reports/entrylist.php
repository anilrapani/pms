<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
         <?php echo $title; ?>
        <small> </small>
      </h1>
    </section>
    <section class="content">
        <div class="row ">
            <form role="form" action="<?php echo base_url() ?>admin/reports/entry/list" method="get" role="form">
                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="vehicle_type_id">Vehicle Type</label>
                                        <select class="form-control required" id="vehicle_type_id" name="vehicle_type_id">
                                            <option value="" >Select Vehicle Type</option>
                                            <?php
                                            
                                            if(!empty($vehicleTypeListArray))
                                            {
                                                foreach ($vehicleTypeListArray as $value)
                                                {
                                                    ?>
                                                    <option value="<?php echo $value->id; ?>" <?php if($value->id == $vehicle_type_id) {echo "selected=selected";} ?> ><?php echo $value->name; ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                <div class="col-xs-2">

                    <div class="form-group">
                        <label for="role">Date</label>
                        <div class="input-group date" data-provide="datepicker">
                            <input type="text" class="form-control" name="entryDate" value="<?php echo $entryDate; ?>">
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </div>
                        </div>
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
                            <button type="submit" id="download" class="btn btn-primary pull-right" style="margin-right: 5px;">
                                <i class="fa fa-download"></i> Download
                            </button>
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
                      <th>Ticket No.</th>
                      <th>Entry Date & Time</th>
                      <th>Vehicle No.</th>
                      <th>Vehicle Type</th>
                      <th>Company Name</th>
                      <th>Gate Name</th>
                      <th class="text-center">Actions</th>
                    </tr>
                    <?php
                    if(!empty($records))
                    {
                        foreach($records as $record)
                        {
                           
                    ?>
                    <tr>
                      <td><?php echo $record->ticket_no; ?></td>
                      <td><?php echo $record->entry_time; ?></td>
                      <td><?php echo $record->vehicle_number; ?></td>
                      <td><?php echo $record->vehicle_type_name; ?></td>
                      <td><?php echo $record->vehicle_company; ?></td>
                      <td><?php echo $record->gate_entry_name; ?></td>
                      
                      
                      <td class="text-center">
                          <a class="btn btn-sm btn-info" href="<?php echo base_url().'employee/vehicle/exitdetails/'.$record->barcode; ?>"><i class="fa fa-location-arrow"></i></a>
                         <!-- <a class="btn btn-sm btn-danger deleteType" href="#" data-id="<?php echo $record->id; ?>"><i class="fa fa-trash"></i></a> -->
                      </td>
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
                                                        <th>Vehicle Type </th>
                                                        <th>No Of Vehicles</th>
                                                    </tr>
                                                    
                                                    <?php 
                                                    $totalVehiclesCount = 0;
                                                    foreach ($entryListSummaryByVehicleType as $key => $value) {
                                                                            ?>
                                                     <tr>
                                                        <td><?php echo $value->vehicle_type_name; ?></td>
                                                        <td><?php echo $value->type_count; ?></td>
                                                        
                                                    </tr>                                                    
                                                    <?php
                                                    $totalVehiclesCount = $totalVehiclesCount+$value->type_count;
                                                                        }?>
                                                    
                                                    <tr>
                                                        <th>Total Vehicles Count </th>
                                                        <th><?php echo $totalVehiclesCount; ?></th>
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
