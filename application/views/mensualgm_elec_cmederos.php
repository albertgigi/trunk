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
            <td>413899</td>
            <td>373164</td>
            <td>415642</td>
			<td>381714</td>
            <td>350256</td>
         </tr>
         <tr>
            <th>Febrero</th>
            <td>432382</td>
            <td>458220</td>
            <td>407741</td>
			<td>400886</td>
            <td>390700</td>
         </tr>
         <tr>
            <th>Marzo</th>
            <td>105566</td>
            <td>587873</td>
            <td>427806</td>
			<td>496301</td>
            <td>371554</td>
         </tr>
         <tr>
            <th>Abril</th>
            <td>612458</td>
            <td>487676</td>
            <td>475618</td>
			<td>457750</td>
            <td>222467</td>
         </tr>
         <tr>
            <th>Mayo</th>
            <td>705284</td>
            <td>738827</td>
            <td>743904</td>
			<td>809608</td>
            <td>231752</td>
         </tr>
         <tr>
            <th>Junio</th>
            <td>711067</td>
            <td>780553</td>
            <td>763029</td>
			<td>751866</td>
            <td>239392</td>
         </tr>
         <tr>
            <th>Julio</th>
            <td>774476</td>
            <td>714136</td>
            <td>740536</td>
			<td>729688</td>
            <td>343405</td>
         </tr>
         <tr>
            <th>Agosto</th>
            <td>910770</td>
            <td>962264</td>
            <td>980918</td>
			<td>1041116</td>
            <td>335920</td>
         </tr>
         <tr>
            <th>Septiembre</th>
            <td>852502</td>
            <td>826422</td>
            <td>769243</td>
			<td>788815</td>
            <td>305392</td>
         </tr>
         <tr>
            <th>Octubre</th>
            <td>723065</td>
            <td>625316</td>
            <td>625592</td>
			<td>722978</td>
            <td>251012</td>
         </tr>
         <tr>
            <th>Noviembre</th>
            <td>511772</td>
            <td>475867</td>
            <td>461731</td>
			<td>485470</td>
            <td>211618</td>
         </tr>
         <tr>
            <th>Diciembre</th>
            <td>356209</td>
            <td>352976</td>
            <td>328532</td>
			<td>313618</td>
            <td>192039</td>
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
            <td>413,899 kWh</td>
            <td>373,164 kWh</td>
            <td>415,642 kWh</td>
			<td>381,714 kWh</td>
            <td>350,256  kWh</td>
         </tr>
         <tr>
            <th>Febrero</th>
            <td>432,382 kWh</td>
            <td>458,220 kWh</td>
            <td>407,741 kWh</td>
			<td>400,886 kWh</td>
            <td>390,700 kWh</td>
         </tr>
         <tr>
            <th>Marzo</th>
            <td>105,566 kWh</td>
            <td>587,873 kWh</td>
            <td>427,806 kWh</td>
			<td>496,301 kWh</td>
            <td>371,554 kWh</td>
         </tr>
         <tr>
            <th>Abril</th>
            <td>612,458 kWh</td>
            <td>487,676 kWh</td>
            <td>475,618 kWh</td>
			<td>457,750 kWh</td>
            <td>222,467 kWh</td>
         </tr>
         <tr>
            <th>Mayo</th>
            <td>705,284 kWh</td>
            <td>738,827 kWh</td>
            <td>743,904 kWh</td>
			<td>809,608 kWh</td>
            <td>231,752 kWh</td>
         </tr>
         <tr>
            <th>Junio</th>
            <td>711,067 kWh</td>
            <td>780,553 kWh</td>
            <td>763,029 kWh</td>
			<td>751,866 kWh</td>
            <td>239,392 kWh</td>
         </tr>
         <tr>
            <th>Julio</th>
            <td>774,476 kWh</td>
            <td>714,136 kWh</td>
            <td>740,536 kWh</td>
			<td>729,688 kWh</td>
            <td>343,405 kWh</td>
         </tr>
         <tr>
            <th>Agosto</th>
            <td>910,770 kWh</td>
            <td>962,264 kWh</td>
            <td>980,918 kWh</td>
			<td>1,041,116 kWh</td>
            <td>335,920 kWh</td>
         </tr>
         <tr>
            <th>Septiembre</th>
            <td>852,502 kWh</td>
            <td>826,422 kWh</td>
            <td>769,243 kWh</td>
			<td>788,815 kWh</td>
            <td>305,392 kWh</td>
         </tr>
         <tr>
            <th>Octubre</th>
            <td>723,065 kWh</td>
            <td>625,316 kWh</td>
            <td>625,592 kWh</td>
			<td>722,978 kWh</td>
            <td>251,012 kWh</td>
         </tr>
         <tr>
            <th>Noviembre</th>
            <td>511,772 kWh</td>
            <td>475,867 kWh</td>
            <td>461,731 kWh</td>
			<td>485,470 kWh</td>
            <td>211,618 kWh</td>
         </tr>
         <tr>
            <th>Diciembre</th>
            <td>356,209 kWh</td>
            <td>352,976 kWh</td>
            <td>328,532 kWh</td>
			<td>313,618 kWh</td>
            <td>192,039 kWh</td>
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
        text: 'Campus Mederos'
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