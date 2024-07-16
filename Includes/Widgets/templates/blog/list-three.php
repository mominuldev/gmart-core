<div class="gotox__post-list gotox__post-list--<?php echo esc_attr($settings['layout']); ?>">

	<?php if (has_post_thumbnail()): ?>
		<div class="gotox__feature-image">
			<?php the_post_thumbnail('gotox-blog-list_300x185', array('class' => 'img-fluid')) ?>
		</div>
	<?php endif; ?>

	<div class="gotox-post__date-meta">
		<?php Dmt_Theme_Helper::gotox_posted_date(); ?>
	</div>

	<div class="gotox__blog-content">
		<div class="gotox__post-list-title-wrapper">
			<h3 class="gotox__entry-title"><a href="<?php echo get_the_permalink(); ?>"><?php the_title(); ?></a></h3>
		</div>

		<p class="gotox-post__entry-content">
			<?php echo Dmt_Theme_Helper::gotox_excerpt($settings['content_length']); ?>
		</p>
	</div>
</div>



