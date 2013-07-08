<?php /* Template Name: Me */ get_header(); ?>
	
	<!-- section -->
	<section class="skills" role="main">
	
	<div class="wrapper">
	
	<?php if (have_posts()): while (have_posts()) : the_post(); ?>
	
	  <!-- <h1 class="title"><?php the_title(); ?></h1> -->
	
		<!-- article -->
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		
			<?php the_content(); ?>
			
			<br class="clear">
			
			<?php edit_post_link(); ?>

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
	
	</div><!-- /wrapper -->
	
	</section>
	<!-- /section -->

<?php get_footer(); ?>