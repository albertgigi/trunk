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
            <td>1813626</td>
            <td>1572018</td>
			<td>1464786</td>
         </tr>
         <tr>
            <th>Febrero</th>
            <td>2143948</td>
            <td>1843164</td>
			<td>1758517</td>
         </tr>
         <tr>
            <th>Marzo</th>
            <td>2681259</td>
            <td>2034542</td>
			<td>2050199</td>
         </tr>
         <tr>
            <th>Abril</th>
            <td>2336750</td>
            <td>2159446</td>
			<td>2013784</td>
         </tr>
         <tr>
            <th>Mayo</th>
            <td>3394216</td>
            <td>3210421</td>
			<td>3466285</td>
         </tr>
         <tr>
            <th>Junio</th>
            <td>3601301</td>
            <td>3243638</td>
			<td>3479286</td>
         </tr>
         <tr>
            <th>Julio</th>
            <td>3330432</td>
            <td>3487892</td>
			<td>3594783</td>
         </tr>
         <tr>
            <th>Agosto</th>
            <td>4325878</td>
            <td>4272359</td>
			<td>4496859</td>
         </tr>
         <tr>
            <th>Septiembre</th>
            <td>3546104</td>
            <td>3469393</td>
			<td>3449486</td>
         </tr>
         <tr>
            <th>Octubre</th>
            <td>2868611</td>
            <td>2842638</td>
			<td>3305108</td>
         </tr>
         <tr>
            <th>Noviembre</th>
            <td>2311747</td>
            <td>2021292</td>
			<td>2097867</td>
         </tr>
         <tr>
            <th>Diciembre</th>
            <td>1526229</td>
            <td>1343943</td>
			<td>1092549</td>
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
            <td>1,813,626 kWh</td>
            <td>1,572,018 kWh</td>
			<td>1,464,786 kWh</td>
         </tr>
         <tr>
            <th>Febrero</th>
            <td>2,143,948 kWh</td>
            <td>1,843,164 kWh</td>
			<td>1,758,517 kWh</td>
         </tr>
         <tr>
            <th>Marzo</th>
            <td>2,681,259 kWh</td>
            <td>2,034,542 kWh</td>
			<td>2,050,199 kWh</td>
         </tr>
         <tr>
            <th>Abril</th>
            <td>2,336,750 kWh</td>
            <td>2,159,446 kWh</td>
			<td>2,013,784 kWh</td>
         </tr>
         <tr>
            <th>Mayo</th>
            <td>3,394,216 kWh</td>
            <td>3,210,421 kWh</td>
			<td>3,466,285 kWh</td>
         </tr>
         <tr>
            <th>Junio</th>
            <td>3,601,301 kWh</td>
            <td>3,243,638 kWh</td>
			<td>3,479,286 kWh</td>
         </tr>
         <tr>
            <th>Julio</th>
            <td>3,330,432 kWh</td>
            <td>3,487,892 kWh</td>
			<td>3,594,783 kWh</td>
         </tr>
         <tr>
            <th>Agosto</th>
            <td>4,325,878 kWh</td>
            <td>4,272,359 kWh</td>
			<td>4,496,859 kWh</td>
         </tr>
         <tr>
            <th>Septiembre</th>
            <td>3,546,104 kWh</td>
            <td>3,469,393 kWh</td>
			<td>3,449,486 kWh</td>
         </tr>
         <tr>
            <th>Octubre</th>
            <td>2,868,611 kWh</td>
            <td>2,842,638 kWh</td>
			<td>3,305,108 kWh</td>
         </tr>
         <tr>
            <th>Noviembre</th>
            <td>2,311,747 kWh</td>
            <td>2,021,292 kWh</td>
			<td>2,097,867 kWh</td>
         </tr>
         <tr>
            <th>Diciembre</th>
            <td>1,526,229 kWh</td>
            <td>1,343,943 kWh</td>
			<td>1,092,549 kWh</td>
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
        text: 'Ciudad Universitaria'
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