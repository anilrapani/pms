/* 
 * File : job.js 
 * Copyright (C) 2017 Kastech
 * @project : touba316
 * @email : arapani@kastechindia.com
 * @since : Dec 5, 2017
 * @version : 
 * This file contain the validation of edit job form
 * @author Anil Rapani
 */

$(document).ready(function(){
	
	var addOrEditJobForm = $("#addJob, #editJob");
	
	addOrEditJobForm.validate({
		
		rules:{
			name :{ required : true },
			discipline_id :{ required : true, selected : true},
                        job_type_id :{ required : true, selected : true}
		},
		messages:{
			name :{ required : "This field is required" },
                        discipline_id : { required : "This field is required", selected : "Please select atleast one option" },
                        job_type_id : { required : "This field is required", selected : "Please select atleast one option" }
		}
	});
    

});

