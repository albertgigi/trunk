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
            <td>1404</td>
            <td>2150</td>
			<th>1070</th>
         </tr>
         <tr>
            <th>Febrero</th>
            <td>1807</td>
            <td>1489</td>
			<th>1636</th>
         </tr>
         <tr>
            <th>Marzo</th>
            <td>1835</td>
            <td>1542</td>
			<th>1374</th>
         </tr>
         <tr>
            <th>Abril</th>
            <td>2085</td>
            <td>1719</td>
			<th>1662</th>
         </tr>
         <tr>
            <th>Mayo</th>
            <td>2147</td>
            <td>2388</td>
			<th>1178</th>
         </tr>
         <tr>
            <th>Junio</th>
            <td>2151</td>
            <td>2582</td>
			<th>1656</th>
         </tr>
         <tr>
            <th>Julio</th>
            <td>2348</td>
            <td>2492</td>
			<th>1526</th>
         </tr>
         <tr>
            <th>Agosto</th>
            <td>2039</td>
            <td>2587</td>
			<th>1842</th>
         </tr>
         <tr>
            <th>Septiembre</th>
            <td>2303</td>
            <td>2648</td>
			<th>2064</th>
         </tr>
         <tr>
            <th>Octubre</th>
            <td>2108</td>
            <td>1389</td>
			<th>1967</th>
         </tr>
         <tr>
            <th>Noviembre</th>
            <td>2161</td>
            <td>1493</td>
			<th>1853</th>
         </tr>
         <tr>
            <th>Diciembre</th>
            <td>1530</td>
            <td>1437</td>
			<th>1310</th>
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
            <td>1,404</td>
            <td>2,150</td>
			<th>1,070</th>
         </tr>
         <tr>
            <th>Febrero</th>
            <td>1,807</td>
            <td>1,489</td>
			<th>1,636</th>
         </tr>
         <tr>
            <th>Marzo</th>
            <td>1,835</td>
            <td>1,542</td>
			<th>1,374</th>
         </tr>
         <tr>
            <th>Abril</th>
            <td>2,085</td>
            <td>1,719</td>
			<th>1,662</th>
         </tr>
         <tr>
            <th>Mayo</th>
            <td>2,147</td>
            <td>2,388</td>
			<th>1,178</th>
         </tr>
         <tr>
            <th>Junio</th>>
            <td>2,151</td>
            <td>2,582</td>
			<th>1,656</th>
         </tr>
         <tr>
            <th>Julio</th>
            <td>2,348</td>
            <td>2,492</td>
			<th>1,526</th>
         </tr>
         <tr>
            <th>Agosto</th>
            <td>2,039</td>
            <td>2,587</td>
			<th>1,842</th>
         </tr>
         <tr>
            <th>Septiembre</th>
            <td>2,303</td>
            <td>2,648</td>
			<th>2,064</th>
         </tr>
         <tr>
            <th>Octubre</th>
            <td>2,108</td>
            <td>1,389</td>
			<th>1,967</th>
         </tr>
         <tr>
            <th>Noviembre</th>
            <td>2,161</td>
            <td>1,493</td>
			<th>1,853</th>
         </tr>
         <tr>
            <th>Diciembre</th>
            <td>1,530</td>
            <td>1,437</td>
			<th>1,310</th>
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
        text: 'Campus de Ciencias Agropecuarias Escobedo N.L.'
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