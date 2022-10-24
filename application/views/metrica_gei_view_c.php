<?php

$year = array();
$rkw = array();
$rkwxg = array();
$calumni = array();
$i = 0;


$mysqli = new mysqli("localhost", "root", "", "sdspanel1");
$patas = $mysqli->query = "SELECT theyear, rawkw, rawkwxgei, cantidad_alumnos FROM pdc_factor_gei";
$resultado = mysqli_query($mysqli, $patas);
$query = $this->db->query($patas);
while ($row = mysqli_fetch_object($resultado))
{
  $strdata = $row->theyear;
  $ano = substr($strdata,0,4);
  $data = $ano;
  $datas[$i] = $data;
  
  $valorpp[$i] = $row->cantidad_alumnos;
  $valorcc[$i] = $row->rawkw;
  $valorqq[$i] = $row->rawkwxgei;
  $i = $i + 1;

}

?>
<html>
  <head>
    <!--script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Periodo', 'Alumnado', 'Kw/Anual', 'GEI/Anual'],
          <?php
          $k = $i;
          for ($i = 0; $i < $k; $i++)
          {
          ?>
          
          ['<?php echo $datas[$i] ?>',
          
          '<?php echo $valorpp[$i] ?>',
          
          '<?php echo $valorcc[$i] ?>',
          
          '<?php echo $valorqq[$i] ?>'],
          <?php
          }
          ?>
        ]);

        var options = {
          chart: {
            title: 'Métrica anual en consumo Eléctrico',
            subtitle: 'Consumo Kw(Millones), Emisiones GEI(Millones), Alumnado(Miles)',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="columnchart_material" style="width: 1000px; height: 500px;"></div>
  </body>
  <?php echo form_open(); ?>
<p>
<p>
<div>
    <button
      name="enviar"
      value="volver"
      class="btn"
      type="submit"
    ><span class="glyphicon glyphicon-circle-arrow-left"></span> Volver al Inicio</button>
  </div>
  <p>
  <p>
  <p>
  <p>
<?php echo form_close(); ?>
<div class="table-responsive">
  <table class="table table-bordered table-hover">
    <thead>
      <tr>
        <th rowspan=2>Año</th>
        <th rowspan=2>KW/Capita por Año</th>
        <th rowspan=2>Kg/Capita por Año</th>
        <th rowspan=2>Temperatura</th>
      </tr>
    </thead>

    <tbody>
    <?php if($loadgei): ?>
      <?php foreach($loadgei as $item): ?>
      <tr>
        <td><?php echo $item->theyear; ?></td>
        <td><?php echo $item->kwcapitayear; ?></td>
        <td><?php echo $item->kgcapitayear; ?></td>
        <td><?php echo $item->temperatura; ?> °C</td>
      </tr>
      <?php endforeach; ?>
    <?php else: ?>
      <tr>
        <td colspan=10>Selecciona el año.</td>
      </tr>
    <?php endif; ?>
    </tbody>

  </table>
</div> <!-- table-responsive -->


<div class="center">
  <ul class="pagination pagination-lg">
  <?php echo $this->pagination->create_links(); ?>
  </ul>
</div>
</html>