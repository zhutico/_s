<?php
/**
 * WordPress.com - 具体的函数和定义
 *
 * 这个文件包含在 `wp-content/mu-plugins/wpcom-theme-compat.php`.
 *
 * @package _s
 */

/**
 * 为主题中添加wp.com-specific支持
 *
 * @global array $themecolors
 */
function _s_wpcom_setup() {
	global $themecolors;

	// 为第三方服务设置主题颜色
	if ( ! isset( $themecolors ) ) {
		$themecolors = array(
			'bg'     => '',
			'border' => '',
			'text'   => '',
			'link'   => '',
			'url'    => '',
		);
	}
}
add_action( 'after_setup_theme', '_s_wpcom_setup' );
