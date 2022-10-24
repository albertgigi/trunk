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
            <td>9337</td>
            <td>6625</td>
			<th>7262</th>
         </tr>
         <tr>
            <th>Febrero</th>
            <td>9298</td>
            <td>7974</td>
			<th>8892</th>
         </tr>
         <tr>
            <th>Marzo</th>
            <td>9294</td>
            <td>8215</td>
			<th>8078</th>
         </tr>
         <tr>
            <th>Abril</th>
            <td>10616</td>
            <td>10892</td>
			<th>10170</th>
         </tr>
         <tr>
            <th>Mayo</th>
            <td>10965</td>
            <td>10620</td>
			<th>9404</th>
         </tr>
         <tr>
            <th>Junio</th>
            <td>9574</td>
            <td>11360</td>
			<th>11230</th>
         </tr>
         <tr>
            <th>Julio</th>
            <td>10993</td>
            <td>10176</td>
			<th>9189</th>
         </tr>
         <tr>
            <th>Agosto</th>
            <td>11340</td>
            <td>11757</td>
			<th>11697</th>
         </tr>
         <tr>
            <th>Septiembre</th>
            <td>12537</td>
            <td>13453</td>
			<th>12494</th>
         </tr>
         <tr>
            <th>Octubre</th>
            <td>10679</td>
            <td>8346</td>
			<th>9431</th>
         </tr>
         <tr>
            <th>Noviembre</th>
            <td>10055</td>
            <td>9200</td>
			<th>10716</th>
         </tr>
         <tr>
            <th>Diciembre</th>
            <td>8513</td>
            <td>7070</td>
			<th>12439</th>
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
            <td>9,337</td>
            <td>6,625</td>
			<th>7,262</th>
         </tr>
         <tr>
            <th>Febrero</th>
            <td>9,298</td>
            <td>7,974</td>
			<th>8,892</th>
         </tr>
         <tr>
            <th>Marzo</th>
            <td>9,294</td>
            <td>8,215</td>
			<th>8,078</th>
         </tr>
         <tr>
            <th>Abril</th>
            <td>10,616</td>
            <td>10,892</td>
			<th>10,170</th>
         </tr>
         <tr>
            <th>Mayo</th>
            <td>10,965</td>
            <td>10,620</td>
			<th>9,404</th>
         </tr>
         <tr>
            <th>Junio</th>
            <td>9,574</td>
            <td>11,360</td>
			<th>11,230</th>
         </tr>
         <tr>
            <th>Julio</th>
            <td>10,993</td>
            <td>10,176</td>
			<th>9,189</th>
         </tr>
         <tr>
            <th>Agosto</th>
            <td>11,340</td>
            <td>11,757</td>
			<th>11,697</th>
         </tr>
         <tr>
            <th>Septiembre</th>
            <td>12,537</td>
            <td>13,453</td>
			<th>12,494</th>
         </tr>
         <tr>
            <th>Octubre</th>
            <td>10,679</td>
            <td>8,346</td>
			<th>9,431</th>
         </tr>
         <tr>
            <th>Noviembre</th>
            <td>10,055</td>
            <td>9,200</td>
			<th>10,716</th>
         </tr>
         <tr>
            <th>Diciembre</th>
            <td>8,513</td>
            <td>7,070</td>
			<th>12,439</th>
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