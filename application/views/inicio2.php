<section id="pricing">
    <div class="container">
    <div style="margin:auto; width:auto;">
        <div class="box auto">
            <div class="center">
                <h2>Servicios</h2>
                <p class="lead">Registro de consumo de servicios de energía eléctrica, agua y gas<br>en los planteles e instalaciones de la Universidad.</p>
            </div><!--/.center-->
            <div class="big-gap"></div>
            <div id="pricing-table" class="row">
                
                <!--

                COLUMNA PARA ELECTRICIDAD
                
                -->

                <div class="col-sm-4 center">
                    <!--a class="big-link" href="<php echo site_url('consumo_electricidad'); ?>"-->
                    <i class="icon-bolt icon-md icon-color7"></i>
                    <h4>Electricidad</h4>
                    </a>

                    <ul id="planmetric">
                        <li>
                            <b>Recibos</b>
                                <ul>
                                    <li id="wachalosrecibos"><?php echo anchor("consumo_electricidad/catalogo/", "Ver recibos capturados"); ?></li>
                                </ul>
                        </li>
                    </ul>
                    <ul id="planmetric">
                        <li>
                            <b>Gráficas</b>
                                <ul>
                                <li><?php
                                if($_SESSION['sess']['level'] == 1){ echo anchor("consumo_electricidad/diagnostico/", "Gráfica de Electricidad"); }?></li>
									<li id="anualgraf"><?php if($_SESSION['sess']['level'] == 1){ echo anchor("control_factor_gei/graf_nueva_elec_costos", "Gráfica Anual de Costos de Electricidad"); }?></li>
                                    <li id="anualgraf"><?php if($_SESSION['sess']['level'] == 1){ echo anchor("control_factor_gei/graf_nueva_elec_consumos", "Gráfica Anual de Consumo de Electricidad"); }?></li>
									<li id="anualgraf"><?php if($_SESSION['sess']['level'] == 1){ echo anchor("control_factor_gei/graf_nueva_elec_factores", "Gráfica Anual de FP de Electricidad"); }?></li>
                                    <li id="greenmetric2"><?php if($_SESSION['sess']['level'] == 1){ echo anchor("control_factor_gei/metrica_gei_elec/", "GEI Electricidad");} ?></li>
									<li id="greenmetric"><?php if($_SESSION['sess']['level'] == 1) { echo anchor("control_factor_gei/metrica_gei_elec_gm/", "GEI Electricidad - GM"); } ?></li>
                                    <li id="greenmetric"><?php echo anchor("control_factor_gei/metrica_gei_elec_gm_5yrs/", "GEI Electricidad - GM I5A"); ?></li>
                                    <li><?php if($_SESSION['sess']['level'] == 1){ echo anchor("control_factor_gei/kwcperiodo_elec/", "kWh Per Cápita x Año"); }?></li>
									<li id="greenmetric"><?php if($_SESSION['sess']['level'] == 1){ echo anchor("control_factor_gei/kwcperiodo_elec_gm/", "kWh Per Cápita x Año - GM"); }?></li>
                                    <li id="greenmetric"><?php echo anchor("control_factor_gei/kwcperiodo_elec_gm_5yrs/", "kWh Per Cápita x Año - GM I5A"); ?></li>
                                    <li><?php if($_SESSION['sess']['level'] == 1){ echo anchor("control_factor_gei/kgcperiodo_elec/", "Kg de CO2 Per Cápita x Año"); }?></li>
									<li id="greenmetric"><?php if($_SESSION['sess']['level'] == 1){ echo anchor("control_factor_gei/kgcperiodo_elec_gm/", "Kg de CO2 Per Cápita x Año - GM"); }?></li>
                                    <li id="greenmetric"><?php echo anchor("control_factor_gei/kgcperiodo_elec_gm_5yrs/", "Kg de CO2 Per Cápita x Año - GM I5A"); ?></li>
                                    <li><?php if($_SESSION['sess']['level'] == 1){ echo anchor("control_factor_gei/graf_tarifa_hmgpo", "Tarifa HM x Año"); }?></li>
                                    <li><?php if($_SESSION['sess']['level'] == 1){ echo anchor("control_factor_gei/graf_tarifa_omgpo", "Tarifa OM x Año"); }?></li>
						</li>
                                </ul>
                    </ul>
                    <ul id="planmetric">
                        <li>
                            <b>Métricas</b>
                                <ul>
                                    <li><?php if($_SESSION['sess']['level'] == 1){ echo anchor("consumo_electricidad/metricas/", "Métricas de Electricidad"); }?></li>
                                    <li><?php if($_SESSION['sess']['level'] == 1){ echo anchor("consumo_electricidad/campus_buscar/", "Métricas por Campus"); }?></li>
                                    <li><?php if($_SESSION['sess']['level'] == 1){ echo anchor("consumo_electricidad/metricas_buscar_year/", "Total por Años de kWh y Costo"); }?></li>
									<li><?php if($_SESSION['sess']['level'] == 1){ echo anchor("control_factor_gei/desgloze_total_electricidad", "Desglose Masivo"); }?></li>
                                    <li><?php if($_SESSION['sess']['level'] == 1){ echo anchor("control_factor_gei/tarifahm_meses", "Tarifa HM (GDMTH) Mensual x Año"); }?></li>
                                    <li><?php if($_SESSION['sess']['level'] == 1){ echo anchor("control_factor_gei/tarifaom_meses", "Tarifa OM (GDMTO) Mensual x Año"); }?></li>
									<li><?php if($_SESSION['sess']['level'] == 1){ echo anchor("control_factor_gei/consumoelecxcampusnonGM", "Consumo de Electricidad x Campus DINSU"); }?></li>
									<li id="greenmetric"><?php if($_SESSION['sess']['level'] == 1){ echo anchor("control_factor_gei/consumoelecxcampusGMv2", "Consumo de Electricidad x Campus - GM"); }?></li>
                                    </li>
                                    <li id="greenmetric"><?php echo anchor("control_factor_gei/consumoelecxcampusGM5yrs", "Consumo de Electricidad x Campus - GM I5A"); ?></li>
                                    </li>
                                    <li id="greenmetric"><?php echo anchor("control_factor_gei/conteleccomparacion2", "Consumo Ele. x Dependencias - 1 a 2 años"); ?></li>
                                    </li>
                                    <li id="greenmetric"><?php echo anchor("control_factor_gei/pruebaseseselec", "Prueba Dropdown"); ?></li>
                                    </li>
									<li id="greenmetric"><?php echo anchor("control_factor_gei/inicio_gei_mes_elec", "Gráficas de Consumo Mensual por Año - GM"); ?> </li>
									<li><?php if($_SESSION['sess']['level'] == 1){ echo anchor("control_factor_gei/ctdesglosetotanualelec", "Desglose Comparativo de Electricidad"); }?> </li>
									
                                </ul>
                        </li>
                    </ul>
                </div><!--/.col-sm-4-->
                
                <!--
                
                COLUMNA PARA AGUA

                -->
                
                <div class="col-sm-4 center">
                    <!--a class="big-link" href="<php echo site_url('consumo_agua'); ?>"-->
                    <i class="icon-tint icon-md icon-color3"></i>
                        <h4>Agua</h4>
                    </a>

                    <ul id="planmetric">
                        <li>
                            <b>Recibos</b>
                                <ul>
                                    <li><?php
                                if($_SESSION['sess']['level'] == 1){ echo anchor("consumo_agua/capturar/", "Capturar un recibo"); }
                                ?>

                                    </li>
                                    <li id="wachalosrecibos"><?php echo anchor("consumo_agua/catalogo/", "Ver recibos capturados"); ?>

                                    </li>
                                </ul>
                        </li>
                        <h7><?php if($_SESSION['sess']['level'] == 1){ echo anchor("", "Servicios"); }?></h7>
                                <ul>
                                    <li><?php
                                if($_SESSION['sess']['level'] == 1){ echo anchor("consumo_agua/servicio_registrar/", "Registrar nuevo servicio"); }
                                ?>
                                    </li>
                                    <li><?php if($_SESSION['sess']['level'] == 1){ echo anchor("consumo_agua/servicio_catalogo/", "Catálogo de servicios"); }?></li>
                                </ul>
                        </li>
                    </ul>
                    <ul id="planmetric">
                        <li>
                        <b>Gráficas</b>
                        <ul>
                            <li><?php if($_SESSION['sess']['level'] == 1){ echo anchor("consumo_agua/diagnostico/", "Gráfica de Agua"); }?></li>
							<li id="anualgraf"><?php if($_SESSION['sess']['level'] == 1){ echo anchor("control_factor_gei/graf_nueva_agua_costos", "Gráfica Anual de Costos de Agua"); }?></li>
							<li id="anualgraf"><?php if($_SESSION['sess']['level'] == 1){ echo anchor("control_factor_gei/graf_nueva_agua_consumos", "Gráfica Anual de Consumo de Agua en m3"); }?></li>
                            <li id="greenmetric2"><?php if($_SESSION['sess']['level'] == 1){ echo anchor("control_factor_gei/metrica_gei_agua/", "GEI Agua"); }?></li>
							<li id="greenmetric"><?php if($_SESSION['sess']['level'] == 1){ echo anchor("control_factor_gei/metrica_gei_agua_gm/", "GEI Agua - GM"); }?></li>
                            <li id="greenmetric"><?php echo anchor("control_factor_gei/metrica_gei_agua_gm_5yrs/", "GEI Agua - GM I5A"); ?></li>
                            <li><?php if($_SESSION['sess']['level'] == 1){ echo anchor("control_factor_gei/m3cperiodo_agua/", "m3 Per Cápita x Año"); }?></li>
                            <li id="greenmetric"><?php if($_SESSION['sess']['level'] == 1){ echo anchor("control_factor_gei/m3cperiodo_agua_gm/", "m3 Per Cápita x Año - GM"); }?></li>
                            <li id="greenmetric"><?php echo anchor("control_factor_gei/m3cperiodo_agua_gm_5yrs/", "m3 Per Cápita x Año - GM I5A"); ?></li>
                            <li><?php if($_SESSION['sess']['level'] == 1){ echo anchor("control_factor_gei/wtrkgcperiodo_agua/", "Kg de CO2 Per Cápita x Año"); }?></li>
                            <li id="greenmetric"><?php if($_SESSION['sess']['level'] == 1){ echo anchor("control_factor_gei/wtrkgcperiodo_agua_gm/", "Kg de CO2 Per Cápita x Año - GM"); }?></li>
                            <li id="greenmetric"><?php echo anchor("control_factor_gei/wtrkgcperiodo_agua_gm_5yrs/", "Kg de CO2 Per Cápita x Año - GM I5A"); ?></li>
                            <li><?php if($_SESSION['sess']['level'] == 1){ echo anchor("control_factor_gei/metricas_aguas_mediciones", "Agua Potable y Residual - Solo CU"); }?></li>

                        </ul>
                        </li>
                    </ul>
                    <ul class="plan">

                    </ul>
                    <ul id="planmetric">
                        <li>
                            <b>Métricas</b>
                                <ul>
                                    <li><?php if($_SESSION['sess']['level'] == 1){ echo anchor("consumo_agua/metricas_buscar_year_agua/", "Total por Años"); }?></li>
									<li><?php if($_SESSION['sess']['level'] == 1){ echo anchor("control_factor_gei/desgloze_total_aqua", "Desglose Masivo"); }?></li>
                                    <li><?php if($_SESSION['sess']['level'] == 1){ echo anchor("control_factor_gei/tarifagua_meses", "Consumo m3 Mensual x Año"); }?></li>
									<li><?php if($_SESSION['sess']['level'] == 1){ echo anchor("control_factor_gei/consumoaguaxcampusnonGM", "Consumo de Agua x Campus DINSU"); }?></li>
									<li id="greenmetric"><?php if($_SESSION['sess']['level'] == 1){ echo anchor("control_factor_gei/consumoaguaxcampusGMv2", "Consumo de Agua x Campus - GM"); }?></li>
                                    <li id="greenmetric"><?php echo anchor("control_factor_gei/consumoaguaxcampusGM5yrs", "Consumo de Agua x Campus - GM I5A"); ?></li>
                                    <li id="greenmetric"><?php echo anchor("control_factor_gei/contaguacomparacion", "Consumo Agua x Dependencias - 1 a 2 años"); ?></li>
                                    </li>
									<li id="greenmetric"><?php echo anchor("control_factor_gei/inicio_gei_mes_agua", "Gráficas de Consumo Mensual por Año - GM"); ?> </li>
									<li><?php if($_SESSION['sess']['level'] == 1){ echo anchor("control_factor_gei/ctdesglosetotanualagua", "Desglose Comparativo de Agua"); }?></li>
                                </ul>
                        </li>
                    </ul>
                </div><!--/.col-sm-4-->
                
                <!--

                COLUMNA PARA GAS
                
                -->


                <div class="col-sm-4 center">
                    <!--a class="big-link" href="<php echo site_url('consumo_gas'); ?>"-->
                    <i class="icon-fire icon-md icon-color1"></i>
                        <h4>Gas</h4>
                    </a>
                    <ul id="planmetric">
                        <li>
                            <b>Recibos</b>
                                <ul>
                                    <li><?php
                                if($_SESSION['sess']['level'] == 1){ echo anchor("consumo_gas/capturar/", "Capturar un recibo"); }
                                ?>
                                    </li>
                                    <li id="wachalosrecibos"><?php echo anchor("consumo_gas/catalogo/", "Ver recibos capturados"); ?></li>
                                </ul>
                        </li>
                        <h7><?php if($_SESSION['sess']['level'] == 1){ echo anchor("", "Servicios"); }?></h7>
                                <ul>
                                    <li><?php
                                if($_SESSION['sess']['level'] == 1){ echo anchor("consumo_gas/servicio_registrar/", "Registrar nuevo servicio"); }
                                ?>
                                    </li>
                                    <li><?php if($_SESSION['sess']['level'] == 1){ echo anchor("consumo_gas/servicio_catalogo/", "Catálogo de servicios"); }?></li>
                                </ul>
                        </li>
                    </ul>
                    <ul id="planmetric">
                        <li>
                            <b>Gráficas</b>
                                <ul>
                                    <li><?php if($_SESSION['sess']['level'] == 1){ echo anchor("consumo_gas/diagnostico/", "Gráfica de Gas"); }?></li>
									<li id="anualgraf"><?php if($_SESSION['sess']['level'] == 1){ echo anchor("control_factor_gei/graf_nueva_gas_costos", "Gráfica Anual de Costos de Gas"); }?></li>
                                    <li id="anualgraf"><?php if($_SESSION['sess']['level'] == 1){ echo anchor("control_factor_gei/graf_nueva_gas_consumos", "Gráfica Anual de Consumo de Gas en m3"); }?></li>
                                    <li id="greenmetric2"><?php if($_SESSION['sess']['level'] == 1){ echo anchor("control_factor_gei/metrica_gei_gas/", "GEI Gas"); }?></li>
									<li id="greenmetric"><?php if($_SESSION['sess']['level'] == 1){ echo anchor("control_factor_gei/metrica_gei_gas_gm/", "GEI Gas - GM"); }?></li>
                                    <li id="greenmetric"><?php echo anchor("control_factor_gei/metrica_gei_gas_gm_5yrs/", "GEI Gas - GM I5A"); ?></li>
                                    <li><?php if($_SESSION['sess']['level'] == 1){ echo anchor("control_factor_gei/m3cperiodo_gas/", "m3 Per Cápita x Año"); }?></li>
                                    <li id="greenmetric"><?php if($_SESSION['sess']['level'] == 1){ echo anchor("control_factor_gei/m3cperiodo_gas_gm/", "m3 Per Cápita x Año - GM"); }?></li>
                                    <li id="greenmetric"><?php echo anchor("control_factor_gei/m3cperiodo_gas_gm_5yrs/", "m3 Per Cápita x Año - GM I5A"); ?></li>
                                    <li><?php if($_SESSION['sess']['level'] == 1){ echo anchor("control_factor_gei/gaskgcperiodo_gas/", "Kg de CO2 Per Cápita x Año"); }?></li>
                                    <li id="greenmetric"><?php if($_SESSION['sess']['level'] == 1){ echo anchor("control_factor_gei/gaskgcperiodo_gas_gm/", "Kg de CO2 Per Cápita x Año - GM"); }?></li>
                                    <li id="greenmetric"><?php echo anchor("control_factor_gei/gaskgcperiodo_gas_gm_5yrs/", "Kg de CO2 Per Cápita x Año - GM I5A"); ?></li>
                                </ul>
                        </li>
                    <ul id="plan">
                    <li>
                    <h7><?php if($_SESSION['sess']['level'] == 1){ echo anchor("", "Factor GEI"); }?></h7>
                    </li>
                    <ul>
                    <li>
                    <b><?php if($_SESSION['sess']['level'] == 1){ echo anchor("control_factor_gei/factor_gei/", "Capturar Datos"); }?></b>
                    </li>
                    </ul>
                    </li>
                    </ul>
                        
					<ul id="planmetric">
                        <li>
                            <b>Métricas</b>
                                <ul>
                                    <li><?php if($_SESSION['sess']['level'] == 1){ echo anchor("consumo_gas/metricas_buscar_year_gas/", "Total por Años"); }?></li>
									<li><?php if($_SESSION['sess']['level'] == 1){ echo anchor("control_factor_gei/desgloze_total_vapor", "Desglose Masivo"); }?></li>
                                    <li><?php if($_SESSION['sess']['level'] == 1){ echo anchor("control_factor_gei/tarifgas_meses", "Consumo m3 Mensual x Año"); }?></li>
									<li><?php if($_SESSION['sess']['level'] == 1){ echo anchor("control_factor_gei/consumogaasxcampusnonGM", "Consumo de Gas x Campus DINSU"); }?></li>
									<li id="greenmetric"><?php if($_SESSION['sess']['level'] == 1){ echo anchor("control_factor_gei/consumogaasxcampusGMv2", "Consumo de Gas x Campus - GM"); }?></li>
                                    <li id="greenmetric"><?php echo anchor("control_factor_gei/consumogaasxcampusGM5yrs", "Consumo de Gas x Campus - GM I5A"); ?></li>
                                    <li id="greenmetric"><?php echo anchor("control_factor_gei/contgascomparacion", "Consumo Gas x Dependencias - 1 a 2 años"); ?></li>
                                    </li>
									<li id="greenmetric"><?php echo anchor("control_factor_gei/inicio_gei_mes_gas", "Gráficas de Consumo Mensual por Año - GM"); ?> </li>
									<li><?php if($_SESSION['sess']['level'] == 1){ echo anchor("control_factor_gei/ctdesglosetotanualgas", "Desglose Comparativo de Gas"); }?> </li>
                                </ul>
                        </li>
                    </ul>
                </div><!--/.col-sm-4-->
            </div>
        </div><!--DIV BOX-->
        </div><!--DIV STYLE-->
    </div>
</section><!--/#pricing-->


<section id="contact">
    <div class="container">
        <div class="box last">
            <div class="row">
            <div class="center">
                 <h2>Directorio</h2><br>

                    <div class="col-sm-6">

                        <h4><b>Dr. Santos Guzmán López</b></h4>
                        <h4>Rector</h4><br>

                        <h4><b>Dra. Emilia Edith Vásquez Farías</b></h4>
                        <h4>Secretaria Académica</h4><br>

                        <h4><b>Dr. Mario Alberto González de León</b></h4>
                        <h4>Director General de Tecnologías y Desarrollo Digital</h4><br>

                        <h4><b>Ing. Arturo Cárdenas Garza</b></h4>
                        <h4>Coordinador del Panel de Control</h4><br>

                    </div><!--/.col-sm-6-->
                    <div class="col-sm-6">

                        <h4><b>Dr. Juan Paura García</b></h4>
                        <h4>Secretario General</h4><br>

                        <h4><b>Dr. Sergio Fernández Delgadillo</b></h4>
                        <h4>Secretaría de Sustentabilidad</h4><br>

                        <h4><b>MC Félix González Estrada</b></h4>
                        <h4>Director de Infraestructura para la Sustentabilidad</h4><br>
                    </div><!--/.col-sm-6-->
            </div><!--/.row-->
            </div><!--/.box-->
        </div><!--/.container-->
    </div>
</section><!--/#contact