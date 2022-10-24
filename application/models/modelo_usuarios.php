<?php
Class Modelo_usuarios Extends CI_Model {
	

function catalogo() {
	$query = $this->db->get('pdc_usuarios');
	if($query->num_rows()>0) {
		foreach($query->result() as $row) {
			$usuarios[$row->id] = $row;		
		}
		return $usuarios;
	}
	else return false;
}	
	
	
function usuario($id) {
	$this->db->where('id', $id);
	$query = $this->db->get("pdc_usuarios");
	return $query->row();
}
	
}
