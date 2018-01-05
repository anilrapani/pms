<?php
require_once 'Common_model.php';


class K_master_price_per_time_model extends Common_Model {

    var $table_name = 'k_master_price_per_time';
    var $id = 'id';
    var $from_minutes = 'from_minutes';
    var $to_minutes = 'to_minutes';
    var $amount = 'amount';
    var $vehicle_type_id = 'price_id';
    var $status = 'status';
    var $deleted = 'deleted';
    
    function __construct() {
        parent::__construct();
        $this->setTableName($this->table_name);
    }
    /**
     * This function is used to insert Price information
     * @param array $inputData : This is user's new price information
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
     * This function is used to get the employee price list and total price count
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
        $this->db->where(
                 array(
                     $this->deleted => 2
                 )
        );
        $this->db->where(array($this->deleted => 2));
        if ($inputData['totalCount'] == false) {
            $this->db->limit($inputData['page'], $inputData['offset']);
        }
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
     * This function is used to get the user Price information
     * @param array $id : This is user Price updated information
     * @param number $id : This is price id
     * @return object $result : This is result
     */
    function getDetails($id) {
        $this->db->select("$this->id,$this->from_minutes,$this->to_minutes,$this->vehicle_type_id, $this->amount");
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
     * This function is used to update the user price's information
     * @param array $data : This is user price's updated information
     * @param number $id : This is discipline id
     * @return boolean $result : TRUE / FALSE
     */
    function update($data, $id) {
        $this->db->where($this->id, $id);
        $this->db->update($this->table_name, $data);
        return TRUE;
    }

    /**
     * This function is used to delete the price information
     * @param number $id : This is price id
     * @param array $data : This is price data
     * @return boolean $result : TRUE / FALSE
     */
    function delete($id, $data) {
        $this->db->where($this->id, $id);
        $this->db->update($this->table_name, $data);
        return $this->db->affected_rows();
    }
    
    function getPriceListByPriceId($vehicleTypeId){
        $this->db->select("$this->id,$this->from_minutes,$this->to_minutes,$this->amount");
        $this->db->from("$this->table_name");
         $this->db->where(
                 array(
                     $this->deleted => 2,
                    $this->vehicle_type_id=> $vehicleTypeId
                 )
        );
        $query = $this->db->get();
        return $query->result();
    }
    function insertMultiplePricesByPriceId($data){
        
        $this->db->insert_batch($this->table_name, $data);
        return $this->db->last_query();
        
        
    }
    
    function deletingPricesExistingByPriceId($data,$id){
        $this->db->where($this->vehicle_type_id, $id);
        $this->db->update($this->table_name, $data);
       
    }
    
     function getPricePerTimeList(){
        $this->db->select("$this->id,$this->name,price_per_time.from_time,price_per_time.to_time");
        
        $this->db->from("$this->table_name as BaseTbl");
        $this->db->join('k_master_vehicle_gate_employee as vehicle_gate_employee', 'vehicle_gate_employee.vehicle_gate_id = BaseTbl.id','left');
        $this->db->join("k_master_price_per_time as price_per_time","price_per_time.price_id= BaseTbl.id",'left');
         $this->db->where(
                 array(
                     $this->status => 1,
                     $this->deleted => 2,
                     $this->id => $id
                 )
        );
        $query = $this->db->get();
        return $query->row();
    }

    
    

}
