<?php  
 if(isset($_POST["from_date"], $_POST["to_date"]))  
 {  
      $connect = mysqli_connect("localhost", "root", "", "panel");  
      $output = '';  
      $query = "  
           SELECT * FROM pdc_all_dep_elec  
           WHERE periodo_inicio BETWEEN '".$_POST["from_date"]."' AND '".$_POST["to_date"]."'
      "; 
            $querysumas = "  
           SELECT sum(costo) as CostoTotal, sum(consumo) as ConsumoTotal FROM pdc_all_dep_elec
           WHERE periodo_inicio BETWEEN '".$_POST["from_date"]."' AND '".$_POST["to_date"]."'
      ";  
      $resultsumas = mysqli_query($connect, $querysumas);  
      $result = mysqli_query($connect, $query);
      $rowsumas = mysqli_fetch_array($resultsumas);  
      $output .= '  
           <table class="table table-bordered table-fit">
                <tr>  
                             <th>NIS</th>
                             <th>Dependencia</th>
                             <th>Inicio</th>
                             <th>Fin</th>
                             <th>Consumo</th>
                             <th>Costo</th>
                             <th>FP</th>
                </tr>  
      ';  
      if(mysqli_num_rows($result) > 0)  
      {  
           while($row = mysqli_fetch_array($result))  
           {  
                $output .= '  
                     <tr>  
                          <td>'. $row["cuenta"] .'</td>  
                          <td>'. $row["dependencia"] .'</td>  
                          <td>'. $row["periodo_inicio"] .'</td>  
                          <td>'. $row["periodo_fin"] .'</td>  
                          <td>'. number_format($row["consumo"],0) .' KwH</td>
                          <td>$ '. number_format($row["costo"],0) .'</td>  
                          <td>'. $row["factor"] .'</td>  
                     </tr>  
                ';  

           }  
           
           $output .= '
                    <tr>  
                          <td>Total</td>  
                          <td></td>  
                          <td></td>  
                          <td></td>  
                          <td width="15%"> '. number_format($rowsumas["ConsumoTotal"],0) .' KwH </td>
                          <td width="15%">$ '. number_format($rowsumas["CostoTotal"],0) .' </td>  
                          <td></td>  
                     </tr>  
                ';  
             


           
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