<html xmlns="http://www.w3.org/1999/xhtml"><!--INICIO HTML Y HEAD PARA IMPRIMIR-->
      <head>
      
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
      
         <script type="text/javascript"><!---->//INICIO DEL SCRIPT PARA IMPRIMIR
            function PrintDiv() {    
               var divToPrint = document.getElementById('divToPrint');
               var popupWin = window.open('', '_blank', 'width=755,height=700'); <!---->//AQUI SE DEFINE EL ANCHO Y ALTO DE VISTA PREVIA
               popupWin.document.open();
               popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
                popupWin.document.close();
                    }
         </script><!--CIERRE DEL SCRIPT PARA IMPRIMIR-->
       </head><!--CIERRE DEL HEAD PARA IMPRIMIR-->
       
       
            <body ><!--INICIO DEL BODY-->

<?php echo form_open("consumo_agua/buscar"); ?>
<div>
<div class="buscador">
	<div>
		<label>NIS</label>
	</div>
	<div class="input-group">
			<input
				id="servicio"
				name="servicio"
				class="form-control"
				type="text"
				value="<?php if(!empty($num_servicio)) { echo $num_servicio; } ?>"
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
			<option value="<?php echo $item->id; ?>"
			<?php if($dependencia) echo ($item->id==$dependencia)?
			'selected' : ''; ?>>
			<?php echo $item->cuenta." - ".$item->dependencia; ?>
			</option>
		<?php endforeach; ?>
		</select>
</div>
<div class="buscador">
	<div>
		<label>Año</label>
	</div>
	<select name="year">
		<option value="">----</option>
		<?php for($a=2011; $a<=date('Y'); $a++): ?>
			<option value="<?php echo $a; ?>" <?php if(isset($year) && $year==$a) echo "selected"?>><?php echo $a; ?></option>
		<?php endfor; ?>
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
<div>

<div id="divToPrint" > <!--INICIO DEL DIV DONDE IRA TODO EL CONTENIDO QUE SE DESEE IMPRIMIR-->
<div style="background-color:white;"><!--DIV PARA COLOCAR EL COLOR DE FONDO-->


	<?php if($recibos): ?>
	<?php foreach($servicios as $item): ?>
				<?php if($item->id==$dependencia || $item->cuenta==$num_servicio):?>
				<h3>Recibos de
					<?php echo $item->dependencia; ?>
				</h3>
				<?php endif; ?>
	<?php endforeach; ?>
	<?php endif; ?>
</div>
<div class="table-responsive">
	<table class="table table-bordered table-hover">
		<thead>
			<tr>
				<th rowspan=2>NIS</th>
				<th rowspan=2>Dependencia</th>
				<th class="text-center" colspan=2>Período</th>
				<th rowspan=2>Consumo m3</th>
				<th rowspan=2>Costo</th>
				<th rowspan=2>Acciones</th>
			</tr>
			<tr>
				<th>Inicio</th>
				<th>Fin</th>
			</tr>
		</thead>

		<tbody>
		<?php if($recibos): ?>
			<?php foreach($recibos as $item): ?>
			<tr>
				<td><?php echo $servicios[$item->servicio]->cuenta; ?></td>
				<td><?php echo $servicios[$item->servicio]->dependencia; ?></td>
				<td><?php echo $item->periodo_inicio; ?></td>
				<td><?php echo $item->periodo_fin; ?></td>
				<!--<td class="text-right">?php echo $item->consumo; ?> m3</td>ORIGINAL-->
				<td class="text-right"><?php echo number_format($item->consumo); ?></td>
				<!--<td class="text-right">$ ?php echo $item->costo; ?></td>ORIGINAL-->
				<td class="text-right">$ <?php echo number_format($item->costo,2); ?></td>
				<td>
				<!--ACTUALIZACION DEL 23-MARZO-2018-->
					<?php
                                if($_SESSION['sess']['level'] == 1){ echo anchor('consumo_agua/recibo/'.$item->id, '<span class="icon-eye-open"></span> Ver', 'class="view" data-remodal-target="modal_ver"'); } ?><br>
					<?php
                                if($_SESSION['sess']['level'] == 1){ echo anchor('consumo_agua/actualizar/'.$item->id, '<span class="icon-edit"></span> Actualizar'); } ?><br>
					<?php
                                if($_SESSION['sess']['level'] == 1){  echo anchor('consumo_agua/borrar/'.$item->id, '<span class="icon-trash"></span> Borrar', 'class="delete"'); } ?>
				<!--ACTUALIZACION DEL 23-MARZO-2018-->
				</td>
			</tr>
			<?php endforeach; ?>
			<tr class="active">
				<td>Total</td>
				<td></td>
				<td></td>
				<td></td>
				<!--<td class="text-right"><b>?php echo $totalM3Agua;?> m3</b></td>ORIGINAL-->
				<td class="text-right"><b><?php echo number_format($totalM3Agua);?> m3</b></td>
				<!--<td class="text-right"><b>?php echo "$ ".$totalCostoAgua;?></b></td>ORIGINAL-->
				<td class="text-right"><b><?php echo "$ ".number_format($totalCostoAgua,2);?></b></td>
				<td></td>
			</tr>
		<?php else: ?>
			<tr>
				<td colspan=10>No se han registrado recibos de consumo.</td>
			</tr>
		<?php endif; ?>
		</tbody>

	</table>
</div> <!-- table-responsive -->

</div><!--CIERRE DEL DIV PARA COLOR DE FONDO-->
</div><!--CIERRE DEL DIV PARA IMPRIMIR-->

<div><!--INICIO DEL BOTON PARA EJECUTAR LA IMPRESIÓN-->

<input type="button" value="Imprimir" onclick="PrintDiv();" />
</div><!--CIERRE DEL BOTON DE IMPRESIÓN-->

<div class="center">
	<ul class="pagination pagination-lg">
	<?php echo $this->pagination->create_links(); ?>
	</ul>
</div>

		</body> <!--FIN DEL BODY-->
</html><!--CIERRE DEL HTML-->