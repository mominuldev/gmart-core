<div class="tt-promo style_three">
	<div class="tt-promo__content-wrapper">

		<div class="tt-promo__content">
			<?php if ( ! empty( $settings['promo_sub_title'] ) ) : ?>
				<h3 class="tt-promo__subtitle"><?php echo $settings['promo_sub_title']; ?></h3>
			<?php endif; ?>

			<?php if ( ! empty( $settings['promo_title'] ) ) : ?>
				<h3 class="tt-promo__title"><?php echo $settings['promo_title']; ?></h3>
			<?php endif; ?>

			<?php if ( ! empty( $settings['promo_description'] ) ) : ?>
				<p class="tt-promo__description"><?php echo $settings['promo_description'] ?></p>
			<?php endif; ?>
		</div>
		<div class="tt-promo__button-container">
			<?php if ( ! empty( $settings['promo_btn_text'] ) ) : ?>
				<a href="<?php echo esc_url( $settings['promo_link']['url'] ); ?>"	class="tt-btn tt-promo__btn"><?php echo $settings['promo_btn_text']; ?><i class="feather-arrow-right"></i></a>
			<?php endif; ?>
		</div>
	</div>
	<!-- /.tt-promo__content -->

</div>
<!-- /.tt-promo -->