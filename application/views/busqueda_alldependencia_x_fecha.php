<?php  
 $connect = mysqli_connect("localhost", "root", "", "panel");  
 $query = "SELECT * FROM pdc_all_dep_elec ORDER BY dependencia ASC";
 $querySumaCosto = "SELECT sum(costo) as CostoTotal, sum(consumo) as ConsumoTotal FROM pdc_all_dep_elec";   
 $result = mysqli_query($connect, $query); 
 $resultSumaCosto = mysqli_query($connect, $querySumaCosto);  
 ?>  
 <!DOCTYPE html>  
 <html>  
      <head>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
           <title></title>
		   	  <link src="https://code.jquery.com/jquery-3.2.1.js"</>
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>  
           <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
		   
      </head>  
      <body>  
           <br /><br />
           <div class="row" align="center">
           <div class="container" style="width:700px;">  
                <div class="col-sm-4" align="right">
                     <input type="text" name="from_date" id="from_date" class="form-control" placeholder="Fecha Inicio" />  
                </div>  
                <div class="col-sm-4" align="right">
                     <input type="text" name="to_date" id="to_date" class="form-control" placeholder="Fecha Fin" />  
                </div>  
                <div class="col-sm-3" align="center">
                     <input href= type="button" name="_filter" id="filter" value="Buscar" class="btn btn-info" value="{{ csrf_filter() }}" />  
                </div>
              </div>
                
                <div style="clear:both"></div>
                
                <div class="row">
                  <?php echo form_open(); ?>
                  <div class="col-sm-4 col-sm-push-5" align="center">
                    <button
                    name="enviar"
                    value="volver"
                    class="btn"
                    type="submit"
                    ><span class="glyphicon glyphicon-circle-arrow-left"></span> Al Inicio</button>
                </div>
                <div class="col-sm-5 col-sm-pull-4" align="right">
                  <button
                    name="enviar"
                    value="reloadalldepelec"
                    class="btn"
                    type="submit"
                  ><span class="glyphicon glyphicon-retweet"></span> Recargar Datos</button>
                </div>  
                <?php echo form_close(); ?>
              </div>
                <br />  

                <div id="order_table">  
                     <table class="table table-bordered table-fit">
					 
                          <tr>  
                             <th>NIS</th>
                             <th>Dependencia</th>
                             <th>Inicio</th>
                             <th>Fin</th>
                             <th>Consumo kWh</th>
                             <th>Costo</th>
                             <th>FP</th>
                          </tr>  
                     <?php  
                     while($row = mysqli_fetch_array($result))
                     {  
                     ?>  
                          <tr>  
                               <td><?php echo $row["cuenta"]; ?></td>  
                               <td><?php echo $row["dependencia"]; ?></td>  
                               <td><?php echo $row["periodo_inicio"]; ?></td>  
                               <td><?php echo $row["periodo_fin"]; ?></td>  
                               <td><?php echo number_format($row["consumo"],0);?></td>  
                               <td>$<?php echo number_format($row["costo"],0);?></td>  
                               <td><?php echo $row["factor"]; ?></td>
                          </tr>  
                     <?php  
                     }  
                     ?>
                     <?php
                     $rowSuma = mysqli_fetch_array($resultSumaCosto)
                     ?>
                    <tr>
                         <td>Total</td>
                         <td></td>
                         <td></td>
                         <td></td>
                         <td><?php echo number_format($rowSuma["ConsumoTotal"],0);?></td>
                         <td>$<?php echo number_format($rowSuma["CostoTotal"],0);?></td>
						 <td></td>
                     </tr>
                     </table>
                </div>  
              </div>
           </div>  
      </body>  
 </html>
<script type="text/javascript">
	integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
	crossorigin="anonymous"
      $(document).ready(function(){  
           $.datepicker.setDefaults({  
                dateFormat: 'yy-mm-dd'
           });  
           $(function(){  
                $("#from_date").datepicker();  
                $("#to_date").datepicker();  
           });  
           $('#filter').click(function(){  
                var from_date = $('#from_date').val();  
                var to_date = $('#to_date').val(); 
                console.log(to_date);
                if(from_date != '' && to_date != '')  
                {  
                     $.ajax({  
						  method:"POST",
                                url:"http://localhost:8080/PanelControlDTI/trunk/application/views/all_fecha_energia.php",
							//$config['base_url']		= 'http://www.provisionalpanel.uanl.mx/';
							//$config['base_url']	= 'http://www.paneldecontrol.sds.uanl.mx/';
							//$config['base_url']	= 'http://panelitodc.me:8080/PanelControlDTI/trunk/';
							//$config['base_url'] = 'http://localhost:8080/PanelControlDTI/trunk/index.php/inicio'
                          crossDomain: true,
                          data:{from_date:from_date, to_date:to_date},  
                          success:function(data)  
                          {  
                               $('#order_table').html(data);  
                          },
                          error:function(xhr,status,error)
                          {
                            console.log(error);
                          }
                     });  
                }  
                else  
                {  
                     alert("Favor de Seleccionar una Fecha Correcta");
                }  
           });  
      });  
 </script>