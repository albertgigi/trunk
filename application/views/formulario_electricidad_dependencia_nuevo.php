<?php echo form_open("consumo_electricidad/dependencia_nuevo"); ?>
<div class="row">
	<div class="col-md-6 text-right">
			<label for="servicio">Nombre de dependencia</label>
	</div>
	<div class="col-md-6">
		<input
			id="cuenta"
			name="cuenta"
			class="form-control"
			type="text"
		>
	</div>
</div>
<?php if(!empty($repetido)): ?>
	<div class="repetidos">
		<label>Dependencia ya existe</label>
	</div>
<?php endif; ?>
<div class="row">
	<div class="col-md-6 pull-right">
		<button
			name="enviar"
			value="aceptar"
			class="btn"
			type="submit"
		><span class="glyphicon glyphicon-floppy-disk"></span> Guardar y salir</button>
	</div>
</div>
<?php echo form_close(); ?>