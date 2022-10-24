<!--?php echo form_open("consumo_electricidad/campus_buscar"); ?-->
<html xmlns="http://www.w3.org/1999/xhtml"><!--INICIO HTML Y HEAD PARA IMPRIMIR-->
      <head>
      
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
      <script src="https://code.jquery.com/jquery-3.3.1.min.map"></script>
	  <script type="text/javascript" src="https://code.highcharts.com/stock/highstock.js"></script>
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
	<?php if($recibos): ?>
	<?php foreach($servicios as $item): ?>
				<?php if($item->id==$dependencia):?>
				<h3>Recibos de
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
            json.lang = {
            	months: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
            	'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre']
            };
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

<table id="datatables" class="table table-condensed table-bordered table-hover" style="display: block;">
		<thead>
			<tr>
				<th>Year</th>
				<th>Consumo</th>
			</tr>
		</thead>

		<tbody>
			<?php if($recibos): ?>
				<?php foreach($recibos as $item): ?>
			<tr>
				<td><?php setlocale(LC_TIME, 'es_ES', 'esp_esp'); $fulldate=$item->periodo_fin; $monthNum= substr($fulldate, 5,-3); 
				$monthName = date("F", mktime(0, 0, 0, $monthNum, 10)); echo $monthName; ?></td>
				<td><?php echo number_format($item->consumo, 0, "", " "); ?></td>
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
				<th class="text-center">Consumo</th>
			</tr>
		</thead>

		<tbody>
		<?php if($recibos): ?>
			<?php foreach($recibos as $item): ?>
			<tr>
				<td><?php echo $item->periodo_fin; ?></td>
				<td class="text-right"><b><?php echo number_format($item->consumo); ?></b></td>
			</tr>
			<?php endforeach; ?>
		<?php else: ?>
			<tr>
				<td colspan=10>Favor de seleccionar la dependencia a consultar.</td>
			</tr>
		<?php endif; ?>
		</tbody>

	</table>
</body>
</html>