<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/* 
 * Copyright (C) 2017 Kastech
 * @project : pms
 * @author : Anil Rapani
 * @email : arapani@kastechindia.com
 * @since : Dec 15, 2017
 * @version : 
 */
class Common_model extends CI_Model {

    //Set the table Name
    var $table_name;
    var $deleted;
    var $status;
    public function setTableName($tablename) {
        $this->table_name = $tablename;
    }
    function get() {
        
        $this->db->select('*');
        $this->db->from($this->table_name);
          $this->db->where(
                 array(
                     $this->status => 1,
                     $this->deleted => 2
                 )
        );
        
        $query = $this->db->get();
     
        $result = $query->result();

        return $result;
    }

}