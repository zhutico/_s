<?php
/**
 * 搜索结果页面
 *
 * @package _s
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title"><?php printf( __( '符合“%s”的搜索结果：', '_s' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
			</header><!-- .page-header -->

			<?php /* Loop开始 */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php
				/**
				 * 在搜索结果中运行Loop
				 * 如果你想在子主题中重写这一部分，然后通过文件引入。
				 * 引入content-search.php替换这一部分。
				 */
				get_template_part( 'content', 'search' );
				?>

			<?php endwhile; ?>

			<?php the_posts_navigation(); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
