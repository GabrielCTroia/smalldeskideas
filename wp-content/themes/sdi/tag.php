<?php get_header(); ?>
	
	<!-- section -->
	<section role="main">
	
		<h1 class="title">WORKS <span class="skill"><?php echo single_tag_title('', false); ?><span></h1>
		
<!--
		<ul class="filters">   		
   		<li class="filter-tag">
      		<span class="bold">Filters:</span>
   		</li>
   		<?php    		
   		   $tags = get_category_tags( array('categories' => 'Works'));    		
            
            foreach ($tags as $tag): ?>   		
   		   
   		   <li class="filter-tag <?php echo (single_tag_title('', false) == $tag->tag_name) ? 'current' : '';?>">
   		      <a href="<?php echo get_term_link($tag->tag_name,'post_tag'); ?>">
   		         <?php echo $tag->tag_name; ?>
   		      </a>
   		   </li>   		
   		   
   		<?php endforeach; ?>   		
		</ul>
-->
	
    <div class="clear"></div>
    
		<?php get_template_part('custom-pages/loop-works'); ?>
		
		<?php get_template_part('pagination'); ?>
	
	</section>
	<!-- /section -->
	

<?php get_footer(); ?>