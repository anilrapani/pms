/**
 * @author Anil Rapani
 */


$(document).ready(function(){

  
       jQuery.validator.addMethod("selected", function(value, element)
       {
           if(value == 0) { return false; }
          else { return true; }
       },"This field is required.");
       
     	
});
