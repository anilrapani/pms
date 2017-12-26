<div class="content-wrapper" style="min-height: 433px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> Report Summary
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
        <div class="row filtering">
              <div class="col-md-2">
                                    <div class="form-group">
                                        <select class="form-control required" id="user_id" name="role" aria-required="true" aria-invalid="true">
                                            <option value="0">All Employees</option>
                                            
                                            <?php foreach ($userListArray as $key => $value) {
                                                
                                            ?>
                                            <option value="<?php echo $value->id; ?>" <?php if($user_id == $value->id){ echo "selected=selected"; }?>><?php echo $value->name;  ?></option>
                                            <?php }?>
                                                   
                                                                                                 
                                                                                            </select>
                                                                                            
                                    </div>
                                </div>
            
               <div class="col-md-2">
                                    <div class="form-group">
                                        
                                        <select class="form-control required" id="gate_id" name="role" aria-required="true" aria-invalid="true">
                                            <option value="0">All Terminals
                                            
                                            </option>
                                 <?php foreach ($gateListArray as $key => $value) {
                                                
                                            ?>
                                            <option value="<?php echo $value->id; ?>" <?php if($gate_id == $value->id){ echo "selected=selected"; }?>><?php echo $value->name;  ?></option>
                                            <?php }?>
                                                   
                                                                                                       
                                                                                        
                                                                                            </select>
                                                                                            
                                    </div>
                                </div>
<!--              <div class="col-xs-2">
                     <div class="form-group">
                  <label for="role">From Date</label>
    <div class="input-group date" data-provide="datepicker">
      <input type="text" class="form-control">
      <div class="input-group-addon">
        <span class="glyphicon glyphicon-th"></span>
      </div>
    </div>
                     </div>
                  
                 
  </div>
                 <div class="col-xs-2">
                     <div class="form-group">
                  <label for="role">To Date</label>
    <div class="input-group date" data-provide="datepicker">
      <input type="text" class="form-control">
      <div class="input-group-addon">
        <span class="glyphicon glyphicon-th"></span>
      </div>
    </div>
                     </div>
                  
                 
  </div>-->
            
<!--                <div class="col-xs-2">
                     <div class="form-group">
                  <label for="role">&nbsp;</label>
    <div class="input-group date" data-provide="datepicker">
                     <input type="submit" class="btn btn-primary" value="Submit">
    </div>
                     </div>
                  
                 
  </div>-->
        </div>
        
<!--               <div class="row" ><div class="col-xs-12">
                    <div class="box">
                           <div class="box-header">
                    <h3 class="box-title">Current List(Need to collect from employee)</h3>
                    
                </div>
                        <div class="box-body table-responsive no-padding">
                            <label for="role">Total Amount : </label><span>800000</span>
                            <label for="role">Pending Amount : </label><span>0</span>
                        </div>
                    </div>
            </div>
                    </div>-->
        
        <div class="row">
            <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                    <h3 class="box-title">Current List (Pending at gates)</h3>
                    
                </div>
            <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tr>
                      <th>Id</th>
                      <th>Gate</th>
                      <th>Employee Name</th>
                      <th>Total Amount</th>
                        <th>Cash Amount</th>
                      <th>Card Amount</th>
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
                      <td><?php echo $record->user_name; ?></td>
                      <td><?php echo $record->total_amount; ?></td>
                      <td><?php echo $record->cash_amount; ?></td>
                      <td><?php echo $record->card_amount; ?></td>
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
                </div>
                </div>
        </div>
        
<!--        <div class="row" ><div class="col-xs-12">
                    <div class="box">
                           <div class="box-header">
                   
                    
                </div>
                        <div class="box-body table-responsive no-padding">
                            <label for="role">Total Amount : </label><span>800000</span>
                            <label for="role">Pending Amount : </label><span>0</span>
                        </div>
                    </div>
            </div>
                    </div>-->
        
        <div class="row">
            <div class="col-xs-12">
                    <div class="box">
                          <div class="box-header">
                    <h3 class="box-title">Emloyee Generated Report pending for Approval by admin(Need to collect from employee)</h3>
                    
                </div>
                      
            <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tr>
                      <th>Id</th>
                      <th>Gate</th>
                      <th>Employee Name</th>
                      <th>Total Amount</th>
                        <th>Cash Amount</th>
                      <th>Card Amount</th>
                      <th>From Entry Time</th>
                      <th>To Entry Time</th>
                    
                      <th>From Id</th>
                      <th>To Id</th>
                      <th>Report Status</th>
                      <th>Collect</th>
<!--                      <th class="text-center">Actions</th>-->
                    </tr>
                    <?php
                    if(!empty($submittedReportArray))
                    {
                        foreach($submittedReportArray as $key => $record)
                        {
                    ?>
                    <tr>
                      <td><?php echo $key+1; ?></td>
                      <td><?php echo $record->gate_name; ?></td>
                      <td><?php echo $record->user_name; ?></td>
                      <td><?php echo $record->total_amount; ?></td>
                      <td><?php echo $record->cash_amount; ?></td>
                      <td><?php echo $record->card_amount; ?></td>
                      <td><?php echo $record->first_parking_id_time_after_login; ?></td>
                      <td><?php echo $record->last_parking_id_time_after_login; ?></td>
                      <td><?php echo $record->parking_id_from; ?></td>
                      <td><?php echo $record->parking_id_to; ?></td>
                      <td><?php $report_paid_to_admin = REPORT_PAID_TO_ADMIN;
                                echo $report_paid_to_admin[$record->paid_to_admin];
                          ?></td>
                      <td class="text-center">
                               
                          <a class="btn btn-sm btn-info" href="<?php echo base_url().'admin/report/approveEmployeeReport/?report_id='.$record->id.'&user_id='.$user_id.'&gate_id='.$gate_id; ?>"><i class="fa fa-money"></i></a>
                          
                      </td>
                          
                      </td>
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
    $('.filtering').change(function(){
      
      var url = "<?php echo base_url(); ?>admin/report/summary?";
      
      
        url+='user_id='+encodeURIComponent($("#user_id").val())+'&';
        url+='gate_id='+encodeURIComponent($("#gate_id").val())+'&';
      
      url = url.replace(/\&$/,'');
      // alert(url);
      window.location.href=url;
      
      });
</script>
