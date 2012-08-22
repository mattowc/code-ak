<?php
/*
Template Name: Store
*/
get_header(); ?>
<div class="store-home"> 
    <?php /* START PRODUCTS */
    global $paged, $wp_query, $wp;
	if  ( empty($paged) ) {
		if ( !empty( $_GET['paged'] ) ) {
			$paged = $_GET['paged'];
		} elseif ( !empty($wp->matched_query) && $args = wp_parse_args($wp->matched_query) ) {
			if ( !empty( $args['paged'] ) ) {
				$paged = $args['paged'];
			}
		}
		if ( !empty($paged) )
			$wp_query->set('paged', $paged);
        }      
	$temp = $wp_query;
	$wp_query= null;
	$wp_query = new WP_Query();
	/* Adjusted by Jon McDonald */ 
	$wp_query->query( array(
		'posts_per_page' => '' . of_get_option('products_total') .'',
		'post_type' => 'products',
		'paged' => $paged,
		'tax_query'	=> array(
        	array(
            	'taxonomy'  => 'types',
            	'field'     => 'slug',
            	'terms'     => 'Distributors', // exclude media posts in the news-cat custom taxonomy
            	'operator'  => 'NOT IN'
            )
           ),
       	)
	);
	/* End Adjustment */

	if ( $wp_query->have_posts() ) : ?>
	
	<div id="products_grid">
	
	<?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
		<?php
		$term_list = wp_get_post_terms( $post->ID, 'types', array("fields" => "names") );
		if(in_array( "Distributors", $term_list) ) {
			continue;
		}		
		?>
		<div class="single_grid_product">
			<?php if (has_post_thumbnail()) { ?>
			<div class="product_med_wrap">
				<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" class="single_product_image_link">
					<?php the_post_thumbnail( 'product_med', array('alt' => get_the_title()) ); ?>
				</a>
			</div>
			<?php } else { ?>
			<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" class="single_product_image_link"><?php the_title(); ?></a>
			<?php } ?>
			<h3><a class="grid_title" href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
			<div class="product_meta">
				<?php if (get_post_meta($post->ID, '_dc_price', true) != '') { ?>
				<div class="left">	
					<?php echo get_post_meta($post->ID, '_dc_price', true);?>			
				</div>
				<?php } ?>
				<div class="right">
					<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" class="more-link">View Details &raquo;</a>
				</div>
				<div class="clear"></div>
			</div>
		</div>
        
		<?php endwhile; ?>
		<div class="clear"></div>
	</div> <?php // end #products_grid ?>
	<div class="navigation">
		<div class="nav-prev"><?php previous_posts_link( __('&laquo; Previous Page', 'blank')) ?></div>
		<div class="nav-next"><?php next_posts_link( __('Next Page &raquo;', 'blank')) ?></div>
		<div class="clear"></div>
	</div>

	<?php else : ?>
	<h2>We can't seem to find the page you're looking for.</h2>
	<p>Please try one of the links on top.</p>
        
	<?php endif; wp_reset_query(); ?>
</div><!-- end .store-home -->

<?php get_footer(); ?>