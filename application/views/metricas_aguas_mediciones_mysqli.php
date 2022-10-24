<?php
//Esta carpeta y archivo que contiene estan directamente en la carpeta PanelControlDTI
require_once ("php/connection.php");
?>
<!DOCTYPE HTML>
<html>
<head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>

         <script type="text/javascript"><!---->//INICIO DEL SCRIPT PARA IMPRIMIR
            function PrintDiv() {    
               var divToPrint = document.getElementById('divToPrint');//NOMBRE DEL DIV
               var popupWin = window.open('', '_blank', 'width=1000,height=690'); <!---->//AQUI SE DECIDE EL ANCHO Y ALTO DE VISTA PREVIA
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
        text: 'Agua Potable y Residual'
    },
    xAxis: {
        categories: [
        <?php
            $sql = "SELECT year_water_comp FROM `factor_gei_agua_comparativo`
            GROUP BY year_water_comp ASC";
            $result = mysqli_query($connection,$sql);
            while ($registros = mysqli_fetch_array($result))
            {
            ?>
                '<?php echo $registros["year_water_comp"] ?>',
                <?php
            }
            ?>
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
        <?php
            $sql = "SELECT `consumo_water_comp` AS RESRESWATER FROM
            `factor_gei_agua_comparativo`
            WHERE `id_servicio` = '64'";
            $result1 = mysqli_query($connection,$sql);
            while ($registros1 = mysqli_fetch_array($result1))
            {
            ?>
                <?php echo $registros1["RESRESWATER"] ?>,
                <?php
            }
            ?>

            ]
    }, {
        name: 'Agua Potable',
        color: "#8ee5ee", //Se define el color de la columna
        data: [
        <?php
            $sql = "SELECT `consumo_water_comp` AS POTPOTWATER FROM 
            `factor_gei_agua_comparativo`
            WHERE `id_servicio` = '44'";
            $result2 = mysqli_query($connection,$sql);
            while ($registros2 = mysqli_fetch_array($result2))
            {
            ?>
                <?php echo $registros2["POTPOTWATER"] ?>,
                <?php
            }
            ?>

            ]
    }]
});
}); //CIERRE PARA EL ESTILO DEL TAMAÑO DE FUENTE DEL TITULO DE LA GRÁFICA

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

<?php echo form_open(); ?>
<div>
  <div class="col-md-12 text-right">
    <button name="enviar" value="volver" class="btn" type="submit">
    <span class="glyphicon glyphicon-circle-arrow-left"></span> Volver al Inicio</button>
  </div>
</div>
<?php echo form_close(); ?>
<!--CIERRE DE BOTON-->
</html>