<?php

global $product, $gmart_sc;
$classes_column = array();
$column         = dmt_option( 'shop_column', '3' );

$product_style = dmt_option( 'product_style', 'style--one' );



if ( $product_style ) {
	$classes_product = $product_style;
}




//if ( isset( $gmart_sc['columns'] ) && $gmart_sc['columns'] ) {
//	$classes_column[] = 'col-lg-' . $col . ' col-md-' . $col . ' col-sm-6';
//} elseif ( $column ) {
//	$classes_column[] = 'col-md-4 col-sm-6 col-lg-' . $column;
//}

$classes_column[] = 'col-md-4 col-sm-6 col-lg-' . $column;

?>

<?php if ( $loadmore == 1 ): ?>
	<?php if ( $wp_query->have_posts() ) : ?>
		<?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
			<div <?php wc_product_class( $classes_column, $product ); ?>>
				<div class="dmt-product-item <?php echo esc_attr( $classes_product ); ?>">
					<?php wc_get_template_part( 'content-product-grid' ); ?>
				</div>
			</div>
		<?php endwhile; // end of the loop. ?>
	<?php else : ?>
		<?php wc_get_template( 'loop/no-products-found.php' ); ?>
	<?php endif; ?>

<?php else : ?>
	<?php set_query_var( 'layout_shop', $layout_shop ); ?>
	<?php if ( $wp_query->have_posts() ) : ?>
		<?php woocommerce_product_loop_start(); ?>
		<?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
			<div <?php wc_product_class( $classes_column, $product ); ?>>
				<div class="dmt-product-item <?php echo esc_attr( $classes_product ); ?>">
					<?php wc_get_template_part( 'content-product-grid' ); ?>
				</div>
			</div>
		<?php endwhile; // end of the loop. ?>
		<?php woocommerce_product_loop_end(); ?>
	<?php else : ?>
		<?php wc_get_template( 'loop/no-products-found.php' ); ?>
	<?php endif; ?>

<?php endif; ?>