<div class="dmt-testimonial-wrapper">

	<div <?php $this->print_render_attribute_string( 'wrapper' ); ?>>

		<?php if ( $settings['navigation'] == 'yes' ) : ?>
			<div class="testimonial-prev">
				<i class="ri-arrow-left-line"></i>
			</div>
		<?php endif; ?>
		<div class="swiper-wrapper">
			<?php if ( is_array( $testimonials ) ) :
				foreach ( $testimonials as $testimonial ) : ?>
					<?php
					if ( $testimonial['image'] != '' ) {
						$avatar = $testimonial['image']['url'];
					}
					?>
					<div class="swiper-slide">
						<div <?php $this->print_render_attribute_string( 'testimonial' ); ?>>

							<?php if ( ! empty( $avatar ) ): ?>
								<div class="testimonial__avatar">
									<img class="author-image" src="<?php echo esc_url( $avatar ) ?>" alt="<?php echo esc_attr( $testimonial['name'] ) ?>" height="120" width="120">
								</div>
							<?php endif; ?>

							<?php if ( $settings['show_quotes'] == 'yes' ) : ?>
								<div class="testimonial__quote">
									<svg xmlns="http://www.w3.org/2000/svg" width="28" height="24" viewBox="0 0 28 24" fill="none">
										<path d="M0 0V24L12 12V0H0Z" fill="#CFDBDD"/>
										<path d="M16 0V24L28 12V0H16Z" fill="#CFDBDD"/>
									</svg>
								</div>
							<?php endif; ?>

							<?php if ( ! empty( $testimonial['review_content'] ) ) : ?>
								<p class="testimonial__content">
									<?php echo $testimonial['review_content']; ?>
								</p>
							<?php endif; ?>

							<div class="testimonial__info-wrapper">
								<div class="bio-wrapper">
									<?php if ( ! empty( $testimonial['name'] ) ) : ?>
										<h4 class="testimonial__name"><?php echo $testimonial['name']; ?></h4>
									<?php endif; ?>

									<?php if ( ! empty( $testimonial['designation'] ) ) : ?>
										<span class="testimonial__designation"><?php echo $testimonial['designation']; ?></span>
									<?php endif; ?>
								</div>

								<?php
								$rating = $testimonial['rating'];
								$this->add_render_attribute( 'star-rating', 'class', 'dmt-star-rating dmt-star-' . esc_attr( $rating ) );

								$rating_markup = "<div class='dmt-star-rating dmt-star-" . $rating . "'>\n";
								$rating_markup .= "<span class=\"dmt-star-1 fa-star\"></span>\n";
								$rating_markup .= "<span class=\"dmt-star-2 fa-star\"></span>\n";
								$rating_markup .= "<span class=\"dmt-star-3 fa-star\"></span>\n";
								$rating_markup .= "<span class=\"dmt-star-4 fa-star\"></span>\n";
								$rating_markup .= "<span class=\"dmt-star-5 fa-star\"></span>\n";
								$rating_markup .= "</div>";

								if( $settings['show_rating'] == 'yes') {
									echo $rating_markup;
								}
								?>
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

		<?php if ( $settings['navigation'] == 'yes' ) : ?>
			<div class="testimonial-next ">
				<i class="ri-arrow-right-line"></i>
			</div>
		<?php endif; ?>
	</div>
	<!-- /.swiper-wrapper -->
	<?php if ( $settings['pagination'] == 'yes' ) { ?>
		<div class="testimonial-pagination dmt-slider-pagination swiper-pagination"></div>
	<?php } ?>

</div>
<!-- /.dmt-testimonial-wrapper -->
