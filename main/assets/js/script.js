$(window).scroll(function() {	
	// Sticky header
	var windowWidth = window.innerWidth || $(window).width();
	header_one = $("header.page-header");
	if (windowWidth >= 992) {
		if ($(".page-wrapper").outerHeight() > $(window).innerHeight() + 300 && $(window).scrollTop() > 200) {
			$(header_one).addClass("boutique-header_sticky");
		} else if ($(window).scrollTop() <= 200) {
			$(header_one).removeClass("boutique-header_sticky");
		}
	}
});
var stickyHide = 0;
if (stickyHide == 1) {
	var scrollPrev = 0;
	setTimeout(function() {
		$(window).scroll(function() {
			header_one = $("header.page-header");
			sticky_header_one = $("header.page-header .header-main");
			var scrolled = $(this).scrollTop(),
				firstScrollUp = false,
				firstScrollDown = false;
			if (scrolled > 0) {
				if (scrolled > scrollPrev) {
					firstScrollUp = false;
					if (scrolled < $(sticky_header_one).height() + $(sticky_header_one).offset().top) {
						if (firstScrollDown === false) {
							$(header_one).addClass('boutique-header_sticky-hide');
							firstScrollDown = true;
						}
					}
				} else {
					firstScrollDown = false;
					if (scrolled > $(sticky_header_one).offset().top) {
						if (firstScrollUp === false) {
							$(header_one).removeClass('boutique-header_sticky-hide');
							firstScrollUp = true;
						}
					}
				}
				scrollPrev = scrolled;
			}
		});
	}, 2500);
}
	
$(document).ready(function () {	
	//smooth scroll to anchor
	$(".scroll").click(function(event){
		event.preventDefault();
		//calculate destination place
		var dest=0;
		if($(this.hash).offset().top > $(document).height()-$(window).height()){
			dest=$(document).height()-$(window).height()-100;
		}else{
			dest=$(this.hash).offset().top-100;
		}
	//go to destination
	$('html,body').animate({scrollTop:dest}, 1000,'swing');
	});
	
	$(".navigation.skynetch-megamenu li.classic .submenu, .navigation.skynetch-megamenu li.staticwidth .submenu, .navigation.skynetch-megamenu li.classic .subchildmenu .subchildmenu").each(function() {
		$(this).css("left", "-9999px");
		$(this).css("right", "auto");
	});
	$("nav.skynetch-megamenu").find("li.classic .subchildmenu > li.parent").mouseover(function() {
		var popup = $(this).children("ul.subchildmenu");
		var w_width = $(window).innerWidth();
		if (popup) {
			var pos = $(this).offset();
			var c_width = $(popup).outerWidth();
			if (w_width <= pos.left + $(this).outerWidth() + c_width) {
				$(popup).css("left", "auto");
				$(popup).css("right", "100%");
			} else {
				$(popup).css("left", "100%");
				$(popup).css("right", "auto");
			}
		}
	});
	$("nav.skynetch-megamenu").find("li.staticwidth.parent").mouseover(function() {
		var popup = $(this).children(".submenu");
		var w_width = $(window).innerWidth();
		if (popup) {
			var pos = $(this).offset();
			var c_width = $(popup).outerWidth();
			if (w_width <= pos.left + $(this).outerWidth() + c_width) {
				var pos_left = w_width - pos.left - $(this).outerWidth() - c_width;
				$(popup).css("left", pos_left + "px");
				$(popup).css("right", "auto");
			} else {
				$(popup).css("left", "0");
				$(popup).css("right", "auto");
			}
		}
	});
	$("nav.skynetch-megamenu").find("li.classic.parent").mouseover(function() {
		var popup = $(this).children(".submenu");
		var w_width = $(window).innerWidth();
		if (popup) {
			var pos = $(this).offset();
			var c_width = $(popup).outerWidth();
			if (w_width <= pos.left + $(this).outerWidth() + c_width) {
				$(popup).css("left", "auto");
				$(popup).css("right", "0");
			} else {
				$(popup).css("left", "0");
				$(popup).css("right", "auto");
			}
		}
	});
	$(window).resize(function() {
		$(".navigation.skynetch-megamenu li.classic .submenu, .navigation.skynetch-megamenu li.staticwidth .submenu, .navigation.skynetch-megamenu li.classic .subchildmenu .subchildmenu").each(function() {
			$(this).css("left", "-9999px");
			$(this).css("right", "auto");
		});
	});
	$(".nav-toggle").off('click').on('click', function(e) {
		if (!$("html").hasClass("nav-open")) {
			$("html").addClass("nav-before-open");
			setTimeout(function() {
				$("html").addClass("nav-open");
			}, 300);
		}
		else {
			$("html").removeClass("nav-open");
			setTimeout(function() {
				$("html").removeClass("nav-before-open");
			}, 300);
		}
	});
	$("li.ui-menu-item > .open-children-toggle").off("click").on("click", function() {
		if (!$(this).parent().children(".submenu").hasClass("opened")) {
			$(this).parent().children(".submenu").addClass("opened");
			$(this).parent().children("a").addClass("ui-state-active");
		}
		else {
			$(this).parent().children(".submenu").removeClass("opened");
			$(this).parent().children("a").removeClass("ui-state-active");
		}
	});
	
	// Toggle menu - Product Category
	$('.js-toggle-filter').click(function() {
		this_id = $(this).attr('id');
		$(this).closest('.fa').hide();
		$('.js-pop-filter').toggle(function() {
			$(this).animate({}, 300);
		});
		// $('.js-pop-filterblock[data-filter-level="'+this_id+'"]').addClass('active');
	});
	
	$('.product-slick').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        fade: true,
        asNavFor: '.slider-nav'
    });
    $('.slider-nav').slick({
        vertical: false,
        slidesToShow: 5,
        slidesToScroll: 1,
        asNavFor: '.product-slick',
        arrows: false,
        dots: false,
        focusOnSelect: true,
		responsive: [
			{
			breakpoint: 600,
				settings: {
					slidesToShow: 4,
					slidesToScroll: 1,
					infinite: true,
					dots: true
				}
			},
		],
    });
	$('.slide-6').slick({
        dots: false,
		autoplay: true,
		autoplaySpeed: 3000,
		arrows: true,
		infinite: false,
		speed: 300,
		slidesToShow: 5,
		slidesToScroll: 1,
		responsive: [
			{
			breakpoint: 1024,
				settings: {
					slidesToShow: 4,
					slidesToScroll: 1,
					infinite: true,
					dots: true
				}
			},
			{
			breakpoint: 600,
				settings: {
					slidesToShow: 3,
					slidesToScroll: 1
				}
			},
			{
			breakpoint: 480,
				settings: {
					slidesToShow: 2,
					slidesToScroll: 1,
					arrows: false,
				}
			}
			// You can unslick at a given breakpoint now by adding:
			// settings: "unslick"
			// instead of a settings object
		]
    });
});