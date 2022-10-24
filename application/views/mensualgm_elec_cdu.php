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
            <td>1672802</td>
            <td>1813626</td>
            <td>1572018</td>
			<td>1464786</td>
			<td>1520005</td>
			
         </tr>
         <tr>
            <th>Febrero</th>
            <td>2036828</td>
            <td>2143948</td>
            <td>1843164</td>
			<td>1758517</td>
			<td>1746909</td>
         </tr>
         <tr>
            <th>Marzo</th>
            <td>2142195</td>
            <td>2681259</td>
            <td>2034542</td>
			<td>2050199</td>
			<td>1781198</td>
         </tr>
         <tr>
            <th>Abril</th>
            <td>2968211</td>
            <td>2336750</td>
            <td>2159446</td>
			<td>2013784</td>
			<td>1091360</td>
         </tr>
         <tr>
            <th>Mayo</th>
            <td>3266424</td>
            <td>3394216</td>
            <td>3210421</td>
			<td>3466285</td>
			<td>1427857</td>
         </tr>
         <tr>
            <th>Junio</th>
            <td>3308133</td>
            <td>3601301</td>
            <td>3243638</td>
			<td>3479286</td>
			<td>1668391</td>
         </tr>
         <tr>
            <th>Julio</th>
            <td>3555395</td>
            <td>3330432</td>
            <td>3487892</td>
			<td>3594783</td>
			<td>1903171</td>
         </tr>
         <tr>
            <th>Agosto</th>
            <td>4249192</td>
            <td>4325878</td>
            <td>4272359</td>
			<td>4496859</td>
			<td>1930291</td>
         </tr>
         <tr>
            <th>Septiembre</th>
            <td>3611614</td>
            <td>3546104</td>
            <td>3469393</td>
			<td>3449486</td>
			<td>1559711</td>
         </tr>
         <tr>
            <th>Octubre</th>
            <td>3272006</td>
            <td>2868611</td>
            <td>2842638</td>
			<td>3305108</td>
			<td>1375513</td>
         </tr>
         <tr>
            <th>Noviembre</th>
            <td>2354649</td>
            <td>2311747</td>
            <td>2021292</td>
			<td>2097867</td>
			<td>1128054</td>
         </tr>
         <tr>
            <th>Diciembre</th>
            <td>1443379</td>
            <td>1526229</td>
            <td>1343943</td>
			<td>1092549</td>
			<td>934790</td>
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
            <td>1,672,802 kWh</td>
            <td>1,813,626 kWh</td>
            <td>1,572,018 kWh</td>
			<td>1,464,786 kWh</td>
			<td>1,520,005 kWh</td>
         </tr>
         <tr>
            <th>Febrero</th>
            <td>2,036,828 kWh</td>
            <td>2,143,948 kWh</td>
            <td>1,843,164 kWh</td>
			<td>1,758,517 kWh</td>
			<td>1,746,909 kWh</td>
         </tr>
         <tr>
            <th>Marzo</th>
            <td>2,142,195 kWh</td>
            <td>2,681,259 kWh</td>
            <td>2,034,542 kWh</td>
			<td>2,050,199 kWh</td>
			<td>1,781,198 kWh</td>
         </tr>
         <tr>
            <th>Abril</th>
            <td>2,968,211 kWh</td>
            <td>2,336,750 kWh</td>
            <td>2,159,446 kWh</td>
			<td>2,013,784 kWh</td>
			<td>1,091,360 kWh</td>
         </tr>
         <tr>
            <th>Mayo</th>
            <td>3,266,424 kWh</td>
            <td>3,394,216 kWh</td>
            <td>3,210,421 kWh</td>
			<td>3,466,285 kWh</td>
			<td>1,427,857 kWh</td>
         </tr>
         <tr>
            <th>Junio</th>
            <td>3,308,133 kWh</td>
            <td>3,601,301 kWh</td>
            <td>3,243,638 kWh</td>
			<td>3,479,286 kWh</td>
			<td>1,668,391 kWh</td>
         </tr>
         <tr>
            <th>Julio</th>
            <td>3,555,395 kWh</td>
            <td>3,330,432 kWh</td>
            <td>3,487,892 kWh</td>
			<td>3,594,783 kWh</td>
			<td>1,903,171 kWh</td>
         </tr>
         <tr>
            <th>Agosto</th>
            <td>4,249,192 kWh</td>
            <td>4,325,878 kWh</td>
            <td>4,272,359 kWh</td>
			<td>4,496,859 kWh</td>
			<td>1,930,291 kWh</td>
         </tr>
         <tr>
            <th>Septiembre</th>
            <td>3,611,614 kWh</td>
            <td>3,546,104 kWh</td>
            <td>3,469,393 kWh</td>
			<td>3,449,486 kWh</td>
			<td>1,559,711 kWh</td>
			
         </tr>
         <tr>
            <th>Octubre</th>
            <td>3,272,006 kWh</td>
            <td>2,868,611 kWh</td>
            <td>2,842,638 kWh</td>
			<td>3,305,108 kWh</td>
			<td>1,375,513 kWh</td>
         </tr>
         <tr>
            <th>Noviembre</th>
            <td>2,354,649 kWh</td>
            <td>2,311,747 kWh</td>
            <td>2,021,292 kWh</td>
			<td>2,097,867 kWh</td>
			<td>1,128,054 kWh</td>
         </tr>
         <tr>
            <th>Diciembre</th>
            <td>1,443,379 kWh</td>
            <td>1,526,229 kWh</td>
            <td>1,343,943 kWh</td>
			<td>1,092,549 kWh</td>
			<td>934,790 kWh</td>
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
        text: 'Ciudad Universitaria'
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
                     y: -1,
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