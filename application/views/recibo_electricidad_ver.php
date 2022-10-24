<form>
<div class="row">
	<div class="col-md-6 col-sm-6 col-xs-6 text-right">
			<label for="servicio">Fecha de captura</label>
	</div>
	<div class="col-md-6 col-sm-6 col-xs-6">
		<span><?php echo @date("Y-m-d", $recibo->datetime); ?></span>
	</div>
</div>
<div class="row">
	<div class="col-md-6 col-sm-6 col-xs-6 text-right">
			<label for="servicio">Usuario que capturó</label>
	</div>
	<div class="col-md-6 col-sm-6 col-xs-6">
		<span><?php echo $usuario->nombre; ?></span>
	</div>
</div>
<hr>
<div class="row">
	<div class="col-md-6 col-sm-6 col-xs-6 text-right">
			<label for="servicio">Servicio</label>
	</div>
	<div class="col-md-6 col-sm-6 col-xs-6">
		<span><?php echo $servicios[$recibo->servicio]->cuenta; ?></span>
	</div>
</div>
<div class="row">
	<div class="col-md-6 col-sm-6 col-xs-6 text-right">
			<label for="servicio">Dependencia</label>
	</div>
	<div class="col-md-6 col-sm-6 col-xs-6">
		<span><?php echo $servicios[$recibo->servicio]->dependencia; ?></span>
	</div>
</div>
<div class="row">
	<div class="col-md-6 col-sm-6 col-xs-6 text-right">
			<label for="periodo_inicio">Inicio del periodo</label>
	</div>
	<div class="col-md-6 col-sm-6 col-xs-6">
		<span><?php echo $recibo->periodo_inicio; ?></span>
	</div>
</div>
<div class="row">
	<div class="col-md-6 col-sm-6 col-xs-6 text-right">
			<label for="periodo_fin">Fin del periodo</label>
	</div>
	<div class="col-md-6 col-sm-6 col-xs-6">
		<div class="input-group">
			<span><?php echo $recibo->periodo_fin; ?></span>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6 col-sm-6 col-xs-6 text-right">
			<label for="consumo">Consumo</label>
	</div>
	<div class="col-md-6 col-sm-6 col-xs-6">
		<!--<span>?php echo $recibo->consumo; ?> Kwh</span>ORIGINAL-->
		<span><?php echo number_format($recibo->consumo); ?> Kwh</span>
	</div>
</div>
<div class="row">
	<div class="col-md-6 col-sm-6 col-xs-6 text-right">
			<label for="costo">Costo</label>
	</div>
	<div class="col-md-6 col-sm-6 col-xs-6">
		<!--<span>$?php echo $recibo->costo; ?></span>ORIGINAL-->
		<span>$<?php echo number_format($recibo->costo,2); ?></span>
	</div>
</div>
<div class="row">
	<div class="col-md-6 col-sm-6 col-xs-6 text-right">
			<label for="factor">Factor de potencia</label>
	</div>
	<div class="col-md-6 col-sm-6 col-xs-6">
		<span><?php echo $recibo->factor; ?>  FP</span>
	</div>
</div>
</form>