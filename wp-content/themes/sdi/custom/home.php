<?php /* Template Name: Home */ 

if($_GET['getJSON']) { //spit the JSON if that's what the controller is looking for. AJAX enabled

   $postData = new stdClass();
   
   if (have_posts()): 
      
      while (have_posts()) : the_post();
      
         $postData->ID           = get_the_id();
         $postData->cssClasses   = get_post_class();
         $postData->title        = get_the_title();
         $postData->content      = get_the_content();
         $postData->post_name    = get_the_slug($postData->ID);
               
      endwhile; 
   
   endif;
   
   echo json_encode($postData);
   
} else if($_GET['getTemplate']) { //spit the template if that's what is loooking for. AJAX enabled ?>

<script type="text/html" id="section-home">
   
	<section id="home" class="home" data-bind="with: data">
	
	  <div class="wrapper">
  	    	  
  	  <!-- article -->
   		<article>
   		
        <div data-bind="html: content"></div>
   			
   			<br class="clear">
            
            <div class="row links">
               
               <div class="span4 nomargin link">
                  <a class="link-in" href="#what-i-know"><h2 data-bind="text: $root.currentSection.name">See<br/> What I know</h2></a>
               </div>
               
               <div class="span4 nomargin link">
                  <a href="#what-can-i-do"><h2>See<br/> What I can do</h2></a>
               </div>
               
               <div class="span4 nomargin link">
                  <a href="#who-am-i"><h2>See<br/> Who I am</h2></a>
               </div>               
               
            </div>   			  
   			  
   		</article>
   		<!-- /article -->
  	  
  	  
	  </div> <!-- /wrapper -->
    
    <div href="#" id="handlerArea" class="handlerArea">
      <div class="arrow"></div>
    </div>
    	
	</section>

</script>
	
<?php } else {  //show the plain old HTML. no AJAX/JS

get_header(); ?>	
		
	<section class="home">
	
	  <div class="wrapper">
	  <!-- <div class="cube"></div>   -->
	
    <?php if (have_posts()): while (have_posts()) : the_post(); ?>
   
         <?php if(has_post_thumbnail()): ?>
	      <div class="thumb">
	         <?php the_post_thumbnail('large',array('class' => 'circle')); ?>
	      </div>
	      <?php endif; ?>
   		<!-- article -->
   		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
   		   
   			<?php the_content(); ?>
   			
   			<br class="clear">
            
            <div class="row links">
               
               <div class="span4 ifJsHide" data-bind="fadeVisible: $root.sectionsAssoc().skills.data">
                  <a href="/#skills"><h2>See<br/> What I know</h2></a>
               </div>
               
               <div class="span4 ifJsHide" data-bind="fadeVisible: $root.sectionsAssoc().work.data">
                  <a href="/#work"><h2>See<br/> What I can do</h2></a>
               </div>
               
               <div class="span4 ifJsHide" data-bind="fadeVisible: $root.sectionsAssoc().work.data">
                  <a href="/#work"><h2>See<br/> Who I am</h2></a>
               </div>               
               
            </div>
   			  
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
  	
  	<div class="loader"></div>
	
	</section><!-- /home -->
	
	<?php 
	
	   /* B/C I'm not loading the home page with KO anymore I point the WordPress' home page to this page and include the loader here. */
	   
	   include( __DIR__ .'/loader.php');   	
   	
	?>
	
<?php get_footer(); ?>

<?php } /* endif */ //AJAX==true ?>