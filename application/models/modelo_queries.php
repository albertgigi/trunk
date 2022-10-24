<?php
Class Modelo_queries Extends CI_Model {
	
/*
-------------------------------------------------------------------------------------------
Función que genera un LISTADO de cualquier tabla
------------------------------------------------------------------------------------------
table:			es el nombre de la tabla que se consultará
conditions: 	arreglo asociativo de campos y valores de condición
limit:			limite de registros de la consulta (opcional)
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
	
	$query = ($limit)? $this->db->get($table, $limit, $offset) : $this->db->get($table);	
	
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
	$query = $this->db->get($table, 1);
	if($query && $query->num_rows()==1) {
		$data = $query->row();
		return $data;
	}
	else return false;
}

}
