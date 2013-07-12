		<!-- footer -->
		<footer class="footer ifJsHide" data-bind="afterAllLoaded: true" role="contentinfo">            
         
         <div class="wrapper">
         
         <div class="row">
         
     			<div class="span4 left-col">       				
     				<div class="span-wrapper">
                  <div class="social-icons">
           				<!-- <h3>Let's Connect</h3> -->
           				<a target="_blank" href="http://behance.com/gabrielcatalin">
           				 <img src="<?php echo get_template_directory_uri(); ?>/img/icons/be_64x64px.png" alt="be_64x64px"/>
           				</a>
           				<a target="_blank" href="http://linkedin.com/gabrielcatalin">
           				 <img src="<?php echo get_template_directory_uri(); ?>/img/icons/linked_in_64x64px.png" alt="linked_in_64x64px"/>
           				</a>
           				<a target="_blank" href="http://twitter.com/gabrielcatalin">
           				 <img src="<?php echo get_template_directory_uri(); ?>/img/icons/twitter_64x64px.png" alt="twitter_64x64px" />
           				</a>
                  </div><!-- /social-icons -->     
                  <br/>
               </div><!-- span-wrapper -->
           </div><!-- /span -->
           
           <div class="span4 middle-col">
             <div class="span-wrapper">
               <div class="twitter-feed">
                  <a class="twitter-timeline" href="https://twitter.com/gabrielcatalin" height="370" data-chrome="nofooter noheader noscrollbar transparent" data-border-color="#bbb" data-widget-id="349185417867837441">Tweets by @gabrielcatalin</a>
                  <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
               </div> <!-- /twitter-feed -->
   
             </div><!-- span-wrapper -->
           </div><!-- /span -->
           
           <div class="span4 right-col">
            <div class="span-wrapper">
               <?php echo do_shortcode('[contact-form-7 id="77" title="Contact Form"]') ?>                 
            </div><!-- /span-wrapper -->                 
           </div><!-- /span -->
            
         </div><!-- /row -->              
         
         </div>
		</footer>
		<!-- /footer -->		