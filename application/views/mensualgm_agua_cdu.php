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
            <td>74243</td>
            <td>107250</td>
            <td>56846</td>
			<td>55864</td>
            <td>51730</td>
         </tr>
         <tr>
            <th>Febrero</th>
            <td>78757</td>
            <td>96096</td>
            <td>64795</td>
			<td>52403</td>
            <td>57855</td>
         </tr>
         <tr>
            <th>Marzo</th>
            <td>75499</td>
            <td>104226</td>
            <td>63866</td>
			<td>57145</td>
            <td>58060</td>
         </tr>
         <tr>
            <th>Abril</th>
            <td>86307</td>
            <td>95378</td>
            <td>70918</td>
			<td>60708</td>
            <td>34991</td>
         </tr>
         <tr>
            <th>Mayo</th>
            <td>80477</td>
            <td>117435</td>
            <td>69387</td>
			<td>69283</td>
            <td>43547</td>
         </tr>
         <tr>
            <th>Junio</th>
            <td>77493</td>
            <td>108514</td>
            <td>73129</td>
			<td>58562</td>
            <td>41477</td>
         </tr>
         <tr>
            <th>Julio</th>
            <td>88368</td>
            <td>106035</td>
            <td>65395</td>
			<td>73506</td>
            <td>48355</td>
         </tr>
         <tr>
            <th>Agosto</th>
            <td>104928</td>
            <td>129052</td>
            <td>92427</td>
			<td>79623</td>
            <td>49529</td>
         </tr>
         <tr>
            <th>Septiembre</th>
            <td>89597</td>
            <td>105223</td>
            <td>75014</td>
			<td>58527</td>
            <td>51788</td>
         </tr>
         <tr>
            <th>Octubre</th>
            <td>99956</td>
            <td>91157</td>
            <td>72558</td>
			<td>71359</td>
            <td>47128</td>
         </tr>
         <tr>
            <th>Noviembre</th>
            <td>112540</td>
            <td>64565</td>
            <td>68198</td>
			<td>58277</td>
            <td>41306</td>
         </tr>
         <tr>
            <th>Diciembre</th>
            <td>97348</td>
            <td>53092</td>
            <td>53502</td>
			<td>52748</td>
            <td>40154</td>
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
            <td>74,243</td>
            <td>107,250</td>
            <td>56,846</td>
			<td>55,864</td>
            <td>51,730</td>
         </tr>
         <tr>
            <th>Febrero</th>
            <td>78,757</td>
            <td>96,096</td>
            <td>64,795</td>
			<td>52,403</td>
            <td>57,855</td>
         </tr>
         <tr>
            <th>Marzo</th>
            <td>75,499</td>
            <td>104,226</td>
            <td>63,866</td>
			<td>57,145</td>
            <td>58,060</td>
         </tr>
         <tr>
            <th>Abril</th>
            <td>86,307</td>
            <td>95,378</td>
            <td>70,918</td>
			<td>60,708</td>
            <td>34,991</td>
         </tr>
         <tr>
            <th>Mayo</th>
            <td>80,477</td>
            <td>117,435</td>
            <td>69,387</td>
			<td>69,283</td>
            <td>43,547</td>
         </tr>
         <tr>
            <th>Junio</th>
            <td>77,493</td>
            <td>108,514</td>
            <td>73,129</td>
			<td>58,562</td>
            <td>41,477</td>
         </tr>
         <tr>
            <th>Julio</th>
            <td>88,368</td>
            <td>106,035</td>
            <td>65,395</td>
			<td>73,506</td>
            <td>48,355</td>
         </tr>
         <tr>
            <th>Agosto</th>
            <td>104,928</td>
            <td>129,052</td>
            <td>92,427</td>
			<td>79,623</td>
            <td>49,529</td>
         </tr>
         <tr>
            <th>Septiembre</th>
            <td>89,597</td>
            <td>105,223</td>
            <td>75,014</td>
			<td>58,527</td>
            <td>51,788</td>
         </tr>
         <tr>
            <th>Octubre</th>
            <td>99,956</td>
            <td>91,157</td>
            <td>72,558</td>
			<td>71,359</td>
            <td>47,128</td>
         </tr>
         <tr>
            <th>Noviembre</th>
            <td>112,540</td>
            <td>64,565</td>
            <td>68,198</td>
			<td>58,277</td>
            <td>41,306</td>
         </tr>
         <tr>
            <th>Diciembre</th>
            <td>97,348</td>
            <td>53,092</td>
            <td>53,502</td>
			<td>52,748</td>
            <td>40,154</td>
			
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
        text: 'Ciudad Universitaria'
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