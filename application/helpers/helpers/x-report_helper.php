<?php if (!defined('BASEPATH')) exit('Prohibido el acceso');
//secure your snippet from external access

/* Funciones para la generación de reportes */

/* Reporte HISTÓRICO */
function reporte_anual($actual, $site, $areas, $medidas) {	
	// Conteo de totales
	$years = anios($actual);	
	foreach($years as $year) {		
		$full_table[] = array(
			'anio' 		=> $year, 
			'electro_consum'=> total_anio($actual, 1, 'reg_consum', $year, $site),
			'electro_cost' 	=> '$'.total_anio($actual, 1, 'reg_cost', $year, $site),
			'water_consum' 	=> total_anio($actual, 2, 'reg_consum', $year, $site),
			'water_cost' 	=> '$'.total_anio($actual, 2, 'reg_cost', $year, $site)
		);	
	}
	// Nombre del sitio
	if(trim($site) == '') {
		$site_file = 'Universidad Autónoma de Nuevo León';
		$site_pdf = 'Universidad Autónoma de Nuevo León';
	}
	else {
		$site_data = $actual->modelo_controlp->medidor_data($site);
		$site_file = ($site_data->med_name).'';
		$site_pdf = utf8_decode($site_file);
	}
	
	// Configuración general
	$actual->cezpdf->selectFont('./fonts/Times-Roman.afm');
	$actual->cezpdf->ezText('Secretaría de Desarrollo Sustentable', 16);	
	$actual->cezpdf->ezText('Consumos y gastos históricos.', 15);
	$y = $actual->cezpdf->ezText($site_pdf, 15);
	$actual->cezpdf->line(30, $y-15, 550, $y-15);
	$actual->cezpdf->ezSetDy(-25);
	
	/* Tabla */
	$header = array(
		'anio' => 'Año',
		'electro_consum'=> 'Consumo de electricidad',
		'electro_cost' 	=> 'Consumo de electricidad',
		'water_consum' 	=> 'Consumo de electricidad',
		'water_cost' 	=> 'Consumo de electricidad'	
	);
	$config = array('fontSize' => 11);
	$actual->cezpdf->ezTable($full_table, $header, 'Tabla de totales', $config);
	
	/* Imágenes */
	$actual->cezpdf->ezNewPage();
	$actual->cezpdf->ezText('Gráficas', 14);
	$actual->cezpdf->ezSetDy(-10);
	foreach($areas as $area)
		foreach($medidas as $medida) {
			$actual->cezpdf->ezText(ucfirst($medida.' de '.$area->area_path), 12);
			$actual->cezpdf->ezSetDy(-15);
			$img_name = 'BarrasAnual';
			$img_name .= '_'.$area->area_path;
			$img_name .= '_'.$medida;
			if(trim($site)!='') $img_name .= '_'.$site;
			$img_name .= '.png';			
			@$actual->cezpdf->ezImage('./graficas/'.$img_name, 5, 500, 'none', 'left');
			$actual->cezpdf->ezSetDy(-15);
		}
	
	// Guarda archivo	
	$content = $actual->cezpdf->ezOutput();
	/* Normalización del nombre */
	$site_file = str_replace(' ', '', $site_pdf);
	$search = explode(",","ç,æ,œ,á,é,í,ó,ú,à,è,ì,ò,ù,ä,ë,ï,ö,ü,ÿ,â,ê,î,ô,û,å,e,i,ø,u");
	$replace = explode(",","c,ae,oe,a,e,i,o,u,a,e,i,o,u,a,e,i,o,u,y,a,e,i,o,u,a,e,i,o,u");
	$site_file = str_replace($search, $replace, $site_file);
	
	$file_name = 'Reporte_Historico_'.$site_file.'.pdf';
	$fp = @fopen('./reportes/'.$file_name, 'w');
	@fwrite($fp, $content);
	@fclose($fp);
	// Devuelve nombre de archivo generado
	return $file_name;
}
/* Reporte HISTÓRICO, zona */
function reporte_anual_zona($actual, $zone, $areas, $medidas) {	
	// Conteo de totales
	$years = anios($actual);	
	foreach($years as $year) {		
		$full_table[] = array(
			'anio' 		=> $year, 
			'electro_consum'=> total_anio_zona($actual, 1, 'reg_consum', $year, $zone),
			'electro_cost' 	=> '$'.total_anio_zona($actual, 1, 'reg_cost', $year, $zone),
			'water_consum' 	=> total_anio_zona($actual, 2, 'reg_consum', $year, $zone),
			'water_cost' 	=> '$'.total_anio_zona($actual, 2, 'reg_cost', $year, $zone)
		);	
	}
	// Nombre del sitio	
	$zone_data = $actual->modelo_controlp->zona_data($zone);
	$zone_file = ($zone_data->zona_name).'';
	$zone_pdf = utf8_decode($zone_file);
	
	// Configuración general
	$actual->cezpdf->selectFont('./fonts/Times-Roman.afm');
	$actual->cezpdf->ezText('Secretaría de Desarrollo Sustentable', 16);	
	$actual->cezpdf->ezText('Consumos y gastos históricos.', 15);
	$y = $actual->cezpdf->ezText($zone_pdf, 15);
	$actual->cezpdf->line(30, $y-15, 550, $y-15);
	$actual->cezpdf->ezSetDy(-25);
	
	/* Tabla */
	$header = array(
		'anio' 		=> 'Año',
		'electro_consum'=> 'Consumo de electricidad',
		'electro_cost' 	=> 'Consumo de electricidad',
		'water_consum' 	=> 'Consumo de electricidad',
		'water_cost' 	=> 'Consumo de electricidad'	
	);
	$config = array('fontSize' => 11);
	$actual->cezpdf->ezTable($full_table, $header, 'Tabla de totales', $config);
	
	/* Imágenes */
	$actual->cezpdf->ezNewPage();
	$actual->cezpdf->ezText('Gráficas', 14);
	$actual->cezpdf->ezSetDy(-10);
	foreach($areas as $area)
		foreach($medidas as $medida) {
			$actual->cezpdf->ezText(ucfirst($medida.' de '.$area->area_path), 12);
			$actual->cezpdf->ezSetDy(-15);
			$img_name = 'BarrasAnualZona';
			$img_name .= '_'.$area->area_path;
			$img_name .= '_'.$medida;
			if(trim($zone)!='') $img_name .= '_'.$zone;
			$img_name .= '.png';			
			@$actual->cezpdf->ezImage('./graficas/'.$img_name, 5, 500, 'none', 'left');
			$actual->cezpdf->ezSetDy(-15);
		}
	
	// Guarda archivo	
	$content = $actual->cezpdf->ezOutput();
	/* Normalización del nombre */
	$zone_file = str_replace(' ', '', $zone_pdf);
	$search = explode(",","ç,æ,œ,á,é,í,ó,ú,à,è,ì,ò,ù,ä,ë,ï,ö,ü,ÿ,â,ê,î,ô,û,å,e,i,ø,u");
	$replace = explode(",","c,ae,oe,a,e,i,o,u,a,e,i,o,u,a,e,i,o,u,y,a,e,i,o,u,a,e,i,o,u");
	$zone_file = str_replace($search, $replace, $zone_file);
	
	$file_name = 'Reporte_Historico_'.$zone_file.'.pdf';
	$fp = fopen('./reportes/'.$file_name, 'w');
	fwrite($fp, $content);
	fclose($fp);
	// Devuelve nombre de archivo generado
	return $file_name;
}

/* Reporte ANUAL */
function reporte_mensual($actual, $site, $areas, $medidas, $year) {	
	// Meses
	$meses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', ' Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
	// Conteo de totales	
	for($mes=1; $mes<13; $mes++) {		
		$full_table[] = array(
			'mes' 	=>	$meses[$mes-1], 
			'electro_consum' 	=>	total_mes($actual, 1, 'reg_consum', $year, $mes, $site),
			'electro_cost' 		=>	'$'.total_mes($actual, 1, 'reg_cost', $year, $mes, $site),
			'water_consum' 		=>	total_mes($actual, 2, 'reg_consum', $year, $mes, $site),
			'water_cost' 			=>	'$'.total_mes($actual, 2, 'reg_cost', $year, $mes, $site)
		);	
	}
	// Nombre del sitio
	if(trim($site) == '') {
		$site_file = 'Universidad Autónoma de Nuevo León';
		$site_pdf = 'Universidad Autónoma de Nuevo León';
	}
	else {
		$site_data = $actual->modelo_controlp->medidor_data($site);
		$site_file = ($site_data->med_name).'';
		$site_pdf = utf8_decode($site_file);
	}
	
	// Configuración general
	$actual->cezpdf->selectFont('./fonts/Times-Roman.afm');
	$actual->cezpdf->ezText('Secretaría de Desarrollo Sustentable', 16);	
	$actual->cezpdf->ezText('Consumos y gastos '.$year.'.', 15);
	$y = $actual->cezpdf->ezText($site_pdf, 15);
	$actual->cezpdf->line(30, $y-15, 550, $y-15);
	$actual->cezpdf->ezSetDy(-25);
	
	/* Tabla */
	$header = array(
		'mes' => 'Mes',
		'electro_consum' => 'Consumo de electricidad' ,
		'electro_cost' => 'Consumo de electricidad' ,
		'water_consum' => 'Consumo de electricidad' ,
		'water_cost' => 'Consumo de electricidad'		
	);
	$config = array('fontSize' => 11);
	$actual->cezpdf->ezTable($full_table, $header, 'Tabla de totales', $config);
	
	/* Imágenes */
	$actual->cezpdf->ezNewPage();
	$actual->cezpdf->ezText('Gráficas', 14);
	$actual->cezpdf->ezSetDy(-10);
	foreach($areas as $area)
		foreach($medidas as $medida) {
			$actual->cezpdf->ezText(ucfirst($medida.' de '.$area->area_path), 12);
			$actual->cezpdf->ezSetDy(-15);
			$img_name = 'BarrasMensual';
			$img_name .= '_'.$area->area_path;
			$img_name .= '_'.$medida;
			$img_name .= '_'.$year;
			if(trim($site)!='') $img_name .= '_'.$site;
			$img_name .= '.png';			
			@$actual->cezpdf->ezImage('./graficas/'.$img_name, 5, 500, 'none', 'left');
			$actual->cezpdf->ezSetDy(-15);
		}
	
	// Guarda archivo	
	$content = $actual->cezpdf->ezOutput();
	/* Normalización del nombre */
	$site_file = str_replace(' ', '', $site_pdf);
	$search = explode(",","ç,æ,œ,á,é,í,ó,ú,à,è,ì,ò,ù,ä,ë,ï,ö,ü,ÿ,â,ê,î,ô,û,å,e,i,ø,u");
	$replace = explode(",","c,ae,oe,a,e,i,o,u,a,e,i,o,u,a,e,i,o,u,y,a,e,i,o,u,a,e,i,o,u");
	$site_file = str_replace($search, $replace, $site_file);
	
	$file_name = 'Reporte_Anual_'.$year.'_'.$site_file.'.pdf';
	$fp = fopen('./reportes/'.$file_name, 'w');
	fwrite($fp, $content);
	fclose($fp);
	// Devuelve nombre de archivo generado
	return $file_name;
}
/* Reporte ANUAL, zona */
function reporte_mensual_zona($actual, $zone, $areas, $medidas, $year) {	
	// Meses
	$meses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', ' Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
	// Conteo de totales	
	for($mes=1; $mes<13; $mes++) {		
		$full_table[] = array(
			'mes' 	=>	$meses[$mes-1], 
			'electro_consum' 	=>	total_mes_zona($actual, 1, 'reg_consum', $year, $mes, $zone),
			'electro_cost' 		=>	'$'.total_mes_zona($actual, 1, 'reg_cost', $year, $mes, $zone),
			'water_consum' 		=>	total_mes_zona($actual, 2, 'reg_consum', $year, $mes, $zone),
			'water_cost' 			=>	'$'.total_mes_zona($actual, 2, 'reg_cost', $year, $mes, $zone)
		);	
	}
	// Nombre del sitio	
	$zone_data = $actual->modelo_controlp->zona_data($zone);
	$zone_file = ($zone_data->zona_name).'';
	$zone_pdf = utf8_decode($zone_file);
	
	// Configuración general
	$actual->cezpdf->selectFont('./fonts/Times-Roman.afm');
	$actual->cezpdf->ezText('Secretaría de Desarrollo Sustentable', 16);	
	$actual->cezpdf->ezText('Consumos y gastos '.$year.'.', 15);
	$y = $actual->cezpdf->ezText($zone_pdf, 15);
	$actual->cezpdf->line(30, $y-15, 550, $y-15);
	$actual->cezpdf->ezSetDy(-25);
	
	/* Tabla */
	$header = array(
		'mes' => 'Mes',
		'electro_consum' => 'Consumo de electricidad' ,
		'electro_cost' => 'Consumo de electricidad' ,
		'water_consum' => 'Consumo de electricidad' ,
		'water_cost' => 'Consumo de electricidad'		
	);
	$config = array('fontSize' => 11);
	$actual->cezpdf->ezTable($full_table, $header, 'Tabla de totales', $config);
	
	/* Imágenes */
	$actual->cezpdf->ezNewPage();
	$actual->cezpdf->ezText('Gráficas', 14);
	$actual->cezpdf->ezSetDy(-10);
	foreach($areas as $area)
		foreach($medidas as $medida) {
			$actual->cezpdf->ezText(ucfirst($medida.' de '.$area->area_path), 12);
			$actual->cezpdf->ezSetDy(-15);
			$img_name = 'BarrasMensualZona';
			$img_name .= '_'.$area->area_path;
			$img_name .= '_'.$medida;
			$img_name .= '_'.$year;
			if(trim($zone)!='') $img_name .= '_'.$zone;
			$img_name .= '.png';			
			@$actual->cezpdf->ezImage('./graficas/'.$img_name, 5, 500, 'none', 'left');
			$actual->cezpdf->ezSetDy(-15);
		}
	
	// Guarda archivo	
	$content = $actual->cezpdf->ezOutput();
	/* Normalización del nombre */
	$zone_file = str_replace(' ', '', $zone_pdf);
	$search = explode(",","ç,æ,œ,á,é,í,ó,ú,à,è,ì,ò,ù,ä,ë,ï,ö,ü,ÿ,â,ê,î,ô,û,å,e,i,ø,u");
	$replace = explode(",","c,ae,oe,a,e,i,o,u,a,e,i,o,u,a,e,i,o,u,y,a,e,i,o,u,a,e,i,o,u");
	$zone_file = str_replace($search, $replace, $zone_file);
	
	$file_name = 'Reporte_Anual_'.$year.'_'.$zone_file.'.pdf';
	$fp = fopen('./reportes/'.$file_name, 'w');
	fwrite($fp, $content);
	fclose($fp);
	// Devuelve nombre de archivo generado
	return $file_name;
}

/* Reporte de MAYORES CONSUMIDORES */
function mayores_consumidores($actual, $year) {
	// Áreas
	$areas = array('agua', 'electricidad');
	// Arreglos asociativos ordenados
	foreach($areas as $area) { $arreglo_original[$area] = major_consumers($actual, $area, $year); }
	
	// Configuración general
	$actual->cezpdf->selectFont('./fonts/Times-Roman.afm');
	$actual->cezpdf->ezText('Secretaría de Desarrollo Sustentable', 16);	
	$actual->cezpdf->ezText('Dependencias de mayor consumo.', 15);
	if($year=='') $y = $actual->cezpdf->ezText('Reporte Histórico.', 15);
	else $y = $actual->cezpdf->ezText('Reporte del año '.$year.'.', 15);
	
	$actual->cezpdf->line(30, $y-15, 550, $y-15);
	$actual->cezpdf->ezSetDy(-25);
	/* Tabla */	
	$header = array(
		0 => 'Dependencia',
		1 => 'Consumo'
	);
	$config = array('fontSize' => 11);	
	foreach($arreglo_original as $area => $arreglo) {
		if($arreglo) {
			foreach($arreglo as $key => $value) {
				// Nombre de la dependencia
				if($key != 'otros') {
					$site_data = $actual->modelo_controlp->medidor_data($key);
					$site_file = ($site_data->med_name).'';
					$site_name = utf8_decode($site_file);
				} else $site_name = 'Otros';
				$nu_arreglo[] = array($site_name, $value);
			}
			$actual->cezpdf->ezTable($nu_arreglo, $header, 'Consumo de '.$area);
			$actual->cezpdf->ezSetDy(-15);
			unset($nu_arreglo);
		} // if		
	}
	
	/* Imágenes */
	$actual->cezpdf->ezNewPage();
	$actual->cezpdf->ezText('Gráficas', 14);
	$actual->cezpdf->ezSetDy(-10);
	foreach($areas as $area) {
		$actual->cezpdf->ezSetDy(-15);
		$img_name = 'BarrasMayores';
		$img_name .= '_'.$area;		
		if(trim($year)!='') $img_name .= '_'.$year;
		$img_name .= '.png';			
		@$actual->cezpdf->ezImage('./graficas/'.$img_name, 5, 500, 'none', 'left');
		$actual->cezpdf->ezSetDy(-15);
	}
	
	// Guarda archivo	
	$content = $actual->cezpdf->ezOutput();
	
	$file_name = 'Mayores_consumidores_'.$year.'.pdf';
	$fp = fopen('./reportes/'.$file_name, 'w');
	fwrite($fp, $content);
	fclose($fp);
	// Devuelve nombre de archivo generado
	return $file_name;
}

/* Reporte de PORCENTAJES DE CONSUMO */
function mayores_porcentajes($actual, $year) {
	// Áreas
	$areas = array('agua', 'electricidad');
	
	// Arreglos asociativos ordenados
	foreach($areas as $area) { $arreglo_original[$area] = major_consumers($actual, $area, $year); }
	
	// Configuración general
	$actual->cezpdf->selectFont('./fonts/Times-Roman.afm');
	$actual->cezpdf->ezText('Secretaría de Desarrollo Sustentable', 16);
	$actual->cezpdf->ezText('Porcentajes de consumo por dependencia.', 15);
	if($year=='') $y = $actual->cezpdf->ezText('Reporte Histórico.', 15);
	else $y = $actual->cezpdf->ezText('Reporte del año '.$year.'.', 15);
	
	$actual->cezpdf->line(30, $y-15, 550, $y-15);
	$actual->cezpdf->ezSetDy(-25);
	
	// Tabla
	$header = array(
		0 => 'Dependencia',
		1 => 'Porcentaje'
	);
	$config = array('fontSize' => 11);	
	foreach($arreglo_original as $area => $arreglo) {
		if($arreglo) {
			foreach($arreglo as $key => $value) {
				// Nombre de la dependencia
				if($key != 'otros') {
					$site_data = $actual->modelo_controlp->medidor_data($key);
					$site_file = ($site_data->med_name).'';
					$site_name = utf8_decode($site_file);
				} else $site_name = 'Otros';
				$nu_arreglo[] = array($site_name, $value);
			}
			$actual->cezpdf->ezTable($nu_arreglo, $header, 'Consumo de '.$area);
			$actual->cezpdf->ezSetDy(-15);
			unset($nu_arreglo);
		} // if
	}
	
	// Imágenes
	$actual->cezpdf->ezNewPage();
	$actual->cezpdf->ezText('Gráficas', 14);
	$actual->cezpdf->ezSetDy(-10);
	foreach($areas as $area) {
		$actual->cezpdf->ezSetDy(-15);
		$img_name = 'PastelMayores';
		$img_name .= '_'.$area;		
		if(trim($year)!='') $img_name .= '_'.$year;
		$img_name .= '.png';			
		@$actual->cezpdf->ezImage('./graficas/'.$img_name, 5, 500, 'none', 'left');
		$actual->cezpdf->ezSetDy(-15);
	}
	
	// Guarda archivo	
	$content = $actual->cezpdf->ezOutput();
	
	$file_name = 'Porcentajes_dependencias_'.$year.'.pdf';
	$fp = fopen('./reportes/'.$file_name, 'w');
	fwrite($fp, $content);
	fclose($fp);
	// Devuelve nombre de archivo generado
	return $file_name;
}

/* Reporte de TENDENCIA ANUAL */
function tendencia_anual($actual, $site, $areas, $medidas, $limit) {
	// Conteo de totales
	$years = anios($actual);	
	foreach($years as $year) {		
		$full_table[] = array(
			'anio' 	=>	$year, 
			'electro_consum' 	=>	total_anio($actual, 1, 'reg_consum', $year, $site),
			'electro_cost' 		=>	'$'.total_anio($actual, 1, 'reg_cost', $year, $site),
			'water_consum' 		=>	total_anio($actual, 2, 'reg_consum', $year, $site),
			'water_cost' 			=>	'$'.total_anio($actual, 2, 'reg_cost', $year, $site)
		);	
	}
	// Nombre del sitio
	if(trim($site) == '') {
		$site_file = 'Universidad Autónoma de Nuevo León';
		$site_pdf = 'Universidad Autónoma de Nuevo León';
	}
	else {
		$site_data = $actual->modelo_controlp->medidor_data($site);
		$site_file = ($site_data->med_name).'';
		$site_pdf = utf8_decode($site_file);
	}
	
	// Configuración general
	$actual->cezpdf->selectFont('./fonts/Times-Roman.afm');
	$actual->cezpdf->ezText('Secretaría de Desarrollo Sustentable', 16);	
	$actual->cezpdf->ezText('Consumos y gastos históricos.', 15);
	$y = $actual->cezpdf->ezText($site_pdf, 15);
	$actual->cezpdf->line(30, $y-15, 550, $y-15);
	$actual->cezpdf->ezSetDy(-25);
	
	/* Tabla */
	$header = array(
		'anio' => 'Año',
		'electro_consum' => 'Consumo de electricidad' ,
		'electro_cost' => 'Consumo de electricidad' ,
		'water_consum' => 'Consumo de electricidad' ,
		'water_cost' => 'Consumo de electricidad'		
	);
	$config = array('fontSize' => 11);
	$actual->cezpdf->ezTable($full_table, $header, 'Tabla de totales', $config);
	
	/* Imágenes */
	$actual->cezpdf->ezNewPage();
	$actual->cezpdf->ezText('Gráficas', 14);
	$actual->cezpdf->ezSetDy(-10);
	foreach($areas as $area)
		foreach($medidas as $medida) {
			$actual->cezpdf->ezText(ucfirst($medida.' de '.$area->area_path), 12);
			$actual->cezpdf->ezSetDy(-15);
			$img_name = 'LineasTendencia';
			$img_name .= '_'.$area->area_path;
			$img_name .= '_'.$medida;
			if(trim($limit)!='') $img_name .= '_'.$limit;
			if(trim($site)!='') $img_name .= '_'.$site;
			$img_name .= '.png';			
			@$actual->cezpdf->ezImage('./graficas/'.$img_name, 5, 500, 'none', 'left');
			$actual->cezpdf->ezSetDy(-15);
		}
	
	// Guarda archivo	
	$content = $actual->cezpdf->ezOutput();
	/* Normalización del nombre */
	$site_file = str_replace(' ', '', $site_pdf);
	$search = explode(",","ç,æ,œ,á,é,í,ó,ú,à,è,ì,ò,ù,ä,ë,ï,ö,ü,ÿ,â,ê,î,ô,û,å,e,i,ø,u");
	$replace = explode(",","c,ae,oe,a,e,i,o,u,a,e,i,o,u,a,e,i,o,u,y,a,e,i,o,u,a,e,i,o,u");
	$site_file = str_replace($search, $replace, $site_file);
	
	$file_name = 'Tendencia_Historica_'.$site_file.'.pdf';
	$fp = fopen('./reportes/'.$file_name, 'w');
	fwrite($fp, $content);
	fclose($fp);
	// Devuelve nombre de archivo generado
	return $file_name;
}
