<?php
/**
 * 标签模板
 *
 * 一些函数将会替换WordPress的核心功能
 *
 * @package _s
 */

if ( ! function_exists( 'the_posts_navigation' ) ) :
/**
 * 显示上一页/下一页分页
 *
 * @todo WordPress 4.3发布时移除这个函数
 */
function the_posts_navigation() {
	// 如果只有一页时不打印空标签
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	?>
	<nav class="navigation posts-navigation" role="navigation">
		<h2 class="screen-reader-text"><?php _e( 'Posts navigation', '_s' ); ?></h2>
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( __( 'Older posts', '_s' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts', '_s' ) ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'the_post_navigation' ) ) :
/**
 * 显示上一页/下一页分页
 *
 * @todo WordPress 4.3发布时移除这个函数
 */
function the_post_navigation() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="navigation post-navigation" role="navigation">
		<h2 class="screen-reader-text"><?php _e( '文章分页', '_s' ); ?></h2>
		<div class="nav-links">
			<?php
				previous_post_link( '<div class="nav-previous">%link</div>', '%title' );
				next_post_link( '<div class="nav-next">%link</div>', '%title' );
			?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( '_s_posted_on' ) ) :
/**
 * 在meta中打印当前文章发布日期/时间，作者信息
 */
function _s_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		_x( '%s', '发布于', '_s' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		_x( '%s', '作者', '_s' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>';

}
endif;

if ( ! function_exists( '_s_entry_footer' ) ) :
/**
 * 在meta中打印分类，标签和评论
 */
function _s_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' == get_post_type() ) {
		/* 翻译：翻译逗号之后*/
		$categories_list = get_the_category_list( __( ', ', '_s' ) );
		if ( $categories_list && _s_categorized_blog() ) {
			printf( '<span class="cat-links">' . __( '发布于 %1$s', '_s' ) . '</span>', $categories_list );
		}

		/* 翻译：翻译逗号之后*/
		$tags_list = get_the_tag_list( '', __( ', ', '_s' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . __( '标签%1$s', '_s' ) . '</span>', $tags_list );
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link( __( '留下您的评论', '_s' ), __( '1条评论', '_s' ), __( '%条评论', '_s' ) );
		echo '</span>';
	}

	edit_post_link( __( '编辑', '_s' ), '<span class="edit-link">', '</span>' );
}
endif;

if ( ! function_exists( 'the_archive_title' ) ) :
/**
 * the_archive_title()
 *
 * 基于查询对象显示存档页面标题
 *
 * @todo WordPress 4.3发布时移除这个函数
 *
 * @param string $before 可选，内容的标题开头，默认的空
 * @param string $after  可选，内容添加到标题，默认的空
 */
function the_archive_title( $before = '', $after = '' ) {
	if ( is_category() ) {
		$title = sprintf( __( '分类：%s', '_s' ), single_cat_title( '', false ) );
	} elseif ( is_tag() ) {
		$title = sprintf( __( '标签：%s', '_s' ), single_tag_title( '', false ) );
	} elseif ( is_author() ) {
		$title = sprintf( __( '作者： %s', '_s' ), '<span class="vcard">' . get_the_author() . '</span>' );
	} elseif ( is_year() ) {
		$title = sprintf( __( '年：%s', '_s' ), get_the_date( _x( 'Y', '每年的文章存档的日期格式', '_s' ) ) );
	} elseif ( is_month() ) {
		$title = sprintf( __( '月： %s', '_s' ), get_the_date( _x( 'F Y', '每月的文章存档的日期格式', '_s' ) ) );
	} elseif ( is_day() ) {
		$title = sprintf( __( 'Day: %s', '_s' ), get_the_date( _x( 'F j, Y', '每天的文章存档的日期格式', '_s' ) ) );
	} elseif ( is_tax( 'post_format' ) ) {
		if ( is_tax( 'post_format', 'post-format-aside' ) ) {
			$title = _x( 'Aside', '文章存档页面文章标题', '_s' );
		} elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {
			$title = _x( 'Galleries', '文章存档页面文章标题', '_s' );
		} elseif ( is_tax( 'post_format', 'post-format-image' ) ) {
			$title = _x( 'Images', '文章存档页面文章标题', '_s' );
		} elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
			$title = _x( 'Videos', '文章存档页面文章标题', '_s' );
		} elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
			$title = _x( 'Quotes', '文章存档页面文章标题', '_s' );
		} elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
			$title = _x( 'Links', '文章存档页面文章标题', '_s' );
		} elseif ( is_tax( 'post_format', 'post-format-status' ) ) {
			$title = _x( 'Statuses', '文章存档页面文章标题', '_s' );
		} elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {
			$title = _x( 'Audio', '文章存档页面文章标题', '_s' );
		} elseif ( is_tax( 'post_format', 'post-format-chat' ) ) {
			$title = _x( 'Chats', '文章存档页面文章标题', '_s' );
		}
	} elseif ( is_post_type_archive() ) {
		$title = sprintf( __( '文章存档：%s', '_s' ), post_type_archive_title( '', false ) );
	} elseif ( is_tax() ) {
		$tax = get_taxonomy( get_queried_object()->taxonomy );
		/* 翻译： 1：文章标题自定义分类, 2：当前分类 */
		$title = sprintf( __( '%1$s: %2$s', '_s' ), $tax->labels->singular_name, single_term_title( '', false ) );
	} else {
		$title = __( '文章存档', '_s' );
	}

	/**
	 * 存档页面标题
	 *
	 * @param string $title 显示的存档页面标题
	 */
	$title = apply_filters( 'get_the_archive_title', $title );

	if ( ! empty( $title ) ) {
		echo $before . $title . $after;
	}
}
endif;

if ( ! function_exists( 'the_archive_description' ) ) :
/**
 * the_archive_description()
 *
 * 显示分类，标签或者描述
 *
 * @todo WordPress 4.3发布时移除这个函数
 *
 * @param string $before 可选，在内容之前插入描述
 * @param string $after 可选，在内容之后插入描述
 */
function the_archive_description( $before = '', $after = '' ) {
	$description = apply_filters( 'get_the_archive_description', term_description() );

	if ( ! empty( $description ) ) {
		/**
		 * 文章存档描述
		 *
		 * @see term_description()
		 *
		 * @param string $description 是否显示存档页面描述
		 */
		echo $before . $description . $after;
	}
}
endif;

/**
 * 当有超过一个分类时返回true
 *
 * @return bool
 */
function _s_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( '_s_categories' ) ) ) {
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			'number'     => 2,
		) );

		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( '_s_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// 有超过一个分类时， _s_categorized_blog 返回true
		return true;
	} else {
		// 只有一个分类时 _s_categorized_blog 返回false.
		return false;
	}
}

/**
 * in _s_categorized_blog.
 */
function _s_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	delete_transient( '_s_categories' );
}
add_action( 'edit_category', '_s_category_transient_flusher' );
add_action( 'save_post',     '_s_category_transient_flusher' );
