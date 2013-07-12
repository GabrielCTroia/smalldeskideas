<?php if($_GET['getJSON']) { //spit the JSON if that's what the controller is looking for. AJAX enabled
   
   //the JSON for this should already by part of the Works Object
   
} else if($_GET['getTemplate']) { //spit the template if that's what is loooking for. AJAX enabled ?>

   <div class="box-wrapper" data-bind="">
      
      <a data-bind="attr: {href: $root.getWorkPermalink($data)}">
         
         <!-- post thumbnail -->
   		<div class="thumb">
   		   <!-- ko if: thumbnail -->
   		      <div>
      		      <img class="lazy" src="" data-bind="attr: {'data-original': thumbnail}" />
   		      </div>
   		   <!-- /ko -->
   		   <!-- ko ifnot: thumbnail -->
      		   <span>&#60;/no thumb&#62;</span>
            <!-- /ko -->
   		</div>
   		<!-- /post thumbnail -->         
         
         <div class="info">
      		
      		<!-- post title -->
      		<h2 class="work-title pull-left" data-bind="text: post_title"></h2>      		            		
      		<!-- /post title -->
      		
      		<span class="date pull-right" data-bind="text: ago"></span>
      		
      		<div class="clear"></div>
      		
      		<p class="skills" data-bind="foreach: skills">
               <span data-bind="text: $data.name"></span>
      		</p>
      		
   		</div> <!-- /info -->
         
      </a>
   
   </div> <!-- box-wrapper -->


<?php } else { //show the plain old HTML. no AJAX/JS ?>

   <div class="box-wrapper">
	   <a href="<?php echo get_permalink($postID); ?>" title="<?php echo $work->post_title; ?>">

   		<!-- post thumbnail -->
   		<div class="thumb">
      		<?php if ( has_post_thumbnail($postID)) : // Check if thumbnail exists ?>   			
      			<?php echo get_the_post_thumbnail($postID,'large'); // Declare pixel size you need inside the array ?>
      		<?php else: ?>
      		   <span>&#60;/no thumb&#62;</span>
      		<?php endif; ?>
   		</div>
   		<!-- /post thumbnail -->
   		
   		<div class="info">
      		
      		<!-- post title -->
      		<h2 class="work-title pull-left"><?php echo $work->post_title; ?></h2>      		            		
      		<!-- /post title -->
      		
      		<span class="date pull-right"><?php echo _ago(get_post_time('U',true)); ?></span>
      		
      		<div class="clear"></div>
      		
      		<p class="skills">
      		<?php $tags = wp_get_post_tags($postID); 
        		if($tags):
              
        		  foreach($tags as $index=>$tag):              		
                echo $tag->name . ', ';
                //if(!end($tags)) echo ',';
              endforeach;
        		endif; ?>
      		</p>
   		</div>
   		
   		<?php //html5wp_excerpt('html5wp_index'); // Build your custom callback length in functions.php ?>
   		
   		<?php edit_post_link(); ?>      		
      </a>
   </div><!-- /box-wrapper -->  
   
<?php } //endif ?>