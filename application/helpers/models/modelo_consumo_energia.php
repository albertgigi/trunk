<?php
Class Modelo_consumo_energia Extends CI_Model {

/* RECIBOS*/

/* Catálogo de recibos */
function catalogo($limite=false, $inicio=0) {
	if($limite)
		$this->db->limit($limite, $inicio);

	$this->db->order_by("datetime", "desc");
	$query = $this->db->get('pdc_consumo_energia');

	if($query->num_rows()>0) {
		foreach($query->result() as $row) {
			$dependencias[$row->id] = $row;
		}
		return $dependencias;
	}
	else return false;
}

function sumaKhEnergia(){
	$this->db->select_sum('consumo');
	$query = $this->db->get('pdc_consumo_energia');
	$result = $query->row()->consumo;
	return $result;
}

function sumaKhEnergiaPorServicioDependencia($dependencia,$num_servicio,$year){

	if(!empty($dependencia)){
		$this->db->where('dependencia',$dependencia);
		$this->db->select('id');
		$query = $this->db->get('pdc_servicios_energia');
		$dependenciaId = $query->row()->id;	//COMENTARIZADO EL 25-ENERO-2019 SI PRESENTA PROBLEMAS ROLLBACK
	}else{

		if(!empty($num_servicio)){
			$this->db->where('cuenta',$num_servicio);
			$this->db->select('id');
			$query = $this->db->get('pdc_servicios_energia');
			$dependenciaId = $query->row()->id;
		}
	}

	if(!empty($year)){

		$this->db->like('periodo_fin',$year);
		$this->db->where('servicio',$dependenciaId);	//COMENTARIZADO EL 25-ENERO-2019 SI PRESENTA PROBLEMAS ROLLBACK
		$this->db->select_sum('consumo');
		$query = $this->db->get('pdc_consumo_energia');
		$result = $query->row()->consumo;
		return $result;

	}else{

	$this->db->where('servicio',$dependenciaId);	//COMENTARIZADO EL 25-ENERO-2019 SI PRESENTA PROBLEMAS ROLLBACK
	$this->db->select_sum('consumo');
	$query = $this->db->get('pdc_consumo_energia');
	$result = $query->row()->consumo;
		return  $result;
	}
}

function sumaKhEnergiaPorVariosServicios($array,$year){// $array guarda los numero de servicio

		$sql = "SELECT CONCAT('', FORMAT(SUM(consumo), 2)) AS CONSUMO FROM pdc_consumo_energia";
		$dependenciasArray = array();//guarda los id de dependencias que corresponden al servicio

		for($i=0; $i < count($array); $i++){

			$this->db->where('cuenta',$array[$i]);
			$this->db->select('id');
			$query = $this->db->get('pdc_servicios_energia');
			$dependenciaId = $query->row()->id;
			array_push($dependenciasArray,$dependenciaId);

		}

		$sql .= " WHERE (servicio =".$dependenciasArray[0];

        for ($j=1; $j < count($dependenciasArray) ; $j++) {
	$sql .= " OR servicio =".$dependenciasArray[$j];
        }

	if(!empty($year)){
			$sql .= ") and periodo_fin LIKE '%".$year."%'";
		}else{
			$sql .= ")";
		}

		$query = $this->db->query($sql);

		if($query->num_rows() > 0)
		{
			return $query->row()->CONSUMO;

		}else{

			return FALSE;

		}
}


function sumaCostoEnergia(){
	$this->db->select_sum('costo');
	$query = $this->db->get('pdc_consumo_energia');
	$result = $query->row()->costo;
	return $result;
}

function sumaCostoEnergiaPorServicioDependencia($dependencia,$num_servicio,$year){

	if(!empty($dependencia)){
		$this->db->where('dependencia',$dependencia);
		$this->db->select('id');
		$query = $this->db->get('pdc_servicios_energia');
		$dependenciaId = $query->row()->id;
	}
	else
	{

		if(!empty($num_servicio)){
			$this->db->where('cuenta',$num_servicio);
			$this->db->select('id');
			$query = $this->db->get('pdc_servicios_energia');
			$dependenciaId = $query->row()->id;
		}
	}
	if(!empty($year)){
		$this->db->like('periodo_fin',$year);
		$this->db->where('servicio',$dependenciaId);
		$this->db->select_sum('costo');
		$query = $this->db->get('pdc_consumo_energia');
		$result = $query->row()->costo;
		return $result;
	}
	else
	{
		$this->db->where('servicio',$dependenciaId);	//COMENTARIZADO EL 25-ENERO-2019 SI PRESENTA PROBLEMAS ROLLBACK
		$this->db->select_sum('costo');
		$query = $this->db->get('pdc_consumo_energia');
		$result = $query->row()->costo;
		return $result;
	}
}

function sumaCostoEnergiaPorVariosServicios($array,$year){

		$sql = "SELECT CONCAT('', FORMAT(SUM(costo), 2)) AS CONSUMO FROM pdc_consumo_energia";
		$dependenciasArrayCosto = array();//guardo los id de dependencias que corresponden al servicio

		for($i=0; $i < count($array); $i++){

			$this->db->where('cuenta',$array[$i]);
			$this->db->select('id');
			$query = $this->db->get('pdc_servicios_energia');
			$dependenciaId = $query->row()->id;
			array_push($dependenciasArrayCosto,$dependenciaId);

		}

		$sql .= " WHERE (servicio =".$dependenciasArrayCosto[0];

        for ($j=1; $j < count($dependenciasArrayCosto) ; $j++) {
		$sql .= " OR servicio =".$dependenciasArrayCosto[$j];
        }

		if(!empty($year)){
			$sql .= ") and periodo_fin LIKE '%".$year."%'";
		}else{
			$sql .= ")";
		}

		$query = $this->db->query($sql);

		if($query->num_rows() > 0)
		{
			return $query->row()->CONSUMO;

		}else{

			return FALSE;

		}
}

function sumaKhEnergiaPorYear($year){
        $sql = "SELECT CONCAT('', FORMAT(SUM(consumo), 0)) AS CONSUMO FROM pdc_consumo_energia";

		$sql .= " WHERE periodo_fin LIKE '%".$year."%'";

		$query = $this->db->query($sql);

		if($query->num_rows() > 0)
		{
			return $query->row()->CONSUMO;

		}else{

			return FALSE;

		}
}

function sumaCostoEnergiaPorYear($year){
		$sql = "SELECT CONCAT('', FORMAT(SUM(costo), 2)) AS COSTO FROM pdc_consumo_energia";

		$sql .= " WHERE periodo_fin LIKE '%".$year."%'";

		$query = $this->db->query($sql);

		if($query->num_rows() > 0)
		{
			return $query->row()->COSTO;

		}else{

			return FALSE;

		}
}

//Realiza la consulta en la tabla pdc_consumo_energia
//concat('$', format(sum(price), 2)
function sumaTotalTotal($year)
{
	$sql=
	"SELECT CONCAT('', FORMAT(SUM(consumo), 0)) AS SumaConsumo,
	CONCAT('', FORMAT(SUM(costo),2)) AS SumaCosto,
	GROUP_CONCAT(DISTINCT(YEAR(periodo_fin))) AS SumaYear FROM pdc_consumo_energia
	WHERE (YEAR(periodo_fin) <'0-0-0' OR YEAR(periodo_fin)> '2010-12-31')
	AND (YEAR(periodo_fin) <= YEAR(NOW()) )/*'2100-12-31' OR YEAR(periodo_fin)> '2100-12-31')*/
	AND consumo IS NOT NULL AND consumo <> ''
	AND costo IS NOT NULL AND costo <> ''
	AND periodo_inicio IS NOT NULL AND  periodo_inicio <> ''
	AND periodo_fin IS NOT NULL AND periodo_fin <> ''
	AND servicio IS NOT NULL AND servicio <> ''
	AND factor IS NOT NULL AND factor <> ''
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

/****************************************************************************************************************************
															RECIBOS
****************************************************************************************************************************/

/* Información de un recibo */
function recibo($id) {
	$this->db->where('id', $id);
	$query = $this->db->get("pdc_consumo_energia");
	return $query->row();
}

/* Registrar un recibo */
function crear() {
	$data['datetime'] = time();
	$data['usuario']	= $_SESSION['sess']['id'];
	$data['servicio'] = $this->input->post('servicio');
	$data['periodo_inicio'] = $this->input->post('periodo_inicio');
	$data['periodo_fin'] = $this->input->post('periodo_fin');
	$data['consumo'] = $this->input->post('consumo');
	$data['costo'] = $this->input->post('costo');
	$data['factor'] = $this->input->post('factor');
	$this->db->insert("pdc_consumo_energia", $data);
}

/* Edita un recibo */
function editar($id) {
	$data['datetime'] = time();
	$data['servicio'] = $this->input->post('servicio');
	$data['periodo_inicio'] = $this->input->post('periodo_inicio');
	$data['periodo_fin'] = $this->input->post('periodo_fin');
	$data['consumo'] = $this->input->post('consumo');
	$data['costo'] = $this->input->post('costo');
	$data['factor'] = $this->input->post('factor');
	$this->db->where('id', $id);
	$this->db->update("pdc_consumo_energia", $data);
}

/* Borrar un recibo */
function borrar($id) {
	$this->db->where('id', $id);
	$this->db->delete('pdc_consumo_energia');
}

/* Resultado de la busqueda */

function resultado($limite=false, $inicio=0){
	$dependencia = $this->input->post('dependencia');
	$num_servicio = $this->input->post('servicio');
	$year = $this->input->post('year');

	if(empty($dependencia) && empty($num_servicio)  && !empty($year)){

			$this->db->like('periodo_fin', $year);
			$this->db->order_by("periodo_inicio", "desc");
			$query = $this->db->get('pdc_consumo_energia');

			if($query->num_rows()>0) {
				foreach($query->result() as $row) {
					$dependencias[$row->id] = $row;
				}
				return $dependencias;
			}
			else return false;

	}else{

		$busqueda	= $this->modelo_consumo_energia->servicio_busqueda();
		if(!empty($busqueda)){
			if($limite)
				$this->db->limit($limite, $inicio);

			if(!empty($year))
			$this->db->like('periodo_fin', $year);
			$this->db->order_by("periodo_inicio", "desc");
			$this->db->where('servicio', $busqueda->id);
			$query = $this->db->get('pdc_consumo_energia');

			if($query->num_rows()>0) {
				foreach($query->result() as $row) {
					$dependencias[$row->id] = $row;
				}
				return $dependencias;
			}
			else return false;
		}
		else return false;

		}
}



function resultadoVariosServicios($array,$year){//esta accion entra cuando se ponen varios servicios en el textbox separados por una coma

		$dependenciasA = array();//guardo los id de dependencias que corresponden al servicio

		for($i=0; $i < count($array); $i++){

			$this->db->where('cuenta',$array[$i]);
			$this->db->select('id');
			$query = $this->db->get('pdc_servicios_energia');
			$dependenciaId = $query->row()->id;
			array_push($dependenciasA,$dependenciaId);

		}

			$sql = "SELECT * FROM pdc_consumo_energia";
			$sql .= " WHERE (servicio =".$dependenciasA[0];

			for ($j=1; $j < count($dependenciasA) ; $j++) {
			$sql .= " OR servicio =".$dependenciasA[$j];
			}
			if(!empty($year)){
				$sql .= ") and periodo_fin LIKE '%".$year."%'";
			}else{
				$sql .= ")";
			}

			$query = $this->db->query($sql);


			if($query->num_rows()>0) {
				foreach($query->result() as $row) {
					$dependencias[$row->id] = $row;
				}
				return $dependencias;
			}
			else return false;
}


/* SERVICIOS */

/* Catálogo de servicios */
//Este modelo usa la tabla "pdc_servicios_energia", existe la posibilidad de tomarla como referencia global para consultas en cuanto a metricas de energia(electrica) se refiere
function servicios_catalogo($limite=false, $inicio=0) {
	$this->db->order_by('dependencia', 'asc');
	if($limite)
		$this->db->limit($limite, $inicio);
	$query = $this->db->get('pdc_servicios_energia');

	if($query->num_rows()>0) {
		foreach($query->result() as $row) {
			$servicios[$row->id] = $row;
		}
		return $servicios;
	}
	else return false;
}

//Hace la consulta para mandar llamar las dependencias de pdc_servicios_energia
function catalogo_buscador(){
	$this->db->order_by('dependencia', 'asc');
	$query = $this->db->get('pdc_servicios_energia');
	if($query->num_rows()>0) {
		foreach($query->result() as $row) {
			$servicios[$row->id] = $row;
		}
		return $servicios;
	}
}



function servicio($id) {
	$this->db->where('id', $id);
	$query = $this->db->get('pdc_servicios_energia');
	return $query->row();
}
function servicio_crear() {
	$data['cuenta'] = $this->input->post('cuenta');
	$data['dependencia'] = $this->input->post('dependencia');
	$this->db->insert("pdc_servicios_energia", $data);
}

function servicio_editar($id) {
	$data['cuenta'] = $this->input->post('cuenta');
	$data['dependencia'] = $this->input->post('dependencia');
	$this->db->where('id', $id);
	$this->db->update("pdc_servicios_energia", $data);
}

function servicio_borrar($id) {
	$this->db->where('id', $id);
	$this->db->delete('pdc_servicios_energia');
}

/* Busqueda de un servicio. Realiza una consulta para mandar llamar los numeros de servicio(cuenta), incluyendo la dependencia*/
function servicio_busqueda()
{
	$servicio = $this->input->post('servicio');
	$dependencia = $this->input->post('dependencia');

	if(!empty($servicio) && !empty($dependencia)){
		$this->db->where('cuenta', $servicio);
		$this->db->where('id', $dependencia);
		$query = $this->db->get("pdc_servicios_energia");
		return $query->row();
	}

	if(!empty($servicio))
	{
	$this->db->where('cuenta', $servicio);
	$query = $this->db->get("pdc_servicios_energia");
	return $query->row();
	}
	if(!empty($dependencia))
	{
	$this->db->where('dependencia', $dependencia);
	$query = $this->db->get("pdc_servicios_energia");
	return $query->row();
	}

}

/* DEPENDENCIAS NO SE USA PARA BUSQUEDA EN CONTROLLER buscar() O quien sabe*/

function dependencias_catalogo() {
	$this->db->order_by("nombre", "asc");
	$query = $this->db->get("pdc_dependencias");

	if($query->num_rows()>0) {
		foreach($query->result() as $row) {
			$dependencias[$row->id] = $row;
		}
		return $dependencias;
	}
	else return false;
}

function dependencias_verificar($cuenta){
	$this->db->like('nombre', $cuenta , 'none');
	$query = $this->db->get("pdc_dependencias");
	return $query->row();
}

function dependencias_crear(){
	$data['nombre'] = $this->input->post('cuenta');
	$this->db->insert("pdc_dependencias", $data);
}

function dependencia_editar($id) {// trae la dependnecia a editar
	$this->db->where('id', $id);
	$query = $this->db->get('pdc_dependencias');
	return $query->row();
 }

function editaDependencia($id){// edita la dependencia
	$data['nombre'] = $this->input->post('dependencia');
	$this->db->where('id', $id);
	$this->db->update("pdc_dependencias", $data);
}

/****************************************************************************************
MÉTRICAS
****************************************************************************************/

function info_metrica($servicio, $recibo){
	$consumo = "";
	foreach($recibo as $item){
		$info['cuenta'] = $servicio[$item->servicio]->cuenta;
		$info['dependencia'] = $servicio[$item->servicio]->dependencia;
		$consumo += $item->consumo;
	}
	$info['consumo'] = $consumo;
	return $info;
}

function total_verificar($year, $cuenta){
	$this->db->like('cuenta', $cuenta , 'none');
	$this->db->like('year', $year , 'none');
	$query = $this->db->get("pdc_metricas_energia");
	return $query->row();
}

function cambio_total($cuenta,$consumo,$id){
		$data['total_consumo'] = $consumo;
		$this->db->where('id', $id);
		$this->db->update("pdc_metricas_energia", $data);
}

function total_actualiza($servicio, $recibo){
	$info = $this->modelo_consumo_energia->info_metrica($servicio, $recibo);
	$data['cuenta'] = $info['cuenta'];
	$data['dependencia'] = $info['dependencia'];
	$data['total_consumo'] = $info['consumo'];
	$data['year'] = $this->input->post('year');
	$duplicado = $this->modelo_consumo_energia->total_verificar($data['year'], $info['cuenta']);
	if(empty($duplicado)){
		$this->db->insert("pdc_metricas_energia", $data);
	}else{

		if($info['consumo'] != $duplicado->total_consumo){
			$this->modelo_consumo_energia->cambio_total($info['cuenta'], $info['consumo'], $duplicado->id);
		}
	}
	return $data;
}

/************************************
Catálogo de métricas
************************************/
function metricas_catalogo($limite=false, $inicio=0) {
	$this->db->order_by('dependencia', 'asc');
	$this->db->order_by("year", "asc");
	if($limite)
		$this->db->limit($limite, $inicio);
	$query = $this->db->get('pdc_metricas_energia');

	if($query->num_rows()>0) {
		foreach($query->result() as $row) {
			$servicios[$row->id] = $row;
		}
		return $servicios;
	}
	else return false;
}

/* Resultado de la busqueda, no se usa en el CONTROLLER buscar() */

function metricas_resultado($limite=false, $inicio=0){
	$dependencia = $this->input->post('dependencia');
	$num_servicio = $this->input->post('servicio');
	$year = $this->input->post('year');

	$busqueda = $this->modelo_consumo_energia->servicio_busqueda();
		if(!empty($busqueda)){
			if($limite)
				$this->db->limit($limite, $inicio);

			if(!empty($year))
				$this->db->like('year', $year);

			$this->db->order_by('dependencia', 'asc');
			$this->db->order_by("year", "asc");
			$this->db->where('cuenta', $busqueda->cuenta);
			$query = $this->db->get('pdc_metricas_energia');

			if($query->num_rows()>0) {
				foreach($query->result() as $row) {
					$dependencias[$row->id] = $row;
				}
				return $dependencias;
			}
			else return false;
		}
	else return false;
}

function metrica($id) {
	$this->db->where('id', $id);
	$query = $this->db->get('pdc_metricas_energia');
	return $query->row();
}

function metrica_editar($id) {
	$data['cuenta'] = $this->input->post('cuenta');
	$data['dependencia'] = $this->input->post('dependencia');
	$this->db->where('id', $id);
	$this->db->update("pdc_metricas_energia", $data);
}

function metrica_borrar($id) {
	$this->db->where('id', $id);
	$this->db->delete('pdc_metricas_energia');
}

/* Busqueda de un servicio, no se usa en el CONTROLLER buscar() */
function metrica_busqueda() {
	$servicio = $this->input->post('servicio');
	$dependencia = $this->input->post('dependencia');

	if(!empty($servicio) && !empty($dependencia)){
		$this->db->where('cuenta', $servicio);
		$this->db->where('id', $dependencia);
		$query = $this->db->get("pdc_servicios_energia");
		return $query->row();
	}

	if(!empty($servicio)){
	$this->db->where('cuenta', $servicio);
	$query = $this->db->get("pdc_servicios_energia");
	return $query->row();
	}
	if(!empty($dependencia)){
	$this->db->where('dependencia', $dependencia);
	$query = $this->db->get("pdc_servicios_energia");
	return $query->row();
	}

}

/* Edita un registro */
function editar_registro($id) {
	$data['cuenta'] = $this->input->post('cuenta');
	$data['dependencia'] = $this->input->post('dependencia');
	$data['consumo_persona'] = $this->input->post('consumo_persona');
	$data['total_consumo'] = $this->input->post('total_consumo');
	$this->db->where('id', $id);
	$this->db->update("pdc_metricas_energia", $data);
}

/****************************************************************************************
NUEVAS GRÁFICAS
****************************************************************************************/

/* Función para obtener un total elemental */
function total_mes($type, $unidad, $service, $year=false, $month=false) {
	/* Primero obtiene el año y mes actual */
	$year = ($year)? $year : date('Y');
	$month = ($month)? $month : date('m');
	$d_date = $year. '-' . $month;


	$this->db->where('servicio', '60');
	$this->db->like('periodo_inicio', $d_date);
	$query = $this->db->get("pdc_consumo_energia");

	if($query->num_rows>0) {
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
	$query = $this->db->get("pdc_consumo_energia");

	if($query->num_rows>0) {
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
	$month	= 12;
	$month = ($month)? $month : date('m');

	$totales = false;

	for($a=$meses-1; $a>=0; $a--)
	{
		$months[] = date('Y-m', mktime(0, 0, 0, $month-$a+1, 0, $year));
	}

	$prueba= $this->modelo_consumo_energia->prueba_query($year, $service);

	if(!empty($prueba))
	{
		foreach($prueba as $item)
		{
			$totales[] = $item->$unidad;
		}
	}
	//print_r($prueba);

	$filename = "ultimos-meses_".$unidad."_".$service;

	if($totales) {
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
			"AroundZero"=>TRUE,
			"Rounded"=>TRUE,
			"Draw0Line"=>TRUE,
			"Floating50Serie"=>TRUE,
			"Floating0Value"=>FALSE,
			"DisplayPos"=>LABEL_POS_OUTSIDE
		));

		$grafica->render('graficas/'.$filename.'.png');
	}
	else {
		$filename = false;
	}
	return $filename;
}


/***************************************************************************************************************************/

//Hace la insercion en las tablas elcampus1 y elcampus2 para generar la tabla
//que se muestra en Consumo Por Campus (consumo_electricidad/campus_buscar)
function campustransact1()
{
	$this->db->trans_start();
	$tabla1= "CREATE TABLE IF NOT EXISTS `elcampus1` ( `id` INT NOT NULL AUTO_INCREMENT , `periodo_fin` VARCHAR(256) NOT NULL , `consumo` VARCHAR(128) NOT NULL , `costo` VARCHAR(256) NOT NULL , `thecampus` VARCHAR(256) NOT NULL , PRIMARY KEY (`id`), UNIQUE `consumini1` (`consumo`)) ENGINE = InnoDB;";
	//$untable1= "DROP TABLE pdc_factor_gei;";
	$tabla2= "CREATE TABLE IF NOT EXISTS `elcampus2` ( `id` INT NOT NULL AUTO_INCREMENT , `campusyear` YEAR NOT NULL , `campus2` VARCHAR(256) NOT NULL , `campusconsumo2` VARCHAR(128) NOT NULL , `campuscosto2` VARCHAR(256) NOT NULL , PRIMARY KEY (`id`), UNIQUE `consumini2` (`campusconsumo2`)) ENGINE = InnoDB;";
	$this->db->query($tabla1);
	$this->db->query($tabla2);
	$this->db->query("INSERT INTO elcampus1(periodo_fin, consumo, costo, thecampus)
			SELECT GROUP_CONCAT(DISTINCT(YEAR(a.periodo_fin))),
			CONCAT(SUM(a.consumo)),
			CONCAT(SUM(a.costo)),
			c.campus
			FROM pdc_consumo_energia a
			INNER JOIN ctrl_servicios b ON a.servicio = b.id 
			INNER JOIN pdc_servicios_energia c ON b.account = c.cuenta 
			WHERE c.campus IS NOT NULL AND c.campus <> ''
			AND a.periodo_fin IS NOT NULL AND a.periodo_fin <> ''
			AND a.consumo IS NOT NULL AND a.consumo <> ''
			AND a.costo IS NOT NULL AND a.costo <> ''
			AND b.account IS NOT NULL AND b.account <> ''
			AND a.servicio IS NOT NULL AND a.servicio <> ''
			AND (YEAR(a.periodo_fin) >= 2011 AND YEAR(a.periodo_fin) <= YEAR(NOW()) ) /*NUEVA FUNCIÓN*/
			GROUP BY YEAR(a.periodo_fin), c.campus
			ORDER BY YEAR(a.periodo_fin) ASC, a.servicio ASC
			ON DUPLICATE KEY UPDATE periodo_fin = VALUES(periodo_fin), consumo = VALUES(consumo), costo= VALUES(costo),
			thecampus = VALUES(thecampus)");
	$this->db->query("INSERT INTO elcampus2(campusyear, campus2, campusconsumo2, campuscosto2)
			SELECT periodo_fin, thecampus, consumo, costo
			FROM elcampus1
			ON DUPLICATE KEY UPDATE campusyear = VALUES(campusyear),
			campus2 = VALUES(campus2), campusconsumo2 = VALUES(campusconsumo2),
			campuscosto2 = VALUES(campuscosto2)");
	$this->db->trans_complete();
}

//Test de borrado para recargar datos nuevos en tablas elcampu1 elcampus2
function drope_c1_2table()
{
	$this->db->query("DROP TABLE elcampus1;");
	$this->db->query("DROP TABLE elcampus2;");
}
/******************************************************************************************************************************/
function lista_campus()
{
	$sql = "SELECT  campusyear, campus2, campusconsumo2, campuscosto2
	FROM elcampus2";

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

/****************************************************************************************************************************
														CAMPUS TESTS
****************************************************************************************************************************/
//DEBE GENERAR UNA NUEVA TABLA; pdc_campus
function campus_catalogo() {
	$this->db->order_by("campus", "asc");
	$query = $this->db->get("pdc_campus");

	if($query->num_rows()>0) {
		foreach($query->result() as $row) {
			$thecampuses[$row->id] = $row;
		}
		return $thecampuses;
	}
	else return false;
}


function campus_full($limite=false, $inicio=0)
{
	if($limite)
	//if($inicio)
	$this->db->limit($limite, $inicio);

	$this->db->group_by('campusyear');
	$this->db->order_by("campusyear", "desc");
	$query = $this->db->get('elcampus2');

	if($query->num_rows()>0) {
		foreach($query->result() as $row) {
			$campus[$row->id] = $row;
		}
		return $campus2;
	}
	else return false;
}

function campus_buscador()
{
	$this->db->order_by('campus2', 'asc');
	$this->db->group_by('campus2');
	$query = $this->db->get('elcampus2');
	if($query->num_rows()>0) {
		foreach($query->result() as $row) {
			$campus2[$row->id] = $row;
			
		}
		return $campus2;

	}
}



/******************************************************************************************************************************/
function campus_resultado()
{
	$campus2 = $this->input->post('campus2');

	$year = $this->input->post('year');

	if(empty($campus2) && empty($year))
	{
		$this->db->like('campusyear', $year);
		$this->db->like('campus2', $campus2);
		$this->db->order_by('campusyear', 'desc');
		$query = $this->db->get('elcampus2');

		if ($query->num_rows()>0)
		{
				foreach($query->result() as $row)
				{
					$campusyear[$row->id] = $row;
				}
				return $campusyear;
		}
		else return false;
	}

	//Manda resultados si se selecciona el año
	if(empty($campus2) && !empty($year))
	{
		$this->db->where('campusyear', $year);
		$this->db->order_by('campusyear', 'desc');
		$query = $this->db->get('elcampus2');
		if ($query->num_rows()>0)
		{
			foreach($query->result() as $row)
			{
				$campusyear[$row->id] = $row;
			}
			return $campusyear;
		}
		else return false;
	}
	//ADO
	
	//Manda resultados si se selecciona el campus
	if(!empty($campus2) && empty($year))
	{
		$this->db->where('campus2', $campus2);
		$this->db->order_by('campusyear', 'desc');
		$query = $this->db->get('elcampus2');
				
			if ($query->num_rows()>0)
			{
				foreach($query->result() as $row)
				{
					$campusyear[$row->id] = $row;
				}
				return $campusyear;
			}
			else return false;
	}
	
	//Manda resultados si se seleccionan ambos
	if(!empty($campus2) && !empty($year))
	{
		$this->db->where('campusyear', $year);
		$this->db->where('campus2', $campus2);
		$this->db->order_by('campusyear', 'desc');
		$query = $this->db->get('elcampus2');

			if($query->num_rows()>0)
			{
				foreach($query->result() as $row)
				{
					$campusyear[$row->id] = $row;
				}
				return $campusyear;
			}
			else return false;
	}
	
}



function sumaCampusConsumo($campus2, $year)
{
	$this->db->select_sum('campusconsumo2');
	$query = $this->db->get('elcampus2');
	$result = $query->row()->campusconsumo2;
	return $result;
}

function sumaCampusCosto($campus2, $year)
{
	$this->db->select_sum('campuscosto2');
	$query = $this->db->get('elcampus2');
	$result = $query->row()->campuscosto2;
	return $result;
}


//Works :o Realiza la sumatoria del Consumo "al cargar la pagina" 
function sumaConsumoEnergiaEmptyAll($campus2, $year)
{

	if(empty($campus))
	{
		$this->db->where('campus2',$campus2);
		$this->db->select('id');
		$query = $this->db->get('elcampus2');
		//$campusId = $query->row()->id;
	}
	if(empty($year))
	{

		$this->db->like('campusyear',$year);
		$this->db->select_sum('campusconsumo2');
		$query = $this->db->get('elcampus2');
		$result = $query->row()->campusconsumo2;
		return $result;

	}

}

//Works :o Realiza la sumatoria del Costo "al cargar la pagina" 
function sumaCostoEnergiaEmptyAll($campus2, $year)
{

	if(empty($campus2))
	{
		$this->db->where('campus2', $campus2);
		$this->db->select('id');
		$query = $this->db->get('elcampus2');
		//$campusId = $query->row()->id;
	}
	if(empty($year))
	{
		$this->db->like('campusyear',$year);
		$this->db->select_sum('campuscosto2');
		$query = $this->db->get('elcampus2');
		$result = $query->row()->campuscosto2;
		return $result;
	}

}


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//Works :o Realiza la sumatoria del Consumo, seleccionado campus y año
function sumaConsumoEnergiaAll($campus2, $year)
{

	if(!empty($campus2))
	{
		$this->db->where('campus2',$campus2);
		$this->db->where('campusyear', $year);
		
		//$query = $this->db->get('elcampus2');
		//$campusId = $query->row()->id;
	}
	if(!empty($year))
	{
		$this->db->where('campus2', $campus2);
		//$this->db->select('id');
		$this->db->select('campusconsumo2', /*'id',*/ $year);
		$query = $this->db->get('elcampus2');
		$result = $query->row()->campusconsumo2;
		//return NULL;
		return $result;

	}
}

//Works :o Realiza la sumatoria del Costo, seleccionado campus y año
function sumaCostoEnergiaAll($campus2, $year)
{

	if(!empty($campus2))
	{
		$this->db->where('campus2', $campus2);
		$this->db->where('campusyear', $year);
		
		//$query = $this->db->get('elcampus2');
		//$campusId = $query->row()->id;
	}
	if(!empty($year))
	{
		$this->db->where('campus2', $campus2);
		//$this->db->select('id');
		$this->db->select('campuscosto2', /*'id',*/ $year);
		$query = $this->db->get('elcampus2');
		$result = $query->row()->campuscosto2;
		//return NULL;
		return $result;
	}

}


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//Works :o Realiza la sumatoria del Consumo, por campus seleccionado
function sumaConsumoEnergiaEmptyYear($campus2, $year)
{

	if(empty($year))
	{
		$this->db->where('campus2',$campus2);
		$this->db->where('id');
		//$this->db->select('id');
		$query = $this->db->get('elcampus2');
		//$campusId = $query->row()->id;
	}
	if(!empty($campus2))
	{
		$this->db->where('campus2', $campus2);
		$this->db->select_sum('campusconsumo2');
		$query = $this->db->get('elcampus2');
		$result = $query->row()->campusconsumo2;
		return $result;
	}
}

//Works :o Realiza la sumatoria del Costo, por campus seleccionado
function sumaCostoEnergiaEmptyYear($campus2, $year)
{

	if(empty($year))
	{
		$this->db->where('campus2', $campus2);
		$this->db->select('id');
		$query = $this->db->get('elcampus2');
		//$campusId = $query->row()->id;
	}
	if(!empty($campus2))
	{
		$this->db->where('campus2', $campus2);
		$this->db->select_sum('campuscosto2');
		$query = $this->db->get('elcampus2');
		$result = $query->row()->campuscosto2;
		return $result;
	}

}


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//Works :o Realiza la sumatoria del Consumo, por año seleccionado
function sumaConsumoEnergiaEmptyCampus($campus2, $year)
{
if(empty($campus2))
	{
		$this->db->where('campusyear', $year);
		$this->db->where('id');
		$query = $this->db->get('elcampus2');
		//$campusId = $query->row()->id; //COMENTARIZADO POR CAUSAR POSIBLES ERRORES DE CONSULTA
	}
	if(!empty($year))
	{
		$this->db->where('campusyear', $year);
		$this->db->select_sum('campusconsumo2');
		$query = $this->db->get('elcampus2');
		$result = $query->row()->campusconsumo2;
		return $result;
	}
}

//Works :o Realiza la sumatoria del Costo, por año seleccionado
function sumaCostoEnergiaEmptyCampus($campus2, $year)
{
	if(empty($campus2))
	{
		$this->db->where('campus2', $campus2);
		$this->db->select('id');
		$query = $this->db->get('elcampus2');
		//$campusId = $query->row()->id; //COMENTARIZADO POR CAUSAR POSIBLES ERRORES DE CONSULTA
	}
	if(!empty($year))
	{
		$this->db->where('campusyear', $year);
		$this->db->select_sum('campuscosto2');
		$query = $this->db->get('elcampus2');
		$result = $query->row()->campuscosto2;
		return $result;
	}
}


/******************************************************************************************************************************/
														
/******************************************************************************************************************************/
														/*PDF*/
/******************************************************************************************************************************/
/*Funcion de modelo en pruebas, para imprimir o guardar el archivo en formato PDF*/
function panel_pdf() {
	$filename= "prueba";
	/*Información de recibos*/
	$info_recibos= $this->modelo_consumo_energia->catalogo();

	/* ARCHIVO */
		$pdf = new tFPDF();

		$pdf->AddFont('dejavu', '', 'DejaVuSerif.ttf', true);
		$pdf->AddFont('dejavusans', '', 'DejaVuSans.ttf', true);
		$pdf->AddFont('dejavusans', 'B', 'DejaVuSans-Bold.ttf', true);

		$pdf->SetMargins(10, 10, 10);
		$pdf->SetTextColor(110, 110, 110);
		$pdf->AliasNbPages();

		/* SECCIÓN 1: Portada  */
			$pdf->AddPage();
			$pdf->SetY(35);
			$pdf->Image('img/logo-uanl.png', 20, 25, 50);

			/* Título */
			$pdf->SetFont('dejavu', '', 16);
			$pdf->SetX(85);
			$pdf->Cell(100, 8, 'Secretaría de Desarrollo Sustentable', 0, 1);

			/* Subtítulo */
			$subtitulo = 'Reporte de recibos de dependencias ';
			$pdf->SetDrawColor(216, 216 , 216);
			$pdf->SetFont('dejavusans', '', 14);
			$pdf->Ln(20);
			$pdf->Cell(0, 10, $subtitulo, 'B', 1);

			/* Información general */
			$pdf->SetFont('dejavusans','B', 9);
				/* Dependencia */
				$pdf->Ln(5);
				$pdf->Cell(60, 5, 'Dependencia');
				//$dependencia = $info_site->site_name;
				$dependencia = 'Todas las dependencias';
				$pdf->Cell('120', 5, $dependencia, '', 1);

			/* Miembros presentes del Comité para la Sustentabilidad */
				$pdf->Ln(140);
				$pdf->SetFont('dejavusans','B', 9);
				$pdf->Cell(0, 5, 'Directorio');
				$pdf->Ln(6);
				$pdf->SetFont('dejavusans', '', 9);
					/* Administrativo */
					$pdf->SetX(10);
					$pdf->Cell(90, 5, 'Rector:');
					$pdf->Cell(80, 5, 'Dr. Jesús Ancer Rodríguez');
					$pdf->Ln(6);
					/* Académico */
					$pdf->SetX(10);
					$pdf->Cell(90, 5, 'Secretario Académico:');
					$pdf->Cell(120, 5, 'Dr. Juan Manuel Alcocer González');
					$pdf->Ln(6);
					/* Estudiante */
					$pdf->SetX(10);
					$pdf->Cell(90, 5, 'Director General de informática:');
					$pdf->Cell(120, 5, 'Ing. Alberto Zambrano Elizondo');
					$pdf->Ln(6);
					/* Estudiante */
					$pdf->SetX(10);
					$pdf->Cell(90, 5, 'Coordinador del Panel de Control:');
					$pdf->Cell(120, 5, 'Ing. Arturo Cárdenas Garza');
					$pdf->Ln(6);
					/* Estudiante */
					$pdf->SetX(10);
					$pdf->Cell(90, 5, 'Secretario General:');
					$pdf->Cell(120, 5, 'Ing. Rogelio Garza Rivera');
					$pdf->Ln(6);
					/* Estudiante */
					$pdf->SetX(10);
					$pdf->Cell(90, 5, 'Secretario de Desarrollo Sustentable:');
					$pdf->Cell(120, 5, 'Dr. Sergio Fernández Delgadillo');
					$pdf->Ln(6);
					/* Estudiante */
					$pdf->SetX(10);
					$pdf->Cell(90, 5, 'Director de Infraestructura para la Sustentabilidad:');
					$pdf->Cell(120, 5, 'MC Félix González Estrada');
					$pdf->Ln(6);
}
		/* SECCIÓN 3: 1.2 Tablas
				$pdf->AddPage();

			$pdf->SetTextColor(110, 110, 110);
			$pdf->AddPage();
			$pdf->SetFont('dejavusans', 'B', 11);
			$subtitulo = '1.2 '.$info_area->area_subtitle;
			$pdf->Cell(0, 0, $subtitulo);
			$pdf->Ln(5);
			$pdf->SetFont('dejavusans', '', 10);

			$main_table = new tfpdfTable($pdf);
			$main_table->setStyle('th', 'dejavusans', 'B', 8, '');
			$main_table->setStyle('p', 'dejavusans', '', 8, '');
			$multicell = tfpdfMulticell::getInstance($pdf);
			/* Configuración de la tabla
			$table_config = array(
					'TABLE'			=> array(
					'BORDER_COLOR' => array(220, 220, 220),
					'BORDER_SIZE'   => 0.3,
				),
					'HEADER'			=> array(
					'TEXT_COLOR'		=> array(110, 110, 110),
					'TEXT_SIZE' => 9,
					'LINE_SIZE' => 6,
					'BORDER_SIZE' => 0.3,
					'BORDER_TYPE' => 'B',
					'BORDER_COLOR' => array(220, 220, 220),
					'BACKGROUND_COLOR' => array(240, 240, 240)
				),
				'ROW' => array(
					'TEXT_COLOR'		=> array(110, 110, 110),
					'TEXT_SIZE'         => 9,
					'LINE_SIZE'         => 4,
					'BORDER_SIZE' => 0.1,
					'BORDER_COLOR' => array(230, 230, 230)
				)
			);
			/* Se crea la tabla
			$main_table->initialize(array(35, 40, 35, 20, 35, 20), $table_config);

			/* Encabezados de tabla, dependen del área
			switch($info_diag->type) {
				case 1:
					$tabla_head = array(
						array('TEXT'  => '<th>Edificio, piso</th>'),
						array('TEXT'  => '<th>Ubicación</th>'),
						array('TEXT'  => '<th>Unidades</th>'),
						array('TEXT'  => '<th>Watts</th>'),
						array('TEXT'  => '<th>Tipo</th>'),
						array('TEXT'  => '<th>Calidad de Iluminación</th>')
					);
					break;
				case 2:
					$tabla_head = array(
						array('TEXT'  => '<th>Edificio, piso</th>'),
						array('TEXT'  => '<th>Ubicación</th>'),
						array('TEXT'  => '<th>Equipo</th>'),
						array('TEXT'  => '<th>Unidades</th>'),
						array('TEXT'  => '<th>Tipo</th>'),
						array('TEXT'  => '<th>Estado</th>')
					);
					break;
			}

			if($tablas) {
				/* Se añade el encabezado a la tabla
				$main_table->addHeader($tabla_head);

				foreach($tablas as $key=>$fila) {
					$even = $key%2;
					switch($info_diag->type) {
						case 1:
							$row[0]['TEXT'] = '<p>'.$fila->edificio.' '.$fila->piso.'</p>';
							$row[0]['TEXT_ALIGN'] = 'L';
							$row[1]['TEXT'] = '<p>'.$fila->area.' '.$fila->lugar.'</p>';
							$row[1]['TEXT_ALIGN'] = 'L';
							$row[2]['TEXT'] = '<p>'.$fila->unidades.'</p>';
							$row[2]['TEXT_ALIGN'] = 'L';
							$row[3]['TEXT'] = '<p>'.$fila->watts.'</p>';
							$row[3]['TEXT_ALIGN'] = 'L';
							$row[4]['TEXT'] = '<p>'.$fila->tipo.'</p>';
							$row[4]['TEXT_ALIGN'] = 'L';
							$row[5]['TEXT'] = ucfirst($fila->estado);
							$row[5]['TEXT_ALIGN'] = 'L';
							break;
						case 2:
							$row[0]['TEXT'] = '<p>'.$fila->edificio.' '.$fila->piso.'</p>';
							$row[0]['TEXT_ALIGN'] = 'L';
							$row[1]['TEXT'] = '<p>'.$fila->area.' '.$fila->lugar.'</p>';
							$row[1]['TEXT_ALIGN'] = 'L';
							$row[2]['TEXT'] = '<p>'.$fila->equipo.'</p>';
							$row[2]['TEXT_ALIGN'] = 'L';
							$row[3]['TEXT'] = '<p>'.$fila->unidades.'</p>';
							$row[3]['TEXT_ALIGN'] = 'L';
							$row[4]['TEXT'] = '<p>'.$fila->tipo.'</p>';
							$row[4]['TEXT_ALIGN'] = 'L';
							$row[5]['TEXT'] = ucfirst($fila->estado);
							$row[5]['TEXT_ALIGN'] = 'L';
							break;
					}
					/* Colorea las filas pares
					if($even==1) {
						$row[0]['BACKGROUND_COLOR'] =
						$row[1]['BACKGROUND_COLOR'] =
						$row[2]['BACKGROUND_COLOR'] =
						$row[3]['BACKGROUND_COLOR'] =
						$row[4]['BACKGROUND_COLOR'] =
						$row[5]['BACKGROUND_COLOR'] = array(240, 240, 240);
					}
					else {
						$row[0]['BACKGROUND_COLOR'] =
						$row[1]['BACKGROUND_COLOR'] =
						$row[2]['BACKGROUND_COLOR'] =
						$row[3]['BACKGROUND_COLOR'] =
						$row[4]['BACKGROUND_COLOR'] =
						$row[5]['BACKGROUND_COLOR'] = array(255, 255, 255);
					}
					/* COLOR */
					/* Colorea el tipo de equipamiento, con la función color_type_pdf
					$row[4]['TEXT_COLOR'] = color_type_pdf($fila->tipo);
					/* Colorear el estado, dependiendo si el diagnóstico es eléctrico o hidráulico */
					/* La función "color_cell_pdf" regresa el arreglo con el color
					$row[5]['TEXT_COLOR'] = color_cell_pdf($fila->estado);
					$main_table->addRow($row);
				}
				$main_table->close();
			} /* if tablas */

		/*$pdf->Output('./archivos/reportes/'.$filename, 'F');*/
//		$pdf->Output();
}
//}///////////////////////////FIN DEL CI MODELO