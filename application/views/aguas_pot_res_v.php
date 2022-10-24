    <html xmlns="http://www.w3.org/1999/xhtml">
      <head>
         <script type="text/javascript">     
            function PrintDiv() {    
               var divToPrint = document.getElementById('divToPrint');
               var popupWin = window.open('', '_blank', 'width=640,height=750'); //ESTE PARAMETRO SE PUEDE MODIFICAR PARA LA VISTA PREVIA DE LO QUE SE VA A IMPRIMIR
               popupWin.document.open();
               popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
                popupWin.document.close();
                    }
         </script>
       </head>


<?php echo form_open("control_factor_gei/crearwtr"); ?>

<div class="row">
	<div class="col-md-4 text-right">
			<label for="theyearw">Año</label>
	</div>

	<div class="col-md-6">
		<div class="input-group">
		<input id="theyearw" name="theyearw" class="form-control" type="text">
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-4 text-right">
			<label for="potwtr">Agua Potable</label>
	</div>

	<div class="col-md-6">
		<div class="input-group">
		<input id="potwtr" name="potwtr" class="form-control" type="text">
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-4 text-right">
			<label for="reswtr">Agua Residual</label>
	</div>

	<div class="col-md-6">
		<div class="input-group">
			<input id="reswtr" name="reswtr" class="form-control" type="text">
		</div>
	</div>
</div>

<div class="row">
<script type="text/javascript">
	$(function ()
	{
		$('#cancelarwtr').click(function () {
			$('input[type=text]').each(function () {
				$(this).val('');
			})
		})
	})
	</script>
</div>

<div class="col-md-6 pull-right">
	<button name="cancelarwtr" id="cancelarwtr" class="btn" type="button">
	<span class="glyphicon glyphicon-remove"></span> Cancelar</button>
</div>

<div>
	<div class="col-md-6 text-right">
		<button name="enviar" value="repetirwtr" class="btn" type="submit">
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
							<th>Agua Potable</th>
							<th>Agua Residual</th>
						</tr>
					</thead>
					<tbody>
						<?php if($mostrardatoswtr): ?>
						<?php foreach($mostrardatoswtr as $itema): ?>
						<tr>
							<td><?php echo $itema['show_theyearw']; ?></td>
							<td><?php echo $itema['show_potwtr']; ?> Ltrs.</td>
							<td><?php echo $itema['show_reswtr']; ?> Ltrs.</td>
							<td>
								<?php echo anchor('control_factor_gei/form_actualizar_agua_pot_res/'.$itema['show_idw'], '<span class="icon-edit"></span> Editar', 'class="edit"'); ?>
									<br>
								<?php echo anchor('control_factor_gei/boton_borrar_agua_pot_res/'.$itema['show_idw'], '<span class="icon-trash"></span> Borrar', 'class="delete"'); ?>
							</td>
						</tr>
						<?php endforeach; ?>
						<?php endif; ?>
					</tbody>

				</table>
			</div> <!-- table-responsive -->
		</div>
	</div>

	<div>
		<input type="button" value="Imprimir" onclick="PrintDiv();" />
	</div>

</body> 
</html>