<?php
//include_once APPPATH.'libraries\third_party\mpdf\mpdf.php';
	Class Modelo_factor_gei Extends CI_Model
	{
	/********************************************************************************************************************************
	FACTOR GEI
	********************************************************************************************************************************/
	//Crea los registros, la tabla obviamente sera una nueva con el nombre de... pdc_factor_gei
	function creargei()
	{
		$data['theyear'] = $this->input->post('theyear');
		$data['cantidad_alumnos'] = $this->input->post('cantidad_alumnos');
		$data['emisionesa'] = $this->input->post('emisionesa');
		$data['emisiones'] = $this->input->post('emisiones');
		$data['emisionesg'] = $this->input->post('emisionesg');
		$data['temperatura'] = $this->input->post('temperatura');
		$this->db->insert("pdc_factor_gei_all", $data);
	}

	/* Sirve para borrar el registro deseado */
	function borrar_gei($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('pdc_factor_gei_all');
	}

	//Obtiene toda la informacion de la tabla pdc_factor_gei
	function info_gei($id) {
		$this->db->where('id', $id);
		$query = $this->db->get("pdc_factor_gei_all");
		return $query->row();
	}

	//Realiza un update(actualización) a la tabla de pdc_factor_gei
	function edicion_gei($id)
	{
		$data['theyear'] = $this->input->post('theyear');
		$data['cantidad_alumnos'] = $this->input->post('cantidad_alumnos');
		$data['emisionesa'] = $this->input->post('emisionesa');
		$data['emisiones'] = $this->input->post('emisiones');
		$data['emisionesg'] = $this->input->post('emisionesg');
		$data['temperatura'] = $this->input->post('temperatura');
		$this->db->where('id', $id);
		$this->db->update("pdc_factor_gei_all", $data);
	}

	//Realiza la consulta en la tabla pdc_factor_gei para poderla desplegar despues
	function consulta_gei()
	{

		$sql = "SELECT id AS show_id,
				theyear AS show_years,
				FORMAT(cantidad_alumnos,0) AS show_alumnos,
				emisionesa AS show_emisionesa,
				emisiones AS show_emisiones,
				emisionesg AS show_emisionesg,
				temperatura AS show_temperatura
				FROM pdc_factor_gei_all";


		$sql .= " GROUP BY theyear ORDER BY theyear";

		$query = $this->db->query($sql);

		if($query->num_rows() > 0)
			{
				return $query->result_array();

			}
			else
				{
					return FALSE;
				}
	}

	//Tal vez sirva tal vez no (llamar esta función en pruebas)
	function catalogo_gei($limite=false, $inicio=0)
	{
		if($limite)
			$this->db->limit($limite, $inicio);

		$this->db->order_by("theyear", "desc");
		$query = $this->db->get('pdc_factor_gei_all');

		if($query->num_rows()>0) {
			foreach($query->result() as $row) {
				$theyear[$row->id] = $row;
			}
			return $theyear;
		}
		else return false;
	}

	//Nota Alumnos es la primer columna, rawkw es la segunda columna, rawkwxgei es la tercera columna en la graficas
	/*******************************************************************************************************************************/
															//GRAF//

	//Carga tabla abajo de la gráfica

	function load_gei_table4()
	{

		if(empty($year))
		{
			$this->db->select('theyear, kwcapitayear, kgcapitayear, temperatura');
			$query = $this->db->get('pdc_factor_gei_all');
			return $query->result();
			

		}

	}

	function load_gei_agua()
	{

		if(empty($year))
		{
			$this->db->select('theyear, m3wtrcapitayear, wtrkgcapitayear, temperatura');
			$query = $this->db->get('pdc_factor_gei_all');
			return $query->result();
			

		}

	}

	function load_gei_gas()
	{

		if(empty($year))
		{
			$this->db->select('theyear, m3gascapitayear, gaskgcapitayear, temperatura');
			$query = $this->db->get('pdc_factor_gei_all');
			return $query->result();
			

		}

	}

	function load_tar_hmgpo()
	{
		if(empty($year))
		{
			$this->db->select('theyearhmgpo, consumohmgpo');
			$query = $this->db->get('pdc_tarifa_hm_gpo');
			return $query->result();
		}
	}

	function load_tar_omgpo()
	{
		if(empty($year))
		{
			$this->db->select('theyearomgpo, consumoomgpo');
			$query = $this->db->get('pdc_tarifa_om_gpo');
			return $query->result();
		}
	}


	/**********************************QUERY PARA CREAR LA TABLA pdc_factor_gei_all*********************************/
	/*ACTUALIZADO EL 08 DE NOV DEL 2017*/
	/*

	/ELECTRICIDAD/
	rawkw se refiere a la cantidad de kWh consumidos
	kwcapitayear se refiere a la división de los valores "rawkw" y "cantidad_alumnos"
	kgcapitayear se refiere a la multiplicación de los valores en "kwcapitayear" y "emisiones" (GEI)
	rawkwxgei se refiere a la multiplicación de los valores "rawkw" y "emisiones" (GEI)

	/AGUA/
	rawm3wtr se refiere a la cantidad de metros cúbicos de agua consumida
	m3wtrcapitayear se refiere a la división entre los valores de "rawm3wtr" y "cantidad_alumnos"
	wtrkgcapitayear se refiere a la multiplicación entre los valores de "m3wtrcapitayear" y "emisionesa" (GEI)
	rawm3wtrxgei se refiere a la multiplicación entre los valores de "rawm3wtr" y "emisionesa" (GEI)

	/GAS/
	rawm3gas se refiere a la cantidad de metros cúbicos de gas consumida
	m3gascapitayear se refiere a la división entre los valores de "rawm3gas" y "cantidad_alumnos"
	gaskgcapitayear se refiere a la multiplicación entre los valores de "m3gascapitayear" y "emisionesg" (GEI)
	rawm3gasxgei se refiere a la multiplicación entre los valores de "rawm3gas" y "emsiones" (GEI)


	*/


	function creacione_factore()
	{

		$this->db->trans_start();
			$start1=	"CREATE TABLE IF NOT EXISTS `pdc_factor_gei_all` ( `id` INT NOT NULL AUTO_INCREMENT ,	
			`theyear` YEAR NOT NULL ,
			`cantidad_alumnos` INT(15) NOT NULL ,
			`emisionesa` FLOAT NOT NULL , /*DECIMAL(4,4) NOT NULL*/ /*DOUBLE (4,4) NOT NULL*/
			`emisiones` FLOAT NOT NULL , /*DECIMAL(4,4) NOT NULL*/ /*DOUBLE (4,4) NOT NULL*/
			`emisionesg` FLOAT NOT NULL , /*DECIMAL(4,4) NOT NULL*/ /*DOUBLE (4,4) NOT NULL*/
			`temperatura` FLOAT NOT NULL ,
			`kwcapitayear` FLOAT NOT NULL ,
			`kgcapitayear` FLOAT NOT NULL ,
			`rawkw` FLOAT NOT NULL,
			`rawkwxgei` FLOAT NOT NULL,
		    `m3wtrcapitayear` FLOAT NOT NULL,
		    `wtrkgcapitayear` FLOAT NOT NULL,
		    `rawm3wtr` FLOAT NOT NULL,
		    `rawm3wtrxgei` FLOAT NOT NULL,
		    `m3gascapitayear` FLOAT NOT NULL,
		    `gaskgcapitayear` FLOAT NOT NULL,
		    `rawm3gas` FLOAT NOT NULL,
		    `rawm3gasxgei` FLOAT NOT NULL,
			PRIMARY KEY (`id`), UNIQUE `yearini` (`theyear`)) ENGINE = InnoDB";

		$this->db->query($start1);

		$this->db->query("INSERT INTO `pdc_factor_gei_all` (id, theyear)
		VALUES (1,2011), (2,2012), (3,2013), (4,2014), (5,2015), (6,2016), (7,2017)
		ON DUPLICATE KEY UPDATE id = VALUES(ID),
		theyear = VALUES(theyear),
		rawkw = VALUES(rawkw),
	    rawm3wtr = VALUES(rawm3wtr),
	    rawm3gas = VALUES(rawm3gas)");
		/*Este query insertara valores para las gráficas de electricidad*/
		/*
		SELECT CONCAT('', FORMAT(SUM(consumo), 0)) AS SumaConsumo,
	CONCAT('', FORMAT(SUM(costo),2)) AS SumaCosto,
	GROUP_CONCAT(DISTINCT(YEAR(periodo_fin))) AS SumaYear FROM pdc_consumo_energia
	WHERE (YEAR(periodo_fin) <'0-0-0' OR YEAR(periodo_fin)> '2010-12-31')
	AND (YEAR(periodo_fin) <= YEAR(NOW()) )
	AND consumo IS NOT NULL AND consumo <> ''
	AND costo IS NOT NULL AND costo <> ''
	AND periodo_inicio IS NOT NULL AND  periodo_inicio <> ''
	AND periodo_fin IS NOT NULL AND periodo_fin <> ''
	AND servicio IS NOT NULL AND servicio <> ''
	AND factor IS NOT NULL AND factor <> ''
	AND datetime IS NOT NULL AND datetime <> ''
    GROUP BY YEAR(periodo_fin) ORDER BY YEAR(periodo_fin)
		
		*/
		
/*Actualizacion de query 27 agosto 2018*/ 
		$this->db->query("INSERT INTO pdc_factor_gei_all(theyear, rawkw)
			(SELECT GROUP_CONCAT(DISTINCT(YEAR(a.periodo_fin))),
			CONCAT(SUM(a.consumo))
			FROM pdc_consumo_energia a
			WHERE a.periodo_fin IS NOT NULL AND a.periodo_fin <> ''
			AND a.consumo IS NOT NULL AND a.consumo <> ''
			AND a.costo IS NOT NULL AND a.costo <> ''
			AND a.servicio IS NOT NULL AND a.servicio <> ''
            AND a.factor IS NOT NULL AND a.factor <> ''
			AND a.datetime IS NOT NULL AND a.datetime <> ''
			AND a.periodo_inicio IS NOT NULL AND a.periodo_inicio <> ''
			AND (YEAR(a.periodo_fin) >= 2011 AND YEAR(a.periodo_fin) <= YEAR(NOW()) )
			GROUP BY YEAR(a.periodo_fin)
			ORDER BY YEAR(a.periodo_fin) ASC, a.servicio ASC)
			ON DUPLICATE KEY UPDATE theyear = VALUES(theyear), rawkw = VALUES(rawkw)");
	/*Este query insertara valores para las gráficas de agua*/
		$this->db->query("INSERT INTO `pdc_factor_gei_all`(theyear, rawm3wtr)
			(SELECT GROUP_CONCAT(DISTINCT(YEAR(b.periodo_fin))),
			CONCAT(SUM(b.consumo))
			FROM pdc_consumo_agua b
			WHERE b.periodo_fin IS NOT NULL AND b.periodo_fin <> ''
			AND b.consumo IS NOT NULL AND b.consumo <> ''
			AND b.costo IS NOT NULL AND b.costo <> ''
			AND b.servicio IS NOT NULL AND b.servicio <> ''
			AND b.datetime IS NOT NULL AND b.datetime <> ''
			AND b.periodo_inicio IS NOT NULL AND b.periodo_inicio <> ''
			AND (YEAR(b.periodo_fin) >= 2011 AND YEAR(b.periodo_fin) <= YEAR(NOW()) )
			GROUP BY YEAR(b.periodo_fin)
			ORDER BY YEAR(b.periodo_fin) ASC, b.servicio ASC)
			ON DUPLICATE KEY UPDATE theyear = VALUES(theyear), rawm3wtr = VALUES(rawm3wtr)");
	/*Este query Insertara valores para las gráficas de gas*/
		/*CONSULTA ANTIGUA*/
		/*$this->db->query("INSERT INTO `pdc_factor_gei_all`(theyear, rawm3gas)
			(SELECT GROUP_CONCAT(DISTINCT(YEAR(c.periodo_fin))),
			CONCAT(SUM(c.consumo))
			FROM pdc_consumo_gas c
			WHERE c.periodo_fin IS NOT NULL AND c.periodo_fin <> ''
			AND c.consumo IS NOT NULL AND c.consumo <> ''
			AND c.costo IS NOT NULL AND c.costo <> ''
			AND c.servicio IS NOT NULL AND c.servicio <> ''
			AND c.datetime IS NOT NULL AND c.datetime <> ''
			AND c.periodo_inicio IS NOT NULL AND c.periodo_inicio <> ''
			AND (YEAR(c.periodo_fin) >= 2011 AND YEAR(c.periodo_fin) <= YEAR(NOW()) )
			GROUP BY YEAR(c.periodo_fin)
			ORDER BY YEAR(c.periodo_fin) ASC, c.servicio ASC)
			ON DUPLICATE KEY UPDATE theyear = VALUES(theyear), rawm3gas = VALUES(rawm3gas)");*/
			$this->db->query("INSERT INTO `pdc_factor_gei_all`(theyear, rawm3gas)
			(SELECT GROUP_CONCAT(DISTINCT(YEAR(periodo_inicio))),
			CONCAT(SUM(consumo))
			FROM pdc_consumo_gas
			WHERE
			((YEAR(periodo_inicio) >=2011 AND YEAR(periodo_inicio) <=YEAR(NOW()))
			OR (YEAR(periodo_fin) >=2011 AND YEAR(periodo_fin) <=YEAR(NOW())) AND YEAR(periodo_inicio) != 2010)
			GROUP BY YEAR(periodo_inicio)
			ORDER BY YEAR(periodo_fin) ASC, servicio ASC)
			ON DUPLICATE KEY UPDATE theyear = VALUES(theyear), rawm3gas = VALUES(rawm3gas)");
		$this->db->trans_complete();


	}




	/*****************FUNCION PARA LA TABLA DE AGUA POTABLE Y RESIDUAL*****************/

	/*function drope_pot_res()
	{
		$this->db->query("DROP TABLE IF EXISTS factor_gei_agua_comparativo;");
	}

	function creacione_pot_res()
	{
		$this->db->trans_start();
		$start1= "CREATE TABLE IF NOT EXISTS `factor_gei_agua_comparativo`(`id` INT NOT NULL AUTO_INCREMENT,
			`id_servicio` INT(8) NOT NULL,
			`year_water_comp` VARCHAR(15) NOT NULL,
			`consumo_water_comp` FLOAT NOT NULL,
			`costo_water_comp` FLOAT NOT NULL,
			`cuenta_waters_comp` VARCHAR (20) NOT NULL,
			PRIMARY KEY (`id`)) ENGINE = InnoDB";

		$this->db->query($start1);

		$this->db->query("INSERT INTO `factor_gei_agua_comparativo`(`id_servicio`, `year_water_comp`,
			`consumo_water_comp`,`costo_water_comp`, `cuenta_waters_comp`)
			(SELECT
			a.servicio,
			GROUP_CONCAT(DISTINCT(YEAR(a.periodo_fin))),
			SUM(a.consumo),
			SUM(a.costo),
			b.cuenta
			FROM pdc_consumo_agua a
			INNER JOIN pdc_servicios_agua b ON a.servicio = b.id
			AND a.periodo_fin IS NOT NULL AND a.periodo_fin <> ''
			AND a.consumo IS NOT NULL AND a.consumo <> ''
			AND a.costo IS NOT NULL AND a.costo <> ''
			AND b.cuenta IS NOT NULL AND b.cuenta <> ''
			AND (YEAR(a.periodo_fin) >= 2014 AND YEAR(a.periodo_fin) <= YEAR(NOW()))
			WHERE (a.servicio = '44') OR
			(a.servicio = '64')
			GROUP BY YEAR(a.periodo_fin), a.servicio ASC
			ORDER BY YEAR(a.periodo_fin) ASC, a.servicio ASC)
			ON DUPLICATE KEY UPDATE id_servicio = VALUES(id_servicio), year_water_comp = VALUES(year_water_comp),
			consumo_water_comp = VALUES(consumo_water_comp), costo_water_comp = VALUES(costo_water_comp),
			cuenta_waters_comp = VALUES(cuenta_waters_comp)");

		$this->db->trans_complete();

	}*/
	
	
function drope_factwatcomp()
{
	$this->db->query("DROP TABLE IF EXISTS  `factor_gei_agua_comparativo`;");
}

	function creacione_pdc_water_comp()
	{
			$this->db->trans_start();

$startwat = "CREATE TABLE IF NOT EXISTS `factor_gei_agua_comparativo`(`id` INT NOT NULL AUTO_INCREMENT,
`id_servicio` INT(8) NOT NULL, `year_water_comp` VARCHAR(15) NOT NULL, `consumo_water_comp` FLOAT NOT NULL,
`costo_water_comp` FLOAT NOT NULL, `cuenta_waters_comp` VARCHAR (20) NOT NULL,
`pot_waters_comp` VARCHAR(15) NOT NULL,  `res_waters_comp` VARCHAR(15) NOT NULL,
PRIMARY KEY (`id`)) ENGINE = InnoDB";
		
	$this->db->query($startwat);

	$this->db->query(
		"INSERT INTO `factor_gei_agua_comparativo`(`id_servicio`, `year_water_comp`,
		`consumo_water_comp`,`costo_water_comp`, `cuenta_waters_comp`)
		(SELECT
		a.servicio,
		GROUP_CONCAT(DISTINCT(YEAR(a.periodo_fin))),
		SUM(a.consumo),
		SUM(a.costo),
		b.cuenta
		FROM pdc_consumo_agua a
		INNER JOIN pdc_servicios_agua b ON a.servicio = b.id
		AND a.periodo_fin IS NOT NULL AND a.periodo_fin <> ''
		AND a.consumo IS NOT NULL AND a.consumo <> ''
		AND a.costo IS NOT NULL AND a.costo <> ''
		AND b.cuenta IS NOT NULL AND b.cuenta <> ''
		AND (YEAR(a.periodo_fin) >= 2014 AND YEAR(a.periodo_fin) <= YEAR(NOW()))
		WHERE (a.servicio = '44') OR
		(a.servicio = '64')
		GROUP BY YEAR(a.periodo_fin), a.servicio ASC
		ORDER BY YEAR(a.periodo_fin) ASC, a.servicio ASC)
		ON DUPLICATE KEY UPDATE id_servicio = VALUES(id_servicio), year_water_comp = VALUES(year_water_comp),
		consumo_water_comp = VALUES(consumo_water_comp), costo_water_comp = VALUES(costo_water_comp), cuenta_waters_comp = VALUES(cuenta_waters_comp),
		pot_waters_comp = VALUES(pot_waters_comp), res_waters_comp = VALUES(res_waters_comp)");

	$startwat2=
	"UPDATE `factor_gei_agua_comparativo`
	SET `pot_waters_comp` = 'POTPOTWATER'
	WHERE `id_servicio` = '44'";
	$this->db->query($startwat2);
	$startwat3=
	"UPDATE factor_gei_agua_comparativo
	SET res_waters_comp = 'RESRESWATER'
	WHERE id_servicio = '64' ";
	$this->db->query($startwat3);
	


	$this->db->trans_complete();


	}
	/*****************TERMINACION DE LA FUNCION*****************/	

	/*****************FUNCION PARA CREAR TARFIAS HM TOTALES POR AÑOS*****************/

	function drope_tarifa_hmgpo()
	{
		$this->db->query("DROP TABLE IF EXISTS pdc_tarifa_hm_gpo;");
	}

	function creacione_tarifa_hmgpo()
	{

		$this->db->trans_start();

			$starthmgpo = "CREATE TABLE IF NOT EXISTS `pdc_tarifa_hm_gpo`  (`id` INT NOT NULL AUTO_INCREMENT ,
				`theyearhmgpo` YEAR NOT NULL ,
			    `consumohmgpo` FLOAT NOT NULL DEFAULT 0,
			    `costohmgpo` FLOAT NOT NULL DEFAULT 0,
				PRIMARY KEY (`id`), UNIQUE `yearhmgpo` (`theyearhmgpo`))  ENGINE = InnoDB";
		$this->db->query($starthmgpo);

		$this->db->query("INSERT INTO `pdc_tarifa_hm_gpo` (id, theyearhmgpo)
		VALUES (1,2011), (2,2012), (3,2013), (4,2014), (5,2015), (6,2016), (7,2017)
		ON DUPLICATE KEY UPDATE id = VALUES(ID),
		theyearhmgpo = VALUES(theyearhmgpo),
		consumohmgpo = VALUES(consumohmgpo),
	    costohmgpo = VALUES(costohmgpo)");

		$this->db->query("INSERT INTO `pdc_tarifa_hm_gpo` (theyearhmgpo, consumohmgpo, costohmgpo)
		(SELECT GROUP_CONCAT(DISTINCT(YEAR(a.periodo_fin))),
		SUM(a.consumo),
		SUM(a.costo)
		FROM `pdc_consumo_energia` a
		INNER JOIN `pdc_servicios_energia` b ON a.servicio = b.id
		AND a.periodo_fin IS NOT NULL AND a.periodo_fin <> ''
		AND a.consumo IS NOT NULL AND a.consumo <> ''
		AND a.costo IS NOT NULL AND a.costo <> ''
		AND b.cuenta IS NOT NULL AND b.cuenta <> ''
		AND NOT a.servicio= '192'
		AND (YEAR(a.periodo_fin) >= 2011 AND YEAR(a.periodo_fin) <= YEAR(NOW()))
		AND b.cuenta IN(
		999941000123, 999071000165, 415930700059, 999000800438, 999120100219, 415030100196, 999090700011,
		415080100120, 999060700068, 999850102225, 999990200081, 999110500065, 999020400185, 415000600208,
		396050801625, 415040800111, 415101000155, 999021000105, 417060800098, 999010900392, 417011100056, 
		999850102187, 415001100233, 415021000677, 395000201248, 396050801803, 396060300721, 999010800193, 
		999011100209, 999050700159, 396050103651, 999081100109, 999971200038, 999850104571, 999981000304, 
		999990200138, 999021100169, 999070900201, 999990800119, 999981000282, 999000500400, 999090700151,
		415031000411, 999000400367, 999111100168, 999021200147, 396080702214, 395081000098, 415021000596, 
		999991100129, 415060200136, 417020900201, 415051200247, 398940420281, 415021100191, 415040900085, 
		999000600595, 999020900218, 999031000243, 999091200039, 999011100161, 395000200977, 392050800381, 
		415050800101, 415160800076, 417021000238, 999050800404, 999100700091, 999850104562, 417140500516,
		390050800337, 415150400053, 999000500426, 999140100380, 999150400225, 415140500068, 999130800383,
		407161001018, 999010700148, 396140101703, 396140500543, 777000501774)
	    GROUP BY YEAR(a.periodo_fin)
		ORDER BY YEAR(a.periodo_fin)ASC)
		ON DUPLICATE KEY UPDATE theyearhmgpo = VALUES(theyearhmgpo), consumohmgpo = VALUES(consumohmgpo), costohmgpo = VALUES(costohmgpo)");
		$this->db->trans_complete();
	}
	/*****************TERMINACION DE LA FUNCION*****************/



/*****************FUNCION PARA CREAR TARFIAS OM TOTALES POR AÑOS*****************/
function drope_tarifa_omgpo()
{
	$this->db->query("DROP TABLE IF EXISTS pdc_tarifa_om_gpo;");
}

function creacione_tarifa_omgpo()
{
	$this->db->trans_start();

	$startomgpo = "CREATE TABLE IF NOT EXISTS `pdc_tarifa_om_gpo`  (`id` INT NOT NULL AUTO_INCREMENT ,
				`theyearomgpo` YEAR NOT NULL ,
			    `consumoomgpo` FLOAT NOT NULL,
			    `costoomgpo` FLOAT NOT NULL,
				PRIMARY KEY (`id`), UNIQUE `yearomgpo` (`theyearomgpo`))  ENGINE = InnoDB";
		
	$this->db->query($startomgpo);

	$this->db->query(
		"INSERT INTO `pdc_tarifa_om_gpo` (id, theyearomgpo)
		VALUES (1,2011), (2,2012), (3,2013), (4,2014), (5,2015), (6,2016), (7,2017)
		ON DUPLICATE KEY UPDATE id = VALUES(ID),
		theyearomgpo = VALUES(theyearomgpo),
		consumoomgpo = VALUES(consumoomgpo),
	    costoomgpo = VALUES(costoomgpo)");

	$this->db->query("
	INSERT INTO `pdc_tarifa_om_gpo` (`theyearomgpo`, `consumoomgpo`, `costoomgpo`)
	(SELECT GROUP_CONCAT(DISTINCT(YEAR(a.periodo_fin))),
	/*CONCAT('', SUM(a.consumo)),
	CONCAT('', SUM(a.costo))*/
	SUM(a.consumo),
	SUM(a.costo)
	FROM `pdc_consumo_energia` a
	INNER JOIN `pdc_servicios_energia` b ON a.servicio = b.id
	AND a.periodo_fin IS NOT NULL AND a.periodo_fin <> ''
	AND a.consumo IS NOT NULL AND a.consumo <> ''
	AND a.costo IS NOT NULL AND a.costo <> ''
	AND b.cuenta IS NOT NULL AND b.cuenta <> ''
	AND NOT a.servicio = '192'
	AND (YEAR(a.periodo_fin) >= 2011 AND YEAR(a.periodo_fin) <=YEAR(NOW()))
	AND b.cuenta IN(
	396040910141, 396041201186, 396041201194, 396750301283, 888001105010, 403070900499, 414850702330, 379850802831,
	396020302349, 392950800220, 400070502109, 399110500483, 390871201164, 401950705790, 389860700250, 395750300531,
	372850200526, 888850801011, 385850900158, 398990810609, 379970402569, 407121200891, 396091100402, 379850802792,
	79040402933, 379040402941, 373980303692, 407120301449, 373850401145)
	GROUP BY YEAR(a.periodo_fin)
	ORDER BY YEAR(a.periodo_fin)ASC)
	ON DUPLICATE KEY UPDATE theyearomgpo = VALUES(theyearomgpo), consumoomgpo = VALUES(consumoomgpo), costoomgpo = (costoomgpo);");
	$this->db->trans_complete();
}
/*****************TERMINACION DE LA FUNCION*****************/



/**************************INSERT DE OPERACIONES A LAS SIGUIENTES COLUMNAS**************************/


	function ins_capitas()
	{
		$this->db->trans_start();
		/*ELECTRICIDAD*/
		$this->db->query("UPDATE pdc_factor_gei_all SET kwcapitayear = rawkw/cantidad_alumnos WHERE theyear >= 2011");
		$this->db->query("UPDATE pdc_factor_gei_all SET kgcapitayear = kwcapitayear*emisiones WHERE theyear >= 2011");
		$this->db->query("UPDATE pdc_factor_gei_all SET rawkwxgei    = rawkw*emisiones WHERE theyear >= 2011");	
		/*AGUA*/
	    $this->db->query("UPDATE pdc_factor_gei_all SET m3wtrcapitayear = rawm3wtr/cantidad_alumnos WHERE theyear >= 2011");
		$this->db->query("UPDATE pdc_factor_gei_all SET wtrkgcapitayear = m3wtrcapitayear*emisionesa WHERE theyear >= 2011");
		$this->db->query("UPDATE pdc_factor_gei_all SET rawm3wtrxgei    = rawm3wtr*emisionesa WHERE theyear >= 2011");
		/*GAS*/
		$this->db->query("UPDATE pdc_factor_gei_all SET m3gascapitayear = rawm3gas/cantidad_alumnos WHERE theyear >= 2011");
		$this->db->query("UPDATE pdc_factor_gei_all SET gaskgcapitayear = m3gascapitayear*emisionesg WHERE theyear >= 2011");
		$this->db->query("UPDATE pdc_factor_gei_all SET rawm3gasxgei = rawm3gas*emisionesg WHERE theyear >= 2011");
		$this->db->trans_complete();
	}
/*****************TERMINACION DEl INSERT*****************/

/****************************************************************************************************************************************************************************/
											/*HASTA AQUI LLEGA EL MODELO ORGINAL DEL ANTERIOR SERVIDOR*/																	
/****************************************************************************************************************************************************************************/

/**************************************************************************************************************************/
//CREA LA TABLA de pdc_all_dep_elec PARA SU CONULTA EN LAS VISTAS DE busqueda_alldependencia_x_fecha y all_fecha_energia//
function alldepelecchafa()
{
	$this->db->trans_start();
		$tabla_all_dep_elec= "CREATE TABLE IF NOT EXISTS `pdc_all_dep_elec`(`id` INT NOT NULL AUTO_INCREMENT,
		 `cuenta` VARCHAR(64) NOT NULL, `dependencia` VARCHAR(256) NOT NULL, `periodo_inicio` DATE NOT NULL, `periodo_fin`DATE NOT NULL, `consumo` INT(30), `costo` INT(30), `factor` TEXT NOT NULL,
		PRIMARY KEY (`id`)) ENGINE InnoDB;";

		$this->db->query($tabla_all_dep_elec);
		$this->db->query("INSERT INTO `pdc_all_dep_elec`(`cuenta`, `dependencia`, `periodo_inicio`, `periodo_fin`, `consumo`, `costo`, `factor`)
	(SELECT
	b.cuenta,
    b.dependencia,
    a.periodo_inicio,
    a.periodo_fin,
	a.consumo,
	a.costo,
    a.factor
	FROM `pdc_consumo_energia` a
	INNER JOIN `pdc_servicios_energia` b ON a.servicio = b.id
    AND a.periodo_inicio IS NOT NULL AND a.periodo_inicio <> ''
	AND a.periodo_fin IS NOT NULL AND a.periodo_fin <> ''
	AND b.cuenta IS NOT NULL AND b.cuenta <> ''
	AND (YEAR(a.periodo_fin) >= 2011 AND YEAR(a.periodo_fin) <= YEAR(NOW()))
    ORDER BY b.dependencia ASC)");
	$this->db->trans_complete();
}
/**************************************************************************************************************************/
//FUNCION PARA ELIMIAR LOS REGISTROS DE LA TABLA pdc_all_dep_elec Y PODER RECARGAR DATOS ACTUALES

function dropper_all_dep_elec()
{
	$this->db->query("DROP TABLE pdc_all_dep_elec;");
}
/**************************************************************************************************************************/
//CREA LA TABLA de pdc_all_dep_agua PARA SU CONULTA EN LAS VISTAS DE busqueda_alldependencia_x_fecha_agua y all_fecha_agua//
/*PARA desglose MASIVO DE AGUA*/
/*function alldepaguacchafa()*/
function alldepaguachafa()
{
	$this->db->trans_start();
		$tabla_all_dep_agua= "CREATE TABLE IF NOT EXISTS `pdc_all_dep_agua`(`id` INT NOT NULL AUTO_INCREMENT,
		 `cuenta` VARCHAR(64) NOT NULL, `dependencia` VARCHAR(256) NOT NULL, `periodo_inicio` DATE NOT NULL, `periodo_fin`DATE NOT NULL, `consumo` INT(30), `costo` INT(30),
		PRIMARY KEY (`id`)) ENGINE InnoDB;";

		$this->db->query($tabla_all_dep_agua);
		$this->db->query("INSERT INTO `pdc_all_dep_agua`(`cuenta`, `dependencia`, `periodo_inicio`, `periodo_fin`, `consumo`, `costo`)
	(SELECT
	b.cuenta,
    b.dependencia,
    a.periodo_inicio,
    a.periodo_fin,
	a.consumo,
	a.costo
	FROM `pdc_consumo_agua` a
	INNER JOIN `pdc_servicios_agua` b ON a.servicio = b.id
    AND a.periodo_inicio IS NOT NULL AND a.periodo_inicio <> ''
	AND a.periodo_fin IS NOT NULL AND a.periodo_fin <> ''
	AND b.cuenta IS NOT NULL AND b.cuenta <> ''
	AND (YEAR(a.periodo_fin) >= 2011 AND YEAR(a.periodo_fin) <= YEAR(NOW()))
    ORDER BY b.dependencia ASC)");
	$this->db->trans_complete();
}

//FUNCION PARA ELIMIAR LOS REGISTROS DE LA TABLA pdc_all_dep_agua Y PODER RECARGAR DATOS ACTUALES

function dropper_all_dep_agua()
{
	$this->db->query("DROP TABLE pdc_all_dep_agua;");
}
/**************************************************************************************************************************/
//CREA LA TABLA de pdc_all_dep_gaas PARA SU CONULTA EN LAS VISTAS DE busqueda_alldependencia_x_fecha_gaas y all_fecha_gaseoso//
/*PARA desglose MASIVO DE ELECTRICIDAD*/
function alldepgaaschafa()
{
	$this->db->trans_start();
		$tabla_all_dep_gaas= "CREATE TABLE IF NOT EXISTS `pdc_all_dep_gaas`(`id` INT NOT NULL AUTO_INCREMENT,
		 `cuenta` VARCHAR(64) NOT NULL, `dependencia` VARCHAR(256) NOT NULL, `periodo_inicio` DATE NOT NULL, `periodo_fin`DATE NOT NULL, `consumo` INT(30), `costo` INT(30),
		PRIMARY KEY (`id`)) ENGINE InnoDB;";

		$this->db->query($tabla_all_dep_gaas);
		$this->db->query("INSERT INTO `pdc_all_dep_gaas`(`cuenta`, `dependencia`, `periodo_inicio`, `periodo_fin`, `consumo`, `costo`)
	(SELECT
	b.cuenta,
    b.dependencia,
    a.periodo_inicio,
    a.periodo_fin,
	a.consumo,
	a.costo
	FROM `pdc_consumo_gas` a
	INNER JOIN `pdc_servicios_gas` b ON a.servicio = b.id
    AND a.periodo_inicio IS NOT NULL AND a.periodo_inicio <> ''
	AND a.periodo_fin IS NOT NULL AND a.periodo_fin <> ''
	AND b.cuenta IS NOT NULL AND b.cuenta <> ''
	AND (YEAR(a.periodo_fin) >= 2011 AND YEAR(a.periodo_fin) <= YEAR(NOW()))
    ORDER BY b.dependencia ASC)");
	$this->db->trans_complete();
}
/**************************************************************************************************************************/
//FUNCION PARA ELIMIAR LOS REGISTROS DE LA TABLA pdc_all_dep_gaas Y PODER RECARGAR DATOS ACTUALES

function dropper_all_dep_gaas()
{
	$this->db->query("DROP TABLE pdc_all_dep_gaas;");
}


/**************************************************************************************************************************/

//CREA LAS TABLAS DE pdctarifahmgpo_x_mepo, temp_hm_1, temp_hm_2 y pdc_tar_hm_final_x_mepo. TAMBIEN HACE LA INSERCION DE DATOS CORRESPONDIENTES A LAS MISMAS//
function tarhmfinaltransact()
{
	$this->db->trans_start();
	$tabla1= "CREATE TABLE IF NOT EXISTS `pdctarifahmgpo_x_mepo` (`id` INT NOT NULL AUTO_INCREMENT,
				`idservicio_hm_x_mepo` FLOAT NOT NULL, `cuenta_hm_x_mepo` VARCHAR(100) NOT NULL,
				`dependencia_hm_x_mepo` VARCHAR(55) NOT NULL , `fecha_hm_x_mepo` VARCHAR(15) NOT NULL,
				`mes_hm_x_mepo` VARCHAR(15) NOT NULL, `consumo_hm_x_mepo` DECIMAL(30,2) NOT NULL,
			    `costo_hm_x_mepo` DECIMAL(30,2) NOT NULL, PRIMARY KEY (`id`),
			    UNIQUE KEY (`id`))  ENGINE = InnoDB";

	$tabla2= "CREATE TABLE IF NOT EXISTS `temp_hm_1` (`idservicio_hm_x_mepo_1` INT NOT NULL, `cuenta_hm_x_mepo_1` VARCHAR(100) NOT NULL,
	`dependencia_hm_x_mepo_1` VARCHAR(100), `ano` YEAR, `enero` FLOAT, `febrero` FLOAT, `marzo` FLOAT, `abril` FLOAT, `mayo` FLOAT, `junio` FLOAT,
	`julio` FLOAT, `agosto` FLOAT, `septiembre` FLOAT, `octubre` FLOAT, `noviembre` FLOAT, `diciembre` FLOAT)";

	$tabla3= "CREATE TABLE IF NOT EXISTS `temp_hm_2` (`idservicio_hm_x_mepo_2` INT NOT NULL, `cuenta_hm_x_mepo_2` VARCHAR(100) NOT NULL,
	`dependencia_hm_x_mepo_2` VARCHAR(100), `ano` YEAR, `enero` FLOAT, `febrero` FLOAT , `marzo` FLOAT, `abril` FLOAT, `mayo` FLOAT, `junio` FLOAT,
	`julio` FLOAT, `agosto` FLOAT, `septiembre` FLOAT, `octubre` FLOAT, `noviembre` FLOAT, `diciembre` FLOAT)";

	$tabla4= "CREATE TABLE IF NOT EXISTS `pdc_tar_hm_final_x_mepo`  (`id` INT NOT NULL AUTO_INCREMENT,
				`id_tar_hm_final_x_mepo` INT(30) NULL, `cta_tar_hm_final_x_mepo` VARCHAR(100) NOT NULL,
				`dep_tar_hm_final_x_mepo` VARCHAR(55) NOT NULL,  `yer_tar_hm_final_x_mepo` YEAR NOT NULL,
			    `Enero` INT(30) NOT NULL, `Febrero` INT(30) NOT NULL, `Marzo` INT(30) NOT NULL, `Abril` INT(30) NOT NULL,
                `Mayo` INT(30) NOT NULL, `Junio` INT(30) NOT NULL, `Julio` INT(30) NOT NULL, `Agosto` INT(30) NOT NULL,
                `Septiembre` INT(30) NOT NULL, `Octubre` INT(30) NOT NULL, `Noviembre` INT(30) NOT NULL,
                `Diciembre` INT(30) NOT NULL, PRIMARY KEY (`id`), UNIQUE KEY (`id`))  ENGINE = InnoDB";

	$this->db->query($tabla1);
	$this->db->query($tabla2);
	$this->db->query($tabla3);
	$this->db->query($tabla4);
	
	$this->db->query(
		"INSERT INTO `pdctarifahmgpo_x_mepo` (`idservicio_hm_x_mepo`, `cuenta_hm_x_mepo`, `dependencia_hm_x_mepo`,
			`fecha_hm_x_mepo`, `mes_hm_x_mepo`, `consumo_hm_x_mepo`, `costo_hm_x_mepo`)
	(SELECT 
    a.servicio,
    b.cuenta,
    b.dependencia,
    a.periodo_fin,
    MONTHNAME(a.periodo_fin),
	CONCAT('', (a.consumo)),
	CONCAT('', (a.costo))
	FROM `pdc_consumo_energia` a
	INNER JOIN `pdc_servicios_energia` b ON a.servicio = b.id
    WHERE a.servicio IS NOT NULL AND a.servicio <> ''
    AND b.cuenta IS NOT NULL AND b.cuenta <> ''
    AND b.dependencia IS NOT NULL AND b.dependencia <> ''
	AND a.periodo_fin IS NOT NULL AND a.periodo_fin <> ''
	AND a.consumo IS NOT NULL AND a.consumo <> ''
	AND a.costo IS NOT NULL AND a.costo <> ''
	AND a.servicio <> '192'
	AND (YEAR(a.periodo_fin) >= 2011 AND YEAR(a.periodo_fin) <=YEAR(NOW()))
	AND b.cuenta IN(
		999941000123, 999071000165, 415930700059, 999000800438, 999120100219, 415030100196, 999090700011,
		415080100120, 999060700068, 999850102225, 999990200081, 999110500065, 999020400185, 415000600208,
		396050801625, 415040800111, 415101000155, 999021000105, 417060800098, 999010900392, 417011100056, 
		999850102187, 415001100233, 415021000677, 395000201248, 396050801803, 396060300721, 999010800193, 
		999011100209, 999050700159, 396050103651, 999081100109, 999971200038, 999850104571, 999981000304, 
		999990200138, 999021100169, 999070900201, 999990800119, 999981000282, 999000500400, 999090700151,
		415031000411, 999000400367, 999111100168, 999021200147, 396080702214, 395081000098, 415021000596, 
		999991100129, 415060200136, 417020900201, 415051200247, 398940420281, 415021100191, 415040900085, 
		999000600595, 999020900218, 999031000243, 999091200039, 999011100161, 395000200977, 392050800381, 
		415050800101, 415160800076, 417021000238, 999050800404, 999100700091, 999850104562, 417140500516,
		390050800337, 415150400053, 999000500426, 999140100380, 999150400225, 415140500068, 999130800383,
		407161001018, 999010700148, 396140101703, 396140500543, 777000501774)
	ORDER BY a.periodo_fin ASC, MONTHNAME(a.periodo_fin) ASC)
	ON DUPLICATE KEY UPDATE idservicio_hm_x_mepo = VALUES(idservicio_hm_x_mepo),
	cuenta_hm_x_mepo = VALUES(cuenta_hm_x_mepo), dependencia_hm_x_mepo = VALUES(dependencia_hm_x_mepo),
	fecha_hm_x_mepo = VALUES(fecha_hm_x_mepo), mes_hm_x_mepo = VALUES(mes_hm_x_mepo),
    consumo_hm_x_mepo = VALUES(consumo_hm_x_mepo), costo_hm_x_mepo = VALUES(costo_hm_x_mepo)");

	$this->db->query(
		"INSERT INTO temp_hm_1 
		SELECT CONCAT(idservicio_hm_x_mepo),
		CONCAT(cuenta_hm_x_mepo),
		CONCAT(dependencia_hm_x_mepo),
		CONCAT(YEAR(fecha_hm_x_mepo)),
		CASE WHEN mes_hm_x_mepo= 'January' THEN consumo_hm_x_mepo END,
		CASE WHEN mes_hm_x_mepo= 'February' THEN consumo_hm_x_mepo END,
		CASE WHEN mes_hm_x_mepo= 'March' THEN consumo_hm_x_mepo END,
		CASE WHEN mes_hm_x_mepo= 'April' THEN consumo_hm_x_mepo END,
		CASE WHEN mes_hm_x_mepo= 'May' THEN consumo_hm_x_mepo END,
		CASE WHEN mes_hm_x_mepo= 'June' THEN consumo_hm_x_mepo END,
		CASE WHEN mes_hm_x_mepo= 'July' THEN consumo_hm_x_mepo END,
		CASE WHEN mes_hm_x_mepo= 'August' THEN consumo_hm_x_mepo END,
		CASE WHEN mes_hm_x_mepo= 'September' THEN consumo_hm_x_mepo END,
		CASE WHEN mes_hm_x_mepo= 'October' THEN consumo_hm_x_mepo END,
		CASE WHEN mes_hm_x_mepo= 'November' THEN consumo_hm_x_mepo END,
		CASE WHEN mes_hm_x_mepo= 'December' THEN consumo_hm_x_mepo END
		FROM  `pdctarifahmgpo_x_mepo`
		WHERE TRUE");

	$this->db->query(
		"INSERT INTO temp_hm_2
		SELECT idservicio_hm_x_mepo_1,
		cuenta_hm_x_mepo_1,
		dependencia_hm_x_mepo_1,
		ano,
		SUM(enero),
		SUM(febrero),
		SUM(marzo),
		SUM(abril),
		SUM(mayo),
		SUM(junio),
		SUM(julio),
		SUM(agosto),
		SUM(septiembre),
		SUM(octubre),
		SUM(noviembre),
		SUM(diciembre)
		FROM temp_hm_1
		GROUP BY idservicio_hm_x_mepo_1 ASC, ano ASC");

	$this->db->query(
		"INSERT INTO `pdc_tar_hm_final_x_mepo`(`id_tar_hm_final_x_mepo`, `cta_tar_hm_final_x_mepo`, 
		`dep_tar_hm_final_x_mepo`, `yer_tar_hm_final_x_mepo`, `Enero`, `Febrero`, `Marzo`, `Abril`, `Mayo`, `Junio`, `Julio`,
		`Agosto`, `Septiembre`, `Octubre`, `Noviembre`, `Diciembre`)
						
		(SELECT  
		idservicio_hm_x_mepo_2,
		cuenta_hm_x_mepo_2,
		dependencia_hm_x_mepo_2,
		ano,
		COALESCE(enero,0) AS Enero,
		COALESCE(febrero,0) AS Febrero,
		COALESCE(marzo,0) AS Marzo,
		COALESCE(abril,0) AS Abril,	
		COALESCE(mayo,0) AS Mayo,
		COALESCE(junio,0) AS Junio,
		COALESCE(julio,0) AS Julio,
		COALESCE(agosto,0) AS Agosto,
		COALESCE(septiembre,0) AS Septiembre,
		COALESCE(octubre,0) AS Octubre,
		COALESCE(noviembre,0) AS Noviembre,
		COALESCE(diciembre,0) AS Diciembre FROM temp_hm_2)
		ON DUPLICATE KEY UPDATE id_tar_hm_final_x_mepo = VALUES(id_tar_hm_final_x_mepo),
		cta_tar_hm_final_x_mepo = VALUES(cta_tar_hm_final_x_mepo), 
		dep_tar_hm_final_x_mepo = VALUES(dep_tar_hm_final_x_mepo),
		yer_tar_hm_final_x_mepo = VALUES(yer_tar_hm_final_x_mepo),
		Enero = VALUES(Enero), Febrero = VALUES(Febrero), Marzo = VALUES(Marzo), Abril = VALUES(Abril),
		Mayo = VALUES(Mayo), Junio = VALUES(Junio), Julio = VALUES(Julio), Agosto = VALUES(Agosto),
		Septiembre = VALUES(Septiembre), Octubre = VALUES(Octubre), Noviembre = VALUES(Noviembre),
		Diciembre = VALUES(Diciembre)");

	$this->db->trans_complete();
}
//*************************************FIN DE LA TRANSACCION*************************************//

//ELIMINA LAS TABLAS PARA GENERAR NUEVOS DATOS//
function droper_hm_final()
{
	$this->db->query("DROP TABLE pdctarifahmgpo_x_mepo;");
	$this->db->query("DROP TABLE temp_hm_1;");
	$this->db->query("DROP TABLE temp_hm_2;");
	$this->db->query("DROP TABLE pdc_tar_hm_final_x_mepo;");
}


//*********************************MODELO CARGADOR COMBOBOX DEPENDENCIAS TARIFA HM FINAL*********************************//
function dep_hm_final()
{
	
	$this->db->order_by('dep_tar_hm_final_x_mepo', 'asc');
	$this->db->group_by('dep_tar_hm_final_x_mepo');
	$query = $this->db->get('pdc_tar_hm_final_x_mepo');
	if($query->num_rows()>0) {
		foreach($query->result() as $row) {
			$dep_tar_hm_final_x_mepo[$row->id] = $row;
			
		}
		return $dep_tar_hm_final_x_mepo;

	}
}




function dep_hm_final_resultado()
{
	$dep_tar_hm_final_x_mepo = $this->input->post("dep_tar_hm_final_x_mepo");
	//MANDA RESULTADOS SI SE SELECCIONA LA DEPENDENCIA//
	if(!empty($dep_tar_hm_final_x_mepo))
	{
		$this->db->where('dep_tar_hm_final_x_mepo', $dep_tar_hm_final_x_mepo);
		$this->db->order_by('yer_tar_hm_final_x_mepo', 'asc');
		$query = $this->db->get('pdc_tar_hm_final_x_mepo');
				
			if ($query->num_rows()>0)
			{
				foreach($query->result() as $row)
				{
					$yer_tar_hm_final_x_mepo[$row->id] = $row;
				}
				return $yer_tar_hm_final_x_mepo;
			}
			else return false;
	}

}



////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//Realiza la sumatoria del consumo, dependiendo del mes en la vista tar_hm_final_x_mepo TARIFA HM
function EneroTotalHM($dep_tar_hm_final_x_mepo)
{


	if(!empty($dep_tar_hm_final_x_mepo))
	{
		$this->db->where('dep_tar_hm_final_x_mepo', $dep_tar_hm_final_x_mepo);
		$this->db->select_sum('Enero');
		$query = $this->db->get('pdc_tar_hm_final_x_mepo');
		$result = $query->row()->Enero;
		return $result;
	}

}

function FebreroTotalHM($dep_tar_hm_final_x_mepo)
{


	if(!empty($dep_tar_hm_final_x_mepo))
	{
		$this->db->where('dep_tar_hm_final_x_mepo', $dep_tar_hm_final_x_mepo);
		$this->db->select_sum('Febrero');
		$query = $this->db->get('pdc_tar_hm_final_x_mepo');
		$result = $query->row()->Febrero;
		return $result;
	}

}

function MarzoTotalHM($dep_tar_hm_final_x_mepo)
{


	if(!empty($dep_tar_hm_final_x_mepo))
	{
		$this->db->where('dep_tar_hm_final_x_mepo', $dep_tar_hm_final_x_mepo);
		$this->db->select_sum('Marzo');
		$query = $this->db->get('pdc_tar_hm_final_x_mepo');
		$result = $query->row()->Marzo;
		return $result;
	}

}

function AbrilTotalHM($dep_tar_hm_final_x_mepo)
{


	if(!empty($dep_tar_hm_final_x_mepo))
	{
		$this->db->where('dep_tar_hm_final_x_mepo', $dep_tar_hm_final_x_mepo);
		$this->db->select_sum('Abril');
		$query = $this->db->get('pdc_tar_hm_final_x_mepo');
		$result = $query->row()->Abril;
		return $result;
	}

}

function MayoTotalHM($dep_tar_hm_final_x_mepo)
{


	if(!empty($dep_tar_hm_final_x_mepo))
	{
		$this->db->where('dep_tar_hm_final_x_mepo', $dep_tar_hm_final_x_mepo);
		$this->db->select_sum('Mayo');
		$query = $this->db->get('pdc_tar_hm_final_x_mepo');
		$result = $query->row()->Mayo;
		return $result;
	}

}

function JunioTotalHM($dep_tar_hm_final_x_mepo)
{


	if(!empty($dep_tar_hm_final_x_mepo))
	{
		$this->db->where('dep_tar_hm_final_x_mepo', $dep_tar_hm_final_x_mepo);
		$this->db->select_sum('Junio');
		$query = $this->db->get('pdc_tar_hm_final_x_mepo');
		$result = $query->row()->Junio;
		return $result;
	}

}

function JulioTotalHM($dep_tar_hm_final_x_mepo)
{


	if(!empty($dep_tar_hm_final_x_mepo))
	{
		$this->db->where('dep_tar_hm_final_x_mepo', $dep_tar_hm_final_x_mepo);
		$this->db->select_sum('Julio');
		$query = $this->db->get('pdc_tar_hm_final_x_mepo');
		$result = $query->row()->Julio;
		return $result;
	}

}

function AgostoTotalHM($dep_tar_hm_final_x_mepo)
{


	if(!empty($dep_tar_hm_final_x_mepo))
	{
		$this->db->where('dep_tar_hm_final_x_mepo', $dep_tar_hm_final_x_mepo);
		$this->db->select_sum('Agosto');
		$query = $this->db->get('pdc_tar_hm_final_x_mepo');
		$result = $query->row()->Agosto;
		return $result;
	}

}

function SeptiembreTotalHM($dep_tar_hm_final_x_mepo)
{


	if(!empty($dep_tar_hm_final_x_mepo))
	{
		$this->db->where('dep_tar_hm_final_x_mepo', $dep_tar_hm_final_x_mepo);
		$this->db->select_sum('Septiembre');
		$query = $this->db->get('pdc_tar_hm_final_x_mepo');
		$result = $query->row()->Septiembre;
		return $result;
	}

}

function OctubreTotalHM($dep_tar_hm_final_x_mepo)
{


	if(!empty($dep_tar_hm_final_x_mepo))
	{
		$this->db->where('dep_tar_hm_final_x_mepo', $dep_tar_hm_final_x_mepo);
		$this->db->select_sum('Octubre');
		$query = $this->db->get('pdc_tar_hm_final_x_mepo');
		$result = $query->row()->Octubre;
		return $result;
	}

}

function NoviembreTotalHM($dep_tar_hm_final_x_mepo)
{


	if(!empty($dep_tar_hm_final_x_mepo))
	{
		$this->db->where('dep_tar_hm_final_x_mepo', $dep_tar_hm_final_x_mepo);
		$this->db->select_sum('Noviembre');
		$query = $this->db->get('pdc_tar_hm_final_x_mepo');
		$result = $query->row()->Noviembre;
		return $result;
	}

}

function DiciembreTotalHM($dep_tar_hm_final_x_mepo)
{


	if(!empty($dep_tar_hm_final_x_mepo))
	{
		$this->db->where('dep_tar_hm_final_x_mepo', $dep_tar_hm_final_x_mepo);
		$this->db->select_sum('Diciembre');
		$query = $this->db->get('pdc_tar_hm_final_x_mepo');
		$result = $query->row()->Diciembre;
		return $result;
	}

}
/***************************************************************************************************************************/

/***************************************************************************************************************************/

//CREA LAS TABLAS DE pdctarifaomgpo_x_mepo, temp_om_1, temp_om_2 y pdc_tar_om_final_x_mepo. TAMBIEN HACE LA INSERCION DE DATOS CORRESPONDIENTES A LAS MISMAS//
function taromfinaltransact()
{
	$this->db->trans_start();
	$tabla1= "CREATE TABLE IF NOT EXISTS `pdctarifaomgpo_x_mepo` (`id` INT NOT NULL AUTO_INCREMENT,
				`idservicio_om_x_mepo` FLOAT NOT NULL, `cuenta_om_x_mepo` VARCHAR(100) NOT NULL,
				`dependencia_om_x_mepo` VARCHAR(55) NOT NULL , `fecha_om_x_mepo` VARCHAR(15) NOT NULL,
				`mes_om_x_mepo` VARCHAR(15) NOT NULL, `consumo_om_x_mepo` DECIMAL(30,2) NOT NULL,
			    `costo_om_x_mepo` DECIMAL(30,2) NOT NULL, PRIMARY KEY (`id`),
			    UNIQUE `consuom` (`id`))  ENGINE = InnoDB";

	$tabla2= "CREATE TABLE IF NOT EXISTS `temp_om_1` (`idservicio_om_x_mepo_1` INT, `cuenta_om_x_mepo_1` VARCHAR(100) NOT NULL,
	`dependencia_om_x_mepo_1` VARCHAR(100), `ano` INT, `enero` FLOAT, `febrero` FLOAT, `marzo` FLOAT, `abril` FLOAT, `mayo` FLOAT, `junio` FLOAT,
	`julio` FLOAT, `agosto` FLOAT, `septiembre` FLOAT, `octubre` FLOAT, `noviembre` FLOAT, `diciembre` FLOAT)";

	$tabla3= "CREATE TABLE IF NOT EXISTS `temp_om_2` (`idservicio_om_x_mepo_2` INT, `cuenta_om_x_mepo_2` VARCHAR(100) NOT NULL,
	`dependencia_om_x_mepo_2` VARCHAR(100), `ano` INT, `enero` FLOAT, `febrero` FLOAT , `marzo` FLOAT, `abril` FLOAT, `mayo` FLOAT, `junio` FLOAT,
	`julio` FLOAT, `agosto` FLOAT, `septiembre` FLOAT, `octubre` FLOAT, `noviembre` FLOAT, `diciembre` FLOAT)";

	$tabla4= "CREATE TABLE IF NOT EXISTS `pdc_tar_om_final_x_mepo`  (`id` INT NOT NULL AUTO_INCREMENT ,
				`id_tar_om_final_x_mepo` INT(20) NULL, `cta_tar_om_final_x_mepo` VARCHAR(100) NOT NULL,
				`dep_tar_om_final_x_mepo` VARCHAR(55) NOT NULL,  `yer_tar_om_final_x_mepo` YEAR NOT NULL,
			    `Enero` INT(30) NOT NULL, `Febrero` INT(30) NOT NULL, `Marzo` INT(30) NOT NULL, `Abril` INT(30) NOT NULL,
                `Mayo` INT(30) NOT NULL, `Junio` INT(30) NOT NULL, `Julio` INT(30) NOT NULL, `Agosto` INT(30) NOT NULL,
                `Septiembre` INT(30) NOT NULL, `Octubre` INT(30) NOT NULL, `Noviembre` INT(30) NOT NULL,
                `Diciembre` INT(30) NOT NULL, PRIMARY KEY (`id`), UNIQUE `eneomfinal` (`id`))  ENGINE = InnoDB";

	$this->db->query($tabla1);
	$this->db->query($tabla2);
	$this->db->query($tabla3);
	$this->db->query($tabla4);
	
	$this->db->query(
		"INSERT INTO `pdctarifaomgpo_x_mepo` (`idservicio_om_x_mepo`, `cuenta_om_x_mepo`, `dependencia_om_x_mepo`,
			`fecha_om_x_mepo`, `mes_om_x_mepo`, `consumo_om_x_mepo`, `costo_om_x_mepo`)
	(SELECT 
    a.servicio,
    b.cuenta,
    b.dependencia,
    a.periodo_fin,
    MONTHNAME(a.periodo_fin),
	CONCAT('', (a.consumo)),
	CONCAT('', (a.costo))
	FROM `pdc_consumo_energia` a
	INNER JOIN `pdc_servicios_energia` b ON a.servicio = b.id
    WHERE a.servicio IS NOT NULL AND a.servicio <> ''
    AND b.cuenta IS NOT NULL AND b.cuenta <> ''
    AND b.dependencia IS NOT NULL AND b.dependencia <> ''
	AND a.periodo_fin IS NOT NULL AND a.periodo_fin <> ''
	AND a.consumo IS NOT NULL AND a.consumo <> ''
	AND a.costo IS NOT NULL AND a.costo <> ''
	AND a.servicio <> '192'
	AND (YEAR(a.periodo_fin) >= 2011 AND YEAR(a.periodo_fin) <=YEAR(NOW()))
	AND b.cuenta IN(
	396040910141, 396041201186, 396041201194, 396750301283, 888001105010, 403070900499, 414850702330, 379850802831,
	396020302349, 392950800220, 400070502109, 399110500483, 390871201164, 401950705790, 389860700250, 395750300531,
	372850200526, 888850801011, 385850900158, 398990810609, 379970402569, 407121200891, 396091100402, 379850802792,
	79040402933, 379040402941, 373980303692, 407120301449, 373850401145)
	ORDER BY a.periodo_fin ASC, MONTHNAME(a.periodo_fin) ASC)
	ON DUPLICATE KEY UPDATE idservicio_om_x_mepo = VALUES(idservicio_om_x_mepo),
	cuenta_om_x_mepo = VALUES(cuenta_om_x_mepo), dependencia_om_x_mepo = VALUES(dependencia_om_x_mepo),
	fecha_om_x_mepo = VALUES(fecha_om_x_mepo), mes_om_x_mepo = VALUES(mes_om_x_mepo),
    consumo_om_x_mepo = VALUES(consumo_om_x_mepo), costo_om_x_mepo = VALUES(costo_om_x_mepo)");

	$this->db->query(
		"INSERT INTO temp_om_1 
		SELECT CONCAT(idservicio_om_x_mepo),
		CONCAT(cuenta_om_x_mepo),
		CONCAT(dependencia_om_x_mepo),
		CONCAT(YEAR(fecha_om_x_mepo)),
		CASE WHEN mes_om_x_mepo= 'January' THEN consumo_om_x_mepo END,
		CASE WHEN mes_om_x_mepo= 'February' THEN consumo_om_x_mepo END,
		CASE WHEN mes_om_x_mepo= 'March' THEN consumo_om_x_mepo END,
		CASE WHEN mes_om_x_mepo= 'April' THEN consumo_om_x_mepo END,
		CASE WHEN mes_om_x_mepo= 'May' THEN consumo_om_x_mepo END,
		CASE WHEN mes_om_x_mepo= 'June' THEN consumo_om_x_mepo END,
		CASE WHEN mes_om_x_mepo= 'July' THEN consumo_om_x_mepo END,
		CASE WHEN mes_om_x_mepo= 'August' THEN consumo_om_x_mepo END,
		CASE WHEN mes_om_x_mepo= 'September' THEN consumo_om_x_mepo END,
		CASE WHEN mes_om_x_mepo= 'October' THEN consumo_om_x_mepo END,
		CASE WHEN mes_om_x_mepo= 'November' THEN consumo_om_x_mepo END,
		CASE WHEN mes_om_x_mepo= 'December' THEN consumo_om_x_mepo END
		FROM  `pdctarifaomgpo_x_mepo`
		WHERE TRUE");

	$this->db->query(
		"INSERT INTO temp_om_2
		SELECT idservicio_om_x_mepo_1,
		cuenta_om_x_mepo_1,
		dependencia_om_x_mepo_1,
		ano,
		SUM(enero),
		SUM(febrero),
		SUM(marzo),
		SUM(abril),
		SUM(mayo),
		SUM(junio),
		SUM(julio),
		SUM(agosto),
		SUM(septiembre),
		SUM(octubre),
		SUM(noviembre),
		SUM(diciembre)
		FROM temp_om_1
		GROUP BY idservicio_om_x_mepo_1 ASC, ano ASC");

	$this->db->query(
		"INSERT INTO `pdc_tar_om_final_x_mepo`(`id_tar_om_final_x_mepo`, `cta_tar_om_final_x_mepo`, 
		`dep_tar_om_final_x_mepo`, `yer_tar_om_final_x_mepo`, `Enero`, `Febrero`, `Marzo`, `Abril`, `Mayo`, `Junio`, `Julio`,
		`Agosto`, `Septiembre`, `Octubre`, `Noviembre`, `Diciembre`)
						
		(SELECT 
		idservicio_om_x_mepo_2,
		cuenta_om_x_mepo_2,
		dependencia_om_x_mepo_2,
		ano,
		COALESCE(enero,0) AS Enero,
		COALESCE(febrero,0) AS Febrero,
		COALESCE(marzo,0) AS Marzo,
		COALESCE(abril,0) AS Abril,	
		COALESCE(mayo,0) AS Mayo,
		COALESCE(junio,0) AS Junio,
		COALESCE(julio,0) AS Julio,
		COALESCE(agosto,0) AS Agosto,
		COALESCE(septiembre,0) AS Septiembre,
		COALESCE(octubre,0) AS Octubre,
		COALESCE(noviembre,0) AS Noviembre,
		COALESCE(diciembre,0) AS Diciembre FROM temp_om_2)
		ON DUPLICATE KEY UPDATE id_tar_om_final_x_mepo = VALUES(id_tar_om_final_x_mepo),
		cta_tar_om_final_x_mepo = VALUES(cta_tar_om_final_x_mepo), 
		dep_tar_om_final_x_mepo = VALUES(dep_tar_om_final_x_mepo),
		yer_tar_om_final_x_mepo = VALUES(yer_tar_om_final_x_mepo),
		Enero = VALUES(Enero), Febrero = VALUES(Febrero), Marzo = VALUES(Marzo), Abril = VALUES(Abril),
		Mayo = VALUES(Mayo), Junio = VALUES(Junio), Julio = VALUES(Julio), Agosto = VALUES(Agosto),
		Septiembre = VALUES(Septiembre), Octubre = VALUES(Octubre), Noviembre = VALUES(Noviembre),
		Diciembre = VALUES(Diciembre)");
	$this->db->trans_complete();
}
//*************************************FIN DE LA TRANSACCION*************************************//

//ELIMINA LAS TABLAS PARA GENERAR NUEVOS DATOS//
function droper_om_final()
{
	$this->db->query("DROP TABLE  pdctarifaomgpo_x_mepo;");
	$this->db->query("DROP TABLE  temp_om_1;");
	$this->db->query("DROP TABLE  temp_om_2;");
	$this->db->query("DROP TABLE  pdc_tar_om_final_x_mepo;");
}


//*********************************MODELO CARGADOR COMBOBOX DEPENDENCIAS TARIFA OM FINAL*********************************//
function dep_om_final()
{
	
	$this->db->order_by('dep_tar_om_final_x_mepo', 'asc');
	$this->db->group_by('dep_tar_om_final_x_mepo');
	$query = $this->db->get('pdc_tar_om_final_x_mepo');
	if($query->num_rows()>0) {
		foreach($query->result() as $row) {
			$dep_tar_om_final_x_mepo[$row->id] = $row;
			
		}
		return $dep_tar_om_final_x_mepo;

	}
}




function dep_om_final_resultado()
{
	$dep_tar_om_final_x_mepo = $this->input->post("dep_tar_om_final_x_mepo");
	//MANDA RESULTADOS SI SE SELECCIONA LA DEPENDENCIA//
	if(!empty($dep_tar_om_final_x_mepo))
	{
		$this->db->where('dep_tar_om_final_x_mepo', $dep_tar_om_final_x_mepo);
		$this->db->order_by('yer_tar_om_final_x_mepo', 'asc');
		$query = $this->db->get('pdc_tar_om_final_x_mepo');
				
			if ($query->num_rows()>0)
			{
				foreach($query->result() as $row)
				{
					$yer_tar_om_final_x_mepo[$row->id] = $row;
				}
				return $yer_tar_om_final_x_mepo;
			}
			else return false;
	}

}



////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//Realiza la sumatoria del consumo, dependiendo del mes en la vista tar_om_final_x_mepo TARIFA OM
function EneroTotalOM($dep_tar_om_final_x_mepo)
{


	if(!empty($dep_tar_om_final_x_mepo))
	{
		$this->db->where('dep_tar_om_final_x_mepo', $dep_tar_om_final_x_mepo);
		$this->db->select_sum('Enero');
		$query = $this->db->get('pdc_tar_om_final_x_mepo');
		$result = $query->row()->Enero;
		return $result;
	}

}

function FebreroTotalOM($dep_tar_om_final_x_mepo)
{


	if(!empty($dep_tar_om_final_x_mepo))
	{
		$this->db->where('dep_tar_om_final_x_mepo', $dep_tar_om_final_x_mepo);
		$this->db->select_sum('Febrero');
		$query = $this->db->get('pdc_tar_om_final_x_mepo');
		$result = $query->row()->Febrero;
		return $result;
	}

}

function MarzoTotalOM($dep_tar_om_final_x_mepo)
{


	if(!empty($dep_tar_om_final_x_mepo))
	{
		$this->db->where('dep_tar_om_final_x_mepo', $dep_tar_om_final_x_mepo);
		$this->db->select_sum('Marzo');
		$query = $this->db->get('pdc_tar_om_final_x_mepo');
		$result = $query->row()->Marzo;
		return $result;
	}

}

function AbrilTotalOM($dep_tar_om_final_x_mepo)
{


	if(!empty($dep_tar_om_final_x_mepo))
	{
		$this->db->where('dep_tar_om_final_x_mepo', $dep_tar_om_final_x_mepo);
		$this->db->select_sum('Abril');
		$query = $this->db->get('pdc_tar_om_final_x_mepo');
		$result = $query->row()->Abril;
		return $result;
	}

}

function MayoTotalOM($dep_tar_om_final_x_mepo)
{


	if(!empty($dep_tar_om_final_x_mepo))
	{
		$this->db->where('dep_tar_om_final_x_mepo', $dep_tar_om_final_x_mepo);
		$this->db->select_sum('Mayo');
		$query = $this->db->get('pdc_tar_om_final_x_mepo');
		$result = $query->row()->Mayo;
		return $result;
	}

}

function JunioTotalOM($dep_tar_om_final_x_mepo)
{


	if(!empty($dep_tar_om_final_x_mepo))
	{
		$this->db->where('dep_tar_om_final_x_mepo', $dep_tar_om_final_x_mepo);
		$this->db->select_sum('Junio');
		$query = $this->db->get('pdc_tar_om_final_x_mepo');
		$result = $query->row()->Junio;
		return $result;
	}

}

function JulioTotalOM($dep_tar_om_final_x_mepo)
{


	if(!empty($dep_tar_om_final_x_mepo))
	{
		$this->db->where('dep_tar_om_final_x_mepo', $dep_tar_om_final_x_mepo);
		$this->db->select_sum('Julio');
		$query = $this->db->get('pdc_tar_om_final_x_mepo');
		$result = $query->row()->Julio;
		return $result;
	}

}

function AgostoTotalOM($dep_tar_om_final_x_mepo)
{


	if(!empty($dep_tar_om_final_x_mepo))
	{
		$this->db->where('dep_tar_om_final_x_mepo', $dep_tar_om_final_x_mepo);
		$this->db->select_sum('Agosto');
		$query = $this->db->get('pdc_tar_om_final_x_mepo');
		$result = $query->row()->Agosto;
		return $result;
	}

}

function SeptiembreTotalOM($dep_tar_om_final_x_mepo)
{


	if(!empty($dep_tar_om_final_x_mepo))
	{
		$this->db->where('dep_tar_om_final_x_mepo', $dep_tar_om_final_x_mepo);
		$this->db->select_sum('Septiembre');
		$query = $this->db->get('pdc_tar_om_final_x_mepo');
		$result = $query->row()->Septiembre;
		return $result;
	}

}

function OctubreTotalOM($dep_tar_om_final_x_mepo)
{


	if(!empty($dep_tar_om_final_x_mepo))
	{
		$this->db->where('dep_tar_om_final_x_mepo', $dep_tar_om_final_x_mepo);
		$this->db->select_sum('Octubre');
		$query = $this->db->get('pdc_tar_om_final_x_mepo');
		$result = $query->row()->Octubre;
		return $result;
	}

}

function NoviembreTotalOM($dep_tar_om_final_x_mepo)
{


	if(!empty($dep_tar_om_final_x_mepo))
	{
		$this->db->where('dep_tar_om_final_x_mepo', $dep_tar_om_final_x_mepo);
		$this->db->select_sum('Noviembre');
		$query = $this->db->get('pdc_tar_om_final_x_mepo');
		$result = $query->row()->Noviembre;
		return $result;
	}

}

function DiciembreTotalOM($dep_tar_om_final_x_mepo)
{


	if(!empty($dep_tar_om_final_x_mepo))
	{
		$this->db->where('dep_tar_om_final_x_mepo', $dep_tar_om_final_x_mepo);
		$this->db->select_sum('Diciembre');
		$query = $this->db->get('pdc_tar_om_final_x_mepo');
		$result = $query->row()->Diciembre;
		return $result;
	}

}
/***************************************************************************************************************************/
/*****************************************************************************************************/
//CREA LAS TABLAS DE pdcaguagpo_x_mepo, temp_agua_1, temp_agua_2 y pdc_agua_final_x_mepo//
// TAMBIEN HACE LA INSERCION DE DATOS CORRESPONDIENTES A LAS MISMAS//
function taraguafinaltransact()
{
	$this->db->trans_start();
	$tabla1= 
	"CREATE TABLE IF NOT EXISTS `pdcaguagpo_x_mepo` (`id` INT NOT NULL AUTO_INCREMENT,
				`idservicio_agua_x_mepo` FLOAT NOT NULL, `cuenta_agua_x_mepo` VARCHAR(100) NOT NULL,
				`dependencia_agua_x_mepo` VARCHAR(55) NOT NULL , `fecha_agua_x_mepo` VARCHAR(15) NOT NULL,
				`mes_agua_x_mepo` VARCHAR(15) NOT NULL, `consumo_agua_x_mepo` DECIMAL(30,2) NOT NULL,
			    `costo_agua_x_mepo` DECIMAL(30,2) NOT NULL, PRIMARY KEY (`id`), UNIQUE `consuagua` (`id`))  ENGINE = InnoDB";

	$tabla2= 
	"CREATE TABLE IF NOT EXISTS `temp_agua_1` (`idservicio_agua_x_mepo_1` INT, `cuenta_agua_x_mepo_1` VARCHAR(100) NOT NULL,
	`dependencia_agua_x_mepo_1` VARCHAR(100), `ano` INT, `enero` FLOAT, `febrero` FLOAT, `marzo` FLOAT, `abril` FLOAT, `mayo` FLOAT, `junio` FLOAT,
	`julio` FLOAT, `agosto` FLOAT, `septiembre` FLOAT, `octubre` FLOAT, `noviembre` FLOAT, `diciembre` FLOAT)";

	$tabla3= 
	"CREATE TABLE IF NOT EXISTS `temp_agua_2` (`idservicio_agua_x_mepo_2` INT, `cuenta_agua_x_mepo_2` VARCHAR(100) NOT NULL,
	`dependencia_agua_x_mepo_2` VARCHAR(100), `ano` INT, `enero` FLOAT, `febrero` FLOAT , `marzo` FLOAT, `abril` FLOAT, `mayo` FLOAT, `junio` FLOAT,
	`julio` FLOAT, `agosto` FLOAT, `septiembre` FLOAT, `octubre` FLOAT, `noviembre` FLOAT, `diciembre` FLOAT)";

	$tabla4= 
	"CREATE TABLE IF NOT EXISTS `pdc_agua_final_x_mepo`  (`id` INT NOT NULL AUTO_INCREMENT,
				`id_agua_final_x_mepo` INT(20) NULL, `cta_agua_final_x_mepo` VARCHAR(100) NOT NULL,
				`dep_agua_final_x_mepo` VARCHAR(55) NOT NULL,  `yer_agua_final_x_mepo` YEAR NOT NULL,
			    `Enero` INT(30) NOT NULL, `Febrero` INT(30) NOT NULL, `Marzo` INT(30) NOT NULL, `Abril` INT(30) NOT NULL,
                `Mayo` INT(30) NOT NULL, `Junio` INT(30) NOT NULL, `Julio` INT(30) NOT NULL, `Agosto` INT(30) NOT NULL,
                `Septiembre` INT(30) NOT NULL, `Octubre` INT(30) NOT NULL, `Noviembre` INT(30) NOT NULL,
                `Diciembre` INT(30) NOT NULL, PRIMARY KEY (`id`), UNIQUE `eneaguafinal` (`id`))  ENGINE = InnoDB";

	$this->db->query($tabla1);
	$this->db->query($tabla2);
	$this->db->query($tabla3);
	$this->db->query($tabla4);
	
	$this->db->query(
		"INSERT INTO `pdcaguagpo_x_mepo` (`idservicio_agua_x_mepo`, `cuenta_agua_x_mepo`, `dependencia_agua_x_mepo`,
			`fecha_agua_x_mepo`, `mes_agua_x_mepo`, `consumo_agua_x_mepo`, `costo_agua_x_mepo`)
	(SELECT 
    a.servicio,
    b.cuenta,
    b.dependencia,
    a.periodo_fin,
    MONTHNAME(a.periodo_fin),
	CONCAT('', (a.consumo)),
	CONCAT('', (a.costo))
	FROM `pdc_consumo_agua` a
	INNER JOIN `pdc_servicios_agua` b ON a.servicio = b.id
    WHERE a.servicio IS NOT NULL AND a.servicio <> ''
    AND b.cuenta IS NOT NULL AND b.cuenta <> ''
    AND b.dependencia IS NOT NULL AND b.dependencia <> ''
	AND a.periodo_fin IS NOT NULL AND a.periodo_fin <> ''
	AND a.consumo IS NOT NULL AND a.consumo <> ''
	AND a.costo IS NOT NULL AND a.costo <> ''
	AND (YEAR(a.periodo_fin) >= 2011 AND YEAR(a.periodo_fin) <=YEAR(NOW()))
	AND b.cuenta IN(
'5095287-01', '4001387-01', '5083545-01', '4001384-01', '4001380-01', '3042615-01', '4001376-01', 
'4001379-01', '4001361-01', '4001360-01', '4001350-01', '4001355-01', '4001377-01', '4001352-01', 
'4001369-01', '4001370-01', '4001381-01', '4001382-01', '4001353-01', '4001378-01', '4001374-01', 
'4001375-01', '4001372-01', '4001364-01', '4001385-01', '4001365-01', '4001358-01', '4001386-01', 
'5054175-01', '4001356-01', '4001357-01', '4001359-01', '4001349-01', '4001366-01', '4001383-01', 
'4001388-01', '4001368-01', '4001351-01', '4001371-01', '4001373-01', '4001367-01', '4001362-01', 
'4001354-01', '4001363-01', '5154180-01', '5334385-01', '5392402-01', '5333427-01', '5359776-01', 
'5359775-01', '5429702-01', '5429707-01', '3000851-01', '3189793-01', '3189407-01', '3308474-01',
'5229225-01', '3278962-01', '3307616-01', '3223085-01', '3271191-01', '5585177-01', '5599044-01', 
'5589733-01', '2061407-01', '3309696-01', '3291356-01', '5669793-01', '3225062-01', '5888506-01', 
'4002997-01', '2007810-01', '4002945-01', '3308473-01', '5785502-02', '5939017-01', '6183766-01')
	ORDER BY a.periodo_fin ASC, MONTHNAME(a.periodo_fin) ASC)
	ON DUPLICATE KEY UPDATE idservicio_agua_x_mepo = VALUES(idservicio_agua_x_mepo),
	cuenta_agua_x_mepo = VALUES(cuenta_agua_x_mepo), dependencia_agua_x_mepo = VALUES(dependencia_agua_x_mepo),
	fecha_agua_x_mepo = VALUES(fecha_agua_x_mepo), mes_agua_x_mepo = VALUES(mes_agua_x_mepo),
    consumo_agua_x_mepo = VALUES(consumo_agua_x_mepo), costo_agua_x_mepo = VALUES(costo_agua_x_mepo)");

	$this->db->query(
		"INSERT INTO temp_agua_1 
		SELECT CONCAT(idservicio_agua_x_mepo),
		CONCAT(cuenta_agua_x_mepo),
		CONCAT(dependencia_agua_x_mepo),
		CONCAT(YEAR(fecha_agua_x_mepo)),
		CASE WHEN mes_agua_x_mepo= 'January' THEN consumo_agua_x_mepo END,
		CASE WHEN mes_agua_x_mepo= 'February' THEN consumo_agua_x_mepo END,
		CASE WHEN mes_agua_x_mepo= 'March' THEN consumo_agua_x_mepo END,
		CASE WHEN mes_agua_x_mepo= 'April' THEN consumo_agua_x_mepo END,
		CASE WHEN mes_agua_x_mepo= 'May' THEN consumo_agua_x_mepo END,
		CASE WHEN mes_agua_x_mepo= 'June' THEN consumo_agua_x_mepo END,
		CASE WHEN mes_agua_x_mepo= 'July' THEN consumo_agua_x_mepo END,
		CASE WHEN mes_agua_x_mepo= 'August' THEN consumo_agua_x_mepo END,
		CASE WHEN mes_agua_x_mepo= 'September' THEN consumo_agua_x_mepo END,
		CASE WHEN mes_agua_x_mepo= 'October' THEN consumo_agua_x_mepo END,
		CASE WHEN mes_agua_x_mepo= 'November' THEN consumo_agua_x_mepo END,
		CASE WHEN mes_agua_x_mepo= 'December' THEN consumo_agua_x_mepo END
		FROM  `pdcaguagpo_x_mepo`
		WHERE TRUE");

	$this->db->query(
		"INSERT INTO temp_agua_2
		SELECT idservicio_agua_x_mepo_1,
		cuenta_agua_x_mepo_1,
		dependencia_agua_x_mepo_1,
		ano,
		SUM(enero),
		SUM(febrero),
		SUM(marzo),
		SUM(abril),
		SUM(mayo),
		SUM(junio),
		SUM(julio),
		SUM(agosto),
		SUM(septiembre),
		SUM(octubre),
		SUM(noviembre),
		SUM(diciembre)
		FROM temp_agua_1
		GROUP BY idservicio_agua_x_mepo_1 ASC, ano ASC");

	$this->db->query(
		"INSERT INTO `pdc_agua_final_x_mepo`(`id_agua_final_x_mepo`, `cta_agua_final_x_mepo`, 
		`dep_agua_final_x_mepo`, `yer_agua_final_x_mepo`, `Enero`, `Febrero`, `Marzo`, `Abril`, 
		`Mayo`, `Junio`, `Julio`, `Agosto`, `Septiembre`, `Octubre`, `Noviembre`, `Diciembre`)
						
		(SELECT 
		idservicio_agua_x_mepo_2,
		cuenta_agua_x_mepo_2,
		dependencia_agua_x_mepo_2,
		ano,
		COALESCE(enero,0) AS Enero,
		COALESCE(febrero,0) AS Febrero,
		COALESCE(marzo,0) AS Marzo,
		COALESCE(abril,0) AS Abril,	
		COALESCE(mayo,0) AS Mayo,
		COALESCE(junio,0) AS Junio,
		COALESCE(julio,0) AS Julio,
		COALESCE(agosto,0) AS Agosto,
		COALESCE(septiembre,0) AS Septiembre,
		COALESCE(octubre,0) AS Octubre,
		COALESCE(noviembre,0) AS Noviembre,
		COALESCE(diciembre,0) AS Diciembre FROM temp_agua_2)
		ON DUPLICATE KEY UPDATE id_agua_final_x_mepo = VALUES(id_agua_final_x_mepo),
		cta_agua_final_x_mepo = VALUES(cta_agua_final_x_mepo), 
		dep_agua_final_x_mepo = VALUES(dep_agua_final_x_mepo),
		yer_agua_final_x_mepo = VALUES(yer_agua_final_x_mepo),
		Enero = VALUES(Enero), Febrero = VALUES(Febrero), Marzo = VALUES(Marzo), Abril = VALUES(Abril),
		Mayo = VALUES(Mayo), Junio = VALUES(Junio), Julio = VALUES(Julio), Agosto = VALUES(Agosto),
		Septiembre = VALUES(Septiembre), Octubre = VALUES(Octubre), Noviembre = VALUES(Noviembre),
		Diciembre = VALUES(Diciembre)");
	$this->db->trans_complete();
}
//*************************************FIN DE LA TRANSACCION*************************************//

//ELIMINA LAS TABLAS PARA GENERAR NUEVOS DATOS//
function droper_agua_final()
{
	$this->db->query("DROP TABLE  pdcaguagpo_x_mepo;");
	$this->db->query("DROP TABLE  temp_agua_1;");
	$this->db->query("DROP TABLE  temp_agua_2;");
	$this->db->query("DROP TABLE  pdc_agua_final_x_mepo;");
}


//**********************MODELO CARGADOR COMBOBOX DEPENDENCIAS AGUA FINAL************************//
function dep_agua_final()
{
	
	$this->db->order_by('dep_agua_final_x_mepo', 'asc');
	$this->db->group_by('dep_agua_final_x_mepo');
	$query = $this->db->get('pdc_agua_final_x_mepo');
	if($query->num_rows()>0) {
		foreach($query->result() as $row) {
			$dep_agua_final_x_mepo[$row->id] = $row;
			
		}
		return $dep_agua_final_x_mepo;

	}
}

//////////////////////////////////////////////////////////////////////////////////

function dep_agua_final_resultado()
{
	$dep_agua_final_x_mepo = $this->input->post("dep_agua_final_x_mepo");
	//MANDA RESULTADOS SI SE SELECCIONA LA DEPENDENCIA//
	if(!empty($dep_agua_final_x_mepo))
	{
		$this->db->where('dep_agua_final_x_mepo', $dep_agua_final_x_mepo);
		$this->db->order_by('yer_agua_final_x_mepo', 'asc');
		$query = $this->db->get('pdc_agua_final_x_mepo');
				
			if ($query->num_rows()>0)
			{
				foreach($query->result() as $row)
				{
					$yer_agua_final_x_mepo[$row->id] = $row;
				}
				return $yer_agua_final_x_mepo;
			}
			else return false;
	}

}



///////////////////////////////////////////////////////////////////////////////////////////////////////

//Realiza la sumatoria del consumo, dependiendo del mes en la vista tar_om_final_x_mepo TARIFA OM
function EneroTotalWT($dep_agua_final_x_mepo)
{


	if(!empty($dep_agua_final_x_mepo))
	{
		$this->db->where('dep_agua_final_x_mepo', $dep_agua_final_x_mepo);
		$this->db->select_sum('Enero');
		$query = $this->db->get('pdc_agua_final_x_mepo');
		$result = $query->row()->Enero;
		return $result;
	}

}

function FebreroTotalWT($dep_agua_final_x_mepo)
{


	if(!empty($dep_agua_final_x_mepo))
	{
		$this->db->where('dep_agua_final_x_mepo', $dep_agua_final_x_mepo);
		$this->db->select_sum('Febrero');
		$query = $this->db->get('pdc_agua_final_x_mepo');
		$result = $query->row()->Febrero;
		return $result;
	}

}

function MarzoTotalWT($dep_agua_final_x_mepo)
{


	if(!empty($dep_agua_final_x_mepo))
	{
		$this->db->where('dep_agua_final_x_mepo', $dep_agua_final_x_mepo);
		$this->db->select_sum('Marzo');
		$query = $this->db->get('pdc_agua_final_x_mepo');
		$result = $query->row()->Marzo;
		return $result;
	}

}

function AbrilTotalWT($dep_agua_final_x_mepo)
{


	if(!empty($dep_agua_final_x_mepo))
	{
		$this->db->where('dep_agua_final_x_mepo', $dep_agua_final_x_mepo);
		$this->db->select_sum('Abril');
		$query = $this->db->get('pdc_agua_final_x_mepo');
		$result = $query->row()->Abril;
		return $result;
	}

}

function MayoTotalWT($dep_agua_final_x_mepo)
{


	if(!empty($dep_agua_final_x_mepo))
	{
		$this->db->where('dep_agua_final_x_mepo', $dep_agua_final_x_mepo);
		$this->db->select_sum('Mayo');
		$query = $this->db->get('pdc_agua_final_x_mepo');
		$result = $query->row()->Mayo;
		return $result;
	}

}

function JunioTotalWT($dep_agua_final_x_mepo)
{


	if(!empty($dep_agua_final_x_mepo))
	{
		$this->db->where('dep_agua_final_x_mepo', $dep_agua_final_x_mepo);
		$this->db->select_sum('Junio');
		$query = $this->db->get('pdc_agua_final_x_mepo');
		$result = $query->row()->Junio;
		return $result;
	}

}

function JulioTotalWT($dep_agua_final_x_mepo)
{


	if(!empty($dep_agua_final_x_mepo))
	{
		$this->db->where('dep_agua_final_x_mepo', $dep_agua_final_x_mepo);
		$this->db->select_sum('Julio');
		$query = $this->db->get('pdc_agua_final_x_mepo');
		$result = $query->row()->Julio;
		return $result;
	}

}

function AgostoTotalWT($dep_agua_final_x_mepo)
{


	if(!empty($dep_agua_final_x_mepo))
	{
		$this->db->where('dep_agua_final_x_mepo', $dep_agua_final_x_mepo);
		$this->db->select_sum('Agosto');
		$query = $this->db->get('pdc_agua_final_x_mepo');
		$result = $query->row()->Agosto;
		return $result;
	}

}

function SeptiembreTotalWT($dep_agua_final_x_mepo)
{


	if(!empty($dep_agua_final_x_mepo))
	{
		$this->db->where('dep_agua_final_x_mepo', $dep_agua_final_x_mepo);
		$this->db->select_sum('Septiembre');
		$query = $this->db->get('pdc_agua_final_x_mepo');
		$result = $query->row()->Septiembre;
		return $result;
	}

}

function OctubreTotalWT($dep_agua_final_x_mepo)
{


	if(!empty($dep_agua_final_x_mepo))
	{
		$this->db->where('dep_agua_final_x_mepo', $dep_agua_final_x_mepo);
		$this->db->select_sum('Octubre');
		$query = $this->db->get('pdc_agua_final_x_mepo');
		$result = $query->row()->Octubre;
		return $result;
	}

}

function NoviembreTotalWT($dep_agua_final_x_mepo)
{


	if(!empty($dep_agua_final_x_mepo))
	{
		$this->db->where('dep_agua_final_x_mepo', $dep_agua_final_x_mepo);
		$this->db->select_sum('Noviembre');
		$query = $this->db->get('pdc_agua_final_x_mepo');
		$result = $query->row()->Noviembre;
		return $result;
	}

}

function DiciembreTotalWT($dep_agua_final_x_mepo)
{


	if(!empty($dep_agua_final_x_mepo))
	{
		$this->db->where('dep_agua_final_x_mepo', $dep_agua_final_x_mepo);
		$this->db->select_sum('Diciembre');
		$query = $this->db->get('pdc_agua_final_x_mepo');
		$result = $query->row()->Diciembre;
		return $result;
	}

}




/*****************************************************************************************************/

/*****************************************************************************************************/
//CREA LAS TABLAS DE pdcgasgpo_x_mepo, temp_gas_1, temp_gas_2 y pdc_gas_final_x_mepo//
// TAMBIEN HACE LA INSERCION DE DATOS CORRESPONDIENTES A LAS MISMAS//
function targasfinaltransact()
{
	$this->db->trans_start();
	$tabla1= 
	"CREATE TABLE IF NOT EXISTS `pdcgasgpo_x_mepo` (`id` INT NOT NULL AUTO_INCREMENT,
				`idservicio_gas_x_mepo` INT(20) NULL, `cuenta_gas_x_mepo` VARCHAR(100) NOT NULL,
				`dependencia_gas_x_mepo` VARCHAR(55) NOT NULL , `fecha_gas_x_mepo` VARCHAR(15) NOT NULL,
				`mes_gas_x_mepo` VARCHAR(15) NOT NULL, `consumo_gas_x_mepo` DECIMAL(30,2) NOT NULL,
			    `costo_gas_x_mepo` DECIMAL(30,2) NOT NULL, PRIMARY KEY (`id`), UNIQUE `consugas` (`id`))  ENGINE = InnoDB";

	$tabla2= 
	"CREATE TABLE IF NOT EXISTS `temp_gas_1` (`idservicio_gas_x_mepo_1` INT, `cuenta_gas_x_mepo_1` VARCHAR(100) NOT NULL,
	`dependencia_gas_x_mepo_1` VARCHAR(100), `ano` INT, `enero` FLOAT, `febrero` FLOAT, `marzo` FLOAT, `abril` FLOAT, `mayo` FLOAT, `junio` FLOAT,
	`julio` FLOAT, `agosto` FLOAT, `septiembre` FLOAT, `octubre` FLOAT, `noviembre` FLOAT, `diciembre` FLOAT)";

	$tabla3= 
	"CREATE TABLE IF NOT EXISTS `temp_gas_2` (`idservicio_gas_x_mepo_2` INT, `cuenta_gas_x_mepo_2` VARCHAR(100) NOT NULL,
	`dependencia_gas_x_mepo_2` VARCHAR(100), `ano` INT, `enero` FLOAT, `febrero` FLOAT , `marzo` FLOAT, `abril` FLOAT, `mayo` FLOAT, `junio` FLOAT,
	`julio` FLOAT, `agosto` FLOAT, `septiembre` FLOAT, `octubre` FLOAT, `noviembre` FLOAT, `diciembre` FLOAT)";

	$tabla4= 
	"CREATE TABLE IF NOT EXISTS `pdc_gas_final_x_mepo`  (`id` INT NOT NULL AUTO_INCREMENT ,
				`id_gas_final_x_mepo` INT(20) NULL, `cta_gas_final_x_mepo` VARCHAR(100) NOT NULL,
				`dep_gas_final_x_mepo` VARCHAR(55) NOT NULL,  `yer_gas_final_x_mepo` YEAR NOT NULL,
			    `Enero` INT(30) NOT NULL, `Febrero` INT(30) NOT NULL, `Marzo` INT(30) NOT NULL, `Abril` INT(30) NOT NULL,
                `Mayo` INT(30) NOT NULL, `Junio` INT(30) NOT NULL, `Julio` INT(30) NOT NULL, `Agosto` INT(30) NOT NULL,
                `Septiembre` INT(30) NOT NULL, `Octubre` INT(30) NOT NULL, `Noviembre` INT(30) NOT NULL,
                `Diciembre` INT(30) NOT NULL, PRIMARY KEY (`id`), UNIQUE `enegasfinal` (`id`))  ENGINE = InnoDB";

	$this->db->query($tabla1);
	$this->db->query($tabla2);
	$this->db->query($tabla3);
	$this->db->query($tabla4);
	
	$this->db->query(
		"INSERT INTO `pdcgasgpo_x_mepo` (`idservicio_gas_x_mepo`, `cuenta_gas_x_mepo`, `dependencia_gas_x_mepo`,
			`fecha_gas_x_mepo`, `mes_gas_x_mepo`, `consumo_gas_x_mepo`, `costo_gas_x_mepo`)
	(SELECT 
    a.servicio,
    b.cuenta,
    b.dependencia,
    a.periodo_fin,
    MONTHNAME(a.periodo_fin),
	CONCAT('', (a.consumo)),
	CONCAT('', (a.costo))
	FROM `pdc_consumo_gas` a
	INNER JOIN `pdc_servicios_gas` b ON a.servicio = b.id
    WHERE a.servicio IS NOT NULL AND a.servicio <> ''
    AND b.cuenta IS NOT NULL AND b.cuenta <> ''
    AND b.dependencia IS NOT NULL AND b.dependencia <> ''
	AND a.periodo_fin IS NOT NULL AND a.periodo_fin <> ''
	AND a.consumo IS NOT NULL AND a.consumo <> ''
	AND a.costo IS NOT NULL AND a.costo <> ''
	AND (YEAR(a.periodo_fin) >= 2011 AND YEAR(a.periodo_fin) <=YEAR(NOW()))
	AND b.cuenta IN(
'03200034-4', '02415804-4', '02416922-2', '02398564-4', '02434957-7', '02398542-2', '02415416-6', '02411765-5',
'02416909-9', '03237554-4', '02416955-5', '03423342-2', '03444399-9', '03428166-6', '02354756-6', '02404726-6',
'03597012-2', '02416897-7', '02339127-7', '02403676-6', 'MY19970332', '02398553-3', '02416933-3', '02411743-3',
'02415792-2', 'MY19970333', '88S5595421', '10748397-7',' 04859173-3', '04052871-1', '02655608-8', '02657525-5',
'01229462-2', '02457318-8', '00432456-6', '07908399-9', '04261587-7', '02486125-5', '00326095-5', '08703002-2',
'10463928-8', '00325332-2', '05107886-6', '10415923-3', '00319091-1', '5888506-01', 'MY20161002', '02416911-1')
	ORDER BY a.periodo_fin ASC, MONTHNAME(a.periodo_fin) ASC)
	ON DUPLICATE KEY UPDATE idservicio_gas_x_mepo = VALUES(idservicio_gas_x_mepo),
	cuenta_gas_x_mepo = VALUES(cuenta_gas_x_mepo), dependencia_gas_x_mepo = VALUES(dependencia_gas_x_mepo),
	fecha_gas_x_mepo = VALUES(fecha_gas_x_mepo), mes_gas_x_mepo = VALUES(mes_gas_x_mepo),
    consumo_gas_x_mepo = VALUES(consumo_gas_x_mepo), costo_gas_x_mepo = VALUES(costo_gas_x_mepo)");

	$this->db->query(
		"INSERT INTO temp_gas_1 
		SELECT CONCAT(idservicio_gas_x_mepo),
		CONCAT(cuenta_gas_x_mepo),
		CONCAT(dependencia_gas_x_mepo),
		CONCAT(YEAR(fecha_gas_x_mepo)),
		CASE WHEN mes_gas_x_mepo= 'January' THEN consumo_gas_x_mepo END,
		CASE WHEN mes_gas_x_mepo= 'February' THEN consumo_gas_x_mepo END,
		CASE WHEN mes_gas_x_mepo= 'March' THEN consumo_gas_x_mepo END,
		CASE WHEN mes_gas_x_mepo= 'April' THEN consumo_gas_x_mepo END,
		CASE WHEN mes_gas_x_mepo= 'May' THEN consumo_gas_x_mepo END,
		CASE WHEN mes_gas_x_mepo= 'June' THEN consumo_gas_x_mepo END,
		CASE WHEN mes_gas_x_mepo= 'July' THEN consumo_gas_x_mepo END,
		CASE WHEN mes_gas_x_mepo= 'August' THEN consumo_gas_x_mepo END,
		CASE WHEN mes_gas_x_mepo= 'September' THEN consumo_gas_x_mepo END,
		CASE WHEN mes_gas_x_mepo= 'October' THEN consumo_gas_x_mepo END,
		CASE WHEN mes_gas_x_mepo= 'November' THEN consumo_gas_x_mepo END,
		CASE WHEN mes_gas_x_mepo= 'December' THEN consumo_gas_x_mepo END
		FROM  `pdcgasgpo_x_mepo`
		WHERE TRUE");

	$this->db->query(
		"INSERT INTO temp_gas_2
		SELECT idservicio_gas_x_mepo_1,
		cuenta_gas_x_mepo_1,
		dependencia_gas_x_mepo_1,
		ano,
		SUM(enero),
		SUM(febrero),
		SUM(marzo),
		SUM(abril),
		SUM(mayo),
		SUM(junio),
		SUM(julio),
		SUM(agosto),
		SUM(septiembre),
		SUM(octubre),
		SUM(noviembre),
		SUM(diciembre)
		FROM temp_gas_1
		GROUP BY idservicio_gas_x_mepo_1 ASC, ano ASC");

	$this->db->query(
		"INSERT INTO `pdc_gas_final_x_mepo`(`id_gas_final_x_mepo`, `cta_gas_final_x_mepo`, 
		`dep_gas_final_x_mepo`, `yer_gas_final_x_mepo`, `Enero`, `Febrero`, `Marzo`, `Abril`, `Mayo`, `Junio`, `Julio`,
		`Agosto`, `Septiembre`, `Octubre`, `Noviembre`, `Diciembre`)
						
		(SELECT 
		idservicio_gas_x_mepo_2,
		cuenta_gas_x_mepo_2,
		dependencia_gas_x_mepo_2,
		ano,
		COALESCE(enero,0) AS Enero,
		COALESCE(febrero,0) AS Febrero,
		COALESCE(marzo,0) AS Marzo,
		COALESCE(abril,0) AS Abril,	
		COALESCE(mayo,0) AS Mayo,
		COALESCE(junio,0) AS Junio,
		COALESCE(julio,0) AS Julio,
		COALESCE(agosto,0) AS Agosto,
		COALESCE(septiembre,0) AS Septiembre,
		COALESCE(octubre,0) AS Octubre,
		COALESCE(noviembre,0) AS Noviembre,
		COALESCE(diciembre,0) AS Diciembre FROM temp_gas_2)
		ON DUPLICATE KEY UPDATE id_gas_final_x_mepo = VALUES(id_gas_final_x_mepo),
		cta_gas_final_x_mepo = VALUES(cta_gas_final_x_mepo), 
		dep_gas_final_x_mepo = VALUES(dep_gas_final_x_mepo),
		yer_gas_final_x_mepo = VALUES(yer_gas_final_x_mepo),
		Enero = VALUES(Enero), Febrero = VALUES(Febrero), Marzo = VALUES(Marzo), Abril = VALUES(Abril),
		Mayo = VALUES(Mayo), Junio = VALUES(Junio), Julio = VALUES(Julio), Agosto = VALUES(Agosto),
		Septiembre = VALUES(Septiembre), Octubre = VALUES(Octubre), Noviembre = VALUES(Noviembre),
		Diciembre = VALUES(Diciembre)");
	$this->db->trans_complete();
}
//*************************************FIN DE LA TRANSACCION*************************************//

//ELIMINA LAS TABLAS PARA GENERAR NUEVOS DATOS//
function droper_gas_final()
{
	$this->db->query("DROP TABLE  pdcgasgpo_x_mepo;");
	$this->db->query("DROP TABLE  temp_gas_1;");
	$this->db->query("DROP TABLE  temp_gas_2;");
	$this->db->query("DROP TABLE  pdc_gas_final_x_mepo;");
}


//**********************MODELO CARGADOR COMBOBOX DEPENDENCIAS gas FINAL************************//
function dep_gas_final()
{
	
	$this->db->order_by('dep_gas_final_x_mepo', 'asc');
	$this->db->group_by('dep_gas_final_x_mepo');
	$query = $this->db->get('pdc_gas_final_x_mepo');
	if($query->num_rows()>0) {
		foreach($query->result() as $row) {
			$dep_gas_final_x_mepo[$row->id] = $row;
			
		}
		return $dep_gas_final_x_mepo;

	}
}

//////////////////////////////////////////////////////////////////////////////////

function dep_gas_final_resultado()
{
	$dep_gas_final_x_mepo = $this->input->post("dep_gas_final_x_mepo");
	//MANDA RESULTADOS SI SE SELECCIONA LA DEPENDENCIA//
	if(!empty($dep_gas_final_x_mepo))
	{
		$this->db->where('dep_gas_final_x_mepo', $dep_gas_final_x_mepo);
		$this->db->order_by('yer_gas_final_x_mepo', 'asc');
		$query = $this->db->get('pdc_gas_final_x_mepo');
				
			if ($query->num_rows()>0)
			{
				foreach($query->result() as $row)
				{
					$yer_gas_final_x_mepo[$row->id] = $row;
				}
				return $yer_gas_final_x_mepo;
			}
			else return false;
	}

}



///////////////////////////////////////////////////////////////////////////////////////////////////////

//Realiza la sumatoria del consumo, dependiendo del mes en la vista tar_om_final_x_mepo TARIFA OM
function EneroTotalGS($dep_gas_final_x_mepo)
{


	if(!empty($dep_gas_final_x_mepo))
	{
		$this->db->where('dep_gas_final_x_mepo', $dep_gas_final_x_mepo);
		$this->db->select_sum('Enero');
		$query = $this->db->get('pdc_gas_final_x_mepo');
		$result = $query->row()->Enero;
		return $result;
	}

}

function FebreroTotalGS($dep_gas_final_x_mepo)
{


	if(!empty($dep_gas_final_x_mepo))
	{
		$this->db->where('dep_gas_final_x_mepo', $dep_gas_final_x_mepo);
		$this->db->select_sum('Febrero');
		$query = $this->db->get('pdc_gas_final_x_mepo');
		$result = $query->row()->Febrero;
		return $result;
	}

}

function MarzoTotalGS($dep_gas_final_x_mepo)
{


	if(!empty($dep_gas_final_x_mepo))
	{
		$this->db->where('dep_gas_final_x_mepo', $dep_gas_final_x_mepo);
		$this->db->select_sum('Marzo');
		$query = $this->db->get('pdc_gas_final_x_mepo');
		$result = $query->row()->Marzo;
		return $result;
	}

}

function AbrilTotalGS($dep_gas_final_x_mepo)
{


	if(!empty($dep_gas_final_x_mepo))
	{
		$this->db->where('dep_gas_final_x_mepo', $dep_gas_final_x_mepo);
		$this->db->select_sum('Abril');
		$query = $this->db->get('pdc_gas_final_x_mepo');
		$result = $query->row()->Abril;
		return $result;
	}

}

function MayoTotalGS($dep_gas_final_x_mepo)
{


	if(!empty($dep_gas_final_x_mepo))
	{
		$this->db->where('dep_gas_final_x_mepo', $dep_gas_final_x_mepo);
		$this->db->select_sum('Mayo');
		$query = $this->db->get('pdc_gas_final_x_mepo');
		$result = $query->row()->Mayo;
		return $result;
	}

}

function JunioTotalGS($dep_gas_final_x_mepo)
{


	if(!empty($dep_gas_final_x_mepo))
	{
		$this->db->where('dep_gas_final_x_mepo', $dep_gas_final_x_mepo);
		$this->db->select_sum('Junio');
		$query = $this->db->get('pdc_gas_final_x_mepo');
		$result = $query->row()->Junio;
		return $result;
	}

}

function JulioTotalGS($dep_gas_final_x_mepo)
{


	if(!empty($dep_gas_final_x_mepo))
	{
		$this->db->where('dep_gas_final_x_mepo', $dep_gas_final_x_mepo);
		$this->db->select_sum('Julio');
		$query = $this->db->get('pdc_gas_final_x_mepo');
		$result = $query->row()->Julio;
		return $result;
	}

}

function AgostoTotalGS($dep_gas_final_x_mepo)
{


	if(!empty($dep_gas_final_x_mepo))
	{
		$this->db->where('dep_gas_final_x_mepo', $dep_gas_final_x_mepo);
		$this->db->select_sum('Agosto');
		$query = $this->db->get('pdc_gas_final_x_mepo');
		$result = $query->row()->Agosto;
		return $result;
	}

}

function SeptiembreTotalGS($dep_gas_final_x_mepo)
{


	if(!empty($dep_gas_final_x_mepo))
	{
		$this->db->where('dep_gas_final_x_mepo', $dep_gas_final_x_mepo);
		$this->db->select_sum('Septiembre');
		$query = $this->db->get('pdc_gas_final_x_mepo');
		$result = $query->row()->Septiembre;
		return $result;
	}

}

function OctubreTotalGS($dep_gas_final_x_mepo)
{


	if(!empty($dep_gas_final_x_mepo))
	{
		$this->db->where('dep_gas_final_x_mepo', $dep_gas_final_x_mepo);
		$this->db->select_sum('Octubre');
		$query = $this->db->get('pdc_gas_final_x_mepo');
		$result = $query->row()->Octubre;
		return $result;
	}

}

function NoviembreTotalGS($dep_gas_final_x_mepo)
{


	if(!empty($dep_gas_final_x_mepo))
	{
		$this->db->where('dep_gas_final_x_mepo', $dep_gas_final_x_mepo);
		$this->db->select_sum('Noviembre');
		$query = $this->db->get('pdc_gas_final_x_mepo');
		$result = $query->row()->Noviembre;
		return $result;
	}

}

function DiciembreTotalGS($dep_gas_final_x_mepo)
{


	if(!empty($dep_gas_final_x_mepo))
	{
		$this->db->where('dep_gas_final_x_mepo', $dep_gas_final_x_mepo);
		$this->db->select_sum('Diciembre');
		$query = $this->db->get('pdc_gas_final_x_mepo');
		$result = $query->row()->Diciembre;
		return $result;
	}

}


/***************************************************************************************************************************/

/*MODELO PARA NUEVAS GRAFICAS DE ELECTRICIDAD*/

function console_log( ...$messages ){
  $msgs = '';
  foreach ($messages as $msg) {
    $msgs .= json_encode($msg);
  }

  echo '<script>';
  echo 'console.log('. json_encode($msgs) .')';
  echo '</script>';
}
/**************************************MODELO NUMERO A MESES************************************/
/*function obtenumeroames($meses_arr){
				$resultado = "";

				switch ($meses_arr){
					case 1:
						$resultado = "Enero";
						break;
					case 2:
						$resultado = "Febrero";
						break;
					case 3:
						$resultado = "Marzo";
						break;
					case 4:
						$resultado = "Abril";
						break;
					case 5:
						$resultado = "Mayo";
						break;
					case 6:
						$resultado = "Junio";
						break;
					case 7:
						$resultado = "Julio";
						break;
					case 8:
						$resultado = "Agosto";
						break;
					case 9:
						$resultado = "Septiembre";
						break;
					case 10:
						$resultado = "Octubre";
						break;
					case 11:
						$resultado = "Noviembre";
						break;
					case 12:
						$resultado = "Diciembre";
						break;
				}
				return $resultado;
			}*/
/*********************************************FIN DEL MODELO********************************************/

/***************INICIO DEL MODELO PARA NUEVA GRAFICA DE CONSUMO Y COSTO ELECTRICIDAD***************/
function resgrafconkwh($limite=false, $inicio=0)
{

	$dependencia = $this->input->post('dependencia');
	$year = $this->input->post('year');
	$this->console_log($dependencia);
	$this->console_log($year);
	if(empty($dependencia) && !empty($year))
	{
			$this->db->like('periodo_fin', $year);
			$this->db->order_by("periodo_inicio", "asc");
			$query = $this->db->get('pdc_consumo_energia');

			if($query->num_rows()>0)
			{
				foreach($query->result() as $row)
					{
						$dependencias[$row->id] = $row;
					}
				return $dependencias;
			}
				else return false;

	}

	else
	{
		$busqueda	= $this->modelo_factor_gei->serbusgrafconkwh();
		$this->console_log($busqueda);
		if(!empty($busqueda))
		{
			if($limite)
				$this->db->limit($limite, $inicio);

				if(!empty($year))
					$this->db->like('periodo_fin', $year);
					$this->db->order_by("periodo_inicio", "asc");
					$this->db->where('servicio', $busqueda->id);
					$query = $this->db->get('pdc_consumo_energia');

					if($query->num_rows()>0)
					{
						foreach($query->result() as $row)
							{
								$dependencias[$row->id] = $row;
							}
							$this->console_log($dependencias);
						return $dependencias;
					}
					else return false;
		}
		else return false;
	}
}


function serbusgrafconkwh()
{
	$servicio = $this->input->post('servicio');
	$dependencia = $this->input->post('dependencia');

	if(!empty($servicio) && !empty($dependencia))
	{
		$this->db->where('cuenta', $servicio);
		$this->db->where('id', $dependencia);
		$query = $this->db->get("pdc_servicios_energia");
		return $query->row();
	}

	if(!empty($servicio))
	{
		$this->db->where('cuenta', $servicio);
		$query = $this->db->get("pdc_servicios_energia");
		return $query->row();
	}
	if(!empty($dependencia))
	{
		$this->db->where('id', $dependencia);
		$query = $this->db->get("pdc_servicios_energia");
		return $query->row();
	}

}

function sercatgrafconkwh($limite=false, $inicio=0)
{
	$this->db->order_by('dependencia', 'asc');
	if($limite)
		$this->db->limit($limite, $inicio);
	$query = $this->db->get('pdc_servicios_energia');

		if($query->num_rows()>0)
		{
			foreach($query->result() as $row)
				{
					$servicios[$row->id] = $row;
				}
			return $servicios;
		}
		else return false;
}
/************************FINAL DEL MODELO PARA NUEVA GRAFICA DE ELECTRICIDAD***********************/



/***********************************MODELO NUEVA GRAFICA PARA AGUA********************************/

function resgrafaguacos($limite=false, $inicio=0)
{

	$dependencia = $this->input->post('dependencia');
	$year = $this->input->post('year');
	$this->console_log($dependencia);
	$this->console_log($year);
	if(empty($dependencia) && !empty($year))
	{
			$this->db->like('periodo_fin', $year);
			$this->db->order_by("periodo_inicio", "asc");
			$query = $this->db->get('pdc_consumo_agua');

			if($query->num_rows()>0)
			{
				foreach($query->result() as $row)
					{
						$dependencias[$row->id] = $row;
					}
				return $dependencias;
			}
				else return false;

	}

	else
	{
		$busqueda	= $this->modelo_factor_gei->serbusgrafcosagua();
		$this->console_log($busqueda);
		if(!empty($busqueda))
		{
			if($limite)
				$this->db->limit($limite, $inicio);

				if(!empty($year))
					$this->db->like('periodo_fin', $year);
					$this->db->order_by("periodo_inicio", "asc");
					$this->db->where('servicio', $busqueda->id);
					$query = $this->db->get('pdc_consumo_agua');

					if($query->num_rows()>0)
					{
						foreach($query->result() as $row)
							{
								$dependencias[$row->id] = $row;
							}
							$this->console_log($dependencias);
						return $dependencias;
					}
					else return false;
		}
		else return false;
	}
}


function serbusgrafcosagua()
{
	$servicio = $this->input->post('servicio');
	$dependencia = $this->input->post('dependencia');

	if(!empty($servicio) && !empty($dependencia))
	{
		$this->db->where('cuenta', $servicio);
		$this->db->where('id', $dependencia);
		$query = $this->db->get("pdc_servicios_agua");
		return $query->row();
	}

	if(!empty($servicio))
	{
		$this->db->where('cuenta', $servicio);
		$query = $this->db->get("pdc_servicios_agua");
		return $query->row();
	}
	if(!empty($dependencia))
	{
		$this->db->where('id', $dependencia);
		$query = $this->db->get("pdc_servicios_agua");
		return $query->row();
	}

}

function sercatgrafcosagua($limite=false, $inicio=0)
{
	$this->db->order_by('dependencia', 'asc');
	if($limite)
		$this->db->limit($limite, $inicio);
	$query = $this->db->get('pdc_servicios_agua');

		if($query->num_rows()>0)
		{
			foreach($query->result() as $row)
				{
					$servicios[$row->id] = $row;
				}
			return $servicios;
		}
		else return false;
}
/****************************************************************************************/
/***********************************MODELO NUEVA GRAFICA PARA GAS********************************/

function resgrafgascos($limite=false, $inicio=0)
{

	$dependencia = $this->input->post('dependencia');
	$year = $this->input->post('year');
	$this->console_log($dependencia);
	$this->console_log($year);
	if(empty($dependencia) && !empty($year))
	{
			$this->db->like('periodo_fin', $year);
			$this->db->order_by("periodo_inicio", "asc");
			$query = $this->db->get('pdc_consumo_gas');

			if($query->num_rows()>0)
			{
				foreach($query->result() as $row)
					{
						$dependencias[$row->id] = $row;
					}
				return $dependencias;
			}
				else return false;

	}

	else
	{
		$busqueda	= $this->modelo_factor_gei->serbusgrafcosgas();
		$this->console_log($busqueda);
		if(!empty($busqueda))
		{
			if($limite)
				$this->db->limit($limite, $inicio);

				if(!empty($year))
					$this->db->like('periodo_fin', $year);
					$this->db->order_by("periodo_inicio", "asc");
					$this->db->where('servicio', $busqueda->id);
					$query = $this->db->get('pdc_consumo_gas');

					if($query->num_rows()>0)
					{
						foreach($query->result() as $row)
							{
								$dependencias[$row->id] = $row;
							}
							$this->console_log($dependencias);
						return $dependencias;
					}
					else return false;
		}
		else return false;
	}
}


function serbusgrafcosgas()
{
	$servicio = $this->input->post('servicio');
	$dependencia = $this->input->post('dependencia');

	if(!empty($servicio) && !empty($dependencia))
	{
		$this->db->where('cuenta', $servicio);
		$this->db->where('id', $dependencia);
		$query = $this->db->get("pdc_servicios_gas");
		return $query->row();
	}

	if(!empty($servicio))
	{
		$this->db->where('cuenta', $servicio);
		$query = $this->db->get("pdc_servicios_gas");
		return $query->row();
	}
	if(!empty($dependencia))
	{
		$this->db->where('id', $dependencia);
		$query = $this->db->get("pdc_servicios_gas");
		return $query->row();
	}

}

function sercatgrafcosgas($limite=false, $inicio=0)
{
	$this->db->order_by('dependencia', 'asc');
	if($limite)
		$this->db->limit($limite, $inicio);
	$query = $this->db->get('pdc_servicios_gas');

		if($query->num_rows()>0)
		{
			foreach($query->result() as $row)
				{
					$servicios[$row->id] = $row;
				}
			return $servicios;
		}
		else return false;
}
/****************************************************************************************/
/***************************************************************************************************************************/
						/*INICIO DE CONSUMO EN ENERGIA 2015 A LA FECHA PARA LOS CAMPUS (Green Metric)*/
/***************************************************************************************************************************/

//CREA LAS TABLAS DE pdctarifaomgpo_x_mepo, temp_om_1, temp_om_2 y pdc_tar_om_final_x_mepo. TAMBIEN HACE LA INSERCION DE DATOS CORRESPONDIENTES A LAS MISMAS//
function conelecxcampus()
{
	$this->db->trans_start();
	$tabla1= "CREATE TABLE IF NOT EXISTS `greenmetricenerfirstdataa` (`id` INT NOT NULL AUTO_INCREMENT,
				`campus_gmtcfst` VARCHAR(55) NOT NULL , `fecha_gmtcfst` VARCHAR(15) NOT NULL,
				`mes_gmtcfst` VARCHAR(15) NOT NULL, `consumo_gmtcfst` DECIMAL(30,2) NOT NULL,
			    `costo_gmtcfst` DECIMAL(30,2) NOT NULL, PRIMARY KEY (`id`),
			    UNIQUE `consumogmt` (`id`))  ENGINE = InnoDB";

	$tabla2= "CREATE TABLE IF NOT EXISTS `greenmetricenertemp11` 
	(`campus_gmtt1` VARCHAR(100), `anogmtt1` INT, `enero` DECIMAL(30,2) NOT NULL, `febrero` DECIMAL(30,2) NOT NULL,
	`marzo` DECIMAL(30,2) NOT NULL, `abril` DECIMAL(30,2) NOT NULL, `mayo` DECIMAL(30,2) NOT NULL, `junio` DECIMAL(30,2) NOT NULL,
	`julio` DECIMAL(30,2) NOT NULL, `agosto` DECIMAL(30,2) NOT NULL, `septiembre` DECIMAL(30,2) NOT NULL,
    `octubre` DECIMAL(30,2) NOT NULL, `noviembre` DECIMAL(30,2) NOT NULL, `diciembre` DECIMAL(30,2) NOT NULL)";

	$tabla3= "CREATE TABLE IF NOT EXISTS `greenmetricenertemp22`
	 (`campus_gmtt2` VARCHAR(100), `anogmtt2` INT, `enero` FLOAT, `febrero` FLOAT , `marzo` FLOAT, `abril` FLOAT, `mayo` FLOAT,
	 `junio` FLOAT, `julio` FLOAT, `agosto` FLOAT, `septiembre` FLOAT, `octubre` FLOAT, `noviembre` FLOAT, `diciembre` FLOAT)";

	$tabla4= "CREATE TABLE IF NOT EXISTS `greenmetricenerfinalgraff`  (`id` INT NOT NULL AUTO_INCREMENT ,
				`campus_gmtfinal` VARCHAR(55) NOT NULL,  `year_gmtfinal` YEAR NOT NULL,
			    `Enero` INT(30) NOT NULL, `Febrero` INT(30) NOT NULL, `Marzo` INT(30) NOT NULL, `Abril` INT(30) NOT NULL,
                `Mayo` INT(30) NOT NULL, `Junio` INT(30) NOT NULL, `Julio` INT(30) NOT NULL, `Agosto` INT(30) NOT NULL,
                `Septiembre` INT(30) NOT NULL, `Octubre` INT(30) NOT NULL, `Noviembre` INT(30) NOT NULL,
                `Diciembre` INT(30) NOT NULL, PRIMARY KEY (`id`), UNIQUE `enegmtfinal` (`id`))  ENGINE = InnoDB";

	$this->db->query($tabla1);
	$this->db->query($tabla2);
	$this->db->query($tabla3);
	$this->db->query($tabla4);
	
	$this->db->query(
		"INSERT INTO `greenmetricenerfirstdataa` (`campus_gmtcfst`,
			`fecha_gmtcfst`, `mes_gmtcfst`, `consumo_gmtcfst`, `costo_gmtcfst`)
	(SELECT DISTINCT
            c.campus,
            (a.periodo_fin),
            MONTHNAME(a.periodo_fin),
			SUM(a.consumo),
			SUM(a.costo)
			FROM `pdc_consumo_energia` a
			INNER JOIN `ctrl_servicios` b ON a.servicio = b.id 
			INNER JOIN `pdc_servicios_energia` c ON b.account = c.cuenta 
			WHERE c.campus IS NOT NULL AND c.campus <> ''
			AND a.periodo_fin IS NOT NULL AND a.periodo_fin <> ''
			AND a.consumo IS NOT NULL AND a.consumo <> ''
			AND a.costo IS NOT NULL AND a.costo <> ''
			AND b.account IS NOT NULL AND b.account <> ''
			AND a.servicio IS NOT NULL AND a.servicio <> ''
			AND (YEAR(a.periodo_fin) >= 2015 AND YEAR(a.periodo_fin) <= YEAR(NOW()) )
			GROUP BY a.periodo_fin, c.campus
			ORDER BY DATE(a.periodo_fin) ASC, c.campus ASC)
	ON DUPLICATE KEY UPDATE
    campus_gmtcfst = VALUES(campus_gmtcfst),
	fecha_gmtcfst = VALUES(fecha_gmtcfst), mes_gmtcfst = VALUES(mes_gmtcfst),
    consumo_gmtcfst = VALUES(consumo_gmtcfst), costo_gmtcfst = VALUES(costo_gmtcfst)");

	$this->db->query(
		"INSERT INTO `greenmetricenertemp11`
		SELECT
		CONCAT(`campus_gmtcfst`),
		CONCAT(YEAR(`fecha_gmtcfst`)),
		CASE WHEN `mes_gmtcfst`= 'January' THEN `consumo_gmtcfst` END,
		CASE WHEN `mes_gmtcfst`= 'February' THEN `consumo_gmtcfst` END,
		CASE WHEN `mes_gmtcfst`= 'March' THEN `consumo_gmtcfst` END,
		CASE WHEN `mes_gmtcfst`= 'April' THEN `consumo_gmtcfst` END,
		CASE WHEN `mes_gmtcfst`= 'May' THEN `consumo_gmtcfst` END,
		CASE WHEN `mes_gmtcfst`= 'June' THEN `consumo_gmtcfst` END,
		CASE WHEN `mes_gmtcfst`= 'July' THEN `consumo_gmtcfst` END,
		CASE WHEN `mes_gmtcfst`= 'August' THEN `consumo_gmtcfst` END,
		CASE WHEN `mes_gmtcfst`= 'September' THEN `consumo_gmtcfst` END,
		CASE WHEN `mes_gmtcfst`= 'October' THEN `consumo_gmtcfst` END,
		CASE WHEN `mes_gmtcfst`= 'November' THEN `consumo_gmtcfst` END,
		CASE WHEN `mes_gmtcfst`= 'December' THEN `consumo_gmtcfst` END
		FROM  `greenmetricenerfirstdataa`
		WHERE TRUE");

	$this->db->query(
		"INSERT INTO `greenmetricenertemp22`
			SELECT
			`campus_gmtt1`,
			`anogmtt1`,
			SUM(`enero`),
			SUM(`febrero`),
			SUM(`marzo`),
			SUM(`abril`),
			SUM(`mayo`),
			SUM(`junio`),
			SUM(`julio`),
			SUM(`agosto`),
			SUM(`septiembre`),
			SUM(`octubre`),
			SUM(`noviembre`),
			SUM(`diciembre`)
			FROM `greenmetricenertemp11`
			GROUP BY `campus_gmtt1`, `anogmtt1` ASC");

	$this->db->query(
		"INSERT INTO `greenmetricenerfinalgraff`(
		`campus_gmtfinal`, `year_gmtfinal`, `Enero`, `Febrero`, `Marzo`, `Abril`, `Mayo`, `Junio`, `Julio`,
		`Agosto`, `Septiembre`, `Octubre`, `Noviembre`, `Diciembre`)
		(SELECT
		`campus_gmtt2`,
		`anogmtt2`,
		COALESCE(`enero`,0) AS Enero,
		COALESCE(`febrero`,0) AS Febrero,
		COALESCE(`marzo`,0) AS Marzo,
		COALESCE(`abril`,0) AS Abril,
		COALESCE(`mayo`,0) AS Mayo,
		COALESCE(`junio`,0) AS Junio,
		COALESCE(`julio`,0) AS Julio,
		COALESCE(`agosto`,0) AS Agosto,
		COALESCE(`septiembre`,0) AS Septiembre,
		COALESCE(`octubre`,0) AS Octubre,
		COALESCE(`noviembre`,0) AS Noviembre,
		COALESCE(`diciembre`,0) AS Diciembre
        FROM `greenmetricenertemp22`)
		ON DUPLICATE KEY UPDATE
		campus_gmtfinal = VALUES(campus_gmtfinal),
		year_gmtfinal = VALUES(year_gmtfinal),
		Enero = VALUES(Enero), Febrero = VALUES(Febrero), Marzo = VALUES(Marzo), Abril = VALUES(Abril),
		Mayo = VALUES(Mayo), Junio = VALUES(Junio), Julio = VALUES(Julio), Agosto = VALUES(Agosto),
		Septiembre = VALUES(Septiembre), Octubre = VALUES(Octubre), Noviembre = VALUES(Noviembre),
		Diciembre = VALUES(Diciembre)");
	$this->db->trans_complete();
}
//*************************************FIN DE LA TRANSACCION*************************************//

//ELIMINA LAS TABLAS PARA GENERAR NUEVOS DATOS//
function droprelecxcampus()
{
	$this->db->query("DROP TABLE  greenmetricenerfirstdataa;");
	$this->db->query("DROP TABLE  greenmetricenertemp11;");
	$this->db->query("DROP TABLE  greenmetricenertemp22;");
	$this->db->query("DROP TABLE  greenmetricenerfinalgraff;");
}


//*********************************MODELO CARGADOR COMBOBOX ELECTRICIDAD X CAMPUS FINAL*********************************//
function elecxcampusfinal()
{
	
	$this->db->order_by('campus_gmtfinal', 'asc');
	$this->db->group_by('campus_gmtfinal');
	$query = $this->db->get('greenmetricenerfinalgraff');
	if($query->num_rows()>0) {
		foreach($query->result() as $row) {
			$campus_gmtfinal[$row->id] = $row;
			
		}
		return $campus_gmtfinal;

	}
}




function elecxcampusresultado()
{
	$campus_gmtfinal = $this->input->post("campus_gmtfinal");
	//MANDA RESULTADOS SI SE SELECCIONA LA DEPENDENCIA//
	if(!empty($campus_gmtfinal))
	{
		$this->db->where('campus_gmtfinal', $campus_gmtfinal);
		$this->db->order_by('year_gmtfinal', 'asc');
		$query = $this->db->get('greenmetricenerfinalgraff');
				
			if ($query->num_rows()>0)
			{
				foreach($query->result() as $row)
				{
					$year_gmtfinal[$row->id] = $row;
				}
				return $year_gmtfinal;
			}
			else return false;
	}

}



////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//Realiza la sumatoria del consumo, dependiendo del mes en la vista tar_om_final_x_mepo TARIFA OM
function Eneroelecxcampustot($campus_gmtfinal)
{


	if(!empty($campus_gmtfinal))
	{
		$this->db->where('campus_gmtfinal', $campus_gmtfinal);
		$this->db->select_sum('Enero');
		$query = $this->db->get('greenmetricenerfinalgraff');
		$result = $query->row()->Enero;
		return $result;
	}

}

function Febreroelecxcampustot($campus_gmtfinal)
{


	if(!empty($campus_gmtfinal))
	{
		$this->db->where('campus_gmtfinal', $campus_gmtfinal);
		$this->db->select_sum('Febrero');
		$query = $this->db->get('greenmetricenerfinalgraff');
		$result = $query->row()->Febrero;
		return $result;
	}

}

function Marzoelecxcampustot($campus_gmtfinal)
{


	if(!empty($campus_gmtfinal))
	{
		$this->db->where('campus_gmtfinal', $campus_gmtfinal);
		$this->db->select_sum('Marzo');
		$query = $this->db->get('greenmetricenerfinalgraff');
		$result = $query->row()->Marzo;
		return $result;
	}

}

function Abrilelecxcampustot($campus_gmtfinal)
{


	if(!empty($campus_gmtfinal))
	{
		$this->db->where('campus_gmtfinal', $campus_gmtfinal);
		$this->db->select_sum('Abril');
		$query = $this->db->get('greenmetricenerfinalgraff');
		$result = $query->row()->Abril;
		return $result;
	}

}

function Mayoelecxcampustot($campus_gmtfinal)
{


	if(!empty($campus_gmtfinal))
	{
		$this->db->where('campus_gmtfinal', $campus_gmtfinal);
		$this->db->select_sum('Mayo');
		$query = $this->db->get('greenmetricenerfinalgraff');
		$result = $query->row()->Mayo;
		return $result;
	}

}

function Junioelecxcampustot($campus_gmtfinal)
{


	if(!empty($campus_gmtfinal))
	{
		$this->db->where('campus_gmtfinal', $campus_gmtfinal);
		$this->db->select_sum('Junio');
		$query = $this->db->get('greenmetricenerfinalgraff');
		$result = $query->row()->Junio;
		return $result;
	}

}

function Julioelecxcampustot($campus_gmtfinal)
{


	if(!empty($campus_gmtfinal))
	{
		$this->db->where('campus_gmtfinal', $campus_gmtfinal);
		$this->db->select_sum('Julio');
		$query = $this->db->get('greenmetricenerfinalgraff');
		$result = $query->row()->Julio;
		return $result;
	}

}

function Agostoelecxcampustot($campus_gmtfinal)
{


	if(!empty($campus_gmtfinal))
	{
		$this->db->where('campus_gmtfinal', $campus_gmtfinal);
		$this->db->select_sum('Agosto');
		$query = $this->db->get('greenmetricenerfinalgraff');
		$result = $query->row()->Agosto;
		return $result;
	}

}

function Septiembreelecxcampustot($campus_gmtfinal)
{


	if(!empty($campus_gmtfinal))
	{
		$this->db->where('campus_gmtfinal', $campus_gmtfinal);
		$this->db->select_sum('Septiembre');
		$query = $this->db->get('greenmetricenerfinalgraff');
		$result = $query->row()->Septiembre;
		return $result;
	}

}

function Octubreelecxcampustot($campus_gmtfinal)
{


	if(!empty($campus_gmtfinal))
	{
		$this->db->where('campus_gmtfinal', $campus_gmtfinal);
		$this->db->select_sum('Octubre');
		$query = $this->db->get('greenmetricenerfinalgraff');
		$result = $query->row()->Octubre;
		return $result;
	}

}

function Noviembreelecxcampustot($campus_gmtfinal)
{


	if(!empty($campus_gmtfinal))
	{
		$this->db->where('campus_gmtfinal', $campus_gmtfinal);
		$this->db->select_sum('Noviembre');
		$query = $this->db->get('greenmetricenerfinalgraff');
		$result = $query->row()->Noviembre;
		return $result;
	}

}

function Diciembreelecxcampustot($campus_gmtfinal)
{


	if(!empty($campus_gmtfinal))
	{
		$this->db->where('campus_gmtfinal', $campus_gmtfinal);
		$this->db->select_sum('Diciembre');
		$query = $this->db->get('greenmetricenerfinalgraff');
		$result = $query->row()->Diciembre;
		return $result;
	}

}
/***************************************************************************************************************************/
							/*FIN DE CONSUMO EN ENERGIA 2015 A LA FECHA PARA LOS CAMPUS (Green Metric)*/
/***************************************************************************************************************************/


/***************************************************************************************************************************/
		/*INICIO DE CONSUMO EN ENERGIA 2015 A LA FECHA PARA LOS CAMPUS (Green Metric AJUSTE UN AÑO MENOR AL ACTUAL)*/
/***************************************************************************************************************************/

//CREA LAS TABLAS DE pdctarifaomgpo_x_mepo, temp_om_1, temp_om_2 y pdc_tar_om_final_x_mepo. TAMBIEN HACE LA INSERCION DE DATOS CORRESPONDIENTES A LAS MISMAS//
function conelecxcampusv2()
{
	$this->db->trans_start();
	$tabla1= "CREATE TABLE IF NOT EXISTS `v2greenmetricenerfirstdataa` (`id` INT NOT NULL AUTO_INCREMENT,
				`campus_gmtcfst` VARCHAR(55) NOT NULL , `fecha_gmtcfst` VARCHAR(15) NOT NULL,
				`mes_gmtcfst` VARCHAR(15) NOT NULL, `consumo_gmtcfst` DECIMAL(30,2) NOT NULL,
			    `costo_gmtcfst` DECIMAL(30,2) NOT NULL, PRIMARY KEY (`id`),
			    UNIQUE `v2consumogmt` (`id`))  ENGINE = InnoDB";

	$tabla2= "CREATE TABLE IF NOT EXISTS `v2greenmetricenertemp11` 
	(`campus_gmtt1` VARCHAR(100), `anogmtt1` INT, `enero` DECIMAL(30,2) NOT NULL, `febrero` DECIMAL(30,2) NOT NULL,
	`marzo` DECIMAL(30,2) NOT NULL, `abril` DECIMAL(30,2) NOT NULL, `mayo` DECIMAL(30,2) NOT NULL, `junio` DECIMAL(30,2) NOT NULL,
	`julio` DECIMAL(30,2) NOT NULL, `agosto` DECIMAL(30,2) NOT NULL, `septiembre` DECIMAL(30,2) NOT NULL,
    `octubre` DECIMAL(30,2) NOT NULL, `noviembre` DECIMAL(30,2) NOT NULL, `diciembre` DECIMAL(30,2) NOT NULL)";

	$tabla3= "CREATE TABLE IF NOT EXISTS `v2greenmetricenertemp22`
	 (`campus_gmtt2` VARCHAR(100), `anogmtt2` INT, `enero` FLOAT, `febrero` FLOAT , `marzo` FLOAT, `abril` FLOAT, `mayo` FLOAT,
	 `junio` FLOAT, `julio` FLOAT, `agosto` FLOAT, `septiembre` FLOAT, `octubre` FLOAT, `noviembre` FLOAT, `diciembre` FLOAT)";

	$tabla4= "CREATE TABLE IF NOT EXISTS `v2greenmetricenerfinalgraff`  (`id` INT NOT NULL AUTO_INCREMENT ,
				`campus_gmtfinal` VARCHAR(55) NOT NULL,  `year_gmtfinal` YEAR NOT NULL,
			    `Enero` INT(30) NOT NULL, `Febrero` INT(30) NOT NULL, `Marzo` INT(30) NOT NULL, `Abril` INT(30) NOT NULL,
                `Mayo` INT(30) NOT NULL, `Junio` INT(30) NOT NULL, `Julio` INT(30) NOT NULL, `Agosto` INT(30) NOT NULL,
                `Septiembre` INT(30) NOT NULL, `Octubre` INT(30) NOT NULL, `Noviembre` INT(30) NOT NULL,
                `Diciembre` INT(30) NOT NULL, PRIMARY KEY (`id`), UNIQUE `enegmtfinal` (`id`))  ENGINE = InnoDB";

	$this->db->query($tabla1);
	$this->db->query($tabla2);
	$this->db->query($tabla3);
	$this->db->query($tabla4);
	
	$this->db->query(
		"INSERT INTO `v2greenmetricenerfirstdataa` (`campus_gmtcfst`,
			`fecha_gmtcfst`, `mes_gmtcfst`, `consumo_gmtcfst`, `costo_gmtcfst`)
	(SELECT DISTINCT
            c.campus,
            (a.periodo_fin),
            MONTHNAME(a.periodo_fin),
			SUM(a.consumo),
			SUM(a.costo)
			FROM `pdc_consumo_energia` a
			INNER JOIN `ctrl_servicios` b ON a.servicio = b.id 
			INNER JOIN `pdc_servicios_energia` c ON b.account = c.cuenta 
			WHERE c.campus IS NOT NULL AND c.campus <> ''
			AND a.periodo_fin IS NOT NULL AND a.periodo_fin <> ''
			AND a.consumo IS NOT NULL AND a.consumo <> ''
			AND a.costo IS NOT NULL AND a.costo <> ''
			AND b.account IS NOT NULL AND b.account <> ''
			AND a.servicio IS NOT NULL AND a.servicio <> ''
			AND (YEAR(a.periodo_fin) >= 2015 AND YEAR(a.periodo_fin) <= YEAR(NOW() - INTERVAL 1 YEAR) )
			GROUP BY a.periodo_fin, c.campus
			ORDER BY DATE(a.periodo_fin) ASC, c.campus ASC)
	ON DUPLICATE KEY UPDATE
    campus_gmtcfst = VALUES(campus_gmtcfst),
	fecha_gmtcfst = VALUES(fecha_gmtcfst), mes_gmtcfst = VALUES(mes_gmtcfst),
    consumo_gmtcfst = VALUES(consumo_gmtcfst), costo_gmtcfst = VALUES(costo_gmtcfst)");

	$this->db->query(
		"INSERT INTO `v2greenmetricenertemp11`
		SELECT
		CONCAT(`campus_gmtcfst`),
		CONCAT(YEAR(`fecha_gmtcfst`)),
		CASE WHEN `mes_gmtcfst`= 'January' THEN `consumo_gmtcfst` END,
		CASE WHEN `mes_gmtcfst`= 'February' THEN `consumo_gmtcfst` END,
		CASE WHEN `mes_gmtcfst`= 'March' THEN `consumo_gmtcfst` END,
		CASE WHEN `mes_gmtcfst`= 'April' THEN `consumo_gmtcfst` END,
		CASE WHEN `mes_gmtcfst`= 'May' THEN `consumo_gmtcfst` END,
		CASE WHEN `mes_gmtcfst`= 'June' THEN `consumo_gmtcfst` END,
		CASE WHEN `mes_gmtcfst`= 'July' THEN `consumo_gmtcfst` END,
		CASE WHEN `mes_gmtcfst`= 'August' THEN `consumo_gmtcfst` END,
		CASE WHEN `mes_gmtcfst`= 'September' THEN `consumo_gmtcfst` END,
		CASE WHEN `mes_gmtcfst`= 'October' THEN `consumo_gmtcfst` END,
		CASE WHEN `mes_gmtcfst`= 'November' THEN `consumo_gmtcfst` END,
		CASE WHEN `mes_gmtcfst`= 'December' THEN `consumo_gmtcfst` END
		FROM  `v2greenmetricenerfirstdataa`
		WHERE TRUE");

	$this->db->query(
		"INSERT INTO `v2greenmetricenertemp22`
			SELECT
			`campus_gmtt1`,
			`anogmtt1`,
			SUM(`enero`),
			SUM(`febrero`),
			SUM(`marzo`),
			SUM(`abril`),
			SUM(`mayo`),
			SUM(`junio`),
			SUM(`julio`),
			SUM(`agosto`),
			SUM(`septiembre`),
			SUM(`octubre`),
			SUM(`noviembre`),
			SUM(`diciembre`)
			FROM `v2greenmetricenertemp11`
			GROUP BY `campus_gmtt1`, `anogmtt1` ASC");

	$this->db->query(
		"INSERT INTO `v2greenmetricenerfinalgraff`(
		`campus_gmtfinal`, `year_gmtfinal`, `Enero`, `Febrero`, `Marzo`, `Abril`, `Mayo`, `Junio`, `Julio`,
		`Agosto`, `Septiembre`, `Octubre`, `Noviembre`, `Diciembre`)
		(SELECT
		`campus_gmtt2`,
		`anogmtt2`,
		COALESCE(`enero`,0) AS Enero,
		COALESCE(`febrero`,0) AS Febrero,
		COALESCE(`marzo`,0) AS Marzo,
		COALESCE(`abril`,0) AS Abril,
		COALESCE(`mayo`,0) AS Mayo,
		COALESCE(`junio`,0) AS Junio,
		COALESCE(`julio`,0) AS Julio,
		COALESCE(`agosto`,0) AS Agosto,
		COALESCE(`septiembre`,0) AS Septiembre,
		COALESCE(`octubre`,0) AS Octubre,
		COALESCE(`noviembre`,0) AS Noviembre,
		COALESCE(`diciembre`,0) AS Diciembre
        FROM `v2greenmetricenertemp22`)
		ON DUPLICATE KEY UPDATE
		campus_gmtfinal = VALUES(campus_gmtfinal),
		year_gmtfinal = VALUES(year_gmtfinal),
		Enero = VALUES(Enero), Febrero = VALUES(Febrero), Marzo = VALUES(Marzo), Abril = VALUES(Abril),
		Mayo = VALUES(Mayo), Junio = VALUES(Junio), Julio = VALUES(Julio), Agosto = VALUES(Agosto),
		Septiembre = VALUES(Septiembre), Octubre = VALUES(Octubre), Noviembre = VALUES(Noviembre),
		Diciembre = VALUES(Diciembre)");
	$this->db->trans_complete();
}
//*************************************FIN DE LA TRANSACCION*************************************//

//ELIMINA LAS TABLAS PARA GENERAR NUEVOS DATOS//
function droprelecxcampusv2()
{
	$this->db->query("DROP TABLE  v2greenmetricenerfirstdataa;");
	$this->db->query("DROP TABLE  v2greenmetricenertemp11;");
	$this->db->query("DROP TABLE  v2greenmetricenertemp22;");
	$this->db->query("DROP TABLE  v2greenmetricenerfinalgraff;");
}


//*********************************MODELO CARGADOR COMBOBOX ELECTRICIDAD X CAMPUS FINAL*********************************//
function elecxcampusfinalv2()
{
	
	$this->db->order_by('campus_gmtfinal', 'asc');
	$this->db->group_by('campus_gmtfinal');
	$query = $this->db->get('v2greenmetricenerfinalgraff');
	if($query->num_rows()>0) {
		foreach($query->result() as $row) {
			$campus_gmtfinal[$row->id] = $row;
			
		}
		return $campus_gmtfinal;

	}
}




function elecxcampusresultadov2()
{
	$campus_gmtfinal = $this->input->post("campus_gmtfinal");
	//MANDA RESULTADOS SI SE SELECCIONA LA DEPENDENCIA//
	if(!empty($campus_gmtfinal))
	{
		$this->db->where('campus_gmtfinal', $campus_gmtfinal);
		$this->db->order_by('year_gmtfinal', 'asc');
		$query = $this->db->get('v2greenmetricenerfinalgraff');
				
			if ($query->num_rows()>0)
			{
				foreach($query->result() as $row)
				{
					$year_gmtfinal[$row->id] = $row;
				}
				return $year_gmtfinal;
			}
			else return false;
	}

}



////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//Realiza la sumatoria del consumo, dependiendo del mes en la vista tar_om_final_x_mepo TARIFA OM
function Eneroelecxcampustotv2($campus_gmtfinal)
{


	if(!empty($campus_gmtfinal))
	{
		$this->db->where('campus_gmtfinal', $campus_gmtfinal);
		$this->db->select_sum('Enero');
		$query = $this->db->get('v2greenmetricenerfinalgraff');
		$result = $query->row()->Enero;
		return $result;
	}

}

function Febreroelecxcampustotv2($campus_gmtfinal)
{


	if(!empty($campus_gmtfinal))
	{
		$this->db->where('campus_gmtfinal', $campus_gmtfinal);
		$this->db->select_sum('Febrero');
		$query = $this->db->get('v2greenmetricenerfinalgraff');
		$result = $query->row()->Febrero;
		return $result;
	}

}

function Marzoelecxcampustotv2($campus_gmtfinal)
{


	if(!empty($campus_gmtfinal))
	{
		$this->db->where('campus_gmtfinal', $campus_gmtfinal);
		$this->db->select_sum('Marzo');
		$query = $this->db->get('v2greenmetricenerfinalgraff');
		$result = $query->row()->Marzo;
		return $result;
	}

}

function Abrilelecxcampustotv2($campus_gmtfinal)
{


	if(!empty($campus_gmtfinal))
	{
		$this->db->where('campus_gmtfinal', $campus_gmtfinal);
		$this->db->select_sum('Abril');
		$query = $this->db->get('v2greenmetricenerfinalgraff');
		$result = $query->row()->Abril;
		return $result;
	}

}

function Mayoelecxcampustotv2($campus_gmtfinal)
{


	if(!empty($campus_gmtfinal))
	{
		$this->db->where('campus_gmtfinal', $campus_gmtfinal);
		$this->db->select_sum('Mayo');
		$query = $this->db->get('v2greenmetricenerfinalgraff');
		$result = $query->row()->Mayo;
		return $result;
	}

}

function Junioelecxcampustotv2($campus_gmtfinal)
{


	if(!empty($campus_gmtfinal))
	{
		$this->db->where('campus_gmtfinal', $campus_gmtfinal);
		$this->db->select_sum('Junio');
		$query = $this->db->get('v2greenmetricenerfinalgraff');
		$result = $query->row()->Junio;
		return $result;
	}

}

function Julioelecxcampustotv2($campus_gmtfinal)
{


	if(!empty($campus_gmtfinal))
	{
		$this->db->where('campus_gmtfinal', $campus_gmtfinal);
		$this->db->select_sum('Julio');
		$query = $this->db->get('v2greenmetricenerfinalgraff');
		$result = $query->row()->Julio;
		return $result;
	}

}

function Agostoelecxcampustotv2($campus_gmtfinal)
{


	if(!empty($campus_gmtfinal))
	{
		$this->db->where('campus_gmtfinal', $campus_gmtfinal);
		$this->db->select_sum('Agosto');
		$query = $this->db->get('v2greenmetricenerfinalgraff');
		$result = $query->row()->Agosto;
		return $result;
	}

}

function Septiembreelecxcampustotv2($campus_gmtfinal)
{


	if(!empty($campus_gmtfinal))
	{
		$this->db->where('campus_gmtfinal', $campus_gmtfinal);
		$this->db->select_sum('Septiembre');
		$query = $this->db->get('v2greenmetricenerfinalgraff');
		$result = $query->row()->Septiembre;
		return $result;
	}

}

function Octubreelecxcampustotv2($campus_gmtfinal)
{


	if(!empty($campus_gmtfinal))
	{
		$this->db->where('campus_gmtfinal', $campus_gmtfinal);
		$this->db->select_sum('Octubre');
		$query = $this->db->get('v2greenmetricenerfinalgraff');
		$result = $query->row()->Octubre;
		return $result;
	}

}

function Noviembreelecxcampustotv2($campus_gmtfinal)
{


	if(!empty($campus_gmtfinal))
	{
		$this->db->where('campus_gmtfinal', $campus_gmtfinal);
		$this->db->select_sum('Noviembre');
		$query = $this->db->get('v2greenmetricenerfinalgraff');
		$result = $query->row()->Noviembre;
		return $result;
	}

}

function Diciembreelecxcampustotv2($campus_gmtfinal)
{


	if(!empty($campus_gmtfinal))
	{
		$this->db->where('campus_gmtfinal', $campus_gmtfinal);
		$this->db->select_sum('Diciembre');
		$query = $this->db->get('v2greenmetricenerfinalgraff');
		$result = $query->row()->Diciembre;
		return $result;
	}

}
/***************************************************************************************************************************/
			/*FIN DE CONSUMO EN ENERGIA 2015 A LA FECHA PARA LOS CAMPUS (Green Metric AJUSTE UN AÑO MENOR AL ACTUAL)*/
/***************************************************************************************************************************/



/***************************************************************************************************************************/
						/*INICIO DE CONSUMO EN ENERGIA 2011 A LA FECHA PARA LOS CAMPUS (Green Metric)*/
/***************************************************************************************************************************/

//CREA LAS TABLAS DE pdctarifaomgpo_x_mepo, temp_om_1, temp_om_2 y pdc_tar_om_final_x_mepo. TAMBIEN HACE LA INSERCION DE DATOS CORRESPONDIENTES A LAS MISMAS//
function conelecxcampusnonGM()
{
	$this->db->trans_start();
	$tabla1= "CREATE TABLE IF NOT EXISTS `nongreenmetricenerfirstdataa` (`id` INT NOT NULL AUTO_INCREMENT,
				`campus_nongmtcfst` VARCHAR(55) NOT NULL , `fecha_nongmtcfst` VARCHAR(15) NOT NULL,
				`mes_nongmtcfst` VARCHAR(15) NOT NULL, `consumo_nongmtcfst` DECIMAL(30,2) NOT NULL,
			    `costo_nongmtcfst` DECIMAL(30,2) NOT NULL, PRIMARY KEY (`id`),
			    UNIQUE `consumonongmt` (`id`))  ENGINE = InnoDB";

	$tabla2= "CREATE TABLE IF NOT EXISTS `nongreenmetricenertemp11` 
	(`campus_nongmtt1` VARCHAR(100), `anonongmtt1` INT, `enero` DECIMAL(30,2) NOT NULL, `febrero` DECIMAL(30,2) NOT NULL,
	`marzo` DECIMAL(30,2) NOT NULL, `abril` DECIMAL(30,2) NOT NULL, `mayo` DECIMAL(30,2) NOT NULL, `junio` DECIMAL(30,2) NOT NULL,
	`julio` DECIMAL(30,2) NOT NULL, `agosto` DECIMAL(30,2) NOT NULL, `septiembre` DECIMAL(30,2) NOT NULL,
    `octubre` DECIMAL(30,2) NOT NULL, `noviembre` DECIMAL(30,2) NOT NULL, `diciembre` DECIMAL(30,2) NOT NULL)";

	$tabla3= "CREATE TABLE IF NOT EXISTS `nongreenmetricenertemp22`
	 (`campus_nongmtt2` VARCHAR(100), `anonongmtt2` INT, `enero` FLOAT, `febrero` FLOAT , `marzo` FLOAT, `abril` FLOAT, `mayo` FLOAT,
	 `junio` FLOAT, `julio` FLOAT, `agosto` FLOAT, `septiembre` FLOAT, `octubre` FLOAT, `noviembre` FLOAT, `diciembre` FLOAT)";

	$tabla4= "CREATE TABLE IF NOT EXISTS `nongreenmetricenerfinalgraff`  (`id` INT NOT NULL AUTO_INCREMENT ,
				`campus_nongmtfinal` VARCHAR(55) NOT NULL,  `year_nongmtfinal` YEAR NOT NULL,
			    `Enero` INT(30) NOT NULL, `Febrero` INT(30) NOT NULL, `Marzo` INT(30) NOT NULL, `Abril` INT(30) NOT NULL,
                `Mayo` INT(30) NOT NULL, `Junio` INT(30) NOT NULL, `Julio` INT(30) NOT NULL, `Agosto` INT(30) NOT NULL,
                `Septiembre` INT(30) NOT NULL, `Octubre` INT(30) NOT NULL, `Noviembre` INT(30) NOT NULL,
                `Diciembre` INT(30) NOT NULL, PRIMARY KEY (`id`), UNIQUE `enenongmtfinal` (`id`))  ENGINE = InnoDB";

	$this->db->query($tabla1);
	$this->db->query($tabla2);
	$this->db->query($tabla3);
	$this->db->query($tabla4);
	
	$this->db->query(
		"INSERT INTO `nongreenmetricenerfirstdataa` (`campus_nongmtcfst`,
			`fecha_nongmtcfst`, `mes_nongmtcfst`, `consumo_nongmtcfst`, `costo_nongmtcfst`)
	(SELECT DISTINCT
            c.campus,
            (a.periodo_fin),
            MONTHNAME(a.periodo_fin),
			SUM(a.consumo),
			SUM(a.costo)
			FROM `pdc_consumo_energia` a
			INNER JOIN `ctrl_servicios` b ON a.servicio = b.id 
			INNER JOIN `pdc_servicios_energia` c ON b.account = c.cuenta 
			WHERE c.campus IS NOT NULL AND c.campus <> ''
			AND a.periodo_fin IS NOT NULL AND a.periodo_fin <> ''
			AND a.consumo IS NOT NULL AND a.consumo <> ''
			AND a.costo IS NOT NULL AND a.costo <> ''
			AND b.account IS NOT NULL AND b.account <> ''
			AND a.servicio IS NOT NULL AND a.servicio <> ''
			AND (YEAR(a.periodo_fin) >= 2011 AND YEAR(a.periodo_fin) <= YEAR(NOW()) )
			GROUP BY a.periodo_fin, c.campus
			ORDER BY DATE(a.periodo_fin) ASC, c.campus ASC)
	ON DUPLICATE KEY UPDATE
    campus_nongmtcfst = VALUES(campus_nongmtcfst),
	fecha_nongmtcfst = VALUES(fecha_nongmtcfst), mes_nongmtcfst = VALUES(mes_nongmtcfst),
    consumo_nongmtcfst = VALUES(consumo_nongmtcfst), costo_nongmtcfst = VALUES(costo_nongmtcfst)");

	$this->db->query(
		"INSERT INTO `nongreenmetricenertemp11`
		SELECT
		CONCAT(`campus_nongmtcfst`),
		CONCAT(YEAR(`fecha_nongmtcfst`)),
		CASE WHEN `mes_nongmtcfst`= 'January' THEN `consumo_nongmtcfst` END,
		CASE WHEN `mes_nongmtcfst`= 'February' THEN `consumo_nongmtcfst` END,
		CASE WHEN `mes_nongmtcfst`= 'March' THEN `consumo_nongmtcfst` END,
		CASE WHEN `mes_nongmtcfst`= 'April' THEN `consumo_nongmtcfst` END,
		CASE WHEN `mes_nongmtcfst`= 'May' THEN `consumo_nongmtcfst` END,
		CASE WHEN `mes_nongmtcfst`= 'June' THEN `consumo_nongmtcfst` END,
		CASE WHEN `mes_nongmtcfst`= 'July' THEN `consumo_nongmtcfst` END,
		CASE WHEN `mes_nongmtcfst`= 'August' THEN `consumo_nongmtcfst` END,
		CASE WHEN `mes_nongmtcfst`= 'September' THEN `consumo_nongmtcfst` END,
		CASE WHEN `mes_nongmtcfst`= 'October' THEN `consumo_nongmtcfst` END,
		CASE WHEN `mes_nongmtcfst`= 'November' THEN `consumo_nongmtcfst` END,
		CASE WHEN `mes_nongmtcfst`= 'December' THEN `consumo_nongmtcfst` END
		FROM  `nongreenmetricenerfirstdataa`
		WHERE TRUE");

	$this->db->query(
		"INSERT INTO `nongreenmetricenertemp22`
			SELECT
			`campus_nongmtt1`,
			`anonongmtt1`,
			SUM(`enero`),
			SUM(`febrero`),
			SUM(`marzo`),
			SUM(`abril`),
			SUM(`mayo`),
			SUM(`junio`),
			SUM(`julio`),
			SUM(`agosto`),
			SUM(`septiembre`),
			SUM(`octubre`),
			SUM(`noviembre`),
			SUM(`diciembre`)
			FROM `nongreenmetricenertemp11`
			GROUP BY `campus_nongmtt1`, `anonongmtt1` ASC");

	$this->db->query(
		"INSERT INTO `nongreenmetricenerfinalgraff`(
		`campus_nongmtfinal`, `year_nongmtfinal`, `Enero`, `Febrero`, `Marzo`, `Abril`, `Mayo`, `Junio`, `Julio`,
		`Agosto`, `Septiembre`, `Octubre`, `Noviembre`, `Diciembre`)
		(SELECT 
		`campus_nongmtt2`,
		`anonongmtt2`,
		COALESCE(`enero`,0) AS Enero,
		COALESCE(`febrero`,0) AS Febrero,
		COALESCE(`marzo`,0) AS Marzo,
		COALESCE(`abril`,0) AS Abril,	
		COALESCE(`mayo`,0) AS Mayo,
		COALESCE(`junio`,0) AS Junio,
		COALESCE(`julio`,0) AS Julio,
		COALESCE(`agosto`,0) AS Agosto,
		COALESCE(`septiembre`,0) AS Septiembre,
		COALESCE(`octubre`,0) AS Octubre,
		COALESCE(`noviembre`,0) AS Noviembre,
		COALESCE(`diciembre`,0) AS Diciembre
        FROM `nongreenmetricenertemp22`)
		ON DUPLICATE KEY UPDATE
		campus_nongmtfinal = VALUES(campus_nongmtfinal),
		year_nongmtfinal = VALUES(year_nongmtfinal),
		Enero = VALUES(Enero), Febrero = VALUES(Febrero), Marzo = VALUES(Marzo), Abril = VALUES(Abril),
		Mayo = VALUES(Mayo), Junio = VALUES(Junio), Julio = VALUES(Julio), Agosto = VALUES(Agosto),
		Septiembre = VALUES(Septiembre), Octubre = VALUES(Octubre), Noviembre = VALUES(Noviembre),
		Diciembre = VALUES(Diciembre)");
	$this->db->trans_complete();
}
//*************************************FIN DE LA TRANSACCION*************************************//

//ELIMINA LAS TABLAS PARA GENERAR NUEVOS DATOS//
function droprelecxcampusnonGM()
{
	$this->db->query("DROP TABLE  nongreenmetricenerfirstdataa;");
	$this->db->query("DROP TABLE  nongreenmetricenertemp11;");
	$this->db->query("DROP TABLE  nongreenmetricenertemp22;");
	$this->db->query("DROP TABLE  nongreenmetricenerfinalgraff;");
}


//*********************************MODELO CARGADOR COMBOBOX ELECTRICIDAD X CAMPUS FINAL*********************************//
function elecxcampusfinalnonGM()
{
	
	$this->db->order_by('campus_nongmtfinal', 'asc');
	$this->db->group_by('campus_nongmtfinal');
	$query = $this->db->get('nongreenmetricenerfinalgraff');
	if($query->num_rows()>0) {
		foreach($query->result() as $row) {
			$campus_nongmtfinal[$row->id] = $row;
			
		}
		return $campus_nongmtfinal;

	}
}


function elecxcampusresultadononGM()
{
	$campus_nongmtfinal = $this->input->post("campus_nongmtfinal");
	//MANDA RESULTADOS SI SE SELECCIONA LA DEPENDENCIA//
	if(!empty($campus_nongmtfinal))
	{
		$this->db->where('campus_nongmtfinal', $campus_nongmtfinal);
		$this->db->order_by('year_nongmtfinal', 'asc');
		$query = $this->db->get('nongreenmetricenerfinalgraff');
				
			if ($query->num_rows()>0)
			{
				foreach($query->result() as $row)
				{
					$year_nongmtfinal[$row->id] = $row;
				}
				return $year_nongmtfinal;
			}
			else return false;
	}

}


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//Realiza la sumatoria del consumo, dependiendo del mes en la vista tar_om_final_x_mepo TARIFA OM
function EneroelecxcampustotnonGM($campus_nongmtfinal)
{


	if(!empty($campus_nongmtfinal))
	{
		$this->db->where('campus_nongmtfinal', $campus_nongmtfinal);
		$this->db->select_sum('Enero');
		$query = $this->db->get('nongreenmetricenerfinalgraff');
		$result = $query->row()->Enero;
		return $result;
	}

}

function FebreroelecxcampustotnonGM($campus_nongmtfinal)
{


	if(!empty($campus_nongmtfinal))
	{
		$this->db->where('campus_nongmtfinal', $campus_nongmtfinal);
		$this->db->select_sum('Febrero');
		$query = $this->db->get('nongreenmetricenerfinalgraff');
		$result = $query->row()->Febrero;
		return $result;
	}

}

function MarzoelecxcampustotnonGM($campus_nongmtfinal)
{


	if(!empty($campus_nongmtfinal))
	{
		$this->db->where('campus_nongmtfinal', $campus_nongmtfinal);
		$this->db->select_sum('Marzo');
		$query = $this->db->get('nongreenmetricenerfinalgraff');
		$result = $query->row()->Marzo;
		return $result;
	}

}

function AbrilelecxcampustotnonGM($campus_nongmtfinal)
{


	if(!empty($campus_nongmtfinal))
	{
		$this->db->where('campus_nongmtfinal', $campus_nongmtfinal);
		$this->db->select_sum('Abril');
		$query = $this->db->get('nongreenmetricenerfinalgraff');
		$result = $query->row()->Abril;
		return $result;
	}

}

function MayoelecxcampustotnonGM($campus_nongmtfinal)
{


	if(!empty($campus_nongmtfinal))
	{
		$this->db->where('campus_nongmtfinal', $campus_nongmtfinal);
		$this->db->select_sum('Mayo');
		$query = $this->db->get('nongreenmetricenerfinalgraff');
		$result = $query->row()->Mayo;
		return $result;
	}

}

function JunioelecxcampustotnonGM($campus_nongmtfinal)
{


	if(!empty($campus_nongmtfinal))
	{
		$this->db->where('campus_nongmtfinal', $campus_nongmtfinal);
		$this->db->select_sum('Junio');
		$query = $this->db->get('nongreenmetricenerfinalgraff');
		$result = $query->row()->Junio;
		return $result;
	}

}

function JulioelecxcampustotnonGM($campus_nongmtfinal)
{


	if(!empty($campus_nongmtfinal))
	{
		$this->db->where('campus_nongmtfinal', $campus_nongmtfinal);
		$this->db->select_sum('Julio');
		$query = $this->db->get('nongreenmetricenerfinalgraff');
		$result = $query->row()->Julio;
		return $result;
	}

}

function AgostoelecxcampustotnonGM($campus_nongmtfinal)
{


	if(!empty($campus_nongmtfinal))
	{
		$this->db->where('campus_nongmtfinal', $campus_nongmtfinal);
		$this->db->select_sum('Agosto');
		$query = $this->db->get('nongreenmetricenerfinalgraff');
		$result = $query->row()->Agosto;
		return $result;
	}

}

function SeptiembreelecxcampustotnonGM($campus_nongmtfinal)
{


	if(!empty($campus_nongmtfinal))
	{
		$this->db->where('campus_nongmtfinal', $campus_nongmtfinal);
		$this->db->select_sum('Septiembre');
		$query = $this->db->get('nongreenmetricenerfinalgraff');
		$result = $query->row()->Septiembre;
		return $result;
	}

}

function OctubreelecxcampustotnonGM($campus_nongmtfinal)
{


	if(!empty($campus_nongmtfinal))
	{
		$this->db->where('campus_nongmtfinal', $campus_nongmtfinal);
		$this->db->select_sum('Octubre');
		$query = $this->db->get('nongreenmetricenerfinalgraff');
		$result = $query->row()->Octubre;
		return $result;
	}

}

function NoviembreelecxcampustotnonGM($campus_nongmtfinal)
{


	if(!empty($campus_nongmtfinal))
	{
		$this->db->where('campus_nongmtfinal', $campus_nongmtfinal);
		$this->db->select_sum('Noviembre');
		$query = $this->db->get('nongreenmetricenerfinalgraff');
		$result = $query->row()->Noviembre;
		return $result;
	}

}

function DiciembreelecxcampustotnonGM($campus_nongmtfinal)
{


	if(!empty($campus_nongmtfinal))
	{
		$this->db->where('campus_nongmtfinal', $campus_nongmtfinal);
		$this->db->select_sum('Diciembre');
		$query = $this->db->get('nongreenmetricenerfinalgraff');
		$result = $query->row()->Diciembre;
		return $result;
	}

}
/***************************************************************************************************************************/
							/*FIN DE CONSUMO EN ENERGIA 2015 A LA FECHA PARA LOS CAMPUS*/
/***************************************************************************************************************************/
function creacione_factore_gm()
	{

		$this->db->trans_start();
			$start1=	"CREATE TABLE IF NOT EXISTS `gmpdc_factor_gei_all` ( `id` INT NOT NULL AUTO_INCREMENT,	
			`gmtheyear` YEAR NOT NULL,
			`gmcantidad_alumnos` INT(15) NOT NULL,
			`gmemisionesa` FLOAT NOT NULL,
			`gmemisiones` FLOAT NOT NULL,
			`gmemisionesg` FLOAT NOT NULL,
			`gmtemperatura` FLOAT NOT NULL,
			`gmkwcapitayear` FLOAT NOT NULL,
			`gmkgcapitayear` FLOAT NOT NULL,
			`gmrawkw` FLOAT NOT NULL,
			`gmrawkwxgei` FLOAT NOT NULL,
		    `gmm3wtrcapitayear` FLOAT NOT NULL,
		    `gmwtrkgcapitayear` FLOAT NOT NULL,
		    `gmrawm3wtr` FLOAT NOT NULL,
		    `gmrawm3wtrxgei` FLOAT NOT NULL,
		    `gmm3gascapitayear` FLOAT NOT NULL,
		    `gmgaskgcapitayear` FLOAT NOT NULL,
		    `gmrawm3gas` FLOAT NOT NULL,
		    `gmrawm3gasxgei` FLOAT NOT NULL,
			PRIMARY KEY (`id`), UNIQUE `gmyearini` (`gmtheyear`)) ENGINE = InnoDB";

		$this->db->query($start1);

		$this->db->query("INSERT INTO `gmpdc_factor_gei_all` (gmtheyear, gmcantidad_alumnos, gmemisionesa, gmemisiones, gmemisionesg, gmtemperatura, gmkwcapitayear, gmkgcapitayear, gmrawkw, gmrawkwxgei, gmm3wtrcapitayear, gmwtrkgcapitayear, gmrawm3wtr, gmrawm3wtrxgei, gmm3gascapitayear, gmgaskgcapitayear, gmrawm3gas, gmrawm3gasxgei)
			(SELECT `theyear`, `cantidad_alumnos`, `emisionesa`, `emisiones`, `emisionesg`, `temperatura`, `kwcapitayear`,
			`kgcapitayear`, `rawkw`, `rawkwxgei`, `m3wtrcapitayear`, `wtrkgcapitayear`, `rawm3wtr`, `rawm3wtrxgei`, `m3gascapitayear`,
		    `gaskgcapitayear`, `rawm3gas`, `rawm3gasxgei` FROM `pdc_factor_gei_all` WHERE theyear<=NOW() - INTERVAL 1 YEAR)
		    ON DUPLICATE KEY UPDATE id = VALUES(ID),
		    gmtheyear = VALUES(gmtheyear), gmcantidad_alumnos = VALUES(gmcantidad_alumnos), gmemisionesa = VALUES(gmemisionesa),
		    gmemisiones = VALUES(gmemisiones), gmemisionesg = VALUES(gmemisionesg), gmtemperatura = VALUES(gmtemperatura),
		    gmkwcapitayear = VALUES(gmkwcapitayear), gmkgcapitayear = VALUES(gmkgcapitayear), gmrawkw = VALUES(gmrawkw),
		    gmrawkwxgei = VALUES(gmrawkwxgei), gmm3wtrcapitayear = VALUES(gmm3wtrcapitayear), gmwtrkgcapitayear = VALUES(gmwtrkgcapitayear),
		    gmrawm3wtr = VALUES(gmrawm3wtr), gmrawm3wtrxgei = VALUES(gmrawm3wtrxgei), gmm3gascapitayear = VALUES(gmm3gascapitayear),
		    gmgaskgcapitayear = VALUES(gmgaskgcapitayear), gmrawm3gas = VALUES(gmrawm3gas), gmrawm3gasxgei = VALUES(gmrawm3gasxgei)");

		$this->db->trans_complete();
	}
	//CARGA LA TABLA PARA metricas_gei_elec_gm.php
	function load_gei_table_gm()
	{

		if(empty($year))
		{
			//$this->db->select('gmtheyear, gmkwcapitayear, gmkgcapitayear, gmtemperatura');
			$this->db->select('v2gmtheyear, v2gmkwcapitayear, v2gmkgcapitayear, v2gmtemperatura');
			//$query = $this->db->get('gmpdc_factor_gei_all');
			$query = $this->db->get('gmpdcfactorgeiallv2');
			return $query->result();
			

		}

	}

function drope_creacione_factore_gm()
{
	$this->db->query("DROP TABLE IF EXISTS  `gmpdc_factor_gei_all`;");
}

/****************************************************************************************/
/****************************************************************************************/
function creacionefactoregmv2()
{
	$this->db->trans_start();
	$tablass1= "CREATE TABLE IF NOT EXISTS `gmpdcfactorgeiallv2` ( `id` INT NOT NULL AUTO_INCREMENT,	
			`v2gmtheyear` YEAR NOT NULL,
			`v2gmcantidad_alumnos` INT(15) NOT NULL,
			`v2gmemisionesa` FLOAT NOT NULL,
			`v2gmemisiones` FLOAT NOT NULL,
			`v2gmemisionesg` FLOAT NOT NULL,
			`v2gmtemperatura` FLOAT NOT NULL,
			`v2gmkwcapitayear` FLOAT NOT NULL,
			`v2gmkgcapitayear` FLOAT NOT NULL,
			`v2gmrawkw` FLOAT NOT NULL,
			`v2gmrawkwxgei` FLOAT NOT NULL,
		    `v2gmm3wtrcapitayear` FLOAT NOT NULL,
		    `v2gmwtrkgcapitayear` FLOAT NOT NULL,
		    `v2gmrawm3wtr` FLOAT NOT NULL,
		    `v2gmrawm3wtrxgei` FLOAT NOT NULL,
		    `v2gmm3gascapitayear` FLOAT NOT NULL,
		    `v2gmgaskgcapitayear` FLOAT NOT NULL,
		    `v2gmrawm3gas` FLOAT NOT NULL,
		    `v2gmrawm3gasxgei` FLOAT NOT NULL,
			PRIMARY KEY (`id`), UNIQUE `gmidi` (`id`)) ENGINE = InnoDB";

	$this->db->query($tablass1);
	
	$this->db->query(
		"INSERT INTO `gmpdcfactorgeiallv2` (v2gmtheyear, v2gmcantidad_alumnos, v2gmemisionesa, v2gmemisiones, v2gmemisionesg, v2gmtemperatura, v2gmkwcapitayear, v2gmkgcapitayear,
		v2gmrawkw, v2gmrawkwxgei, v2gmm3wtrcapitayear, v2gmwtrkgcapitayear, v2gmrawm3wtr, v2gmrawm3wtrxgei, v2gmm3gascapitayear, v2gmgaskgcapitayear, v2gmrawm3gas, v2gmrawm3gasxgei)
			(SELECT `theyear`, `cantidad_alumnos`, `emisionesa`, `emisiones`, `emisionesg`, `temperatura`, `kwcapitayear`,
			`kgcapitayear`, `rawkw`, `rawkwxgei`, `m3wtrcapitayear`, `wtrkgcapitayear`, `rawm3wtr`, `rawm3wtrxgei`, `m3gascapitayear`,
		    `gaskgcapitayear`, `rawm3gas`, `rawm3gasxgei` FROM `pdc_factor_gei_all` WHERE theyear<=NOW() - INTERVAL 1 YEAR)
		    ON DUPLICATE KEY UPDATE id = VALUES(ID),
		    v2gmtheyear = VALUES(v2gmtheyear), v2gmcantidad_alumnos = VALUES(v2gmcantidad_alumnos), v2gmemisionesa = VALUES(v2gmemisionesa),
		    v2gmemisiones = VALUES(v2gmemisiones), v2gmemisionesg = VALUES(v2gmemisionesg), v2gmtemperatura = VALUES(v2gmtemperatura),
		    v2gmkwcapitayear = VALUES(v2gmkwcapitayear), v2gmkgcapitayear = VALUES(v2gmkgcapitayear), v2gmrawkw = VALUES(v2gmrawkw),
		    v2gmrawkwxgei = VALUES(v2gmrawkwxgei), v2gmm3wtrcapitayear = VALUES(v2gmm3wtrcapitayear), v2gmwtrkgcapitayear = VALUES(v2gmwtrkgcapitayear),
		    v2gmrawm3wtr = VALUES(v2gmrawm3wtr), v2gmrawm3wtrxgei = VALUES(v2gmrawm3wtrxgei), v2gmm3gascapitayear = VALUES(v2gmm3gascapitayear),
		    v2gmgaskgcapitayear = VALUES(v2gmgaskgcapitayear), v2gmrawm3gas = VALUES(v2gmrawm3gas), v2gmrawm3gasxgei = VALUES(v2gmrawm3gasxgei)");

	$this->db->trans_complete();
}
//*************************************FIN DE LA TRANSACCION*************************************//

//ELIMINA LAS TABLAS PARA GENERAR NUEVOS DATOS//
function dropecreacionefactoregmV2()
{
	$this->db->query("DROP TABLE gmpdcfactorgeiallv2;");
}
/****************************************************************************************/
	function load_gei_table_gmv2()
	{

		if(empty($year))
		{
			$this->db->select('v2gmtheyear, v2gmkwcapitayear, v2gmkgcapitayear, v2gmtemperatura');
			$query = $this->db->get('gmpdcfactorgeiallv2');
			return $query->result();
			

		}

	}
/****************************************************************************************/
/***************************************************************************************************************************/
		/*INICIO DE CONSUMO EN AGUA 2015 A LA FECHA PARA LOS CAMPUS (Green Metric AJUSTE UN AÑO MENOR AL ACTUAL)*/
/***************************************************************************************************************************/

//CREA LAS TABLAS DE pdctarifaomgpo_x_mepo, temp_om_1, temp_om_2 y pdc_tar_om_final_x_mepo. TAMBIEN HACE LA INSERCION DE DATOS CORRESPONDIENTES A LAS MISMAS//
function conaguaxcampusv2()
{
	$this->db->trans_start();
	$tabla1= "CREATE TABLE IF NOT EXISTS `v2greenmetricaguafirstdataa` (`id` INT NOT NULL AUTO_INCREMENT,
				`campus_gmtcfst` VARCHAR(55) NOT NULL , `fecha_gmtcfst` VARCHAR(15) NOT NULL,
				`mes_gmtcfst` VARCHAR(15) NOT NULL, `consumo_gmtcfst` DECIMAL(30,2) NOT NULL,
			    `costo_gmtcfst` DECIMAL(30,2) NOT NULL, PRIMARY KEY (`id`),
			    UNIQUE `v2consumogmt` (`id`))  ENGINE = InnoDB";

	$tabla2= "CREATE TABLE IF NOT EXISTS `v2greenmetricaguatemp11` 
	(`campus_gmtt1` VARCHAR(100), `anogmtt1` INT, `enero` DECIMAL(30,2) NOT NULL, `febrero` DECIMAL(30,2) NOT NULL,
	`marzo` DECIMAL(30,2) NOT NULL, `abril` DECIMAL(30,2) NOT NULL, `mayo` DECIMAL(30,2) NOT NULL, `junio` DECIMAL(30,2) NOT NULL,
	`julio` DECIMAL(30,2) NOT NULL, `agosto` DECIMAL(30,2) NOT NULL, `septiembre` DECIMAL(30,2) NOT NULL,
    `octubre` DECIMAL(30,2) NOT NULL, `noviembre` DECIMAL(30,2) NOT NULL, `diciembre` DECIMAL(30,2) NOT NULL)";

	$tabla3= "CREATE TABLE IF NOT EXISTS `v2greenmetricaguatemp22`
	 (`campus_gmtt2` VARCHAR(100), `anogmtt2` INT, `enero` FLOAT, `febrero` FLOAT , `marzo` FLOAT, `abril` FLOAT, `mayo` FLOAT,
	 `junio` FLOAT, `julio` FLOAT, `agosto` FLOAT, `septiembre` FLOAT, `octubre` FLOAT, `noviembre` FLOAT, `diciembre` FLOAT)";

	$tabla4= "CREATE TABLE IF NOT EXISTS `v2greenmetricaguafinalgraff`  (`id` INT NOT NULL AUTO_INCREMENT ,
				`campus_gmtfinal` VARCHAR(55) NOT NULL,  `year_gmtfinal` YEAR NOT NULL,
			    `Enero` INT(30) NOT NULL, `Febrero` INT(30) NOT NULL, `Marzo` INT(30) NOT NULL, `Abril` INT(30) NOT NULL,
                `Mayo` INT(30) NOT NULL, `Junio` INT(30) NOT NULL, `Julio` INT(30) NOT NULL, `Agosto` INT(30) NOT NULL,
                `Septiembre` INT(30) NOT NULL, `Octubre` INT(30) NOT NULL, `Noviembre` INT(30) NOT NULL,
                `Diciembre` INT(30) NOT NULL, PRIMARY KEY (`id`), UNIQUE `enegmtfinal` (`id`))  ENGINE = InnoDB";

	$this->db->query($tabla1);
	$this->db->query($tabla2);
	$this->db->query($tabla3);
	$this->db->query($tabla4);
	
	$this->db->query(
		"INSERT INTO `v2greenmetricaguafirstdataa` (`campus_gmtcfst`,
			`fecha_gmtcfst`, `mes_gmtcfst`, `consumo_gmtcfst`, `costo_gmtcfst`)
	(SELECT DISTINCT
            c.campus,
            (a.periodo_fin),
            MONTHNAME(a.periodo_fin),
			SUM(a.consumo),
			SUM(a.costo)
			FROM `pdc_consumo_agua` a
			INNER JOIN `ctrl_servicios_agua` b ON a.servicio = b.id 
			INNER JOIN `pdc_servicios_agua` c ON b.account = c.cuenta 
			WHERE c.campus IS NOT NULL AND c.campus <> ''
			AND a.periodo_fin IS NOT NULL AND a.periodo_fin <> ''
			AND a.consumo IS NOT NULL AND a.consumo <> ''
			AND a.costo IS NOT NULL AND a.costo <> ''
			AND b.account IS NOT NULL AND b.account <> ''
			AND a.servicio IS NOT NULL AND a.servicio <> ''
			AND (YEAR(a.periodo_fin) >= 2015 AND YEAR(a.periodo_fin) <= YEAR(NOW() - INTERVAL 1 YEAR) )
			GROUP BY a.periodo_fin, c.campus
			ORDER BY DATE(a.periodo_fin) ASC, c.campus ASC)
	ON DUPLICATE KEY UPDATE
    campus_gmtcfst = VALUES(campus_gmtcfst),
	fecha_gmtcfst = VALUES(fecha_gmtcfst), mes_gmtcfst = VALUES(mes_gmtcfst),
    consumo_gmtcfst = VALUES(consumo_gmtcfst), costo_gmtcfst = VALUES(costo_gmtcfst)");

	$this->db->query(
		"INSERT INTO `v2greenmetricaguatemp11`
		SELECT
		CONCAT(`campus_gmtcfst`),
		CONCAT(YEAR(`fecha_gmtcfst`)),
		CASE WHEN `mes_gmtcfst`= 'January' THEN `consumo_gmtcfst` END,
		CASE WHEN `mes_gmtcfst`= 'February' THEN `consumo_gmtcfst` END,
		CASE WHEN `mes_gmtcfst`= 'March' THEN `consumo_gmtcfst` END,
		CASE WHEN `mes_gmtcfst`= 'April' THEN `consumo_gmtcfst` END,
		CASE WHEN `mes_gmtcfst`= 'May' THEN `consumo_gmtcfst` END,
		CASE WHEN `mes_gmtcfst`= 'June' THEN `consumo_gmtcfst` END,
		CASE WHEN `mes_gmtcfst`= 'July' THEN `consumo_gmtcfst` END,
		CASE WHEN `mes_gmtcfst`= 'August' THEN `consumo_gmtcfst` END,
		CASE WHEN `mes_gmtcfst`= 'September' THEN `consumo_gmtcfst` END,
		CASE WHEN `mes_gmtcfst`= 'October' THEN `consumo_gmtcfst` END,
		CASE WHEN `mes_gmtcfst`= 'November' THEN `consumo_gmtcfst` END,
		CASE WHEN `mes_gmtcfst`= 'December' THEN `consumo_gmtcfst` END
		FROM  `v2greenmetricaguafirstdataa`
		WHERE TRUE");

	$this->db->query(
		"INSERT INTO `v2greenmetricaguatemp22`
			SELECT
			`campus_gmtt1`,
			`anogmtt1`,
			SUM(`enero`),
			SUM(`febrero`),
			SUM(`marzo`),
			SUM(`abril`),
			SUM(`mayo`),
			SUM(`junio`),
			SUM(`julio`),
			SUM(`agosto`),
			SUM(`septiembre`),
			SUM(`octubre`),
			SUM(`noviembre`),
			SUM(`diciembre`)
			FROM `v2greenmetricaguatemp11`
			GROUP BY `campus_gmtt1`, `anogmtt1` ASC");

	$this->db->query(
		"INSERT INTO `v2greenmetricaguafinalgraff`(
		`campus_gmtfinal`, `year_gmtfinal`, `Enero`, `Febrero`, `Marzo`, `Abril`, `Mayo`, `Junio`, `Julio`,
		`Agosto`, `Septiembre`, `Octubre`, `Noviembre`, `Diciembre`)
		(SELECT
		`campus_gmtt2`,
		`anogmtt2`,
		COALESCE(`enero`,0) AS Enero,
		COALESCE(`febrero`,0) AS Febrero,
		COALESCE(`marzo`,0) AS Marzo,
		COALESCE(`abril`,0) AS Abril,
		COALESCE(`mayo`,0) AS Mayo,
		COALESCE(`junio`,0) AS Junio,
		COALESCE(`julio`,0) AS Julio,
		COALESCE(`agosto`,0) AS Agosto,
		COALESCE(`septiembre`,0) AS Septiembre,
		COALESCE(`octubre`,0) AS Octubre,
		COALESCE(`noviembre`,0) AS Noviembre,
		COALESCE(`diciembre`,0) AS Diciembre
        FROM `v2greenmetricaguatemp22`)
		ON DUPLICATE KEY UPDATE
		campus_gmtfinal = VALUES(campus_gmtfinal),
		year_gmtfinal = VALUES(year_gmtfinal),
		Enero = VALUES(Enero), Febrero = VALUES(Febrero), Marzo = VALUES(Marzo), Abril = VALUES(Abril),
		Mayo = VALUES(Mayo), Junio = VALUES(Junio), Julio = VALUES(Julio), Agosto = VALUES(Agosto),
		Septiembre = VALUES(Septiembre), Octubre = VALUES(Octubre), Noviembre = VALUES(Noviembre),
		Diciembre = VALUES(Diciembre)");
	$this->db->trans_complete();
}
//*************************************FIN DE LA TRANSACCION*************************************//

//ELIMINA LAS TABLAS PARA GENERAR NUEVOS DATOS//
function dropraguaxcampusv2()
{
	$this->db->query("DROP TABLE  v2greenmetricaguafirstdataa;");
	$this->db->query("DROP TABLE  v2greenmetricaguatemp11;");
	$this->db->query("DROP TABLE  v2greenmetricaguatemp22;");
	$this->db->query("DROP TABLE  v2greenmetricaguafinalgraff;");
}


//*********************************MODELO CARGADOR COMBOBOX ELECTRICIDAD X CAMPUS FINAL*********************************//
function aguaxcampusfinalv2()
{
	
	$this->db->order_by('campus_gmtfinal', 'asc');
	$this->db->group_by('campus_gmtfinal');
	$query = $this->db->get('v2greenmetricaguafinalgraff');
	if($query->num_rows()>0) {
		foreach($query->result() as $row) {
			$campus_gmtfinal[$row->id] = $row;
			
		}
		return $campus_gmtfinal;

	}
}




function aguaxcampusresultadov2()
{
	$campus_gmtfinal = $this->input->post("campus_gmtfinal");
	//MANDA RESULTADOS SI SE SELECCIONA LA DEPENDENCIA//
	if(!empty($campus_gmtfinal))
	{
		$this->db->where('campus_gmtfinal', $campus_gmtfinal);
		$this->db->order_by('year_gmtfinal', 'asc');
		$query = $this->db->get('v2greenmetricaguafinalgraff');
				
			if ($query->num_rows()>0)
			{
				foreach($query->result() as $row)
				{
					$year_gmtfinal[$row->id] = $row;
				}
				return $year_gmtfinal;
			}
			else return false;
	}

}



////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//Realiza la sumatoria del consumo, dependiendo del mes en la vista tar_om_final_x_mepo TARIFA OM
function Eneroaguaxcampustotv2($campus_gmtfinal)
{


	if(!empty($campus_gmtfinal))
	{
		$this->db->where('campus_gmtfinal', $campus_gmtfinal);
		$this->db->select_sum('Enero');
		$query = $this->db->get('v2greenmetricaguafinalgraff');
		$result = $query->row()->Enero;
		return $result;
	}

}

function Febreroaguaxcampustotv2($campus_gmtfinal)
{


	if(!empty($campus_gmtfinal))
	{
		$this->db->where('campus_gmtfinal', $campus_gmtfinal);
		$this->db->select_sum('Febrero');
		$query = $this->db->get('v2greenmetricaguafinalgraff');
		$result = $query->row()->Febrero;
		return $result;
	}

}

function Marzoaguaxcampustotv2($campus_gmtfinal)
{


	if(!empty($campus_gmtfinal))
	{
		$this->db->where('campus_gmtfinal', $campus_gmtfinal);
		$this->db->select_sum('Marzo');
		$query = $this->db->get('v2greenmetricaguafinalgraff');
		$result = $query->row()->Marzo;
		return $result;
	}

}

function Abrilaguaxcampustotv2($campus_gmtfinal)
{


	if(!empty($campus_gmtfinal))
	{
		$this->db->where('campus_gmtfinal', $campus_gmtfinal);
		$this->db->select_sum('Abril');
		$query = $this->db->get('v2greenmetricaguafinalgraff');
		$result = $query->row()->Abril;
		return $result;
	}

}

function Mayoaguaxcampustotv2($campus_gmtfinal)
{


	if(!empty($campus_gmtfinal))
	{
		$this->db->where('campus_gmtfinal', $campus_gmtfinal);
		$this->db->select_sum('Mayo');
		$query = $this->db->get('v2greenmetricaguafinalgraff');
		$result = $query->row()->Mayo;
		return $result;
	}

}

function Junioaguaxcampustotv2($campus_gmtfinal)
{


	if(!empty($campus_gmtfinal))
	{
		$this->db->where('campus_gmtfinal', $campus_gmtfinal);
		$this->db->select_sum('Junio');
		$query = $this->db->get('v2greenmetricaguafinalgraff');
		$result = $query->row()->Junio;
		return $result;
	}

}

function Julioaguaxcampustotv2($campus_gmtfinal)
{


	if(!empty($campus_gmtfinal))
	{
		$this->db->where('campus_gmtfinal', $campus_gmtfinal);
		$this->db->select_sum('Julio');
		$query = $this->db->get('v2greenmetricaguafinalgraff');
		$result = $query->row()->Julio;
		return $result;
	}

}

function Agostoaguaxcampustotv2($campus_gmtfinal)
{


	if(!empty($campus_gmtfinal))
	{
		$this->db->where('campus_gmtfinal', $campus_gmtfinal);
		$this->db->select_sum('Agosto');
		$query = $this->db->get('v2greenmetricaguafinalgraff');
		$result = $query->row()->Agosto;
		return $result;
	}

}

function Septiembreaguaxcampustotv2($campus_gmtfinal)
{


	if(!empty($campus_gmtfinal))
	{
		$this->db->where('campus_gmtfinal', $campus_gmtfinal);
		$this->db->select_sum('Septiembre');
		$query = $this->db->get('v2greenmetricaguafinalgraff');
		$result = $query->row()->Septiembre;
		return $result;
	}

}

function Octubreaguaxcampustotv2($campus_gmtfinal)
{


	if(!empty($campus_gmtfinal))
	{
		$this->db->where('campus_gmtfinal', $campus_gmtfinal);
		$this->db->select_sum('Octubre');
		$query = $this->db->get('v2greenmetricaguafinalgraff');
		$result = $query->row()->Octubre;
		return $result;
	}

}

function Noviembreaguaxcampustotv2($campus_gmtfinal)
{


	if(!empty($campus_gmtfinal))
	{
		$this->db->where('campus_gmtfinal', $campus_gmtfinal);
		$this->db->select_sum('Noviembre');
		$query = $this->db->get('v2greenmetricaguafinalgraff');
		$result = $query->row()->Noviembre;
		return $result;
	}

}

function Diciembreaguaxcampustotv2($campus_gmtfinal)
{


	if(!empty($campus_gmtfinal))
	{
		$this->db->where('campus_gmtfinal', $campus_gmtfinal);
		$this->db->select_sum('Diciembre');
		$query = $this->db->get('v2greenmetricaguafinalgraff');
		$result = $query->row()->Diciembre;
		return $result;
	}

}
/***************************************************************************************************************************/
			/*FIN DE CONSUMO EN AGUA 2015 A LA FECHA PARA LOS CAMPUS (Green Metric AJUSTE UN AÑO MENOR AL ACTUAL)*/
/***************************************************************************************************************************/



/***************************************************************************************************************************/
						/*INICIO DE CONSUMO EN AGUA 2011 A LA FECHA PARA LOS CAMPUS (Green Metric)*/
/***************************************************************************************************************************/

//CREA LAS TABLAS DE pdctarifaomgpo_x_mepo, temp_om_1, temp_om_2 y pdc_tar_om_final_x_mepo. TAMBIEN HACE LA INSERCION DE DATOS CORRESPONDIENTES A LAS MISMAS//
function conaguaxcampusnonGM()
{
	$this->db->trans_start();
	$tabla1= "CREATE TABLE IF NOT EXISTS `nongreenmetricaguafirstdataa` (`id` INT NOT NULL AUTO_INCREMENT,
				`campus_nongmtcfst` VARCHAR(55) NOT NULL , `fecha_nongmtcfst` VARCHAR(15) NOT NULL,
				`mes_nongmtcfst` VARCHAR(15) NOT NULL, `consumo_nongmtcfst` DECIMAL(30,2) NOT NULL,
			    `costo_nongmtcfst` DECIMAL(30,2) NOT NULL, PRIMARY KEY (`id`),
			    UNIQUE `consumonongmt` (`id`))  ENGINE = InnoDB";

	$tabla2= "CREATE TABLE IF NOT EXISTS `nongreenmetricaguatemp11` 
	(`campus_nongmtt1` VARCHAR(100), `anonongmtt1` INT, `enero` DECIMAL(30,2) NOT NULL, `febrero` DECIMAL(30,2) NOT NULL,
	`marzo` DECIMAL(30,2) NOT NULL, `abril` DECIMAL(30,2) NOT NULL, `mayo` DECIMAL(30,2) NOT NULL, `junio` DECIMAL(30,2) NOT NULL,
	`julio` DECIMAL(30,2) NOT NULL, `agosto` DECIMAL(30,2) NOT NULL, `septiembre` DECIMAL(30,2) NOT NULL,
    `octubre` DECIMAL(30,2) NOT NULL, `noviembre` DECIMAL(30,2) NOT NULL, `diciembre` DECIMAL(30,2) NOT NULL)";

	$tabla3= "CREATE TABLE IF NOT EXISTS `nongreenmetricaguatemp22`
	 (`campus_nongmtt2` VARCHAR(100), `anonongmtt2` INT, `enero` FLOAT, `febrero` FLOAT , `marzo` FLOAT, `abril` FLOAT, `mayo` FLOAT,
	 `junio` FLOAT, `julio` FLOAT, `agosto` FLOAT, `septiembre` FLOAT, `octubre` FLOAT, `noviembre` FLOAT, `diciembre` FLOAT)";

	$tabla4= "CREATE TABLE IF NOT EXISTS `nongreenmetricaguafinalgraff`  (`id` INT NOT NULL AUTO_INCREMENT ,
				`campus_nongmtfinal` VARCHAR(55) NOT NULL,  `year_nongmtfinal` YEAR NOT NULL,
			    `Enero` INT(30) NOT NULL, `Febrero` INT(30) NOT NULL, `Marzo` INT(30) NOT NULL, `Abril` INT(30) NOT NULL,
                `Mayo` INT(30) NOT NULL, `Junio` INT(30) NOT NULL, `Julio` INT(30) NOT NULL, `Agosto` INT(30) NOT NULL,
                `Septiembre` INT(30) NOT NULL, `Octubre` INT(30) NOT NULL, `Noviembre` INT(30) NOT NULL,
                `Diciembre` INT(30) NOT NULL, PRIMARY KEY (`id`), UNIQUE `enenongmtfinal` (`id`))  ENGINE = InnoDB";

	$this->db->query($tabla1);
	$this->db->query($tabla2);
	$this->db->query($tabla3);
	$this->db->query($tabla4);
	
	$this->db->query(
		"INSERT INTO `nongreenmetricaguafirstdataa` (`campus_nongmtcfst`,
			`fecha_nongmtcfst`, `mes_nongmtcfst`, `consumo_nongmtcfst`, `costo_nongmtcfst`)
	(SELECT DISTINCT
            c.campus,
            (a.periodo_fin),
            MONTHNAME(a.periodo_fin),
			SUM(a.consumo),
			SUM(a.costo)
			FROM `pdc_consumo_agua` a
			INNER JOIN `ctrl_servicios_agua` b ON a.servicio = b.id 
			INNER JOIN `pdc_servicios_agua` c ON b.account = c.cuenta 
			WHERE c.campus IS NOT NULL AND c.campus <> ''
			AND a.periodo_fin IS NOT NULL AND a.periodo_fin <> ''
			AND a.consumo IS NOT NULL AND a.consumo <> ''
			AND a.costo IS NOT NULL AND a.costo <> ''
			AND b.account IS NOT NULL AND b.account <> ''
			AND a.servicio IS NOT NULL AND a.servicio <> ''
			AND (YEAR(a.periodo_fin) >= 2011 AND YEAR(a.periodo_fin) <= YEAR(NOW()) )
			GROUP BY a.periodo_fin, c.campus
			ORDER BY DATE(a.periodo_fin) ASC, c.campus ASC)
	ON DUPLICATE KEY UPDATE
    campus_nongmtcfst = VALUES(campus_nongmtcfst),
	fecha_nongmtcfst = VALUES(fecha_nongmtcfst), mes_nongmtcfst = VALUES(mes_nongmtcfst),
    consumo_nongmtcfst = VALUES(consumo_nongmtcfst), costo_nongmtcfst = VALUES(costo_nongmtcfst)");

	$this->db->query(
		"INSERT INTO `nongreenmetricaguatemp11`
		SELECT
		CONCAT(`campus_nongmtcfst`),
		CONCAT(YEAR(`fecha_nongmtcfst`)),
		CASE WHEN `mes_nongmtcfst`= 'January' THEN `consumo_nongmtcfst` END,
		CASE WHEN `mes_nongmtcfst`= 'February' THEN `consumo_nongmtcfst` END,
		CASE WHEN `mes_nongmtcfst`= 'March' THEN `consumo_nongmtcfst` END,
		CASE WHEN `mes_nongmtcfst`= 'April' THEN `consumo_nongmtcfst` END,
		CASE WHEN `mes_nongmtcfst`= 'May' THEN `consumo_nongmtcfst` END,
		CASE WHEN `mes_nongmtcfst`= 'June' THEN `consumo_nongmtcfst` END,
		CASE WHEN `mes_nongmtcfst`= 'July' THEN `consumo_nongmtcfst` END,
		CASE WHEN `mes_nongmtcfst`= 'August' THEN `consumo_nongmtcfst` END,
		CASE WHEN `mes_nongmtcfst`= 'September' THEN `consumo_nongmtcfst` END,
		CASE WHEN `mes_nongmtcfst`= 'October' THEN `consumo_nongmtcfst` END,
		CASE WHEN `mes_nongmtcfst`= 'November' THEN `consumo_nongmtcfst` END,
		CASE WHEN `mes_nongmtcfst`= 'December' THEN `consumo_nongmtcfst` END
		FROM  `nongreenmetricaguafirstdataa`
		WHERE TRUE");

	$this->db->query(
		"INSERT INTO `nongreenmetricaguatemp22`
			SELECT
			`campus_nongmtt1`,
			`anonongmtt1`,
			SUM(`enero`),
			SUM(`febrero`),
			SUM(`marzo`),
			SUM(`abril`),
			SUM(`mayo`),
			SUM(`junio`),
			SUM(`julio`),
			SUM(`agosto`),
			SUM(`septiembre`),
			SUM(`octubre`),
			SUM(`noviembre`),
			SUM(`diciembre`)
			FROM `nongreenmetricaguatemp11`
			GROUP BY `campus_nongmtt1`, `anonongmtt1` ASC");

	$this->db->query(
		"INSERT INTO `nongreenmetricaguafinalgraff`(
		`campus_nongmtfinal`, `year_nongmtfinal`, `Enero`, `Febrero`, `Marzo`, `Abril`, `Mayo`, `Junio`, `Julio`,
		`Agosto`, `Septiembre`, `Octubre`, `Noviembre`, `Diciembre`)
		(SELECT 
		`campus_nongmtt2`,
		`anonongmtt2`,
		COALESCE(`enero`,0) AS Enero,
		COALESCE(`febrero`,0) AS Febrero,
		COALESCE(`marzo`,0) AS Marzo,
		COALESCE(`abril`,0) AS Abril,	
		COALESCE(`mayo`,0) AS Mayo,
		COALESCE(`junio`,0) AS Junio,
		COALESCE(`julio`,0) AS Julio,
		COALESCE(`agosto`,0) AS Agosto,
		COALESCE(`septiembre`,0) AS Septiembre,
		COALESCE(`octubre`,0) AS Octubre,
		COALESCE(`noviembre`,0) AS Noviembre,
		COALESCE(`diciembre`,0) AS Diciembre
        FROM `nongreenmetricaguatemp22`)
		ON DUPLICATE KEY UPDATE
		campus_nongmtfinal = VALUES(campus_nongmtfinal),
		year_nongmtfinal = VALUES(year_nongmtfinal),
		Enero = VALUES(Enero), Febrero = VALUES(Febrero), Marzo = VALUES(Marzo), Abril = VALUES(Abril),
		Mayo = VALUES(Mayo), Junio = VALUES(Junio), Julio = VALUES(Julio), Agosto = VALUES(Agosto),
		Septiembre = VALUES(Septiembre), Octubre = VALUES(Octubre), Noviembre = VALUES(Noviembre),
		Diciembre = VALUES(Diciembre)");
	$this->db->trans_complete();
}
//*************************************FIN DE LA TRANSACCION*************************************//

//ELIMINA LAS TABLAS PARA GENERAR NUEVOS DATOS//
function dropraguaxcampusnonGM()
{
	$this->db->query("DROP TABLE  nongreenmetricaguafirstdataa;");
	$this->db->query("DROP TABLE  nongreenmetricaguatemp11;");
	$this->db->query("DROP TABLE  nongreenmetricaguatemp22;");
	$this->db->query("DROP TABLE  nongreenmetricaguafinalgraff;");
}


//*********************************MODELO CARGADOR COMBOBOX ELECTRICIDAD X CAMPUS FINAL*********************************//
function aguaxcampusfinalnonGM()
{
	
	$this->db->order_by('campus_nongmtfinal', 'asc');
	$this->db->group_by('campus_nongmtfinal');
	$query = $this->db->get('nongreenmetricaguafinalgraff');
	if($query->num_rows()>0) {
		foreach($query->result() as $row) {
			$campus_nongmtfinal[$row->id] = $row;
			
		}
		return $campus_nongmtfinal;

	}
}


function aguaxcampusresultadononGM()
{
	$campus_nongmtfinal = $this->input->post("campus_nongmtfinal");
	//MANDA RESULTADOS SI SE SELECCIONA LA DEPENDENCIA//
	if(!empty($campus_nongmtfinal))
	{
		$this->db->where('campus_nongmtfinal', $campus_nongmtfinal);
		$this->db->order_by('year_nongmtfinal', 'asc');
		$query = $this->db->get('nongreenmetricaguafinalgraff');
				
			if ($query->num_rows()>0)
			{
				foreach($query->result() as $row)
				{
					$year_nongmtfinal[$row->id] = $row;
				}
				return $year_nongmtfinal;
			}
			else return false;
	}

}


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//Realiza la sumatoria del consumo, dependiendo del mes en la vista tar_om_final_x_mepo TARIFA OM
function EneroaguaxcampustotnonGM($campus_nongmtfinal)
{


	if(!empty($campus_nongmtfinal))
	{
		$this->db->where('campus_nongmtfinal', $campus_nongmtfinal);
		$this->db->select_sum('Enero');
		$query = $this->db->get('nongreenmetricaguafinalgraff');
		$result = $query->row()->Enero;
		return $result;
	}

}

function FebreroaguaxcampustotnonGM($campus_nongmtfinal)
{


	if(!empty($campus_nongmtfinal))
	{
		$this->db->where('campus_nongmtfinal', $campus_nongmtfinal);
		$this->db->select_sum('Febrero');
		$query = $this->db->get('nongreenmetricaguafinalgraff');
		$result = $query->row()->Febrero;
		return $result;
	}

}

function MarzoaguaxcampustotnonGM($campus_nongmtfinal)
{


	if(!empty($campus_nongmtfinal))
	{
		$this->db->where('campus_nongmtfinal', $campus_nongmtfinal);
		$this->db->select_sum('Marzo');
		$query = $this->db->get('nongreenmetricaguafinalgraff');
		$result = $query->row()->Marzo;
		return $result;
	}

}

function AbrilaguaxcampustotnonGM($campus_nongmtfinal)
{


	if(!empty($campus_nongmtfinal))
	{
		$this->db->where('campus_nongmtfinal', $campus_nongmtfinal);
		$this->db->select_sum('Abril');
		$query = $this->db->get('nongreenmetricaguafinalgraff');
		$result = $query->row()->Abril;
		return $result;
	}

}

function MayoaguaxcampustotnonGM($campus_nongmtfinal)
{


	if(!empty($campus_nongmtfinal))
	{
		$this->db->where('campus_nongmtfinal', $campus_nongmtfinal);
		$this->db->select_sum('Mayo');
		$query = $this->db->get('nongreenmetricaguafinalgraff');
		$result = $query->row()->Mayo;
		return $result;
	}

}

function JunioaguaxcampustotnonGM($campus_nongmtfinal)
{


	if(!empty($campus_nongmtfinal))
	{
		$this->db->where('campus_nongmtfinal', $campus_nongmtfinal);
		$this->db->select_sum('Junio');
		$query = $this->db->get('nongreenmetricaguafinalgraff');
		$result = $query->row()->Junio;
		return $result;
	}

}

function JulioaguaxcampustotnonGM($campus_nongmtfinal)
{


	if(!empty($campus_nongmtfinal))
	{
		$this->db->where('campus_nongmtfinal', $campus_nongmtfinal);
		$this->db->select_sum('Julio');
		$query = $this->db->get('nongreenmetricaguafinalgraff');
		$result = $query->row()->Julio;
		return $result;
	}

}

function AgostoaguaxcampustotnonGM($campus_nongmtfinal)
{


	if(!empty($campus_nongmtfinal))
	{
		$this->db->where('campus_nongmtfinal', $campus_nongmtfinal);
		$this->db->select_sum('Agosto');
		$query = $this->db->get('nongreenmetricaguafinalgraff');
		$result = $query->row()->Agosto;
		return $result;
	}

}

function SeptiembreaguaxcampustotnonGM($campus_nongmtfinal)
{


	if(!empty($campus_nongmtfinal))
	{
		$this->db->where('campus_nongmtfinal', $campus_nongmtfinal);
		$this->db->select_sum('Septiembre');
		$query = $this->db->get('nongreenmetricaguafinalgraff');
		$result = $query->row()->Septiembre;
		return $result;
	}

}

function OctubreaguaxcampustotnonGM($campus_nongmtfinal)
{


	if(!empty($campus_nongmtfinal))
	{
		$this->db->where('campus_nongmtfinal', $campus_nongmtfinal);
		$this->db->select_sum('Octubre');
		$query = $this->db->get('nongreenmetricaguafinalgraff');
		$result = $query->row()->Octubre;
		return $result;
	}

}

function NoviembreaguaxcampustotnonGM($campus_nongmtfinal)
{


	if(!empty($campus_nongmtfinal))
	{
		$this->db->where('campus_nongmtfinal', $campus_nongmtfinal);
		$this->db->select_sum('Noviembre');
		$query = $this->db->get('nongreenmetricaguafinalgraff');
		$result = $query->row()->Noviembre;
		return $result;
	}

}

function DiciembreaguaxcampustotnonGM($campus_nongmtfinal)
{


	if(!empty($campus_nongmtfinal))
	{
		$this->db->where('campus_nongmtfinal', $campus_nongmtfinal);
		$this->db->select_sum('Diciembre');
		$query = $this->db->get('nongreenmetricaguafinalgraff');
		$result = $query->row()->Diciembre;
		return $result;
	}

}
/***************************************************************************************************************************/
							/*FIN DE CONSUMO EN AGUA 2011 A LA FECHA PARA LOS CAMPUS*/
/***************************************************************************************************************************/

/***************************************************************************************************************************/
		/*INICIO DE CONSUMO EN GAS 2015 A LA FECHA PARA LOS CAMPUS (Green Metric AJUSTE UN AÑO MENOR AL ACTUAL)*/
/***************************************************************************************************************************/

//CREA LAS TABLAS DE pdctarifaomgpo_x_mepo, temp_om_1, temp_om_2 y pdc_tar_om_final_x_mepo. TAMBIEN HACE LA INSERCION DE DATOS CORRESPONDIENTES A LAS MISMAS//
function congaasxcampusv2()
{
	$this->db->trans_start();
	$tabla1= "CREATE TABLE IF NOT EXISTS `v2greenmetricgaasfirstdataa` (`id` INT NOT NULL AUTO_INCREMENT,
				`campus_gmtcfst` VARCHAR(55) NOT NULL , `fecha_gmtcfst` VARCHAR(15) NOT NULL,
				`mes_gmtcfst` VARCHAR(15) NOT NULL, `consumo_gmtcfst` DECIMAL(30,2) NOT NULL,
			    `costo_gmtcfst` DECIMAL(30,2) NOT NULL, PRIMARY KEY (`id`),
			    UNIQUE `v2consumogmt` (`id`))  ENGINE = InnoDB";

	$tabla2= "CREATE TABLE IF NOT EXISTS `v2greenmetricgaastemp11` 
	(`campus_gmtt1` VARCHAR(100), `anogmtt1` INT, `enero` DECIMAL(30,2) NOT NULL, `febrero` DECIMAL(30,2) NOT NULL,
	`marzo` DECIMAL(30,2) NOT NULL, `abril` DECIMAL(30,2) NOT NULL, `mayo` DECIMAL(30,2) NOT NULL, `junio` DECIMAL(30,2) NOT NULL,
	`julio` DECIMAL(30,2) NOT NULL, `agosto` DECIMAL(30,2) NOT NULL, `septiembre` DECIMAL(30,2) NOT NULL,
    `octubre` DECIMAL(30,2) NOT NULL, `noviembre` DECIMAL(30,2) NOT NULL, `diciembre` DECIMAL(30,2) NOT NULL)";

	$tabla3= "CREATE TABLE IF NOT EXISTS `v2greenmetricgaastemp22`
	 (`campus_gmtt2` VARCHAR(100), `anogmtt2` INT, `enero` FLOAT, `febrero` FLOAT , `marzo` FLOAT, `abril` FLOAT, `mayo` FLOAT,
	 `junio` FLOAT, `julio` FLOAT, `agosto` FLOAT, `septiembre` FLOAT, `octubre` FLOAT, `noviembre` FLOAT, `diciembre` FLOAT)";

	$tabla4= "CREATE TABLE IF NOT EXISTS `v2greenmetricgaasfinalgraff`  (`id` INT NOT NULL AUTO_INCREMENT ,
				`campus_gmtfinal` VARCHAR(55) NOT NULL,  `year_gmtfinal` YEAR NOT NULL,
			    `Enero` INT(30) NOT NULL, `Febrero` INT(30) NOT NULL, `Marzo` INT(30) NOT NULL, `Abril` INT(30) NOT NULL,
                `Mayo` INT(30) NOT NULL, `Junio` INT(30) NOT NULL, `Julio` INT(30) NOT NULL, `Agosto` INT(30) NOT NULL,
                `Septiembre` INT(30) NOT NULL, `Octubre` INT(30) NOT NULL, `Noviembre` INT(30) NOT NULL,
                `Diciembre` INT(30) NOT NULL, PRIMARY KEY (`id`), UNIQUE `enegmtfinal` (`id`))  ENGINE = InnoDB";

	$this->db->query($tabla1);
	$this->db->query($tabla2);
	$this->db->query($tabla3);
	$this->db->query($tabla4);
	
	$this->db->query(
		"INSERT INTO `v2greenmetricgaasfirstdataa` (`campus_gmtcfst`,
			`fecha_gmtcfst`, `mes_gmtcfst`, `consumo_gmtcfst`, `costo_gmtcfst`)
	(SELECT DISTINCT
            c.campus,
            (a.periodo_fin),
            MONTHNAME(a.periodo_fin),
			SUM(a.consumo),
			SUM(a.costo)
			FROM `pdc_consumo_gas` a
			INNER JOIN `ctrl_servicios_gas` b ON a.servicio = b.id 
			INNER JOIN `pdc_servicios_gas` c ON b.account = c.cuenta 
			WHERE c.campus IS NOT NULL AND c.campus <> ''
			AND a.periodo_fin IS NOT NULL AND a.periodo_fin <> ''
			AND a.consumo IS NOT NULL AND a.consumo <> ''
			AND a.costo IS NOT NULL AND a.costo <> ''
			AND b.account IS NOT NULL AND b.account <> ''
			AND a.servicio IS NOT NULL AND a.servicio <> ''
			AND (YEAR(a.periodo_fin) >= 2015 AND YEAR(a.periodo_fin) <= YEAR(NOW() - INTERVAL 1 YEAR) )
			GROUP BY a.periodo_fin, c.campus
			ORDER BY DATE(a.periodo_fin) ASC, c.campus ASC)
	ON DUPLICATE KEY UPDATE
    campus_gmtcfst = VALUES(campus_gmtcfst),
	fecha_gmtcfst = VALUES(fecha_gmtcfst), mes_gmtcfst = VALUES(mes_gmtcfst),
    consumo_gmtcfst = VALUES(consumo_gmtcfst), costo_gmtcfst = VALUES(costo_gmtcfst)");

	$this->db->query(
		"INSERT INTO `v2greenmetricgaastemp11`
		SELECT
		CONCAT(`campus_gmtcfst`),
		CONCAT(YEAR(`fecha_gmtcfst`)),
		CASE WHEN `mes_gmtcfst`= 'January' THEN `consumo_gmtcfst` END,
		CASE WHEN `mes_gmtcfst`= 'February' THEN `consumo_gmtcfst` END,
		CASE WHEN `mes_gmtcfst`= 'March' THEN `consumo_gmtcfst` END,
		CASE WHEN `mes_gmtcfst`= 'April' THEN `consumo_gmtcfst` END,
		CASE WHEN `mes_gmtcfst`= 'May' THEN `consumo_gmtcfst` END,
		CASE WHEN `mes_gmtcfst`= 'June' THEN `consumo_gmtcfst` END,
		CASE WHEN `mes_gmtcfst`= 'July' THEN `consumo_gmtcfst` END,
		CASE WHEN `mes_gmtcfst`= 'August' THEN `consumo_gmtcfst` END,
		CASE WHEN `mes_gmtcfst`= 'September' THEN `consumo_gmtcfst` END,
		CASE WHEN `mes_gmtcfst`= 'October' THEN `consumo_gmtcfst` END,
		CASE WHEN `mes_gmtcfst`= 'November' THEN `consumo_gmtcfst` END,
		CASE WHEN `mes_gmtcfst`= 'December' THEN `consumo_gmtcfst` END
		FROM  `v2greenmetricgaasfirstdataa`
		WHERE TRUE");

	$this->db->query(
		"INSERT INTO `v2greenmetricgaastemp22`
			SELECT
			`campus_gmtt1`,
			`anogmtt1`,
			SUM(`enero`),
			SUM(`febrero`),
			SUM(`marzo`),
			SUM(`abril`),
			SUM(`mayo`),
			SUM(`junio`),
			SUM(`julio`),
			SUM(`agosto`),
			SUM(`septiembre`),
			SUM(`octubre`),
			SUM(`noviembre`),
			SUM(`diciembre`)
			FROM `v2greenmetricgaastemp11`
			GROUP BY `campus_gmtt1`, `anogmtt1` ASC");

	$this->db->query(
		"INSERT INTO `v2greenmetricgaasfinalgraff`(
		`campus_gmtfinal`, `year_gmtfinal`, `Enero`, `Febrero`, `Marzo`, `Abril`, `Mayo`, `Junio`, `Julio`,
		`Agosto`, `Septiembre`, `Octubre`, `Noviembre`, `Diciembre`)
		(SELECT
		`campus_gmtt2`,
		`anogmtt2`,
		COALESCE(`enero`,0) AS Enero,
		COALESCE(`febrero`,0) AS Febrero,
		COALESCE(`marzo`,0) AS Marzo,
		COALESCE(`abril`,0) AS Abril,
		COALESCE(`mayo`,0) AS Mayo,
		COALESCE(`junio`,0) AS Junio,
		COALESCE(`julio`,0) AS Julio,
		COALESCE(`agosto`,0) AS Agosto,
		COALESCE(`septiembre`,0) AS Septiembre,
		COALESCE(`octubre`,0) AS Octubre,
		COALESCE(`noviembre`,0) AS Noviembre,
		COALESCE(`diciembre`,0) AS Diciembre
        FROM `v2greenmetricgaastemp22`)
		ON DUPLICATE KEY UPDATE
		campus_gmtfinal = VALUES(campus_gmtfinal),
		year_gmtfinal = VALUES(year_gmtfinal),
		Enero = VALUES(Enero), Febrero = VALUES(Febrero), Marzo = VALUES(Marzo), Abril = VALUES(Abril),
		Mayo = VALUES(Mayo), Junio = VALUES(Junio), Julio = VALUES(Julio), Agosto = VALUES(Agosto),
		Septiembre = VALUES(Septiembre), Octubre = VALUES(Octubre), Noviembre = VALUES(Noviembre),
		Diciembre = VALUES(Diciembre)");
	$this->db->trans_complete();
}
//*************************************FIN DE LA TRANSACCION*************************************//

//ELIMINA LAS TABLAS PARA GENERAR NUEVOS DATOS//
function droprgaasxcampusv2()
{
	$this->db->query("DROP TABLE  v2greenmetricgaasfirstdataa;");
	$this->db->query("DROP TABLE  v2greenmetricgaastemp11;");
	$this->db->query("DROP TABLE  v2greenmetricgaastemp22;");
	$this->db->query("DROP TABLE  v2greenmetricgaasfinalgraff;");
}


//*********************************MODELO CARGADOR COMBOBOX ELECTRICIDAD X CAMPUS FINAL*********************************//
function gaasxcampusfinalv2()
{
	
	$this->db->order_by('campus_gmtfinal', 'asc');
	$this->db->group_by('campus_gmtfinal');
	$query = $this->db->get('v2greenmetricgaasfinalgraff');
	if($query->num_rows()>0) {
		foreach($query->result() as $row) {
			$campus_gmtfinal[$row->id] = $row;
			
		}
		return $campus_gmtfinal;

	}
}




function gaasxcampusresultadov2()
{
	$campus_gmtfinal = $this->input->post("campus_gmtfinal");
	//MANDA RESULTADOS SI SE SELECCIONA LA DEPENDENCIA//
	if(!empty($campus_gmtfinal))
	{
		$this->db->where('campus_gmtfinal', $campus_gmtfinal);
		$this->db->order_by('year_gmtfinal', 'asc');
		$query = $this->db->get('v2greenmetricgaasfinalgraff');
				
			if ($query->num_rows()>0)
			{
				foreach($query->result() as $row)
				{
					$year_gmtfinal[$row->id] = $row;
				}
				return $year_gmtfinal;
			}
			else return false;
	}

}



////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//Realiza la sumatoria del consumo, dependiendo del mes en la vista tar_om_final_x_mepo TARIFA OM
function Enerogaasxcampustotv2($campus_gmtfinal)
{


	if(!empty($campus_gmtfinal))
	{
		$this->db->where('campus_gmtfinal', $campus_gmtfinal);
		$this->db->select_sum('Enero');
		$query = $this->db->get('v2greenmetricgaasfinalgraff');
		$result = $query->row()->Enero;
		return $result;
	}

}

function Febrerogaasxcampustotv2($campus_gmtfinal)
{


	if(!empty($campus_gmtfinal))
	{
		$this->db->where('campus_gmtfinal', $campus_gmtfinal);
		$this->db->select_sum('Febrero');
		$query = $this->db->get('v2greenmetricgaasfinalgraff');
		$result = $query->row()->Febrero;
		return $result;
	}

}

function Marzogaasxcampustotv2($campus_gmtfinal)
{


	if(!empty($campus_gmtfinal))
	{
		$this->db->where('campus_gmtfinal', $campus_gmtfinal);
		$this->db->select_sum('Marzo');
		$query = $this->db->get('v2greenmetricgaasfinalgraff');
		$result = $query->row()->Marzo;
		return $result;
	}

}

function Abrilgaasxcampustotv2($campus_gmtfinal)
{


	if(!empty($campus_gmtfinal))
	{
		$this->db->where('campus_gmtfinal', $campus_gmtfinal);
		$this->db->select_sum('Abril');
		$query = $this->db->get('v2greenmetricgaasfinalgraff');
		$result = $query->row()->Abril;
		return $result;
	}

}

function Mayogaasxcampustotv2($campus_gmtfinal)
{


	if(!empty($campus_gmtfinal))
	{
		$this->db->where('campus_gmtfinal', $campus_gmtfinal);
		$this->db->select_sum('Mayo');
		$query = $this->db->get('v2greenmetricgaasfinalgraff');
		$result = $query->row()->Mayo;
		return $result;
	}

}

function Juniogaasxcampustotv2($campus_gmtfinal)
{


	if(!empty($campus_gmtfinal))
	{
		$this->db->where('campus_gmtfinal', $campus_gmtfinal);
		$this->db->select_sum('Junio');
		$query = $this->db->get('v2greenmetricgaasfinalgraff');
		$result = $query->row()->Junio;
		return $result;
	}

}

function Juliogaasxcampustotv2($campus_gmtfinal)
{


	if(!empty($campus_gmtfinal))
	{
		$this->db->where('campus_gmtfinal', $campus_gmtfinal);
		$this->db->select_sum('Julio');
		$query = $this->db->get('v2greenmetricgaasfinalgraff');
		$result = $query->row()->Julio;
		return $result;
	}

}

function Agostogaasxcampustotv2($campus_gmtfinal)
{


	if(!empty($campus_gmtfinal))
	{
		$this->db->where('campus_gmtfinal', $campus_gmtfinal);
		$this->db->select_sum('Agosto');
		$query = $this->db->get('v2greenmetricgaasfinalgraff');
		$result = $query->row()->Agosto;
		return $result;
	}

}

function Septiembregaasxcampustotv2($campus_gmtfinal)
{


	if(!empty($campus_gmtfinal))
	{
		$this->db->where('campus_gmtfinal', $campus_gmtfinal);
		$this->db->select_sum('Septiembre');
		$query = $this->db->get('v2greenmetricgaasfinalgraff');
		$result = $query->row()->Septiembre;
		return $result;
	}

}

function Octubregaasxcampustotv2($campus_gmtfinal)
{


	if(!empty($campus_gmtfinal))
	{
		$this->db->where('campus_gmtfinal', $campus_gmtfinal);
		$this->db->select_sum('Octubre');
		$query = $this->db->get('v2greenmetricgaasfinalgraff');
		$result = $query->row()->Octubre;
		return $result;
	}

}

function Noviembregaasxcampustotv2($campus_gmtfinal)
{


	if(!empty($campus_gmtfinal))
	{
		$this->db->where('campus_gmtfinal', $campus_gmtfinal);
		$this->db->select_sum('Noviembre');
		$query = $this->db->get('v2greenmetricgaasfinalgraff');
		$result = $query->row()->Noviembre;
		return $result;
	}

}

function Diciembregaasxcampustotv2($campus_gmtfinal)
{


	if(!empty($campus_gmtfinal))
	{
		$this->db->where('campus_gmtfinal', $campus_gmtfinal);
		$this->db->select_sum('Diciembre');
		$query = $this->db->get('v2greenmetricgaasfinalgraff');
		$result = $query->row()->Diciembre;
		return $result;
	}

}
/***************************************************************************************************************************/
			/*FIN DE CONSUMO EN GAS 2015 A LA FECHA PARA LOS CAMPUS (Green Metric AJUSTE UN AÑO MENOR AL ACTUAL)*/
/***************************************************************************************************************************/



/***************************************************************************************************************************/
						/*INICIO DE CONSUMO EN GAS 2011 A LA FECHA PARA LOS CAMPUS (DINSU)*/
/***************************************************************************************************************************/

//CREA LAS TABLAS DE pdctarifaomgpo_x_mepo, temp_om_1, temp_om_2 y pdc_tar_om_final_x_mepo. TAMBIEN HACE LA INSERCION DE DATOS CORRESPONDIENTES A LAS MISMAS//
function congaasxcampusnonGM()
{
	$this->db->trans_start();
	$tabla1= "CREATE TABLE IF NOT EXISTS `nongreenmetricgaasfirstdataa` 
	(`id` INT NOT NULL AUTO_INCREMENT, `campus_nongmtcfst` VARCHAR(55) NOT NULL , `fecha_nongmtcfst` VARCHAR(15) NOT NULL,
	`mes_nongmtcfst` VARCHAR(15) NOT NULL, `consumo_nongmtcfst` DECIMAL(30,2) NOT NULL, `costo_nongmtcfst` DECIMAL(30,2) NOT NULL,
	PRIMARY KEY (`id`), UNIQUE `consumonongmt` (`id`))  ENGINE = InnoDB";

	$tabla2= "CREATE TABLE IF NOT EXISTS `nongreenmetricgaastemp11`
	(`campus_nongmtt1` VARCHAR(100), `anonongmtt1` INT, `enero` DECIMAL(30,2) NOT NULL, `febrero` DECIMAL(30,2) NOT NULL, `marzo` DECIMAL(30,2) NOT NULL, `abril` DECIMAL(30,2) NOT NULL,
    `mayo` DECIMAL(30,2) NOT NULL, `junio` DECIMAL(30,2) NOT NULL, `julio` DECIMAL(30,2) NOT NULL, `agosto` DECIMAL(30,2) NOT NULL, `septiembre` DECIMAL(30,2) NOT NULL,
    `octubre` DECIMAL(30,2) NOT NULL, `noviembre` DECIMAL(30,2) NOT NULL, `diciembre` DECIMAL(30,2) NOT NULL)";

	$tabla3= "CREATE TABLE IF NOT EXISTS `nongreenmetricgaastemp22`
	(`campus_nongmtt2` VARCHAR(100), `anonongmtt2` INT, `enero` FLOAT, `febrero` FLOAT , `marzo` FLOAT, `abril` FLOAT, `mayo` FLOAT, `junio` FLOAT,
	`julio` FLOAT, `agosto` FLOAT, `septiembre` FLOAT, `octubre` FLOAT, `noviembre` FLOAT, `diciembre` FLOAT)";

	$tabla4= "CREATE TABLE IF NOT EXISTS `nongreenmetricgaasfinalgraff`
	(`id` INT NOT NULL AUTO_INCREMENT , `campus_nongmtfinal` VARCHAR(55) NOT NULL,  `year_nongmtfinal` YEAR NOT NULL,
    `Enero` INT(30) NOT NULL, `Febrero` INT(30) NOT NULL, `Marzo` INT(30) NOT NULL, `Abril` INT(30) NOT NULL,
    `Mayo` INT(30) NOT NULL, `Junio` INT(30) NOT NULL, `Julio` INT(30) NOT NULL, `Agosto` INT(30) NOT NULL,
    `Septiembre` INT(30) NOT NULL, `Octubre` INT(30) NOT NULL, `Noviembre` INT(30) NOT NULL,
    `Diciembre` INT(30) NOT NULL, PRIMARY KEY (`id`), UNIQUE `enenongmtfinal` (`id`))  ENGINE = InnoDB";

	$this->db->query($tabla1);
	$this->db->query($tabla2);
	$this->db->query($tabla3);
	$this->db->query($tabla4);
	
	$this->db->query(
		"INSERT INTO `nongreenmetricgaasfirstdataa` (`campus_nongmtcfst`,
			`fecha_nongmtcfst`, `mes_nongmtcfst`, `consumo_nongmtcfst`, `costo_nongmtcfst`)
	(SELECT DISTINCT
            c.campus,
            (a.periodo_fin),
            MONTHNAME(a.periodo_fin),
			SUM(a.consumo),
			SUM(a.costo)
			FROM `pdc_consumo_gas` a
			INNER JOIN `ctrl_servicios_gas` b ON a.servicio = b.id 
			INNER JOIN `pdc_servicios_gas` c ON b.account = c.cuenta 
			WHERE c.campus IS NOT NULL AND c.campus <> ''
			AND a.periodo_fin IS NOT NULL AND a.periodo_fin <> ''
			AND a.consumo IS NOT NULL AND a.consumo <> ''
			AND a.costo IS NOT NULL AND a.costo <> ''
			AND b.account IS NOT NULL AND b.account <> ''
			AND a.servicio IS NOT NULL AND a.servicio <> ''
			AND (YEAR(a.periodo_fin) >= 2011 AND YEAR(a.periodo_fin) <= YEAR(NOW()) )
			GROUP BY a.periodo_fin, c.campus
			ORDER BY DATE(a.periodo_fin) ASC, c.campus ASC)
	ON DUPLICATE KEY UPDATE
    campus_nongmtcfst = VALUES(campus_nongmtcfst),
	fecha_nongmtcfst = VALUES(fecha_nongmtcfst), mes_nongmtcfst = VALUES(mes_nongmtcfst),
    consumo_nongmtcfst = VALUES(consumo_nongmtcfst), costo_nongmtcfst = VALUES(costo_nongmtcfst)");

	$this->db->query(
		"INSERT INTO `nongreenmetricgaastemp11`
		SELECT
		CONCAT(`campus_nongmtcfst`),
		CONCAT(YEAR(`fecha_nongmtcfst`)),
		CASE WHEN `mes_nongmtcfst`= 'January' THEN `consumo_nongmtcfst` END,
		CASE WHEN `mes_nongmtcfst`= 'February' THEN `consumo_nongmtcfst` END,
		CASE WHEN `mes_nongmtcfst`= 'March' THEN `consumo_nongmtcfst` END,
		CASE WHEN `mes_nongmtcfst`= 'April' THEN `consumo_nongmtcfst` END,
		CASE WHEN `mes_nongmtcfst`= 'May' THEN `consumo_nongmtcfst` END,
		CASE WHEN `mes_nongmtcfst`= 'June' THEN `consumo_nongmtcfst` END,
		CASE WHEN `mes_nongmtcfst`= 'July' THEN `consumo_nongmtcfst` END,
		CASE WHEN `mes_nongmtcfst`= 'August' THEN `consumo_nongmtcfst` END,
		CASE WHEN `mes_nongmtcfst`= 'September' THEN `consumo_nongmtcfst` END,
		CASE WHEN `mes_nongmtcfst`= 'October' THEN `consumo_nongmtcfst` END,
		CASE WHEN `mes_nongmtcfst`= 'November' THEN `consumo_nongmtcfst` END,
		CASE WHEN `mes_nongmtcfst`= 'December' THEN `consumo_nongmtcfst` END
		FROM  `nongreenmetricgaasfirstdataa`
		WHERE TRUE");

	$this->db->query(
		"INSERT INTO `nongreenmetricgaastemp22`
			SELECT
			`campus_nongmtt1`,
			`anonongmtt1`,
			SUM(`enero`),
			SUM(`febrero`),
			SUM(`marzo`),
			SUM(`abril`),
			SUM(`mayo`),
			SUM(`junio`),
			SUM(`julio`),
			SUM(`agosto`),
			SUM(`septiembre`),
			SUM(`octubre`),
			SUM(`noviembre`),
			SUM(`diciembre`)
			FROM `nongreenmetricgaastemp11`
			GROUP BY `campus_nongmtt1`, `anonongmtt1` ASC");

	$this->db->query(
		"INSERT INTO `nongreenmetricgaasfinalgraff`(
		`campus_nongmtfinal`, `year_nongmtfinal`, `Enero`, `Febrero`, `Marzo`, `Abril`, `Mayo`, `Junio`, `Julio`,
		`Agosto`, `Septiembre`, `Octubre`, `Noviembre`, `Diciembre`)
		(SELECT 
		`campus_nongmtt2`,
		`anonongmtt2`,
		COALESCE(`enero`,0) AS Enero,
		COALESCE(`febrero`,0) AS Febrero,
		COALESCE(`marzo`,0) AS Marzo,
		COALESCE(`abril`,0) AS Abril,	
		COALESCE(`mayo`,0) AS Mayo,
		COALESCE(`junio`,0) AS Junio,
		COALESCE(`julio`,0) AS Julio,
		COALESCE(`agosto`,0) AS Agosto,
		COALESCE(`septiembre`,0) AS Septiembre,
		COALESCE(`octubre`,0) AS Octubre,
		COALESCE(`noviembre`,0) AS Noviembre,
		COALESCE(`diciembre`,0) AS Diciembre
        FROM `nongreenmetricgaastemp22`)
		ON DUPLICATE KEY UPDATE
		campus_nongmtfinal = VALUES(campus_nongmtfinal),
		year_nongmtfinal = VALUES(year_nongmtfinal),
		Enero = VALUES(Enero), Febrero = VALUES(Febrero), Marzo = VALUES(Marzo), Abril = VALUES(Abril),
		Mayo = VALUES(Mayo), Junio = VALUES(Junio), Julio = VALUES(Julio), Agosto = VALUES(Agosto),
		Septiembre = VALUES(Septiembre), Octubre = VALUES(Octubre), Noviembre = VALUES(Noviembre),
		Diciembre = VALUES(Diciembre)");
	$this->db->trans_complete();
}
//*************************************FIN DE LA TRANSACCION*************************************//

//ELIMINA LAS TABLAS PARA GENERAR NUEVOS DATOS//
function droprgaasxcampusnonGM()
{
	$this->db->query("DROP TABLE  nongreenmetricgaasfirstdataa;");
	$this->db->query("DROP TABLE  nongreenmetricgaastemp11;");
	$this->db->query("DROP TABLE  nongreenmetricgaastemp22;");
	$this->db->query("DROP TABLE  nongreenmetricgaasfinalgraff;");
}


//*********************************MODELO CARGADOR COMBOBOX GAS X CAMPUS FINAL*********************************//
function gaasxcampusfinalnonGM()
{
	
	$this->db->order_by('campus_nongmtfinal', 'asc');
	$this->db->group_by('campus_nongmtfinal');
	$query = $this->db->get('nongreenmetricgaasfinalgraff');
	if($query->num_rows()>0) {
		foreach($query->result() as $row) {
			$campus_nongmtfinal[$row->id] = $row;
			
		}
		return $campus_nongmtfinal;

	}
}


function gaasxcampusresultadononGM()
{
	$campus_nongmtfinal = $this->input->post("campus_nongmtfinal");
	//MANDA RESULTADOS SI SE SELECCIONA LA DEPENDENCIA//
	if(!empty($campus_nongmtfinal))
	{
		$this->db->where('campus_nongmtfinal', $campus_nongmtfinal);
		$this->db->order_by('year_nongmtfinal', 'asc');
		$query = $this->db->get('nongreenmetricgaasfinalgraff');
				
			if ($query->num_rows()>0)
			{
				foreach($query->result() as $row)
				{
					$year_nongmtfinal[$row->id] = $row;
				}
				return $year_nongmtfinal;
			}
			else return false;
	}

}


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//Realiza la sumatoria del consumo, dependiendo del mes en la vista tar_om_final_x_mepo TARIFA OM
function EnerogaasxcampustotnonGM($campus_nongmtfinal)
{


	if(!empty($campus_nongmtfinal))
	{
		$this->db->where('campus_nongmtfinal', $campus_nongmtfinal);
		$this->db->select_sum('Enero');
		$query = $this->db->get('nongreenmetricgaasfinalgraff');
		$result = $query->row()->Enero;
		return $result;
	}

}

function FebrerogaasxcampustotnonGM($campus_nongmtfinal)
{


	if(!empty($campus_nongmtfinal))
	{
		$this->db->where('campus_nongmtfinal', $campus_nongmtfinal);
		$this->db->select_sum('Febrero');
		$query = $this->db->get('nongreenmetricgaasfinalgraff');
		$result = $query->row()->Febrero;
		return $result;
	}

}

function MarzogaasxcampustotnonGM($campus_nongmtfinal)
{


	if(!empty($campus_nongmtfinal))
	{
		$this->db->where('campus_nongmtfinal', $campus_nongmtfinal);
		$this->db->select_sum('Marzo');
		$query = $this->db->get('nongreenmetricgaasfinalgraff');
		$result = $query->row()->Marzo;
		return $result;
	}

}

function AbrilgaasxcampustotnonGM($campus_nongmtfinal)
{


	if(!empty($campus_nongmtfinal))
	{
		$this->db->where('campus_nongmtfinal', $campus_nongmtfinal);
		$this->db->select_sum('Abril');
		$query = $this->db->get('nongreenmetricgaasfinalgraff');
		$result = $query->row()->Abril;
		return $result;
	}

}

function MayogaasxcampustotnonGM($campus_nongmtfinal)
{


	if(!empty($campus_nongmtfinal))
	{
		$this->db->where('campus_nongmtfinal', $campus_nongmtfinal);
		$this->db->select_sum('Mayo');
		$query = $this->db->get('nongreenmetricgaasfinalgraff');
		$result = $query->row()->Mayo;
		return $result;
	}

}

function JuniogaasxcampustotnonGM($campus_nongmtfinal)
{


	if(!empty($campus_nongmtfinal))
	{
		$this->db->where('campus_nongmtfinal', $campus_nongmtfinal);
		$this->db->select_sum('Junio');
		$query = $this->db->get('nongreenmetricgaasfinalgraff');
		$result = $query->row()->Junio;
		return $result;
	}

}

function JuliogaasxcampustotnonGM($campus_nongmtfinal)
{


	if(!empty($campus_nongmtfinal))
	{
		$this->db->where('campus_nongmtfinal', $campus_nongmtfinal);
		$this->db->select_sum('Julio');
		$query = $this->db->get('nongreenmetricgaasfinalgraff');
		$result = $query->row()->Julio;
		return $result;
	}

}

function AgostogaasxcampustotnonGM($campus_nongmtfinal)
{


	if(!empty($campus_nongmtfinal))
	{
		$this->db->where('campus_nongmtfinal', $campus_nongmtfinal);
		$this->db->select_sum('Agosto');
		$query = $this->db->get('nongreenmetricgaasfinalgraff');
		$result = $query->row()->Agosto;
		return $result;
	}

}

function SeptiembregaasxcampustotnonGM($campus_nongmtfinal)
{


	if(!empty($campus_nongmtfinal))
	{
		$this->db->where('campus_nongmtfinal', $campus_nongmtfinal);
		$this->db->select_sum('Septiembre');
		$query = $this->db->get('nongreenmetricgaasfinalgraff');
		$result = $query->row()->Septiembre;
		return $result;
	}

}

function OctubregaasxcampustotnonGM($campus_nongmtfinal)
{


	if(!empty($campus_nongmtfinal))
	{
		$this->db->where('campus_nongmtfinal', $campus_nongmtfinal);
		$this->db->select_sum('Octubre');
		$query = $this->db->get('nongreenmetricgaasfinalgraff');
		$result = $query->row()->Octubre;
		return $result;
	}

}

function NoviembregaasxcampustotnonGM($campus_nongmtfinal)
{


	if(!empty($campus_nongmtfinal))
	{
		$this->db->where('campus_nongmtfinal', $campus_nongmtfinal);
		$this->db->select_sum('Noviembre');
		$query = $this->db->get('nongreenmetricgaasfinalgraff');
		$result = $query->row()->Noviembre;
		return $result;
	}

}

function DiciembregaasxcampustotnonGM($campus_nongmtfinal)
{


	if(!empty($campus_nongmtfinal))
	{
		$this->db->where('campus_nongmtfinal', $campus_nongmtfinal);
		$this->db->select_sum('Diciembre');
		$query = $this->db->get('nongreenmetricgaasfinalgraff');
		$result = $query->row()->Diciembre;
		return $result;
	}

}
/***************************************************************************************************************************/
							/*FIN DE CONSUMO EN GAS 2011 A LA FECHA PARA LOS CAMPUS*/
/***************************************************************************************************************************/
/***************************************************************************************************************************/
						  /*MODELO QUE CARGA TABLA CONSUMO DE AGUA(m3) GEI GREEN METRIC */
/***************************************************************************************************************************/
	//Carga la tabla para metricas_gei_agua_gm.php
	function load_gei_table_wtr_gm()
	{

		if(empty($year))
		{
			//$this->db->select('gmtheyear, gmm3wtrcapitayear, gmwtrkgcapitayear, gmtemperatura');
			$this->db->select('v2gmtheyear, v2gmm3wtrcapitayear, v2gmwtrkgcapitayear, v2gmtemperatura');
			//$query = $this->db->get('gmpdc_factor_gei_all');
			$query = $this->db->get('gmpdcfactorgeiallv2');
			return $query->result();
			

		}

	}
/***************************************************************************************************************************/
													/*FIN DE MODELO*/
/***************************************************************************************************************************/
/***************************************************************************************************************************/
						  /*MODELO QUE CARGA TABLA CONSUMO DE GAS(m3) GEI GREEN METRIC */
/***************************************************************************************************************************/

	function load_gei_table_gas_gm()
	{

		if(empty($year))
		{
			//$this->db->select('gmtheyear, gmm3gascapitayear, gmgaskgcapitayear, gmtemperatura');
			$this->db->select('v2gmtheyear, v2gmm3gascapitayear, v2gmgaskgcapitayear, v2gmtemperatura');
			//$query = $this->db->get('gmpdc_factor_gei_all');
			$query = $this->db->get('gmpdcfactorgeiallv2');
			return $query->result();
			

		}

	}
/***************************************************************************************************************************/
											/*FIN DE MODELO*/
/***************************************************************************************************************************/
/***************************************************************************************************************************/
						  /*MODELO QUE CARGA TABLAS DE DESGLOSE ANUAL TOTAL */
/***************************************************************************************************************************/
												/*ELECTRICIDAD*/
										
										/*INICIO DE LA TRANSACCION*/
function creatotanualelec()
{
	$this->db->trans_start();
	
	$tabla1= "CREATE TABLE IF NOT EXISTS `comparativoelectricidad1`
				(`id` INT NOT NULL AUTO_INCREMENT, `TheYear` YEAR NOT NULL,
				`SumaConsumo` VARCHAR(25) NOT NULL , `SumaCosto` VARCHAR(25) NOT NULL,
				PRIMARY KEY (`id`), UNIQUE `TheYear` (`id`))  ENGINE = InnoDB";
				
	$tabla2= "CREATE TABLE IF NOT EXISTS `comparativoelectricidadfinal`
				(`id` INT NOT NULL AUTO_INCREMENT, `TheYear` YEAR NOT NULL,
				`SumaConsumo` VARCHAR(25) NOT NULL , `SumaCosto` VARCHAR(25) NOT NULL,
				`cantidad_alumnos` VARCHAR(25) NOT NULL, `emisiones` FLOAT NOT NULL,
				`temperatura` FLOAT NOT NULL, `kwcapitayear` FLOAT NOT NULL,
				`kgcapitayear` FLOAT NOT NULL, `rawkw` FLOAT NOT NULL,
				`rawkwxgei` FLOAT NOT NULL, PRIMARY KEY (`id`),
			    UNIQUE `TheYear` (`id`))  ENGINE = InnoDB";
				
	$this->db->query($tabla1);
	$this->db->query($tabla2);
	
	$this->db->query(
	"INSERT INTO `comparativoelectricidad1` (`TheYear`, `SumaConsumo`,`SumaCosto`)
	
	(SELECT GROUP_CONCAT(DISTINCT(YEAR(periodo_fin))) AS TheYear,
    CONCAT('', FORMAT(SUM(consumo), 0)) AS SumaConsumo,
	CONCAT('', FORMAT(SUM(costo),2)) AS SumaCosto FROM pdc_all_dep_elec
	WHERE (YEAR(periodo_inicio) <= YEAR(NOW()) )
	AND (YEAR(periodo_fin) <= YEAR(NOW()) )
	AND consumo IS NOT NULL AND consumo <> ''
	AND costo IS NOT NULL AND costo <> ''
	AND periodo_inicio IS NOT NULL AND  periodo_inicio <> ''
	AND periodo_fin IS NOT NULL AND periodo_fin <> ''
	AND cuenta IS NOT NULL AND cuenta <> ''
	AND factor IS NOT NULL AND factor <> ''
    GROUP BY YEAR(periodo_fin) ORDER BY YEAR(periodo_fin)ASC)");
	
	$this->db->query(
	"INSERT INTO `comparativoelectricidadfinal` (`TheYear`, `SumaConsumo`,
	`SumaCosto`, `cantidad_alumnos`, `emisiones`, `temperatura`,
	`kwcapitayear`, `kgcapitayear`, `rawkw`, `rawkwxgei`)

	(SELECT DISTINCT
	a.TheYear, a.SumaConsumo, a.SumaCosto,
	b.cantidad_alumnos, b.emisiones, b.temperatura,
	b.kwcapitayear, b.kgcapitayear, b.rawkw, b.rawkwxgei
	FROM `comparativoelectricidad1` a
	INNER JOIN `pdc_factor_gei_all` b ON a.TheYear = b.theyear)");
	
	$this->db->trans_complete();
}
										/*FIN DE LA TRANSACCION*/
							/*BORRADO DE TABLAS PARA VOLVER A VOLCAR DATOS LIMPIOS*/
function dropdestotanualelec()
{
	$this->db->query("DROP TABLE comparativoelectricidad1;");
	$this->db->query("DROP TABLE comparativoelectricidadfinal;");
}



										/*CONSULTA QUE MUESTRA LA TABLA EN LA PAGINA*/
function desglosetotanualelec($year)
{
	$sql=
	"SELECT TheYear AS TheYear,
	SumaCosto AS SumaCosto,
	SumaConsumo AS SumaConsumo,
	CONCAT('', FORMAT((cantidad_alumnos),0)) AS CantidadAlumnos,
    emisiones AS emisiones,
    kwcapitayear AS kwcapitayear,
    kgcapitayear AS kgcapitayear,
    rawkw AS rawkw,
    rawkwxgei AS rawkwxgei FROM comparativoelectricidadfinal";

	$sql .= " ORDER BY TheYear ASC";

	$query = $this->db->query($sql);

	if($query->num_rows() > 0)
		{
			return $query->result_array();

		}
		else
			{
				return FALSE;
			}
}
/********************************************************CIERRE*******************************************************/

												/*AGUA*/
										
										/*INICIO DE LA TRANSACCION*/
function creatotanualagua()
{
	$this->db->trans_start();
	
	$tabla1= "CREATE TABLE IF NOT EXISTS `comparativoagua1`
				(`id` INT NOT NULL AUTO_INCREMENT, `TheYear` YEAR NOT NULL,
				`SumaConsumo` VARCHAR(25) NOT NULL , `SumaCosto` VARCHAR(25) NOT NULL,
				PRIMARY KEY (`id`), UNIQUE `TheYear` (`id`))  ENGINE = InnoDB";
				
	$tabla2= "CREATE TABLE IF NOT EXISTS `comparativoaguafinal`
				(`id` INT NOT NULL AUTO_INCREMENT, `TheYear` YEAR NOT NULL,
				`SumaConsumo` VARCHAR(25) NOT NULL , `SumaCosto` VARCHAR(25) NOT NULL,
				`cantidad_alumnos` VARCHAR(25) NOT NULL, `emisionesa` FLOAT NOT NULL,
				`temperatura` FLOAT NOT NULL, `m3wtrcapitayear` FLOAT NOT NULL,
				`wtrkgcapitayear` FLOAT NOT NULL, `rawm3wtr` FLOAT NOT NULL,
				`rawm3wtrxgei` FLOAT NOT NULL, PRIMARY KEY (`id`),
			    UNIQUE `TheYear` (`id`))  ENGINE = InnoDB";
				
	$this->db->query($tabla1);
	$this->db->query($tabla2);
	
	$this->db->query(
	"INSERT INTO `comparativoagua1` (`TheYear`, `SumaConsumo`,`SumaCosto`)
	
	(SELECT GROUP_CONCAT(DISTINCT(YEAR(periodo_fin))) AS TheYear,
    CONCAT('', FORMAT(SUM(consumo), 0)) AS SumaConsumo,
	CONCAT('', FORMAT(SUM(costo),2)) AS SumaCosto FROM pdc_all_dep_agua
	WHERE (YEAR(periodo_inicio) <= YEAR(NOW()) )
	AND (YEAR(periodo_fin) <= YEAR(NOW()) )
	AND consumo IS NOT NULL AND consumo <> ''
	AND costo IS NOT NULL AND costo <> ''
	AND periodo_inicio IS NOT NULL AND  periodo_inicio <> ''
	AND periodo_fin IS NOT NULL AND periodo_fin <> ''
	AND cuenta IS NOT NULL AND cuenta <> ''
    GROUP BY YEAR(periodo_fin) ORDER BY YEAR(periodo_fin))");
	
	$this->db->query(
	"INSERT INTO `comparativoaguafinal` (`TheYear`, `SumaConsumo`,
	`SumaCosto`, `cantidad_alumnos`, `emisionesa`, `temperatura`,
	`m3wtrcapitayear`, `wtrkgcapitayear`, `rawm3wtr`, `rawm3wtrxgei`)

	(SELECT DISTINCT
	a.TheYear, a.SumaConsumo, a.SumaCosto,
	b.cantidad_alumnos, b.emisionesa, b.temperatura,
	b.m3wtrcapitayear, b.wtrkgcapitayear, b.rawm3wtr, b.rawm3wtrxgei
	FROM `comparativoagua1` a
	INNER JOIN `pdc_factor_gei_all` b ON a.TheYear = b.theyear)");
	
	$this->db->trans_complete();
}
										/*FIN DE LA TRANSACCION*/

				
									/*BORRADO DE TABLAS PARA VOLVER A VOLCAR DATOS LIMPIOS*/
function dropdestotanualagua()
{
	$this->db->query("DROP TABLE comparativoagua1;");
	$this->db->query("DROP TABLE comparativoaguafinal;");
}

										/*CONSULTA QUE MUESTRA LA TABLA EN LA PAGINA*/
function desglosetotanualagua($year)
{
	$sql=
	"SELECT TheYear AS TheYear,
	SumaCosto AS SumaCosto,
	SumaConsumo AS SumaConsumo,
	CONCAT('', FORMAT((cantidad_alumnos),0)) AS CantidadAlumnos,
    emisionesa AS emisionesa,
    m3wtrcapitayear AS m3wtrcapitayear,
    wtrkgcapitayear AS wtrkgcapitayear,
    rawm3wtr AS rawm3wtr,
    rawm3wtrxgei AS rawm3wtrxgei FROM comparativoaguafinal";

	$sql .= " ORDER BY TheYear ASC";

	$query = $this->db->query($sql);

	if($query->num_rows() > 0)
		{
			return $query->result_array();

		}
		else
			{
				return FALSE;
			}
}

/********************************************************CIERRE*******************************************************/

												/*GAS*/
										
										/*INICIO DE LA TRANSACCION*/
function creatotanualgas()
{
	$this->db->trans_start();
	
	$tabla1= "CREATE TABLE IF NOT EXISTS `comparativogas1`
				(`id` INT NOT NULL AUTO_INCREMENT, `TheYear` YEAR NOT NULL,
				`SumaConsumo` VARCHAR(25) NOT NULL , `SumaCosto` VARCHAR(25) NOT NULL,
				PRIMARY KEY (`id`), UNIQUE `TheYear` (`id`))  ENGINE = InnoDB";
				
	$tabla2= "CREATE TABLE IF NOT EXISTS `comparativogasfinal`
				(`id` INT NOT NULL AUTO_INCREMENT, `TheYear` YEAR NOT NULL,
				`SumaConsumo` VARCHAR(25) NOT NULL , `SumaCosto` VARCHAR(25) NOT NULL,
				`cantidad_alumnos` VARCHAR(25) NOT NULL, `emisionesg` FLOAT NOT NULL,
				`temperatura` FLOAT NOT NULL, `m3gascapitayear` FLOAT NOT NULL,
				`gaskgcapitayear` FLOAT NOT NULL, `rawm3gas` FLOAT NOT NULL,
				`rawm3gasxgei` FLOAT NOT NULL, PRIMARY KEY (`id`),
			    UNIQUE `TheYear` (`id`))  ENGINE = InnoDB";
				
	$this->db->query($tabla1);
	$this->db->query($tabla2);
	
	$this->db->query(
	"INSERT INTO `comparativogas1` (`TheYear`, `SumaConsumo`,`SumaCosto`)
	
	(SELECT GROUP_CONCAT(DISTINCT(YEAR(periodo_fin))) AS TheYear,
    CONCAT('', FORMAT(SUM(consumo), 0)) AS SumaConsumo,
	CONCAT('', FORMAT(SUM(costo),2)) AS SumaCosto FROM pdc_all_dep_gaas
	WHERE (YEAR(periodo_inicio) <= YEAR(NOW()) )
	AND (YEAR(periodo_fin) <= YEAR(NOW()) )
	AND consumo IS NOT NULL AND consumo <> ''
	AND costo IS NOT NULL AND costo <> ''
	AND periodo_inicio IS NOT NULL AND  periodo_inicio <> ''
	AND periodo_fin IS NOT NULL AND periodo_fin <> ''
	AND cuenta IS NOT NULL AND cuenta <> ''
    GROUP BY YEAR(periodo_fin) ORDER BY YEAR(periodo_fin))");
	
	$this->db->query(
	"INSERT INTO `comparativogasfinal` (`TheYear`, `SumaConsumo`,
	`SumaCosto`, `cantidad_alumnos`, `emisionesg`, `temperatura`,
	`m3gascapitayear`, `gaskgcapitayear`, `rawm3gas`, `rawm3gasxgei`)

	(SELECT DISTINCT
	a.TheYear, a.SumaConsumo, a.SumaCosto,
	b.cantidad_alumnos, b.emisionesg, b.temperatura,
	b.m3gascapitayear, b.gaskgcapitayear, b.rawm3gas, b.rawm3gasxgei
	FROM `comparativogas1` a
	INNER JOIN `pdc_factor_gei_all` b ON a.TheYear = b.theyear)");
	
	$this->db->trans_complete();
}
										/*FIN DE LA TRANSACCION*/
										
										/*BORRADO DE TABLAS PARA VOLVER A VOLCAR DATOS LIMPIOS*/
function dropdestotanualgas()
{
	$this->db->query("DROP TABLE comparativogas1;");
	$this->db->query("DROP TABLE comparativogasfinal;");
}



										/*CONSULTA QUE MUESTRA LA TABLA EN LA PAGINA*/
function desglosetotanualgas($year)
{
	$sql=
	"SELECT TheYear AS TheYear,
	SumaCosto AS SumaCosto,
	SumaConsumo AS SumaConsumo,
	CONCAT('', FORMAT((cantidad_alumnos),0)) AS CantidadAlumnos,
    emisionesg AS emisionesg,
    m3gascapitayear AS m3gascapitayear,
    gaskgcapitayear AS gaskgcapitayear,
    rawm3gas AS rawm3gas,
    rawm3gasxgei AS rawm3gasxgei FROM comparativogasfinal";

	$sql .= " ORDER BY TheYear ASC";

	$query = $this->db->query($sql);

	if($query->num_rows() > 0)
		{
			return $query->result_array();

		}
		else
			{
				return FALSE;
			}
}
/***************************************************************************************************************************/
/***************************************************************************************************************************/

/***************************************************************************************************************************/
	   /**********************************MODELO GM PARA EL INTERVALO DE 5 AÑOS***************************************/
/***************************************************************************************************************************/
function creacione_factore_gm_5yrs()
	{

		$this->db->trans_start();
			$start1=	"CREATE TABLE IF NOT EXISTS `5yrs_gmpdc_factor_gei_all` ( `id` INT NOT NULL AUTO_INCREMENT,	
			`gmtheyear5yrs` YEAR NOT NULL,
			`gmcantidad_alumnos5yrs` INT(15) NOT NULL,
			`gmemisionesa5yrs` FLOAT NOT NULL,
			`gmemisiones5yrs` FLOAT NOT NULL,
			`gmemisionesg5yrs` FLOAT NOT NULL,
			`gmtemperatura5yrs` FLOAT NOT NULL,
			`gmkwcapitayear5yrs` FLOAT NOT NULL,
			`gmkgcapitayear5yrs` FLOAT NOT NULL,
			`gmrawkw5yrs` FLOAT NOT NULL,
			`gmrawkwxgei5yrs` FLOAT NOT NULL,
		    `gmm3wtrcapitayear5yrs` FLOAT NOT NULL,
		    `gmwtrkgcapitayear5yrs` FLOAT NOT NULL,
		    `gmrawm3wtr5yrs` FLOAT NOT NULL,
		    `gmrawm3wtrxgei5yrs` FLOAT NOT NULL,
		    `gmm3gascapitayear5yrs` FLOAT NOT NULL,
		    `gmgaskgcapitayear5yrs` FLOAT NOT NULL,
		    `gmrawm3gas5yrs` FLOAT NOT NULL,
		    `gmrawm3gasxgei5yrs` FLOAT NOT NULL,
			PRIMARY KEY (`id`), UNIQUE `gmyearini5yrs` (`gmtheyear5yrs`)) ENGINE = InnoDB";

		$this->db->query($start1);

		$this->db->query("INSERT INTO `5yrs_gmpdc_factor_gei_all` (gmtheyear5yrs, gmcantidad_alumnos5yrs, gmemisionesa5yrs, gmemisiones5yrs, gmemisionesg5yrs, gmtemperatura5yrs,
		 				gmkwcapitayear5yrs, gmkgcapitayear5yrs, gmrawkw5yrs, gmrawkwxgei5yrs, gmm3wtrcapitayear5yrs, gmwtrkgcapitayear5yrs, gmrawm3wtr5yrs, gmrawm3wtrxgei5yrs,
						 gmm3gascapitayear5yrs, gmgaskgcapitayear5yrs, gmrawm3gas5yrs, gmrawm3gasxgei5yrs)
			(SELECT `theyear`, `cantidad_alumnos`, `emisionesa`, `emisiones`, `emisionesg`, `temperatura`, `kwcapitayear`,
			`kgcapitayear`, `rawkw`, `rawkwxgei`, `m3wtrcapitayear`, `wtrkgcapitayear`, `rawm3wtr`, `rawm3wtrxgei`, `m3gascapitayear`,
		    `gaskgcapitayear`, `rawm3gas`, `rawm3gasxgei` FROM `pdc_factor_gei_all` WHERE theyear>=NOW() - INTERVAL 5 YEAR and theyear<=NOW() - INTERVAL 1 YEAR)
		    ON DUPLICATE KEY UPDATE id = VALUES(ID),
		    gmtheyear5yrs = VALUES(gmtheyear5yrs), gmcantidad_alumnos5yrs = VALUES(gmcantidad_alumnos5yrs), gmemisionesa5yrs = VALUES(gmemisionesa5yrs),
		    gmemisiones5yrs = VALUES(gmemisiones5yrs), gmemisionesg5yrs = VALUES(gmemisionesg5yrs), gmtemperatura5yrs = VALUES(gmtemperatura5yrs),
		    gmkwcapitayear5yrs = VALUES(gmkwcapitayear5yrs), gmkgcapitayear5yrs = VALUES(gmkgcapitayear5yrs), gmrawkw5yrs = VALUES(gmrawkw5yrs),
		    gmrawkwxgei5yrs = VALUES(gmrawkwxgei5yrs), gmm3wtrcapitayear5yrs = VALUES(gmm3wtrcapitayear5yrs), gmwtrkgcapitayear5yrs = VALUES(gmwtrkgcapitayear5yrs),
		    gmrawm3wtr5yrs = VALUES(gmrawm3wtr5yrs), gmrawm3wtrxgei5yrs = VALUES(gmrawm3wtrxgei5yrs), gmm3gascapitayear5yrs = VALUES(gmm3gascapitayear5yrs),
		    gmgaskgcapitayear5yrs = VALUES(gmgaskgcapitayear5yrs), gmrawm3gas5yrs = VALUES(gmrawm3gas5yrs), gmrawm3gasxgei5yrs = VALUES(gmrawm3gasxgei5yrs)");

		$this->db->trans_complete();
	}
	//CARGA LA TABLA PARA metricas_gei_elec_gm_5yrs.php
	function load_gei_table_gm_5yrs()
	{

		if(empty($year))
		{
			$this->db->select('gmtheyear5yrs, gmkwcapitayear5yrs, gmkgcapitayear5yrs, gmtemperatura5yrs');
			$query = $this->db->get('5yrs_gmpdc_factor_gei_all');
			return $query->result();
			

		}

	}

function drope_creacione_factore_gm_5yrs()
{
	$this->db->query("DROP TABLE IF EXISTS  `5yrs_gmpdc_factor_gei_all`;");
}

/****************************************************************************************/
/***************************************************************************************************************************/
						  /*MODELO QUE CARGA TABLA CONSUMO DE AGUA(m3) GEI GM INTERVALO 5 AÑOS */
/***************************************************************************************************************************/
	//Carga la tabla para metricas_gei_agua_gm.php
	function load_gei_table_wtr_gm_5yrs()
	{

		if(empty($year))
		{
			$this->db->select('gmtheyear5yrs, gmm3wtrcapitayear5yrs, gmwtrkgcapitayear5yrs, gmtemperatura5yrs');
			$query = $this->db->get('5yrs_gmpdc_factor_gei_all');
			return $query->result();
			

		}

	}
/***************************************************************************************************************************/
													/*FIN DEL LLAMADO*/
/***************************************************************************************************************************/
/***************************************************************************************************************************/
						  /*MODELO QUE CARGA TABLA CONSUMO DE GAS(m3) GEI GREEN METRIC */
/***************************************************************************************************************************/

function load_gei_table_gas_gm_5yrs()
{

	if(empty($year))
	{
		$this->db->select('gmtheyear5yrs, gmm3gascapitayear5yrs, gmgaskgcapitayear5yrs, gmtemperatura5yrs');
		$query = $this->db->get('5yrs_gmpdc_factor_gei_all');
		return $query->result();
		

	}

}
/***************************************************************************************************************************/
												/*FIN DEL LLAMADO*/
/***************************************************************************************************************************/
/***************************************************************************************************************************/
		/*INICIO DE CONSUMO DE ELECTRICIDAD X CAMPUS INTERVALO 5 AÑOS (GM)*/
/***************************************************************************************************************************/

//CREA TABLAS TEMPORALES Y FINAL QUE SERAN DATOS PARA LAS GRÁFICAS//
function conelecxcampus5yrs()
{
	$this->db->trans_start();
	$tabla1= "CREATE TABLE IF NOT EXISTS `greenmetricenerfirstdataa5yrs` (`id` INT NOT NULL AUTO_INCREMENT,
				`campus_gmtcfst` VARCHAR(55) NOT NULL , `fecha_gmtcfst` VARCHAR(15) NOT NULL,
				`mes_gmtcfst` VARCHAR(15) NOT NULL, `consumo_gmtcfst` DECIMAL(30,2) NOT NULL,
			    `costo_gmtcfst` DECIMAL(30,2) NOT NULL, PRIMARY KEY (`id`),
			    UNIQUE `v2consumogmt` (`id`))  ENGINE = InnoDB";

	$tabla2= "CREATE TABLE IF NOT EXISTS `greenmetricenertemp11_5yrs` 
	(`campus_gmtt1` VARCHAR(100), `anogmtt1` INT, `enero` DECIMAL(30,2) NOT NULL, `febrero` DECIMAL(30,2) NOT NULL,
	`marzo` DECIMAL(30,2) NOT NULL, `abril` DECIMAL(30,2) NOT NULL, `mayo` DECIMAL(30,2) NOT NULL, `junio` DECIMAL(30,2) NOT NULL,
	`julio` DECIMAL(30,2) NOT NULL, `agosto` DECIMAL(30,2) NOT NULL, `septiembre` DECIMAL(30,2) NOT NULL,
    `octubre` DECIMAL(30,2) NOT NULL, `noviembre` DECIMAL(30,2) NOT NULL, `diciembre` DECIMAL(30,2) NOT NULL)";

	$tabla3= "CREATE TABLE IF NOT EXISTS `greenmetricenertemp22_5yrs`
	 (`campus_gmtt2` VARCHAR(100), `anogmtt2` INT, `enero` FLOAT, `febrero` FLOAT , `marzo` FLOAT, `abril` FLOAT, `mayo` FLOAT,
	 `junio` FLOAT, `julio` FLOAT, `agosto` FLOAT, `septiembre` FLOAT, `octubre` FLOAT, `noviembre` FLOAT, `diciembre` FLOAT)";

	$tabla4= "CREATE TABLE IF NOT EXISTS `greenmetricenerfinalgraff5yrs`  (`id` INT NOT NULL AUTO_INCREMENT ,
				`campus_gmtfinal` VARCHAR(55) NOT NULL,  `year_gmtfinal` YEAR NOT NULL,
			    `Enero` INT(30) NOT NULL, `Febrero` INT(30) NOT NULL, `Marzo` INT(30) NOT NULL, `Abril` INT(30) NOT NULL,
                `Mayo` INT(30) NOT NULL, `Junio` INT(30) NOT NULL, `Julio` INT(30) NOT NULL, `Agosto` INT(30) NOT NULL,
                `Septiembre` INT(30) NOT NULL, `Octubre` INT(30) NOT NULL, `Noviembre` INT(30) NOT NULL,
                `Diciembre` INT(30) NOT NULL, PRIMARY KEY (`id`), UNIQUE `enegmtfinal` (`id`))  ENGINE = InnoDB";

	$this->db->query($tabla1);
	$this->db->query($tabla2);
	$this->db->query($tabla3);
	$this->db->query($tabla4);
	
	$this->db->query(
		"INSERT INTO `greenmetricenerfirstdataa5yrs` (`campus_gmtcfst`,
			`fecha_gmtcfst`, `mes_gmtcfst`, `consumo_gmtcfst`, `costo_gmtcfst`)
	SELECT DISTINCT
            c.campus,
            (a.periodo_fin),
            MONTHNAME(a.periodo_fin),
			SUM(a.consumo),
			SUM(a.costo)
			FROM `pdc_consumo_energia` a
			INNER JOIN `ctrl_servicios` b ON a.servicio = b.id 
			INNER JOIN `pdc_servicios_energia` c ON b.account = c.cuenta 
			WHERE c.campus IS NOT NULL AND c.campus <> ''
			AND a.periodo_fin IS NOT NULL AND a.periodo_fin <> ''
			AND a.consumo IS NOT NULL AND a.consumo <> ''
			AND a.costo IS NOT NULL AND a.costo <> ''
			AND b.account IS NOT NULL AND b.account <> ''
			AND a.servicio IS NOT NULL AND a.servicio <> ''
			AND (YEAR(a.periodo_fin) >= YEAR(NOW() - INTERVAL 5 YEAR)  AND YEAR(a.periodo_fin) <= YEAR(NOW() - INTERVAL 1 YEAR) )
			GROUP BY a.periodo_fin, c.campus
			ORDER BY DATE(a.periodo_fin) ASC, c.campus ASC
	ON DUPLICATE KEY UPDATE
    campus_gmtcfst = VALUES(campus_gmtcfst),
	fecha_gmtcfst = VALUES(fecha_gmtcfst), mes_gmtcfst = VALUES(mes_gmtcfst),
    consumo_gmtcfst = VALUES(consumo_gmtcfst), costo_gmtcfst = VALUES(costo_gmtcfst)");

	$this->db->query(
		"INSERT INTO `greenmetricenertemp11_5yrs`
		SELECT
		CONCAT(`campus_gmtcfst`),
		CONCAT(YEAR(`fecha_gmtcfst`)),
		CASE WHEN `mes_gmtcfst`= 'January' THEN `consumo_gmtcfst` END,
		CASE WHEN `mes_gmtcfst`= 'February' THEN `consumo_gmtcfst` END,
		CASE WHEN `mes_gmtcfst`= 'March' THEN `consumo_gmtcfst` END,
		CASE WHEN `mes_gmtcfst`= 'April' THEN `consumo_gmtcfst` END,
		CASE WHEN `mes_gmtcfst`= 'May' THEN `consumo_gmtcfst` END,
		CASE WHEN `mes_gmtcfst`= 'June' THEN `consumo_gmtcfst` END,
		CASE WHEN `mes_gmtcfst`= 'July' THEN `consumo_gmtcfst` END,
		CASE WHEN `mes_gmtcfst`= 'August' THEN `consumo_gmtcfst` END,
		CASE WHEN `mes_gmtcfst`= 'September' THEN `consumo_gmtcfst` END,
		CASE WHEN `mes_gmtcfst`= 'October' THEN `consumo_gmtcfst` END,
		CASE WHEN `mes_gmtcfst`= 'November' THEN `consumo_gmtcfst` END,
		CASE WHEN `mes_gmtcfst`= 'December' THEN `consumo_gmtcfst` END
		FROM  `greenmetricenerfirstdataa5yrs`
		WHERE TRUE");

	$this->db->query(
		"INSERT INTO `greenmetricenertemp22_5yrs`
			SELECT
			`campus_gmtt1`,
			`anogmtt1`,
			SUM(`enero`),
			SUM(`febrero`),
			SUM(`marzo`),
			SUM(`abril`),
			SUM(`mayo`),
			SUM(`junio`),
			SUM(`julio`),
			SUM(`agosto`),
			SUM(`septiembre`),
			SUM(`octubre`),
			SUM(`noviembre`),
			SUM(`diciembre`)
			FROM `greenmetricenertemp11_5yrs`
			GROUP BY `campus_gmtt1`, `anogmtt1` ASC");

	$this->db->query(
		"INSERT INTO `greenmetricenerfinalgraff5yrs`(
		`campus_gmtfinal`, `year_gmtfinal`, `Enero`, `Febrero`, `Marzo`, `Abril`, `Mayo`, `Junio`, `Julio`,
		`Agosto`, `Septiembre`, `Octubre`, `Noviembre`, `Diciembre`)
		SELECT
		`campus_gmtt2`,
		`anogmtt2`,
		COALESCE(`enero`,0) AS Enero,
		COALESCE(`febrero`,0) AS Febrero,
		COALESCE(`marzo`,0) AS Marzo,
		COALESCE(`abril`,0) AS Abril,
		COALESCE(`mayo`,0) AS Mayo,
		COALESCE(`junio`,0) AS Junio,
		COALESCE(`julio`,0) AS Julio,
		COALESCE(`agosto`,0) AS Agosto,
		COALESCE(`septiembre`,0) AS Septiembre,
		COALESCE(`octubre`,0) AS Octubre,
		COALESCE(`noviembre`,0) AS Noviembre,
		COALESCE(`diciembre`,0) AS Diciembre
        FROM `greenmetricenertemp22_5yrs`
		ON DUPLICATE KEY UPDATE
		campus_gmtfinal = VALUES(campus_gmtfinal),
		year_gmtfinal = VALUES(year_gmtfinal),
		Enero = VALUES(Enero), Febrero = VALUES(Febrero), Marzo = VALUES(Marzo), Abril = VALUES(Abril),
		Mayo = VALUES(Mayo), Junio = VALUES(Junio), Julio = VALUES(Julio), Agosto = VALUES(Agosto),
		Septiembre = VALUES(Septiembre), Octubre = VALUES(Octubre), Noviembre = VALUES(Noviembre),
		Diciembre = VALUES(Diciembre)");
	$this->db->trans_complete();
}
//*************************************FIN DE LA TRANSACCION*************************************//

//ELIMINA LAS TABLAS PARA GENERAR NUEVOS DATOS//
function droprelecxcampus5yrs()
{
	$this->db->query("DROP TABLE  greenmetricenerfirstdataa5yrs;");
	$this->db->query("DROP TABLE  greenmetricenertemp11_5yrs;");
	$this->db->query("DROP TABLE  greenmetricenertemp22_5yrs;");
	$this->db->query("DROP TABLE  greenmetricenerfinalgraff5yrs;");
}
//*************************************FIN DEL BORRADO*************************************//

//*********************************MODELO CARGADOR COMBOBOX ELECTRICIDAD X CAMPUS INTERVALO 5 AÑOS*********************************//
function elecxcampusfinal5yrs()
{
	
	$this->db->order_by('campus_gmtfinal', 'asc');
	$this->db->group_by('campus_gmtfinal');
	$query = $this->db->get('greenmetricenerfinalgraff5yrs');
	if($query->num_rows()>0) {
		foreach($query->result() as $row) {
			$campus_gmtfinal[$row->id] = $row;
			
		}
		return $campus_gmtfinal;

	}
}




function elecxcampusresultado5yrs()
{
	$campus_gmtfinal = $this->input->post("campus_gmtfinal");
	//MANDA RESULTADOS SI SE SELECCIONA LA DEPENDENCIA//
	if(!empty($campus_gmtfinal))
	{
		$this->db->where('campus_gmtfinal', $campus_gmtfinal);
		$this->db->order_by('year_gmtfinal', 'asc');
		$query = $this->db->get('greenmetricenerfinalgraff5yrs');
				
			if ($query->num_rows()>0)
			{
				foreach($query->result() as $row)
				{
					$year_gmtfinal[$row->id] = $row;
				}
				return $year_gmtfinal;
			}
			else return false;
	}

}



////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//LLAMADO DE LOS MESES PARA LA GRAFICA Consumo de Electricidad x Campus - GM INTERVALO 5 AÑOS
function Eneroelecxcampustot5yrs($campus_gmtfinal)
{


	if(!empty($campus_gmtfinal))
	{
		$this->db->where('campus_gmtfinal', $campus_gmtfinal);
		$this->db->select_sum('Enero');
		$query = $this->db->get('greenmetricenerfinalgraff5yrs');
		$result = $query->row()->Enero;
		return $result;
	}

}

function Febreroelecxcampustot5yrs($campus_gmtfinal)
{


	if(!empty($campus_gmtfinal))
	{
		$this->db->where('campus_gmtfinal', $campus_gmtfinal);
		$this->db->select_sum('Febrero');
		$query = $this->db->get('greenmetricenerfinalgraff5yrs');
		$result = $query->row()->Febrero;
		return $result;
	}

}

function Marzoelecxcampustot5yrs($campus_gmtfinal)
{


	if(!empty($campus_gmtfinal))
	{
		$this->db->where('campus_gmtfinal', $campus_gmtfinal);
		$this->db->select_sum('Marzo');
		$query = $this->db->get('greenmetricenerfinalgraff5yrs');
		$result = $query->row()->Marzo;
		return $result;
	}

}

function Abrilelecxcampustot5yrs($campus_gmtfinal)
{


	if(!empty($campus_gmtfinal))
	{
		$this->db->where('campus_gmtfinal', $campus_gmtfinal);
		$this->db->select_sum('Abril');
		$query = $this->db->get('greenmetricenerfinalgraff5yrs');
		$result = $query->row()->Abril;
		return $result;
	}

}

function Mayoelecxcampustot5yrs($campus_gmtfinal)
{


	if(!empty($campus_gmtfinal))
	{
		$this->db->where('campus_gmtfinal', $campus_gmtfinal);
		$this->db->select_sum('Mayo');
		$query = $this->db->get('greenmetricenerfinalgraff5yrs');
		$result = $query->row()->Mayo;
		return $result;
	}

}

function Junioelecxcampustot5yrs($campus_gmtfinal)
{


	if(!empty($campus_gmtfinal))
	{
		$this->db->where('campus_gmtfinal', $campus_gmtfinal);
		$this->db->select_sum('Junio');
		$query = $this->db->get('greenmetricenerfinalgraff5yrs');
		$result = $query->row()->Junio;
		return $result;
	}

}

function Julioelecxcampustot5yrs($campus_gmtfinal)
{


	if(!empty($campus_gmtfinal))
	{
		$this->db->where('campus_gmtfinal', $campus_gmtfinal);
		$this->db->select_sum('Julio');
		$query = $this->db->get('greenmetricenerfinalgraff5yrs');
		$result = $query->row()->Julio;
		return $result;
	}

}

function Agostoelecxcampustot5yrs($campus_gmtfinal)
{


	if(!empty($campus_gmtfinal))
	{
		$this->db->where('campus_gmtfinal', $campus_gmtfinal);
		$this->db->select_sum('Agosto');
		$query = $this->db->get('greenmetricenerfinalgraff5yrs');
		$result = $query->row()->Agosto;
		return $result;
	}

}

function Septiembreelecxcampustot5yrs($campus_gmtfinal)
{


	if(!empty($campus_gmtfinal))
	{
		$this->db->where('campus_gmtfinal', $campus_gmtfinal);
		$this->db->select_sum('Septiembre');
		$query = $this->db->get('greenmetricenerfinalgraff5yrs');
		$result = $query->row()->Septiembre;
		return $result;
	}

}

function Octubreelecxcampustot5yrs($campus_gmtfinal)
{


	if(!empty($campus_gmtfinal))
	{
		$this->db->where('campus_gmtfinal', $campus_gmtfinal);
		$this->db->select_sum('Octubre');
		$query = $this->db->get('greenmetricenerfinalgraff5yrs');
		$result = $query->row()->Octubre;
		return $result;
	}

}

function Noviembreelecxcampustot5yrs($campus_gmtfinal)
{


	if(!empty($campus_gmtfinal))
	{
		$this->db->where('campus_gmtfinal', $campus_gmtfinal);
		$this->db->select_sum('Noviembre');
		$query = $this->db->get('greenmetricenerfinalgraff5yrs');
		$result = $query->row()->Noviembre;
		return $result;
	}

}

function Diciembreelecxcampustot5yrs($campus_gmtfinal)
{


	if(!empty($campus_gmtfinal))
	{
		$this->db->where('campus_gmtfinal', $campus_gmtfinal);
		$this->db->select_sum('Diciembre');
		$query = $this->db->get('greenmetricenerfinalgraff5yrs');
		$result = $query->row()->Diciembre;
		return $result;
	}

}
/***************************************************************************************************************************/
								/*FIN DEL LLAMADO PARA EL INTERVALO DE ELECTRICIDAD 5 AÑOS*/
/***************************************************************************************************************************/
/***************************************************************************************************************************/
									/*INICIO DE CONSUMO EN AGUA INTERVALO 5 AÑOS GM*/
/***************************************************************************************************************************/

//CREA LAS TABLAS Y TAMBIEN HACE LA INSERCION DE DATOS CORRESPONDIENTES A LAS MISMAS//
function conaguaxcampus5yrs()
{
	$this->db->trans_start();
	$tabla1= "CREATE TABLE IF NOT EXISTS `greenmetricaguafirstdataa5yrs` (`id` INT NOT NULL AUTO_INCREMENT,
				`campus_gmtcfst` VARCHAR(55) NOT NULL , `fecha_gmtcfst` VARCHAR(15) NOT NULL,
				`mes_gmtcfst` VARCHAR(15) NOT NULL, `consumo_gmtcfst` DECIMAL(30,2) NOT NULL,
			    `costo_gmtcfst` DECIMAL(30,2) NOT NULL, PRIMARY KEY (`id`),
			    UNIQUE `v2consumogmt` (`id`))  ENGINE = InnoDB";

	$tabla2= "CREATE TABLE IF NOT EXISTS `greenmetricaguatemp11_5yrs` 
	(`campus_gmtt1` VARCHAR(100), `anogmtt1` INT, `enero` DECIMAL(30,2) NOT NULL, `febrero` DECIMAL(30,2) NOT NULL,
	`marzo` DECIMAL(30,2) NOT NULL, `abril` DECIMAL(30,2) NOT NULL, `mayo` DECIMAL(30,2) NOT NULL, `junio` DECIMAL(30,2) NOT NULL,
	`julio` DECIMAL(30,2) NOT NULL, `agosto` DECIMAL(30,2) NOT NULL, `septiembre` DECIMAL(30,2) NOT NULL,
    `octubre` DECIMAL(30,2) NOT NULL, `noviembre` DECIMAL(30,2) NOT NULL, `diciembre` DECIMAL(30,2) NOT NULL)";

	$tabla3= "CREATE TABLE IF NOT EXISTS `greenmetricaguatemp22_5yrs`
	 (`campus_gmtt2` VARCHAR(100), `anogmtt2` INT, `enero` FLOAT, `febrero` FLOAT , `marzo` FLOAT, `abril` FLOAT, `mayo` FLOAT,
	 `junio` FLOAT, `julio` FLOAT, `agosto` FLOAT, `septiembre` FLOAT, `octubre` FLOAT, `noviembre` FLOAT, `diciembre` FLOAT)";

	$tabla4= "CREATE TABLE IF NOT EXISTS `greenmetricaguafinalgraff5yrs`  (`id` INT NOT NULL AUTO_INCREMENT ,
				`campus_gmtfinal` VARCHAR(55) NOT NULL,  `year_gmtfinal` YEAR NOT NULL,
			    `Enero` INT(30) NOT NULL, `Febrero` INT(30) NOT NULL, `Marzo` INT(30) NOT NULL, `Abril` INT(30) NOT NULL,
                `Mayo` INT(30) NOT NULL, `Junio` INT(30) NOT NULL, `Julio` INT(30) NOT NULL, `Agosto` INT(30) NOT NULL,
                `Septiembre` INT(30) NOT NULL, `Octubre` INT(30) NOT NULL, `Noviembre` INT(30) NOT NULL,
                `Diciembre` INT(30) NOT NULL, PRIMARY KEY (`id`), UNIQUE `enegmtfinal` (`id`))  ENGINE = InnoDB";

	$this->db->query($tabla1);
	$this->db->query($tabla2);
	$this->db->query($tabla3);
	$this->db->query($tabla4);
	
	$this->db->query(
		"INSERT INTO `greenmetricaguafirstdataa5yrs` (`campus_gmtcfst`,
			`fecha_gmtcfst`, `mes_gmtcfst`, `consumo_gmtcfst`, `costo_gmtcfst`)
	SELECT DISTINCT
            c.campus,
            (a.periodo_fin),
            MONTHNAME(a.periodo_fin),
			SUM(a.consumo),
			SUM(a.costo)
			FROM `pdc_consumo_agua` a
			INNER JOIN `ctrl_servicios_agua` b ON a.servicio = b.id 
			INNER JOIN `pdc_servicios_agua` c ON b.account = c.cuenta 
			WHERE c.campus IS NOT NULL AND c.campus <> ''
			AND a.periodo_fin IS NOT NULL AND a.periodo_fin <> ''
			AND a.consumo IS NOT NULL AND a.consumo <> ''
			AND a.costo IS NOT NULL AND a.costo <> ''
			AND b.account IS NOT NULL AND b.account <> ''
			AND a.servicio IS NOT NULL AND a.servicio <> ''
			AND (YEAR(a.periodo_fin) >= YEAR(NOW() - INTERVAL 5 YEAR)  AND YEAR(a.periodo_fin) <= YEAR(NOW() - INTERVAL 1 YEAR) )
			GROUP BY a.periodo_fin, c.campus
			ORDER BY DATE(a.periodo_fin) ASC, c.campus ASC
	ON DUPLICATE KEY UPDATE
    campus_gmtcfst = VALUES(campus_gmtcfst),
	fecha_gmtcfst = VALUES(fecha_gmtcfst), mes_gmtcfst = VALUES(mes_gmtcfst),
    consumo_gmtcfst = VALUES(consumo_gmtcfst), costo_gmtcfst = VALUES(costo_gmtcfst)");

	$this->db->query(
		"INSERT INTO `greenmetricaguatemp11_5yrs`
		SELECT
		CONCAT(`campus_gmtcfst`),
		CONCAT(YEAR(`fecha_gmtcfst`)),
		CASE WHEN `mes_gmtcfst`= 'January' THEN `consumo_gmtcfst` END,
		CASE WHEN `mes_gmtcfst`= 'February' THEN `consumo_gmtcfst` END,
		CASE WHEN `mes_gmtcfst`= 'March' THEN `consumo_gmtcfst` END,
		CASE WHEN `mes_gmtcfst`= 'April' THEN `consumo_gmtcfst` END,
		CASE WHEN `mes_gmtcfst`= 'May' THEN `consumo_gmtcfst` END,
		CASE WHEN `mes_gmtcfst`= 'June' THEN `consumo_gmtcfst` END,
		CASE WHEN `mes_gmtcfst`= 'July' THEN `consumo_gmtcfst` END,
		CASE WHEN `mes_gmtcfst`= 'August' THEN `consumo_gmtcfst` END,
		CASE WHEN `mes_gmtcfst`= 'September' THEN `consumo_gmtcfst` END,
		CASE WHEN `mes_gmtcfst`= 'October' THEN `consumo_gmtcfst` END,
		CASE WHEN `mes_gmtcfst`= 'November' THEN `consumo_gmtcfst` END,
		CASE WHEN `mes_gmtcfst`= 'December' THEN `consumo_gmtcfst` END
		FROM  `greenmetricaguafirstdataa5yrs`
		WHERE TRUE");

	$this->db->query(
		"INSERT INTO `greenmetricaguatemp22_5yrs`
			SELECT
			`campus_gmtt1`,
			`anogmtt1`,
			SUM(`enero`),
			SUM(`febrero`),
			SUM(`marzo`),
			SUM(`abril`),
			SUM(`mayo`),
			SUM(`junio`),
			SUM(`julio`),
			SUM(`agosto`),
			SUM(`septiembre`),
			SUM(`octubre`),
			SUM(`noviembre`),
			SUM(`diciembre`)
			FROM `greenmetricaguatemp11_5yrs`
			GROUP BY `campus_gmtt1`, `anogmtt1` ASC");

	$this->db->query(
		"INSERT INTO `greenmetricaguafinalgraff5yrs`(
		`campus_gmtfinal`, `year_gmtfinal`, `Enero`, `Febrero`, `Marzo`, `Abril`, `Mayo`, `Junio`, `Julio`,
		`Agosto`, `Septiembre`, `Octubre`, `Noviembre`, `Diciembre`)
		SELECT
		`campus_gmtt2`,
		`anogmtt2`,
		COALESCE(`enero`,0) AS Enero,
		COALESCE(`febrero`,0) AS Febrero,
		COALESCE(`marzo`,0) AS Marzo,
		COALESCE(`abril`,0) AS Abril,
		COALESCE(`mayo`,0) AS Mayo,
		COALESCE(`junio`,0) AS Junio,
		COALESCE(`julio`,0) AS Julio,
		COALESCE(`agosto`,0) AS Agosto,
		COALESCE(`septiembre`,0) AS Septiembre,
		COALESCE(`octubre`,0) AS Octubre,
		COALESCE(`noviembre`,0) AS Noviembre,
		COALESCE(`diciembre`,0) AS Diciembre
        FROM `greenmetricaguatemp22_5yrs`
		ON DUPLICATE KEY UPDATE
		campus_gmtfinal = VALUES(campus_gmtfinal),
		year_gmtfinal = VALUES(year_gmtfinal),
		Enero = VALUES(Enero), Febrero = VALUES(Febrero), Marzo = VALUES(Marzo), Abril = VALUES(Abril),
		Mayo = VALUES(Mayo), Junio = VALUES(Junio), Julio = VALUES(Julio), Agosto = VALUES(Agosto),
		Septiembre = VALUES(Septiembre), Octubre = VALUES(Octubre), Noviembre = VALUES(Noviembre),
		Diciembre = VALUES(Diciembre)");
	$this->db->trans_complete();
}
//*************************************FIN DE LA TRANSACCION*************************************//

//ELIMINA LAS TABLAS PARA GENERAR NUEVOS DATOS//
function dropraguaxcampus5yrs()
{
	$this->db->query("DROP TABLE  greenmetricaguafirstdataa5yrs;");
	$this->db->query("DROP TABLE  greenmetricaguatemp11_5yrs;");
	$this->db->query("DROP TABLE  greenmetricaguatemp22_5yrs;");
	$this->db->query("DROP TABLE  greenmetricaguafinalgraff5yrs;");
}


//*********************************MODELO CARGADOR COMBOBOX GreenMetricAjusteAgua5yrs INTERVALO 5 AÑOS*********************************//
function aguaxcampusfinal5yrs()
{
	
	$this->db->order_by('campus_gmtfinal', 'asc');
	$this->db->group_by('campus_gmtfinal');
	$query = $this->db->get('greenmetricaguafinalgraff5yrs');
	if($query->num_rows()>0) {
		foreach($query->result() as $row) {
			$campus_gmtfinal[$row->id] = $row;
			
		}
		return $campus_gmtfinal;

	}
}




function aguaxcampusresultado5yrs()
{
	$campus_gmtfinal = $this->input->post("campus_gmtfinal");
	//MANDA RESULTADOS SI SE SELECCIONA LA DEPENDENCIA//
	if(!empty($campus_gmtfinal))
	{
		$this->db->where('campus_gmtfinal', $campus_gmtfinal);
		$this->db->order_by('year_gmtfinal', 'asc');
		$query = $this->db->get('greenmetricaguafinalgraff5yrs');
				
			if ($query->num_rows()>0)
			{
				foreach($query->result() as $row)
				{
					$year_gmtfinal[$row->id] = $row;
				}
				return $year_gmtfinal;
			}
			else return false;
	}

}



////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//Realiza la sumatoria del consumo, dependiendo del mes en la vista GreenMetricAjusteAgua5yrs INTERVALO 5 AÑOS
function Eneroaguaxcampustot5yrs($campus_gmtfinal)
{


	if(!empty($campus_gmtfinal))
	{
		$this->db->where('campus_gmtfinal', $campus_gmtfinal);
		$this->db->select_sum('Enero');
		$query = $this->db->get('greenmetricaguafinalgraff5yrs');
		$result = $query->row()->Enero;
		return $result;
	}

}

function Febreroaguaxcampustot5yrs($campus_gmtfinal)
{


	if(!empty($campus_gmtfinal))
	{
		$this->db->where('campus_gmtfinal', $campus_gmtfinal);
		$this->db->select_sum('Febrero');
		$query = $this->db->get('greenmetricaguafinalgraff5yrs');
		$result = $query->row()->Febrero;
		return $result;
	}

}

function Marzoaguaxcampustot5yrs($campus_gmtfinal)
{


	if(!empty($campus_gmtfinal))
	{
		$this->db->where('campus_gmtfinal', $campus_gmtfinal);
		$this->db->select_sum('Marzo');
		$query = $this->db->get('greenmetricaguafinalgraff5yrs');
		$result = $query->row()->Marzo;
		return $result;
	}

}

function Abrilaguaxcampustot5yrs($campus_gmtfinal)
{


	if(!empty($campus_gmtfinal))
	{
		$this->db->where('campus_gmtfinal', $campus_gmtfinal);
		$this->db->select_sum('Abril');
		$query = $this->db->get('greenmetricaguafinalgraff5yrs');
		$result = $query->row()->Abril;
		return $result;
	}

}

function Mayoaguaxcampustot5yrs($campus_gmtfinal)
{


	if(!empty($campus_gmtfinal))
	{
		$this->db->where('campus_gmtfinal', $campus_gmtfinal);
		$this->db->select_sum('Mayo');
		$query = $this->db->get('greenmetricaguafinalgraff5yrs');
		$result = $query->row()->Mayo;
		return $result;
	}

}

function Junioaguaxcampustot5yrs($campus_gmtfinal)
{


	if(!empty($campus_gmtfinal))
	{
		$this->db->where('campus_gmtfinal', $campus_gmtfinal);
		$this->db->select_sum('Junio');
		$query = $this->db->get('greenmetricaguafinalgraff5yrs');
		$result = $query->row()->Junio;
		return $result;
	}

}

function Julioaguaxcampustot5yrs($campus_gmtfinal)
{


	if(!empty($campus_gmtfinal))
	{
		$this->db->where('campus_gmtfinal', $campus_gmtfinal);
		$this->db->select_sum('Julio');
		$query = $this->db->get('greenmetricaguafinalgraff5yrs');
		$result = $query->row()->Julio;
		return $result;
	}

}

function Agostoaguaxcampustot5yrs($campus_gmtfinal)
{


	if(!empty($campus_gmtfinal))
	{
		$this->db->where('campus_gmtfinal', $campus_gmtfinal);
		$this->db->select_sum('Agosto');
		$query = $this->db->get('greenmetricaguafinalgraff5yrs');
		$result = $query->row()->Agosto;
		return $result;
	}

}

function Septiembreaguaxcampustot5yrs($campus_gmtfinal)
{


	if(!empty($campus_gmtfinal))
	{
		$this->db->where('campus_gmtfinal', $campus_gmtfinal);
		$this->db->select_sum('Septiembre');
		$query = $this->db->get('greenmetricaguafinalgraff5yrs');
		$result = $query->row()->Septiembre;
		return $result;
	}

}

function Octubreaguaxcampustot5yrs($campus_gmtfinal)
{


	if(!empty($campus_gmtfinal))
	{
		$this->db->where('campus_gmtfinal', $campus_gmtfinal);
		$this->db->select_sum('Octubre');
		$query = $this->db->get('greenmetricaguafinalgraff5yrs');
		$result = $query->row()->Octubre;
		return $result;
	}

}

function Noviembreaguaxcampustot5yrs($campus_gmtfinal)
{


	if(!empty($campus_gmtfinal))
	{
		$this->db->where('campus_gmtfinal', $campus_gmtfinal);
		$this->db->select_sum('Noviembre');
		$query = $this->db->get('greenmetricaguafinalgraff5yrs');
		$result = $query->row()->Noviembre;
		return $result;
	}

}

function Diciembreaguaxcampustot5yrs($campus_gmtfinal)
{


	if(!empty($campus_gmtfinal))
	{
		$this->db->where('campus_gmtfinal', $campus_gmtfinal);
		$this->db->select_sum('Diciembre');
		$query = $this->db->get('greenmetricaguafinalgraff5yrs');
		$result = $query->row()->Diciembre;
		return $result;
	}

}
/***************************************************************************************************************************/
									/*FIN DE CONSUMO EN AGUA GM INTERVALO 5 AÑOS*/
/***************************************************************************************************************************/
/***************************************************************************************************************************/
									/*INICIO DE CONSUMO EN GAS GM INTERVALO 5 AÑOS*/
/***************************************************************************************************************************/

//CREA LAS TABLAS, TAMBIEN HACE LA INSERCION DE DATOS CORRESPONDIENTES A LAS MISMAS//
function congaasxcampus5yrs()
{
	$this->db->trans_start();
	$tabla1= "CREATE TABLE IF NOT EXISTS `greenmetricgaasfirstdataa5yrs` (`id` INT NOT NULL AUTO_INCREMENT,
				`campus_gmtcfst` VARCHAR(55) NOT NULL , `fecha_gmtcfst` VARCHAR(15) NOT NULL,
				`mes_gmtcfst` VARCHAR(15) NOT NULL, `consumo_gmtcfst` DECIMAL(30,2) NOT NULL,
			    `costo_gmtcfst` DECIMAL(30,2) NOT NULL, PRIMARY KEY (`id`),
			    UNIQUE `v2consumogmt` (`id`))  ENGINE = InnoDB";

	$tabla2= "CREATE TABLE IF NOT EXISTS `greenmetricgaastemp11_5yrs` 
	(`campus_gmtt1` VARCHAR(100), `anogmtt1` INT, `enero` DECIMAL(30,2) NOT NULL, `febrero` DECIMAL(30,2) NOT NULL,
	`marzo` DECIMAL(30,2) NOT NULL, `abril` DECIMAL(30,2) NOT NULL, `mayo` DECIMAL(30,2) NOT NULL, `junio` DECIMAL(30,2) NOT NULL,
	`julio` DECIMAL(30,2) NOT NULL, `agosto` DECIMAL(30,2) NOT NULL, `septiembre` DECIMAL(30,2) NOT NULL,
    `octubre` DECIMAL(30,2) NOT NULL, `noviembre` DECIMAL(30,2) NOT NULL, `diciembre` DECIMAL(30,2) NOT NULL)";

	$tabla3= "CREATE TABLE IF NOT EXISTS `greenmetricgaastemp22_5yrs`
	 (`campus_gmtt2` VARCHAR(100), `anogmtt2` INT, `enero` FLOAT, `febrero` FLOAT , `marzo` FLOAT, `abril` FLOAT, `mayo` FLOAT,
	 `junio` FLOAT, `julio` FLOAT, `agosto` FLOAT, `septiembre` FLOAT, `octubre` FLOAT, `noviembre` FLOAT, `diciembre` FLOAT)";

	$tabla4= "CREATE TABLE IF NOT EXISTS `greenmetricgaasfinalgraff5yrs`  (`id` INT NOT NULL AUTO_INCREMENT ,
				`campus_gmtfinal` VARCHAR(55) NOT NULL,  `year_gmtfinal` YEAR NOT NULL,
			    `Enero` INT(30) NOT NULL, `Febrero` INT(30) NOT NULL, `Marzo` INT(30) NOT NULL, `Abril` INT(30) NOT NULL,
                `Mayo` INT(30) NOT NULL, `Junio` INT(30) NOT NULL, `Julio` INT(30) NOT NULL, `Agosto` INT(30) NOT NULL,
                `Septiembre` INT(30) NOT NULL, `Octubre` INT(30) NOT NULL, `Noviembre` INT(30) NOT NULL,
                `Diciembre` INT(30) NOT NULL, PRIMARY KEY (`id`), UNIQUE `enegmtfinal` (`id`))  ENGINE = InnoDB";

	$this->db->query($tabla1);
	$this->db->query($tabla2);
	$this->db->query($tabla3);
	$this->db->query($tabla4);
	
	$this->db->query(
		"INSERT INTO `greenmetricgaasfirstdataa5yrs` (`campus_gmtcfst`,
			`fecha_gmtcfst`, `mes_gmtcfst`, `consumo_gmtcfst`, `costo_gmtcfst`)
	SELECT DISTINCT
            c.campus,
            (a.periodo_fin),
            MONTHNAME(a.periodo_fin),
			SUM(a.consumo),
			SUM(a.costo)
			FROM `pdc_consumo_gas` a
			INNER JOIN `ctrl_servicios_gas` b ON a.servicio = b.id 
			INNER JOIN `pdc_servicios_gas` c ON b.account = c.cuenta 
			WHERE c.campus IS NOT NULL AND c.campus <> ''
			AND a.periodo_fin IS NOT NULL AND a.periodo_fin <> ''
			AND a.consumo IS NOT NULL AND a.consumo <> ''
			AND a.costo IS NOT NULL AND a.costo <> ''
			AND b.account IS NOT NULL AND b.account <> ''
			AND a.servicio IS NOT NULL AND a.servicio <> ''
			AND (YEAR(a.periodo_fin) >= YEAR(NOW() - INTERVAL 5 YEAR)  AND YEAR(a.periodo_fin) <= YEAR(NOW() - INTERVAL 1 YEAR) )
			GROUP BY a.periodo_fin, c.campus
			ORDER BY DATE(a.periodo_fin) ASC, c.campus ASC
	ON DUPLICATE KEY UPDATE
    campus_gmtcfst = VALUES(campus_gmtcfst),
	fecha_gmtcfst = VALUES(fecha_gmtcfst), mes_gmtcfst = VALUES(mes_gmtcfst),
    consumo_gmtcfst = VALUES(consumo_gmtcfst), costo_gmtcfst = VALUES(costo_gmtcfst)");

	$this->db->query(
		"INSERT INTO `greenmetricgaastemp11_5yrs`
		SELECT
		CONCAT(`campus_gmtcfst`),
		CONCAT(YEAR(`fecha_gmtcfst`)),
		CASE WHEN `mes_gmtcfst`= 'January' THEN `consumo_gmtcfst` END,
		CASE WHEN `mes_gmtcfst`= 'February' THEN `consumo_gmtcfst` END,
		CASE WHEN `mes_gmtcfst`= 'March' THEN `consumo_gmtcfst` END,
		CASE WHEN `mes_gmtcfst`= 'April' THEN `consumo_gmtcfst` END,
		CASE WHEN `mes_gmtcfst`= 'May' THEN `consumo_gmtcfst` END,
		CASE WHEN `mes_gmtcfst`= 'June' THEN `consumo_gmtcfst` END,
		CASE WHEN `mes_gmtcfst`= 'July' THEN `consumo_gmtcfst` END,
		CASE WHEN `mes_gmtcfst`= 'August' THEN `consumo_gmtcfst` END,
		CASE WHEN `mes_gmtcfst`= 'September' THEN `consumo_gmtcfst` END,
		CASE WHEN `mes_gmtcfst`= 'October' THEN `consumo_gmtcfst` END,
		CASE WHEN `mes_gmtcfst`= 'November' THEN `consumo_gmtcfst` END,
		CASE WHEN `mes_gmtcfst`= 'December' THEN `consumo_gmtcfst` END
		FROM  `greenmetricgaasfirstdataa5yrs`
		WHERE TRUE");

	$this->db->query(
		"INSERT INTO `greenmetricgaastemp22_5yrs`
			SELECT
			`campus_gmtt1`,
			`anogmtt1`,
			SUM(`enero`),
			SUM(`febrero`),
			SUM(`marzo`),
			SUM(`abril`),
			SUM(`mayo`),
			SUM(`junio`),
			SUM(`julio`),
			SUM(`agosto`),
			SUM(`septiembre`),
			SUM(`octubre`),
			SUM(`noviembre`),
			SUM(`diciembre`)
			FROM `greenmetricgaastemp11_5yrs`
			GROUP BY `campus_gmtt1`, `anogmtt1` ASC");

	$this->db->query(
		"INSERT INTO `greenmetricgaasfinalgraff5yrs`(
		`campus_gmtfinal`, `year_gmtfinal`, `Enero`, `Febrero`, `Marzo`, `Abril`, `Mayo`, `Junio`, `Julio`,
		`Agosto`, `Septiembre`, `Octubre`, `Noviembre`, `Diciembre`)
		SELECT
		`campus_gmtt2`,
		`anogmtt2`,
		COALESCE(`enero`,0) AS Enero,
		COALESCE(`febrero`,0) AS Febrero,
		COALESCE(`marzo`,0) AS Marzo,
		COALESCE(`abril`,0) AS Abril,
		COALESCE(`mayo`,0) AS Mayo,
		COALESCE(`junio`,0) AS Junio,
		COALESCE(`julio`,0) AS Julio,
		COALESCE(`agosto`,0) AS Agosto,
		COALESCE(`septiembre`,0) AS Septiembre,
		COALESCE(`octubre`,0) AS Octubre,
		COALESCE(`noviembre`,0) AS Noviembre,
		COALESCE(`diciembre`,0) AS Diciembre
        FROM `greenmetricgaastemp22_5yrs`
		ON DUPLICATE KEY UPDATE
		campus_gmtfinal = VALUES(campus_gmtfinal),
		year_gmtfinal = VALUES(year_gmtfinal),
		Enero = VALUES(Enero), Febrero = VALUES(Febrero), Marzo = VALUES(Marzo), Abril = VALUES(Abril),
		Mayo = VALUES(Mayo), Junio = VALUES(Junio), Julio = VALUES(Julio), Agosto = VALUES(Agosto),
		Septiembre = VALUES(Septiembre), Octubre = VALUES(Octubre), Noviembre = VALUES(Noviembre),
		Diciembre = VALUES(Diciembre)");
	$this->db->trans_complete();
}
//*************************************FIN DE LA TRANSACCION*************************************//

//ELIMINA LAS TABLAS PARA GENERAR NUEVOS DATOS//
function droprgaasxcampus5yrs()
{
	$this->db->query("DROP TABLE  greenmetricgaasfirstdataa5yrs;");
	$this->db->query("DROP TABLE  greenmetricgaastemp11_5yrs;");
	$this->db->query("DROP TABLE  greenmetricgaastemp22_5yrs;");
	$this->db->query("DROP TABLE  greenmetricgaasfinalgraff5yrs;");
}


//*********************************MODELO CARGADOR COMBOBOX GAS*********************************//
function gaasxcampusfinal5yrs()
{
	
	$this->db->order_by('campus_gmtfinal', 'asc');
	$this->db->group_by('campus_gmtfinal');
	$query = $this->db->get('greenmetricgaasfinalgraff5yrs');
	if($query->num_rows()>0) {
		foreach($query->result() as $row) {
			$campus_gmtfinal[$row->id] = $row;
			
		}
		return $campus_gmtfinal;

	}
}




function gaasxcampusresultado5yrs()
{
	$campus_gmtfinal = $this->input->post("campus_gmtfinal");
	//MANDA RESULTADOS SI SE SELECCIONA LA DEPENDENCIA//
	if(!empty($campus_gmtfinal))
	{
		$this->db->where('campus_gmtfinal', $campus_gmtfinal);
		$this->db->order_by('year_gmtfinal', 'asc');
		$query = $this->db->get('greenmetricgaasfinalgraff5yrs');
				
			if ($query->num_rows()>0)
			{
				foreach($query->result() as $row)
				{
					$year_gmtfinal[$row->id] = $row;
				}
				return $year_gmtfinal;
			}
			else return false;
	}

}



////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//Realiza la sumatoria del consumo, dependiendo del mes en la vista GreenMetricAjusteGas5yrs INTERVALO 5 AÑOS
function Enerogaasxcampustot5yrs($campus_gmtfinal)
{


	if(!empty($campus_gmtfinal))
	{
		$this->db->where('campus_gmtfinal', $campus_gmtfinal);
		$this->db->select_sum('Enero');
		$query = $this->db->get('greenmetricgaasfinalgraff5yrs');
		$result = $query->row()->Enero;
		return $result;
	}

}

function Febrerogaasxcampustot5yrs($campus_gmtfinal)
{


	if(!empty($campus_gmtfinal))
	{
		$this->db->where('campus_gmtfinal', $campus_gmtfinal);
		$this->db->select_sum('Febrero');
		$query = $this->db->get('greenmetricgaasfinalgraff5yrs');
		$result = $query->row()->Febrero;
		return $result;
	}

}

function Marzogaasxcampustot5yrs($campus_gmtfinal)
{


	if(!empty($campus_gmtfinal))
	{
		$this->db->where('campus_gmtfinal', $campus_gmtfinal);
		$this->db->select_sum('Marzo');
		$query = $this->db->get('greenmetricgaasfinalgraff5yrs');
		$result = $query->row()->Marzo;
		return $result;
	}

}

function Abrilgaasxcampustot5yrs($campus_gmtfinal)
{


	if(!empty($campus_gmtfinal))
	{
		$this->db->where('campus_gmtfinal', $campus_gmtfinal);
		$this->db->select_sum('Abril');
		$query = $this->db->get('greenmetricgaasfinalgraff5yrs');
		$result = $query->row()->Abril;
		return $result;
	}

}

function Mayogaasxcampustot5yrs($campus_gmtfinal)
{


	if(!empty($campus_gmtfinal))
	{
		$this->db->where('campus_gmtfinal', $campus_gmtfinal);
		$this->db->select_sum('Mayo');
		$query = $this->db->get('greenmetricgaasfinalgraff5yrs');
		$result = $query->row()->Mayo;
		return $result;
	}

}

function Juniogaasxcampustot5yrs($campus_gmtfinal)
{


	if(!empty($campus_gmtfinal))
	{
		$this->db->where('campus_gmtfinal', $campus_gmtfinal);
		$this->db->select_sum('Junio');
		$query = $this->db->get('greenmetricgaasfinalgraff5yrs');
		$result = $query->row()->Junio;
		return $result;
	}

}

function Juliogaasxcampustot5yrs($campus_gmtfinal)
{


	if(!empty($campus_gmtfinal))
	{
		$this->db->where('campus_gmtfinal', $campus_gmtfinal);
		$this->db->select_sum('Julio');
		$query = $this->db->get('greenmetricgaasfinalgraff5yrs');
		$result = $query->row()->Julio;
		return $result;
	}

}

function Agostogaasxcampustot5yrs($campus_gmtfinal)
{


	if(!empty($campus_gmtfinal))
	{
		$this->db->where('campus_gmtfinal', $campus_gmtfinal);
		$this->db->select_sum('Agosto');
		$query = $this->db->get('greenmetricgaasfinalgraff5yrs');
		$result = $query->row()->Agosto;
		return $result;
	}

}

function Septiembregaasxcampustot5yrs($campus_gmtfinal)
{


	if(!empty($campus_gmtfinal))
	{
		$this->db->where('campus_gmtfinal', $campus_gmtfinal);
		$this->db->select_sum('Septiembre');
		$query = $this->db->get('greenmetricgaasfinalgraff5yrs');
		$result = $query->row()->Septiembre;
		return $result;
	}

}

function Octubregaasxcampustot5yrs($campus_gmtfinal)
{


	if(!empty($campus_gmtfinal))
	{
		$this->db->where('campus_gmtfinal', $campus_gmtfinal);
		$this->db->select_sum('Octubre');
		$query = $this->db->get('greenmetricgaasfinalgraff5yrs');
		$result = $query->row()->Octubre;
		return $result;
	}

}

function Noviembregaasxcampustot5yrs($campus_gmtfinal)
{


	if(!empty($campus_gmtfinal))
	{
		$this->db->where('campus_gmtfinal', $campus_gmtfinal);
		$this->db->select_sum('Noviembre');
		$query = $this->db->get('greenmetricgaasfinalgraff5yrs');
		$result = $query->row()->Noviembre;
		return $result;
	}

}

function Diciembregaasxcampustot5yrs($campus_gmtfinal)
{


	if(!empty($campus_gmtfinal))
	{
		$this->db->where('campus_gmtfinal', $campus_gmtfinal);
		$this->db->select_sum('Diciembre');
		$query = $this->db->get('greenmetricgaasfinalgraff5yrs');
		$result = $query->row()->Diciembre;
		return $result;
	}

}
/***************************************************************************************************************************/
										/*FIN DE CONSUMO EN GAS GM INTERVALO 5 AÑOS*/
/***************************************************************************************************************************/




/***************************************************************************************************************************/
						/*INICIO PARAL MODELO PARA LA BUSQUEDA DE CONSUMO X DEPENDENCIAS (ING. FELIX)*/
/***************************************************************************************************************************/


/***************************************************************************************************************************/
					/*INICIO DE LA COMPARACION DE CONSUMO AÑO ACTUAL Y PASADO - ELECTRICIDAD*/
/***************************************************************************************************************************/

//CREA TABLAS TEMPORALES Y FINAL QUE SERAN DATOS PARA LAS GRÁFICAS//
function creatablascomparacionelec()
{
/*/CREA LA TABLA INICIAL QUE RECOLECTA(HACE JOIN) ENTRE LAS TABLAS CORRESPONDIENTES AL CONSUMO Y COSTO DE LAS DEPENDENCIAS DEL SERVICIO DE ELECTRICIDAD PARA MOSTRAR LA GRAFICA/*/
	$this->db->trans_start();
	$tabla1= "CREATE TABLE IF NOT EXISTS `depes_recibos_energia_1ero_1year_final` (`id` INT NOT NULL AUTO_INCREMENT, `cta_fst` FLOAT(26) NOT NULL, `depes_fst` VARCHAR(55) NOT NULL,
	`periodo_inicio_fst` VARCHAR(15) NOT NULL, `mes_inicio_fst` VARCHAR(15) NOT NULL,
	 `periodo_fin_fst` VARCHAR(15) NOT NULL, `mes_fin_fst` VARCHAR(15) NOT NULL,
	  `consumo_mes_fst` DECIMAL(30,2) NOT NULL, `costo_mes_fst` DECIMAL(30,2) NOT NULL, PRIMARY KEY (`id`),
	UNIQUE `depreene1yrf` (`id`))    ENGINE = InnoDB DEFAULT CHARSET=utf8";
	/*/CREA LA TABLA TEMP1YEAR EN ORDEN CORRESPONDIENTE POR MESES DEPENDIENDO SI ES CONSUMO Y/O COSTO/*/
	$tabla2= "CREATE TABLE IF NOT EXISTS `depes_recibos_energia_temp1year_pasado_y_actual_final`
	(`cta_temp1year_pasado_1` FLOAT(26) NOT NULL, `depes_temp1year_pasado_1` VARCHAR(100),
    `periodo_inicio_temp1year_pasado_1` DATE, `year_inicio_temp1year_pasado_1` YEAR, `mes_inicio_temp1year_p1` VARCHAR(15) NOT NULL,
    `periodo_fin_temp1year_pasado_1` DATE, `year_fin_temp1year_pasado_1` YEAR, `mes_fin_temp1year_p1` VARCHAR(15) NOT NULL,
    `enero_con` DECIMAL(30,2) NOT NULL, `febrero_con` DECIMAL(30,2) NOT NULL, `marzo_con` DECIMAL(30,2) NOT NULL,
    `abril_con` DECIMAL(30,2) NOT NULL, `mayo_con` DECIMAL(30,2) NOT NULL, `junio_con` DECIMAL(30,2) NOT NULL,
	`julio_con` DECIMAL(30,2) NOT NULL, `agosto_con` DECIMAL(30,2) NOT NULL, `septiembre_con` DECIMAL(30,2) NOT NULL,
    `octubre_con` DECIMAL(30,2) NOT NULL, `noviembre_con` DECIMAL(30,2) NOT NULL, `diciembre_con` DECIMAL(30,2) NOT NULL,
    `enero_cos` DECIMAL(30,2) NOT NULL, `febrero_cos` DECIMAL(30,2) NOT NULL, `marzo_cos` DECIMAL(30,2) NOT NULL,
    `abril_cos` DECIMAL(30,2) NOT NULL, `mayo_cos` DECIMAL(30,2) NOT NULL, `junio_cos` DECIMAL(30,2) NOT NULL,
	`julio_cos` DECIMAL(30,2) NOT NULL, `agosto_cos` DECIMAL(30,2) NOT NULL, `septiembre_cos` DECIMAL(30,2) NOT NULL,
    `octubre_cos` DECIMAL(30,2) NOT NULL, `noviembre_cos` DECIMAL(30,2) NOT NULL, `diciembre_cos` DECIMAL(30,2) NOT NULL)   ENGINE = InnoDB DEFAULT CHARSET=utf8";
	/*/CREA LA TABLA TEMPORAL CORRESPONDIENTE AL AÑO ACTUAL, PREVIO A LA TABLA DE LA GRAFICA FINAL/*/
	$tabla3= "CREATE TABLE IF NOT EXISTS `depes_elec_anio_actual_temporal`
	(`cta_temp_anio_actual` VARCHAR(100) NOT NULL, `depe_temp_anio_actual` VARCHAR(100) NOT NULL, `anio_temp_ele` YEAR NOT NULL, `enero` DECIMAL(30,2) NOT NULL, `febrero` DECIMAL(30,2) NOT NULL,
	`marzo` DECIMAL(30,2) NOT NULL, `abril` DECIMAL(30,2) NOT NULL, `mayo` DECIMAL(30,2) NOT NULL, `junio` DECIMAL(30,2) NOT NULL,
	`julio` DECIMAL(30,2) NOT NULL, `agosto` DECIMAL(30,2) NOT NULL, `septiembre` DECIMAL(30,2) NOT NULL,
    `octubre` DECIMAL(30,2) NOT NULL, `noviembre` DECIMAL(30,2) NOT NULL, `diciembre` DECIMAL(30,2) NOT NULL)   ENGINE = InnoDB DEFAULT CHARSET=utf8";
	//CREA LA TABLA PARA LA MOSTRAR LA//
	$tabla4= "CREATE TABLE IF NOT EXISTS `depes_elec_anio_actual_grafica_final`
	(`id` INT NOT NULL AUTO_INCREMENT,
	`cta_eleanio_atual` VARCHAR(100), `depe_eleanio_actual` VARCHAR(100), `anio_actual_elec` YEAR NOT NULL,
	`Enero` INT(30) NOT NULL, `Febrero` INT(30) NOT NULL, `Marzo` INT(30) NOT NULL, `Abril` INT(30) NOT NULL,
			   `Mayo` INT(30) NOT NULL, `Junio` INT(30) NOT NULL, `Julio` INT(30) NOT NULL, `Agosto` INT(30) NOT NULL,
			   `Septiembre` INT(30) NOT NULL, `Octubre` INT(30) NOT NULL, `Noviembre` INT(30) NOT NULL,
			   `Diciembre` INT(30) NOT NULL, UNIQUE `deperepe` (`id`))    ENGINE = InnoDB DEFAULT CHARSET=utf8";

	//CREA LA TABLA FINAL PARA LAS COMPARACIONES//
	$tabla5= "CREATE TABLE IF NOT EXISTS `tbl_final_consumo_year_pasado_y_comparaciones` (`id` INT NOT NULL AUTO_INCREMENT,
	`cta_final_cypyp` VARCHAR(55) NOT NULL, `depe_final_cypyp` VARCHAR(55) NOT NULL,
	`anio_final_cypyp` VARCHAR(15) NOT NULL, `Enero`  DECIMAL(45,2) NOT NULL,  `Febrero`  DECIMAL(45,2) NOT NULL,
	`Marzo`  DECIMAL(45,2) NOT NULL,  `Abril`  DECIMAL(45,2) NOT NULL,  `Mayo`  DECIMAL(45,2) NOT NULL,
	`Junio`  DECIMAL(45,2) NOT NULL,  `Julio`  DECIMAL(45,2) NOT NULL,  `Agosto`  DECIMAL(45,2) NOT NULL,
	`Septiembre`  DECIMAL(45,2) NOT NULL,  `Octubre`  DECIMAL(45,2) NOT NULL,  `Noviembre`  DECIMAL(45,2) NOT NULL,
	`Diciembre`  DECIMAL(45,2) NOT NULL, `consumo_mes_anterior`  DECIMAL(45,2) NOT NULL,
	`consumo_mismo_mes_year_anterior` DECIMAL(45,2) NOT NULL, PRIMARY KEY (`id`),
	UNIQUE `depreene1yrf` (`id`))    ENGINE = InnoDB DEFAULT CHARSET=utf8";

	//CREA LA TABLA PARA MOSTRAR EL PREVIO A LA TABLA DE LAS DEPENDENCIAS PASADAS//
	$tabla6= "CREATE TABLE IF NOT EXISTS `depes_elec_anio_actual_grafica_final_final` (`id` INT NOT NULL AUTO_INCREMENT, `cta_eleanio_atual` VARCHAR(40) NOT NULL,
	`depe_eleanio_actual` VARCHAR(60) NOT NULL, `anio_actual_elec` VARCHAR(20) NOT NULL,
	`Enero` INT(50) NOT NULL, `Febrero` INT(50) NOT NULL,
	`Marzo` INT(50) NOT NULL, `Abril` INT(50) NOT NULL,
	`Mayo` INT(50) NOT NULL, `Junio` INT(50) NOT NULL,
    `Julio` INT(50) NOT NULL, `Agosto` INT(50) NOT NULL,
	`Septiembre` INT(50) NOT NULL, `Octubre` INT(50) NOT NULL,
    `Noviembre` INT(50) NOT NULL, `Diciembre` INT(50) NOT NULL,
    `consumo_mes_anterior` VARCHAR(40) NOT NULL, `consumo_mismo_mes_year_anterior` VARCHAR(40) NOT NULL,
    PRIMARY KEY (`id`), UNIQUE `depepepe` (`id`))  ENGINE = InnoDB DEFAULT CHARSET=utf8";

	$this->db->query($tabla1);
	$this->db->query($tabla2);
	$this->db->query($tabla3);
	$this->db->query($tabla4);
	$this->db->query($tabla5);
	$this->db->query($tabla6);
	
	/*/HACE JOIN DE LAS TABLAS QUE HACEN REFERENCIA A LOS CONSUMOS Y COSTOS DE LAS DEPENDENCIAS EN EL SERVICIO DE ELECTRICIDAD/*/ 
	$this->db->query(
		"INSERT INTO `depes_recibos_energia_1ero_1year_final` (`cta_fst`, `depes_fst`, `periodo_inicio_fst`, `mes_inicio_fst`, `periodo_fin_fst`, `mes_fin_fst`, `consumo_mes_fst`,
		 `costo_mes_fst`)
		SELECT DISTINCT
		c.cuenta,
		c.dependencia,
		(a.periodo_inicio),
		MONTHNAME(a.periodo_inicio),
		(a.periodo_fin),
		MONTHNAME(a.periodo_fin),
		(a.consumo),
		(a.costo)
		FROM `pdc_consumo_energia` a
		INNER JOIN `ctrl_servicios` b ON a.servicio = b.id 
		INNER JOIN `pdc_servicios_energia` c ON b.account = c.cuenta 
		WHERE c.dependencia IS NOT NULL AND c.dependencia <> ''
		AND a.periodo_fin IS NOT NULL AND a.periodo_fin <> ''
		AND a.consumo IS NOT NULL AND a.consumo <> ''
		AND a.costo IS NOT NULL AND a.costo <> ''
		AND b.account IS NOT NULL AND b.account <> ''
		AND a.servicio IS NOT NULL AND a.servicio <> ''
        AND a.id NOT IN('192')
		AND b.id NOT IN('192')
		AND a.id NOT IN('105')
		AND b.id NOT IN('105')
		AND c.id NOT IN('192')
		AND c.id NOT IN('105')
        AND (YEAR(a.periodo_fin) <= YEAR(NOW() - INTERVAL 0 YEAR) AND YEAR(a.periodo_fin)  >= YEAR(NOW() - INTERVAL 1 YEAR))
		ORDER BY DATE(a.periodo_fin) ASC
		ON DUPLICATE KEY UPDATE cta_fst = VALUES(cta_fst), `depes_fst` = VALUES(depes_fst), `periodo_inicio_fst` = VALUES(periodo_inicio_fst), `mes_inicio_fst` = VALUES(mes_inicio_fst),
		`periodo_fin_fst` = VALUES(periodo_fin_fst), `mes_fin_fst` = VALUES(mes_fin_fst), `consumo_mes_fst` = VALUES(consumo_mes_fst), `costo_mes_fst` = VALUES(costo_mes_fst)");

/*/INSERTA LOS DATOS A LA TABLA TEMP1YEAR EN ORDEN CORRESPONDIENTE AL AÑO PASADO Y ACTUAL POR MESES DEPENDIENDO SI ES CONSUMO Y/O COSTO/*/
	$this->db->query(
		"INSERT INTO `depes_recibos_energia_temp1year_pasado_y_actual_final`
		SELECT
		CONCAT(`cta_fst`),
		CONCAT(`depes_fst`),
		CONCAT(`periodo_inicio_fst`),
		CONCAT(YEAR(`periodo_inicio_fst`)),
		CONCAT(`mes_inicio_fst`),
		CONCAT(`periodo_fin_fst`),
		CONCAT(YEAR(`periodo_fin_fst`)),
		CONCAT(`mes_fin_fst`),
		CASE WHEN `mes_fin_fst` = 'January' THEN `consumo_mes_fst` END,
		CASE WHEN `mes_fin_fst` = 'February' THEN `consumo_mes_fst` END,
		CASE WHEN `mes_fin_fst` = 'March' THEN `consumo_mes_fst` END,
		CASE WHEN `mes_fin_fst` = 'April' THEN `consumo_mes_fst` END,
		CASE WHEN `mes_fin_fst` = 'May' THEN `consumo_mes_fst` END,
		CASE WHEN `mes_fin_fst` = 'June' THEN `consumo_mes_fst` END,
		CASE WHEN `mes_fin_fst` = 'July' THEN `consumo_mes_fst` END,
		CASE WHEN `mes_fin_fst` = 'August' THEN `consumo_mes_fst` END,
		CASE WHEN `mes_fin_fst` = 'September' THEN `consumo_mes_fst` END,
		CASE WHEN `mes_fin_fst` = 'October' THEN `consumo_mes_fst` END,
		CASE WHEN `mes_fin_fst` = 'November' THEN `consumo_mes_fst` END,
		CASE WHEN `mes_fin_fst` = 'December' THEN `consumo_mes_fst` END,
		CASE WHEN `mes_fin_fst` = 'January' THEN `costo_mes_fst` END,
		CASE WHEN `mes_fin_fst` = 'February' THEN `costo_mes_fst` END,
		CASE WHEN `mes_fin_fst` = 'March' THEN `costo_mes_fst` END,
		CASE WHEN `mes_fin_fst` = 'April' THEN `costo_mes_fst` END,
		CASE WHEN `mes_fin_fst` = 'May' THEN `costo_mes_fst` END,
		CASE WHEN `mes_fin_fst` = 'June' THEN `costo_mes_fst` END,
		CASE WHEN `mes_fin_fst` = 'July' THEN `costo_mes_fst` END,
		CASE WHEN `mes_fin_fst` = 'August' THEN `costo_mes_fst` END,
		CASE WHEN `mes_fin_fst` = 'September' THEN `costo_mes_fst` END,
		CASE WHEN `mes_fin_fst` = 'October' THEN `costo_mes_fst` END,
		CASE WHEN `mes_fin_fst` = 'November' THEN `costo_mes_fst` END,
		CASE WHEN `mes_fin_fst` = 'December' THEN `costo_mes_fst` END
		FROM `depes_recibos_energia_1ero_1year_final`
		WHERE TRUE");

/*/INSERTA LOS DATOS A LA TABLA TEMPORAL CORRESPONDIENTE AL AÑO ACTUAL, PREVIO A LA TABLA DE LA GRAFICA FINAL/*/
	$this->db->query(
		"INSERT INTO `depes_elec_anio_actual_temporal`(
			`cta_temp_anio_actual`, `depe_temp_anio_actual`,
			 `anio_temp_ele`, `enero`, `febrero`,
			`marzo`, `abril`, `mayo`, `junio`,
			`julio`, `agosto`, `septiembre`,
			`octubre`, `noviembre`, `diciembre`)
					SELECT
					`cta_temp1year_pasado_1`,
					`depes_temp1year_pasado_1`,
					`periodo_fin_temp1year_pasado_1`,
					SUM(`enero_con`),
					SUM(`febrero_con`),
					SUM(`marzo_con`),
					SUM(`abril_con`),
					SUM(`mayo_con`),
					SUM(`junio_con`),
					SUM(`julio_con`),
					SUM(`agosto_con`),
					SUM(`septiembre_con`),
					SUM(`octubre_con`),
					SUM(`noviembre_con`),
					SUM(`diciembre_con`)
					FROM `depes_recibos_energia_temp1year_pasado_y_actual_final`
					WHERE YEAR(periodo_fin_temp1year_pasado_1) = YEAR(NOW())
					GROUP BY `depes_temp1year_pasado_1`, YEAR(`periodo_fin_temp1year_pasado_1`) ASC");

/*/INSERTA LOS DATOS A LA TABLA FINAL PARA MOSTRAR LA GRAFICA/*/
	$this->db->query(
		"INSERT INTO `depes_elec_anio_actual_grafica_final`(`cta_eleanio_atual`, `depe_eleanio_actual`, `anio_actual_elec`,
		`Enero`, `Febrero`, `Marzo`, `Abril`,
				   `Mayo`, `Junio`, `Julio`, `Agosto`,
				   `Septiembre`, `Octubre`, `Noviembre`,
				   `Diciembre`)
   		SELECT
   		`cta_temp_anio_actual`,
   		`depe_temp_anio_actual`,
   		`anio_temp_ele`,
   		COALESCE(`enero`,0) AS Enero,
   		COALESCE(`febrero`,0) AS Febrero,
   		COALESCE(`marzo`,0) AS Marzo,
   		COALESCE(`abril`,0) AS Abril,
   		COALESCE(`mayo`,0) AS Mayo,
   		COALESCE(`junio`,0) AS Junio,
   		COALESCE(`julio`,0) AS Julio,
   		COALESCE(`agosto`,0) AS Agosto,
   		COALESCE(`septiembre`,0) AS Septiembre,
   		COALESCE(`octubre`,0) AS Octubre,
   		COALESCE(`noviembre`,0) AS Noviembre,
   		COALESCE(`diciembre`,0) AS Diciembre
   		FROM `depes_elec_anio_actual_temporal`
   		GROUP BY `depe_temp_anio_actual` ASC");

/*/HACE INSERCION A LOS DATOS PARA LA TABLA PRE FINAL DE CONSUMO DE COMPARACIONES/*/
		$this->db->query(
			"INSERT INTO `tbl_final_consumo_year_pasado_y_comparaciones` (
			`cta_final_cypyp`, `depe_final_cypyp`,
			`anio_final_cypyp`, `Enero`,  `Febrero`,
			`Marzo`,  `Abril`,  `Mayo`,
			`Junio`, `Julio`, `Agosto`,
			`Septiembre`, `Octubre`,  `Noviembre`,
			`Diciembre`, `consumo_mes_anterior`,
			`consumo_mismo_mes_year_anterior`)
			SELECT DISTINCT
			a.cta_temp_anio_pasado,
			a.depe_temp_anio_pasado,
			a.anio_temp_pasado,
			COALESCE(a.enero,0) AS Enero,
			COALESCE(a.febrero,0) AS Febrero,
			COALESCE(a.marzo,0) AS Marzo,
			COALESCE(a.abril,0) AS Abril,
			COALESCE(a.mayo,0) AS Mayo,
			COALESCE(a.junio,0) AS Junio,
			COALESCE(a.julio,0) AS Julio,
			COALESCE(a.agosto,0) AS Agosto,
			COALESCE(a.septiembre,0) AS Septiembre,
			COALESCE(a.octubre,0) AS Octubre,
			COALESCE(a.noviembre,0) AS Noviembre,
			COALESCE(a.diciembre,0) AS Diciembre,
			b.consumo_mes_anterior,
			b.consumo_mismo_mes_year_anterior
			FROM `depes_elec_anio_pasado_consumo_temporal_v4` a
			INNER JOIN `tbl_temp_comparacion_elec_depu_v1` b ON a.servicio_temp_year_pasado = b.servicio
			WHERE b.servicio IS NOT NULL AND b.servicio <> ''
			AND (YEAR(b.periodo_fin) <= YEAR(NOW() - INTERVAL 0 YEAR) AND YEAR(b.periodo_fin)  >= YEAR(NOW() - INTERVAL 1 YEAR))
			ORDER BY DATE(b.periodo_fin) ASC");

		$this->db->query(
			"INSERT INTO `depes_elec_anio_actual_grafica_final_final` (`cta_eleanio_atual`, `depe_eleanio_actual`, `anio_actual_elec`,
			`Enero`, `Febrero`,
			`Marzo`, `Abril`,
			`Mayo`, `Junio`,
			`Julio`, `Agosto`,
			`Septiembre`, `Octubre`,
			`Noviembre`, `Diciembre`,
			`consumo_mes_anterior`, `consumo_mismo_mes_year_anterior`)
			SELECT DISTINCT
			a.cta_eleanio_atual,
			a.depe_eleanio_actual,
			a.anio_actual_elec,
			a.Enero,
			a.Febrero,
			a.Marzo,
			a.Abril,
			a.Mayo,
			a.Junio,
			a.Julio,
			a.Agosto,
			a.Septiembre,
			a.Octubre,
			a.Noviembre,
			a.Diciembre,
			b.consumo_mes_anterior,
			b. consumo_mismo_mes_year_anterior
			FROM `depes_elec_anio_actual_grafica_final` a
			INNER JOIN `tbl_final_consumo_year_pasado_y_comparaciones` b ON a.cta_eleanio_atual=b.cta_final_cypyp");

$this->db->trans_complete();
}
//*************************************FIN DE LA TRANSACCION*************************************//

//ELIMINA LAS TABLAS PARA GENERAR NUEVOS DATOS//
function droprtablascompelecactualypasado()
{
	$this->db->query("DROP TABLE  depes_recibos_energia_1ero_1year_final;");
	$this->db->query("DROP TABLE  depes_recibos_energia_temp1year_pasado_y_actual_final;");
	$this->db->query("DROP TABLE  depes_elec_anio_actual_temporal;");
	$this->db->query("DROP TABLE  depes_elec_anio_actual_grafica_final;");
}
//*************************************FIN DEL BORRADO*************************************//

//CARGA EL MENU DROP DOWN PARA LAS DEPENDENCIAS ELECTRICIDAD//
function catdepesxragraficoanioactual()
{
	
	$this->db->order_by('depe_eleanio_actual', 'asc');
	$this->db->group_by('depe_eleanio_actual');
	$query = $this->db->get('depes_elec_anio_actual_grafica_final');
	if($query->num_rows()>0) {
		foreach($query->result() as $row) {
			$depe_eleanio_actual[$row->id] = $row;
			
		}
		return $depe_eleanio_actual;

	}
}
//*************************************FIN*************************************//

//CARGA EL MENU DROP DOWN PARA LAS DEPENDENCIAS ELECTRICIDAD//
function catdepesxragraficoanioactualdep()
{
	
	$this->db->order_by('depe_eleanio_actual', 'asc');
	$this->db->group_by('depe_eleanio_actual');
	$query = $this->db->get('depes_elec_anio_actual_grafica_final');
	if($query->num_rows()>0) {
		foreach($query->result() as $row) {
			$depe_eleanio_actual[$row->id] = $row;
			
		}
		return $depe_eleanio_actual;

	}
}
//*************************************FIN*************************************//

//CARGA EL MENU DROP DOWN PARA LAS DEPENDENCIAS ELECTRICIDAD//
function catdepesxragraficoanioactualcta()
{
	
	$this->db->order_by('depe_eleanio_actual', 'asc');
	$this->db->group_by('depe_eleanio_actual');
	$query = $this->db->get('depes_elec_anio_actual_grafica_final');
	if($query->num_rows()>0) {
		foreach($query->result() as $row) {
			$cta_eleanio_actual[$row->id] = $row;
			
		}
		return $cta_eleanio_actual;

	}
}
//*************************************FIN*************************************//

//MANDA RESULTADOS SI SE SELECCIONA LA DEPENDENCIA PARA GENERAR LA GRÁFICA EN ELECTRICIDAD//
function graficaelecdepeyear()
{
	$depe_eleanio_actual = $this->input->post("depe_eleanio_actual");
	if(!empty($depe_eleanio_actual))
	{
		$this->db->where('depe_eleanio_actual', $depe_eleanio_actual);
		$this->db->order_by('id', 'asc');
		$query = $this->db->get('depes_elec_anio_actual_grafica_final_final');
				
			if ($query->num_rows()>0)
			{
				foreach($query->result() as $row)
				{
					$cta_eleanio_atual[$row->id] = $row;
				}
				return $cta_eleanio_atual;
			}
}

}
//*************************************FIN*************************************//

//MANDA RESULTADOS SI SE SELECCIONA LA DEPENDENCIA PARA GENERAR LA GRÁFICA EN ELECTRICIDAD//
function graficaelecdepeyeardep()
{
	$depe_eleanio_actual = $this->input->post("depe_eleanio_actual");
	if(!empty($depe_eleanio_actual))
	{
		$this->db->where('depe_eleanio_actual', $depe_eleanio_actual);
		$this->db->order_by('id', 'asc');
		$query = $this->db->get('depes_elec_anio_actual_grafica_final_final');
				
			if ($query->num_rows()>0)
			{
				foreach($query->result() as $row)
				{
					$cta_eleanio_atual[$row->id] = $row;
				}
				return $cta_eleanio_atual;
			}
}

}
//*************************************FIN*************************************//
//MANDA RESULTADOS SI SE SELECCIONA LA DEPENDENCIA PARA GENERAR LA GRÁFICA EN ELECTRICIDAD//
function graficaelecdepeyearcta()
{
	$cta_eleanio_actual = $this->input->post("cta_eleanio_actual");
	if(!empty($cta_eleanio_actual))
	{
		$this->db->where('cta_eleanio_actual', $cta_eleanio_actual);
		$this->db->order_by('id', 'asc');
		$query = $this->db->get('depes_elec_anio_actual_grafica_final_final');
				
			if ($query->num_rows()>0)
			{
				foreach($query->result() as $row)
				{
					$cta_eleanio_atual[$row->id] = $row;
				}
				return $cta_eleanio_atual;
			}
}

}
//*************************************FIN*************************************//

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//LLAMADO DE LOS MESES PARA LA GRAFICA AÑO ACTUAL DE CONSUMO EN ELECTRICIDAD//

function Eneroelecactualyear($depe_eleanio_actual)
{


	if(!empty($depe_eleanio_actual))
	{
		$this->db->where('depe_eleanio_actual', $depe_eleanio_actual);
		$this->db->select_sum('Enero');
		$query = $this->db->get('depes_elec_anio_actual_grafica_final');
		$result = $query->row()->Enero;
		return $result;
	}

}

function Febreroelecactualyear($depe_eleanio_actual)
{


	if(!empty($depes))
	{
		$this->db->where('depe_eleanio_actual', $depe_eleanio_actual);
		$this->db->select_sum('Febrero');
		$query = $this->db->get('depes_elec_anio_actual_grafica_final');
		$result = $query->row()->Febrero;
		return $result;
	}

}

function Marzoelecactualyear($depe_eleanio_actual)
{


	if(!empty($depe_eleanio_actual))
	{
		$this->db->where('depe_eleanio_actual', $depe_eleanio_actual);
		$this->db->select_sum('Marzo');
		$query = $this->db->get('depes_elec_anio_actual_grafica_final');
		$result = $query->row()->Marzo;
		return $result;
	}

}

function Abrilelecactualyear($depe_eleanio_actual)
{


	if(!empty($depe_eleanio_actual))
	{
		$this->db->where('depe_eleanio_actual', $depe_eleanio_actual);
		$this->db->select_sum('Abril');
		$query = $this->db->get('depes_elec_anio_actual_grafica_final');
		$result = $query->row()->Abril;
		return $result;
	}

}

function Mayoelecactualyear($depe_eleanio_actual)
{


	if(!empty($depe_eleanio_actual))
	{
		$this->db->where('depe_eleanio_actual', $depe_eleanio_actual);
		$this->db->select_sum('Mayo');
		$query = $this->db->get('depes_elec_anio_actual_grafica_final');
		$result = $query->row()->Mayo;
		return $result;
	}

}

function Junioelecactualyear($depe_eleanio_actual)
{


	if(!empty($depe_eleanio_actual))
	{
		$this->db->where('depe_eleanio_actual', $depe_eleanio_actual);
		$this->db->select_sum('Junio');
		$query = $this->db->get('depes_elec_anio_actual_grafica_final');
		$result = $query->row()->Junio;
		return $result;
	}

}

function Julioelecactualyear($depe_eleanio_actual)
{


	if(!empty($depe_eleanio_actual))
	{
		$this->db->where('depe_eleanio_actual', $depe_eleanio_actual);
		$this->db->select_sum('Julio');
		$query = $this->db->get('depes_elec_anio_actual_grafica_final');
		$result = $query->row()->Julio;
		return $result;
	}

}

function Agostoelecactualyear($depe_eleanio_actual)
{


	if(!empty($depe_eleanio_actual))
	{
		$this->db->where('depe_eleanio_actual', $depe_eleanio_actual);
		$this->db->select_sum('Agosto');
		$query = $this->db->get('depes_elec_anio_actual_grafica_final');
		$result = $query->row()->Agosto;
		return $result;
	}

}

function Septiembreelecactualyear($depe_eleanio_actual)
{


	if(!empty($depe_eleanio_actual))
	{
		$this->db->where('depe_eleanio_actual', $depe_eleanio_actual);
		$this->db->select_sum('Septiembre');
		$query = $this->db->get('depes_elec_anio_actual_grafica_final');
		$result = $query->row()->Septiembre;
		return $result;
	}

}

function Octubreelecactualyear($depe_eleanio_actual)
{


	if(!empty($depe_eleanio_actual))
	{
		$this->db->where('depe_eleanio_actual', $depe_eleanio_actual);
		$this->db->select_sum('Octubre');
		$query = $this->db->get('depes_elec_anio_actual_grafica_final');
		$result = $query->row()->Octubre;
		return $result;
	}

}

function Noviembreelecactualyear($depe_eleanio_actual)
{


	if(!empty($depe_eleanio_actual))
	{
		$this->db->where('depe_eleanio_actual', $depe_eleanio_actual);
		$this->db->select_sum('Noviembre');
		$query = $this->db->get('depes_elec_anio_actual_grafica_final');
		$result = $query->row()->Noviembre;
		return $result;
	}

}

function Diciembreelecactualyear($depe_eleanio_actual)
{


	if(!empty($depe_eleanio_actual))
	{
		$this->db->where('depe_eleanio_actual', $depe_eleanio_actual);
		$this->db->select_sum('Diciembre');
		$query = $this->db->get('depes_elec_anio_actual_grafica_final');
		$result = $query->row()->Diciembre;
		return $result;
	}

}
			//*************************************FIN*************************************//

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//LLAMADO DE LOS MESES PARA LA GRAFICA AÑO ACTUAL DE CONSUMO EN ELECTRICIDAD//

function Eneroelecactualyearcta($cta_eleanio_actual)
{


	if(!empty($cta_eleanio_actual))
	{
		$this->db->where('cta_eleanio_actual', $cta_eleanio_actual);
		$this->db->select_sum('Enero');
		$query = $this->db->get('depes_elec_anio_actual_grafica_final');
		$result = $query->row()->Enero;
		return $result;
	}

}

function Febreroelecactualyearcta($cta_eleanio_actual)
{


	if(!empty($depes))
	{
		$this->db->where('cta_eleanio_actual', $cta_eleanio_actual);
		$this->db->select_sum('Febrero');
		$query = $this->db->get('depes_elec_anio_actual_grafica_final');
		$result = $query->row()->Febrero;
		return $result;
	}

}

function Marzoelecactualyearcta($cta_eleanio_actual)
{


	if(!empty($cta_eleanio_actual))
	{
		$this->db->where('cta_eleanio_actual', $cta_eleanio_actual);
		$this->db->select_sum('Marzo');
		$query = $this->db->get('depes_elec_anio_actual_grafica_final');
		$result = $query->row()->Marzo;
		return $result;
	}

}

function Abrilelecactualyearcta($cta_eleanio_actual)
{


	if(!empty($cta_eleanio_actual))
	{
		$this->db->where('cta_eleanio_actual', $cta_eleanio_actual);
		$this->db->select_sum('Abril');
		$query = $this->db->get('depes_elec_anio_actual_grafica_final');
		$result = $query->row()->Abril;
		return $result;
	}

}

function Mayoelecactualyearcta($cta_eleanio_actual)
{


	if(!empty($cta_eleanio_actual))
	{
		$this->db->where('cta_eleanio_actual', $cta_eleanio_actual);
		$this->db->select_sum('Mayo');
		$query = $this->db->get('depes_elec_anio_actual_grafica_final');
		$result = $query->row()->Mayo;
		return $result;
	}

}

function Junioelecactualyearcta($cta_eleanio_actual)
{


	if(!empty($cta_eleanio_actual))
	{
		$this->db->where('cta_eleanio_actual', $cta_eleanio_actual);
		$this->db->select_sum('Junio');
		$query = $this->db->get('depes_elec_anio_actual_grafica_final');
		$result = $query->row()->Junio;
		return $result;
	}

}

function Julioelecactualyearcta($cta_eleanio_actual)
{


	if(!empty($cta_eleanio_actual))
	{
		$this->db->where('cta_eleanio_actual', $cta_eleanio_actual);
		$this->db->select_sum('Julio');
		$query = $this->db->get('depes_elec_anio_actual_grafica_final');
		$result = $query->row()->Julio;
		return $result;
	}

}

function Agostoelecactualyearcta($cta_eleanio_actual)
{


	if(!empty($cta_eleanio_actual))
	{
		$this->db->where('cta_eleanio_actual', $cta_eleanio_actual);
		$this->db->select_sum('Agosto');
		$query = $this->db->get('depes_elec_anio_actual_grafica_final');
		$result = $query->row()->Agosto;
		return $result;
	}

}

function Septiembreelecactualyearcta($cta_eleanio_actual)
{


	if(!empty($cta_eleanio_actual))
	{
		$this->db->where('cta_eleanio_actual', $cta_eleanio_actual);
		$this->db->select_sum('Septiembre');
		$query = $this->db->get('depes_elec_anio_actual_grafica_final');
		$result = $query->row()->Septiembre;
		return $result;
	}

}

function Octubreelecactualyearcta($cta_eleanio_actual)
{


	if(!empty($cta_eleanio_actual))
	{
		$this->db->where('cta_eleanio_actual', $cta_eleanio_actual);
		$this->db->select_sum('Octubre');
		$query = $this->db->get('depes_elec_anio_actual_grafica_final');
		$result = $query->row()->Octubre;
		return $result;
	}

}

function Noviembreelecactualyearcta($cta_eleanio_actual)
{


	if(!empty($cta_eleanio_actual))
	{
		$this->db->where('cta_eleanio_actual', $cta_eleanio_actual);
		$this->db->select_sum('Noviembre');
		$query = $this->db->get('depes_elec_anio_actual_grafica_final');
		$result = $query->row()->Noviembre;
		return $result;
	}

}

function Diciembreelecactualyearcta($cta_eleanio_actual)
{


	if(!empty($cta_eleanio_actual))
	{
		$this->db->where('cta_eleanio_actual', $cta_eleanio_actual);
		$this->db->select_sum('Diciembre');
		$query = $this->db->get('depes_elec_anio_actual_grafica_final');
		$result = $query->row()->Diciembre;
		return $result;
	}

}
			//*************************************FIN*************************************//

/***************************************************************************************************************************/
						/*FIN DEL LLAMADO PARA LA COMPARACION DE CONSUMO AÑO ACTUAL Y PASADO - ELECTRICIDAD*/
/***************************************************************************************************************************/
function conteleccomparacionv2($limite=false, $inicio=0)
{

	$dependencia = $this->input->post('dependencia');
	$year = $this->input->post('year');
	$this->console_log($dependencia);
	$this->console_log($year);
	if(empty($dependencia) && !empty($year))
	{
			$this->db->like('periodo_fin', $year);
			$this->db->order_by("periodo_inicio", "asc");
			$query = $this->db->get('pdc_consumo_energia');

			if($query->num_rows()>0)
			{
				foreach($query->result() as $row)
					{
						$dependencias[$row->id] = $row;
					}
				return $dependencias;
			}
				else return false;

	}

	else
	{
		$busqueda	= $this->modelo_factor_gei->serbusgrafconkwh();
		$this->console_log($busqueda);
		if(!empty($busqueda))
		{
			if($limite)
				$this->db->limit($limite, $inicio);

				if(!empty($year))
					$this->db->like('periodo_fin', $year);
					$this->db->order_by("periodo_inicio", "asc");
					$this->db->where('servicio', $busqueda->id);
					$query = $this->db->get('pdc_consumo_energia');

					if($query->num_rows()>0)
					{
						foreach($query->result() as $row)
							{
								$dependencias[$row->id] = $row;
							}
							$this->console_log($dependencias);
						return $dependencias;
					}
					else return false;
		}
		else return false;
	}
}



/***************************************************************************************************************************/
					/*INICIO DE LA COMPARACION DE CONSUMO AÑO ACTUAL Y PASADO - AGUA*/
/***************************************************************************************************************************/

//CREA TABLAS TEMPORALES Y FINAL QUE SERAN DATOS PARA LAS GRÁFICAS//
function creatablascomparacionagua()
{
/*/CREA LA TABLA INICIAL QUE RECOLECTA(HACE JOIN) ENTRE LAS TABLAS CORRESPONDIENTES AL CONSUMO Y COSTO DE LAS DEPENDENCIAS DEL SERVICIO DE aguaTRICIDAD PARA MOSTRAR LA GRAFICA/*/
	$this->db->trans_start();
	$tabla1= "CREATE TABLE IF NOT EXISTS `depes_recibos_agua_1ero_1year_final` (`id` INT NOT NULL AUTO_INCREMENT, `cta_fst` FLOAT(26) NOT NULL, `depes_fst` VARCHAR(55) NOT NULL,
	`periodo_inicio_fst` VARCHAR(15) NOT NULL, `mes_inicio_fst` VARCHAR(15) NOT NULL,
	 `periodo_fin_fst` VARCHAR(15) NOT NULL, `mes_fin_fst` VARCHAR(15) NOT NULL,
	  `consumo_mes_fst` DECIMAL(30,2) NOT NULL, `costo_mes_fst` DECIMAL(30,2) NOT NULL, PRIMARY KEY (`id`),
	UNIQUE `depreene1yrf` (`id`))    ENGINE = InnoDB DEFAULT CHARSET=utf8";
	/*/CREA LA TABLA TEMP1YEAR EN ORDEN CORRESPONDIENTE POR MESES DEPENDIENDO SI ES CONSUMO Y/O COSTO/*/
	$tabla2= "CREATE TABLE IF NOT EXISTS `depes_recibos_energia_temp1year_pasado_y_actual_final`
	(`cta_temp1year_pasado_1` FLOAT(26) NOT NULL, `depes_temp1year_pasado_1` VARCHAR(100),
    `periodo_inicio_temp1year_pasado_1` DATE, `year_inicio_temp1year_pasado_1` YEAR, `mes_inicio_temp1year_p1` VARCHAR(15) NOT NULL,
    `periodo_fin_temp1year_pasado_1` DATE, `year_fin_temp1year_pasado_1` YEAR, `mes_fin_temp1year_p1` VARCHAR(15) NOT NULL,
    `enero_con` DECIMAL(30,2) NOT NULL, `febrero_con` DECIMAL(30,2) NOT NULL, `marzo_con` DECIMAL(30,2) NOT NULL,
    `abril_con` DECIMAL(30,2) NOT NULL, `mayo_con` DECIMAL(30,2) NOT NULL, `junio_con` DECIMAL(30,2) NOT NULL,
	`julio_con` DECIMAL(30,2) NOT NULL, `agosto_con` DECIMAL(30,2) NOT NULL, `septiembre_con` DECIMAL(30,2) NOT NULL,
    `octubre_con` DECIMAL(30,2) NOT NULL, `noviembre_con` DECIMAL(30,2) NOT NULL, `diciembre_con` DECIMAL(30,2) NOT NULL,
    `enero_cos` DECIMAL(30,2) NOT NULL, `febrero_cos` DECIMAL(30,2) NOT NULL, `marzo_cos` DECIMAL(30,2) NOT NULL,
    `abril_cos` DECIMAL(30,2) NOT NULL, `mayo_cos` DECIMAL(30,2) NOT NULL, `junio_cos` DECIMAL(30,2) NOT NULL,
	`julio_cos` DECIMAL(30,2) NOT NULL, `agosto_cos` DECIMAL(30,2) NOT NULL, `septiembre_cos` DECIMAL(30,2) NOT NULL,
    `octubre_cos` DECIMAL(30,2) NOT NULL, `noviembre_cos` DECIMAL(30,2) NOT NULL, `diciembre_cos` DECIMAL(30,2) NOT NULL)   ENGINE = InnoDB DEFAULT CHARSET=utf8";
	/*/CREA LA TABLA TEMPORAL CORRESPONDIENTE AL AÑO ACTUAL, PREVIO A LA TABLA DE LA GRAFICA FINAL/*/
	$tabla3= "CREATE TABLE IF NOT EXISTS `depes_agua_anio_actual_temporal`
	(`cta_temp_anio_actual` VARCHAR(100) NOT NULL, `depe_temp_anio_actual` VARCHAR(100) NOT NULL, `anio_temp_ele` YEAR NOT NULL, `enero` DECIMAL(30,2) NOT NULL, `febrero` DECIMAL(30,2) NOT NULL,
	`marzo` DECIMAL(30,2) NOT NULL, `abril` DECIMAL(30,2) NOT NULL, `mayo` DECIMAL(30,2) NOT NULL, `junio` DECIMAL(30,2) NOT NULL,
	`julio` DECIMAL(30,2) NOT NULL, `agosto` DECIMAL(30,2) NOT NULL, `septiembre` DECIMAL(30,2) NOT NULL,
    `octubre` DECIMAL(30,2) NOT NULL, `noviembre` DECIMAL(30,2) NOT NULL, `diciembre` DECIMAL(30,2) NOT NULL)   ENGINE = InnoDB DEFAULT CHARSET=utf8";
	//CREA LA TABLA FINAL PARA MOSTRAR LA GRAFICA//
	$tabla4= "CREATE TABLE IF NOT EXISTS `depes_agua_anio_actual_grafica_final`
	(`id` INT NOT NULL AUTO_INCREMENT,
	`cta_wtranio_atual` VARCHAR(100), `depe_aguaanio_actual` VARCHAR(100), `anio_actual_agua` YEAR NOT NULL,
	`Enero` INT(30) NOT NULL, `Febrero` INT(30) NOT NULL, `Marzo` INT(30) NOT NULL, `Abril` INT(30) NOT NULL,
			   `Mayo` INT(30) NOT NULL, `Junio` INT(30) NOT NULL, `Julio` INT(30) NOT NULL, `Agosto` INT(30) NOT NULL,
			   `Septiembre` INT(30) NOT NULL, `Octubre` INT(30) NOT NULL, `Noviembre` INT(30) NOT NULL,
			   `Diciembre` INT(30) NOT NULL, UNIQUE `deperepe` (`id`))    ENGINE = InnoDB DEFAULT CHARSET=utf8";

	$this->db->query($tabla1);
	$this->db->query($tabla2);
	$this->db->query($tabla3);
	$this->db->query($tabla4);
	
	/*/HACE JOIN DE LAS TABLAS QUE HACEN REFERENCIA A LOS CONSUMOS Y COSTOS DE LAS DEPENDENCIAS EN EL SERVICIO DE aguaTRICIDAD/*/ 
	$this->db->query(
		"INSERT INTO `depes_recibos_energia_1ero_1year_final` (`cta_fst`, `depes_fst`, `periodo_inicio_fst`, `mes_inicio_fst`, `periodo_fin_fst`,
		`mes_fin_fst`, `consumo_mes_fst`, `costo_mes_fst`)
		SaguaT DISTINCT
		c.cuenta,
		c.dependencia,
		(a.periodo_inicio),
		MONTHNAME(a.periodo_inicio),
		(a.periodo_fin),
		MONTHNAME(a.periodo_fin),
		(a.consumo),
		(a.costo)
		FROM `pdc_consumo_energia` a
		INNER JOIN `ctrl_servicios` b ON a.servicio = b.id 
		INNER JOIN `pdc_servicios_energia` c ON b.account = c.cuenta 
		WHERE c.dependencia IS NOT NULL AND c.dependencia <> ''
		AND a.periodo_fin IS NOT NULL AND a.periodo_fin <> ''
		AND a.consumo IS NOT NULL AND a.consumo <> ''
		AND a.costo IS NOT NULL AND a.costo <> ''
		AND b.account IS NOT NULL AND b.account <> ''
		AND a.servicio IS NOT NULL AND a.servicio <> ''
        AND a.id NOT IN('192')
		AND b.id NOT IN('192')
		AND a.id NOT IN('105')
		AND b.id NOT IN('105')
		AND c.id NOT IN('192')
		AND c.id NOT IN('105')
        AND (YEAR(a.periodo_fin) <= YEAR(NOW() - INTERVAL 0 YEAR) AND YEAR(a.periodo_fin)  >= YEAR(NOW() - INTERVAL 1 YEAR))
		ORDER BY DATE(a.periodo_fin) ASC
		ON DUPLICATE KEY UPDATE cta_fst = VALUES(cta_fst), `depes_fst` = VALUES(depes_fst), `periodo_inicio_fst` = VALUES(periodo_inicio_fst), `mes_inicio_fst` = VALUES(mes_inicio_fst),
		`periodo_fin_fst` = VALUES(periodo_fin_fst), `mes_fin_fst` = VALUES(mes_fin_fst), `consumo_mes_fst` = VALUES(consumo_mes_fst), `costo_mes_fst` = VALUES(costo_mes_fst)");

/*/INSERTA LOS DATOS A LA TABLA TEMP1YEAR EN ORDEN CORRESPONDIENTE AL AÑO PASADO Y ACTUAL POR MESES DEPENDIENDO SI ES CONSUMO Y/O COSTO/*/
	$this->db->query(
		"INSERT INTO `depes_recibos_energia_temp1year_pasado_y_actual_final`
		SaguaT
		CONCAT(`cta_fst`),
		CONCAT(`depes_fst`),
		CONCAT(`periodo_inicio_fst`),
		CONCAT(YEAR(`periodo_inicio_fst`)),
		CONCAT(`mes_inicio_fst`),
		CONCAT(`periodo_fin_fst`),
		CONCAT(YEAR(`periodo_fin_fst`)),
		CONCAT(`mes_fin_fst`),
		CASE WHEN `mes_fin_fst` = 'January' THEN `consumo_mes_fst` END,
		CASE WHEN `mes_fin_fst` = 'February' THEN `consumo_mes_fst` END,
		CASE WHEN `mes_fin_fst` = 'March' THEN `consumo_mes_fst` END,
		CASE WHEN `mes_fin_fst` = 'April' THEN `consumo_mes_fst` END,
		CASE WHEN `mes_fin_fst` = 'May' THEN `consumo_mes_fst` END,
		CASE WHEN `mes_fin_fst` = 'June' THEN `consumo_mes_fst` END,
		CASE WHEN `mes_fin_fst` = 'July' THEN `consumo_mes_fst` END,
		CASE WHEN `mes_fin_fst` = 'August' THEN `consumo_mes_fst` END,
		CASE WHEN `mes_fin_fst` = 'September' THEN `consumo_mes_fst` END,
		CASE WHEN `mes_fin_fst` = 'October' THEN `consumo_mes_fst` END,
		CASE WHEN `mes_fin_fst` = 'November' THEN `consumo_mes_fst` END,
		CASE WHEN `mes_fin_fst` = 'December' THEN `consumo_mes_fst` END,
		CASE WHEN `mes_fin_fst` = 'January' THEN `costo_mes_fst` END,
		CASE WHEN `mes_fin_fst` = 'February' THEN `costo_mes_fst` END,
		CASE WHEN `mes_fin_fst` = 'March' THEN `costo_mes_fst` END,
		CASE WHEN `mes_fin_fst` = 'April' THEN `costo_mes_fst` END,
		CASE WHEN `mes_fin_fst` = 'May' THEN `costo_mes_fst` END,
		CASE WHEN `mes_fin_fst` = 'June' THEN `costo_mes_fst` END,
		CASE WHEN `mes_fin_fst` = 'July' THEN `costo_mes_fst` END,
		CASE WHEN `mes_fin_fst` = 'August' THEN `costo_mes_fst` END,
		CASE WHEN `mes_fin_fst` = 'September' THEN `costo_mes_fst` END,
		CASE WHEN `mes_fin_fst` = 'October' THEN `costo_mes_fst` END,
		CASE WHEN `mes_fin_fst` = 'November' THEN `costo_mes_fst` END,
		CASE WHEN `mes_fin_fst` = 'December' THEN `costo_mes_fst` END
		FROM `depes_recibos_energia_1ero_1year_final
		WHERE TRUE");

/*/INSERTA LOS DATOS A LA TABLA TEMPORAL CORRESPONDIENTE AL AÑO ACTUAL, PREVIO A LA TABLA DE LA GRAFICA FINAL/*/
	$this->db->query(
		"INSERT INTO `depes_agua_anio_actual_temporal`(
			`cta_temp_anio_actual`, `depe_temp_anio_actual`,
			 `anio_temp_ele`, `enero`, `febrero`,
			`marzo`, `abril`, `mayo`, `junio`,
			`julio`, `agosto`, `septiembre`,
			`octubre`, `noviembre`, `diciembre`)
					SaguaT
					`cta_temp1year_pasado_1`,
					`depes_temp1year_pasado_1`,
					`periodo_fin_temp1year_pasado_1`,
					SUM(`enero_con`),
					SUM(`febrero_con`),
					SUM(`marzo_con`),
					SUM(`abril_con`),
					SUM(`mayo_con`),
					SUM(`junio_con`),
					SUM(`julio_con`),
					SUM(`agosto_con`),
					SUM(`septiembre_con`),
					SUM(`octubre_con`),
					SUM(`noviembre_con`),
					SUM(`diciembre_con`)
					FROM `depes_recibos_energia_temp1year_pasado_y_actual_final`
					WHERE YEAR(periodo_fin_temp1year_pasado_1) = YEAR(NOW())
					GROUP BY `depes_temp1year_pasado_1`, YEAR(`periodo_fin_temp1year_pasado_1`) ASC");

/*/INSERTA LOS DATOS A LA TABLA FINAL PARA MOSTRAR LA GRAFICA/*/
	$this->db->query(
		"INSERT INTO `depes_agua_anio_actual_grafica_final`(`cta_wtranio_atual`, `depe_aguaanio_actual`, `anio_actual_agua`,
		`Enero`, `Febrero`, `Marzo`, `Abril`,
				   `Mayo`, `Junio`, `Julio`, `Agosto`,
				   `Septiembre`, `Octubre`, `Noviembre`,
				   `Diciembre`)
   		SaguaT
   		`cta_temp_anio_actual`,
   		`depe_temp_anio_actual`,
   		`anio_temp_ele`,
   		COALESCE(`enero`,0) AS Enero,
   		COALESCE(`febrero`,0) AS Febrero,
   		COALESCE(`marzo`,0) AS Marzo,
   		COALESCE(`abril`,0) AS Abril,
   		COALESCE(`mayo`,0) AS Mayo,
   		COALESCE(`junio`,0) AS Junio,
   		COALESCE(`julio`,0) AS Julio,
   		COALESCE(`agosto`,0) AS Agosto,
   		COALESCE(`septiembre`,0) AS Septiembre,
   		COALESCE(`octubre`,0) AS Octubre,
   		COALESCE(`noviembre`,0) AS Noviembre,
   		COALESCE(`diciembre`,0) AS Diciembre
   		FROM `depes_agua_anio_actual_temporal`
   		GROUP BY `depe_temp_anio_actual` ASC");

$this->db->trans_complete();
}
//*************************************FIN DE LA TRANSACCION*************************************//

//ELIMINA LAS TABLAS PARA GENERAR NUEVOS DATOS//
function droprtablascompaguaactualypasado()
{
	$this->db->query("DROP TABLE  depes_recibos_energia_1ero_1year_final;");
	$this->db->query("DROP TABLE  depes_recibos_energia_temp1year_pasado_y_actual_final;");
	$this->db->query("DROP TABLE  depes_agua_anio_actual_temporal;");
	$this->db->query("DROP TABLE  depes_agua_anio_actual_grafica_final;");
}
//*************************************FIN DEL BORRADO*************************************//

//CARGA EL MENU DROP DOWN PARA LAS DEPENDENCIAS AGUA//
function catdepesxragraficoanioactualagua()
{
	
	$this->db->order_by('depe_aguaanio_actual', 'asc');
	$this->db->group_by('depe_aguaanio_actual');
	$query = $this->db->get('depes_agua_anio_actual_grafica_final');
	if($query->num_rows()>0) {
		foreach($query->result() as $row) {
			$depe_aguaanio_actual[$row->id] = $row;
			
		}
		return $depe_aguaanio_actual;

	}
}
//*************************************FIN*************************************//

//MANDA RESULTADOS SI SE SELECCIONA LA DEPENDENCIA PARA GENERAR LA GRÁFICA EN AGUA//
function graficaaguadepeyear()
{
	$depe_aguaanio_actual = $this->input->post("depe_aguaanio_actual");
	if(!empty($depe_aguaanio_actual))
	{
		$this->db->where('depe_aguaanio_actual', $depe_aguaanio_actual);
		$this->db->order_by('id', 'asc');
		$query = $this->db->get('depes_agua_anio_actual_grafica_final_final');
				
			if ($query->num_rows()>0)
			{
				foreach($query->result() as $row)
				{
					$cta_wtranio_atual[$row->id] = $row;
				}
				return $cta_wtranio_atual;
			}
}

}


function sercatgrafdepeselec($limite=false, $inicio=0)
{
	$this->db->order_by('dependencia', 'asc');
	if($limite)
		$this->db->limit($limite, $inicio);
	$query = $this->db->get('pdc_servicios_energia');

		if($query->num_rows()>0)
		{
			foreach($query->result() as $row)
				{
					$servicios[$row->id] = $row;
				}
			return $servicios;
		}
		else return false;
}
//*************************************FIN*************************************//

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//LLAMADO DE LOS MESES PARA LA GRAFICA AÑO ACTUAL DE CONSUMO EN AGUA//

function Eneroaguaactualyear($depe_aguaanio_actual)
{


	if(!empty($depe_aguaanio_actual))
	{
		$this->db->where('depe_aguaanio_actual', $depe_aguaanio_actual);
		$this->db->select_sum('Enero');
		$query = $this->db->get('depes_agua_anio_actual_grafica_final');
		$result = $query->row()->Enero;
		return $result;
	}

}

function Febreroaguaactualyear($depe_aguaanio_actual)
{


	if(!empty($depes))
	{
		$this->db->where('depe_aguaanio_actual', $depe_aguaanio_actual);
		$this->db->select_sum('Febrero');
		$query = $this->db->get('depes_agua_anio_actual_grafica_final');
		$result = $query->row()->Febrero;
		return $result;
	}

}

function Marzoaguaactualyear($depe_aguaanio_actual)
{


	if(!empty($depe_aguaanio_actual))
	{
		$this->db->where('depe_aguaanio_actual', $depe_aguaanio_actual);
		$this->db->select_sum('Marzo');
		$query = $this->db->get('depes_agua_anio_actual_grafica_final');
		$result = $query->row()->Marzo;
		return $result;
	}

}

function Abrilaguaactualyear($depe_aguaanio_actual)
{


	if(!empty($depe_aguaanio_actual))
	{
		$this->db->where('depe_aguaanio_actual', $depe_aguaanio_actual);
		$this->db->select_sum('Abril');
		$query = $this->db->get('depes_agua_anio_actual_grafica_final');
		$result = $query->row()->Abril;
		return $result;
	}

}

function Mayoaguaactualyear($depe_aguaanio_actual)
{


	if(!empty($depe_aguaanio_actual))
	{
		$this->db->where('depe_aguaanio_actual', $depe_aguaanio_actual);
		$this->db->select_sum('Mayo');
		$query = $this->db->get('depes_agua_anio_actual_grafica_final');
		$result = $query->row()->Mayo;
		return $result;
	}

}

function Junioaguaactualyear($depe_aguaanio_actual)
{


	if(!empty($depe_aguaanio_actual))
	{
		$this->db->where('depe_aguaanio_actual', $depe_aguaanio_actual);
		$this->db->select_sum('Junio');
		$query = $this->db->get('depes_agua_anio_actual_grafica_final');
		$result = $query->row()->Junio;
		return $result;
	}

}

function Julioaguaactualyear($depe_aguaanio_actual)
{


	if(!empty($depe_aguaanio_actual))
	{
		$this->db->where('depe_aguaanio_actual', $depe_aguaanio_actual);
		$this->db->select_sum('Julio');
		$query = $this->db->get('depes_agua_anio_actual_grafica_final');
		$result = $query->row()->Julio;
		return $result;
	}

}

function Agostoaguaactualyear($depe_aguaanio_actual)
{


	if(!empty($depe_aguaanio_actual))
	{
		$this->db->where('depe_aguaanio_actual', $depe_aguaanio_actual);
		$this->db->select_sum('Agosto');
		$query = $this->db->get('depes_agua_anio_actual_grafica_final');
		$result = $query->row()->Agosto;
		return $result;
	}

}

function Septiembreaguaactualyear($depe_aguaanio_actual)
{


	if(!empty($depe_aguaanio_actual))
	{
		$this->db->where('depe_aguaanio_actual', $depe_aguaanio_actual);
		$this->db->select_sum('Septiembre');
		$query = $this->db->get('depes_agua_anio_actual_grafica_final');
		$result = $query->row()->Septiembre;
		return $result;
	}

}

function Octubreaguaactualyear($depe_aguaanio_actual)
{


	if(!empty($depe_aguaanio_actual))
	{
		$this->db->where('depe_aguaanio_actual', $depe_aguaanio_actual);
		$this->db->select_sum('Octubre');
		$query = $this->db->get('depes_agua_anio_actual_grafica_final');
		$result = $query->row()->Octubre;
		return $result;
	}

}

function Noviembreaguaactualyear($depe_aguaanio_actual)
{


	if(!empty($depe_aguaanio_actual))
	{
		$this->db->where('depe_aguaanio_actual', $depe_aguaanio_actual);
		$this->db->select_sum('Noviembre');
		$query = $this->db->get('depes_agua_anio_actual_grafica_final');
		$result = $query->row()->Noviembre;
		return $result;
	}

}

function Diciembreaguaactualyear($depe_aguaanio_actual)
{


	if(!empty($depe_aguaanio_actual))
	{
		$this->db->where('depe_aguaanio_actual', $depe_aguaanio_actual);
		$this->db->select_sum('Diciembre');
		$query = $this->db->get('depes_agua_anio_actual_grafica_final');
		$result = $query->row()->Diciembre;
		return $result;
	}

}
			//*************************************FIN*************************************//
			
/***************************************************************************************************************************/
						/*FIN DEL LLAMADO PARA LA COMPARACION DE CONSUMO AÑO ACTUAL Y PASADO - AGUA*/
/***************************************************************************************************************************/
/***************************************************************************************************************************/
					/*INICIO DE LA COMPARACION DE CONSUMO AÑO ACTUAL Y PASADO - GAS*/
/***************************************************************************************************************************/

//CREA TABLAS TEMPORALES Y FINAL QUE SERAN DATOS PARA LAS GRÁFICAS//
function creatablascomparaciongas()
{
/*/CREA LA TABLA INICIAL QUE RECOLECTA(HACE JOIN) ENTRE LAS TABLAS CORRESPONDIENTES AL CONSUMO Y COSTO DE LAS DEPENDENCIAS DEL SERVICIO DE gasTRICIDAD PARA MOSTRAR LA GRAFICA/*/
	$this->db->trans_start();
	$tabla1= "CREATE TABLE IF NOT EXISTS `depes_recibos_gas_1ero_1year_final` (`id` INT NOT NULL AUTO_INCREMENT, `cta_fst` FLOAT(26) NOT NULL, `depes_fst` VARCHAR(55) NOT NULL,
	`periodo_inicio_fst` VARCHAR(15) NOT NULL, `mes_inicio_fst` VARCHAR(15) NOT NULL,
	 `periodo_fin_fst` VARCHAR(15) NOT NULL, `mes_fin_fst` VARCHAR(15) NOT NULL,
	  `consumo_mes_fst` DECIMAL(30,2) NOT NULL, `costo_mes_fst` DECIMAL(30,2) NOT NULL, PRIMARY KEY (`id`),
	UNIQUE `depreene1yrf` (`id`))    ENGINE = InnoDB DEFAULT CHARSET=utf8";
	/*/CREA LA TABLA TEMP1YEAR EN ORDEN CORRESPONDIENTE POR MESES DEPENDIENDO SI ES CONSUMO Y/O COSTO/*/
	$tabla2= "CREATE TABLE IF NOT EXISTS `depes_recibos_gas_temp1year_pasado_y_actual_final`
	(`cta_temp1year_pasado_1` FLOAT(26) NOT NULL, `depes_temp1year_pasado_1` VARCHAR(100),
    `periodo_inicio_temp1year_pasado_1` DATE, `year_inicio_temp1year_pasado_1` YEAR, `mes_inicio_temp1year_p1` VARCHAR(15) NOT NULL,
    `periodo_fin_temp1year_pasado_1` DATE, `year_fin_temp1year_pasado_1` YEAR, `mes_fin_temp1year_p1` VARCHAR(15) NOT NULL,
    `enero_con` DECIMAL(30,2) NOT NULL, `febrero_con` DECIMAL(30,2) NOT NULL, `marzo_con` DECIMAL(30,2) NOT NULL,
    `abril_con` DECIMAL(30,2) NOT NULL, `mayo_con` DECIMAL(30,2) NOT NULL, `junio_con` DECIMAL(30,2) NOT NULL,
	`julio_con` DECIMAL(30,2) NOT NULL, `agosto_con` DECIMAL(30,2) NOT NULL, `septiembre_con` DECIMAL(30,2) NOT NULL,
    `octubre_con` DECIMAL(30,2) NOT NULL, `noviembre_con` DECIMAL(30,2) NOT NULL, `diciembre_con` DECIMAL(30,2) NOT NULL,
    `enero_cos` DECIMAL(30,2) NOT NULL, `febrero_cos` DECIMAL(30,2) NOT NULL, `marzo_cos` DECIMAL(30,2) NOT NULL,
    `abril_cos` DECIMAL(30,2) NOT NULL, `mayo_cos` DECIMAL(30,2) NOT NULL, `junio_cos` DECIMAL(30,2) NOT NULL,
	`julio_cos` DECIMAL(30,2) NOT NULL, `agosto_cos` DECIMAL(30,2) NOT NULL, `septiembre_cos` DECIMAL(30,2) NOT NULL,
    `octubre_cos` DECIMAL(30,2) NOT NULL, `noviembre_cos` DECIMAL(30,2) NOT NULL, `diciembre_cos` DECIMAL(30,2) NOT NULL)   ENGINE = InnoDB DEFAULT CHARSET=utf8";
	/*/CREA LA TABLA TEMPORAL CORRESPONDIENTE AL AÑO ACTUAL, PREVIO A LA TABLA DE LA GRAFICA FINAL/*/
	$tabla3= "CREATE TABLE IF NOT EXISTS `depes_gas_anio_actual_temporal`
	(`cta_temp_anio_actual` VARCHAR(100) NOT NULL, `depe_temp_anio_actual` VARCHAR(100) NOT NULL, `anio_temp_ele` YEAR NOT NULL, `enero` DECIMAL(30,2) NOT NULL, `febrero` DECIMAL(30,2) NOT NULL,
	`marzo` DECIMAL(30,2) NOT NULL, `abril` DECIMAL(30,2) NOT NULL, `mayo` DECIMAL(30,2) NOT NULL, `junio` DECIMAL(30,2) NOT NULL,
	`julio` DECIMAL(30,2) NOT NULL, `agosto` DECIMAL(30,2) NOT NULL, `septiembre` DECIMAL(30,2) NOT NULL,
    `octubre` DECIMAL(30,2) NOT NULL, `noviembre` DECIMAL(30,2) NOT NULL, `diciembre` DECIMAL(30,2) NOT NULL)   ENGINE = InnoDB DEFAULT CHARSET=utf8";
	//CREA LA TABLA FINAL PARA MOSTRAR LA GRAFICA//
	$tabla4= "CREATE TABLE IF NOT EXISTS `depes_gas_anio_actual_grafica_final`
	(`id` INT NOT NULL AUTO_INCREMENT,
	`cta_wtranio_atual` VARCHAR(100), `depe_gasanio_actual` VARCHAR(100), `anio_actual_gas` YEAR NOT NULL,
	`Enero` INT(30) NOT NULL, `Febrero` INT(30) NOT NULL, `Marzo` INT(30) NOT NULL, `Abril` INT(30) NOT NULL,
			   `Mayo` INT(30) NOT NULL, `Junio` INT(30) NOT NULL, `Julio` INT(30) NOT NULL, `Agosto` INT(30) NOT NULL,
			   `Septiembre` INT(30) NOT NULL, `Octubre` INT(30) NOT NULL, `Noviembre` INT(30) NOT NULL,
			   `Diciembre` INT(30) NOT NULL, UNIQUE `deperepe` (`id`))    ENGINE = InnoDB DEFAULT CHARSET=utf8";

	$this->db->query($tabla1);
	$this->db->query($tabla2);
	$this->db->query($tabla3);
	$this->db->query($tabla4);
	
	/*/HACE JOIN DE LAS TABLAS QUE HACEN REFERENCIA A LOS CONSUMOS Y COSTOS DE LAS DEPENDENCIAS EN EL SERVICIO DE gasTRICIDAD/*/ 
	$this->db->query(
		"INSERT INTO `depes_recibos_gas_1ero_1year_final` (`cta_fst`, `depes_fst`, `periodo_inicio_fst`, `mes_inicio_fst`, `periodo_fin_fst`,
		`mes_fin_fst`, `consumo_mes_fst`, `costo_mes_fst`)
		SgasT DISTINCT
		c.cuenta,
		c.dependencia,
		(a.periodo_inicio),
		MONTHNAME(a.periodo_inicio),
		(a.periodo_fin),
		MONTHNAME(a.periodo_fin),
		(a.consumo),
		(a.costo)
		FROM `pdc_consumo_gas` a
		INNER JOIN `ctrl_servicios` b ON a.servicio = b.id 
		INNER JOIN `pdc_servicios_gas` c ON b.account = c.cuenta 
		WHERE c.dependencia IS NOT NULL AND c.dependencia <> ''
		AND a.periodo_fin IS NOT NULL AND a.periodo_fin <> ''
		AND a.consumo IS NOT NULL AND a.consumo <> ''
		AND a.costo IS NOT NULL AND a.costo <> ''
		AND b.account IS NOT NULL AND b.account <> ''
		AND a.servicio IS NOT NULL AND a.servicio <> ''
        AND a.id NOT IN('192')
		AND b.id NOT IN('192')
		AND a.id NOT IN('105')
		AND b.id NOT IN('105')
		AND c.id NOT IN('192')
		AND c.id NOT IN('105')
        AND (YEAR(a.periodo_fin) <= YEAR(NOW() - INTERVAL 0 YEAR) AND YEAR(a.periodo_fin)  >= YEAR(NOW() - INTERVAL 1 YEAR))
		ORDER BY DATE(a.periodo_fin) ASC
		ON DUPLICATE KEY UPDATE cta_fst = VALUES(cta_fst), `depes_fst` = VALUES(depes_fst), `periodo_inicio_fst` = VALUES(periodo_inicio_fst), `mes_inicio_fst` = VALUES(mes_inicio_fst),
		`periodo_fin_fst` = VALUES(periodo_fin_fst), `mes_fin_fst` = VALUES(mes_fin_fst), `consumo_mes_fst` = VALUES(consumo_mes_fst), `costo_mes_fst` = VALUES(costo_mes_fst)");

/*/INSERTA LOS DATOS A LA TABLA TEMP1YEAR EN ORDEN CORRESPONDIENTE AL AÑO PASADO Y ACTUAL POR MESES DEPENDIENDO SI ES CONSUMO Y/O COSTO/*/
	$this->db->query(
		"INSERT INTO `depes_recibos_gas_temp1year_pasado_y_actual_final`
		SgasT
		CONCAT(`cta_fst`),
		CONCAT(`depes_fst`),
		CONCAT(`periodo_inicio_fst`),
		CONCAT(YEAR(`periodo_inicio_fst`)),
		CONCAT(`mes_inicio_fst`),
		CONCAT(`periodo_fin_fst`),
		CONCAT(YEAR(`periodo_fin_fst`)),
		CONCAT(`mes_fin_fst`),
		CASE WHEN `mes_fin_fst` = 'January' THEN `consumo_mes_fst` END,
		CASE WHEN `mes_fin_fst` = 'February' THEN `consumo_mes_fst` END,
		CASE WHEN `mes_fin_fst` = 'March' THEN `consumo_mes_fst` END,
		CASE WHEN `mes_fin_fst` = 'April' THEN `consumo_mes_fst` END,
		CASE WHEN `mes_fin_fst` = 'May' THEN `consumo_mes_fst` END,
		CASE WHEN `mes_fin_fst` = 'June' THEN `consumo_mes_fst` END,
		CASE WHEN `mes_fin_fst` = 'July' THEN `consumo_mes_fst` END,
		CASE WHEN `mes_fin_fst` = 'August' THEN `consumo_mes_fst` END,
		CASE WHEN `mes_fin_fst` = 'September' THEN `consumo_mes_fst` END,
		CASE WHEN `mes_fin_fst` = 'October' THEN `consumo_mes_fst` END,
		CASE WHEN `mes_fin_fst` = 'November' THEN `consumo_mes_fst` END,
		CASE WHEN `mes_fin_fst` = 'December' THEN `consumo_mes_fst` END,
		CASE WHEN `mes_fin_fst` = 'January' THEN `costo_mes_fst` END,
		CASE WHEN `mes_fin_fst` = 'February' THEN `costo_mes_fst` END,
		CASE WHEN `mes_fin_fst` = 'March' THEN `costo_mes_fst` END,
		CASE WHEN `mes_fin_fst` = 'April' THEN `costo_mes_fst` END,
		CASE WHEN `mes_fin_fst` = 'May' THEN `costo_mes_fst` END,
		CASE WHEN `mes_fin_fst` = 'June' THEN `costo_mes_fst` END,
		CASE WHEN `mes_fin_fst` = 'July' THEN `costo_mes_fst` END,
		CASE WHEN `mes_fin_fst` = 'August' THEN `costo_mes_fst` END,
		CASE WHEN `mes_fin_fst` = 'September' THEN `costo_mes_fst` END,
		CASE WHEN `mes_fin_fst` = 'October' THEN `costo_mes_fst` END,
		CASE WHEN `mes_fin_fst` = 'November' THEN `costo_mes_fst` END,
		CASE WHEN `mes_fin_fst` = 'December' THEN `costo_mes_fst` END
		FROM `depes_recibos_gas_1ero_1year_final
		WHERE TRUE");

/*/INSERTA LOS DATOS A LA TABLA TEMPORAL CORRESPONDIENTE AL AÑO ACTUAL, PREVIO A LA TABLA DE LA GRAFICA FINAL/*/
	$this->db->query(
		"INSERT INTO `depes_gas_anio_actual_temporal`(
			`cta_temp_anio_actual`, `depe_temp_anio_actual`,
			 `anio_temp_ele`, `enero`, `febrero`,
			`marzo`, `abril`, `mayo`, `junio`,
			`julio`, `agosto`, `septiembre`,
			`octubre`, `noviembre`, `diciembre`)
					SgasT
					`cta_temp1year_pasado_1`,
					`depes_temp1year_pasado_1`,
					`periodo_fin_temp1year_pasado_1`,
					SUM(`enero_con`),
					SUM(`febrero_con`),
					SUM(`marzo_con`),
					SUM(`abril_con`),
					SUM(`mayo_con`),
					SUM(`junio_con`),
					SUM(`julio_con`),
					SUM(`agosto_con`),
					SUM(`septiembre_con`),
					SUM(`octubre_con`),
					SUM(`noviembre_con`),
					SUM(`diciembre_con`)
					FROM `depes_recibos_gas_temp1year_pasado_y_actual_final`
					WHERE YEAR(periodo_fin_temp1year_pasado_1) = YEAR(NOW())
					GROUP BY `depes_temp1year_pasado_1`, YEAR(`periodo_fin_temp1year_pasado_1`) ASC");

/*/INSERTA LOS DATOS A LA TABLA FINAL PARA MOSTRAR LA GRAFICA/*/
	$this->db->query(
		"INSERT INTO `depes_gas_anio_actual_grafica_final`(`cta_wtranio_atual`, `depe_gasanio_actual`, `anio_actual_gas`,
		`Enero`, `Febrero`, `Marzo`, `Abril`,
				   `Mayo`, `Junio`, `Julio`, `Agosto`,
				   `Septiembre`, `Octubre`, `Noviembre`,
				   `Diciembre`)
   		SgasT
   		`cta_temp_anio_actual`,
   		`depe_temp_anio_actual`,
   		`anio_temp_ele`,
   		COALESCE(`enero`,0) AS Enero,
   		COALESCE(`febrero`,0) AS Febrero,
   		COALESCE(`marzo`,0) AS Marzo,
   		COALESCE(`abril`,0) AS Abril,
   		COALESCE(`mayo`,0) AS Mayo,
   		COALESCE(`junio`,0) AS Junio,
   		COALESCE(`julio`,0) AS Julio,
   		COALESCE(`agosto`,0) AS Agosto,
   		COALESCE(`septiembre`,0) AS Septiembre,
   		COALESCE(`octubre`,0) AS Octubre,
   		COALESCE(`noviembre`,0) AS Noviembre,
   		COALESCE(`diciembre`,0) AS Diciembre
   		FROM `depes_gas_anio_actual_temporal`
   		GROUP BY `depe_temp_anio_actual` ASC");

$this->db->trans_complete();
}
//*************************************FIN DE LA TRANSACCION*************************************//

//ELIMINA LAS TABLAS PARA GENERAR NUEVOS DATOS//
function droprtablascompgasactualypasado()
{
	$this->db->query("DROP TABLE  depes_recibos_gas_1ero_1year_final;");
	$this->db->query("DROP TABLE  depes_recibos_gas_temp1year_pasado_y_actual_final;");
	$this->db->query("DROP TABLE  depes_gas_anio_actual_temporal;");
	$this->db->query("DROP TABLE  depes_gas_anio_actual_grafica_final;");
}
//*************************************FIN DEL BORRADO*************************************//

//CARGA EL MENU DROP DOWN PARA LAS DEPENDENCIAS GAS//

function catdepesxragraficoanioactualgas()
{
	
	$this->db->order_by('depe_gasanio_actual', 'asc');
	$this->db->group_by('depe_gasanio_actual');
	$query = $this->db->get('depes_gas_anio_actual_grafica_final');
	if($query->num_rows()>0) {
		foreach($query->result() as $row) {
			$depe_gasanio_actual[$row->id] = $row;
			
		}
		return $depe_gasanio_actual;

	}
}
//*************************************FIN*************************************//

//MANDA RESULTADOS SI SE SELECCIONA LA DEPENDENCIA PARA GENERAR LA GRÁFICA EN gas//
function graficagasdepeyear()
{
	$depe_gasanio_actual = $this->input->post("depe_gasanio_actual");
	if(!empty($depe_gasanio_actual))
	{
		$this->db->where('depe_gasanio_actual', $depe_gasanio_actual);
		$this->db->order_by('id', 'asc');
		$query = $this->db->get('depes_gas_anio_actual_grafica_final_final');
				
			if ($query->num_rows()>0)
			{
				foreach($query->result() as $row)
				{
					$cta_wtranio_atual[$row->id] = $row;
				}
				return $cta_wtranio_atual;
			}
}

}
//*************************************FIN*************************************//

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//LLAMADO DE LOS MESES PARA LA GRAFICA AÑO ACTUAL DE CONSUMO EN GAS//
function Enerogasactualyear($depe_gasanio_actual)
{


	if(!empty($depe_gasanio_actual))
	{
		$this->db->where('depe_gasanio_actual', $depe_gasanio_actual);
		$this->db->select_sum('Enero');
		$query = $this->db->get('depes_gas_anio_actual_grafica_final');
		$result = $query->row()->Enero;
		return $result;
	}

}

function Febrerogasactualyear($depe_gasanio_actual)
{


	if(!empty($depes))
	{
		$this->db->where('depe_gasanio_actual', $depe_gasanio_actual);
		$this->db->select_sum('Febrero');
		$query = $this->db->get('depes_gas_anio_actual_grafica_final');
		$result = $query->row()->Febrero;
		return $result;
	}

}

function Marzogasactualyear($depe_gasanio_actual)
{


	if(!empty($depe_gasanio_actual))
	{
		$this->db->where('depe_gasanio_actual', $depe_gasanio_actual);
		$this->db->select_sum('Marzo');
		$query = $this->db->get('depes_gas_anio_actual_grafica_final');
		$result = $query->row()->Marzo;
		return $result;
	}

}

function Abrilgasactualyear($depe_gasanio_actual)
{


	if(!empty($depe_gasanio_actual))
	{
		$this->db->where('depe_gasanio_actual', $depe_gasanio_actual);
		$this->db->select_sum('Abril');
		$query = $this->db->get('depes_gas_anio_actual_grafica_final');
		$result = $query->row()->Abril;
		return $result;
	}

}

function Mayogasactualyear($depe_gasanio_actual)
{


	if(!empty($depe_gasanio_actual))
	{
		$this->db->where('depe_gasanio_actual', $depe_gasanio_actual);
		$this->db->select_sum('Mayo');
		$query = $this->db->get('depes_gas_anio_actual_grafica_final');
		$result = $query->row()->Mayo;
		return $result;
	}

}

function Juniogasactualyear($depe_gasanio_actual)
{


	if(!empty($depe_gasanio_actual))
	{
		$this->db->where('depe_gasanio_actual', $depe_gasanio_actual);
		$this->db->select_sum('Junio');
		$query = $this->db->get('depes_gas_anio_actual_grafica_final');
		$result = $query->row()->Junio;
		return $result;
	}

}

function Juliogasactualyear($depe_gasanio_actual)
{


	if(!empty($depe_gasanio_actual))
	{
		$this->db->where('depe_gasanio_actual', $depe_gasanio_actual);
		$this->db->select_sum('Julio');
		$query = $this->db->get('depes_gas_anio_actual_grafica_final');
		$result = $query->row()->Julio;
		return $result;
	}

}

function Agostogasactualyear($depe_gasanio_actual)
{


	if(!empty($depe_gasanio_actual))
	{
		$this->db->where('depe_gasanio_actual', $depe_gasanio_actual);
		$this->db->select_sum('Agosto');
		$query = $this->db->get('depes_gas_anio_actual_grafica_final');
		$result = $query->row()->Agosto;
		return $result;
	}

}

function Septiembregasactualyear($depe_gasanio_actual)
{


	if(!empty($depe_gasanio_actual))
	{
		$this->db->where('depe_gasanio_actual', $depe_gasanio_actual);
		$this->db->select_sum('Septiembre');
		$query = $this->db->get('depes_gas_anio_actual_grafica_final');
		$result = $query->row()->Septiembre;
		return $result;
	}

}

function Octubregasactualyear($depe_gasanio_actual)
{


	if(!empty($depe_gasanio_actual))
	{
		$this->db->where('depe_gasanio_actual', $depe_gasanio_actual);
		$this->db->select_sum('Octubre');
		$query = $this->db->get('depes_gas_anio_actual_grafica_final');
		$result = $query->row()->Octubre;
		return $result;
	}

}

function Noviembregasactualyear($depe_gasanio_actual)
{


	if(!empty($depe_gasanio_actual))
	{
		$this->db->where('depe_gasanio_actual', $depe_gasanio_actual);
		$this->db->select_sum('Noviembre');
		$query = $this->db->get('depes_gas_anio_actual_grafica_final');
		$result = $query->row()->Noviembre;
		return $result;
	}

}

function Diciembregasactualyear($depe_gasanio_actual)
{


	if(!empty($depe_gasanio_actual))
	{
		$this->db->where('depe_gasanio_actual', $depe_gasanio_actual);
		$this->db->select_sum('Diciembre');
		$query = $this->db->get('depes_gas_anio_actual_grafica_final');
		$result = $query->row()->Diciembre;
		return $result;
	}

}
			//*************************************FIN*************************************//

/***************************************************************************************************************************/
						/*FIN DEL LLAMADO PARA LA COMPARACION DE CONSUMO AÑO ACTUAL Y PASADO - GAS*/
/***************************************************************************************************************************/
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////





/***************************************************************************************************************************/
					/*INICIO DE LA COMPARACION DE CONSUMO AÑO ACTUAL Y PASADO - ELECTRICIDAD*/
/***************************************************************************************************************************/

//CREA TABLAS TEMPORALES Y FINAL QUE SERAN DATOS PARA LAS GRÁFICAS//
function creatablascomparacionelecv2()
{
/*/CREA LA TABLA INICIAL QUE RECOLECTA(HACE JOIN) ENTRE LAS TABLAS CORRESPONDIENTES AL CONSUMO Y COSTO DE LAS DEPENDENCIAS DEL SERVICIO DE ELECTRICIDAD PARA MOSTRAR LA GRAFICA/*/
	$this->db->trans_start();
	$tabla1= "CREATE TABLE IF NOT EXISTS `depes_recibos_energia_1ero_1year_final` (`id` INT NOT NULL AUTO_INCREMENT, `cta_fst` FLOAT(26) NOT NULL, `depes_fst` VARCHAR(55) NOT NULL,
	`periodo_inicio_fst` VARCHAR(15) NOT NULL, `mes_inicio_fst` VARCHAR(15) NOT NULL,
	 `periodo_fin_fst` VARCHAR(15) NOT NULL, `mes_fin_fst` VARCHAR(15) NOT NULL,
	  `consumo_mes_fst` DECIMAL(30,2) NOT NULL, `costo_mes_fst` DECIMAL(30,2) NOT NULL, PRIMARY KEY (`id`),
	UNIQUE `depreene1yrf` (`id`))    ENGINE = InnoDB DEFAULT CHARSET=utf8";
	/*/CREA LA TABLA TEMP1YEAR EN ORDEN CORRESPONDIENTE POR MESES DEPENDIENDO SI ES CONSUMO Y/O COSTO/*/
	$tabla2= "CREATE TABLE IF NOT EXISTS `depes_recibos_energia_temp1year_pasado_y_actual_final`
	(`cta_temp1year_pasado_1` FLOAT(26) NOT NULL, `depes_temp1year_pasado_1` VARCHAR(100),
    `periodo_inicio_temp1year_pasado_1` DATE, `year_inicio_temp1year_pasado_1` YEAR, `mes_inicio_temp1year_p1` VARCHAR(15) NOT NULL,
    `periodo_fin_temp1year_pasado_1` DATE, `year_fin_temp1year_pasado_1` YEAR, `mes_fin_temp1year_p1` VARCHAR(15) NOT NULL,
    `enero_con` DECIMAL(30,2) NOT NULL, `febrero_con` DECIMAL(30,2) NOT NULL, `marzo_con` DECIMAL(30,2) NOT NULL,
    `abril_con` DECIMAL(30,2) NOT NULL, `mayo_con` DECIMAL(30,2) NOT NULL, `junio_con` DECIMAL(30,2) NOT NULL,
	`julio_con` DECIMAL(30,2) NOT NULL, `agosto_con` DECIMAL(30,2) NOT NULL, `septiembre_con` DECIMAL(30,2) NOT NULL,
    `octubre_con` DECIMAL(30,2) NOT NULL, `noviembre_con` DECIMAL(30,2) NOT NULL, `diciembre_con` DECIMAL(30,2) NOT NULL,
    `enero_cos` DECIMAL(30,2) NOT NULL, `febrero_cos` DECIMAL(30,2) NOT NULL, `marzo_cos` DECIMAL(30,2) NOT NULL,
    `abril_cos` DECIMAL(30,2) NOT NULL, `mayo_cos` DECIMAL(30,2) NOT NULL, `junio_cos` DECIMAL(30,2) NOT NULL,
	`julio_cos` DECIMAL(30,2) NOT NULL, `agosto_cos` DECIMAL(30,2) NOT NULL, `septiembre_cos` DECIMAL(30,2) NOT NULL,
    `octubre_cos` DECIMAL(30,2) NOT NULL, `noviembre_cos` DECIMAL(30,2) NOT NULL, `diciembre_cos` DECIMAL(30,2) NOT NULL)   ENGINE = InnoDB DEFAULT CHARSET=utf8";
	/*/CREA LA TABLA TEMPORAL CORRESPONDIENTE AL AÑO ACTUAL, PREVIO A LA TABLA DE LA GRAFICA FINAL/*/
	$tabla3= "CREATE TABLE IF NOT EXISTS `depes_elec_anio_actual_temporal`
	(`cta_temp_anio_actual` VARCHAR(100) NOT NULL, `depe_temp_anio_actual` VARCHAR(100) NOT NULL, `anio_temp_ele` YEAR NOT NULL, `enero` DECIMAL(30,2) NOT NULL, `febrero` DECIMAL(30,2) NOT NULL,
	`marzo` DECIMAL(30,2) NOT NULL, `abril` DECIMAL(30,2) NOT NULL, `mayo` DECIMAL(30,2) NOT NULL, `junio` DECIMAL(30,2) NOT NULL,
	`julio` DECIMAL(30,2) NOT NULL, `agosto` DECIMAL(30,2) NOT NULL, `septiembre` DECIMAL(30,2) NOT NULL,
    `octubre` DECIMAL(30,2) NOT NULL, `noviembre` DECIMAL(30,2) NOT NULL, `diciembre` DECIMAL(30,2) NOT NULL)   ENGINE = InnoDB DEFAULT CHARSET=utf8";
	//CREA LA TABLA PARA LA MOSTRAR LA//
	$tabla4= "CREATE TABLE IF NOT EXISTS `depes_elec_anio_actual_grafica_final`
	(`id` INT NOT NULL AUTO_INCREMENT,
	`cta_eleanio_atual` VARCHAR(100), `depe_eleanio_actual` VARCHAR(100), `anio_actual_elec` YEAR NOT NULL,
	`Enero` INT(30) NOT NULL, `Febrero` INT(30) NOT NULL, `Marzo` INT(30) NOT NULL, `Abril` INT(30) NOT NULL,
			   `Mayo` INT(30) NOT NULL, `Junio` INT(30) NOT NULL, `Julio` INT(30) NOT NULL, `Agosto` INT(30) NOT NULL,
			   `Septiembre` INT(30) NOT NULL, `Octubre` INT(30) NOT NULL, `Noviembre` INT(30) NOT NULL,
			   `Diciembre` INT(30) NOT NULL, UNIQUE `deperepe` (`id`))    ENGINE = InnoDB DEFAULT CHARSET=utf8";

	//CREA LA TABLA FINAL PARA LAS COMPARACIONES//
	$tabla5= "CREATE TABLE IF NOT EXISTS `tbl_final_consumo_year_pasado_y_comparaciones` (`id` INT NOT NULL AUTO_INCREMENT,
	`cta_final_cypyp` VARCHAR(55) NOT NULL, `depe_final_cypyp` VARCHAR(55) NOT NULL,
	`anio_final_cypyp` VARCHAR(15) NOT NULL, `Enero`  DECIMAL(45,2) NOT NULL,  `Febrero`  DECIMAL(45,2) NOT NULL,
	`Marzo`  DECIMAL(45,2) NOT NULL,  `Abril`  DECIMAL(45,2) NOT NULL,  `Mayo`  DECIMAL(45,2) NOT NULL,
	`Junio`  DECIMAL(45,2) NOT NULL,  `Julio`  DECIMAL(45,2) NOT NULL,  `Agosto`  DECIMAL(45,2) NOT NULL,
	`Septiembre`  DECIMAL(45,2) NOT NULL,  `Octubre`  DECIMAL(45,2) NOT NULL,  `Noviembre`  DECIMAL(45,2) NOT NULL,
	`Diciembre`  DECIMAL(45,2) NOT NULL, `consumo_mes_anterior`  DECIMAL(45,2) NOT NULL,
	`consumo_mismo_mes_year_anterior` DECIMAL(45,2) NOT NULL, PRIMARY KEY (`id`),
	UNIQUE `depreene1yrf` (`id`))    ENGINE = InnoDB DEFAULT CHARSET=utf8";

	//CREA LA TABLA PARA MOSTRAR EL PREVIO A LA TABLA DE LAS DEPENDENCIAS PASADAS//
	$tabla6= "CREATE TABLE IF NOT EXISTS `depes_recibos_energia_1ero_year_pasado_final_v4` (`id` INT NOT NULL AUTO_INCREMENT, `servicio_year_pasado` FLOAT(16) NOT NULL,
	`cta_year_pasado` FLOAT(26) NOT NULL, `depes_year_pasado` VARCHAR(55) NOT NULL,
	`periodo_inicio_year_pasado` VARCHAR(15) NOT NULL, `mes_inicio_year_pasado` VARCHAR(15) NOT NULL,
	`periodo_fin_year_pasado` VARCHAR(15) NOT NULL, `mes_fin_year_pasado` VARCHAR(15) NOT NULL,
	`consumo_mes_year_pasado` DECIMAL(30,2) NOT NULL, `costo_mes_year_pasado` DECIMAL(30,2) NOT NULL, PRIMARY KEY (`id`),
	UNIQUE `depreene1yrf` (`id`))  ENGINE = InnoDB DEFAULT CHARSET=utf8";

	$tabla7= "CREATE TABLE IF NOT EXISTS `depes_recibos_energia_temp1_year_pasado_concos_final_v4`
	(`servicio_temp1_year_pasado` FLOAT(16) NOT NULL, `cta_temp1_year_pasado` FLOAT(26) NOT NULL, `depes_temp1_year_pasado` VARCHAR(100),
    `periodo_inicio_temp1_year_pasado` DATE, `year_inicio_temp1_year_pasado` INT, `mes_inicio_temp1_year_pasado` VARCHAR(15) NOT NULL,
    `periodo_fin_temp1_year_pasado` DATE, `year_fin_temp1_year_pasado` INT, `mes_fin_temp1_year_pasado` VARCHAR(15) NOT NULL,
    `enero_con` DECIMAL(30,2) NOT NULL, `febrero_con` DECIMAL(30,2) NOT NULL, `marzo_con` DECIMAL(30,2) NOT NULL,
    `abril_con` DECIMAL(30,2) NOT NULL, `mayo_con` DECIMAL(30,2) NOT NULL, `junio_con` DECIMAL(30,2) NOT NULL,
	`julio_con` DECIMAL(30,2) NOT NULL, `agosto_con` DECIMAL(30,2) NOT NULL, `septiembre_con` DECIMAL(30,2) NOT NULL,
    `octubre_con` DECIMAL(30,2) NOT NULL, `noviembre_con` DECIMAL(30,2) NOT NULL, `diciembre_con` DECIMAL(30,2) NOT NULL) ENGINE = InnoDB DEFAULT CHARSET=utf8.";

	$tabla8= "CREATE TABLE IF NOT EXISTS `depes_elec_anio_pasado_consumo_temporal_v4`
	( `servicio_temp_year_pasado` VARCHAR(26) NOT NULL,`cta_temp_anio_pasado` VARCHAR(100) NOT NULL, `depe_temp_anio_pasado` VARCHAR(100) NOT NULL, `anio_temp_pasado` YEAR,
    `enero` DECIMAL(30,2) NOT NULL, `febrero` DECIMAL(30,2) NOT NULL,
	`marzo` DECIMAL(30,2) NOT NULL, `abril` DECIMAL(30,2) NOT NULL, `mayo` DECIMAL(30,2) NOT NULL, `junio` DECIMAL(30,2) NOT NULL,
	`julio` DECIMAL(30,2) NOT NULL, `agosto` DECIMAL(30,2) NOT NULL, `septiembre` DECIMAL(30,2) NOT NULL,
    `octubre` DECIMAL(30,2) NOT NULL, `noviembre` DECIMAL(30,2) NOT NULL, `diciembre` DECIMAL(30,2) NOT NULL) ENGINE = InnoDB DEFAULT CHARSET=utf8";

	$tabla9= "CREATE TABLE IF NOT EXISTS `depes_elec_consumo_final_pasado_v4`  (`id` INT NOT NULL AUTO_INCREMENT,
	`servicio_consumo_final` VARCHAR(16) NOT NULL, `cta_consumo_final_pasado` VARCHAR(100) NOT NULL,
	`dep_consumo_final_pasado` VARCHAR(55) NOT NULL,  `yer_consumo_final_pasado` YEAR NOT NULL,
	`Enero` INT(30) NOT NULL, `Febrero` INT(30) NOT NULL, `Marzo` INT(30) NOT NULL, `Abril` INT(30) NOT NULL,
	`Mayo` INT(30) NOT NULL, `Junio` INT(30) NOT NULL, `Julio` INT(30) NOT NULL, `Agosto` INT(30) NOT NULL,
	`Septiembre` INT(30) NOT NULL, `Octubre` INT(30) NOT NULL, `Noviembre` INT(30) NOT NULL,
	`Diciembre` INT(30) NOT NULL, `mismo_year_mes_anterior` INT(30) NOT NULL, `mismo_mes_year_anterior` INT(30) NOT NULL,
	UNIQUE KEY (`id`)) ENGINE = InnoDB DEFAULT CHARSET=utf8";

	$tabla10= "CREATE TABLE IF NOT EXISTS `tbl_temp_comparacion_elec_v1` (/*`id` INT NOT NULL AUTO_INCREMENT, */
		`usuario` VARCHAR(15) NOT NULL,`servicio` VARCHAR(55) NOT NULL, `periodo_fin` VARCHAR(15) NOT NULL, `consumo_actual` VARCHAR(25) NOT NULL,
		`consumo_mes_anterior` VARCHAR(25) NOT NULL, `consumo_mismo_mes_year_anterior` VARCHAR(25) NOT NULL)    ENGINE = InnoDB DEFAULT CHARSET=utf8";

	$tabla11= "CREATE TABLE IF NOT EXISTS `tbl_temp_comparacion_elec_depu_v1` (/*`id` INT NOT NULL AUTO_INCREMENT, */
		`usuario` VARCHAR(15) NOT NULL,`servicio` VARCHAR(55) NOT NULL, `periodo_fin` VARCHAR(15) NOT NULL, `consumo_actual` VARCHAR(25) NOT NULL,
		`consumo_mes_anterior` VARCHAR(25) NOT NULL, `consumo_mismo_mes_year_anterior` VARCHAR(25) NOT NULL)    ENGINE = InnoDB DEFAULT CHARSET=utf8";

	$tabla12= "CREATE TABLE IF NOT EXISTS `depes_elec_anio_actual_grafica_final_final` (`id` INT NOT NULL AUTO_INCREMENT, `cta_eleanio_atual` VARCHAR(40) NOT NULL,
	`depe_eleanio_actual` VARCHAR(60) NOT NULL, `anio_actual_elec` VARCHAR(20) NOT NULL,
	`Enero` INT(50) NOT NULL, `Febrero` INT(50) NOT NULL,
	`Marzo` INT(50) NOT NULL, `Abril` INT(50) NOT NULL,
	`Mayo` INT(50) NOT NULL, `Junio` INT(50) NOT NULL,
    `Julio` INT(50) NOT NULL, `Agosto` INT(50) NOT NULL,
	`Septiembre` INT(50) NOT NULL, `Octubre` INT(50) NOT NULL,
    `Noviembre` INT(50) NOT NULL, `Diciembre` INT(50) NOT NULL,
    `consumo_mes_anterior` VARCHAR(40) NOT NULL, `consumo_mismo_mes_year_anterior` VARCHAR(40) NOT NULL,
    PRIMARY KEY (`id`), UNIQUE `depepepe` (`id`))  ENGINE = InnoDB DEFAULT CHARSET=utf8";

	$tabla13= "INSERT INTO `depes_recibos_energia_1ero_1year_final` (`cta_fst`, `depes_fst`, `periodo_inicio_fst`, `mes_inicio_fst`, `periodo_fin_fst`, `mes_fin_fst`, `consumo_mes_fst`,
	`costo_mes_fst`)
   SELECT DISTINCT
   c.cuenta,
   c.dependencia,
   (a.periodo_inicio),
   MONTHNAME(a.periodo_inicio),
   (a.periodo_fin),
   MONTHNAME(a.periodo_fin),
   (a.consumo),
   (a.costo)
   FROM `pdc_consumo_energia` a
   INNER JOIN `ctrl_servicios` b ON a.servicio = b.id 
   INNER JOIN `pdc_servicios_energia` c ON b.account = c.cuenta 
   WHERE c.dependencia IS NOT NULL AND c.dependencia <> ''
   AND a.periodo_fin IS NOT NULL AND a.periodo_fin <> ''
   AND a.consumo IS NOT NULL AND a.consumo <> ''
   AND a.costo IS NOT NULL AND a.costo <> ''
   AND b.account IS NOT NULL AND b.account <> ''
   AND a.servicio IS NOT NULL AND a.servicio <> ''
   AND a.id NOT IN('192')
   AND b.id NOT IN('192')
   AND a.id NOT IN('105')
   AND b.id NOT IN('105')
   AND c.id NOT IN('192')
   AND c.id NOT IN('105')
   AND (YEAR(a.periodo_fin) <= YEAR(NOW() - INTERVAL 0 YEAR) AND YEAR(a.periodo_fin)  >= YEAR(NOW() - INTERVAL 1 YEAR))
   ORDER BY DATE(a.periodo_fin) ASC
   ON DUPLICATE KEY UPDATE cta_fst = VALUES(cta_fst), `depes_fst` = VALUES(depes_fst), `periodo_inicio_fst` = VALUES(periodo_inicio_fst), `mes_inicio_fst` = VALUES(mes_inicio_fst),
   `periodo_fin_fst` = VALUES(periodo_fin_fst), `mes_fin_fst` = VALUES(mes_fin_fst), `consumo_mes_fst` = VALUES(consumo_mes_fst), `costo_mes_fst` = VALUES(costo_mes_fst)";

	$this->db->query($tabla1);
	$this->db->query($tabla2);
	$this->db->query($tabla3);
	$this->db->query($tabla4);
	$this->db->query($tabla5);
	$this->db->query($tabla6);
	
	/*/HACE JOIN DE LAS TABLAS QUE HACEN REFERENCIA A LOS CONSUMOS Y COSTOS DE LAS DEPENDENCIAS EN EL SERVICIO DE ELECTRICIDAD/*/ 
	$this->db->query(
		"INSERT INTO `depes_recibos_energia_1ero_1year_final` (`cta_fst`, `depes_fst`, `periodo_inicio_fst`, `mes_inicio_fst`, `periodo_fin_fst`, `mes_fin_fst`, `consumo_mes_fst`,
		 `costo_mes_fst`)
		SELECT DISTINCT
		c.cuenta,
		c.dependencia,
		(a.periodo_inicio),
		MONTHNAME(a.periodo_inicio),
		(a.periodo_fin),
		MONTHNAME(a.periodo_fin),
		(a.consumo),
		(a.costo)
		FROM `pdc_consumo_energia` a
		INNER JOIN `ctrl_servicios` b ON a.servicio = b.id 
		INNER JOIN `pdc_servicios_energia` c ON b.account = c.cuenta 
		WHERE c.dependencia IS NOT NULL AND c.dependencia <> ''
		AND a.periodo_fin IS NOT NULL AND a.periodo_fin <> ''
		AND a.consumo IS NOT NULL AND a.consumo <> ''
		AND a.costo IS NOT NULL AND a.costo <> ''
		AND b.account IS NOT NULL AND b.account <> ''
		AND a.servicio IS NOT NULL AND a.servicio <> ''
        AND a.id NOT IN('192')
		AND b.id NOT IN('192')
		AND a.id NOT IN('105')
		AND b.id NOT IN('105')
		AND c.id NOT IN('192')
		AND c.id NOT IN('105')
        AND (YEAR(a.periodo_fin) <= YEAR(NOW() - INTERVAL 0 YEAR) AND YEAR(a.periodo_fin)  >= YEAR(NOW() - INTERVAL 1 YEAR))
		ORDER BY DATE(a.periodo_fin) ASC
		ON DUPLICATE KEY UPDATE cta_fst = VALUES(cta_fst), `depes_fst` = VALUES(depes_fst), `periodo_inicio_fst` = VALUES(periodo_inicio_fst), `mes_inicio_fst` = VALUES(mes_inicio_fst),
		`periodo_fin_fst` = VALUES(periodo_fin_fst), `mes_fin_fst` = VALUES(mes_fin_fst), `consumo_mes_fst` = VALUES(consumo_mes_fst), `costo_mes_fst` = VALUES(costo_mes_fst)");

/*/INSERTA LOS DATOS A LA TABLA TEMP1YEAR EN ORDEN CORRESPONDIENTE AL AÑO PASADO Y ACTUAL POR MESES DEPENDIENDO SI ES CONSUMO Y/O COSTO/*/
	$this->db->query(
		"INSERT INTO `depes_recibos_energia_temp1year_pasado_y_actual_final`
		SELECT
		CONCAT(`cta_fst`),
		CONCAT(`depes_fst`),
		CONCAT(`periodo_inicio_fst`),
		CONCAT(YEAR(`periodo_inicio_fst`)),
		CONCAT(`mes_inicio_fst`),
		CONCAT(`periodo_fin_fst`),
		CONCAT(YEAR(`periodo_fin_fst`)),
		CONCAT(`mes_fin_fst`),
		CASE WHEN `mes_fin_fst` = 'January' THEN `consumo_mes_fst` END,
		CASE WHEN `mes_fin_fst` = 'February' THEN `consumo_mes_fst` END,
		CASE WHEN `mes_fin_fst` = 'March' THEN `consumo_mes_fst` END,
		CASE WHEN `mes_fin_fst` = 'April' THEN `consumo_mes_fst` END,
		CASE WHEN `mes_fin_fst` = 'May' THEN `consumo_mes_fst` END,
		CASE WHEN `mes_fin_fst` = 'June' THEN `consumo_mes_fst` END,
		CASE WHEN `mes_fin_fst` = 'July' THEN `consumo_mes_fst` END,
		CASE WHEN `mes_fin_fst` = 'August' THEN `consumo_mes_fst` END,
		CASE WHEN `mes_fin_fst` = 'September' THEN `consumo_mes_fst` END,
		CASE WHEN `mes_fin_fst` = 'October' THEN `consumo_mes_fst` END,
		CASE WHEN `mes_fin_fst` = 'November' THEN `consumo_mes_fst` END,
		CASE WHEN `mes_fin_fst` = 'December' THEN `consumo_mes_fst` END,
		CASE WHEN `mes_fin_fst` = 'January' THEN `costo_mes_fst` END,
		CASE WHEN `mes_fin_fst` = 'February' THEN `costo_mes_fst` END,
		CASE WHEN `mes_fin_fst` = 'March' THEN `costo_mes_fst` END,
		CASE WHEN `mes_fin_fst` = 'April' THEN `costo_mes_fst` END,
		CASE WHEN `mes_fin_fst` = 'May' THEN `costo_mes_fst` END,
		CASE WHEN `mes_fin_fst` = 'June' THEN `costo_mes_fst` END,
		CASE WHEN `mes_fin_fst` = 'July' THEN `costo_mes_fst` END,
		CASE WHEN `mes_fin_fst` = 'August' THEN `costo_mes_fst` END,
		CASE WHEN `mes_fin_fst` = 'September' THEN `costo_mes_fst` END,
		CASE WHEN `mes_fin_fst` = 'October' THEN `costo_mes_fst` END,
		CASE WHEN `mes_fin_fst` = 'November' THEN `costo_mes_fst` END,
		CASE WHEN `mes_fin_fst` = 'December' THEN `costo_mes_fst` END
		FROM `depes_recibos_energia_1ero_1year_final`
		WHERE TRUE");

/*/INSERTA LOS DATOS A LA TABLA TEMPORAL CORRESPONDIENTE AL AÑO ACTUAL, PREVIO A LA TABLA DE LA GRAFICA FINAL/*/
	$this->db->query(
		"INSERT INTO `depes_elec_anio_actual_temporal`(
			`cta_temp_anio_actual`, `depe_temp_anio_actual`,
			 `anio_temp_ele`, `enero`, `febrero`,
			`marzo`, `abril`, `mayo`, `junio`,
			`julio`, `agosto`, `septiembre`,
			`octubre`, `noviembre`, `diciembre`)
					SELECT
					`cta_temp1year_pasado_1`,
					`depes_temp1year_pasado_1`,
					`periodo_fin_temp1year_pasado_1`,
					SUM(`enero_con`),
					SUM(`febrero_con`),
					SUM(`marzo_con`),
					SUM(`abril_con`),
					SUM(`mayo_con`),
					SUM(`junio_con`),
					SUM(`julio_con`),
					SUM(`agosto_con`),
					SUM(`septiembre_con`),
					SUM(`octubre_con`),
					SUM(`noviembre_con`),
					SUM(`diciembre_con`)
					FROM `depes_recibos_energia_temp1year_pasado_y_actual_final`
					WHERE YEAR(periodo_fin_temp1year_pasado_1) = YEAR(NOW())
					GROUP BY `depes_temp1year_pasado_1`, YEAR(`periodo_fin_temp1year_pasado_1`) ASC");

/*/INSERTA LOS DATOS A LA TABLA FINAL PARA MOSTRAR LA GRAFICA/*/
	$this->db->query(
		"INSERT INTO `depes_elec_anio_actual_grafica_final`(`cta_eleanio_atual`, `depe_eleanio_actual`, `anio_actual_elec`,
		`Enero`, `Febrero`, `Marzo`, `Abril`,
				   `Mayo`, `Junio`, `Julio`, `Agosto`,
				   `Septiembre`, `Octubre`, `Noviembre`,
				   `Diciembre`)
   		SELECT
   		`cta_temp_anio_actual`,
   		`depe_temp_anio_actual`,
   		`anio_temp_ele`,
   		COALESCE(`enero`,0) AS Enero,
   		COALESCE(`febrero`,0) AS Febrero,
   		COALESCE(`marzo`,0) AS Marzo,
   		COALESCE(`abril`,0) AS Abril,
   		COALESCE(`mayo`,0) AS Mayo,
   		COALESCE(`junio`,0) AS Junio,
   		COALESCE(`julio`,0) AS Julio,
   		COALESCE(`agosto`,0) AS Agosto,
   		COALESCE(`septiembre`,0) AS Septiembre,
   		COALESCE(`octubre`,0) AS Octubre,
   		COALESCE(`noviembre`,0) AS Noviembre,
   		COALESCE(`diciembre`,0) AS Diciembre
   		FROM `depes_elec_anio_actual_temporal`
   		GROUP BY `depe_temp_anio_actual` ASC");

/*/HACE INSERCION A LOS DATOS PARA LA TABLA PRE FINAL DE CONSUMO DE COMPARACIONES/*/
		$this->db->query(
			"INSERT INTO `tbl_final_consumo_year_pasado_y_comparaciones` (
			`cta_final_cypyp`, `depe_final_cypyp`,
			`anio_final_cypyp`, `Enero`,  `Febrero`,
			`Marzo`,  `Abril`,  `Mayo`,
			`Junio`, `Julio`, `Agosto`,
			`Septiembre`, `Octubre`,  `Noviembre`,
			`Diciembre`, `consumo_mes_anterior`,
			`consumo_mismo_mes_year_anterior`)
			SELECT DISTINCT
			a.cta_temp_anio_pasado,
			a.depe_temp_anio_pasado,
			a.anio_temp_pasado,
			COALESCE(a.enero,0) AS Enero,
			COALESCE(a.febrero,0) AS Febrero,
			COALESCE(a.marzo,0) AS Marzo,
			COALESCE(a.abril,0) AS Abril,
			COALESCE(a.mayo,0) AS Mayo,
			COALESCE(a.junio,0) AS Junio,
			COALESCE(a.julio,0) AS Julio,
			COALESCE(a.agosto,0) AS Agosto,
			COALESCE(a.septiembre,0) AS Septiembre,
			COALESCE(a.octubre,0) AS Octubre,
			COALESCE(a.noviembre,0) AS Noviembre,
			COALESCE(a.diciembre,0) AS Diciembre,
			b.consumo_mes_anterior,
			b.consumo_mismo_mes_year_anterior
			FROM `depes_elec_anio_pasado_consumo_temporal_v4` a
			INNER JOIN `tbl_temp_comparacion_elec_depu_v1` b ON a.servicio_temp_year_pasado = b.servicio
			WHERE b.servicio IS NOT NULL AND b.servicio <> ''
			AND (YEAR(b.periodo_fin) <= YEAR(NOW() - INTERVAL 0 YEAR) AND YEAR(b.periodo_fin)  >= YEAR(NOW() - INTERVAL 1 YEAR))
			ORDER BY DATE(b.periodo_fin) ASC");

		$this->db->query(
			"INSERT INTO `depes_elec_anio_actual_grafica_final_final` (`cta_eleanio_atual`, `depe_eleanio_actual`, `anio_actual_elec`,
			`Enero`, `Febrero`,
			`Marzo`, `Abril`,
			`Mayo`, `Junio`,
			`Julio`, `Agosto`,
			`Septiembre`, `Octubre`,
			`Noviembre`, `Diciembre`,
			`consumo_mes_anterior`, `consumo_mismo_mes_year_anterior`)
			SELECT DISTINCT
			a.cta_eleanio_atual,
			a.depe_eleanio_actual,
			a.anio_actual_elec,
			a.Enero,
			a.Febrero,
			a.Marzo,
			a.Abril,
			a.Mayo,
			a.Junio,
			a.Julio,
			a.Agosto,
			a.Septiembre,
			a.Octubre,
			a.Noviembre,
			a.Diciembre,
			b.consumo_mes_anterior,
			b. consumo_mismo_mes_year_anterior
			FROM `depes_elec_anio_actual_grafica_final` a
			INNER JOIN `tbl_final_consumo_year_pasado_y_comparaciones` b ON a.cta_eleanio_atual=b.cta_final_cypyp");

$this->db->trans_complete();
}
//*************************************FIN DE LA TRANSACCION*************************************//

//ELIMINA LAS TABLAS PARA GENERAR NUEVOS DATOS//
function droprtablascompelecactualypasadov2()
{
	$this->db->query("DROP TABLE  depes_recibos_energia_1ero_1year_final;");
	$this->db->query("DROP TABLE  depes_recibos_energia_temp1year_pasado_y_actual_final;");
	$this->db->query("DROP TABLE  depes_elec_anio_actual_temporal;");
	$this->db->query("DROP TABLE  depes_elec_anio_actual_grafica_final;");
}
//*************************************FIN DEL BORRADO*************************************//

//*************************************QUERIES PARA SELECCION DE MES (COMPARACIÓNES EN ELECTRICIDAD)*************************************//
function eneroelec()
{
$this->db->trans_start();
$eneroelec = "SELECT b.usuario, b.servicio, b.periodo_fin, (b.consumo), b.consumo_mes_anterior, c.consumo_mismomes_yearanterior FROM (
	SELECT a0.usuario, a0.servicio, a0.periodo_fin, (a0.consumo), (SELECT IFNULL(a1.consumo,0) FROM `pdc_consumo_energia` a1
	WHERE
	a1.usuario = a0.usuario
	AND
	a0.servicio = a1.servicio
	AND
	YEAR(a1.periodo_fin) = YEAR(a0.periodo_fin)
	AND
	MONTH(a1.periodo_fin) = 0 )AS consumo_mes_anterior
	FROM `pdc_consumo_energia` AS a0
	WHERE YEAR(a0.periodo_fin) = YEAR(NOW())) AS b
	LEFT JOIN (
	SELECT a0.usuario, a0.servicio, a0.periodo_fin, a0.consumo, (SELECT IFNULL(a1.consumo,0) FROM `pdc_consumo_energia` a1
	WHERE
	a1.usuario = a0.usuario
	AND
	a0.servicio = a1.servicio
	AND
	YEAR(a1.periodo_fin) = YEAR(NOW() - INTERVAL 1 YEAR)
	AND
	MONTH(a1.periodo_fin) = 1)AS consumo_mismomes_yearanterior
	FROM `pdc_consumo_energia` a0
	WHERE 
	YEAR(a0.periodo_fin) = YEAR(NOW())) AS c ON b.usuario = c.usuario AND b.servicio = c.servicio AND b.periodo_fin = c.periodo_fin";

	
$this->db->trans_complete();
}

//*************************************FIN DE QUERIES EN ELECTRICIDAD (PEDIDO ING. FELIX)*************************************//

//CARGA EL MENU DROP DOWN PARA LAS DEPENDENCIAS ELECTRICIDAD//
function catdepesxragraficoanioactualv2()
{
	
	$this->db->order_by('depe_eleanio_actual', 'asc');
	$this->db->group_by('depe_eleanio_actual');
	$query = $this->db->get('depes_elec_anio_actual_grafica_final');
	if($query->num_rows()>0) {
		foreach($query->result() as $row) {
			$depe_eleanio_actual[$row->id] = $row;
			
		}
		return $depe_eleanio_actual;

	}
}
//*************************************FIN*************************************//

//MANDA RESULTADOS SI SE SELECCIONA LA DEPENDENCIA PARA GENERAR LA GRÁFICA EN ELECTRICIDAD//
function graficaelecdepeyearv2()
{
	$depe_eleanio_actual = $this->input->post("depe_eleanio_actual");
	if(!empty($depe_eleanio_actual))
	{
		$this->db->where('depe_eleanio_actual', $depe_eleanio_actual);
		$this->db->order_by('id', 'asc');
		$query = $this->db->get('depes_elec_anio_actual_grafica_final_final');
				
			if ($query->num_rows()>0)
			{
				foreach($query->result() as $row)
				{
					$cta_eleanio_atual[$row->id] = $row;
				}
				return $cta_eleanio_atual;
			}
}

}
//*************************************FIN*************************************//

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//LLAMADO DE LOS MESES PARA LA GRAFICA AÑO ACTUAL DE CONSUMO EN ELECTRICIDAD//

function Eneroelecactualyearv2($depe_eleanio_actual)
{


	if(!empty($depe_eleanio_actual))
	{
		$this->db->where('depe_eleanio_actual', $depe_eleanio_actual);
		$this->db->select_sum('Enero');
		$query = $this->db->get('depes_elec_anio_actual_grafica_final');
		$result = $query->row()->Enero;
		return $result;
	}

}

function Febreroelecactualyearv2($depe_eleanio_actual)
{


	if(!empty($depes))
	{
		$this->db->where('depe_eleanio_actual', $depe_eleanio_actual);
		$this->db->select_sum('Febrero');
		$query = $this->db->get('depes_elec_anio_actual_grafica_final');
		$result = $query->row()->Febrero;
		return $result;
	}

}

function Marzoelecactualyearv2($depe_eleanio_actual)
{


	if(!empty($depe_eleanio_actual))
	{
		$this->db->where('depe_eleanio_actual', $depe_eleanio_actual);
		$this->db->select_sum('Marzo');
		$query = $this->db->get('depes_elec_anio_actual_grafica_final');
		$result = $query->row()->Marzo;
		return $result;
	}

}

function Abrilelecactualyearv2($depe_eleanio_actual)
{


	if(!empty($depe_eleanio_actual))
	{
		$this->db->where('depe_eleanio_actual', $depe_eleanio_actual);
		$this->db->select_sum('Abril');
		$query = $this->db->get('depes_elec_anio_actual_grafica_final');
		$result = $query->row()->Abril;
		return $result;
	}

}

function Mayoelecactualyearv2($depe_eleanio_actual)
{


	if(!empty($depe_eleanio_actual))
	{
		$this->db->where('depe_eleanio_actual', $depe_eleanio_actual);
		$this->db->select_sum('Mayo');
		$query = $this->db->get('depes_elec_anio_actual_grafica_final');
		$result = $query->row()->Mayo;
		return $result;
	}

}

function Junioelecactualyearv2($depe_eleanio_actual)
{


	if(!empty($depe_eleanio_actual))
	{
		$this->db->where('depe_eleanio_actual', $depe_eleanio_actual);
		$this->db->select_sum('Junio');
		$query = $this->db->get('depes_elec_anio_actual_grafica_final');
		$result = $query->row()->Junio;
		return $result;
	}

}

function Julioelecactualyearv2($depe_eleanio_actual)
{


	if(!empty($depe_eleanio_actual))
	{
		$this->db->where('depe_eleanio_actual', $depe_eleanio_actual);
		$this->db->select_sum('Julio');
		$query = $this->db->get('depes_elec_anio_actual_grafica_final');
		$result = $query->row()->Julio;
		return $result;
	}

}

function Agostoelecactualyearv2($depe_eleanio_actual)
{


	if(!empty($depe_eleanio_actual))
	{
		$this->db->where('depe_eleanio_actual', $depe_eleanio_actual);
		$this->db->select_sum('Agosto');
		$query = $this->db->get('depes_elec_anio_actual_grafica_final');
		$result = $query->row()->Agosto;
		return $result;
	}

}

function Septiembreelecactualyearv2($depe_eleanio_actual)
{


	if(!empty($depe_eleanio_actual))
	{
		$this->db->where('depe_eleanio_actual', $depe_eleanio_actual);
		$this->db->select_sum('Septiembre');
		$query = $this->db->get('depes_elec_anio_actual_grafica_final');
		$result = $query->row()->Septiembre;
		return $result;
	}

}

function Octubreelecactualyearv2($depe_eleanio_actual)
{


	if(!empty($depe_eleanio_actual))
	{
		$this->db->where('depe_eleanio_actual', $depe_eleanio_actual);
		$this->db->select_sum('Octubre');
		$query = $this->db->get('depes_elec_anio_actual_grafica_final');
		$result = $query->row()->Octubre;
		return $result;
	}

}

function Noviembreelecactualyearv2($depe_eleanio_actual)
{


	if(!empty($depe_eleanio_actual))
	{
		$this->db->where('depe_eleanio_actual', $depe_eleanio_actual);
		$this->db->select_sum('Noviembre');
		$query = $this->db->get('depes_elec_anio_actual_grafica_final');
		$result = $query->row()->Noviembre;
		return $result;
	}

}

function Diciembreelecactualyearv2($depe_eleanio_actual)
{


	if(!empty($depe_eleanio_actual))
	{
		$this->db->where('depe_eleanio_actual', $depe_eleanio_actual);
		$this->db->select_sum('Diciembre');
		$query = $this->db->get('depes_elec_anio_actual_grafica_final');
		$result = $query->row()->Diciembre;
		return $result;
	}

}
			//*************************************FIN*************************************//

/***************************************************************************************************************************/
						/*FIN DEL LLAMADO PARA LA COMPARACION DE CONSUMO AÑO ACTUAL Y PASADO - ELECTRICIDAD*/
/***************************************************************************************************************************/

/***************************************************************************************************************************/
						/*FIN PARAL MODELO PARA LA BUSQUEDA DE CONSUMO X DEPENDENCIAS (ING. FELIX)*/
/***************************************************************************************************************************/
/***************************************************************************************************************************/
											/*FIN DE MODELO*/
/***************************************************************************************************************************/
}//CIERRE TOTAL DEL MODELO