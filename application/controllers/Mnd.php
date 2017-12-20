<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mnd extends CI_Controller {

	public function index()
	{
		//I'm just using rand() function for data example
		$temp = "32132131";
		$this->set_barcode($temp);
	}
	
	private function set_barcode($code)
	{
		//load library
		$this->load->library('zend');
		//load in folder Zend
		$this->zend->load('Zend/Barcode');
		//generate barcode
                
		$file = Zend_Barcode::draw('code128', 'image', array('text'=>$code), array());
                
                $code = time().'1222';
        imagepng($file,"barcode/{$code}.png");
        $data['barcode'] = $code.'.png';
        // $data['bar'] = $bar;
        $this->load->view('anil',$data);
                // $this->load->view('anil');
        
                
	}
	
}