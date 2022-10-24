	<?php
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
		$this->db->query("INSERT INTO pdc_factor_gei_all(theyear, rawkw)
			(SELECT GROUP_CONCAT(DISTINCT(YEAR(a.periodo_fin))),
			CONCAT(SUM(a.consumo))
			FROM pdc_consumo_energia a
			WHERE a.periodo_fin IS NOT NULL AND a.periodo_fin <> ''
			AND a.consumo IS NOT NULL AND a.consumo <> ''
			AND a.costo IS NOT NULL AND a.costo <> ''
			AND a.servicio IS NOT NULL AND a.servicio <> ''
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
		/*$this->db->query("INSERT INTO `pdc_factor_gei_all`(theyear, rawm3gas)
			(SELECT GROUP_CONCAT(DISTINCT(YEAR(c.periodo_fin))),
			CONCAT(SUM(c.consumo))
			FROM pdc_consumo_gas c
			WHERE c.periodo_fin IS NOT NULL AND c.periodo_fin <> ''
			AND c.consumo IS NOT NULL AND c.consumo <> ''
			AND c.costo IS NOT NULL AND c.costo <> ''
			AND c.servicio IS NOT NULL AND c.servicio <> ''
			AND c.datetime IS NOT NULL AND c.datetime <> ''
			AND c.periodo_fin IS NOT NULL AND c.periodo_fin <> ''
			AND (YEAR(c.periodo_fin) >= 2011 AND YEAR(c.periodo_fin) <= YEAR(NOW()) )
			AND (YEAR(periodo_fin) >=2011 AND YEAR(periodo_fin) <=YEAR(NOW()))
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

/**************************TERMINACION DEL TRANSACT**************************/


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


/***********************************CONSUMO DE AGUA POTABLE Y RESIDUAL*********************************************/
	/*****************FUNCION PARA LA TABLA DE AGUA POTABLE Y RESIDUAL*****************/

	function drope_pot_res()
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
	ON DUPLICATE KEY UPDATE theyearomgpo = VALUES(theyearomgpo), consumoomgpo = VALUES(consumoomgpo), costoomgpo = (costoomgpo)");
	$this->db->trans_complete();
}
/*****************TERMINACION DE LA FUNCION*****************/
/*

	function consulta_aguas_pot_res()
	{

		$sql = "SELECT id AS show_idw,
		theyearw AS show_theyearw,
		FORMAT(potwtr,0) AS show_potwtr,
		FORMAT(reswtr,0) AS show_reswtr
		FROM pdc_waters";


		$sql .= " ORDER BY theyearw";

		$query = $this->db->query($sql);

		if($query->num_rows() > 0)
			{
				return $query->result_array();

			}
			else
				{
					return FALSE;
				}
	} */


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

	}//CIERRE DEL MODELO