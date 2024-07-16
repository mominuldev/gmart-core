<div <?php echo $this->get_render_attribute_string( 'wrapper' ) ?>>
	<div class="container">
		<div class="row align-items-center">
			<div class="col-lg-5 dmt-order-2">
				<div class="banner__content">
					<?php if ( ! empty( $settings['subtitle'] ) ) : ?>
						<h3 <?php echo $this->get_render_attribute_string( 'subtitle' ); ?>>
							<?php echo $settings['subtitle']; ?>
						</h3>
					<?php endif; ?>

					<?php if ( ! empty( $settings['title'] ) ) : ?>
						<h1 <?php echo $this->get_render_attribute_string( 'title' ); ?>>
							<?php echo $settings['title']; ?>
						</h1>
					<?php endif ?>

					<?php if ( ! empty( $settings['description'] ) ) : ?>
						<p class="wow fadeInUp banner__description" data-wow-delay=".5s">
							<?php echo $settings['description']; ?>
						</p>
					<?php endif ?>

					<div class="banner__btns wow fadeInUp" data-wow-delay=".7s">
						<?php if ( ! empty( $settings['btn_link']['url'] ) ) : ?>
							<a <?php $this->print_render_attribute_string( 'button' ); ?>>
								<?php echo $settings['btn_text'] ?>
							</a>
						<?php endif; ?>
					</div>
				</div>
			</div>

			<?php if ( ! empty( $settings['feature_image']['url'] ) || ! empty( $settings['feature_image_two']['url'] ) ) : ?>
				<div class="col-lg-7">
					<div class="banner__feature-image-wrap">
						<?php if ( ! empty( $settings['feature_image']['url'] ) ) : ?>
							<div class="banner__feature-image mt-85">
								<div class="banner__feature-image-content">
									<h3 class="banner__cat-title">
										<?php echo $settings['banner-cat-title']; ?>
									</h3>
								</div>
								<img src="<?php echo esc_url( $settings['feature_image']['url'] ); ?>"
									 class="wow fadeInUp"
									 data-wow-delay="0.5s" alt="<?php echo esc_attr( $settings['title'] ); ?>">
							</div>
						<?php endif; ?>
						<!-- /.banner-feature-image -->

						<?php if ( ! empty( $settings['feature_image_two']['url'] ) ) : ?>
							<div class="banner__feature-image banner--feature-image-two before-bg-secondary">
								<div class="banner__feature-image-content">
									<h3 class="banner__cat-title">
										<?php echo $settings['banner-cat-title-two']; ?>
									</h3>
								</div>
								<img src="<?php echo esc_url( $settings['feature_image_two']['url'] ); ?>" class="wow fadeInUp" data-wow-delay="0.5s" alt="<?php echo esc_attr( $settings['title'] ); ?>">
							</div>
						<?php endif; ?>
						<!-- /.banner-feature-image -->

<!--						Badges-->
						<?php if ( ! empty( $settings['badge_image']['url'] ) ) : ?>
							<div class="banner__badge-image badge-image">
								<img src="<?php echo esc_url( $settings['badge_image']['url'] ); ?>" class="wow fadeIn
								Up" data-wow-delay="0.5s" alt="<?php echo esc_attr( $settings['title'] ); ?>">
							</div>
						<?php endif; ?>
					</div>
					<!-- /.banner__feature-image-wrap -->
				</div>
				<!-- /.col-md-7 -->
			<?php endif; ?>

		</div>
	</div>

</div>
