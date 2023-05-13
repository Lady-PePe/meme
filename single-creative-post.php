<?php

/**
 * Template Name: Creative Post Template
 * Template Post Type: post
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage gericht
 * @since 1.0
 * @version 1.0
 */
namespace Ealain\Ealain;

get_header(); ?>
<?php
global $ealain_options ;
$post_section = ealain()->post_style();
$ealain_layout = '';
if (isset($ealain_options['blog_setting'])) {
    $ealain_layout = $ealain_options['blog_setting'];
}
?>
<div class="site-content-contain creative-post-template blog-widget">
    <div id="content" class="site-content">
        <div id="primary" class="content-area">
            <main id="main" class="site-main">
                <div class="<?php echo apply_filters('content_container_class','container'); ?>">
                    <div class="row <?php echo esc_attr($post_section['row_reverse']); ?>">
                        <?php
                        if (have_posts()) {

                            while (have_posts()) { ?>
                                <?php
                                the_post();
                                get_template_part('template-parts/content/entry_creative_post', get_post_type(), $post_section['post']);
                                ?>
                        <?php }
                            if (!is_singular()) {
                                if (isset($ealain_options['display_pagination'])) {
                                    $options = $ealain_options['display_pagination'];
                                    if ($options == "yes") {
                                        get_template_part('template-parts/content/pagination');
                                    }
                                } else {
                                    get_template_part('template-parts/content/pagination');
                                }
                            }
                        } else {
                            get_template_part('template-parts/content/error');
                        }
                        ?>
                    </div>
                </div>
            </main><!-- #primary -->
        </div>
    </div>
</div>
<?php get_footer();
