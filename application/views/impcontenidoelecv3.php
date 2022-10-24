<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
// Guardamos el contenido de contenido.php en la variable html
ob_start();
require "consultaconcoselecxdepev3.php";
$html = ob_get_clean();
// Jalamos las librerias de dompdf
require_once ("application/libraries/dompdf/autoload.inc.php");
//require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;
// Inicializamos dompdf
$dompdf = new Dompdf();
// Le pasamos el html a dompdf
$dompdf->loadHtml($html);
// Colocamos als propiedades de la hoja
$dompdf->setPaper("A4", "landscape");
// Escribimos el html en el PDF
$dompdf->render();
// Ponemos el PDF en el browser
$dompdf->stream();
?>