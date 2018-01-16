<?php

class Dbchanges extends CI_Controller {

    /**
     * This is default constructor of the class
     */
    public function __construct() {
        parent::__construct();
        //$this->load->model('k_master_vehicle_type_model');
     //   $this->isLoggedIn();
    }
    
    function addcolumndirectly(){
     $this->load->dbforge();
     $fields = array(
        'privileges' => array('type' => 'MEDIUMBLOB', 'null'=>FALSE, 'after' => 'name')
);
$result = $this->dbforge->add_column('k_user_role', $fields);
if($result){
     echo 'added column';
}else{
     echo 'error';
}
    
    }
    function pageNotFound() {
        $this->global['pageTitle'] = 'Pms : 404 - Page Not Found';

        $this->loadViews("404", $this->global, NULL, NULL);
    }

}