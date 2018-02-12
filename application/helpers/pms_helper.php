<?php if(!defined('BASEPATH')) exit('No direct script access allowed');


/**
 * This function is used to print the content of any data
 */
function pre($data)
{
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}

/**
 * This function used to get the CI instance
 */
if(!function_exists('get_instance'))
{
    function get_instance()
    {
        $CI = &get_instance();
    }
}

/**
 * This function used to generate the hashed password
 * @param {string} $plainPassword : This is plain text password
 */
if(!function_exists('getHashedPassword'))
{
    function getHashedPassword($plainPassword)
    {
        return password_hash($plainPassword, PASSWORD_DEFAULT);
    }
}

/**
 * This function used to generate the hashed password
 * @param {string} $plainPassword : This is plain text password
 * @param {string} $hashedPassword : This is hashed password
 */
if(!function_exists('verifyHashedPassword'))
{
    function verifyHashedPassword($plainPassword, $hashedPassword)
    {
        return password_verify($plainPassword, $hashedPassword) ? true : false;
    }
}

/**
 * This method used to get current browser agent
 */
if(!function_exists('getBrowserAgent'))
{
    function getBrowserAgent()
    {
        $CI = get_instance();
        $CI->load->library('user_agent');

        $agent = '';

        if ($CI->agent->is_browser())
        {
            $agent = $CI->agent->browser().' '.$CI->agent->version();
        }
        else if ($CI->agent->is_robot())
        {
            $agent = $CI->agent->robot();
        }
        else if ($CI->agent->is_mobile())
        {
            $agent = $CI->agent->mobile();
        }
        else
        {
            $agent = 'Unidentified User Agent';
        }

        return $agent;
    }
}

if(!function_exists('setProtocol'))
{
    function setProtocol()
    {
        $CI = &get_instance();
                    
        $CI->load->library('email');
        
        $config['protocol'] = PROTOCOL;
        $config['mailpath'] = MAIL_PATH;
        $config['smtp_host'] = SMTP_HOST;
        $config['smtp_port'] = SMTP_PORT;
        $config['smtp_user'] = SMTP_USER;
        $config['smtp_pass'] = SMTP_PASS;
        $config['charset'] = "utf-8";
        $config['mailtype'] = "html";
        $config['newline'] = "\r\n";
        
        $CI->email->initialize($config);
        
        return $CI;
    }
}

if(!function_exists('emailConfig'))
{
    function emailConfig()
    {
        $CI->load->library('email');
        $config['protocol'] = PROTOCOL;
        $config['smtp_host'] = SMTP_HOST;
        $config['smtp_port'] = SMTP_PORT;
        $config['mailpath'] = MAIL_PATH;
        $config['charset'] = 'UTF-8';
        $config['mailtype'] = "html";
        $config['newline'] = "\r\n";
        $config['wordwrap'] = TRUE;
    }
}

if(!function_exists('resetPasswordEmail'))
{
    function resetPasswordEmail($detail)
    {
        $data["data"] = $detail;
        // pre($detail);
        // die;
        
        $CI = setProtocol();        
        
        $CI->email->from(EMAIL_FROM, FROM_NAME);
        $CI->email->subject("Reset Password");
        $CI->email->message($CI->load->view('email/resetPassword', $data, TRUE));
        $CI->email->to($detail["email"]);
        $status = $CI->email->send();
        
        return $status;
    }
}

if(!function_exists('setFlashData'))
{
    function setFlashData($status, $flashMsg)
    {
        $CI = get_instance();
        $CI->session->set_flashdata($status, $flashMsg);
    }
}


if ( ! function_exists('active_link'))
{
    function active_link($controller)
    {
        $CI =& get_instance();
         
        $class = $CI->router->fetch_class();
        
        return ($class == $controller) ? 'active' : '';
    }
}

if ( ! function_exists('convertTime'))
{
    /**
 * 
 * @param type $dateTime
 * @param type $timeZoneName
 * @param type $utc default false convert the passed  datetime to utc time
 * $utc passed as true convert the utc datetime to passed timezone format
 * @return type
 */
function convertTime($dateTime, $timeZoneName, $utc = FALSE) {
    // based on location $timeZoneName add or substract hours for gst currently set to India only as it is used only in india
    if($timeZoneName == 'IST'){
        return date('Y-m-d H:i:s',strtotime('+330 minutes',strtotime($dateTime)));
    }
//    if($timeZoneName == 'UTC'){
//        return date('Y-m-d H:i:s',strtotime('-330 minutes',strtotime($dateTime)));
//    }
    


}
}

if ( ! function_exists('minutes_to_hours_n_minutes'))
{
    function minutes_to_hours_n_minutes($number,$divider)
    {
        $arr['hours'] = str_pad((floor($number / $divider)), 2, 0, STR_PAD_LEFT);
        $arr['minutes'] = str_pad(($number % $divider), 2, 0, STR_PAD_LEFT);
        return $arr;
    }
}


if ( ! function_exists('thumbnail_from_image_data'))
{
    function thumbnail_from_image_data($WIDTH,$HEIGHT,$image_data,$image_name,$path_to_upload,$width_orig,$height_orig)
    {
        $image_dimension = $WIDTH;
        
    
        $ratio_orig = $width_orig/$height_orig;
        if($WIDTH == 'original'){
            $WIDTH = $width_orig;
            $HEIGHT = $WIDTH+1;
        }
            if ($WIDTH/$HEIGHT > $ratio_orig) {
                $WIDTH = $HEIGHT*$ratio_orig;
            } else {
                $HEIGHT = $WIDTH/$ratio_orig;
            }
        

        $image_data = str_replace('data:image/png;base64,', '', $image_data);
        $image_data = str_replace(' ', '+', $image_data);
        

        $theme_image_little = imagecreatefromstring(base64_decode($image_data));

        $image_little = imagecreatetruecolor($WIDTH, $HEIGHT);

        // $org_w and org_h depends of your image, in your case, i guess 800 and 600
        imagecopyresampled($image_little, $theme_image_little, 0, 0, 0, 0, $WIDTH, $HEIGHT, $width_orig, $height_orig);

        // Thanks to Michael Robinson
        // start buffering
        ob_start();
        imagepng($image_little);
        $contents =  ob_get_contents();
        ob_end_clean();
        
        file_put_contents(APPPATH .$path_to_upload.$image_dimension.'/'.$image_name,$contents);

    }
}


if ( ! function_exists('fc_path_forward'))
{
    function fc_path_forward(){
        $fpath = FCPATH;
        $fpath =  str_replace('\\', '/', $fpath);       
    }
}



?>