<?php
Class Modelo_consumo_agua Extends CI_Model
{

/* RECIBOS*/

/* Catálogo de recibos */
function catalogo($limite=false, $inicio=0)
{
	if($limite)
		$this->db->limit($limite, $inicio);

	$this->db->order_by("datetime", "desc");
	$query = $this->db->get('pdc_consumo_agua');

	if($query->num_rows()>0)
	{
		foreach($query->result() as $row)
		{
			$dependencias[$row->id] = $row;
		}
		return $dependencias;
	}
		else return false;
}


function sumaM3()
{
	$this->db->select_sum('consumo');
	$query = $this->db->get('pdc_consumo_agua');
	$result = $query->row()->consumo;
	return $result;
}

function sumaM3AguaPorServicioDependencia($dependencia,$num_servicio,$year)
{

	if(!empty($dependencia))
	{
		$dependenciaId = $dependencia;
	}
	else
		{

			if(!empty($num_servicio))
			{
				$this->db->where('cuenta',$num_servicio);
				$this->db->select('id');
				$query = $this->db->get('pdc_servicios_agua');
				$dependenciaId = $query->row()->id;
			}
		}

	if(!empty($year))
	{

		$this->db->like('periodo_fin',$year);
		$this->db->where('servicio',$dependenciaId);
		$this->db->select_sum('consumo');
		$query = $this->db->get('pdc_consumo_agua');
		$result = $query->row()->consumo;
		return $result;

	}
	else
		{
			//$this->db->where('servicio',$dependenciaId);	//COMENTARIZADO EL 25-ENERO-2019 SI PRESENTA PROBLEMAS ROLLBACK
			$this->db->select_sum('consumo');
			$query = $this->db->get('pdc_consumo_agua');
			$result = $query->row()->consumo;
			return $result;
		}
}

function sumaM3AguaPorVariosServicios($array,$year)
{

	$sql = "SELECT SUM(consumo) AS CONSUMO FROM pdc_consumo_agua";
	$dependenciasArray = array();//guardo los id de dependencias que corresponden al servicio

	for($i=0; $i < count($array); $i++)
	{
		$this->db->where('cuenta',$array[$i]);
		$this->db->select('id');
		$query = $this->db->get('pdc_servicios_agua');
		$dependenciaId = $query->row()->id;
		array_push($dependenciasArray,$dependenciaId);
	}

	$sql .= " WHERE (servicio =".$dependenciasArray[0];

    for ($j=1; $j < count($dependenciasArray) ; $j++)
    {
		$sql .= " OR servicio =".$dependenciasArray[$j];
    }
	if(!empty($year))
	{
		$sql .= ") and periodo_fin LIKE '%".$year."%'";
	}
	else
		{
			$sql .= ")";
		}

	$query = $this->db->query($sql);

	if($query->num_rows() > 0)
	{
		return $query->row()->CONSUMO;

	}
	else
	{
		return FALSE;

	}
}

function sumaCostoAgua()
{
	$this->db->select_sum('costo');
	$query = $this->db->get('pdc_consumo_agua');
	$result = $query->row()->costo;
	return $result;
}

function sumaCostoAguaPorServicioDependencia($dependencia,$num_servicio,$year)
{

	if(!empty($dependencia))
	{
		$dependenciaId = $dependencia;
	}
	else
	{
		if(!empty($num_servicio))
		{
			$this->db->where('cuenta',$num_servicio);
			$this->db->select('id');
			$query = $this->db->get('pdc_servicios_agua');
			$dependenciaId = $query->row()->id;
		}
	}

	if(!empty($year))
	{
		$this->db->like('periodo_fin',$year);
		$this->db->where('servicio',$dependenciaId);
		$this->db->select_sum('costo');
		$query = $this->db->get('pdc_consumo_agua');
		$result = $query->row()->costo;
		return $result;
	}
	else
		{
			//$this->db->where('servicio',$dependenciaId);	//COMENTARIZADO EL 25-ENERO-2019 SI PRESENTA PROBLEMAS ROLLBACK
			$this->db->select_sum('costo');
			$query = $this->db->get('pdc_consumo_agua');
			$result = $query->row()->costo;
			return $result;
		}
}

function sumaCostoAguaPorVariosServicios($array,$year)
{

		$sql = "SELECT SUM(costo) AS CONSUMO FROM pdc_consumo_agua";
		$dependenciasArrayCosto = array();//guardo los id de dependencias que corresponden al servicio

		for($i=0; $i < count($array); $i++)
		{

			$this->db->where('cuenta',$array[$i]);
			$this->db->select('id');
			$query = $this->db->get('pdc_servicios_agua');
			$dependenciaId = $query->row()->id;
			array_push($dependenciasArrayCosto,$dependenciaId);

		}

		$sql .= " WHERE (servicio =".$dependenciasArrayCosto[0];

        for ($j=1; $j < count($dependenciasArrayCosto) ; $j++)
        {
			$sql .= " OR servicio =".$dependenciasArrayCosto[$j];
        }
			if(!empty($year))
			{
				$sql .= ") and periodo_fin LIKE '%".$year."%'";
			}
			else
				{
					$sql .= ")";
				}
		$query = $this->db->query($sql);

		if($query->num_rows() > 0)
			{
				return $query->row()->CONSUMO;

			}
			else
				{

					return FALSE;
				}
}

function sumaM3AguaPorYear($year)
{
    $sql = "SELECT SUM(consumo) AS CONSUMO FROM pdc_consumo_agua";

	$sql .= " WHERE periodo_fin LIKE '%".$year."%'";

	$query = $this->db->query($sql);

	if($query->num_rows() > 0)
		{
			return $query->row()->CONSUMO;
		}
		else
			{

				return FALSE;
			}
}

function sumaCostoAguaPorYear($year)
{
    $sql = "SELECT SUM(costo) AS COSTO FROM pdc_consumo_agua";

	$sql .= " WHERE periodo_fin LIKE '%".$year."%'";

	$query = $this->db->query($sql);

	if($query->num_rows() > 0)
		{
			return $query->row()->COSTO;

		}
		else
			{

				return FALSE;
			}
}

/* Información de un recibo */
function recibo($id)
{
	$this->db->where('id', $id);
	$query = $this->db->get("pdc_consumo_agua");
	return $query->row();
}

/* Registrar un recibo */
function crear()
{

	$data['datetime'] = time();
	$data['usuario'] = $_SESSION['sess']['id'];
	$data['servicio'] = $this->input->post('servicio');
	$data['periodo_inicio'] = $this->input->post('periodo_inicio');
	$data['periodo_fin'] = $this->input->post('periodo_fin');
	$data['consumo'] = $this->input->post('consumo');
	$data['costo'] = $this->input->post('costo');
	$this->db->insert("pdc_consumo_agua", $data);
}

/* Edita un recibo */
function editar($id)
{

	$data['datetime'] = time();
	$data['servicio'] = $this->input->post('servicio');
	$data['periodo_inicio'] = $this->input->post('periodo_inicio');
	$data['periodo_fin'] = $this->input->post('periodo_fin');
	$data['consumo'] = $this->input->post('consumo');
	$data['costo'] = $this->input->post('costo');
	$this->db->where('id', $id);
	$this->db->update("pdc_consumo_agua", $data);
}

/* Borrar un recibo */
function borrar($id)
{
	$this->db->where('id', $id);
	$this->db->delete('pdc_consumo_agua');
}

/* Resultado de la busqueda */

function resultado($limite=false, $inicio=0)
{
	$dependencia = $this->input->post('dependencia');
	$num_servicio = $this->input->post('servicio');
	$year = $this->input->post('year');

	if(empty($dependencia) && empty($num_servicio)  && !empty($year))
	{
			$this->db->like('periodo_fin', $year);
			$this->db->order_by("periodo_inicio", "desc");
			$query = $this->db->get('pdc_consumo_agua');

			if($query->num_rows()>0)
			{
				foreach($query->result() as $row)
					{
						$dependencias[$row->id] = $row;
					}
				return $dependencias;
			}
				else return false;

	}

	else
	{
		$busqueda	= $this->modelo_consumo_agua->servicio_busqueda();
		if(!empty($busqueda))
		{
			if($limite)
				$this->db->limit($limite, $inicio);

				if(!empty($year))
					$this->db->like('periodo_fin', $year);
					$this->db->order_by("periodo_inicio", "desc");
					$this->db->where('servicio', $busqueda->id);
					$query = $this->db->get('pdc_consumo_agua');

					if($query->num_rows()>0)
					{
						foreach($query->result() as $row)
							{
								$dependencias[$row->id] = $row;
							}
						return $dependencias;
					}
					else return false;
		}
		else return false;
	}
}

function resultadoVariosServicios($array,$year)
{//esta accion entra cuando se ponen varios servicios en el textbox separados por una coma

		$dependenciasA = array();//guardo los id de dependencias que corresponden al servicio

		for($i=0; $i < count($array); $i++)
		{

			$this->db->where('cuenta',$array[$i]);
			$this->db->select('id');
			$query = $this->db->get('pdc_servicios_agua');
			$dependenciaId = $query->row()->id;
			array_push($dependenciasA,$dependenciaId);

		}

			$sql = "SELECT * FROM pdc_consumo_agua";
			$sql .= " WHERE (servicio =".$dependenciasA[0];

			for ($j=1; $j < count($dependenciasA) ; $j++)
			{
			$sql .= " OR servicio =".$dependenciasA[$j];
			}
			if(!empty($year))
				{
					$sql .= ") and periodo_fin LIKE '%".$year."%'";
				}
				else
					{
						$sql .= ")";
					}

			$query = $this->db->query($sql);


			if($query->num_rows()>0)
			{
				foreach($query->result() as $row)
					{
						$dependencias[$row->id] = $row;
					}
					return $dependencias;
			}
			else return false;
}	

/* SERVICIOS */

/* Catálogo de servicios */
function servicios_catalogo($limite=false, $inicio=0)
{
	$this->db->order_by('dependencia', 'asc');
	if($limite)
		$this->db->limit($limite, $inicio);
	$query = $this->db->get('pdc_servicios_agua');

		if($query->num_rows()>0)
		{
			foreach($query->result() as $row)
				{
					$servicios[$row->id] = $row;
				}
			return $servicios;
		}
		else return false;
}

function servicio($id)
{
	$this->db->where('id', $id);
	$query = $this->db->get('pdc_servicios_agua');
	return $query->row();
}
function servicio_crear()
{
	$data['cuenta'] = $this->input->post('cuenta');
	$data['dependencia'] = $this->input->post('dependencia');
	$this->db->insert("pdc_servicios_agua", $data);
}

function servicio_editar($id)
{
	$data['cuenta'] = $this->input->post('cuenta');
	$data['dependencia'] = $this->input->post('dependencia');
	$this->db->where('id', $id);
	$this->db->update("pdc_servicios_agua", $data);
}

function servicio_borrar($id)
{
	$this->db->where('id', $id);
	$this->db->delete('pdc_servicios_agua');
}

/* Busqueda de un servicio */
function servicio_busqueda()
{
	$servicio = $this->input->post('servicio');
	$dependencia = $this->input->post('dependencia');

	if(!empty($servicio) && !empty($dependencia))
	{
		$this->db->where('cuenta', $servicio);
		$this->db->where('id', $dependencia);
		$query = $this->db->get("pdc_servicios_agua");
		return $query->row();
	}

	if(!empty($servicio))
	{
		$this->db->where('cuenta', $servicio);
		$query = $this->db->get("pdc_servicios_agua");
		return $query->row();
	}
	if(!empty($dependencia))
	{
		$this->db->where('id', $dependencia);
		$query = $this->db->get("pdc_servicios_agua");
		return $query->row();
	}

}

/* DEPENDENCIAS */

function dependencias_catalogo()
{
	$this->db->order_by("nombre", "asc");
	$query = $this->db->get("pdc_dependencias");

	if($query->num_rows()>0)
	{
		foreach($query->result() as $row)
			{
				$dependencias[$row->id] = $row;
			}
			return $dependencias;
	}
	else return false;
}


function dependencia_editar($id)
{// trae la dependnecia a editar
	$this->db->where('id', $id);
	$query = $this->db->get('pdc_dependencias');
	return $query->row();
 }

 function editaDependencia($id)
 {// edita la dependencia
	$data['nombre'] = $this->input->post('dependencia');
	$this->db->where('id', $id);
	$this->db->update("pdc_dependencias", $data);
}

/****************************************************************************************
NUEVAS GRÁFICAS
****************************************************************************************/

/* Función para obtener un total elemental */
function total_mes($type, $unidad, $service, $year=false, $month=false)
{
	/* Primero obtiene el año y mes actual */
	$year = ($year)? $year : date('Y');
	$month = ($month)? $month : date('m');
	$d_date = $year. '-' . $month;


	$this->db->where('servicio', '60');
	$this->db->like('periodo_inicio', $d_date);
	$query = $this->db->get("pdc_consumo_agua");

	if($query->num_rows>0)
	{
		$data = $query->row_array();
		return $data;
	}
	else return 0;

}

function prueba_query($year, $service)
{
	$this->db->where('servicio', $service);
	$this->db->like('periodo_fin', $year);
	$this->db->order_by("periodo_fin", "asc");
	$query = $this->db->get("pdc_consumo_agua");

	if($query->num_rows>0)
	{
		foreach($query->result() as $row)
		{
			$data[] = $row;
		}
		return $data;
	}
	else return 0;
}

/* Genera una gráfica de totales de la última cantidad de meses */
function ultimos_meses($type, $unidad, $service, $year=false, $month=false, $meses=12 )
{

	/* Primero obtiene el año actual */
	$year = ($year)? $year : date('Y');
	$month = 12;
	$month = ($month)? $month : date('m');

	$totales = false;

	for($a=$meses-1; $a>=0; $a--)
	{
		$months[] = date('Y-m', mktime(0, 0, 0, $month-$a+1, 0, $year));
	}

	$prueba= $this->modelo_consumo_agua->prueba_query($year, $service);

	if(!empty($prueba))
	{
		foreach($prueba as $item)
		{
			$totales[] = $item->$unidad;
		}
	}

	$filename = "ultimos-meses_".$unidad."_".$service;

	if($totales)
	{
		/* Nombre del archivo */

		/* Creación de la gráfica */

		$data = new pData();
		$data->addPoints($totales, 'Totales');
		$data->setAxisName(0, 'Totales ('.$unidad.')');

		$data->addPoints($months, 'Meses');
		$data->setSerieDescription("Meses","Meses");
		$data->setAbscissa('Meses');

		$grafica = new pImage(1000, 600, $data);
		$grafica->setGraphArea(80, 60, 960, 540);
		/*SE ACTUALIZO LA RUTA PARA LA VERSION DEL NUEVO SERVIDOR 05-JULIO-2018*/
		$grafica->setFontProperties(array("FontName"=>"/media/web/htdocs/dependencias/panel/www/application/helpers/pchart/fonts/verdana.ttf","FontSize"=>9));

		$grafica->drawScale(array(
			"CycleBackground"=>TRUE,
			"DrawSubTicks"=>TRUE,
			"GridR"=>200,
			"GridG"=>200,
			"GridB"=>200

		));
		$grafica->drawBarChart(array(
			"DisplayValues"=>TRUE,
			"DisplayPos"=>LABEL_POS_OUTSIDE
		));

		$grafica->render('graficas/'.$filename.'.png');
	}
	else
	{
		$filename = false;
	}
	return $filename;
}

//Realiza la consulta en la tabla pdc_consumo_agua
//concat('$', format(sum(price), 2)
function sumaTotalTotalAgua($year)
{
	$sql=
	"SELECT CONCAT('', FORMAT(SUM(consumo), 0)) AS SumaConsumo,
	CONCAT('', FORMAT(SUM(costo),2)) AS SumaCosto,
	GROUP_CONCAT(DISTINCT(YEAR(periodo_fin))) AS SumaYear FROM pdc_consumo_agua
	WHERE (YEAR(periodo_fin) <'0-0-0' OR YEAR(periodo_fin)> '2010-12-31')
	AND (YEAR(periodo_fin) <= YEAR(NOW()) )
	AND consumo IS NOT NULL AND consumo <> ''
	AND costo IS NOT NULL AND costo <> ''
	AND periodo_inicio IS NOT NULL AND  periodo_inicio <> ''
	AND periodo_fin IS NOT NULL AND periodo_fin <> ''
	AND servicio IS NOT NULL AND servicio <> ''
	AND datetime IS NOT NULL AND datetime <> ''";

	$sql .= " GROUP BY YEAR(periodo_fin) ORDER BY YEAR(periodo_fin)";

	$query = $this->db->query($sql);

	if($query->num_rows() > 0)
		{
			return $query->result_array();

		}
		else
			{
				return FALSE;
			}
}


}//CIERRE TOTAL DEL CI MODELO