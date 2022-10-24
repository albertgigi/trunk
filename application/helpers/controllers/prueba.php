<?php
Class prueba Extends CI_Controller
{
	
public function __construct()
{
    parent::__construct();
	/* Verifica que se haya iniciado sesión correctamente */
	session_start();
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
	$this->modelo_consumo_energia->panel_pdf();
	$data['servicios']	= $this->modelo_consumo_energia->servicios_catalogo();	
	$data['title'] 		= '<i class="icon-bolt"></i> Energía Eléctrica';
	$data['body'] 		= 'inicio_electricidad';
	$this->load->view('main', $data);	
}

}
