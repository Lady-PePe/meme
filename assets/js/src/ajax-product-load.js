(function (jQuery) {
    loadmore_product();
})(jQuery);
function loadmore_product(ealain_option_product=jQuery('.ealain-product-main-list').data('options')) {
    let canBeLoaded = true,
        bottomOffset = 2000; // the distance (in px) from the page bottom when you want to load more posts
    if (ealain_option_product == 'load_more') {
        jQuery('.ealain_loadmore_product').unbind('click').click(function () {
            let button_load = jQuery(this).attr('data-loading-text');
            let button_text = jQuery(this).attr('data-text');
            let button = jQuery(this).parent(),
                data = {
                    'action': 'loadmore_product',
                    'query': ealain_loadmore_params.posts, // that's how we get params from wp_localize_script() function
                    'page': ealain_loadmore_params.current_page,
                    'is_grid': jQuery('.ealain-product-view-buttons').find('.btn.active').hasClass('ealain-view-grid')
                };
            jQuery.ajax({ // you can also use jQuery.post here
                url: ealain_loadmore_params.ajaxurl, // AJAX handler
                data: data,
                type: 'POST',
                beforeSend: function (xhr) {
                    button.find('.text-btn').text(button_load); // change the button text, you can also add a preloader image
                },
                success: function (data) {
                    if (data) {
                        button.find('.text-btn').text(button_text);
                        data = jQuery(data).each((item, val) => jQuery(val).addClass('wow ealain-image-effect'));
                        button.prev('div').append(data); // insert new posts
                        ealain_loadmore_params.current_page++;
                        
                        update_product_count();
                        jQuery('.ealain-product-main-list').attr('data-pagedno', ealain_loadmore_params.current_page);

                        if (ealain_loadmore_params.current_page >= ealain_loadmore_params.max_page)
                            button.remove(); // if last page, remove the button

                    } else {
                        button.remove(); // if no data, remove the button as well
                    }
                }
            });
        });
    }

    if (ealain_option_product == 'infinite_scroll') {
        jQuery(window).unbind('scroll').scroll(function () {

            //** search load more *//
            if (jQuery(document).scrollTop() > (jQuery(document).height() - bottomOffset) && canBeLoaded == true) {
                canBeLoaded = false;
                let data = {
                    'action': 'loadmore_product',
                    'query': ealain_loadmore_params.posts, // that's how we get params from wp_localize_script() function
                    'page': ealain_loadmore_params.current_page,
                    'is_grid': jQuery('.ealain-product-view-buttons').find('.btn.active').hasClass('ealain-view-grid')
                };

                jQuery.ajax({ // you can also use jQuery.post here
                    url: ealain_loadmore_params.ajaxurl, // AJAX handler
                    data: data,
                    type: 'POST',
                    beforeSend: function (xhr) {
                    },
                    success: function (data) {
                        if (data) {
                            jQuery(".loader-wheel-container").html('<div class="loader-wheel"><i><i><i><i><i><i><i><i><i><i><i><i></i></i></i></i></i></i></i></i></i></i></i></i></div>');
                            data = jQuery(data).each((item, val) => jQuery(val).addClass('wow ealain-image-effect'));
                            jQuery('.ealain-product-main-list').find('.products').append(data);
                            update_product_count();
                            ealain_loadmore_params.current_page++;
                            canBeLoaded = true; // the ajax is completed, now we can run it again
                            jQuery('.ealain-product-main-list').attr('data-pagedno', ealain_loadmore_params.current_page);

                            if (ealain_loadmore_params.current_page >= ealain_loadmore_params.max_page)
                                jQuery(".loader-wheel-container").html('');
                        }
                        else {
                            jQuery(".loader-wheel-container").html('');
                        }
                    }
                });
            }
        });

    }
}

function update_product_count(result_count_element = jQuery('.woocommerce-result-count'), per_paged = jQuery('.woocommerce-result-count').data('product-per-page')) {
    let text = result_count_element.text();
    let content_text_arr = text.trim().split(' ');
    let count_arr = content_text_arr[1].split('–');

    count_arr[1] = Number(count_arr[1]) + Number(per_paged);
    if (count_arr[1] > content_text_arr[3]) {
        count_arr[1] = content_text_arr[3];
    }
    content_text_arr[1] = count_arr.join('–')
    result_count_element.html(content_text_arr.join(' '));
}
