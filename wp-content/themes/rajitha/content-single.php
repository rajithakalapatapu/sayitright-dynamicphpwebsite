<div class="breadcrumb">
	<img src="<?php echo get_site_url();?>/imgsay/home-banner.jpg" alt="Home Page">
	<h6 id="breadcrumbh6">Home --> Blog </h6>
	<h2 id="breadcrumbh4">Blog</h2>
</div>

<div class="blog_entry">

	<div class="blog_entry_meta">
		<div class="blog_entry_date">
			<?php the_date(); ?>
		</div>
		<div class="blog_entry_author">
			<a href="#"><?php the_author(); ?></a>
		</div>
	</div>

	<div class="blog_entry_text">
		<div class="blog_entry_title black_text">
			<?php the_title(); ?>

		</div>
		<div class="blog_entry_content">
			<?php the_content(); ?>
		</div>
	</div>

	<div class="post_navigation">
		<div class="prev_post">
			<?php
			$previous_post = get_previous_post();
			if ( is_a( $previous_post , 'WP_Post' ) ) : ?>
				<div class="post_navigation_direction">
					Prev Post
				</div>
				<a class="post_navigation_link" href="<?php echo get_permalink( $previous_post->ID ); ?>">
					<?php echo get_the_title( $previous_post->ID ); ?>
				</a>
			<?php endif; ?>
		</div>
		<div class="next_post">
			<?php
			$next_post = get_next_post();
			if ( is_a( $next_post , 'WP_Post' ) ) : ?>
				<div class="post_navigation_direction">
					Next Post
				</div>
				<a  class="post_navigation_link" href="<?php echo get_permalink( $next_post->ID ); ?>">
					<?php echo get_the_title( $next_post->ID ); ?>
				</a>
			<?php endif; ?>
		</div>
	</div>


	<div class="comments">
		<span class="comments_count">
			<?php comments_number('No comments', '1 Comment', '% Comments'); ?>
		</span>
		<?php comments_template(); ?>
	</div>
	<?php
	$comments_args = array(
        // Change the title of send button
		'label_submit' => __( 'Send', 'textdomain' ),
        // Change the title of the reply section
		'title_reply' => __( 'Write a Reply or Comment', 'textdomain' ),
        // Remove "Text or HTML to be displayed after the set of comment fields".
		'comment_notes_after' => '',
        // Redefine your own textarea (the comment body).
		'comment_field' => '<p class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun' ) . '</label><br /><textarea id="comment" name="comment" aria-required="true"></textarea></p>',
	);
	comment_form( $comments_args );
	?>

</div>

