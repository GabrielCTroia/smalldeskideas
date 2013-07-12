
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
		
<!-- 		<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700,300italic' rel='stylesheet' type='text/css'> -->
		<link href='http://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/bootstrap.min.css">
		
		<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/main.css">
		<script>
		(function(){
			// configure legacy, retina, touch requirements @ conditionizr.com
			conditionizr();
		})();
		</script>
		
	</head>
	<body <?php body_class(); ?>>
   
   <?php include_once( __DIR__ . '/custom/headerModule.php' );?>