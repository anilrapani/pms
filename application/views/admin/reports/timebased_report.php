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
            <form role="form" action="<?php echo base_url() ?>admin/reports/timebased/list" method="get" role="form">
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
                            <button type="submit" id="download_pdf" class="btn btn-primary pull-right" style="margin-right: 5px;">
                                <i class="fa fa-download"></i> Download Pdf
                            </button>
                        </div>
                    </div>
            </div> 
               <div class="col-xs-2 pull-right">
                    <div class="form-group">
                        <label for="role">&nbsp;</label>
                        <div class="input-group" >
                            <button type="submit" id="download" class="btn btn-primary pull-right" style="margin-right: 5px;">
                                <i class="fa fa-download"></i> Download Xls
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
                      <th>Exit Date & Time</th>
                      <th>Parking Hours</th>
                      <th>Amount</th>
                      <th>Company Name</th>
                      <th>Gate Name</th>
                      <th class="text-center">Actions</th>
                    </tr>
                    <?php
//                    echo "<pre>";
//                    var_dump($records);
//                    exit;
                    if(!empty($records))
                    {
                        foreach($records as $record)
                        {
                           
                    ?>
                    <tr>
                      <td><?php echo $record->ticket_no; ?></td>
                      <td><?php echo $record->entry_time; ?></td>
                        <td><?php if(!empty(trim($record->vehicle_number))){
                                    echo $record->vehicle_number; 
                                }else if(!empty(trim($record->image_vehicle_number_plate)) && file_exists(FCPATH.'assets/images/upload/numberplate/75/'.$record->image_vehicle_number_plate)){ ?> 
                                  <a href="#" class="pop">
                                        <img class="imageresource"  width="75" class="img-responsive" src="<?php echo base_url() ?>assets/images/upload/numberplate/75/<?php echo $record->image_vehicle_number_plate; ?>" alt="" image_name="<?php echo $record->image_vehicle_number_plate; ?>">
                                    </a>
                          <?php } ?>
                      </td>
                      <td><?php echo $record->vehicle_type_name; ?></td>
                      <td><?php echo $record->exit_time; ?></td>
                      <td><?php echo $record->parked_hours; ?></td>
                      <td><?php echo $record->total_amount; ?></td>
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
                                                        <th></th>
                                                        <th>Vehicle Type </th>
                                                        <th>No Of Vehicles Exited</th>
                                                        <th>Amount</th>
                                                    </tr>
                                                    
                                                    <?php 
                                                    $totalVehiclesCount = 0;
                                                    $totalAmount = 0;
                                                    foreach ($exitListSummaryByVehicleType as $key => $value) {
                                                                            ?>
                                                     <tr>
                                                         <td></td>
                                                        <td><?php echo $value->vehicle_type_name; ?></td>
                                                        <td><?php echo $value->type_count; ?></td>
                                                        <td><?php echo $value->amount; ?></td>
                                                        
                                                    </tr>                                                    
                                                    <?php
                                                    $totalAmount = $totalAmount+$value->amount;
                                                    $totalVehiclesCount = $totalVehiclesCount+$value->type_count;
                                                    
                                                                        }?>
                                                    
                                                    <tr>
                                                        <th>Total</th>
                                                        <th></th>
                                                        <th><?php echo $totalVehiclesCount; ?></th>
                                                        <th><?php echo $totalAmount; ?></th>
                                                    </tr>
                                                                                                    
                                                    
                                                </tbody>
                                            </table>

                                        </div><!-- /.box-body -->

                                    </div>    
                                </div>
        </div>
                  <div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Image preview</h4>
      </div>
      <div class="modal-body">
        <img src="" id="imagepreview" class="img-responsive" >
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
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

 $(".pop").on("click", function() {
   var full_image = '<?php echo base_url() ?>assets/images/upload/numberplate/640/'+$(this).children( '.imageresource' ).attr('image_name');
   $('#imagepreview').attr('src', full_image); // here asign the image to the modal when the user click the enlarge link
   $('#imagemodal').modal('show'); // imagemodal is the id attribute assigned to the bootstrap modal, then i use the show function
});

  $( "#download" ).click( function(){
      
window.location="<?php $params   = $_SERVER['QUERY_STRING'];


$fullURL = current_url() . '?' . $params.'&download=true'; echo $fullURL; //current_url(); //base_url().uri_string()?>";


  });
    $( "#download_pdf" ).click( function(){
      
window.location="<?php $params   = $_SERVER['QUERY_STRING'];


$fullURL = current_url() . '?' . $params.'&download=true&pdf=true'; echo $fullURL; //current_url(); //base_url().uri_string()?>";


  });


});
   
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/admin/common.js" charset="utf-8"></script>
