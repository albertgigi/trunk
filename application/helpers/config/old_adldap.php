<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['account_suffix']			= '@uanl.red';
$config['base_dn']					= 'DC=uanl,DC=red';
$config['domain_controllers']	= array ("uanl.red");
$config['ad_username']			= 'premios';
$config['ad_password']			= 'PT23dgi';
$config['real_primarygroup']		= true;
$config['use_ssl']					= false;
$config['use_tls'] 					= false;
$config['recursive_groups']		= true;

/* End of file adldap.php */
/* Location: ./system/application/config/adldap.php */