<?php echo form_open("consumo_electricidad/servicio_buscar/"); ?>
<div>
<div class="buscador">
	<div>
		<label>Número de servicio</label>
	</div>
	<div class="input-group">
			<input
				id="servicio"
				name="servicio"
				class="form-control"
				type="text"
			>
	</div>
</div>
<div class="buscador">
	<div>
		<label>Dependencia</label>
	</div>
	<select
			id="dependencia"
			name="dependencia"
			class="form-control"
		>
			<option value="">----</option>
		<?php foreach($catalogo as $item): ?>
			<!--option value="<php echo $item->dependencia; ?>"><php echo $item->dependencia; ?></option-->
			<option value="<?php echo $item->id; ?>"><?php echo $item->cuenta." - ".$item->dependencia; ?></option>
		<?php endforeach; ?>
		</select>
</div>
<div class="busqueda_boton">
	<div>
		<button
			name="enviar"
			value="aceptar"
			class="btn"
			type="submit"
		><span class="glyphicon glyphicon-search"></span> Buscar</button>
	</div>
</div>
</div>
<div class="text-right">
	<label><a href="http://www.cfe.gob.mx/paginas/home.aspx">CFE</a></label>
</div>
<div class="text-right">
	<label><a href="http://cfectiva.cfe.gob.mx/cfectiva/index.php">CFEfectiva Empresarial</a></label>
</div>
<?php echo form_close(); ?>
<div class="table-responsive">
	<table class="table table-bordered table-hover">
		<thead>
			<tr>
				<th>Número de servicio</th>
				<th>Dependencia</th>
				<th>Acciones</th>
			</tr>
		</thead>

		<tbody>

		<?php if($servicios): ?>
			<?php foreach($servicios as $item): ?>
			<tr>
				<td><?php echo $item->cuenta; ?></td>
				<td><?php echo $item->dependencia; ?></td>
				<td><small>
				<?php echo anchor('consumo_electricidad/servicio_actualizar/'.$item->id, '<span class="icon-edit"></span> Actualizar'); ?>
				<?php echo anchor('consumo_electricidad/servicio_borrar/'.$item->id, '<span class="icon-trash"></span> Borrar', 'class="delete"'); ?>
								</small></td>
			</tr>
			<?php endforeach; ?>
		<?php else: ?>
			<tr>
				<td colspan=10>No se han registrado recibos de consumo.</td>
			</tr>
		<?php endif; ?>
		</tbody>

	</table>
</div> <!-- table-responsive -->

<div class="center">
	<ul class="pagination pagination-lg">
	<?php echo $this->pagination->create_links(); ?>
	</ul>
</div>
