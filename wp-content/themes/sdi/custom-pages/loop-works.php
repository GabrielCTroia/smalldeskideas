<div class="works-grid row clearfix">

   <?php if (have_posts()): while (have_posts()) : the_post(); ?>
   	
   	<!-- article -->
   	<article id="post-<?php the_ID(); ?>" class="span4 box work">
   	   
   	   <div class="box-wrapper">
      	   <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
   
         		<!-- post thumbnail -->
         		<div class="thumb">
            		<?php if ( has_post_thumbnail()) : // Check if thumbnail exists ?>   			
            			<?php the_post_thumbnail('medium'); // Declare pixel size you need inside the array ?>
            		<?php else: ?>
            		   <span>&#60;/no thumb&#62;</span>
            		<?php endif; ?>
         		</div>
         		<!-- /post thumbnail -->
         		
         		<div class="info">
            		
            		<!-- post title -->
            		<h2><?php the_title(); ?></h2>      		            		
            		<!-- /post title -->
            		<span class="date"><?php echo _ago(get_post_time('U',true)); ?></span>
            		<p>~3400 lines of code</p>
            		
         		</div>
         		
         		<?php //html5wp_excerpt('html5wp_index'); // Build your custom callback length in functions.php ?>
         		
         		<?php edit_post_link(); ?>
      		
            </a>
   	   </div>   		   			
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