<?php
global $wp_query, $wp;
$widget_id       = 'dmt_filter_ajax' . rand() . time();
$array_value_url = $_GET ? ( base64_encode( serialize( $_GET ) ) ) : "";
$layout_shop     = 1;
$shop_paging     = dmt_option( 'shop_paging', 'shop-pagination' );
$base_url        = get_permalink( wc_get_page_id( 'shop' ) );
$taxonomy        = get_query_var( 'taxonomy' );
$id_taxonomy     = isset( get_queried_object()->term_id ) ? get_queried_object()->term_id : 0;
$relation        = 'AND';
?>
<div id="<?php echo esc_attr( $widget_id ); ?>" class="dmt-woocommerce-filter-product">
	<?php if ( $title1 != '' ) : ?>
		<div class="dmt-block-title">
			<!-- Title -->
			<?php if ( $title1 != '' ) { ?>
				<h2><?php echo $title1; ?></h2>
			<?php } ?>
		</div>
	<?php endif; ?>
	<?php
	//Filter Categories//
	if ( $show_category ) {
		$this->woocommerce_filter_category();
	}
	?>
	<?php require( DMT_WIDGET_TEMPLATE_PATH . 'dmt-ajax-filter/filter.php' ); ?>
	<?php
	//Filter Brand
	if ( $show_brand ) {
		$this->woocommerce_filter_brand( $showcount );
	}
	?>
</div>
<script type="text/javascript">
	jQuery(document).ready(function ($) {
		$("#<?php echo $widget_id; ?>").binFilterProduct({
			widget_id: $("#<?php echo esc_js( $widget_id ); ?>"),
			taxonomy: "<?php echo esc_js( $taxonomy ); ?>",
			id_taxonomy:<?php echo esc_js( $id_taxonomy ); ?>,
			base_url: "<?php echo esc_js( $base_url ); ?>",
			attribute: "<?php echo ( isset( $attribute ) && $attribute ) ? esc_js( implode( ',', $attribute ) ) : ""; ?>",
			showcount:<?php echo esc_js( $showcount ); ?>,
			show_price:<?php echo esc_js( $show_price ); ?>,
			relation: "<?php echo esc_js( $relation ); ?>",
			show_category:<?php echo esc_js( $show_category ); ?>,
			show_brand:<?php echo esc_js( $show_brand ); ?>,
			layout_shop:<?php echo esc_js( $layout_shop ); ?>,
			shop_paging: "<?php echo esc_js( $shop_paging ); ?>",
			array_value_url: "<?php echo esc_js( $array_value_url ); ?>"
		});
	});
</script>