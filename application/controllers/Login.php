<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/* 
 * Copyright (C) 2017 Kastech
 * @project : touba316
 * @author : Kastech
 * @since : Dec 2, 2017
 * @version : 
 */

class Login extends CI_Controller
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        
        parent::__construct();
        $this->load->model('login_model');
    }

    /**
     * Index Page for this controller.
     */
    public function index()
    {
            
        $this->isLoggedIn();
    }
    
    /**
     * This function used to check the user is logged in or not
     */
    function isLoggedIn()
    {
        $isLoggedIn = $this->session->userdata('isLoggedIn');
        
        if(!isset($isLoggedIn) || $isLoggedIn != TRUE)
        {
            $this->load->model('k_master_vehicle_gate_model');
            $data['gatesList'] = $this->k_master_vehicle_gate_model->getGatesList();
            $this->load->view('login',$data);
        }
        else
        {
            redirect('/dashboard');
        }
    }
    
    
    /**
     * This function used to logged in user
     */
    public function loginMe()
    {
        
        
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|max_length[128]|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|max_length[32]');
        $this->form_validation->set_rules('gate_id', 'gate selection', 'required|max_length[32]');

        if($this->form_validation->run() == FALSE)
        {

            $this->index();
        }
        else
        {
                 
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $gate_id = $this->input->post('gate_id');
            
            $result = $this->login_model->loginMe($email, $password);
            $userStatus = 2;
            $sessionArray['role'] = 0;
            if(count($result) > 0)
            {
                foreach ($result as $res)
                {
                    $sessionArray = array('userId'=>$res->user_id,                    
                                            'role'=>$res->role_id,
                                            'roleText'=>$res->role_name,
                                            'name'=>$res->user_name,
                                            'isLoggedIn' => TRUE
                                    );
                                    
                  $userStatus = $res->user_status;
                    
                }
                
                
                
                if($userStatus == 2){
                    $this->session->set_flashdata('error', 'User is not activated!');
                    redirect('/login');
                }
                
                if($sessionArray['role'] != 2 && $this->config->item('enable_gate_restriction_for_employee_at_employee_login') == TRUE || $this->config->item('enable_ip_restriction_for_employee_at_employee_login') == TRUE){
                        $this->load->model('k_master_vehicle_gate_model');
                        $ip = $this->input->ip_address();
                        $inputArray = array(
                            'user_id'   =>  $sessionArray['userId'],
                            'ipaddress' =>  $ip,
                            'vehicle_gate_id' =>   $gate_id
                        );

                        $gate_access = $this->k_master_vehicle_gate_model->checkForUserAccess($inputArray);
                    
                        if(count($gate_access) > 0){
                            echo 'if';
                        }else{
                            echo 'else'; 
                                $this->session->set_flashdata('error', 'Gate Access denied!');
                            redirect('/login');
                            
                        }
                       
//                            echo "<pre>";
//                        echo $this->db->last_query()."<br>";
//                        echo count($gate_access)."<br>";
//                        var_dump($gate_access)."<br>";
//                        exit;

                        
                }
                 $sessionArray['login_gate_id'] = $gate_id;
                $this->session->set_userdata($sessionArray);
                redirect('/dashboard');
            }
            else
            {
                $this->session->set_flashdata('error', 'Email or password mismatch');
                
                redirect('/login');
            }
        }
    }

    /**
     * This function used to load forgot password view
     */
    public function forgotPassword()
    {
        $this->load->view('forgotPassword');
    }
    
    /**
     * This function used to generate reset password request link
     */
    function resetPasswordUser()
    {
        $status = '';
        
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('login_email','Email','trim|required|valid_email');
                
        if($this->form_validation->run() == FALSE)
        {
            $this->forgotPassword();
        }
        else 
        {
            $email = $this->input->post('login_email');
            
            if($this->login_model->checkEmailExist($email))
            {
                $encoded_email = urlencode($email);
                
                $this->load->helper('string');
                $data['email'] = $email;
                $data['activation_id'] = random_string('alnum',15);
                $data['create_time'] = date('Y-m-d H:i:s');
                $data['agent'] = getBrowserAgent();
                $data['client_ip'] = $this->input->ip_address();
                
                $save = $this->login_model->resetPasswordUser($data);                
                
                if($save)
                {
                    $data1['reset_link'] = base_url() . "resetPasswordConfirmUser/" . $data['activation_id'] . "/" . $encoded_email;
                    $userInfo = $this->login_model->getCustomerInfoByEmail($email);

                    if(!empty($userInfo)){
                        $data1["name"] = $userInfo[0]->name;
                        $data1["email"] = $userInfo[0]->email;
                        $data1["message"] = "Reset Your Password";
                    }

                    $sendStatus = resetPasswordEmail($data1);

                    if($sendStatus){
                        $status = "send";
                        setFlashData($status, "Reset password link sent successfully, please check mails.");
                    } else {
                        $status = "notsend";
                        setFlashData($status, "Email has been failed, try again.");
                    }
                }
                else
                {
                    $status = 'unable';
                    setFlashData($status, "It seems an error while sending your details, try again.");
                }
            }
            else
            {
                $status = 'invalid';
                setFlashData($status, "This email is not registered with us.");
            }
            redirect('/forgotPassword');
        }
    }

    // This function used to reset the password 
    function resetPasswordConfirmUser($activation_id, $email)
    {
        // Get email and activation code from URL values at index 3-4
        $email = urldecode($email);
        
        // Check activation id in database
        $is_correct = $this->login_model->checkActivationDetails($email, $activation_id);
        
        $data['email'] = $email;
        $data['activation_code'] = $activation_id;
        
        if ($is_correct == 1)
        {
            $this->load->view('newPassword', $data);
        }
        else
        {
            redirect('/login');
        }
    }
    
    // This function used to create new password
    function createPasswordUser()
    {
        $status = '';
        $message = '';
        $email = $this->input->post("email");
        $activation_id = $this->input->post("activation_code");
        
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('password','Password','required|max_length[20]');
        $this->form_validation->set_rules('cpassword','Confirm Password','trim|required|matches[password]|max_length[20]');
        
        if($this->form_validation->run() == FALSE)
        {
            $this->resetPasswordConfirmUser($activation_id, urlencode($email));
        }
        else
        {
            $password = $this->input->post('password');
            $cpassword = $this->input->post('cpassword');
            
            // Check activation id in database
            $is_correct = $this->login_model->checkActivationDetails($email, $activation_id);
            
            if($is_correct == 1)
            {                
                $this->login_model->createPasswordUser($email, $password);
                
                $status = 'success';
                $message = 'Password changed successfully';
            }
            else
            {
                $status = 'error';
                $message = 'Password changed failed';
            }
            
            setFlashData($status, $message);

            redirect("/login");
        }
    }


}

?>