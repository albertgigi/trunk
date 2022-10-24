<?php 

require_once "conexion.php";

class ModeloCategorias{

	static public function mdlMostrarCategorias(){

		/*************************************************************************************************************************************************************/
		$stmt = Conexion::conectar()-> prepare("SELECT
		 /*`id`,*/ 
		`cta_final_cypyp` AS cuentita,
		`depe_final_cypyp` AS dependencita,
		`anio_final_cypyp` AS anhito,
		CONCAT(FORMAT(`Enero`,0), ' KwH') AS Enero,
		CONCAT(FORMAT(`Febrero`,0), ' KwH') AS Febrero,
		CONCAT(FORMAT(`Marzo`,0), ' KwH') AS Marzo,
		CONCAT(FORMAT(`Abril`,0), ' KwH') AS Abril,
        CONCAT(FORMAT(`Mayo`,0), ' KwH') AS Mayo,
		CONCAT(FORMAT(`Junio`,0), ' KwH') AS Junio,
		CONCAT(FORMAT(`Julio`,0), ' KwH') AS Julio,
		CONCAT(FORMAT(`Agosto`,0), ' KwH') AS Agosto,
        CONCAT(FORMAT(`Septiembre`,0), ' KwH') AS Septiembre,
		CONCAT(FORMAT(`Octubre`,0), ' KwH') AS Octubre,
        CONCAT(FORMAT(`Noviembre`,0), ' KwH') AS Noviembre,
		CONCAT(FORMAT(`Diciembre`,0), ' KwH') AS Diciembre/*,
		`consumo_actual`, `consumo_mes_anterior`, `consumo_mismo_mes_year_anterior`*/
		 FROM `tbl_final_consumo_year_pasado_y_comparaciones`;");

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt = null;
	}

}