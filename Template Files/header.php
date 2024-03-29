<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes() ?>>
	<head>
		<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
		<title><?php bloginfo('name'); ?></title>
		<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS" href="<?php bloginfo('rss2_url'); ?>" />
		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
		
		<!-- Custom CSS -->
		<style type="text/css">
		a {
			color:<?php echo stripslashes(of_get_option('link_color')); ?>;
		}
		ul.commentlist .bypostauthor img.avatar {
			border:1px solid <?php echo stripslashes(of_get_option('link_color')); ?>;
		}
		</style>
		<!-- CSS -->
		<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />

		
		<!-- jQuery We Need -->
		<?php wp_head(); //leave for plugins ?>
		<?php if (of_get_option('favicon') != '') { ?>
		<!-- The Favicon -->
		<link rel="shortcut icon" href="<?php echo stripslashes(of_get_option('favicon')); ?>" />
		<?php } ?>
	</head>
	<body <?php body_class('scheme_'. stripslashes(of_get_option('color_scheme')) .' button_'. stripslashes(of_get_option('button_color')) .' '. stripslashes(of_get_option('layout')) .''); ?>>
		<div class="wrapper" id="header">
			<div class="container">
				<?php if (of_get_option('logo') != '') { ?>
				<a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?>" class="left the_logo">
					<img src="<?php echo stripslashes(of_get_option('logo')); ?>" alt="<?php bloginfo('name'); ?>" id="logo" />
				</a>
				<?php } else { ?>
				<h1 class="the_logo"><a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?>"><?php bloginfo('name'); ?></a></h1>
				<?php } ?>
				<?php get_search_form(); ?>
				<div class="clear"></div>
			</div>
		</div>
		<div class="wrapper" id="main_menu">
			<div class="container">
				<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
				<div id="cart_links">
					<ul>
						<?php if (of_get_option('affiliate_mode') == 'no') { ?>
						<?php if (of_get_option('member_login') != '') { ?>
							<?php if(Cart66Common::isLoggedIn()): ?>
								<li><a href="<?php echo stripslashes(of_get_option('store_link')); ?>/?cart66-task=logout" title="Log Out">Log Out</a></li>
								<?php if (of_get_option('account_link') != '') { ?><li><a href="<?php echo stripslashes(of_get_option('account_link')); ?>/" title="My Account">My Account</a></li><?php } ?>
							<?php else: ?>
								<li><a href="<?php echo stripslashes(of_get_option('member_login')); ?>" title="Log In">Log In</a></li>
							<?php endif; ?>
						<?php } if (of_get_option('cart_link') != '') { ?>
						<li>
							<a href="<?php echo stripslashes(of_get_option('cart_link')); ?>" title="cart" id="head_cart">
								Your Cart
								<?php $items = Cart66Session::get('Cart66Cart')->countItems(); if($items < 1) { echo '(<span id="header_cart_count">0</span>)'; } else if($items > 0) { ?>
								(<span id="header_cart_count"><?php echo $items; ?></span>)
						<?php } ?>
						<?php } ?>
						<?php } //end affiliate_mode ?>
						</a></li>
					</ul>
				</div>
				<div class="clear"></div>
			</div>
		</div>
		<?php if (is_front_page()) { ?>
		<?php /* START THE SLIDE LOOP */ $loop = new WP_Query( array( 'post_type' => 'slides', 'posts_per_page' => 3, 'order' => 'desc' ) ); ?>
		<?php $count_slides = wp_count_posts('slides')->publish; if ($count_slides != '0') { ?>
		<div class="wrapper" id="slider_wrap">
			<div class="wrapper" id="slider">
				<div class="container">
					<div id="slides">
						<div class="slidearea slides_container">
						<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
							<div class="single_slide">
								<h2 class="slide_title"><?php the_title(); ?></h2>
								<div class="slide_content">
								<?php the_content(); ?>
									<div class="clear"></div>
								<?php if (get_post_meta($post->ID, '_dc_slide_price', true) != '') { ?>
									<span class="slide_price"><?php echo get_post_meta($post->ID, '_dc_slide_price', true);?></span>
								<?php } ?>
								<?php if (get_post_meta($post->ID, '_dc_button_link', true) != '') { ?>
									<a href="<?php echo get_post_meta($post->ID, '_dc_button_link', true);?>" class="button" title="<?php the_title(); ?>">
								<?php if (get_post_meta($post->ID, '_dc_button_text', true) != '') { ?>
									<?php echo get_post_meta($post->ID, '_dc_button_text', true);?>
								<?php } else { ?>
										Learn More
								<?php } ?>
									</a>
								<?php } ?>
									<div class="clear"></div>
								</div>
								<div class="slide_image_wrap">
								<?php if (get_post_meta($post->ID, '_dc_button_link', true) != '') { ?>
								<a href="<?php echo get_post_meta($post->ID, '_dc_button_link', true);?>" title="<?php the_title(); ?>"<?php if (of_get_option('slider_box') == 'yes') { ?> class="slide_image_box"<?php } ?>><?php } else { if (of_get_option('slider_box') == 'yes') { ?><div class="slide_image_box"><?php } } ?>
									<?php $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large'); ?>
    								<?php echo '<a class="lightbox" href="' . $large_image_url[0] . '" title="' . the_title_attribute('echo=0') . '" >'; ?>
									<?php the_post_thumbnail( 'thumbnail', array('alt' => get_the_title(), 'class'=>'alignnone main-home-img' ) ); ?>
									<?php echo'</a>'; ?>
								<?php if (get_post_meta($post->ID, '_dc_button_link', true) != '') { ?></a><?php } else { if (of_get_option('slider_box') == 'yes') { ?></div><?php } } ?>
								</div>
								<div class="clear"></div>
							</div>
						<?php endwhile; wp_reset_query(); /* END THE SLIDE LOOP */?>
						</div>
						<div class="clear"></div>
						<?php if ($count_slides != '1') { ?>
						<div id="slide_pagination">
						<?php /* START THE SLIDE PAGINATION LOOP */ $loop = new WP_Query( array( 'post_type' => 'slides', 'posts_per_page' => 3, 'order' => 'desc' ) ); ?>
						<?php $count=0; ?>
						<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
						<?php $count++; ?>
							<a href="#<?php echo $count; ?>" class="slide_pag_link" title="<?php the_title(); ?>"><?php the_post_thumbnail( 'slide_thumb', array('alt' => get_the_title()) ); ?></a>
						<?php endwhile; wp_reset_query(); /* END THE SLIDE PAGINATION LOOP */?>
							<div class="clear"></div>
						</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
		<?php } } ?>
		<div class="wrapper" id="content"> <!-- #content ends in footer.php -->
			<div class="container">