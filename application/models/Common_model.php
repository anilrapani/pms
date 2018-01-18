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
   
    
        /**
     * This function is used to insert Govt proof type's information
     * @param array $inputData : This is user's new Govt proof type information
     * @return int $inserted_id : This is inserted Id
     */
    function insert($inputData) {
        $this->db->trans_start();
        $this->db->insert($this->table_name, $inputData);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }
     /**
     * This function is used to update the user vehicle terminal's information
     * @param array $data : This is vehicle terminal's updated information
     * @param number $id : This is vehicle terminal id
     * @return boolean $result : TRUE / FALSE
     */
    function update($data, $id) {
        $this->db->where($this->id, $id);
        $this->db->update($this->table_name, $data);
        return TRUE;
    }
    
    /**
     * This function is used to delete the Vehicle terminal information
     * @param number $id : This is Vehicle terminal id
     * @param array $data : This is vehicle terminal data
     * @return boolean $result : TRUE / FALSE
     */
    function delete($id, $data) {
        $this->db->where($this->id, $id);
        $this->db->update($this->table_name, $data);
        return $this->db->affected_rows();
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