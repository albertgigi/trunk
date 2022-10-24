<?php
$con = mysql_connect('localhost', 'sdspan3', 'RTRIUHG54637') or die('Error connecting to server');
mysql_select_db("sdspanel1", $con); 

 $sql = "SELECT year_water_comp,
pot_waters_comp AS MAIN1,
res_waters_comp AS MAIN2,
consumo_water_comp,
id_servicio
FROM `factor_gei_agua_comparativo`
WHERE
(pot_waters_comp = 'POTPOTWATER')  OR
(res_waters_comp = 'RESRESWATER') 
GROUP BY year_water_comp ASC, MAIN1 ASC, MAIN2 ASC
ORDER BY year_water_comp ASC";
            $result = mysql_query($sql);
            $data = array();
            while ($row = mysql_fetch_array($result)){
                $data[] = $row['year_water_comp'];
            
                $data1[] = $row['MAIN1'];

                $data2[] = $row['MAIN2'];
            }
?>          
<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>

        <script type="text/javascript"><!--//INICIO DEL SCRIPT PARA IMPRIMIR-->
            function PrintDiv() {    
               var divToPrint = document.getElementById('divToPrint');//NOMBRE DEL DIV
               var popupWin = window.open('', '_blank', 'width=1000,height=690'); //AQUI SE DECIDE EL ANCHO Y ALTO DE VISTA PREVIA
               popupWin.document.open();
               popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
                popupWin.document.close();
                    }
         </script><!--CIERRE DEL SCRIPT PARA IMPRIMIR-->


    <div id="divToPrint" > <!--INICIO DEL DIV DONDE IRA TODO EL CONTENIDO QUE SE DESEE IMPRIMIR-->
    <div style="background-color:white;"><!--DIV PARA COLOCAR EL COLOR DE FONDO-->


        <script type="text/javascript"><!--//INICIO DEL SCRIPT PARA DIBUJAR LA TABLA-->

$(function () {
    $('#container').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Kilowatts Per Cápita por Año'
        },
        xAxis: {
            categories: [
        <?php echo join($data, ',') ?>
        ]
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Totales'
            },
            stackLabels: {
                enabled: true,
                style: {
                    fontWeight: 'bold',
                    color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                }
            }
        },
        legend: {
            align: 'right',
            x: -30,
            verticalAlign: 'top',
            y: 25,
            floating: true,
            backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
            borderColor: '#CCC',
            borderWidth: 1,
            shadow: false
        },
        tooltip: {
            headerFormat: '<b>{point.x}</b><br/>',
            pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
        },
        plotOptions: {
            column: {
                stacking: 'normal',
                dataLabels: {
                    enabled: true,
                    color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
                }
            }
        },
        series: [{
            name: 'Agua Residual',
            color: "#8b8878", //Se define el color de la columna
            data: [
            <?php echo join($data1, ',') ?>
            ]
        
        },
        {
            name: 'Agua Potable',
            color: "#8ee5ee", //Se define el color de la columna
            data: [
            <?php echo join($data2, ',') ?>
            ]

        }]
    });
});
        </script><!--FIN DEL SCRIPT QUE IMPRIME LA TABLA-->
    </head>
    <body>
<script src="<?php echo base_url(); ?>assets/js/highcharts.js"></script>
<script src="<?php echo base_url(); ?>assets/js//modules/exporting.js"></script>

<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
    </body>
</div><!--CIERRE DEL DIV PARA COLOR DE FONDO-->

                </div><!--CIERRE DEL DIV PARA IMPRIMIR-->


                <div><!--INICIO DEL BOTON PARA EJECUTAR LA IMPRESIÓN-->
                    <input type="button" value="Imprimir" onclick="PrintDiv();" />
                </div><!--CIERRE DEL BOTON DE IMPRESIÓN-->
    <!--BOTON PARA VOLVER A INICIO DE PANEL-->


<!--BOTON PARA VOLVER A INICIO DE PANEL-->
  <?php echo form_open(); ?>
<div>
<div class="col-md-12 text-right">
    <button
      name="enviar"
      value="volver"
      class="btn"
      type="submit"
    ><span class="glyphicon glyphicon-circle-arrow-left"></span> Volver al Inicio</button>
  </div>
<?php echo form_close(); ?>
<!--CIERRE DE BOTON-->
</html>