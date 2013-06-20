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

/*          echo "pre"; */
    			          
/*
          $works = new WP_Query(array(
            'post_type'          => 'post'
          ));
*/
          
/*          echo "<pre>"; */
/*  			print_r($works); */
/*  			echo "</pre>"; */
 			
 			
 			
/*  		    echo "Asd"; */
           
/*           var_dump($works); */
          
          
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
/*
       
         echo "<pre>";
 			print_r($work);
 			echo "</pre>";
*/ 
       ?> 
      
         
         <article id="post-<?php echo $work->ID ?>" class="span4 box work" style="background-image:url(<?php echo $work->thumbnail; ?>)">       
           <div class="wrapper">             
             <a href="<?php echo get_permalink($work->ID); ?> " class="">
               <div class="thumb"><?php echo (has_post_thumbnail($work->ID)) ? get_the_post_thumbnail( $work->ID , 'medium') : '<span>&#60;/no thumb&#62;</span>'; ?></div>
               <div class="info">
                  <h2><?php echo $work->post_title; ?></h2>
                  <p>~ 3400 Lines of Code</p>            
               </div>
             </a>
           </div>
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