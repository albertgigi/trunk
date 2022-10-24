<?php
include 'config_elec_2years.php';

## Read value
$draw = $_POST['draw'];
$row = $_POST['start'];
$rowperpage = $_POST['length']; // Rows display per page
$columnIndex = $_POST['order'][0]['column']; // Column index
$columnName = $_POST['columns'][$columnIndex]['data']; // Column name
$columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
$searchValue = mysqli_real_escape_string($con,$_POST['search']['value']); // Search value

## Date search value
$searchByFromdate = mysqli_real_escape_string($con,$_POST['searchByFromdate']);
$searchByTodate = mysqli_real_escape_string($con,$_POST['searchByTodate']);

## Search 
$searchQuery = " ";
if($searchValue != ''){
    $searchQuery = " and (cta like '%".$searchValue."%' or depe_eleanio_actual2 like '%".$searchValue."%' ) ";
}

// Date filter
if($searchByFromdate != '' && $searchByTodate != ''){
    $searchQuery .= " and (periodo_inicio between '".$searchByFromdate."' and '".$searchByTodate."' ) ";
}

## Total number of records without filtering
$sel = mysqli_query($con,"select count(*) as allcount from comparacion_year_actual_y_pasado_noid_final");
$records = mysqli_fetch_assoc($sel);
$totalRecords = $records['allcount'];

## Total number of records with filtering
$sel = mysqli_query($con,"select count(*) as allcount from comparacion_year_actual_y_pasado_noid_final WHERE 1 ".$searchQuery);
$records = mysqli_fetch_assoc($sel);
$totalRecordwithFilter = $records['allcount'];

## Fetch records
$empQuery = "select * from comparacion_year_actual_y_pasado_noid_final WHERE 1 ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;
$empRecords = mysqli_query($con, $empQuery);
$data = array();

while ($row = mysqli_fetch_assoc($empRecords)) {
    $data[] = array(
    	"cta"=>$row['cta'],
    	"depe_eleanio_actual2"=>$row['depe_eleanio_actual2'],
    	"periodo_inicio"=>$row['periodo_inicio'],
    	"periodo_fin"=>$row['periodo_fin'],
    	"enero_cos"=>$row['enero_cos'],
        "febrero_cos"=>$row['febrero_cos'],
        "marzo_cos"=>$row['marzo_cos'],
        "abril_cos"=>$row['abril_cos'],
        "mayo_cos"=>$row['mayo_cos'],
        "junio_cos"=>$row['junio_cos'],
        "julio_cos"=>$row['julio_cos'],
        "agosto_cos"=>$row['agosto_cos'],
        "septiembre_cos"=>$row['septiembre_cos'],
        "octubre_cos"=>$row['octubre_cos'],
        "noviembre_cos"=>$row['noviembre_cos'],
        "diciembre_cos"=>$row['diciembre_cos'],
        "enero_con"=>$row['enero_con'],
        "febrero_con"=>$row['febrero_con'],
        "marzo_con"=>$row['marzo_con'],
        "abril_con"=>$row['abril_con'],
        "mayo_con"=>$row['mayo_con'],
        "junio_con"=>$row['junio_con'],
        "julio_con"=>$row['julio_con'],
        "agosto_con"=>$row['agosto_con'],
        "septiembre_con"=>$row['septiembre_con'],
        "octubre_con"=>$row['octubre_con'],
        "noviembre_con"=>$row['noviembre_con'],
        "diciembre_con"=>$row['diciembre_con']

    );
}

## Response
$response = array(
    "draw" => intval($draw),
    "iTotalRecords" => $totalRecords,
    "iTotalDisplayRecords" => $totalRecordwithFilter,
    "aaData" => $data
);

echo json_encode($response);
die;
?>