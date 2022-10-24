<!--Es la misma vista para editar dependencia de agua, luz o gas ya que usan las mismas dependencias-->
<div class="table-responsive">
	<table class="table table-bordered table-hover">
		<thead>
			<tr>
				<th rowspan=2>Dependencia</th>
				<th rowspan=2>Acciones</th>
			</tr>
		</thead>
		<tbody>
		<?php if($catalogoDependencias): ?>
			<?php foreach($catalogoDependencias as $item): ?>
			<tr>
				<td><?php echo $item->nombre; ?></td>
				<td>
					<?php echo anchor('consumo_electricidad/dependencia_actualizar/'.$item->id, '<span class="icon-edit"></span> Editar'); ?><br>
				</td>
			</tr>
			<?php endforeach; ?>
		<?php else: ?>
			<tr>
				<td colspan=10>No se han registrado dependencias.</td>
			</tr>
		<?php endif; ?>
		</tbody>

	</table>
</div> <!-- table-responsive -->
