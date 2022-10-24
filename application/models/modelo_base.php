<?php
class Modelo_base extends CI_Model {

/* BASE DE DATOS */
/*
-------------------------------------------------------------------------------------------
Función que genera un LISTADO de cualquier tabla
------------------------------------------------------------------------------------------
table:			es el nombre de la tabla que se consultará
conditions: 	arreglo asociativo de campos y valores de condición
limit:				limite de registros de la consulta (opcional)
offset:			punto de partida para el query (opcional)
order: 			campo con el cual se ordenará la consulta (opcional)
type: 			tipo de ordenamiento, ascendente o descendente (opcional)

Regresa un arreglo de objetos, cada objeto es un registro
Si no obtiene valores, la función regresa el valor booleano false
El ordenamiento predeterminado es por id, ascendente
-------------------------------------------------------------------------------------------
*/
function any_list($table, 
			$conditions=false,
			$limit=false,
			$offset=false,
			$order=false,
			$type='asc',
			$user=false,
			$key=true) {
	/* Se agregan las condiciones del arreglo asociativo */
	if($conditions) {
		foreach($conditions as $field=>$value) {
			$this->db->where($field, $value);
		}
	}
	/* Se realiza la selección por usuario */
	if($user) $this->db->where('user', $user); 
	/* Se realiza el ordenamiento */
	if($order && $type) { $this->db->order_by($order, $type); }
	else { $this->db->order_by('id', 'asc'); }
	
	$query = ($limit)? $this->db->get(DB_PREFIX.$table, $limit, $offset) : $this->db->get(DB_PREFIX.$table);	
	
	if($query->num_rows()>0) {
		foreach($query->result() as $row) {
			if($key) {
				$data[$row->id] = $row;
			}
			else {
				$data[] = $row;
			}
		
		}
		return $data;
	}
	else return false;
}
/*
-------------------------------------------------------------------------------------------
Función que obtiene la información de un REGISTRO
-------------------------------------------------------------------------------------------
table:		es el nombre de la tabla que se buscará el registro
field:		es el nombre de la columna sobre la cual se buscará
value: 		el valor que se desea encontrar el en campo 'field'

Los tres parámetros son obligatorios
Su resultado en un objeto que representa el registro
Si no obtiene valores, la función regresa el valor booleano false
-------------------------------------------------------------------------------------------
*/
function any_data($table, 
			$conditions) {
	/* Se agregan las condiciones del arreglo asociativo */
	if($conditions) {
		foreach($conditions as $field=>$value) {
			$this->db->where($field, $value);
		}
	}
	$query = $this->db->get(DB_PREFIX.$table, 1);
	if($query && $query->num_rows()==1) {
		$data = $query->row();
		return $data;
	}
	else return false;
}
/*
-------------------------------------------------------------------------------------------
Función que agrega un registro a una tabla
-------------------------------------------------------------------------------------------
table:		es el nombre de la tabla  donde se borrará
data:		arreglo asociativo de valores adicionales
exclude:	valores que se buscarán para evitar repetición de registros
-------------------------------------------------------------------------------------------
*/
function any_insert($table, $data=array(), $exclude=false) {

	foreach($this->input->post() as $key=>$value) {
		if($key!='submit' 
			&& !is_array($value)
		) {
			$data[$key] = $value;
		}
		/* Al final se tiene el arreglo asociativo que se quiere registrar */
	}
	$data['datetime'] = time();
	/* Se va a crear un arreglo asociativo de condiciones para verificar si existe un registro repetido */
	if($exclude){
		foreach($exclude as $field) {
			if(array_key_exists($field, $data)) {
				$conditions[$field] = $data[$field];
			}
			/* Al final se obtiene un arreglo de condiciones */	
		}
		if($this->modelo_base->any_data($table, $conditions)==false) {
			/* El registro no existe, se agrega */
			$this->db->insert(DB_PREFIX.$table, $data);
			$data['status'] = true;
			$data['message'] = "Se ha agregado el registro correctamente.";
			$data['type'] = "confirm fa-check-circle";
		}
		else {
			$data['status'] = false;
			$data['message'] = "El registro que intentas agregar ya existe.";
			$data['type'] = "warning fa-exclamation-triangle";
		}
	}
	else {	
		$this->db->insert(DB_PREFIX.$table, $data);
		$data['status'] = true;
		$data['message'] = "Se ha agregado el registro correctamente.";
		$data['type'] = "confirm fa-check-circle";
	}
	$data['id'] = $this->db->insert_id();
	return $data;
}
/*
-------------------------------------------------------------------------------------------
Función que agrega campos múltiples a una tabla
-------------------------------------------------------------------------------------------
table:		es el nombre de la tabla  donde se borrará
default:	arreglo asociativo de valores adicionales
fields:		arreglo de los campos múltiples que se agregarán
-------------------------------------------------------------------------------------------
*/
function any_insert_multiple($table, $default, $fields = array()) {
	
	if(count($fields) > 0) {
		$data = array();
		foreach($this->input->post($fields[0]) as $key => $item) {
			if(trim($item)!='') {
				foreach($default as $id => $def) {
					$data[$key][$id] = $def;
				}
				foreach($fields as $field) {
					$temp = $this->input->post($field);
					$data[$key][$field] = $temp[$key];
				}
			}
		}
		if(count($data)>0) $this->db->insert_batch(DB_PREFIX.$table, $data);
		else return false;
	}
	return false;
	
}

/*
-------------------------------------------------------------------------------------------
Función que edita un registro de la tabla
-------------------------------------------------------------------------------------------
table:		es el nombre de la tabla  donde se borrará
extra:		arreglo asociativo de valores adicionales
exclude:	valores que se buscarán para evitar repetición de registros
-------------------------------------------------------------------------------------------
*/
function any_update($table, $data=array(), $conditions=false, $exclude=false) {

	foreach($this->input->post() as $key=>$value) {
		if($key!='submit' 
			&& !is_array($value)
		) {
			$data[$key] = $value;
		}
		/* Al final se tiene el arreglo asociativo que se quiere registrar */
	}
	
	if($conditions) {
		foreach($conditions as $field=>$value) {
			$this->db->where($field, $value);
		}
		$this->db->update(DB_PREFIX.$table, $data);
		$data['status'] = true;
		$data['type'] = "confirm fa-check-circle";
		$data['message'] = 'Se ha editado el registro correctamente.';
	}
	else {
		$data['status'] = 'No se ha podido modificar el registro.';
		$data['type'] = "warning fa-exclamation-triangle";
		$data['message'] = false;
	}
	
	return $data;	
}
/*
-------------------------------------------------------------------------------------------
Función que borra registros de una tabla
-------------------------------------------------------------------------------------------
table:		es el nombre de la tabla  donde se borrará
field:		es el nombre de la columna sobre la cual se buscará
value: 		el valor que se desea encontrar el en campo 'field'
-------------------------------------------------------------------------------------------
*/
function any_delete($table, 
			$conditions) {
	/* Se agregan las condiciones del arreglo asociativo */
	if($conditions) {
		foreach($conditions as $field=>$value) {
			$this->db->where($field, $value);
		}
	}
	$query = $this->db->delete(DB_PREFIX.$table);
	if($query) return true;
	else return false;
}
/* SESIÓN */
/*
-------------------------------------------------------------------------------------------
Función que verifica que se haya iniciado sesión y que se tenga el nivel de acceso correspondiente
-------------------------------------------------------------------------------------------
clearance: 	el nivel de usuario que se verificará
*/
function log_check($clearance=0) {
	
	if($this->session->userdata('usr_logged')==true) {
		if($clearance==0) {
			/* Acceso correcto a un área común */
			$data['status'] = true;
			$data['message'] = "Acceso correcto.";
			$data['type'] = "";
		}
		elseif($this->session->userdata('usr_level')<=$clearance) {
			/* Acceso correcto a un área permitida  */
			$data['status'] = true;
			$data['message'] = "Acceso correcto.";
			$data['type'] = "";
		}
		else {
			/* Acceso denegado a un área no permitida */
			$data['status'] = false;
			$data['message'] = "No tienes acceso a esta sección de la aplicación.";
			$data['type'] = "";
		}
	}
	else {
		$data['status'] = false;
		$data['message'] = "Es necesario que inicies sesión para acceder a la aplicación.";
		$data['type'] = "";
	}
	return $data;
}
/*
-------------------------------------------------------------------------------------------
Función que cumple dos propósitos: inicia una sesión o verifica 
si ya hay una existente
-------------------------------------------------------------------------------------------
table:		es el nombre de la tabla de usuarios del sistema
username:	es el nombre del usuario que se buscará
password:	es la contraseña del usuario
-------------------------------------------------------------------------------------------
*/
function log_in($table, 
				$username=false, 
				$password=false) {	
	if($username && $password) {
		
		/* Verifica que el nombre de usuario es correcto y existe, regresa valores de estado */		
		$ldap_user_data = $this->modelo_base->ldap_user_data($table, $username, $password);		
		if($ldap_user_data['result']==4) {
			$conditions['username'] = $ldap_user_data['userdata'][0]['samaccountname'][0];
			$user_data = $this->modelo_base->any_data($table, $conditions);
			$session_data = array(
				'usr_id' 			=> $user_data->id,
				'usr_level' 		=> $user_data->clearance,
				'usr_username'		=> $user_data->username,
				'usr_fullname'		=> $user_data->fullname,
				'usr_logged'		=> true,
				'usr_status' 		=> $ldap_user_data['status'],
				'usr_result' 		=> $ldap_user_data['result'],
				'usr_message'		=> $ldap_user_data['message'],
				'usr_type'			=> $ldap_user_data['type']
			);			
		}
		else {
			$session_data = array(
				'usr_id' 			=> false,
				'usr_level' 		=> false,
				'usr_username'		=> false,
				'usr_fullname'		=> false,
				'usr_logged'		=> false,
				'usr_status' 		=> $ldap_user_data['status'],
				'usr_result' 		=> $ldap_user_data['result'],
				'usr_message'		=> $ldap_user_data['message'],
				'usr_type'			=> $ldap_user_data['type']
			);
		}		
		$this->session->set_userdata($session_data);
		return $this->session->userdata;
	}
	else {
		/* En caso de que solo se quiera saber el estado de la sesión */
		return $this->session->userdata;
	}
	
}
/*
-------------------------------------------------------------------------------------------
Función que cierra la sesión de un usuario
-------------------------------------------------------------------------------------------
*/
function log_out() {
	$session_data = array(
		'usr_id' 			=> false,
		'usr_level' 		=> false,
		'usr_username'		=> false,
		'usr_fullname'		=> false,
		'usr_logged'		=> false,
		'usr_status' 		=> false,
		'usr_result' 		=> false,
		'usr_message'		=> false
	);
	$this->session->unset_userdata($session_data);
	$this->session->sess_destroy();
}

/* USUARIOS */
/*
-------------------------------------------------------------------------------------------
Función que obtiene la información de un USUARIO o verifica
que su contraseña sea correcta
-------------------------------------------------------------------------------------------
table:		es el nombre de la tabla de usuarios del sistema
username:	es el nombre del usuario que se buscará
password:	es la contraseña del usuario

Posibles resultados:
1. El nombre de usuario es inválido, no existe (false).
2. El nombre de usuario es válido (true).
3. El nombre de usuario es válido y tiene cuenta en el sistema, pero la contraseña es incorrecta (false).
4. El nombre de usuario es válido, la contraseña es correcta y tiene cuenta en el sistema (true).
5. El nombre de usuario es válido y la contraseña es correcta, pero tiene cuenta en el sistema (false).
-------------------------------------------------------------------------------------------
*/
function ldap_user_data($table, $username, $password=false) {
	$username = str_replace('@uanl.mx', '', $username);
	/* Información del usuario extraída del AD */
	$user = @$this->adldap->user_info($username);
	
	/* Se verifica que exista el usuario */
	if($user['count']==0) {
		$data['userdata'] 	= false;
		$data['message'] 	= 'Nombre de cuenta inválido.';
		$data['status'] 	= false;
		$data['result'] 	= 1;
		$data['type']		= 'error fa-times-circle';
	}
	else {
		/* La información del usuario, obtenida del AD */
		$data['userdata'] = $user;
		/* La información del usuario en la base de datos */
		$conditions['username'] = $username;
		$user_data = $this->modelo_base->any_data($table, $conditions);
		
		/* Verifica que tenga cuenta en el sistema */
		if($user_data) {			
			/* Si se proporcionó contraseña, se verifica que sea correcta */
			if($password) {
				$ldap_auth	= $this->adldap->authenticate($username, $password);
				if($ldap_auth) {
					$data['message'] 	= 'Acceso correcto.';
					$data['status'] 	= true;
					$data['result'] 	= 4;
					$data['type']		= 'confirm fa-check-circle';
				}
				else {
					$data['message'] 	= 'Contraseña incorrecta.';
					$data['status'] 	= false;
					$data['result'] 	= 3;
					$data['type']		= 'error fa-times-circle';
				} /* ldap_auth */
			} 
			else {
					$data['message']	= 'El usuario ya existe en el sistema.';
					$data['status'] 	= true;
					$data['result'] 	= 2;
					$data['type']		= 'warning fa-exclamation-triangle';
			} /* password */
		}
		else {		
			$data['message']= 'No tienes acceso al sistema.';
			$data['status'] = false;
			$data['result'] = 5;
			$data['type']	= 'error fa-times-circle';
		} /* user_data */
	}
	return $data;	
}

/* MENU */
/*
-------------------------------------------------------------------------------------------
Función que genera un menú de dos niveles
-------------------------------------------------------------------------------------------

-------------------------------------------------------------------------------------------
*/
function menu($table, $clearance, $level=0, $parent=0, $before=false, $after=false) {
	if($table) {
		
		if($clearance) $this->db->where_in('clearance', array(0, $clearance));
		$this->db->where('parent', $parent);
		$this->db->order_by('order', 'asc');
		$query = $this->db->get(DB_PREFIX.$table);
		
		if($query->num_rows()>0) {
			echo '<ul>';
			foreach($query->result() as $row) {
				/* Verifica si tiene elementos derivados */
				$conditions['parent'] = $row->id;
				$submenu = $this->modelo_base->any_data($table, $conditions);
				echo '<li>';
				echo $before.anchor($row->path, $row->title, 'class="parent level'.$level.' order'.$row->order.'"').$after;
				
				/* Si tiene elementos dependientes, ejecuta nuevamente la función */
				if($submenu) {
					$this->modelo_base->menu($table, $clearance, $level+1, $row->id, $before, $after);
				}
				
				echo '</li>';
			}
			echo '</ul>';
		}
		else {
			return false;
		}
		
	}
	
}

/* UPLOAD */
/*
-------------------------------------------------------------------------------------------

-------------------------------------------------------------------------------------------

-------------------------------------------------------------------------------------------
*/
function any_upload($path='./files/uploads', $types_allowed='pdf|jpg|png', $field='file', $max_size='2048') {
	if(!empty($_FILES[$field]['name'])) {
		$config['upload_path'] = $path;
		$config['max_size']	= $max_size;
		$config['allowed_types'] = $types_allowed;
	
		$this->load->library('upload', $config);
	
		if (!$this->upload->do_upload($field)) {
			$data = array('error' => $this->upload->display_errors());
			$data['status'] = false;
			
		}
		else{
			$data = array('upload_data' => $this->upload->data());
			$data['status'] = true;
		}
		$data['empty'] = false;
	}
	else {
		$data['empty'] = true;
		$data['status'] = true;
	}
	return $data;
}


/*
-------------------------------------------------------------------------------------------
Función que regresa una fecha unix en un formato específico
-------------------------------------------------------------------------------------------
function date_
-------------------------------------------------------------------------------------------
*/
function date_normal($unix, $style="short") {
	
	$day_list = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
	$month_list = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
	$month_list_short = array("Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic");
	
	$day = date('N', $unix)-1;
	$date = date('j', $unix);
	$month = date('n', $unix)-1;
	$year = date('Y', $unix);
	
	switch($style) {
		case 'short':
			$string = "$date $month_list_short[$month] $year";
			break;
		case 'medium':
			$string = "$month_list[$month] $date, $year";
			break;
		case 'long':
			$string = "$day_list[$day] $date de $month_list[$month], $year";
			break;		
	}
	return $string;
	
}

/* QUERY JSON */
/*
-------------------------------------------------------------------------------------------
Función que regresa un query en formato JSON
-------------------------------------------------------------------------------------------

-------------------------------------------------------------------------------------------
*/
function json_list($table,
		$field="name", 
		$value=false, 
		$limit=false, 
		$offset=false, 
		$order=false, 
		$type=false,
		$unique=false) {
	/* Se realiza la búsqueda por campo */
	if($field && $value) $this->db->like($field, $value);
	/* Se realiza el ordenamiento */
	if($order && $type) $this->db->order_by($order, $type);	
	/* Unico */
	if($unique) $this->db->group_by($unique);
	$query = ($limit)? $this->db->get(DB_PREFIX.$table, $limit, $offset) : $this->db->get(DB_PREFIX.$table);
	
	if($query->num_rows()>0) {
		foreach($query->result() as $row) {
			$data[$row->id] = $row->$field;
		}
		return json_encode($data);
	}
	else return false;
}

} /* EOF */
