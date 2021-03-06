<?php
/*
 *  Author: Todd Motto | @toddmotto
 *  URL: html5blank.com | @html5blank
 *  Custom functions, support, custom post types and more.
 */

/*------------------------------------*\
	External Modules/Files
\*------------------------------------*/

// Load any external files you have here

/*------------------------------------*\
	Theme Support
\*------------------------------------*/

if (!isset($content_width))
{
    $content_width = 900;
}

if (function_exists('add_theme_support'))
{
    // Add Menu Support
    add_theme_support('menus');

    // Add Thumbnail Theme Support
    add_theme_support('post-thumbnails');
    add_image_size('large', 700, '', true); // Large Thumbnail
    add_image_size('medium', 250, '', true); // Medium Thumbnail
    add_image_size('small', 120, '', true); // Small Thumbnail
    add_image_size('custom-size', 700, 200, true); // Custom Thumbnail Size call using the_post_thumbnail('custom-size');

    // Add Support for Custom Backgrounds - Uncomment below if you're going to use
    /*add_theme_support('custom-background', array(
	'default-color' => 'FFF',
	'default-image' => get_template_directory_uri() . '/img/bg.jpg'
    ));*/

    // Add Support for Custom Header - Uncomment below if you're going to use
    /*add_theme_support('custom-header', array(
	'default-image'			=> get_template_directory_uri() . '/img/headers/default.jpg',
	'header-text'			=> false,
	'default-text-color'		=> '000',
	'width'				=> 1000,
	'height'			=> 198,
	'random-default'		=> false,
	'wp-head-callback'		=> $wphead_cb,
	'admin-head-callback'		=> $adminhead_cb,
	'admin-preview-callback'	=> $adminpreview_cb
    ));*/

    // Enables post and comment RSS feed links to head
    add_theme_support('automatic-feed-links');

    // Localisation Support
    load_theme_textdomain('html5blank', get_template_directory() . '/languages');
}

/*------------------------------------*\
	Functions
\*------------------------------------*/

// HTML5 Blank navigation
function html5blank_nav()
{
	wp_nav_menu(
	array(
		'theme_location'  => 'header-menu',
		'menu'            => '', 
		'container'       => 'div', 
		'container_class' => 'menu-{menu slug}-container', 
		'container_id'    => '',
		'menu_class'      => 'menu', 
		'menu_id'         => '',
		'echo'            => true,
		'fallback_cb'     => 'wp_page_menu',
		'before'          => '',
		'after'           => '',
		'link_before'     => '',
		'link_after'      => '',
		'items_wrap'      => '<ul>%3$s</ul>',
		'depth'           => 0,
		'walker'          => ''
		)
	);
}

// Protocol relative URLs for enqueued scripts/styles
function html5blank_protocol_relative($url)
{
	if(is_admin()) return $url;
	return str_replace(array('http:','https:'), '', $url, $c=1);
}

// Load HTML5 Blank scripts (header.php)
function html5blank_header_scripts()
{
    if (!is_admin()) {
        wp_register_script('conditionizr', '//cdnjs.cloudflare.com/ajax/libs/conditionizr.js/2.2.0/conditionizr.min.js', array(), '2.2.0'); // Conditionizr
        wp_enqueue_script('conditionizr'); // Enqueue it!
        
        wp_register_script('modernizr', '//cdnjs.cloudflare.com/ajax/libs/modernizr/2.6.2/modernizr.min.js', array(), '2.6.2'); // Modernizr
        wp_enqueue_script('modernizr'); // Enqueue it!
    }
}

// Load HTML5 Blank scripts (footer.php)
function html5blank_footer_scripts()
{
    if (!is_admin()) {
        wp_deregister_script('jquery'); // Deregister WordPress jQuery
        
        wp_register_script('html5blankscripts', get_template_directory_uri() . '/js/scripts.js', array(), '1.0.0'); // Custom scripts
        wp_enqueue_script('html5blankscripts'); // Enqueue it!
    }
}

// Load HTML5 Blank conditional scripts
function conditional_scripts()
{
    if (is_page('pagenamehere')) {
        wp_register_script('scriptname', get_template_directory_uri() . '/js/scriptname.js', array('jquery'), '1.0.0'); // Conditional script(s)
        wp_enqueue_script('scriptname'); // Enqueue it!
    }
}

// Load HTML5 Blank styles
function html5blank_styles()
{
    wp_register_style('normalize', get_template_directory_uri() . '/normalize.css', array(), '1.0', 'all');
    wp_enqueue_style('normalize'); // Enqueue it!
    
    wp_register_style('html5blank', get_template_directory_uri() . '/style.css', array(), '1.0', 'all');
    wp_enqueue_style('html5blank'); // Enqueue it!
}

// Register HTML5 Blank Navigation
function register_html5_menu()
{
    register_nav_menus(array( // Using array to specify more menus if needed
        'header-menu' => __('Header Menu', 'html5blank'), // Main Navigation
        'sidebar-menu' => __('Sidebar Menu', 'html5blank'), // Sidebar Navigation
        'extra-menu' => __('Extra Menu', 'html5blank') // Extra Navigation if needed (duplicate as many as you need!)
    ));
}

// Remove the <div> surrounding the dynamic navigation to cleanup markup
function my_wp_nav_menu_args($args = '')
{
    $args['container'] = false;
    return $args;
}

// Remove Injected classes, ID's and Page ID's from Navigation <li> items
function my_css_attributes_filter($var)
{
    return is_array($var) ? array() : '';
}

// Remove invalid rel attribute values in the categorylist
function remove_category_rel_from_category_list($thelist)
{
    return str_replace('rel="category tag"', 'rel="tag"', $thelist);
}

// Add page slug to body class, love this - Credit: Starkers Wordpress Theme
function add_slug_to_body_class($classes)
{
    global $post;
    if (is_home()) {
        $key = array_search('blog', $classes);
        if ($key > -1) {
            unset($classes[$key]);
        }
    } elseif (is_page()) {
        $classes[] = sanitize_html_class($post->post_name);
    } elseif (is_singular()) {
        $classes[] = sanitize_html_class($post->post_name);
    }

    return $classes;
}

// If Dynamic Sidebar Exists
if (function_exists('register_sidebar'))
{
    // Define Sidebar Widget Area 1
    register_sidebar(array(
        'name' => __('Widget Area 1', 'html5blank'),
        'description' => __('Description for this widget-area...', 'html5blank'),
        'id' => 'widget-area-1',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));

    // Define Sidebar Widget Area 2
    register_sidebar(array(
        'name' => __('Widget Area 2', 'html5blank'),
        'description' => __('Description for this widget-area...', 'html5blank'),
        'id' => 'widget-area-2',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));
}

// Remove wp_head() injected Recent Comment styles
function my_remove_recent_comments_style()
{
    global $wp_widget_factory;
    remove_action('wp_head', array(
        $wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
        'recent_comments_style'
    ));
}

// Pagination for paged posts, Page 1, Page 2, Page 3, with Next and Previous Links, No plugin
function html5wp_pagination()
{
    global $wp_query;
    $big = 999999999;
    echo paginate_links(array(
        'base' => str_replace($big, '%#%', get_pagenum_link($big)),
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages
    ));
}

// Custom Excerpts
function html5wp_index($length) // Create 20 Word Callback for Index page Excerpts, call using html5wp_excerpt('html5wp_index');
{
    return 20;
}

// Create 40 Word Callback for Custom Post Excerpts, call using html5wp_excerpt('html5wp_custom_post');
function html5wp_custom_post($length)
{
    return 40;
}

// Create the Custom Excerpts callback
function html5wp_excerpt($length_callback = '', $more_callback = '')
{
    global $post;
    if (function_exists($length_callback)) {
        add_filter('excerpt_length', $length_callback);
    }
    if (function_exists($more_callback)) {
        add_filter('excerpt_more', $more_callback);
    }
    $output = get_the_excerpt();
    $output = apply_filters('wptexturize', $output);
    $output = apply_filters('convert_chars', $output);
    $output = '<p>' . $output . '</p>';
    echo $output;
}

// Custom View Article link to Post
function html5_blank_view_article($more)
{
    global $post;
    return '... <a class="view-article" href="' . get_permalink($post->ID) . '">' . __('View Article', 'html5blank') . '</a>';
}

// Remove Admin bar
function remove_admin_bar()
{
    return false;
}

// Remove 'text/css' from our enqueued stylesheet
function html5_style_remove($tag)
{
    return preg_replace('~\s+type=["\'][^"\']++["\']~', '', $tag);
}

// Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail
function remove_thumbnail_dimensions( $html )
{
    $html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
    return $html;
}

// Custom Gravatar in Settings > Discussion
function html5blankgravatar ($avatar_defaults)
{
    $myavatar = get_template_directory_uri() . '/img/gravatar.jpg';
    $avatar_defaults[$myavatar] = "Custom Gravatar";
    return $avatar_defaults;
}

// Threaded Comments
function enable_threaded_comments()
{
    if (!is_admin()) {
        if (is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
            wp_enqueue_script('comment-reply');
        }
    }
}

// Custom Comments Callback
function html5blankcomments($comment, $args, $depth)
{
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);
	
	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
?>
	<<?php echo $tag ?> <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
	<?php if ( 'div' != $args['style'] ) : ?>
	<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
	<?php endif; ?>
	<div class="comment-author vcard">
	<?php if ($args['avatar_size'] != 0) echo get_avatar( $comment, $args['180'] ); ?>
	<?php printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>'), get_comment_author_link()) ?>
	</div>
<?php if ($comment->comment_approved == '0') : ?>
	<em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.') ?></em>
	<br />
<?php endif; ?>

	<div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">
		<?php
			printf( __('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)'),'  ','' );
		?>
	</div>

	<?php comment_text() ?>

	<div class="reply">
	<?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
	</div>
	<?php if ( 'div' != $args['style'] ) : ?>
	</div>
	<?php endif; ?>
<?php }

/*------------------------------------*\
	Actions + Filters + ShortCodes
\*------------------------------------*/

// Add Actions
add_action('init', 'html5blank_header_scripts'); // Add Custom Scripts to wp_head
add_action('wp_footer', 'html5blank_footer_scripts'); // Add Custom Scripts to wp_footer
add_action('wp_print_scripts', 'conditional_scripts'); // Add Conditional Page Scripts
add_action('get_header', 'enable_threaded_comments'); // Enable Threaded Comments
add_action('wp_enqueue_scripts', 'html5blank_styles'); // Add Theme Stylesheet
add_action('init', 'register_html5_menu'); // Add HTML5 Blank Menu
add_action('init', 'create_post_type_html5'); // Add our HTML5 Blank Custom Post Type
add_action('widgets_init', 'my_remove_recent_comments_style'); // Remove inline Recent Comment Styles from wp_head()
add_action('init', 'html5wp_pagination'); // Add our HTML5 Pagination

// Remove Actions
remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
remove_action('wp_head', 'index_rel_link'); // Index link
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // Prev link
remove_action('wp_head', 'start_post_rel_link', 10, 0); // Start link
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // Display relational links for the posts adjacent to the current post.
remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

// Add Filters
add_filter('script_loader_src', 'html5blank_protocol_relative'); // Protocol relative URLs for enqueued scripts
add_filter('style_loader_src' , 'html5blank_protocol_relative'); // Protocol relative URLs for enqueued styles
add_filter('avatar_defaults', 'html5blankgravatar'); // Custom Gravatar in Settings > Discussion
add_filter('body_class', 'add_slug_to_body_class'); // Add slug to body class (Starkers build)
add_filter('widget_text', 'do_shortcode'); // Allow shortcodes in Dynamic Sidebar
add_filter('widget_text', 'shortcode_unautop'); // Remove <p> tags in Dynamic Sidebars (better!)
add_filter('wp_nav_menu_args', 'my_wp_nav_menu_args'); // Remove surrounding <div> from WP Navigation
// add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected classes (Commented out by default)
// add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected ID (Commented out by default)
// add_filter('page_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> Page ID's (Commented out by default)
add_filter('the_category', 'remove_category_rel_from_category_list'); // Remove invalid rel attribute
add_filter('the_excerpt', 'shortcode_unautop'); // Remove auto <p> tags in Excerpt (Manual Excerpts only)
add_filter('the_excerpt', 'do_shortcode'); // Allows Shortcodes to be executed in Excerpt (Manual Excerpts only)
add_filter('excerpt_more', 'html5_blank_view_article'); // Add 'View Article' button instead of [...] for Excerpts
add_filter('show_admin_bar', 'remove_admin_bar'); // Remove Admin bar
add_filter('style_loader_tag', 'html5_style_remove'); // Remove 'text/css' from enqueued stylesheet
add_filter('post_thumbnail_html', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to thumbnails
add_filter('image_send_to_editor', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to post images

// Remove Filters
remove_filter('the_excerpt', 'wpautop'); // Remove <p> tags from Excerpt altogether

// Shortcodes
add_shortcode('html5_shortcode_demo', 'html5_shortcode_demo'); // You can place [html5_shortcode_demo] in Pages, Posts now.
add_shortcode('html5_shortcode_demo_2', 'html5_shortcode_demo_2'); // Place [html5_shortcode_demo_2] in Pages, Posts now.

// Shortcodes above would be nested like this -
// [html5_shortcode_demo] [html5_shortcode_demo_2] Here's the page title! [/html5_shortcode_demo_2] [/html5_shortcode_demo]

/*------------------------------------*\
	Custom Post Types
\*------------------------------------*/

// Create 1 Custom Post type for a Demo, called HTML5-Blank
function create_post_type_html5()
{
    register_taxonomy_for_object_type('category', 'html5-blank'); // Register Taxonomies for Category
    register_taxonomy_for_object_type('post_tag', 'html5-blank');
    register_post_type('html5-blank', // Register Custom Post Type
        array(
        'labels' => array(
            'name' => __('HTML5 Blank Custom Post', 'html5blank'), // Rename these to suit
            'singular_name' => __('HTML5 Blank Custom Post', 'html5blank'),
            'add_new' => __('Add New', 'html5blank'),
            'add_new_item' => __('Add New HTML5 Blank Custom Post', 'html5blank'),
            'edit' => __('Edit', 'html5blank'),
            'edit_item' => __('Edit HTML5 Blank Custom Post', 'html5blank'),
            'new_item' => __('New HTML5 Blank Custom Post', 'html5blank'),
            'view' => __('View HTML5 Blank Custom Post', 'html5blank'),
            'view_item' => __('View HTML5 Blank Custom Post', 'html5blank'),
            'search_items' => __('Search HTML5 Blank Custom Post', 'html5blank'),
            'not_found' => __('No HTML5 Blank Custom Posts found', 'html5blank'),
            'not_found_in_trash' => __('No HTML5 Blank Custom Posts found in Trash', 'html5blank')
        ),
        'public' => true,
        'hierarchical' => true, // Allows your posts to behave like Hierarchy Pages
        'has_archive' => true,
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'thumbnail'
        ), // Go to Dashboard Custom HTML5 Blank post for supports
        'can_export' => true, // Allows export in Tools > Export
        'taxonomies' => array(
            'post_tag',
            'category'
        ) // Add Category and Post Tags support
    ));
}

/*------------------------------------*\
	ShortCode Functions
\*------------------------------------*/

// Shortcode Demo with Nested Capability
function html5_shortcode_demo($atts, $content = null)
{
    return '<div class="shortcode-demo">' . do_shortcode($content) . '</div>'; // do_shortcode allows for nested Shortcodes
}

// Shortcode Demo with simple <h2> tag
function html5_shortcode_demo_2($atts, $content = null) // Demo Heading H2 shortcode, allows for nesting within above element. Fully expandable.
{
    return '<h2>' . $content . '</h2>';
}





/* CUSTOM FUNCTIONS */


function getSkillData($skill){
   
/*
   var_dump($skill);
   return;
*/
   /* get the skill permalink */
   $skill->term_link        = get_term_link($skill->name,'post_tag');
              
   /*
   Get all the posts that have the current tag.
   inspired from: http://www.wprecipes.com/how-to-show-related-posts-without-a-plugin  
   */
   $postsInTag = new WP_Query(
      array(
         'tag__in'            => $skill->term_id   
        //,'caller_get_posts'   => 1 //not sure what this is      
      )
   );  
   
   /* store all the post_date in this $postDates array, to be parsed later in order to find the oldest date */
   $postsDates = array_map( function($item){ //this is really cool. I didn't know you can have anonymous functions like in JS
      return $item->post_date;                                             
   },$postsInTag->posts);
   
   /* get the oldest post which actually represents the skill experience */ 
   $skill->projectOldestDate = min($postsDates);
   $skill->experience        = _ago(strtotime($skill->projectOldestDate),0,false); 
   
   /* I can also get the lines of code, but it's fine for now */
   //$skill->linesOfCode      = 3400;
   
   /* get the score number */            
   $skill->score       = calculateScore($skill->tag_name, $skill->projectOldestDate,$skill->count);     
   
   /* get the score string based on the score number */
   $skill->scoreString = sprintf(theScoreString($skill->score),'<span class="skill-name">' . $skill->name . "</span>");
   
   /* get the rotational degree based on the score number */
   $skill->rotationDeg = $skill->score * 3.6;
   
   /* get the formula of the score math */
   $skill->formula     = calculateScore($skill->tag_name, $skill->projectOldestDate,$skill->count,null,true);
      
   return $skill;
}





/**
 * info  :  
 * input : @args - array of argments
 * output: array of the posts within the given tags   
 */
function getCategoryTags($args) {
	global $wpdb;

  //THIS SQL IS FUCKING AWESOME - found here: http://wordpress.org/support/topic/get-tags-specific-to-category	                
	        
  $sql = "
    SELECT DISTINCT terms2.term_id as term_id, terms2.name as name, t2.count
		FROM
			wp_posts as p1
			LEFT JOIN wp_term_relationships as r1 ON p1.ID = r1.object_ID
			LEFT JOIN wp_term_taxonomy as t1 ON r1.term_taxonomy_id = t1.term_taxonomy_id
			LEFT JOIN wp_terms as terms1 ON t1.term_id = terms1.term_id,

			wp_posts as p2
			LEFT JOIN wp_term_relationships as r2 ON p2.ID = r2.object_ID
			LEFT JOIN wp_term_taxonomy as t2 ON r2.term_taxonomy_id = t2.term_taxonomy_id
			LEFT JOIN wp_terms as terms2 ON t2.term_id = terms2.term_id
		WHERE
			t1.taxonomy = 'category' AND p1.post_status = 'publish' AND terms1.slug IN ('" . strtolower($args['categories']) . "') AND
      t2.taxonomy = 'post_tag' AND p2.post_status = 'publish'
			AND p1.ID = p2.ID			
		ORDER by t2.count DESC";
    
  return $wpdb->get_results($sql);
}

/**
 * Returns the difference between the given time and the current time.
 *
 * input : @t as time - given time
 * output: string
 */
function ago($time)
{
   $periods = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
   $lengths = array("60","60","24","7","4.35","12","10");

   $now = time();

       $difference     = $now - $time;
       $tense         = "ago";

   for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
       $difference /= $lengths[$j];
   }

   $difference = round($difference);

   if($difference != 1) {
       $periods[$j].= "s";
   }

   return "$difference $periods[$j] ago ";
}

function _ago($tm,$rcs = 0,$suffix=true) {
   $cur_tm = time(); $dif = $cur_tm-$tm;
   /* $pds = array('s','m','h','d','w','M','Y','D'); */
   $pds = array('seconf','minute','hour','day','week','month','year','decade');
   $lngh = array(1,60,3600,86400,604800,2630880,31570560,315705600);
   for($v = sizeof($lngh)-1; ($v >= 0)&&(($no = $dif/$lngh[$v])<=1); $v--); if($v < 0) $v = 0; $_tm = $cur_tm-($dif%$lngh[$v]);

   $no = floor($no); 
   if($no <> 1) 
      $pds[$v] .='s'; 

   $x = sprintf("%d %s ",$no,$pds[$v]);

   if(($rcs == 1)&&($v >= 1)&&(($cur_tm-$_tm) > 0)) 
      $x .= time_ago($_tm);
      
      
   if($suffix)
      return $x .'ago';
   else 
      return $x;
}






/**
 * Calculates the score using a set algorithm.
 * 
 * input: @skillName (String)       - the skill name
 *        @projectsCount(Int)       - the number of the projects I've been working on  
 *        @$skillDate (Date)        - the date of the 1st encountered project with the sill
 *        @linesOfCode (Int)        - the number of code lines
 *
 * output: int between 0 and 100 represnting the level            
 */
function calculateScore($skillName, $skillDate = null, $projectsCount = null, $linesOfCode = null, $spitFormula = false){
    
    $skill = new StdClass();
   
       $skill->difficulty = 0;
       $skill->importance = 0;
        
    $projectsGrade         = 0;
    $experienceGrade       = 0;
    
    /* convert the $skillDate to days since I know the skill */          
    $experienceInDays = floor((time() - strtotime($skillDate)) / 86400);
    
    
    //return ( time() - $skillDate ) / 86400;
    /* another aproach of dealing with dates - found here http://stackoverflow.com/questions/8063057/convert-this-string-to-datetime */
      //$date = date_create_from_format('Y-m-d H:i:s', '2013-07-12 16:19:50');
      //return ($now - $date->getTimestamp()) /86400;
    
    /* The grades are given from 1 to 10 */
    
    /* give the skills their own grade, depending on the difficulty level (this is totally subjective) */
    switch(strtolower($skillName)){
       
       case 'php' : 
         $skill->difficulty = 8;
         $skill->importance = 9;                         
         break;
         
       case 'javascript' : 
         $skill->difficulty = 7.5;
         $skill->importance = 8.5;
         break;
         
       case 'css' : 
         $skill->difficulty = 6;
         $skill->importance = 8.3;
         break;
         
       case 'html' : 
         $skill->difficulty = 4;
         $skill->importance = 10;
         break;         
         
       case 'wordpress' : 
         $skill->difficulty = 4.2;
         $skill->importance = 4.5;
         break;
         
       case 'joomla' : 
         $skill->difficulty = 5;
         $skill->importance = 4.5;
         break;
         
       case 'drupal' : 
         $skill->difficulty = 5.4;
         $skill->importance = 4.5;
         break;
         
       default : 
         $skill->difficulty = 1.5;
         $skill->importance = 1.5;
         break; 
       
    }


    
    /* give the grade according to the Projects Count */
    if($projectsCount)          
      switch($c = $projectsCount){
         
         case ($c > 18)  : $projectsGrade = 10;
            break;
         
         case ($c > 15)  : $projectsGrade = 9;
            break;
         
         case ($c > 12)  : $projectsGrade = 8;
            break;
            
         case ($c > 9)   : $projectsGrade = 7;
            break;
            
         case ($c > 7)   : $projectsGrade = 6;
            break;            
            
         case ($c > 5)   : $projectsGrade = 5;
            break;            
            
         case ($c > 3)   : $projectsGrade = 4;
            break;                        
            
         case ($c > 2)   : $projectsGrade = 3;
            break;                           
            
         case ($c > 1)   : $projectsGrade = 2;
            break;                                             
            
         default         : $projectsGrade = 1;
            break;
      }
    
    /* give the grade according to the Experience Count */
    if($experienceInDays) 
      switch($e = $experienceInDays){
         
         case ($e > 1200)  : $experienceGrade = 10;
            break;    
            
         case ($e > 900)   : $experienceGrade = 9;
            break;    
    
         case ($e > 600)   : $experienceGrade = 8;
            break;        
            
         case ($e > 360)   : $experienceGrade = 7;
            break;                

         case ($e > 180)   : $experienceGrade = 6;
            break;    
    
         case ($e > 90)    : $experienceGrade = 5;
            break;        
            
         case ($e > 60)    : $experienceGrade = 4;
            break;
            
         case ($e > 30)    : $experienceGrade = 3.5;
            break;                            
            
         case ($e > 20)    : $experienceGrade = 2.5;
            break;            
            
         default           : $experienceGrade = 1;
            break;            
    
      }

    $result = ($experienceGrade * 2) + ($projectsGrade * 4) + ($skill->difficulty * 2) + ($skill->importance * 2);

    if($spitFormula)
      return '(' . $experienceGrade . ' * 2) + (' . $projectsGrade . ' * 4) + (' . $skill->difficulty . ' * 2) + (' . $skill->importance . ' * 2) = ' . $result;

    return $result;
}


/**
 * input: @score as int
 * output: str_format ready for printf
 */
function theScoreString($score){

  $scoreArray = array(
                'Just Started playing with %s'
               ,'Still learning %s'
               ,'I know the Basics of %s'
               ,'I can find my way with %s'
               ,'I enjoy %s already'
               ,'%s is one of my favorites'
               ,'I can do cool stuff in %s'
               ,'Can ride %s with no handlebars'
               ,'I don\'t even need to look when coding in %s'
               ,'I\'m the sh*t at %s');
  
  return $scoreArray[floor($score/10)];
}


/**
 * Returns the slug of the current post. Used in the loop
 */
function the_slug($echo=true){
  $slug = basename(get_permalink());
  do_action('before_slug', $slug);
  $slug = apply_filters('slug_filter', $slug);
  if( $echo ) echo $slug;
  do_action('after_slug', $slug);
  return $slug;
}

/** 
 * Returns the slug of the given post id. 
 */
function get_the_slug($id){
  $slug = basename(get_permalink($id));
  do_action('before_slug', $slug);
  $slug = apply_filters('slug_filter', $slug);
  do_action('after_slug', $slug);
  return $slug;
}

/** 
 * Returns the id by slug 
 */
function get_post_id_by_slug( $slug) {
    $query = new WP_Query(
        array(
            'name' => $slug
        )
    );
    $query->the_post();
    return get_the_ID();
}



function my_conversion(){
   
   echo "uisuadiaudioa";
   exit; 
   
}

add_action( ‘wpcf7_before_send_mail’, ‘my_conversion’ );

?>