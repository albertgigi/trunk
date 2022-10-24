<?php echo form_open("control_factor_gei/editar_agua_pot_res/$info_apr->id"); ?> <!--anteriormente ['id']-->
<div class="row">
	<div class="col-md-4 text-right">
			<label for="year">Año</label>
	</div>
	<div class="col-md-6">
		<div class="input-group">
			<input
				id="year"
				name="theyearw"
				class="form-control"
				type="text"
				value="<?php echo $info_apr->theyearw; ?>"
			>

		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-4 text-right">
			<label for="agua_potable">Agua Potable</label>
	</div>
	<div class="col-md-6">
		<div class="input-group">
			<input
				id="totalaguapotable"
				name="potwtr"
				class="form-control"
				type="text"
				value="<?php echo $info_apr->potwtr; ?>"
			>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-4 text-right">
			<label for="agua_residual">Agua Residual</label>
	</div>
	<div class="col-md-6">
		<div class="input-group">
			<input
				id="totalaguaresidual"
				name="reswtr"
				class="form-control"
				type="text"
				value="<?php echo $info_apr->reswtr; ?>"
			>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6 pull-right">
		<button
			name="enviar"
			value="actualizar_agua_pot_res"
			class="btn"
			type="submit"
		><span class="glyphicon glyphicon-floppy-disk"></span>Actualizar</button>
	</div>
</div>
<?php echo form_close(); ?>