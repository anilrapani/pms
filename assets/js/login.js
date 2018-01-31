/**
 * File : common.js 
 * 
 * This file contain the validation of edit discipline form
 * 
 * @author Anil Rapani
 */

$(document).ready(function(){
	
	var loginForm = $("#login");
	 
        $.validator.addMethod("alphanumericChars", function(value, element) {
                return this.optional(element) || /^[a-z0-9]+$/i.test(value);
         }, "Field should contain only letters and numbers");
    
        loginForm.validate({
		
		rules:{
			user_name :{ required : true, alphanumericChars : true },
                        password :{ required : true }
		},
		messages:{
			// name :{ required : "This field is required" },
                        // phone :{ required : "This field is required" },
                        // email :{ required : "This field is required" }
		}
	});
        
        
});

