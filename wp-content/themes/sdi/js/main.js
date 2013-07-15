var _debug = true;

var _log = function(input, isArray){
  
  if(!_debug) return;
  
  //console.log(typeof input);
  
  if( typeof input == Array && !isArray ){
    console.log('---------------------------');
    console.log('This is the log for ' + input[0]);
    for( i in input)
      _log(i)      
    console.log('End of log for ' + input[0]);
    console.log('---------------------------');
  
  } else //if not array must be string, number or object     
    console.log(input);
  
}





/******************************************************************* 
 *********************** PUBLIC METHODS ****************************
 ******************************************************************/






/**
  * make the elements slideDown and Up or (Right and Left - not yet)
  *
  * input: elm        = jquery wrapped element
  *        options    = object with a set of options like: 
  *                           speed - millisenconds
  *                           axe   - horizontal,vertical
  *                           dir   - right,left,down,up
  *
  *
  * output: void, has sideEffects 
  */
var curtainize = function(elm, options, callback){
  
  var self = this;
  
  self.elm = elm;
  self.callback = (callback != undefined) ? callback : function(){};
  
  
  self.elm.initOffset   = self.elm.offset(); //get the first positions(top,left)
  self.elm.initSize     = {'width' : self.elm.width(), 'height' : self.elm.height()}; //get the original sizes
    
  //check if options are given and if not create an empty object to be populated with defaults
  var options           = (options != undefined) ? options : {};
  
    //set the defaul options
    options.speed       = (options.speed != undefined) ? option.speed : 800;
    options.easing      = (options.easing != undefined) ? options.easing : 'swing';
    options.handlerArea = (options.handlerArea != undefined) ? options.handlerArea : 100;
  
  //apend the options to self 
  self.options        = options;
  
  _log(self);

}
  
  curtainize.prototype.curtainDown = function(callback){
    
    var self = this;
    
    _log('Curtain is moving down');
    
    self.elm.animate({
      top       : self.elm.initOffset.top
    },{
      duration  : self.options.speed
     ,easing    : self.options.easing
     ,done      : function(){      
        //call the callbacks 
        self.callback();
        (callback != undefined) ? callback() : '';
      }      
    });
    
  }
  
  
  curtainize.prototype.curtainUp = function(callback){
    
    var self = this;
    
    _log('The curtain is moving up.');
    
    self.elm.animate({
      top        : - self.elm.height() + self.elm.initOffset.top + self.options.handlerArea
    },{
      duration   : self.options.speed
     ,easing     : self.options.easing
     ,done : function(){
        //call the callbacks 
        self.callback();
        (callback != undefined) ? callback() : '';
      }      
    });
    
  }
  
  
  
  
  
  
  



function getHtmlContent(urlData,callback){
   
}





/** 
 * returns the object from an array of objects that matched the criteria 
 *
 * input: @array (Array)            - the Array in which the matching is done
 *        @property (String)        - the Object propery 
 *        @value (Number,String)    - the given value which needs to match
 *
 * output: the matched Object
 */ 
function matchObjectByItem(array,property,value){
  return $.grep(array,function(e){
    return e[property] == value;
  });
}







/**
 * returns the index of an object in an array 
 *
 * input: @array           - the Array in which the matching is done
 *        @property        - the Object property
 *        @value           - the given value which needs to match
 *
 * output: Number - the Index in the Array of the matched Item 
 */
function getIndexByItem(array,property,value){
  var index = false;
  
  $.grep(array,function(e,i){
    if(e[property] == value){
      index = i;
      return;
    }
  });
  
  return index;
}


function disableScroll(){     
 $('body').addClass('fixed');
 _log('scroll is disabled');
}


function enableScroll(){     
 $('body').removeClass('fixed');
 _log('scroll is enabled');
}







/******************************************************************* 
 *********************** CUSTOM BINDINGS ***************************
 ******************************************************************/









ko.bindingHandlers.curtainize = {
  
  init: function(element, valueAccessor, allBindingsAccessor, viewModel,bindingContext){
    
    //get the real given value       
    var value = ko.utils.unwrapObservable(valueAccessor());
    
    viewModel.isCurtainDown = ko.observable(value);
    
    viewModel.curtain = new curtainize($(element));
    
    //set a callback for the curtainUp
    viewModel.callbackCurtainUp = function(){
      enableScroll();
    }
    
    //on scroll set the slide the curtain up
/*
    $(window).scroll(function(event){ //this doesn't work with a regular mouse wheel - 
      
      viewModel.isCurtainDown(false);
    });
*/
    
  },
  
  update: function(element, valueAccessor, allBindingsAccessor, viewModel) {
    var isCurtainDown = ko.utils.unwrapObservable(viewModel.isCurtainDown()); 
    
    if(isCurtainDown == true)
      viewModel.curtain.curtainDown()
    else
      viewModel.curtain.curtainUp(viewModel.callbackCurtainUp)
  }

}








ko.bindingHandlers.renderPanel = {

  init: function(element, valueAccessor, allBindingsAccessor, viewModel,bindingContext){
    
    var value      = ko.utils.unwrapObservable(valueAccessor());
    
    //declare some needed observables on the $root level
    bindingContext.$root.prevPanelData = ko.observable();
    bindingContext.$root.nextPanelData = ko.observable();
    
    
    bindingContext.$root.nextPanelURL = ko.observable();
    bindingContext.$root.prevPanelURL = ko.observable(); 
    
    
    bindingContext.$root.subPanels = ko.observableArray();
    /* set a HTML object */
    var HTML = {};
        
    HTML.panelElm     = '<div class="panel">';
    HTML.closeButton  = '<a href="#" class="panel-close" data-bind="attr: {href: $root.getCurrentSectionURL()}">';
    HTML.nextButton   = 
    '<!-- ko if: $root.prevPanelURL --><a href="#" class="panel-arrow-prev" data-bind="attr: {href: $root.prevPanelURL}"></a><!-- /ko -->';
    HTML.prevButton   = 
    '<!-- ko if: $root.nextPanelURL --><a href="#" class="panel-arrow-next" data-bind="attr: {href: $root.nextPanelURL}"></a><!-- /ko -->';
    
    HTML.loader       = '<div class="loader">';
    HTML.bkg          = '<div class="panel-background">';
    
    /* wrap the element in the panel div */
    $(element).wrap(HTML.panelElm);   
    /* element becomes subpanel */
    $(element).addClass('subpanel');
    
    /* this is our panel Elm from now on */
    var panelElm = $(element).parents('.panel');
        
    //prepend the close button to the subpanel 
    $(element).prepend(HTML.closeButton);
    //prepend the next button to the subpanel
    $(element).prepend(HTML.nextButton);
    //prepend the prev button to the subpanel
    $(element).prepend(HTML.prevButton);
    
    
    panelElm.prepend(HTML.loader);
    panelElm.prepend(HTML.bkg);
    
    element.HTML = HTML;
    
    
    /* Event Listeners */
    
       /* Keys Press           
        * one() is very important - it unbounds the event after the 1st invocation           
        */
      
       /* Close the panel when pressing escape.*/
       $(document).keyup(function(e) {
         if (e.keyCode == 27) { // esc
            /* close the panel by changing the url */
            window.location.href = bindingContext.$root.getCurrentSectionURL();
            _log('The panel was closed!');
         }   
       });
       
       /* Go to the Next Panel when pressing Right Arrow */
       $(document).keyup(function(e) {
         if (e.keyCode == 39) { // right arrow
            /* go to the next one by changing the url */
            if(bindingContext.$root.nextPanelURL()){
              window.location.href = bindingContext.$root.nextPanelURL();
              _log('Just went to the Next Subpanel!');
            }
         }   
       });
       
       /* Go to the Prev Panel when pressing Left Arrow */
       $(document).keyup(function(e) {
         if (e.keyCode == 37) { // left arrow
            if(bindingContext.$root.prevPanelURL()){
               /* go to the prev one by changing the url */               
               window.location.href = bindingContext.$root.prevPanelURL();
               _log('Just went to the Prev Subpanel!');
            }
         }   
      });       

    
    _log('The panel for ' + value + ' was initiated');
    
    
  },
  
  update: function(element, valueAccessor, allBindingsAccessor, viewModel,bindingContext){
    
    var value      = ko.utils.unwrapObservable(valueAccessor()),
        panelElm   = $(element).parents('.panel'); //defined in the init    
    
    if(value){

      $(element).hide().fadeIn(500);
      console.log("Panel for " + value.title + " is in.");
    
    } else {      


      //make the page scrollable again
      enableScroll();
      
      console.log("Panel is out.");
    }
    
    _log('The panel was updated succesfully!');

  }
  
}






ko.bindingHandlers.renderSkill = {

  init: function(element, valueAccessor, allBindingsAccessor, viewModel,bindingContext){
    
    var value = ko.utils.unwrapObservable(valueAccessor());
    
    // the rotation degree is the score times 3.6
    var rotateDegree = 3.6 * value.score;

    if(rotateDegree > 180)
      $(element).addClass('gt50');
    
    $(element).find('.pie-wrapper.spinner').css({'-webkit-transform' : 'rotate(' + rotateDegree + 'deg)'});      

    return; //this in not working yet - to be fixed in the next iteration
    
    
    /* Show the other half of the pie if the score is higher than half and it's not shown already*/
    //need to do this animation only when the elements are visible  
    var timer = setTimeout(function(){
       
       //make sure the calculated degree is bigger than half
       if(rotateDegree > 180){
           
           
         /* Animate the rotattion - not working yet. The clipper is fading than it's coming back */
         
         //the ratio between the rotateDegree and 180 
         var percentageRatio     = rotateDegree/180
            
         //create a unique css animation for each element
         var cssAnimation        = document.createElement('style');
             cssAnimation.type   = 'text/css'
            
         //get the name from the element's id
         var animationName       = 'hide-' + $(element).parents('.skill').attr('id');         
            
         //create the animation rules
         var rules               = document.createTextNode('@-webkit-keyframes ' + animationName + ' {' +
                                    '0% { opacity:1; }' + ' ' +
                                    100/percentageRatio + '% { opacity:0; }' +
                                 '}');
         
         /* append it to the dom */
         cssAnimation.appendChild(rules);
         document.getElementsByTagName("head")[0].appendChild(cssAnimation);

         //add the animation-name to the clipper.out
         $(element).find('.clipper.out').css({'-webkit-animation-name' : animationName});
         
         //add the animation-name to the pie-wrapper.fill
         //$(element).find('.pie-wrapper.fill').css({'-webkit-animation-name' : 'showMe'});
       }
       
       //tried to see if a a delay could solve the issue - nope
       setTimeout(function(){
           //apply the new rotation degree to the .pie that is rotated s
          $(element).find('.pie-wrapper.spinner').css({'-webkit-transform' : 'rotate(' + rotateDegree + 'deg)'});      
       }, 2)
       
       
    }, 2000);

  }

}








ko.bindingHandlers.fadeVisible = {

  update: function(element, valueAccessor, allBindingsAccessor, viewModel,bindingContext){
     
     var value = ko.utils.unwrapObservable(valueAccessor());
        
     if(value)
      $(element).fadeIn(800);
     else
      $(element).fadeOut();  
  }

}






ko.bindingHandlers.renderNav = {

  init: function(element, valueAccessor, allBindingsAccessor, viewModel,bindingContext){
      
      var value = ko.utils.unwrapObservable(valueAccessor());
      
      //don't to anything if the value is not true
      if (value!=true)
         return;
         
      $(element).find('a').each(function(){
         
         var oldHref    = $(this).attr('href'); //get the old href         
         var splitHref  = oldHref.split('/'); //split it
         
         //if it's an external link don't touch it. If internal format it. 
         if(window.location.hostname == splitHref[2]){
            var newHref = oldHref.substr(oldHref.indexOf('//')+2); //take the protocol out (https,http)         
                newHref = newHref.replace(window.location.hostname, ''); //take the hostname out
                newHref = newHref.substr(1); //take the leading slash out
                newHref = newHref.substr(0,newHref.length-1); //take the ending slash out         
            $(this).attr('href', '/#' + newHref);
         }
      });
           
  }

}





/* Render the element only after everything AJAX loaded completely */
ko.bindingHandlers.afterAllLoaded = {

  update: function(element, valueAccessor, allBindingsAccessor, viewModel,bindingContext){
     
     //don't need this
     var value = ko.utils.unwrapObservable(valueAccessor());
     
     $(element).show();
     
  }

}



/******************************************************************* 
 *************************** KO APP ********************************
 ******************************************************************/







function AppViewModel() {
   
   var self = this;
         
   /* Object - holding the information of everything that was loaded via AJAX */
   self.AJAXLoaded = {
      'count'       : ko.observable()  
     ,'index'       : ko.observable()
     ,'loadedItems' : ko.observableArray()
   }      
   
   /* B/C I need to work with AJAXLoaded object I need to take this method out of the above definition */
   // true if count == index, false otherwise
   self.AJAXLoaded.checkSum = ko.computed(function(){
                        //interesting enough: in this case undefined is not equal to undefined :)
                        return self.AJAXLoaded.count() == self.AJAXLoaded.index();
                     })
         
         
         
         
   /* Define the sections. - these should probably be loaded dynamically */
   self.sections = ko.observableArray([
         {
            'name'      : 'skills'
           ,'realURL'   : '/skills'        
         },{
            'name'      : 'work'
           ,'realURL'   : '/work'        
         }
      ]);
   
   
   /* These takes the self.sections Array and makes it an associative array, 
      so I can refer to section.section_name from now on */
   self.sectionsAssoc = ko.computed(function(){
     var result = {};
     ko.utils.arrayForEach(self.sections(),function(item){        
        result[item.name] = item;
     }); 
     return result;
   });
    
    
   self.modules = ko.observableArray([
         {
            'name'      : 'header'
           ,'realURL'   : '/'
         },{
            'name'      : 'work'
           ,'realURL'   : '/'        
         }
      ]);
   
   self.currentSection        = ko.observable();       
   
   /* Object with the data of the that shows up on the current panel */
   self.currentPanelData      = ko.observable();

   
   self.works                 = ko.observable();
   self.allSkills             = ko.observable();
   
   
   /*
    I chose this to be computed instead of doing it the other way - having the currentPanel computed with this observable
       because, this way I feel is more dynamic. I can have other computed observables listening to the currentPanel, since
       currentPanel is changed one time in self.renderPanel();
    */
   self.currentWorkData       = ko.computed(function(){
     return self.currentPanelData();
   });   
      
   
  /********************** PRIVATE METHODS ********************/
  
  /**
   * input: @url (String)          - the url
   *              (Object)         - the url and the QueryString
   *        @callback (String)     - the callback function name
   *        @progressData (Object) - currentIndex,limit. Calculates the progress status.
   *
   * output: Void 
   * 
   * side effects: populates a given element in the callback with the returned data
   */ 
   self.getJSON = function(urlData,callback,progressData){   
      var url           = null
         ,queryString   = null;
      
      
      if (typeof urlData == Object){ //if Object than populate the vars with the objects' data. Usually there is a Query String involved
         url           = urlData.url;
         queryString   = (urlData.queryString != undefined) ? '&' + urlData.queryString : null;
      } else { // if not Object, than is be String
         url = urlData; 
      }
      
      //update the self.AJAXLoaded() with the datas from here
      if(typeof progressData != undefined) {
         //I should also have a session/checked by time or smtg ....
         
         /* check if the count is already set */
         if(self.AJAXLoaded.count() == undefined)         
            //set the count now to be able to do a checksum()  
            self.AJAXLoaded.count(progressData.count);
      }
      
      
      $.getJSON(url + '?getJSON=true' + queryString).success(function(data){      
         
         if(callback != undefined)        
           callback(data);
                  
         if(progressData != undefined) {   
            //update the current index in the AJAXLoaded var
            self.AJAXLoaded.index(progressData.currentIndex);
            
            /* I don't need this right now */
            //self.AJAXLoaded.loadedItems().push(data);
         }
         
         console.log(self.AJAXLoaded.loadedItems());
            
         console.log("JSON succeded for ", data);
         
      }).error(function(error){
         _log("Error! The JSON for " + url + " didn't load. Here's why: ",error);
      });
   }
  
  
  
  
  
                
  /** 
   * Void(): set the content for the sections 
   * 
   */          
   self.setSectionsContent = function(){
      for(var i = 0; i < self.sections().length; i++){         
         var currSect             = self.sections()[i];
             currSect.data        = ko.observable();  //stores the section' datas
             currSect.template    = 'section-' + currSect.name ; //stores the section' template
             currSect.loaded      = ko.observable(false);
         
         /* populate the data object with the section' data */
         self.getJSON(currSect.realURL, currSect.data, {'currentIndex' : i+1 , 'count': self.sections().length});        
      }
   }
   
   
   self.getCurrentSectionURL = function(){
     return '/#' + self.currentSection().name; 
   }
      
   /**
    * Returns the given section' template
    *
    * input: @section (string) - section name
    * output:  string - sections' template name 
    */
   self.getSectionTemplate = function(section){
      return section.template;
   }
   
   
   /** 
   * Void(): set the content for the modules
   * 
   */          
   self.setModulesContent = function(){
      for(var i = 0; i < self.modules().length; i++){         
         var currModule             = self.modules()[i];
             currModule.data        = ko.observable();  //stores the module' datas
             currModule.template    = 'module-' + currModule.name ; //stores the module' template
         
         /* populate the data object with the section' data */
         getHtmlContent( { 'url' : currModule.realURL, 'queryString' : 'getModule=' + currModule.name}, currModule.data);        
      }
   }
   
   

   /** 
    * Returns the formated permalink of each work 
    *
    * input: @data - string containing the work data object
    */
   self.getWorkPermalink = function(data){
     return '#work/' + data.post_name;
   }

   /** 
    * Matches & returns a section in the self.sections array by its name 
    *
    * input: @name (string) - name of the section
    * output: the section object
    */
   self.matchSectionByName = function(name){
     return matchObjectByItem(self.sections(),'name',name)[0];
   }
   

   /** 
    * Renders the Current Panel and Creates the Environment for the next,prev and everything the panel needs.
    *
    * input: @currentPanelData (Object)   - containing the AJAXed JSON of the current Panel.
    *        @allPanelsArray (Array)      - the Array of all the possible panels (next,prev).       
    *        @currentPanelIndex (Number)  - the index of the current panel in the allPanelsArray array.
    *
    * output:  Void.
    */
   self.renderPanel = function(currentPanelData,allPanelsArray,currentPanelIndex){

     /* populate the currentPanelData */
     self.currentPanelData(currentPanelData);
     
     /* make sure there is a prev panel */
     if(allPanelsArray[currentPanelIndex-1] != undefined)
        self.prevPanelURL(self.getCurrentSectionURL() + '/' + allPanelsArray[currentPanelIndex-1].post_name);     
     else 
        self.prevPanelURL(null);     
     
     /* make sure there is a next panel */
     if(allPanelsArray[currentPanelIndex+1] != undefined)
        self.nextPanelURL(self.getCurrentSectionURL() + '/' + allPanelsArray[currentPanelIndex+1].post_name);
     else 
        self.nextPanelURL(null);
     
     //console.log('prev',self.prevPanelURL());
     //console.log('next',self.nextPanelURL());
     
   }





   self.showSingleWork = function(data){
    
    //set the data to the currentWorkData 
    //self.currentWorkData(data); 
    
    var workSection = self.matchSectionByName('work');
    
    
    //need to call the init functions in each sammy controller and have this called only after everything else loaded
    //the timer works for now
    var timer = setTimeout(function(){
      self.works(workSection.data().works); //this can be laoded much earlier - when the template is loade with a custom fucntion when the element is ready or smtg alike
      
      //get the index of the current work and pass it in the self.renderPanel as an argument
      var index = getIndexByItem(self.works(),'ID',data.ID);
      self.renderPanel(data,self.works(),index);
    }, 500);
     
   }

   /** 
     * Animates a scroll to the section's position on the same page.
     *
     * input: @sectionAnchor (string) - with the section object
     */     
   self.jumpToSection = function(sectionAnchor){      
      $(window).scrollTo($('#'+sectionAnchor), {duration: 500});        
      //console.log(sectionAnchor);      
   }

    
    
   /** 
    * Sets/Gets/Renders/Initiates/Calls all the methods needed to happen before the DOM is ready. 
    *
    * Void()
    */        
   self.initDOM = function(){
     //disableScroll();
     
     
     /* get the Sections Content before everything else */ 
     //self.setModulesContent();           
     
     /* get the Sections Content before everything else */ 
     self.setSectionsContent();           
     
     /* This is a special var.      
      * It's used more for the callback function that provides. 
      * Once everything is loaded via AJAX other stuff needs to be done. This is the place to do that.
      * Is True if everything is loaded, and False otherwise. */     
     self.afterAllLoaded = ko.computed(function(){ //disambiguation: this is not the same as ko.customBinding.afterAllLoaded - it probably will replace it
        
        //lazy load those images
        if( self.AJAXLoaded.checkSum() == true ){ //if AJAX has Loaded to stuff           
           $('.lazy').lazyload({
              effect : 'fadeIn'
           });           
        }
        
     })
     
   }      
   
   
   
/*
   var timer = window.setInterval(function(){
      console.log(self.AJAXLoaded.checkSum());
   }, 200)
*/
   
   
   
   
   
  /********************** INITIALIZERS ***********************/
  
  
     
   /* prepare the DOM */
   self.initDOM(); 
   
   
  
  
  

  
  
  
  
  
  

  /*************************** ROUTER *****************************/
  
  
  
  
  
  
   
  //return;
  Sammy(function() {


    // define a 'get' route that will be triggered at '#work/{sub}'
    this.get('#work/:article', function() {
      /* set the current section */
      self.currentSection(self.matchSectionByName('work')); 

      /* get the JSON data and set the current article( currentWorkData ) */
      self.getJSON('/work/'+this.params.article, self.showSingleWork);            
      
      return false;
    });


    // define a 'get' route that will be triggered at '#{section}/{sub}'
    this.get('#:section/:article', function() {
      /* set the current section */
      self.currentSection(self.matchSectionByName(this.params.section)); 

      /* get the JSON data and set the current article( currentWorkData ) -probably need to be changed to something more flexible */
      self.getJSON('/'+this.params.section+'/'+this.params.article, self.renderPanel);            
      
      return false;
    });



    // define a 'get' route that will be triggered at '#{path}'
    this.get('#:section', function() {
      //set the current section
      self.currentSection(self.matchSectionByName(this.params.section));       
      
      //not yet implemented
      if(!self.currentSection()) 
         window.hash('#404');
         
      /* reset the currentPanelData */
      self.currentPanelData(null);
      
      self.jumpToSection(self.currentSection().name);
      
      return false;
    });
    
    
    // define a home 'get'    
    this.get('/', function() {
      //self.currentWorkData(null); 
      self.currentPanelData(null);
      
      self.getScrollEvents();
    });

    
  }).run();
   
   
   
   
}




// Activates knockout.js only this is the home page
if($('body.home').length)
  ko.applyBindings(new AppViewModel());  


