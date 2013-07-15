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
      
         $postData->skills           = getCategoryTags(array('categories' => 'Works'));
                      
            foreach($postData->skills as $skill) : 
               
               $skill = getSkillData($skill);
                                                   
            endforeach;
      
      endwhile; 
   
   endif;
   
   //spit the JSON
   echo json_encode($postData);
   
   
   /*
echo "<pre>";
   print_r($postData);
   echo "</pre>";
*/
   
} else if($_GET['getTemplate']) { //spit the template if that's what is loooking for. AJAX enabled ?>

<script type="text/html" id="section-skills">
   
   <!-- ko with: data -->
   
   <section data-bind="attr: {id: post_name}">
      
      <div class="wrapper">
         
         <article data-bind="html: content"></article>
         
         <div class="skills-grid row" data-bind="foreach: skills">
            
            <div class="span2 box skill" data-bind="attr: {id: 'skill-'+$index()}">       
               
               <div class="box-wrapper">
                  
                  <a data-bind-not-used="attr: {href: term_link}">
                     
                     <div class="table">
                        <div class="table-cell">
                           
                           <div class="shown">
                              
                              <h2 data-bind="html: scoreString"></h2>
                              <span data-bind-not-used="text: formula"></span>
                           </div> <!-- /shown -->
                           
                           <div class="details hidden">                              
                              <span><span data-bind="text: count"></span> Projects</span><br>                              
                              <span>+<span data-bind="text: experience"></span> of Experience</span><br>      
                           </div> <!-- /details -->
                           
                        </div><!-- /table-cell -->

                     </div> <!-- /table -->
                     
                  </a>
                                                    
                  <div class="ring" data-bind="renderSkill: $data">                   
                     <div class="pie-wrapper spinner">
                        <div class="pie"></div>
                        <div class="clipper"></div>
                     </div>
                     <div class="pie-wrapper fill">
                        <div class="pie"></div>               
                     </div>                     
                     <div class="clipper out"></div>
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
          
          $skillTags = getCategoryTags( array('categories' => 'Works'));
          
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
                              <span><?php echo 3; ?> Years of Experience</span><br>                                       
                           </div>
                           
                        </div><!-- /table-cell -->
                     </div><!-- /table -->                     
                   </a>
                
                   <div class="ring <?php echo($rotationDegree>180) ? 'gt50' : ''; ?>" > 
                     <div class="pie-wrapper spinner" style="-webkit-transform: rotate(<?php echo $rotationDegree;?>deg);">
                        <div class="pie"></div>
                        <div class="clipper"></div>
                     </div>                     
                     <div class="pie-wrapper fill">
                        <div class="pie"></div>               
                     </div>
                     <div class="clipper out"></div>
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