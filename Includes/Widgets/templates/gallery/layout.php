<div class="dmt-gallery-items">
	<div class="row">
		<?php if ( $galleries ) : ?>
			<?php foreach ( $galleries as $key => $item ) : ?>
				<div class="col-lg-4 col-md-4 col-sm-4">
					<div class="dmt-gallery-item">
						<img src="<?php echo esc_url( $item['gallery_imege'] ) ?>"
							 alt="<?php echo esc_attr( $item['gallery_info'] ) ?>">
					</div>
				</div>
			<?php endforeach; ?>
		<?php endif; ?>
	</div>
</div>
<!-- /.dmt-gallery-items -->