<?php /* Template Name: Works */ get_header(); ?>
	
	<!-- section -->
	<section class="works" role="main">
	
	<?php if (have_posts()): while (have_posts()) : the_post(); ?>
	
	  <h1 class="title"><?php the_title(); ?></h1>
	
		<!-- article -->
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		
			<?php the_content(); ?>
			
			<br class="clear">
			
			<?php edit_post_link(); ?>
      </article>
		
		<div class="c"></div>
		<!-- /article -->
			
			
			<div class="works-grid row">
			
  			<?php 
          
          $works = new WP_Query(
            array(
              'post_type'        => 'post',
              'orderby'          => 'date',
              'order'            => 'DESC',
              'posts_per_page'   => -1,
              'category_name'    => 'Works'
            )
          ); 
                 
          foreach($works->posts as $work) : 
   
         ?> 

         <article id="post-<?php echo $work->ID ?>" class="span4 box work" style="background-image:url(<?php echo $work->thumbnail; ?>)">       
            <?php $postID = $work->ID; 
            include("work-thumb.php") ?>
         </article>

  		<?php endforeach; ?>
			
			
			</div>
		
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