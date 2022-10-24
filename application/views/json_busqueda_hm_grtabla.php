<!--?php echo form_open("consumo_electricidad/campus_buscar"); ?-->
<html xmlns="http://www.w3.org/1999/xhtml"><!--INICIO HTML Y HEAD PARA IMPRIMIR-->
      <head>
      
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
      
         <script type="text/javascript">//INICIO DEL SCRIPT PARA IMPRIMIR
            function PrintDiv() {    
               var divToPrint = document.getElementById('divToPrint');
               var popupWin = window.open('', '_blank', 'width=650,height=600'); //AQUI SE DEFINE EL ANCHO Y ALTO DE VISTA PREVIA
               popupWin.document.open();
               popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
                popupWin.document.close();
                    }
         </script><!--CIERRE DEL SCRIPT PARA IMPRIMIR-->
       </head><!--CIERRE DEL HEAD PARA IMPRIMIR-->

       <body ><!--INICIO DEL BODY-->

<?php echo form_open(); ?>
<div class="buscador">
	<div>
		<label>Dependencia</label>
	</div>
	<select
			id="dep_tar_hm_final_x_mepo"
			name="dep_tar_hm_final_x_mepo"
			class="form-control"
		>
			<option value="">----</option>
		<?php foreach($catdephmfinal as $item): ?>
			<option value="<?php echo $item->dep_tar_hm_final_x_mepo; ?>"><?php echo $item->cta_tar_hm_final_x_mepo.
			" - ".$item->dep_tar_hm_final_x_mepo; ?></option>
			><?php echo $item->dep_tar_hm_final_x_mepo; ?></option>
		<?php endforeach; ?>
		</select>
</div>
<div class="busqueda_boton">
	<div>
		<button
			name="enviar"
			value="aceptar"
			class="btn"
			type="submit"
		><span class="glyphicon glyphicon-search"></span> Buscar</button>
	</div>
	<div>
		<button
			name="enviar"
			value="volver"
			class="btn"
			type="submit"
		><span class="glyphicon glyphicon-circle-arrow-left"></span> Volver al Inicio</button>
	</div>
	<div>
		<button
			name="enviar"
			value="reloadhmfinal"
			class="btn"
			type="submit"
		><span class="glyphicon glyphicon-retweet"></span> Recargar Datos</button>
	</div>
</div>

<?php echo form_close(); ?>

<div id="divToPrint" > <!--INICIO DEL DIV DONDE IRA TODO EL CONTENIDO QUE SE DESEE IMPRIMIR-->
                   <div style="background-color:white;"><!--DIV PARA COLOCAR EL COLOR DE FONDO-->
<?php
$b = array ('m' => 'monkey', 'foo' => 'bar', 'x' => array ('x', 'y', 'z'));
$results = print_r($b, true); // $results now contains output from print_r
?>


<style>
h1 {
    border-bottom: 3px solid #cc9900;
    color: #996600;
    font-size: 30px;
}
table, th , td  {
    border: 1px solid grey;
    border-collapse: collapse;
    padding: 5px;
}
table tr:nth-child(odd) {
    background-color: #f1f1f1;
}
table tr:nth-child(even) {
    background-color: #ffffff;
}
</style>
</head>
<body>

<h2>Customers</h2>
<div id="id01"></div>

<script>
var xmlhttp = new XMLHttpRequest();
var url = "http://localhost:8080/PanelControlDTI/trunk/application/views/search_jsontablahm.php";

xmlhttp.onreadystatechange=function() {
    if (this.readyState == 4 && this.status == 200) {
        myFunction(this.responseText);
    }
}
xmlhttp.open("GET", url, true);
xmlhttp.send();

function myFunction(response) {
    var arr = JSON.parse(response);
    var i;
    var out = "<table>";

    for(i = 0; i < arr.length; i++) {
        out += "<tr><td>" + 
        arr[i].Fecha +
        "</td><td>" +
        arr[i].Enero +
        "</td><td>" +
        arr[i].Febrero +
        "</td><td>" +
        arr[i].Marzo +
        "</td><td>" +
        arr[i].Abril +
        "</td><td>" +
        arr[i].Mayo +
        "</td><td>" +
        arr[i].Junio +
        "</td><td>" +
        arr[i].Julio +
        "</td><td>" +
        arr[i].Agosto +
        "</td><td>" +
        arr[i].Septiembre +
        "</td><td>" +
        arr[i].Octubre +
        "</td><td>" +
        arr[i].Noviembre +
        "</td><td>" +
        arr[i].Diciembre +
        "</td><td>" +
        arr[i].NIS +
        "</td><td>" +
        arr[i].Dependencia +
        "</td></tr>";
    }
    out += "</table>";
    document.getElementById("id01").innerHTML = out;
}
</script>




<div class="table-responsive">
	<div id="chart"></div>
	<table id="data" class="table table-condensed table-bordered table-hover">
		<thead>
			<tr>
				<th>Date</th>
				<th>Dependencia</th>
				<th>NIS</th>
				<th>Enero</th>
				<th>Febrero</th>
				<th>Marzo</th>
				<th>Abril</th>
				<th>Mayo</th>
				<th>Junio</th>
				<th>Julio</th>
				<th>Agosto</th>
				<th>Septiembre</th>
				<th>Octubre</th>
				<th>Noviembre</th>
				<th>Diciembre</th>
			</tr>
		</thead>

		<tbody>
		<?php if($resdephmfinal1): ?>
			<?php foreach($resdephmfinal1 as $item): ?>
			<tr>
				<td><?php echo $item->yer_tar_hm_final_x_mepo; ?></td>
				<td><?php echo $item->dep_tar_hm_final_x_mepo; ?></td>
				<td><?php echo $item->cta_tar_hm_final_x_mepo; ?></td>
				<td><?php echo number_format($item->Enero); ?></td>
				<td><?php echo number_format($item->Febrero); ?></td>
				<td><?php echo number_format($item->Marzo); ?></td>
				<td><?php echo number_format($item->Abril); ?></td>
				<td><?php echo number_format($item->Mayo); ?></td>
				<td><?php echo number_format($item->Junio); ?></td>
				<td><?php echo number_format($item->Julio); ?></td>
				<td><?php echo number_format($item->Agosto); ?></td>
				<td><?php echo number_format($item->Septiembre); ?></td>
				<td><?php echo number_format($item->Octubre); ?></td>
				<td><?php echo number_format($item->Noviembre); ?></td>
				<td><?php echo number_format($item->Diciembre); ?></td>
			</tr>
			<?php endforeach; ?>
			<tr class="active">
				<td>Total KwH</td>
				<td></td>
				<td></td>
				<td class="text-right"><b><?php echo number_format($EneroTotalHM);?></b></td>
				<td class="text-right"><b><?php echo number_format($FebreroTotalHM);?></b></td>
				<td class="text-right"><b><?php echo number_format($MarzoTotalHM);?></b></td>
				<td class="text-right"><b><?php echo number_format($AbrilTotalHM);?></b></td>
				<td class="text-right"><b><?php echo number_format($MayoTotalHM);?></b></td>
				<td class="text-right"><b><?php echo number_format($JunioTotalHM);?></b></td>
				<td class="text-right"><b><?php echo number_format($JulioTotalHM);?></b></td>
				<td class="text-right"><b><?php echo number_format($AgostoTotalHM);?></b></td>
				<td class="text-right"><b><?php echo number_format($SeptiembreTotalHM);?></b></td>
				<td class="text-right"><b><?php echo number_format($OctubreTotalHM);?></b></td>
				<td class="text-right"><b><?php echo number_format($NoviembreTotalHM);?></b></td>
				<td class="text-right"><b><?php echo number_format($DiciembreTotalHM);?></b></td>
			</tr>
		<?php else: ?>
			<tr>
				<td colspan=10>Favor de seleccionar la dependencia a consultar.</td>
			</tr>
		<?php endif; ?>
		</tbody>

	</table>

	<script type="text/javascript">
$(function() {
$('#chart').highchartsMaker($('#data'), {
	"title": "Test Gráfica",
	"yAxis":{"min":0},
	//31557600000
	"date_interval":31557600000,
	});
});
</script>
</div> <!-- table-responsive -->


</div><!--CIERRE DEL DIV PARA COLOR DE FONDO-->

                </div><!--CIERRE DEL DIV PARA IMPRIMIR-->
                <script src="<?php echo base_url(); ?>assets/js/highcharts.js"></script>
				<script src="<?php echo base_url(); ?>assets/js//modules/exporting.js"></script>
				<script src="<?php echo base_url(); ?>assets/js/jquery.highchartsmaker.js"></script>

<div class="center">
	<ul class="pagination pagination-lg">
	<?php echo $this->pagination->create_links(); ?>
	</ul>
</div>

<div><!--INICIO DEL BOTON PARA EJECUTAR LA IMPRESIÓN-->
                    <input type="button" value="Imprimir" onclick="PrintDiv();" />
                </div><!--CIERRE DEL BOTON DE IMPRESIÓN-->



            </body> <!--FIN DEL BODY-->
    </html><!--CIERRE DEL HTML-->