<?php  
 if(isset($_POST["from_date"], $_POST["to_date"]))  
 {  
      $connect = mysqli_connect("localhost", "root", "", "panel");  
      $output = '';  
      $query = "  
           SELECT * FROM comparacion_year_actual_y_pasado_noid_final
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
                     <td>'. $row["cta"] .'</td>  
                     <td>'. $row["depe_eleanio_actual2"] .'</td>  
                     <td>'. $row["periodo_inicio"] .'</td>  
                     <td>'. $row["periodo_fin"] .'</td>  
                     <td>'. number_format($row["enero_con"],0) .' KwH</td>
                     <td>'. number_format($row["febrero_con"],0) .' KwH</td>
                     <td>'. number_format($row["marzo_con"],0) .' KwH</td>
                     <td>'. number_format($row["abril_con"],0) .' KwH</td>
                     <td>'. number_format($row["mayo_con"],0) .' KwH</td>
                     <td>'. number_format($row["junio_con"],0) .' KwH</td>
                     <td>'. number_format($row["julio_con"],0) .' KwH</td>
                     <td>'. number_format($row["agosto_con"],0) .' KwH</td>
                     <td>'. number_format($row["septiembre_con"],0) .' KwH</td>
                     <td>'. number_format($row["octubre_con"],0) .' KwH</td>
                     <td>'. number_format($row["noviembre_con"],0) .' KwH</td>
                     <td>'. number_format($row["diciembre_con"],0) .' KwH</td>
                     <td>$ '. number_format($row["enero_cos"],0) .'</td>
                     <td>$ '. number_format($row["febrero_cos"],0) .'</td>
                     <td>$ '. number_format($row["marzo_cos"],0) .'</td>
                     <td>$ '. number_format($row["abril_cos"],0) .'</td>
                     <td>$ '. number_format($row["mayo_cos"],0) .'</td>
                     <td>$ '. number_format($row["junio_cos"],0) .'</td>
                     <td>$ '. number_format($row["julio_cos"],0) .'</td>
                     <td>$ '. number_format($row["agosto_cos"],0) .'</td>
                     <td>$ '. number_format($row["septiembre_cos"],0) .'</td>
                     <td>$ '. number_format($row["octubre_cos"],0) .'</td>
                     <td>$ '. number_format($row["noviembre_cos"],0) .'</td>
                     <td>$ '. number_format($row["diciembre_cos"],0) .'</td>
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