<?php
if(isset($_POST["from_date"], $_POST["to_date"])){
$con = mysql_connect('localhost', 'sdspan3', 'RTRIUHG54637') or die('Error connecting to server');
mysql_select_db("sdspanel1", $con); 

 $sql = "           SELECT * FROM pdc_all_dep_elec  
           WHERE periodo_inicio BETWEEN '".$_POST["from_date"]."' AND '".$_POST["to_date"]."' "; 
 
            $result = mysql_query($sql);
            $data = array();
            while ($row = mysql_fetch_array($result)){
                $data[] = $row['cuenta'];
            
                $data1[] = $row['dependencia'];
                
                $data2[] = $row['periodo_inicio'];
                
                $data3[] = $row['periodo_fin'];

                $data4[] = $row['consumo'];

                $data5[] = $row['costo'];

                $data6[] = $row['factor'];
                
                $output .= '  
                 <table class="table table-bordered">  
                      <tr>  
                                   <th width="5%">NIS</th>
                                   <th width="65%">Dependencia</th>
                                   <th width="5%">Inicio</th>
                                   <th width="5%">Fin</th>
                                   <th>Consumo KwH</th>
                                   <th width="5%">Costo</th>
                                   <th width="2%">FP</th>
                      </tr>  
            ';  
      if(mysqli_num_rows($result) > 0)  
      {  
           while($row = mysqli_fetch_array($result))  
           {  
                $output .= '  
                     <tr>  
                          <td>'. $row["<?php echo join($data, ',') ?>"] .'</td>  
                          <td>'. $row["<?php echo join($data1, ',') ?>"] .'</td>  
                          <td>'. $row["<?php echo join($data2, ',') ?>"] .'</td>  
                          <td>'. $row["<?php echo join($data3, ',') ?>"] .'</td>  
                          <td>'. $row["<?php echo join($data4, ',') ?>"] .'</td>  
                          <td>'. $row["<?php echo join($data5, ',') ?>"] .'</td>  
                          <td>'. $row["<?php echo join($data6, ',') ?>"] .'</td>  
                     </tr>  
                ';  
           }  
      }  
      else  
      {  
           $output .= '  
                <tr>  
                     <td colspan="5">No hay datos a encontrar.</td>  
                </tr>  
           ';  
      }  
      $output .= '</table>';  
      echo $output;  
 }  
 ?>