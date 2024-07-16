<?php
/**
 * The template for displaying product slider widget
 *
 * This template can be overridden by copying it to yourtheme/ultrastore/elementor/slider.php
 */

$style = $settings['prod_style'];

$count = $list->post_count;
$j     = 1;


if ( $list->have_posts() ) { ?>
	<div class="dmt_product_wrapper">

		<div class="product-header-wrap">
			<?php if ( $settings['subtitle'] || $settings['title'] ): ?>
				<div class="section-heading">
					<?php if ( $settings['subtitle'] ): ?>
						<h3 class="subtitle"><?php echo esc_html( $settings['subtitle'] ); ?></h3>
					<?php endif; ?>

					<?php if ( $settings['title'] ): ?>
						<h2 class="section-title"><?php echo esc_html( $settings['title'] ); ?></h2>
					<?php endif; ?>
				</div>
				<!-- /.heading-wrap -->
			<?php endif; ?>

			<?php if ( $settings['navigation'] == 'yes' ): ?>
				<div class="slider-controller">
					<div class="slider-control">
						<div class="product-prev">
							<i class="ri-arrow-left-line"></i>
						</div>

						<div class="product-next">
							<i class="ri-arrow-right-line"></i>
						</div>
					</div>
					<!-- /.slider-control -->
				</div>
				<!-- /.slider-controller -->
			<?php endif; ?>
		</div>
		<!-- /.product-header-wrap -->

		<div class="dmt-product-slider">
			<div <?php $this->print_render_attribute_string( 'wrapper' ); ?>>
				<div class="swiper-wrapper">
					<?php while ( $list->have_posts() ): $list->the_post();
						global $product, $post, $wpdb, $average; ?>
						<div class="swiper-slide">
							<div class="dmt-product-item <?php echo esc_attr($settings['prod_style']); ?>">
								<?php wc_get_template_part( 'content', 'product-grid' ); ?>
							</div>
							<!-- /.dmt-product-item -->
						</div>
						<?php $j ++; ?>
					<?php endwhile;
					wp_reset_postdata(); ?>
				</div>
				<?php if($settings['scrollbar'] == 'yes') { ?>
					<div class="swiper-scrollbar"></div>
				<?php } ?>

				<?php if($settings['pagination'] == 'yes') { ?>
					<div class="dmt-slider-pagination product-carousel-pagination"></div>
				<?php } ?>
			</div>
		</div>
	</div>
	<?php
}
