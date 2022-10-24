<?php echo form_open(); ?>
<!--ACTUALMENTE NO HAY CAMPUS LINARES PARA AGUA-->
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
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="<?php echo base_url(); ?>assets/js/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="<?php echo base_url(); ?>assets/js/highcharts-3d.js"></script> <!--OJO ES RECOMENDABLE USAR LA OPCION DE 3D ALOJADA EN EL SERVIDOR-->
<div id = "container" style = "width: 100%; height: 730px; margin: 0 auto"></div>

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
            <td>57185</td>
            <td>52805</td>
         </tr>
         <tr>
            <th>Febrero</th>
            <td>59008</td>
            <td>53278</td>
         </tr>
         <tr>
            <th>Marzo</th>
            <td>54804</td>
            <td>59629</td>
            <td>74126</td>
            <td>53818</td>
         </tr>
         <tr>
            <th>Abril</th>
            <td>53443</td>
            <td>82188</td>
            <td>57548</td>
            <td>57906</td>
         </tr>
         <tr>
            <th>Mayo</th>
            <td>78624</td>
            <td>97957</td>
            <td>115146</td>
            <td>98559</td>
         </tr>
         <tr>
            <th>Junio</th>
            <td>85218</td>
            <td>98405</td>
            <td>111542</td>
            <td>109905</td>
         </tr>
         <tr>
            <th>Julio</th>
            <td>87975</td>
            <td>98104</td>
            <td>91640</td>
            <td>101162</td>
         </tr>
         <tr>
            <th>Agosto</th>
            <td>135685</td>
            <td>142914</td>
            <td>137859</td>
            <td>133168</td>
         </tr>
         <tr>
            <th>Septiembre</th>
            <td>125620</td>
            <td>117546</td>
            <td>114925</td>
            <td>98195</td>
         </tr>
         <tr>
            <th>Octubre</th>
            <td>93272</td>
            <td>99184</td>
            <td>83691</td>
            <td>87284</td>
         </tr>
         <tr>
            <th>Noviembre</th>
            <td>67509</td>
            <td>67876</td>
            <td>62642</td>
            <td>57497</td>
         </tr>
         <tr>
            <th>Diciembre</th>
            <td>44577</td>
            <td>48188</td>
            <td>48441</td>
            <td>44689</td>
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
         </tr>
      </thead>

      <tbody>
         <tr>
            <th>Enero</th>
            <td>55,427 kWh</td>
            <td>49,732 kWh</td>
            <td>57,185 kWh</td>
            <td>52,805 kWh</td>
         </tr>
         <tr>
            <th>Febrero</th>
            <td>50,632 kWh</td>
            <td>57,992 kWh</td>
            <td>59,008 kWh</td>
            <td>53,278 kWh</td>
         </tr>
         <tr>
            <th>Marzo</th>
            <td>54,804 kWh</td>
            <td>59,629 kWh</td>
            <td>74,126 kWh</td>
            <td>53,818 kWh</td>
         </tr>
         <tr>
            <th>Abril</th>
            <td>53,443 kWh</td>
            <td>82,188 kWh</td>
            <td>57,548 kWh</td>
            <td>57,906 kWh</td>
         </tr>
         <tr>
            <th>Mayo</th>
            <td>78,624 kWh</td>
            <td>97,957 kWh</td>
            <td>115,146 kWh</td>
            <td>98,559 kWh</td>
         </tr>
         <tr>
            <th>Junio</th>
            <td>85,218 kWh</td>
            <td>98,405 kWh</td>
            <td>111,542 kWh</td>
            <td>109,905 kWh</td>
         </tr>
         <tr>
            <th>Julio</th>
            <td>87,975 kWh</td>
            <td>98,104 kWh</td>
            <td>91,640 kWh</td>
            <td>101,162 kWh</td>
         </tr>
         <tr>
            <th>Agosto</th>
            <td>135,685 kWh</td>
            <td>142,914 kWh</td>
            <td>137,859 kWh</td>
            <td>133,168 kWh</td>
         </tr>
         <tr>
            <th>Septiembre</th>
            <td>125,620 kWh</td>
            <td>117,546 kWh</td>
            <td>114,925 kWh</td>
            <td>98,195 kWh</td>
         </tr>
         <tr>
            <th>Octubre</th>
            <td>93,272 kWh</td>
            <td>99,184 kWh</td>
            <td>83,691 kWh</td>
            <td>87,284 kWh</td>
         </tr>
         <tr>
            <th>Noviembre</th>
            <td>67,509 kWh</td>
            <td>67,876 kWh</td>
            <td>62,642 kWh</td>
            <td>57,497 kWh</td>
         </tr>
         <tr>
            <th>Diciembre</th>
            <td>44,577 kWh</td>
            <td>48,188 kWh</td>
            <td>48,441 kWh</td>
            <td>44,689 kWh</td>
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
        text: 'Campus Linares'
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
                     x: 1,
                     y: 0,
                     color: (Highcharts.theme && Highcharts.theme.dataLabelsColor)
                        || 'black',
                     style: {
                        textShadow: '0 0 3px white'
                     },
                  },
               },
            },
    yAxis: {
        allowDecimals: false,
        title: {
            text: 'Units'
        }
    },
    tooltip: {
        formatter: function () {
            return '<b>' + this.series.name + '</b><br/>' +
                this.point.y + ' ' + this.point.name.toLowerCase();
        }
    }
});
</script>