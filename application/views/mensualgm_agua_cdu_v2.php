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
            <th></th>>
            <th>2017</th>
            <th>2018</th>
			<th>2019</th>
         </tr>
      </thead>

      <tbody>
         <tr>
            <th>Enero</th>
            <td>107250</td>
            <td>56846</td>
			<td>55864</td>
         </tr>
         <tr>
            <th>Febrero</th>
            <td>96096</td>
            <td>64795</td>
			<td>52403</td>
         </tr>
         <tr>
            <th>Marzo</th>
            <td>104226</td>
            <td>63866</td>
			<td>57145</td>
         </tr>
         <tr>
            <th>Abril</th>
            <td>95378</td>
            <td>70918</td>
			<td>60708</td>
         </tr>
         <tr>
            <th>Mayo</th>
            <td>117435</td>
            <td>69387</td>
			<td>69283</td>
         </tr>
         <tr>
            <th>Junio</th>>
            <td>108514</td>
            <td>73129</td>
			<td>58562</td>
         </tr>
         <tr>
            <th>Julio</th>
            <td>106035</td>
            <td>65395</td>
			<td>73506</td>
         </tr>
         <tr>
            <th>Agosto</th>>
            <td>129052</td>
            <td>92427</td>
			<td>79623</td>
         </tr>
         <tr>
            <th>Septiembre</th>
            <td>105223</td>
            <td>75014</td>
			<td>58527</td>
         </tr>
         <tr>
            <th>Octubre</th>
            <td>91157</td>
            <td>72558</td>
			<td>71359</td>
         </tr>
         <tr>
            <th>Noviembre</th>
            <td>64565</td>
            <td>68198</td>
			<td>58277</td>
         </tr>
         <tr>
            <th>Diciembre</th>
            <td>53092</td>
            <td>53502</td>
			<td>52748</td>
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
            <td>107,250</td>
            <td>56,846</td>
			<td>55,864</td>
         </tr>
         <tr>
            <th>Febrero</th>>
            <td>96,096</td>
            <td>64,795</td>
			<td>52,403</td>
         </tr>
         <tr>
            <th>Marzo</th>
            <td>104,226</td>
            <td>63,866</td>
			<td>57,145</td>
         </tr>
         <tr>
            <th>Abril</th>>
            <td>95,378</td>
            <td>70,918</td>
			<td>60,708</td>
         </tr>
         <tr>
            <th>Mayo</th>>
            <td>117,435</td>
            <td>69,387</td>
			<td>69,283</td>
         </tr>
         <tr>
            <th>Junio</th>d>
            <td>108,514</td>
            <td>73,129</td>
			<td>58,562</td>
         </tr>
         <tr>
            <th>Julio</th>>
            <td>106,035</td>
            <td>65,395</td>
			<td>73,506</td>
         </tr>
         <tr>
            <th>Agosto</th>
            <td>129,052</td>
            <td>92,427</td>
			<td>79,623</td>
         </tr>
         <tr>
            <th>Septiembre</th>
            <td>105,223</td>
            <td>75,014</td>
			<td>58,527</td>
         </tr>
         <tr>
            <th>Octubre</th>
            <td>91,157</td>
            <td>72,558</td>
			<td>71,359</td>
         </tr>
         <tr>
            <th>Noviembre</th>
            <td>64,565</td>
            <td>68,198</td>
			<td>58,277</td>
         </tr>
         <tr>
            <th>Diciembre</th>
            <td>53,092</td>
            <td>53,502</td>
			<td>52,748</td>
			
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