<?php get_header(); ?>
	
	<!-- section -->
	<section role="main">
	
		<h1 class="title">I've done all these using       
		
		   <span class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo single_tag_title('', false); ?></a>
            <ul class="dropdown-menu">   		
         		<?php    		
         		   $tags = get_category_tags( array('categories' => 'Works'));    		
                  
                  foreach ($tags as $tag): ?>   		
         		   
         		   <li class="<?php echo (single_tag_title('', false) == $tag->tag_name) ? 'current' : '';?>">
         		      <a href="<?php echo get_term_link($tag->tag_name,'post_tag'); ?>">
         		         <?php echo $tag->tag_name; ?>
         		      </a>
         		   </li>   		
         		   
         		<?php endforeach; ?>   		
      		</ul>
         </span>
      </h1>


		
		
<!-- 		<span class="skill"><?php echo single_tag_title('', false); ?><span></h1> -->
		
	<!--
	<ul class="filters">   		
   		<li class="filter-tag">
      		<span class="bold">Filter by Skill:</span>
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
		
		<!--
<ul class="filters by-type pull-right">
   		 <li class="filter-tag">
      		<span class="bold">Filter by Type:</span>
   		</li>
   		<?php 
      		
      		$categories = get_categories(array(      		   
      		   'child_of'  => 4 //works category
      		   ,'orderby'  => 'count'
      		   ,'order'    => 'desc'
      		));
      		
      		//var_dump($categories);
      		
/*
      		echo "<pre>";
      		print_r($categories);
      		echo "</pre>";
*/
            foreach($categories as $category): ?>
            
            <li class="filter-tag">
               <a href="<?php echo get_category_link( $category->term_id ); ?>">
                  <?php echo $category->name; ?>
               </a>               
            </li>
            
            <?php endforeach; ?>
   		
		</ul>
-->
	
    <div class="clear"></div>
    
		<?php get_template_part('custom/loop-works'); ?>
		
		<?php get_template_part('pagination'); ?>
	
	</section>
	<!-- /section -->
	

<?php get_footer(); ?>