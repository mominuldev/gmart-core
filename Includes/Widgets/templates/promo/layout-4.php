<div class="tt-promo style_four">
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

		<?php if ( ! empty( $settings['coupon_text'] ) ) : ?>
			<span class="tt-promo_coupon-info"><?php echo $settings['coupon_text']; ?></span>
		<?php endif; ?>


		<?php if ( ! empty( $settings['promo_btn_text'] ) ) : ?>
			<span class="promo-text"><?php echo $settings['promo_btn_text']; ?></span>
		<?php endif; ?>
	</div>
	<!-- /.tt-promo__content -->
</div>
<!-- /.tt-promo -->