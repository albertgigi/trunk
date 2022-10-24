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
            <td>28083</td>
            <td>29585</td>
            <td>32229</td>
			<td>32229</td>
			<td>21926</td>
         </tr>
         <tr>
            <th>Febrero</th>
            <td>20656</td>
            <td>28062</td>
            <td>38699</td>
			<td>30851</td>
            <td>31918</td>
         </tr>
         <tr>
            <th>Marzo</th>
            <td>13143</td>
            <td>30963</td>
            <td>85845</td>
			<td>33347</td>
            <td>56134</td>
         </tr>
         <tr>
            <th>Abril</th>
            <td>27981</td>
            <td>25601</td>
            <td>113725</td>
			<td>38798</td>
            <td>56365</td>
         </tr>
         <tr>
            <th>Mayo</th>
            <td>29634</td>
            <td>28869</td>
            <td>59781</td>
			<th>76013</th>
            <td>84008</td>
         </tr>
         <tr>
            <th>Junio</th>
            <td>1812</td>
            <td>61358</td>
            <td>72585</td>
			<th>85129</th>
            <td>75709</td>
         </tr>
         <tr>
            <th>Julio</th>
            <td>26435</td>
            <td>28879</td>
            <td>73184</td>
			<th>94901</th>
            <td>107928</td>
         </tr>
         <tr>
            <th>Agosto</th>
            <td>26977</td>
            <td>37956</td>
            <td>73025</td>
			<th>91658</th>
            <td>112908</td>
         </tr>
         <tr>
            <th>Septiembre</th>
            <td>28162</td>
            <td>62039</td>
            <td>62713</td>
			<th>79024</th>
            <td>81343</td>
         </tr>
         <tr>
            <th>Octubre</th>
            <td>28907</td>
            <td>75165</td>
            <td>60155</td>
			<th>72183</th>
            <td>68422</td>
         </tr>
         <tr>
            <th>Noviembre</th>
            <td>30202</td>
            <td>48286</td>
            <td>29694</td>
			<th>30082</th>
            <td>59718</td>
         </tr>
         <tr>
            <th>Diciembre</th>
            <td>29589</td>
            <td>34840</td>
            <td>25089</td>
			<th>31715</th>
            <td>24242</td>
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
            <td>28,083</td>
            <td>29,585</td>
            <td>32,229</td>
			<td>22,246</td>
            <td>21,926</td>
         </tr>
         <tr>
            <th>Febrero</th>
            <td>20,656</td>
            <td>28,062</td>
            <td>38,699</td>
			<td>30,851</td>
            <td>31,918</td>
         </tr>
         <tr>
            <th>Marzo</th>
            <td>13,143</td>
            <td>30,963</td>
            <td>85,845</td>
			<td>33,347</td>
            <td>56,134</td>
         </tr>
         <tr>
            <th>Abril</th>
            <td>27,981</td>
            <td>25,601</td>
            <td>113,725</td>
			<td>38,798</td>
            <td>56,365</td>
         </tr>
         <tr>
            <th>Mayo</th>
            <td>29,634</td>
            <td>28,869</td>
            <td>59,781</td>
			<th>76,013</th>
            <td>84,008</td>
         </tr>
         <tr>
            <th>Junio</th>
            <td>1,812</td>
            <td>61,358</td>
            <td>72,585</td>
			<th>85,129</th>
            <td>75,709</td>
         </tr>
         <tr>
            <th>Julio</th>
            <td>26,435</td>
            <td>28,879</td>
            <td>73,184</td>
			<th>94,901</th>
            <td>107,928</td>
         </tr>
         <tr>
            <th>Agosto</th>
            <td>26,977</td>
            <td>37,956</td>
            <td>73,025</td>
			<th>91,658</th>
            <td>112,908</td>
         </tr>
         <tr>
            <th>Septiembre</th>
            <td>28,162</td>
            <td>62,039</td>
            <td>62,713</td>
			<th>79,024</th>
            <td>81,343</td>
         </tr>
         <tr>
            <th>Octubre</th>
            <td>28,907</td>
            <td>75,165</td>
            <td>60,155</td>
			<th>72,183</th>
            <td>68,422</td>
         </tr>
         <tr>
            <th>Noviembre</th>
            <td>30,202</td>
            <td>48,286</td>
            <td>29,694</td>
			<th>30,082</th>
            <td>59,718</td>
         </tr>
         <tr>
            <th>Diciembre</th>
            <td>29,589</td>
            <td>34,840</td>
            <td>25,089</td>
			<th>31,715</th>
            <td>24,242</td>
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