      <?php include_once( __DIR__ . '/custom/footerModule.php'); ?>
		
		<!-- jquery cdn and custom scripts -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
		<script>window.jQuery || document.write('<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/1.9.1/jquery.min.js"><\/script>');</script>
		
		<!-- <script src="<?php echo get_template_directory_uri(); ?>/js/bootstrap.min.js"></script> -->
		
		<!-- Contact Form 7 scripts -->
		
   		<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.form.min.js"></script>
   		
   		<script src="<?php echo get_template_directory_uri(); ?>/js/contact-form.script.js"></script>

		<!-- /Contact Form 7 scripts -->
		
		<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.lazyload.js"></script>
				
		<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.scrollorama.js"></script>
		
		<script src="<?php echo get_template_directory_uri(); ?>/js/waypoints.min.js"></script>
		
		<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.scrollTo-1.4.3.1-min.js"></script>
		
		<script src="<?php echo get_template_directory_uri(); ?>/js/sammy.min.js"></script>
		
		<script src="<?php echo get_template_directory_uri(); ?>/js/knockout-2.2.1.min.js"></script>
		
      <script src="<?php echo get_template_directory_uri(); ?>/js/main.js"></script>		
				
		<?php wp_footer(); ?>
		
		<!-- analytics -->
		<script>
			var _gaq=[['_setAccount','UA-XXXXXXXX-XX'],['_trackPageview']];
			(function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
			g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
			s.parentNode.insertBefore(g,s)})(document,'script');
		</script>

	</body>
</html>