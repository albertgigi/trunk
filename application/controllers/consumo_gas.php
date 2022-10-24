<?php
Class Consumo_gas Extends CI_Controller
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

/*DATO IMPORTANTE LOS TOTALES SE LES COLOCO COMAS Y SE PUSIERON EN LAS VISTAS DE:
catalogo_gas_recibos
busqueda_gas_recibos
recibo_gas_ver
entre otros*/

/* Portada principal del módulo de servicio; ésta página puede incluir información diversa */
function index()
{
	$data['servicios']	= $this->modelo_consumo_gas->servicios_catalogo();
	$data['title'] = '<i class="icon-fire"></i> Gas';
	$data['body'] = 'inicio_gas';
	$this->load->view('main', $data);
}

/* Muestra un catálogo de los recibos capturados */
function catalogo()
{
	/* Configuración de la paginación */
	$por_pagina = 5;
	$recibos_total	= $this->modelo_consumo_gas->catalogo();
	$config['base_url'] = site_url("consumo_gas/catalogo");
	$config['total_rows'] = count($recibos_total);
	$config['per_page'] = $por_pagina;
	$config['num_links']	= 3;
	/* Números: */
	$config['num_tag_open'] = '<li>';
	$config['num_tag_close'] = '</li>';
	/* Liga actual: */
	$config['cur_tag_open'] = '<li class="active"><a href="#">';
	$config['cur_tag_close'] = '</a></li>';
	/* Primera y útlima: */
	$config['first_link'] = "Primera";
	$config['last_link'] = "Última";
	$config['first_tag_open'] =
	$config['last_tag_open'] = '<li>';
	$config['first_tag_close']=
	$config['last_tag_close'] = '</li>';
	/* Siguiente y anterior: */
	$config['next_link'] =
	$config['prev_link'] = false;
	$this->pagination->initialize($config);

	$data['sumaM3Gas'] = $this->modelo_consumo_gas->sumaM3Gas();
	$data['sumaCostoGas'] = $this->modelo_consumo_gas->sumaCostoGas();
	$data['servicios']	= $this->modelo_consumo_gas->servicios_catalogo();
	$data['recibos'] = $this->modelo_consumo_gas->catalogo($por_pagina, $this->uri->segment(3));
	$data['title'] = '<i class="icon-fire"></i> Gas';
	$data['subtitle'] = 'Catálogo de recibos';
	$data['body'] = 'catalogo_gas_recibos';
	$this->load->view('main', $data);
}

/* Muestra información de un recibo en particular */
function recibo($id=false) {
	/* Es posible acceder a este controlador por medio de AJAX o mediante una página */
	if($id) {
		$data['recibo']		= $this->modelo_consumo_gas->recibo($id);
		$data['usuario']	= $this->modelo_usuarios->usuario($data['recibo']->usuario);
		$data['servicios']	= $this->modelo_consumo_gas->servicios_catalogo();
		$data['title'] = '<i class="icon-fire"></i> Gas';
		$data['subtitle'] = 'Información del recibo';

		if(isset($_GET['ajax'])) {
			$this->load->view('recibo_gas_ver', $data);
		}
		else {
			$data['body'] = 'recibo_gas_ver';
			$this->load->view('main', $data);
		}

	}
	else {
		redirect("error");
	}
}

/* Muestra el formulario de captura de un nuevo recibo */
function capturar() {
	/* Listado de números de servicios */
	$data['servicios']	= $this->modelo_consumo_gas->servicios_catalogo();
	$data['title'] = '<i class="icon-fire"></i> Gas';
	$data['subtitle'] = 'Captura de recibo';
	$data['body'] = 'recibo_gas_crear';
	$this->load->view('main', $data);
}
/* Realiza la creación de un nuevo recibo */
function crear() {
	$this->modelo_consumo_gas->crear();
	$submit = $this->input->post('enviar');
	if($submit=='repetir') {
		redirect("consumo_gas/capturar/");
	}
	else {
		redirect("consumo_gas/catalogo/");
	}
}

/* Muestra el formulario de actualización de un recibo existente */
function actualizar($id=false) {
	if($id) {
		$data['recibo']		= $this->modelo_consumo_gas->recibo($id);
		$data['servicios']	= $this->modelo_consumo_gas->servicios_catalogo();
		$data['title'] = '<i class="icon-fire"></i> Gas';
		$data['subtitle'] = 'Actualizar recibo';
		$data['body'] = 'recibo_gas_editar';
		$this->load->view('main', $data);
	}
	else {
		redirect("error");
	}
}
/* Realiza la edición de un recibo existente */
function editar($id=false) {
	if($id) {
		$this->modelo_consumo_gas->editar($id);
		redirect("consumo_gas/recibo/$id");
	}
	else {
		redirect("error");
	}
}

/* Realiza la eliminación de un recibo */
function borrar($id=false) {
	if($id) {
		$this->modelo_consumo_gas->borrar($id);
	}
	else {
		redirect("error");
	}
}

function buscar(){
	$submit = $this->input->post('enviar');
	$dependencia = $this->input->post('dependencia');
	$num_servicio = $this->input->post('servicio');
	$year = $this->input->post('year');
	if($submit=='volver') {
		redirect("consumo_gas/catalogo/");
	}
	else {
		$data['recibos']	= $this->modelo_consumo_gas->resultado();
		$data['servicios']	= $this->modelo_consumo_gas->servicios_catalogo();
		$data['dependencia']= $dependencia;
		$data['num_servicio'] = $num_servicio;
		$data['year'] = $year;
		$array = explode(",", $num_servicio);
		if(count($array) > 1){
			$data['totalM3Gas'] = $this->modelo_consumo_gas->sumaM3GasPorVariosServicios($array,$year);
			$data['totalCostoGas'] = $this->modelo_consumo_gas->sumaCostoGasPorVariosServicios($array,$year);
			$data['recibos'] = $this->modelo_consumo_gas->resultadoVariosServicios($array,$year);
		}
		if(empty($dependencia) && empty($num_servicio)  && !empty($year)){
			$data['totalM3Gas'] = $this->modelo_consumo_gas->sumaM3GasPorYear($year);
			$data['totalCostoGas'] = $this->modelo_consumo_gas->sumaCostoGasPorYear($year);
		}
		else{
			$data['totalM3Gas'] = $this->modelo_consumo_gas->sumaM3GasPorServicioDependencia($dependencia,$num_servicio,$year);
			$data['totalCostoGas'] = $this->modelo_consumo_gas->sumaCostoGasPorServicioDependencia($dependencia,$num_servicio,$year);
		}
		$data['title'] = '<i class="icon-fire"></i> Gas';
		$data['subtitle'] = 'Busqueda de recibos';
		$data['body'] = 'busqueda_gas_recibos';
		$this->load->view('main', $data);
	}
}

/* SERVICIOS */
/* Los servicios se refieren a las cuentas o dependencias */
function servicio_catalogo() {
	/* Configuración de la paginación */
	$por_pagina = 50;
	$servicios_total		= $this->modelo_consumo_gas->servicios_catalogo();
	$config['base_url'] = site_url("consumo_gas/servicio_catalogo");
	$config['total_rows'] = count($servicios_total);
	$config['per_page'] = $por_pagina;
	$config['num_links']	= 3;
	/* Números: */
	$config['num_tag_open'] = '<li>';
	$config['num_tag_close'] = '</li>';
	/* Liga actual: */
	$config['cur_tag_open'] = '<li class="active"><a href="#">';
	$config['cur_tag_close'] = '</a></li>';
	/* Primera y útlima: */
	$config['first_link'] = "Primera";
	$config['last_link'] = "Última";
	$config['firsttag_open'] =
	$config['last_tag_open'] = '<li>';
	$config['first_tag_close']=
	$config['last_tag_close'] = '</li>';
	/* Siguiente y anterior: */
	$config['next_link'] =
	$config['prev_link'] = false;
	$this->pagination->initialize($config);

	$data['servicios']	= $this->modelo_consumo_gas->servicios_catalogo($por_pagina, $this->uri->segment(3));
	$data['title'] = '<i class="icon-fire"></i> Gas';
	$data['subtitle'] = 'Catálogo de servicios';
	$data['body'] = 'catalogo_gas_servicios';
	$this->load->view('main', $data);
}

/* Muestra el formulario de registro de un nuevo servicio */
function servicio_registrar() {
	$data['dependencias'] = $this->modelo_consumo_gas->dependencias_catalogo();
	$data['title'] = '<i class="icon-fire"></i> Gas';
	$data['subtitle'] = 'Registrar servicio';
	$data['body'] = 'formulario_gas_servicio';
	$this->load->view('main', $data);
}
/* Realiza la creación de un nuevo servicio */
function servicio_crear() {
	$this->modelo_consumo_gas->servicio_crear();
	$submit = $this->input->post('enviar');
	if($submit=='repetir') {
		redirect("consumo_gas/servicio_registrar/");
	}
	else {
		redirect("consumo_gas/servicio_catalogo/");
	}
}

/* Muestra el formulario de actualización de un servicio */
function servicio_actualizar($id=false) {
	if($id) {
		$data['servicio']	= $this->modelo_consumo_gas->servicio($id);
		$data['dependencias'] = $this->modelo_consumo_gas->dependencias_catalogo();
		$data['title'] = '<i class="icon-fire"></i> Gas';
		$data['subtitle'] = 'Editar servicio';
		$data['body'] = 'formulario_gas_servicio_editar';
		$this->load->view('main', $data);
	}
	else {
		redirect("error");
	}
}
/* Realiza la edición de un servicio existente */
function servicio_editar($id=false) {
	if($id) {
		$this->modelo_consumo_gas->servicio_editar($id);
		redirect("consumo_gas/servicio_catalogo/");
	}
	else {
		redirect("error");
	}
}

function servicio_borrar($id=false) {
	if($id) {
		$this->modelo_consumo_gas->servicio_borrar($id);
		redirect("consumo_gas/servicio_catalogo/");
	}
	else {
		redirect("error");
	}
}

function servicio_buscar(){

	$submit = $this->input->post('enviar');
	if($submit=='aceptar') {
		$data['servicios']	= $this->modelo_consumo_gas->servicios_catalogo();
		$data['busqueda']	= $this->modelo_consumo_gas->servicio_busqueda();
		$data['title'] = '<i class="icon-fire"></i> Gas';
		$data['subtitle'] = 'Busqueda de servicios';
		$data['body'] = 'busqueda_gas_servicios';
		$this->load->view('main', $data);
	}
	else {
		redirect("consumo_gas/servicio_catalogo/");
	}

}


/****************************************************************************************
Dependencias
****************************************************************************************/

function catalogo_dependencias(){
	$data['catalogoDependencias'] = $this->modelo_consumo_gas->dependencias_catalogo();
	$data['subtitle'] = 'Editar dependencias';
	$data['body'] = 'catalogo_dependencias';
	$this->load->view('main', $data);
}

function dependencia_actualizar($id=false) {
	if($id) {
		$data['dependencia'] = $this->modelo_consumo_gas->dependencia_editar($id);
		$data['title'] = 'Editar Dependencia';
		$data['body'] = 'formulario_dependencias_editar';
		$this->load->view('main', $data);
	}
	else {
		redirect("error");
	}
}

function dependencia_editar($id=false){

	if($id) {
		$this->modelo_consumo_gas->editaDependencia($id);
		redirect("consumo_gas/catalogo_dependencias/");
	}
	else {
		redirect("error");
	}

}


/****************************************************************************************
NUEVAS GRÁFICAS
****************************************************************************************/

function diagnostico($type=false) {
	if($this->input->post('submit')) {
		$data['chart'] = $this->modelo_consumo_gas->ultimos_meses(
			$type,
			$this->input->post('measure'),
			$this->input->post('service'),
			$this->input->post('year')
		);

	}
	else $data['chart'] = false;

	$data['measure']= $this->input->post('measure');
	$data['service']= $this->input->post('service');
	$data['year']= $this->input->post('year');
	$data['services'] = $this->modelo_consumo_gas->servicios_catalogo();
	$data['title'] = '<i class="icon-fire"></i> Gas';
	$data['subtitle'] = 'Diagnósticos';
	$data['body']	= 'grafica_gas';
	$this->load->view('main', $data);
}


/***********************************************************************************************
METRICAS POR AÑO GAS
***********************************************************************************************/
/* Configuración */


/*Muestra en una tabla el resultado de la busqueda de metrica relacionada al cosumo y costo total, por años de todas las dependencias, tabla pdc_consumo_gas */
function metricas_buscar_year_gas()
{
	$submit = $this->input->post('enviar');
	$year = $this->input->post('year');
	if($submit=='volver')
	{
		redirect("inicio");
	}
	else
	{
		$data['year'] = $year;
		$data['mostrardatos'] = $this->modelo_consumo_gas->sumaTotalTotalGas($year);
		$data['title'] = '<i class="icon-fire"></i> Gas';
		$data['subtitle'] = 'Total por Años';
		$data['body'] = 'busqueda_gas_metricas_year';
		$this->load->view('main', $data);

	}
}


} //Este es el cierre de todo el CI CONTROLLER