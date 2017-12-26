<?php
require_once 'common_model.php';
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class K_report_model extends Common_Model {
    
    
    var $id = 'id';
    var $user_id = 'user_id';
    var $cash_amount = 'cash_amount';
    var $card_amount = 'card_amount';
    var $card_start_transaction_id = 'card_start_transaction_id';
    var $card_end_transaction_id = 'card_end_transaction_id';
    var $total_amount = 'total_amount';
    var $gate_id = 'gate_id';
    var $paid_to_admin = 'paid_to_admin';
    var $first_parking_id_time_after_login = 'first_parking_id_time_after_login';
    var $last_parking_id_time_after_login = 'last_parking_id_time_after_login';
    var $parking_id_from = 'parking_id_from';
    var $parking_id_to = 'parking_id_to';
    var $status = 'status';
    var $deleted = 'deleted';
    var $created_by = 'created_by';
    var $updated_by = 'updated_by';
    var $created_time = 'created_time';
    var $updated_time = 'updated_time';
    var $table_name = 'k_report';
    
    function __construct() {
        parent::__construct();
        $this->setTableName($this->table_name);
    }
    
    function getNumberOfRecordsByUserId($userId){
        
        
        $this->db->select("count($this->id) as total_count");
                $this->db->from($this->table_name);
        
                 $this->db->where(
                 array(
                     "$this->user_id" => $userId,
                     "$this->status" => 1,
                     "$this->deleted" => 2
                 )
        );            

        $query = $this->db->get();
        return $query->row();
    }
    
    function createReport($data){
         $this->db->insert_batch($this->table_name, $data);
        return $this->db->last_query();
        
    }
    
    
    /**
     * This function is used to insert company's information
     * @param array $inputData : This is user's new company information
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
     * This function is used to get the employee company list and total company count
     * @param array $inputData : This is array with searchText, page, segment
     * @return array $result : This is result
     */
    function getList($inputData) {
        if (isset($inputData['totalCount']) && $inputData['totalCount'] == true) {
            $this->db->select("BaseTbl.$this->id");
        } else {
            $this->db->select("BaseTbl.*,gate.name as gate_name");
        }
        $this->db->from("$this->table_name as BaseTbl");
        $this->db->join('k_master_vehicle_gate as gate', "gate.id = BaseTbl.$this->gate_id",'left');
        
        if (!empty($inputData['searchText'])) {
            $this->db->or_group_start();
            // $this->db->like('barcode', $inputData['searchText']);
            //$this->db->or_like('id', $inputData['searchText']);

            $this->db->group_end();
          
        }
        $this->db->where(array(
                     "BaseTbl.$this->deleted" => 2
                 )
        );
        if (isset($inputData['user_id'])){
            $this->db->where(array("BaseTbl.$this->user_id" => $inputData['user_id']));
        }
        $this->db->order_by("BaseTbl.$this->last_parking_id_time_after_login",'desc');
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
     * This function is used to get the user company's information
     * @param array $id : This is user company's updated information
     * @param number $id : This is company id
     * @return object $result : This is result
     */
    function getDetails($id) {
        $this->db->select("*");
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
     * This function is used to update the user company's information
     * @param array $data : This is user company's updated information
     * @param number $id : This is discipline id
     * @return boolean $result : TRUE / FALSE
     */
    function update($data, $id) {
        $this->db->where($this->id, $id);
        $this->db->update($this->table_name, $data);
        return TRUE;
    }

    /**
     * This function is used to delete the company information
     * @param number $id : This is company id
     * @param array $data : This is company data
     * @return boolean $result : TRUE / FALSE
     */
    function delete($id, $data) {
        $this->db->where($this->id, $id);
        $this->db->update($this->table_name, $data);
        return $this->db->affected_rows();
    }
    
    
        /**
     * This function is used to get the user company's information
     * @param array $id : This is user company's updated information
     * @param number $id : This is company id
     * @return object $result : This is result
     */
    function getDetailsByBarcode($id) {
        $this->db->select("*");
        $this->db->from("$this->table_name");
         $this->db->where(
                 array(
                     $this->deleted => 2,
                    $this->barcode => $id
                 )
        );
        $query = $this->db->get();
        return $query->row();
    }
    
    
        /**
     * This function is used to get the user company's information
     * @param array $id : This is user company's updated information
     * @param number $id : This is company id
     * @return object $result : This is result
     */
    function getDetailsByBarcodeOrId($id) {
        $this->db->select("*");
        $this->db->from("$this->table_name");
        $this->db->where('barcode', $id);
        $this->db->or_where('id', $id);
        $query = $this->db->get();
        return $query->row();
    }
    
    
    function isNewTicketCreated(){
        $this->db->select("id");
        $this->db->from("$this->table_name");
         $this->db->where(
                 array(
                     $this->entry_time => '0000-00-00 00:00:00',
                     $this->status => 1,
                     $this->deleted => 2
                 )
        );
        $this->db->order_by("id", "desc");
        $query = $this->db->get();
        return $query->row();
    }
    
    
    function getTotalAmountFromDate($inputData){
        // $this->db->select("sum(total)");
        $this->db->select_sum('total_amount');
        $this->db->from("$this->table_name");
        // DATE_FORMAT($inputDate,'%Y-%m-%d %H:%i:%s')
        
         $this->db->where(
                 array(
                     $this->total_amount.">"=> 0,
                     $this->exit_time.">" => $inputData['start_date_time'],
                     $this->exit_time."!="=> '0000-00-00 00:00:00',
                     $this->status => 1,
                     $this->deleted => 2
                 )
        );
        if(isset($inputData['paid_to_admin'])){
            $this->db->where( array($this->paid_to_admin => $inputData['paid_to_admin'] ));
        }
        // $this->db->order_by("id", "desc");
        $query = $this->db->get();
        return $query->row();
    }
    
    function getReport($userID){
        
        
        
        
        $this->db->select("sum(BaseTbl.$this->total_amount) as total_amount, BaseTbl.$this->gate_id_exit, BaseTbl.$this->exited_by, SUM(CASE WHEN BaseTbl.$this->customer_paid_by_cash_or_card = 1 THEN BaseTbl.$this->total_amount ELSE 0 END) as cash_amount, SUM(CASE WHEN BaseTbl.$this->customer_paid_by_cash_or_card = 2 THEN BaseTbl.$this->total_amount ELSE 0 END) as card_amount, min(BaseTbl.$this->exit_time) as first_parking_id_time_after_login, max(BaseTbl.$this->exit_time) as last_parking_id_time_after_login, min(BaseTbl.$this->id) as parking_id_from, max(BaseTbl.$this->id) as parking_id_to ");
        $this->db->from("$this->table_name as BaseTbl");
        $this->db->join('k_report as report', "report.user_id = BaseTbl.$this->exited_by",'left');
        
                    
                    $this->db->where("BaseTbl.$this->exited_by",$userID);
                    $this->db->where("BaseTbl.$this->exit_time !=",'0000-00-00 00:00:00');
                    $this->db->where("BaseTbl.$this->exit_time >","k_report.last_parking_id_time_after_login");
                    
        
                    $this->db->group_by("BaseTbl.$this->gate_id_exit"); 
                    $this->db->order_by("BaseTbl.$this->id", 'asc'); 
                    $query = $this->db->get();
                          
        return $query->result();
       
                    
        } 
        
        
    

}
