<?php /* Template Name: Home */ get_header(); ?>
	</div> <!-- wrapper -->
	
	<?php if (have_posts()): while (have_posts()) : the_post(); ?>
	
	   <div class="hero">
	      
	      <div class="cover">
	         <?php the_post_thumbnail(); ?>
	      </div>
	        
         <div class="wrapper">
         
      		<!-- article -->
      		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
      		   
      			<?php the_content(); ?>
      			
      			<br class="clear">
      			
      			<?php edit_post_link(); ?>			
      			  
      		</article>
      		<!-- /article -->
   		
         </div>
         
      </div>
	<?php endwhile; ?>
	
	<?php else: ?>
	
		<!-- article -->
		<article>
			
			<h2><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h2>
			
		</article>
		<!-- /article -->
	
	<?php endif; ?>
	
      <!-- wrapper -->
	<div class="wrapper">

<?php get_footer(); ?>