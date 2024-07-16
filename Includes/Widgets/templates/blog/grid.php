<div class="col-md-6 col-sm-6 col-lg-<?php echo esc_attr($settings['column']); ?>">
	<div class="dmt-blog-post blog-post-grid wow fadeInUp" data-wow-delay="<?php echo $ant;?>s">
		<?php if (has_post_thumbnail()) : ?>
			<div class="post-thumbnail-wrapper">
				<?php Dmt_Theme_Helper::gmart_post_thumbnail(); ?>
				<div class="post-date">
					<span class="day"><?php echo get_the_date('d'); ?></span>
					<span class="month"><?php echo get_the_date('M'); ?></span>
				</div>
			</div>
			<!-- /.post-thumbnail-wrapper -->
		<?php endif; ?>

		<div class="blog-content">
			<?php if ( 'post' === get_post_type() ) :
				$category_list = get_the_category_list( ' ' );
			    $show_category = $settings['show_category'];

				if ( $category_list && 'yes' === $show_category ) : ?>
					<div class="post-meta-wrapper">
						<?php echo wp_kses_post( $category_list ); ?>
					</div><!-- .entry-meta -->
				<?php endif; ?>
			<?php endif; ?>

			<?php the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>

			<div class="entry-content">
				<div class="blog-content-inner">

					<?php
						$word_count = $settings['content_length'];
					?>

					<p>
						<?php echo Dmt_Theme_Helper::gmart_substring( get_the_content(), $word_count, '...' ); ?>
					</p>

					<?php if ( is_singular() ) {
						wp_link_pages();
					} ?>

				</div>

				<div class="blog-footer">
					<?php if ( 'post' === get_post_type() ) : ?>
						<ul class="post-meta">
							<li>
								<i class="ri-user-6-line"></i>
								<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
									<?php the_author();?>
								</a>
							</li>
							<li>
								<i class="ri-chat-3-line"></i>
								<?php Dmt_Theme_Helper::gmart_entry_comments( get_the_ID() ); ?>
							</li>

							<li class="reading-time">
								<i class="ri-time-line"></i>
								<?php echo Dmt_Theme_Helper::post_reading_time( get_the_ID() ); ?>
							</li>
						</ul>
					<?php endif; ?>
				</div>
			</div>
		</div><!-- /.entry-content -->
	</div>
</div>