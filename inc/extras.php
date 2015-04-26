<?php
/**
 * 自定义功能，独立于主题模板之外
 *
 * 一些函数会替换WordPress的核心功能
 *
 * @package _s
 */

/**
 * 为body元素添加自定义类
 *
 * @param array $classes body的class类
 * @return array
 */
function _s_body_classes( $classes ) {
	// 为多人博客中发布文章超过一篇以上的作者添加一个类
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	return $classes;
}
add_filter( 'body_class', '_s_body_classes' );

if ( version_compare( $GLOBALS['wp_version'], '4.1', '<' ) ) :
	/**
	 * wp_title在<title>中输出简洁的标题
	 *
	 * @param string $title 当前视图的默认的标题。
	 * @param string $sep 可选的分隔符。
	 * @return string 处理后的标题
	 */
	function _s_wp_title( $title, $sep ) {
		if ( is_feed() ) {
			return $title;
		}

		global $page, $paged;

		// 添加标题
		$title .= get_bloginfo( 'name', 'display' );

		// 为主页添加副标题
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) ) {
			$title .= " $sep $site_description";
		}

		// 必要时添加页面页码
		if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
			$title .= " $sep " . sprintf( __( 'Page %s', '_s' ), max( $paged, $page ) );
		}

		return $title;
	}
	add_filter( 'wp_title', '_s_wp_title', 10, 2 );

	/**
	 * WordPress 4.1+ 中的标题添加
	 *
	 * @link https://make.wordpress.org/core/2014/10/29/title-tags-in-4-1/
	 * @todo WordPress 4.3 发布时移除这个函数
	 */
	function _s_render_title() {
		?>
		<title><?php wp_title( '|', true, 'right' ); ?></title>
		<?php
	}
	add_action( 'wp_head', '_s_render_title' );
endif;
