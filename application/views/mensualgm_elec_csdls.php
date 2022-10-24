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
            <td>1447309</td>
            <td>1651188</td>
            <td>1491590</td>
			<td>1469622</td>
            <td>1517830</td>
         </tr>
         <tr>
            <th>Febrero</th>
            <td>1699422</td>
            <td>1868887</td>
            <td>1651012</td>
			<td>1604986</td>
            <td>1545837</td>
         </tr>
         <tr>
            <th>Marzo</th>
            <td>1943158</td>
            <td>2279159</td>
            <td>1994040</td>
			<td>1926797</td>
            <td>1912184</td>
         </tr>
         <tr>
            <th>Abril</th>
            <td>2347916</td>
            <td>1968419</td>
            <td>2059000</td>
			<td>2042659</td>
            <td>1664858</td>
         </tr>
         <tr>
            <th>Mayo</th>
            <td>2671467</td>
            <td>2801859</td>
            <td>2799364</td>
			<td>2891772</td>
            <td>1973535</td>
         </tr>
         <tr>
            <th>Junio</th>
            <td>2813478</td>
            <td>3015044</td>
            <td>2936522</td>
			<td>2919800</td>
            <td>2086624</td>
         </tr>
         <tr>
            <th>Julio</th>
            <td>2959052</td>
            <td>2822457</td>
            <td>3043030</td>
			<td>2970394</td>
			<td>2215998</td>
         </tr>
         <tr>
            <th>Agosto</th>
            <td>3166752</td>
            <td>3334193</td>
            <td>3349996</td>
			<td>3473514</td>
            <td>2265367</td>
         </tr>
         <tr>
            <th>Septiembre</th>
            <td>2849915</td>
            <td>2754848</td>
            <td>2734434</td>
			<td>2787788</td>
            <td>1945455</td>
         </tr>
         <tr>
            <th>Octubre</th>
            <td>2590243</td>
            <td>2351856</td>
            <td>2397730</td>
			<td>2626035</td>
            <td>1934164</td>
         </tr>
         <tr>
            <th>Noviembre</th>
            <td>2001350</td>
            <td>1998132</td>
            <td>1811523</td>
			<td>1829425</td>
            <td>1549168</td>
         </tr>
         <tr>
            <th>Diciembre</th>
            <td>1490072</td>
            <td>1507857</td>
            <td>1466417</td>
			<td>1551982</td>
            <td>1301521</td>
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
            <td>1,447,309 kWh</td>
            <td>1,651,188 kWh</td>
            <td>1,491,590 kWh</td>
			<td>1,469,622 kWh</td>
			<td>1,517,830 kWh</td>
         </tr>
         <tr>
            <th>Febrero</th>
            <td>1,699,422 kWh</td>
            <td>1,868,887 kWh</td>
            <td>1,651,012 kWh</td>
			<td>1,604,986 kWh</td>
			<td>1,545,837 kWh</td>
         </tr>
         <tr>
            <th>Marzo</th>
            <td>1,943,158 kWh</td>
            <td>2,279,159 kWh</td>
            <td>1,994,040 kWh</td>
			<td>1,926,797 kWh</td>
			<td>1,912,184 kWh</td>
         </tr>
         <tr>
            <th>Abril</th>
            <td>2,347,916 kWh</td>
            <td>1,968,419 kWh</td>
            <td>2,059,000 kWh</td>
			<td>2,042,659 kWh</td>
			<td>1,664,858 kWh</td>
         </tr>
         <tr>
            <th>Mayo</th>
            <td>2,671,467 kWh</td>
            <td>2,801,859 kWh</td>
            <td>2,799,364 kWh</td>
			<td>2,891,772 kWh</td>
			<td>1,973,535 kWh</td>
         </tr>
         <tr>
            <th>Junio</th>
            <td>2,813,478 kWh</td>
            <td>3,015,044 kWh</td>
            <td>2,936,522 kWh</td>
			<td>2,919,800 kWh</td>
			<td>2,086,624 kWh</td>
         </tr>
         <tr>
            <th>Julio</th>
            <td>2,959,052 kWh</td>
            <td>2,822,457 kWh</td>
            <td>3,043,030 kWh</td>
			<td>2,970,394 kWh</td>
			<td>2,215,998 kWh</td>
         </tr>
         <tr>
            <th>Agosto</th>
            <td>3,166,752 kWh</td>
            <td>3,334,193 kWh</td>
            <td>3,349,996 kWh</td>
			<td>3,473,514 kWh</td>
			<td>2,265,367 kWh</td>
         </tr>
         <tr>
            <th>Septiembre</th>
            <td>2,849,915 kWh</td>
            <td>2,754,848 kWh</td>
            <td>2,734,434 kWh</td>
			<td>2,787,788 kWh</td>
			<td>1,945,455 kWh</td>
         </tr>
         <tr>
            <th>Octubre</th>
            <td>2,590,243 kWh</td>
            <td>2,351,856 kWh</td>
            <td>2,397,730 kWh</td>
			<td>2,626,035 kWh</td>
			<td>1,934,164 kWh</td>
         </tr>
         <tr>
            <th>Noviembre</th>
            <td>2,001,350 kWh</td>
            <td>1,998,132 kWh</td>
            <td>1,811,523 kWh</td>
			<td>1,829,425 kWh</td>
			<td>1,549,168 kWh</td>
         </tr>
         <tr>
            <th>Diciembre</th>
            <td>1,490,072 kWh</td>
            <td>1,507,857 kWh</td>
            <td>1,466,417 kWh</td>
			<td>1,551,982 kWh</td>
			<td>1,301,521 kWh</td>
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
        text: 'Campus Ciencias de la Salud'
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