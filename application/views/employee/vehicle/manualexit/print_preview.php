<style type="text/css">
    .printTicket{
        width: 60%;
        border: 1px solid black;
        
    }
    .printTicket h2{
        font-size: 22px !important;
        line-height: 10px;
        
    }
    .printTicket h3{
        line-height: 10px;
        font-size: 18px !important;
    }
    .printTicket h4{
        line-height: 10px;
        font-size: 14px !important;
    }
</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
       <h1>
             <?php echo ($isNewEntry == true)?'New ':''; echo $title; ?>
            <small></small>
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
        <div class="row">
            <?php if($isNewEntry == false) {?>
                <div class="col-md-6">
                <!-- general form elements -->



                <div class="box box-primary ">
                    <div class="box-header">
                        <h3 class="box-title"><?php echo $sub_title.' No : '.$entryId; ?></h3> <?php if($isNewEntry == false) {?><input type="submit" class="btn btn-primary float-right" style="float:right;"value="Print"><?php } ?>
                        <br>
                        <br>
                        <h3 class="box-title">Print Preview</h3>
                        <div class="box-body printTicket" >
                            <div style="text-align: center; ">
                            <h2>Employee Company</h2>
                            <h3>Cargo Terminal 1?</h3>
                            <h3>Bangalore International Airport?</h3>
                            <h3>Entry Ticket</h3>
                             <h3>||||| ||| ||| |||||| |||</h3>
                            <h3>5     3   3   6      6  </h3>
                            </div>
                            <div style="text-align: left;">
                           
                            
                            
                            <h4>Ticket Number: <span><?php echo $entryId; ?></span></h4>
                            <h4>Entry Date : <span></span></h4>
                            <h4>Entry Time: <span></span></h4>
                            <h4>Vehicle : <span></span></h4>
                            <h4>Company Id: <span></span></h4>
                            <h4>Vehicle No: <span></span></h4>
                            <h3>Parking Charges </h3>
                            <?php 
//                                foreach ($array as $key => $value) {
//                                                    
//                                  }
                            ?>
                            <h3>Driver Details </h3>
                            <h4>Sample Name</h4>
                            <h4>RC : <span>Sample RC Number</span></h4>
                            
                            <h3>No Horn </h3>
                            <h3>Speed Limit : <span>10Km/Hr</span></h3>
                            <h3>Kastech India Pvt. Ltd. </h3>
                            </div>
                        </div>
                            
                    </div> 
                    
                </div>
                </div>
            <?php }?>
        </div>    
    </section>

</div>