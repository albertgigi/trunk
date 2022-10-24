<?php if (!defined('BASEPATH')) exit('Prohibido el acceso');
/* secure your snippet from external access */

/* Funciones para la generación de gráficas */

/* Primer año en el que hubo registro */
function first_year($actual) {
	$actual->db->not_like('reg_period_start', '0000');
	$actual->db->select_min('reg_period_start');
	$query = $actual->db->get('ctrl_recibos');
	$row = $query->row();
	$break = explode('-', $row->reg_period_start);
	return $break[0];
}

/* Regresa una lista de los últimos años*/
function anios($actual, $limit='') {
	if(trim($limit)=='') $limit=0;
	$first_year = first_year($actual);
	$cur_year = date('Y'); $cur_year += 0;

	if($limit!=0) $start = $cur_year-$limit;
	else $start = $first_year;
	
	for($i=$start ; $i<$cur_year+1; $i++) {
		$anios[] = $i;
	} /* for */
	return $anios;
}

/* Sumar todos los valores de un arreglo */
function array_total($arreglo) {
	$total=0;
	foreach($arreglo as $arr) {
		$total += $arr;
	}
	if($total != 0) return true;
	else return false;
}

/* CONSUMO/COSTO */
function total_mes($actual, $area, $medida, $anio, $mes, $site='') {
	// Periodo de tiempo
	$lapso_start 	= date('Y-m-d', mktime(0, 0, 0, $mes, 1, $anio));
	$lapso_end 	= date('Y-m-d', mktime(0, 0, 0, $mes+1, 0, $anio));
	
	if(trim($site)!='') $actual->db->where('reg_site', $site);
	$actual->db->where('reg_area', $area);
	$actual->db->where('reg_period_start >=', $lapso_start);
	$actual->db->where('reg_period_end <=', $lapso_end);
	$query = $actual->db->get('ctrl_recibos');	
	
	if($query->num_rows() > 0) {
		$total = 0;
		foreach($query->result() as $row) {			
			$total += $row->$medida;
		} // foreach		
		if($total != 0) return $total;
		else return false;
	} else { return 0; }
}
// CONSUMO/COSTO TOTAL en una ZONA en un mes
function total_mes_zona($actual, $area, $medida, $anio, $mes, $zona) {
	// Sitios de la zona
	$sitios = $actual->modelo_controlp->zona_meds_id($zona);
	// Periodo de tiempo
	$lapso_start 	= date('Y-m-d', mktime(0, 0, 0, $mes, 1, $anio));
	$lapso_end 	= date('Y-m-d', mktime(0, 0, 0, $mes+1, 0, $anio));
	
	if(trim($zona)!='') $actual->db->where_in('reg_site', $sitios);
	$actual->db->where('reg_area', $area);
	$actual->db->where('reg_period_start >=', $lapso_start);
	$actual->db->where('reg_period_end <=', $lapso_end);
	$query = $actual->db->get('ctrl_recibos');	
	
	if($query->num_rows() > 0) {
		$total = 0;
		foreach($query->result() as $row) {			
			$total += $row->$medida;
		} // foreach		
		if($total != 0) return $total;
		else return false;
	} else { return 0; }
}

// CONSUMO/COSTO TOTAL en una área en un año
function total_anio($actual, $area, $medida, $anio, $site='') {
	$lapso_start = date('Y-m-d', mktime(0, 0, 0, 1, 1, $anio));
	$lapso_end = date('Y-m-d', mktime(0, 0, 0, 12, 31, $anio));
	
	if(trim($site)!='') $actual->db->where('reg_site', $site);
	$actual->db->where('reg_area', $area);
	$actual->db->where('reg_period_end >=', $lapso_start);
	$actual->db->where('reg_period_start <=', $lapso_end);
	$actual->db->order_by('reg_period_start', 'asc');
	$query = $actual->db->get('ctrl_recibos');
	
	if($query->num_rows() > 0) {
		$total = 0;
		foreach($query->result() as $row) {
			$total += $row->$medida;
		} // foreach
		return $total;
	} else { return 0; }
}
// CONSUMO/COSTO TOTAL en una área en un año
function total_anio_zona($actual, $area, $medida, $anio, $zona) {
	// Sitios de la zona
	$sitios = $actual->modelo_controlp->zona_meds_id($zona);
	// Periodo de tiempo
	$lapso_start = date('Y-m-d', mktime(0, 0, 0, 1, 1, $anio));
	$lapso_end = date('Y-m-d', mktime(0, 0, 0, 12, 31, $anio));
	
	if(trim($zona)!='') $actual->db->where_in('reg_site', $sitios);
	$actual->db->where('reg_area', $area);
	$actual->db->where('reg_period_end >=', $lapso_start);
	$actual->db->where('reg_period_start <=', $lapso_end);
	$actual->db->order_by('reg_period_start', 'asc');
	$query = $actual->db->get('ctrl_recibos');
	
	if($query->num_rows() > 0) {
		$total = 0;
		foreach($query->result() as $row) {
			$total += $row->$medida;
		} // foreach
		return $total;
	} else { return 0; }
}

/* ESTADÍSTICAS Y CONTEOS */

/* 10 dependencias más consumidoras de cada recurso */
class elem {
	public $site;
	public $cant;
	public function __construct($site, $cant) {
		$this->site = $site;
		$this->cant = $cant;
	}
}
function major_consumers($actual, $area, $anio='') {
	$area_data = is_area($actual, $area);
	if($anio!='') {
		$anio_start 	= date('Y-m-d', mktime(0, 0, 0, 1, 1, $anio));
		$anio_end 	= date('Y-m-d', mktime(0, 0, 0, 12, 31, $anio));
	}
	$medidores = $actual->modelo_controlp->medidor_list();
	
	// Ciclo por sites
	foreach($medidores as $medidor) {
		$actual->db->where('reg_site', $medidor->med_id);
		
		if($anio!='') {
			$actual->db->where('reg_period_end >=', $anio_start);
			$actual->db->where('reg_period_start <= ', $anio_end);
		}
		
		
		$actual->db->where('reg_area', $area_data->area_id);		
		$query = $actual->db->get('ctrl_recibos');		
		if($query->num_rows() > 0) {
			$total = 0;
			foreach($query->result() as $row) {
				$total += $row->reg_consum;
			} // foreach
			$list[] = new elem($row->reg_site, $total);
		} // if
		
	} // foreach

	if(isset($list)) {
		$sorted_asc = sort_obj_array($list, 'cant');	
		$size = count($sorted_asc);
		
		if($size > 10) {
			$otros = 0;
			for($i = $size; $i > $size-10; $i--) {
				$major[$sorted_asc[$i-1]->site] = $sorted_asc[$i-1]->cant;
			} // for
			for($i = $size-10; $i > 0; $i--) {		
				$otros += $sorted_asc[$i-1]->cant;
			} // for
			$major['otros'] = $otros;
		}
		else {
			for($i = $size; $i > 0; $i--) {
				$major[$sorted_asc[$i-1]->site] = $sorted_asc[$i-1]->cant;
			} // for
		}
		// Arreglo asociativo; array[id del sitio][consumo]
		return $major;	
	}
	else { return false; }
}

/* Recibe un arreglo major y regresa el arreglo de sitios*/
function major_sites($actual, $major) {
	foreach($major as $key => $value) {
		$site_data = $actual->modelo_controlp->medidor_data($key);
		if($site_data) $data[] = $site_data->med_name;
		else $data[] = 'Otras';
	} // foreach
	return $data;
}
/* Recibe un arreglo major y regresa el arreglo de consumos*/
function major_consum($major) {
	foreach($major as $key => $value) {		
		$data[] = $value;
	} // foreach
	return $data;
}

function sort_obj_array($array, $property) {
    $cur = 1;
    $stack[1]['l'] = 0;
    $stack[1]['r'] = count($array)-1;

    do {
        $l = $stack[$cur]['l'];
        $r = $stack[$cur]['r'];
        $cur--;

        do {
            $i = $l;
            $j = $r;
            $tmp = $array[(int)( ($l+$r)/2 )];

            do {
                while( $array[$i]->{$property} < $tmp->{$property} ) $i++;
                while( $tmp->{$property} < $array[$j]->{$property} ) $j--;
                
                if( $i <= $j) {
                    $w = $array[$i];
                    $array[$i] = $array[$j];
                    $array[$j] = $w;

                    $i++;
                    $j--;
                }

            } while ( $i <= $j );

            if( $i < $r ) {
                $cur++;
                $stack[$cur]['l'] = $i;
                $stack[$cur]['r'] = $r;
            }
            $r = $j;

        } while ( $l < $r );

    } while ( $cur != 0 );

    return $array;
}

/* FUNCIÓN DE PORCENTAJE */
function percent($value, $total) {
	$val_one = ($value / $total)*100;
	$val_one = ceil($val_one);
	return $val_one;
}


/////////////////////////////////////////////////////////////////////////////////////
/* GENERACIÓN DE GRÁFICAS - CONSTRUCTOR */
/////////////////////////////////////////////////////////////////////////////////////

/* Gráfica de barras para un año */
function barras_mensual($actual, $area, $medida, $anio='', $site='') {

	/* Título de la medición. Para fines de graficación. */
	switch($medida) {
		case 'consumo' : 
			$cmedida = 'reg_consum';
			$med_name = 'Consumo';
			switch($area) {
				case 'electricidad' :
					$med_title = 'Consumo (kwh)';
					break;
				case 'agua' :
					$med_title = 'Consumo (m3)';
					break;
			}
			break;
		case 'costo' :
			$cmedida = 'reg_cost';
			$med_name = 'Costo';
			$med_title = 'Costo ($)';
			break;
	}

	$MyData = new pData();
	/* 
		Obtiene el total de cada mes del año y llena el arreglo con los valores
		depende del área recibida utiliza una función.
	*/
	$area_data = is_area($actual, $area);
	for($i = 1; $i < 13; $i++) { 
		$total[] = total_mes($actual, $area_data->area_id, $cmedida, $anio, $i, $site); 
	}
	$MyData->addPoints($total, $med_name);
	$MyData->setAxisName(0, $med_title);
	$real = array_total($total);
	
	/*
	switch($area) {
		case 'electricidad' :
			for($i = 1; $i < 13; $i++) { 
				$total[] = total_mes($actual, 'ctrl_reg_electro', $cmedida, $anio, $i, $site); 
			}
			$MyData->addPoints($total, $med_name);
			$MyData->setAxisName(0, $med_title);
			$real = array_total($total);
			break;
		case 'agua' :
			for($i = 1; $i < 13; $i++) { 
				$total[] = total_mes($actual, 'ctrl_reg_water', $cmedida, $anio, $i, $site); 
			}
			$MyData->addPoints($total, $med_name);
			$MyData->setAxisName(0, $med_title);
			$real = array_total($total);
			break;
	}
	*/
	
	$MyData->addPoints(array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre' , 'Diciembre'), "Mes"); 
	$MyData->setAbscissa("Mes"); 
	$MyData->setAbscissaName("Mes"); 
	
	if($real) {
		/* Create the pChart object */ 
		$myPicture = new pImage(960,480,$MyData); 
		/*
		$myPicture->drawGradientArea(0,0,840,450,DIRECTION_VERTICAL,array("StartR"=>240,"StartG"=>240,"StartB"=>240,"EndR"=>180,"EndG"=>180,"EndB"=>180,"Alpha"=>100)); 
		$myPicture->drawGradientArea(0,0,840,450,DIRECTION_HORIZONTAL,array("StartR"=>240,"StartG"=>240,"StartB"=>240,"EndR"=>180,"EndG"=>180,"EndB"=>180,"Alpha"=>20)); 
		*/
		$myPicture->setFontProperties(array("FontName"=>"fonts/pf_arma_five.ttf","FontSize"=>7)); 
		/* Draw the chart scale */  
		$myPicture->setGraphArea(100,30,820,400); 
		$myPicture->drawScale(array("CycleBackground"=>TRUE,"DrawSubTicks"=>TRUE,"GridR"=>0,"GridG"=>0,"GridB"=>0,"GridAlpha"=>10,"Pos"=>SCALE_POS_LEFTRIGHT));
		/* Turn on shadow computing */  
		$myPicture->setShadow(TRUE,array("X"=>1,"Y"=>1,"R"=>0,"G"=>0,"B"=>0,"Alpha"=>10));		
		$MyData->setPalette($med_name, array("R"=>249,"G"=>178,"B"=>0,"Alpha"=>100));
		/* Draw the chart */
		$myPicture->drawBarChart(array("DisplayPos"=>LABEL_POS_TOP,"DisplayValues"=>TRUE,"Rounded"=>TRUE,"Surrounding"=>30)); 		
	} // if
	else {
		$myPicture = new pImage(840,450); 
		$myPicture->drawGradientArea(0,0,840,450,DIRECTION_VERTICAL,array("StartR"=>240,"StartG"=>240,"StartB"=>240,"EndR"=>180,"EndG"=>180,"EndB"=>180,"Alpha"=>100)); 
		$myPicture->drawGradientArea(0,0,840,450,DIRECTION_HORIZONTAL,array("StartR"=>240,"StartG"=>240,"StartB"=>240,"EndR"=>180,"EndG"=>180,"EndB"=>180,"Alpha"=>20)); 
		$myPicture->setShadow(TRUE,array("X"=>1,"Y"=>1,"R"=>0,"G"=>0,"B"=>0,"Alpha"=>20)); 
		$myPicture->setFontProperties(array("FontName"=>"fonts/pf_arma_five.ttf","FontSize"=>7)); 
		
		$TextSettings = array("R"=>51,"G"=>51,"B"=>51,"FontSize"=>16); 
		$myPicture->drawText(40,200,"No hay información para graficar.",$TextSettings); 			
	}
	$file_name = 'BarrasMensual';
	$file_name .= '_'.$area;
	$file_name .= '_'.$medida;
	if(trim($anio)!='') $file_name .= '_'.$anio;
	if(trim($site)!='') $file_name .= '_'.$site;
	$file_name .= '.png';
	$myPicture->render('graficas/'.$file_name);
}
/* Gráfica de barras para un año, por zona */
function barras_mensual_zona($actual, $area, $medida, $anio='', $zona='') {

	/* Título de la medición. Para fines de graficación. */
	switch($medida) {
		case 'consumo' : 
			$cmedida = 'reg_consum';
			$med_name = 'Consumo';
			switch($area) {
				case 'electricidad' :
					$med_title = 'Consumo (kwh)';
					break;
				case 'agua' :
					$med_title = 'Consumo (m3)';
					break;
			}
			break;
		case 'costo' :
			$cmedida = 'reg_cost';
			$med_name = 'Costo';
			$med_title = 'Costo ($)';
			break;
	}

	$MyData = new pData();
	/* 
		Obtiene el total de cada mes del año y llena el arreglo con los valores
		depende del área recibida utiliza una función.
	*/
	$area_data = is_area($actual, $area);
	for($i = 1; $i < 13; $i++) { 
		$total[] = total_mes_zona($actual, $area_data->area_id, $cmedida, $anio, $i, $zona); 
	}
	$MyData->addPoints($total, $med_name);
	$MyData->setAxisName(0, $med_title);
	$real = array_total($total);
	/*			
	switch($area) {
		case 'electricidad' :
			for($i = 1; $i < 13; $i++) { 
				$total[] = total_mes_zona($actual, 'ctrl_reg_electro', $cmedida, $anio, $i, $zona); 
			}
			$MyData->addPoints($total, $med_name);
			$MyData->setAxisName(0, $med_title);
			$real = array_total($total);
			break;
		case 'agua' :
			for($i = 1; $i < 13; $i++) { 
				$total[] = total_mes_zona($actual, 'ctrl_reg_water', $cmedida, $anio, $i, $zona); 
			}
			$MyData->addPoints($total, $med_name);
			$MyData->setAxisName(0, $med_title);
			$real = array_total($total);
			break;
	}
	*/
	$MyData->addPoints(array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre' , 'Diciembre'), "Mes"); 
	$MyData->setAbscissa("Mes"); 
	$MyData->setAbscissaName("Mes"); 
	
	if($real) {
		/* Create the pChart object */ 
		$myPicture = new pImage(840,450,$MyData); 
		$myPicture->drawGradientArea(0,0,840,450,DIRECTION_VERTICAL,array("StartR"=>240,"StartG"=>240,"StartB"=>240,"EndR"=>180,"EndG"=>180,"EndB"=>180,"Alpha"=>100)); 
		$myPicture->drawGradientArea(0,0,840,450,DIRECTION_HORIZONTAL,array("StartR"=>240,"StartG"=>240,"StartB"=>240,"EndR"=>180,"EndG"=>180,"EndB"=>180,"Alpha"=>20)); 
		$myPicture->setFontProperties(array("FontName"=>"fonts/pf_arma_five.ttf","FontSize"=>7)); 
		/* Draw the chart scale */  
		$myPicture->setGraphArea(100,30,820,400); 
		$myPicture->drawScale(array("CycleBackground"=>TRUE,"DrawSubTicks"=>TRUE,"GridR"=>0,"GridG"=>0,"GridB"=>0,"GridAlpha"=>10,"Pos"=>SCALE_POS_LEFTRIGHT));
		/* Turn on shadow computing */  
		$myPicture->setShadow(TRUE,array("X"=>1,"Y"=>1,"R"=>0,"G"=>0,"B"=>0,"Alpha"=>10));		
		$MyData->setPalette($med_name, array("R"=>249,"G"=>178,"B"=>0,"Alpha"=>100));
		/* Draw the chart */
		$myPicture->drawBarChart(array("DisplayPos"=>LABEL_POS_TOP,"DisplayValues"=>TRUE,"Rounded"=>TRUE,"Surrounding"=>30)); 		
	} // if
	else {
		$myPicture = new pImage(840,450); 
		$myPicture->drawGradientArea(0,0,840,450,DIRECTION_VERTICAL,array("StartR"=>240,"StartG"=>240,"StartB"=>240,"EndR"=>180,"EndG"=>180,"EndB"=>180,"Alpha"=>100)); 
		$myPicture->drawGradientArea(0,0,840,450,DIRECTION_HORIZONTAL,array("StartR"=>240,"StartG"=>240,"StartB"=>240,"EndR"=>180,"EndG"=>180,"EndB"=>180,"Alpha"=>20)); 
		$myPicture->setShadow(TRUE,array("X"=>1,"Y"=>1,"R"=>0,"G"=>0,"B"=>0,"Alpha"=>20)); 
		$myPicture->setFontProperties(array("FontName"=>"fonts/pf_arma_five.ttf","FontSize"=>7)); 
		
		$TextSettings = array("R"=>51,"G"=>51,"B"=>51,"FontSize"=>16); 
		$myPicture->drawText(40,200,"No hay información para graficar.",$TextSettings); 			
	}
	$file_name = 'BarrasMensualZona';
	$file_name .= '_'.$area;
	$file_name .= '_'.$medida;
	if(trim($anio)!='') $file_name .= '_'.$anio;
	if(trim($zona)!='') $file_name .= '_'.$zona;
	$file_name .= '.png';
	$myPicture->render('graficas/'.$file_name);
}


/* Gráfica de barras para todos los años */
function barras_anual($actual, $area, $medida, $site='') {
	/* Se crea el objeto pChart */
	$MyData = new pData();	
	/* El lienzo principal */
	$myPicture = new pImage(960, 520,$MyData); 
	/* Fuente tipográfica */
	$myPicture->setFontProperties(array("FontName"=>"fonts/verdana.ttf", "FontSize"=>9, "R"=>60, "G"=>60, "B"=>60)); 
	/* La gráfica */
	$myPicture->setGraphArea(120, 20, 950, 460); 
	
	/* Título de la medición. Para fines de graficación. */
	switch($medida) {
		case 'consumo' : 
			$cmedida = 'reg_consum';
			$med_name = 'Consumo';
			switch($area) {
				/* Este condicional se aprovecha para etiquetas y color de barras de gráfica */
				case 'electricidad' :
					$med_title = 'Consumo (kwh)';
					$MyData->setPalette($med_name, array("R"=>203, "G"=>113, "B"=>23));
					break;
				case 'agua' :
					$med_title = 'Consumo (m3)';
					$MyData->setPalette($med_name, array("R"=>4,"G"=>137,"B"=>177,"Alpha"=>100));
					break;
			}
			break;
		case 'costo' :
			$cmedida = 'reg_cost';
			$med_name = 'Costo';
			$med_title = 'Costo ($)';
			break;
	}
	
	/* 
	Obtiene el total de cada año y llena el arreglo con los valores
	depende del área recibida utiliza una función.
	*/	
	$years = anios($actual); /* Los años que se tomarán en cuenta */
	$area_data = is_area($actual, $area);
	/* Se calculan los totales de cada año */
	foreach($years as $year) { $total[] = total_anio($actual, $area_data->area_id, $cmedida, $year, $site); }
	/* Eje Y */
	$MyData->addPoints($total, $med_name);
	$MyData->setAxisName(0, $med_title); 
	$real = array_total($total);	
	/*  Eje X */
	$MyData->addPoints($years, "Año"); 
	$MyData->setAbscissa("Año"); 
	$MyData->setAbscissaName("Año"); 
	
	/* La escala */
	$scale["CycleBackground"] = TRUE;
	$scale["DrawSubTicks"] = TRUE;
	$scale["GridR"] = 120;
	$scale["GridB"] = 120;
	$scale["GridG"] = 120;		
	$scale["Pos"] = SCALE_POS_LEFTRIGHT;
	$myPicture->drawScale($scale);
	
	if($real) {
		/* Creación de la gráfica */
		$settings["DisplayPos"] = LABEL_POS_TOP;
		$settings["DisplayValues"] = TRUE;
		$settings["DisplayOffset"] = 5;		
		$myPicture->drawBarChart($settings);
	} 
	else {
		/* La gráfica */
		$myPicture->setGraphArea(120, 20, 950, 460);
		$TextSettings = array("R"=>51, "G"=>51, "B"=>51,"FontSize"=>16); 
		$myPicture->drawText(240,220,"No hay información para graficar.",$TextSettings); 			
	}
	/* Se genera el nombre del archivo y la imagen */
	$file_name = 'BarrasAnual';
	$file_name .= '_'.$area;
	$file_name .= '_'.$medida;
	if(trim($site)!='') $file_name .= '_'.$site;
	$file_name .= '.png';
	$myPicture->render('graficas/'.$file_name);
}
/* Gráfica de barras para todos los años */
function barras_anual_zona($actual, $area, $medida, $zone='') {
	/* Título de la medición. Para fines de graficación. */
	switch($medida) {
		case 'consumo' : 
			$cmedida = 'reg_consum';
			$med_name = 'Consumo';
			switch($area) {
				case 'electricidad' :
					$med_title = 'Consumo (kwh)';
					break;
				case 'agua' :
					$med_title = 'Consumo (m3)';
					break;
			}
			break;
		case 'costo' :
			$cmedida = 'reg_cost';
			$med_name = 'Costo';
			$med_title = 'Costo ($)';
			break;
	}

	$MyData = new pData();
	/* 
		Obtiene el total de cada año y llena el arreglo con los valores
		depende del área recibida utiliza una función.
	*/
	$years = anios($actual);
	$area_data = is_area($actual, $area);
	foreach($years as $year) { $total[] = total_anio_zona($actual, $area_data->area_id, $cmedida, $year, $zone); }
	$MyData->addPoints($total, $med_name);
	$MyData->setAxisName(0, $med_title); 
	$real = array_total($total);
	/*
	switch($area) {
		case 'electricidad' :
			foreach($years as $year) { $total[] = total_anio_zona($actual, 'ctrl_reg_electro', $cmedida, $year, $zone); }
			$MyData->addPoints($total, $med_name);
			$MyData->setAxisName(0, $med_title); 
			$real = array_total($total);
			break;
		case 'agua' :
			foreach($years as $year) { $total[] = total_anio_zona($actual, 'ctrl_reg_water', $cmedida, $year, $zone); }
			$MyData->addPoints($total, $med_name);
			$MyData->setAxisName(0, $med_title); 
			$real = array_total($total);
			break;
	}
	*/
	
	if($real) {
		$MyData->addPoints($years, "Año"); 
		$MyData->setAbscissa("Año"); 
		$MyData->setAbscissaName("Año"); 
		/* Create the pChart object */ 
		$myPicture = new pImage(840,450,$MyData); 
		$myPicture->drawGradientArea(0,0,840,450,DIRECTION_VERTICAL,array("StartR"=>240,"StartG"=>240,"StartB"=>240,"EndR"=>180,"EndG"=>180,"EndB"=>180,"Alpha"=>100)); 
		$myPicture->drawGradientArea(0,0,840,450,DIRECTION_HORIZONTAL,array("StartR"=>240,"StartG"=>240,"StartB"=>240,"EndR"=>180,"EndG"=>180,"EndB"=>180,"Alpha"=>20)); 
		$myPicture->setFontProperties(array("FontName"=>"fonts/pf_arma_five.ttf","FontSize"=>7)); 
		/* Draw the chart scale */  
		$myPicture->setGraphArea(100,30,820,400); 
		$myPicture->drawScale(array("CycleBackground"=>TRUE,"DrawSubTicks"=>TRUE,"GridR"=>0,"GridG"=>0,"GridB"=>0,"GridAlpha"=>10,"Pos"=>SCALE_POS_LEFTRIGHT));
		/* Turn on shadow computing */  
		$myPicture->setShadow(TRUE,array("X"=>1,"Y"=>1,"R"=>0,"G"=>0,"B"=>0,"Alpha"=>10));
		$MyData->setPalette($med_name, array("R"=>4,"G"=>137,"B"=>177,"Alpha"=>100));
		/* Draw the chart */
		$myPicture->drawBarChart(array("DisplayPos"=>LABEL_POS_TOP,"DisplayValues"=>TRUE,"Rounded"=>TRUE,"Surrounding"=>30)); 		
	} // if
	else {
		$myPicture = new pImage(840,450); 
		$myPicture->drawGradientArea(0,0,840,450,DIRECTION_VERTICAL,array("StartR"=>240,"StartG"=>240,"StartB"=>240,"EndR"=>180,"EndG"=>180,"EndB"=>180,"Alpha"=>100)); 
		$myPicture->drawGradientArea(0,0,840,450,DIRECTION_HORIZONTAL,array("StartR"=>240,"StartG"=>240,"StartB"=>240,"EndR"=>180,"EndG"=>180,"EndB"=>180,"Alpha"=>20)); 
		$myPicture->setShadow(TRUE,array("X"=>1,"Y"=>1,"R"=>0,"G"=>0,"B"=>0,"Alpha"=>20)); 
		$myPicture->setFontProperties(array("FontName"=>"fonts/pf_arma_five.ttf","FontSize"=>7)); 
		
		$TextSettings = array("R"=>51,"G"=>51,"B"=>51,"FontSize"=>16); 
		$myPicture->drawText(40,200,"No hay información para graficar.",$TextSettings); 			
	}
	$file_name = 'BarrasAnualZona';
	$file_name .= '_'.$area;
	$file_name .= '_'.$medida;
	if(trim($zone)!='') $file_name .= '_'.$zone;
	$file_name .= '.png';
	$myPicture->render('graficas/'.$file_name);
}

/* Gráfica de barras para mayores consumidores */
function barras_major($actual, $area, $anio='') {		
	$MyData = new pData();
	/* 
		Obtiene el total de cada año y llena el arreglo con los valores
		depende del área recibida utiliza una función.
	*/	
	$major_raw = major_consumers($actual, $area, $anio);
	if($major_raw) {
		$major_sites = major_sites($actual, $major_raw);
		$major_consum = major_consum($major_raw);
	}
	
	switch($area) {
		case 'electricidad' :
			$consumo = 'Consumo (kwh)';
			break;
		case 'agua' :
			$consumo = 'Consumo (m3)';
			break;
	}
	
	if($major_raw) {
	
		$MyData->addPoints($major_consum, 'Consumo');				
		$MyData->setAxisName(0, $consumo);
		
		$MyData->addPoints($major_sites, "Dependencias"); 
		$MyData->setAbscissa("Dependencias"); 
		// $MyData->setAbscissaName("Dependencias"); 

		/* Create the pChart object */ 
		$myPicture = new pImage(840,450,$MyData); 
		$myPicture->drawGradientArea(0,0,840,500,DIRECTION_VERTICAL,array("StartR"=>240,"StartG"=>240,"StartB"=>240,"EndR"=>180,"EndG"=>180,"EndB"=>180,"Alpha"=>100)); 
		$myPicture->drawGradientArea(0,0,840,500,DIRECTION_HORIZONTAL,array("StartR"=>240,"StartG"=>240,"StartB"=>240,"EndR"=>180,"EndG"=>180,"EndB"=>180,"Alpha"=>20)); 
		$myPicture->setFontProperties(array("FontName"=>"fonts/pf_arma_five.ttf","FontSize"=>7)); 
		/* Draw the chart scale */  
		$myPicture->setGraphArea(100,30,820,300); 
		$myPicture->drawScale(array("CycleBackground"=>TRUE,"DrawSubTicks"=>TRUE,"GridR"=>0,"GridG"=>0,"GridB"=>0,"GridAlpha"=>10,"Pos"=>SCALE_POS_LEFTRIGHT, "LabelRotation"=>35));
		/* Turn on shadow computing */  
		$myPicture->setShadow(TRUE,array("X"=>1,"Y"=>1,"R"=>0,"G"=>0,"B"=>0,"Alpha"=>10)); 				
		$MyData->setPalette('Consumo', array("R"=>86,"G"=>45,"B"=>124,"Alpha"=>100));
		/* Draw the chart */
		$myPicture->drawBarChart(array("DisplayPos"=>LABEL_POS_TOP,"DisplayValues"=>TRUE,"Rounded"=>TRUE,"Surrounding"=>30)); 		
	} // if
	else {
		$myPicture = new pImage(840,450); 
		$myPicture->drawGradientArea(0,0,840,450,DIRECTION_VERTICAL,array("StartR"=>240,"StartG"=>240,"StartB"=>240,"EndR"=>180,"EndG"=>180,"EndB"=>180,"Alpha"=>100)); 
		$myPicture->drawGradientArea(0,0,840,450,DIRECTION_HORIZONTAL,array("StartR"=>240,"StartG"=>240,"StartB"=>240,"EndR"=>180,"EndG"=>180,"EndB"=>180,"Alpha"=>20)); 
		$myPicture->setShadow(TRUE,array("X"=>1,"Y"=>1,"R"=>0,"G"=>0,"B"=>0,"Alpha"=>20)); 
		$myPicture->setFontProperties(array("FontName"=>"fonts/pf_arma_five.ttf","FontSize"=>7)); 
		
		$TextSettings = array("R"=>51,"G"=>51,"B"=>51,"FontSize"=>16); 
		$myPicture->drawText(40,200,"No hay información para graficar.",$TextSettings); 			
	}
	$file_name = 'BarrasMayores';
	$file_name .= '_'.$area;
	if(trim($anio)!='') $file_name .= '_'.$anio;
	$file_name .= '.png';
	$myPicture->render('graficas/'.$file_name);
}

/* Gráfica de pastel de mayores consumidores */
function pastel_major($actual, $area, $anio='') {
	/* Create and populate the pData object */
	$MyData = new pData();
	$major_raw	= major_consumers($actual, $area, $anio);

	if($major_raw) {
		$major_sites	= major_sites($actual, $major_raw);
		$major_consum 	= major_consum($major_raw);
		
		$MyData->addPoints($major_consum,"Consumo");  
		$MyData->setSerieDescription("ScoreA","Application A");

		/* Define the absissa serie */			
		$MyData->addPoints($major_sites,"Dependencia");
		$MyData->setAbscissa("Dependencia");

		/* Create the pChart object */
		$myPicture = new pImage(840,450,$MyData,TRUE);

		/* Set the default font properties */ 
		$myPicture->setFontProperties(array("FontName"=>"fonts/Forgotte.ttf","FontSize"=>11,"R"=>51,"G"=>51,"B"=>51));
		
		/* Create the pPie object */			
		$myPicture->drawFilledRectangle(0,0,840,450,
			array("R"=>18, "G"=>49, "B"=>135, "Dash"=>1, "DashR"=>38, "DashG"=>69, "DashB"=>155));			
		$myPicture->drawGradientArea(0,0,840,450,DIRECTION_VERTICAL,
			array("StartR"=>53, "StartG"=>112, "StartB"=>231, "EndR"=>23, "EndG"=>50, "EndB"=>138, "Alpha"=>50));
		
		$PieChart = new pPie($myPicture,$MyData);
		
		/* Colores de slices */
		$PieChart->setSliceColor(0,array("R"=>219,"G"=>169,"B"=>1));
		$PieChart->setSliceColor(1,array("R"=>29,"G"=>52,"B"=>113));
		$PieChart->setSliceColor(2,array("R"=>46,"G"=>151,"B"=>224));
		$PieChart->setSliceColor(3,array("R"=>224,"G"=>46,"B"=>117));
		$PieChart->setSliceColor(4,array("R"=>115,"G"=>40,"B"=>155));
		
		$PieChart->setSliceColor(5,array("R"=>213,"G"=>191,"B"=>67));
		
		$PieChart->setSliceColor(6,array("R"=>116,"G"=>184,"B"=>64));
		$PieChart->setSliceColor(7,array("R"=>211,"G"=>116,"B"=>20));
		$PieChart->setSliceColor(8,array("R"=>19,"G"=>128,"B"=>149));
		
		$PieChart->setSliceColor(9,array("R"=>54,"G"=>102,"B"=>28));
		$PieChart->setSliceColor(10,array("R"=>197,"G"=>50,"B"=>69));

		/* Enable shadow computing */ 
		$myPicture->setShadow(TRUE,array("X"=>3,"Y"=>3,"R"=>0,"G"=>0,"B"=>0,"Alpha"=>10));

		/* Draw a splitted pie chart */ 			
		$PieChart->draw2DPie(190,210,array("Radius"=>100,"Border"=>TRUE, "WriteValues"=>TRUE));

		/* Write the legend box */ 
		$myPicture->setFontProperties(array("FontName"=>"fonts/Forgotte.ttf","FontSize"=>11,"R"=>255,"G"=>255,"B"=>255));
		$PieChart->drawPieLegend(400,130,array("Style"=>LEGEND_NOBORDER,"Mode"=>LEGEND_VERTICAL, "BoxSize"=>12));

	} // if
	else {
		$myPicture = new pImage(840,450); 
		$myPicture->drawGradientArea(0,0,840,450,DIRECTION_VERTICAL,array("StartR"=>240,"StartG"=>240,"StartB"=>240,"EndR"=>180,"EndG"=>180,"EndB"=>180,"Alpha"=>100)); 
		$myPicture->drawGradientArea(0,0,840,450,DIRECTION_HORIZONTAL,array("StartR"=>240,"StartG"=>240,"StartB"=>240,"EndR"=>180,"EndG"=>180,"EndB"=>180,"Alpha"=>20)); 
		$myPicture->setShadow(TRUE,array("X"=>1,"Y"=>1,"R"=>0,"G"=>0,"B"=>0,"Alpha"=>20)); 
		$myPicture->setFontProperties(array("FontName"=>"fonts/pf_arma_five.ttf","FontSize"=>7)); 
		
		$TextSettings = array("R"=>51,"G"=>51,"B"=>51,"FontSize"=>16); 
		$myPicture->drawText(40,200,"No hay información para graficar.",$TextSettings); 			
	}
	$file_name = 'PastelMayores';
	$file_name .= '_'.$area;
	if(trim($anio)!='') $file_name .= '_'.$anio;	
	$file_name .= '.png';
	$myPicture->render('graficas/'.$file_name);
}

/* Líneas de tendencia */
function lineas_tendencia($actual, $area, $medida, $limit='', $site='') {
	
	/* Crear el objeto pData */
	$MyData = new pData(); 
	
	/* DATOS ELEMENTALES */
	// Límite de años que se graficarán	
	$anios = anios($actual, $limit);
	
	/* Título de la medición. Para fines de graficación. */
	switch($medida) {
		case 'consumo' : 
			$cmedida = 'reg_consum';
			$med_name = 'Consumo';
			switch($area) {
				case 'electricidad' :
					$med_title = 'Consumo (kwh)';
					break;
				case 'agua' :
					$med_title = 'Consumo (m3)';
					break;
			}
			break;
		case 'costo' :
			$cmedida = 'reg_cost';
			$med_name = 'Costo';
			$med_title = 'Costo ($)';
			break;
	}
	$area_data = is_area($actual, $area);
	foreach($anios as $anio) {				
		for($i = 1; $i < 13; $i++) {
			$total[] = total_mes($actual, $area_data->area_id, $cmedida, $anio, $i, $site); 
			/* Poblar el objeto, dependiendo del área */
			/*
			switch($area) {
				case 'electricidad' :
					$total[] = total_mes($actual, 'ctrl_reg_electro', $cmedida, $anio, $i, $site); 
					break;
				case 'agua' :
					$total[] = total_mes($actual, 'ctrl_reg_water', $cmedida, $anio, $i, $site); 
					break;
			}
			*/
			$MyData->addPoints($total, $anio);
			unset($total);
		}
	}
	
	if($anios) {
		$MyData->setAxisName(0,$med_title);
		$MyData->addPoints(array("Enero", 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre' , 'Diciembre'), "Labels"); 
		
		$MyData->setSerieDescription("Labels","Mes");
		$MyData->setAbscissa("Labels");

		/* Create the pChart object */
		$myPicture = new pImage(840,450,$MyData);
		$myPicture->drawGradientArea(0,0,840,500,DIRECTION_VERTICAL,array("StartR"=>240,"StartG"=>240,"StartB"=>240,"EndR"=>180,"EndG"=>180,"EndB"=>180,"Alpha"=>100)); 
		$myPicture->drawGradientArea(0,0,840,500,DIRECTION_HORIZONTAL,array("StartR"=>240,"StartG"=>240,"StartB"=>240,"EndR"=>180,"EndG"=>180,"EndB"=>180,"Alpha"=>20)); 

		/* Turn of Antialiasing */
		$myPicture->Antialias = TRUE;
		/* Set the default font */
		$myPicture->setFontProperties(array("FontName"=>"fonts/pf_arma_five.ttf","FontSize"=>6));
		/* Define the chart area */
		$myPicture->setGraphArea(50,20,820,370);
		/* Draw the scale */
		$scaleSettings = array("XMargin"=>10,"YMargin"=>10,"Floating"=>TRUE,"GridR"=>200,"GridG"=>200,"GridB"=>200,"DrawSubTicks"=>TRUE,"CycleBackground"=>TRUE);
		$myPicture->drawScale($scaleSettings);
		/* Turn on Antialiasing */
		$myPicture->Antialias = TRUE;
		/* Draw the line chart */
		$myPicture->drawSplineChart(array("DisplayValues"=>TRUE,"DisplayColor"=>DISPLAY_AUTO));
		/* Write the chart legend */
		$myPicture->drawLegend(70,10,array("Style"=>LEGEND_NOBORDER,"Mode"=>LEGEND_HORIZONTAL, 'BoxSize'=>12));

	} // if
	else {
		$myPicture = new pImage(840,450); 
		$myPicture->drawGradientArea(0,0,840,450,DIRECTION_VERTICAL,array("StartR"=>240,"StartG"=>240,"StartB"=>240,"EndR"=>180,"EndG"=>180,"EndB"=>180,"Alpha"=>100)); 
		$myPicture->drawGradientArea(0,0,840,450,DIRECTION_HORIZONTAL,array("StartR"=>240,"StartG"=>240,"StartB"=>240,"EndR"=>180,"EndG"=>180,"EndB"=>180,"Alpha"=>20)); 
		$myPicture->setShadow(TRUE,array("X"=>1,"Y"=>1,"R"=>0,"G"=>0,"B"=>0,"Alpha"=>20)); 
		$myPicture->setFontProperties(array("FontName"=>"fonts/pf_arma_five.ttf","FontSize"=>7)); 
		
		$TextSettings = array("R"=>51,"G"=>51,"B"=>51,"FontSize"=>16); 
		$myPicture->drawText(40,200,"No hay información para graficar.",$TextSettings);			
	}
	$file_name = 'LineasTendencia';
	$file_name .= '_'.$area;
	$file_name .= '_'.$medida;
	if(trim($site)!='') $file_name .= '_'.$site;
	if(trim($limit)!='') $file_name .= '_'.$limit;
	$file_name .= '.png';
	$myPicture->render('graficas/'.$file_name);
}


