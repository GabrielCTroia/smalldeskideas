<?php /* Template Name: Works */ 

if($_GET['getJSON']) { //spit the JSON if that's what the controller is looking for. AJAX enabled

   $postData = new stdClass();
   
   if (have_posts()): 
      
      while (have_posts()) : the_post();
      
         $postData->ID           = get_the_id();
         $postData->cssClasses   = get_post_class();
         $postData->title        = get_the_title();
         $postData->content      = get_the_content();
         $postData->post_name    = get_the_slug($postData->ID);
         
         //get the works         
         $works = new WP_Query(
            array(
              'post_type'        => 'post',
              'orderby'          => 'date',
              'order'            => 'DESC',
              'posts_per_page'   => -1,
              'category_name'    => 'Works'
            )
         ); 

         $postData->works        = $works->posts;
         
         foreach($postData->works as $work):                           
            $work->permalink   = get_permalink($work->ID);            
            //return just the URL of the thumb - found here: http://wordpress.org/support/topic/getting-post-thumbnail-url
            $work->thumbnail   = wp_get_attachment_image_src(get_post_thumbnail_id($work->ID),'large');             
              $work->thumbnail = $work->thumbnail[0];
            $work->ago         = _ago(strtotime($work->post_date)); //this needs to return the proper date
            $work->skills      = wp_get_post_tags($work->ID);
         
         endforeach;
      
      endwhile; 
   
   endif;
   
   echo json_encode($postData);
   
   /*
   echo "<pre>";
   print_r($postData);
   echo "</pre>";
   */
   
} else if($_GET['getTemplate']) { //spit the template if that's what is loooking for. AJAX enabled ?>
   
<script type="text/html" id="section-work">
   
   <!-- ko with: data -->
   
   <section data-bind="attr: {id: post_name}">
      
      <div class="wrapper">
         
         <article data-bind="html: content"></article>
         
         <div class="works-grid row" data-bind="foreach: works">
            
            <article id="post-id" class="span4 box work">       
               
               <?php include("work-thumb.php"); ?>
               
            </article> <!-- /box -->
            
         </div> <!-- /grid -->
         
      </div> <!-- /wrapper -->
   
   </section><!-- /section -->
   
   <!-- /ko -->
   
</script>

<?php } else { //show the plain old HTML. no AJAX/JS

get_header(); ?>
   
	<!-- section -->
	<section class="works content" role="main">
	
	<div class="wrapper">
	
	<?php if (have_posts()): while (have_posts()) : the_post(); ?>
	
	  <!-- <h1 class="title"><?php the_title(); ?></h1> -->
	
		<!-- article -->
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> data-bind="html: content">
		
			<?php the_content(); ?>
			
			<br class="clear">
			
			<?php edit_post_link(); ?>
      </article>

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
	
	</div>
	
	</section>
	<!-- /section -->
   
<?php get_footer(); ?>

<?php } /* endif */ //AJAX==true ?>