<?php /* Template Name: Skills */

if($_GET['getJSON']) { //spit the JSON if that's what the controller is looking for. AJAX enabled

   $postData = new stdClass();
   
   if (have_posts()): 
      
      while (have_posts()) : the_post();
      
         $postData->ID               = get_the_id();
         $postData->postCssClasses   = get_post_class();
         $postData->title            = get_the_title();
         $postData->content          = get_the_content();
         $postData->post_name        = get_the_slug($postData->ID);
         
         //get the works         
         $skills = new WP_Query(
            array(
              'post_type'        => 'post',
              'orderby'          => 'date',
              'order'            => 'DESC',
              'posts_per_page'   => -1,
              'category_name'    => 'Works'
            )
         ); 

         $postData->skills              = get_category_tags( array('categories' => 'Works'));
          
         foreach($postData->skills as $skill) : 
            
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

<script type="text/html" id="section-skills">
   
   <!-- ko with: data -->
   
   <section class="scrollorama-block" data-bind="attr: {id: post_name}">
      
      <div class="wrapper">
         
         <article data-bind="html: content"></article>
         
         <div class="skills-grid row" data-bind="foreach: skills">
            
            <div class="span2 box skill">       
               
               <div class="box-wrapper">
                  
                  <a data-bind="attr: {href: term_link}">
                     
                     <div class="table">
                        <div class="table-cell">
                           
                           <div class="shown">
                              
                              <h2 data-bind="html: scoreString"></h2>
                              
                           </div> <!-- /shown -->
                           
                           <div class="details hidden">
                              <span><span data-bind="text: projectsCount"></span> Projects</span><br>
                              <span><span data-bind="text: linesOfCode"></span> Lines Of Code</span><br>
                              <span><span data-bind="text: experience"></span> Years of Experience</span><br>      
                           </div> <!-- /details -->
                           
                        </div><!-- /table-cell -->

                     </div> <!-- /table -->
                     
                  </a>
                                                    
                  <div class="ring" data-bind="renderSkill: $data"> 
                  
                     <div class="ring-wrapper">
                        <div class="pie rotated"></div>
                        <div class="pie fill"></div>               
                     </div> <!-- /ring-wrapper -->               
                     
                     <div class="pie trace"></div>
                     <div class="pie background"></div>
                  
                  </div> <!-- /ring -->
                  
               </div> <!-- /box-wrapper -->
               
            </div> <!-- /box -->
            
         </div> <!-- /grid -->
         
      </div> <!-- /wrapper -->
   
   </section><!-- /section -->
   
   <!-- /ko -->
   
</script>

<?php } else { //show the plain old HTML. no AJAX/JS   
 
get_header(); ?>

<!-- section -->
<section class="skills" role="main">

   <div class="wrapper">
   	
	<?php if (have_posts()): while (have_posts()) : the_post(); ?>
	
	  <!-- <h1 class="title"><?php the_title(); ?></h1> -->
	
		<!-- article -->
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		
			<?php the_content(); ?>
			
			<br class="clear">
			
			<?php edit_post_link(); ?>
			
			<div class="skills-grid row">
			
  			<?php 
          
          $skillTags = get_category_tags( array('categories' => 'Works'));
          
          foreach($skillTags as $tag) : 
            
            $skillScore = calculateScore(2,2,2);     
            $rotationDegree = $skillScore * 3.6;
          ?> 
            <div class="span2 box skill" data-code="3230" data-experience="4" data-projects="<?php echo $tag->count;?>">       
              
              <div class="box-wrapper">

                   <a href="<?php echo get_term_link($tag->tag_name,'post_tag'); ?>">                   
                     <div class="table">
                        <div class="table-cell">
                           
                           <div class="shown">
                              <h2><?php printf(theScoreString($skillScore),'<span class="skill-name">' . $tag->tag_name . "</span>"); ?></h2>
                           </div>                           
                           <div class="details hidden">
                              <span><?php echo $tag->count; ?> Projects</span><br>
                              <span><?php echo 13000; ?> Lines Of Code</span><br>
                              <span><?php echo 3; ?> Years of Experience</span><br>                                       
                           </div>
                           
                        </div><!-- /table-cell -->
                     </div><!-- /table -->                     
                   </a>
                
                   <div class="ring"> 
                     <div class="ring-wrapper <?php echo($rotationDegree>180) ? 'gt50' : ''; ?>">
                        <div class="pie rotated" style="-webkit-transform: rotate(<?php echo $rotationDegree;?>deg);"></div>
                        <div class="pie fill" style=""></div>               
                     </div>               
                     <div class="pie trace"></div>                                 
                     <div class="pie background"></div>
                   </div>

              </div><!-- /wrapper -->              
              
            </div><!-- /skill -->
  		<?php endforeach; ?>
			
			
			</div> <!-- /skills -->
			
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
	
   </div> <!-- /wrapper -->
	
</section>
<!-- /section -->

<?php get_footer(); ?>

<?php } /* endif */ //AJAX==true ?>