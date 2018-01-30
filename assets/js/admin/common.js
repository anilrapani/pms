/**
 * File : common.js 
 * 
 * This file contain the validation of edit discipline form
 * 
 * @author Anil Rapani
 */

$(document).ready(function(){
	
	var companyForm = $("#addCompany,#editCompany,#addGovtProofType,#editGovtProofType,#addShift,#editShift,#addPrice,#editPrice,#addRole,#editRole,#addType,#editType,#addGate,#editGate");
	 
        $.validator.addMethod("alphanumericChars", function(value, element) {
                return this.optional(element) || /^[a-z0-9\ \-\&\,]+$/i.test(value);
         }, "Field should contain only letters and numbers");
    
        $.validator.addMethod("price", function(value, element) {
                return this.optional(element) || /^[0-9\ \.]+$/i.test(value);
         }, "Field should contain numbers and dot");
         
	companyForm.validate({
		
		rules:{
			name :{ required : true, alphanumericChars: true },
                        phone :{ required : true, number: true, minlength: 10, maxlength: 12 },
                        email :{ required : true,email : true },
                        address:{required : true},
                        start_time:{required : true},
                        end_time:{required : true},
                        more_than_minutes_per_hour_amount :{ required : true, price: true},
                        number_of_wheels :{required : true, number: true},
                        
			
		},
		messages:{
			// name :{ required : "This field is required" },
                        // phone :{ required : "This field is required" },
                        // email :{ required : "This field is required" }
		}
	});
        

        $(document).on("click", ".deleteConfirmation", function () {
            var recordId = $(this).data('id');
            $("#deleteRecord").attr("data-id", recordId); 
            $('#responseMessage').css("color", "#333"); $('#responseMessage').text("Are you sure you want to delete?");
        });
        
         jQuery(document).on("click", ".deleteRecord", function(){      
                    var id = $("#deleteRecord").attr("data-id"),
			hitURL = baseURL + deleteUrl,
			currentRow = $('.currentRow [data-id=' + id + ']');
                        
            		jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : hitURL,
			data : { id : id } 
			}).done(function(data){
				if(data.status == true) {   currentRow.parents('tr').remove(); $('#modal-default').modal('toggle'); }
				else if(data.status == false) { $('#responseMessage').css("color", "#d73925"); $('#responseMessage').text("Deletion Failed!"); }
				else { $('#responseMessage').css("color", "#d73925"); $('#responseMessage').text("Access denied!");  }
			});
		
	});
        
        
});

