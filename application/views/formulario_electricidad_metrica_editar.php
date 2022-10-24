<?php echo form_open("consumo_electricidad/metrica_editar/$servicio->id"); ?>

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
			value="<?php echo $servicio->cuenta; ?>"
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
			<option
				value="<?php echo $item->dependencia; ?>"
				<?php echo ($servicio->dependencia==$item->dependencia)? "selected" : ""; ?>
			><?php echo $item->dependencia; ?></option>
		<?php endforeach; ?>
		</select>
	</div>
</div>
<div class="row">
	<div class="col-md-6 text-right">
			<label for="servicio">Consumo per capita de Kw/h</label>
	</div>
	<div class="col-md-6">
		<input
			id="cuenta"
			name="consumo_persona"
			class="form-control"
			type="text"
			value="<?php echo $servicio->consumo_persona; ?>"
		>
	</div>
</div>
<div class="row">
	<div class="col-md-6 text-right">
			<label for="servicio">Consumo total de Kw/h</label>
	</div>
	<div class="col-md-6">
		<input
			id="cuenta"
			name="total_consumo"
			class="form-control"
			type="text"
			value="<?php echo $servicio->total_consumo; ?>"
		>
	</div>
</div>

<div class="row">
	<div class="col-md-6 pull-right">
		<button
			id="aceptar"
			name="aceptar"
			class="btn"
			type="submit"
		><span class="glyphicon glyphicon-floppy-disk"></span> Actualizar</button>
	</div>
</div>
<?php echo form_close(); ?>