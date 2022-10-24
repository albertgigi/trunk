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
            <td>1200</td>
            <td>1779</td>
            <td>1172</td>
			<td>1172</td>
            <td>1718</td>
         </tr>
         <tr>
            <th>Febrero</th>
            <td>2074</td>
            <td>1800</td>
            <td>1483</td>
			<td>1633</td>
            <td>2395</td>
         </tr>
         <tr>
            <th>Marzo</th>
            <td>1980</td>
            <td>1914</td>
            <td>1147</td>
			<td>2285</td>
            <td>1518</td>
         </tr>
         <tr>
            <th>Abril</th>
            <td>1786</td>
            <td>912</td>
            <td>1497</td>
			<td>1157</td>
            <td>25</td>
         </tr>
         <tr>
            <th>Mayo</th>
            <td>1925</td>
            <td>1864</td>
            <td>1942</td>
			<td>1381</td>
            <td>7</td>
         </tr>
         <tr>
            <th>Junio</th>
            <td>1900</td>
            <td>1532</td>
            <td>1521</td>
			<td>1982</td>
            <td>570</td>
         </tr>
         <tr>
            <th>Julio</th>
            <td>1653</td>
            <td>1567</td>
            <td>1618</td>
			<td>2147</td>
            <td>800</td>
         </tr>
         <tr>
            <th>Agosto</th>
            <td>1900</td>
            <td>1799</td>
            <td>1899</td>
			<td>2336</td>
            <td>744</td>
         </tr>
         <tr>
            <th>Septiembre</th>
            <td>1842</td>
            <td>1583</td>
            <td>1825</td>
			<td>1841</td>
            <td>537</td>
         </tr>
         <tr>
            <th>Octubre</th>
            <td>1724</td>
            <td>1324</td>
            <td>2275</td>
			<td>2140</td>
            <td>920</td>
         </tr>
         <tr>
            <th>Noviembre</th>
            <td>1649</td>
            <td>1583</td>
            <td>1985</td>
			<td>2639</td>
            <td>832</td>
         </tr>
         <tr>
            <th>Diciembre</th>
            <td>774</td>
            <td>861</td>
            <td>1170</td>
			<td>1205</td>
            <td>540</td>
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
            <td>1,200</td>
            <td>1,779</td>
            <td>1,172</td>
			<td>1,172</td>
            <td>1,718</td>
         </tr>
         <tr>
            <th>Febrero</th>
            <td>2,074</td>
            <td>1,800</td>
            <td>1,483</td>
			<td>1,633</td>
            <td>2,395</td>
         </tr>
         <tr>
            <th>Marzo</th>
            <td>1,980</td>
            <td>1,914</td>
            <td>1,147</td>
			<td>2,285</td>
            <td>1,518</td>
         </tr>
         <tr>
            <th>Abril</th>
            <td>1,786</td>
            <td>912</td>
            <td>1,497</td>
			<td>1,157</td>
            <td>25</td>
         </tr>
         <tr>
            <th>Mayo</th>
            <td>1,925</td>
            <td>1,864</td>
            <td>1,942</td>
			<td>1,381</td>
            <td>7</td>
         </tr>
         <tr>
            <th>Junio</th>
            <td>1,900</td>
            <td>1,532</td>
            <td>1,521</td>
			<td>1,982</td>
            <td>570</td>
         </tr>
         <tr>
            <th>Julio</th>
            <td>1,653</td>
            <td>1,567</td>
            <td>1,618</td>
			<td>2,147</td>
            <td>800</td>
         </tr>
         <tr>
            <th>Agosto</th>
            <td>1,900</td>
            <td>1,799</td>
            <td>1,899</td>
			<td>2,336</td>
            <td>744</td>
         </tr>
         <tr>
            <th>Septiembre</th>
            <td>1,842</td>
            <td>1,583</td>
            <td>1,825</td>
			<td>1,841</td>
            <td>537</td>
         </tr>
         <tr>
            <th>Octubre</th>
            <td>1,724</td>
            <td>1,324</td>
            <td>2,275</td>
			<td>2,140</td>
            <td>920</td>
         </tr>
         <tr>
            <th>Noviembre</th>
            <td>1,649</td>
            <td>1,583</td>
            <td>1,985</td>
			<td>2,639</td>
            <td>832</td>
         </tr>
         <tr>
            <th>Diciembre</th>
            <td>774</td>
            <td>861</td>
            <td>1,170</td>
			<td>1,205</td>
            <td>540</td>
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
        text: 'Campus de Ciencias Agropecuarias Escobedo N.L.'
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