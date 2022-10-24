<?php 
Class Login Extends CI_Controller
{

public function __construct()
{
    parent::__construct();
	session_start();
	/* Verifica que se haya iniciado sesión correctamente */
	if(isset($_SESSION['sess']['logged']))
	{
		/* Se inicio sesión sin problemas */
		redirect("inicio");
	}
	else
	{

	}
}
	
function index() {
	
	$data['body'] = 'formulario_login';
	$data['title'] = 'Inicio de sesión';
	$this->load->view("main", $data);
}

function log_in()
{
	$this->modelo_login->log_in('pdc_usuarios', $this->input->post("nombre"), $this->input->post("password"));
	
	if(isset($_SESSION['sess']['logged']))
	{
		redirect('/inicio');
	}
	else
	{
		$ldap_user_data = $this->modelo_login->ldap_user_data('pdc_usuarios', $this->input->post("nombre"), $this->input->post("password"));
		$data['nombre'] = $this->input->post("nombre");
		$data['user'] = $ldap_user_data['user'];
		$data['sesion'] = $ldap_user_data['status'];
		$data['body'] = 'formulario_login';
		$data['title'] = 'Inicio de sesión';
		$this->load->view("main", $data);
	}
	
	
}	

}