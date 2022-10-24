<?php 
Class Modelo_login2 Extends CI_Model {

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
		$ldap_user_data = $this->modelo_login->ldap_user_data($table, $username, $password);
		//print_r($ldap_user_data);
		/* El estado 4 es el único válido */	
		if($ldap_user_data['status']==4) {
			
			$conditions['usuario'] = $ldap_user_data['userdata'][0]['samaccountname'][0];			
			$user_data = $this->modelo_queries->any_data($table, $conditions);
			
			$_SESSION['sess']['id']			= $user_data->id;
			$_SESSION['sess']['level'] 		= $user_data->nivel;
			$_SESSION['sess']['username']	= $user_data->usuario;
			$_SESSION['sess']['fullname']	= $user_data->nombre;
			$_SESSION['sess']['logged']		= true;
			$_SESSION['sess']['status']		= $ldap_user_data['status'];
			$_SESSION['sess']['message']	= $ldap_user_data['message'];
		}
		else {
			return $ldap_user_data['status'];
			/*$_SESSION['sess']['id']			= 
			$_SESSION['sess']['level'] 		= 
			$_SESSION['sess']['username']	= 
			$_SESSION['sess']['fullname']	=
			$_SESSION['sess']['logged']		= false;
			$_SESSION['sess']['status']		= $ldap_user_data['status'];
			$_SESSION['sess']['message']	= $ldap_user_data['message'];*/
		}		
	}
	else {
		/* En caso de que solo se quiera saber el estado de la sesión */
	}
	
}
/*
-------------------------------------------------------------------------------------------
Función que cierra la sesión de un usuario
-------------------------------------------------------------------------------------------
*/
function log_out() {
	session_destroy();
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
5. El nombre de usuario es válido y la contraseña es correcta, pero no tiene cuenta en el sistema (false).
-------------------------------------------------------------------------------------------
*/
function ldap_user_data($table, $username, $password) {
	$username = str_replace('@uanl.mx', '', $username);
	
	 
	//* Información del usuario extraída del AD */
	$user = @$this->adldap->user_info($username);
	$data['user'] = $user;
	/* Se verifica que exista el usuario */
	if($user['count']==0) {
		$data['userdata'] 	= false;
		$data['message'] 	= 'Nombre de cuenta inválido.';
		$data['status'] 	= 1;
		$data['type']		= 'error fa-times-circle';
	}
	else {
		/* La información del usuario, obtenida del AD */
		$data['userdata'] = $user;
		/* La información del usuario en la base de datos */
		$conditions['usuario'] = $username;
		$user_data = $this->modelo_queries->any_data($table, $conditions);
		
		/* Verifica que tenga cuenta en el sistema */
		if($user_data) {			
			/* Si se proporcionó contraseña, se verifica que sea correcta */
			if($password) {
				$ldap_auth	= $this->adldap->authenticate($username, $password);
				if($ldap_auth) {
					$data['message'] 	= 'Acceso correcto.';
					$data['status'] 	= 4;
					$data['type']		= 'confirm fa-check-circle';
				}
				else {
					$data['message'] 	= 'Contraseña incorrecta.';
					$data['status'] 	= 3;
					$data['type']		= 'error fa-times-circle';
				} /* ldap_auth */
			} 
			else {
					$data['message']	= 'El usuario ya existe en el sistema.';
					$data['status'] 	= 2;
					$data['type']		= 'warning fa-exclamation-triangle';
			} /* password */
		}
		else {		
			$data['message']= 'No tienes acceso al sistema.';
			$data['status'] = 5;
			$data['type']	= 'error fa-times-circle';
		} /* user_data */
	}
	return $data;	
}

}