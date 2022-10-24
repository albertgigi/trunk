<form>
<div class="row">
	<div class="col-md-6 col-sm-6 col-xs-6 text-right">
			<label for="theyear">Año</label>
	</div>
	<div class="col-md-6 col-sm-6 col-xs-6">
		<span><?php echo $info_gei->theyear; ?></span>
	</div>
</div>
<div class="row">
	<div class="col-md-6 col-sm-6 col-xs-6 text-right">
			<label for="cantidad_alumnos">Población Total</label>
	</div>
	<div class="col-md-6 col-sm-6 col-xs-6">
		<div class="input-group">
			<span><?php echo $info_gei->cantidad_alumnos; ?></span>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6 col-sm-6 col-xs-6 text-right">
			<label for="emisionesa">Factor GEI Agua</label>
	</div>
	<div class="col-md-6 col-sm-6 col-xs-6">
		<span><?php echo $info_gei->emisionesa; ?></span>
	</div>
</div>
<div class="row">
	<div class="col-md-6 col-sm-6 col-xs-6 text-right">
			<label for="emisiones">Factor GEI Electricidad</label>
	</div>
	<div class="col-md-6 col-sm-6 col-xs-6">
		<span><?php echo $info_gei->emisiones; ?></span>
	</div>
</div>
<div class="row">
	<div class="col-md-6 col-sm-6 col-xs-6 text-right">
			<label for="emisionesg">Factor GEI Gas</label>
	</div>
	<div class="col-md-6 col-sm-6 col-xs-6">
		<span><?php echo $info_gei->emisionesg; ?></span>
	</div>
</div>
<div class="row">
	<div class="col-md-6 col-sm-6 col-xs-6 text-right">
			<label for="temperatura">Temperatura</label>
	</div>
	<div class="col-md-6 col-sm-6 col-xs-6">
		<span>$<?php echo $info_gei->temperatura; ?> °C</span>
	</div>
</div>
</form>