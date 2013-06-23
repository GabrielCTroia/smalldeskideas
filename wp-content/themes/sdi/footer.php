			<!-- footer -->
			<footer class="footer" role="contentinfo">
        
           <!-- logo -->
     			<div class="span4 pull-left">
     				<a href="<?php echo home_url(); ?>">
                 <?php bloginfo('title'); ?>
     				</a>
     				<br><br>
     				Follow me:
     				
     				<a href="http://behance.com/gabrielcatalin">
     				 <img src="<?php echo get_template_directory_uri(); ?>/img/icons/be_64x64px.png" alt="be_64x64px" width="" height="" />
     				</a>
     				<a href="http://linkedin.com/gabrielcatalin">
     				 <img src="<?php echo get_template_directory_uri(); ?>/img/icons/linked_in_64x64px.png" alt="linked_in_64x64px" width="" height="" />
     				</a>
     				<a href="http://twitter.com/gabrielcatalin">
     				 <img src="<?php echo get_template_directory_uri(); ?>/img/icons/twitter_64x64px.png" alt="twitter_64x64px" width="" height="" />
     				</a>
     			</div>
     			<!-- /logo -->				
           
           <div class="span4 pull-right">
              
            <form class="contact">
               
               <div class="control-group">
                  <label for="input-name">Your Name</label>
                  <input id="input-name" name="input-name" type="text" value="" placeholder="Your Name" ><br/>
               </div>
               
               <div class="control-group">
                  <label for="input-name">Your Email</label>
                  <input id="input-email" name="input-email" type="text" value="" placeholder="Your Email" ><br/>
               </div>
               
               <div class="control-group">
                  <label for="input-name">The Message</label>
                  <textarea id="input-msg" name="input-msg" type="text" value="" placeholder="Message" ></textarea><br/>
               </div>

               <div class="control-group">
                  <input type="submit" value="Say Hello!">
               </div>
               
            </form>
              
           </div>
        
			</footer>
			<!-- /footer -->
		
		</div>
		<!-- /wrapper -->
		
		<!-- jquery cdn and custom scripts -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
		<script>window.jQuery || document.write('<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/1.9.1/jquery.min.js"><\/script>');</script>
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