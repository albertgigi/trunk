<form>
<div class="row">
	<div class="col-md-6 col-sm-6 col-xs-6 text-right">
			<label for="theyearw">Año</label>
	</div>
	<div class="col-md-6 col-sm-6 col-xs-6">
		<span><?php echo $info_agua_pot_res->theyearw; ?></span>
	</div>
</div>
<div class="row">
	<div class="col-md-6 col-sm-6 col-xs-6 text-right">
			<label for="potwtr">Agua Potable</label>
	</div>
	<div class="col-md-6 col-sm-6 col-xs-6">
		<div class="input-group">
			<span><?php echo $info_agua_pot_res->potwtr; ?></span>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-6 col-sm-6 col-xs-6 text-right">
			<label for="reswtr">Agua Residual</label>
	</div>

	<div class="col-md-6 col-sm-6 col-xs-6">
		<span><?php echo $info_agua_pot_res->reswtr; ?></span>
	</div>
</div>

</form>