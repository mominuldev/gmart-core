<?php

use GPTheme\GmartCore\ImageSize;

if ( ! isset( $settings ) ) {
	$settings = array();
}

$ant = 0.5;

while ( $dmt_query->have_posts() ) :
	$dmt_query->the_post();
	$classes      = array( "dmt-project grid-item" );
	$reveal       = $settings['reveal_animation'];
	$grid_classes = '';

	if ( 'yes' == $reveal ) {
		$grid_classes .= 'overlay_effect ';
	}

	if ( 'yes' == $settings['tilt-effect'] ) {
		$grid_classes .= 'tilt-effect ';
	}

	if ( ! empty( $settings['grid_animation'] ) ) {
		$grid_classes .= $settings['grid_animation'] . ' wow ';
	}
	if ( ! empty( $settings['overlay_style'] ) ) {
		$grid_classes .= $settings['overlay_style'];
	}

	?>
	<figure <?php post_class( implode( ' ', $classes ) ); ?>>
		<div class="dmt-project__wrapper dmt-box <?php echo $grid_classes; ?>" data-wow-delay="<?php echo esc_attr( $ant ); ?>s">
			<div class="dmt-project__thumbnail-wrapper">
				<div class="dmt-project__thumbnail">
					<a href="<?php echo the_permalink(); ?>" class="post-permalink link-secret">
						<?php if ( has_post_thumbnail() ) { ?>
							<?php $size = ImageSize::elementor_parse_image_size( $settings, '480x480' ); ?>
							<?php ImageSize::the_post_thumbnail( array( 'size' => $size ) ); ?>
						<?php } ?>
						<?php if ( 'grid-card' == $settings['overlay_style'] ) : ?>
							<span class="dmt-project__permalink"><?php echo 'Case <br> Studies' ?></span>
						<?php endif; ?>

						<?php if ( 'gird-overlay' == $settings['overlay_style'] ) : ?>
							<div class="dmt-project__info">
								<div class="dmt-project__cat">
									<?php
									$terms = get_the_terms( get_the_ID(), 'project_category' );

									if ( $terms && ! is_wp_error( $terms ) ) :
										foreach ( $terms as $term ) { ?>
											<span class="dmt-project__cat-item"><?php echo $term->name; ?></span>
										<?php } ?>
									<?php endif; ?>
								</div>

								<h3 class="dmt-project__title">
									<?php the_title(); ?>
								</h3>

							</div>
						<?php endif; ?>
					</a>
				</div>
			</div>

			<?php if ( 'grid-card' == $settings['overlay_style'] ) : ?>
				<div class="dmt-project__info">

					<div class="dmt-project__cat" data-wow-delay="<?php echo esc_attr( $ant ); ?>s">
						<?php
						$terms = get_the_terms( get_the_ID(), 'project_category' );

						if ( $terms && ! is_wp_error( $terms ) ) :
							foreach ( $terms as $term ) { ?>
								<span class="dmt-project__cat-item"><?php echo $term->name; ?></span>
							<?php } ?>
						<?php endif; ?>
					</div>

					<h3 class="dmt-project__title" data-wow-delay="<?php echo esc_attr( $ant ); ?>s" data-hover="<?php the_title(); ?>">
						<a href="<?php echo the_permalink(); ?>"><?php the_title(); ?></a>
					</h3>

				</div>
			<?php endif; ?>
		</div>
	</figure>

	<?php
	$ant = $ant + 0.2;
endwhile;
?>