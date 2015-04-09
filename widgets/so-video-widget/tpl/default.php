<?php echo $args['before_title'] . esc_html($instance['title']) . $args['after_title'] ?>

<div>
	<video width="640" height="360" id="player1" preload="none" poster="<?php echo esc_attr( $poster ) ?>">
		<source type="video/<?php echo $video_type ?>" src="<?php echo esc_attr( $src ) ?>" />
	</video>
</div>