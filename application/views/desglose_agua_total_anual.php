<html xmlns="http://www.w3.org/1999/xhtml"><!--INICIO HTML Y HEAD PARA IMPRIMIR-->
      <head>
      
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
      
         <script type="text/javascript">//INICIO DEL SCRIPT PARA IMPRIMIR
            function PrintDiv() {    
               var divToPrint = document.getElementById('divToPrint');
               var popupWin = window.open('', '_blank', 'width=600,height=600'); //AQUI SE DEFINE EL ANCHO Y ALTO DE VISTA PREVIA
               popupWin.document.open();
               popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
                popupWin.document.close();
                    }
         </script><!--CIERRE DEL SCRIPT PARA IMPRIMIR-->
       </head><!--CIERRE DEL HEAD PARA IMPRIMIR-->
       
       
            <body ><!--INICIO DEL BODY-->
<?php echo form_open(); ?>
<div class="busqueda_boton">
	<div>
        <button
            name="enviar"
            value="volver"
            class="btn"
            type="submit"
        ><span class="glyphicon glyphicon-circle-arrow-left"></span> Volver al Inicio</button>
    </div>
<div></div>
<div>
		<button
			name="enviar"
			value="reloadtotagua"
			class="btn"
			type="submit"
		><span class="glyphicon glyphicon-retweet"></span> Recargar Datos</button>
	</div>
<?php echo form_close(); ?>

</div>
<div id="divToPrint" > <!--INICIO DEL DIV DONDE IRA TODO EL CONTENIDO QUE SE DESEE IMPRIMIR-->
                   <div style="background-color:white;"><!--DIV PARA COLOCAR EL COLOR DE FONDO-->

<div class="table-responsive">
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>Año</th>
                <th>Consumo Total</th>
                <th>Costo Total</th>
                <th>Población Total</th>
                <th>Emisiones</th>
                <th>m3 Per Capita</th>
                <th>kg Per Capita</th>
                
            </tr>
        </thead>
        <tbody>

        <?php if($mostrardatos): ?>


            <?php foreach($mostrardatos as $item): ?>
            <tr>
                    <td><?php echo $item['TheYear']; ?></td>
                    <td><?php echo $item['SumaConsumo']; ?></td>
					<td>$ <?php echo $item['SumaCosto']; ?></td>
                    <td><?php echo $item['CantidadAlumnos']; ?></td>
                    <td><?php echo $item['emisionesa']; ?></td>
                    <td><?php echo $item['m3wtrcapitayear']; ?> m3</td>
                    <td><?php echo $item['wtrkgcapitayear']; ?> kg</td>
                    
                <?php endforeach; ?>
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