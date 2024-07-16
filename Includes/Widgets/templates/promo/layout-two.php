<div <?php $this->print_render_attribute_string( 'wrapper' )?>>
	<div class="dmt-promo__image">
		<?php if ( ! empty( $settings['promo_image']['url'] ) ) : ?>
			<img src="<?php echo esc_url( $settings['promo_image']['url'] ); ?>" alt="<?php echo esc_attr( $settings['promo_title'] ); ?>">
		<?php endif; ?>
	</div>
	<!-- /.dmt-promo__image -->

	<div class="dmt-promo__content">
		<div class="dmt-promo__content-inner">
			<?php if ( ! empty( $settings['promo_sub_title'] ) ) : ?>
				<h3 class="dmt-promo__subtitle"><?php echo $settings['promo_sub_title']; ?></h3>
			<?php endif; ?>

			<?php if ( ! empty( $settings['promo_title'] ) ) : ?>
				<h2 class="dmt-promo__title"><?php echo $settings['promo_title']; ?></h2>
			<?php endif; ?>

			<?php if ( ! empty( $settings['promo_btn_text'] ) ) : ?>
				<a <?php echo $this->get_render_attribute_string( 'btn_link' ); ?>><?php echo $settings['promo_btn_text']; ?></a>
			<?php endif; ?>
		</div>
	</div>
	<!-- /.dmt-promo__content -->
</div>
<!-- /.dmt-promo -->