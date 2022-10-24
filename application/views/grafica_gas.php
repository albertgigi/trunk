<html xmlns="http://www.w3.org/1999/xhtml"><!--INICIO HTML Y HEAD PARA IMPRIMIR-->
      <head>
      
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
      
         <script type="text/javascript"><!---->//INICIO DEL SCRIPT PARA IMPRIMIR
            function PrintDiv() {    
               var divToPrint = document.getElementById('divToPrint');
               var popupWin = window.open('', '_blank', 'width=1050,height=680'); <!---->//AQUI SE DEFINE EL ANCHO Y ALTO DE VISTA PREVIA
               popupWin.document.open();
               popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
                popupWin.document.close();
                    }
         </script><!--CIERRE DEL SCRIPT PARA IMPRIMIR-->
       </head><!--CIERRE DEL HEAD PARA IMPRIMIR-->
       
       
            <body ><!--INICIO DEL BODY-->



<fieldset>
	<legend>Consumo de Gas</legend>
	<?php echo form_open("consumo_gas/diagnostico"); ?>
	<p>Seleccione los parámetros para la tabla y gráfica</p>

	<p>
		<label for="service">Servicio</label>
		<select
			id="service"
			name="service"
		>
			<?php foreach($services as $item): ?>
			<option
				value="<?php echo $item->id; ?>"
				<?php if($service) echo ($item->id==$service)? 'selected' : ''; ?>
			><?php echo $item->dependencia; ?></option>
			<?php endforeach; ?>
		</select>

	</p>
	<p>
		<label>Columnas a graficar</label>
		<select name="measure">
			<option value="consumo" <?php if(isset($measure) && $measure=='consumo'):?> selected <?php endif;?>>m3</option>
			<option value="costo" <?php if(isset($measure) && $measure=='costo'):?> selected <?php endif;?>>Costo total</option>
		</select>
	</p>
	<p>
		<label>Año</label>
		<select name="year">
			<option value="">----</option>
			<?php for($a=2011; $a<=date('Y'); $a++): ?>
				<option value="<?php echo $a; ?>" <?php if(isset($year) && $year==$a) echo "selected"?>><?php echo $a; ?></option>
			<?php endfor; ?>
		</select>
		<!--
		<label>Periodo</label>
		<input type="radio"><label>Año actual</label>
		-->
	</p>

	
	<p>
		<label>&nbsp;</label>
		<input type="submit" name="submit" value="Aceptar">
	</p>

 
	<?php echo form_close(); ?>
</fieldset>
<div id="divToPrint" > <!--INICIO DEL DIV DONDE IRA TODO EL CONTENIDO QUE SE DESEE IMPRIMIR-->
                   <div style="background-color:white;"><!--DIV PARA COLOCAR EL COLOR DE FONDO-->
<div>
	<?php if($chart): ?>
	<h3>Gráfica de
		<?php foreach($services as $item): ?>
				<?php if($item->id==$service) echo $item->dependencia ; ?>
			<?php endforeach; ?>
	</h3>
	<img src="<?php echo base_url('graficas').'/'.$chart.'.png'; ?>">
<?php else: ?>
	<img class="fleft" style="width: 48%;" src="<?php echo base_url(); ?>graficas/Grafica04.jpg">
	<img class="fright" style="width: 48%;" src="<?php echo base_url(); ?>graficas/Grafica02.jpg">
<?php endif; ?>
</div>

</div><!--CIERRE DEL DIV PARA COLOR DE FONDO-->

                </div><!--CIERRE DEL DIV PARA IMPRIMIR-->


                <div><!--INICIO DEL BOTON PARA EJECUTAR LA IMPRESIÓN-->
                    <input type="button" value="Imprimir" onclick="PrintDiv();" />
                </div><!--CIERRE DEL BOTON DE IMPRESIÓN-->

            </body> <!--FIN DEL BODY-->
    </html><!--CIERRE DEL HTML-->