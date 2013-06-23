<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>
		
		<!-- dns prefetch -->
		<link href="//www.google-analytics.com" rel="dns-prefetch">
		
		<!-- meta -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width,initial-scale=1.0">
		<meta name="description" content="<?php bloginfo('description'); ?>">
		
		<!-- icons -->
		<link href="<?php echo get_template_directory_uri(); ?>/img/icons/favicon.ico" rel="shortcut icon">
		<link href="<?php echo get_template_directory_uri(); ?>/img/icons/touch.png" rel="apple-touch-icon-precomposed">
		
			
		<!-- css + javascript -->
		<?php wp_head(); ?>
		
		<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700,300italic' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/main.css">
		<script>
		(function(){
			// configure legacy, retina, touch requirements @ conditionizr.com
			conditionizr();
		})();
		</script>
	</head>
	<body <?php body_class(); ?>>
	
		<!-- header -->
		<header class="header clearfix" role="banner">
			  
			  <div class="wrapper">

					<!-- logo -->
					<div class="logo">
						<a href="<?php echo home_url(); ?>">
               <?php //bloginfo('title'); ?>
               smalldesk<span class="bold">Ideas</span>
						</a>
					</div>
					<!-- /logo -->
					
					<!-- nav -->
					<nav class="nav clearfix" role="navigation">
						<?php html5blank_nav(); ?>
					</nav>
					<!-- /nav -->

			  </div>
		
		</header>
		<!-- /header -->
			
      <!-- wrapper -->
		<div class="wrapper">