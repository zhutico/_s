<?php
/**
 * 文章存档页面模板。
 *
 * 了解更多请访问：http://codex.wordpress.org/Template_Hierarchy
 *
 * @package _s
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="taxonomy-description">', '</div>' );
				?>
			</header><!-- .page-header -->

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
