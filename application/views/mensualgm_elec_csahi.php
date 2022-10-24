<?php echo form_open(); ?>

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
<script src="http://code.highcharts.com/stock/highstock.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<!--script src="?php echo base_url(); ?>assets/js/modules/exporting.js"></script-->
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="<?php echo base_url(); ?>assets/js/highcharts-3d.js"></script> <!--OJO ES RECOMENDABLE USAR LA OPCION DE 3D ALOJADA EN EL SERVIDOR-->
<div id = "container" style = "width: 100%; height: 766px; margin: 0 auto"></div>

<table id="datatable" class="table table-condensed table-bordered table-hover" style="display: none;">
      <thead>
         <tr>
            <th></th>
            <th>2016</th>
            <th>2017</th>
            <th>2018</th>
			<th>2019</th>
            <th>2020</th>
         </tr>
      </thead>

      <tbody>
         <tr>
            <th>Enero</th>
            <td>9368</td>
            <td>12008</td>
            <td>11896</td>
			<td>9152</td>
            <td>8200</td>
         </tr>
         <tr>
            <th>Febrero</th>
            <td>13072</td>
            <td>14576</td>
            <td>15256</td>
			<td>11400</td>
            <td>10936</td>
         </tr>
         <tr>
            <th>Marzo</th>
            <td>15408</td>
            <td>19488</td>
            <td>15912</td>
			<td>14192</td>
            <td>12392</td>
         </tr>
         <tr>
            <th>Abril</th>
            <td>19864</td>
            <td>19720</td>
            <td>16096</td>
			<td>16432</td>
            <td>10224</td>
         </tr>
         <tr>
            <th>Mayo</th>
            <td>27600</td>
            <td>24384</td>
            <td>26392</td>
			<td>22104</td>
            <td>8688</td>
         </tr>
         <tr>
            <th>Junio</th>
            <td>22160</td>
            <td>21656</td>
            <td>39720</td>
			<td>23016</td>
            <td>9184</td>
         </tr>
         <tr>
            <th>Julio</th>
            <td>18064</td>
            <td>19040</td>
            <td>19232</td>
			<td>16184</td>
            <td>11384</td>
         </tr>
         <tr>
            <th>Agosto</th>
            <td>34976</td>
            <td>32920</td>
            <td>30400</td>
			<td>30392</td>
            <td>10904</td>
         </tr>
         <tr>
            <th>Septiembre</th>
            <td>37168</td>
            <td>37664</td>
            <td>10504</td>
			<td>36728</td>
            <td>9752</td>
         </tr>
         <tr>
            <th>Octubre</th>
            <td>33552</td>
            <td>30432</td>
            <td>49528</td>
			<td>31528</td>
            <td>7184</td>
         </tr>
         <tr>
            <th>Noviembre</th>
            <td>24544</td>
            <td>20552</td>
            <td>15152</td>
			<td>17360</td>
            <td>6480</td>
         </tr>
         <tr>
            <th>Diciembre</th>
            <td>12608</td>
            <td>14408</td>
            <td>15328</td>
			<td>10072</td>
            <td>5280</td>
         </tr>
      </tbody>

   </table>
<!--COMIENZO DE LA TABLA DE DATOS CON COMMMAS-->

<table id="mugres" class="table table-condensed table-bordered table-hover">
      <thead>
         <tr>
            <th></th>
            <th>2016</th>
            <th>2017</th>
            <th>2018</th>
            <th>2019</th>
			<th>2020</th>
         </tr>
      </thead>

      <tbody>
         <tr>
            <th>Enero</th>
            <td>9,368 kWh</td>
            <td>12,008 kWh</td>
            <td>11,896 kWh</td>
			<td>9,152 kWh</td>
            <td>8,200 kWh</td>
         </tr>
         <tr>
            <th>Febrero</th>
            <td>13,072 kWh</td>
            <td>14,576 kWh</td>
            <td>15,256 kWh</td>
			<td>11,400 kWh</td>
            <td>10,936 kWh</td>
         </tr>
         <tr>
            <th>Marzo</th>
            <td>15,408 kWh</td>
            <td>19,488 kWh</td>
            <td>15,912 kWh</td>
			<td>14,192 kWh</td>
            <td>12,392 kWh</td>
         </tr>
         <tr>
            <th>Abril</th>
            <td>19,864 kWh</td>
            <td>19,720 kWh</td>
            <td>16,096 kWh</td>
			<td>16,432 kWh</td>
            <td>10,224 kWh</td>
         </tr>
         <tr>
            <th>Mayo</th>
            <td>27,600 kWh</td>
            <td>24,384 kWh</td>
            <td>26,392 kWh</td>
			<td>22,104 kWh</td>
            <td>8,688 kWh</td>
         </tr>
         <tr>
            <th>Junio</th>
            <td>22,160 kWh</td>
            <td>21,656 kWh</td>
            <td>39,720 kWh</td>
			<td>23,016 kWh</td>
            <td>9,184 kWh</td>
         </tr>
         <tr>
            <th>Julio</th>
            <td>18,064 kWh</td>
            <td>19,040 kWh</td>
            <td>19,232 kWh</td>
			<td>16,184 kWh</td>
            <td>11,384 kWh</td>
         </tr>
         <tr>
            <th>Agosto</th>
            <td>34,976 kWh</td>
            <td>32,920 kWh</td>
            <td>30,400 kWh</td>
			<td>30,392 kWh</td>
            <td>10,904 kWh</td>
         </tr>
         <tr>
            <th>Septiembre</th>
            <td>37,168 kWh</td>
            <td>37,664 kWh</td>
            <td>10,504 kWh</td>
			<td>36,728 kWh</td>
            <td>9,752 kWh</td>
         </tr>
         <tr>
            <th>Octubre</th>
            <td>33,552 kWh</td>
            <td>30,432 kWh</td>
            <td>49,528 kWh</td>
			<td>31,528 kWh</td>
            <td>7,184 kWh</td>
         </tr>
         <tr>
            <th>Noviembre</th>
            <td>24,544 kWh</td>
            <td>20,552 kWh</td>
            <td>15,152 kWh</td>
			<td>17,360 kWh</td>
            <td>6,480 kWh</td>
         </tr>
         <tr>
            <th>Diciembre</th>
            <td>12,608 kWh</td>
            <td>14,408 kWh</td>
            <td>15,328 kWh</td>
			<td>10,072 kWh</td>
            <td>5,280 kWh</td>
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
                     x: 0,
                     y: -2,
                     color: (Highcharts.theme && Highcharts.theme.dataLabelsColor)
                        || 'black',
                     style: {
                        textShadow: '0 0 3px white',
						fontSize: '11px'
                     },
                  },
               },
            },
			xAxis: {
        min:0,
        max:11,
        categories: null,
        title: {
            enabled: true,
            margin: 3
        },
        labels: {
            align: 'center',
            style: {
                fontFamily: 'Verdana, sans-serif'
            }
        }
    },
    scrollbar: {
        enabled: true
    },
    yAxis: {
        allowDecimals: false,
        title: {
            text: 'Units'
        },
		style: {
			fontSize: '10px'
			}
    },
    tooltip: {
        formatter: function () {
            return '<b>' + this.series.name + '</b><br/>' +
                this.point.y + ' ' + this.point.name.toLowerCase();
        }
    },
	exporting: {
        sourceWidth: 1366,
               sourceHeight: 768,
               scale: 2, 
                  chartOptions:
                  {
                     chart:
                     {
                        height: this.chartHeight
                     }
                  }
    }
});
</script>