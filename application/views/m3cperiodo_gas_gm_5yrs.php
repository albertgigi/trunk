<?php
//Esta carpeta y archivo que contiene estan directamente en la carpeta PanelControlDTI
require_once ("php/connection.php");
?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
        
    
            <script type="text/javascript">//INICIO DEL SCRIPT PARA IMPRIMIR
            function PrintDiv() {    
               var divToPrint = document.getElementById('divToPrint');//NOMBRE DEL DIV
               var popupWin = window.open('', '_blank', 'width=750,height=800'); //AQUI SE DECIDE EL ANCHO Y ALTO DE VISTA PREVIA
               popupWin.document.open();
               popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
                popupWin.document.close();
                    }
         </script><!--CIERRE DEL SCRIPT PARA IMPRIMIR-->
    </head>

    <body>
      <div id="divToPrint" >
            <div style="background-color:white;">

        <style type="text/css">
#container {
    height: 900px;
    width: 0 auto;
    margin: 0 auto;
}
        </style>

        <script type="text/javascript">
            $(function () {

    // INICIO DEL ESTILO, PARA CAMBIAR EL TAMAÑO DE LA FUENTE EN EL TÍTULO DE LA GRÁFICA
    Highcharts.theme = {
        rangeselector: {
            enabled: false
        },
        tooltip: {
            crosshairs: false
        },
        legend: {
            enabled: true
        },
		scrollbar: {
            enabled: true,
            barBackgroundColor: 'cyan',
            barBorderRadius: 7,
            barBorderWidth: 0,
            buttonBackgroundColor: 'white',
            buttonBorderWidth: 0,
            buttonBorderRadius: 7,
            trackBackgroundColor: 'white',
            trackBorderWidth: 1,
            trackBorderRadius: 8,
            trackBorderColor: '#CCC',
            rifleColor: 'black',
            buttonArrowColor: 'black'
        },
        title: {
            style: {
                fontSize: '15px',
            }
        }
    }
    var highchartsOptions = Highcharts.setOptions(Highcharts.theme); //SE DEFINE LA VARIABLE PARA LAS OPCIONES DE LA GRÁFICA


$(function () {
    $('#container').highcharts({
        chart: {
            type: 'column',
            margin: 75,
            options3d: {
                enabled: true,
                alpha: 20,
                beta: 20,
                viewDistance: 20,
                depth: 20 * 15
            }
        },

        title: {
            text: 'Metros Cúbicos Per Cápita por Año (GM)'
        },

        xAxis: {
            categories: [
            <?php
            $sql = "SELECT * FROM 5yrs_gmpdc_factor_gei_all";
            $result = mysqli_query($connection,$sql);
            while ($registros = mysqli_fetch_array($result))
            {
            ?>
                '<?php echo $registros["gmtheyear5yrs"] ?>',
                <?php
            }
            ?>
            ]
        },

        yAxis: {
            allowDecimals: false,
            min: 0,
            title: {
                text: 'Totales'
            }
        },

        tooltip: {
            headerFormat: '<b>{point.key}</b><br>',
            pointFormat: '<span style="color:{series.color}">\u25CF</span> {series.name}: {point.y} / {point.stackTotal}'
        },

        plotOptions: {
            column: {
                depth: 80,
                stacking: false,
                grouping: false,
                groupZPadding: 20,
                dataLabels: {
                    format: '<div style="text-align:center"><span style="font-size:10px;color:' + //este agregado hace una modificacion para cambiar el estilo en las cantidades
                    ((Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black') + '">{y}</span><br/>',
                    enabled: true,
                    color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'black'
                }
            }
        },
        exporting: {
               /*sourceWidth: 1920,
               sourceHeight: 1080,*/
			   sourceWidth: 1366,
               sourceHeight: 768,
               scale: 1, 
                  chartOptions:
                  {
                     chart:
                     {
                        height: this.chartHeight
                     }
                  }
            },
        series: [{
            events: { //Este "evento" define que tanto los colores al pasar o no pasar el puntero del ratón sobre las columnas, seguiran igual, además que agrega colores correspondientes a los marcos y labels en la gráfica.
                mouseOver: function() {
                    overSeriesIndex = this.index;
                    for(var i=0; i<this.data.length; i++)
                        {
                            this.data[i].setState('hover');
                        }
                    },
                mouseOut: function(){
                        for(var i=0; i<this.data.length; i++)
                        {
                            this.data[i].setState('');
                        }
            }}, //Cierre del evento
            name: 'Metros Cúbicos Per Cápita Anual',
            color: "#eec900", //Se define el color de la columna
            data: [
            <?php
            $sql = "SELECT FORMAT ((gmm3gascapitayear5yrs), 2) AS GM3CYEAR FROM 5yrs_gmpdc_factor_gei_all";
            $result1 = mysqli_query($connection,$sql);
            while ($registros1 = mysqli_fetch_array($result1))
            {
            ?>
                <?php echo $registros1["GM3CYEAR"] ?>,
                <?php
            }
            ?>
            ],
            stack: 0
        }]
    });

});
});//CIERRE DEL EVENTO
</script>
    
<!--script src="https://code.highcharts.com/highcharts.js"></script-->
<!--script src="https://code.highcharts.com/highcharts-3d.js"></script-->
<!--script src="https://code.highcharts.com/modules/exporting.js"></script-->
<!--script src="<php echo base_url(); ?>assets/js/highcharts.js"></script-->
<script type="text/javascript" src="https://code.highcharts.com/stock/highstock.js"></script>
<script src="<?php echo base_url(); ?>assets/js/highcharts-3d.js"></script> <!--OJO ES RECOMENDABLE USAR LA OPCION DE 3D ALOJADA EN EL SERVIDOR-->
<!--script src="?php echo base_url(); ?>assets/js/modules/exporting.js"></script-->
<script src="https://code.highcharts.com/modules/exporting.js"></script>


<div id="container" style="height: 500px" style="width: 700px"></div>
    </body>

    </div> <!--cierres del div para imprimir-->
</div><!--cierres del div para imprimir-->


<!--BOTON PARA IMPRIMIR/ULTIMA PARTE-->
<div class="center">
  <ul class="pagination pagination-lg">
    <?php echo $this->pagination->create_links(); ?>
  </ul>
</div>

<div>
    <input type="button" value="Imprimir" onclick="PrintDiv();" />
</div>
<!--CIERRE DE BOTON-->

<!--BOTON PARA VOLVER A INICIO DE PANEL-->
<?php echo form_open(); ?>
    <div>
    <div class="col-md-12 text-right">
        <button name="enviar" value="volver" class="btn" type="submit">
          <span class="glyphicon glyphicon-circle-arrow-left"></span> Volver al Inicio
        </button>
  </div>
  <!--CIERRE DE BOTON-->
<?php echo form_close(); ?>
</html>