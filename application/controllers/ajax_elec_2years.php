<?php
Class ajax_elec_2years Extends CI_Controller
{
	
public function __construct()
{
    parent::__construct();
	session_start();
	/* Verifica que se haya iniciado sesión correctamente */
	if(isset($_SESSION['sess']))
	{
		/* Se inicio sesión sin problemas */
	}
	else
	{
		/* Redirecciona a pantalla de login */
		redirect("login");
	}
}


function ajax_elec_2years()
{
	
		$data['body'] = 'ajax_elec_2years_true';
		$this->load->view('main', $data);

	}