<?php echo form_open("conusmo_electricidad", ""); ?>

<div class="row">
	<div class="col-md-6 text-right">
			<label for="servicio">Servicio</label>
	</div>
	<div class="col-md-6">
		<select
			id="periodo_inicio"
			name="periodo_inicio"
			class="form-control"
		>
			<option></option>					
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
				id="periodo_inicio"
				name="periodo_inicio"
				class="form-control"
				type="text"
			>
			<span class="input-group-addon">kw</span>
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
				id="periodo_inicio"
				name="periodo_inicio"
				class="form-control"
				type="text"
			>
			<span class="input-group-addon">$</span>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-6 pull-right">
		<button
			id="aceptar"
			name="aceptar"
			class="btn"
			type="submit"
		><span class="glyphicon glyphicon-floppy-disk"></span> Guardar</button>
	</div>
</div>
<?php echo form_close(); ?>