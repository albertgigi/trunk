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
            <td>373164</td>
            <td>415642</td>
			   <td>381714</td>
         </tr>
         <tr>
            <th>Febrero</th>
            <td>458220</td>
            <td>407741</td>
			   <td>400886</td>
         </tr>
         <tr>
            <th>Marzo</th>
            <td>587873</td>
            <td>427806</td>
			   <td>496301</td>
         </tr>
         <tr>
            <th>Abril</th>
            <td>487676</td>
            <td>475618</td>
			   <td>457750</td>
         </tr>
         <tr>
            <th>Mayo</th>
            <td>738827</td>
            <td>743904</td>
			   <td>809608</td>
         </tr>
         <tr>
            <th>Junio</th>
            <td>780553</td>
            <td>763029</td>
			   <td>751866</td>
         </tr>
         <tr>
            <th>Julio</th>
            <td>714136</td>
            <td>740536</td>
			   <td>729688</td>
         </tr>
         <tr>
            <th>Agosto</th>
            <td>962264</td>
            <td>980918</td>
			   <td>1041116</td>
         </tr>
         <tr>
            <th>Septiembre</th>
            <td>826422</td>
            <td>769243</td>
			   <td>788815</td>
         </tr>
         <tr>
            <th>Octubre</th>
            <td>625316</td>
            <td>625592</td>
			   <td>722978</td>
         </tr>
         <tr>
            <th>Noviembre</th>
            <td>475867</td>
            <td>461731</td>
			   <td>485470</td>
         </tr>
         <tr>
            <th>Diciembre</th>
            <td>352976</td>
            <td>328532</td>
			   <td>313618</td>
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
			<th>2019</th>
         </tr>
      </thead>

      <tbody>
         <tr>
            <th>Enero</th>

            <td>373,164 kWh</td>
            <td>415,642 kWh</td>
			   <td>381,714 kWh</td>
         </tr>
         <tr>
            <th>Febrero</th>
            <td>458,220 kWh</td>
            <td>407,741 kWh</td>
			   <td>400,886 kWh</td>
         </tr>
         <tr>
            <th>Marzo</th>
            <td>587,873 kWh</td>
            <td>427,806 kWh</td>
			   <td>496,301 kWh</td>
         </tr>
         <tr>
            <th>Abril</th>
            <td>487,676 kWh</td>
            <td>475,618 kWh</td>
			   <td>457,750 kWh</td>
         </tr>
         <tr>
            <th>Mayo</th>
            <td>738,827 kWh</td>
            <td>743,904 kWh</td>
			   <td>809,608 kWh</td>
         </tr>
         <tr>
            <th>Junio</th>
            <td>780,553 kWh</td>
            <td>763,029 kWh</td>
			   <td>751,866 kWh</td>
         </tr>
         <tr>
            <th>Julio</th>
            <td>714,136 kWh</td>
            <td>740,536 kWh</td>
			<td>729,688 kWh</td>
         </tr>
         <tr>
            <th>Agosto</th>>
            <td>962,264 kWh</td>
            <td>980,918 kWh</td>
			   <td>1,041,116 kWh</td>
         </tr>
         <tr>
            <th>Septiembre</th>
            <td>826,422 kWh</td>
            <td>769,243 kWh</td>
			   <td>788,815 kWh</td>
         </tr>
         <tr>
            <th>Octubre</th>
            <td>625,316 kWh</td>
            <td>625,592 kWh</td>
			   <td>722,978 kWh</td>
         </tr>
         <tr>
            <th>Noviembre</th>
            <td>475,867 kWh</td>
            <td>461,731 kWh</td>
			   <td>485,470 kWh</td>
         </tr>
         <tr>
            <th>Diciembre</th>
            <td>352,976 kWh</td>
            <td>328,532 kWh</td>
			   <td>313,618 kWh</td>
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
        text: 'Campus Mederos'
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