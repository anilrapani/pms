<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once 'Common_model.php';

class K_master_device_registry_model extends Common_Model {

    var $table_name = 'k_master_device_registry';
    var $id = 'id';
    var $name = 'name';
    var $user_id = 'user_id';
    var $ipaddress = 'ipaddress';
    var $status = 'status';
    var $deleted = 'deleted';
    
    function __construct() {
        parent::__construct();
        $this->setTableName($this->table_name);
    }
    /**
     * This function is used to insert Vehicle's information
     * @param array $inputData : This is user's new vehicle terminal information
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
     * This function is used to get the vehicle terminal list and count
     * @param array $inputData : This is array with searchText, page, segment
     * @return array $result : This is result
     */
    function getList($inputData) {
        if (isset($inputData['totalCount']) && $inputData['totalCount'] == true) {
            $this->db->select($this->id);
        } else {
            // add this->type for
            $this->db->select("$this->id,$this->name,$this->status,$this->ipaddress,$this->user_id");
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
        $this->db->order_by("id", "desc");
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
        $this->db->select("$this->id,$this->name,$this->user_id,$this->ipaddress,$this->status");
        $this->db->from("$this->table_name");
         $this->db->where(
                 array(
                     $this->deleted => 2,
                    $this->id => $id
                 )
        );
        $query = $this->db->get();
        return $query->row();
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
    function getDeviceRegistryList(){
          
        $this->db->select("$this->id,$this->name,$this->ipaddress");
        $this->db->from("$this->table_name");
         $this->db->where(
                 array(
                     $this->status => 1,
                     $this->deleted => 2,
                    )
        );
        $query = $this->db->get();
        return $query->result();

    }
}
