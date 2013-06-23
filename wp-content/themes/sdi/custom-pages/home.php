<?php /* Template Name: Home */ get_header(); ?>
	
	<?php if (have_posts()): while (have_posts()) : the_post(); ?>
	
	   <div class="focus">
	      
	      <div class="thumb">
	         <?php the_post_thumbnail('large',array('class' => 'circle')); ?>
	      </div>

         
      		<!-- article -->
      		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
      		   
      			<?php the_content(); ?>
      			
      			<br class="clear">
      			
      			<?php edit_post_link(); ?>			
      			  
      		</article>
      		<!-- /article -->
         
      </div>
	<?php endwhile; ?>
	
	<?php else: ?>
	
		<!-- article -->
		<article>
			
			<h2><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h2>
			
		</article>
		<!-- /article -->
	
	<?php endif; ?>


<?php get_footer(); ?>