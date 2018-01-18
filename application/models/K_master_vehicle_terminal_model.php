<?php
require_once 'Common_model.php';

class K_master_gate_model extends Common_Model {

    var $table_name = 'k_master_gate';
    var $id = 'id';
    var $name = 'name';
    var $type = 'type';
    
    var $status = 'status';
    var $deleted = 'deleted';
    
    function __construct() {
        parent::__construct();
        $this->setTableName($this->table_name);
    }
  
    /**
     * This function is used to get the vehicle terminal list and count
     * @param array $inputData : This is array with searchText, page, segment
     * @return array $result : This is result
     */
    function getList($inputData) {
        if (isset($inputData['totalCount']) && $inputData['totalCount'] == true) {
            $this->db->select($this->id);
        } else {
            // add this->type for
            $this->db->select("$this->id,$this->name,$this->status,$this->type");
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
     * This function is used to get the user vehicle terminal's information
     * @param array $id : This is user vehicle terminal's updated information
     * @param number $id : This is vehicle terminal id
     * @return object $result : This is result
     */
    function getDetails($id) {
        $this->db->select("$this->id,$this->name,$this->type,$this->status");
        $this->db->from("$this->table_name");
         $this->db->where(
                 array(
                    $this->id => $id
                 )
        );
        $query = $this->db->get();
        return $query->row();
    }

  
}
