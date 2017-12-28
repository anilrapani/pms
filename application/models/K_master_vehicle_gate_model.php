<?php
require_once 'common_model.php';
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class K_master_vehicle_gate_model extends Common_Model {

    var $table_name = 'k_master_vehicle_gate';
    var $id = 'id';
    var $name = 'name';
    var $type = 'type';
    
    var $status = 'status';
    var $deleted = 'deleted';
    var $vehicle_gate_id = 'vehicle_gate_id';
    var $user_id = 'user_id';
    var $device_registry_id = 'device_registry_id';

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
        $this->db->select("$this->id,$this->name,$this->type,$this->status,(CASE WHEN $this->type = 1 THEN 'entry' ELSE 'exit' END) as type_name");
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
    
    function getGatesList(){
              $this->db->select("*");
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
    
    
    function checkForUserAccess($inputArray){
        $this->db->select("BaseTbl.id,BaseTbl.name as gate_name, (CASE WHEN BaseTbl.$this->type = 1 THEN 'entry' ELSE 'exit' END) as gate_type ");
        $this->db->from("$this->table_name as BaseTbl");
        $this->db->join('k_master_vehicle_gate_employee as vehicle_gate_employee', 'vehicle_gate_employee.vehicle_gate_id = BaseTbl.id','left');
        $this->db->join('K_master_device_registry as device_registry', 'device_registry.id = vehicle_gate_employee.device_registry_id','left');
        
        if($this->config->item('enable_gate_restriction_for_employee_at_employee_login') == TRUE && $this->config->item('enable_ip_restriction_for_employee_at_employee_login') == FALSE){
                    $this->db->group_start();
                        $this->db->where("vehicle_gate_employee.$this->user_id" ,0);
                        $this->db->or_where("vehicle_gate_employee.$this->user_id" ,$inputArray['user_id']);
                    $this->db->group_end();
                    
                    $this->db->where(
                         array(
                             "vehicle_gate_employee.$this->status" => 1,
                             "vehicle_gate_employee.$this->deleted" => 2,
                    ));
                    
        } 
        
        if($this->config->item('enable_gate_restriction_for_employee_at_employee_login') == FALSE && $this->config->item('enable_ip_restriction_for_employee_at_employee_login') == TRUE){
                    $this->db->group_start();
                        
                        $this->db->group_start();
                            $this->db->where("vehicle_gate_employee.$this->device_registry_id" ,0);
                            $this->db->where("vehicle_gate_employee.$this->status" , 1);
                            $this->db->where("vehicle_gate_employee.$this->deleted" , 2);
                        $this->db->group_end();
                        
                        $this->db->or_group_start();
                                $this->db->where('device_registry.ipaddress' , $inputArray['ipaddress']);
                                $this->db->where("device_registry.$this->status" , 1);
                                $this->db->where("device_registry.$this->deleted", 2);
                        $this->db->group_end();
                        
                    $this->db->group_end();
                    
                     
                    
                    
        }
         
         
            if($this->config->item('enable_gate_restriction_for_employee_at_employee_login') == TRUE && $this->config->item('enable_ip_restriction_for_employee_at_employee_login') == TRUE){
                $this->db->group_start();
                    $this->db->group_start();
                        $this->db->where(
                                array(
                                    "vehicle_gate_employee.$this->user_id" => 0,
                                    "vehicle_gate_employee.$this->device_registry_id" => 0,
                                    "vehicle_gate_employee.$this->status" => 1,
                                    "vehicle_gate_employee.$this->deleted" => 2
                                )
                        );
                    $this->db->group_end();

                    $this->db->or_group_start();
                        $this->db->where(
                                array(
                                    "vehicle_gate_employee.$this->user_id" => $inputArray['user_id'],
                                    "vehicle_gate_employee.$this->device_registry_id" => 0,
                                    "vehicle_gate_employee.$this->status" => 1,
                                    "vehicle_gate_employee.$this->deleted" => 2
                                )
                        );
                    $this->db->group_end();    

                    $this->db->or_group_start();
                        $this->db->where(
                                array(
                                    "vehicle_gate_employee.$this->user_id" => 0,
                                    'device_registry.ipaddress' => $inputArray['ipaddress'],
                                    "vehicle_gate_employee.$this->status" => 1,
                                    "vehicle_gate_employee.$this->deleted" => 2,
                                    "device_registry.$this->status" => 1,
                                    "device_registry.$this->deleted" => 2
                                )
                        );
                    $this->db->group_end();

                    $this->db->or_group_start();
                        $this->db->where(
                                array(
                                    "vehicle_gate_employee.$this->user_id" => $inputArray['user_id'],
                                    'device_registry.ipaddress' => $inputArray['ipaddress'],
                                    "vehicle_gate_employee.$this->status" => 1,
                                    "vehicle_gate_employee.$this->deleted" => 2,
                                    "device_registry.$this->status" => 1,
                                    "device_registry.$this->deleted" => 2
                                )
                        );
                    $this->db->group_end();
                     $this->db->group_end();
            }

         
         $this->db->where(
                 array(
                     "BaseTbl.$this->id" => $inputArray['vehicle_gate_id'],
                     "BaseTbl.$this->status" => 1,
                     "BaseTbl.$this->deleted" => 2
                     )
        );
         
        $query = $this->db->get();
        return $query->result();
    }

}
