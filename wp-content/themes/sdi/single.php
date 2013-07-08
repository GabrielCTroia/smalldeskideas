<?php /* Template Name: Skills */

if($_GET['getJSON']) { //spit the JSON if that's what the controller is looking for. AJAX enabled

   $postData = new stdClass();
   
   if (have_posts()): 
      
      while (have_posts()) : the_post();
      
         $postData->ID               = get_the_ID();
         $postData->postCssClasses   = get_post_class();
         $postData->title            = get_the_title();
         $postData->content          = get_the_content();
         $postData->cover            = get_the_post_thumbnail();
         $postData->coverBkg         = 'background:' . get_post_meta( get_the_ID(), 'CoverBackground' , 1 );
         $postData->externalURL      = get_permalink( get_page_by_title( 'Live' )) . '?url=' . the_slug(false);
         $postData->date             = get_the_time('F j, Y');
         $postData->realURL          = get_permalink();          
         $postData->usedSkills       = wp_get_post_tags($postData->ID);
         
         foreach($postData->usedSkills as $skill) : 
            
            $skill->term_link        = get_term_link($skill->tag_name,'post_tag');
            $skill->projectsCount    = $skill->count;
            $skill->linesOfCode      = 3400;
            $skill->experience       = 4;
            
            $skill->score            = calculateScore(2,2,2);     
            $skill->scoreString      = sprintf(theScoreString($skill->score),'<span class="skill-name">' . $skill->tag_name . "</span>");
            $skill->rotationDeg      = $skill->score * 3.6;
                     
         endforeach;
          
      endwhile; 
   
   endif;
   
   //spit the JSON
   echo json_encode($postData);
   
} else if($_GET['getTemplate']) { //spit the template if that's what is loooking for. AJAX enabled ?>

<script type="text/html" id="single-work">

  <!-- ko with: $root.currentWorkData -->
    
  <section role="main" data-bind="renderPanel: $root.currentWorkData">
    
    <article>
      
      <!-- ko if: cover -->
      
        <div class="hero" data-bind="attr: {style: coverBkg}">
          
          <div class="wrapper">
              
             <div class="cover" data-bind="html: cover"></div> <!-- /cover -->
            
          </div> <!-- /wrapper -->
          
        </div> <!-- /hero -->
        
      <!-- /ko -->
      
      <div class="content wrapper">
        
        <div class="row">
          
          <div class="span8">
            
            <div class="span-wrapper">
              
              <div class="headline clearfix">
                
                <h1 class="title item" data-bind="text: title"></h1>
                
                <a class="project-url item" data-bind="attr: {href: externalURL}">See it live</a>
                
                <span class="date item pull-right">Finished <span data-bind="text: date"></span></span>
                
              </div> <!-- /headline -->
              
              <div data-bind="html: content"></div>
              
            </div> <!-- /span-wrapper -->
            
          </div> <!-- /span8 -->
          
          <?php get_sidebar('left'); ?>  
          
        </div> <!-- /row -->
        
      </div> <!-- /wrapper -->
      
    </article>
    
  </section>
  
  </div>
  
</script>


<?php } else { 

get_header(); ?>
	
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
  
                 </div> <!-- /headline -->
        			
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

<?php get_footer(); ?>

<?php } /* endif */ //AJAX==true ?>