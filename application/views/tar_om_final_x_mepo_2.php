<!--?php echo form_open("consumo_electricidad/campus_buscar"); ?-->
<html xmlns="http://www.w3.org/1999/xhtml"><!--INICIO HTML Y HEAD PARA IMPRIMIR-->
      <head>
      
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
      <script src="https://code.jquery.com/jquery-3.3.1.min.map"></script>
      <!--script src="<php echo base_url(); ?>assets/js/highcharts.js"></script-->
	  <script type="text/javascript" src="https://code.highcharts.com/stock/highstock.js"></script>
      <script src = "https://code.highcharts.com/modules/data.js"></script>
	  <!--script src="?php echo base_url(); ?>assets/js/modules/exporting.js"></script-->
	  <script src="https://code.highcharts.com/modules/exporting.js"></script>
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
			id="dep_tar_om_final_x_mepo"
			name="dep_tar_om_final_x_mepo"
			class="form-control"
		>
			<option value="">----</option>
		<?php foreach($catdepomfinal as $item): ?>
			<option value="<?php echo $item->dep_tar_om_final_x_mepo; ?>"><?php echo $item->cta_tar_om_final_x_mepo.
			" - ".$item->dep_tar_om_final_x_mepo; ?></option>
			><?php echo $item->dep_tar_om_final_x_mepo; ?></option>
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
			value="reloadomfinal"
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





</div> <!-- table-responsive -->


</div><!--CIERRE DEL DIV PARA COLOR DE FONDO-->

                </div><!--CIERRE DEL DIV PARA IMPRIMIR-->

<div class="center">
	<ul class="pagination pagination-lg">
	<?php echo $this->pagination->create_links(); ?>
	</ul>
</div>
<div>
		<h3>
	<?php if($resdepomfinal1): ?>
		<?php foreach($resdepomfinal1 as $item): ?>
			<tr>
				<td><?php echo $item->dep_tar_om_final_x_mepo;
				break; ?>

			</tr>
			<?php endforeach; ?>
		<?php else: ?>
			<tr>
				<td colspan=10></td>
			</tr>
		<?php endif; ?>
		</h3>
</div>

	<div id = "container" style = "width:100%; height: 400px; margin: 0 auto"></div>
      <script language = "JavaScript">
      	$(document).ready(function() {
      	
            var data = {
               table: 'datatables'
            };
            var chart = {
               type: 'column'
            };
            var title = {
               text: ''   
            };
            var yAxis = {
               allowDecimals: false,
               title: {
                  text: 'Consumo KwH'
              },
              labels: {
                format: '{value:,.0f}',
                valuesuffix: '',
                shared: true
            
        },
            };
            var tooltip = {
               formatter: function () {
               	return '<b>' + this.series.name + '</b><br/>' +
                     this.point.y;
               }
            };
            var credits = {
               enabled: false
            };  
            var json = {};
            json.chart = chart;
            json.title = title;
            json.data = data;
            json.yAxis = yAxis;
            json.credits = credits;
            json.tooltip = tooltip;
			json.scrollbar = {
            	enabled: true,
            	barBackgroundColor: 'cyan',
            	barBorderRadius: 7,
            	barBorderWidth: 0,
            	buttonBackgroundColor: 'white',
            	buttonBorderWidth: 0,
            	buttonBorderRadius: 7,
            	trackBackgroundColor: 'white',
            	trackBorderWidth: 1,
            	trackBorderRadius: 8,
            	trackBorderColor: '#CCC',
            	rifleColor: 'black',
            	buttonArrowColor: 'black',
				};
			json.colors= ['#7CB5EC', '#434348',
			'#90ED7D', '#F7A35C',
			'#8085E9', '#F15C80',
			'#E4D354', '#CD0000',
			'#F45B5B', '#91E8E1',
			'#7D26CD', '#104E8B'
			];
            $('#container').highcharts(json);
         });
      </script>

<table id="datatables" class="table table-condensed table-bordered table-hover" style="display: none;">
		<thead>
			<tr>
				<th>Year</th>
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
			<?php if($resdepomfinal1): ?>
				<?php foreach($resdepomfinal1 as $item): ?>
			<tr>
				<td><?php echo $item->yer_tar_om_final_x_mepo; ?></td>
				<td><?php echo number_format($item->Enero, 0, "", " "); ?></td>
				<td><?php echo number_format($item->Febrero, 0, "", " "); ?></td>
				<td><?php echo number_format($item->Marzo, 0, "", " "); ?></td>
				<td><?php echo number_format($item->Abril, 0, "", " "); ?></td>
				<td><?php echo number_format($item->Mayo, 0, "", " "); ?></td>
				<td><?php echo number_format($item->Junio, 0, "", " "); ?></td>
				<td><?php echo number_format($item->Julio, 0, "", " "); ?></td>
				<td><?php echo number_format($item->Agosto, 0, "", " "); ?></td>
				<td><?php echo number_format($item->Septiembre, 0, "", " "); ?></td>
				<td><?php echo number_format($item->Octubre, 0, "", " "); ?></td>
				<td><?php echo number_format($item->Noviembre, 0, "", " "); ?></td>
				<td><?php echo number_format($item->Diciembre, 0, "", " "); ?></td>
			</tr>
			<?php endforeach; ?>
		<?php else: ?>
			<tr>
				<td colspan=10>Favor de seleccionar la dependencia a consultar.</td>
			</tr>
		<?php endif; ?>
		</tbody>

	</table>
<!--COMIENZO DE LA TABLA DE DATOS CON COMMMAS-->

<table id="" class="table table-condensed table-bordered table-hover">
		<thead>
			<tr>
				<th>Año</th>
				<th class="text-center">Enero</th>
				<th class="text-center">Febrero</th>
				<th class="text-center">Marzo</th>
				<th class="text-center">Abril</th>
				<th class="text-center">Mayo</th>
				<th class="text-center">Junio</th>
				<th class="text-center">Julio</th>
				<th class="text-center">Agosto</th>
				<th class="text-center">Septiembre</th>
				<th class="text-center">Octubre</th>
				<th class="text-center">Noviembre</th>
				<th class="text-center">Diciembre</th>
			</tr>
		</thead>

		<tbody>
		<?php if($resdepomfinal1): ?>
			<?php foreach($resdepomfinal1 as $item): ?>
			<tr>
				<td><?php echo $item->yer_tar_om_final_x_mepo; ?></td>
				<td class="text-right"><b><?php echo number_format($item->Enero); ?></b></td>
				<td class="text-right"><b><?php echo number_format($item->Febrero); ?></b></td>
				<td class="text-right"><b><?php echo number_format($item->Marzo); ?></b></td>
				<td class="text-right"><b><?php echo number_format($item->Abril); ?></b></td>
				<td class="text-right"><b><?php echo number_format($item->Mayo); ?></b></td>
				<td class="text-right"><b><?php echo number_format($item->Junio); ?></b></td>
				<td class="text-right"><b><?php echo number_format($item->Julio); ?></b></td>
				<td class="text-right"><b><?php echo number_format($item->Agosto); ?></b></td>
				<td class="text-right"><b><?php echo number_format($item->Septiembre); ?></b></td>
				<td class="text-right"><b><?php echo number_format($item->Octubre); ?></b></td>
				<td class="text-right"><b><?php echo number_format($item->Noviembre); ?></b></td>
				<td class="text-right"><b><?php echo number_format($item->Diciembre); ?></b></td>
			</tr>
			<?php endforeach; ?>
			<tr class="active">
				<td><b>Total</b></td>
				<td class="text-right"><b><?php echo number_format($EneroTotalOM);?></b></td>
				<td class="text-right"><b><?php echo number_format($FebreroTotalOM);?></b></td>
				<td class="text-right"><b><?php echo number_format($MarzoTotalOM);?></b></td>
				<td class="text-right"><b><?php echo number_format($AbrilTotalOM);?></b></td>
				<td class="text-right"><b><?php echo number_format($MayoTotalOM);?></b></td>
				<td class="text-right"><b><?php echo number_format($JunioTotalOM);?></b></td>
				<td class="text-right"><b><?php echo number_format($JulioTotalOM);?></b></td>
				<td class="text-right"><b><?php echo number_format($AgostoTotalOM);?></b></td>
				<td class="text-right"><b><?php echo number_format($SeptiembreTotalOM);?></b></td>
				<td class="text-right"><b><?php echo number_format($OctubreTotalOM);?></b></td>
				<td class="text-right"><b><?php echo number_format($NoviembreTotalOM);?></b></td>
				<td class="text-right"><b><?php echo number_format($DiciembreTotalOM);?></b></td>
			</tr>
		<?php else: ?>
			<tr>
				<td colspan=10>Favor de seleccionar la dependencia a consultar.</td>
			</tr>
		<?php endif; ?>
		</tbody>

	</table>
</body>
</html>