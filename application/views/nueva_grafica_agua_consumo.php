<!--?php echo form_open("consumo_electricidad/campus_buscar"); ?-->
<html xmlns="http://www.w3.org/1999/xhtml"><!--INICIO HTML Y HEAD PARA IMPRIMIR-->
      <head>
      
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
      <script src="https://code.jquery.com/jquery-3.3.1.min.map"></script>
	  <script type="text/javascript" src="https://code.highcharts.com/stock/highstock.js"></script>
	  <script src = "https://code.highcharts.com/modules/exporting.js"></script>
      <script src = "https://code.highcharts.com/modules/data.js"></script>

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
			id="dependencia"
			name="dependencia"
			class="form-control"
		>
			<option value="">----</option>
		<?php foreach($servicios as $item): ?>
			<option value="<?php echo $item->id; ?>"
			<?php if($dependencia) echo ($item->id==$dependencia)?
			'selected' : ''; ?>>
			<?php echo $item->cuenta." - ".$item->dependencia; ?>
			</option>
		<?php endforeach; ?>
		</select>
</div>

<div class="buscador">
	<div>
		<label>Año</label>
	</div>
	<select name="year">
		<option value="">----</option>
		<?php for($a=2011; $a<=date('Y'); $a++): ?>
			<option value="<?php echo $a; ?>" <?php if(isset($year) && $year==$a) echo "selected"?>><?php echo $a; ?></option>
		<?php endfor; ?>
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
	<?php if($recibos): ?>
	<?php foreach($servicios as $item): ?>
				<?php if($item->id==$dependencia):?>
				<h3>
					<?php echo $item->dependencia; ?>
				</h3>
				<?php endif; ?>
	<?php endforeach; ?>
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
                  text: 'Consumo m3'
              },
              labels: {
                format: '{value:,.0f}',
                valuesuffix: '',
                shared: true
            
        },
            };
            var date = {
            	interval: '31557600000'
            };
            var tooltip = {
               formatter: function () {
               	return '<b>' + this.series.name + '</b><br/>' +
                     this.point.y;
               }
            };
            var credits = {
               enabled: true
            };
			var exporting =
            {
               /*sourceWidth: 1920,
               sourceHeight: 1080,*/
			   sourceWidth: 1366,
               sourceHeight: 768,
               scale: 1, 
                  chartOptions:
                  {
                     chart:
                     {
                        height: this.chartHeight
                     }
                  }
            };
			var series = [
               {
                  dataLabels: { //SIRVE PARA MOSTRAR Y DAR FORMATO A LOS DATOS FLOTANTES DE LAS COLUMNAS DE LA GRÁFICA 
                     enabled: true,
                     //rotation: -90,
                     color: '#000000',
                     align: 'center',
                     format: '{point.y:,.0f}', // SIRVE PARA MODIFICAR EL FORMATO DEL NUMERO A MOSTRAR https://www.highcharts.com/docs/chart-concepts/labels-and-string-formatting
                     y: 2, // 10 pixels down from the top
                     
                     style: {
                        fontSize: '10px', //FONT SIZE
                        fontFamily: 'Verdana, sans-serif'
                     }
                  }//, //SE DEFINE EL COLOR DE LA COLUMNA DEPENDIENDO DE LA CANTIDAD MAXIMA ASIGNADA
				  //zones: [{
            //value:90000,
            //color: '#ff0000'  
        //}//]//
               }
            ];
            var json = {};
            json.chart = chart;
            json.title = title;
            json.data = data;
            json.yAxis = yAxis;
            json.credits = credits;
			json.exporting = exporting;
			json.series = series;
            json.tooltip = tooltip;

			json.colors= ['#BCE02F', '#BCE02F',
			'#BCE02F', '#BCE02F',
			'#BCE02F', '#BCE02F',
			'#BCE02F', '#BCE02F',
			'#BCE02F', '#BCE02F',
			'#BCE02F', '#BCE02F'
			];
            $('#container').highcharts(json);
         });
      </script>

<table id="datatables" class="table table-condensed table-bordered table-hover" style="display: none;">
		<thead>
			<tr>
				<th>Year</th>
				<th>Consumo m3</th>
			</tr>
		</thead>

		<tbody>
			<!--FUNCION PARA EL ARRAY QUE CAMBIA EL NUMERO A NOMBRE DEL MES-->
			<?php
			function obtenumeroames($meses_arr){
				$resultado = "";

				switch ($meses_arr){
					case 1:
						$resultado = "Enero";
						break;
					case 2:
						$resultado = "Febrero";
						break;
					case 3:
						$resultado = "Marzo";
						break;
					case 4:
						$resultado = "Abril";
						break;
					case 5:
						$resultado = "Mayo";
						break;
					case 6:
						$resultado = "Junio";
						break;
					case 7:
						$resultado = "Julio";
						break;
					case 8:
						$resultado = "Agosto";
						break;
					case 9:
						$resultado = "Septiembre";
						break;
					case 10:
						$resultado = "Octubre";
						break;
					case 11:
						$resultado = "Noviembre";
						break;
					case 12:
						$resultado = "Diciembre";
						break;
				}
				return $resultado;
			}
			?>
			<!--FIN-->
			<!--INICIO DEL IF/FOREACH PARA GENERAR LOS DATOS DE LA TABLA QUE CARGA LA GRAFICA
				VA OCULTA-->
			<?php if($recibos): ?>
				<?php foreach($recibos as $item): ?>
			<tr>
				<td>
					<?php 
					$fulldate=$item->periodo_fin; $monthNum = substr($fulldate, 5,-3);

					$monthName = obtenumeroames($monthNum);

					echo $monthName;
					?>
					
				</td>
				<td><?php echo number_format($item->consumo, 0, "", " "); ?></td>
			</tr>
			<?php endforeach; ?>
		<?php else: ?>
			<!--FIN-->
			<tr>
				<td colspan=10>Favor de seleccionar la dependencia y año a consultar.</td>
			</tr>
		<?php endif; ?>
		</tbody>

	</table>
<!--COMIENZO DE LA TABLA DE DATOS CON COMMMAS-->

<table id="" class="table table-condensed  table-hover">
		<thead>
			<tr>
				<th class="text-center">Fecha</th>
				<th class="text-center">Consumo</th>
			</tr>
		</thead>

		<tbody>
		<?php if($recibos): ?>
			<?php foreach($recibos as $item): ?>
			<tr>
				<td class="text-center"><?php echo $item->periodo_fin; ?></td>
				<td class="text-center"><b><?php echo number_format($item->consumo); ?> m3</b></td>
			</tr>
			<?php endforeach; ?>
		<?php else: ?>
			<tr>
				<td colspan=10>Favor de seleccionar la dependencia y año a consultar.</td>
			</tr>
		<?php endif; ?>
		</tbody>

	</table>
</body>
</html>