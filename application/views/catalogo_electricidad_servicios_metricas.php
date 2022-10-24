    <html xmlns="http://www.w3.org/1999/xhtml"><!--INICIO HTML Y HEAD PARA IMPRIMIR-->
      <head>
      
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
      
         <script type="text/javascript"><!---->//INICIO DEL SCRIPT PARA IMPRIMIR
            function PrintDiv() {    
               var divToPrint = document.getElementById('divToPrint');
               var popupWin = window.open('', '_blank', 'width=680,height=800'); <!---->//AQUI SE DEFINE EL ANCHO Y ALTO DE VISTA PREVIA
               popupWin.document.open();
               popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
                popupWin.document.close();
                    }
         </script><!--CIERRE DEL SCRIPT PARA IMPRIMIR-->
       </head><!--CIERRE DEL HEAD PARA IMPRIMIR-->


       
	<body ><!--INICIO DEL BODY-->

<?php echo form_open("consumo_electricidad/metricas_buscar/"); ?>
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
</div>
</div>
<div class="text-right">
	<label><a href="http://www.cfe.gob.mx/paginas/home.aspx">CFE</a></label>
</div>
<div class="text-right">
	<label><a href="http://cfectiva.cfe.gob.mx/cfectiva/index.php">CFEfectiva Empresarial</a></label>
</div>

                <div id="divToPrint" > <!--INICIO DEL DIV DONDE IRA TODO EL CONTENIDO QUE SE DESEE IMPRIMIR-->
                <div style="background-color:white;"><!--DIV PARA COLOCAR EL COLOR DE FONDO-->
<?php echo form_close(); ?>

<div class="table-responsive">
	<table class="table table-bordered table-hover">
		<thead>
			<tr>
				<th>Número de servicio</th>
				<th>Dependencia</th>
				<th>Total Consumo</th>
				<th>Consumo per capita</th>
				<th>Año</th>
				<th>Acciones</th>
			</tr>
		</thead>

		<tbody>

		<?php if($servicios): ?>
			<?php foreach($servicios as $item): ?>
			<tr>
				<td><?php echo $item->cuenta; ?></td>
				<td><?php echo $item->dependencia; ?></td>
				<!--td>?php echo $item->total_consumo; ?> Kw/h</td-->
				<td><?php echo number_format($item->total_consumo); ?></td>
				<!--td>?php echo $item->consumo_persona; ?> Kw/h</td-->
				<td><?php echo number_format($item->consumo_persona); ?></td>
				<td><?php echo $item->year; ?></td>
				<td><small>
				<?php echo anchor('consumo_electricidad/metrica_actualizar/'.$item->id, '<span class="icon-edit"></span> Actualizar'); ?>
				<?php echo anchor('consumo_electricidad/metrica_borrar/'.$item->id, '<span class="icon-trash"></span> Borrar', 'class="delete"'); ?>
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