(function (jQuery) {

	jQuery(document).ready(function () {

		let ealain_options = jQuery('.ealain_datapass').data('options');
		let ealain_options_blog = jQuery('.ealain_datapass_blog').data('options');
		let ealain_option_achive = jQuery('.watchlist-contens').data('options');



		if (ealain_options == "load_more") {
			jQuery('.ealain_loadmore_btn').click(function () {
				let button_load = jQuery(this).attr('data-loading-text');
				let button_text = jQuery(this).text();
				let button = jQuery(this),
					data = {
						'action': 'loadmore',
						'query': ealain_loadmore_params.posts, // that's how we get params from wp_localize_script() function
						'page': ealain_loadmore_params.current_page
					};
				jQuery.ajax({ // you can also use jQuery.post here
					url: ealain_loadmore_params.ajaxurl, // AJAX handler
					data: data,
					type: 'POST',
					beforeSend: function (xhr) {
						button.text(button_load); // change the button text, you can also add a preloader image
					},
					success: function (data) {
						if (data) {
							button.text(button_text).prev('div').append(data); // insert new posts
							ealain_loadmore_params.current_page++;

							if (ealain_loadmore_params.current_page == ealain_loadmore_params.max_page)
								button.remove(); // if last page, remove the button

						} else {
							button.remove(); // if no data, remove the button as well
						}
					}
				});
			});
		}
		if (ealain_options_blog == "load_more") {
			//** blog load more *//
			jQuery('.ealain_loadmore_btn_blog').click(function () {
				let button_load = jQuery(this).attr('data-loading-text');
				let button_text = jQuery(this).text();
				let button = jQuery(this),
					data = {
						'action': 'loadmore_blog',
						'query': ealain_loadmore_params.posts, // that's how we get params from wp_localize_script() function
						'page': ealain_loadmore_params.current_page
					};

				jQuery.ajax({ // you can also use jQuery.post here
					url: ealain_loadmore_params.ajaxurl, // AJAX handler
					data: data,
					type: 'POST',
					beforeSend: function (xhr) {
						button.text(button_load); // change the button text, you can also add a preloader image
					},
					success: function (data) {
						if (data) {
							button.text(button_text).prev().after(data); // insert new posts
							ealain_loadmore_params.current_page++;

							if (ealain_loadmore_params.current_page == ealain_loadmore_params.max_page)
								button.remove(); // if last page, remove the button

						} else {
							button.remove(); // if no data, remove the button as well
						}
					}
				});
			});

		}

		if (ealain_option_achive == "load_more") {
			jQuery('.ealain_loadmore_btn').click(function () {
				let button_load = jQuery(this).attr('data-loading-text');
				let button_text = jQuery(this).text();
				let max_page = jQuery('.watchlist-contens').data('pages');
				let button = jQuery(this),
					data = {
						'action': 'loadmore_archive',
						'query': ealain_loadmore_params.posts, // that's how we get params from wp_localize_script() function
						'page': ealain_loadmore_params.current_page,
						'availablepost': jQuery('.watchlist-contens').data('displaypost'),
					};
				jQuery.ajax({ // you can also use jQuery.post here
					url: ealain_loadmore_params.ajaxurl, // AJAX handler
					data: data,
					type: 'POST',
					beforeSend: function (xhr) {
						button.text(button_load); // change the button text, you can also add a preloader image
					},
					success: function (data) {
						if (data) {
							button.text(button_text).prev('div').append(data); // insert new posts
							watchlist_last_item();
							circle_chart();
							ealain_loadmore_params.current_page++;

							if (ealain_loadmore_params.current_page == max_page)
								button.remove(); // if last page, remove the button

						} else {
							button.remove(); // if no data, remove the button as well
						}
					}
				});
			});
		}


	});

	jQuery(function (jQuery) {

		let canBeLoaded = true,
			bottomOffset = 2000; // the distance (in px) from the page bottom when you want to load more posts

		let ealain_options = jQuery('.ealain_datapass').data('options');
		let ealain_options_blog = jQuery('.ealain_datapass_blog').data('options');
		let ealain_option_archive = jQuery('.ealain_datapass_archive').data('options')
		let ealain_option_product = jQuery('.ealain-product-main-list').data('options');
		if (ealain_options == "infinite_scroll") {

			jQuery(window).scroll(function () {
				let data = {
					'action': 'loadmore',
					'query': ealain_loadmore_params.posts,
					'page': ealain_loadmore_params.current_page
				};

				if (jQuery(document).scrollTop() > (jQuery(document).height() - bottomOffset) && canBeLoaded == true) {

					jQuery.ajax({
						url: ealain_loadmore_params.ajaxurl,
						data: data,
						type: 'POST',
						beforeSend: function (xhr) {
							canBeLoaded = false;
						},
						success: function (data) {
							if (data) {
								jQuery(".loader-wheel-container").html('<div class="loader-wheel"><i><i><i><i><i><i><i><i><i><i><i><i></i></i></i></i></i></i></i></i></i></i></i></i></div>');
								jQuery('#main').find('article:last-of-type').after(data); // where to insert posts
								canBeLoaded = true; // the ajax is completed, now we can run it again
								ealain_loadmore_params.current_page++;

								if (ealain_loadmore_params.current_page == ealain_loadmore_params.max_page) {
									jQuery(".loader-wheel-container").html('');
								}
							} else {
								jQuery(".loader-wheel-container").html('');
							}

						}
					});
				}


			});

		}
		if (ealain_options_blog == "infinite_scroll") {
			jQuery(window).scroll(function () {

				//** search load more *//
				let data = {
					'action': 'loadmore_blog',
					'query': ealain_loadmore_params.posts,
					'page': ealain_loadmore_params.current_page
				};

				if (jQuery(document).scrollTop() > (jQuery(document).height() - bottomOffset) && canBeLoaded == true) {

					jQuery.ajax({
						url: ealain_loadmore_params.ajaxurl,
						data: data,
						type: 'POST',
						beforeSend: function (xhr) {
							canBeLoaded = false;
						},
						success: function (data) {
							if (data) {
								jQuery(".loader-wheel-container").html('<div class="loader-wheel"><i><i><i><i><i><i><i><i><i><i><i><i></i></i></i></i></i></i></i></i></i></i></i></i></div>');
								jQuery('#main').find('.ealain-blog-main-list .loader-wheel-container').before(data); // where to insert posts
								canBeLoaded = true; // the ajax is completed, now we can run it again
								ealain_loadmore_params.current_page++;
								if (ealain_loadmore_params.current_page == ealain_loadmore_params.max_page) {
									jQuery(".loader-wheel-container").html('');
								}
							} else {
								jQuery(".loader-wheel-container").html('');
							}

						}
					});
				}


			});
		}
		//For Archive page 
		if (ealain_option_archive == "infinite_scroll") {
			jQuery(window).scroll(function () {

				//** search load more *//

				let max_page = jQuery('.watchlist-contens').data('pages');
				let loader_wheel = jQuery('.loader-wheel-container');
				let button = jQuery(this),
					data = {
						'action': 'loadmore_archive',
						'query': ealain_loadmore_params.posts, // that's how we get params from wp_localize_script() function
						'page': ealain_loadmore_params.current_page,
						'availablepost': jQuery('.watchlist-contens').data('displaypost'),
					};

				if (jQuery(document).scrollTop() > (jQuery(document).height() - bottomOffset) && canBeLoaded == true) {
					jQuery.ajax({ // you can also use jQuery.post here
						url: ealain_loadmore_params.ajaxurl, // AJAX handler
						data: data,
						type: 'POST',
						beforeSend: function (xhr) {
							canBeLoaded = false;
						},
						success: function (data) {
							if (data) {
								jQuery(".loader-wheel-container").html('<div class="loader-wheel"><i><i><i><i><i><i><i><i><i><i><i><i></i></i></i></i></i></i></i></i></i></i></i></i></div>');
								loader_wheel.prev('div').append(data); // insert new posts
								watchlist_last_item();
								circle_chart();
								ealain_loadmore_params.current_page++;
								canBeLoaded = true; // the ajax is completed, now we can run it again

								if (ealain_loadmore_params.current_page == max_page)
									jQuery(".loader-wheel-container").html(''); // if last page, remove the button

							} else {
								jQuery(".loader-wheel-container").html(''); // if last page, remove the button
							}
						}
					});
				}


			});
		}

		//** Cast infinite scroll**//
		if (jQuery("#cast-person-list").length > 0) {
			jQuery("#cast-person-list").scroll(function () {
				let _this = jQuery(this);
				let ealain_options_person_all = _this.find('.ealain_cast_list.active').data('options');
				if (ealain_options_person_all == 'infinite_scroll') {
					//** person load more *//
					if (jQuery(document).scrollTop() > (jQuery(document).height() - bottomOffset) && canBeLoaded == true) {
						canBeLoaded = false;
						let ealain_current_page = parseInt(_this.find('.ealain_cast_list.active').data('current-page'));
						let post = _this.find('.ealain_cast_list.active').attr('data-attibute');
						let url = window.location.href;
						let data = {
							'action': 'loadmore_person',
							'query': ealain_loadmore_params.posts,
							'page': ealain_current_page,
							'href': url,
							'post_type': post,
						};
						ealain_current_page++;
						_this.find('.ealain_cast_list.active').data('current-page', ealain_current_page);
						jQuery.ajax({
							url: ealain_loadmore_params.ajaxurl,
							data: data,
							type: 'POST',
							success: function (data) {
								if (data) {
									_this.find('.ealain_cast_list.active .loader-wheel-container').html('<div class="loader-wheel"><i><i><i><i><i><i><i><i><i><i><i><i></i></i></i></i></i></i></i></i></i></i></i></i></div>');
									_this.find('.ealain_cast_list.active .cast-related-list tr:last-child').after(data); // where to insert posts
									canBeLoaded = true; // the ajax is completed, now we can run it again

								} else {
									_this.find('.ealain_cast_list.active .loader-wheel-container').html('');
								}

							}
						});
					}

				}
			});
		}


	});


})(jQuery);

