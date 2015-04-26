<?php
/**
 * 首页模板
 *
 * 这是一个WordPress主题最通用的模板文件
 * 另一个必需文件是style.css
 * 当没有找到匹配的模板文件时，它用来显示页面内容
 * 例如： 当home.php不存在时使用此页面来页面内容
 * 更多信息请参考：http://codex.wordpress.org/Template_Hierarchy
 *
 * @package _s
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<?php /* Loop开始 */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php
					/* 包括在内容中使用特定格式的模板。
					 *如果你想在子主题中重写这一部分，然后通过文件引入。
					 * 引入content-___.php （___ 是文章格式名称）替换这一部分。
					 */
					get_template_part( 'content', get_post_format() );
				?>

			<?php endwhile; ?>

			<?php the_posts_navigation(); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
