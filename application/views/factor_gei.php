    <html xmlns="http://www.w3.org/1999/xhtml">
      <head>
         <script type="text/javascript">     
            function PrintDiv() {    
               var divToPrint = document.getElementById('divToPrint');
               var popupWin = window.open('', '_blank', 'width=640,height=750');
               popupWin.document.open();
               popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
                popupWin.document.close();
                    }
         </script>
       </head>


<!--?php echo form_open("consumo_gas/factor_gei"); ?>-->
<?php echo form_open("control_factor_gei/creargei"); ?>

<div class="row">
	<div class="col-md-4 text-right">
		<label for="total_alumnos">Año</label>
	</div>

	<div class="col-md-6">
		<div class="input-group">
		<input id="theyear" name="theyear" class="form-control" type="text">
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-4 text-right">
		<label for="total_alumnos">Población Total</label>
	</div>

	<div class="col-md-6">
		<div class="input-group">
		<input id="cantidad_alumnos" name="cantidad_alumnos" class="form-control" type="text">
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-4 text-right">
		<label for="emisionesa">Factor GEI Agua</label>
	</div>

	<div class="col-md-6">
		<div class="input-group">
			<input id="emisionesa" name="emisionesa" class="form-control" type="text">
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-4 text-right">
		<label for="emisiones">Factor GEI Electricidad</label>
</div>

	<div class="col-md-6">
		<div class="input-group">
			<input id="emisiones" name="emisiones" class="form-control" type="text">
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-4 text-right">
			<label for="emisionesg">Factor GEI Gas</label>
	</div>

	<div class="col-md-6">
		<div class="input-group">
			<input id="emisionesg" name="emisionesg" class="form-control" type="text">
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-4 text-right">
			<label for="temperatura">Temperatura</label>
	</div>
	<div class="col-md-6">
		<div class="input-group">
		<input id="temperatura" name="temperatura" class="form-control" type="text">
		</div>
	</div>
</div>


<div class="row">
<script type="text/javascript">
	$(function ()
	{
		$('#cancelargei').click(function () {
			$('input[type=text]').each(function () {
				$(this).val('');
			})
		})
	})
	</script>
	<!--div class="busqueda_boton">
	<div>
		<button
			name="enviar"
			value="load_gdata"
			class="btn"
			type="submit"
		><span class="glyphicon glyphicon-search"></span> Graficas GEI Electricidad</button>
	</div-->
	<div class="col-md-6 pull-right">
	<button name="cancelargei" id="cancelargei" class="btn" type="button">
	<span class="glyphicon glyphicon-remove"></span> Cancelar</button>
	</div>
	<div>
	<div class="col-md-6 text-right">
	<button name="enviar" value="repetirgei" class="btn" type="submit">
	<!--button ?php echo form_submit('enviar', 'repetirgei', 'class="btn"'); ?>-->
	<span class="glyphicon glyphicon-floppy-disk"></span> Guardar y Capturar otro </button>
	</div>
</div>

<?php echo form_close(); ?>
<body> <!--to be replaced or not-->

<div id="divToPrint" >
                   <div style="background-color:white;">


<div class="table-responsive">
	<table class="table table-bordered table-hover">
		<thead>
			<tr>
				<th>Año</th>
				<th>Población Total</th>
				<th>GEI Agua</th>
				<th>GEI Electricidad</th>
				<th>GEI Gas</th>
				<th>Temperatura Promedio</th>
				<th>Acciones</th>
			</tr>
		</thead>
		<tbody>
		<?php if($mostrardatos): ?>
			<?php foreach($mostrardatos as $item): ?>
			<tr>
				<td><?php echo $item['show_years']; ?></td>
				<td><?php echo $item['show_alumnos']; ?></td>
				<td><?php echo $item['show_emisionesa']; ?></td>
				<td><?php echo $item['show_emisiones']; ?></td>
				<td><?php echo $item['show_emisionesg']; ?></td>
				<td><?php echo $item['show_temperatura']; ?> °C</td>
				<td>
					<?php echo anchor('control_factor_gei/form_actualizar_gei/'.$item['show_id'], '<span class="icon-edit"></span> Editar', 'class="edit"'); ?>
					<br>
					<?php echo anchor('control_factor_gei/boton_borrar_gei/'.$item['show_id'], '<span class="icon-trash"></span> Borrar', 'class="delete"'); ?>
				</td>
			</tr>
			<?php endforeach; ?>
		<?php endif; ?>
		</tbody>

	</table>
</div> <!-- table-responsive -->

 			</div>
 		</div>


<!-- <div class="center">
	<ul class="pagination pagination-lg">
	?php echo $this->pagination->create_links(); ?>
	</ul>
</div> -->
	<div>
	<input type="button" value="Imprimir" onclick="PrintDiv();" />
	</div>


</body> 
</html>