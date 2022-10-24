<?php echo form_open("consumo_gas/crear/"); ?>

<div class="row">
	<div class="col-md-6 text-right">
			<label for="servicio">Servicio</label>
	</div>
	<div class="col-md-6">
		<select
			id="servicio"
			name="servicio"
			class="form-control"
		>
		<?php foreach($servicios as $item): ?>
			<option value="<?php echo $item->id; ?>"><?php echo $item->cuenta." - ".$item->dependencia; ?></option>
		<?php endforeach; ?>
		</select>
	</div>
</div>
<div class="row">
	<div class="col-md-6 text-right">
			<label for="periodo_inicio">Inicio del periodo</label>
	</div>
	<div class="col-md-6">
		<div class="input-group">
			<input
				id="periodo_inicio"
				name="periodo_inicio"
				class="form-control date"
				type="text"
			>
			<span class="input-group-addon glyphicon glyphicon-calendar"></span>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6 text-right">
			<label for="periodo_fin">Fin del periodo</label>
	</div>
	<div class="col-md-6">
		<div class="input-group">
			<input
				id="periodo_fin"
				name="periodo_fin"
				class="form-control date"
				type="text"
			>
			<span class="input-group-addon glyphicon glyphicon-calendar"></span>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6 text-right">
			<label for="periodo_inicio">Consumo</label>
	</div>
	<div class="col-md-6">
		<div class="input-group">
			<input
				id="consumo"
				name="consumo"
				class="form-control"
				type="text"
			>
			<span class="input-group-addon">m3</span>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6 text-right">
			<label for="periodo_inicio">Costo</label>
	</div>
	<div class="col-md-6">
		<div class="input-group">
			<input
				id="costo"
				name="costo"
				class="form-control"
				type="text"
			>
			<span class="input-group-addon">$</span>
		</div>
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