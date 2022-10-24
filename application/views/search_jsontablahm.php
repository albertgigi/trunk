<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$conn = new mysql("localhost","sdspan3","RTRIUHG54637","sdspanel1");

$result = $conn->query("SELECT yer_tar_hm_final_x_mepo, Enero, Febrero, Marzo, Abril,
Mayo, Junio, Julio, Agosto, Septiembre, Octubre, Noviembre, Diciembre, cta_tar_hm_final_x_mepo,
dep_tar_hm_final_x_mepo FROM pdc_tar_hm_final_x_mepo");

$outp = "[";
while($rs = $result->fetch_array(MYSQL_ASSOC)) {
    if ($outp != "[") {$outp .= ",";}
    $outp .= '{"Fecha":"'  . $rs["yer_tar_hm_final_x_mepo"] . '",';
    $outp .= '"Enero":"'   . $rs["Enero"]        . '",';
    $outp .= '"Febrero":"'. $rs["Febrero"]     . '"}';
    $outp .= '"Marzo":"'. $rs["Marzo"]     . '"}';
    $outp .= '"Abril":"'. $rs["Abril"]     . '"}';
    $outp .= '"Mayo":"'. $rs["Mayo"]     . '"}';
    $outp .= '"Junio":"'. $rs["Junio"]     . '"}';
    $outp .= '"Julio":"'. $rs["Julio"]     . '"}';
    $outp .= '"Agosto":"'. $rs["Agosto"]     . '"}';
    $outp .= '"Septiembre":"'. $rs["Septiembre"]     . '"}';
    $outp .= '"Octubre":"'. $rs["Octubre"]     . '"}';
    $outp .= '"Noviembre":"'. $rs["Noviembre"]     . '"}';
    $outp .= '"Diciembre":"'. $rs["Diciembre"]     . '"}';
    $outp .= '"NIS":"'. $rs["cta_tar_hm_final_x_mepo"]     . '"}';
    $outp .= '"Dependencia":"'. $rs["dep_tar_hm_final_x_mepo"]     . '"}';
}
$outp .="]";

$conn->close();

echo($outp);
?>