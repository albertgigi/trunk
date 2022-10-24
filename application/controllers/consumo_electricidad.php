<?php
Class Consumo_electricidad Extends CI_Controller
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
catalogo_electricidad_recibos
busqueda_electricidad_recibos
recibo_electricidad_ver*/

/* Portada principal del módulo de servicio; ésta página puede incluir información diversa */
function index()
{
	$this->load->view('main');
}

/* Muestra un catálogo de los recibos capturados */
function catalogo()
{
	/* Configuración de la paginación */
	$por_pagina = 5;
	$recibos_total	= $this->modelo_consumo_energia->catalogo();
	$config['base_url'] = site_url("consumo_electricidad/catalogo");
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

	$data['servicios']	= $this->modelo_consumo_energia->servicios_catalogo();
	$data['catalogo']		= $this->modelo_consumo_energia->catalogo_buscador();
	$data['recibos'] = $this->modelo_consumo_energia->catalogo($por_pagina, $this->uri->segment(3));
	$data['title'] = '<i class="icon-bolt"></i> Energía Eléctrica';
	$data['subtitle'] = 'Catálogo de recibos';
	$data['body'] = 'catalogo_electricidad_recibos';
	$data['sumaKhEnergia'] = $this->modelo_consumo_energia->sumaKhEnergia();
	$data['sumaCosto'] = $this->modelo_consumo_energia->sumaCostoEnergia();
	$this->load->view('main', $data);
}

/* Muestra información de un recibo en particular */
function recibo($id=false)
{
	/* Es posible acceder a este controlador por medio de AJAX o mediante una página */
	if($id)
	{
		$data['recibo']		= $this->modelo_consumo_energia->recibo($id);
		$data['usuario']	= $this->modelo_usuarios->usuario($data['recibo']->usuario);
		$data['servicios']	= $this->modelo_consumo_energia->servicios_catalogo();
		$data['title'] = '<i class="icon-bolt"></i> Energía Eléctrica';
		$data['subtitle'] = 'Información del recibo';

		if(isset($_GET['ajax']))
		{
			$this->load->view('recibo_electricidad_ver', $data);
		}
		else
		{
			$data['body'] = 'recibo_electricidad_ver';
			$this->load->view('main', $data);
		}

	}
	else
	{
		redirect("error");
	}
}

/* Muestra el formulario de captura de un nuevo recibo */
function capturar()
{
	/* Listado de números de servicios */
	$data['servicios']	= $this->modelo_consumo_energia->servicios_catalogo();
	$data['title'] = '<i class="icon-bolt"></i> Energía Eléctrica';
	$data['subtitle'] = 'Captura de recibo';
	$data['body'] = 'recibo_electricidad_crear';
	$this->load->view('main', $data);
}
/* Realiza la creación de un nuevo recibo */
function crear()
{
	$this->modelo_consumo_energia->crear();
	$submit = $this->input->post('enviar');
	if($submit=='repetir')
	{
		redirect("consumo_electricidad/capturar/");
	}
	else
	{
		redirect("consumo_electricidad/catalogo/");
	}
}

/* Muestra el formulario de actualización de un recibo existente */
function actualizar($id=false)
{
	if($id)
	{
		$data['recibo']		= $this->modelo_consumo_energia->recibo($id);
		$data['servicios']	= $this->modelo_consumo_energia->servicios_catalogo();
		$data['title'] = '<i class="icon-bolt"></i> Energía Eléctrica';
		$data['subtitle'] = 'Actualizar recibo';
		$data['body'] = 'recibo_electricidad_editar';
		$this->load->view('main', $data);
	}
	else
	{
		redirect("error");
	}
}
/* Realiza la edición de un recibo existente */
function editar($id=false)
{
	if($id)
	{
		$this->modelo_consumo_energia->editar($id);
		redirect("consumo_electricidad/recibo/$id");
	}
	else
	{
		redirect("error");
	}
}

/* Realiza la eliminación de un recibo */
function borrar($id=false)
{
	if($id)
	{
		$this->modelo_consumo_energia->borrar($id);
	}
	else
	{
		redirect("error");
	}
}
//Posiblemente aqui se inserte la nueva funcion controller que llamara el modelo a poner en la vista del catalogo de recibos
function buscar()
{
	$submit = $this->input->post('enviar');
	$dependencia = $this->input->post('dependencia');
	$num_servicio = $this->input->post('servicio');
	$year = $this->input->post('year');
	if($submit=='volver')
	{
		redirect("consumo_electricidad/catalogo/");
	}
	else
	{
		$data['catalogo']	= $this->modelo_consumo_energia->catalogo_buscador();// carga combobox dependencias usa pdc_servicios_energia
		$data['recibos']	= $this->modelo_consumo_energia->resultado();//usa pdc_consumo_energia, realiza consultas por dependencia(quien sabe como lo haga), numero de servicio?, año, tambien usa otro modelo de servicio_busqueda
		$data['servicios']	= $this->modelo_consumo_energia->servicios_catalogo();//usa pdc_servicios_energia, realiza consultas por numero de servicio, dependencia, y campus
		$data['dependencia']= $dependencia;
		$data['num_servicio'] = $num_servicio;
		$data['year'] = $year;
		$array = explode(",", $num_servicio);
	if(count($array) > 1)
	{
			$data['total_kwh'] = $this->modelo_consumo_energia->sumaKhEnergiaPorVariosServicios($array,$year);
			$data['total_costo'] = $this->modelo_consumo_energia->sumaCostoEnergiaPorVariosServicios($array,$year);
			$data['recibos'] = $this->modelo_consumo_energia->resultadoVariosServicios($array,$year);
	}
	else
	{
	if(!empty($year))
	{
				//$data['info'] = $this->modelo_consumo_energia->total_actualiza($data['servicios'], $data['recibos']);
	}
	if(empty($dependencia) && empty($num_servicio)  && !empty($year))
	{
				$data['total_kwh'] = $this->modelo_consumo_energia->sumaKhEnergiaPorYear($year);
				$data['total_costo'] = $this->modelo_consumo_energia->sumaCostoEnergiaPorYear($year);
	}
	else
	{
				$data['total_kwh'] = $this->modelo_consumo_energia->sumaKhEnergiaPorServicioDependencia($dependencia,$num_servicio,$year);
				$data['total_costo'] = $this->modelo_consumo_energia->sumaCostoEnergiaPorServicioDependencia($dependencia,$num_servicio,$year);
	}
	}
		$data['title']= '<i class="icon-bolt"></i> Energía Eléctrica';
		$data['subtitle'] = 'Busqueda de recibos';
		$data['body'] = 'busqueda_electricidad_recibos';
		$this->load->view('main', $data);
	}
}

/* SERVICIOS */
/* Los servicios se refieren a las cuentas de las dependencias */
function servicio_catalogo()
{
	/* Configuración de la paginación */
	$por_pagina = 50;
	$servicios_total		= $this->modelo_consumo_energia->servicios_catalogo();
	$config['base_url'] = site_url("consumo_electricidad/servicio_catalogo");
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

	$data['servicios']	= $this->modelo_consumo_energia->servicios_catalogo($por_pagina, $this->uri->segment(3));
	$data['catalogo']		= $this->modelo_consumo_energia->catalogo_buscador();
	$data['title'] = '<i class="icon-bolt"></i> Energía Eléctrica';
	$data['subtitle'] = 'Catálogo de servicios';
	$data['body'] = 'catalogo_electricidad_servicios';
	$this->load->view('main', $data);
}

/* Muestra el formulario de registro de un nuevo servicio */
function servicio_registrar()
{
	$data['dependencias'] = $this->modelo_consumo_energia->dependencias_catalogo();
	$data['title'] = '<i class="icon-bolt"></i> Energía Eléctrica';
	$data['subtitle'] = 'Registrar servicio';
	$data['body'] = 'formulario_electricidad_servicio';
	$this->load->view('main', $data);
}
/* Realiza la creación de un nuevo servicio */
function servicio_crear()
{
	$this->modelo_consumo_energia->servicio_crear();
	$submit = $this->input->post('enviar');
	if($submit=='repetir')
	{
		redirect("consumo_electricidad/servicio_registrar/");
	}
	else
	{
		redirect("consumo_electricidad/servicio_catalogo/");
	}
}

/* Muestra el formulario de actualización de un servicio */
function servicio_actualizar($id=false)
{
	if($id)
	{
		$data['servicio']	= $this->modelo_consumo_energia->servicio($id);
		$data['dependencias'] = $this->modelo_consumo_energia->dependencias_catalogo();
		$data['title'] = '<i class="icon-bolt"></i> Energía Eléctrica';
		$data['subtitle'] = 'Editar servicio';
		$data['body'] = 'formulario_electricidad_servicio_editar';
		$this->load->view('main', $data);
	}
	else
	{
		redirect("error");
	}
}
/* Realiza la edición de un servicio existente */
function servicio_editar($id=false)
{
	if($id)
	{
		$this->modelo_consumo_energia->servicio_editar($id);
		redirect("consumo_electricidad/servicio_catalogo/");
	}
	else
	{
		redirect("error");
	}
}

function servicio_borrar($id=false)
{
	if($id)
	{
		$this->modelo_consumo_energia->servicio_borrar($id);
		redirect("consumo_electricidad/servicio_catalogo/");
	}
	else
	{
		redirect("error");
	}
}

function servicio_buscar()
{

	$submit = $this->input->post('enviar');
	if($submit=='aceptar')
	{
		$data['catalogo']		= $this->modelo_consumo_energia->catalogo_buscador();
		$data['servicios']	= $this->modelo_consumo_energia->servicios_catalogo();
		$data['busqueda']	= $this->modelo_consumo_energia->servicio_busqueda();
		$data['title'] = '<i class="icon-bolt"></i> Energía Eléctrica';
		$data['subtitle'] = 'Busqueda de servicios';
		$data['body'] = 'busqueda_electricidad_servicios';
		$this->load->view('main', $data);
	}
	else
	{
		redirect("consumo_electricidad/servicio_catalogo/");
	}

}

/****************************************************************************************
DEPENDENCIAS
****************************************************************************************/

function dependencia_nuevo()
{
	$submit = $this->input->post('enviar');
	$cuenta = $this->input->post('cuenta');

	if(!empty($submit) && !empty($cuenta))
	{
		$repetido = $this->modelo_consumo_energia->dependencias_verificar($cuenta);
		if(empty($repetido))
		{
			$this->modelo_consumo_energia->dependencias_crear();
			redirect("consumo_electricidad/servicio_registrar/");
		}
		else
		{
			$data['repetido'] = true;
		}
	}
	$data['title'] = '<i class="icon-bolt"></i> Energía Eléctrica';
	$data['subtitle'] = 'Agregar dependencia';
	$data['body'] = 'formulario_electricidad_dependencia_nuevo';
	$this->load->view('main', $data);
}

function catalogo_dependencias()
{
	$data['catalogoDependencias'] = $this->modelo_consumo_energia->dependencias_catalogo();
	$data['subtitle'] = 'Editar dependencias';
	$data['body'] = 'catalogo_dependencias';
	$this->load->view('main', $data);
}


function dependencia_actualizar($id=false)
{
	if($id)
	{
		$data['dependencia'] = $this->modelo_consumo_energia->dependencia_editar($id);
		$data['title'] = 'Editar Dependencia';
		$data['body'] = 'formulario_dependencias_editar';
		$this->load->view('main', $data);
	}
	else
	{
		redirect("error");
	}
}

function dependencia_editar($id=false)
{

	if($id)
	{
		$this->modelo_consumo_energia->editaDependencia($id);
		redirect("consumo_electricidad/catalogo_dependencias/");
	}
	else
	{
		redirect("error");
	}

}
/****************************************************************************************
NUEVAS GRÁFICAS
****************************************************************************************/

function diagnostico($type=false)
{
	if($this->input->post('submit'))
	{
		$data['chart'] = $this->modelo_consumo_energia->ultimos_meses(
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
	$data['services'] = $this->modelo_consumo_energia->servicios_catalogo();
	$data['title'] = '<i class="icon-bolt"></i> Energía Eléctrica';
	$data['subtitle'] = 'Diagnósticos';
	$data['body']	= 'grafica_electricidad';
	$this->load->view('main', $data);
}

/****************************************************************************************
MÉTRICAS
****************************************************************************************/

/* Muestra en una pagina, un catálogo de los recibos capturados */
function metricas()
{
	/* Configuración de la paginación */
	$por_pagina = 20;
	$servicios_total		= $this->modelo_consumo_energia->metricas_catalogo();
	$config['base_url'] = site_url("consumo_electricidad/metricas");
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

	$data['servicios']	= $this->modelo_consumo_energia->metricas_catalogo($por_pagina, $this->uri->segment(3));
	$data['catalogo']		= $this->modelo_consumo_energia->catalogo_buscador();
	$data['title'] = '<i class="icon-bolt"></i> Energía Eléctrica';
	$data['subtitle'] = 'Catálogo métricas de servicios';
	$data['body'] = 'catalogo_electricidad_servicios_metricas';
	$this->load->view('main', $data);
}

function metricas_buscar()
{
	$submit = $this->input->post('enviar');
	$dependencia = $this->input->post('dependencia');
	$num_servicio = $this->input->post('servicio');
	$year = $this->input->post('year');
	if($submit=='volver')
	{
		redirect("consumo_electricidad/metricas/");
	}
	else
	{
		$data['catalogo']		= $this->modelo_consumo_energia->catalogo_buscador();
		$data['servicios']	= $this->modelo_consumo_energia->metricas_resultado();
		$data['dependencia']= $dependencia;
		$data['num_servicio'] = $num_servicio;
		$data['year'] = $year;
		$data['title'] = '<i class="icon-bolt"></i> Energía Eléctrica';
		$data['subtitle'] = 'Busqueda de Servicios';
		$data['body'] = 'busqueda_electricidad_metricas';
		$this->load->view('main', $data);

	}
}

function metrica_actualizar($id=false)
{
	if($id)
	{
		$data['servicio']	= $this->modelo_consumo_energia->metrica($id);
		$data['dependencias'] = $this->modelo_consumo_energia->catalogo_buscador();
		$data['title'] = '<i class="icon-bolt"></i> Energía Eléctrica';
		$data['subtitle'] = 'Editar servicio';
		$data['body'] = 'formulario_electricidad_metrica_editar';
		$this->load->view('main', $data);
	}
	else
	{
		redirect("error");
	}
}

function metrica_editar($id=false)
{
	if($id)
	{
		$this->modelo_consumo_energia->editar_registro($id);
		redirect("consumo_electricidad/metricas/");
	}
	else
	{
		redirect("error");
	}
}

function metrica_borrar($id=false)
{
	if($id)
	{
		$this->modelo_consumo_energia->metrica_borrar($id);
		redirect("consumo_electricidad/metricas/");
	}
	else
	{
		redirect("error");
	}
}


/***********************************************************************************************
METRICAS POR AÑO ELECTRICIDAD/ENERGIA
***********************************************************************************************/
/* Configuración */


/*Muestra en una tabla el resultado de la busqueda de metrica relacionada al cosumo y costo total, por años de todas las dependencias, tabla pdc_consumo_energia */
function metricas_buscar_year()
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
		$data['mostrardatos'] = $this->modelo_consumo_energia->sumaTotalTotal($year);
		$data['title'] = '<i class="icon-bolt"></i> Energía Eléctrica';
		$data['subtitle'] = 'Total por Años de kWh y Costo';
		$data['body'] = 'busqueda_electricidad_metricas_year';
		$this->load->view('main', $data);

	}
}

/****************************************************************************************************************************
														CAMPUS TESTS
****************************************************************************************************************************/
//Genera el formulario para la busqueda por Campus en Métricas//


function campus_buscar()
{
	$this->modelo_consumo_energia->campustransact1();
	$submit = $this->input->post('enviar');
	$campus2 = $this->input->post('campus2');

	$year = $this->input->post('year');
	if($submit=='volver')
	{
		redirect("inicio");
	}
	if($submit=='reloadcampus2')
	{
		$this->modelo_consumo_energia->drope_c1_2table();
		redirect("consumo_electricidad/campus_buscar");
	}
	else
	{
		// Carga combobox campus

		$data['catcampus']	= $this->modelo_consumo_energia->campus_buscador();

		// Genera las consultas por campus y/o años
		$data['resultcampus'] = $this->modelo_consumo_energia->campus_resultado();
		$data['campus2'] = $campus2;
		$data['year'] = $year;

	if(empty($campus2) && empty($year))
	{
		$data['campusconsumototal'] = $this->modelo_consumo_energia->sumaConsumoEnergiaEmptyAll($campus2, $year);
		$data['campuscostototal'] = $this->modelo_consumo_energia->sumaCostoEnergiaEmptyAll($campus2, $year);
	} else {
		if(empty($campus2) && !empty($year))
		{
			$data['campusconsumototal'] = $this->modelo_consumo_energia->sumaConsumoEnergiaEmptyCampus($campus2, $year);
			$data['campuscostototal'] = $this->modelo_consumo_energia->sumaCostoEnergiaEmptyCampus($campus2, $year);
		} else {
			if(!empty($campus2) && empty($year))
			{
				$data['campusconsumototal'] = $this->modelo_consumo_energia->sumaConsumoEnergiaEmptyYear($campus2, $year);
				$data['campuscostototal'] = $this->modelo_consumo_energia->sumaCostoEnergiaEmptyYear($campus2, $year);
			} else {
				if(!empty($campus2) && !empty($year))
				{
					$data['campusconsumototal'] = $this->modelo_consumo_energia->sumaConsumoEnergiaAll($campus2, $year);
					$data['campuscostototal'] = $this->modelo_consumo_energia->sumaCostoEnergiaAll($campus2, $year);
				}	
			}
		}	
	}
		$data['title']= '<i class="icon-bolt"></i> Energía Eléctrica';
		$data['subtitle'] = 'Busqueda por Campus';
		$data['body'] = 'busqueda_electricidad_campus_c';
		$this->load->view('main', $data);
}
}

/****************************************************************************************************************************************************************************************************************************************************************/


}//CIERRE