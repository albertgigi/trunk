jQuery(function($) {

	$(function(){
		$('#main-slider.carousel').carousel({
			interval: 10000,
			pause: false
		});
	});

	//Ajax contact
	var form = $('.contact-form');
	form.submit(function () {
		$this = $(this);
		$.post($(this).attr('action'), function(data) {
			$this.prev().text(data.message).fadeIn().delay(3000).fadeOut();
		},'json');
		return false;
	});


	$('.navbar-nav > li').click(function(event) {
    if($(this).parent().parent().is("#navbar-collapse-1")) return;
    event.preventDefault();
    var target = $(this).find('>a').prop('hash');
    $('html, body').animate({
        scrollTop: $(target).offset().top // COSA
    }, 500);
	});

	//scrollspy
	$('[data-spy="scroll"]').each(function () {
		var $spy = $(this).scrollspy('refresh')
	})

	//PrettyPhoto
	$("a.preview").prettyPhoto({
		social_tools: false
	});

	//Isotope
	$(window).load(function(){
		$portfolio = $('.portfolio-items');
		$portfolio.isotope({
			itemSelector : 'li',
			layoutMode : 'fitRows'
		});
		$portfolio_selectors = $('.portfolio-filter >li>a');
		$portfolio_selectors.on('click', function(){
			$portfolio_selectors.removeClass('active');
			$(this).addClass('active');
			var selector = $(this).attr('data-filter');
			$portfolio.isotope({ filter: selector });
			return false;
		});
	});




	/* V: */
	/* Datepicker */
	if($('.date').length>0) {
		$('.date').datepicker({
			dateFormat: "yy-mm-dd"
		});
    }
	/* Delete link */
	if($('a.delete').length>0) {
		$('a.delete').click(function() {
			var liga = $(this).attr('href');
			var fila = $(this).parents('tr');
			var respuesta = confirm("Confirma que deseas eliminar este registro.");
			if(respuesta) {
				$.ajax({
					url: liga,
					success: function() {
						fila.fadeOut('1000', function() {
							fila.remove();
						});
					}
				});
			}
			return false;
		});
    }
    /* Info link */
    if($('a.view').length>0) {
        $('a.view').click(function(e) {
            e.stopPropagation();
            var liga = $(this).attr('href');
            $.ajax({
                type: "GET",
                url: liga,
                dataType: "html",
                data: { ajax: 1 },
                success: function(result) {
                  $('.view').avgrund({
                      openOnEvent: false,
                      showClose: true,
                      enableStackAnimation: true,
                      onBlurContainer: '.blur',
                      width: 480,
                      height: '100%',
                      template: result
                  });
                }
            });
            return false;
        });
    }
});