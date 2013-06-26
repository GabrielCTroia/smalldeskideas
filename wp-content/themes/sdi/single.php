<?php get_header(); 
   
?>
	
	</div><!-- /wrapper -->
	
	<!-- section -->
	<section role="main">
	
	<?php if (have_posts()): while (have_posts()) : the_post(); ?>
	
		<!-- article -->
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		  
		  <!-- post thumbnail -->
  			<?php if ( has_post_thumbnail()) : // Check if Thumbnail exists ?>
  			  <div class="hero" style="background: <?php echo (get_post_meta( get_the_ID(), 'CoverBackground' , 1 )) ? get_post_meta( get_the_ID() , 'CoverBackground' , 1 ) : ''; ?>">
  			    
  			     <div class="wrapper">
  			      
       			  <div class="cover">
       				<!-- <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"> -->
       					<?php the_post_thumbnail(); // Fullsize image for the single post ?>
       				<!-- </a> -->
       			  </div>
    			  
  			     </div>
    			 
          </div>
  			<?php endif; ?>
  		<!-- /post thumbnail -->

		
      <div class="content wrapper" role="content">
        
        <div class="row">
        
          <div class="span8">
            
            <div class="span-wrapper">
               
               <div class="headline clearfix">
            
                  <!-- post title -->
         			<h1 class="title item"><?php the_title(); ?></h1>
         			<!-- /post title -->          			  			
                  
                  <?php if(get_post_meta( get_the_id() , 'URL' , 1 )) :?>
                     <a href="<?php echo get_permalink(get_page_by_title( 'Live' )) . '?url=' . the_slug(false) ; ?>" class="project-url item">See it live</a>
                  <?php endif; ?>
                  <span class="date item pull-right">Finished <?php the_time('F j, Y'); ?></span>

               </div>
      			
      			<?php the_content(); // Dynamic Content ?>
      			
      			<?php edit_post_link(); // Always handy to have Edit Post Links available ?>

            </div> <!-- /span-wrapper -->
      		
          </div>
          
          <?php get_sidebar('left'); ?>
  			
        </div><!-- /row -->
        
      </div><!-- /wrapper -->
        
		</article>
		<!-- /article -->
		
	<?php endwhile; ?>
	
	<?php else: ?>
	
		<div class="wrapper">
  		<!-- article -->
  		<article>  		
  			  <h1><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h1>  			
  		</article>
  		<!-- /article -->			  
     </div>
     
	<?php endif; ?>
	
	</section>
	<!-- /section -->
	
	<div class="wrapper">

<?php get_footer(); ?>