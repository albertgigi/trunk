<?php
//Esta carpeta y archivo que contiene estan directamente en la carpeta PanelControlDTI
require_once ("php/connection.php");
?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
        
    
            <script type="text/javascript"><!--//INICIO DEL SCRIPT PARA IMPRIMIR-->
            function PrintDiv() {    
               var divToPrint = document.getElementById('divToPrint');//NOMBRE DEL DIV
               var popupWin = window.open('', '_blank', 'width=1920,height=1080'); //AQUI SE DECIDE EL ANCHO Y ALTO DE VISTA PREVIA
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
    height: 0 auto; 
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
                fontSize: '20px',
            }
        }
    }
    var highchartsOptions = Highcharts.setOptions(Highcharts.theme); //SE DEFINE LA VARIABLE PARA LAS OPCIONES DE LA GRÁFICA


$(function () {
    $('#container').highcharts({
        chart: {
            type: 'column',
            zoomType: 'x',
            panning: true,
            panKey: 'shift',
            margin: 75,
            options3d: {
                enabled: true,
                alpha: 20,
                beta: 20,
                viewDistance: 25,
                depth: 5 * 50
            }
        },

        title: {
            text: 'Población Total 2011 - 2020'+"<br> </br>"+'Consumo Anual 2011 - 2020'+"<br> </br>"+'Emisiones GEI 2011 - 2020'
        },

        xAxis: {
            categories: [
            <?php
            $sql = "SELECT * FROM gmpdcfactorgeiallv2";
            $result = mysqli_query($connection,$sql);
            while ($registros = mysqli_fetch_array($result))
            {
            ?>
                '<?php echo $registros["v2gmtheyear"] ?>',
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
        exporting: {
            sourceWidth: 1920,
               sourceHeight: 1080,
			   /*sourceWidth: 1366,
               sourceHeight: 768,*/
            scale: 1,
            chartOptions:
                  {
                     chart:
                     {
                        height: this.chartHeight,
                        width: this.chartWidth
                     }
                  }
            },
			plotOptions: {
				series: {
                /*pointWidth: 50,
                groupPadding: 50,*/
                dataLabels: {
                    enable: true,
                    style: {
                        color: 'black',
						fontSize: '90px',
                        fontWeight: 'bold'
                    }
                }
            },
            column: {
                depth: 80,
                stacking: false,
                grouping: false,
                groupZPadding: 20,
                dataLabels: {
                    allowOverlap: true,
                    enabled: true,
                    format: '<div style="text-align:center"><span style="font-size:10px;color:' + //este agregado hace una modificacion para cambiar el estilo en las cantidades
                    ((Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black') + '">{y}</span><br/>',
                    enabled: true,
                    color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'black',

                }
            }
        },
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
                            series: [{
                    dataLabels: {
          style: {
            fontSize: '60px',
            fontWeight: 'bold'
          }
        },
            name: 'Emisiones GEI - Miles de Toneladas',
            color: '#dedede', //Se define el color
            fontSize: 22,
            data: [
            <?php
            $sql = "SELECT FORMAT((`v2gmrawkwxgei` / 1000000), 2) AS RKWGEI FROM gmpdcfactorgeiallv2";
            $result1 = mysqli_query($connection,$sql);
            while ($registros1 = mysqli_fetch_array($result1))
            {
            ?>
                <?php echo $registros1["RKWGEI"] ?>,
                <?php
            }
            ?>

            ],
            stack: 0
        }, {
			dataLabels: {
						enabled: true,
                     x: 0,
                     y: 0,
          style: {
            fontSize: '60px',
            fontWeight: 'bold'
          }
        },
            name: 'Consumo Anual de kWh - Millones',
            color: '#87ceff', //Se define el color
            data: [
            <?php
            $sql = "SELECT FORMAT((`v2gmrawkw` / 1000000), 2) AS RKW FROM gmpdcfactorgeiallv2";
            $result2 = mysqli_query($connection,$sql);
            while ($registros2 = mysqli_fetch_array($result2))
            {
            ?>
                <?php echo $registros2["RKW"] ?>,
                <?php
            }
            ?>

            ],
            stack: 1
        }, {
			dataLabels: {
				enabled: true,
				x: 0,
				y: 0,
				style: {
					fontSize: '60px',
					fontWeight: 'bold'
					}
					},
            name: 'Población Total - Miles',
            color: '#32cd32', //Se define el color
            data: [
            <?php
            $sql = "SELECT FORMAT((`v2gmcantidad_alumnos` / 1000), 1) AS CALUMNI FROM gmpdcfactorgeiallv2";
            $result3 = mysqli_query($connection,$sql);
            while ($registros3 = mysqli_fetch_array($result3))
            {
            ?>
                <?php echo $registros3["CALUMNI"] ?>,
                <?php
            }
            ?>

            ],
            stack: 2
        }]
    });

});
}); //CIERRE PARA EL ESTILO DEL TAMAÑO DE FUENTE DEL TITULO DE LA GRÁFICA


        </script>
    

<!--script src="https://code.highcharts.com/highcharts.js"></script-->
<!--script src="https://code.highcharts.com/highcharts-3d.js"></script-->
<!--script src="https://code.highcharts.com/modules/exporting.js"></script-->
<!--script src="<php echo base_url(); ?>assets/js/highcharts.js"></script-->
<script type="text/javascript" src="https://code.highcharts.com/stock/highstock.js"></script>
<script src="<?php echo base_url(); ?>assets/js/highcharts-3d.js"></script>
<!--script src="?php echo base_url(); ?>assets/js/modules/exporting.js"></script-->
<script src="https://code.highcharts.com/modules/exporting.js"></script>


<div id="container" style="height: 500px" style="width: 700px"></div>
    </body>
<div class="table-responsive">
  <table class="table table-bordered table-hover">
    <thead>
      <tr>
        <th rowspan=2>Año</th>
        <th rowspan=2>kWh Per Capita por Año</th>
        <th rowspan=2>kg Per Capita por Año</th>
        <th rowspan=2>Temperatura</th>
      </tr>
    </thead>

    <tbody>
    <?php if($loadgei): ?>
      <?php foreach($loadgei as $item): ?>
      <tr>
        <td><?php echo $item->v2gmtheyear; ?></td>
        <td><?php echo number_format($item->v2gmkwcapitayear,2); ?></td> <!--Sirve para dar formato y así manipular la información como el usuario requiera.-->
        <td><?php echo number_format($item->v2gmkgcapitayear,2); ?> kg</td>
        <td><?php echo $item->v2gmtemperatura; ?> °C</td>
      </tr>
      <?php endforeach; ?>
    <?php else: ?>
      <tr>
        <td colspan=10></td>
      </tr>
    <?php endif; ?>
    </tbody>

  </table>
</div> <!-- table-responsive -->


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
<div class="text-center">
      <button
         name="enviar"
         value="reloadgmpdcv2"
         class="btn"
         type="submit"
      ><span class="glyphicon glyphicon-retweet"></span> Recargar datos GM</button>
   </div>
<div class="col-md-12 text-right">
    <button
      name="enviar"
      value="volver"
      class="btn"
      type="submit"
    ><span class="glyphicon glyphicon-circle-arrow-left"></span> Volver al Inicio</button>
  </div>
   </div>
  <!--CIERRE DE BOTON-->
<?php echo form_close(); ?>
    </html>