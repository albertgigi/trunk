<!--?php echo form_open("consumo_electricidad/campus_buscar"); ?-->
<html xmlns="http://www.w3.org/1999/xhtml"><!--INICIO HTML Y HEAD PARA IMPRIMIR-->
      <head>
         
         <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
         <!--script src="<php echo base_url(); ?>assets/js/highcharts.js"></script-->
            <!--script src = "https://code.highcharts.com/modules/exporting.js"></script-->
            <!--script src="https://code.highcharts.com/highcharts.js"></script-->
            <!--script src="https://code.highcharts.com/highcharts-3d.js"></script-->
            <!--script src="https://code.highcharts.com/modules/exporting.js"></script-->
            <!--script src="<php echo base_url(); ?>assets/js/highcharts.js"></script-->
               <script type="text/javascript" src="https://code.highcharts.com/stock/highstock.js"></script>
               <script src="<?php echo base_url(); ?>assets/js/highcharts-3d.js"></script> <!--OJO ES RECOMENDABLE USAR LA OPCION DE 3D ALOJADA EN EL SERVIDOR-->
               <!--script src="?php echo base_url(); ?>assets/js/modules/exporting.js"></script-->
			   <script src="https://code.highcharts.com/modules/exporting.js"></script>
               <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
               <script src="https://code.jquery.com/jquery-3.3.1.min.map"></script>
               <!--script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script-->
            <script src = "https://code.highcharts.com/modules/data.js"></script>
            <script type="text/javascript">//INICIO DEL SCRIPT PARA IMPRIMIR
            function PrintDiv() {    
               var divToPrint = document.getElementById('divToPrint');
               var popupWin = window.open('', '_blank', 'width=860,height=648'); //AQUI SE DEFINE EL ANCHO Y ALTO DE VISTA PREVIA
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
         id="campus_nongmtfinal"
         name="campus_nongmtfinal"
         class="form-control"
      >
         <option value="">----</option>
      <?php foreach($catecexcnongm as $item): ?>
         <option value="<?php echo $item->campus_nongmtfinal; ?>"><?php echo $item->campus_nongmtfinal; ?></option>
         ><?php echo $item->campus_nongmtfinal; ?></option>
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
         value="reloadcexcnongm"
         class="btn"
         type="submit"
      ><span class="glyphicon glyphicon-retweet"></span> Recargar Datos</button>
   </div>
</div>

<?php echo form_close(); ?>

<div id="divToPrint" > <!--INICIO DEL DIV DONDE IRA TODO EL CONTENIDO QUE SE DESEE IMPRIMIR-->
                   <div style="background-color:white;"><!--DIV PARA COLOCAR EL COLOR DE FONDO-->
<?php
$b = array ('m' => 'monkey', 'foo' => 'bar', 'x' => array ('x', 'y', 'z'));
$results = print_r($b, true); // $results now contains output from print_r
?>





</div> <!-- table-responsive -->


</div><!--CIERRE DEL DIV PARA COLOR DE FONDO-->

                </div><!--CIERRE DEL DIV PARA IMPRIMIR-->

<div class="center">
   <ul class="pagination pagination-lg">
   <?php echo $this->pagination->create_links(); ?>
   </ul>
</div>
<div>
      <h3>
   <?php if($resecexcnongm): ?>
      <?php foreach($resecexcnongm as $item): ?>
         <tr>
            <td><?php echo $item->campus_nongmtfinal;
            break; ?>

         </tr>
         <?php endforeach; ?>
      <?php else: ?>
         <tr>
            <td colspan=10></td>
         </tr>
      <?php endif; ?>
      </h3>
</div>

   <div id = "container" style = "width: 100%; height: 730px; margin: 0 auto"></div>
   <div id = "sliders">
         <table>
            <!--<tr>
               <td>Angulo Alfa</td>
               <td><input id = "R0" type = "range" min = "0" max = "45" value = "2"/>
                  <span id = "R0-value" class = "value"></span>
               </td>
            </tr>
            <tr>
               <td>Angulo Beta</td>
               <td><input id = "R1" type = "range" min = "0" max = "45" value = "2"/>
                  <span id = "R1-value" class = "value"></span>
               </td>
            </tr>-->
            <!--tr>
               <td>Profundidad</td>
               <td><input id = "R2" type = "range" min = "0" max = "100" value = "50"/>
                  <span id = "R2-value" class = "value"></span>
               </td>
            </tr-->
            <!--<tr>
               <td>Distancia</td>
               <td><input id = "R3" type = "range" min = "0" max = "100" value = "0"/>
                  <span id = "R3-value" class = "value"></span>
               </td>
            </tr>-->
         </table>
      </div>
      <script language = "JavaScript">
         $(document).ready(function() {

            var data = {
               table: 'datatables'
            };

            var chart = {
               renderTo: 'container',
               type: 'column',
               zoomType: 'x',
               panning: true,
               panKey: 'shift',
               /*margin: 10,*/

               options3d: {
                  enabled: false,
                  alpha: 2,
                  beta: 2,
                  depth: 50,
                  viewDistance: 0
               }
            };
            var title = {
               text: '<?php echo $item->campus_nongmtfinal?>'
            };

            var plotOptions = {
               series: {
                  /*stacking: 'normal',*/
                  /*edgeWidth: -10,
                  edgeHeigth: -10,*/
                  depth: 80,
                  stacking: false,
                  grouping: true,
                  groupPadding: 0.2,
                  pointWidth: 8,
                  /*groupZPadding: 20,
                  pointPadding: 1,
                  
                  maxPointWidth: 150,
                  distance: 20,*/
                  dataLabels: {
                     enabled: true,
                     align: 'left',
                     allowOverlap: true,
                     rotation: 270,
                     x: 1,
                     y: 0,
                     color: (Highcharts.theme && Highcharts.theme.dataLabelsColor)
                        || 'black',
                     style: {
                        textShadow: '0 0 3px white'
                     }
                  }
               }
            };
            var exporting =
            {
               sourceWidth: 1920,
               sourceHeight: 1080,
               scale: 1, 
                  chartOptions:
                  {
                     chart:
                     {
                        height: this.chartHeight
                     }
                  }
            };
            var yAxis = {
               allowDecimals: false,
               title: {
                  text: 'Consumo KwH'
              },
              labels: {
                format: '{value:,.0f}',
                valuesuffix: '',
                shared: true
               },
         };
         var xAxis = {
              
         };
            /*var tooltip = {
               formatter: function () {
                  return '<b>' + this.series.name + '</b><br/>' +
                     this.point.y;
               }
            };*/
            var tooltip = {
               formatter: function () {
                  return '<b>' + this.x + '</b><br/>' +
                  this.series.name + ': ' + this.y + '<br/>' +
                  'Total: ' + this.point.stackTotal;
               }
            };
            var credits = {
               enabled: false
            };  
            var json = {};
            json.chart = chart;
            json.title = title;
            json.data = data;
            json.plotOptions = plotOptions;
            json.exporting = exporting;
            json.yAxis = yAxis;
            json.xAxis = xAxis;
            json.credits = credits;
            json.tooltip = tooltip;
         json.scrollbar = {
               enabled: true,
               barBackgroundColor: 'lime',
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
               buttonArrowColor: 'black',
            };
         json.colors= ['#7CB5EC', '#434348',
         '#90ED7D', '#F7A35C',
         '#8085E9', '#F15C80',
         '#E4D354', '#CD0000',
         '#F45B5B', '#91E8E1',
         '#7D26CD', '#104E8B'
         ];
            /*$('#container').highcharts(json);*/
            var highchart = new Highcharts.Chart(json);
           
            function showValues() {
               /*$('#R0-value').html(highchart.options.chart.options3d.alpha);
               $('#R1-value').html(highchart.options.chart.options3d.beta);*/
               $('#R2-value').html(highchart.options.chart.options3d.depth);
               /*$('#R3-value').html(highchart.options.chart.options3d.viewDistance);*/
            }
            
            // Activate the sliders
            /*$('#R0').on('change', function () {
               highchart.options.chart.options3d.alpha = this.value;
               showValues();
               highchart.redraw(false);
            });
            $('#R1').on('change', function () {
               highchart.options.chart.options3d.beta = this.value;
               showValues();
               highchart.redraw(false);
            });*/
            $('#R2').on('change', function () {
               highchart.options.chart.options3d.depth = this.value;
               showValues();
               highchart.redraw(false);
            });
            /*$('#R3').on('change', function () {
               highchart.options.chart.options3d.viewDistance = this.value;
               showValues();
               highchart.redraw(false);
            });*/
            showValues();
         });

      </script>

<table id="datatables" class="table table-condensed table-bordered table-hover" style="display: none;">
      <thead>
         <tr>
            <th>Year</th>
            <th>Enero</th>
            <th>Febrero</th>
            <th>Marzo</th>
            <th>Abril</th>
            <th>Mayo</th>
            <th>Junio</th>
            <th>Julio</th>
            <th>Agosto</th>
            <th>Septiembre</th>
            <th>Octubre</th>
            <th>Noviembre</th>
            <th>Diciembre</th>
         </tr>
      </thead>

      <tbody>
         <?php if($resecexcnongm): ?>
            <?php foreach($resecexcnongm as $item): ?>
         <tr>
            <td><?php echo $item->year_nongmtfinal; ?></td>
            <td><?php echo number_format($item->Enero, 0, "", " "); ?></td>
            <td><?php echo number_format($item->Febrero, 0, "", " "); ?></td>
            <td><?php echo number_format($item->Marzo, 0, "", " "); ?></td>
            <td><?php echo number_format($item->Abril, 0, "", " "); ?></td>
            <td><?php echo number_format($item->Mayo, 0, "", " "); ?></td>
            <td><?php echo number_format($item->Junio, 0, "", " "); ?></td>
            <td><?php echo number_format($item->Julio, 0, "", " "); ?></td>
            <td><?php echo number_format($item->Agosto, 0, "", " "); ?></td>
            <td><?php echo number_format($item->Septiembre, 0, "", " "); ?></td>
            <td><?php echo number_format($item->Octubre, 0, "", " "); ?></td>
            <td><?php echo number_format($item->Noviembre, 0, "", " "); ?></td>
            <td><?php echo number_format($item->Diciembre, 0, "", " "); ?></td>
         </tr>
         <?php endforeach; ?>
      <?php else: ?>
         <tr>
            <td colspan=10>Favor de seleccionar el campus a consultar.</td>
         </tr>
      <?php endif; ?>
      </tbody>

   </table>
<!--COMIENZO DE LA TABLA DE DATOS CON COMMMAS-->

<table id="mugres" class="table table-condensed table-bordered table-hover">
      <thead>
         <tr>
            <th>Año</th>
            <th class="text-center">Enero</th>
            <th class="text-center">Febrero</th>
            <th class="text-center">Marzo</th>
            <th class="text-center">Abril</th>
            <th class="text-center">Mayo</th>
            <th class="text-center">Junio</th>
            <th class="text-center">Julio</th>
            <th class="text-center">Agosto</th>
            <th class="text-center">Septiembre</th>
            <th class="text-center">Octubre</th>
            <th class="text-center">Noviembre</th>
            <th class="text-center">Diciembre</th>
         </tr>
      </thead>

      <tbody>
      <?php if($resecexcnongm): ?>
         <?php foreach($resecexcnongm as $item): ?>
         <tr>
            <td><?php echo $item->year_nongmtfinal; ?></td>
            <td class="text-right"><b><?php echo number_format($item->Enero); ?></b></td>
            <td class="text-right"><b><?php echo number_format($item->Febrero); ?></b></td>
            <td class="text-right"><b><?php echo number_format($item->Marzo); ?></b></td>
            <td class="text-right"><b><?php echo number_format($item->Abril); ?></b></td>
            <td class="text-right"><b><?php echo number_format($item->Mayo); ?></b></td>
            <td class="text-right"><b><?php echo number_format($item->Junio); ?></b></td>
            <td class="text-right"><b><?php echo number_format($item->Julio); ?></b></td>
            <td class="text-right"><b><?php echo number_format($item->Agosto); ?></b></td>
            <td class="text-right"><b><?php echo number_format($item->Septiembre); ?></b></td>
            <td class="text-right"><b><?php echo number_format($item->Octubre); ?></b></td>
            <td class="text-right"><b><?php echo number_format($item->Noviembre); ?></b></td>
            <td class="text-right"><b><?php echo number_format($item->Diciembre); ?></b></td>
         </tr>
         <?php endforeach; ?>
         <tr class="active">
            <td><b>Total</b></td>
            <td class="text-right"><b><?php echo number_format($EnerogaasxcampustotnonGM);?></b></td>
            <td class="text-right"><b><?php echo number_format($FebrerogaasxcampustotnonGM);?></b></td>
            <td class="text-right"><b><?php echo number_format($MarzogaasxcampustotnonGM);?></b></td>
            <td class="text-right"><b><?php echo number_format($AbrilgaasxcampustotnonGM);?></b></td>
            <td class="text-right"><b><?php echo number_format($MayogaasxcampustotnonGM);?></b></td>
            <td class="text-right"><b><?php echo number_format($JuniogaasxcampustotnonGM);?></b></td>
            <td class="text-right"><b><?php echo number_format($JuliogaasxcampustotnonGM);?></b></td>
            <td class="text-right"><b><?php echo number_format($AgostogaasxcampustotnonGM);?></b></td>
            <td class="text-right"><b><?php echo number_format($SeptiembregaasxcampustotnonGM);?></b></td>
            <td class="text-right"><b><?php echo number_format($OctubregaasxcampustotnonGM);?></b></td>
            <td class="text-right"><b><?php echo number_format($NoviembregaasxcampustotnonGM);?></b></td>
            <td class="text-right"><b><?php echo number_format($DiciembregaasxcampustotnonGM);?></b></td>
         </tr>
      <?php else: ?>
         <tr>
            <td colspan=10>Favor de seleccionar el campus a consultar.</td>
         </tr>
      <?php endif; ?>
      </tbody>

   </table>
</body>
</html>