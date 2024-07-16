<?php

// Control core classes for avoid errors
if ( class_exists( 'CSF' ) ) {

	/**
	 * Register About Widget.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
	 */
	CSF::createWidget( 'dmt_product_filter_widget', array(
		'title'       => __('DM Product Filter', 'gmart'),
		'classname'   => 'dmt-woocommerce-filter-product',
		'description' => __('Woocommerce product filter widget', 'gmart'),
		'fields'      => array(

			// Title
			array(
				'id'    => 'title',
				'type'  => 'text',
				'title' => __('Title', 'gmart'),
			),

			// Select Filter
            array(
                'id'      => 'select_filter',
                'type'    => 'select',
                'title'   => __('Select Filter', 'gmart'),
                'options' => array(
                    'category' => __('Category', 'gmart'),
                    'price' => __('price', 'gmart'),
                    'brand'    => __('Brand', 'gmart'),
                ),
            ),

			// Show Number of Products
			array(
				'id'    => 'showcount',
				'type'  => 'switcher',
				'title' => __('Show Number of Products', 'gmart'),
			),

			// Show Price
			array(
				'id'    => 'show_price',
				'type'  => 'switcher',
				'title' => __('Show Price', 'gmart'),
			),

            // Select Attribute For Filter
//            array(
//                'id'      => 'select_attribute',
//                'type'    => 'select',
//                'title'   => __('Select Attribute For Filter', 'gmart'),
//                'options' => array(
//                    'pirce' => __('price', 'gmart'),
//                    'color'    => __('Color', 'gmart'),
//                    'brand'    => __('Brand', 'gmart'),
//                ),
//            ),

			array(
				'id'          => 'select_attribute',
				'type'        => 'select',
				'title'       => 'Select woocommerce attribute',
				'placeholder' => 'Select a Attribute',
				'multiple' => true,
				'chosen'      => true,
				'ajax'        => true,
				'options'     => 'categories',
				'query_args'  => array(
					'taxonomy'  => 'woocommerce_attribute_taxonomies'
				)
			),


//			array(
//				'id'       => 'select_attribute',
//				'type'     => 'button_set',
//				'title'    => 'Button Set with multiple',
//				'multiple' => true,
//				'options'  => [
//					'color' => 'Color',
//					'label' => 'Label',
//					'image'  => 'Image',
//				]
//			),
		)
	) );


//
// Front-end display of widget example 1
// Attention: This function named considering above widget base id.
//
	if ( ! function_exists( 'dmt_product_filter_widget' ) ) {
		function dmt_product_filter_widget( $args, $instance ) {

			echo $args['before_widget'];

			$title = $instance['title'] ? $instance['title'] : '';
			$select_filter = $instance['select_filter'] ? $instance['select_filter'] : '';
			$attribute = $instance['select_attribute'] ? $instance['select_attribute'] : '';
			$showcount = $instance['showcount'] ? $instance['showcount'] : '';
			$show_price = $instance['show_price'] ? $instance['show_price'] : '';

			// Title
			if ( ! empty( $title ) ) {
				echo '<h2 class="widget-title">' . esc_html( $title ) . '</h2>';
			}

			include DMT_WIDGET_TEMPLATE_PATH . 'dmt-ajax-filter/default-new.php';



			echo $args['after_widget'];

		}
	}


	add_action( 'admin_enqueue_scripts', 'dmt_filter_admin_script'  );
	add_action( 'dmt_woocommerce_product_filter_result', 'dmt_filter_title'  );
	/* Ajax Callback */
	add_action( 'wp_ajax_dmt_filter_products_callback', 'dmt_filter_products_callback' );
	add_action( 'wp_ajax_nopriv_dmt_filter_products_callback', 'dmt_filter_products_callback' );


	function dmt_filter_title() {
		$chosen_attributes = \WC_Query::get_layered_nav_chosen_attributes();
		$meta_query        = WC()->query->get_meta_query();
		$tax_query         = WC()->query->get_tax_query();
		$prices            = get_filtered_price( $meta_query, $tax_query );
		$default_min_price = floor( $prices->min_price );
		$default_max_price = ceil( $prices->max_price );
		$min_price         = get_query_var( 'min_price' ) ? get_query_var( 'min_price' ) : $default_min_price;
		$max_price         = get_query_var( 'max_price' ) ? get_query_var( 'max_price' ) : $default_max_price;
		?>
		<div class="woocommerce-filter-title">
			<?php
			$check                = false;
			$attribute_taxonomies = wc_get_attribute_taxonomies();

			if ( $attribute_taxonomies ) {
				foreach ( $attribute_taxonomies as $attribute ) : $taxonomy = wc_attribute_taxonomy_name( $attribute->attribute_name ); ?>
					<?php if ( isset( $chosen_attributes[ $taxonomy ]['terms'] ) && $chosen_attributes[ $taxonomy ]['terms'] ): $check = true; ?>
						<?php foreach ( $chosen_attributes[ $taxonomy ]['terms'] as $term ): ?>
							<?php $value = get_term_by( 'slug', $term, $taxonomy ); ?>
							<span data-name="<?php echo esc_attr( $taxonomy ); ?>"
								  data-value="<?php echo esc_attr( $term ); ?>"><?php echo esc_html( $value->name ); ?></span>
						<?php endforeach; ?>
					<?php endif; ?>
				<?php endforeach;
			}
			?>
			<?php if ( ( $min_price && ( $min_price != $default_min_price ) ) || ( $max_price && ( $max_price != $default_max_price ) ) ): $check = true; ?>
				<span
					class="text-price"><?php echo wc_price( $min_price ); ?> - <?php echo wc_price( $max_price ); ?></span>
			<?php endif; ?>
			<?php if ( $check ): ?>
				<button class="filter_clear_all dmt-clear-btn"
						type="button"><?php echo esc_html__( 'Clear All', 'gmart-core' ); ?></button>
			<?php endif;
			?>
		</div>
		<?php
	}

	function dmt_filter_admin_script() {
		wp_enqueue_style( 'wp-color-picker' );
	}

	function dmt_filter_products_callback() {
		global $wpdb;
		$dir = DMT_WIDGET_TEMPLATE_PATH . 'dmt-ajax-filter/default_ajax_new.php';
		include $dir;
	}


	function get_current_term_slug() {
		return absint( is_tax() ? get_queried_object()->slug : 0 );
	}

	function get_current_term_id() {
		return absint( is_tax() ? get_queried_object()->term_id : 0 );
	}

	function get_filtered_term_product_counts( $term_ids, $taxonomy, $query_type, $tax_query, $meta_query ) {
		global $wpdb;

		if ( 'or' === $query_type ) {
			foreach ( $tax_query as $key => $query ) {
				if ( $taxonomy === $query['taxonomy'] ) {
					unset( $tax_query[ $key ] );
				}
			}
		}

		$meta_query     = new \WP_Meta_Query( $meta_query );
		$tax_query      = new \WP_Tax_Query( $tax_query );
		$meta_query_sql = $meta_query->get_sql( 'post', $wpdb->posts, 'ID' );
		$tax_query_sql  = $tax_query->get_sql( $wpdb->posts, 'ID' );

		// Generate query
		$query             = array();
		$query['select']   = "SELECT COUNT( DISTINCT {$wpdb->posts}.ID ) as term_count, terms.term_id as term_count_id";
		$query['from']     = "FROM {$wpdb->posts}";
		$query['join']     = "
			INNER JOIN {$wpdb->term_relationships} AS term_relationships ON {$wpdb->posts}.ID = term_relationships.object_id
			INNER JOIN {$wpdb->term_taxonomy} AS term_taxonomy USING( term_taxonomy_id )
			INNER JOIN {$wpdb->terms} AS terms USING( term_id )
			" . $tax_query_sql['join'] . $meta_query_sql['join'];
		$query['where']    = "
			WHERE {$wpdb->posts}.post_type IN ( 'product' )
			AND {$wpdb->posts}.post_status = 'publish'
			" . $tax_query_sql['where'] . $meta_query_sql['where'] . "
			AND terms.term_id IN (" . implode( ',', array_map( 'absint', $term_ids ) ) . ")
		";
		$query['group_by'] = "GROUP BY terms.term_id";
		$query             = apply_filters( 'woocommerce_get_filtered_term_product_counts_query', $query );
		$query             = implode( ' ', $query );
		$results           = $wpdb->get_results( $query );

		return wp_list_pluck( $results, 'term_count', 'term_count_id' );
	}

	function get_page_base_url( $taxonomy ) {
		if ( defined( 'SHOP_IS_ON_FRONT' ) ) {
			$link = home_url();
		} elseif ( is_post_type_archive( 'product' ) || is_page( wc_get_page_id( 'shop' ) ) ) {
			$link = get_post_type_archive_link( 'product' );
		} elseif ( is_product_category() ) {
			$link = get_term_link( get_query_var( 'product_cat' ), 'product_cat' );
		} elseif ( is_product_tag() ) {
			$link = get_term_link( get_query_var( 'product_tag' ), 'product_tag' );
		} else {
			$link = get_term_link( get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
		}

		// Min/Max
		if ( isset( $_GET['min_price'] ) ) {
			$link = add_query_arg( 'min_price', wc_clean( $_GET['min_price'] ), $link );
		}

		if ( isset( $_GET['max_price'] ) ) {
			$link = add_query_arg( 'max_price', wc_clean( $_GET['max_price'] ), $link );
		}

		// Orderby
		if ( isset( $_GET['orderby'] ) ) {
			$link = add_query_arg( 'orderby', wc_clean( $_GET['orderby'] ), $link );
		}

		/**
		 * Search Arg.
		 * To support quote characters, first they are decoded from &quot; entities, then URL encoded.
		 */
		if ( get_search_query() ) {
			$link = add_query_arg( 's', rawurlencode( htmlspecialchars_decode( get_search_query() ) ), $link );
		}

		// Post Type Arg
		if ( isset( $_GET['post_type'] ) ) {
			$link = add_query_arg( 'post_type', wc_clean( $_GET['post_type'] ), $link );
		}

		// Min Rating Arg
		if ( isset( $_GET['min_rating'] ) ) {
			$link = add_query_arg( 'min_rating', wc_clean( $_GET['min_rating'] ), $link );
		}

		// All current filters
		if ( $_chosen_attributes = \WC_Query::get_layered_nav_chosen_attributes() ) {
			foreach ( $_chosen_attributes as $name => $data ) {
				if ( $name === $taxonomy ) {
					continue;
				}
				$filter_name = sanitize_title( str_replace( 'pa_', '', $name ) );
				if ( ! empty( $data['terms'] ) ) {
					$link = add_query_arg( 'filter_' . $filter_name, implode( ',', $data['terms'] ), $link );
				}
				if ( 'or' == $data['query_type'] ) {
					$link = add_query_arg( 'query_type_' . $filter_name, 'or', $link );
				}
			}
		}

		return $link;
	}

	function getTemplatePath( $tpl = 'default-new', $type = '' ) {
		$file = '/' . $tpl . $type . '.php';
		$dir  = DMT_WIDGET_TEMPLATE_PATH . 'dmt-ajax-filter';
		if ( file_exists( $dir . $file ) ) {
			return $dir . $file;
		}

		return $tpl == 'default-new' ? false : getTemplatePath( 'default-new', $type );
	}

	/**
	 * Update the widget settings.
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		// strip tag on text field
		$instance['title1'] = strip_tags( $new_instance['title1'] );

		if ( array_key_exists( 'attribute', $new_instance ) ) {
			if ( is_array( $new_instance['attribute'] ) ) {
				$instance['attribute'] = array_map( 'strval', $new_instance['attribute'] );
			} else {
				$instance['attribute'] = $new_instance['attribute'];
			}
		} else {
			$instance['attribute'] = '';
		}

		if ( array_key_exists( 'show_category', $new_instance ) ) {
			$instance['show_category'] = strip_tags( $new_instance['show_category'] );
		}

		if ( array_key_exists( 'show_price', $new_instance ) ) {
			$instance['show_price'] = strip_tags( $new_instance['show_price'] );
		}

		if ( array_key_exists( 'showcount', $new_instance ) ) {
			$instance['showcount'] = strip_tags( $new_instance['showcount'] );
		}
		if ( array_key_exists( 'show_brand', $new_instance ) ) {
			$instance['show_brand'] = strip_tags( $new_instance['show_brand'] );
		}

		return $instance;
	}

	function woocommerce_filter_price( $chosen_attributes, $default_min_price, $default_max_price ) {
		$min_price = ( isset( $chosen_attributes['min_price'] ) && $chosen_attributes['min_price'] ) ? $chosen_attributes['min_price'] : $default_min_price;
		$max_price = ( isset( $chosen_attributes['max_price'] ) && $chosen_attributes['max_price'] ) ? $chosen_attributes['max_price'] : $default_max_price;
		echo '<div class="dmt-filter-price">';
		echo '<h3>' . esc_html__( 'Price', 'gmart-core' ) . '</h3>';
		echo '<div class="content-filter-price">';
		if ( ( $min_price != $default_min_price ) || ( $max_price != $default_max_price ) ) {
			echo '<facet-remove class="facet-remove-price">' . esc_html__( "Reset", "gmart-core" ) . '</facet-remove>';
		}
		echo '<div id="dmt_slider_price" data-symbol="' . get_woocommerce_currency_symbol() . '" data-min="' . $default_min_price . '" data-max="' . $default_max_price . '"></div>';
		echo '<div class="price-input">';
		echo '<span>' . esc_html__( 'Range : ', 'gmart-core' ) . '</span>';
		echo '<span class="input-text text-price-filter" id="text-price-filter-min-text">' . wc_price( $min_price ) . '</span> - ';
		echo '<span class="input-text text-price-filter" id="text-price-filter-max-text">' . wc_price( $max_price ) . '</span>';
		echo '<input class="input-text text-price-filter hidden" id="price-filter-min-text" type="text" value="' . $min_price . '">';
		echo '<input class="input-text text-price-filter hidden" id="price-filter-max-text" type="text" value="' . $max_price . '">';
		echo '</div>';
		echo '</div>';
		echo '</div>';
	}

	function get_filtered_price( $meta_query, $tax_query ) {
		global $wpdb, $wp_the_query;

		$meta_query = new \WP_Meta_Query( $meta_query );
		$tax_query  = new \WP_Tax_Query( $tax_query );

		$meta_query_sql = $meta_query->get_sql( 'post', $wpdb->posts, 'ID' );
		$tax_query_sql  = $tax_query->get_sql( $wpdb->posts, 'ID' );

		$sql = "SELECT min( CAST( price_meta.meta_value AS UNSIGNED ) ) as min_price, max( CAST( price_meta.meta_value AS UNSIGNED ) ) as max_price FROM {$wpdb->posts} ";
		$sql .= " LEFT JOIN {$wpdb->postmeta} as price_meta ON {$wpdb->posts}.ID = price_meta.post_id " . $tax_query_sql['join'] . $meta_query_sql['join'];
		$sql .= " 	WHERE {$wpdb->posts}.post_type = 'product'
					AND {$wpdb->posts}.post_status = 'publish'
					AND price_meta.meta_key IN ('" . implode( "','", array_map( 'esc_sql', apply_filters( 'woocommerce_price_filter_meta_keys', array( '_price' ) ) ) ) . "')
					AND price_meta.meta_value > '' ";
		$sql .= $tax_query_sql['where'] . $meta_query_sql['where'];

		return $wpdb->get_row( $sql );
	}

	function woocommerce_filter_atribute( $attribute, $tax_query, $meta_query, $chosen_attributes, $relation, $showcount ) {
		$query_type = $relation;

		if ( $attribute ) {
			foreach ( $attribute as $att ) {
				$taxonomy = wc_attribute_taxonomy_name( $att );
				$orderby  = wc_attribute_orderby( $taxonomy );
				if ( $orderby ) {
					switch ( $orderby ) {
						case 'name' :
							$get_terms_args['orderby']    = 'name';
							$get_terms_args['menu_order'] = false;
							break;
						case 'id' :
							$get_terms_args['orderby']    = 'id';
							$get_terms_args['order']      = 'ASC';
							$get_terms_args['menu_order'] = false;
							break;
						case 'menu_order' :
							$get_terms_args['menu_order'] = 'ASC';
							break;
					}
				} else {
					$get_terms_args = array();
				}

				$get_terms_args['tax_query'] = $tax_query;
				$terms                       = get_terms( $taxonomy, $get_terms_args );
				$count_terms                 = 0;
				if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
					foreach ( $terms as $term ) {
						$d_term_counts = get_filtered_term_product_counts( wp_list_pluck( $terms, 'term_id' ), $taxonomy, $query_type, $tax_query, $meta_query );
						$d_count       = isset( $d_term_counts[ $term->term_id ] ) ? $d_term_counts[ $term->term_id ] : 0;
						$count_terms   = $count_terms + $d_count;
					}
				}
				if ( $count_terms > 0 ) {
					if ( count( $terms ) > 0 ):
						$current_values = isset( $chosen_attributes[ $taxonomy ]['terms'] ) ? $chosen_attributes[ $taxonomy ]['terms'] : array();
						$name_att            = wc_attribute_label( $taxonomy ); ?>
						<div class="dmt-filter dmt-filter-<?php echo esc_attr( $att ); ?>">
							<h3><?php echo ucfirst( $name_att ); ?><?php if ( count( $current_values ) > 0 ): ?><label
									class="count-chosen"><?php echo count( $current_values ); ?></label><?php endif; ?>
							</h3>
							<div class="content_filter">
								<?php if ( count( $current_values ) > 0 ): ?>
									<facet-remove><?php echo esc_html__( 'Reset', 'gmart-core' ) ?></facet-remove>
								<?php endif; ?>
								<?php
								$tax_attribute = dmt_get_tax_attribute( $taxonomy );
								if ( isset( $tax_attribute->attribute_type ) && $tax_attribute->attribute_type != "select" ) {
									?>
									<ul id="<?php echo esc_attr( 'pa_' . $att ); ?>">
										<?php
										$term_counts = get_filtered_term_product_counts( wp_list_pluck( $terms, 'term_id' ), $taxonomy, $query_type, $tax_query, $meta_query );
										foreach ( $terms as $term ) {
											$option_is_set = in_array( $term->slug, $current_values );
											$count         = isset( $term_counts[ $term->term_id ] ) ? $term_counts[ $term->term_id ] : 0;
											if ( $count > 0 ) {
												$tax_attribute = dmt_get_tax_attribute( $taxonomy );
												$text_count    = $showcount ? '' . absint( $count ) . '' : "";
												$text_count2   = $showcount ? '' . absint( $count ) . '' : "";
												if ( isset( $tax_attribute->attribute_type ) && $tax_attribute->attribute_type == "color" ) {
													$color = get_term_meta( $term->term_id, 'color', true );
													echo '<li class="filter_color ' . ( $option_is_set ? "active " . esc_attr( $term->slug ) . "" : "" . esc_attr( $term->slug ) . "" ) . '">';
													echo '	<span style="background-color:' . esc_attr( $color ) . ';">
																<input value="' . esc_attr( $term->slug ) . '" name="filter_' . esc_attr( $att ) . '" type="checkbox" ' . ( $option_is_set ? "checked" : "" ) . '>
															</span>';
													echo apply_filters( 'woocommerce_layered_nav_count', '<label class="count">' . esc_html( $term->name ) . '</label>', $count, $term );
													echo '</li> ';
												} elseif ( isset( $tax_attribute->attribute_type ) && $tax_attribute->attribute_type == "image" ) {
													$bg_image         = '';
													$id_image         = get_term_meta( $term->term_id, 'image', true );
													$image_attributes = wp_get_attachment_image_src( $id_image );
													if ( $image_attributes ) {
														$bg_image = 'style="background-image:url(' . esc_url( $image_attributes[0] ) . ');"';
													}
													echo '<li class="filter_image">';
													echo '	<span ' . ( $option_is_set ? "class='active " . esc_attr( $term->slug ) . "'" : "class='" . esc_attr( $term->slug ) . "'" ) . ' ' . $bg_image . '>
																<input value="' . esc_attr( $term->slug ) . '" name="filter_' . esc_attr( $att ) . '" type="checkbox" ' . ( $option_is_set ? "checked" : "" ) . '>
															</span>';
													echo apply_filters( 'woocommerce_layered_nav_count', '<label class="count">' . esc_html( $term->name ) . '<mark>' . esc_html( $text_count2 ) . '</mark></label>', $count, $term );
													echo '</li> ';
												} else {
													echo '<li ' . ( $option_is_set ? "class='active'" : "" ) . '>';
													echo '<span>
															<input  value="' . esc_attr( $term->slug ) . '" name="filter_' . esc_attr( $att ) . '"  type="checkbox" ' . ( $option_is_set ? "checked" : "" ) . '>
															<label class="name">' . esc_html( $term->name ) . '</label>';
													echo apply_filters( 'woocommerce_layered_nav_count', '<label class="count">' . esc_html( $text_count ) . '</label>', $count, $term );
													echo '</span>';
													echo '</li> ';
												}
											}
										}
										?>
									</ul>
								<?php } else { ?>
									<h2 class="dropdown-toggle" data-toggle="dropdown"><?php echo esc_html__('Choose option','gmart-core') ?></h2>
									<ul id="<?php echo esc_attr( 'pa_' . $att ); ?>"
									    class="filter-select dropdown-menu">
										<?php
										$term_counts = get_filtered_term_product_counts( wp_list_pluck( $terms, 'term_id' ), $taxonomy, $query_type, $tax_query, $meta_query );
										foreach ( $terms as $term ) {
											$current_values = isset( $chosen_attributes[ $taxonomy ]['terms'] ) ? $chosen_attributes[ $taxonomy ]['terms'] : array();
											$option_is_set  = in_array( $term->slug, $current_values );
											$count          = isset( $term_counts[ $term->term_id ] ) ? $term_counts[ $term->term_id ] : 0;
											if ( $count > 0 ) {
												$tax_attribute = dmt_get_tax_attribute( $taxonomy );
												$text_count    = $showcount ? '(' . absint( $count ) . ')' : "";
												echo '<li class="filter_orther">';
												echo '<div ' . ( $option_is_set ? "class='active'" : "" ) . '>
															<span><input  value="' . esc_attr( $term->slug ) . '" name="filter_' . esc_attr( $att ) . '"  type="checkbox" ' . ( $option_is_set ? "checked" : "" ) . '>';
												echo apply_filters( 'woocommerce_layered_nav_count', '<label class="count">' . esc_html( $term->name ) . '</label><mark>' . esc_html( $text_count ) . '</mark></span>', $count, $term );
												echo '</div>';
												echo '</li> ';
											}
										}
										?>
									</ul>
								<?php } ?>
							</div>
						</div>
					<?php endif;
				}
			}
		}
	}

	function woocommerce_filter_category() {
		$id_item = is_tax( 'product_cat' ) ? get_queried_object()->term_id : 0;
		$terms   = get_terms( 'product_cat', array( 'hide_empty' => true, 'parent' => 0 ) );
		if ( $terms ) {
			echo '<div class="dmt-filter dmt-filter-category">';
			echo '<h3 class="widget-title">' . esc_html__( 'Categories', 'gmart-core' ) . '</h3>';
			echo '<div id="pa_category" data-taxonomy="product_cat" class="block_content filter_taxonomy_product filter_category_product">';
			foreach ( $terms as $term ) {
				$option_is_set = ( $term->term_id == $id_item ) ? 1 : 0;
				$terms_vl1     = get_terms( 'product_cat', array( 'hide_empty' => false, 'parent' => $term->term_id ) );
				echo '<div data-id_item="' . $term->term_id . '" class="item-taxonomy item-category ' . ( ( count( $terms_vl1 ) > 0 ) ? 'cat-parent' : '' ) . ' ' . ( ( $option_is_set == 1 ) ? 'active' : '' ) . '">';
				echo '<a href="' . get_term_link( $term->term_id, 'product_cat' ) . '"><label class="name">' . esc_html( $term->name ) . '</label>';
				echo '<label class="count">(' . ( $term->count ) . ')</label></a>';
				if ( $terms_vl1 ) {
					echo '<div class="children">';
					foreach ( $terms_vl1 as $term_vl ) {
						$option_is_set = ( $term_vl->term_id == $id_item ) ? 1 : 0;
						$terms_vl2     = get_terms( 'product_cat', array(
							'hide_empty' => false,
							'parent'     => $term_vl->term_id
						) );
						echo '<div data-id_item="' . $term_vl->term_id . '" class="item-taxonomy item-category  ' . ( ( count( $terms_vl2 ) > 0 ) ? 'cat-parent' : '' ) . ' ' . ( ( $option_is_set == 1 ) ? 'active' : '' ) . '">';
						echo '<a href="' . get_term_link( $term_vl->term_id, 'product_cat' ) . '"><label class="name">' . esc_html( $term_vl->name ) . '</label>';
						echo '<label class="count">(' . ( $term_vl->count ) . ')</label></a>';
						if ( $terms_vl2 ) {
							echo '<div class="children">';
							foreach ( $terms_vl2 as $term_vl2 ) {
								$option_is_set = ( $term_vl2->term_id == $id_item ) ? 1 : 0;
								echo '<div data-id_item="' . $term_vl2->term_id . '" class="item-taxonomy item-category ' . ( ( $option_is_set == 1 ) ? 'active' : '' ) . '">';
								echo '<a href="' . get_term_link( $term_vl2->term_id, 'product_cat' ) . '"><label class="name">' . esc_html( $term_vl2->name ) . '</label>';
								echo '<label class="count">(' . ( $term_vl2->count ) . ')</label></a>';
								echo '</div> ';
							}
							echo '</div>';
						}
						echo '</div> ';
					}
					echo '</div>';
				}
				echo '</div> ';
			}
			echo '</div></div>';
		}
	}

	function woocommerce_filter_brand( $showcount ) {
		$id_item = is_tax( 'product_brand' ) ? get_queried_object()->term_id : 0;
		$terms   = get_terms( 'product_brand', array( 'hide_empty' => true ) );
		if ( $terms ) {
			echo '<div class="dmt-filter dmt-filter-brand">';
			echo '<h3 class="widget-title">' . esc_html__( 'Brands', 'gmart-core' ) . '</h3>';
			echo '<div id="pa_brand" data-taxonomy="product_brand" class="block_content filter_taxonomy_product filter_brand_product">';
			foreach ( $terms as $term ) {
				$option_is_set = ( $term->term_id == $id_item ) ? 1 : 0;
				echo '<div data-id_item="' . $term->term_id . '" class="item-taxonomy item-brand ' . ( ( $option_is_set == 1 ) ? 'active' : '' ) . '">';
				echo '<a href="' . get_term_link( $term->term_id, 'product_brand' ) . '"><label class="name">' . esc_html( $term->name ) . '</label>';
				echo '<label class="count">(' . ( $term->count ) . ')</label></a>';
				echo '</div> ';
			}
			echo '</div></div>';
		}
	}

}

