   	   <div class="box-wrapper">
      	   <a href="<?php echo get_permalink($postID); ?>" title="<?php the_title(); ?>">
   
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
            		<h2 class="work-title pull-left"><?php echo get_the_title($postID); ?></h2>      		            		
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