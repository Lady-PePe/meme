<?php

/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ealain
 */

namespace Ealain\Ealain;

$post_section = ealain()->post_style();
get_header();

   ?>
<div class="site-content-contain">
   <div id="content" class="site-content">
      <div id="primary" class="content-area">
         <main id="main" class="site-main">
            <div class="container ealain-team-detail">
               <div class="ealain-info <?php echo esc_attr($post_section['row_reverse']); ?>"> <?php
                  if (have_posts()) {      
                     while (have_posts()) {
                     ?>
                        <div class="row"> 
                           <div class="<?php echo esc_attr($post_section['post']); ?>"> <?php 
                                the_post(); ?>
                               <div class="content"> 
                                    <?php echo the_content(); ?> 
                               </div>
                           </div>
                        </div> <?php
                     }
                  } ?>
                  
               </div>
            </div>
           
         </main>
         <!-- #primary -->
      </div>
   </div>
</div>
<?php
get_footer();
