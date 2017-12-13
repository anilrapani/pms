/**
 * File : discipline.js 
 * 
 * This file contain the validation of edit discipline form
 * 
 * @author Anil Rapani
 */

$(document).ready(function(){
	
	var companyForm = $("#addCompany,#editCompany");
	
	companyForm.validate({
		
		rules:{
			name :{ required : true },
                        phone :{ required : true },
                        email :{ required : true,email : true }
			
		},
		messages:{
			name :{ required : "This field is required" },
                        phone :{ required : "This field is required" },
                        email :{ required : "This field is required" }
		}
	});
});