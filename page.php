<?php
/**
 * 页面模板
 *
 * 此模板用来显示所有默认页面的内容
 * 请注意，这是WordPress构建页面
 * 和其他的页面一起，可以在你的WordPress站点中
 * 使用不同的模板
 *
 * @package _s
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'page' ); ?>

				<?php
					// 如果评论开启或者至少有一条评论，在页面中显示评论模板
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
				?>

			<?php endwhile; // loop结束 ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
