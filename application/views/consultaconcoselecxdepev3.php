<!DOCTYPE html>
<html lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

         <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
         <script type="text/javascript" src="https://code.highcharts.com/stock/highstock.js"></script>
         <!--script src="https://code.highcharts.com/highcharts.js"></script-->
         <script src="<?php echo base_url(); ?>assets/js/highcharts-3d.js"></script> <!--OJO ES RECOMENDABLE USAR LA OPCION DE 3D ALOJADA EN EL SERVIDOR-->
         <script src = "https://code.highcharts.com/modules/exporting.js"></script>
         <!--src="assets/js/jquery-3.3.1.js"-->
         <!--src="assets/js/jquery-3.3.1.min.map"-->
         <script src = "https://code.highcharts.com/modules/data.js"></script>

        <!-- CSS STYLES -->
    <!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->
        <!-- Font Awesome -->
        <link href="<?php echo base_url(); ?>vistas/assets/plugins/fontawesome-free/css/all.min.css"  rel='stylesheet' type='text/css'>

        <!-- Theme style -->
        <link href="<?php echo base_url(); ?>vistas/assets/dist/css/adminlte.css"  rel='stylesheet' type='text/css'>

        <link href="<?php echo base_url(); ?>vistas/assets/dist/css/index.css"  rel='stylesheet' type='text/css'>

        <!-- DataTabes CSS -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css" rel='stylesheet' type='text/css'>

        <!-- SweetAlert2 -->
        <link href="<?php echo base_url(); ?>vistas/assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css"  rel='stylesheet' type='text/css'>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css"  rel='stylesheet' type='text/css'>
        
    <!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->


    <!-- SCRIPT -->
    <!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->

        <!-- jQuery -->
        <!--http://localhost:8080/PanelControlDTI/trunk-->
        <script src="<?php echo base_url(); ?>vistas/assets/plugins/jquery/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery-ui.min.js"></script>
        <!--script src="vistas/assets/plugins/jquery/jquery.min.js"></script-->
        <!-- Bootstrap 4 -->
        
        <script src="<?php echo base_url(); ?>vistas/assets/plugins/bootstrap/js/bootstrap.bundle.js"></script>
        <!-- AdminLTE App -->
        <script src="<?php echo base_url(); ?>../trunk/vistas/assets/dist/js/adminlte.js"></script>
        <!--script src="vistas/assets/dist/js/adminlte.js"></script-->

        
        <script src="<?php echo base_url(); ?>../assets/js/moment.min.js"></script>
        
        <!--PDF CONVERTERS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.es.min.js" integrity="sha512-3chOMtjYaSa9m2bCC8qGxmEcX449u63D1fMXMQdueS3/XgE12iHQdmZVXVVbhBLc9i7h9WUuuM15B0CCE6Jtvg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <!-- Datatable js -->
        
        <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
        
        <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
        <!-- SweetAlert2 -->
        <script src="<?php echo base_url(); ?>vistas/assets/plugins/sweetalert2/sweetalert2.min.js"></script>
        <!--script src="vistas/assets/plugins/sweetalert2/sweetalert2.min.js"></script-->
        
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        
    <!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->






<?php echo form_open(); ?>
<div class="buscador">
   <div>
      <label>Dependencia a buscar</label>
   </div>
   <select
         id="depe_eleanio_actual"
         name="depe_eleanio_actual"
         class="form-control"
      >
         <option value="">----</option>
      <?php foreach($catdepes as $item): ?>
         <option value="<?php echo $item->depe_eleanio_actual; ?>"><?php echo $item->depe_eleanio_actual; ?></option>
         ><?php echo $item->depe_eleanio_actual; ?></option>
      <?php endforeach; ?>
      </select>
</div>
<div class="busqueda_boton">
   <div>
      <button
         name="enviar"
         value="aceptar"
         class="btn"
         type="submit"
      ><span class="glyphicon glyphicon-search"></span> Buscar</button>
   </div>
   <div>
      <button
         name="enviar"
         value="volver"
         class="btn"
         type="submit"
      ><span class="glyphicon glyphicon-circle-arrow-left"></span> Volver al Inicio</button>
   </div>
   <div>
      <button
         name="enviar"
         value="reloadtablaseleccomparacion"
         class="btn"
         type="submit"
      ><span class="glyphicon glyphicon-retweet"></span> Recargar Datos</button>
   </div>
</div>
<div>
</div>

<?php echo form_close(); ?>

<!--DIV EXCLUSIVO PARA IMPRIMIR PDF, EN MODO JS-->

 <div class="col-sm-6" id="divToExport">

    <button type="button" onclick="generatePDF()" class="btn-sm btn-danger pull-right">Descargar a PDF</button>
<!--DIV EXCLUSIVO PARA IMPRIMIR PDF, EN MODO JS-->
<div class="center">
   <ul class="pagination pagination-lg">
   <?php echo $this->pagination->create_links(); ?>
   </ul>
</div>

<div>
      <h3>
   <?php if($resultdependencia): ?>
      <?php foreach($resultdependencia as $item): ?>
         <tr>
            <td><?php echo $item->cta_eleanio_actual;
            break; ?>

         </tr>
         <?php endforeach; ?>
      <?php else: ?>
         <tr>
            <td colspan=10></td>
         </tr>
      <?php endif; ?>
      </h3>
</div>


   <div id = "container" style = "width: auto; height: auto; margin: auto"></div>
   <div id = "sliders"></div>
      <script language = "JavaScript">
         $(document).ready(function() {

            var data = {
               table: 'datatables'
            };

            var chart = {
               renderTo: 'container',
               type: 'column',
               crisp: true,
               panning: false,
               panKey: 'shift',
            };
            var title = {
               text: 'ENERGÍA <?php echo $item->depe_eleanio_actual?>'
            };

            var plotOptions = {
               series: {
                  depth: 10,
                  stacking: false,
                  grouping: true,
                  //groupPadding: 0.031, //Define el espacio entre columnas
                  pointPadding: 1.75,
                  //minPointLength: 3,
                  PointLength: 10,
                  maxPointWidth: 50, //determina el ancho maximo de las columnas
                  pointWidth: 22, //determina el ancho de las columnas
                  dataLabels: {
                     enabled: true,
                     align: 'center',
                     verticalAlign: 'bottom',
                     allowOverlap: true,
                     rotation: 1,
                     x: 0,
                     y: -10,
                     style: {
                        fontSize: '10px',
                        fontColor: 'black'
                     },
                     formatter: function () {
                        result = this.y;
  if (this.y > 1000000) { result = (this.y / 1000000).toFixed(1) + "M" }
  else if (this.y > 1000) { result = Math.floor(this.y / 1).toFixed(0) + "m" }
  return result;
    
                    }
                  }
               }
            };
            var exporting =
            {
			   sourceWidth: 1920,
               sourceHeight: 1080,
               scale: 1, 
                  chartOptions:
                  {
                     chart:
                     {
                        height: this.chartHeight
                     }
                  }
            };
            var yAxis = {
               allowDecimals: true,
               title: {
                  text: 'Consumo KwH'
              },
              labels: {
                format: '{value:,.0f}',
                valuesuffix: '',
                shared: false
               },
         };
         var xAxis = {
               allowDecimals: false,
               title: {
                  style: {
            fontSize: '20px'
        },
                  text: 'Donde M son millones y m son miles.'
              },
              labels: {
                format: '{value:,.0f}',
                valuesuffix: '',
                shared: false
               },
         };
            var tooltip = {
               formatter: function () {
                  return '<b>' + this.x + '</b><br/>' +
                  this.series.name + ': ' + this.y + '<br/>';
               },
               
            };
            var credits = {
               enabled: true
            };  
            var json = {};
            json.chart = chart;
            json.title = title;
            json.data = data;
            json.plotOptions = plotOptions;
            json.exporting = exporting;
            json.yAxis = yAxis;
            json.xAxis = xAxis;
            json.credits = credits;
            json.tooltip = tooltip;
            json.scrollbar = {
            enabled: false,
            barBackgroundColor: 'lime',
            barBorderRadius: 7,
            barBorderWidth: 0,
            buttonBackgroundColor: 'white',
            buttonBorderWidth: 0,
            buttonBorderRadius: 7,
            trackBackgroundColor: 'white',
            trackBorderWidth: 1,
            trackBorderRadius: 8,
            trackBorderColor: '#CCC',
            rifleColor: 'black',
            buttonArrowColor: 'black',
            };
         json.colors= ['#7CB5EC', '#ffefdb',
         '#90ED7D', '#F7A35C',
         '#8085E9', '#F15C80',
         '#E4D354', '#CD0000',
         '#F45B5B', '#91E8E1',
         '#87cefa', '#7fffd4'
         ];
            
            var highchart = new Highcharts.Chart(json);
         });

      </script>

<table id="datatables" class="table table-condensed table-bordered table-hover" style="display: none;">
      <thead>
         <tr>
            <th>Year</th>
            <th>Enero</th>
            <th>Febrero</th>
            <th>Marzo</th>
            <th>Abril</th>
            <th>Mayo</th>
            <th>Junio</th>
            <th>Julio</th>
            <th>Agosto</th>
            <th>Septiembre</th>
            <th>Octubre</th>
            <th>Noviembre</th>
            <th>Diciembre</th>
         </tr>
      </thead>

      <tbody>
         <?php if($resultdependencia): ?>
            <?php foreach($resultdependencia as $item): ?>
         <tr>
            <td><?php echo $item->anio_actual_elec; ?></td>
            <td><?php echo number_format($item->Enero, 0, "", " "); ?></td>
            <td><?php echo number_format($item->Febrero, 0, "", " "); ?></td>
            <td><?php echo number_format($item->Marzo, 0, "", " "); ?></td>
            <td><?php echo number_format($item->Abril, 0, "", " "); ?></td>
            <td><?php echo number_format($item->Mayo, 0, "", " "); ?></td>
            <td><?php echo number_format($item->Junio, 0, "", " "); ?></td>
            <td><?php echo number_format($item->Julio, 0, "", " "); ?></td>
            <td><?php echo number_format($item->Agosto, 0, "", " "); ?></td>
            <td><?php echo number_format($item->Septiembre, 0, "", " "); ?></td>
            <td><?php echo number_format($item->Octubre, 0, "", " "); ?></td>
            <td><?php echo number_format($item->Noviembre, 0, "", " "); ?></td>
            <td><?php echo number_format($item->Diciembre, 0, "", " "); ?></td>
         </tr>
         <?php endforeach; ?>
      <?php else: ?>
         <tr>
            <td colspan=10>Favor de seleccionar el campus a consultar.</td>
         </tr>
      <?php endif; ?>
      </tbody>

   </table>
<!--COMIENZO DE LA TABLA DE DATOS CON COMMMAS-->

<table id="mugres" class="table table-condensed table-bordered table-hover" style="display: none;">
      <thead>
         <tr>
            <th>Año</th>
            <th class="text-center">Enero</th>
            <th class="text-center">Febrero</th>
            <th class="text-center">Marzo</th>
            <th class="text-center">Abril</th>
            <th class="text-center">Mayo</th>
            <th class="text-center">Junio</th>
            <th class="text-center">Julio</th>
            <th class="text-center">Agosto</th>
            <th class="text-center">Septiembre</th>
            <th class="text-center">Octubre</th>
            <th class="text-center">Noviembre</th>
            <th class="text-center">Diciembre</th>
         </tr>
      </thead>

      <tbody>
      <?php if($resultdependencia): ?>
         <?php foreach($resultdependencia as $item): ?>
         <tr>
            <td><?php echo $item->anio_actual_elec; ?></td>
            <td class="text-right"><b><?php echo number_format($item->Enero); ?></b></td>
            <td class="text-right"><b><?php echo number_format($item->Febrero); ?></b></td>
            <td class="text-right"><b><?php echo number_format($item->Marzo); ?></b></td>
            <td class="text-right"><b><?php echo number_format($item->Abril); ?></b></td>
            <td class="text-right"><b><?php echo number_format($item->Mayo); ?></b></td>
            <td class="text-right"><b><?php echo number_format($item->Junio); ?></b></td>
            <td class="text-right"><b><?php echo number_format($item->Julio); ?></b></td>
            <td class="text-right"><b><?php echo number_format($item->Agosto); ?></b></td>
            <td class="text-right"><b><?php echo number_format($item->Septiembre); ?></b></td>
            <td class="text-right"><b><?php echo number_format($item->Octubre); ?></b></td>
            <td class="text-right"><b><?php echo number_format($item->Noviembre); ?></b></td>
            <td class="text-right"><b><?php echo number_format($item->Diciembre); ?></b></td>
         </tr>
         <?php endforeach; ?>
      <?php else: ?>
         <tr>
            <td colspan=10>Favor de seleccionar el campus a consultar.</td>
         </tr>
      <?php endif; ?>
      </tbody>

   </table>




   <script>
$("#periodo_fin").on("change", function() {
      $(this).prop("disabled", false);
    });

    $(function() {
      var defaults = {
        closeText: 'Cerrar',
        prevText: '<Anterior',
        nextText: 'Siguiente>',
        currentText: 'Hoy',
        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
        dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
        dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Juv', 'Vie', 'Sáb'],
        dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
        weekHeader: 'Sm',
        dateFormat: 'yy/mm/dd',
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: ''
      };

      $.datepicker.setDefaults(defaults);
      $("#periodo_inicio").datepicker({
        //The value "0" means today (0 days from today)
        //minDate: 0,
        onSelect: function(dateStr) {
          //datepicker("setDate", new Date()); //día actual.
          var minDate = $(this).datepicker('getDate');
          if (minDate) {
            var maxDate = $("#periodo_fin").datepicker('getDate');
            if (maxDate && minDate < maxDate) {} else {
              minDate.setDate(minDate.getDate() + 1);
              $('#periodo_fin').datepicker('setDate', minDate).
              datepicker('option', 'minDate', minDate); //día siguiente al actual en "check_out".
            }
          }
          $('#periodo_fin').change();
        }
      });

      $('#periodo_fin').datepicker().on("input click", function(e) {
        console.log("Fecha salida cambiada: ", e.target.value);
      });
    });
    </script>
<!-- CONTENT -->
<section class="content">
    
    <div class="container-fluid">
    <!--div style="margin:-1vh; width:10vh;"-->

        <table id="" class="table table-striped table-bordered nowrap" style="width:100%;">
            <thead class="bg-info">
                <tr>
                    <td style="width:5%;">Id</td>
                    <td>Cuenta</td>
                    <td>Dependencia</td>
                    <td style="width:10%;">Año</td>
                    <td style="width:5%;">Ene.</td>
                    <td style="width:5%;">Feb.</td>
                    <td style="width:5%;">Mar.</td>
                    <td style="width:5%;">Abr.</td>
                    <td style="width:5%;">May.</td>
                    <td style="width:5%;">Jun.</td>
                    <td style="width:5%;">Jul.</td>
                    <td style="width:5%;">Ago.</td>
                    <td style="width:5%;">Sep.</td>
                    <td style="width:5%;">Oct.</td>
                    <td style="width:5%;">Nov.</td>
                    <td style="width:5%;">Dic.</td>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>    

    </div>
    </div>
 
</section>
<!-- ./ CONTENT -->
<!--CIERRE DEL DIV EXCLUSIVO PARA IMPRMIR EN PDF, METODO JS-->
</div>


<script>

	$(document).ready(function(){

        var accion = "";

  		var table = $("#").DataTable({
  			"ajax":{
				//"url": "controllers/controlador.ajax.elec.php",
                //"url":"http://localhost:8080/PanelControlDTI/trunk/index.php/control_factor_gei/controllers/controlador.ajax.elec.php",
                "url":"http://localhost:8080/PanelControlDTI/trunk/application/controllers/controlador.ajax.elec.php",
                //"url":"../trunk/application/controllers/controlador.ajax.elec.php",
				"type":"POST",
				"dataSrc":""
			},  			
            "columns":[
                    {"data": "id"},
                    {"data": "cta_consumo_final_pasado"},
                    {"data": "dep_consumo_final_pasado"},
                    {"data": "yer_consumo_final_pasado"},
                    {"data": "Enero"},
                    {"data": "Febrero"},
                    {"data": "Marzo"},
                    {"data": "Abril"},
                    {"data": "Mayo"},
                    {"data": "Junio"},
                    {"data": "Julio"},
                    {"data": "Agosto"},
                    {"data": "Septiembre"},
                    {"data": "Octubre"},
                    {"data": "Noviembre"},
                    {"data": "Diciembre"},
                ],

            "language":{
                    "processing": "Procesando...",
                    "lengthMenu": "Mostrar _MENU_ registros",
                    "zeroRecords": "No se encontraron resultados",
                    "emptyTable": "Ningún dato disponible en esta tabla",
                    "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "search": "Buscar NIS:",
                    "infoThousands": ",",
                    "loadingRecords": "Cargando...",
                    "paginate": {
                        "first": "Primero",
                        "last": "Último",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    },
                    "aria": {
                        "sortAscending": ": Activar para ordenar la columna de manera ascendente",
                        "sortDescending": ": Activar para ordenar la columna de manera descendente"
                    },
                    "buttons": {
                        "copy": "Copiar",
                        "colvis": "Visibilidad",
                        "collection": "Colección",
                        "colvisRestore": "Restaurar visibilidad",
                        "copyKeys": "Presione ctrl o u2318 + C para copiar los datos de la tabla al portapapeles del sistema. <br \/> <br \/> Para cancelar, haga clic en este mensaje o presione escape.",
                        "copySuccess": {
                            "1": "Copiada 1 fila al portapapeles",
                            "_": "Copiadas %d fila al portapapeles"
                        },
                        "copyTitle": "Copiar al portapapeles",
                        "csv": "CSV",
                        "excel": "Excel",
                        "pageLength": {
                            "-1": "Mostrar todas las filas",
                            "1": "Mostrar 1 fila",
                            "_": "Mostrar %d filas"
                        },
                        "pdf": "PDF",
                        "print": "Imprimir"
                    },
                    "autoFill": {
                        "cancel": "Cancelar",
                        "fill": "Rellene todas las celdas con <i>%d<\/i>",
                        "fillHorizontal": "Rellenar celdas horizontalmente",
                        "fillVertical": "Rellenar celdas verticalmentemente"
                    },
                    "decimal": ",",
                    "searchBuilder": {
                        "add": "Añadir condición",
                        "button": {
                            "0": "Constructor de búsqueda",
                            "_": "Constructor de búsqueda (%d)"
                        },
                        "clearAll": "Borrar todo",
                        "condition": "Condición",
                        "conditions": {
                            "date": {
                                "after": "Despues",
                                "before": "Antes",
                                "between": "Entre",
                                "empty": "Vacío",
                                "equals": "Igual a",
                                "notBetween": "No entre",
                                "notEmpty": "No Vacio",
                                "not": "Diferente de"
                            },
                            "number": {
                                "between": "Entre",
                                "empty": "Vacio",
                                "equals": "Igual a",
                                "gt": "Mayor a",
                                "gte": "Mayor o igual a",
                                "lt": "Menor que",
                                "lte": "Menor o igual que",
                                "notBetween": "No entre",
                                "notEmpty": "No vacío",
                                "not": "Diferente de"
                            },
                            "string": {
                                "contains": "Contiene",
                                "empty": "Vacío",
                                "endsWith": "Termina en",
                                "equals": "Igual a",
                                "notEmpty": "No Vacio",
                                "startsWith": "Empieza con",
                                "not": "Diferente de"
                            },
                            "array": {
                                "not": "Diferente de",
                                "equals": "Igual",
                                "empty": "Vacío",
                                "contains": "Contiene",
                                "notEmpty": "No Vacío",
                                "without": "Sin"
                            }
                        },
                        "data": "Data",
                        "deleteTitle": "Eliminar regla de filtrado",
                        "leftTitle": "Criterios anulados",
                        "logicAnd": "Y",
                        "logicOr": "O",
                        "rightTitle": "Criterios de sangría",
                        "title": {
                            "0": "Constructor de búsqueda",
                            "_": "Constructor de búsqueda (%d)"
                        },
                        "value": "Valor"
                    },
                    "searchPanes": {
                        "clearMessage": "Borrar todo",
                        "collapse": {
                            "0": "Paneles de búsqueda",
                            "_": "Paneles de búsqueda (%d)"
                        },
                        "count": "{total}",
                        "countFiltered": "{shown} ({total})",
                        "emptyPanes": "Sin paneles de búsqueda",
                        "loadMessage": "Cargando paneles de búsqueda",
                        "title": "Filtros Activos - %d"
                    },
                    "select": {
                        "1": "%d fila seleccionada",
                        "_": "%d filas seleccionadas",
                        "cells": {
                            "1": "1 celda seleccionada",
                            "_": "$d celdas seleccionadas"
                        },
                        "columns": {
                            "1": "1 columna seleccionada",
                            "_": "%d columnas seleccionadas"
                        }
                    },
                    "thousands": ".",
                    "datetime": {
                        "previous": "Anterior",
                        "next": "Proximo",
                        "hours": "Horas",
                        "minutes": "Minutos",
                        "seconds": "Segundos",
                        "unknown": "-",
                        "amPm": [
                            "am",
                            "pm"
                        ]
                    },
                    "editor": {
                        "close": "Cerrar",
                        "create": {
                            "button": "Nuevo",
                            "title": "Crear Nuevo Registro",
                            "submit": "Crear"
                        },
                        "edit": {
                            "button": "Editar",
                            "title": "Editar Registro",
                            "submit": "Actualizar"
                        },
                        "remove": {
                            "button": "Eliminar",
                            "title": "Eliminar Registro",
                            "submit": "Eliminar",
                            "confirm": {
                                "_": "¿Está seguro que desea eliminar %d filas?",
                                "1": "¿Está seguro que desea eliminar 1 fila?"
                            }
                        },
                        "error": {
                            "system": "Ha ocurrido un error en el sistema (<a target=\"\\\" rel=\"\\ nofollow\" href=\"\\\">Más información&lt;\\\/a&gt;).<\/a>"
                        },
                        "multi": {
                            "title": "Múltiples Valores",
                            "info": "Los elementos seleccionados contienen diferentes valores para este registro. Para editar y establecer todos los elementos de este registro con el mismo valor, hacer click o tap aquí, de lo contrario conservarán sus valores individuales.",
                            "restore": "Deshacer Cambios",
                            "noMulti": "Este registro puede ser editado individualmente, pero no como parte de un grupo."
                        }
                    },
                    "info": "Mostrando de _START_ a _END_ de _TOTAL_ entradas"
            },
  		});


	})

	
	

</script>
<script type="text/javascript">
  function generatePDF() {
        
        // Choose the element id which you want to export.
        var element = document.getElementById('divToExport');
        element.style.width = 'auto';
        element.style.height = 'auto';
        var opt = {
            margin:       0.5,
            filename:     'myfile.pdf',
            image:        { type: 'jpeg', quality: 100 },
            html2canvas:  { scale: 1 },
            jsPDF:        { unit: 'in', format: 'letter', orientation: 'portrait',precision: '12' }
          };
        
        // choose the element and pass it to html2pdf() function and call the save() on it to save as pdf.
        html2pdf().set(opt).from(element).save();
      }
</script>

</html>