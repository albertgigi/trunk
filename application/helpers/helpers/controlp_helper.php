<?php if (!defined('BASEPATH')) exit('Prohibido el acceso');

/* Verifica que existe el área a la que se hace referencia con un path */
function is_area($actual, $path) {
	$actual->db->where('area_path', $path);	
	$query = $actual->db->get('ctrl_areas');	
	$row = $query->row();
	return ($row)? $row : false;
 }

/* Verifica que se haya iniciado la sesión */
function is_logged($actual) {
	$log = $actual->session->userdata('ctrl_log');
	return ($log)? true : false;
}

/* Regresa el id de un usuario, para inicio de sesión */
function user_id($actual, $username) {
	$actual->db->where('user_login', $username);
	$query = $actual->db->get('ctrl_users');
	$row = $query->row();
	return ($row)? $row->user_id : false;
}	

/* Regresa los elementos del menu principal, se va a ir */
function menu_main($actual, $level, $area) {
	$actual->db->where('menu_type <=', $level);
	$actual->db->where('menu_area', $area);
	$actual->db->order_by('menu_level', 'asc');
	$query = $actual->db->get('ctrl_menu_main');
	if($query->num_rows() > 0) {
		foreach($query->result() as $row) {
			$data[] = $row;
		} // foreach
		return $data;
	} // if
	else { return false; }
}

/* Regresa los elementos del menu principal, se va a ir */
function menu_diagnostico($actual, $level) {
	$actual->db->where('menu_type <=', $level);
	$actual->db->order_by('menu_level', 'asc');
	$query = $actual->db->get('ctrl_menu_diagnostico');
	if($query->num_rows() > 0) {
		foreach($query->result() as $row) {
			$data[] = $row;
		} // foreach
		return $data;
	} // if
	else { return false; }
}

/* N�mero de registros pendientes de terminar */
function pending($actual, $usr_id) {
	$actual->db->select('reg_id');
	$actual->db->where('reg_user', $usr_id);
	$actual->db->where('reg_cost', 0);
	$query = $actual->db->get('ctrl_recibos');
	$pending = $query->num_rows();
	return $pending;
}

/* Formato de fecha */
function periodo_nice($fecha) {		
	$meses = array('Ene', 'Feb', 'Mar', ' Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic');
	$elem = explode('-', $fecha);
	
	$mes = $elem[1] -= 1;
	$dia = $elem[2] += 0;
	
	$nuevo = $meses[$mes].' '.$dia;
	return $nuevo;
}
function str_decode_utf8($string) { 
  if (mb_detect_encoding($string, 'UTF-8', true) === TRUE) { 
    $string = utf8_decode($string); 
  }
return $string; 
}
function str_encode_utf8($string) { 
  if (mb_detect_encoding($string, 'UTF-8', true) === FALSE) { 
    $string = utf8_encode($string); 
  }
return $string; 
}

/* DIAGNOSTICOS Y REPORTES */
function date_easy($date) {	
	if($date!='0000-00-00') {	
		/* Recibe una fecha en formato YYYY-MM-DD y la cambia a una forma m�s sencilla */
		$meses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
		$date2 = date('Y-n-j', strtotime($date));
		list($anio, $mes, $dia) = explode('-', $date2);
		return $dia.' de '.$meses[$mes-1].', '.$anio;
	}
	else return '-';
}

/* Función que define el color de estado en las tablas del sistema */
function color_cell_table($item) {
	$class = '';
	/* Recibe todo el arreglo, para poder hacer diferentes validaciones */
	/* La primera validación es la de T12 */
	if($item->tipo=='T12') {
		$class = 'rojo medio';
	} else {
		$status = strtolower($item->estado);
		switch(trim($status)) {
			case 'bueno':
			case 'buena':
			case 'satisfactoria':
			case 'satisfactorio':
				$class = 'verde medio';
				break;
			case 'regular':
			case 'insuficiente':
			case 'obsoleto':
				$class = 'ambar medio';
				break;
			case 'malo':
			case 'mala':
			case 'excesiva':
			case 'excesivo':
				$class = 'rojo medio';
				break;
			default:
				$class = '';
		}
	}
	return $class;
}
/* Función que determina de qué color se mostrará el texto de un tipo de iluminación */
function color_type_table($type) {
	$type = trim(strtolower($type));
	switch($type) {
		case 'incandescente':
		case 'reflector':
		case 'dicroica':
		case 'dicroicas':
		case 'aditivos metálicos':
		case 'aditivos':
		case 'vs':
		case 't12':
		case 't12 fluorescente':
		case 't12 tipo u':
			/* Rojo */
			$class = 'rojo medio';
			break;
		case 'am':
		case 'halógeno':
		case 'fluorescente':
			/* Ámbar */
			$class = 'ambar medio';
			break;
		case 'pl':
		case 't8':
		case 't8 fluorescentes':
		case 't8 tipo u':
		case 't5':
		case 'ahorrador':
		case 'led':
			/* Verde */
			$class = 'verde medio';
			break;
		default:
			$class = '';
	}
	return $class;
}

/* Función que define el color del texto en una celda de estado en el reporte pdf */
function color_cell_pdf($status) {
	$status = trim(strtolower($status));	
	switch($status) {
		case 'bueno':
		case 'satisfactoria':
		case 'satisfactorio':
		case 'green':
			/* Verde */
			$color = array(33, 97, 11);
			break;
		case 'regular':
		case 'insuficiente':
		case 'amber':
			/*Ámbar */
			$color = array(255, 64, 0);
			break;
		case 'malo':
		case 'excesiva':
		case 'excesivo':
		case 'red':
			/* Rojo */
			$color = array(180, 4, 4);
			break;
		default:
			$color = array(110, 110, 110);
	}
	return $color;
}
/* Función que determina de qué color se mostrará el texto de un tipo de iluminación */
function color_type_pdf($type) {
	$type = trim(strtolower($type));
	switch($type) {
		case 'incandescente':
		case 'reflector':
		case 'dicroica':
		case 'dicroicas':
		case 'vs':
		case 't12':
			/* Rojo */
			$color = array(180, 4, 4);
			break;
		case 'am':
		case 'halógeno':
		case 'fluorescente':
			/* Ámbar */
			$color = array(255, 64, 0);
			break;
		case 'pl':
		case 't8':
		case 't8 tipo u':
		case 't5':
		case 'led':
			/* Verde */
			$color = array(33, 97, 11);
			break;
		default:
			$color = array(110, 110, 110);
	}
	return $color;
}
function color_text_pdf($pdf, $class) {
	switch($class) {
		case 'green':
			$pdf->SetTextColor(33, 97, 11);
			break;
		case 'amber':
			$pdf->SetTextColor(255, 64, 0);
			break;
		case 'red':
			$pdf->SetTextColor(180, 4, 4);
			break;
	}
}


/****************************************************************************************
NUEVAS FUNCIONES DE COLORES
****************************************************************************************/
/* Color de un tipo de iluminación */
function tabla_color_iluminacion_tipo($tipo) {
	$tipo = trim(strtolower($tipo));
	switch($tipo) {
		case 'incandescente':
		case 'reflector':
		case 'dicroica':
		case 'dicroicas':
		case 'aditivos metálicos':
		case 'aditivos':
		case 'vs':
		case 't12':
		case 't12 fluorescente':
		case 't12 tipo u':
			/* Rojo */
			$color = 'rojo medio';
			break;
		case 'am':
		case 'halógeno':
		case 'fluorescente':
			/* Ámbar */
			$color = 'ambar medio';
			break;
		case 'pl':
		case 't8':
		case 't8 fluorescentes':
		case 't8 tipo u':
		case 't5':
		case 'ahorrador':
		case 'led':
			/* Verde */
			$color = 'verde medio';
			break;
		default:
			$color = '';
	}
	return $color;
}
/* Color de un estado de iluminación */
function tabla_color_iluminacion_estado($estado) {
	$estado = strtolower($estado);
	switch(trim($estado)) {
		case 'bueno':
		case 'buena':
		case 'satisfactoria':
		case 'satisfactorio':
			$color = 'verde medio';
			break;
		case 'regular':
		case 'insuficiente':
		case 'obsoleto':
		case 'malo':
		case 'mala':
		case 'excesiva':
		case 'excesivo':
			$color = 'rojo medio';
			break;
		default:
			$color = '';
	}
	return $color;
}

/* Función para fecha */
function date_nice($time) {
	$time = strtotime($time);
	$dias = array('Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado');
	$meses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
	
	$day = date('w', $time);
	$month = date('n', $time);
	
	return $dias[$day].' '.date('j', $time).' de '.$meses[$month-1].', '.date('Y', $time);
	
}

