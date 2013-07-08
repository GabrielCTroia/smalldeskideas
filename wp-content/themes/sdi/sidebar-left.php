<?php if($_GET['getJSON']) { //spit the JSON if that's what the controller is looking for. AJAX enabled
  
  //the JSON for this should already by part of the Works Object
   
} else if($_GET['getTemplate']) { //spit the template if that's what is loooking for. AJAX enabled ?>

  <aside class="span4">
  
    <div class="span-wrapper">
      
      <div class="skills-used grid clearfix">
      
        <h3>Skills Used:</h3>
        
        <div class="row">
          
          <!-- ko foreach: usedSkills-->
            
            <div class="skill span3 box" >
              
              <div class="box-wrapper">
                
                <a href="#" data-bind="">
                  
                  <div class="table">
                    
                    <div class="table-cell">
                      
                      <h5 data-bind="text: name"></h5>
                      
                    </div> <!-- /table-cell -->
                    
                  </div> <!-- /table -->
                  
                </a>
                
                <div class="ring" data-bind="renderSkill: $data">
                  
                   <div class="ring-wrapper">
                      <div class="pie rotated" style=""></div>
                      <div class="pie fill" style=""></div>               
                   </div>               
                   
                   <div class="pie trace"></div>                                 
                   <div class="pie background"></div>
                  
                </div> <!-- /ring -->
                
              </div> <!-- /box-wrapper -->
              
            </div> <!-- /skill -->
            
          <!-- /ko -->
          
        </div>
      
      </div> <!-- /skills-used -->
      
      <div class="project-details">
         
         <h3>Project Details</h3>
         
         <span>Project Duration ~ 3month</span><br>
         <span>Total lines of code ~ 23000</span><br>
         <span>Project Duration ~ 3month</span><br>
         
      </div>   
      
    </div> <!-- /span-wrapper -->
    
  </aside>

<?php } else { ?>

 <aside class="span4">
   
   <div class="span-wrapper">
      
      <div class="skills-used grid clearfix">
         
        <h3>Skills Used:</h3>
        
        <div class="row">
        <?php 
        
          //the_tags( __( 'Skills Used: ', 'html5blank' ), ', ', ''); // Separated by commas with a line break at the end 
          $tags = wp_get_post_tags(get_the_ID());
          
          //var_dump($tags);
          
          foreach( $tags as $tag ) : 
          
            $skillScore = calculateScore(2,2,2);     
            $rotationDegree = $skillScore * 3.6;

          ?>               
              <div class="skill span3 box" data-code="" data-experience="" data-projects="<?php echo $tag->count;?>">       
                
                  <div class="box-wrapper">
    
                     <a href="<?php echo get_term_link($tag->name,'post_tag'); ?>" class="">                   
                       <div class="table">
                          <div class="table-cell">                                 
                            <h5><?php echo $tag->name; ?></h5>                                                            
                          </div><!-- /table-cell -->
                       </div><!-- /table -->                     
                     </a>
                  
                     <div class="ring experience"> 
                       <div class="ring-wrapper <?php echo($rotationDegree>180) ? 'gt50' : ''; ?>">
                          <div class="pie" style="-webkit-transform: rotate(<?php echo $rotationDegree;?>deg);"></div>
                          <div class="pie fill" style=""></div>               
                       </div>               
                       <div class="pie trace"></div>                                 
                       <div class="pie background"></div>
                     </div> <!-- /ring -->
                       
                  </div><!-- /box-wrapper -->
               
           </div><!-- /skill -->

           <?php endforeach; ?>
         
        </div><!-- /grid-row -->
        
      </div><!-- /skills-used -->
      
      <div class="project-details">
         
         <h3>Project Details</h3>
         
         <span>Project Duration ~ 3month</span><br>
         <span>Total lines of code ~ 23000</span><br>
         <span>Project Duration ~ 3month</span><br>
         
      </div>   
   
      <div class="sidebar-widget">
   		<?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('widget-area-1')) ?>
   	</div>
   	
   	<div class="sidebar-widget">
   		<?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('widget-area-2')) ?>
   	</div>   
      
   </div><!-- span-wrapper -->
      
 </aside>
 
 <?php } /* endif */ //AJAX==true ?>