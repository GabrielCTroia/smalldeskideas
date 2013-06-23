<?php get_header(); ?>
	
	</div><!-- /wrapper -->
	
	<!-- section -->
	<section role="main">
	
	<?php if (have_posts()): while (have_posts()) : the_post(); ?>
	
		<!-- article -->
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		
		  <!-- post thumbnail -->
  			<?php if ( has_post_thumbnail()) : // Check if Thumbnail exists ?>
  			  <div class="hero">
  			  
    			  <div class="cover">
    				<!-- <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"> -->
    					<?php the_post_thumbnail(); // Fullsize image for the single post ?>
    				<!-- </a> -->
    			  </div>
    			 
          </div>
  			<?php endif; ?>
  		<!-- /post thumbnail -->

		
      <div class="wrapper">
        
        <div class="row">
        
          <div class="span8">
            
            <!-- post title -->
      			<h1>
      				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
      			</h1>
      			<!-- /post title -->          			  			
            
      			<!-- post details -->
      			<h2>Job Finished on <span class="date"><?php the_time('F j, Y'); ?></span></h2>
      			<!-- /post details -->
      			
      			<?php the_content(); // Dynamic Content ?>
      			
      			<p><?php _e( 'Categorised in: ', 'html5blank' ); the_category(', '); // Separated by commas ?></p>
      			
      			<?php edit_post_link(); // Always handy to have Edit Post Links available ?>
      		
          </div>
          
          <aside class="span4">
            
            <div class="skills-used grid">
            
              <h2>Skills Used:</h2>
              <?php 
              
                //the_tags( __( 'Skills Used: ', 'html5blank' ), ', ', ''); // Separated by commas with a line break at the end 
                $tags = wp_get_post_tags(get_the_ID());
                
                //var_dump($tags);
                
                foreach( $tags as $tag ) : 
                
                  $skillScore = calculateScore(2,2,2);     
                  $rotationDegree = $skillScore * 3.6;
  
                ?>               
                    <div class="skill box" data-code="" data-experience="" data-projects="<?php echo $tag->count;?>">       
                      
                        <div class="box-wrapper">
          
                           <a href="<?php echo get_term_link($tag->name,'post_tag'); ?>" class="">                   
                             <div class="table">
                                <div class="table-cell">                                 
                                  <h5><?php echo $tag->name; ?></h5>                                                            
                                </div><!-- /table-cell -->
                             </div><!-- /table -->                     
                           </a>
                        
                           <div class="ring experience"> 
                             <div class="ring-wrapper <?php echo($rotationDegree>180) ? 'gt50' : ''; ?>">
                                <div class="pie" style="-webkit-transform: rotate(<?php echo $rotationDegree;?>deg);"></div>
                                <div class="pie fill" style=""></div>               
                             </div>               
                             <div class="pie trace"></div>                                 
                             <div class="pie background"></div>
                           </div>
                             
                        </div><!-- /box-wrapper -->
                        
                    </div><!-- /skill -->
                    
                <?php endforeach; ?>
            
            </div><!-- /skills-used -->
            
          </aside>
  			
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