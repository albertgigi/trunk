<section id="pricing">
    <div class="container"></div>
        <div class="box first"></div>
            <div class="center">
            </div><!--/.center-->
            <div id="pricing-table" class="row"></div>

                <div class="center">
                    <i class="icon-bolt icon-md icon-color7"></i>
                    </a>

                    <ul class="plan">
                        <li>
                            <b>Gráficas de:</b>
                                <ul>
                                    <li><?php echo anchor("control_factor_gei/mensualgm_elec_cdun_v2/", "Campus Ciudad Universitaria"); ?>
                                    </li>
                                    <li><?php echo anchor("control_factor_gei/mensualgm_elec_cdls_v2/", "Campus Ciencias de la Salud"); ?>
                                    </li>
                                    <li><?php echo anchor("control_factor_gei/mensualgm_elec_cagro_v2/", "Campus Ciencias Agropecuarias"); ?>
                                    </li>
                                    <li><?php echo anchor("control_factor_gei/mensualgm_elec_clina_v2/", "Campus Linares"); ?>
                                    </li>
                                    <li><?php echo anchor("control_factor_gei/mensualgm_elec_cmede_v2/", "Campus Mederos"); ?>
                                    </li>
                                    <li><?php echo anchor("control_factor_gei/mensualgm_elec_csahi_v2/", "Campus Sabinas Hidalgo"); ?>
                                    </li>
                                </ul>
                        </li>
                    </ul>
</section><!--/#pricing-->
<?php echo form_open(); ?>

	<div class="center">
		<button
			name="enviar"
			value="volver"
			class="btn"
			type="submit"
		><span class="glyphicon glyphicon-circle-arrow-left"></span> Volver al Inicio</button>
	</div>

<?php echo form_close(); ?>