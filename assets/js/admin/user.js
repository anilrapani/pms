/**
 * File : addUser.js
 * 
 * This file contain the validation of add user form
 * 
 * Using validation plugin : jquery.validate.js
 * 
 * @author Anil Rapani
 */

$(document).ready(function(){
	
	var addUserForm = $("#user");
	$.validator.addMethod("alphanumericChars", function(value, element) {
                return this.optional(element) || /^[a-z0-9\ \-\&]+$/i.test(value);
         }, "Field should contain only letters and numbers");
    
	var validator = addUserForm.validate({
		
		rules:{
			fname :{ required : true, alphanumericChars : true },
			email : { required : true, email : true, remote : { url : baseURL + "checkEmailExists", type :"post"} },
			password : { required : true },
			cpassword : {required : true, equalTo: "#password"},
			mobile : { required : true, digits : true, minlength :10, maxlength :12 },
			role : { required : true, selected : true},
                        shift_id : { required : true, selected : true },
                        user_company_id : { required : true, selected : true },
                        government_proof_type_id : { required : true, selected : true },
                        government_id_number : {required : true }
                        
		},
		messages:{
			fname :{ required : "This field is required" },
			email : { required : "This field is required", email : "Please enter valid email address", remote : "Email already taken" },
			password : { required : "This field is required" },
			cpassword : {required : "This field is required", equalTo: "Please enter same password" },
			mobile : { required : "This field is required", digits : "Please enter numbers only" },
			role : { required : "This field is required", selected : "Please select atleast one option" },			
                        shift_id : { required : "This field is required", selected : "Please select atleast one option" },
                        user_company_id : { required : "This field is required", selected : "Please select atleast one option" },
                        government_proof_type_id : { required : "This field is required", selected : "Please select atleast one option" }
		}
	});
        
        $(document).on("click", ".deleteConfirmation", function () {
            var recordId = $(this).data('id');
            console.log('t1');
            $("#deleteRecord").attr("data-id", recordId); 
            
            $('#responseMessage').css("color", "#333"); $('#responseMessage').text("Are you sure you want to delete?");
        });
        
         jQuery(document).on("click", ".deleteRecord", function(){   
             // console.log('t2'+baseURL+deleteUrl);
                    var id = $("#deleteRecord").attr("data-id"),
			hitURL = baseURL + deleteUrl,
			currentRow = $('.currentRow [data-id=' + id + ']');
                        console.log(hitURL);
                        console.log(id);
            		jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : hitURL,
			data : { id : id } 
			}).done(function(data){
                            console.log('t3');
				if(data.status == true) {   currentRow.parents('tr').remove(); $('#modal-default').modal('toggle'); }
				else if(data.status == false) { $('#responseMessage').css("color", "#d73925"); $('#responseMessage').text("Deletion Failed!"); }
				else { $('#responseMessage').css("color", "#d73925"); $('#responseMessage').text("Access denied!");  }
			});
		
	});
        
});
