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

<?php $this->load->view($body); ?>

<?php $this->load->view("include/foot"); ?>