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
    			
  /*
    			echo "<pre>";
    			print_r(get_category_tags( array('categories' => 'Works') ));
    			echo "</pre>";
  */
          
          $skillTags = get_category_tags( array('categories' => 'Works'));
          
          foreach($skillTags as $tag) : ?> 
            <div class="span5 box skill" data-code="3230" data-experience="4" data-projects="<?php echo $tag->count;?>">       
              <div class="wrapper circle">
                <a href="<?php echo get_term_link($tag->tag_name,'post_tag'); ?>" class="">
                
                  <div class="table">
                     <div class="table-cell">
                        <h2><?php echo $tag->tag_name; ?></h2>
                        <p><?php echo $tag->count; ?> Projects 
                        <br/>~ 3400 Lines of Code</p>            
                     </div><!-- /table-cell -->
                  </div><!-- /table -->
                  
                </a>
                
               <div class="ring experience">
                  <div class="pie" style=""></div>
                  <div class="pie fill" style=""></div>               
               </div>                  
               
               <div class="ring projects">
                  <div class="pie" style=""></div>
                  <div class="pie fill" style=""></div>
               </div>
               
               <div class="ring codes">
                  <div class="pie" style=""></div>
                  <div class="pie fill" style=""></div>
               </div>
               
<!--                 <div class="line-experience" data-score="69" style="//width:<?php echo rand(20,80); ?>px">eXperience</div> -->
<!--
                <div class="line-projects" data-score="23" style="width:<?php echo rand(20,100); ?>px">Projects</div>
                <div class="line-code" data-score="95" style="width:<?php echo rand(20,100); ?>px">Code</div>
-->

              </div>
              
            </div>
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