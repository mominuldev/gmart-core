<div class="dmt-testimonial-two">
	<div <?php $this->print_render_attribute_string('wrapper'); ?>>
		<?php if ($settings['navigation'] == 'yes') : ?>
			<div class="testimonial-prev">
				<i class="fas fa-chevron-left"></i>
			</div>
		<?php endif; ?>
		<div class="swiper-wrapper">
			<?php if (is_array($testimonials)) :
				foreach ($testimonials as $testimonial) : ?>
					<?php
					if ($testimonial['image'] != '') {
						$avatar = $testimonial['image']['url'];
					}
					?>
					<div class="swiper-slide">
						<div <?php $this->print_render_attribute_string('testimonial'); ?>>

							<?php
							$rating = $testimonial['rating'];
							$this->add_render_attribute('star-rating', 'class', 'dmt-star-rating dmt-star-' . esc_attr($rating));

							$rating_markup = "<div class='dmt-star-rating dmt-star-" . $rating . "'>\n";
							$rating_markup .= "<span class=\"dmt-star-1\"></span>\n";
							$rating_markup .= "<span class=\"dmt-star-2\"></span>\n";
							$rating_markup .= "<span class=\"dmt-star-3\"></span>\n";
							$rating_markup .= "<span class=\"dmt-star-4\"></span>\n";
							$rating_markup .= "<span class=\"dmt-star-5\"></span>\n";
							$rating_markup .= "</div>";

							echo $rating_markup;
							?>

							<?php if ( ! empty( $testimonial['title'] ) ) : ?>
								<h3 class="testimonial__title"><?php echo $testimonial['title']; ?></h3>
							<?php endif; ?>

							<?php if (!empty($testimonial['review_content'])) : ?>
								<p class="testimonial__content">
									<?php echo $testimonial['review_content']; ?>
								</p>
							<?php endif; ?>

							<div class="testimonial__info-wrapper">
								<?php if (!empty($avatar)): ?>
									<div class="testimonial__avatar">
										<img class="author-image" src="<?php echo esc_url($avatar) ?>" alt="<?php echo esc_attr($testimonial['name']) ?>" height="120" width="120">
									</div>
								<?php endif; ?>

								<div class="testimonial__bio-wrapper">
									<?php if (!empty($testimonial['name'])) : ?>
										<h4 class="testimonial__name"><?php echo $testimonial['name']; ?></h4>
									<?php endif; ?>

									<?php if (!empty($testimonial['designation'])) : ?>
										<span class="testimonial__designation"><?php echo $testimonial['designation']; ?></span>
									<?php endif; ?>
								</div>

							</div>
							<!-- /.testimonial-info-wrapper -->
						</div>
					</div>
					<!-- /.swiper-slide -->
				<?php
				endforeach;
			endif;
			?>
		</div>

		<?php if ($settings['navigation'] == 'yes') : ?>
			<div class="testimonial-next ">
				<i class="fas fa-chevron-right"></i>
			</div>
		<?php endif; ?>

		<?php if ($settings['pagination'] == 'yes') { ?>
			<div class="testimonial-pagination dmt-slider-pagination"></div>
		<?php } ?>
	</div>
	<!-- /.swiper-wrapper -->

	<?php if (! empty( $settings['image']['url'])) : ?>
		<div class="testimonial-image">
			<img src="<?php echo esc_url($settings['image']['url']); ?>" alt="<?php echo esc_attr__('Testimonial Image'); ?>">
		</div>
	<?php endif; ?>

</div>
<!-- /.dmt-testimonial-wrapper -->
