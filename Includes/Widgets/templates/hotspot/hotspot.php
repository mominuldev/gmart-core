<?php
//$product_id = $settings['product_id']; // Replace 123 with the actual product ID
//$product = wc_get_product($product_id);
//
//var_dump($product_id);
//
//if ($product) {
//	// Product found, you can access its data
//	$product_title = $product->get_title();
//	$product_price = $product->get_price();
//
//	// Perform operations with product data
//	echo "Product Title: $product_title, Price: $product_price";
//} else {
//	// Product not found
//	echo "Product not found";
//}

?>

<div class="product-hotspot">
	<div class="product-hotspot__image">
		<img src="<?php echo esc_url( $settings['hotspot_image']['url'] ); ?>" alt="<?php echo esc_attr__( 'Hotspot Image', 'gmart-core' ); ?>">
	</div>

	<div class="product-hotspot__list">
		<?php if ( ! empty( $settings['hotspot'] ) ) : ?>
			<?php foreach ( $settings['hotspot'] as $index => $item ) :

				$product = wc_get_product( $item['product_id'] );

				// Item Class
				$this->add_render_attribute( 'item', 'class', 'product-hotspot__item' );

				$this->add_render_attribute( 'list-item', 'class', [
					'product-hotspot__item',
					'elementor-repeater-item-' . $item['_id'],
				] );


				if ( ! $product ) {
					continue;
				}

				$product_title = $product->get_title();
				$product_price = $product->get_price();

				?>
				<div <?php $this->print_render_attribute_string( 'list-item' ); ?>>
					<div class="product-hotspot__item-icon">
						<i class="ri-add-line"></i>

						<div class="product-hotspot__item-content">

							<div class="product-hotspot__item-image">
								<?php echo $product->get_image(); ?>
							</div>


							<?php echo wc_get_rating_html( $product->get_average_rating() ); ?>

							<div class="product-hotspot__item-title">
								<?php echo $product_title; ?>
							</div>
							<span class="product-hotspot__item-description">
								$<?php echo $product_price; ?>
							</span>

							<a href="<?php echo esc_url( $product->get_permalink() ); ?>" class="dmt-btn-link product-hotspot__item-btn">
								<?php echo esc_html__( 'View Product', 'gmart-core' ); ?>
							</a>

						</div>
					</div>

				</div>
			<?php endforeach; ?>
		<?php endif; ?>
	</div>
</div>
