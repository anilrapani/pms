<?php
require_once 'common_model.php';
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class K_parking_model extends Common_Model {

    var $table_name = 'k_parking';
    var $id = 'id';
    var $vehicle_type_id = 'vehicle_type_id';
    var $vehicle_number = '';
    var $vehicle_company_id = 'vehicle_company_id';
    var $vehicle_company = 'vehicle_company';
    var $driver_name = 'driver_name';
    var $driving_license_number = 'driving_license_number';
    var $image_driving_license_number = 'image_driving_license_number';
    var $image_vehicle_number_plate = 'image_vehicle_number_plate';
    var $entry_time = 'entry_time';
    var $exit_time = 'exit_time';
    var $master_prices_id = 'master_prices_id';
    var $total_amount = 'total_amount';
    var $total_minutes = 'total_minutes';
    var $barcode = 'barcode';
    var $master_price_details = 'master_price_details';
    var $status = 'status';
    var $deleted = 'deleted';
    var $paid_to_admin = 'paid_to_admin';
    var $terminal_id = 'terminal_id';
    var $exited_by = 'exited_by';
    
    
    function __construct() {
        parent::__construct();
        $this->setTableName($this->table_name);
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
            $this->db->select($this->id);
        } else {
            $this->db->select('*');
        }
        $this->db->from($this->table_name);
        
        if (!empty($inputData['searchText'])) {
            $this->db->or_group_start();
            $this->db->like('barcode', $inputData['searchText']);
            $this->db->or_like('id', $inputData['searchText']);

            $this->db->group_end();
            //    $likeCriteria = "(" . $this->name . "  LIKE '%" . $inputData['searchText'] . "%')";
        //    $this->db->where($likeCriteria);
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

}
