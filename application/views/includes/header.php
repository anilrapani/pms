<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title><?php echo $pageTitle; ?></title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.4 -->
    <link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />    
    <!-- FontAwesome 4.3.0 -->
    <link href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons 2.0.0 -->
    <link href="<?php echo base_url(); ?>assets/ionicframework/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/css/touba.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
    <link href="<?php echo base_url(); ?>assets/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    
    
    <style>
    	.error{
    		color:red;
    		font-weight: normal;
    	}
    </style>
    <?php
            $jsExt = $this->config->item('js_gz_extension');
            $cssExt = $this->config->item('css_gz_extension');  
            
            
            if (isset($assets['cssTopArray']) && is_array($assets['cssTopArray'])) {
                foreach ($assets['cssTopArray'] as $cssFile) {
                    echo '<link rel="stylesheet" type="text/css" href="' . $cssFile . $cssExt . '">';
                    echo "\n";
                }
            }
            
           
    ?>
    <!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url(); ?>assets/js/jQuery-2.1.4.min.js"></script>
    <script type="text/javascript">
        var baseURL = "<?php echo base_url(); ?>";
        
    </script>
    <?php 
     if (isset($assets['jsTopArray']) && is_array($assets['jsTopArray'])) {
                foreach ($assets['jsTopArray'] as $js) {
                    echo '<script src="' . $js . $jsExt . '"></script>';
                    echo "\n";
                }
     }
    ?>
   
  </head>
  <body class="skin-blue sidebar-mini">
      
    <div class="wrapper">
      
      <header class="main-header">
        <!-- Logo -->
        <a href="<?php echo base_url(); ?>" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b><?php echo PROJECT_NAME; ?></b></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b><?php echo PROJECT_NAME; ?></b></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a><?php echo $gate_id; ?>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="<?php echo base_url(); ?>assets/dist/img/avatar.png" class="user-image" alt="User Image"/>
                  <span class="hidden-xs"><?php echo $name; ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="<?php echo base_url(); ?>assets/dist/img/avatar.png" class="img-circle" alt="User Image" />
                    <p>
                      <?php echo $name; ?>
                      <small><?php echo $role_text; ?></small>
                    </p>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="<?php echo base_url(); ?>loadChangePass" class="btn btn-default btn-flat"><i class="fa fa-key"></i> Change Password</a>
                    </div>
                    <div class="pull-right">
                      <a href="<?php echo base_url(); ?>logout" class="btn btn-default btn-flat"><i class="fa fa-sign-out"></i> Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="treeview">
              <a href="<?php echo base_url(); ?>dashboard">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span></i>
              </a>
            </li>
            <?php
            if($role == ROLE_ADMIN)
            {
                
            ?>
            <li class="treeview <?php echo ($this->uri->segment(1) == 'admin' && ($this->uri->segment(2) == 'employee' || $this->uri->segment(2) == 'vehicle' ))?'active':''; ?> ">
              <a href="#"><i class="fa fa-database"></i><span>Master Data</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                            <li class="treeview">
                            <a href="<?php echo base_url(); ?>admin/employee/company/list" >
                              <i class="fa fa-ticket"></i>
                              <span>Employee Companies</span>
                            </a>
                          </li>
                          <li class="treeview">
                            <a href="<?php echo base_url(); ?>admin/employee/govtprooftype/list" >
                              <i class="fa fa-ticket"></i>
                              <span>Govt Proof Types</span>
                            </a>
                          </li>
<!--                          <li class="treeview">
                            <a href="<?php echo base_url(); ?>admin/employee/shift/list" >
                              <i class="fa fa-ticket"></i>
                              <span>Employee Shifts</span>
                            </a>
                          </li>-->
                          <li class="treeview">
                            <a href="<?php echo base_url(); ?>admin/vehicle/type/list" >
                              <i class="fa fa-ticket"></i>
                              <span>Vehicle Types and Rates</span>
                            </a>
                          </li>
                            <li class="treeview">
                            <a href="<?php echo base_url(); ?>admin/employee/deviceregistry/list" >
                              <i class="fa fa-ticket"></i>
                              <span>Device Registry</span>
                            </a>
                          </li>
                            <li class="treeview">
                            <a href="<?php echo base_url(); ?>admin/vehicle/gate/list" >
                              <i class="fa fa-ticket"></i>
                              <span>Gates</span>
                            </a>
                          </li>
                          
                          
                          
              </ul>
            </li>
            <li class="treeview">
                            <a href="<?php echo base_url(); ?>admin/vehicle/parking/list" >
                              <i class="fa fa-ticket"></i>
                              <span>Vehicle Parking List</span>
                            </a>
                          </li>
                        <li class="treeview">
                            <a href="<?php echo base_url(); ?>admin/report/reportchart" >
                              <i class="fa fa-ticket"></i>
                              <span>Report Chart</span>
                            </a>
                          </li>
                          <li class="treeview">
                            <a href="<?php echo base_url(); ?>admin/report/amountcollection" >
                              <i class="fa fa-ticket"></i>
                              <span>Amount Collection</span>
                            </a>
                          </li>
                          
                           <li class="treeview">
                            <a href="<?php echo base_url(); ?>admin/report/summary" >
                              <i class="fa fa-ticket"></i>
                              <span>Report Summary</span>
                            </a>
                          </li>
                          
<!--                                    <li class="treeview">
                            <a href="<?php echo base_url(); ?>admin/vehicle/report" >
                              <i class="fa fa-ticket"></i>
                              <span>Report</span>
                            </a>
                          </li>-->
             <?php
                }
                if($role == ROLE_ADMIN || $role == ROLE_EMPLOYEE)
            {
            ?>
            
               <?php if($role == ROLE_ADMIN){ ?>
<!--            <li class="treeview" <?php echo ($this->uri->segment(1) == 'employee' && $this->uri->segment(2) == 'vehicle')?'active':''; ?> >
              <a href="#"><i class="fa fa-database"></i><span>Vehicle Data</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                           <li class="treeview">
                            <a href="<?php echo base_url(); ?>employee/vehicle/company/list" >
                              <i class="fa fa-ticket"></i>
                              <span>Vehicle Company</span>
                            </a>
                          </li>
                       
                           <li class="treeview">
                            <a href="<?php echo base_url(); ?>admin/vehicle/type/list" >
                              <i class="fa fa-ticket"></i>
                              <span>Vehicle Type</span>
                            </a>
                          </li>
                          
                          
                      
                          
              </ul>
            </li>-->
            <?php } ?>
                <li class="treeview">
                            <a href="<?php echo base_url(); ?>employee/vehicle/add/entry" >
                              <i class="fa fa-ticket"></i>
                              <span>Vehicle Entry</span>
                            </a>
                          </li>
                          
                          
                            <li class="treeview">
                            <a href="<?php echo base_url(); ?>employee/vehicle/exit/details" >
                              <i class="fa fa-ticket"></i>
                              <span>Vehicle Exit</span>
                            </a>
                          </li>
                          
                           <li class="treeview">
                            <a href="<?php echo base_url(); ?>employee/report/current/list" >
                              <i class="fa fa-ticket"></i>
                              <span>My Current Report</span>
                            </a>
                          </li>
                          <li class="treeview">
                            <a href="<?php echo base_url(); ?>employee/report/submitted/list" >
                              <i class="fa fa-ticket"></i>
                              <span>My Submitted Report</span>
                            </a>
                          </li>
                          
                          
            <?php if($role == ROLE_ADMIN){ ?>
            <li class="treeview">
              <a href="<?php echo base_url(); ?>userListing">
                <i class="fa fa-users"></i>
                <span>Users</span>
              </a>
            </li>
         
            <?php
            }
            }
            ?>
          
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>