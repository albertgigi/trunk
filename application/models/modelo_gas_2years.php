<?php
Class Modelo_gas_2years Extends CI_Model
{

/* RECIBOS*/
function config_gas_2years()
{
	$sql=
	"SELECT CONCAT('', FORMAT(SUM(consumo), 0)) AS SumaConsumo,
	CONCAT('', FORMAT(SUM(costo),2)) AS SumaCosto,
	GROUP_CONCAT(DISTINCT(YEAR(periodo_fin))) AS SumaYear FROM pdc_consumo_agua
	WHERE (YEAR(periodo_fin) <'0-0-0' OR YEAR(periodo_fin)> '2010-12-31')
	AND (YEAR(periodo_fin) <= YEAR(NOW()) )
	AND consumo IS NOT NULL AND consumo <> ''
	AND costo IS NOT NULL AND costo <> ''
	AND periodo_inicio IS NOT NULL AND  periodo_inicio <> ''
	AND periodo_fin IS NOT NULL AND periodo_fin <> ''
	AND servicio IS NOT NULL AND servicio <> ''
	AND datetime IS NOT NULL AND datetime <> ''";

	$sql .= " GROUP BY YEAR(periodo_fin) ORDER BY YEAR(periodo_fin)";

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
    }