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
            <td>32265</td>
            <td>36939</td>
			<th>30157</th>
         </tr>
         <tr>
            <th>Febrero</th>
            <td>32558</td>
            <td>34495</td>
			<th>31512</th>
         </tr>
         <tr>
            <th>Marzo</th>
            <td>39031</td>
            <td>31979</td>
			<th>34222</th>
         </tr>
         <tr>
            <th>Abril</th>
            <td>32578</td>
            <td>32723</td>
			<th>35777</th>
         </tr>
         <tr>
            <th>Mayo</th>
            <td>42537</td>
            <td>34045</td>
			<th>44488</th>
         </tr>
         <tr>
            <th>Junio</th>
            <td>38616</td>
            <td>33097</td>
			<th>38255</th>
         </tr>
         <tr>
            <th>Julio</th>
            <td>37443</td>
            <td>34193</td>
			<th>43580</th>
         </tr>
         <tr>
            <th>Agosto</th>
            <td>45629</td>
            <td>41023</td>
			<th>45464</th>
         </tr>
         <tr>
            <th>Septiembre</th>
            <td>39858</td>
            <td>30359</td>
			<th>41047</th>
         </tr>
         <tr>
            <th>Octubre</th>
            <td>38277</td>
            <td>34386</td>
			<th>44714</th>
         </tr>
         <tr>
            <th>Noviembre</th>
            <td>43048</td>
            <td>29601</td>
			<th>35741</th>
         </tr>
         <tr>
            <th>Diciembre</th>
            <td>33003</td>
            <td>28558</td>
			<th>34687</th>
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
            <td>32,265</td>
            <td>36,939</td>
			<th>30,157</th>
         </tr>
         <tr>
            <th>Febrero</th>
            <td>32,558</td>
            <td>34,495</td>
			<th>31,512</th>
         </tr>
         <tr>
            <th>Marzo</th>
            <td>39,031</td>
            <td>31,979</td>
			<th>34,222</th>
         </tr>
         <tr>
            <th>Abril</th>
            <td>32,578</td>
            <td>32,723</td>
			<th>35,777</th>
         </tr>
         <tr>
            <th>Mayo</th>
            <td>42,537</td>
            <td>34,045</td>
			<th>44,488</th>
         </tr>
         <tr>
            <th>Junio</th>
            <td>38,616</td>
            <td>33,097</td>
			<th>38,255</th>
         </tr>
         <tr>
            <th>Julio</th>
            <td>37,443</td>
            <td>34,193</td>
			<th>43,580</th>
         </tr>
         <tr>
            <th>Agosto</th>
            <td>45,629</td>
            <td>41,023</td>
			<th>45,464</th>
         </tr>
         <tr>
            <th>Septiembre</th>
            <td>39,858</td>
            <td>30,359</td>
			<th>41,047</th>
         </tr>
         <tr>
            <th>Octubre</th>
            <td>38,277</td>
            <td>34,386</td>
			<th>44,714</th>
         </tr>
         <tr>
            <th>Noviembre</th>
            <td>43,048</td>
            <td>29,601</td>
			<th>35,741</th>
         </tr>
         <tr>
            <th>Diciembre</th>
            <td>33,003</td>
            <td>28,558</td>
			<th>34,687</th>
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