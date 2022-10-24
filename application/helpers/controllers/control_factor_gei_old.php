<?php
Class Control_factor_gei Extends CI_Controller {

public function __construct() {
    parent::__construct();
	session_start();
	/* Verifica que se haya iniciado sesión correctamente */
	if(isset($_SESSION['sess'])) {
		/* Se inicio sesión sin problemas */
	}
	else {
		/* Redirecciona a pantalla de login */
		redirect("login");
	}
}

function index()
{
	$this->load->view('main');
}



/********************************************************************************************************************************
													FACTOR GEI GAS EFECTO INVERNADERO
********************************************************************************************************************************/


/********************************************************************************************************************************
																BOTONAZOS														
********************************************************************************************************************************/
/* Realiza la creación de un nuevo recibo, debe actuar como refresh de la pagina en ambos casos, solo que repetir_gei agrega los datos a la tabla correspondiente */
function creargei()
{
	$this->modelo_factor_gei->creargei();
	$submit = $this->input->post('enviar');
	if($submit=='repetirgei')
	{
	
		redirect("control_factor_gei/factor_gei/", 'refresh');
	
	}
	
}

function editar_gei($id=false)
{
	if($id)
	{
		$this->modelo_factor_gei->edicion_gei($id);
		$submit = $this->input->post('enviar');
		if ($submit=='actualizar_gei')
	{
		redirect("control_factor_gei/factor_gei");
	}
		else
			redirect("control_factor_gei/info_gei/$id");
	}
		else
	{
		redirect("error");
	}
}

function boton_borrar_gei($id=false)
{
	if($id)
	{
		$this->modelo_factor_gei->borrar_gei($id);
	}
	else
	{
		redirect("error");
	}
}

/****************************************************************************************
Controladores para cargarlos en la vista
****************************************************************************************/
//Main
function factor_gei()
{
	$submit = $this->input->post('enviar');
	if ($submit=='load_gdata')
	{
		redirect("control_factor_gei/factor_gei");
	}
	else
	{
		$this->modelo_factor_gei->creacione_factore();
		$this->modelo_factor_gei->ins_capitas();
		//redirect("control_factor_gei/le_diagnostik");

	
	
	$data['mostrardatos'] = $this->modelo_factor_gei->consulta_gei();
	$data['title'] = '<i class="icon-fire"></i> Gas Efecto Invernadero';
	$data['subtitle'] = 'Captura de Datos';
	$data['body'] = 'factor_gei';
	$this->load->view('main', $data);
}
}


//Crea la paginacion para la vista de edición de los datos en la tabla pdc_factor_gei

function edicion_gei($id=false)
{
	/* Es posible acceder a este controlador por medio de AJAX o mediante una página */
	if($id)
	{
		$data['info_gei'] = $this->modelo_factor_gei->info_gei($id);
		$data['consulta_gei'] = $this->modelo_factor_gei->consulta_gei();
		$data['title'] = '<i class="icon-fire"></i> Gas';
		$data['subtitle'] = 'Información a Editar';

		if(isset($_GET['ajax']))
		{
			$this->load->view('factor_gei_ver', $data);
		}
		else
		{
			$data['body'] = 'factor_gei_ver';
			$this->load->view('main', $data);
		}

	}
	else
	{
		redirect("error");
	}
}

/* Muestra el formulario de actualización de un registro existente */
function form_actualizar_gei($id=false)
{
	if($id)
	{
		$data['info_gei'] = $this->modelo_factor_gei->info_gei($id);
		$data['consulta_gei'] = $this->modelo_factor_gei->consulta_gei();
		$data['title'] = '<i class="icon-fire"></i> Gas';
		$data['subtitle'] = 'Actualizar Datos';
		$data['body'] = 'factor_gei_editar';
		$this->load->view('main', $data);
	}
	else
	{
		redirect("error");
	}
}




function metrica_gei_elec()
{
	$submit = $this->input->post('enviar');
	$year = $this->input->post('year');
	if($submit=='volver')
	{
		redirect("inicio");
	}
	else
	{
		if(empty($year))
		{
			$data['loadgei'] = $this->modelo_factor_gei->load_gei_table4();
		}
		$data['tittle'] = '<i class="icon-bolt"></i> Energía Eléctrica';
		$data['subtitle'] = 'Consumo de Electricidad 2011 -  ' .date("Y");
		$data['body'] = 'metricas_gei_elec';
		$this->load->view('main', $data);
}
}

function kwcperiodo_elec()
{
	$submit = $this->input->post('enviar');
		if($submit=='volver')
	{
		redirect("inicio");
	}
	$data['tittle'] = '<i class="icon-bolt"></i> Energía Eléctrica';
	$data['subtitle'] = 'Electricidad';
	$data['body'] = 'kwcapitayear_elec';
	$this->load->view('main', $data);
}

function kgcperiodo_elec()
{
	$submit = $this->input->post('enviar');
		if($submit=='volver')
	{
		redirect("inicio");
	}
	$data['tittle'] = '<i class="icon-bolt"></i> Energía Eléctrica';
	$data['subtitle'] = 'Electricidad';
	$data['body'] = 'kgcapitayear_elec';
	$this->load->view('main', $data);
}




function experimentala()
{
	$data['tittle'] = '<i class="icon-bolt"></i> Energía Eléctrica';
	$data['subtitle'] = 'Electricidad';
	$data['body'] = 'experimental01';
	$this->load->view('main', $data);

}

function experimentalb()
{
	$data['tittle'] = '<i class="icon-bolt"></i> Energía Eléctrica';
	$data['subtitle'] = 'Electricidad';
	$data['body'] = 'test_v001';
	$this->load->view('main', $data);
}






}//CIERRE DEL CONTROLLER
