<?php
Class Inicio Extends CI_Controller
{
	
public function __construct()
{
    parent::__construct();
	/* Verifica que se haya iniciado sesión correctamente */
	session_start();
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

function index()
{
	$data['body'] = "inicio";
	$this->load->view("main-front", $data);
}

}
