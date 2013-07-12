<?php /* Template Name: Live */ 

if(!$_GET['url'] || !$url = get_post_meta( get_post_id_by_slug($_GET['url']) , 'URL' , 1 ) ){
   header('location: /404'); 
   exit();
} 

?>
	
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
		
		<style>
         body{
            height:100%;
            overflow:hidden;
            margin:0;
            padding: 0;
         }
         
         iframe{
            width:100%;
            height:100%;
            border:none;
   		}
		</style>
		
	</head>
	<body>		
   	<iframe src="<?php echo $url; ?>"></iframe>   	   
	</body>	
</html>

