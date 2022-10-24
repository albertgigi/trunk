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
            <td>139195</td>
            <td>131494</td>
			<td>118835</td>
         </tr>
         <tr>
            <th>Febrero</th>
            <td>157628</td>
            <td>136736</td>
			<td>134471</td>
         </tr>
         <tr>
            <th>Marzo</th>
            <td>190800</td>
            <td>164566</td>
			<td>167811</td>
         </tr>
         <tr>
            <th>Abril</th>
            <td>168091</td>
            <td>178249</td>
			<td>169159</td>
         </tr>
         <tr>
            <th>Mayo</th>
            <td>246471</td>
            <td>252974</td>
			<td>254510</td>
         </tr>
         <tr>
            <th>Junio</th>
            <td>269137</td>
            <td>253165</td>
			<td>268411</td>
         </tr>
         <tr>
            <th>Julio</th>
            <td>253925</td>
            <td>267028</td>
			<td>278227</td>
         </tr>
         <tr>
            <th>Agosto</th>
            <td>310228</td>
            <td>310429</td>
			<td>323390</td>
         </tr>
         <tr>
            <th>Septiembre</th>
            <td>237477</td>
            <td>243529</td>
			<td>252406</td>
         </tr>
         <tr>
            <th>Octubre</th>
            <td>195086</td>
            <td>195918</td>
			<td>234240</td>
         </tr>
         <tr>
            <th>Noviembre</th>
            <td>166938</td>
            <td>153544</td>
			<td>302998</td>
         </tr>
         <tr>
            <th>Diciembre</th>
            <td>127367</td>
            <td>112037</td>
			<td>119167</td>
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
            <td>139,195 kWh</td>
            <td>131,494 kWh</td>
			<td>118,835 kWh</td>
         </tr>
         <tr>
            <th>Febrero</th>
            <td>157,628 kWh</td>
            <td>136,736 kWh</td>
			<td>134,471 kWh</td>
         </tr>
         <tr>
            <th>Marzo</th>
            <td>190,800 kWh</td>
            <td>164,566 kWh</td>
			<td>167,811 kWh</td>
         </tr>
         <tr>
            <th>Abril</th>
            <td>168,091 kWh</td>
            <td>178,249 kWh</td>
			<td>169,159 kWh</td>
         </tr>
         <tr>
            <th>Mayo</th>
            <td>246,471 kWh</td>
            <td>252,974 kWh</td>
			<td>254,510 kWh</td>
         </tr>
         <tr>
            <th>Junio</th>
            <td>269,137 kWh</td>
            <td>253,165 kWh</td>
			<td>268,411 kWh</td>
         </tr>
         <tr>
            <th>Julio</th>
            <td>253,925 kWh</td>
            <td>267,028 kWh</td>
			<td>278,227 kWh</td>
         </tr>
         <tr>
            <th>Agosto</th>
            <td>310,228 kWh</td>
            <td>310,429 kWh</td>
			<td>323,390 kWh</td>
         </tr>
         <tr>
            <th>Septiembre</th>
            <td>237,477 kWh</td>
            <td>243,529 kWh</td>
			<td>252,406 kWh</td>
         </tr>
         <tr>
            <th>Octubre</th>
            <td>195,086 kWh</td>
            <td>195,918 kWh</td>
			<td>234,240 kWh</td>
         </tr>
         <tr>
            <th>Noviembre</th>
            <td>166,938 kWh</td>
            <td>153,544 kWh</td>
			<td>302,998 kWh</td>
         </tr>
         <tr>
            <th>Diciembre</th>
            <td>127,367 kWh</td>
            <td>112,037 kWh</td>
			<td>119,167 kWh</td>
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