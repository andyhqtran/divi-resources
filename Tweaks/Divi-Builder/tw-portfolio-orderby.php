<?php

if ( class_exists( 'ET_Builder_Module_Portfolio' ) ):
	class My_ET_Builder_Module_Portfolio extends ET_Builder_Module_Portfolio {

		function shortcode_callback( $atts, $content = null, $function_name ) {
			$module_id           = $this->shortcode_atts['module_id'];
			$module_class        = $this->shortcode_atts['module_class'];
			$fullwidth           = $this->shortcode_atts['fullwidth'];
			$posts_number        = $this->shortcode_atts['posts_number'];
			$include_categories  = $this->shortcode_atts['include_categories'];
			$show_title          = $this->shortcode_atts['show_title'];
			$show_categories     = $this->shortcode_atts['show_categories'];
			$show_pagination     = $this->shortcode_atts['show_pagination'];
			$background_layout   = $this->shortcode_atts['background_layout'];
			$zoom_icon_color     = $this->shortcode_atts['zoom_icon_color'];
			$hover_overlay_color = $this->shortcode_atts['hover_overlay_color'];
			$hover_icon          = $this->shortcode_atts['hover_icon'];
			global $paged;
			$module_class = ET_Builder_Element::add_module_order_class( $module_class, $function_name );
			if ( '' !== $zoom_icon_color ) {
				ET_Builder_Element::set_style( $function_name, array(
					'selector'    => '%%order_class%% .et_overlay:before',
					'declaration' => sprintf(
						'color: %1$s !important;',
						esc_html( $zoom_icon_color )
					),
				) );
			}
			if ( '' !== $hover_overlay_color ) {
				ET_Builder_Element::set_style( $function_name, array(
					'selector'    => '%%order_class%% .et_overlay',
					'declaration' => sprintf(
						'background-color: %1$s;
					border-color: %1$s;',
						esc_html( $hover_overlay_color )
					),
				) );
			}
			$container_is_closed = false;
			$args = array(
				'posts_per_page' => (int) $posts_number,
				'post_type'      => 'project',
				'order'          => 'ASC'
			);
			$et_paged = is_front_page() ? get_query_var( 'page' ) : get_query_var( 'paged' );
			if ( is_front_page() ) {
				$paged = $et_paged;
			}
			if ( '' !== $include_categories )
				$args['tax_query'] = array(
					array(
						'taxonomy' => 'project_category',
						'field' => 'id',
						'terms' => explode( ',', $include_categories ),
						'operator' => 'IN',
					)
				);
			if ( ! is_search() ) {
				$args['paged'] = $et_paged;
			}
			$main_post_class = sprintf(
				'et_pb_portfolio_item%1$s',
				( 'on' !== $fullwidth ? ' et_pb_grid_item' : '' )
			);
			ob_start();
			query_posts( $args );
			if ( have_posts() ) {
				while ( have_posts() ) {
					the_post(); ?>

					<div id="post-<?php the_ID(); ?>" <?php post_class( $main_post_class ); ?>>

						<?php
						$thumb = '';
						$width = 'on' === $fullwidth ?  1080 : 400;
						$width = (int) apply_filters( 'et_pb_portfolio_image_width', $width );
						$height = 'on' === $fullwidth ?  9999 : 284;
						$height = (int) apply_filters( 'et_pb_portfolio_image_height', $height );
						$classtext = 'on' === $fullwidth ? 'et_pb_post_main_image' : '';
						$titletext = get_the_title();
						$thumbnail = get_thumbnail( $width, $height, $classtext, $titletext, $titletext, false, 'Blogimage' );
						$thumb = $thumbnail["thumb"];
						$thumb_id = get_post_thumbnail_id();
						list($full_src, $full_width, $full_height) = wp_get_attachment_image_src( $thumb_id, 'full' );
						if ( '' !== $thumb ) : ?>
							<a href="<?php echo $full_src; ?>">
								<?php if ( 'on' !== $fullwidth ) : ?>
								<span class="et_portfolio_image">
					<?php endif; ?>
					<?php print_thumbnail( $thumb, $thumbnail["use_timthumb"], $titletext, $width, $height ); ?>
					<?php if ( 'on' !== $fullwidth ) :
					$data_icon = '' !== $hover_icon
						? sprintf(
							' data-icon="%1$s"',
							esc_attr( et_pb_process_font_icon( $hover_icon ) )
						)
						: '';
					printf( '<span class="et_overlay%1$s"%2$s></span>',
						( '' !== $hover_icon ? ' et_pb_inline_icon' : '' ),
						$data_icon
					);
					?>
						</span>
							<?php endif; ?>
							</a>
							<?php
						endif;
						?>

						<?php if ( 'on' === $show_title ) : ?>
							<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						<?php endif; ?>

						<?php if ( 'on' === $show_categories ) : ?>
							<p class="post-meta"><?php echo strip_tags( get_the_term_list( get_the_ID(), 'project_category', '', ", ", '' ) ); ?></p>
						<?php endif; ?>

					</div> <!-- .et_pb_portfolio_item -->
				<?php	}
				if ( 'on' === $show_pagination && ! is_search() ) {
					echo '</div> <!-- .et_pb_portfolio -->';
					$container_is_closed = true;
					if ( function_exists( 'wp_pagenavi' ) ) {
						wp_pagenavi();
					} else {
						if ( et_is_builder_plugin_active() ) {
							include( ET_BUILDER_PLUGIN_DIR . 'includes/navigation.php' );
						} else {
							get_template_part( 'includes/navigation', 'index' );
						}
					}
				}
				wp_reset_query();
			} else {
				if ( et_is_builder_plugin_active() ) {
					include( ET_BUILDER_PLUGIN_DIR . 'includes/no-results.php' );
				} else {
					get_template_part( 'includes/no-results', 'index' );
				}
			}
			$posts = ob_get_contents();
			ob_end_clean();
			$class = " et_pb_module et_pb_bg_layout_{$background_layout}";
			$output = sprintf(
				'<div%5$s class="%1$s%3$s%6$s">
				%2$s
			%4$s',
				( 'on' === $fullwidth ? 'et_pb_portfolio' : 'et_pb_portfolio_grid clearfix' ),
				$posts,
				esc_attr( $class ),
				( ! $container_is_closed ? '</div> <!-- .et_pb_portfolio -->' : '' ),
				( '' !== $module_id ? sprintf( ' id="%1$s"', esc_attr( $module_id ) ) : '' ),
				( '' !== $module_class ? sprintf( ' %1$s', esc_attr( $module_class ) ) : '' )
			);
			return $output;
		}
	}
endif;

class My_ET_Portfolio_Orderby_Tweak extends My_ET_Tweak {
	public $builder_module_tweak = true;
	public $builder_module_class = 'ET_Builder_Module_Portfolio';
	
}

?>
