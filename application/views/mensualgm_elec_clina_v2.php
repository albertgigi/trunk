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
<script src="<?php echo base_url(); ?>assets/js/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="<?php echo base_url(); ?>assets/js/highcharts-3d.js"></script> <!--OJO ES RECOMENDABLE USAR LA OPCION DE 3D ALOJADA EN EL SERVIDOR-->
<div id = "container" style = "width: 100%; height: 766px; margin: 0 auto"></div>

<table id="datatable" class="table table-condensed table-bordered table-hover" style="display: none;">
      <thead>
         <tr>
            <th></th>
            <th>2017</th>
            <th>2018</th>
			<th>2019</th>
         </tr>
      </thead>

      <tbody>
         <tr>
            <th>Enero</th>
            <td>57185</td>
            <td>52805</td>
			<td>45660</td>
         </tr>
         <tr>
            <th>Febrero</th>
            <td>59008</td>
            <td>53278</td>
			<td>50657</td>
         </tr>
         <tr>
            <th>Marzo</th>
            <td>74126</td>
            <td>53818</td>
			<td>60981</td>
         </tr>
         <tr>
            <th>Abril</th>
            <td>57548</td>
            <td>57906</td>
			<td>56710</td>
         </tr>
         <tr>
            <th>Mayo</th>
            <td>115146</td>
            <td>98559</td>
			<td>98152</td>
         </tr>
         <tr>
            <th>Junio</th>
            <td>111542</td>
            <td>109905</td>
			<td>96618</td>
         </tr>
         <tr>
            <th>Julio</th>
            <td>91640</td>
            <td>101162</td>
			<td>101994</td>
         </tr>
         <tr>
            <th>Agosto</th>
            <td>137859</td>
            <td>133168</td>
			<td>145122</td>
         </tr>
         <tr>
            <th>Septiembre</th>
            <td>114925</td>
            <td>98195</td>
			<td>106175</td>
         </tr>
         <tr>
            <th>Octubre</th>
            <td>83691</td>
            <td>87284</td>
			<td>99038</td>
         </tr>
         <tr>
            <th>Noviembre</th>
            <td>62642</td>
            <td>57497</td>
			<td>55711</td>
         </tr>
         <tr>
            <th>Diciembre</th>
            <td>48441</td>
            <td>44689</td>
			<td>41694</td>
         </tr>
      </tbody>

   </table>
<!--COMIENZO DE LA TABLA DE DATOS CON COMMMAS-->

<table id="mugres" class="table table-condensed table-bordered table-hover">
      <thead>
         <tr>
            <th></th>
            <th>2017</th>
            <th>2018</th>
			<th>2019</th>
         </tr>
      </thead>

      <tbody>
         <tr>
            <th>Enero</th>
            <td>57,185 kWh</td>
            <td>52,805 kWh</td>
			<td>45,660 kWh</td>
         </tr>
         <tr>
            <th>Febrero</th>
            <td>59,008 kWh</td>
            <td>53,278 kWh</td>
			<td>50,657 kWh</td>
         </tr>
         <tr>
            <th>Marzo</th>
            <td>74,126 kWh</td>
            <td>53,818 kWh</td>
			<td>60,981 kWh</td>
         </tr>
         <tr>
            <th>Abril</th>
            <td>57,548 kWh</td>
            <td>57,906 kWh</td>
			<td>56,710 kWh</td>
         </tr>
         <tr>
            <th>Mayo</th>
            <td>115,146 kWh</td>
            <td>98,559 kWh</td>
			<td>98,152 kWh</td>
         </tr>
         <tr>
            <th>Junio</th>
            <td>111,542 kWh</td>
            <td>109,905 kWh</td>
			<td>96,618 kWh</td>
         </tr>
         <tr>
            <th>Julio</th>
            <td>91,640 kWh</td>
            <td>101,162 kWh</td>
			<td>101,994 kWh</td>
         </tr>
         <tr>
            <th>Agosto</th>
            <td>137,859 kWh</td>
            <td>133,168 kWh</td>
			<td>145,122 kWh</td>
         </tr>
         <tr>
            <th>Septiembre</th>
            <td>114,925 kWh</td>
            <td>98,195 kWh</td>
			<td>106,175 kWh</td>
         </tr>
         <tr>
            <th>Octubre</th>
            <td>83,691 kWh</td>
            <td>87,284 kWh</td>
			<td>99,038 kWh</td>
         </tr>
         <tr>
            <th>Noviembre</th>
            <td>62,642 kWh</td>
            <td>57,497 kWh</td>
			<td>55,711 kWh</td>
         </tr>
         <tr>
            <th>Diciembre</th>
            <td>48,441 kWh</td>
            <td>44,689 kWh</td>
			<td>41,694 kWh</td>
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
                  alpha: 0,
                  beta: 0,
                  depth: 0,
                  viewDistance: 100
               }
    },
    title: {
        text: 'Campus Linares'
    },
    plotOptions : {
               series: {
                  /*stacking: 'normal',*/
                  edgeWidth: -20,
                  edgeHeigth: -20,
                  depth: 10,
                  stacking: false,
                  grouping: true,
                  groupPadding: 0.1,
                  groupZPadding: 10,
                  pointPadding: 1,
                  maxPointWidth: 30,
                  pointWidth: 14,
                  distance: 14,
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
                     y: -4,
                     color: (Highcharts.theme && Highcharts.theme.dataLabelsColor)
                        || 'black',
                     style: {
                        textShadow: '0 0 3px white',
						fontSize: '14px'
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