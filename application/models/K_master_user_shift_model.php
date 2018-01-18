<?php
require_once 'Common_model.php';

class K_master_user_shift_model extends Common_Model {

    var $table_name = 'k_master_user_shift';
    var $id = 'id';
    var $name = 'name';
    var $start_time = 'start_time';
    var $end_time = 'end_time';
    var $status = 'status';
    var $deleted = 'deleted';
    
    function __construct() {
        parent::__construct();
        $this->setTableName($this->table_name);
    }
 

    /**
     * This function is used to get the employee shift list and total Shift count
     * @param array $inputData : This is array with searchText, page, segment
     * @return array $result : This is result
     */
    function getList($inputData) {
        if (isset($inputData['totalCount']) && $inputData['totalCount'] == true) {
            $this->db->select($this->id);
        } else {
            $this->db->select("$this->id,$this->name,$this->status");
        }
        $this->db->from($this->table_name);
        if (!empty($inputData['searchText'])) {
            $likeCriteria = "(" . $this->name . "  LIKE '%" . $inputData['searchText'] . "%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where($this->deleted,2);
        if ($inputData['totalCount'] == false) {
            $this->db->limit($inputData['page'], $inputData['offset']);
        }
        $this->db->order_by("$this->id", "desc");
        $query = $this->db->get();
        $result = $query->result();

        if (isset($inputData['totalCount']) && $inputData['totalCount'] == true) {
            $result['count'] = count($result);
            return $result;
        } else {
            return $result;
        }
    }

    /**
     * This function is used to get the employee shift's detail information
     * @param array $id : This is user Shift's updated information
     * @param number $id : This is discipline id
     * @return object $result : This is result
     */
    function getDetails($id) {
        $this->db->select("$this->id,$this->name,$this->start_time,$this->end_time, $this->status");
        $this->db->from("$this->table_name");
         $this->db->where(
                 array(
                   $this->id => $id
                 )
        );
        $query = $this->db->get();
        return $query->row();
    }

 
    
    function getShiftList(){
        $this->db->select("*");
        $this->db->from("$this->table_name");
         $this->db->where(
                 array(
                     $this->status => 1,
                     $this->deleted => 2
                 )
        );
        $query = $this->db->get();
        return $query->result();
    }

}
