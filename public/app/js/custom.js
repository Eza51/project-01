
(function ($) {

	//mobile menu
	 jQuery('.main-menu').meanmenu({
		meanScreenWidth: 991
	});

    // StickyHeader
	function stickyHeader() {
		var strickyScrollPos = $('#strickymenu').next().offset().top;
		if ($('#strickymenu').length) {
			if ($(window).scrollTop() > strickyScrollPos) {
				$('#strickymenu').addClass('sticky');
				$('body').addClass('sticky');
			} else if ($(window).scrollTop() <= strickyScrollPos) {
				$('#strickymenu').removeClass('sticky');
				$('body').removeClass('sticky');
			}
		};
	}
	$(window).on('scroll', function () {
		stickyHeader();
	});

	//Business 
	$('.business-carousel').owlCarousel({
		loop: true,
		autoplay: true,
		autoplayHoverPause: true,
		margin: 30,
		nav: true,
		navText: ["<div class='left-arrow'><img src='/app/img/left-arrow.png' alt='arrow'></div>", "<div class='right-arrow'><img src='/app/img/right-arrow.png' alt='arrow'></div>"],
		responsive: {
			0: {
				items: 1
			},
			520: {
				items: 1
			},
			768: {
				items: 2
			},
			1000: {
				items: 2
			},
			1200: {
				items: 3
			}
		}
	});

	//Blog 
	$('.blog-carousel').owlCarousel({
		loop: true,
		autoplay: true,
		autoplayHoverPause: true,
		margin: 30,
		nav: true,
		navText: ["<div class='left-arrow'><img src='/app/img/left-arrow.png' alt='arrow'></div>", "<div class='right-arrow'><img src='/app/img/right-arrow.png' alt='arrow'></div>"],
		responsive: {
			0: {
				items: 1
			},
			520: {
				items: 1
			},
			768: {
				items: 2
			},
			1000: {
				items: 3
			},
			1200: {
				items: 3
			}
		}
	});

	//Single Page
	$('.single-carousel').owlCarousel({
		loop: true,
		autoplay: true,
		autoplayHoverPause: true,
		margin: 15,
		nav: true,
		navText: ["<i class='fa fa-caret-left'></i>", "<i class='fa fa-caret-right'></i>"],
		responsive: {
			0: {
				items: 2
			},
			520: {
				items: 3
			},
			750: {
				items: 4
			},
			1000: {
				items: 4
			}
		}
	});

	//Categoris Page
	$('.popular-carousel').owlCarousel({
		loop: true,
		autoplay: true,
		autoplayHoverPause: true,
		margin: 0,
		nav: true,
		navText: ["<div class='left-arrow'><img src='/app/img/left-arrow.png' alt='arrow'></div>", "<div class='right-arrow'><img src='/app/img/right-arrow.png' alt='arrow'></div>"],
		responsive: {
			0: {
				items: 1
			},
			520: {
				items: 1
			},
			1000: {
				items: 1
			}
		}
	});

	// filter-price
	$("#range-bar").slider({
		range: true,
		min: 5,
		max: 1500,
		values: [240, 960],
		slide: function (event, ui) {
			$("#range-show").html(ui.values[0] + '$' + ' - ' + ui.values[1] + '$');
		}
	});
	$("#range-show").html($("#range-bar").slider('values', 0) + '$' + ' - ' + $("#range-bar").slider('values', 1) + '$');

	// Spinner
	$("#shop_spinner").spinner({
		min: 1
	});

	// ProgressBar
	$('.progress .progress-bar').css("width",
	function() {
		return $(this).attr("aria-valuenow") + "%";
	}
	);

	 //Scroll-Top
	    $(".scroll-top").hide();
	    $(window).scroll(function () {
	        if ($(this).scrollTop() > 300) {
	            $(".scroll-top").fadeIn();
	        } else {
	            $(".scroll-top").fadeOut();
	        }
	    });
	    $(".scroll-top").click(function () {
	        $("html, body").animate({
	            scrollTop: 0,
	        }, 550)
	    });

	$(window).load(function () {
		$('#preloader').fadeOut();
		$('#preloader-status').delay(200).fadeOut('slow');
		$('body').delay(200).css({
			'overflow-x': 'hidden'
		});
	});

})(jQuery);

