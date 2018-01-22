<?php 
if(isset($_POST['privilege'])){
    $privileges = serialize($_POST['privilege']);
    echo $privileges;
    exit;
}


define('ROLE_PRIVILEGES_ARRAY',                            json_encode(array(   1=>'Master - Shifts',
                                                                               // 2=>'Operator Collection Report',
                                                                              //  3=>'Manual Entry',
                                                                              //  4=>'Device Registry', // Network Monitoring
                                                                              //  5=>'Remaining Vehicles Report',
                                                                                6=>'Shift Report',
                                                                                7=>'Daily Entry Report',
                                                                                8=>'Master - Roles', // Add Role
                                                                                9=>'Daily Exit Report',
                                                                                10=>'Daily Remaining Vehicles Report',
                                                                                11=>'Monthly Report',
                                                                                // 12=>'Ticket Type Report',
                                                                                13=>'Time Based Report',
                                                                                14=>'Summary Report',
                                                                               // 15=>'Add Vehicle',
                                                                               // 16=>'Add Previlege',
                                                                               // 17=>'Daily Remaining Vechiles',
                                                                               // 18=>'Audit Trail Report',
                                                                                19=>'Master - Vendor Companies',
                                                                                20=>'Companywise Report',
                                                                               // 21=>'Update Vendor company details',
                                                                                22=>'Change password',
                                                                                23=>'Entry form',
                                                                                24=>'Administrative Tasks - Users',
                                                                                25=>'Exit form',
                                                                               // 26=>'Duplicate Entry Ticket',
                                                                                27=>'Summary Report For Supervisor',
                                                                            //    28=>'Manual Exit',
                                                                            //    29=>'Manual Exit Report',
                                                                               // 30=>'Add Free Time',
                                                                               // 31=>'Add Category',
                                                                                32=>'Master - Gates', // Add Terminal
                                                                                //33=>'Add Employee' - user already present
                                                                                33=>'Master - Employee Company',
                                                                                34=>'Govt Proof Types',
                                                                                35=>'Master - Prices',
                                                                                36=>'Administrative Tasks - Vehicle Types and Prices',
                                                                                37=>'Administrative Tasks - Gates and Employee',
                                                                                38=>'Cash Management - Report Chart',
                                                                                39=>'Cash Management - Cash Report Summary',
                                                                                40=>'Approve Employee Report',
                                                                                41=>'Cash Management - Cash Collected list',
                                                                                42=>'All Exited list',
                                                                                43=>'My Current Report',
                                                                                44=>'My Submitted Report'
                                                                        )));
?>
<form action="" method="post">

                                <?php 
                                        $role_privileges_array = json_decode(ROLE_PRIVILEGES_ARRAY,true);
                                        foreach ($role_privileges_array as $key => $value) {
                                ?>  
                                        <input type="checkbox" name="privilege[<?php echo $key; ?>]">
                                <?php }?>
                                      
                                        <input type="submit" value="submit">
</form>
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

