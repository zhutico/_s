<?php
/**
 * 评论模板
 *
 * 包含当前评论区域
 * 和评论表单
 *
 * @package _s
 */

/*
 * 如果当前文章或者页面设有密码保护
 * 在访问者输入密码之前
 * 不加载评论区域
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php // 你可以从这里开始编辑 ?>

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
				printf( _nx( '&ldquo;%2$s&rdquo;共有 1 条评论', '&ldquo;%2$s&rdquo;共有 %1$s 条评论', get_comments_number(), '评论', '_s' ),
					number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
			?>
		</h2>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // 评论分页 ?>
		<nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
			<h2 class="screen-reader-text"><?php _e( '评论分页', '_s' ); ?></h2>
			<div class="nav-links">

				<div class="nav-previous"><?php previous_comments_link( __( '更早的评论', '_s' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( '更新的评论', '_s' ) ); ?></div>

			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-above -->
		<?php endif; // 检查评论分页 ?>

		<ol class="comment-list">
			<?php
				wp_list_comments( array(
					'style'      => 'ol',
					'short_ping' => true,
				) );
			?>
		</ol><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // 显示评论分页 ?>
		<nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
			<h2 class="screen-reader-text"><?php _e( '评论分页', '_s' ); ?></h2>
			<div class="nav-links">

				<div class="nav-previous"><?php previous_comments_link( __( '更早的评论', '_s' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( '更新的评论', '_s' ) ); ?></div>

			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-below -->
		<?php endif; // check for comment navigation ?>

	<?php endif; // have_comments() ?>

	<?php
		// 如果评论关闭，显示相应的提示信息
		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php _e( '评论已关闭', '_s' ); ?></p>
	<?php endif; ?>

	<?php comment_form(); ?>

</div><!-- #comments -->
