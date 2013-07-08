<?php
/*
YARPP Template: Thumbnails
Description: Requires a theme which supports post thumbnails
Author: mitcho (Michael Yoshitaka Erlewine)
*/ ?>
<h3>Related Work</h3>
<?php if (have_posts()):?>
<ul class="grid row">
	<?php while (have_posts()) : the_post(); ?>
		<?php if (has_post_thumbnail()):?>
		<li class="box span6">
		   <div class="box-wrapper span-wrapper thumb">
		      <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
               <?php the_post_thumbnail('medium'); ?>
               <div class="table">                  
   		         <div class="table-cell">   		               		         		         
      		         <h4 class="hidden"><?php the_title_attribute(); ?></h4>      		         
                  </div>  
               </div>
		       </a>
		   </div>
      </li>
		<?php endif; ?>
	<?php endwhile; ?>
</ul>

<?php else: ?>
<p>No related photos.</p>
<?php endif; ?>
