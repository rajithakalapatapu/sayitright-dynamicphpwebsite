<?php get_header();?>
<div id="content">

	<div class="breadcrumb">
		<img src="<?php echo get_site_url();?>/imgsay/home-banner.jpg" alt="Home Page">
		<h6 id="breadcrumbh6">Home --> Blog </h6>
		<h2 id="breadcrumbh4">Blog</h2>
	</div>


	<!-- <?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post();?>

			<div class="post">
				<div class="post-title">
					<h1>
						<a href="<?php the_permalink() ?>" rei="bookmark" title="Permalink to <?php the_title_attribute(); ?>">
							<?php the_title(); ?>
						</a>
					</h1>
					<span class="post-cat">
						<?php the_category(', ') ?>
					</span>
					<span class="post-comments">
						<?php comments_popup_link('No comments', '1 Comment', '% Comments'); ?>
					</span>
				</div>
				<div class="entry">
					<?php the_content('Read the rest of the entry;'); ?>
				</div>
			</div>
		<?php endwhile; ?>
	-->


	<div class="row">
		<div class="col-sm-12">

			<?php
			if ( have_posts() ) : while ( have_posts() ) : the_post();

				get_template_part( 'content', get_post_format() );

			endwhile; endif;
			?>
			<?php else : ?>
				<h2> Not found </h2>
			<?php endif; ?>

		</div> <!-- /.col -->
	</div> <!-- /.row -->

</div>
<?php get_footer();?>
