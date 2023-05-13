<?php

/**
 * Template part for displaying the Breadcrumb 
 *
 * @package ealain
 */

namespace Ealain\Ealain;

use Ealain\Ealain\Dynamic_Style\Styles\Breadcrumb;

$is_breadcrumb = true;
$ealain_style = '';

if(class_exists("Redux")){ 
    global $ealain_options ;
    if(isset($ealain_options['breadcrumb_style'])){
        $ealain_style = $ealain_options['breadcrumb_style'];
    }
}

global $ealain_options ;
if (is_front_page()) {
    if (is_home()) {
?>
        <div class="ealain-breadcrumb text-center ealain-breadcrumb-style-<?php echo esc_attr($ealain_style) ?>">
            <div class="container">
                <div class="row flex-row-reverse">
                    <div class="col-sm-12">
                        <div class="heading-title white ealain-breadcrumb-title">
                            <h1 class="title mt-0">
                                <?php esc_html_e('Home', 'ealain'); ?>
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php
    }
} else {
    if (class_exists("Redux")) {
        $breadcrumb = new Breadcrumb();
        $is_breadcrumb = $breadcrumb->is_ealain_breadcrumb();
    }
    if ($is_breadcrumb) ealain()->ealain_breadcrumb();
}
?>