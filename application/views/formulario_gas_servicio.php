<?php echo form_open("consumo_gas/servicio_crear"); ?>

<div class="row">
	<div class="col-md-6 text-right">
			<label for="servicio">Número de servicio</label>
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
<div class="row">
	<div class="col-md-6 text-right">
			<label for="servicio">Dependencia</label>
	</div>
	<div class="col-md-6">
		<select
			id="dependencia"
			name="dependencia"
			class="form-control"
			type="text"
		>
		<?php foreach($dependencias as $item): ?>
			<option value="<?php echo $item->nombre; ?>"><?php echo $item->nombre; ?></option>
		<?php endforeach; ?>
		</select>
	</div>
</div>

<div class="row">
	<div class="col-md-6 text-right">
		<button
			name="enviar"
			value="repetir"
			class="btn"
			type="submit"
		><span class="glyphicon glyphicon-refresh"></span> Guardar y capturar otro</button>
	</div>
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