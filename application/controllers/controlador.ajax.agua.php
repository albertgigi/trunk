<?php 

require_once "../controllers/controlador.categorias.agua.php";
require_once "../models/modelo.categorias.agua.php";

class ajaxCategorias{

	public $id;
	public $cta_consumo_final_pasado;
	public $dep_consumo_final_pasado;
	public $yer_consumo_final_pasado;
	public $Enero;
	public $Febrero;
	public $Marzo;
	public $Abril;
	public $Mayo;
	public $Junio;
	public $Julio;
	public $Agosto;
	public $Septiembre;
	public $Octubre;
	public $Noviembre;
	public $Diciembre;
	public function MostrarCategorias(){

		$respuesta = ControladorCategorias::ctrMostrarCategorias();

		echo json_encode($respuesta);
	}

	public function registrarCategorias(){
		
		$respuesta = ControladorCategorias::ctrRegistrarCategorias($this->cta_consumo_final_pasado, $this->dep_consumo_final_pasado,
		$this->yer_consumo_final_pasado, $this->Enero,$this->Febrero,$this->Marzo,$this->Abril,$this->Mayo,$this->Junio,
		$this->Julio,$this->Agosto,$this->Septiembre,$this->Octubre,$this->Noviembre,$this->Diciembre);
		echo json_encode($respuesta,JSON_UNESCAPED_UNICODE);
	}

	public function eliminarCategoria(){
		
		$respuesta = ControladorCategorias::ctrEliminarCategoria($this->id);

		echo json_encode($respuesta,JSON_UNESCAPED_UNICODE);
	}

	public function actualizarCategoria(){
		
		$respuesta = ControladorCategorias::ctrActualizarCategoria($this->id,$this->cta_consumo_final_pasado,
		$this->dep_consumo_final_pasado, $this->yer_consumo_final_pasado,
		$this->Enero,$this->Febrero,$this->Marzo,$this->Abril,$this->Mayo,$this->Junio,
		$this->Julio,$this->Agosto,$this->Septiembre,$this->Octubre,$this->Noviembre,$this->Diciembre);
		echo json_encode($respuesta,JSON_UNESCAPED_UNICODE);
	}
	
}

if(!isset($_POST["accion"])){
	$respuesta = new ajaxCategorias();
	$respuesta -> MostrarCategorias();
}else{

	if($_POST["accion"] == "registrar"){
		$insertar = new ajaxCategorias();
		$insertar->cta_consumo_final_pasado = $_POST["cta_consumo_final_pasado"];
	}

	if($_POST["accion"] == "eliminar"){
		$eliminar = new ajaxCategorias();
		$eliminar->id = $_POST["id"];
		$eliminar->eliminarCategoria();
	}

	if($_POST["accion"] == "actualizar"){
		$actualizar = new ajaxCategorias();

		$actualizar->id = $_POST["id"];
		$actualizar->cta_consumo_final_pasado = $_POST["cta_consumo_final_pasado"];
		$actualizar->actualizarCategoria();
	}

}