<?php
require APPPATH . '/libraries/BaseController.php';
/* 
 * Copyright (C) 2017 Kastech
 * @project : touba316
 * @author : Anil Rapani
 * @email : arapani@kastechindia.com
 * @since : Dec 2, 2017
 * @version : 
 */

class User extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->isLoggedIn();   
    }
    
    /**
     * This function used to load the first screen of the user
     */
    public function index()
    {
        $this->global['pageTitle'] = PROJECT_NAME.' : Dashboard';
        $count = $this->user_model->userListingCount();
        $data['userCount'] = $count;
        $this->loadViews("dashboard", $this->global, $data , NULL);
    }
    
    /**
     * This function is used to load the user list
     */
    function userListing()
    {
        if(!array_key_exists(24,$this->role_privileges))
        {
            $this->loadThis();
        }
        else
        {
            $this->load->model('user_model');
        
            $searchText = $this->input->post('searchText');
            $data['searchText'] = $searchText;
            
            $this->load->library('pagination');
            
            $count = $this->user_model->userListingCount($searchText);
            $returns["offset"] = 0;
            $returns = $this->paginationCompress ( "userListing/", $count, 5, SEGMENT );
            
            $data['userRecords'] = $this->user_model->userListing($searchText, $returns["page"], $returns["offset"]);
            $data['offset'] = $returns["offset"];
            $this->global['pageTitle'] = PROJECT_NAME. ' : Employee Listing';
                 $this->global['assets'] = array('cssTopArray'     => array(base_url() . 'assets/plugins/iCheck/all'),
                              'cssBottomArray'  => array(),
                              'jsTopArray'      => array(),
                              'jsBottomArray'   => array(base_url() . 'assets/plugins/iCheck/icheck')
                              
                    );
            $this->loadViews("users", $this->global, $data, $this->global);
        }
    }

    /**
     * This function is used to load the add new form
     */
    function addNew()
    {
        if(!array_key_exists(24,$this->role_privileges))
        {
            $this->loadThis();
        }
        else
        {
            $this->load->model('user_model');
            $this->load->model(array('k_master_government_proof_type_model','k_master_user_company_model','k_master_user_shift_model'));
            $data['roles'] = $this->user_model->getUserRoles();
            
            $data['governmentProofTypes'] = $this->k_master_government_proof_type_model->get();
            $data['employeeCompanies'] = $this->k_master_user_company_model->get();
            $data['employeeShifts'] = $this->k_master_user_shift_model->get();
            
            $this->global['pageTitle'] = PROJECT_NAME. ' : Add New User';

            $this->loadViews("addNew", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to check whether email already exist or not
     */
    function checkEmailExists()
    {
        $userId = $this->input->post("userId");
        $email = $this->input->post("email");
        
        if(empty($userId)){
            $result = $this->user_model->checkEmailExists($email);
        } else {
            $result = $this->user_model->checkEmailExists($email, $userId);
        }
        
        if(empty($result)){ echo("true"); }
        else { echo("false"); }
    }
    
    /**
     * This function is used to add new user to the system
     */
    function addNewUser()
    {
        if(!array_key_exists(24,$this->role_privileges))
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('fname','Full Name','trim|required|max_length[128]');
            $this->form_validation->set_rules('email','Email','trim|required|valid_email|max_length[128]');
            $this->form_validation->set_rules('password','Password','required|max_length[20]');
            $this->form_validation->set_rules('cpassword','Confirm Password','trim|required|matches[password]|max_length[20]');
            $this->form_validation->set_rules('role','Role','trim|required|numeric');
            $this->form_validation->set_rules('mobile','Mobile Number','required|min_length[10]');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->addNew();
            }
            else
            {
                $name = ucwords(strtolower($this->input->post('fname')));
                $email = $this->input->post('email');
                $password = $this->input->post('password');
                $roleId = $this->input->post('role');
                $mobile = $this->input->post('mobile');
                $government_proof_type_id = $this->input->post('government_proof_type_id');
                $government_id_number = $this->input->post('government_id_number');
                $user_company_id = $this->input->post('user_company_id');
                $shift_id = $this->input->post('shift_id');
                $status = $this->input->post('status');
                
                
                $userInfo = array('email'=>$email, 
                                  'password'=>getHashedPassword($password), 
                                  'role_id'=>$roleId,
                                  'name'=> $name,
                                  'mobile'=>$mobile,
                                  'government_proof_type_id' => $government_proof_type_id,
                                  'government_id_number'   => $government_id_number,
                                  'user_company_id'    => $user_company_id,
                                  'shift_id'   => $shift_id,
                                  'status' => $status,
                                  'created_by'=>$this->vendorId,
                                  'created_time'=>date('Y-m-d H:i:s')
                    );
                
                $this->load->model('user_model');
                $result = $this->user_model->addNewUser($userInfo);
                
                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'New User created successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'User creation failed');
                }
                
                redirect('addNew');
            }
        }
    }

    
    /**
     * This function is used load user edit information
     * @param number $userId : Optional : This is user id
     */
    function editOld($userId = NULL)
    {
        if(!array_key_exists(24,$this->role_privileges)){
            $this->loadThis();
        }
        else
        {
            if($userId == null)
            {
                redirect('userListing');
            }
            
            $data['roles'] = $this->user_model->getUserRoles();
            $data['userInfo'] = $this->user_model->getUserInfo($userId);
            $this->load->model(array('k_master_government_proof_type_model','k_master_user_company_model','k_master_user_shift_model')); 
            $data['governmentProofTypes'] = $this->k_master_government_proof_type_model->get();
            $data['employeeCompanies'] = $this->k_master_user_company_model->get();
            $data['employeeShifts'] = $this->k_master_user_shift_model->get();
            
            $this->global['pageTitle'] = PROJECT_NAME. ' : Edit User';
            
            $this->loadViews("editOld", $this->global, $data, NULL);
        }
    }
    
    
    /**
     * This function is used to edit the user information
     */
    function editUser()
    {
        if(!array_key_exists(24,$this->role_privileges))
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            
            $userId = $this->input->post('userId');
            
            $this->form_validation->set_rules('fname','Full Name','trim|required|max_length[128]');
            $this->form_validation->set_rules('email','Email','trim|required|valid_email|max_length[128]');
            $this->form_validation->set_rules('password','Password','matches[cpassword]|max_length[20]');
            $this->form_validation->set_rules('cpassword','Confirm Password','matches[password]|max_length[20]');
            $this->form_validation->set_rules('role','Role','trim|required|numeric');
            $this->form_validation->set_rules('mobile','Mobile Number','required|min_length[10]');
            
            
            if($this->form_validation->run() == FALSE)
            {
                $this->editOld($userId);
            }
            else
            {
                $name = ucwords(strtolower($this->input->post('fname')));
                $email = $this->input->post('email');
                $password = $this->input->post('password');
                $roleId = $this->input->post('role');
                $mobile = $this->input->post('mobile');
                
                 $government_proof_type_id = $this->input->post('government_proof_type_id');
                $government_id_number = $this->input->post('government_id_number');
                $user_company_id = $this->input->post('user_company_id');
                $shift_id = $this->input->post('shift_id');
                $status = $this->input->post('status');
                
                $userInfo = array();
                
                if(empty($password))
                {
                    $userInfo = array('email'=>$email, 'role_id'=>$roleId, 'name'=>$name,
                                        'government_proof_type_id' => $government_proof_type_id,
                                        'government_id_number'   => $government_id_number,
                                        'user_company_id'    => $user_company_id,
                                        'shift_id'   => $shift_id,
                                        'status'   => $status,
                                        'mobile'=>$mobile, 'updated_by'=>$this->vendorId, 'updated_time'=>date('Y-m-d H:i:s'));
                }
                else
                {
                    $userInfo = array('email'=>$email, 'password'=>getHashedPassword($password), 'role_id'=>$roleId,
                        'name'=>ucwords($name), 'mobile'=>$mobile, 'updated_by'=>$this->vendorId, 
                        'updated_time'=>date('Y-m-d H:i:s'));
                }
                
                $result = $this->user_model->editUser($userInfo, $userId);
                
                if($result == true)
                {
                    $this->session->set_flashdata('success', 'User updated successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'User updation failed');
                }
                
                redirect('userListing');
            }
        }
    }


    /**
     * This function is used to delete the user using userId
     * @return boolean $result : TRUE / FALSE
     */
    function deleteUser()
    {
        
        if(!array_key_exists(24,$this->role_privileges))
        {
            echo(json_encode(array('status'=>'access')));
        
        }
        else
        {
            $userId = $this->input->post('id');
            $userInfo = array('deleted'=>1,'updated_by'=>$this->vendorId, 'updated_time'=>date('Y-m-d H:i:s'));
           
            $result = $this->user_model->deleteUser($userId, $userInfo);
            
            if ($result > 0) { echo(json_encode(array('status'=>TRUE))); }
            else { echo(json_encode(array('status'=>FALSE))); }
        }
    }
    function updateUserStatus() {

        if(!array_key_exists(24,$this->role_privileges)){
            echo(json_encode(array('status' => 'access')));
        } else {
            $id = $this->input->post('id');
            $status = $this->input->post('status');
            $data = array('status' => $status, 'updated_by' => $this->vendorId, 'updated_time' => date('Y-m-d H:i:s'));
            $result = $this->user_model->update($data, $id);
            if ($result > 0) {
                echo(json_encode(array('status' => TRUE)));
            } else {
                echo(json_encode(array('status' => FALSE)));
            }
        }
    }
    /**
     * This function is used to load the change password screen
     */
    function loadChangePass()
    {
        if(!array_key_exists(22,$this->role_privileges)){
            $this->loadThis();
        }else{
            $this->global['pageTitle'] = PROJECT_NAME. ' : Change Password';

            $this->loadViews("changePassword", $this->global, NULL, NULL);
        }
    }
    
    
    /**
     * This function is used to change the password of the user
     */
    function changePassword()
    {
        if(!array_key_exists(22,$this->role_privileges)){
            $this->loadThis();
        }else{
        
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('oldPassword','Old password','required|max_length[20]');
        $this->form_validation->set_rules('newPassword','New password','required|max_length[20]');
        $this->form_validation->set_rules('cNewPassword','Confirm new password','required|matches[newPassword]|max_length[20]');
        
        if($this->form_validation->run() == FALSE)
        {
            $this->loadChangePass();
        }
        else
        {
            $oldPassword = $this->input->post('oldPassword');
            $newPassword = $this->input->post('newPassword');
            
            $resultPas = $this->user_model->matchOldPassword($this->vendorId, $oldPassword);
            
            if(empty($resultPas))
            {
                $this->session->set_flashdata('nomatch', 'Your old password not correct');
                redirect('loadChangePass');
            }
            else
            {
                $usersData = array('password'=>getHashedPassword($newPassword), 'updated_by'=>$this->vendorId,
                                'updated_time'=>date('Y-m-d H:i:s'));
                
                $result = $this->user_model->changePassword($this->vendorId, $usersData);
                
                if($result > 0) { $this->session->set_flashdata('success', 'Password updation successful'); }
                else { $this->session->set_flashdata('error', 'Password updation failed'); }
                
                redirect('loadChangePass');
            }
        }
        }
    }

    function pageNotFound()
    {
        $this->global['pageTitle'] = 'Touba : 404 - Page Not Found';
        
        $this->loadViews("404", $this->global, NULL, NULL);
    }
}

?>