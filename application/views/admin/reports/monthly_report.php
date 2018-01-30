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
            <form role="form" action="<?php echo base_url() ?>admin/reports/monthly/list" method="get" role="form">
                
                     <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="status">Year Selection</label>
                                        <select class="form-control required" id="year" name="year">
                                            <option value="">Select Year</option>
                                            <?php
                                            $years_for_report_array = json_decode(YEARS_FOR_REPORT_ARRAY,true);
                                            if(!empty($years_for_report_array))
                                            {
                                                for($each_year=$years_for_report_array['from_year'];$each_year<=$years_for_report_array['to_year'];$each_year++)
                                                {
                                                    ?>
                                                    <option value="<?php echo $each_year; ?>" <?php if($year == $each_year) { echo "selected=selected";} ?> ><?php echo $each_year; ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                
                 <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="status">Month Selection</label>
                                        <select class="form-control required" id="month" name="month">
                                                <option value="">Select Month</option>
                                            <?php
                                            $months_for_report_array = json_decode(MONTHS_FOR_REPORT_ARRAY,true);
                                            if(!empty($months_for_report_array))
                                            {
                                                foreach ($months_for_report_array as $key => $value)
                                                {
                                                    ?>
                                                    <option value="<?php echo $key; ?>" <?php if($key == $month) {echo "selected=selected";} ?> ><?php echo $value; ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
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
                      <th>Vehicle Type</th>
                      <th>Vehicle Type Id</th>
                      <th>Exit Date</th>
                      <th>Total Vehicles Exited</th>
                      <th>Total Amount</th>
                    </tr>
                    <?php
                    if(!empty($records))
                    {
                        foreach($records as $record)
                        {
                           
                    ?>
                    <tr>
                      <td><?php echo $record->vehicle_type_name; ?></td>
                      <th><?php echo $record->vehicle_type_id; ?></th>
                      <td><?php echo $record->each_date; ?></td>
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
