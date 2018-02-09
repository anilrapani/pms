/**
 * File : common.js 
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
        
        var govtProofTypeForm = $("#addGovtProofType,#editGovtProofType");
	
	govtProofTypeForm.validate({
		
		rules:{
			name :{ required : true }
			
		},
		messages:{
			name :{ required : "This field is required" }
		}
	});
        
        
         var shiftForm = $("#addShift,#editShift");
	
	shiftForm.validate({
		
		rules:{
			name :{ required : true }
			
		},
		messages:{
			name :{ required : "This field is required" }
		}
	});
        
        
        var entryForm = $("#addEntry");
        
        entryForm.validate({
             ignore: [],
           rules:{
               vehicle_type_id: {required : true},
               image_vehicle_number_plate : {required : true}
//               image_driving_license_number : {required : true}
           },
           messages:{
               vehicle_type_id: {required: "This field is required"},
               image_vehicle_number_plate : {required : "Please capture number plate"}
//                image_driving_license_number : {required : "Please capture number plate"}
           }
        });
        
        
         jQuery(document).on("click", ".deleteCompany,.deleteShift,.deleteGovtProofType", function(){
		var id = $(this).data("id"),
			hitURL = baseURL + deleteUrl,
			currentRow = $(this);
		
		var confirmation = confirm("Are you sure to delete this Record ?");
		
		if(confirmation)
		{
			jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : hitURL,
			data : { id : id } 
			}).done(function(data){
				currentRow.parents('tr').remove();
				if(data.status = true) { alert("Successfully deleted"); }
				else if(data.status = false) { alert("Deletion failed"); }
				else { alert("Access denied..!"); }
			});
		}
	});
        
});