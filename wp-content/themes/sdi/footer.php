<?php if($_POST['AJAX'] == true) return; ?>

			</div>
         <!-- main -->
			
			<!-- footer -->
			<footer class="footer scrollorama-block" role="contentinfo">            
            
            <div class="wrapper">
            
            <div class="row">
            
        			<div class="span4">       				
        				<div class="span-wrapper">

           				<h3>Let's Connect</h3>
           				<a href="http://behance.com/gabrielcatalin">
           				 <img src="<?php echo get_template_directory_uri(); ?>/img/icons/be_64x64px.png" alt="be_64x64px" width="" height="" />
           				</a>
           				<a href="http://linkedin.com/gabrielcatalin">
           				 <img src="<?php echo get_template_directory_uri(); ?>/img/icons/linked_in_64x64px.png" alt="linked_in_64x64px" width="" height="" />
           				</a>
           				<a href="http://twitter.com/gabrielcatalin">
           				 <img src="<?php echo get_template_directory_uri(); ?>/img/icons/twitter_64x64px.png" alt="twitter_64x64px" width="" height="" />
           				</a>
           				
                  </div><!-- span-wrapper -->
              </div><!-- /span -->
              
              <div class="span4 twitter-feed">
                <div class="span-wrapper">
                 
                  <a class="twitter-timeline" href="https://twitter.com/gabrielcatalin" height="280" data-chrome="nofooter noheader noscrollbar transparent" data-border-color="#bbb" data-widget-id="349185417867837441">Tweets by @gabrielcatalin</a>
                  <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
      
                </div><!-- span-wrapper -->
              </div><!-- /span -->
              
              <div class="span4">
               <div class="span-wrapper">

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
                 
               </div><!-- /span-wrapper -->                 
              </div><!-- /span -->
               
            </div><!-- /row -->              
            
            </div>
			</footer>
			<!-- /footer -->		
		
		<!-- jquery cdn and custom scripts -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
		<script>window.jQuery || document.write('<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/1.9.1/jquery.min.js"><\/script>');</script>
		
		<!-- <script src="<?php echo get_template_directory_uri(); ?>/js/bootstrap.min.js"></script> -->
		
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