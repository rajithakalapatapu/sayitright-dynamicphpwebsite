<div class="blog-post">
	<h1 class="blog-post-title">
		<a href="<?php the_permalink() ?>" rei="bookmark" title="Permalink to <?php the_title_attribute(); ?>">
			<?php the_title(); ?>
		</a>
	</h1>
	<p class="blog-post-meta"><?php the_date(); ?> by <a href="#"><?php the_author(); ?></a></p>

	<?php the_excerpt(); ?>

</div><!-- /.blog-post -->