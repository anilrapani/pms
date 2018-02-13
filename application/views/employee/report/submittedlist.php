<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
<!--      <h1>
         <?php echo $title; ?>
        <small> </small>
      </h1>-->
    </section>
    <section class="content">
   
        <div class="row">
           
            <div class="col-xs-12">
                
              <div class="box">
<!--                <div class="box-header">
                    <h3 class="box-title"><?php echo $sub_title; ?></h3>
                    <div class="box-tools">
                        <form action="<?php echo base_url() ?>employee/vehicle/company/list" method="POST" id="searchList">
                            <div class="input-group">
                              <input type="text" name="searchText" value="<?php echo $searchText; ?>" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search"/>
                              <div class="input-group-btn">
                                <button class="btn btn-sm btn-default searchList"><i class="fa fa-search"></i></button>
                              </div>
                            </div>
                        </form>
                    </div>
                </div> /.box-header -->

                <div class="box-header">
                    <h3 class="box-title">Current List</h3>
                    
                    
                    <a class="btn btn-primary pull-right" href="<?php echo base_url(); ?>employee/report/currentReportSubmission"><i class="fa fa-gears"></i> Generate Report</a>
         
                    
                </div>
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tr>
                      <th>Id</th>
                      <th>Gate</th>
                      <th>Total Amount</th>
<!--                        <th>Cash Amount</th>
                      <th>Card Amount</th>-->
                      <th>From Entry Time</th>
                      <th>To Entry Time</th>
                    
                      <th>From Id</th>
                      <th>To Id</th>
<!--                      <th class="text-center">Actions</th>-->
                    </tr>
                    <?php
                    if(!empty($currentReportArray))
                    {
                        foreach($currentReportArray as $key => $record)
                        {
                    ?>
                    <tr>
                      <td><?php echo $key+1; ?></td>
                      <td><?php echo $record->gate_name; ?></td>
                      <td><?php echo $record->total_amount; ?></td>
<!--                      <td><?php echo $record->cash_amount; ?></td>
                      <td><?php echo $record->card_amount; ?></td>-->
                      <td><?php echo $record->first_parking_id_time_after_login; ?></td>
                      <td><?php echo $record->last_parking_id_time_after_login; ?></td>
                      <td><?php echo $record->parking_id_from; ?></td>
                      <td><?php echo $record->parking_id_to; ?></td>
<!--                      <td class="text-center">
                          <a class="btn btn-sm btn-info" href="<?php echo base_url().'employee/vehicle/edit/company/'.$record->id; ?>"><i class="fa fa-pencil"></i></a>
                          <a class="btn btn-sm btn-danger deleteCompany" href="#" data-id="<?php echo $record->id; ?>"><i class="fa fa-trash"></i></a>
                      </td>-->
                    </tr>
                    <?php
                        }
                    }else{
                    ?>
                    <td>No Records Found</td>
                    <?php
                    }
                    
?>
                    
                  </table>
                  
                </div><!-- /.box-body -->
                
                
                
                
              </div><!-- /.box -->
            </div>
             <div class="col-xs-12">
                
              <div class="box">
                  <div class="box-header">
                    <h3 class="box-title">Submitted List</h3>
                </div>
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tr>
                      <th>Id</th>
                      <th>Gate</th>
                      <th>Total Amount</th>
<!--                        <th>Cash Amount</th>
                      <th>Card Amount</th>-->
                      <th>From Entry Time</th>
                      <th>To Entry Time</th>
                    
<!--                      <th>From Id</th>
                      <th>To Id</th>-->
                      <th>Total Vehicles</th>
                      <th>Report Status</th>
                      <th>Print</th>
                      <th>Email</th>
<!--                      <th class="text-center">Actions</th>-->
                    </tr>
                    <?php
                    if(!empty($generatedReportArray))
                    {
                        foreach($generatedReportArray as $key => $record)
                        {
                    ?>
                    <tr>
                      <td><?php echo $key+1; ?></td>
                      <td><?php echo $record->gate_name; ?></td>
                      <td><?php echo $record->total_amount; ?></td>
<!--                      <td><?php echo $record->cash_amount; ?></td>
                      <td><?php echo $record->card_amount; ?></td>-->
                      <td><?php echo $record->first_parking_id_time_after_login; ?></td>
                      <td><?php echo $record->last_parking_id_time_after_login; ?></td>
<!--                      <td><?php echo $record->parking_id_from; ?></td>
                      <td><?php echo $record->parking_id_to; ?></td>-->
                      <td><?php echo $record->total_vehicles_exited; ?></td>
                      <td><?php $report_paid_to_admin = json_decode(REPORT_PAID_TO_ADMIN,TRUE);
                                echo $report_paid_to_admin[$record->paid_to_admin];
                          ?></td>
                      <td>
                           
                           <span class="btn btn-sm btn-info" href="" onclick="printPage(<?php echo $record->id; ?>)"><i class="fa fa-print"></i></span>
                           
                           <div id="printTicketData" class="box-body generatedReportPrint<?php echo $record->id; ?>" style="line-height: 5px; font-size: 12px; font-family: sans-serif; display: none;">
                                <div class="ticketHeader" style="font-size: 13px;">
                                <p><b>Menzies Aviation Bobba (B'lore) Pvt Ltd</b></p>
                                    <p style="margin-left: 70px;"><?php echo $record->gate_name; ?></p>
                                    <p style="margin-left: 90px;">Report</p>
                                    <p><span>-------------------------------------------------------</span></p>
                                </div>
                                <div style="ticketBody">
                                    <div class="ticketLine"><p><span style="float: left;width: 130px;">Date</span>: <span><?php echo date("d-m-Y ", strtotime($record->last_parking_id_time_after_login)); ?></span></p></div>
                                    <div class="ticketLine"><p><span style="float: left;width: 130px;">Time</span>: <span><?php echo date("H:i ", strtotime($record->last_parking_id_time_after_login)); ?></span></p></div>
                                    <div class="ticketLine"><p><span style="float: left;width: 130px;">No. of vehicles entered</span>: <span><?php echo $record->total_vehicles_exited; ?></span></p></div>                        
                                    <div class="ticketLine"><p><span style="float: left;width: 130px;">Total Amount</span>: <span><?php echo $record->total_amount; ?></span></p></div>
                                </div>
                            </div>
                          </td>
                          <td><span class="btn btn-primary" class="sendReportToAdmin" onclick="sendReportToAdmin(<?php echo $record->id; ?>)" ><?php if($record->email_sent_to_admin >0){ echo "Resend Email"; }else{ echo "Email"; } ?></span></td>

                    </tr>
                    <?php
                        }
                    }else{
                    ?>
                    <td>No Records Found</td>
                    <?php
                    }
                    
?>
                    
                  </table>
                  
                </div><!-- /.box-body -->
              </div>
             </div>   
        </div>
    </section>
</div>
<script type="text/javascript">
    deleteUrl = "employee/vehicle/deleteCompany";
function printPage(report_id){
    $(".generatedReportPrint"+report_id).css("display", "block");
    var options = {mode:"popup",popHt: 500, popWd: 400, popX: 500,   popY: 600,popTitle:"",popClose: false};
    $(".generatedReportPrint"+report_id).printArea( options ); 
    $(".generatedReportPrint"+report_id).css("display", "none");
}

function sendReportToAdmin(reportId){
    // $('.sendReportToAdmin').text('Resend Email');
    
     $.ajax({
        type: 'POST', 
    url: '<?php echo base_url() . 'admin/reports/shiftReportToAdmin'; ?>', 
    data: { reportId : reportId, },
    dataType: 'json',
    success: function (data) { 
        
        }
    });
}
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/admin/common.js" charset="utf-8"></script>
