<?php
/**
 * 未找到文章的显示对应提示的模板
 *
 * 了解更多请访问：http://codex.wordpress.org/Template_Hierarchy
 *
 * @package _s
 */
?>

<section class="no-results not-found">
	<header class="page-header">
		<h1 class="page-title"><?php _e( '未找到内容', '_s' ); ?></h1>
	</header><!-- .page-header -->

	<div class="page-content">
		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<p><?php printf( __( '开始发布您的第一篇文章？ <a href="%1$s">点此开始</a>.', '_s' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

		<?php elseif ( is_search() ) : ?>

			<p><?php _e( '抱歉，没有找到符合条件的文章，请更换关键词重试！', '_s' ); ?></p>
			<?php get_search_form(); ?>

		<?php else : ?>

			<p><?php _e( '哦哦，我不太理解您的请求，也许搜索可以帮助您…', '_s' ); ?></p>
			<?php get_search_form(); ?>

		<?php endif; ?>
	</div><!-- .page-content -->
</section><!-- .no-results -->
