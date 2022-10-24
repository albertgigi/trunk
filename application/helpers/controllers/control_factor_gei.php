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
/********************************************************CIERRE*******************************************************/
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
/********************************************************CIERRE*******************************************************/

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
/********************************************************CIERRE*******************************************************/

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
/********************************************************CIERRE*******************************************************/

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
/********************************************************CIERRE*******************************************************/

/*CONTROL PARA MANDAR LLAMAR LA GRÁFICA ANUAL DE ELECTRICIDAD (HIGHCHARTS)*/
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
		//$data['subtitle'] = 'Consumo de Electricidad 2011 - 2018';
		$data['body'] = 'metricas_gei_elec';
		$this->load->view('main', $data);
}
}
/********************************************************CIERRE*******************************************************/

/*CONTROL PARA MANDAR LLAMAR LA GRÁFICA DE KWh PER CAPITA POR AÑO EN ELECTRICIDAD (HIGHCHARTS)*/
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
/********************************************************CIERRE*******************************************************/

/*CONTROL PARA MANDAR LLAMAR LA GRÁFICA DE Kg PER CAPITA POR AÑO EN ELECTRICIDAD (HIGHCHARTS)*/
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
/********************************************************CIERRE*******************************************************/

/*CONTROL PARA MANDAR LLAMAR LA GRÁFICA ANUAL DE AGUA (HIGHCHARTS)*/

function metrica_gei_agua()
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
			$data['loadgei_a'] = $this->modelo_factor_gei->load_gei_agua();
		}
		$data['tittle'] = '<i class="icon-tint"></i> Energía Liquida';
		$data['subtitle'] = 'Consumo de Agua 2011 -  ' .date("Y");
		$data['body'] = 'metricas_gei_agua';
		$this->load->view('main', $data);
}
}
/********************************************************CIERRE*******************************************************/

/*CONTROL PARA MANDAR LLAMAR LA GRÁFICA DE KWh PER CAPITA POR AÑO EN AGUA (HIGHCHARTS)*/
function m3cperiodo_agua()
{
	$submit = $this->input->post('enviar');
		if($submit=='volver')
	{
		redirect("inicio");
	}
	$data['tittle'] = '<i class="icon-tint"></i> Energía Líquida';
	$data['subtitle'] = 'Agua';
	$data['body'] = 'm3cperiodo_agua';
	$this->load->view('main', $data);
}
/********************************************************CIERRE*******************************************************/

/*CONTROL PARA MANDAR LLAMAR LA GRÁFICA DE Kg PER CAPITA POR AÑO EN AGUA (HIGHCHARTS)*/
function wtrkgcperiodo_agua()
{
	$submit = $this->input->post('enviar');
		if($submit=='volver')
	{
		redirect("inicio");
	}
	$data['tittle'] = '<i class="icon-tint"></i> Energía Líquida';
	$data['subtitle'] = 'Agua';
	$data['body'] = 'wtrkgcperiodo_agua';
	$this->load->view('main', $data);
}
/********************************************************CIERRE*******************************************************/

/*CONTROL PARA MANDAR LLAMAR LA GRÁFICA ANUAL DE GAS (HIGHCHARTS)*/

function metrica_gei_gas()
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
			$data['loadgei_g'] = $this->modelo_factor_gei->load_gei_gas();
		}
		$data['title'] = '<i class="icon-fire"></i> Energia Gas Natural';
		$data['subtitle'] = 'Consumo de Gas 2011 -  ' .date("Y");
		$data['body'] = 'metricas_gei_gas';
		$this->load->view('main', $data);
	}
}
/********************************************************CIERRE*******************************************************/

/*CONTROL PARA MANDAR LLAMAR LA GRÁFICA DE M3 PER CAPITA POR AÑO EN GAS (HIGHCHARTS)*/
function m3cperiodo_gas()
{
	$submit = $this->input->post('enviar');
		if($submit=='volver')
	{
		redirect("inicio");
	}
	$data['tittle'] = '<i class="icon-fire"></i> Energía Líquida';
	$data['subtitle'] = 'Gas';
	$data['body'] = 'm3cperiodo_gas';
	$this->load->view('main', $data);
}
/********************************************************CIERRE*******************************************************/
/*CONTROL PARA MANDAR LLAMAR LA GRÁFICA DE kg PER CAPITA POR AÑO EN GAS (HIGHCHARTS)*/
function gaskgcperiodo_gas()
{
	$submit = $this->input->post('enviar');
		if($submit=='volver')
	{
		redirect("inicio");
	}
	$data['tittle'] = '<i class="icon-fire"></i> Energía Líquida';
	$data['subtitle'] = 'Gas';
	$data['body'] = 'gaskgcperiodo_gas';
	$this->load->view('main', $data);
}


/********************************************************CIERRE*******************************************************/
function experimentala()
{
	$data['tittle'] = '<i class="icon-bolt"></i> Energía Eléctrica';
	$data['subtitle'] = 'Electricidad';
	$data['body'] = 'experimental01';
	$this->load->view('main', $data);

}
/********************************************************CIERRE*******************************************************/
function experimentalb()
{
	$data['tittle'] = '<i class="icon-bolt"></i> Energía Eléctrica';
	$data['subtitle'] = 'Electricidad';
	$data['body'] = 'test_v001';
	$this->load->view('main', $data);
}
/********************************************************CIERRE*******************************************************/

/*****************CONTROL PARA MOSTRAR GRÁFICA DE CONSUMO EN AGUA POTABLE Y RESIDUAL***************************/
/*function metricas_aguas_mediciones()
{
	$submit = $this->input->post('enviar');
		if($submit=='volver')
	{
		redirect("inicio");
	}
	$this->modelo_factor_gei->drope_pot_res();
	$this->modelo_factor_gei->creacione_pot_res();
	$data['tittle'] = '<i class="icon-tint"></i> Energía Líquida';
	$data['subtitle'] = 'Consumo 2014 -  ' .date("Y");
	$data['body'] = 'metricas_aguas_mediciones';
	$this->load->view('main', $data);
}*/
/********************************************************CIERRE*******************************************************/

/*****************CONTROL PARA MOSTRAR GRÁFICA DE CONSUMO EN AGUA POTABLE Y RESIDUAL***************************/
function metricas_aguas_mediciones()
{
	$submit = $this->input->post('enviar');
		if($submit=='volver')
	{
		redirect("inicio");
	}
	$this->modelo_factor_gei->drope_factwatcomp();
	$this->modelo_factor_gei->creacione_pdc_water_comp();
	$data['tittle'] = '<i class="icon-tint"></i> Energía Líquida';
	$data['subtitle'] = 'Consumo 2014 -  ' .date("Y");
	$data['body'] = 'metricas_aguas_mediciones';
	$this->load->view('main', $data);
}
/********************************************************CIERRE*******************************************************/



/*****************CONTROL PARA LA GRAFICA ANUAL EN TARIFA HM*****************/

function graf_tarifa_hmgpo()
{
	$submit = $this->input->post('enviar');
	$year = $this->input->post('year');
	if($submit=='volver')
	{
		redirect("inicio");
	}
	else
	{
		$this->modelo_factor_gei->creacione_tarifa_hmgpo();
		if(empty($year))
		{
			$data['loadtarhmgpo'] = $this->modelo_factor_gei->load_tar_hmgpo();
		}
		$data['title'] = '<i class="icon-bolt"></i> Energia Eléctrica';
		$data['subtitle'] = 'Tarifa HM 2011 -  ' .date("Y");
		$data['body'] = 'graf_tarifa_hmgpo_3d';
		$this->load->view('main', $data);
	}
}
/********************************************************CIERRE*******************************************************/

/*****************CONTROL PARA LA GRAFICA ANUAL EN TARIFA OM*****************/
function graf_tarifa_omgpo()
{
	$submit = $this->input->post('enviar');
	$year = $this->input->post('year');
	if($submit=='volver')
	{
		redirect("inicio");
	}
	else
	{
		$this->modelo_factor_gei->creacione_tarifa_omgpo();
		if(empty($year))
		{
			$data['loadtaromgpo'] = $this->modelo_factor_gei->load_tar_omgpo();
		}
		$data['title'] = '<i class="icon-bolt"></i> Energia Eléctrica';
		$data['subtitle'] = 'Tarifa OM 2011 -  ' .date("Y");
		$data['body'] = 'graf_tarifa_omgpo_3d';
		$this->load->view('main', $data);
	}
}
/********************************************************CIERRE*******************************************************/


/****************************************************************************************************************************/
//Genera el formulario para la tarífa HM por mes de cada año//


function tarifahm_meses()
{
	/*$this->modelo_factor_gei->tarhmfinaltransact();*/
	$submit = $this->input->post('enviar');
	$dep_tar_hm_final_x_mepo = $this->input->post('dep_tar_hm_final_x_mepo');

	if($submit=='volver')
	{
		redirect("inicio");
	}
	if($submit=='reloadhmfinal')
	{
		$this->modelo_factor_gei->tarhmfinaltransact();
		$this->modelo_factor_gei->droper_hm_final();
		$this->modelo_factor_gei->tarhmfinaltransact();
		redirect("control_factor_gei/tarifahm_meses");
	}
	else
	{
		// Carga combobox dependencia

		$data['catdephmfinal']	= $this->modelo_factor_gei->dep_hm_final();

		// Genera las consultas por dependencia
		$data['resdephmfinal1'] = $this->modelo_factor_gei->dep_hm_final_resultado();
		
		$data['dep_tar_hm_final_x_mepo'] = $dep_tar_hm_final_x_mepo;


	if(!empty($dep_tar_hm_final_x_mepo))
	{
		$data['EneroTotalHM'] = $this->modelo_factor_gei->EneroTotalHM($dep_tar_hm_final_x_mepo);
		$data['FebreroTotalHM'] = $this->modelo_factor_gei->FebreroTotalHM($dep_tar_hm_final_x_mepo);
		$data['MarzoTotalHM'] = $this->modelo_factor_gei->MarzoTotalHM($dep_tar_hm_final_x_mepo);
		$data['AbrilTotalHM'] = $this->modelo_factor_gei->AbrilTotalHM($dep_tar_hm_final_x_mepo);
		$data['MayoTotalHM'] = $this->modelo_factor_gei->MayoTotalHM($dep_tar_hm_final_x_mepo);
		$data['JunioTotalHM'] = $this->modelo_factor_gei->JunioTotalHM($dep_tar_hm_final_x_mepo);
		$data['JulioTotalHM'] = $this->modelo_factor_gei->JulioTotalHM($dep_tar_hm_final_x_mepo);
		$data['AgostoTotalHM'] = $this->modelo_factor_gei->AgostoTotalHM($dep_tar_hm_final_x_mepo);
		$data['SeptiembreTotalHM'] = $this->modelo_factor_gei->SeptiembreTotalHM($dep_tar_hm_final_x_mepo);
		$data['OctubreTotalHM'] = $this->modelo_factor_gei->OctubreTotalHM($dep_tar_hm_final_x_mepo);
		$data['NoviembreTotalHM'] = $this->modelo_factor_gei->NoviembreTotalHM($dep_tar_hm_final_x_mepo);
		$data['DiciembreTotalHM'] = $this->modelo_factor_gei->DiciembreTotalHM($dep_tar_hm_final_x_mepo);
	}	
	else{
			if(!!empty($dep_tar_hm_final_x_mepo))
	{
		$data['EneroTotalHM'] = $this->modelo_factor_gei->EneroTotalHM($dep_tar_hm_final_x_mepo);
		$data['FebreroTotalHM'] = $this->modelo_factor_gei->FebreroTotalHM($dep_tar_hm_final_x_mepo);
		$data['MarzoTotalHM'] = $this->modelo_factor_gei->MarzoTotalHM($dep_tar_hm_final_x_mepo);
		$data['AbrilTotalHM'] = $this->modelo_factor_gei->AbrilTotalHM($dep_tar_hm_final_x_mepo);
		$data['MayoTotalHM'] = $this->modelo_factor_gei->MayoTotalHM($dep_tar_hm_final_x_mepo);
		$data['JunioTotalHM'] = $this->modelo_factor_gei->JunioTotalHM($dep_tar_hm_final_x_mepo);
		$data['JulioTotalHM'] = $this->modelo_factor_gei->JulioTotalHM($dep_tar_hm_final_x_mepo);
		$data['AgostoTotalHM'] = $this->modelo_factor_gei->AgostoTotalHM($dep_tar_hm_final_x_mepo);
		$data['SeptiembreTotalHM'] = $this->modelo_factor_gei->SeptiembreTotalHM($dep_tar_hm_final_x_mepo);
		$data['OctubreTotalHM'] = $this->modelo_factor_gei->OctubreTotalHM($dep_tar_hm_final_x_mepo);
		$data['NoviembreTotalHM'] = $this->modelo_factor_gei->NoviembreTotalHM($dep_tar_hm_final_x_mepo);
		$data['DiciembreTotalHM'] = $this->modelo_factor_gei->DiciembreTotalHM($dep_tar_hm_final_x_mepo);
	}	
	}
	}
		$data['title']= '<i class="icon-bolt"></i> Energía Eléctrica';
		$data['subtitle'] = 'Tabla HM Mensual en KwH';
		$data['body'] = 'tar_hm_final_x_mepo_2';
		$this->load->view('main', $data);
}


/********************************************************CIERRE*******************************************************/


/****************************************************************************************************************************/
//Genera el formulario para la tarífa OM por mes de cada año//


function tarifaom_meses()
{
	/*$this->modelo_factor_gei->taromfinaltransact();*/
	$submit = $this->input->post('enviar');
	$dep_tar_om_final_x_mepo = $this->input->post('dep_tar_om_final_x_mepo');

	if($submit=='volver')
	{
		redirect("inicio");
	}
	if($submit=='reloadomfinal')
	{
		$this->modelo_factor_gei->taromfinaltransact();
		$this->modelo_factor_gei->droper_om_final();
		$this->modelo_factor_gei->taromfinaltransact();
		redirect("control_factor_gei/tarifaom_meses");
	}
	else
	{
		// Carga combobox dependencia

		$data['catdepomfinal']	= $this->modelo_factor_gei->dep_om_final();

		// Genera las consultas por dependencia
		$data['resdepomfinal1'] = $this->modelo_factor_gei->dep_om_final_resultado();
		
		$data['dep_tar_om_final_x_mepo'] = $dep_tar_om_final_x_mepo;


	if(!empty($dep_tar_om_final_x_mepo))
	{
		$data['EneroTotalOM'] = $this->modelo_factor_gei->EneroTotalOM($dep_tar_om_final_x_mepo);
		$data['FebreroTotalOM'] = $this->modelo_factor_gei->FebreroTotalOM($dep_tar_om_final_x_mepo);
		$data['MarzoTotalOM'] = $this->modelo_factor_gei->MarzoTotalOM($dep_tar_om_final_x_mepo);
		$data['AbrilTotalOM'] = $this->modelo_factor_gei->AbrilTotalOM($dep_tar_om_final_x_mepo);
		$data['MayoTotalOM'] = $this->modelo_factor_gei->MayoTotalOM($dep_tar_om_final_x_mepo);
		$data['JunioTotalOM'] = $this->modelo_factor_gei->JunioTotalOM($dep_tar_om_final_x_mepo);
		$data['JulioTotalOM'] = $this->modelo_factor_gei->JulioTotalOM($dep_tar_om_final_x_mepo);
		$data['AgostoTotalOM'] = $this->modelo_factor_gei->AgostoTotalOM($dep_tar_om_final_x_mepo);
		$data['SeptiembreTotalOM'] = $this->modelo_factor_gei->SeptiembreTotalOM($dep_tar_om_final_x_mepo);
		$data['OctubreTotalOM'] = $this->modelo_factor_gei->OctubreTotalOM($dep_tar_om_final_x_mepo);
		$data['NoviembreTotalOM'] = $this->modelo_factor_gei->NoviembreTotalOM($dep_tar_om_final_x_mepo);
		$data['DiciembreTotalOM'] = $this->modelo_factor_gei->DiciembreTotalOM($dep_tar_om_final_x_mepo);
	}	
	else{
			if(!!empty($dep_tar_om_final_x_mepo))
	{
		$data['EneroTotalOM'] = $this->modelo_factor_gei->EneroTotalOM($dep_tar_om_final_x_mepo);
		$data['FebreroTotalOM'] = $this->modelo_factor_gei->FebreroTotalOM($dep_tar_om_final_x_mepo);
		$data['MarzoTotalOM'] = $this->modelo_factor_gei->MarzoTotalOM($dep_tar_om_final_x_mepo);
		$data['AbrilTotalOM'] = $this->modelo_factor_gei->AbrilTotalOM($dep_tar_om_final_x_mepo);
		$data['MayoTotalOM'] = $this->modelo_factor_gei->MayoTotalOM($dep_tar_om_final_x_mepo);
		$data['JunioTotalOM'] = $this->modelo_factor_gei->JunioTotalOM($dep_tar_om_final_x_mepo);
		$data['JulioTotalOM'] = $this->modelo_factor_gei->JulioTotalOM($dep_tar_om_final_x_mepo);
		$data['AgostoTotalOM'] = $this->modelo_factor_gei->AgostoTotalOM($dep_tar_om_final_x_mepo);
		$data['SeptiembreTotalOM'] = $this->modelo_factor_gei->SeptiembreTotalOM($dep_tar_om_final_x_mepo);
		$data['OctubreTotalOM'] = $this->modelo_factor_gei->OctubreTotalOM($dep_tar_om_final_x_mepo);
		$data['NoviembreTotalOM'] = $this->modelo_factor_gei->NoviembreTotalOM($dep_tar_om_final_x_mepo);
		$data['DiciembreTotalOM'] = $this->modelo_factor_gei->DiciembreTotalOM($dep_tar_om_final_x_mepo);
	}	
	}
	}
		$data['title']= '<i class="icon-bolt"></i> Energía Eléctrica';
		$data['subtitle'] = 'Tabla OM Mensual en KwH';
		$data['body'] = 'tar_om_final_x_mepo_2';
		$this->load->view('main', $data);
}

/********************************************************CIERRE*******************************************************/

function desgloze_total_electricidad()
{

	$submit = $this->input->post('enviar');

	if($submit=='volver')
	{
		redirect("inicio");
	}
	if($submit=='reloadalldepelec')
	{
		$this->modelo_factor_gei->alldepelecchafa();
		$this->modelo_factor_gei->dropper_all_dep_elec();
		$this->modelo_factor_gei->alldepelecchafa();
		redirect("control_factor_gei/desgloze_total_electricidad");
	}
	
		$data['title']= '<i class="icon-bolt"></i> Electricidad';
		$data['subtitle'] = 'Desglose Masivo de Dependencias';
		$data['body'] = 'busqueda_alldependencia_x_fecha';
		$this->load->view('main', $data);
}


function desgloze_total_aqua()
{

	$submit = $this->input->post('enviar');

	if($submit=='volver')
	{
		redirect("inicio");
	}
	if($submit=='reloadalldepagua')
	{
		$this->modelo_factor_gei->alldepaguachafa();
		$this->modelo_factor_gei->dropper_all_dep_agua();
		$this->modelo_factor_gei->alldepaguachafa();
		redirect("control_factor_gei/desgloze_total_aqua");
	}
	
		$data['title']= '<i class="icon-tint"></i> Agua';
		$data['subtitle'] = 'Desglose Masivo de Dependencias';
		$data['body'] = 'busqueda_alldependencia_x_fecha_agua';
		$this->load->view('main', $data);
}

function desgloze_total_vapor()
{

	$submit = $this->input->post('enviar');

	if($submit=='volver')
	{
		redirect("inicio");
	}
	if($submit=='reloadalldepgaas')
	{
		$this->modelo_factor_gei->alldepgaaschafa();
		$this->modelo_factor_gei->dropper_all_dep_gaas();
		$this->modelo_factor_gei->alldepgaaschafa();
		redirect("control_factor_gei/desgloze_total_vapor");
	}
	
		$data['title']= '<i class="icon-fire"></i> Gas';
		$data['subtitle'] = 'Desglose Masivo de Dependencias';
		$data['body'] = 'busqueda_alldependencia_x_fecha_gaas';
		$this->load->view('main', $data);
}
/********************************************************CIERRE*******************************************************/

//Genera el formulario para la tarífa de Agua por mes de cada año//


function tarifagua_meses()
{
	/*$this->modelo_factor_gei->taromfinaltransact();*/
	$submit = $this->input->post('enviar');
	$dep_agua_final_x_mepo = $this->input->post('dep_agua_final_x_mepo');

	if($submit=='volver')
	{
		redirect("inicio");
	}
	if($submit=='reloadwtfinal')
	{
		$this->modelo_factor_gei->taraguafinaltransact();
		$this->modelo_factor_gei->droper_agua_final();
		$this->modelo_factor_gei->taraguafinaltransact();
		redirect("control_factor_gei/tarifagua_meses");
	}
	else
	{
		// Carga combobox dependencia

		$data['catdepwtfinal']	= $this->modelo_factor_gei->dep_agua_final();

		// Genera las consultas por dependencia
		$data['resdepwtfinal1'] = $this->modelo_factor_gei->dep_agua_final_resultado();
		$data['dep_agua_final_x_mepo'] = $dep_agua_final_x_mepo;


	if(!empty($dep_agua_final_x_mepo))
	{
		$data['EneroTotalWT'] = $this->modelo_factor_gei->EneroTotalWT($dep_agua_final_x_mepo);
		$data['FebreroTotalWT'] = $this->modelo_factor_gei->FebreroTotalWT($dep_agua_final_x_mepo);
		$data['MarzoTotalWT'] = $this->modelo_factor_gei->MarzoTotalWT($dep_agua_final_x_mepo);
		$data['AbrilTotalWT'] = $this->modelo_factor_gei->AbrilTotalWT($dep_agua_final_x_mepo);
		$data['MayoTotalWT'] = $this->modelo_factor_gei->MayoTotalWT($dep_agua_final_x_mepo);
		$data['JunioTotalWT'] = $this->modelo_factor_gei->JunioTotalWT($dep_agua_final_x_mepo);
		$data['JulioTotalWT'] = $this->modelo_factor_gei->JulioTotalWT($dep_agua_final_x_mepo);
		$data['AgostoTotalWT'] = $this->modelo_factor_gei->AgostoTotalWT($dep_agua_final_x_mepo);
		$data['SeptiembreTotalWT'] = $this->modelo_factor_gei->SeptiembreTotalWT($dep_agua_final_x_mepo);
		$data['OctubreTotalWT'] = $this->modelo_factor_gei->OctubreTotalWT($dep_agua_final_x_mepo);
		$data['NoviembreTotalWT'] = $this->modelo_factor_gei->NoviembreTotalWT($dep_agua_final_x_mepo);
		$data['DiciembreTotalWT'] = $this->modelo_factor_gei->DiciembreTotalWT($dep_agua_final_x_mepo);
	}	
	else{
			if(!!empty($dep_agua_final_x_mepo))
	{
		$data['EneroTotalWT'] = $this->modelo_factor_gei->EneroTotalWT($dep_agua_final_x_mepo);
		$data['FebreroTotalWT'] = $this->modelo_factor_gei->FebreroTotalWT($dep_agua_final_x_mepo);
		$data['MarzoTotalWT'] = $this->modelo_factor_gei->MarzoTotalWT($dep_agua_final_x_mepo);
		$data['AbrilTotalWT'] = $this->modelo_factor_gei->AbrilTotalWT($dep_agua_final_x_mepo);
		$data['MayoTotalWT'] = $this->modelo_factor_gei->MayoTotalWT($dep_agua_final_x_mepo);
		$data['JunioTotalWT'] = $this->modelo_factor_gei->JunioTotalWT($dep_agua_final_x_mepo);
		$data['JulioTotalWT'] = $this->modelo_factor_gei->JulioTotalWT($dep_agua_final_x_mepo);
		$data['AgostoTotalWT'] = $this->modelo_factor_gei->AgostoTotalWT($dep_agua_final_x_mepo);
		$data['SeptiembreTotalWT'] = $this->modelo_factor_gei->SeptiembreTotalWT($dep_agua_final_x_mepo);
		$data['OctubreTotalWT'] = $this->modelo_factor_gei->OctubreTotalWT($dep_agua_final_x_mepo);
		$data['NoviembreTotalWT'] = $this->modelo_factor_gei->NoviembreTotalWT($dep_agua_final_x_mepo);
		$data['DiciembreTotalWT'] = $this->modelo_factor_gei->DiciembreTotalWT($dep_agua_final_x_mepo);
	}	
	}
	}
		$data['title']= '<i class="icon-tint"></i> Agua';
		$data['subtitle'] = 'Consumo Mensual x Año de m3 en Agua';
		$data['body'] = 'tar_agua_final_x_mepo_2';
		$this->load->view('main', $data);
}

/********************************************************CIERRE*******************************************************/

/******************************************************************************************************/
//Genera el formulario para la tarífa de gas por mes de cada año//


function tarifgas_meses()
{
	$submit = $this->input->post('enviar');
	$dep_gas_final_x_mepo = $this->input->post('dep_gas_final_x_mepo');

	if($submit=='volver')
	{
		redirect("inicio");
	}
	if($submit=='reloadgsfinal')
	{
		$this->modelo_factor_gei->targasfinaltransact();
		$this->modelo_factor_gei->droper_gas_final();
		$this->modelo_factor_gei->targasfinaltransact();
		redirect("control_factor_gei/tarifgas_meses");
	}
	else
	{
		// Carga combobox dependencia

		$data['catdepgsfinal']	= $this->modelo_factor_gei->dep_gas_final();

		// Genera las consultas por dependencia
		$data['resdepgsfinal1'] = $this->modelo_factor_gei->dep_gas_final_resultado();
		$data['dep_gas_final_x_mepo'] = $dep_gas_final_x_mepo;


	if(!empty($dep_gas_final_x_mepo))
	{
		$data['EneroTotalGS'] = $this->modelo_factor_gei->EneroTotalGS($dep_gas_final_x_mepo);
		$data['FebreroTotalGS'] = $this->modelo_factor_gei->FebreroTotalGS($dep_gas_final_x_mepo);
		$data['MarzoTotalGS'] = $this->modelo_factor_gei->MarzoTotalGS($dep_gas_final_x_mepo);
		$data['AbrilTotalGS'] = $this->modelo_factor_gei->AbrilTotalGS($dep_gas_final_x_mepo);
		$data['MayoTotalGS'] = $this->modelo_factor_gei->MayoTotalGS($dep_gas_final_x_mepo);
		$data['JunioTotalGS'] = $this->modelo_factor_gei->JunioTotalGS($dep_gas_final_x_mepo);
		$data['JulioTotalGS'] = $this->modelo_factor_gei->JulioTotalGS($dep_gas_final_x_mepo);
		$data['AgostoTotalGS'] = $this->modelo_factor_gei->AgostoTotalGS($dep_gas_final_x_mepo);
		$data['SeptiembreTotalGS'] = $this->modelo_factor_gei->SeptiembreTotalGS($dep_gas_final_x_mepo);
		$data['OctubreTotalGS'] = $this->modelo_factor_gei->OctubreTotalGS($dep_gas_final_x_mepo);
		$data['NoviembreTotalGS'] = $this->modelo_factor_gei->NoviembreTotalGS($dep_gas_final_x_mepo);
		$data['DiciembreTotalGS'] = $this->modelo_factor_gei->DiciembreTotalGS($dep_gas_final_x_mepo);
	}	
	else{
			if(!!empty($dep_gas_final_x_mepo))
	{
		$data['EneroTotalGS'] = $this->modelo_factor_gei->EneroTotalGS($dep_gas_final_x_mepo);
		$data['FebreroTotalGS'] = $this->modelo_factor_gei->FebreroTotalGS($dep_gas_final_x_mepo);
		$data['MarzoTotalGS'] = $this->modelo_factor_gei->MarzoTotalGS($dep_gas_final_x_mepo);
		$data['AbrilTotalGS'] = $this->modelo_factor_gei->AbrilTotalGS($dep_gas_final_x_mepo);
		$data['MayoTotalGS'] = $this->modelo_factor_gei->MayoTotalGS($dep_gas_final_x_mepo);
		$data['JunioTotalGS'] = $this->modelo_factor_gei->JunioTotalGS($dep_gas_final_x_mepo);
		$data['JulioTotalGS'] = $this->modelo_factor_gei->JulioTotalGS($dep_gas_final_x_mepo);
		$data['AgostoTotalGS'] = $this->modelo_factor_gei->AgostoTotalGS($dep_gas_final_x_mepo);
		$data['SeptiembreTotalGS'] = $this->modelo_factor_gei->SeptiembreTotalGS($dep_gas_final_x_mepo);
		$data['OctubreTotalGS'] = $this->modelo_factor_gei->OctubreTotalGS($dep_gas_final_x_mepo);
		$data['NoviembreTotalGS'] = $this->modelo_factor_gei->NoviembreTotalGS($dep_gas_final_x_mepo);
		$data['DiciembreTotalGS'] = $this->modelo_factor_gei->DiciembreTotalGS($dep_gas_final_x_mepo);
	}	
	}
	}
		$data['title']= '<i class="icon-fire"></i> Gas';
		$data['subtitle'] = 'Consumo Mensual x Año de m3 en Gas';
		$data['body'] = 'tar_gas_final_x_mepo_2';
		$this->load->view('main', $data);
}

/********************************************************CIERRE*******************************************************/

/***********************************CONTROL NUEVA GRÁFICA CONSUMO kWh**********************************/
function graf_nueva_elec_costos()
{
	$submit = $this->input->post('enviar');
	$dependencia = $this->input->post('dependencia');
	$year = $this->input->post('year');
	
	if($submit=='volver')
		{
			redirect("inicio");
		}
		else 
		{
			$data['recibos']	= $this->modelo_factor_gei->resgrafconkwh();
			$data['servicios']	= $this->modelo_factor_gei->sercatgrafconkwh();
			//$data['obtenmes']	= $this->modelo_factor_gei->obtenumeroames();
			//$data['mocos'] = $this->modelo_factor_gei->debug_to_console();
			$this->console_log($year);
			$data['dependencia']= $dependencia;
			$data['year'] = $year;

					$data['title'] = '<i class="icon-bolt"></i> Energía Eléctrica';
					$data['subtitle'] = 'Gráfica Anual de Costos de Electricidad';
					$data['body'] = 'nueva_grafica_energia_costo';
					$this->load->view('main', $data);
		}
}

function console_log( ...$messages ){
  $msgs = '';
  foreach ($messages as $msg) {
    $msgs .= json_encode($msg);
  }

  echo '<script>';
  echo 'console.log('. json_encode($msgs) .')';
  echo '</script>';
}

 public function getYear($pdate)
 { 
 	$date = DateTime::createFromFormat("Ymd", $pdate); return $date->format("Y");
 }

 public function getMonth($pdate)
 {
 	$date = DateTime::createFromFormat("Ymd", $pdate); return $date->format("m");
 }
 
 public function getDay($pdate)
 {
 	$date = DateTime::createFromFormat("Ymd", $pdate); return $date->format("d");
 }
/********************************************************CIERRE*******************************************************/

/***********************************CONTROL NUEVA GRÁFICA CONSUMO kWh**********************************/
function graf_nueva_elec_consumos()
{
	$submit = $this->input->post('enviar');
	$dependencia = $this->input->post('dependencia');
	$year = $this->input->post('year');
	
	if($submit=='volver')
		{
			redirect("inicio");
		}
		else 
		{
			$data['recibos']	= $this->modelo_factor_gei->resgrafconkwh();
			$data['servicios']	= $this->modelo_factor_gei->sercatgrafconkwh();
			//$data['mocos'] = $this->modelo_factor_gei->debug_to_console();
			$this->console_log($year);
			$data['dependencia']= $dependencia;
			$data['year'] = $year;

					$data['title'] = '<i class="icon-bolt"></i> Energía Eléctrica';
					$data['subtitle'] = 'Gráfica Anual de Consumo de Electricidad';
					$data['body'] = 'nueva_grafica_energia_consumo';
					$this->load->view('main', $data);
		}
}
/********************************************************CIERRE*******************************************************/

/**********************************CONTROL NUEVA GRAFICA AGUA COSTO*********************************/
function graf_nueva_agua_costos()
{
	$submit = $this->input->post('enviar');
	$dependencia = $this->input->post('dependencia');
	$year = $this->input->post('year');
	
	if($submit=='volver')
		{
			redirect("inicio");
		}
		else 
		{
			$data['recibos']	= $this->modelo_factor_gei->resgrafaguacos();
			$data['servicios']	= $this->modelo_factor_gei->sercatgrafcosagua();
			//$data['mocos'] = $this->modelo_factor_gei->debug_to_console();
			$this->console_log($year);	
			$data['dependencia']= $dependencia;
			$data['year'] = $year;

					$data['title'] = '<i class="icon-tint"></i> Agua';
					$data['subtitle'] = 'Gráfica Anual de Costos de Agua';
					$data['body'] = 'nueva_grafica_agua_costo';
					$this->load->view('main', $data);
		}
}
/********************************************************CIERRE*******************************************************/

/**********************************CONTROL NUEVA GRAFICA AGUA CONSUMO*********************************/
function graf_nueva_agua_consumos()
{
	$submit = $this->input->post('enviar');
	$dependencia = $this->input->post('dependencia');
	$year = $this->input->post('year');
	
	if($submit=='volver')
		{
			redirect("inicio");
		}
		else 
		{
			$data['recibos']	= $this->modelo_factor_gei->resgrafaguacos();
			$data['servicios']	= $this->modelo_factor_gei->sercatgrafcosagua();
			//$data['mocos'] = $this->modelo_factor_gei->debug_to_console();
			$this->console_log($year);	
			$data['dependencia']= $dependencia;
			$data['year'] = $year;

					$data['title'] = '<i class="icon-tint"></i> Agua';
					$data['subtitle'] = 'Gráfica Anual de Consumo de Agua en m3';
					$data['body'] = 'nueva_grafica_agua_consumo';
					$this->load->view('main', $data);
		}
}

/********************************************************CIERRE*******************************************************/

/**********************************CONTROL NUEVA GRAFICA GAS COSTO*********************************/
function graf_nueva_gas_costos()
{
	$submit = $this->input->post('enviar');
	$dependencia = $this->input->post('dependencia');
	$year = $this->input->post('year');
	
	if($submit=='volver')
		{
			redirect("inicio");
		}
		else 
		{
			$data['recibos']	= $this->modelo_factor_gei->resgrafgascos();
			$data['servicios']	= $this->modelo_factor_gei->sercatgrafcosgas();
			//$data['mocos'] = $this->modelo_factor_gei->debug_to_console();
			$this->console_log($year);	
			$data['dependencia']= $dependencia;
			$data['year'] = $year;

					$data['title'] = '<i class="icon-fire"></i> Gas';
					$data['subtitle'] = 'Gráfica Anual de Costos de Gas';
					$data['body'] = 'nueva_grafica_gas_costo';
					$this->load->view('main', $data);
		}
}
/********************************************************CIERRE*******************************************************/

/**********************************CONTROL NUEVA GRAFICA GAS CONSUMO*********************************/
function graf_nueva_gas_consumos()
{
	$submit = $this->input->post('enviar');
	$dependencia = $this->input->post('dependencia');
	$year = $this->input->post('year');
	
	if($submit=='volver')
		{
			redirect("inicio");
		}
		else 
		{
			$data['recibos']	= $this->modelo_factor_gei->resgrafgascos();
			$data['servicios']	= $this->modelo_factor_gei->sercatgrafcosgas();
			//$data['mocos'] = $this->modelo_factor_gei->debug_to_console();
			$this->console_log($year);	
			$data['dependencia']= $dependencia;
			$data['year'] = $year;

					$data['title'] = '<i class="icon-fire"></i> Gas';
					$data['subtitle'] = 'Gráfica Anual de Consumo de Gas en m3';
					$data['body'] = 'nueva_grafica_gas_consumo';
					$this->load->view('main', $data);
		}
}

/********************************************************CIERRE*******************************************************/

/**********************************CONTROL NUEVA GRAFICA ELECTRICIDAD FACTOR*********************************/
function graf_nueva_elec_factores()
{
	$submit = $this->input->post('enviar');
	$dependencia = $this->input->post('dependencia');
	$year = $this->input->post('year');
	
	if($submit=='volver')
		{
			redirect("inicio");
		}
		else 
		{
			$data['recibos']	= $this->modelo_factor_gei->resgrafconkwh();
			$data['servicios']	= $this->modelo_factor_gei->sercatgrafconkwh();
			//$data['mocos'] = $this->modelo_factor_gei->debug_to_console();
			$this->console_log($year);	
			$data['dependencia']= $dependencia;
			$data['year'] = $year;

					$data['title'] = '<i class="icon-bolt"></i> Energía Eléctrica';
					$data['subtitle'] = 'Gráfica Anual de FP de Electricidad';
					$data['body'] = 'nueva_grafica_energia_fp';
					$this->load->view('main', $data);
		}
}
/********************************************************CIERRE*******************************************************/
/****************************************************************************************************************************/
//Genera el formulario para la consulta de Consumo KwH (GM) por mes desde el 2015 a la fecha//


function consumoelecxcampusGM()
{
	/*$this->modelo_factor_gei->conelecxcampus();*/
	$submit = $this->input->post('enviar');
	$campus_gmtfinal = $this->input->post('campus_gmtfinal');

	if($submit=='volver')
	{
		redirect("inicio");
	}
	if($submit=='reloadcexcgm')
	{
		$this->modelo_factor_gei->conelecxcampus();
		$this->modelo_factor_gei->droprelecxcampus();
		$this->modelo_factor_gei->conelecxcampus();
		redirect("control_factor_gei/consumoelecxcampusGM");
	}
	else
	{
		// Carga combobox campus

		$data['catecexcgm']	= $this->modelo_factor_gei->elecxcampusfinal();

		// Genera las consultas por campus
		$data['resecexcgm'] = $this->modelo_factor_gei->elecxcampusresultado();
		
		$data['campus_gmtfinal'] = $campus_gmtfinal;


	if(!empty($campus_gmtfinal))
	{
		$data['Eneroelecxcampustot'] = $this->modelo_factor_gei->Eneroelecxcampustot($campus_gmtfinal);
		$data['Febreroelecxcampustot'] = $this->modelo_factor_gei->Febreroelecxcampustot($campus_gmtfinal);
		$data['Marzoelecxcampustot'] = $this->modelo_factor_gei->Marzoelecxcampustot($campus_gmtfinal);
		$data['Abrilelecxcampustot'] = $this->modelo_factor_gei->Abrilelecxcampustot($campus_gmtfinal);
		$data['Mayoelecxcampustot'] = $this->modelo_factor_gei->Mayoelecxcampustot($campus_gmtfinal);
		$data['Junioelecxcampustot'] = $this->modelo_factor_gei->Junioelecxcampustot($campus_gmtfinal);
		$data['Julioelecxcampustot'] = $this->modelo_factor_gei->Julioelecxcampustot($campus_gmtfinal);
		$data['Agostoelecxcampustot'] = $this->modelo_factor_gei->Agostoelecxcampustot($campus_gmtfinal);
		$data['Septiembreelecxcampustot'] = $this->modelo_factor_gei->Septiembreelecxcampustot($campus_gmtfinal);
		$data['Octubreelecxcampustot'] = $this->modelo_factor_gei->Octubreelecxcampustot($campus_gmtfinal);
		$data['Noviembreelecxcampustot'] = $this->modelo_factor_gei->Noviembreelecxcampustot($campus_gmtfinal);
		$data['Diciembreelecxcampustot'] = $this->modelo_factor_gei->Diciembreelecxcampustot($campus_gmtfinal);
	}	
	else{
			if(!!empty($campus_gmtfinal))
	{
		$data['Eneroelecxcampustot'] = $this->modelo_factor_gei->Eneroelecxcampustot($campus_gmtfinal);
		$data['Febreroelecxcampustot'] = $this->modelo_factor_gei->Febreroelecxcampustot($campus_gmtfinal);
		$data['Marzoelecxcampustot'] = $this->modelo_factor_gei->Marzoelecxcampustot($campus_gmtfinal);
		$data['Abrilelecxcampustot'] = $this->modelo_factor_gei->Abrilelecxcampustot($campus_gmtfinal);
		$data['Mayoelecxcampustot'] = $this->modelo_factor_gei->Mayoelecxcampustot($campus_gmtfinal);
		$data['Junioelecxcampustot'] = $this->modelo_factor_gei->Junioelecxcampustot($campus_gmtfinal);
		$data['Julioelecxcampustot'] = $this->modelo_factor_gei->Julioelecxcampustot($campus_gmtfinal);
		$data['Agostoelecxcampustot'] = $this->modelo_factor_gei->Agostoelecxcampustot($campus_gmtfinal);
		$data['Septiembreelecxcampustot'] = $this->modelo_factor_gei->Septiembreelecxcampustot($campus_gmtfinal);
		$data['Octubreelecxcampustot'] = $this->modelo_factor_gei->Octubreelecxcampustot($campus_gmtfinal);
		$data['Noviembreelecxcampustot'] = $this->modelo_factor_gei->Noviembreelecxcampustot($campus_gmtfinal);
		$data['Diciembreelecxcampustot'] = $this->modelo_factor_gei->Diciembreelecxcampustot($campus_gmtfinal);
	}	
	}
	}
		$data['title']= '<i class="icon-bolt"></i> Energía Eléctrica';
		$data['subtitle'] = 'Consumo de Electricidad x Campus 2015 -  ' .date('Y').  ' GM';
		$data['body'] = 'consumoelecxcampusGreenMetric';
		$this->load->view('main', $data);
}

/********************************************************CIERRE*******************************************************/

//Genera el formulario para la consulta de Consumo KwH (GM) por mes desde el 2015 a la fecha -1//


function consumoelecxcampusGMv2()
{
	/*$this->modelo_factor_gei->conelecxcampusv2();*/
	$submit = $this->input->post('enviar');
	$campus_gmtfinal = $this->input->post('campus_gmtfinal');

	if($submit=='volver')
	{
		redirect("inicio");
	}
	if($submit=='reloadcexcgmv2')
	{
		$this->modelo_factor_gei->conelecxcampusv2();
		$this->modelo_factor_gei->droprelecxcampusv2();
		$this->modelo_factor_gei->conelecxcampusv2();
		redirect("control_factor_gei/consumoelecxcampusGMv2");
	}
	else
	{
		// Carga combobox campus

		$data['catecexcgmv2']	= $this->modelo_factor_gei->elecxcampusfinalv2();

		// Genera las consultas por campus
		$data['resecexcgmv2'] = $this->modelo_factor_gei->elecxcampusresultadov2();
		
		$data['campus_gmtfinal'] = $campus_gmtfinal;


	if(!empty($campus_gmtfinal))
	{
		$data['Eneroelecxcampustotv2'] = $this->modelo_factor_gei->Eneroelecxcampustotv2($campus_gmtfinal);
		$data['Febreroelecxcampustotv2'] = $this->modelo_factor_gei->Febreroelecxcampustotv2($campus_gmtfinal);
		$data['Marzoelecxcampustotv2'] = $this->modelo_factor_gei->Marzoelecxcampustotv2($campus_gmtfinal);
		$data['Abrilelecxcampustotv2'] = $this->modelo_factor_gei->Abrilelecxcampustotv2($campus_gmtfinal);
		$data['Mayoelecxcampustotv2'] = $this->modelo_factor_gei->Mayoelecxcampustotv2($campus_gmtfinal);
		$data['Junioelecxcampustotv2'] = $this->modelo_factor_gei->Junioelecxcampustotv2($campus_gmtfinal);
		$data['Julioelecxcampustotv2'] = $this->modelo_factor_gei->Julioelecxcampustotv2($campus_gmtfinal);
		$data['Agostoelecxcampustotv2'] = $this->modelo_factor_gei->Agostoelecxcampustotv2($campus_gmtfinal);
		$data['Septiembreelecxcampustotv2'] = $this->modelo_factor_gei->Septiembreelecxcampustotv2($campus_gmtfinal);
		$data['Octubreelecxcampustotv2'] = $this->modelo_factor_gei->Octubreelecxcampustotv2($campus_gmtfinal);
		$data['Noviembreelecxcampustotv2'] = $this->modelo_factor_gei->Noviembreelecxcampustotv2($campus_gmtfinal);
		$data['Diciembreelecxcampustotv2'] = $this->modelo_factor_gei->Diciembreelecxcampustotv2($campus_gmtfinal);
	}	
	else{
			if(!!empty($campus_gmtfinal))
	{
		$data['Eneroelecxcampustotv2'] = $this->modelo_factor_gei->Eneroelecxcampustotv2($campus_gmtfinal);
		$data['Febreroelecxcampustotv2'] = $this->modelo_factor_gei->Febreroelecxcampustotv2($campus_gmtfinal);
		$data['Marzoelecxcampustotv2'] = $this->modelo_factor_gei->Marzoelecxcampustotv2($campus_gmtfinal);
		$data['Abrilelecxcampustotv2'] = $this->modelo_factor_gei->Abrilelecxcampustotv2($campus_gmtfinal);
		$data['Mayoelecxcampustotv2'] = $this->modelo_factor_gei->Mayoelecxcampustotv2($campus_gmtfinal);
		$data['Junioelecxcampustotv2'] = $this->modelo_factor_gei->Junioelecxcampustotv2($campus_gmtfinal);
		$data['Julioelecxcampustotv2'] = $this->modelo_factor_gei->Julioelecxcampustotv2($campus_gmtfinal);
		$data['Agostoelecxcampustotv2'] = $this->modelo_factor_gei->Agostoelecxcampustotv2($campus_gmtfinal);
		$data['Septiembreelecxcampustotv2'] = $this->modelo_factor_gei->Septiembreelecxcampustotv2($campus_gmtfinal);
		$data['Octubreelecxcampustotv2'] = $this->modelo_factor_gei->Octubreelecxcampustotv2($campus_gmtfinal);
		$data['Noviembreelecxcampustotv2'] = $this->modelo_factor_gei->Noviembreelecxcampustotv2($campus_gmtfinal);
		$data['Diciembreelecxcampustotv2'] = $this->modelo_factor_gei->Diciembreelecxcampustotv2($campus_gmtfinal);
	}	
	}
	}
		$data['title']= '<i class="icon-bolt"></i> Energía Eléctrica';
		$data['subtitle'] = 'Consumo de Electricidad x Campus 2015 -  ' .date('Y', strtotime('-1 year')).  ' GM';
		$data['body'] = 'GreenMetricAjuste';
		$this->load->view('main', $data);
}

/********************************************************CIERRE*******************************************************/

//Genera el formulario para la consulta de Consumo KwH (GM) por mes desde el 2015 a la fecha//


function consumoelecxcampusnonGM()
{
	/*$this->modelo_factor_gei->conelecxcampusnonGM();*/
	$submit = $this->input->post('enviar');
	$campus_nongmtfinal = $this->input->post('campus_nongmtfinal');

	if($submit=='volver')
	{
		redirect("inicio");
	}
	if($submit=='reloadcexcnongm')
	{
		$this->modelo_factor_gei->conelecxcampusnonGM();
		$this->modelo_factor_gei->droprelecxcampusnonGM();
		$this->modelo_factor_gei->conelecxcampusnonGM();
		redirect("control_factor_gei/consumoelecxcampusnonGM");
	}
	else
	{
		// Carga combobox dependencia

		$data['catecexcnongm']	= $this->modelo_factor_gei->elecxcampusfinalnonGM();

		// Genera las consultas por dependencia
		$data['resecexcnongm'] = $this->modelo_factor_gei->elecxcampusresultadononGM();
		
		$data['campus_nongmtfinal'] = $campus_nongmtfinal;


	if(!empty($campus_nongmtfinal))
	{
		$data['EneroelecxcampustotnonGM'] = $this->modelo_factor_gei->EneroelecxcampustotnonGM($campus_nongmtfinal);
		$data['FebreroelecxcampustotnonGM'] = $this->modelo_factor_gei->FebreroelecxcampustotnonGM($campus_nongmtfinal);
		$data['MarzoelecxcampustotnonGM'] = $this->modelo_factor_gei->Marzoelecxcampustot($campus_nongmtfinal);
		$data['AbrilelecxcampustotnonGM'] = $this->modelo_factor_gei->AbrilelecxcampustotnonGM($campus_nongmtfinal);
		$data['MayoelecxcampustotnonGM'] = $this->modelo_factor_gei->MayoelecxcampustotnonGM($campus_nongmtfinal);
		$data['JunioelecxcampustotnonGM'] = $this->modelo_factor_gei->JunioelecxcampustotnonGM($campus_nongmtfinal);
		$data['JulioelecxcampustotnonGM'] = $this->modelo_factor_gei->JulioelecxcampustotnonGM($campus_nongmtfinal);
		$data['AgostoelecxcampustotnonGM'] = $this->modelo_factor_gei->AgostoelecxcampustotnonGM($campus_nongmtfinal);
		$data['SeptiembreelecxcampustotnonGM'] = $this->modelo_factor_gei->SeptiembreelecxcampustotnonGM($campus_nongmtfinal);
		$data['OctubreelecxcampustotnonGM'] = $this->modelo_factor_gei->OctubreelecxcampustotnonGM($campus_nongmtfinal);
		$data['NoviembreelecxcampustotnonGM'] = $this->modelo_factor_gei->NoviembreelecxcampustotnonGM($campus_nongmtfinal);
		$data['DiciembreelecxcampustotnonGM'] = $this->modelo_factor_gei->DiciembreelecxcampustotnonGM($campus_nongmtfinal);
	}	
	else{
			if(!!empty($campus_nongmtfinal))
	{
		$data['EneroelecxcampustotnonGM'] = $this->modelo_factor_gei->EneroelecxcampustotnonGM($campus_nongmtfinal);
		$data['FebreroelecxcampustotnonGM'] = $this->modelo_factor_gei->FebreroelecxcampustotnonGM($campus_nongmtfinal);
		$data['MarzoelecxcampustotnonGM'] = $this->modelo_factor_gei->MarzoelecxcampustotnonGM($campus_nongmtfinal);
		$data['AbrilelecxcampustotnonGM'] = $this->modelo_factor_gei->AbrilelecxcampustotnonGM($campus_nongmtfinal);
		$data['MayoelecxcampustotnonGM'] = $this->modelo_factor_gei->MayoelecxcampustotnonGM($campus_nongmtfinal);
		$data['JunioelecxcampustotnonGM'] = $this->modelo_factor_gei->JunioelecxcampustotnonGM($campus_nongmtfinal);
		$data['JulioelecxcampustotnonGM'] = $this->modelo_factor_gei->JulioelecxcampustotnonGM($campus_nongmtfinal);
		$data['AgostoelecxcampustotnonGM'] = $this->modelo_factor_gei->AgostoelecxcampustotnonGM($campus_nongmtfinal);
		$data['SeptiembreelecxcampustotnonGM'] = $this->modelo_factor_gei->SeptiembreelecxcampustotnonGM($campus_nongmtfinal);
		$data['OctubreelecxcampustotnonGM'] = $this->modelo_factor_gei->OctubreelecxcampustotnonGM($campus_nongmtfinal);
		$data['NoviembreelecxcampustotnonGM'] = $this->modelo_factor_gei->NoviembreelecxcampustotnonGM($campus_nongmtfinal);
		$data['DiciembreelecxcampustotnonGM'] = $this->modelo_factor_gei->DiciembreelecxcampustotnonGM($campus_nongmtfinal);
	}	
	}
	}
		$data['title']= '<i class="icon-bolt"></i> Energía Eléctrica';
		$data['subtitle'] = 'Consumo de Electricidad x Campus 2011 -  ' .date("Y").' (DINSU)';
		$data['body'] = 'consumoelecxcampusNONGreenMetric';
		$this->load->view('main', $data);
}

/********************************************************CIERRE*******************************************************/

/*CONTROL PARA MANDAR LLAMAR LA GRÁFICA ANUAL DE ELECTRICIDAD (HIGHCHARTS-GM)*/
function metrica_gei_elec_gm()
{
	$submit = $this->input->post('enviar');
	$year = $this->input->post('year');
	if($submit=='volver')
	{
		redirect("inicio");
	}
	if($submit=='reloadgmpdcv2')
	{
		$this->modelo_factor_gei->creacionefactoregmv2();
		$this->modelo_factor_gei->dropecreacionefactoregmV2();
		$this->modelo_factor_gei->creacionefactoregmv2();
		redirect("control_factor_gei/metrica_gei_elec_gm");
	}
	else
	{
		if(empty($year))
		{
			$data['loadgei'] = $this->modelo_factor_gei->load_gei_table_gm();
		}
		$data['tittle'] = '<i class="icon-bolt"></i> Energía Eléctrica';
		$data['subtitle'] = 'Consumo de Electricidad 2011 -  ' .date('Y', strtotime('-1 year')).  ' GM';
		$data['body'] = 'metricas_gei_elec_gm';
		$this->load->view('main', $data);
}
}
/********************************************************CIERRE*******************************************************/

/*CONTROL PARA MANDAR LLAMAR LA GRÁFICA DE KWh PER CAPITA POR AÑO EN ELECTRICIDAD (HIGHCHARTS-GM)*/
function kwcperiodo_elec_gm()
{
	$submit = $this->input->post('enviar');
		if($submit=='volver')
	{
		redirect("inicio");
	}
	$data['tittle'] = '<i class="icon-bolt"></i> Energía Eléctrica';
	$data['subtitle'] = 'Electricidad 2011 -  ' .date('Y', strtotime('-1 year')).  ' GM';
	$data['body'] = 'kwcapitayear_elec_gm';
	$this->load->view('main', $data);
}
/********************************************************CIERRE*******************************************************/

/*CONTROL PARA MANDAR LLAMAR LA GRÁFICA DE Kg PER CAPITA POR AÑO EN ELECTRICIDAD (HIGHCHARTS-GM)*/
function kgcperiodo_elec_gm()
{
	$submit = $this->input->post('enviar');
		if($submit=='volver')
	{
		redirect("inicio");
	}
	$data['tittle'] = '<i class="icon-bolt"></i> Energía Eléctrica';
	$data['subtitle'] = 'Electricidad 2011 -  ' .date('Y', strtotime('-1 year')).  ' GM';
	$data['body'] = 'kgcapitayear_elec_gm';
	$this->load->view('main', $data);
}
/********************************************************CIERRE*******************************************************/

//Genera el formulario para la consulta de Consumo m3 Agua (GM) por mes desde el 2015 CON AJUSTE UN AÑO MENOR AL ACTUAL)//


function consumoaguaxcampusGMv2()
{
	/*$this->modelo_factor_gei->conaguaxcampusv2();*/
	$submit = $this->input->post('enviar');
	$campus_gmtfinal = $this->input->post('campus_gmtfinal');

	if($submit=='volver')
	{
		redirect("inicio");
	}
	if($submit=='reloadcexcgmv2')
	{
		$this->modelo_factor_gei->conaguaxcampusv2();
		$this->modelo_factor_gei->dropraguaxcampusv2();
		$this->modelo_factor_gei->conaguaxcampusv2();
		redirect("control_factor_gei/consumoaguaxcampusGMv2");
	}
	else
	{
		// Carga combobox campus

		$data['catecexcgmv2']	= $this->modelo_factor_gei->aguaxcampusfinalv2();

		// Genera las consultas por campus
		$data['resecexcgmv2'] = $this->modelo_factor_gei->aguaxcampusresultadov2();
		
		$data['campus_gmtfinal'] = $campus_gmtfinal;


	if(!empty($campus_gmtfinal))
	{
		$data['Eneroaguaxcampustotv2'] = $this->modelo_factor_gei->Eneroaguaxcampustotv2($campus_gmtfinal);
		$data['Febreroaguaxcampustotv2'] = $this->modelo_factor_gei->Febreroaguaxcampustotv2($campus_gmtfinal);
		$data['Marzoaguaxcampustotv2'] = $this->modelo_factor_gei->Marzoaguaxcampustotv2($campus_gmtfinal);
		$data['Abrilaguaxcampustotv2'] = $this->modelo_factor_gei->Abrilaguaxcampustotv2($campus_gmtfinal);
		$data['Mayoaguaxcampustotv2'] = $this->modelo_factor_gei->Mayoaguaxcampustotv2($campus_gmtfinal);
		$data['Junioaguaxcampustotv2'] = $this->modelo_factor_gei->Junioaguaxcampustotv2($campus_gmtfinal);
		$data['Julioaguaxcampustotv2'] = $this->modelo_factor_gei->Julioaguaxcampustotv2($campus_gmtfinal);
		$data['Agostoaguaxcampustotv2'] = $this->modelo_factor_gei->Agostoaguaxcampustotv2($campus_gmtfinal);
		$data['Septiembreaguaxcampustotv2'] = $this->modelo_factor_gei->Septiembreaguaxcampustotv2($campus_gmtfinal);
		$data['Octubreaguaxcampustotv2'] = $this->modelo_factor_gei->Octubreaguaxcampustotv2($campus_gmtfinal);
		$data['Noviembreaguaxcampustotv2'] = $this->modelo_factor_gei->Noviembreaguaxcampustotv2($campus_gmtfinal);
		$data['Diciembreaguaxcampustotv2'] = $this->modelo_factor_gei->Diciembreaguaxcampustotv2($campus_gmtfinal);
	}	
	else{
			if(!!empty($campus_gmtfinal))
	{
		$data['Eneroaguaxcampustotv2'] = $this->modelo_factor_gei->Eneroaguaxcampustotv2($campus_gmtfinal);
		$data['Febreroaguaxcampustotv2'] = $this->modelo_factor_gei->Febreroaguaxcampustotv2($campus_gmtfinal);
		$data['Marzoaguaxcampustotv2'] = $this->modelo_factor_gei->Marzoaguaxcampustotv2($campus_gmtfinal);
		$data['Abrilaguaxcampustotv2'] = $this->modelo_factor_gei->Abrilaguaxcampustotv2($campus_gmtfinal);
		$data['Mayoaguaxcampustotv2'] = $this->modelo_factor_gei->Mayoaguaxcampustotv2($campus_gmtfinal);
		$data['Junioaguaxcampustotv2'] = $this->modelo_factor_gei->Junioaguaxcampustotv2($campus_gmtfinal);
		$data['Julioaguaxcampustotv2'] = $this->modelo_factor_gei->Julioaguaxcampustotv2($campus_gmtfinal);
		$data['Agostoaguaxcampustotv2'] = $this->modelo_factor_gei->Agostoaguaxcampustotv2($campus_gmtfinal);
		$data['Septiembreaguaxcampustotv2'] = $this->modelo_factor_gei->Septiembreaguaxcampustotv2($campus_gmtfinal);
		$data['Octubreaguaxcampustotv2'] = $this->modelo_factor_gei->Octubreelecxcampustotv2($campus_gmtfinal);
		$data['Noviembreaguaxcampustotv2'] = $this->modelo_factor_gei->Noviembreaguaxcampustotv2($campus_gmtfinal);
		$data['Diciembreaguaxcampustotv2'] = $this->modelo_factor_gei->Diciembreaguaxcampustotv2($campus_gmtfinal);
	}	
	}
	}
		$data['title']= '<i class="icon-tint"></i> Agua';
		$data['subtitle'] = 'Consumo de Agua x Campus 2015 -  ' .date('Y', strtotime('-1 year')).  ' GM';
		$data['body'] = 'GreenMetricAjusteAgua';
		$this->load->view('main', $data);
}

/********************************************************CIERRE*******************************************************/

//Genera el formulario para la consulta de Consumo m3 Agua (GM) por mes desde el 2011 a la fecha//


function consumoaguaxcampusnonGM()
{
	/*$this->modelo_factor_gei->conaguaxcampusnonGM();*/
	$submit = $this->input->post('enviar');
	$campus_nongmtfinal = $this->input->post('campus_nongmtfinal');

	if($submit=='volver')
	{
		redirect("inicio");
	}
	if($submit=='reloadcexcnongm')
	{
		$this->modelo_factor_gei->conaguaxcampusnonGM();
		$this->modelo_factor_gei->dropraguaxcampusnonGM();
		$this->modelo_factor_gei->conaguaxcampusnonGM();
		redirect("control_factor_gei/consumoaguaxcampusnonGM");
	}
	else
	{
		// Carga combobox dependencia

		$data['catecexcnongm']	= $this->modelo_factor_gei->aguaxcampusfinalnonGM();

		// Genera las consultas por dependencia
		$data['resecexcnongm'] = $this->modelo_factor_gei->aguaxcampusresultadononGM();
		
		$data['campus_nongmtfinal'] = $campus_nongmtfinal;


	if(!empty($campus_nongmtfinal))
	{
		$data['EneroaguaxcampustotnonGM'] = $this->modelo_factor_gei->EneroaguaxcampustotnonGM($campus_nongmtfinal);
		$data['FebreroaguaxcampustotnonGM'] = $this->modelo_factor_gei->FebreroaguaxcampustotnonGM($campus_nongmtfinal);
		$data['MarzoaguaxcampustotnonGM'] = $this->modelo_factor_gei->MarzoaguaxcampustotnonGM($campus_nongmtfinal);
		$data['AbrilaguaxcampustotnonGM'] = $this->modelo_factor_gei->AbrilaguaxcampustotnonGM($campus_nongmtfinal);
		$data['MayoaguaxcampustotnonGM'] = $this->modelo_factor_gei->MayoaguaxcampustotnonGM($campus_nongmtfinal);
		$data['JunioaguaxcampustotnonGM'] = $this->modelo_factor_gei->JunioaguaxcampustotnonGM($campus_nongmtfinal);
		$data['JulioaguaxcampustotnonGM'] = $this->modelo_factor_gei->JulioaguaxcampustotnonGM($campus_nongmtfinal);
		$data['AgostoaguaxcampustotnonGM'] = $this->modelo_factor_gei->AgostoaguaxcampustotnonGM($campus_nongmtfinal);
		$data['SeptiembreaguaxcampustotnonGM'] = $this->modelo_factor_gei->SeptiembreaguaxcampustotnonGM($campus_nongmtfinal);
		$data['OctubreaguaxcampustotnonGM'] = $this->modelo_factor_gei->OctubreaguaxcampustotnonGM($campus_nongmtfinal);
		$data['NoviembreaguaxcampustotnonGM'] = $this->modelo_factor_gei->NoviembreaguaxcampustotnonGM($campus_nongmtfinal);
		$data['DiciembreaguaxcampustotnonGM'] = $this->modelo_factor_gei->DiciembreaguaxcampustotnonGM($campus_nongmtfinal);
	}	
	else{
			if(!!empty($campus_nongmtfinal))
	{
		$data['EneroaguaxcampustotnonGM'] = $this->modelo_factor_gei->EneroaguaxcampustotnonGM($campus_nongmtfinal);
		$data['FebreroaguaxcampustotnonGM'] = $this->modelo_factor_gei->FebreroaguaxcampustotnonGM($campus_nongmtfinal);
		$data['MarzoaguaxcampustotnonGM'] = $this->modelo_factor_gei->MarzoaguaxcampustotnonGM($campus_nongmtfinal);
		$data['AbrilaguaxcampustotnonGM'] = $this->modelo_factor_gei->AbrilaguaxcampustotnonGM($campus_nongmtfinal);
		$data['MayoaguaxcampustotnonGM'] = $this->modelo_factor_gei->MayoaguaxcampustotnonGM($campus_nongmtfinal);
		$data['JunioaguaxcampustotnonGM'] = $this->modelo_factor_gei->JunioaguaxcampustotnonGM($campus_nongmtfinal);
		$data['JulioaguaxcampustotnonGM'] = $this->modelo_factor_gei->JulioaguaxcampustotnonGM($campus_nongmtfinal);
		$data['AgostoaguaxcampustotnonGM'] = $this->modelo_factor_gei->AgostoaguaxcampustotnonGM($campus_nongmtfinal);
		$data['SeptiembreaguaxcampustotnonGM'] = $this->modelo_factor_gei->SeptiembreaguaxcampustotnonGM($campus_nongmtfinal);
		$data['OctubreaguaxcampustotnonGM'] = $this->modelo_factor_gei->OctubreelecxcampustotnonGM($campus_nongmtfinal);
		$data['NoviembreaguaxcampustotnonGM'] = $this->modelo_factor_gei->NoviembreaguaxcampustotnonGM($campus_nongmtfinal);
		$data['DiciembreaguaxcampustotnonGM'] = $this->modelo_factor_gei->DiciembreaguaxcampustotnonGM($campus_nongmtfinal);
	}	
	}
	}
		$data['title']= '<i class="icon-tint"></i> Agua';
		$data['subtitle'] = 'Consumo de Agua x Campus 2011 -  ' .date("Y").' (DINSU)';
		$data['body'] = 'consumoaguaxcampusNONGreenMetric';
		$this->load->view('main', $data);
}

/********************************************************CIERRE*******************************************************/

//Genera el formulario para la consulta de Consumo m3 Gas (GM) por mes desde el 2015 CON AJUSTE UN AÑO MENOR AL ACTUAL)//


function consumogaasxcampusGMv2()
{
	/*$this->modelo_factor_gei->congaasxcampusv2();*/
	$submit = $this->input->post('enviar');
	$campus_gmtfinal = $this->input->post('campus_gmtfinal');

	if($submit=='volver')
	{
		redirect("inicio");
	}
	if($submit=='reloadcexcgmv2')
	{
		$this->modelo_factor_gei->congaasxcampusv2();
		$this->modelo_factor_gei->droprgaasxcampusv2();
		$this->modelo_factor_gei->congaasxcampusv2();
		redirect("control_factor_gei/consumogaasxcampusGMv2");
	}
	else
	{
		// Carga combobox campus

		$data['catecexcgmv2']	= $this->modelo_factor_gei->gaasxcampusfinalv2();

		// Genera las consultas por campus
		$data['resecexcgmv2'] = $this->modelo_factor_gei->gaasxcampusresultadov2();
		
		$data['campus_gmtfinal'] = $campus_gmtfinal;


	if(!empty($campus_gmtfinal))
	{
		$data['Enerogaasxcampustotv2'] = $this->modelo_factor_gei->Enerogaasxcampustotv2($campus_gmtfinal);
		$data['Febrerogaasxcampustotv2'] = $this->modelo_factor_gei->Febrerogaasxcampustotv2($campus_gmtfinal);
		$data['Marzogaasxcampustotv2'] = $this->modelo_factor_gei->Marzogaasxcampustotv2($campus_gmtfinal);
		$data['Abrilgaasxcampustotv2'] = $this->modelo_factor_gei->Abrilgaasxcampustotv2($campus_gmtfinal);
		$data['Mayogaasxcampustotv2'] = $this->modelo_factor_gei->Mayogaasxcampustotv2($campus_gmtfinal);
		$data['Juniogaasxcampustotv2'] = $this->modelo_factor_gei->Juniogaasxcampustotv2($campus_gmtfinal);
		$data['Juliogaasxcampustotv2'] = $this->modelo_factor_gei->Juliogaasxcampustotv2($campus_gmtfinal);
		$data['Agostogaasxcampustotv2'] = $this->modelo_factor_gei->Agostogaasxcampustotv2($campus_gmtfinal);
		$data['Septiembregaasxcampustotv2'] = $this->modelo_factor_gei->Septiembregaasxcampustotv2($campus_gmtfinal);
		$data['Octubregaasxcampustotv2'] = $this->modelo_factor_gei->Octubregaasxcampustotv2($campus_gmtfinal);
		$data['Noviembregaasxcampustotv2'] = $this->modelo_factor_gei->Noviembregaasxcampustotv2($campus_gmtfinal);
		$data['Diciembregaasxcampustotv2'] = $this->modelo_factor_gei->Diciembregaasxcampustotv2($campus_gmtfinal);
	}	
	else{
			if(!!empty($campus_gmtfinal))
	{
		$data['Enerogaasxcampustotv2'] = $this->modelo_factor_gei->Enerogaasxcampustotv2($campus_gmtfinal);
		$data['Febrerogaasxcampustotv2'] = $this->modelo_factor_gei->Febrerogaasxcampustotv2($campus_gmtfinal);
		$data['Marzogaasxcampustotv2'] = $this->modelo_factor_gei->Marzogaasxcampustotv2($campus_gmtfinal);
		$data['Abrilgaasxcampustotv2'] = $this->modelo_factor_gei->Abrilgaasxcampustotv2($campus_gmtfinal);
		$data['Mayogaasxcampustotv2'] = $this->modelo_factor_gei->Mayogaasxcampustotv2($campus_gmtfinal);
		$data['Juniogaasxcampustotv2'] = $this->modelo_factor_gei->Juniogaasxcampustotv2($campus_gmtfinal);
		$data['Juliogaasxcampustotv2'] = $this->modelo_factor_gei->Juliogaasxcampustotv2($campus_gmtfinal);
		$data['Agostogaasxcampustotv2'] = $this->modelo_factor_gei->Agostogaasxcampustotv2($campus_gmtfinal);
		$data['Septiembregaasxcampustotv2'] = $this->modelo_factor_gei->Septiembregaasxcampustotv2($campus_gmtfinal);
		$data['Octubregaasxcampustotv2'] = $this->modelo_factor_gei->Octubregaasxcampustotv2($campus_gmtfinal);
		$data['Noviembregaasxcampustotv2'] = $this->modelo_factor_gei->Noviembregaasxcampustotv2($campus_gmtfinal);
		$data['Diciembregaasxcampustotv2'] = $this->modelo_factor_gei->Diciembregaasxcampustotv2($campus_gmtfinal);
	}	
	}
	}
		$data['title']= '<i class="icon-fire"></i> Gas Natural';
		$data['subtitle'] = 'Consumo de Gas x Campus 2015 -  ' .date('Y', strtotime('-1 year')).  ' GM';
		$data['body'] = 'GreenMetricAjusteGas';
		$this->load->view('main', $data);
}

/********************************************************CIERRE*******************************************************/

//Genera el formulario para la consulta de Consumo m3 Gas (GM) por mes desde el 2011 a la fecha//


function consumogaasxcampusnonGM()
{
	/*$this->modelo_factor_gei->congaasxcampusnonGM();*/
	$submit = $this->input->post('enviar');
	$campus_nongmtfinal = $this->input->post('campus_nongmtfinal');

	if($submit=='volver')
	{
		redirect("inicio");
	}
	if($submit=='reloadcexcnongm')
	{
		$this->modelo_factor_gei->congaasxcampusnonGM();
		$this->modelo_factor_gei->droprgaasxcampusnonGM();
		$this->modelo_factor_gei->congaasxcampusnonGM();
		redirect("control_factor_gei/consumogaasxcampusnonGM");
	}
	else
	{
		// Carga combobox dependencia

		$data['catecexcnongm']	= $this->modelo_factor_gei->gaasxcampusfinalnonGM();

		// Genera las consultas por dependencia
		$data['resecexcnongm'] = $this->modelo_factor_gei->gaasxcampusresultadononGM();
		
		$data['campus_nongmtfinal'] = $campus_nongmtfinal;


	if(!empty($campus_nongmtfinal))
	{
		$data['EnerogaasxcampustotnonGM'] = $this->modelo_factor_gei->EnerogaasxcampustotnonGM($campus_nongmtfinal);
		$data['FebrerogaasxcampustotnonGM'] = $this->modelo_factor_gei->FebrerogaasxcampustotnonGM($campus_nongmtfinal);
		$data['MarzogaasxcampustotnonGM'] = $this->modelo_factor_gei->MarzogaasxcampustotnonGM($campus_nongmtfinal);
		$data['AbrilgaasxcampustotnonGM'] = $this->modelo_factor_gei->AbrilgaasxcampustotnonGM($campus_nongmtfinal);
		$data['MayogaasxcampustotnonGM'] = $this->modelo_factor_gei->MayogaasxcampustotnonGM($campus_nongmtfinal);
		$data['JuniogaasxcampustotnonGM'] = $this->modelo_factor_gei->JuniogaasxcampustotnonGM($campus_nongmtfinal);
		$data['JuliogaasxcampustotnonGM'] = $this->modelo_factor_gei->JuliogaasxcampustotnonGM($campus_nongmtfinal);
		$data['AgostogaasxcampustotnonGM'] = $this->modelo_factor_gei->AgostogaasxcampustotnonGM($campus_nongmtfinal);
		$data['SeptiembregaasxcampustotnonGM'] = $this->modelo_factor_gei->SeptiembregaasxcampustotnonGM($campus_nongmtfinal);
		$data['OctubregaasxcampustotnonGM'] = $this->modelo_factor_gei->OctubregaasxcampustotnonGM($campus_nongmtfinal);
		$data['NoviembregaasxcampustotnonGM'] = $this->modelo_factor_gei->NoviembregaasxcampustotnonGM($campus_nongmtfinal);
		$data['DiciembregaasxcampustotnonGM'] = $this->modelo_factor_gei->DiciembregaasxcampustotnonGM($campus_nongmtfinal);
	}	
	else{
			if(!!empty($campus_nongmtfinal))
	{
		$data['EnerogaasxcampustotnonGM'] = $this->modelo_factor_gei->EnerogaasxcampustotnonGM($campus_nongmtfinal);
		$data['FebrerogaasxcampustotnonGM'] = $this->modelo_factor_gei->FebrerogaasxcampustotnonGM($campus_nongmtfinal);
		$data['MarzogaasxcampustotnonGM'] = $this->modelo_factor_gei->MarzogaasxcampustotnonGM($campus_nongmtfinal);
		$data['AbrilgaasxcampustotnonGM'] = $this->modelo_factor_gei->AbrilgaasxcampustotnonGM($campus_nongmtfinal);
		$data['MayogaasxcampustotnonGM'] = $this->modelo_factor_gei->MayogaasxcampustotnonGM($campus_nongmtfinal);
		$data['JuniogaasxcampustotnonGM'] = $this->modelo_factor_gei->JuniogaasxcampustotnonGM($campus_nongmtfinal);
		$data['JuliogaasxcampustotnonGM'] = $this->modelo_factor_gei->JuliogaasxcampustotnonGM($campus_nongmtfinal);
		$data['AgostogaasxcampustotnonGM'] = $this->modelo_factor_gei->AgostogaasxcampustotnonGM($campus_nongmtfinal);
		$data['SeptiembregaasxcampustotnonGM'] = $this->modelo_factor_gei->SeptiembregaasxcampustotnonGM($campus_nongmtfinal);
		$data['OctubregaasxcampustotnonGM'] = $this->modelo_factor_gei->OctubregaasxcampustotnonGM($campus_nongmtfinal);
		$data['NoviembregaasxcampustotnonGM'] = $this->modelo_factor_gei->NoviembregaasxcampustotnonGM($campus_nongmtfinal);
		$data['DiciembregaasxcampustotnonGM'] = $this->modelo_factor_gei->DiciembregaasxcampustotnonGM($campus_nongmtfinal);
	}	
	}
	}
		$data['title']= '<i class="icon-fire"></i> Gas Natural';
		$data['subtitle'] = 'Consumo de Gas x Campus 2011 -  ' .date("Y").' (DINSU)';
		$data['body'] = 'consumogaasxcampusNONGreenMetric';
		$this->load->view('main', $data);
}
/********************************************************CIERRE*******************************************************/

/*CONTROL PARA MANDAR LLAMAR LA GRÁFICA ANUAL DE AGUA (HIGHCHARTS-GM)*/
function metrica_gei_agua_gm()
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
			$data['loadgei_a'] = $this->modelo_factor_gei->load_gei_table_wtr_gm();
		}
		$data['tittle'] = '<i class="icon-tint"></i> Agua';
		$data['subtitle'] = 'Consumo de Agua 2011 -  ' .date('Y', strtotime('-1 year')).  ' GM';
		$data['body'] = 'metricas_gei_agua_gm';
		$this->load->view('main', $data);
}
}
/********************************************************CIERRE*******************************************************/

/*CONTROL PARA MANDAR LLAMAR LA GRÁFICA ANUAL DE GAS (HIGHCHARTS-GM)*/

function metrica_gei_gas_gm()
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
			$data['loadgei_g'] = $this->modelo_factor_gei->load_gei_table_gas_gm();
		}
		$data['title'] = '<i class="icon-fire"></i> Gas Natural';
		$data['subtitle'] = 'Consumo de Gas 2011 -  ' .date('Y', strtotime('-1 year')).  ' GM';
		$data['body'] = 'metricas_gei_gas_gm';
		$this->load->view('main', $data);
	}
}
/********************************************************CIERRE*******************************************************/

/***********************************************************************************************
DESGLOZE TOTAL ANUAL DE ELECTRICIDAD
***********************************************************************************************/
/* Configuración */

/*Muestra en una tabla el resultado de la busqueda para el desgloze total anual de electricidad */
function ctdesglosetotanualelec()
{
	$submit = $this->input->post('enviar');
	$year = $this->input->post('year');
	if($submit=='volver')
	{
		redirect("inicio");
	}
		if($submit=='reloadtotelec')
	{
		$this->modelo_factor_gei->creatotanualelec();
		$this->modelo_factor_gei->dropdestotanualelec();
		$this->modelo_factor_gei->creatotanualelec();
		redirect("control_factor_gei/ctdesglosetotanualelec");
	}
	else
	{
		$data['year'] = $year;
		$data['mostrardatos'] = $this->modelo_factor_gei->desglosetotanualelec($year);
		$data['title'] = '<i class="icon-bolt"></i> Energía Eléctrica';
		$data['subtitle'] = 'Desglose Total Anual de Consumo en Electricidad';
		$data['body'] = 'desglose_elec_total_anual';
		$this->load->view('main', $data);

	}
}
/********************************************************CIERRE*******************************************************/

/********************************************************CIERRE*******************************************************/

/***********************************************************************************************
DESGLOZE TOTAL ANUAL DE AGUA
***********************************************************************************************/
/* Configuración */

/*Muestra en una tabla el resultado de la busqueda para el desgloze total anual de agua */
function ctdesglosetotanualagua()
{
	$submit = $this->input->post('enviar');
	$year = $this->input->post('year');
	if($submit=='volver')
	{
		redirect("inicio");
	}
		if($submit=='reloadtotagua')
	{
		$this->modelo_factor_gei->creatotanualagua();
		$this->modelo_factor_gei->dropdestotanualagua();
		$this->modelo_factor_gei->creatotanualagua();
		redirect("control_factor_gei/ctdesglosetotanualagua");
	}
	else
	{
		$data['year'] = $year;
		$data['mostrardatos'] = $this->modelo_factor_gei->desglosetotanualagua($year);
		$data['title'] = '<i class="icon-tint"></i> Agua';
		$data['subtitle'] = 'Desglose Total Anual de Consumo en Agua';
		$data['body'] = 'desglose_agua_total_anual';
		$this->load->view('main', $data);

	}
}
/********************************************************CIERRE*******************************************************/

/***********************************************************************************************
DESGLOSE TOTAL ANUAL DE GAS
***********************************************************************************************/
/* Configuración */

/*Muestra en una tabla el resultado de la busqueda para el desgloze total anual de gas */
function ctdesglosetotanualgas()
{
	$submit = $this->input->post('enviar');
	$year = $this->input->post('year');
	if($submit=='volver')
	{
		redirect("inicio");
	}
		if($submit=='reloadtotgas')
	{
		$this->modelo_factor_gei->creatotanualgas();
		$this->modelo_factor_gei->dropdestotanualgas();
		$this->modelo_factor_gei->creatotanualgas();
		redirect("control_factor_gei/ctdesglosetotanualgas");
	}
	else
	{
		$data['year'] = $year;
		$data['mostrardatos'] = $this->modelo_factor_gei->desglosetotanualgas($year);
		$data['title'] = '<i class="icon-fire"></i> Gas';
		$data['subtitle'] = 'Desglose Total Anual de Consumo en Gas';
		$data['body'] = 'desglose_gas_total_anual';
		$this->load->view('main', $data);


	}
}
/********************************************************CIERRE*******************************************************/

/***************************************************FIN DEL CONTROL***************************************************/

/***********************************************************************************************
CONTROL PARA GRAFICAS GEI DE MESES POR AÑOS
***********************************************************************************************/

/********************************************************ELECTRICIDAD*******************************************************/
/*PAGINA DE ENLACES PARA LAS GRÁFICAS DE ELECTRICIDAD*/
function inicio_gei_mes_elec()
{
	$submit = $this->input->post('enviar');
	$year = $this->input->post('year');
	if($submit=='volver')
	{
		redirect("inicio");
	}
	else
	{

		$data['title'] = '<i class="icon-bolt"></i> Energía Eléctrica';
		$data['subtitle'] = 'Gráficas de Consumo Mensual por Año - GM';
		$data['body'] = 'inicio_gr_gei_elec';
		$this->load->view('main', $data);
	}
}
/********************************************************CIERRE*******************************************************/
/* GM ELECTRICIDAD CIUDAD UNIVERSITARIA */
function mensualgm_elec_cdun()
{
	$submit = $this->input->post('enviar');
	$year = $this->input->post('year');
	if($submit=='volver')
	{
		redirect("control_factor_gei/inicio_gei_mes_elec");
	}
	else
	{
		$data['title'] = '<i class="icon-bolt"></i> Energía Eléctrica';
		$data['subtitle'] = 'Consumo Mensual por Año GM';
		$data['body'] = 'mensualgm_elec_cdu';
		$this->load->view('main', $data);
	}
}
/********************************************************CIERRE*******************************************************/
/* GM ELECTRICIDAD CAMPUS CIENCIAS DE LA SALUD */
function mensualgm_elec_cdls()
{
	$submit = $this->input->post('enviar');
	$year = $this->input->post('year');
	if($submit=='volver')
	{
		redirect("control_factor_gei/inicio_gei_mes_elec");
	}
	else
	{
		$data['title'] = '<i class="icon-bolt"></i> Energía Eléctrica';
		$data['subtitle'] = 'Consumo Mensual por Año GM';
		$data['body'] = 'mensualgm_elec_csdls';
		$this->load->view('main', $data);
	}
}
/********************************************************CIERRE*******************************************************/
/* GM ELECTRICIDAD AGROPECUARIAS */
function mensualgm_elec_cagro()
{
	$submit = $this->input->post('enviar');
	$year = $this->input->post('year');
	if($submit=='volver')
	{
		redirect("control_factor_gei/inicio_gei_mes_elec");
	}
	else
	{
		$data['title'] = '<i class="icon-bolt"></i> Energía Eléctrica';
		$data['subtitle'] = 'Consumo Mensual por Año GM';
		$data['body'] = 'mensualgm_elec_ccagro';
		$this->load->view('main', $data);
	}
}
/********************************************************CIERRE*******************************************************/
/* GM ELECTRICIDAD LINARES */
function mensualgm_elec_clina()
{
	$submit = $this->input->post('enviar');
	$year = $this->input->post('year');
	if($submit=='volver')
	{
		redirect("control_factor_gei/inicio_gei_mes_elec");
	}
	else
	{
		$data['title'] = '<i class="icon-bolt"></i> Energía Eléctrica';
		$data['subtitle'] = 'Consumo Mensual por Año GM';
		$data['body'] = 'mensualgm_elec_clina';
		$this->load->view('main', $data);
	}
}
/********************************************************CIERRE*******************************************************/
/* GM ELECTRICIDAD MEDEROS */
function mensualgm_elec_cmede()
{
	$submit = $this->input->post('enviar');
	$year = $this->input->post('year');
	if($submit=='volver')
	{
		redirect("control_factor_gei/inicio_gei_mes_elec");
	}
	else
	{
		$data['title'] = '<i class="icon-bolt"></i> Energía Eléctrica';
		$data['subtitle'] = 'Consumo Mensual por Año GM';
		$data['body'] = 'mensualgm_elec_cmederos';
		$this->load->view('main', $data);
	}
}
/********************************************************CIERRE*******************************************************/
/* GM ELECTRICIDAD SABINAS HIDALGO */
function mensualgm_elec_csahi()
{
	$submit = $this->input->post('enviar');
	$year = $this->input->post('year');
	if($submit=='volver')
	{
		redirect("control_factor_gei/inicio_gei_mes_elec");
	}
	else
	{
		$data['title'] = '<i class="icon-bolt"></i> Energía Eléctrica';
		$data['subtitle'] = 'Consumo Mensual por Año GM';
		$data['body'] = 'mensualgm_elec_csahi';
		$this->load->view('main', $data);
	}
}
/********************************************************CIERRE*******************************************************/
/********************************************************AGUA*******************************************************/
/*PAGINA DE ENLACES PARA LAS GRÁFICAS DE AGUA*/
function inicio_gei_mes_agua()
{
	$submit = $this->input->post('enviar');
	$year = $this->input->post('year');
	if($submit=='volver')
	{
		redirect("inicio");
	}
	else
	{
		$data['title'] = '<i class="icon-tint"></i> Agua';
		$data['subtitle'] = 'Gráficas de Consumo Mensual por Año';
		$data['body'] = 'inicio_gr_gei_agua';
		$this->load->view('main', $data);
	}
}
/********************************************************CIERRE*******************************************************/
/* GM AGUA CIUDAD UNIVERSITARIA */
function mensualgm_agua_cdun()
{
	$submit = $this->input->post('enviar');
	$year = $this->input->post('year');
	if($submit=='volver')
	{
		redirect("control_factor_gei/inicio_gei_mes_agua");
	}
	else
	{
		$data['title'] = '<i class="icon-tint"></i> Agua';
		$data['subtitle'] = 'Consumo Mensual por Año GM';
		$data['body'] = 'mensualgm_agua_cdu';
		$this->load->view('main', $data);
	}
}
/********************************************************CIERRE*******************************************************/
/* GM AGUA CIENCIAS DE LA SALUD */
function mensualgm_agua_cdls()
{
	$submit = $this->input->post('enviar');
	$year = $this->input->post('year');
	if($submit=='volver')
	{
		redirect("control_factor_gei/inicio_gei_mes_agua");
	}
	else
	{
		$data['title'] = '<i class="icon-tint"></i> Agua';
		$data['subtitle'] = 'Consumo Mensual por Año GM';
		$data['body'] = 'mensualgm_agua_csdls';
		$this->load->view('main', $data);
	}
}
/********************************************************CIERRE*******************************************************/
/* GM AGUA AGROPECUARIAS */
function mensualgm_agua_cagro()
{
	$submit = $this->input->post('enviar');
	$year = $this->input->post('year');
	if($submit=='volver')
	{
		redirect("control_factor_gei/inicio_gei_mes_agua");
	}
	else
	{
		$data['title'] = '<i class="icon-tint"></i> Agua';
		$data['subtitle'] = 'Consumo Mensual por Año GM';
		$data['body'] = 'mensualgm_agua_ccagro';
		$this->load->view('main', $data);
	}
}
/********************************************************CIERRE*******************************************************/
/* GM AGUA LINARES */
function mensualgm_agua_clina()
{
	$submit = $this->input->post('enviar');
	$year = $this->input->post('year');
	if($submit=='volver')
	{
		redirect("control_factor_gei/inicio_gei_mes_agua");
	}
	else
	{
		$data['title'] = '<i class="icon-tint"></i> Agua';
		$data['subtitle'] = 'Consumo Mensual por Año GM';
		$data['body'] = 'mensualgm_agua_clina';
		$this->load->view('main', $data);
	}
}
/********************************************************CIERRE*******************************************************/
/* GM AGUA MEDEROS */
function mensualgm_agua_cmede()
{
	$submit = $this->input->post('enviar');
	$year = $this->input->post('year');
	if($submit=='volver')
	{
		redirect("control_factor_gei/inicio_gei_mes_agua");
	}
	else
	{
		$data['title'] = '<i class="icon-tint"></i> Agua';
		$data['subtitle'] = 'Consumo Mensual por Año GM';
		$data['body'] = 'mensualgm_agua_cmederos';
		$this->load->view('main', $data);
	}
}
/********************************************************CIERRE*******************************************************/
/* GM AGUA SABINAS HIDALGO */
function mensualgm_agua_csahi()
{
	$submit = $this->input->post('enviar');
	$year = $this->input->post('year');
	if($submit=='volver')
	{
		redirect("control_factor_gei/inicio_gei_mes_agua");
	}
	else
	{
		$data['title'] = '<i class="icon-tint"></i> Agua';
		$data['subtitle'] = 'Consumo Mensual por Año GM';
		$data['body'] = 'mensualgm_agua_csahi';
		$this->load->view('main', $data);
	}
}
/********************************************************CIERRE*******************************************************/
/********************************************************GAS*******************************************************/
/*PAGINA DE ENLACES PARA LAS GRÁFICAS DE GAS*/
function inicio_gei_mes_gas()
{
	$submit = $this->input->post('enviar');
	$year = $this->input->post('year');
	if($submit=='volver')
	{
		redirect("inicio");
	}
	else
	{

		$data['title'] = '<i class="icon-fire"></i> Gas';
		$data['subtitle'] = 'Gráficas de Consumo Mensual por Año - GM';
		$data['body'] = 'inicio_gr_gei_gas';
		$this->load->view('main', $data);
	}
}
/********************************************************CIERRE*******************************************************/
/* GM GAS CIUDAD UNIVERSITARIA */
function mensualgm_gas_cdun()
{
	$submit = $this->input->post('enviar');
	$year = $this->input->post('year');
	if($submit=='volver')
	{
		redirect("control_factor_gei/inicio_gei_mes_gas");
	}
	else
	{
		$data['title'] = '<i class="icon-fire"></i> GAS';
		$data['subtitle'] = 'Consumo Mensual por Año GEI GM';
		$data['body'] = 'mensualgm_gas_cdu';
		$this->load->view('main', $data);
	}
}
/********************************************************CIERRE*******************************************************/
/* GM GAS CIENCIAS DE LA SALUD */
function mensualgm_gas_cdls()
{
	$submit = $this->input->post('enviar');
	$year = $this->input->post('year');
	if($submit=='volver')
	{
		redirect("control_factor_gei/inicio_gei_mes_gas");
	}
	else
	{
		$data['title'] = '<i class="icon-fire"></i> GAS';
		$data['subtitle'] = 'Consumo Mensual por Año GM';
		$data['body'] = 'mensualgm_gas_csdls';
		$this->load->view('main', $data);
	}
}
/********************************************************CIERRE*******************************************************/
/* GM GAS AGROPECUARIAS */
function mensualgm_gas_cagro()
{
	$submit = $this->input->post('enviar');
	$year = $this->input->post('year');
	if($submit=='volver')
	{
		redirect("control_factor_gei/inicio_gei_mes_gas");
	}
	else
	{
		$data['title'] = '<i class="icon-fire"></i> GAS';
		$data['subtitle'] = 'Consumo Mensual por Año GM';
		$data['body'] = 'mensualgm_gas_ccagro';
		$this->load->view('main', $data);
	}
}
/********************************************************CIERRE*******************************************************/
/* GM GAS LINARES */
function mensualgm_gas_clina()
{
	$submit = $this->input->post('enviar');
	$year = $this->input->post('year');
	if($submit=='volver')
	{
		redirect("control_factor_gei/inicio_gei_mes_gas");
	}
	else
	{
		$data['title'] = '<i class="icon-fire"></i> GAS';
		$data['subtitle'] = 'Consumo Mensual por Año GM';
		$data['body'] = 'mensualgm_gas_clina';
		$this->load->view('main', $data);
	}
}
/********************************************************CIERRE*******************************************************/
/* GM GAS MEDEROS */
function mensualgm_gas_cmede()
{
	$submit = $this->input->post('enviar');
	$year = $this->input->post('year');
	if($submit=='volver')
	{
		redirect("control_factor_gei/inicio_gei_mes_gas");
	}
	else
	{
		$data['title'] = '<i class="icon-fire"></i> GAS';
		$data['subtitle'] = 'Consumo Mensual por Año GM';
		$data['body'] = 'mensualgm_gas_cmederos';
		$this->load->view('main', $data);
	}
}
/********************************************************CIERRE*******************************************************/
/* GM GAS SABINAS HIDALGO */
function mensualgm_gas_csahi()
{
	$submit = $this->input->post('enviar');
	$year = $this->input->post('year');
	if($submit=='volver')
	{
		redirect("control_factor_gei/inicio_gei_mes_gas");
	}
	else
	{
		$data['title'] = '<i class="icon-fire"></i> GAS';
		$data['subtitle'] = 'Consumo Mensual por Año GM';
		$data['body'] = 'mensualgm_gas_csahi';
		$this->load->view('main', $data);
	}
}
/********************************************************CIERRE*******************************************************/
/*CONTROL PARA MANDAR LLAMAR LA GRÁFICA DE KWh PER CAPITA POR AÑO EN AGUA (HIGHCHARTS)*/
function m3cperiodo_agua_gm()
{
	$submit = $this->input->post('enviar');
		if($submit=='volver')
	{
		redirect("inicio");
	}
	$data['tittle'] = '<i class="icon-tint"></i> Energía Líquida';
	$data['subtitle'] = 'Agua';
	$data['body'] = 'm3cperiodo_agua_gm';
	$this->load->view('main', $data);
}
/********************************************************CIERRE*******************************************************/

/*CONTROL PARA MANDAR LLAMAR LA GRÁFICA DE Kg PER CAPITA POR AÑO EN AGUA GM GM (HIGHCHARTS)*/
function wtrkgcperiodo_agua_gm()
{
	$submit = $this->input->post('enviar');
		if($submit=='volver')
	{
		redirect("inicio");
	}
	$data['tittle'] = '<i class="icon-tint"></i> Energía Líquida';
	$data['subtitle'] = 'Agua';
	$data['body'] = 'wtrkgcperiodo_agua_gm';
	$this->load->view('main', $data);
}
/********************************************************CIERRE*******************************************************/
/*CONTROL PARA MANDAR LLAMAR LA GRÁFICA DE M3 PER CAPITA POR AÑO EN GAS GM GM (HIGHCHARTS)*/
function m3cperiodo_gas_gm()
{
	$submit = $this->input->post('enviar');
		if($submit=='volver')
	{
		redirect("inicio");
	}
	$data['tittle'] = '<i class="icon-fire"></i> Energía Líquida';
	$data['subtitle'] = 'Gas';
	$data['body'] = 'm3cperiodo_gas_gm';
	$this->load->view('main', $data);
}
/********************************************************CIERRE*******************************************************/
/*CONTROL PARA MANDAR LLAMAR LA GRÁFICA DE kg PER CAPITA POR AÑO EN GAS GM GM (HIGHCHARTS)*/
function gaskgcperiodo_gas_gm()
{
	$submit = $this->input->post('enviar');
		if($submit=='volver')
	{
		redirect("inicio");
	}
	$data['tittle'] = '<i class="icon-fire"></i> Energía Líquida';
	$data['subtitle'] = 'Gas';
	$data['body'] = 'gaskgcperiodo_gas_gm';
	$this->load->view('main', $data);
}


/********************************************************CIERRE*******************************************************/
/***************************************************FIN DEL CONTROL***************************************************/
/***********************************************************************************************
CONTROL PARA GRAFICAS GEI DE MESES POR AÑOS - RE EDICIÓN: RANGO MENOR DE AÑOS
***********************************************************************************************/

/********************************************************ELECTRICIDAD*******************************************************/
/*PAGINA DE ENLACES PARA LAS GRÁFICAS DE ELECTRICIDAD*/
function inicio_gei_mes_elec_v2()
{
	$submit = $this->input->post('enviar');
	$year = $this->input->post('year');
	if($submit=='volver')
	{
		redirect("inicio");
	}
	else
	{

		$data['title'] = '<i class="icon-bolt"></i> Energía Eléctrica';
		$data['subtitle'] = 'Gráficas de Consumo Mensual por Año - GM';
		$data['body'] = 'inicio_gr_gei_elec_v2';
		$this->load->view('main', $data);
	}
}
/********************************************************CIERRE*******************************************************/
/* GM ELECTRICIDAD CIUDAD UNIVERSITARIA */
function mensualgm_elec_cdun_v2()
{
	$submit = $this->input->post('enviar');
	$year = $this->input->post('year');
	if($submit=='volver')
	{
		redirect("control_factor_gei/inicio_gei_mes_elec_v2");
	}
	else
	{
		$data['title'] = '<i class="icon-bolt"></i> Energía Eléctrica';
		$data['subtitle'] = 'Consumo Mensual por Año GM';
		$data['body'] = 'mensualgm_elec_cdu_v2';
		$this->load->view('main', $data);
	}
}
/********************************************************CIERRE*******************************************************/
/* GM ELECTRICIDAD CAMPUS CIENCIAS DE LA SALUD */
function mensualgm_elec_cdls_v2()
{
	$submit = $this->input->post('enviar');
	$year = $this->input->post('year');
	if($submit=='volver')
	{
		redirect("control_factor_gei/inicio_gei_mes_elec_v2");
	}
	else
	{
		$data['title'] = '<i class="icon-bolt"></i> Energía Eléctrica';
		$data['subtitle'] = 'Consumo Mensual por Año GM';
		$data['body'] = 'mensualgm_elec_csdls_v2';
		$this->load->view('main', $data);
	}
}
/********************************************************CIERRE*******************************************************/
/* GM ELECTRICIDAD AGROPECUARIAS */
function mensualgm_elec_cagro_v2()
{
	$submit = $this->input->post('enviar');
	$year = $this->input->post('year');
	if($submit=='volver')
	{
		redirect("control_factor_gei/inicio_gei_mes_elec_v2");
	}
	else
	{
		$data['title'] = '<i class="icon-bolt"></i> Energía Eléctrica';
		$data['subtitle'] = 'Consumo Mensual por Año GM';
		$data['body'] = 'mensualgm_elec_ccagro_v2';
		$this->load->view('main', $data);
	}
}
/********************************************************CIERRE*******************************************************/
/* GM ELECTRICIDAD LINARES */
function mensualgm_elec_clina_v2()
{
	$submit = $this->input->post('enviar');
	$year = $this->input->post('year');
	if($submit=='volver')
	{
		redirect("control_factor_gei/inicio_gei_mes_elec_v2");
	}
	else
	{
		$data['title'] = '<i class="icon-bolt"></i> Energía Eléctrica';
		$data['subtitle'] = 'Consumo Mensual por Año GM';
		$data['body'] = 'mensualgm_elec_clina_v2';
		$this->load->view('main', $data);
	}
}
/********************************************************CIERRE*******************************************************/
/* GM ELECTRICIDAD MEDEROS */
function mensualgm_elec_cmede_v2()
{
	$submit = $this->input->post('enviar');
	$year = $this->input->post('year');
	if($submit=='volver')
	{
		redirect("control_factor_gei/inicio_gei_mes_elec_v2");
	}
	else
	{
		$data['title'] = '<i class="icon-bolt"></i> Energía Eléctrica';
		$data['subtitle'] = 'Consumo Mensual por Año GM';
		$data['body'] = 'mensualgm_elec_cmederos_v2';
		$this->load->view('main', $data);
	}
}
/********************************************************CIERRE*******************************************************/
/* GM ELECTRICIDAD SABINAS HIDALGO */
function mensualgm_elec_csahi_v2()
{
	$submit = $this->input->post('enviar');
	$year = $this->input->post('year');
	if($submit=='volver')
	{
		redirect("control_factor_gei/inicio_gei_mes_elec_v2");
	}
	else
	{
		$data['title'] = '<i class="icon-bolt"></i> Energía Eléctrica';
		$data['subtitle'] = 'Consumo Mensual por Año GM';
		$data['body'] = 'mensualgm_elec_csahi_v2';
		$this->load->view('main', $data);
	}
}
/********************************************************CIERRE*******************************************************/
/********************************************************AGUA*******************************************************/
/*PAGINA DE ENLACES PARA LAS GRÁFICAS DE AGUA*/
function inicio_gei_mes_agua_v2()
{
	$submit = $this->input->post('enviar');
	$year = $this->input->post('year');
	if($submit=='volver')
	{
		redirect("inicio");
	}
	else
	{
		$data['title'] = '<i class="icon-tint"></i> Agua';
		$data['subtitle'] = 'Gráficas de Consumo Mensual por Año';
		$data['body'] = 'inicio_gr_gei_agua_v2';
		$this->load->view('main', $data);
	}
}
/********************************************************CIERRE*******************************************************/
/* GM AGUA CIUDAD UNIVERSITARIA */
function mensualgm_agua_cdun_v2()
{
	$submit = $this->input->post('enviar');
	$year = $this->input->post('year');
	if($submit=='volver')
	{
		redirect("control_factor_gei/inicio_gei_mes_agua_v2");
	}
	else
	{
		$data['title'] = '<i class="icon-tint"></i> Agua';
		$data['subtitle'] = 'Consumo Mensual por Año GM';
		$data['body'] = 'mensualgm_agua_cdu_v2';
		$this->load->view('main', $data);
	}
}
/********************************************************CIERRE*******************************************************/
/* GM AGUA CIENCIAS DE LA SALUD */
function mensualgm_agua_cdls_v2()
{
	$submit = $this->input->post('enviar');
	$year = $this->input->post('year');
	if($submit=='volver')
	{
		redirect("control_factor_gei/inicio_gei_mes_agua_v2");
	}
	else
	{
		$data['title'] = '<i class="icon-tint"></i> Agua';
		$data['subtitle'] = 'Consumo Mensual por Año GM';
		$data['body'] = 'mensualgm_agua_csdls_v2';
		$this->load->view('main', $data);
	}
}
/********************************************************CIERRE*******************************************************/
/* GM AGUA AGROPECUARIAS */
function mensualgm_agua_cagro_v2()
{
	$submit = $this->input->post('enviar');
	$year = $this->input->post('year');
	if($submit=='volver')
	{
		redirect("control_factor_gei/inicio_gei_mes_agua_v2");
	}
	else
	{
		$data['title'] = '<i class="icon-tint"></i> Agua';
		$data['subtitle'] = 'Consumo Mensual por Año GM';
		$data['body'] = 'mensualgm_agua_ccagro_v2';
		$this->load->view('main', $data);
	}
}
/********************************************************CIERRE*******************************************************/
/* GM AGUA LINARES */
function mensualgm_agua_clina_v2()
{
	$submit = $this->input->post('enviar');
	$year = $this->input->post('year');
	if($submit=='volver')
	{
		redirect("control_factor_gei/inicio_gei_mes_agua_v2");
	}
	else
	{
		$data['title'] = '<i class="icon-tint"></i> Agua';
		$data['subtitle'] = 'Consumo Mensual por Año GM';
		$data['body'] = 'mensualgm_agua_clina_v2';
		$this->load->view('main', $data);
	}
}
/********************************************************CIERRE*******************************************************/
/* GM AGUA MEDEROS */
function mensualgm_agua_cmede_v2()
{
	$submit = $this->input->post('enviar');
	$year = $this->input->post('year');
	if($submit=='volver')
	{
		redirect("control_factor_gei/inicio_gei_mes_agua_v2");
	}
	else
	{
		$data['title'] = '<i class="icon-tint"></i> Agua';
		$data['subtitle'] = 'Consumo Mensual por Año GM';
		$data['body'] = 'mensualgm_agua_cmederos_v2';
		$this->load->view('main', $data);
	}
}
/********************************************************CIERRE*******************************************************/
/* GM AGUA SABINAS HIDALGO */
function mensualgm_agua_csahi_v2()
{
	$submit = $this->input->post('enviar');
	$year = $this->input->post('year');
	if($submit=='volver')
	{
		redirect("control_factor_gei/inicio_gei_mes_agua_v2");
	}
	else
	{
		$data['title'] = '<i class="icon-tint"></i> Agua';
		$data['subtitle'] = 'Consumo Mensual por Año GM';
		$data['body'] = 'mensualgm_agua_csahi_v2';
		$this->load->view('main', $data);
	}
}
/********************************************************CIERRE*******************************************************/
/********************************************************GAS*******************************************************/
/*PAGINA DE ENLACES PARA LAS GRÁFICAS DE GAS*/
function inicio_gei_mes_gas_v2()
{
	$submit = $this->input->post('enviar');
	$year = $this->input->post('year');
	if($submit=='volver')
	{
		redirect("inicio");
	}
	else
	{

		$data['title'] = '<i class="icon-fire"></i> Gas';
		$data['subtitle'] = 'Gráficas de Consumo Mensual por Año - GM';
		$data['body'] = 'inicio_gr_gei_gas_v2';
		$this->load->view('main', $data);
	}
}
/********************************************************CIERRE*******************************************************/
/* GM GAS CIUDAD UNIVERSITARIA */
function mensualgm_gas_cdun_v2()
{
	$submit = $this->input->post('enviar');
	$year = $this->input->post('year');
	if($submit=='volver')
	{
		redirect("control_factor_gei/inicio_gei_mes_gas_v2");
	}
	else
	{
		$data['title'] = '<i class="icon-fire"></i> GAS';
		$data['subtitle'] = 'Consumo Mensual por Año GEI GM';
		$data['body'] = 'mensualgm_gas_cdu_v2';
		$this->load->view('main', $data);
	}
}
/********************************************************CIERRE*******************************************************/
/* GM GAS CIENCIAS DE LA SALUD */
function mensualgm_gas_cdls_v2()
{
	$submit = $this->input->post('enviar');
	$year = $this->input->post('year');
	if($submit=='volver')
	{
		redirect("control_factor_gei/inicio_gei_mes_gas_v2");
	}
	else
	{
		$data['title'] = '<i class="icon-fire"></i> GAS';
		$data['subtitle'] = 'Consumo Mensual por Año GM';
		$data['body'] = 'mensualgm_gas_csdls_v2';
		$this->load->view('main', $data);
	}
}
/********************************************************CIERRE*******************************************************/
/* GM GAS AGROPECUARIAS */
function mensualgm_gas_cagro_v2()
{
	$submit = $this->input->post('enviar');
	$year = $this->input->post('year');
	if($submit=='volver')
	{
		redirect("control_factor_gei/inicio_gei_mes_gas_v2");
	}
	else
	{
		$data['title'] = '<i class="icon-fire"></i> GAS';
		$data['subtitle'] = 'Consumo Mensual por Año GM';
		$data['body'] = 'mensualgm_gas_ccagro_v2';
		$this->load->view('main', $data);
	}
}
/********************************************************CIERRE*******************************************************/
/* GM GAS LINARES */
function mensualgm_gas_clina_v2()
{
	$submit = $this->input->post('enviar');
	$year = $this->input->post('year');
	if($submit=='volver')
	{
		redirect("control_factor_gei/inicio_gei_mes_gas_v2");
	}
	else
	{
		$data['title'] = '<i class="icon-fire"></i> GAS';
		$data['subtitle'] = 'Consumo Mensual por Año GM';
		$data['body'] = 'mensualgm_gas_clina_v2';
		$this->load->view('main', $data);
	}
}
/********************************************************CIERRE*******************************************************/
/* GM GAS MEDEROS */
function mensualgm_gas_cmede_v2()
{
	$submit = $this->input->post('enviar');
	$year = $this->input->post('year');
	if($submit=='volver')
	{
		redirect("control_factor_gei/inicio_gei_mes_gas_v2");
	}
	else
	{
		$data['title'] = '<i class="icon-fire"></i> GAS';
		$data['subtitle'] = 'Consumo Mensual por Año GM';
		$data['body'] = 'mensualgm_gas_cmederos_v2';
		$this->load->view('main', $data);
	}
}
/********************************************************CIERRE*******************************************************/
/* GM GAS SABINAS HIDALGO */
function mensualgm_gas_csahi_v2()
{
	$submit = $this->input->post('enviar');
	$year = $this->input->post('year');
	if($submit=='volver')
	{
		redirect("control_factor_gei/inicio_gei_mes_gas_v2");
	}
	else
	{
		$data['title'] = '<i class="icon-fire"></i> GAS';
		$data['subtitle'] = 'Consumo Mensual por Año GM';
		$data['body'] = 'mensualgm_gas_csahi_v2';
		$this->load->view('main', $data);
	}
}
/********************************************************CIERRE*******************************************************/

/*CONTROL PARA MANDAR LLAMAR LA GRÁFICA DE KWh PER CAPITA POR AÑO EN ELECTRICIDAD (HIGHCHARTS-GM INTERVALO 5 AÑOS)*/

function kwcperiodo_elec_gm_5yrs()
{
	$submit = $this->input->post('enviar');
		if($submit=='volver')
	{
		redirect("inicio");
	}
	$data['tittle'] = '<i class="icon-bolt"></i> Energía Eléctrica';
	$data['subtitle'] = 'Electricidad ' .date('Y', strtotime('-5 year')).  ' -  ' .date('Y', strtotime('-1 year')).  ' GM';
	$data['body'] = 'kwcapitayear_elec_gm_5yrs';
	$this->load->view('main', $data);
}
/********************************************************CIERRE*******************************************************/


/*CONTROL PARA MANDAR LLAMAR LA GRÁFICA DE Kg PER CAPITA POR AÑO EN ELECTRICIDAD (HIGHCHARTS-GM INTERVALO 5 AÑOS)*/
function kgcperiodo_elec_gm_5yrs()
{
	$submit = $this->input->post('enviar');
		if($submit=='volver')
	{
		redirect("inicio");
	}
	$data['tittle'] = '<i class="icon-bolt"></i> Energía Eléctrica';
	//$data['subtitle'] = 'Electricidad 2011 -  ' .date('Y', strtotime('-1 year')).  ' GM INTERVALO 5 AÑOS';
	$data['subtitle'] = 'Electricidad ' .date('Y', strtotime('-5 year')).  ' -  ' .date('Y', strtotime('-1 year')).  ' GM';
	$data['body'] = 'kgcapitayear_elec_gm_5yrs';
	$this->load->view('main', $data);
}
/********************************************************CIERRE*******************************************************/
/*CONTROL PARA MANDAR LLAMAR LA GRÁFICA ANUAL DE ELECTRICIDAD (HIGHCHARTS-GM INTERVALO 5 AÑOS)*/
function metrica_gei_elec_gm_5yrs()
{
	$submit = $this->input->post('enviar');
	$year = $this->input->post('year');
	if($submit=='volver')
	{
		redirect("inicio");
	}
	if($submit=='reloadgmpdc5yrs')
	{
		$this->modelo_factor_gei->creacione_factore_gm_5yrs();
		$this->modelo_factor_gei->drope_creacione_factore_gm_5yrs();
		$this->modelo_factor_gei->creacione_factore_gm_5yrs();
		redirect("control_factor_gei/metrica_gei_elec_gm_5yrs");
	}
	else
	{
		if(empty($year))
		{
			$data['loadgei5yrs'] = $this->modelo_factor_gei->load_gei_table_gm_5yrs();
		}
		$data['tittle'] = '<i class="icon-bolt"></i> Energía Eléctrica';
		$data['subtitle'] = 'Consumo de Electricidad ' .date('Y', strtotime('-5 year')).  ' -  ' .date('Y', strtotime('-1 year')).  ' GM';
		$data['body'] = 'metricas_gei_elec_gm_5yrs';
		$this->load->view('main', $data);
}
}
/********************************************************CIERRE*******************************************************/

/*CONTROL PARA MANDAR LLAMAR LA GRÁFICA DE KWh PER CAPITA POR AÑO EN AGUA (HIGHCHARTS)*/
function m3cperiodo_agua_gm_5yrs()
{
	$submit = $this->input->post('enviar');
		if($submit=='volver')
	{
		redirect("inicio");
	}
	$data['tittle'] = '<i class="icon-tint"></i> Energía Líquida';
	$data['subtitle'] = 'Agua';
	$data['body'] = 'm3cperiodo_agua_gm_5yrs';
	$this->load->view('main', $data);
}
/********************************************************CIERRE*******************************************************/

/*CONTROL PARA MANDAR LLAMAR LA GRÁFICA DE Kg PER CAPITA POR AÑO EN AGUA GM (HIGHCHARTS INTERVALO 5 AÑOS)*/
function wtrkgcperiodo_agua_gm_5yrs()
{
	$submit = $this->input->post('enviar');
		if($submit=='volver')
	{
		redirect("inicio");
	}
	$data['tittle'] = '<i class="icon-tint"></i> Energía Líquida';
	$data['subtitle'] = 'Agua';
	$data['body'] = 'wtrkgcperiodo_agua_gm_5yrs';
	$this->load->view('main', $data);
}
/********************************************************CIERRE*******************************************************/
/*CONTROL PARA MANDAR LLAMAR LA GRÁFICA DEL INTERVALO DE 5 AÑOS DE AGUA GM (HIGHCHARTS)*/
function metrica_gei_agua_gm_5yrs()
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
			$data['loadgei_a'] = $this->modelo_factor_gei->load_gei_table_wtr_gm_5yrs();
		}
		$data['tittle'] = '<i class="icon-tint"></i> Agua';
		$data['subtitle'] = 'Consumo de Agua 2011 -  ' .date('Y', strtotime('-1 year')).  ' GM';
		$data['body'] = 'metricas_gei_agua_gm_5yrs';
		$this->load->view('main', $data);
}
}
/********************************************************CIERRE*******************************************************/
/*CONTROL PARA MANDAR LLAMAR LA GRÁFICA DE M3 PER CAPITA POR AÑO EN GAS GM GM (HIGHCHARTS INTERVALO 5 AÑOS)*/
function m3cperiodo_gas_gm_5yrs()
{
	$submit = $this->input->post('enviar');
		if($submit=='volver')
	{
		redirect("inicio");
	}
	$data['tittle'] = '<i class="icon-fire"></i> Energía Líquida';
	$data['subtitle'] = 'Gas';
	$data['body'] = 'm3cperiodo_gas_gm_5yrs';
	$this->load->view('main', $data);
}
/********************************************************CIERRE*******************************************************/
/*CONTROL PARA MANDAR LLAMAR LA GRÁFICA DE kg PER CAPITA POR AÑO EN GAS GM GM (HIGHCHARTS INTERVALO 5 AÑOS)*/
function gaskgcperiodo_gas_gm_5yrs()
{
	$submit = $this->input->post('enviar');
		if($submit=='volver')
	{
		redirect("inicio");
	}
	$data['tittle'] = '<i class="icon-fire"></i> Energía Líquida';
	$data['subtitle'] = 'Gas';
	$data['body'] = 'gaskgcperiodo_gas_gm_5yrs';
	$this->load->view('main', $data);
}
/********************************************************CIERRE*******************************************************/
/*CONTROL PARA MANDAR LLAMAR LA GRÁFICA ANUAL DE GAS GM (HIGHCHARTS INTERVALO 5 AÑOS)*/

function metrica_gei_gas_gm_5yrs()
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
			$data['loadgei_g'] = $this->modelo_factor_gei->load_gei_table_gas_gm_5yrs();
		}
		$data['title'] = '<i class="icon-fire"></i> Gas Natural';
		$data['subtitle'] = 'Consumo de Gas ' .date('Y', strtotime('-5 year')).  ' -  ' .date('Y', strtotime('-1 year')).  ' GM';
		$data['body'] = 'metricas_gei_gas_gm_5yrs';
		$this->load->view('main', $data);
	}
}
/********************************************************CIERRE*******************************************************/
//Genera el formulario Consumo de Electricidad x Campus - GM INTERVALO 5 AÑOS//


function consumoelecxcampusGM5yrs()
{
	/*$this->modelo_factor_gei->conelecxcampusv2();*/
	$submit = $this->input->post('enviar');
	$campus_gmtfinal = $this->input->post('campus_gmtfinal');

	if($submit=='volver')
	{
		redirect("inicio");
	}
	if($submit=='reloadcexcgm5yrs')
	{
		$this->modelo_factor_gei->conelecxcampus5yrs();
		$this->modelo_factor_gei->droprelecxcampus5yrs();
		$this->modelo_factor_gei->conelecxcampus5yrs();
		redirect("control_factor_gei/consumoelecxcampusGM5yrs");
	}
	else
	{
		// Carga combobox campus

		$data['catecexcgm5yrs']	= $this->modelo_factor_gei->elecxcampusfinal5yrs();

		// Genera las consultas por campus
		$data['resecexcgm5yrs'] = $this->modelo_factor_gei->elecxcampusresultado5yrs();
		
		$data['campus_gmtfinal'] = $campus_gmtfinal;


	if(!empty($campus_gmtfinal))
	{
		$data['Eneroelecxcampustot5yrs'] = $this->modelo_factor_gei->Eneroelecxcampustot5yrs($campus_gmtfinal);
		$data['Febreroelecxcampustot5yrs'] = $this->modelo_factor_gei->Febreroelecxcampustot5yrs($campus_gmtfinal);
		$data['Marzoelecxcampustot5yrs'] = $this->modelo_factor_gei->Marzoelecxcampustot5yrs($campus_gmtfinal);
		$data['Abrilelecxcampustot5yrs'] = $this->modelo_factor_gei->Abrilelecxcampustot5yrs($campus_gmtfinal);
		$data['Mayoelecxcampustot5yrs'] = $this->modelo_factor_gei->Mayoelecxcampustot5yrs($campus_gmtfinal);
		$data['Junioelecxcampustot5yrs'] = $this->modelo_factor_gei->Junioelecxcampustot5yrs($campus_gmtfinal);
		$data['Julioelecxcampustot5yrs'] = $this->modelo_factor_gei->Julioelecxcampustot5yrs($campus_gmtfinal);
		$data['Agostoelecxcampustot5yrs'] = $this->modelo_factor_gei->Agostoelecxcampustot5yrs($campus_gmtfinal);
		$data['Septiembreelecxcampustot5yrs'] = $this->modelo_factor_gei->Septiembreelecxcampustot5yrs($campus_gmtfinal);
		$data['Octubreelecxcampustot5yrs'] = $this->modelo_factor_gei->Octubreelecxcampustot5yrs($campus_gmtfinal);
		$data['Noviembreelecxcampustot5yrs'] = $this->modelo_factor_gei->Noviembreelecxcampustot5yrs($campus_gmtfinal);
		$data['Diciembreelecxcampustot5yrs'] = $this->modelo_factor_gei->Diciembreelecxcampustot5yrs($campus_gmtfinal);
	}	
	else{
			if(!!empty($campus_gmtfinal))
	{
		$data['Eneroelecxcampustot5yrs'] = $this->modelo_factor_gei->Eneroelecxcampustot5yrs($campus_gmtfinal);
		$data['Febreroelecxcampustot5yrs'] = $this->modelo_factor_gei->Febreroelecxcampustot5yrs($campus_gmtfinal);
		$data['Marzoelecxcampustot5yrs'] = $this->modelo_factor_gei->Marzoelecxcampustot5yrs($campus_gmtfinal);
		$data['Abrilelecxcampustot5yrs'] = $this->modelo_factor_gei->Abrilelecxcampustot5yrs($campus_gmtfinal);
		$data['Mayoelecxcampustot5yrs'] = $this->modelo_factor_gei->Mayoelecxcampustot5yrs($campus_gmtfinal);
		$data['Junioelecxcampustot5yrs'] = $this->modelo_factor_gei->Junioelecxcampustot5yrs($campus_gmtfinal);
		$data['Julioelecxcampustot5yrs'] = $this->modelo_factor_gei->Julioelecxcampustot5yrs($campus_gmtfinal);
		$data['Agostoelecxcampustot5yrs'] = $this->modelo_factor_gei->Agostoelecxcampustot5yrs($campus_gmtfinal);
		$data['Septiembreelecxcampustot5yrs'] = $this->modelo_factor_gei->Septiembreelecxcampustot5yrs($campus_gmtfinal);
		$data['Octubreelecxcampustot5yrs'] = $this->modelo_factor_gei->Octubreelecxcampustot5yrs($campus_gmtfinal);
		$data['Noviembreelecxcampustot5yrs'] = $this->modelo_factor_gei->Noviembreelecxcampustot5yrs($campus_gmtfinal);
		$data['Diciembreelecxcampustot5yrs'] = $this->modelo_factor_gei->Diciembreelecxcampustot5yrs($campus_gmtfinal);
	}	
	}
	}
		$data['title']= '<i class="icon-bolt"></i> Energía Eléctrica';
		$data['subtitle'] = 'Consumo de Electricidad x Campus ' .date('Y', strtotime('-5 year')).  ' -  ' .date('Y', strtotime('-1 year')).  ' GM';
		$data['body'] = 'GreenMetricAjusteElec5yrs';
		$this->load->view('main', $data);
}

/********************************************************CIERRE*******************************************************/
//Genera el formulario para la consulta de Consumo m3 Agua (GM) por mes INTERVALO 5 AÑOS//


function consumoaguaxcampusGM5yrs()
{
	$submit = $this->input->post('enviar');
	$campus_gmtfinal = $this->input->post('campus_gmtfinal');

	if($submit=='volver')
	{
		redirect("inicio");
	}
	if($submit=='reloadcexcgm5yrs')
	{
		$this->modelo_factor_gei->conaguaxcampus5yrs();
		$this->modelo_factor_gei->dropraguaxcampus5yrs();
		$this->modelo_factor_gei->conaguaxcampus5yrs();
		redirect("control_factor_gei/consumoaguaxcampusGM5yrs");
	}
	else
	{
		// Carga combobox campus

		$data['catecexcgm5yrs']	= $this->modelo_factor_gei->aguaxcampusfinal5yrs();

		// Genera las consultas por campus
		$data['resecexcgm5yrs'] = $this->modelo_factor_gei->aguaxcampusresultado5yrs();
		
		$data['campus_gmtfinal5yrs'] = $campus_gmtfinal;


	if(!empty($campus_gmtfinal))
	{
		$data['Eneroaguaxcampustot5yrs'] = $this->modelo_factor_gei->Eneroaguaxcampustot5yrs($campus_gmtfinal);
		$data['Febreroaguaxcampustot5yrs'] = $this->modelo_factor_gei->Febreroaguaxcampustot5yrs($campus_gmtfinal);
		$data['Marzoaguaxcampustot5yrs'] = $this->modelo_factor_gei->Marzoaguaxcampustot5yrs($campus_gmtfinal);
		$data['Abrilaguaxcampustot5yrs'] = $this->modelo_factor_gei->Abrilaguaxcampustot5yrs($campus_gmtfinal);
		$data['Mayoaguaxcampustot5yrs'] = $this->modelo_factor_gei->Mayoaguaxcampustot5yrs($campus_gmtfinal);
		$data['Junioaguaxcampustot5yrs'] = $this->modelo_factor_gei->Junioaguaxcampustot5yrs($campus_gmtfinal);
		$data['Julioaguaxcampustot5yrs'] = $this->modelo_factor_gei->Julioaguaxcampustot5yrs($campus_gmtfinal);
		$data['Agostoaguaxcampustot5yrs'] = $this->modelo_factor_gei->Agostoaguaxcampustot5yrs($campus_gmtfinal);
		$data['Septiembreaguaxcampustot5yrs'] = $this->modelo_factor_gei->Septiembreaguaxcampustot5yrs($campus_gmtfinal);
		$data['Octubreaguaxcampustot5yrs'] = $this->modelo_factor_gei->Octubreaguaxcampustot5yrs($campus_gmtfinal);
		$data['Noviembreaguaxcampustot5yrs'] = $this->modelo_factor_gei->Noviembreaguaxcampustot5yrs($campus_gmtfinal);
		$data['Diciembreaguaxcampustot5yrs'] = $this->modelo_factor_gei->Diciembreaguaxcampustot5yrs($campus_gmtfinal);
	}	
	else{
			if(!!empty($campus_gmtfinal))
	{
		$data['Eneroaguaxcampustot5yrs'] = $this->modelo_factor_gei->Eneroaguaxcampustot5yrs($campus_gmtfinal);
		$data['Febreroaguaxcampustot5yrs'] = $this->modelo_factor_gei->Febreroaguaxcampustot5yrs($campus_gmtfinal);
		$data['Marzoaguaxcampustot5yrs'] = $this->modelo_factor_gei->Marzoaguaxcampustot5yrs($campus_gmtfinal);
		$data['Abrilaguaxcampustot5yrs'] = $this->modelo_factor_gei->Abrilaguaxcampustot5yrs($campus_gmtfinal);
		$data['Mayoaguaxcampustot5yrs'] = $this->modelo_factor_gei->Mayoaguaxcampustot5yrs($campus_gmtfinal);
		$data['Junioaguaxcampustot5yrs'] = $this->modelo_factor_gei->Junioaguaxcampustot5yrs($campus_gmtfinal);
		$data['Julioaguaxcampustot5yrs'] = $this->modelo_factor_gei->Julioaguaxcampustot5yrs($campus_gmtfinal);
		$data['Agostoaguaxcampustot5yrs'] = $this->modelo_factor_gei->Agostoaguaxcampustot5yrs($campus_gmtfinal);
		$data['Septiembreaguaxcampustot5yrs'] = $this->modelo_factor_gei->Septiembreaguaxcampustot5yrs($campus_gmtfinal);
		$data['Octubreaguaxcampustot5yrs'] = $this->modelo_factor_gei->Octubreelecxcampustot5yrs($campus_gmtfinal);
		$data['Noviembreaguaxcampustot5yrs'] = $this->modelo_factor_gei->Noviembreaguaxcampustot5yrs($campus_gmtfinal);
		$data['Diciembreaguaxcampustot5yrs'] = $this->modelo_factor_gei->Diciembreaguaxcampustot5yrs($campus_gmtfinal);
	}	
	}
	}
		$data['title']= '<i class="icon-tint"></i> Agua';
		$data['subtitle'] = 'Consumo de Agua x Campus ' .date('Y', strtotime('-5 year')).  ' -  ' .date('Y', strtotime('-1 year')).  ' GM';
		$data['body'] = 'GreenMetricAjusteAgua5yrs';
		$this->load->view('main', $data);
}

/********************************************************CIERRE*******************************************************/
//Genera el formulario para la consulta de Consumo m3 Gas (GM) por mes INTERVALO 5 AÑOS)//


function consumogaasxcampusGM5yrs()
{
	$submit = $this->input->post('enviar');
	$campus_gmtfinal = $this->input->post('campus_gmtfinal');

	if($submit=='volver')
	{
		redirect("inicio");
	}
	if($submit=='reloadcexcgm5yrs')
	{
		$this->modelo_factor_gei->congaasxcampus5yrs();
		$this->modelo_factor_gei->droprgaasxcampus5yrs();
		$this->modelo_factor_gei->congaasxcampus5yrs();
		redirect("control_factor_gei/consumogaasxcampusGM5yrs");
	}
	else
	{
		// Carga combobox campus

		$data['catecexcgm5yrs']	= $this->modelo_factor_gei->gaasxcampusfinal5yrs();

		// Genera las consultas por campus
		$data['resecexcgm5yrs'] = $this->modelo_factor_gei->gaasxcampusresultado5yrs();
		
		$data['campus_gmtfinal'] = $campus_gmtfinal;


	if(!empty($campus_gmtfinal))
	{
		$data['Enerogaasxcampustot5yrs'] = $this->modelo_factor_gei->Enerogaasxcampustot5yrs($campus_gmtfinal);
		$data['Febrerogaasxcampustot5yrs'] = $this->modelo_factor_gei->Febrerogaasxcampustot5yrs($campus_gmtfinal);
		$data['Marzogaasxcampustot5yrs'] = $this->modelo_factor_gei->Marzogaasxcampustot5yrs($campus_gmtfinal);
		$data['Abrilgaasxcampustot5yrs'] = $this->modelo_factor_gei->Abrilgaasxcampustot5yrs($campus_gmtfinal);
		$data['Mayogaasxcampustot5yrs'] = $this->modelo_factor_gei->Mayogaasxcampustot5yrs($campus_gmtfinal);
		$data['Juniogaasxcampustot5yrs'] = $this->modelo_factor_gei->Juniogaasxcampustot5yrs($campus_gmtfinal);
		$data['Juliogaasxcampustot5yrs'] = $this->modelo_factor_gei->Juliogaasxcampustot5yrs($campus_gmtfinal);
		$data['Agostogaasxcampustot5yrs'] = $this->modelo_factor_gei->Agostogaasxcampustot5yrs($campus_gmtfinal);
		$data['Septiembregaasxcampustot5yrs'] = $this->modelo_factor_gei->Septiembregaasxcampustot5yrs($campus_gmtfinal);
		$data['Octubregaasxcampustot5yrs'] = $this->modelo_factor_gei->Octubregaasxcampustot5yrs($campus_gmtfinal);
		$data['Noviembregaasxcampustot5yrs'] = $this->modelo_factor_gei->Noviembregaasxcampustot5yrs($campus_gmtfinal);
		$data['Diciembregaasxcampustot5yrs'] = $this->modelo_factor_gei->Diciembregaasxcampustot5yrs($campus_gmtfinal);
	}	
	else{
			if(!!empty($campus_gmtfinal))
	{
		$data['Enerogaasxcampustot5yrs'] = $this->modelo_factor_gei->Enerogaasxcampustot5yrs($campus_gmtfinal);
		$data['Febrerogaasxcampustot5yrs'] = $this->modelo_factor_gei->Febrerogaasxcampustot5yrs($campus_gmtfinal);
		$data['Marzogaasxcampustot5yrs'] = $this->modelo_factor_gei->Marzogaasxcampustot5yrs($campus_gmtfinal);
		$data['Abrilgaasxcampustot5yrs'] = $this->modelo_factor_gei->Abrilgaasxcampustot5yrs($campus_gmtfinal);
		$data['Mayogaasxcampustot5yrs'] = $this->modelo_factor_gei->Mayogaasxcampustot5yrs($campus_gmtfinal);
		$data['Juniogaasxcampustot5yrs'] = $this->modelo_factor_gei->Juniogaasxcampustot5yrs($campus_gmtfinal);
		$data['Juliogaasxcampustot5yrs'] = $this->modelo_factor_gei->Juliogaasxcampustot5yrs($campus_gmtfinal);
		$data['Agostogaasxcampustot5yrs'] = $this->modelo_factor_gei->Agostogaasxcampustot5yrs($campus_gmtfinal);
		$data['Septiembregaasxcampustot5yrs'] = $this->modelo_factor_gei->Septiembregaasxcampustot5yrs($campus_gmtfinal);
		$data['Octubregaasxcampustot5yrs'] = $this->modelo_factor_gei->Octubregaasxcampustot5yrs($campus_gmtfinal);
		$data['Noviembregaasxcampustot5yrs'] = $this->modelo_factor_gei->Noviembregaasxcampustot5yrs($campus_gmtfinal);
		$data['Diciembregaasxcampustot5yrs'] = $this->modelo_factor_gei->Diciembregaasxcampustot5yrs($campus_gmtfinal);
	}	
	}
	}
		$data['title']= '<i class="icon-fire"></i> Gas Natural';
		$data['subtitle'] = 'Consumo de Gas x Campus ' .date('Y', strtotime('-5 year')).  ' -  ' .date('Y', strtotime('-1 year')).  ' GM';
		$data['body'] = 'GreenMetricAjusteGas5yrs';
		$this->load->view('main', $data);
}

/********************************************************CIERRE*******************************************************/
}//CIERRE DEL CONTROLLER