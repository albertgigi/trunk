<?php echo form_open("consumo_gas/servicio_buscar"); ?>
<div>
<div class="buscador">
	<div>
		<label>Número de Servicio</label>
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
		<?php foreach($servicios as $item): ?>
			<option value="<?php echo $item->dependencia; ?>"><?php echo $item->dependencia; ?></option>
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
	<div>
		<button
			name="enviar"
			value="volver"
			class="btn"
			type="submit"
		><span class="glyphicon glyphicon-circle-arrow-left"></span> Volver a Catálogo</button>
	</div>
</div>
</div>
<?php echo form_close(); ?>
<div class="table-responsive">
	<table class="table table-bordered table-hover">
		<thead>
			<tr>
				<th>Número de Servicio</th>
				<th>Dependencia</th>
				<th>Acciones</th>
			</tr>
		</thead>

		<tbody>
		<?php if($busqueda): ?>
			<tr>
				<td><?php echo $busqueda->cuenta; ?></td>
				<td><?php echo $busqueda->dependencia; ?></td>
				<td><small>
				<?php echo anchor('consumo_gas/servicio_actualizar/'.$busqueda->id, '<span class="icon-edit"></span> Actualizar'); ?>
				<?php echo anchor('consumo_gas/servicio_borrar/'.$busqueda->id, '<span class="icon-trash"></span> Borrar', 'class="delete"'); ?>
				</small></td>
			</tr>
		<?php else: ?>
			<tr>
				<td colspan=10>No se han encontrado resultados.</td>
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