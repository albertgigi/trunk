<?php echo form_open('login/log_in', 'class="login"'); ?>

<div class="row">
	<div class="col-md-4 col-md-offset-4">
		<div class="input-group">
			<span class="input-group-addon glyphicon glyphicon-user"></span>
			<input
				id="nombre"
				name="nombre"
				class="form-control"
				type="text"
				placeholder="Nombre de usuario"
				value="<?php if(isset($nombre)){ echo $nombre; } ?>"
			>
		</div> <!-- input-group -->
	</div>
</div> <!-- row -->

<div class="row">
	<div class="col-md-4 col-md-offset-4">
		<div class="input-group">
			<span class="input-group-addon glyphicon glyphicon-lock"></span>
			<input
				id="password"
				name="password"
				class="form-control"
				type="password"
				placeholder="Contraseña"
			>
		</div> <!-- input-group -->
	</div>
</div> <!-- row -->

<div class="row">
	<div class="col-md-4 col-md-offset-4 text-center">
			<button
				id="aceptar"
				name="aceptar"
				class="button"
				type="submit"
			>Ingresar</button>			
	</div>
</div> <!-- row -->

<?php echo form_close();?>

<!--<p class="text-center" style="color: #CCC;"><small>?php if(isset($sesion)) print_r($sesion);?></small></p>
<p class="text-center" style="color: #CCC;"><small>?php if(isset($user)) print_r($user);?></small></p>-->