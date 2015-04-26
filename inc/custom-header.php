<?php
/**
 * 自定义顶部
 * http://codex.wordpress.org/Custom_Headers
 *
 * 您可以添加自定义顶部图片到header.php，如

	<?php if ( get_header_image() ) : ?>
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
		<img src="<?php header_image(); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="">
	</a>
	<?php endif; // 顶部图像检查结束 ?>

 *
 * @package _s
 */

/**
 * 添加WordPress自定义顶部支持
 *
 * @uses _s_header_style()
 * @uses _s_admin_header_style()
 * @uses _s_admin_header_image()
 */
function _s_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( '_s_custom_header_args', array(
		'default-image'          => '',
		'default-text-color'     => '000000',
		'width'                  => 1000,
		'height'                 => 250,
		'flex-height'            => true,
		'wp-head-callback'       => '_s_header_style',
		'admin-head-callback'    => '_s_admin_header_style',
		'admin-preview-callback' => '_s_admin_header_image',
	) ) );
}
add_action( 'after_setup_theme', '_s_custom_header_setup' );

if ( ! function_exists( '_s_header_style' ) ) :
/**
 * 自定义顶部图像和颜色显示在后台->外观->顶部的管理面板中
 *
 * @see _s_custom_header_setup().
 */
function _s_header_style() {
	$header_text_color = get_header_textcolor();

	// 如果没有设置顶部文字颜色
	// get_header_textcolor() 设置HEADER_TEXTCOLOR为默认值，不显示顶部文字（返回空）或者十六进制值
	if ( HEADER_TEXTCOLOR == $header_text_color ) {
		return;
	}

	// 如果设置了顶部文本颜色，需要输出自定义样式
	?>
	<style type="text/css">
	<?php
		// 如果不显示顶部文字
		if ( 'blank' == $header_text_color ) :
	?>
		.site-title,
		.site-description {
			position: absolute;
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
		// 如果用户设置了顶部文字颜色
		else :
	?>
		.site-title a,
		.site-description {
			color: #<?php echo esc_attr( $header_text_color ); ?>;
		}
	<?php endif; ?>
	</style>
	<?php
}
endif; // _s_header_style

if ( ! function_exists( '_s_admin_header_style' ) ) :
/**
 * 自定义顶部颜色显示在后台->外观->顶部的管理面板中
 *
 * @see _s_custom_header_setup().
 */
function _s_admin_header_style() {
?>
	<style type="text/css">
		.appearance_page_custom-header #headimg {
			border: none;
		}
		#headimg h1,
		#desc {
		}
		#headimg h1 {
		}
		#headimg h1 a {
		}
		#desc {
		}
		#headimg img {
		}
	</style>
<?php
}
endif; // _s_admin_header_style

if ( ! function_exists( '_s_admin_header_image' ) ) :
/**
 * 自定义顶部图像显示在后台->外观->顶部的管理面板中
 *
 * @see _s_custom_header_setup().
 */
function _s_admin_header_image() {
	$style = sprintf( ' style="color:#%s;"', get_header_textcolor() );
?>
	<div id="headimg">
		<h1 class="displaying-header-text"><a id="name"<?php echo $style; ?> onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
		<div class="displaying-header-text" id="desc"<?php echo $style; ?>><?php bloginfo( 'description' ); ?></div>
		<?php if ( get_header_image() ) : ?>
		<img src="<?php header_image(); ?>" alt="">
		<?php endif; ?>
	</div>
<?php
}
endif; // _s_admin_header_image
