<?php echo form_open("control_factor_gei/editar_gei/$info_gei->id"); ?> <!--anteriormente ['id']-->
<div class="row">
	<div class="col-md-4 text-right">
			<label for="year">Año</label>
	</div>
	<div class="col-md-6">
		<div class="input-group">
			<input
				id="year"
				name="theyear"
				class="form-control"
				type="text"
				value="<?php echo $info_gei->theyear; ?>"
			>

		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-4 text-right">
			<label for="total_alumnos">Población Total</label>
	</div>
	<div class="col-md-6">
		<div class="input-group">
			<input
				id="totalalumni"
				name="cantidad_alumnos"
				class="form-control"
				type="text"
				value="<?php echo $info_gei->cantidad_alumnos; ?>"
			>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-4 text-right">
			<label for="emisionesa">Factor GEI Agua</label>
	</div>
	<div class="col-md-6">
		<div class="input-group">
			<input
				id="emisionesa"
				name="emisionesa"
				class="form-control"
				type="text"
				value="<?php echo $info_gei->emisionesa; ?>"
			>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-4 text-right">
			<label for="emisiones">Factor GEI Electricidad</label>
	</div>
	<div class="col-md-6">
		<div class="input-group">
			<input
				id="emisiones"
				name="emisiones"
				class="form-control"
				type="text"
				value="<?php echo $info_gei->emisiones; ?>"
			>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-4 text-right">
			<label for="emisionesg">Factor GEI Gas</label>
	</div>
	<div class="col-md-6">
		<div class="input-group">
			<input
				id="emisionesg"
				name="emisionesg"
				class="form-control"
				type="text"
				value="<?php echo $info_gei->emisionesg; ?>"
			>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-4 text-right">
			<label for="temperatura">Temperatura</label>
	</div>
	<div class="col-md-6">
		<div class="input-group">
			<input
				id="temperatura"
				name="temperatura"
				class="form-control"
				type="text"
				value="<?php echo $info_gei->temperatura; ?>"
			>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-6 pull-right">
		<button
			name="enviar"
			value="actualizar_gei"
			class="btn"
			type="submit"
		><span class="glyphicon glyphicon-floppy-disk"></span>Actualizar</button>
	</div>
</div>
<?php echo form_close(); ?>

<!--?php echo anchor('consumo_gas/actualizar/'.$item->id, '<span class="icon-edit"></span> Actualizar'); ?> Esto va despues del type en Actualizar-->