<?php

/**
 * Display single product reviews (comments)
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product-reviews.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.3.0
 */

use function Ealain\Ealain\ealain;

defined('ABSPATH') || exit;

global $product;

if (!comments_open()) {
	return;
}

?>
<div id="reviews" class="woocommerce-Reviews">
	<div id="comments">
		<h2 class="woocommerce-Reviews-title">
			<?php
			$count = $product->get_review_count();
			if ($count && wc_review_ratings_enabled()) {
				/* translators: 1: reviews count 2: product name */
				$reviews_title = sprintf(esc_html(_n('%1$s review for %2$s', '%1$s reviews for %2$s', $count, 'ealain')), esc_html($count), '<span>' . get_the_title() . '</span>');
				echo apply_filters('woocommerce_reviews_title', $reviews_title, $count, $product); // WPCS: XSS ok.
			} else {
				esc_html_e('Reviews', 'ealain');
			}
			?>
		</h2>

		<?php if (have_comments()) : ?>
			<ol class="commentlist">
				<?php wp_list_comments(apply_filters('woocommerce_product_review_list_args', array('callback' => 'woocommerce_comments'))); ?>
			</ol>

			<?php
			if (get_comment_pages_count() > 1 && get_option('page_comments')) :
				echo '<nav class="woocommerce-pagination">';
				paginate_comments_links(
					apply_filters(
						'woocommerce_comment_pagination_args',
						array(
							'prev_text' => is_rtl() ? '&rarr;' : '&larr;',
							'next_text' => is_rtl() ? '&larr;' : '&rarr;',
							'type'      => 'list',
						)
					)
				);
				echo '</nav>';
			endif;
			?>
		<?php else : ?>
			<p class="woocommerce-noreviews"><?php esc_html_e('There are no reviews yet.', 'ealain'); ?></p>
		<?php endif; ?>
	</div>

	<?php if (get_option('woocommerce_review_rating_verification_required') === 'no' || wc_customer_bought_product('', get_current_user_id(), $product->get_id())) : ?>
		<div id="review_form_wrapper">
			<div id="review_form">
				<?php
				$bgurl = get_template_directory_uri() . '/assets/images/redux/fish.webp'; 
				$commenter    = wp_get_current_commenter();
				$comment_form = array(
					/* translators: %s is product title */
					'title_reply'         => have_comments() ? esc_html__('Add a review', 'ealain') : sprintf(esc_html__('Be the first to review &ldquo;%s&rdquo;', 'ealain'), get_the_title()),
					/* translators: %s is product title */
					'title_reply_to'      => esc_html__('Leave a Reply to %s', 'ealain'),
					'title_reply_before'  => '<span id="reply-title" class="comment-reply-title">',
					'title_reply_after'   => '</span>',
					'comment_notes_after' => '',
					'label_submit'        => esc_html__('Submit', 'ealain'),
					'submit_button'       => '<div class="ealain-btn-container"><button name="submit" type="submit" id="submit" class="submit ealain-button" value="' . esc_attr__('Post Comment' . 'ealain') . '" >
                    <span class="wrap-btn"><span class="text-btn">' . esc_html__('Submit','ealain') . '</span>
                    <span class="btn-img">
                        <img src="'.esc_url($bgurl).'" class="btn-icon" alt="'.esc_attr__('image','ealain').' ">
                        <svg class="btn-shadow" width="23" class="btn-shadow" height="3" viewBox="0 0 23 3" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M2.98023e-08 1.30102C3.71407 1.9758 7.42816 2.35535 11.2104 2.35535C15.1289 2.35535 19.0815 2.65056 23 2.39752C21.1259 1.21667 8.79109 0.288847 1.26072 0.541887C0.851835 0.541887 0.408889 0.710569 2.98023e-08 0.794915C2.98023e-08 1.00578 2.98023e-08 1.13233 2.98023e-08 1.30102Z" fill="#312660" fill-opacity="0.3"/>
</svg></span></span></button></div>',
					'logged_in_as'        => '',
					'comment_field'       => '',
					'format'              => 'xhtml'
				);

				$name_email_required = (bool) get_option('require_name_email', 1);
				$fields              = array(
					'author' => array(
						'label'    => esc_html__('Name', 'ealain'),
						'type'     => 'text',
						'value'    => $commenter['comment_author'],
						'required' => $name_email_required,
					),
					'email'  => array(
						'label'    => esc_html__('Email', 'ealain'),
						'type'     => 'email',
						'value'    => $commenter['comment_author_email'],
						'required' => $name_email_required,
					),

				);

				$comment_form['fields'] = array();

				foreach ($fields as $key => $field) {
					$field_html  = '<p class="comment-form-' . esc_attr($key) . '">';
					$field_html .= '<label for="' . esc_attr($key) . '">' . esc_html($field['label']);

					if ($field['required']) {
						$field_html .= '&nbsp;<span class="required">*</span>';
					}

					$field_html .= '</label><input id="' . esc_attr($key) . '" name="' . esc_attr($key) . '" type="' . esc_attr($field['type']) . '" value="' . esc_attr($field['value']) . '" size="30" ' . ($field['required'] ? 'required' : '') . ' /></p>';

					$comment_form['fields'][$key] = $field_html;
				}

				$comment_form['fields']['cookies'] = '<p class="ealain-check"><label><input type="checkbox" required="required" /> <span class="checkmark"></span><span class="text-check">' . esc_html__("Save my name, email, and website in this browser for the next time I comment.", "ealain") . '</span></label></p>';

				$account_page_url = wc_get_page_permalink('myaccount');
				if ($account_page_url) {
					/* translators: %s opening and closing link tags respectively */
					$comment_form['must_log_in'] = '<p class="must-log-in">' . sprintf(esc_html__('You must be %1$slogged in%2$s to post a review.', 'ealain'), '<a href="' . esc_url($account_page_url) . '">', '</a>') . '</p>';
				}

				if (wc_review_ratings_enabled()) {
					$comment_form['comment_field'] = '<div class="comment-form-rating"><label for="rating">' . esc_html__('Your rating', 'ealain') . (wc_review_ratings_required() ? '&nbsp;<span class="required">*</span>' : '') . '</label><select name="rating" id="rating" required>
						<option value="">' . esc_html__('Rate&hellip;', 'ealain') . '</option>
						<option value="5">' . esc_html__('Perfect', 'ealain') . '</option>
						<option value="4">' . esc_html__('Good', 'ealain') . '</option>
						<option value="3">' . esc_html__('Average', 'ealain') . '</option>
						<option value="2">' . esc_html__('Not that bad', 'ealain') . '</option>
						<option value="1">' . esc_html__('Very poor', 'ealain') . '</option>
					</select></div>';
				}

				$comment_form['comment_field'] .= '<p class="comment-form-comment"><label for="comment">' . esc_html__('Your review', 'ealain') . '&nbsp;<span class="required">*</span></label><textarea id="comment" name="comment" cols="45" rows="8" required></textarea></p>';

				comment_form(apply_filters('woocommerce_product_review_comment_form_args', $comment_form));
				?>
			</div>
		</div>
	<?php else : ?>
		<p class="woocommerce-verification-required"><?php esc_html_e('Only logged in customers who have purchased this product may leave a review.', 'ealain'); ?></p>
	<?php endif; ?>

	<div class="clear"></div>
</div>