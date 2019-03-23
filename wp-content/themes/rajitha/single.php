<?php get_header(); ?>

<div class="single_entry_row">
	<div class="single_entry_col">

		<?php
		if ( have_posts() ) : while ( have_posts() ) : the_post();
			get_template_part( 'content-single', get_post_format() );
		endwhile; endif;
		?>

	</div> <!-- /.col -->
</div> <!-- /.row -->

<?php get_footer(); ?>