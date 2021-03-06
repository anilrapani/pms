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
                <div class="box-header">
                    <h3 class="box-title"><?php echo $sub_title; ?></h3>
                    <div class="box-tools">
                        <form action="<?php echo base_url() ?>admin/vehicle/parking/list" method="POST" id="searchList">
                            <div class="input-group">
                              <input type="text" name="searchText" value="<?php echo $searchText; ?>" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search"/>
                              <div class="input-group-btn">
                                <button class="btn btn-sm btn-default searchList"><i class="fa fa-search"></i></button>
                              </div>
                            </div>
                        </form>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tr>
                      <th>Id</th>
                      <th>Barcode</th>
                      <th>Entry Time</th>
                      <th>Exit Time</th>
                      <th>Amount</th>
                      <th class="text-center">Actions</th>
                    </tr>
                    <?php
                    if(!empty($records))
                    {
                        foreach($records as $record)
                        {
                    ?>
                    <tr>
                      <td><?php echo $record->id; ?></td>
                      <td><?php echo $record->barcode; ?></td>
                      <td><?php echo $record->entry_time; ?></td>
                      <td><?php echo $record->exit_time; ?></td>
                      <td><?php echo $record->total_amount; ?></td>
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
    </section>
</div>
<script type="text/javascript">
    deleteUrl = "admin/vehicle/deleteType";
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/admin/common.js" charset="utf-8"></script>
