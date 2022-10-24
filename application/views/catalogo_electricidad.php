<table class="table table-bordered">
	<thead>
		<tr>
			<th>Fecha de captura</th>
			<th>Número de cuenta</th>
			<th>Dependencia</th>
			<th colspan=2>Período</th>
			<th>Consumo(Kwh)</th>
			<th>Costo</th>
			<th></th>
		</tr>
	</thead>

	<tbody>
	<?php if($recibos): ?>
		<?php foreach($recibos as $item): ?>
		<tr>
			<td><?php echo @date('Y-m-d', $item->datetime); ?></td>
			<td><?php echo $servicios[$item->servicio]->cuenta; ?></td>
			<td><?php echo $servicios[$item->servicio]->dependencia; ?></td>
			<td><?php echo $item->periodo_inicio; ?></td>
			<td><?php echo $item->periodo_fin; ?></td>
			<!--td>?php echo $item->consumo; ?></td-->
			<td><?php echo number_format($item->consumo); ?></td>
			<!--td>?php echo $item->costo; ?></td-->
			<td><?php echo number_format($item->costo, 2); ?></td>
			<td><small>
			<?php echo anchor('consumo_electricidad/'.$item->id, '<span class="icon-eye-open"></span> Ver'); ?><br>
			<?php echo anchor('consumo_electricidad/actualizar/'.$item->id, '<span class="icon-edit"></span> Actualizar'); ?><br>
			<?php echo anchor('consumo_electricidad/borrar/'.$item->id, '<span class="icon-trash"></span> borrar'); ?>
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

<p class="center">
<?php echo $this->pagination->create_links(); ?>
</p>