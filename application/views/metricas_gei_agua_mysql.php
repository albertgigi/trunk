<?php
$con = mysql_connect('localhost', 'sdspan3', 'RTRIUHG54637') or die('Error connecting to server');
mysql_select_db("sdspanel1", $con); 

 $sql = "SELECT theyear, FORMAT((rawm3wtrxgei / 10000), 2) AS rwm3gwtr, FORMAT((rawm3wtr / 10000), 2) AS rawraw, FORMAT((cantidad_alumnos / 1000), 2) AS calwtr FROM pdc_factor_gei_all";
            $result = mysql_query($sql);
            $data = array();
            while ($row = mysql_fetch_array($result)){
                $data[] = $row['theyear'];
            
                $data1[] = $row['rwm3gwtr'];
                
                $data2[] = $row['rawraw'];
                
                $data3[] = $row['calwtr'];
                
            }
?>          
<!DOCTYPE HTML>
<html>
    <head>
    
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
        
    
            <script type="text/javascript"><!---->//INICIO DEL SCRIPT PARA IMPRIMIR
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
    height: 400px; 
    min-width: 310px; 
    max-width: 800px;
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
                viewDistance: 25,
                depth: 5 * 50
            }
        },

        title: {
            text: ''
        },

        xAxis: {
        categories: [
        <?php echo join($data, ',') ?>
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
                    enabled: true,
                    color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
                }
            }
        },

        series: [{
            events: { //Este "evento" define los colores al pasar o no pasar el puntero del ratón sobre las columnas, seguiran igual, además que agrega colores correspondientes a los marcos y labels en la gráfica.
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
            name: 'Emisiones GEI - Miles de Toneladas',
            color: '#548b54', //Se define el color
            data: [
            <?php echo join($data1, ',') ?>
            ],
            stack: 0
        }, {
            name: 'Población Estudiantil - Miles',
            color: '#eeb422', //Se define el color
            data: [
            <?php echo join($data3, ',') ?>
            ],
            stack: 1
        }, {
            name: 'Consumo Anual de Agua(m3) - Millones',
            color: '#104e8b', //Se define el color
            data: [
            <?php echo join($data2, ',') ?>
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
<script src="<?php echo base_url(); ?>assets/js/highcharts.js"></script>
<script src="<?php echo base_url(); ?>assets/js/highcharts-3d.js"></script>
<script src="<?php echo base_url(); ?>assets/js//modules/exporting.js"></script>


<div id="container" style="height: 500px" style="width: 700px"></div>
    </body>
<div class="table-responsive">
  <table class="table table-bordered table-hover">
    <thead>
      <tr>
        <th rowspan=2>Año</th>
        <th rowspan=2>m3 Per Cápita por Año</th>
        <th rowspan=2>Kg Per Cápita por Año</th>
        <th rowspan=2>Temperatura</th>
      </tr>
    </thead>

    <tbody>
    <?php if($loadgei_a): ?>
      <?php foreach($loadgei_a as $item): ?>
      <tr>
        <td><?php echo $item->theyear; ?></td>
        <td><?php echo $item->m3wtrcapitayear; ?></td>
        <td><?php echo $item->wtrkgcapitayear; ?></td>
        <td><?php echo $item->temperatura; ?> °C</td>
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
<div class="col-md-12 text-right">
    <button
      name="enviar"
      value="volver"
      class="btn"
      type="submit"
    ><span class="glyphicon glyphicon-circle-arrow-left"></span> Volver al Inicio</button>
  </div>
  <!--CIERRE DE BOTON-->
<?php echo form_close(); ?>
    </html>