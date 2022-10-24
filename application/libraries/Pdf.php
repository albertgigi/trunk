<?php
//EXISTE UNA DIFERENCIA AL DECLARAR CON MAYUSCULAS EL 'BASEPATH'
//Y CON MINUSCULAS 'basepath'
//if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//if ( ! defined('basepath')) exit('No direct script access allowed');
//if ( ! defined('basepath')) exit('No redirect');
//require_once 'dompdf/autoload.inc.php';
defined('BASEPATH') OR exit('No direct script access allowed');
require_once ("application/libraries/dompdf/autoload.inc.php");

use Dompdf\Dompdf;


/**
*
**/

Class Pdf extends Dompdf
{

    function __construct()
    {
        parent ::__construct();

    }

}

?>