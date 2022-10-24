<?php echo form_open(); ?>
<!--ACTUALMENTE NO SE CUENTA CON CAMPUS SABINAS HIDALGO PARA GAS-->
	<div>
		<button
			name="enviar"
			value="volver"
			class="btn"
			type="submit"
		><span class="glyphicon glyphicon-circle-arrow-left"></span> Regresar</button>
	</div>

<?php echo form_close(); ?>

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.map"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="<?php echo base_url(); ?>assets/js/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="<?php echo base_url(); ?>assets/js/highcharts-3d.js"></script> <!--OJO ES RECOMENDABLE USAR LA OPCION DE 3D ALOJADA EN EL SERVIDOR-->
<div id = "container" style = "width: 100%; height: 730px; margin: 0 auto"></div>

<table id="datatable" class="table table-condensed table-bordered table-hover" style="display: none;">
      <thead>
         <tr>
            <th></th>
            <th>2015</th>
            <th>2016</th>
            <th>2017</th>
            <th>2018</th>
         </tr>
      </thead>

      <tbody>
         <tr>
            <th>Enero</th>
            <td>8728</td>
            <td>9368</td>
            <td>12008</td>
            <td>11896</td>
         </tr>
         <tr>
            <th>Febrero</th>
            <td>10616</td>
            <td>13072</td>
            <td>14576</td>
            <td>15256</td>
         </tr>
         <tr>
            <th>Marzo</th>
            <td>11184</td>
            <td>15408</td>
            <td>19488</td>
            <td>15912</td>
         </tr>
         <tr>
            <th>Abril</th>
            <td>14392</td>
            <td>19864</td>
            <td>19720</td>
            <td>16096</td>
         </tr>
         <tr>
            <th>Mayo</th>
            <td>23176</td>
            <td>27600</td>
            <td>24384</td>
            <td>26392</td>
         </tr>
         <tr>
            <th>Junio</th>
            <td>19108</td>
            <td>22160</td>
            <td>21656</td>
            <td>25160</td>
         </tr>
         <tr>
            <th>Julio</th>
            <td>17440</td>
            <td>18064</td>
            <td>19040</td>
            <td>19232</td>
         </tr>
         <tr>
            <th>Agosto</th>
            <td>34560</td>
            <td>34976</td>
            <td>32920</td>
            <td>30400</td>
         </tr>
         <tr>
            <th>Septiembre</th>
            <td>39720</td>
            <td>37168</td>
            <td>37664</td>
            <td>10504</td>
         </tr>
         <tr>
            <th>Octubre</th>
            <td>33192</td>
            <td>33552</td>
            <td>30432</td>
            <td>49528</td>
         </tr>
         <tr>
            <th>Noviembre</th>
            <td>22480</td>
            <td>24544</td>
            <td>20552</td>
            <td>15152</td>
         </tr>
         <tr>
            <th>Diciembre</th>
            <td>10440</td>
            <td>12608</td>
            <td>14408</td>
            <td>15328</td>
         </tr>
      </tbody>

   </table>
<!--COMIENZO DE LA TABLA DE DATOS CON COMMMAS-->

<table id="mugres" class="table table-condensed table-bordered table-hover">
      <thead>
         <tr>
            <th></th>
            <th>2015</th>
            <th>2016</th>
            <th>2017</th>
            <th>2018</th>
         </tr>
      </thead>

      <tbody>
         <tr>
            <th>Enero</th>
            <td>8,728 kWh</td>
            <td>9,368 kWh</td>
            <td>12,008 kWh</td>
            <td>11,896 kWh</td>
         </tr>
         <tr>
            <th>Febrero</th>
            <td>10,616 kWh</td>
            <td>13,072 kWh</td>
            <td>14,576 kWh</td>
            <td>15,256 kWh</td>
         </tr>
         <tr>
            <th>Marzo</th>
            <td>11,184 kWh</td>
            <td>15,408 kWh</td>
            <td>19,488 kWh</td>
            <td>15,912 kWh</td>
         </tr>
         <tr>
            <th>Abril</th>
            <td>14,392 kWh</td>
            <td>19,864 kWh</td>
            <td>19,720 kWh</td>
            <td>16,096 kWh</td>
         </tr>
         <tr>
            <th>Mayo</th>
            <td>23,176 kWh</td>
            <td>27,600 kWh</td>
            <td>24,384 kWh</td>
            <td>26,392 kWh</td>
         </tr>
         <tr>
            <th>Junio</th>
            <td>19,108 kWh</td>
            <td>22,160 kWh</td>
            <td>21,656 kWh</td>
            <td>25,160 kWh</td>
         </tr>
         <tr>
            <th>Julio</th>
            <td>17,440 kWh</td>
            <td>18,064 kWh</td>
            <td>19,040 kWh</td>
            <td>19,232 kWh</td>
         </tr>
         <tr>
            <th>Agosto</th>
            <td>34,560 kWh</td>
            <td>34,976 kWh</td>
            <td>32,920 kWh</td>
            <td>30,400 kWh</td>
         </tr>
         <tr>
            <th>Septiembre</th>
            <td>39,720 kWh</td>
            <td>37,168 kWh</td>
            <td>37,664 kWh</td>
            <td>10,504 kWh</td>
         </tr>
         <tr>
            <th>Octubre</th>
            <td>33,192 kWh</td>
            <td>33,552 kWh</td>
            <td>30,432 kWh</td>
            <td>49,528 kWh</td>
         </tr>
         <tr>
            <th>Noviembre</th>
            <td>22,480 kWh</td>
            <td>24,544 kWh</td>
            <td>20,552 kWh</td>
            <td>15,152 kWh</td>
         </tr>
         <tr>
            <th>Diciembre</th>
            <td>10,440 kWh</td>
            <td>12,608 kWh</td>
            <td>14,408 kWh</td>
            <td>15,328 kWh</td>
         </tr>
      </tbody>

   </table>

<script type="text/javascript">
Highcharts.chart('container', {
    data: {
        table: 'datatable'
    },
    chart: {
        renderTo: 'container',
               type: 'column',
               /*zoomType: 'x',
               panning: true,
               panKey: 'shift',
               margin: 10,*/

               options3d: {
               enabled: true,
                  /*alpha: 2,
                  beta: 2,
                  depth: 50,
                  viewDistance: 0*/
               }
    },
    title: {
        text: 'Campus Sabinas Hidalgo'
    },
    plotOptions : {
               series: {
                  /*stacking: 'normal',*/
                  /*edgeWidth: -10,
                  edgeHeigth: -10,*/
                  depth: 10,
                  stacking: false,
                  /*grouping: true,
                  groupPadding: 0.1,
                  groupZPadding: 10,
                  pointPadding: 1,
                  maxPointWidth: 30,
                  pointWidth: 14,
                  distance: 14,*/
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
                     },
                  },
               },
            },
    yAxis: {
        allowDecimals: false,
        title: {
            text: 'Units'
        }
    },
    tooltip: {
        formatter: function () {
            return '<b>' + this.series.name + '</b><br/>' +
                this.point.y + ' ' + this.point.name.toLowerCase();
        }
    }
});
</script>