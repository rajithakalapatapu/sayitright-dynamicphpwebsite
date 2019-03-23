
<div class="commentlist">
	<?php

	function format_comment($comment, $args, $depth) {
	}

	wp_list_comments(
		array(
		'style' => 'div',
		'callback' => format_comment
		)
	);
	?>
</div>