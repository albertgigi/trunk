<!--?php echo form_open("consumo_electricidad/campus_buscar"); ?-->
<html xmlns="http://www.w3.org/1999/xhtml"><!--INICIO HTML Y HEAD PARA IMPRIMIR-->
      <head>
      
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
      
         <script type="text/javascript"><!---->//INICIO DEL SCRIPT PARA IMPRIMIR
            function PrintDiv() {    
               var divToPrint = document.getElementById('divToPrint');
               var popupWin = window.open('', '_blank', 'width=650,height=600'); <!---->//AQUI SE DEFINE EL ANCHO Y ALTO DE VISTA PREVIA
               popupWin.document.open();
               popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
                popupWin.document.close();
                    }
         </script><!--CIERRE DEL SCRIPT PARA IMPRIMIR-->
       </head><!--CIERRE DEL HEAD PARA IMPRIMIR-->

       <body ><!--INICIO DEL BODY-->

<?php echo form_open(); ?>
<div class="buscador">
	<div>
		<label>Campus</label>
	</div>
	<select
			id="campus2"
			name="campus2"
			class="form-control"
		>
			<option value="">----</option>
		<?php foreach($catcampus as $item): ?>
			<option value="<?php echo $item->campus2; ?>"
			<?php if($campus2) echo ($item->campus2==$campus2)? 'selected' : ''; ?>
			><?php echo $item->campus2; ?></option>
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
		><span class="glyphicon glyphicon-circle-arrow-left"></span> Volver al Inicio</button>
	</div>
	<div>
		<button
			name="enviar"
			value="reloadcampus2"
			class="btn"
			type="submit"
		><span class="glyphicon glyphicon-retweet"></span> Recargar Datos</button>
	</div>
</div>
<div class="text-right">
	<label><a href="http://www.cfe.gob.mx/paginas/home.aspx">CFE</a></label>
</div>
<div class="text-right">
	<label><a href="http://cfectiva.cfe.gob.mx/cfectiva/index.php">CFEfectiva Empresarial</a></label>
</div>
<?php echo form_close(); ?>

<div id="divToPrint" > <!--INICIO DEL DIV DONDE IRA TODO EL CONTENIDO QUE SE DESEE IMPRIMIR-->
                   <div style="background-color:white;"><!--DIV PARA COLOCAR EL COLOR DE FONDO-->


<div class="table-responsive">
	<table class="table table-bordered table-hover">
		<thead>
			<tr>
				<th rowspan=2>Año</th>
				<th rowspan=2>Campus</th>
				<th rowspan=2>Consumo</th>
				<th rowspan=2>Costo</th>
			</tr>
		</thead>

		<tbody>
		<?php if($resultcampus): ?>
			<?php foreach($resultcampus as $item): ?>
			<tr>
				<td><?php echo $item->campusyear; ?></td>
				<td><?php echo $item->campus2; ?></td>
				<td><?php echo number_format($item->campusconsumo2); ?></td>
				<td>$<?php echo number_format($item->campuscosto2,2); ?></td>
			</tr>
			<?php endforeach; ?>
			<tr class="active">
				<td>Total</td>
				<td></td>
				<td class="text-right"><b><?php echo number_format($campusconsumototal);?></b></td>
				<td class="text-right"><b><?php echo "$ ".number_format($campuscostototal,2);?></b></td>
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


<div class="center">
	<ul class="pagination pagination-lg">
	<?php echo $this->pagination->create_links(); ?>
	</ul>
</div>

<div><!--INICIO DEL BOTON PARA EJECUTAR LA IMPRESIÓN-->
                    <input type="button" value="Imprimir" onclick="PrintDiv();" />
                </div><!--CIERRE DEL BOTON DE IMPRESIÓN-->



            </body> <!--FIN DEL BODY-->
    </html><!--CIERRE DEL HTML-->