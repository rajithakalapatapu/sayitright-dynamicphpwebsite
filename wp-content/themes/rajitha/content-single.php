<div class="breadcrumb">
	<img src="<?php echo get_site_url();?>/imgsay/home-banner.jpg" alt="Home Page">
	<h6 id="breadcrumbh6">Home --> Blog </h6>
	<h2 id="breadcrumbh4">Blog</h2>
</div>



<div class="blog-post">
	<h1 class="blog-post-title black_text"><?php the_title(); ?></h1>
	<p class="blog-post-meta"><?php the_date(); ?> by <a href="#"><?php the_author(); ?></a></p>
	<?php the_content(); ?>

	<span class="post-comments">
		<?php comments_popup_link('No comments', '1 Comment', '% Comments'); ?>
	</span>

</div><!-- /.blog-post -->
<div class="navigation">
	<div class="prev_post">
		<?php
		$previous_post = get_previous_post();
		if ( is_a( $previous_post , 'WP_Post' ) ) : ?>
			<a href="<?php echo get_permalink( $previous_post->ID ); ?>"><?php echo get_the_title( $previous_post->ID ); ?></a>
		<?php endif; ?>
	</div>
	<div class="next_post">
		<?php
		$next_post = get_next_post();
		if ( is_a( $next_post , 'WP_Post' ) ) : ?>
			<a href="<?php echo get_permalink( $next_post->ID ); ?>"><?php echo get_the_title( $next_post->ID ); ?></a>
		<?php endif; ?>
	</div>
</div>
<div class="comment list">
	<?php
		$comments = get_comments());
	?>
</div>