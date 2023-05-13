/**
 * File custom.js.
 *
 * Theme custom enhancements for a better user experience.
 *
 * Contains handlers to make Theme custom preview reload changes asynchronously.
 */

(function (jQuery) {
	"use strict";

	/*---------------------------------------------------------------------
		   Scroll
	-----------------------------------------------------------------------*/

	var position = jQuery(window).scrollTop();
	jQuery(window).scroll(function () {
		// -----sticky menu
		if (jQuery('.has-sticky').length > 0) {
			var scroll = jQuery(window).scrollTop();
			if (scroll < position) {
				jQuery('.has-sticky').addClass('header-up');
				jQuery('body').addClass('header--is-sticky');
				jQuery('.has-sticky').removeClass('header-down');
			} else {
				jQuery('.has-sticky').addClass('header-down');
				jQuery('.has-sticky').removeClass('header-up ');
				jQuery('body').removeClass('header--is-sticky');
			}
			if (scroll == 0) {
				jQuery('.has-sticky').removeClass('header-up');
				jQuery('.has-sticky').removeClass('header-down');
				jQuery('body').removeClass('header--is-sticky');
			}
			position = scroll;
		}
		//back-to top
		if (jQuery(this).scrollTop() > 250) {
			jQuery('#back-to-top').fadeIn(1400);
			jQuery('#back-to-top .top').css("opacity", "1");
		} else {
			jQuery('#back-to-top').fadeOut(400);
			jQuery('#back-to-top .top').css("opacity", "0");
		}
	});


	jQuery(".navbar-toggler").click(function () {
		if (jQuery(window).width() < 1200) {
			jQuery('body').toggleClass('overflow-hidden');
		}
	});

	jQuery(window).on('resize', function () {
		if (jQuery(window).width() > 1200) {
			if (jQuery('body').hasClass('overflow-hidden')) {
				jQuery('body').removeClass('overflow-hidden');
			}
		} else {
			if (jQuery('.navbar-toggler').hasClass('moblie-menu-active')) {
				jQuery('body').addClass('overflow-hidden');
			}
		}
	});

	jQuery(window).on('load', function (e) {

		/*------------------------
		Page Loader
		--------------------------*/
		jQuery("#load").fadeOut();
		jQuery("#loading").delay(0).fadeOut("slow");


		// scroll body to 0px on click
		jQuery('#top').on('click', function (e) {
			jQuery('body,html').animate({
				scrollTop: 0
			}, 800);
			return false;
		});

		/*---------------------------
		Vertical Menu
		---------------------------*/
		getDefaultMenu();

		/*------------------------
		 main menu toggle
		--------------------------*/
		jQuery(document).on("click", '.custom-toggler', function () {
			if (jQuery('.ealain-mobile-menu ').hasClass('menu-open')) {
				jQuery('.ealain-mobile-menu ').toggleClass('open-delay');
				setTimeout(function () {
					jQuery('.ealain-mobile-menu ').toggleClass('menu-open');
					jQuery('.ealain-mobile-menu ').toggleClass('open-delay');
				}, 1000);
			} else {
				jQuery('.ealain-mobile-menu ').toggleClass('menu-open');
			}
			jQuery('.opn-menu').toggleClass('ealain-open');
		});

		jQuery(document).on("click", '.ham-toggle', function () {
			jQuery('.ham-toggle .menu-btn').toggleClass('is-active');
		});
		jQuery(document).on("click", '.mob-toggle', function () {
			jQuery('body').toggleClass('overflow-hidden');
		});

		/*------------------------
				Wow Animation
		--------------------------*/

		var wow = new WOW({
			boxClass: 'wow',
			animateClass: 'animated',
			offset: 0,
			mobile: true,
			live: true
		});
		wow.init();

	});


	jQuery(document).ready(function () {

		/*------------------------
				superfish menu
		--------------------------*/
		jQuery('ul.sf-menu').superfish({
			delay: 500,
			onBeforeShow: function (ul) {
				var elem = jQuery(this);
				var elem_offset = 0,
					elem_width = 0,
					ul_width = 0;

				if (elem.length == 1) {
					var page_width = jQuery('#page.site').width(),
						elem_offset = elem.parents('li').eq(0).offset().left,
						elem_width = elem.parents('li').eq(0).outerWidth(),
						ul_width = elem.outerWidth();

					if (elem.hasClass('iqonic-megamenu-container')) {
						if (elem.hasClass('iqonic-full-width')) {
							jQuery('.iqonic-megamenu-container.iqonic-full-width').css({
								'left': -elem_offset,
							});
						}
						if (elem.hasClass('iqonic-container-width')) {
							let containerOffset = (elem.closest('.elementor-container').length > 0) ? elem.closest('.elementor-container').offset() : elem.parents('li').eq(0).closest('header .container-fluid nav,header .container nav').offset();
							jQuery('.iqonic-megamenu-container.iqonic-container-width').css({
								'left': -(elem_offset - containerOffset.left)
							});
						}
					}
					if (elem_offset + elem_width + ul_width > page_width - 20 && elem_offset - ul_width > 0) {
						elem.addClass('open-submenu-main');
						elem.css({
							'left': 'auto',
							'right': '0'
						});
					} else {
						elem.removeClass('open-submenu-main');
						elem.css({});
					}
				}
				if (elem.parents("ul").length > 1) {
					var page_width = jQuery('#page.site').width();
					elem_offset = elem.parents("ul").eq(0).offset().left;
					elem_width = elem.parents("ul").eq(0).outerWidth();
					ul_width = elem.outerWidth();

					if (elem_offset + elem_width + ul_width > page_width - 20 && elem_offset - ul_width > 0) {
						elem.addClass('open-submenu-left');
						elem.css({
							'left': 'auto',
							'right': '100%'
						});
					} else {
						elem.removeClass('open-submenu-left');
					}
				}
			},
		});

		/*------------------------
			Search Bar
		--------------------------*/
		if (jQuery(".btn-search").length > 0) {
			jQuery(document).on('click', '.btn-search', function () {
				jQuery(this).parent().find('.ealain-search').toggleClass('search--open');
			});
			jQuery(document).on('click', '.btn-search-close', function () {
				jQuery(this).closest('.ealain-search').toggleClass('search--open');
			});
		}

		jQuery(".navbar-toggler").click(function () {
			if (jQuery(window).width() < 1200) {
				jQuery('body').toggleClass('overflow-hidden');
			}
		});

		/*-----------------------------------------------------------------------
								Select2 
		-------------------------------------------------------------------------*/
		if (jQuery('select').length > 0) {
			jQuery('select').each(function () {

				jQuery(this).select2({
					width: '100%',
					dropdownParent: jQuery(this).parent()
				});
			});
			jQuery('.select2-container').addClass('wide');
		}


		// shop sidebar toggle button
		if (jQuery('.shop-filter-sidebar').length > 0) {
			jQuery(document).on('click', '.shop-filter-sidebar', function () {
				jQuery('body').find('.ealain-woo-sidebar').toggleClass('woo-sidebar-open');
			});
		}

		/*------------------------
		Add to cart with plus minus
		--------------------------*/
		jQuery(document).on('click', 'button.plus, button.minus', function () {

			jQuery('button[name="update_cart"]').removeAttr('disabled');

			var qty = jQuery(this).closest('.quantity').find('.qty');

			if (qty.val() == '') {
				qty.val(0);
			}
			var val = parseFloat(qty.val());
			var max = parseFloat(qty.attr('max'));
			var min = parseFloat(qty.attr('min'));
			var step = parseFloat(qty.attr('step'));

			// Change the value if plus or minus
			if (jQuery(this).is('.plus')) {
				if (max && (max <= val)) {
					qty.val(max);
				} else {
					qty.val(val + step);
				}
			} else {
				if (min && (min >= val)) {

					qty.val(min);
				} else if (val >= 1) {

					qty.val(val - step);
				}
			}
			set_quanity(jQuery(this));
		});


		if (jQuery(document).find('.dropdown-hover').length > 0) {
			jQuery(document).on('click', ".dropdown-hover a.dropdown-cart", function () {
				jQuery(".dropdown-menu-mini-cart").addClass('cart-show');
			});
			jQuery(document).on('click', ".dropdown-close", function () {
				jQuery(".dropdown-menu-mini-cart").removeClass('cart-show');
			});
			jQuery('body').mouseup(function (e) {
				if (jQuery(e.target).parents('.dropdown-menu-mini-cart').length === 0) {
					jQuery(".dropdown-menu-mini-cart").removeClass('cart-show');
				}
			});
		
		}
		if (jQuery(document).find('.header-user-rights').length > 0) {
			jQuery(".ealain-users-settings .header-user-rights").hover(function () {
				var isHovered = jQuery(this).is(":hover");
				if (isHovered) {
					jQuery(this).find(".ealain-sub-dropdown").stop().fadeIn(300);
				} else {
					jQuery(this).find(".ealain-sub-dropdown").stop().fadeOut(300);
				} 
			});
		}
	});

}(jQuery));

function getDefaultMenu() {

	if (jQuery('.menu-style-one.ealain-mobile-menu').length > 0) {
		jQuery('.menu-style-one nav.mobile-menu .sub-menu').css('display', 'none ');
		jQuery('.menu-style-one nav.mobile-menu .top-menu li .dropdown').hide();
		jQuery('.menu-style-one nav.mobile-menu .sub-menu').prev().prev().addClass('submenu');
		jQuery('.menu-style-one nav.mobile-menu .sub-menu').before('<span class="toggledrop"><i class="fas fa-chevron-right"></i></span>');

		jQuery('nav.mobile-menu .widget i,nav.mobile-menu .top-menu i').on('click', function () {
			jQuery(this).next('.children, .sub-menu').slideToggle();
		});
		jQuery('.menu-style-one nav.mobile-menu .top-menu .menu-item .toggledrop').off('click');
		jQuery('.menu-style-one nav.mobile-menu .menu-item .toggledrop').on('click', function () {
			if (jQuery(this).closest(".menu-is--open").length == 0) {
				jQuery('.menu-style-one nav.mobile-menu .menu-item').removeClass('menu-is--open');
			}
			if (jQuery(this).parent().find("ul").length > 1) {
				jQuery(this).parent().addClass('menu-is--open');
			}
			jQuery('.menu-style-one nav.mobile-menu .menu-item:not(.menu-is--open) .children,.menu-style-one nav.mobile-menu .menu-item:not(.menu-is--open) .sub-menu').slideUp();
			if (!jQuery(this).next('.children, .sub-menu').is(':visible') || jQuery(this).parent().hasClass("menu-is--open")) {
				jQuery(this).next('.children, .sub-menu').slideToggle();
			}
			jQuery('.menu-style-one nav.mobile-menu .menu-item:not(.menu-is--open) .toggledrop').not(jQuery(this)).removeClass('active');

			jQuery(this).toggleClass('active');

			jQuery('.menu-style-one nav.mobile-menu .menu-item').removeClass('menu-clicked');
			jQuery(this).parent().addClass('menu-clicked');

			jQuery('.menu-style-one nav.mobile-menu .menu-item').removeClass('current-menu-ancestor');
		});
	}
}

// Wocomerce Set Quantiy Input 
function set_quanity(this_) {
    if (!this_.hasClass('qty')) {
        this_ = this_.siblings('input.qty');
    }
    let current = this_.attr('name');

    let item_hash = current ? current.replace(/cart\[([\w]+)\]\[qty\]/g, "$1") : false;
    if (!item_hash)
        return

    let item_quantity = this_.val();
    let currentVal = parseFloat(item_quantity);

    jQuery.ajax({
        type: 'POST',
        url: iqonic_loadmore_params.ajaxurl,
        data: {
            action: 'qty_cart',
            hash: item_hash,
            quantity: currentVal
        },
        success: function (res) {
            jQuery(document.body).trigger('wc_fragment_refresh');
            jQuery('.ealain-cart-count').html(res['data']['quantity'])
        }
    });
}
