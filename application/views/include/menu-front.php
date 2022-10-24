<!--Esto hace referencia al menu que se despliega en lo alto de la pantalla-->
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

    <div class="container">
        <div id="navbar" class="navbar navbar-default">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="#main-slider"><i class="icon-home"></i> Inicio</a></li>
                    <li><a href="#pricing">Servicios</a></li>

                    <!--DROPDOWN PARA ELECTRICIDAD-->

                    <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Electricidad<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="consumo_electricidad/capturar/">Crear Recibo</a></li>
                        <li><a href="consumo_electricidad/catalogo/">Ver Recibos</a></li>
                        <li><a href="consumo_electricidad/servicio_registrar">Registrar Nuevo Servicio</a></li>
                        <li><a href="consumo_electricidad/servicio_catalogo/">Catalogo de Servicios</a></li>
                        <li><a href="consumo_electricidad/diagnostico/">Gráficas</a></li>
                        <li><a href="consumo_electricidad/metricas/">Métricas</a></li>
                    </ul>
                    </li>

                    <!--DROPDOWN PARA AGUA-->

                    <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Agua<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="consumo_agua/capturar/">Crear Recibo</a></li>
                        <li><a href="consumo_agua/catalogo/">Ver Recibos</a></li>
                        <li><a href="consumo_agua/servicio_registrar">Registrar Nuevo Servicio</a></li>
                        <li><a href="consumo_agua/servicio_catalogo/">Catalogo de Servicios</a></li>
                        <li><a href="consumo_agua/diagnostico/">Gráficas</a></li>
                    </ul>
                    </li>
                    <!--DROPDOWN PARA GAS-->

                    <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Gas<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="consumo_gas/capturar/">Crear Recibo</a></li>
                        <li><a href="consumo_gas/catalogo/">Ver Recibos</a></li>
                        <li><a href="consumo_gas/servicio_registrar">Registrar Nuevo Servicio</a></li>
                        <li><a href="consumo_gas/servicio_catalogo/">Catalogo de Servicios</a></li>
                        <li><a href="consumo_gas/diagnostico/">Gráficas</a></li>
                        <li><a href="consumo_gas/factor_gei/">Factor GEI</a></li>
                    </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>

</header><!--/#header-->