<?php 

class ControladorCategorias{

	static public function ctrMostrarCategorias(){
		
		$respuesta = ModeloCategorias::mdlMostrarCategorias();

		return $respuesta;
	}

	static public function ctrRegistrarCategorias($cta_consumo_final_pasado,$dep_consumo_final_pasado,$yer_consumo_final_pasado,
	$Enero,$Febrero,$Marzo,$Abril,$Mayo,$Junio,$Julio,$Agosto,$Septiembre,$Octubre,$Noviembre,$Diciembre){

		$respuesta = ModeloCategorias::mdlRegistrarCategorias($cta_consumo_final_pasado,$dep_consumo_final_pasado,$yer_consumo_final_pasado,
		$Enero,$Febrero,$Marzo,$Abril,$Mayo,$Junio,$Julio,$Agosto,$Septiembre,$Octubre,$Noviembre,$Diciembre);

		return $respuesta;
	}

	static public function ctrEliminarCategoria($id){

		$respuesta = ModeloCategorias::mdlEliminarCategoria($id);

		return $respuesta;
	}

	static public function ctrActualizarCategoria(/*$id,*/$cta_consumo_final_pasado,$dep_consumo_final_pasado,$yer_consumo_final_pasado,
		$Enero,$Febrero,$Marzo,$Abril,$Mayo,$Junio,$Julio,$Agosto,$Septiembre,$Octubre,$Noviembre,$Diciembre){

		$respuesta = ModeloCategorias::mdlActualizarCategoria(/*$id,*/$cta_consumo_final_pasado,$dep_consumo_final_pasado,$yer_consumo_final_pasado,
			$Enero,$Febrero,$Marzo,$Abril,$Mayo,$Junio,$Julio,$Agosto,$Septiembre,$Octubre,$Noviembre,$Diciembre);

		return $respuesta;
	}

}