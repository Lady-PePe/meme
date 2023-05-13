<?php

/**
 * Template part for displaying the header
 *
 * @package ealain
 */

namespace Ealain\Ealain;

use Ealain\Ealain\Dynamic_Style\Styles\Header;

use function Ealain\Ealain\ealain;

global $ealain_options ;
$bgurl = $site_classes = $has_sticky = $default_header_container = '';
if (class_exists('ReduxFramework')) {
    //theme site class
    $site_classes .= 'ealain';
    //loader
    if (isset($ealain_options['display_loader']) && $ealain_options['display_loader'] === 'yes') {
        if (!empty($ealain_options['loader_gif']['url'])) {
            $bgurl = $ealain_options['loader_gif']['url'];
        }
    }
    //sticky header
    if (isset($ealain_options['display_sticky_header']) && $ealain_options['display_sticky_header'] == 'yes') {
        $has_sticky = ' has-sticky';
    }
    // container
    if (isset($ealain_options['header_layout']) && $ealain_options['header_layout'] == 'default') {
        $default_header_container = ($ealain_options['header_container'] == 'container') ? 'container' : 'container-fluid';
    }
} else {
    //default
    $bgurl = get_template_directory_uri() . '/assets/images/redux/loader.gif';
    $has_sticky = ' has-sticky';
    $default_header_container = 'container-fluid';
}
?> 
<?php if (!empty($bgurl)) { ?>
    <div id="loading">
        <div id="loading-center">
            <img src="<?php echo esc_url($bgurl); ?>" alt="<?php esc_attr_e('loader', 'ealain'); ?>">
        </div>
    </div>
<?php } ?>
<!-- loading End -->
<?php
$is_default_header = true;
$is_header = true;
if (function_exists("get_field")) {
    $header = new Header();
    $is_header = $header->is_ealain_header();
}
$header_response = '';
if (function_exists('get_field') || class_exists('ReduxFramework')) {
    $id = (get_queried_object_id()) ? get_queried_object_id() : '';
    $display_header = !empty($id) ? get_post_meta($id, 'display_header', true) : '';
    $header_slug = !empty($id) ? get_post_meta($id, 'header_layout_name', true) : '';
    $header_layout_type = !empty($id) ? get_post_meta($id, 'header_layout_type', true) : '';
    // ------------header
    if ($is_header) {
        if (class_exists("Elementor\Plugin")) {
            if ($display_header === 'yes' && $header_layout_type === 'custom' && !empty($header_slug)) {
                $my_layout = get_page_by_path($header_slug, '', 'iqonic_hf_layout');
                if ($my_layout) {
                    $is_default_header = false;
                    $has_sticky = '';
                    $header_response =  ealain()->ealain_get_layout_content($my_layout->ID);
                }
            } else if (isset($ealain_options['header_layout']) && $ealain_options['header_layout'] == 'custom') {
                if (!empty($ealain_options['menu_style'])) {
                    $is_default_header = false;
                    $has_sticky = '';
                    $my_layout = get_page_by_path($ealain_options['menu_style'], '', 'iqonic_hf_layout');
                    if ($my_layout) {
                        $header_response =  ealain()->ealain_get_layout_content($my_layout->ID);
                    }
                }
            }
        }

        // ---------------header end
        $h_layout_position = !empty($id) ? get_post_meta($id, 'header_layout_position', true) : '';
        if ($display_header === 'yes' && $header_layout_type === 'custom' && $h_layout_position === 'vertical') {
            $site_classes .= ' vertical-header';
        } else {
            if (isset($ealain_options['header_layout_position']) && $ealain_options['header_layout_position'] == 'vertical') {
                $site_classes .= ' vertical-header';
            }
        }
        if (strpos($site_classes, 'vertical-header')) {
            add_filter('content_container_class', function ($container) {
                $container = 'container-fluid';
                return $container;
            });
        }
    }
}
?>
<div id="page" class="site <?php echo esc_attr(trim($site_classes)); ?>">
    <a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'ealain'); ?></a>
    <?php if ($is_header) { ?>
        <header class="header-default<?php echo esc_attr($has_sticky); ?>" id="default-header">
            <?php
            if (!$is_default_header && !empty($header_response)) {
                echo function_exists('iqonic_return_elementor_res') ? iqonic_return_elementor_res($header_response) : $header_response;
            } else {
                $is_default_header = true;
            }
            if ($is_default_header) {
            ?>
                <div class="<?php echo esc_attr($default_header_container); ?>">
                    <div class="row">
                        <div class="col-md-12">
                            <?php
                            get_template_part('template-parts/header/navigation');
                            ?>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </header><!-- #masthead -->
        <?php if ($is_default_header) : ?>
            <div class="ealain-mobile-menu default-mobile-menu menu-style-one">
                <?php get_template_part('template-parts/header/navigation', 'mobile'); ?>
            </div>
        <?php endif; ?>
    <?php } ?>