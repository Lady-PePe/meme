<?php

/**
 * Ealain\Ealain\Actions\Component class
 *
 * @package ealain
 */

namespace Ealain\Ealain\Actions;

use Ealain\Ealain\Component_Interface;
use Ealain\Ealain\Templating_Component_Interface;

/**
 * Class for managing comments UI.
 *
 * Exposes template tags:
 * * `ealain()->the_comments( array $args = array() )`
 *
 * @link https://wordpress.org/plugins/amp/
 */
class Component implements Component_Interface, Templating_Component_Interface
{
	/**
	 * Gets the unique identifier for the theme component.
	 *
	 * @return string Component slug.
	 */
	public function get_slug(): string
	{
		return 'actions';
	}
	public function initialize()
	{
	}
	/**
	 * Gets template tags to expose as methods on the Template_Tags class instance, accessible through `ealain()`.
	 *
	 * @return array Associative array of $method_name => $callback_info pairs. Each $callback_info must either be
	 *               a callable or an array with key 'callable'. This approach is used to reserve the possibility of
	 *               adding support for further arguments in the future.
	 */
	public function template_tags(): array
	{
		return array(
			'ealain_get_blog_readmore_link' => array($this, 'ealain_get_blog_readmore_link'),
			'ealain_get_blog_readmore' => array($this, 'ealain_get_blog_readmore'),
			'ealain_get_comment_btn' => array($this, 'ealain_get_comment_btn'),
			'ealain_btn' => array($this, 'ealain_btn'),
		);
	}

	//** Blog Read More Button Link **//
	public function ealain_get_blog_readmore_link($link, $label = "Read More")
	{
		$bgurl = get_template_directory_uri() . '/assets/images/redux/fish.webp';

		if (is_404()) {

			echo '<div class="blog-button">		
                <a class="ealain-button" href="' . esc_url($link) . '">
                    <span class="text-btn">' . esc_html($label) . ' </span>
                    <span class="btn-img">
                        <img src="' . esc_url($bgurl) . '" class="btn-icon" alt="' . esc_attr__('image', 'ealain') . ' ">
                        <svg class="btn-shadow" width="23" class="btn-shadow" height="3" viewBox="0 0 23 3" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M2.98023e-08 1.30102C3.71407 1.9758 7.42816 2.35535 11.2104 2.35535C15.1289 2.35535 19.0815 2.65056 23 2.39752C21.1259 1.21667 8.79109 0.288847 1.26072 0.541887C0.851835 0.541887 0.408889 0.710569 2.98023e-08 0.794915C2.98023e-08 1.00578 2.98023e-08 1.13233 2.98023e-08 1.30102Z" fill="#312660" fill-opacity="0.3"/></svg>
                    </span>
                </a>
            </div>';
		} else {
			echo '<div class="blog-button">		
                    <a class="ealain-button-link" href="' . esc_url($link) . '">' . esc_html($label) . ' 
                    <span class="text-btn"></span> 
                    </a>
                </div>';
		}
	}

	//** Blog Read More Button **//
	public function ealain_get_blog_readmore($link, $label)
	{
		$bgurl = get_template_directory_uri() . '/assets/images/redux/fish.webp';
		echo '<div class="blog-button">
				<a class="ealain-button" href="' . esc_url($link) . '">
				<span class="text-btn">' . esc_html($label) . ' </span>
                    <span class="btn-img">
                        <img src="' . esc_url($bgurl) . '" class="btn-icon" alt="' . esc_attr__('image', 'ealain') . ' ">
                        <svg class="btn-shadow" width="23" class="btn-shadow" height="3" viewBox="0 0 23 3" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M2.98023e-08 1.30102C3.71407 1.9758 7.42816 2.35535 11.2104 2.35535C15.1289 2.35535 19.0815 2.65056 23 2.39752C21.1259 1.21667 8.79109 0.288847 1.26072 0.541887C0.851835 0.541887 0.408889 0.710569 2.98023e-08 0.794915C2.98023e-08 1.00578 2.98023e-08 1.13233 2.98023e-08 1.30102Z" fill="#312660" fill-opacity="0.3"/></svg>
                    </span>
				</a>
			</div>';
	}
	//** Comment Submit Button **//
	public function ealain_get_comment_btn()
	{
		$bgurl = get_template_directory_uri() . '/assets/images/redux/fish.webp';

		return '<button name="submit" type="submit" id="submit" class="submit ealain-button" value="' . esc_attr__('Post Comment' . 'ealain') . '" >
                    <span class="text-btn">' . esc_html__('Post Comment', 'ealain') . '</span>
                    <span class="btn-img">
                        <img src="' . esc_url($bgurl) . '" class="btn-icon" alt="' . esc_attr__('image', 'ealain') . ' ">
                        <svg class="btn-shadow" width="23" class="btn-shadow" height="3" viewBox="0 0 23 3" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M2.98023e-08 1.30102C3.71407 1.9758 7.42816 2.35535 11.2104 2.35535C15.1289 2.35535 19.0815 2.65056 23 2.39752C21.1259 1.21667 8.79109 0.288847 1.26072 0.541887C0.851835 0.541887 0.408889 0.710569 2.98023e-08 0.794915C2.98023e-08 1.00578 2.98023e-08 1.13233 2.98023e-08 1.30102Z" fill="#312660" fill-opacity="0.3"/>
</svg>
                    </span>
				</button>';
	}
	public function ealain_btn($tag = 'a',  $label = 'Post Comment', $show_icon = false, $attr = array())
	{
		$bgurl = get_template_directory_uri() . '/assets/images/redux/fish.webp';

		$classes = isset($attr['class']) ? $attr['class'] : '';

		$attr_render = '';
		$attr_render = ($tag == 'button') ? 'type="submit" ' : '';

		foreach ($attr as $key => $value) {
			$attr_render .= $key . '=' . $value . ' ';
		}

		return '<' . tag_escape($tag) . '  class="submit ealain-button ' . esc_attr($classes) . '  " ' . esc_attr($attr_render) . '  >
				' . '<span class="text-btn">' . esc_html__($label) . '</span>' .
			'<span class="btn-img">
				<img src="' . esc_url($bgurl) . '" class="btn-icon" alt="' . esc_attr__('image', 'ealain') . ' ">
				<svg class="btn-shadow" width="23" class="btn-shadow" height="3" viewBox="0 0 23 3" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M2.98023e-08 1.30102C3.71407 1.9758 7.42816 2.35535 11.2104 2.35535C15.1289 2.35535 19.0815 2.65056 23 2.39752C21.1259 1.21667 8.79109 0.288847 1.26072 0.541887C0.851835 0.541887 0.408889 0.710569 2.98023e-08 0.794915C2.98023e-08 1.00578 2.98023e-08 1.13233 2.98023e-08 1.30102Z" fill="#312660" fill-opacity="0.3"/>
</svg>
			</span>' .
			' </' . tag_escape($tag) . '>';
	}
}
