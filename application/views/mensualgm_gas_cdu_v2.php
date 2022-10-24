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
            <td>59913</td>
            <td>63035</td>
			<th>100390</th>
         </tr>
         <tr>
            <th>Febrero</th>
            <td>55581</td>
            <td>67000</td>
			<th>91614</th>
         </tr>
         <tr>
            <th>Marzo</th>
            <td>52592</td>
            <td>51920</td>
			<th>91951</th>
         </tr>
         <tr>
            <th>Abril</th>
            <td>38409</td>
            <td>48941</td>
			<th>56268</th>
         </tr>
         <tr>
            <th>Mayo</th>
            <td>39705</td>
            <td>42221</td>
			<th>52864</th>
         </tr>
         <tr>
            <th>Junio</th>
            <td>21909</td>
            <td>22445</td>
			<th>28678</th>
         </tr>
         <tr>
            <th>Julio</th>
            <td>19414</td>
            <td>19859</td>
			<th>29071</th>
         </tr>
         <tr>
            <th>Agosto</th>
            <td>24295</td>
            <td>30330</td>
			<th>32004</th>
         </tr>
         <tr>
            <th>Septiembre</th>
            <td>29936</td>
            <td>32396</td>
			<th>38098</th>
         </tr>
         <tr>
            <th>Octubre</th>
            <td>56758</td>
            <td>50580</td>
			<th>59047</th>
         </tr>
         <tr>
            <th>Noviembre</th>
            <td>54139</td>
            <td>71492</td>
			<th>76084</th>
         </tr>
         <tr>
            <th>Diciembre</th>
            <td>58299</td>
            <td>87302</td>
			<th>52225</th>
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
            <td>59,913</td>
            <td>63,035</td>
			<th>100,390</th>
         </tr>
         <tr>
            <th>Febrero</th>
            <td>55,581</td>
            <td>67,000</td>
			<th>91,614</th>
         </tr>
         <tr>
            <th>Marzo</th>
            <td>52,592</td>
            <td>51,920</td>
			<th>91,951</th>
         </tr>
         <tr>
            <th>Abril</th>>
            <td>38,409</td>
            <td>48,941</td>
			<th>56,268</th>
         </tr>
         <tr>
            <th>Mayo</th>
            <td>39,705</td>
            <td>42,221</td>
			<th>52,864</th>
         </tr>
         <tr>
            <th>Junio</th>
            <td>21,909</td>
            <td>22,445</td>
			<th>28,678</th>
         </tr>
         <tr>
            <th>Julio</th>
            <td>19,414</td>
            <td>19,859</td>
			<th>29,071</th>
         </tr>
         <tr>
            <th>Agosto</th>
            <td>24,295</td>
            <td>30,330</td>
			<th>32,004</th>
         </tr>
         <tr>
            <th>Septiembre</th>
            <td>29,936</td>
            <td>32,396</td>
			<th>38,098</th>
         </tr>
         <tr>
            <th>Octubre</th>
            <td>56,758</td>
            <td>50,580</td>
			<th>59,047</th>
         </tr>
         <tr>
            <th>Noviembre</th>
            <td>54,139</td>
            <td>71,492</td>
			<th>76,084</th>
         </tr>
         <tr>
            <th>Diciembre</th>
            <td>58,299</td>
            <td>87,302</td>
			<th>52,225</th>
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