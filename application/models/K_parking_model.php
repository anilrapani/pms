<?php
require_once 'Common_model.php';

class K_parking_model extends Common_Model {

    var $table_name = 'k_parking';
    var $id = 'id';
    var $vehicle_type_id = 'vehicle_type_id';
    var $vehicle_number = 'vehicle_number';
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
    var $gate_id_entry = 'gate_id_entry';
    var $gate_id_exit = 'gate_id_exit';
    var $exited_by = 'exited_by';
    var $entry_printed = 'entry_printed';
    var $customer_paid_by_cash_or_card = 'customer_paid_by_cash_or_card';
    var $manual_exit = 'manual_exit';
    
    function __construct() {
        parent::__construct();
        $this->setTableName($this->table_name);
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
          
        }
     
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
                    $this->id => $id
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
    
    function getReport($inputData){
        
        $this->db->select("user.name as user_name, sum(BaseTbl.$this->total_amount) as total_amount, BaseTbl.$this->gate_id_exit, gate.name as gate_name, BaseTbl.$this->exited_by, SUM(CASE WHEN BaseTbl.$this->customer_paid_by_cash_or_card = 1 THEN BaseTbl.$this->total_amount ELSE 0 END) as cash_amount, SUM(CASE WHEN BaseTbl.$this->customer_paid_by_cash_or_card = 2 THEN BaseTbl.$this->total_amount ELSE 0 END) as card_amount, min(BaseTbl.$this->exit_time) as first_parking_id_time_after_login, max(BaseTbl.$this->exit_time) as last_parking_id_time_after_login, min(BaseTbl.$this->id) as parking_id_from, max(BaseTbl.$this->id) as parking_id_to, count(BaseTbl.$this->id) as total_vehicles_exited");
        $this->db->from("$this->table_name as BaseTbl");
        $this->db->join('k_master_vehicle_gate as gate', "gate.id = BaseTbl.$this->gate_id_exit",'left');
        $this->db->join('k_user as user', "user.id = BaseTbl.$this->exited_by",'left');
        
//      if($inputData['isTotalReportCountZero'] == FALSE)
//      $this->db->join('k_report as report', "report.user_id = BaseTbl.$this->exited_by",'left');
        
                    
        $this->db->where("BaseTbl.$this->exited_by",$inputData['vendorId']);
        $this->db->where("BaseTbl.$this->exit_time !=",'0000-00-00 00:00:00');
        $userId = $inputData['vendorId'];
        
        if($inputData['isTotalReportCountZero'] == FALSE) {
            $last_parking_id_time_after_login = "BaseTbl.$this->exit_time > (select max(last_parking_id_time_after_login) from k_report where user_id = $userId)";
            $this->db->where($last_parking_id_time_after_login);
        }    
        
        if(isset($inputData['gate_id']) && !in_array(0,$inputData['gate_id']) && count($inputData['gate_id']) > 0) {
            $this->db->where_in("BaseTbl.$this->gate_id_exit",$inputData['gate_id']);
        }
                    $this->db->group_by("BaseTbl.$this->gate_id_exit"); 
                    $this->db->order_by("BaseTbl.$this->id", 'asc'); 
                    $query = $this->db->get();
//            echo $this->db->last_query();
//            exit;
        return $query->result();
       
                    
        } 
        
        
   /**
     * This function is used to get the employee company list and total company count
     * @param array $inputData : This is array with searchText, page, segment
     * @return array $result : This is result
     */
        /*
         * bak
         * CONCAT(
                    TIMESTAMPDIFF(day,BaseTbl.$this->entry_time,BaseTbl.$this->exit_time) ,  'days ' ,
                    MOD( TIMESTAMPDIFF(hour,BaseTbl.$this->entry_time,BaseTbl.$this->exit_time), 24),  'hours ' ,
                    MOD( TIMESTAMPDIFF(minute,BaseTbl.$this->entry_time,BaseTbl.$this->exit_time), 60), ' minutes'
                ) as parked_hours,
         */
         
        
        
     /**
     * This function is used to get the employee company list and total company count
     * @param array $inputData : This is array with searchText, page, segment
     * @return array $result : This is result
     */
    function getEntryList($inputData) {
        if (isset($inputData['totalCount']) && $inputData['totalCount'] == true && $inputData['download'] == false) {
            $this->db->select("BaseTbl.$this->id");
        } else {
            $this->db->select("BaseTbl.$this->id as ticket_no,BaseTbl.$this->entry_time, BaseTbl.$this->vehicle_number, BaseTbl.$this->image_vehicle_number_plate, vehicle_type.name as vehicle_type_name, BaseTbl.$this->vehicle_company,gate.name as gate_entry_name, BaseTbl.$this->barcode");
            // $this->db->select("");
        }
        $this->db->from("$this->table_name as BaseTbl");
        $this->db->join('k_master_vehicle_type as vehicle_type', "vehicle_type.id = BaseTbl.$this->vehicle_type_id",'left');
        $this->db->join('k_master_vehicle_gate as gate', "gate.id = BaseTbl.$this->gate_id_entry",'left');
        
        
        if (!empty($inputData['entryDate'])) {
            $this->db->where("DATE(BaseTbl.$this->entry_time)", $inputData['entryDate']);
        }
        if (!empty($inputData['vehicle_type_id'])) {
            $this->db->where("BaseTbl.$this->vehicle_type_id", $inputData['vehicle_type_id']);
        }
        
        
        $this->db->where(
                 array(
                     "BaseTbl.$this->status" => 1,
                     "BaseTbl.$this->deleted" => 2
                 )
        );
       
        if ($inputData['totalCount'] == false && $inputData['download'] == false) {
            $this->db->limit($inputData['page'], $inputData['offset']);
        }
        $this->db->order_by("BaseTbl.$this->id", "desc");
        $query = $this->db->get();
        $result = $query->result();

        if (isset($inputData['totalCount']) && $inputData['totalCount'] == true && $inputData['download'] == false) {
            $result['count'] = count($result);
            return $result;
        } else {
            return $result;
        }
    }
    
    
    function getEntryListSummaryByVehicleType($inputData) {
        
        $this->db->select("vehicle_type.name as vehicle_type_name, count(BaseTbl.$this->id) as type_count");
        $this->db->from("$this->table_name as BaseTbl");
        $this->db->join('k_master_vehicle_type as vehicle_type', "vehicle_type.id = BaseTbl.$this->vehicle_type_id",'left');
        
        if (!empty($inputData['entryDate'])) {
            $this->db->where("DATE(BaseTbl.$this->entry_time)", $inputData['entryDate']);
        }
             if (!empty($inputData['vehicle_type_id'])) {
            $this->db->where("BaseTbl.$this->vehicle_type_id", $inputData['vehicle_type_id']);
        }
        
        
        $this->db->where(
                 array(
                     "BaseTbl.$this->status" => 1,
                     "BaseTbl.$this->deleted" => 2
                 )
        );
        $this->db->group_by("BaseTbl.$this->vehicle_type_id");
        $query = $this->db->get();
        $result = $query->result();
          
        
            return $result;
        
    }
    
        
        
        
    function getExitList($inputData) {
        if (isset($inputData['totalCount']) && $inputData['totalCount'] == true && $inputData['download'] == false) {
            $this->db->select("BaseTbl.$this->id");
        } else {
            $this->db->select("BaseTbl.$this->id as ticket_no,BaseTbl.$this->entry_time, BaseTbl.$this->exit_time, 
                CONCAT(
                    TIMESTAMPDIFF(hour,BaseTbl.$this->entry_time,BaseTbl.$this->exit_time),  '.' ,
                    MOD( TIMESTAMPDIFF(minute,BaseTbl.$this->entry_time,BaseTbl.$this->exit_time), 60), ''
                ) as parked_hours,
                BaseTbl.$this->total_amount, BaseTbl.$this->vehicle_number, BaseTbl.$this->image_vehicle_number_plate, vehicle_type.name as vehicle_type_name, BaseTbl.$this->vehicle_company,gate.name as gate_entry_name, BaseTbl.$this->barcode");
            // $this->db->select("");
        }
        $this->db->from("$this->table_name as BaseTbl");
        $this->db->join('k_master_vehicle_type as vehicle_type', "vehicle_type.id = BaseTbl.$this->vehicle_type_id",'left');
        $this->db->join('k_master_vehicle_gate as gate', "gate.id = BaseTbl.$this->gate_id_exit",'left');
        
        
        if (!empty($inputData['exitDate'])) {
            $this->db->where("DATE(BaseTbl.$this->exit_time)", $inputData['exitDate']);
        }
        if (!empty($inputData['vehicle_type_id'])) {
            $this->db->where("BaseTbl.$this->vehicle_type_id", $inputData['vehicle_type_id']);
        }
        
        if (!empty($inputData['month'])) {
            $this->db->where("month(BaseTbl.$this->exit_time)", $inputData['month']);
        }
        
        if (!empty($inputData['year'])) {
            $this->db->where("year(BaseTbl.$this->exit_time)", $inputData['year']);
        }
        $this->db->where(
                 array(
                     "BaseTbl.$this->status" => 1,
                     "BaseTbl.$this->deleted" => 2,
                     "BaseTbl.$this->exit_time !=" =>'0000-00-00 00:00:00',
                 )
        );
       
        if ($inputData['totalCount'] == false && $inputData['download'] == false) {
            $this->db->limit($inputData['page'], $inputData['offset']);
        }
        $query = $this->db->get();
        $result = $query->result();

        if (isset($inputData['totalCount']) && $inputData['totalCount'] == true && $inputData['download'] == false) {
            $result['count'] = count($result);
            return $result;
        } else {
            return $result;
        }
    }
    
    
    function getExitListSummary($inputData) {
        
        $this->db->select("vehicle_type.name as vehicle_type_name, count(BaseTbl.$this->id) as type_count, sum(BaseTbl.$this->total_amount) as amount");
        $this->db->from("$this->table_name as BaseTbl");
        $this->db->join('k_master_vehicle_type as vehicle_type', "vehicle_type.id = BaseTbl.$this->vehicle_type_id",'left');
        
        if (!empty($inputData['exitDate'])) {
            $this->db->where("DATE(BaseTbl.$this->exit_time)", $inputData['exitDate']);
        }
             if (!empty($inputData['vehicle_type_id'])) {
            $this->db->where("BaseTbl.$this->vehicle_type_id", $inputData['vehicle_type_id']);
        }
        
        if (!empty($inputData['month'])) {
            $this->db->where("month(BaseTbl.$this->exit_time)", $inputData['month']);
        }
        
        if (!empty($inputData['year'])) {
            $this->db->where("year(BaseTbl.$this->exit_time)", $inputData['year']);
        }
        $this->db->where(
                 array(
                     "BaseTbl.$this->status" => 1,
                     "BaseTbl.$this->deleted" => 2,
                     "BaseTbl.$this->exit_time !=" =>'0000-00-00 00:00:00',
                 )
        );
        $this->db->group_by("BaseTbl.$this->vehicle_type_id");
        $query = $this->db->get();
        $result = $query->result();
          
        
            return $result;
        
    }





     /**
     * This function is used to get the employee company list and total company count
     * @param array $inputData : This is array with searchText, page, segment
     * @return array $result : This is result
     */
    function getRemainingList($inputData) {
        if (isset($inputData['totalCount']) && $inputData['totalCount'] == true && $inputData['download'] == false) {
            $this->db->select("BaseTbl.$this->id");
        } else {
            $this->db->select("BaseTbl.$this->id as ticket_no,BaseTbl.$this->image_vehicle_number_plate, BaseTbl.$this->entry_time, BaseTbl.$this->vehicle_number, vehicle_type.name as vehicle_type_name, BaseTbl.$this->vehicle_company,gate.name as gate_entry_name, BaseTbl.$this->barcode");
            // $this->db->select("");
        }
        $this->db->from("$this->table_name as BaseTbl");
        $this->db->join('k_master_vehicle_type as vehicle_type', "vehicle_type.id = BaseTbl.$this->vehicle_type_id",'left');
        $this->db->join('k_master_vehicle_gate as gate', "gate.id = BaseTbl.$this->gate_id_entry",'left');
        
        
        if (!empty($inputData['entryDate'])) {
            $this->db->where("DATE(BaseTbl.$this->entry_time)", $inputData['entryDate']);
        }
        if (!empty($inputData['vehicle_type_id'])) {
            $this->db->where("BaseTbl.$this->vehicle_type_id", $inputData['vehicle_type_id']);
        }
        
        
        $this->db->where(
                 array(
                     "BaseTbl.$this->status" => 1,
                     "BaseTbl.$this->deleted" => 2,
                     "BaseTbl.$this->exit_time" =>'0000-00-00 00:00:00',
                 )
        );
       
        if ($inputData['totalCount'] == false && $inputData['download'] == false) {
            $this->db->limit($inputData['page'], $inputData['offset']);
        }
        $query = $this->db->get();
        $result = $query->result();

        if (isset($inputData['totalCount']) && $inputData['totalCount'] == true && $inputData['download'] == false) {
            $result['count'] = count($result);
            return $result;
        } else {
            return $result;
        }
    }
    
    
    function getRemainingListSummaryByVehicleType($inputData) {
        
        $this->db->select("vehicle_type.name as vehicle_type_name, count(BaseTbl.$this->id) as type_count");
        $this->db->from("$this->table_name as BaseTbl");
        $this->db->join('k_master_vehicle_type as vehicle_type', "vehicle_type.id = BaseTbl.$this->vehicle_type_id",'left');
        
        if (!empty($inputData['entryDate'])) {
            $this->db->where("DATE(BaseTbl.$this->entry_time)", $inputData['entryDate']);
        }
             if (!empty($inputData['vehicle_type_id'])) {
            $this->db->where("BaseTbl.$this->vehicle_type_id", $inputData['vehicle_type_id']);
        }
        
        
        $this->db->where(
                 array(
                     "BaseTbl.$this->status" => 1,
                     "BaseTbl.$this->deleted" => 2,
                     "BaseTbl.$this->exit_time" =>'0000-00-00 00:00:00',
                 )
        );
        $this->db->group_by("BaseTbl.$this->vehicle_type_id");
        $query = $this->db->get();
        $result = $query->result();
          
        
            return $result;
        
    }
    
    
    
    
    function getMonthlySummaryByVehicleTypeList($inputData) {
        
        $this->db->select("vehicle_type.name as vehicle_type_name, vehicle_type.id as vehicle_type_id, DATE(BaseTbl.$this->exit_time) as each_date, count(BaseTbl.$this->id) as total_vehicles_exited, sum(BaseTbl.$this->total_amount) as total_amount");
            // $this->db->select("");
        
        $this->db->from("$this->table_name as BaseTbl");
        $this->db->join('k_master_vehicle_type as vehicle_type', "vehicle_type.id = BaseTbl.$this->vehicle_type_id",'left');
        
        
        if (!empty($inputData['month'])) {
            $this->db->where("month(BaseTbl.$this->exit_time)", $inputData['month']);
        }
        
        if (!empty($inputData['year'])) {
            $this->db->where("year(BaseTbl.$this->exit_time)", $inputData['year']);
        }
        
        $this->db->where(
                 array(
                     "BaseTbl.$this->status" => 1,
                     "BaseTbl.$this->deleted" => 2,
                     "BaseTbl.$this->exit_time !=" =>'0000-00-00 00:00:00',
                 )
        );
        
        $this->db->group_by(array("each_date", "vehicle_type.id"));
        $this->db->order_by("each_date");
        if ($inputData['totalCount'] == false && $inputData['download'] == false) {
            $this->db->limit($inputData['page'], $inputData['offset']);
        }
        $query = $this->db->get();
        $result = $query->result();
        
        if (isset($inputData['totalCount']) && $inputData['totalCount'] == true && $inputData['download'] == false) {
            $result['count'] = count($result);
            return $result;
        } else {
            return $result;
        }
    }
    
    
    function getShiftSummaryByVehicleTypeList($inputData) {
        
        $this->db->select("vehicle_type.name as vehicle_type_name, gate.name as gate_name, vehicle_type.id as vehicle_type_id, DATE(BaseTbl.$this->exit_time) as each_date, count(BaseTbl.$this->id) as total_vehicles_exited, sum(BaseTbl.$this->total_amount) as total_amount");
            // $this->db->select("");
        
        $this->db->from("$this->table_name as BaseTbl");
        $this->db->join('k_master_vehicle_type as vehicle_type', "vehicle_type.id = BaseTbl.$this->vehicle_type_id",'left');
        $this->db->join('k_master_vehicle_gate as gate', "gate.id = BaseTbl.$this->gate_id_exit",'left');
        
        
        if (!empty($inputData['start_time']) && !empty($inputData['exitDate'])) {
            $this->db->where("BaseTbl.$this->exit_time >", $inputData['exitDate'].' '.$inputData['start_time']);
        }
        if($inputData['two_days']){
            $inputData['exitDate'] = date('Y-m-d');
        }
        if (!empty($inputData['end_time']) && !empty($inputData['exitDate'])) {
            $this->db->where("BaseTbl.$this->exit_time <", $inputData['exitDate'].' '.$inputData['end_time']);
        }
        
        
        $this->db->where(
                 array(
                     "BaseTbl.$this->status" => 1,
                     "BaseTbl.$this->deleted" => 2,
                     "BaseTbl.$this->exit_time !=" =>'0000-00-00 00:00:00',
                 )
        );
        
        $this->db->group_by(array("vehicle_type.id","BaseTbl.$this->gate_id_exit"));
        $this->db->order_by("each_date");
        if ($inputData['totalCount'] == false && $inputData['download'] == false) {
            $this->db->limit($inputData['page'], $inputData['offset']);
        }
        $query = $this->db->get();
        $result = $query->result();
        
        if (isset($inputData['totalCount']) && $inputData['totalCount'] == true && $inputData['download'] == false) {
            $result['count'] = count($result);
            return $result;
        } else {
            return $result;
        }
    }
    

    function getTariffSummaryList($inputData) {
        $this->db->select("BaseTbl.$this->total_amount as amount, count(BaseTbl.$this->id) as total_vehicles_exited, sum(BaseTbl.$this->total_amount) as total_amount");
        $this->db->from("$this->table_name as BaseTbl");
        $this->db->join('k_master_vehicle_type as vehicle_type', "vehicle_type.id = BaseTbl.$this->vehicle_type_id",'left');
        $this->db->join('k_master_vehicle_gate as gate', "gate.id = BaseTbl.$this->gate_id_exit",'left');
        
        
        if (!empty($inputData['from_date']) && !empty($inputData['from_time'])) {
            $this->db->where("BaseTbl.$this->exit_time >", $inputData['from_date'].' '.$inputData['from_time']);
        }
        
        if (!empty($inputData['to_date']) && !empty($inputData['to_time'])) {
            $this->db->where("BaseTbl.$this->exit_time <", $inputData['to_date'].' '.$inputData['to_time']);
        }
        
        if (!empty($inputData['vehicle_type_id'])) {
            $this->db->where("BaseTbl.$this->vehicle_type_id", $inputData['vehicle_type_id']);
        }
        
        if (!empty($inputData['gate_id'])) {
            $this->db->where("BaseTbl.$this->gate_id_exit", $inputData['gate_id']);
        }
        
        $this->db->where(
                 array(
                     "BaseTbl.$this->status" => 1,
                     "BaseTbl.$this->deleted" => 2,
                     "BaseTbl.$this->exit_time !=" =>'0000-00-00 00:00:00',
                 )
        );
        
        $this->db->group_by(array("BaseTbl.$this->total_amount"));
        $this->db->order_by("BaseTbl.$this->total_amount",'asc');
        if ($inputData['totalCount'] == false && $inputData['download'] == false) {
            $this->db->limit($inputData['page'], $inputData['offset']);
        }
        $query = $this->db->get();
        $result = $query->result();
        
        if (isset($inputData['totalCount']) && $inputData['totalCount'] == true && $inputData['download'] == false) {
            $result['count'] = count($result);
            return $result;
        } else {
            return $result;
        }
    }
    
    function getSupervisorSummaryList($inputData) {
        $this->db->select("BaseTbl.$this->id, BaseTbl.$this->total_amount");
        $this->db->from("$this->table_name as BaseTbl");
        $this->db->join('k_master_vehicle_type as vehicle_type', "vehicle_type.id = BaseTbl.$this->vehicle_type_id",'left');
        $this->db->join('k_master_vehicle_gate as gate', "gate.id = BaseTbl.$this->gate_id_exit",'left');
        
        
        if (!empty($inputData['from_date']) && !empty($inputData['from_time'])) {
            $this->db->where("BaseTbl.$this->exit_time >", $inputData['from_date'].' '.$inputData['from_time']);
        }
        
        if (!empty($inputData['to_date']) && !empty($inputData['to_time'])) {
            $this->db->where("BaseTbl.$this->exit_time <", $inputData['to_date'].' '.$inputData['to_time']);
        }
        
        if (!empty($inputData['vehicle_type_id'])) {
            $this->db->where("BaseTbl.$this->vehicle_type_id", $inputData['vehicle_type_id']);
        }
        
        if (!empty($inputData['gate_id'])) {
            $this->db->where("BaseTbl.$this->gate_id_exit", $inputData['gate_id']);
        }
        
        $this->db->where(
                 array(
                     "BaseTbl.$this->status" => 1,
                     "BaseTbl.$this->deleted" => 2,
                     "BaseTbl.$this->exit_time !=" =>'0000-00-00 00:00:00',
                 )
        );
        
        $this->db->group_by(array("BaseTbl.$this->total_amount"));
        $this->db->order_by("BaseTbl.$this->total_amount",'asc');
        if ($inputData['totalCount'] == false && $inputData['download'] == false) {
            $this->db->limit($inputData['page'], $inputData['offset']);
        }
        $query = $this->db->get();
        $result = $query->result();
        
        if (isset($inputData['totalCount']) && $inputData['totalCount'] == true && $inputData['download'] == false) {
            $result['count'] = count($result);
            return $result;
        } else {
            return $result;
        }
    }
    
    
    function getExitlistByDateTime($inputData) {
        if (isset($inputData['totalCount']) && $inputData['totalCount'] == true && $inputData['download'] == false) {
            $this->db->select("BaseTbl.$this->id");
        } else {
            $this->db->select("BaseTbl.$this->id as ticket_no, BaseTbl.$this->image_vehicle_number_plate, BaseTbl.$this->entry_time, BaseTbl.$this->exit_time, 
                CONCAT(
                    TIMESTAMPDIFF(hour,BaseTbl.$this->entry_time,BaseTbl.$this->exit_time),  '.' ,
                    MOD( TIMESTAMPDIFF(minute,BaseTbl.$this->entry_time,BaseTbl.$this->exit_time), 60), ''
                ) as parked_hours,
                BaseTbl.$this->total_amount, BaseTbl.$this->vehicle_number, vehicle_type.name as vehicle_type_name, BaseTbl.$this->vehicle_company,gate.name as gate_entry_name, BaseTbl.$this->barcode");
            // $this->db->select("");
        }
        $this->db->from("$this->table_name as BaseTbl");
        $this->db->join('k_master_vehicle_type as vehicle_type', "vehicle_type.id = BaseTbl.$this->vehicle_type_id",'left');
        $this->db->join('k_master_vehicle_gate as gate', "gate.id = BaseTbl.$this->gate_id_entry",'left');
        
        if (!empty($inputData['from_date']) && !empty($inputData['from_time'])) {
            $this->db->where("BaseTbl.$this->exit_time >", $inputData['from_date'].' '.$inputData['from_time']);
        }
        
        if (!empty($inputData['to_date']) && !empty($inputData['to_time'])) {
            $this->db->where("BaseTbl.$this->exit_time <", $inputData['to_date'].' '.$inputData['to_time']);
        }
        
        $this->db->where(
                 array(
                     "BaseTbl.$this->status" => 1,
                     "BaseTbl.$this->deleted" => 2,
                     "BaseTbl.$this->exit_time !=" =>'0000-00-00 00:00:00',
                 )
        );
       
        if ($inputData['totalCount'] == false && $inputData['download'] == false) {
            $this->db->limit($inputData['page'], $inputData['offset']);
        }
        $query = $this->db->get();
        $result = $query->result();

        if (isset($inputData['totalCount']) && $inputData['totalCount'] == true && $inputData['download'] == false) {
            $result['count'] = count($result);
            return $result;
        } else {
            return $result;
        }
    }
    
    
    function getExitListSummaryByDateTime($inputData) {
        
        $this->db->select("vehicle_type.name as vehicle_type_name, count(BaseTbl.$this->id) as type_count, sum(BaseTbl.$this->total_amount) as amount");
        $this->db->from("$this->table_name as BaseTbl");
        $this->db->join('k_master_vehicle_type as vehicle_type', "vehicle_type.id = BaseTbl.$this->vehicle_type_id",'left');
        
        if (!empty($inputData['exitDate'])) {
            $this->db->where("DATE(BaseTbl.$this->entry_time)", $inputData['exitDate']);
        }
             if (!empty($inputData['vehicle_type_id'])) {
            $this->db->where("BaseTbl.$this->vehicle_type_id", $inputData['vehicle_type_id']);
        }
        
        
        $this->db->where(
                 array(
                     "BaseTbl.$this->status" => 1,
                     "BaseTbl.$this->deleted" => 2,
                     "BaseTbl.$this->exit_time !=" =>'0000-00-00 00:00:00',
                 )
        );
        $this->db->group_by("BaseTbl.$this->vehicle_type_id");
        $query = $this->db->get();
        $result = $query->result();
          
        
            return $result;
        
    }
    
    function getExitedVehicleCompanyList(){
        $this->db->select("BaseTbl.$this->vehicle_company");
        $this->db->from("$this->table_name as BaseTbl");
        $this->db->where("BaseTbl.$this->exit_time !=",'0000-00-00 00:00:00');
        $this->db->group_by("BaseTbl.$this->vehicle_company");
        $query = $this->db->get();
        
        return $query->result();
       
                    
        } 
        
        
        
     function getExitListByVehicleCompany($inputData) {
        if (isset($inputData['totalCount']) && $inputData['totalCount'] == true && $inputData['download'] == false) {
            $this->db->select("BaseTbl.$this->id");
        } else {
            $this->db->select("BaseTbl.$this->id as ticket_no,BaseTbl.$this->image_vehicle_number_plate, BaseTbl.$this->entry_time, BaseTbl.$this->exit_time, 
                CONCAT(
                    TIMESTAMPDIFF(hour,BaseTbl.$this->entry_time,BaseTbl.$this->exit_time),  '.' ,
                    MOD( TIMESTAMPDIFF(minute,BaseTbl.$this->entry_time,BaseTbl.$this->exit_time), 60), ''
                ) as parked_hours,
                BaseTbl.$this->total_amount, BaseTbl.$this->vehicle_number, vehicle_type.name as vehicle_type_name, BaseTbl.$this->vehicle_company,gate.name as gate_entry_name, BaseTbl.$this->barcode");
            // $this->db->select("");
        }
        $this->db->from("$this->table_name as BaseTbl");
        $this->db->join('k_master_vehicle_type as vehicle_type', "vehicle_type.id = BaseTbl.$this->vehicle_type_id",'left');
        $this->db->join('k_master_vehicle_gate as gate', "gate.id = BaseTbl.$this->gate_id_entry",'left');
        
        if (!empty($inputData['vehicle_company'])) {
            $this->db->where("BaseTbl.$this->vehicle_company", $inputData['vehicle_company']);
        }
        if (!empty($inputData['report_type'])) {
            if($inputData['report_type'] == 1){
                $this->db->where("DATE(BaseTbl.$this->exit_time)", $inputData['date']);
            } else if($inputData['report_type'] == 2){
                $this->db->where("DATE(BaseTbl.$this->exit_time) >", $inputData['date']);
            }
        }
        $this->db->where(
                 array(
                     "BaseTbl.$this->status" => 1,
                     "BaseTbl.$this->deleted" => 2,
                     "BaseTbl.$this->exit_time !=" =>'0000-00-00 00:00:00',
                 )
        );
       
        if ($inputData['totalCount'] == false && $inputData['download'] == false) {
            $this->db->limit($inputData['page'], $inputData['offset']);
        }
        $query = $this->db->get();
        $result = $query->result();

        if (isset($inputData['totalCount']) && $inputData['totalCount'] == true && $inputData['download'] == false) {
            $result['count'] = count($result);
            return $result;
        } else {
            return $result;
        }
    }
    
    
    function getExitListSummaryByVehicleCompany($inputData) {
        
        $this->db->select("vehicle_type.name as vehicle_type_name, count(BaseTbl.$this->id) as type_count, sum(BaseTbl.$this->total_amount) as amount");
        $this->db->from("$this->table_name as BaseTbl");
        $this->db->join('k_master_vehicle_type as vehicle_type', "vehicle_type.id = BaseTbl.$this->vehicle_type_id",'left');
        
        if (!empty($inputData['vehicle_company'])) {
            $this->db->where("BaseTbl.$this->vehicle_company", $inputData['vehicle_company']);
        }
        if (!empty($inputData['report_type'])) {
            if($inputData['report_type'] == 1){
                $this->db->where("DATE(BaseTbl.$this->exit_time)", $inputData['date']);
            } else if($inputData['report_type'] == 2){
                $this->db->where("DATE(BaseTbl.$this->exit_time) >", $inputData['date']);
            }
        }
        
        $this->db->where(
                 array(
                     "BaseTbl.$this->status" => 1,
                     "BaseTbl.$this->deleted" => 2,
                     "BaseTbl.$this->exit_time !=" =>'0000-00-00 00:00:00',
                 )
        );
        $this->db->group_by("BaseTbl.$this->vehicle_type_id");
        $query = $this->db->get();
        $result = $query->result();
          
        
            return $result;
        
    }    
        
  
    function getExitListSummaryShift($inputData) {
        
        $this->db->select("vehicle_type.name as vehicle_type_name, count(BaseTbl.$this->id) as type_count, sum(BaseTbl.$this->total_amount) as amount");
        $this->db->from("$this->table_name as BaseTbl");
        $this->db->join('k_master_vehicle_type as vehicle_type', "vehicle_type.id = BaseTbl.$this->vehicle_type_id",'left');
        
        if (!empty($inputData['first_parking_id_time_after_login'])) {
            $this->db->where("BaseTbl.$this->exit_time >=", $inputData['first_parking_id_time_after_login']);
        }
        if (!empty($inputData['last_parking_id_time_after_login'])) {
            $this->db->where("BaseTbl.$this->exit_time <=", $inputData['last_parking_id_time_after_login']);
        }
        
          if (!empty($inputData['gate_id'])) {
            $this->db->where("BaseTbl.$this->gate_id_exit", $inputData['gate_id']);
        }
        
          if (!empty($inputData['user_id'])) {
            $this->db->where("BaseTbl.$this->exited_by", $inputData['user_id']);
        }
                     
        $this->db->where(
                 array(
                     "BaseTbl.$this->status" => 1,
                     "BaseTbl.$this->deleted" => 2,
                     "BaseTbl.$this->exit_time !=" =>'0000-00-00 00:00:00',
                 )
        );
        $this->db->group_by("BaseTbl.$this->vehicle_type_id");
        $query = $this->db->get();
        $result = $query->result();
          
        
            return $result;
    }
    
    function getExitlistShift($inputData) {
        if (isset($inputData['totalCount']) && $inputData['totalCount'] == true && $inputData['download'] == false) {
            $this->db->select("BaseTbl.$this->id");
        } else {
            $this->db->select("BaseTbl.$this->id as ticket_no,BaseTbl.$this->entry_time, BaseTbl.$this->exit_time, 
                CONCAT(
                    TIMESTAMPDIFF(hour,BaseTbl.$this->entry_time,BaseTbl.$this->exit_time),  '.' ,
                    MOD( TIMESTAMPDIFF(minute,BaseTbl.$this->entry_time,BaseTbl.$this->exit_time), 60), ''
                ) as parked_hours,
                BaseTbl.$this->total_amount, BaseTbl.$this->vehicle_number, BaseTbl.$this->image_vehicle_number_plate, vehicle_type.name as vehicle_type_name, BaseTbl.$this->vehicle_company,gate.name as gate_entry_name, BaseTbl.$this->barcode");
            // $this->db->select("");
        }
        $this->db->from("$this->table_name as BaseTbl");
        $this->db->join('k_master_vehicle_type as vehicle_type', "vehicle_type.id = BaseTbl.$this->vehicle_type_id",'left');
        $this->db->join('k_master_vehicle_gate as gate', "gate.id = BaseTbl.$this->gate_id_exit",'left');
        
        
         if (!empty($inputData['first_parking_id_time_after_login'])) {
            $this->db->where("BaseTbl.$this->exit_time >=", $inputData['first_parking_id_time_after_login']);
        }
        if (!empty($inputData['last_parking_id_time_after_login'])) {
            $this->db->where("BaseTbl.$this->exit_time <=", $inputData['last_parking_id_time_after_login']);
        }
        
          if (!empty($inputData['gate_id'])) {
            $this->db->where("BaseTbl.$this->gate_id_exit", $inputData['gate_id']);
        }
        
          if (!empty($inputData['user_id'])) {
            $this->db->where("BaseTbl.$this->exited_by", $inputData['user_id']);
        }
        $this->db->where(
                 array(
                     "BaseTbl.$this->status" => 1,
                     "BaseTbl.$this->deleted" => 2,
                     "BaseTbl.$this->exit_time !=" =>'0000-00-00 00:00:00',
                 )
        );
       
        if ($inputData['totalCount'] == false && $inputData['download'] == false) {
            $this->db->limit($inputData['page'], $inputData['offset']);
        }
        $query = $this->db->get();
        $result = $query->result();

        if (isset($inputData['totalCount']) && $inputData['totalCount'] == true && $inputData['download'] == false) {
            $result['count'] = count($result);
            return $result;
        } else {
            return $result;
        }
    }
    

}
