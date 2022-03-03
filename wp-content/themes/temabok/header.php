<!doctype html>

<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<?php // force Internet Explorer to use the latest rendering engine available ?>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<?php // mobile meta (hooray!) ?>
	<meta name="HandheldFriendly" content="True">
	<meta name="MobileOptimized" content="320">
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
	<?php // wordpress head functions ?>
	<?php wp_head(); ?>
	<?php // end of wordpress head ?>
	<link rel="stylesheet" href="https://cdn.plyr.io/3.6.4/plyr.css" />
	<script src="https://cdn.plyr.io/3.6.4/plyr.js"></script>
</head>
<body <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage">
	<div id="container" data="self">
		<header id="header" class="header" itemscope itemtype="http://schema.org/WPHeader">
			<div id="header-progress"><span data-progress="<?php echo sp_get_user_article_progress($post->ID); ?>"></span></div>
			<div id="inner-header" class="wrap">
				<?php // CUSTOMIZER LOGO ?>
				<?php if ( function_exists( 'the_custom_logo' ) ) {
					the_custom_logo();
				} ?>

				<nav role="navigation" id="nav-main" class="desktop-nav" itemscope itemtype="http://schema.org/SiteNavigationElement">
					<?php wp_nav_menu(array(
						'container' => false,                           		// remove nav container
						'container_class' => 'menu cf',                 		// class of container (should you choose to use it)
						'menu' => __( 'The Main Menu', 'screenpartner' ),  	// nav name
						'menu_class' => 'nav top-nav cf',               		// adding custom nav class
						'theme_location' => 'main-nav',                 		// where it's located in the theme
						'before' => '',                                 		// before the menu
						'after' => '',                                  		// after the menu
						'link_before' => '',                            		// before each link
						'link_after' => '',                             		// after each link
						'depth' => 0,                                   		// limit the depth of the nav
						'fallback_cb' => ''                             		// fallback function (if there is one)
					)); ?>
				</nav>
				
				<a href="#" class="nav-toggle" aria-controls="nav-main" aria-label="<?php echo __('Open menu', 'screenpartner'); ?>">
					<i class="fa fa-bars"></i>
					<i class="fa fa-times"></i>
				</a>
			</div>
		</header>
