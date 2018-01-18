<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
         <?php echo $title; ?>
        <small> </small>
      </h1>
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
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tr>
                      <th>Id</th>
                      <th>Gate</th>
                      <th>Total Amount</th>
                        <th>Cash Amount</th>
                      <th>Card Amount</th>
                      <th>From Entry Time</th>
                      <th>To Entry Time</th>
                    
                      <th>From Id</th>
                      <th>To Id</th>
                      <th>Report Status</th>
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
                      <td><?php echo $record->cash_amount; ?></td>
                      <td><?php echo $record->card_amount; ?></td>
                      <td><?php echo $record->first_parking_id_time_after_login; ?></td>
                      <td><?php echo $record->last_parking_id_time_after_login; ?></td>
                      <td><?php echo $record->parking_id_from; ?></td>
                      <td><?php echo $record->parking_id_to; ?></td>
                      <td><?php $report_paid_to_admin = json_decode(REPORT_PAID_TO_ADMIN,TRUE);
                                echo $report_paid_to_admin[$record->paid_to_admin];
                          ?></td>
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
                <div class="box-footer clearfix">
                    <?php // echo $this->pagination->create_links(); ?>
                </div>
              </div><!-- /.box -->
            </div>
        </div>
    </section>
</div>
<script type="text/javascript">
    deleteUrl = "employee/vehicle/deleteCompany";
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/admin/common.js" charset="utf-8"></script>
