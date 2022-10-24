<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//require_once 'dompdf/autoload.inc.php';
require_once ("application/library/dompdf/autoload.inc.php");

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