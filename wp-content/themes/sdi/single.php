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
            
               <!-- post title -->
      			<h1>
      				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
      			</h1>
      			<!-- /post title -->          			  			
            
      			<!-- post details -->
      			<h2>Job Finished on <span class="date"><?php the_time('F j, Y'); ?></span></h2>
      			<!-- /post details -->
      			
      			<?php the_content(); // Dynamic Content ?>
      			
      			<?php edit_post_link(); // Always handy to have Edit Post Links available ?>

            </div> <!-- /span-wrapper -->
      		
          </div>
          
          <aside class="span4">
            
            <div class="span-wrapper">
               
               <h2>Visit:<a href="http://amnet.com">amnet.com</a></h2>
               
               <div class="skills-used grid clearfix">
                  
                 <h2>Skills Used:</h2>
                 
                 <div class="row">
                 <?php 
                 
                   //the_tags( __( 'Skills Used: ', 'html5blank' ), ', ', ''); // Separated by commas with a line break at the end 
                   $tags = wp_get_post_tags(get_the_ID());
                   
                   //var_dump($tags);
                   
                   foreach( $tags as $tag ) : 
                   
                     $skillScore = calculateScore(2,2,2);     
                     $rotationDegree = $skillScore * 3.6;
     
                   ?>               
                       <div class="skill span3 box" data-code="" data-experience="" data-projects="<?php echo $tag->count;?>">       
                         
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
                  
                 </div><!-- /grid-row -->
                 
               </div><!-- /skills-used -->
               
               <div class="project-details">
                  
                  <h2>Project Details</h2>
                  
                  <span>Project Duration ~ 3month</span><br>
                  <span>Total lines of code ~ 23000</span><br>
                  <span>Project Duration ~ 3month</span><br>
                  
               </div>
               
            </div><!-- span-wrapper -->
            
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