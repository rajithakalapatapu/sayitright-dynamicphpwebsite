<div class="breadcrumb">
	<img src="<?php echo get_site_url();?>/imgsay/home-banner.jpg" alt="Home Page">
	<h6 id="breadcrumbh6">Home --> Blog </h6>
	<h2 id="breadcrumbh4">Blog</h2>
</div>

<div class="blog_entry">

	<div class="blog_entry_meta">
		<div class="blog_entry_date">
			<?php the_date(); ?>
			<img width=24 height=24 src="<?php echo get_site_url();?>/imgsay/calendar-alt-regular.png" />
		</div>
		<div class="blog_entry_author">
			<a href="#"><?php the_author(); ?></a>
			<?php echo get_avatar( get_the_author_meta( 'ID' ), 24 ); ?>
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
		<div class="comments_list">
			<?php comments_template(); ?>
			<?php

			// print("<div class="contactusleft">");
			$args = array (
				'label_submit' => __( 'Post Comment', 'textdomain' ),
				'comment_field' => '',
				'comment_notes_before' => '',
				'comment_notes_after' => '',
				'class_submit' => 'enter_comment_submit',
				'class_form' => 'enter_comment_form',
				'fields' => apply_filters('comment_form_default_fields',
					array(
					'author' => '
					<div class="entry_comment">
					<div class="entry_comment_grid">
					<div class="enter_comment_author">
                        <input type="text" name="fname" value="Enter Name">
                    </div>
					',
					'message' => '
					<div class="enter_comment_message">
                        <input type="text" name="message" value="Message">
                    </div>
                    </div>
					',
					'cookies' => '
					',
					'email' => '
					<div class="enter_comment_email">
                        <input type="text" name="email" value="Enter email address">
                    </div>
					',
					'subject' => '
					<div class="enter_comment_subject">
                        <input type="text" name="subject" value="Subject">
                    </div>
                    </div>
					',
					)
				)
			);
			// print("</div>");
			comment_form($args);
			?>
		</div>

	</div>
</div>

