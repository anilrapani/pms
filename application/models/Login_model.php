<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
require_once 'Common_model.php';
/* 
 * Copyright (C) 2017 Kastech
 * @project : touba316
 * @author : Anil Rapani
 * @email : arapani@kastechindia.com
 * @since : Dec 2, 2017
 * @version : 
 */
class Login_model extends Common_Model
{
    
    /**
     * This function used to check the login credentials of the user
     * @param string $email : This is email of the user
     * @param string $password : This is encrypted password of the user
     */
    function loginMe($email, $password)
    {
        $this->db->select('BaseTbl.id as user_id, BaseTbl.password, BaseTbl.name as user_name, BaseTbl.status as user_status, BaseTbl.role_id, Roles.name as role_name, Usercompany.name as company_name');
        $this->db->from('k_user as BaseTbl');
        $this->db->join('k_user_role as Roles','Roles.id = BaseTbl.role_id');
        $this->db->join('k_master_user_company as Usercompany','Usercompany.id = BaseTbl.user_company_id');
        $this->db->where('BaseTbl.email', $email);
        $this->db->where('BaseTbl.deleted', 2);
        $query = $this->db->get();
        
        $user = $query->result();
        if(!empty($user)){
            if(verifyHashedPassword($password, $user[0]->password)){
                return $user;
            } else {
                return array();
            }
        } else {
            return array();
        }
    }
    

    /**
     * This function used to check email exists or not
     * @param {string} $email : This is users email id
     * @return {boolean} $result : TRUE/FALSE
     */
    function checkEmailExist($email)
    {
        $this->db->select('id');
        $this->db->where('email', $email);
        $this->db->where('deleted', 2);
        $query = $this->db->get('k_user');

        if ($query->num_rows() > 0){
            return true;
        } else {
            return false;
        }
    }


    /**
     * This function used to insert reset password data
     * @param {array} $data : This is reset password data
     * @return {boolean} $result : TRUE/FALSE
     */
    function resetPasswordUser($data)
    {
        $result = $this->db->insert('k_reset_password', $data);

        if($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * This function is used to get customer information by email-id for forget password email
     * @param string $email : Email id of customer
     * @return object $result : Information of customer
     */
    function getCustomerInfoByEmail($email)
    {
        $this->db->select('id, email, name');
        $this->db->from('k_user');
        $this->db->where('deleted', 2);
        $this->db->where('email', $email);
        $query = $this->db->get();

        return $query->result();
    }

    /**
     * This function used to check correct activation deatails for forget password.
     * @param string $email : Email id of user
     * @param string $activation_id : This is activation string
     */
    function checkActivationDetails($email, $activation_id)
    {
        $this->db->select('id');
        $this->db->from('k_reset_password');
        $this->db->where('email', $email);
        $this->db->where('activation_id', $activation_id);
        $query = $this->db->get();
        return $query->num_rows;
    }

    // This function used to create new password by reset link
    function createPasswordUser($email, $password)
    {
        $this->db->where('email', $email);
        $this->db->where('isDeleted', 0);
        $this->db->update('k_user', array('password'=>getHashedPassword($password)));
        $this->db->delete('p_reset_password', array('email'=>$email));
    }
}

?>
