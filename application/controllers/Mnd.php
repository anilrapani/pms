<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mnd extends CI_Controller {

	public function index()
	{
		//I'm just using rand() function for data example
		$temp = "ANIL";
		$this->set_barcode($temp);
	}
	
	private function set_barcode($code)
	{
		//load library
		$this->load->library('zend');
		//load in folder Zend
		$this->zend->load('Zend/Barcode');
		//generate barcode
                
		$file = Zend_Barcode::render('code39', 'image', array('text'=>$code), array());
                //var_dump(imagepng($imageResource, 'public_html/img/barcode.png'));
                 $code = time().'1222';
        imagepng($file,"barcode/{$code}.png");
        $data['barcode'] = $code.'.png';
        $this->load->view('anil',$data);
                // $this->load->view('anil');
        
                
	}
	
}