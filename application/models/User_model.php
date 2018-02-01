<?php 
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once 'Common_model.php';
class User_model extends Common_Model
{
     var $id ='id';
    var $name ='name';
    var $status ='status';
    var $deleted ='deleted';
    var $table_name ='k_user';
    /**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    function userListingCount($searchText = '')
    {
        $this->db->select('BaseTbl.id, BaseTbl.email, BaseTbl.name as user_name, Role.name as role_name');
        $this->db->from('k_user as BaseTbl');
        $this->db->join('k_user_role as Role', 'Role.id = BaseTbl.role_id','left');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.email  LIKE '%".$searchText."%'
                            OR  BaseTbl.name  LIKE '%".$searchText."%'
                            OR  BaseTbl.mobile  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where(array('BaseTbl.deleted'=>2, 'BaseTbl.role_id !=' => 1,'BaseTbl.id !=' => 2));
        $query = $this->db->get();
        
        return count($query->result());
    }
    
    /**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function userListing($searchText = '', $page, $segment)
    {
        $this->db->select('BaseTbl.id, BaseTbl.email, BaseTbl.name, BaseTbl.status, BaseTbl.mobile, Role.name as role_name, BaseTbl.user_name');
        $this->db->from('k_user as BaseTbl');
        $this->db->join('k_user_role as Role', 'Role.id = BaseTbl.role_id','left');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.email  LIKE '%".$searchText."%'
                            OR  BaseTbl.name  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where(array('BaseTbl.deleted'=>2, 'BaseTbl.role_id !=' => 1,'BaseTbl.id !=' => 2));
        $this->db->limit($page, $segment);
        $this->db->order_by("BaseTbl.id", "desc");
        $query = $this->db->get();
   
        $result = $query->result();        
        return $result;
    }
    
    /**
     * This function is used to get the user roles information
     * @return array $result : This is result of the query
     */
    function getUserRoles()
    {
        $this->db->select('id, name');
        $this->db->from('k_user_role');
        $this->db->where('id !=', 1);
        $query = $this->db->get();
        
        return $query->result();
    }

    /**
     * This function is used to check whether email id is already exist or not
     * @param {string} $email : This is email id
     * @param {number} $userId : This is user id
     * @return {mixed} $result : This is searched result
     */
    function checkEmailExists($email, $userId = 0)
    {
        $this->db->select("email");
        $this->db->from("k_user");
        $this->db->where("email", $email);   
        $this->db->where("deleted", 2);
        if($userId != 0){
            $this->db->where("id !=", $userId);
        }
        $query = $this->db->get();
        return $query->result();
    }
    
    
    /**
     * This function is used to check whether email id is already exist or not
     * @param {string} $email : This is email id
     * @param {number} $userId : This is user id
     * @return {mixed} $result : This is searched result
     */
    function checkUsernameExists($user_name, $userId = 0)
    {
        $this->db->select("user_name");
        $this->db->from("k_user");
        $this->db->where("user_name", $user_name);   
        $this->db->where("deleted", 2);
        if($userId != 0){
            $this->db->where("id !=", $userId);
        }
        $query = $this->db->get();
        return $query->result();
    }
    
    
    
    /**
     * This function is used to add new user to system
     * @return number $insert_id : This is last inserted id
     */
    function addNewUser($userInfo)
    {
        $this->db->trans_start();
        $this->db->insert('k_user', $userInfo);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }
    
    /**
     * This function used to get user information by id
     * @param number $id : This is user id
     * @return array $result : This is user information
     */
    function getUserInfo($userId)
    {
        $this->db->select('id, name, email, mobile, role_id, government_proof_type_id, government_id_number, user_company_id, shift_id,status,user_name');
        $this->db->from('k_user');
        $this->db->where('deleted', 2);
		$this->db->where('role_id !=', 1);
        $this->db->where('id', $userId);
        $query = $this->db->get();
        return $query->result();
    }
    
    
    /**
     * This function is used to update the user information
     * @param array $userInfo : This is users updated information
     * @param number $userId : This is user id
     */
    function editUser($userInfo, $userId)
    {
        $this->db->where('id', $userId);
        $this->db->update('k_user', $userInfo);
        
        return TRUE;
    }
    
    
    
    /**
     * This function is used to delete the user information
     * @param number $userId : This is user id
     * @return boolean $result : TRUE / FALSE
     */
    function deleteUser($userId, $userInfo)
    {
        $this->db->where('id', $userId);
        $this->db->update('k_user', $userInfo);
        
        return $this->db->affected_rows();
    }


    /**
     * This function is used to match users password for change password
     * @param number $userId : This is user id
     */
    function matchOldPassword($userId, $oldPassword)
    {
        $this->db->select('id, password');
        $this->db->where('id', $userId);        
        $this->db->where('deleted', 2);
        $query = $this->db->get('k_user');
        
        $user = $query->result();

        if(!empty($user)){
            if(verifyHashedPassword($oldPassword, $user[0]->password)){
                return $user;
            } else {
                return array();
            }
        } else {
            return array();
        }
    }
    
    /**
     * This function is used to change users password
     * @param number $userId : This is user id
     * @param array $userInfo : This is user updation info
     */
    function changePassword($userId, $userInfo)
    {
        $this->db->where('id', $userId);
        $this->db->where('deleted', 2);
        $this->db->update('k_user', $userInfo);
        
        return $this->db->affected_rows();
    }
    
    
      function getUserList(){
        $this->db->select("$this->id,$this->name");
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

  