<?php get_header(); ?>
<?php if (!((is_tax('types')) || (is_tax('product_tags')))) { ?>
<div class="posts-wrap the_archive">
<?php } else { ?>
<div class="store_home">
<?php } ?>
	<?php if (have_posts()) : ?>
	<h2 class="post_title">
	<?php /* If this is a category */ if (is_category()) { ?>
		<?php _e('Category', 'blank'); ?> &#8220;<?php single_cat_title(); ?>&#8221;	
	<?php /* If this is a tag */ } elseif( is_tag() ) { ?>
		<?php _e('Posts tagged with', 'blank'); ?> &#8220;<?php single_tag_title(); ?>&#8221;  
	<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
		<?php _e('Archive for', 'blank'); ?> <?php the_time('F jS, Y'); ?>
	<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
		<?php _e('Archive for', 'blank'); ?> <?php the_time('F, Y'); ?>
	<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
		<?php _e('Archive for', 'blank'); ?> <?php the_time('Y'); ?>
	<?php /* If this is an author archive */ } elseif (is_author()) { ?>
		<?php _e('Author Archive ', 'blank'); ?>
	<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
		<?php _e('Blog Archives ', 'blank'); ?>
	<?php } elseif (is_tax()) { ?>
		<?php $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); ?>
		<?php echo $term->name; ?>
	<?php }  ?>
	</h2>
	<?php if (!((is_tax('types')) || (is_tax('product_tags')))) { ?>
	<?php while (have_posts()) : the_post(); ?>
     	<div class="post-archive_wrap">
     		<div <?php post_class('post-archive'); ?> id="post-<?php the_ID(); ?>">
				<?php if (has_post_thumbnail()) { ?>
				<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" class="archive_image_link">
					<?php the_post_thumbnail( 'archive_image', array( 'alt' => get_the_title()) ); ?>
				</a>
				<?php } ?>
				<h4 class="archive-entry-title">
					<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
				</h4>
				<div class="archive-meta">
					<span class="left">Posted in <?php the_category(', ') ?> by <?php the_author_posts_link(); ?> on <?php the_time('F d, Y'); ?></span>
					<span class="right"><?php comments_popup_link( __( 'No Comments', 'blank' ), __( '1 Comment', 'blank' ), __( '% Comments', 'blank' ), 'comments-link', __('Comments Closed', 'blank')); ?></span>
					<div class="clear"></div>
				</div><!-- end .archive-meta -->
			</div><!-- end .post -->
		</div><!-- end .post-archive_wrap -->
	<?php endwhile; ?>
	<?php } else { ?>
	<div id="products_grid">
	<?php while (have_posts()) : the_post(); ?>
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
		</div><!-- end #archive_wrap -->
	<?php } ?>

		<div class="navigation">
			<div class="nav-prev"><?php next_posts_link( __('&laquo; Older Entries', 'blank')) ?></div>
			<div class="nav-next"><?php previous_posts_link( __('Newer Entries &raquo;', 'blank')) ?></div>
			<div class="clear"></div>
		</div>

	<?php else : ?>

		<h2>We can't find what you're looking for.</h2>
		<p>Please try one of the links on top.</p>
        
	<?php endif; ?>
</div><!-- end .posts-wrap or #archive_grid_wrap -->

<?php get_footer(); // Comment ?>