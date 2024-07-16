<div class="dmt-contact-info">

	<?php if ( ! empty( $settings['icon'] ) ) : ?>
		<div class="dmt-contact-info__icon">
			<?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?>
		</div>
		<!-- /.dmt-contact-info__icon -->
	<?php endif; ?>

	<?php if ( ! empty( $settings['title'] ) ) : ?>
		<h3 class="dmt-contact-info__title">
			<?php echo $settings['title']; ?>
		</h3>
	<?php endif; ?>

	<?php
	// br check for new line with p tag

	?>

	<?php if ( ! empty( $settings['contact_info'] ) ) :
		// Press Enter to create a new line with p tag
		$info = nl2br( $settings['contact_info'] );
		$info = str_replace( '<br />', '<p>', $info );
		?>
		<div class="dmt-contact-info__info">
			<p><?php echo $info; ?></p>
		</div>
	<?php endif; ?>

	<?php if ( ! empty( $settings['url_label'] ) ) : ?>
		<div class="dmt-contact-info__button">
			<a href="<?php echo $settings['link']['url']; ?>" class="dmt-btn">
				<?php echo $settings['url_label']; ?>
			</a>

			<?php if ( ! empty( $settings['extra_info'] ) ) : ?>
				<p class="dmt-contact-info__extra-info">
					<?php echo $settings['extra_info']; ?>
				</p>
			<?php endif; ?>

		</div>
	<?php endif; ?>
</div>
