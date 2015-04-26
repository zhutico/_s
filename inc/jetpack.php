<?php
/**
 * Jetpack兼容文件
 * 查看：http://jetpack.me/
 *
 * @package _s
 */

/**
 * 添加主题对瀑布流的支持
 * 查看：http://jetpack.me/support/infinite-scroll/
 */
function _s_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'footer'    => 'page',
	) );
}
add_action( 'after_setup_theme', '_s_jetpack_setup' );
