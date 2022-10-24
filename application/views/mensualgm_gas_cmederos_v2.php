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
            <td>3333</td>
            <td>9362</td>
			<th>7218</th>
         </tr>
         <tr>
            <th>Febrero</th>
            <td>7264</td>
            <td>6479</td>
			<th>7330</th>
         </tr>
         <tr>
            <th>Marzo</th>
            <td>5307</td>
            <td>6537</td>
			<th>6932</th>
         </tr>
         <tr>
            <th>Abril</th>
            <td>3112</td>
            <td>5588</td>
			<th>5165</th>
         </tr>
         <tr>
            <th>Mayo</th>
            <td>3750</td>
            <td>7007</td>
			<th>6445</th>
         </tr>
         <tr>
            <th>Junio</th>
            <td>3531</td>
            <td>3860</td>
			<th>5937</th>
         </tr>
         <tr>
            <th>Julio</th>
            <td>2559</td>
            <td>3215</td>
			<th>3736</th>
         </tr>
         <tr>
            <th>Agosto</th>
            <td>2523</td>
            <td>2182</td>
			<th>3874</th>
         </tr>
         <tr>
            <th>Septiembre</th>
            <td>4250</td>
            <td>4474</td>
			<th>4041</th>
         </tr>
         <tr>
            <th>Octubre</th>
            <td>5306</td>
            <td>5536</td>
			<th>4365</th>
         </tr>
         <tr>
            <th>Noviembre</th>
            <td>4857</td>
            <td>7944</td>
			<th>6629</th>
         </tr>
         <tr>
            <th>Diciembre</th>
            <td>8551</td>
            <td>5613</td>
			<th>5340</th>
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
            <td>3,333</td>
            <td>9,362</td>
			<th>7,218</th>
         </tr>
         <tr>
            <th>Febrero</th>
            <td>7,264</td>
            <td>6,479</td>
			<th>7,330</th>
         </tr>
         <tr>
            <th>Marzo</th>
            <td>5,307</td>
            <td>6,537</td>
			<th>6,932</th>
         </tr>
         <tr>
            <th>Abril</th>
            <td>3,112</td>
            <td>5,588</td>
			<th>5,165</th>
         </tr>
         <tr>
            <th>Mayo</th>
            <td>3,750</td>
            <td>7,007</td>
			<th>6,445</th>
         </tr>
         <tr>
            <th>Junio</th>
            <td>3,531</td>
            <td>3,860</td>
			<th>5,937</th>
         </tr>
         <tr>
            <th>Julio</th>
            <td>2,559</td>
            <td>3,215</td>
			<th>3,736</th>
         </tr>
         <tr>
            <th>Agosto</th>
            <td>2,523</td>
            <td>2,182</td>
			<th>3,874</th>
         </tr>
         <tr>
            <th>Septiembre</th>
            <td>4,250</td>
            <td>4,474</td>
			<th>4,041</th>
         </tr>
         <tr>
            <th>Octubre</th>
            <td>5,306</td>
            <td>5,536</td>
			<th>4,365</th>
         </tr>
         <tr>
            <th>Noviembre</th>
            <td>4,857</td>
            <td>7,944</td>
			<th>6,629</th>
         </tr>
         <tr>
            <th>Diciembre</th>
            <td>8,551</td>
            <td>5,613</td>
			<th>5,340</th>
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