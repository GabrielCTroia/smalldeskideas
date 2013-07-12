<?php /* Template Name: Loader */ //get_header(); 
   
   //load the section templates
   
   $_GET['getTemplate'] = true; 
      
      //these should be loaded somehow dynamically - need to get them from wp
      include( __DIR__ . '/home.php'); 

      include( __DIR__ . '/works.php');
      
      include( __DIR__ . '/skills.php'); 
      
      include( __DIR__ . '/../single.php'); 
      
   $_GET['getTemplate'] = false; //reset it to false to be able to load the JSON

?>   
      	   	
   <!-- main -->		
	<div class="main ifJsHide" data-bind="afterAllLoaded: true">
   
   <!-- ko template: {  name: getSectionTemplate
                       ,foreach: sections } -->   
   <!-- /ko -->
   
	</div> <!-- /main -->
   
   <!-- ko template: 'single-work' -->
   <!-- /ko -->
  

<?php //get_footer(); ?>