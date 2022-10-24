<?php 
Class Error Extends CI_Controller {
	
function index() {
	$data['title'] 		= '<i class="icon-leaf"></i> Error';
	$data['body'] 		= 'error';
	$this->load->view('main', $data);	
}

}
