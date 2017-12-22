<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-users"></i> Report Chart
            <small></small>
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo $amount['currentMonth']; ?> Month Report</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-8">
                  <div class="chart-responsive">
                    <canvas id="pieChart" height="165" width="205" style="width: 205px; height: 165px;"></canvas>
                  </div>
                  <!-- ./chart-responsive -->
                </div>
                <!-- /.col -->
                <div class="col-md-4">
                  <ul class="chart-legend clearfix">
                    <li><i class="fa fa-circle-o text-red"></i> Pending</li>
                    <li><i class="fa fa-circle-o text-green"></i> Submitted</li>
                  </ul>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- /.box-body -->
<!--            <div class="box-footer no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li><a href="#">United States of America
                  <span class="pull-right text-red"><i class="fa fa-angle-down"></i> 12%</span></a></li>
                <li><a href="#">India <span class="pull-right text-green"><i class="fa fa-angle-up"></i> 4%</span></a>
                </li>
                <li><a href="#">China
                  <span class="pull-right text-yellow"><i class="fa fa-angle-left"></i> 0%</span></a></li>
              </ul>
            </div>-->
            <!-- /.footer -->
          </div>
<!--                <img src="<?php echo base_url(); ?>assets/images/chart.png" />-->
            </div>
            
            
            
              <div class="col-xs-6">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Exit Terminal's Pending Amount</h3>
                </div>
              </div>   
            </div>
            <div class="col-xs-6">
                    <div class="box">
            <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tbody><tr>
                      <th>Terminal</th>
                      <th>Pending Amount</th>
                      <th class="text-center">Actions</th>
                    </tr>
                    <tr>
                      <td>Exit Terminal 1</td>
                      <td>50000</td>
                      <td class="text-center">
                          <a class="btn btn-sm btn-info" title="Collect Amount" href="http://localhost/pms/editOld/2"><i class="fa fa-location-arrow"></i></a>
                          
                      </td>
                    </tr>
                    
                    <tr>
                      <td>Exit Terminal 2</td>
                      <td>100000</td>
                      <td class="text-center">
                          <a class="btn btn-sm btn-info" title="Collect Amount" href="http://localhost/pms/editOld/2"><i class="fa fa-location-arrow"></i></a>
                          
                      </td>
                    </tr>
                    <tr>
                      <td>Exit Terminal 3</td>
                      <td>80000</td>
                      <td class="text-center">
                          <a class="btn btn-sm btn-info" title="Collect Amount" href="http://localhost/pms/editOld/2"><i class="fa fa-location-arrow"></i></a>
                          
                      </td>
                    </tr>
                    <tr>
                      <td>Exit Terminal 4</td>
                      <td>70000</td>
                      <td class="text-center">
                          <a class="btn btn-sm btn-info" title="Collect Amount" href="http://localhost/pms/editOld/2"><i class="fa fa-location-arrow"></i></a>
                          
                      </td>
                    </tr>
                    <tr>
                      <td>Exit Terminal 5</td>
                      <td>200000</td>
                      <td class="text-center">
                          <a class="btn btn-sm btn-info" title="Collect Amount" href="http://localhost/pms/editOld/2"><i class="fa fa-location-arrow"></i></a>
                          
                      </td>
                    </tr>
                    
                
                                      </tbody></table>
                  </div>
                </div>
                </div>
        </div>
        <div class="row">
          
        </div>
        <div class="row">
                
            </div>
        
    </section>
</div>


<script type="text/javascript">
    // -------------
  // - PIE CHART -
  // -------------
  // Get context with jQuery - using jQuery's .get() method.
  var pieChartCanvas = $('#pieChart').get(0).getContext('2d');
  var pieChart       = new Chart(pieChartCanvas);
  var PieData        = [
    {
      value    : <?php echo $amount['totalAmountPending']; ?>,
      color    : '#f56954',
      highlight: '#f56954',
      label    : 'Pending'
    },
    {
      value    : <?php echo $amount['totalAmountCollected']; ?>,
      color    : '#00a65a',
      highlight: '#00a65a',
      label    : 'Submitted'
    }
  ];
  var pieOptions     = {
    // Boolean - Whether we should show a stroke on each segment
    segmentShowStroke    : true,
    // String - The colour of each segment stroke
    segmentStrokeColor   : '#fff',
    // Number - The width of each segment stroke
    segmentStrokeWidth   : 1,
    // Number - The percentage of the chart that we cut out of the middle
    percentageInnerCutout: 1, // This is 0 for Pie charts
    // Number - Amount of animation steps
    animationSteps       : 100,
    // String - Animation easing effect
    animationEasing      : 'easeOutBounce',
    // Boolean - Whether we animate the rotation of the Doughnut
    animateRotate        : true,
    // Boolean - Whether we animate scaling the Doughnut from the centre
    animateScale         : false,
    // Boolean - whether to make the chart responsive to window resizing
    responsive           : true,
    // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
    maintainAspectRatio  : false,
    // String - A legend template
    legendTemplate       : '<ul class=\'<%=name.toLowerCase()%>-legend\'><% for (var i=0; i<segments.length; i++){%><li><span style=\'background-color:<%=segments[i].fillColor%>\'></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>',
    // String - A tooltip template
    tooltipTemplate      : '<%=value %> <%=label%>'
  };
  // Create pie or douhnut chart
  // You can switch between pie and douhnut using the method below.
  pieChart.Doughnut(PieData, pieOptions);
  // -----------------
  // - END PIE CHART -
  // -----------------
</script>