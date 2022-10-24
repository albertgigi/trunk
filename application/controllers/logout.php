<?php
Class Logout Extends CI_Controller
{
	
public function __construct()
{
    parent::__construct();
	session_start();
	/* Verifica que se haya iniciado sesión correctamente */
	if(isset($_SESSION['sess'])) {
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
	$this->modelo_login->log_out();
	redirect('login');
}	
	
}
