<?php echo form_open("consumo_electricidad/servicio_editar/$servicio->id"); ?>
<!--?php echo form_open("consumo_gas/servicio_editar/$servicio->id"); ?--> <!--ORIGINAL-->

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
				value="<?php echo $item->nombre; ?>"
				<?php echo ($servicio->dependencia==$item->id)? "selected" : ""; ?>
			><?php echo $item->nombre; ?></option>
		<?php endforeach; ?>
		</select>
		<!--<a href="/PanelControlDTI/index.php/consumo_electricidad/catalogo_dependencias/">Editar Dependencias</a>-->
		<a href="<?php echo site_url('consumo_electricidad/dependencia_editar'); ?>">Editar Dependencias</a>
		<!--a href="/index.php/consumo_gas/catalogo_dependencias/">Editar Dependencias</a--> <!--ORIGINAL-->
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