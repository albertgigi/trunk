<?php setlocale(LC_ALL, 'es_MX');    ?>
<?php 
$dias_arr = array(0=>"Domingo",1=>"Lunes",2=>"Martes",3=>"Miércoles",4=>"Jueves",5=>"Viernes",6=>"Sábado");
$meses_arr = array(1=>"Enero", 2=>"Febrero", 3=>"Marzo", 4=>"Abril", 5=>"Mayo", 6=>"Junio", 7=>"Julio", 8=>"Agosto", 9=>"Septiembre", 10=>"Octubre", 11=>"Noviembre", 12=>"Diciembre");

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    

    <title>Panel de Control</title>
    <!--CSS-->

    <!--link rel="shortcut icon" href="images/ico/favicon.ico"-->
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel='stylesheet' type='text/css'>
    <link href="<?php echo base_url(); ?>assets/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="<?php echo base_url(); ?>assets/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="<?php echo base_url(); ?>assets/css/jquery-ui.min.css" rel="stylesheet" type="text/css">

    <link href="<?php echo base_url(); ?>assets/css/avgrund.css" rel='stylesheet' type='text/css'>
    <link href="<?php echo base_url(); ?>assets/css/prettyPhoto.css" rel='stylesheet' type='text/css'>

    <link href="<?php echo base_url(); ?>assets/css/main.css" rel='stylesheet' type='text/css'>
    <link href="<?php echo base_url(); ?>assets/css/style.css" rel='stylesheet' type='text/css'>
	<link href="<?php echo base_url(); ?>assets/css/colornombres.css" rel='stylesheet' type='text/css'>
    


    <script src="<?php echo base_url(); ?>assets/js/jquery.min.js" charset="UTF-8"></script>

    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->

    <!--JAVASCRIPT, JQUERY, JSON ANTERIORMENTE ESTABAN EN EL foot.php Interesante...-->
    <!--script src="<-?php echo base_url(); ?>assets/js/jquery.js"></script-->
    <!--src="assets/js/jq-->
    <!--src="assets/js/jquery-3.3.1.js"-->
    <!--src="assets/js/jquery-3.3.1.min.map"-->
    <script src="<?php echo base_url(); ?>assets/js/main.js" charset="UTF-8"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery-3.1.1.js" charset="UTF-8"></script>
    <link href="<?php echo base_url(); ?>js/jquery-3.3.1.min.map" charset="UTF-8"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery-ui.min.js" charset="UTF-8"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js" charset="UTF-8"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.isotope.min.js" charset="UTF-8"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.prettyPhoto.js" charset="UTF-8"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.avgrund.min.js" charset="UTF-8"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js" charset="UTF-8"></script>
    

</head><!--/head-->
<body data-spy="scroll" data-target="#navbar" data-offset="0">
