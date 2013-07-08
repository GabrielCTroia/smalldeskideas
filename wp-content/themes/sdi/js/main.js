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








/**
  * make the elements slideDown and Up or Right and Left 
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
  //_log(self.elm.initSize);
  
  

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





/**
 * input: @url       - string with the url
 *        @callback  - string with the callback function name;
 *
 * output: void 
 * 
 * side effects: populates a given element in the callback with the returned data
 */ 
function getJSON(url,callback){   
   $.getJSON( url + '?getJSON=true').success(function(data){      
      
      if(callback != undefined)        
        callback(data);
      
      console.log("JSON succeded for ", data);
      
   }).error(function(){
      _log("Error! The JSON for " + url + " didn't load.");
   });
}


/* returns the object from an array of objects that matched the criteria */ 
function matchObjectByItem(array,property,value){
  return $.grep(array,function(e){
    return e[property] == value;
  });
}


/* returns the index of an object in an array */
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


//KO CUSTOM BINDINGS

/*
ko.bindingHandlers.yourBindingName = {
    init: function(element, valueAccessor, allBindingsAccessor, viewModel, bindingContext) {
        // This will be called when the binding is first applied to an element
        // Set up any initial state, event handlers, etc. here
    },
    update: function(element, valueAccessor, allBindingsAccessor, viewModel, bindingContext) {
        // This will be called once when the binding is first applied to an element,
        // and again whenever the associated observable changes value.
        // Update the DOM element based on the supplied values here.
    }
};
*/



//ko.bindingHandlers.customCheck = {
   
   //init: function(element, valueAccessor)
   
   
   
//}

/*
customCheck: {cond: 'condition to be evaluated', then - a callback function , else : a callback function }

customAttrRender: {attribute: value}

if attribute is an object go into it like:

customAttrRender: {style: {-webkit-transform, rotate({dynamicValue: rotationDeg} ) }

style: {propery: value}

when dynamicValue is present, the value of it's property is returned 
*/
/*

ko.bindingHandlers.scroll = {
 
  updating: true,
 
  init: function(element, valueAccessor, allBindingsAccessor) {
      var self = this
      self.updating = true;
      ko.utils.domNodeDisposal.addDisposeCallback(element, function() {
            $(window).off("scroll.ko.scrollHandler")
            self.updating = false
      });
  },
 
  update: function(element, valueAccessor, allBindingsAccessor){
    var props = allBindingsAccessor().scrollOptions;
    var offset = props.offset ? props.offset : "0";
    var loadFunc = props.loadFunc;
    var load = ko.utils.unwrapObservable(valueAccessor());
    var self = this;
 
    if(load){
      element.style.display = "";
      $(window).on("scroll.ko.scrollHandler", function(){
        if(($(document).height() - offset <= $(window).height() + $(window).scrollTop())){
          if(self.updating){
            loadFunc()
            self.updating = false;
          }
        }
        else{
          self.updating = true;
        }
      });
    }
    else{
        element.style.display = "none";
        $(window).off("scroll.ko.scrollHandler")
        self.updating = false
    }
  }
}
*/


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
    
    lastScrollTop = 0;
    //on scroll set the slide the curtain up
    $(window).scroll(function(event){
      
      var st = $(this).scrollTop();
      
      /* the 0.03 of the SEEN* elements height converted to integers  */
      var percentageToInt = ($(element).height() - $(element).offset().top ) * 0.03
      
      /* check if the direction of the scroll is down,   
       * & if the scrollTop is bigger than 0 (OSx smooth way of animating scrolling)
       * & if the ORIGINAL top of the element is still lower than the bottom
       */
      if (st > lastScrollTop && st > 0 && $(element).offset().top > -$(element).height() ){ //scrolling down
        //console.log('scrolling down', st);
        
        //console.log(percentageToInt);    
       
        $(element).css({
          top: $(element).offset().top - percentageToInt
        })
       
      } else if($(element).offset().top <= -$(element).height()){ //the element is out of the screen
        
        viewModel.isCurtainDown(false);  
        
      }
      
      lastScrollTop = st;
      
      //console.log(event);
      
            
      //console.log($(element)[0]);
      //viewModel.isCurtainDown(false);
    });
    
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
    
    console.log('The panel for ' + value + ' was initiated');
    
  },
  
  update: function(element, valueAccessor){
    
    var value      = ko.utils.unwrapObservable(valueAccessor()),
        panelElm   = $(element).parents('.panel'); //defined in the init    
    
    if(value){

      //fade in the panel
      //panelElm.hide().fadeIn(500);
      //panelElm.show();
      $(element).hide().fadeIn(500);
      //make the page unscrollable
      //disableScroll();  
      //$(element).hide();
      
/*
      $(element).css({left:'100%'})
      $(element).animate({
        left: 0
      },500,function(){})
*/
      
      
      console.log("Panel for " + value.title + " is in.");
    
    } else {      

      //fade the panel out
      /*
panelElm.animate({
        left: '-100%'
      },500,function(){})
*/
      
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
    
    /* Show the other half of the pie if the score is higher than half. */
    if(value.score > 50)
      $('.ring-wrapper', element).addClass('gt50');
    
    // the rotation degree is the score times 3.6
    var rotateDegree = 3.6 * value.score;
    
    //apply the new rotation degree to the .pie that is rotated 
    $('.pie.rotated',element).css({'-webkit-transform' : 'rotate(' + rotateDegree + 'deg)'});

/*
    console.log($(element)[0]);
    console.log(value)
*/

  }

}









/* KO App*/

function AppViewModel() {
   
   var self = this;
   
   
   //these should probably be loaded dynamically
   self.sections = ko.observableArray([
         {
            'name'      : 'home'
           ,'realURL'   : '/home'        
         },{
            'name'      : 'skills'
           ,'realURL'   : '/skills'        
         },{
            'name'      : 'work'
           ,'realURL'   : '/work'        
         }
         ]);
    
   
   self.currentSection        = ko.observable();       
   
   
   self.currentPanelData      = ko.observable();

   
   self.works                 = ko.observable();
   self.allSkills                = ko.observable();
   
   
   /*
    I chose this to be compiuted instead of doing it the other way - having the currentPanel computed with this observable
       because, this way I feel is more dynamic. I can have other computed observables listening to the currentPanel, since
       currentPanel is changed one time in self.renderPanel();
    */
   self.currentWorkData       = ko.computed(function(){
     return self.currentPanelData();
   });   
   
   
   /* METHODS */
                
  /** 
   * Void(): set the content for the sections 
   * 
   */          
   self.setSectionsContent = function(){
      for(var i = 0; i < self.sections().length; i++){         
         var currSect             = self.sections()[i];
             currSect.data        = ko.observable();  //stores the section' datas
             currSect.template    = 'section-' + currSect.name ; //stores the section' template
         
         /* populate the data object with the section' data */
         getJSON( self.sections()[i].realURL, currSect.data);        
      }
   }
   
   
   
/*
   self.setAllWorks = function(){
     //not implemented yet - should be called by the template when the section is loaded
   }
   
   self.setAllSkills = function(){
     self.allSkills(self.matchSectionByName('skills').skills);
     
     console.log(self.allSkills());
   }
*/
   
   
   self.getCurrentSectionURL = function(){
     //console.log('/#' + self.currentSection().name);
     return '/#' + self.currentSection().name; 
   }
      
   /**
    * input: @section (string) - section name
    * output:  string - sections' template name 
    */
   self.getSectionTemplate = function(section){
      return section.template;
   }

   /** 
    * returns the formated permalink of each work 
    * input: @data - string containing the work data object
    */
   self.getWorkPermalink = function(data){
     return '#work/' + data.post_name;
   }



   
   /** 
    * matches & returns a section in the self.sections array by its name 
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
     
     console.log('prev',self.prevPanelURL());
     console.log('next',self.nextPanelURL());
     
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
    * if the skill score is bigger than 50 append the 'gt50' class to the skill HTML element 
    *
    * input: @skill (object)      - the skill 
    *        @elm (HTML object)   - the skill HTML element
    * 
    * output: Void.
    */
   self.getSkillClassGT50 = function(skill,elm){
     if (skill.score > 50)
       return $(elm).attr('class') + ' ' + 'gt50';      
     else
      return false;
   }
  
   self.getSkillRotationDegree = function(skill){
     return 
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
   
   
   
   
  
   self.log = function(elm){
     _log('this is the element:', elm);
   }
   
           
   
   
   
   
   /* INITILIAZERS */
   
   self.initDOM = function(){
     disableScroll();
   }   
   
   //prepare the DOM
   self.initDOM(); 
   
   /* get the Sections Content before everything else */ 
   self.setSectionsContent();           
  
  
  
  
   self.getScrollEvents = function(){
     
/*
     $('section').waypoint(function(direction) {      
       console.log($(this)[0],direction);
     });
*/  
    var timer = setTimeout(function(){

/*
      var scrollorama = $.scrollorama({
        blocks: '.scrollorama-block'
      });
    
      scrollorama.animate('.scrollorama-block.home .wrapper',{
        duration    : 1000,
        property    : 'left',
        easing      : 'swing',
        start       : 700,
        end         : 0
      });
*/
    
/*
      scrollorama.onBlockChange(function() {
        console.log('You just scrolled to block#'+scrollorama.blockIndex);
      });
*/
    
    
/*         console.log('This is scrollorama',scrollorama); */
        
        
        
    }, 1000);
    

  }  
  
  
  
  
  
  
  

   /* ROUTER */
   
  //return;
  Sammy(function() {


    // define a 'get' route that will be triggered at '#work/{sub}'
    this.get('#work/:article', function() {
      /* set the current section */
      self.currentSection(self.matchSectionByName('work')); 

      /* get the JSON data and set the current article( currentWorkData ) */
      getJSON('/work/'+this.params.article, self.showSingleWork);            
      
      return false;
    });


    // define a 'get' route that will be triggered at '#{section}/{sub}'
    this.get('#:section/:article', function() {
      /* set the current section */
      self.currentSection(self.matchSectionByName(this.params.section)); 

      /* get the JSON data and set the current article( currentWorkData ) -probably need to be changed to something more flexible */
      getJSON('/'+this.params.section+'/'+this.params.article, self.renderPanel);            
      
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


