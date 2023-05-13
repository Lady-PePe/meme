<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ealain
 */

namespace Ealain\Ealain;
global $ealain_options ;

?>
<!doctype html>
<html <?php language_attributes(); ?> class="no-js">

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">

  <link rel="profile" href="<?php echo is_ssl() ? 'https:' : 'http:' ?>//gmpg.org/xfn/11">
  <?php if (!function_exists('has_site_icon') || !wp_site_icon()) { ?>
    <link rel="shortcut icon" href="<?php echo esc_url(get_template_directory_uri() . '/assets/images/redux/favicon.png'); ?>" />
  <?php } ?>
	
	<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
<link rel="manifest" href="/site.webmanifest">
<meta name="msapplication-TileColor" content="#da532c">
<meta name="theme-color" content="#ffffff">
	
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <?php wp_body_open(); ?>

    <?php if (class_exists('Redux')) { ?>
        <?php if(isset($ealain_options['magic_cursor_btn']) && $ealain_options['magic_cursor_btn'] == 'yes'){ ?>
          <div id="magic-cursor">
            <div id="ball"><svg class="base-circle animated" width="50" height="50" viewBox="0 0 50 50">
            <circle class="c1" cx="25" cy="25" r="23" stroke="#fff" stroke-width="1" fill="none"></circle></svg></div>
          </div>
        <?php } ?>
    <?php } ?>
  
  <div id="body-inner" class="main-body">
<?php get_template_part('template-parts/header/header'); ?>
<?php get_template_part('template-parts/breadcrumb/breadcrumb'); ?>
