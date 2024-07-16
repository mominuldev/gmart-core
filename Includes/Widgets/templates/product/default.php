
<?php
/**
 * Product Widget Template
 *
 * @package MonksMart
 */
$class_col_lg = ($settings['columns'] == 5) ? '2-4'  : (12/$settings['columns']);
$class_col_md = ($settings['columns1'] == 5) ? '2-4'  : (12/$settings['columns1']);
$class_col_sm = ($settings['columns2'] == 5) ? '2-4'  : (12/$settings['columns2']);
$class_col_xs = ($settings['columns3'] == 5) ? '2-4'  : (12/$settings['columns3']);
$attributes = 'col-xl-'.$class_col_lg .' col-lg-'.$class_col_md .' col-md-'.$class_col_sm .' col-'.$class_col_xs;

$j=0;

// Style
$style = $settings['prod_style'];

if ( $list -> have_posts() ){ ?>
	<div class="dmt_product_wrapper">
		<!-- /.product-header-wrap -->
		<div class="content products-list row">
			<?php while($list->have_posts()): $list->the_post();
				global $product, $post, $wpdb, $average; ?>

				<div class="<?php echo esc_attr($attributes); ?>">
					<?php
					global $product,$post, $gmart_sc;

					// Ensure visibility.
					if ( empty( $product ) || ! $product->is_visible() ) {
						return;
					}
					?>

					<div class="dmt-product-item <?php echo esc_attr($style); ?>">
						<?php wc_get_template_part( 'content', 'product-grid' ); ?>
					</div>
					<!-- /.dmt-product-item -->
				</div>
			<?php endwhile; wp_reset_postdata();?>
		</div>
	</div>
	<?php
}
