<div class="works-grid row clearfix">

   <?php if (have_posts()): while (have_posts()) : the_post(); ?>
   	
   	<!-- article -->
   	<article id="post-<?php the_ID(); ?>" class="span4 box work">         
         
         <?php $postID = get_the_ID();          
         include("work-thumb.php") ?>         		   			
         
   	</article>
   	<!-- /article -->
   	
   <?php endwhile; ?>
   
   <?php else: ?>
   
   	<!-- article -->
   	<article>
   		<h2><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h2>
   	</article>
   	<!-- /article -->
   
   <?php endif; ?>
   
</div>