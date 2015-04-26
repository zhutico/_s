<?php
/**
 * _s 函数和定义
 *
 * @package _s
 */

/**
 * 基于主题设计和样式表设置内容的宽度
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* 像素 */
}

if ( ! function_exists( '_s_setup' ) ) :
/**
 * 设置主题默认和注册后支持的各种功能
 *
 * 请注意：这个函数是个钩子函数，会挂钩到after_setup_theme中，在
 * 运行钩子初始化之前，一些功能应该在运行钩子之前添加，如
 * 文章特色图像的支持
 */
function _s_setup() {

	/*
	 * 使主题支持自动翻译
	 * 翻译文件可以/languages/中
	 * 如果您要基于 _s创建主题，通过查找并替换
	 * 在您的主题名称和所有的主题模板文件中修改 '_s' 
	 */
	load_theme_textdomain( '_s', get_template_directory() . '/languages' );

	// 在head 中添加文章/页面、评论的RSS feed
	add_theme_support( 'automatic-feed-links' );

	/*
	 * 使用WodPress管理页面标题
	 * 通过添加主题支持，我们可以使用WordPress提供给我们的编码方式，而不是以硬编码的方式
	 */
	add_theme_support( 'title-tag' );

	/*
	 * 开启文章特色图像支持
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	//add_theme_support( 'post-thumbnails' );

	// 使用wp_nav_menu() 在主题某一位置添加菜单
	register_nav_menus( array(
		'primary' => __( '主菜单', '_s' ),
	) );

	/*
	 * 改变默认值，增强搜索表单，评论表单和评论内容等
	 * 输出有效的HTML5
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * 开启文章格式支持
	 * 更多信息请参考：http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
	) );

	// 自定义背景
	add_theme_support( 'custom-background', apply_filters( '_s_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // _s_setup
add_action( 'after_setup_theme', '_s_setup' );

/**
 * 注册小工具区域
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function _s_widgets_init() {
	register_sidebar( array(
		'name'          => __( '侧边栏', '_s' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', '_s_widgets_init' );

/**
 * 加载JS和CSS
 */
function _s_scripts() {
	wp_enqueue_style( '_s-style', get_stylesheet_uri() );

	wp_enqueue_script( '_s-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( '_s-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', '_s_scripts' );

/**
 * 自定义顶部内容
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * 自定义模板标签
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * 自定义函数，独立于主题模板之外
 */
require get_template_directory() . '/inc/extras.php';

/**
 * 补充定制
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * 加载Jetpack兼容性文件。
 */
require get_template_directory() . '/inc/jetpack.php';
