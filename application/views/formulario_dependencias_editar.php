<?php echo form_open("consumo_electricidad/dependencia_editar/$dependencia->id"); ?>

<div class="row">
	<div class="col-md-12">
		<center>
			<input
				id="nombre_dependencia"
				name="dependencia"
				class="form-control"
				type="text"
				value="<?php echo $dependencia->nombre; ?>"
				style="width:550px"
			>
		</center>
	</div>
</div>
<div class="row">
	<div class="col-md-12 pull-right">
		<center>
			<button
				id="aceptar"
				name="aceptar"
				class="btn"
				type="submit"
			><span class="glyphicon glyphicon-floppy-disk"></span> Actualizar</button>
		</center>
	</div>
</div>
<?php echo form_close(); ?>