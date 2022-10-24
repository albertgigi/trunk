    <html xmlns="http://www.w3.org/1999/xhtml"><!--INICIO HTML Y HEAD PARA IMPRIMIR-->
      <head>
      
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
      
         <script type="text/javascript"><!---->//INICIO DEL SCRIPT PARA IMPRIMIR
            function PrintDiv() {    
               var divToPrint = document.getElementById('divToPrint');
               var popupWin = window.open('', '_blank', 'width=600,height=500'); <!---->//AQUI SE DEFINE EL ANCHO Y ALTO DE VISTA PREVIA
               popupWin.document.open();
               popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
                popupWin.document.close();
                    }
         </script><!--CIERRE DEL SCRIPT PARA IMPRIMIR-->
       </head><!--CIERRE DEL HEAD PARA IMPRIMIR-->
       
       
            <body ><!--INICIO DEL BODY-->
<?php echo form_open("consumo_gas/buscar"); ?>
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
			<!--option value="<php echo $item->id; ?>"><php echo $item->dependencia; ?></option-->
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
<?php echo form_close(); ?>

                <div id="divToPrint" > <!--INICIO DEL DIV DONDE IRA TODO EL CONTENIDO QUE SE DESEE IMPRIMIR-->
                   <div style="background-color:white;"><!--DIV PARA COLOCAR EL COLOR DE FONDO-->

<div class="table-responsive">
	<table class="table table-bordered table-hover">
		<thead>
			<tr>
				<th rowspan=2>Número de cuenta</th>
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
					<?php echo anchor('consumo_gas/recibo/'.$item->id, '<span class="icon-eye-open"></span> Ver', 'class="view" data-remodal-target="modal_ver"'); ?><br>
					<?php echo anchor('consumo_gas/actualizar/'.$item->id, '<span class="icon-edit"></span> Actualizar'); ?><br>
					<?php echo anchor('consumo_gas/borrar/'.$item->id, '<span class="icon-trash"></span> Borrar', 'class="delete"'); ?>
				</td>
			</tr>
			<?php endforeach; ?>
			<tr class="active">
				<td>Total</td>
				<td></td>
				<td></td>
				<td></td>
				<!--<td class="text-right"><b>?php echo $sumaM3Gas;?> m3</b></td>ORIGINAL-->
				<td class="text-right"><b><?php echo number_format($sumaM3Gas);?> m3</b></td>
				<!--<td class="text-right"><b>?php echo "$ ".$sumaCostoGas;?></b></td>ORIGINAL-->
				<td class="text-right"><b><?php echo "$ ".number_format($sumaCostoGas,2);?></b></td>
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