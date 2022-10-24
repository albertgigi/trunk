<?php 

require_once "conexion.php";

class ModeloCategorias{

	static public function mdlMostrarCategorias(){

		/*************************************************************************************************************************************************************/
		$stmt = Conexion::conectar()-> prepare("SELECT `id`, `cta_final_cypyp`, `depe_final_cypyp`, `anio_final_cypyp`,
		FORMAT(`Enero`,0) AS Enero, FORMAT(`Febrero`,0) AS Febrero, FORMAT(`Marzo`,0) AS Marzo, FORMAT(`Abril`,0) AS Abril, FORMAT(`Mayo`,0) AS Mayo, FORMAT(`Junio`,0) AS Junio,
        FORMAT(`Julio`,0) AS Julio, FORMAT(`Agosto`,0) AS Agosto, FORMAT(`Septiembre`,0) AS Septiembre, FORMAT(`Octubre`,0) AS Octubre, FORMAT(`Noviembre`,0) AS Noviembre,
        FORMAT(`Diciembre`,0) AS Diciembre, `consumo_mes_anterior`, `consumo_mismo_mes_year_anterior`
        FROM `tbl_final_consumo_year_pasado_y_comparaciones_agua`;");

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt = null;
	}

}