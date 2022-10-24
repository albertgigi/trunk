<!-- CONTENT-HEADER -->
<section class="content-header">

	<div class="container-fluid">

		<div class="row mb-2">

			<div class="col-sm-6">
				<h1>Administrar Categorías</h1>
			</div>

			<div class="col-sm-6">
				
				<ol class="breadcrumb float-sm-right">

					<li class="breadcrumb-item"><a href="index.php">Inicio</a></li>

                	<li class="breadcrumb-item active">Gestor Categorías</li>						
				</ol>

			</div>
		</div>	
	</div>	<!---HASTA AUQI EL DIV DE ETA SECCION-->

</section>
<!-- /. CONTENT HEADER -->
<body>
      <form action="" name="mibusqueda" id="mibusqueda" method="POST" class="form_buscar">
        <h2>Periodo</h2>
        <label for="periodo_inicio">Inicio:</label>
        <input type="text" placeholder="Fecha Inicio" name="periodo_inicio" id="periodo_inicio" value="">
        <label for="periodo_fin">Fin:</label>
        <input type="text" placeholder="Fecha Fin" name="periodo_fin" id="periodo_fin" value="">
        <!--input type="text" placeholder="Fecha Fin" name="periodo_fin" id="periodo_fin" onchange="calculoNoches();" value="" disabled-->
        <!--p id="calculoNoches"></p><br/-->
        <!--div align="center"-->
          <input type="submit" value="Buscar x Rango" name="buscar" id="buscar"><br/>
        <!--/div-->
      </form>
      </body>
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

        <div class="btn-agregar-categoria btnAgregar">
            <button type="button" class="btn btn-info btn-sm mb-4" data-toggle="modal" data-target="#modal-gestionar-categoria" data-dismiss="modal"> <i class="fas fa-plus-square"></i> Agregar Categoría</button>
        </div>

        <table id="" class="table table-striped table-bordered nowrap" style="width:100%;">
            <thead class="bg-info">
                <tr>
                    <td style="width:5%;">Id</td>
                    <td>Cuenta</td>
                    <td>Dependencia</td>
                    <td style="width:10%;">Periodo Inicio</td>
                    <td style="width:10%;">Año Inicio</td>
                    <td style="width:10%;">Mes Inicio</td>
                    <td style="width:10%;">Periodo Fin</td>
                    <td style="width:10%;">Año Fin</td>
                    <td style="width:10%;">Mes Fin</td>
                    <td style="width:10%;">Ene. Consumo</td>
                    <td style="width:10%;">Feb. Consumo</td>
                    <td style="width:10%;">Mar. Consumo</td>
                    <td style="width:10%;">Abr. Consumo</td>
                    <td style="width:10%;">May. Consumo</td>
                    <td style="width:10%;">Jun. Consumo</td>
                    <td style="width:10%;">Jul. Consumo</td>
                    <td style="width:10%;">Ago. Consumo</td>
                    <td style="width:10%;">Sep. Consumo</td>
                    <td style="width:10%;">Oct. Consumo</td>
                    <td style="width:10%;">Nov. Consumo</td>
                    <td style="width:10%;">Dic. Consumo</td>
                    <td style="width:10%;">Ene. Costo</td>
                    <td style="width:10%;">Feb. Costo</td>
                    <td style="width:10%;">Mar. Costo</td>
                    <td style="width:10%;">Abr. Costo</td>
                    <td style="width:10%;">May. Costo</td>
                    <td style="width:10%;">Jun. Costo</td>
                    <td style="width:10%;">Jul. Costo</td>
                    <td style="width:10%;">Ago. Costo</td>
                    <td style="width:10%;">Sep. Costo</td>
                    <td style="width:10%;">Oct. Costo</td>
                    <td style="width:10%;">Nov. Costo</td>
                    <td style="width:10%;">Dic. Costo</td>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>    

    </div>  

</section>
<!-- ./ CONTENT -->

<!-- VENTANA MODAL PARA REGISTRO Y ACTUALIZACION -->
<div class="modal fade" id="modal-gestionar-categoria">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <!-- ============================================================
            =MODAL HEADER
            ===============================================================-->
            <div class="modal-header bg-info">
                <h4 class="modal-title">Gestionar Categoría</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- ============================================================
            =MODAL BODY
            ===============================================================-->
            <div class="modal-body">
               <div class="row">
                   <div class="col-sm-4">
                        <div class="form-group">
                            <input type="hidden" id ="idcta" name ="categoria" value ="">
                            <label for="txtcta">Cuenta</label>
                            <input type="text" class="form-control" name="categoria" id="txtcta" placeholder="Ingrese la cuenta">
                        </div>
                   </div>
                   <div class="col-sm-4">
                        <div class="form-group">
                            <label for="txtdepe_eleanio_actual2">Dependencia</label>
                            <input type="text" class="form-control" name="depe_eleanio_actual2" id="txtdepe_eleanio_actual2" placeholder="Inghrese la dependencia">
                        </div>
                   </div>
                   <div class="col-sm-4">
                        <div class="form-group">
                        <label for="txtmes_inicio">Mes Inicio</label>
                            <input type="text" class="form-control" name="mes_inicio" id="txtmes_inicio" placeholder="Ingrese el mes">
                            </select>
                        </div>
                   </div>
               </div>
            </div>
            <!-- ============================================================
            =MODAL FOOTER
            ===============================================================-->
            <div class="modal-footer justify-content-end">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                <button type="button" id="btnGuardar" class="btn btn-primary">Guardar</button>
            </div>

        </div>

    </div>

</div>
<!-- ./ VENTANA MODAL PARA REGISTRO Y ACTUALIZACION -->

<script>

	$(document).ready(function(){

        var accion = "";

        var Toast = Swal.mixin({
                                  toast: true,
                                  position: 'top-end',
                                  showConfirmButton: false,
                                  timer: 3000
                                });

  		var table = $("#").DataTable({
  			"ajax":{
				"url": "ajax/categorias.ajax.php",
				"type":"POST",
				"dataSrc":""
			},  			
            /*"columnDefs":[ 
	            	{
                        "searchable": false,
	            		"targets": 4,
	            		"sortable": false,
	            		"render": function (data, type, full, meta){

	            			if(data == 1){
								return "<div class='bg-primary color-palette text-center'>ACTIVO</div> " 
	            			}else{
								return "<div class='bg-danger color-palette text-center'>INACTIVO</div> " 
	            			}
	            			
	            		}
	            	},
            		{
	            		"targets": 5,
	            		"sortable": false,
	            		"render": function (data, type, full, meta){
	            			return "<center>" +
	                                    "<button type='button' class='btn btn-primary btn-sm btnEditar' data-toggle='modal' data-target='#modal-gestionar-categoria'> " +
	            						  "<i class='fas fa-pencil-alt'></i> " +
	            					    "</button> " + 
	            					    "<button type='button' class='btn btn-danger btn-sm btnEliminar'> " +
	            						  "<i class='fas fa-trash'> </i> " +
	            					    "</button>" +
	                                "</center>";
	                    }
            		}
            	],*/
            "columns":[
                    {"data": "id"},
                    {"data": "cta"},
                    {"data": "depe_eleanio_actual2"},
                    {"data": "periodo_inicio"},
                    {"data": "year_inicio"},
                    {"data": "mes_inicio"},
                    {"data": "periodo_fin"},
                    {"data": "year_fin"},
                    {"data": "mes_fin"},
                    {"data": "enero_con"},
                    {"data": "febrero_con"},
                    {"data": "marzo_con"},
                    {"data": "abril_con"},
                    {"data": "mayo_con"},
                    {"data": "junio_con"},
                    {"data": "julio_con"},
                    {"data": "agosto_con"},
                    {"data": "septiembre_con"},
                    {"data": "octubre_con"},
                    {"data": "noviembre_con"},
                    {"data": "diciembre_con"},
                    {"data": "enero_cos"},
                    {"data": "febrero_cos"},
                    {"data": "marzo_cos"},
                    {"data": "abril_cos"},
                    {"data": "mayo_cos"},
                    {"data": "junio_cos"},
                    {"data": "julio_cos"},
                    {"data": "agosto_cos"},
                    {"data": "septiembre_cos"},
                    {"data": "octubre_cos"},
                    {"data": "noviembre_cos"},
                    {"data": "diciembre_cos"},
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

        /*$(".btn-agregar-categoria").on('click',function(){
            accion = "registrar";
        });

        $('# tbody').on('click','.btnEliminar',function(){
            var data = table.row($(this).parents('tr')).data();
            
            var id = data["id"];

            var datos = new FormData();
            datos.append('accion',"eliminar")
            datos.append('id',id);

            swal.fire({

                title: "¡CONFIRMACION!",
                text: "Seguro que desea eliminar la categoria?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: "Sí, Eliminar",
                cancelButtonText: "Cancelar"

            }).then(resultado => {

                if(resultado.value)  {                    

                    //LLAMADO AJAX
                    $.ajax({
                        url: "ajax/categorias.ajax.php",
                        method: "POST",
                        data: datos,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function(respuesta){

                            console.log(respuesta);
                        
                            table.ajax.reload( null, false );                            

                            Toast.fire({
                                icon: 'success',
                                title: respuesta
                            });
                        
                        }
                    })
                }
                else{
                    // alert("no se modifico la categoria");
                }

            })
        })
*/
        /*$('# tbody').on('click','.btnEditar',function(){
            
            var data = table.row($(this).parents('tr')).data();
            accion = "actualizar";

            $("#idCategoria").val(data["id"])
            $("#txtcta").val(data["cta"]);
            $("#txtdepe_eleanio_actual2").val(data["depe_eleanio_actual2"]);
            $("#txtperiodo_inicio").val(data["periodo_inicio"]);
            $("#txtyear_inicio").val(data["year_inicio"]);
            $("#txtmes_inicio").val(data["mes_inicio"]);
            $("#txtperiodo_fin").val(data["periodo_fin"]);
            $("#txtyear_fin").val(data["year_fin"]);
            $("#txtmes_fin").val(data["mes_fin"]);


        })*/

        // GUARDAR LA INFORMACION DE CATEGORIA DESDE LA VENTANA MODAL
        /*$("#btnGuardar").on('click',function(){

            var id = $("#idcta").val(),
                cta = $("#txtcta").val(),
                depe_eleanio_actual2 = $("#txtdepe_eleanio_actual2").val(),
                //periodo_inicio = $("#txtperiodo_inicio").val(),
                periodo_inicio = new Date().toISOString().replace(/T/, ' ').replace(/\..+/, '');
                year_inicio = new Year().replace(/T/, ' ').replace(/\..+/, '');

            
            var datos = new FormData();

            datos.append('id',id)
            datos.append('categoria',categoria)
            datos.append('ruta',ruta);
            datos.append('estado',estado);
            datos.append('fecha',fecha);
            datos.append('accion',accion);

            swal.fire({
                title: "¡CONFIRMAR!",
                text: "¿Está seguro que desea registrar la cuenta?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: "Si, deseo registrar",
                cancelButtonText: "Cancelar"
            
            }).then(resultado => {

                if(resultado.value)  {
            
                    

                    $.ajax({
                        url: "ajax/categorias.ajax.php",
                        method: "POST",
                        data: datos,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function(respuesta){
                            console.log(respuesta);

                            $("#modal-gestionar-categoria").modal('hide');
                            
                            table.ajax.reload(null,false);

                            $("#idCategoria").val("");
                            $("#txtCategoria").val("");
                            $("#txtRuta").val("");
                            $("#ddlEstado").val([1]);

                            Toast.fire({
                                icon: 'success',
                                title: respuesta
                            })

                        }
                    });
                }
                else{
            
                }

            })

            

            
        })*/

    
	})

    
	
	

</script>