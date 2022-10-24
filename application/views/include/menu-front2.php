<!--Esto hace referencia al menu que se despliega en lo alto de la pantalla-->
<!--NUEVO-->
<header id="header" class="header-front" role="banner">
    <div id="top-menu">
        <div class="container">
            <div class="nav">
                <ul>
                    <li><span><i class="icon-user"></i> <?php echo $_SESSION['sess']['fullname']; ?></span></li>
                    <li> | <?php echo anchor('logout', '<i class="icon-power-off"></i> Cerrar sesión'); ?></li>
                </ul>
            </div>
        </div>
    </div> <!--/#top-menu-->

<div id="navbar">
    <nav class="navbar navbar-default navbar-static-top static" role="navigation">
        <div class="container-fluid">
        <div class="navbar-header">
        <!--El #navbar-collapse-1, hace referencia con el "smooth scroll" del views/inlcude/main.js-->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
                <a class="navbar-brand" href="#"></a>

        </div>


            <div class="collapse navbar-collapse static" id="navbar-collapse-1">
                <ul class="nav navbar-nav">
                <li class="active"><a href="http://www.paneldecontrol.sds.uanl.mx/"><i class="icon-home"></i> Inicio</a></li>


                        <!--DROP DOWN PARA ELECTRICIDAD-->
                        <li class="dropdown">
                            <a href="#" class="icon-bolt" class="dropdown-toggle static" data-toggle="dropdown">Electricidad<b class="caret"></b></a>

                            <ul class="dropdown-menu">
                            <li><a href="<?php echo site_url('consumo_electricidad/catalogo'); ?>">Ver Recibos</a></li>
                            <li><a href="<?php echo site_url('consumo_electricidad/servicio_catalogo'); ?>">Catalogo de Servicios</a></li>
                            <li><a href="<?php echo site_url('consumo_electricidad/diagnostico'); ?>">Gráficas</a></li>
                            <li><a href="<?php echo site_url('control_factor_gei/metrica_gei_elec'); ?>">Gráfica GEI Electricidad</a></li>
                            <li><a href="<?php echo site_url('control_factor_gei/kwcperiodo_elec'); ?>">kWh GEI Per Cápita por Año</a></li>
                            <li><a href="<?php echo site_url('control_factor_gei/kgcperiodo_elec'); ?>">kg Per Cápita por Año</a></li>
                            <li><a href="<?php echo site_url('control_factor_gei/graf_tarifa_hmgpo'); ?>"> Tarifa HM por Año</a></li>
                            <li><a href="<?php echo site_url('control_factor_gei/graf_tarifa_omgpo'); ?>"> Tarifa OM por Año</a></li>
                            <!---->
                            <li><a href="<?php echo site_url('consumo_electricidad/metricas'); ?>">Métricas</a></li>
                            <li><a href="<?php echo site_url('consumo_electricidad/campus_buscar'); ?>">Métricas de Campus</a></li>
                            <li><a href="<?php echo site_url('consumo_electricidad/metricas_buscar_year'); ?>">Totales por Años</a></li>
                            </ul>
                        </li>


                        <!--DROP DOWN PARA AGUA-->
                        <li class="dropdown">
                            <a href="#" class="icon-tint" class="dropdown-toggle static" data-toggle="dropdown">Agua<b class="caret"></b></a>

                            <ul class="dropdown-menu">
                            <li><a href="<?php echo site_url('consumo_agua/capturar'); ?>">Crear Recibo</a></li>
                            <li><a href="<?php echo site_url('consumo_agua/servicio_catalogo'); ?>">Catalogo de Servicios</a></li>
                            <li><a href="<?php echo site_url('consumo_agua/diagnostico'); ?>">Gráficas</a></li>
                            <li><a href="<?php echo site_url('control_factor_gei/metrica_gei_agua'); ?>">Gráfica GEI Agua</a></li>
                            <li><a href="<?php echo site_url('control_factor_gei/m3cperiodo_agua'); ?>">m3 GEI Per Cápita x Año</a></li>
                            <li><a href="<?php echo site_url('control_factor_gei/wtrkgcperiodo_agua'); ?>">kg Per Cápita x Año</a></li>
                            <li><a href="<?php echo site_url('control_factor_gei/metricas_aguas_mediciones'); ?>">Agua Potable y Residual</a></li>
                            <li><a href="<?php echo site_url('consumo_agua/metricas_buscar_year_agua'); ?>">Métricas: Total por Años</a></li>
                            </ul>
                        </li>


                        <!--DROP DOWN PARA GAS-->
                        <li class="dropdown">
                            <a href="#" class="icon-fire" class="dropdown-toggle static" data-toggle="dropdown">Gas<b class="caret"></b></a>

                            <ul class="dropdown-menu">
                            <li><a href="<?php echo site_url('consumo_gas/catalogo'); ?>">Ver Recibos</a></li>
                            <li><a href="<?php echo site_url('consumo_gas/servicio_catalogo'); ?>">Catalogo de Servicios</a></li>
                            <li><a href="<?php echo site_url('consumo_gas/diagnostico'); ?>">Gráficas</a></li>
                            <li><a href="<?php echo site_url('control_factor_gei/metrica_gei_gas'); ?>">Gráfica GEI Gas</a></li>
                            <li><a href="<?php echo site_url('control_factor_gei/m3cperiodo_gas'); ?>">m3 GEI Per Cápita x Año</a></li>
                            <li><a href="<?php echo site_url('control_factor_gei/gaskgcperiodo_gas'); ?>">kg Per Cápita x Año</a></li>
                            <li><a href="<?php echo site_url('consumo_gas/metricas_buscar_year_gas'); ?>">Métricas: Total por Años</a></li>
                           </ul>
                        </li>
                </ul>
            </div><!-- /.navbar-collapse -->
    </nav>
</div>
</header>