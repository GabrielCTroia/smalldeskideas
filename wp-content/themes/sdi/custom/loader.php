<?php /* Template Name: Loader */ get_header(); 
   
   //load the section templates
   
   $_GET['getTemplate'] = true; 
      
      //these should be loaded somehow dynamically - need to get them from wp
      include( __DIR__ . '/home.php'); 

      include( __DIR__ . '/works.php');
      
      include( __DIR__ . '/skills.php'); 
      
      include( __DIR__ . '/../single.php'); 
      
   $_GET['getTemplate'] = false; //reset it to false to be able to load the JSON

?>   
<!--

  <script type="text/html" id="template-panel">
    
    <div class="panel" data-bind="with: currentPanel">
      
      <a href="#" data-bind="attr: {href: $root.closePanel}"></a>
      
      <a href="#" data-bind="attr: {href: $root.prevPanelChild}"></a>
      
      <a href="#" data-bind="attr: {href: $root.nextPanelChild}"></a>
      
    </div>
  
  </script>
-->

   <!-- ko template: {  name: getSectionTemplate
                       ,foreach: sections } -->   
   <!-- /ko -->
   
   <!-- ko template: 'single-work' -->
   <!-- /ko -->
  

<?php get_footer(); ?>