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
            <form role="form" action="<?php echo base_url() ?>admin/reports/shift/list" method="get" role="form">
                
                     <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="status">Select Shift</label>
                                        <select class="form-control required" id="shift_id" name="shift_id">
                                            <option value="">Select Shift</option>
                                            <?php
                                            if(!empty($shiftListArray))
                                            {
                                                foreach($shiftListArray as $value)
                                                {
                                                    ?>
                                          
                                                <option value="<?php echo $value->id; ?>" <?php if($value->id == $shift_id) { echo "selected=selected";} ?> ><?php echo $value->start_time.'-'.$value->end_time; ?></option>
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
                            <input type="text" class="form-control" name="exitDate" value="<?php echo $exitDate; ?>">
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
                      <th>Vehicle Type</th>
                      <th>Gate Name</th>
                      <th>Total Vehicles Exited</th>
                      <th>Amount Collected</th>
                    </tr>
                    <?php
                    if(!empty($records))
                    {
                        foreach($records as $record)
                        {
                           
                    ?>
                    <tr>
                      <td><?php echo $record->vehicle_type_name; ?></td>
                      <td><?php echo $record->gate_name; ?></td>
                      
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
   $( "#download_pdf" ).click( function(){
      
window.location="<?php $params   = $_SERVER['QUERY_STRING'];


$fullURL = current_url() . '?' . $params.'&download=true&pdf=true'; echo $fullURL; //current_url(); //base_url().uri_string()?>";


  });

});
   
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/admin/common.js" charset="utf-8"></script>
