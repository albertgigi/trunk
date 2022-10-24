<html xmlns="http://www.w3.org/1999/xhtml"><!--INICIO HTML Y HEAD PARA IMPRIMIR-->
      <head>
      
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
      
         <script type="text/javascript"><!---->//INICIO DEL SCRIPT PARA IMPRIMIR
            function PrintDiv() {    
               var divToPrint = document.getElementById('divToPrint');
               var popupWin = window.open('', '_blank', 'width=700,height=500'); <!---->//AQUI SE DEFINE EL ANCHO Y ALTO DE VISTA PREVIA
               popupWin.document.open();
               popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
                popupWin.document.close();
                    }
         </script><!--CIERRE DEL SCRIPT PARA IMPRIMIR-->
       </head><!--CIERRE DEL HEAD PARA IMPRIMIR-->
       
       
            <body ><!--INICIO DEL BODY-->
<?php echo form_open("consumo_electricidad/buscar/"); ?>
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
<div class="hidden-print" class="text-right">
	<label><a href="http://www.cfe.gob.mx/paginas/home.aspx">CFE</a></label>
</div>
<div class="hidden-print" class="text-right">
	<label><a href="http://cfectiva.cfe.gob.mx/cfectiva/index.php">CFEfectiva Empresarial</a></label>
</div>
<?php echo form_close(); ?>


                <div id="divToPrint" > <!--INICIO DEL DIV DONDE IRA TODO EL CONTENIDO QUE SE DESEE IMPRIMIR-->
                   <div style="background-color:white;"><!--DIV PARA COLOCAR EL COLOR DE FONDO-->


<div class="table-responsive">
	<table class="table table-bordered table-hover">
		<thead>
			<tr>
				<th rowspan=2>NIS</th>
				<th rowspan=2>Dependencia</th>
				<th class="text-center" colspan=2>Período</th>
				<th rowspan=2>Consumo kWh</th>
				<th rowspan=2>Costo</th>
				<th rowspan=2>FP</th>
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
				<!--<td class="text-right">?php echo $item->consumo; ?> Kwh</td>ORGINIAL-->
				<td class="text-right"><?php echo number_format($item->consumo); ?></td>
				<!--<td class="text-right">$ ?php echo $item->costo; ?></td>ORIGINAL-->
				<td class="text-right">$ <?php echo number_format($item->costo,2); ?></td>
				<td class="text-right <?php if($item->factor < 90 && $item->factor > 0) echo 'fp_deficiente';?>"><?php echo $item->factor; ?></td>
				<td class="hidden-print">
									<!--ACTUALIZACION DEL 23-MARZO-2018-->
					<?php
                                if($_SESSION['sess']['level'] == 1){ echo anchor('consumo_electricidad/recibo/'.$item->id, '<span class="icon-eye-open"></span> Ver', 'class="view" data-remodal-target="modal_ver"');} ?><br>
					<?php
								echo anchor('consumo_electricidad/actualizar/'.$item->id, '<span class="icon-edit"></span> Actualizar'); ?><br>
					<?php
                                if($_SESSION['sess']['level'] == 1){ echo anchor('consumo_electricidad/borrar/'.$item->id, '<span class="icon-trash"></span> Borrar', 'class="delete"'); } ?>
                                	<!--ACTUALIZACION DEL 23-MARZO-2018-->
				</td>
			</tr>
				<?php endforeach; ?>
			<tr class="active">
				<td>Total</td>
				<td class="hidden-print"></td>
				<td class="hidden-print"></td>
				<td class="hidden-print"></td>
				<!--<td class="text-right"><b>?php echo $sumaKhEnergia." Kwh</b>"; ?></td>ORIGINAL-->
				<td class="text-right"><b><?php echo number_format($sumaKhEnergia)." </b>"; ?></td>
				<!--<td class="text-right"><b>?php echo "$ ".$sumaCosto;?></b></td>ORIGINAL-->
				<td class="text-right"><b><?php echo "$ ".number_format($sumaCosto,2);?></b></td>
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