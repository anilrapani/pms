<?php

function setemail()
{
// $email="arapani@kastechindia.com";
$email="anil.rapani@gmail.com";
$subject="Parking";
$message="some text";
sendEmail($email,$subject,$message);
}
function sendEmail($email,$subject,$message)
    {

    $config = Array(
      'protocol' => 'smtp',
      'smtp_host' => 'ssl://smtp.googlemail.com',
      'smtp_port' => 465,
      'smtp_user' => 'test.webap@gmail.com', 
      'smtp_pass' => '1234512345t', 
      'mailtype' => 'html',
      'charset' => 'iso-8859-1',
      'wordwrap' => TRUE
    );


          $this->load->library('email', $config);
          $this->email->set_newline("\r\n");
          $this->email->from('test.webap@gmail.com');
          $this->email->to($email);
          $this->email->subject($subject);
          $this->email->message($message);
            $this->email->attach('G:\xampp\htdocs\pms\email_test\sample3.jpg');
          if($this->email->send())
         {
          echo 'Email send.';
         }
         else
        {
         show_error($this->email->print_debugger());
        }

    }
    
    setemail();