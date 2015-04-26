<?php
/**
 * 底部模板
 *
 * 包含在#content关闭之后和所有内容之后
 *
 * @package _s
 */
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
			<a href="<?php echo esc_url( __( 'http://wordpress.org/', '_s' ) ); ?>"><?php printf( __( '自豪地采用 %s', '_s' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span>
			<?php printf( __( '主题：%1$s by %2$s.', '_s' ), '_s', '<a href="http://www.zhutico.com/dev/createtheme
 " rel="designer">主题酷</a>' ); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
