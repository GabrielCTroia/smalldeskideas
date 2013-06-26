<?php /* Template Name: Skills */ get_header(); ?>
	
	<!-- section -->
	<section class="skills" role="main">
	
	<?php if (have_posts()): while (have_posts()) : the_post(); ?>
	
	  <h1 class="title"><?php the_title(); ?></h1>
	
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

                   <a href="<?php echo get_term_link($tag->tag_name,'post_tag'); ?>" class="">                   
                     <div class="table">
                        <div class="table-cell">
                           
                           <div class="shown">
                              <h2><?php printf(theScore($skillScore),'<span class="skill-name">' . $tag->tag_name . "</span>"); ?></h2>
                           </div>                           
                           <div class="details hidden">
                              <span><?php echo $tag->count; ?> Projects</span><br>
                              <span><?php echo 13000; ?> Lines Of Code</span><br>
                              <span><?php echo 3; ?> Years of Experience</span><br>                                       
                           </div>
                           
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

              </div><!-- /wrapper -->              
              
            </div><!-- /skill -->
  		<?php endforeach; ?>
			
			
			</div>
		</article>
		
		<div class="c"></div>
		<!-- /article -->
		
	<?php endwhile; ?>
	
	<?php else: ?>
	
		<!-- article -->
		<article>
			
			<h2><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h2>
			
		</article>
		<!-- /article -->
	
	<?php endif; ?>
	
	</section>
	<!-- /section -->

<?php get_footer(); ?>