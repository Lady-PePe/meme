<?php

/**
 * Ealain\Ealain\Dynamic_Style\Styles\HeaderSticky class
 *
 * @package ealain
 */

namespace Ealain\Ealain\Dynamic_Style\Styles;

use Ealain\Ealain\Dynamic_Style\Component;
use function add_action;

class HeaderSticky extends Component
{
	public function __construct()
	{
		$header = new Header();
		if ($header->is_ealain_header()) {
			add_action('wp_enqueue_scripts', array($this, 'ealain_header_sticky_background_style'), 20);
			add_action('wp_enqueue_scripts', array($this, 'ealain_sticky_sub_menu_color_options'), 20);
			add_action('wp_enqueue_scripts', array($this, 'ealain_sticky_menu_color_options'), 20);
		}
	}

	public function ealain_header_sticky_background_style()
	{
		global $ealain_options ;
		$inline_css = '';
		$id = get_queried_object_id();

		$displayHeader= get_post_meta($id,'display_header',true);
		$headerStickyColorType= get_post_meta($id,'header_sitcky_color_type',true);

		if (!empty($displayHeader) && $displayHeader !== 'default' && !empty($headerStickyColorType) && $headerStickyColorType  !== 'default') {
			$headerStickyColor=get_post_meta($id,'header_sticky_bg',true);
			$inline_css  =  $headerStickyColor ?  '.has-sticky.header-up,.has-sticky.header-down{background : ' .$headerStickyColor . '!important;}' : '';
		} else if (isset($ealain_options['display_sticky_header']) && $ealain_options['display_sticky_header'] === 'yes') {
			if (isset($ealain_options['sticky_header_bg']) && $ealain_options['sticky_header_bg'] != 'default') {
				$type = $ealain_options['sticky_header_bg'];
				if ($type == 'color') {
					if (!empty($ealain_options['sticky_header_bg_color'])) {
						$inline_css .= '.has-sticky.header-up,.has-sticky.header-down{
							background : ' . $ealain_options['sticky_header_bg_color'] . '!important;
						}';
					}
				}
				if ($type == 'image') {
					if (!empty($ealain_options['sticky_header_bg_img']['url'])) {
						$inline_css .= '.has-sticky.header-up,.has-sticky.header-down{
							background : url(' . $ealain_options['sticky_header_bg_img']['url'] . ') !important;
						}';
					}
				}
				if ($type == 'transparent') {
					$inline_css .= '.has-sticky.header-up,.has-sticky.header-down{
						background : transparent !important;
					}';
				}
			}
		}

		if (!empty($inline_css)) {
			wp_add_inline_style('ealain-global', $inline_css);
		}
	}

	public function ealain_sticky_menu_color_options()
	{
		global $ealain_options ;
		$inline_css = '';
		if (isset($ealain_options['sticky_menu_color_type']) && $ealain_options['sticky_menu_color_type'] == 'custom') {
			if (isset($ealain_options['sticky_menu_color']) && !empty($ealain_options['sticky_menu_color'])) {
				$inline_css .= '.has-sticky.header-down .sf-menu > li > a, .has-sticky.header-up .sf-menu > li > a{
						color : ' . $ealain_options['sticky_menu_color'] . '!important;
					}';
			}

			if (isset($ealain_options['sticky_menu_hover_color']) && !empty($ealain_options['sticky_menu_hover_color'])) {
				$inline_css .= '.has-sticky.header-down .sf-menu li:hover > a,.has-sticky.header-down .sf-menu li.current-menu-ancestor > a,.has-sticky.header-down .sf-menu  li.current-menu-item > a, .has-sticky.header-up .sf-menu li:hover > a,.has-sticky.header-up .sf-menu li.current-menu-ancestor > a,.has-sticky.header-up .sf-menu  li.current-menu-item > a{
						color : ' . $ealain_options['sticky_menu_hover_color'] . '!important;
					}';
			}
		}
		if (!empty($inline_css)) {
			wp_add_inline_style('ealain-global', $inline_css);
		}
	}

	public function ealain_sticky_sub_menu_color_options()
	{
		global $ealain_options ;
		$inline_css = '';

		if (isset($ealain_options['sticky_header_submenu_color_type']) && $ealain_options['sticky_header_submenu_color_type'] == 'custom') {
			if (isset($ealain_options['sticky_ealain_header_submenu_color']) && !empty($ealain_options['sticky_ealain_header_submenu_color'])) {
				$inline_css .= '.has-sticky.header-down .sf-menu ul.sub-menu a, .has-sticky.header-up .sf-menu ul.sub-menu a{
                color : ' . $ealain_options['sticky_ealain_header_submenu_color'] . ' !important;
            }';
			}

			if (isset($ealain_options['sticky_ealain_header_submenu_hover_color']) && !empty($ealain_options['sticky_ealain_header_submenu_hover_color'])) {
				$inline_css .= '.has-sticky.header-down .sf-menu li.sfHover>a,.has-sticky.header-down .sf-menu li:hover>a,.has-sticky.header-down .sf-menu li.current-menu-ancestor>a,.has-sticky.header-down .sf-menu li.current-menu-item>a,.has-sticky.header-down .sf-menu ul>li.menu-item.current-menu-parent>a,.has-sticky.header-down .sf-menu ul li.current-menu-parent>a,.has-sticky.header-down .sf-menu ul li .sub-menu li.current-menu-item>a,
				.has-sticky.header-up .sf-menu li.sfHover>a,.has-sticky.header-up .sf-menu .sub-menu li:hover>a,.has-sticky.header-up .sf-menu li.current-menu-ancestor>a,.has-sticky.header-up .sf-menu li.current-menu-item>a,.has-sticky.header-up .sf-menu ul>li.menu-item.current-menu-parent>a,.has-sticky.header-up .sf-menu ul li.current-menu-parent>a,.has-sticky.header-up .sf-menu ul li .sub-menu li.current-menu-item>a{
                color : ' . $ealain_options['sticky_ealain_header_submenu_hover_color'] . ' !important;
            }';
			}

			if (isset($ealain_options['sticky_ealain_header_submenu_background_color']) && !empty($ealain_options['sticky_ealain_header_submenu_background_color'])) {
				$inline_css .= '.has-sticky.header-up .sf-menu ul.sub-menu li, .has-sticky.header-down .sf-menu ul.sub-menu li {
                background : ' . $ealain_options['sticky_ealain_header_submenu_background_color'] . ' !important;
            }';
			}

			if (isset($ealain_options['sticky_header_submenu_background_hover_color']) && !empty($ealain_options['sticky_header_submenu_background_hover_color'])) {
				$inline_css .= '.has-sticky.header-up .sf-menu ul.sub-menu li:hover,.has-sticky.header-up .sf-menu ul.sub-menu li.current-menu-item ,.has-sticky.header-up .sf-menu ul.sub-menu li:hover,.has-sticky.header-up .sf-menu ul.sub-menu li.current-menu-item,
				.has-sticky.header-down .sf-menu ul.sub-menu li:hover,.has-sticky.header-down .sf-menu ul.sub-menu li.current-menu-item ,.has-sticky.header-down .sf-menu ul.sub-menu li:hover,.has-sticky.header-down .sf-menu ul.sub-menu li.current-menu-item{
                background : ' . $ealain_options['sticky_header_submenu_background_hover_color'] . ' !important;
            }';
			}
		}
		if (!empty($inline_css)) {
			wp_add_inline_style('ealain-global', $inline_css);
		}
	}
}
