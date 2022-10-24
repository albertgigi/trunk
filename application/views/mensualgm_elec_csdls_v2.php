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
            <td>1651188</td>
            <td>1491590</td>
			<td>1469622</td>
         </tr>
         <tr>
            <th>Febrero</th>
            <td>1868887</td>
            <td>1651012</td>
			<td>1604986</td>
         </tr>
         <tr>
            <th>Marzo</th>
            <td>2279159</td>
            <td>1994040</td>
			<td>1926797</td>
         </tr>
         <tr>
            <th>Abril</th>
            <td>1968419</td>
            <td>2059000</td>
			<td>2042659</td>
         </tr>
         <tr>
            <th>Mayo</th>
            <td>2801859</td>
            <td>2799364</td>
			<td>2891772</td>
         </tr>
         <tr>
            <th>Junio</th>
            <td>3015044</td>
            <td>2936522</td>
			<td>2919800</td>
         </tr>
         <tr>
            <th>Julio</th>
            <td>2822457</td>
            <td>3043030</td>
			<td>2970394</td>
         </tr>
         <tr>
            <th>Agosto</th>
            <td>3334193</td>
            <td>3349996</td>
			<td>3473514</td>
         </tr>
         <tr>
            <th>Septiembre</th>
            <td>2754848</td>
            <td>2734434</td>
			<td>2787788</td>
         </tr>
         <tr>
            <th>Octubre</th>
            <td>2351856</td>
            <td>2397730</td>
			<td>2626035</td>
         </tr>
         <tr>
            <th>Noviembre</th>
            <td>1998132</td>
            <td>1811523</td>
			<td>3629425</td>
         </tr>
         <tr>
            <th>Diciembre</th>
            <td>1507857</td>
            <td>1466417</td>
			<td>1551982</td>
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
            <td>1,651,188 kWh</td>
            <td>1,491,590 kWh</td>
			<td>1,469,622 kWh</td>
         </tr>
         <tr>
            <th>Febrero</th>
            <td>1,868,887 kWh</td>
            <td>1,651,012 kWh</td>
			<td>1,604,986 kWh</td>
         </tr>
         <tr>
            <th>Marzo</th>
            <td>2,279,159 kWh</td>
            <td>1,994,040 kWh</td>
			<td>1,926,797 kWh</td>
         </tr>
         <tr>
            <th>Abril</th>
            <td>1,968,419 kWh</td>
            <td>2,059,000 kWh</td>
			<td>2,042,659 kWh</td>
         </tr>
         <tr>
            <th>Mayo</th>
            <td>2,801,859 kWh</td>
            <td>2,799,364 kWh</td>
			<td>2,891,772 kWh</td>
         </tr>
         <tr>
            <th>Junio</th>
            <td>3,015,044 kWh</td>
            <td>2,936,522 kWh</td>
			<td>2,919,800 kWh</td>
         </tr>
         <tr>
            <th>Julio</th>
            <td>2,822,457 kWh</td>
            <td>3,043,030 kWh</td>
			<td>2,970,394 kWh</td>
         </tr>
         <tr>
            <th>Agosto</th>
            <td>3,334,193 kWh</td>
            <td>3,349,996 kWh</td>
			<td>3,473,514 kWh</td>
         </tr>
         <tr>
            <th>Septiembre</th>
            <td>2,754,848 kWh</td>
            <td>2,734,434 kWh</td>
			<td>2,787,788 kWh</td>
         </tr>
         <tr>
            <th>Octubre</th>
            <td>2,351,856 kWh</td>
            <td>2,397,730 kWh</td>
			<td>2,626,035 kWh</td>
         </tr>
         <tr>
            <th>Noviembre</th>
            <td>1,998,132 kWh</td>
            <td>1,811,523 kWh</td>
			<td>3,629,425 kWh</td>
         </tr>
         <tr>
            <th>Diciembre</th>
            <td>1,507,857 kWh</td>
            <td>1,466,417 kWh</td>
			<td>1,551,982 kWh</td>
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
        text: 'Campus Ciencias de la Salud'
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