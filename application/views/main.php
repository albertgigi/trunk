<!--ESTE ARCHIVO ES PARA MODIFICAR EL ANCHO Y LARGO DEL CUADRO DE COLOR BLANCO DE TODAS LAS VISTAS-->
<?php $this->load->view("include/head"); ?>
<?php if(isset($_SESSION['sess'])): ?>
<?php $this->load->view("include/menu-front2"); ?>
<?php endif; ?>

<section id="main-slider" class="carousel">
    <div class="carousel-inner">
        <div class="item active">
            <div class="container">
                <div class="carousel-content">
                    <h1><img src="<?php echo base_url(); ?>assets/img/logo-panel.png"></h1>
                    <!--<p class="lead"></p>-->
                </div>
            </div>
        </div><!--/.item-->
        <div class="item">
            <div class="container">
                <div class="carousel-content">
                    <h1><img src="<?php echo base_url(); ?>assets/img/logo-uanl.png">
                    <img src="<?php echo base_url(); ?>assets/img/logo-vision.png">
                    </h1>
                    <!--<p class="lead"></p>-->
                </div>
            </div>
        </div><!--/.item-->
    </div><!--/.carousel-inner-->
    <a class="prev" href="#main-slider" data-slide="prev"><i class="icon-angle-left"></i></a>
    <a class="next" href="#main-slider" data-slide="next"><i class="icon-angle-right"></i></a>
</section><!--/#main-slider-->

<section id="body">
	<div class="container">
	<div style="display: grid; justify-content: auto;"> <!--SOLUCION PARA AUTO AJUSTAR EL CONTENIDO DEL BODY EN LAS VISTAS-->
		<div class="box first">
			<div class="row">
                <div class="center">
                <!-- Título de la página -->
                <?php if(isset($title)): ?>
                    <h2 class="title"><?php echo $title; ?></h2>
                <?php endif; ?>
                <!-- Subtítulo de la página -->
                <?php if(isset($subtitle)): ?>
                    <h1 class="subtitle"><?php echo $subtitle; ?></h1>
                <?php endif; ?>
                </div><!--/.center-->
                <?php $this->load->view($body); ?>
			</div> <!-- row -->
		</div> <!-- box -->
	</div> <!-- container -->
</section>

<section id="contact">
    <div class="container">
	<div style="display: none;"> <!--SOLUCION PARA AUTO AJUSTAR EL CONTENIDO DEL BODY EN LAS VISTAS-->
        <div class="box last">
            <div class="row">
            <?php if(isset($lower)): ?>
                <?php $this->load->view($lower); ?>
            <?php else: ?>
                <?php $this->load->view("include/lower"); ?>
            <?php endif; ?>
            </div><!--/.row-->
        </div><!--/.box-->
		</div>
    </div><!--/.container-->
</section><!--/#contact-->

<?php $this->load->view("include/foot"); ?>

<!--?php $this->load->view("include/menu"); ?-->
<!--ESTE ARCHIVO ES PARA MODIFICAR EL ANCHO Y LARGO DEL CUADRO DE COLOR BLANCO DE TODAS LAS VISTAS-->