/**
 * @author Anil Rapani
 */


jQuery(document).ready(function(){
	
	jQuery(document).on("click", ".deleteUser", function(){
		var userId = $(this).data("userid"),
			hitURL = baseURL + "deleteUser",
			currentRow = $(this);
		
		var confirmation = confirm("Are you sure to delete this user ?");
		
		if(confirmation)
		{
			jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : hitURL,
			data : { userId : userId } 
			}).done(function(data){
				console.log(data);
				currentRow.parents('tr').remove();
				if(data.status = true) { alert("User successfully deleted"); }
				else if(data.status = false) { alert("User deletion failed"); }
				else { alert("Access denied..!"); }
			});
		}
	});
        
        
        
        jQuery(document).on("click", ".deleteCompany", function(){
		var id = $(this).data("id"),
			hitURL = baseURL + "admin/employee/deleteCompany",
			currentRow = $(this);
		
		var confirmation = confirm("Are you sure to delete this Company ?");
		
		if(confirmation)
		{
			jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : hitURL,
			data : { id : id } 
			}).done(function(data){
				currentRow.parents('tr').remove();
				if(data.status = true) { alert("Company successfully deleted"); }
				else if(data.status = false) { alert("Company deletion failed"); }
				else { alert("Access denied..!"); }
			});
		}
	});
	
        
        
         jQuery(document).on("click", ".deleteState", function(){
		var id = $(this).data("id"),
			hitURL = baseURL + "admin/state/deleteState",
			currentRow = $(this);
		
		var confirmation = confirm("Are you sure to delete this State ?");
		
		if(confirmation)
		{
			jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : hitURL,
			data : { id : id } 
			}).done(function(data){
				console.log(data);
				currentRow.parents('tr').remove();
				if(data.status = true) { alert("State successfully deleted"); }
				else if(data.status = false) { alert("State deletion failed"); }
				else { alert("Access denied..!"); }
			});
		}
	});
        
        
         jQuery(document).on("click", ".deleteCity", function(){
		var id = $(this).data("id"),
			hitURL = baseURL + "admin/city/deleteCity",
			currentRow = $(this);
		
		var confirmation = confirm("Are you sure to delete this City ?");
		
		if(confirmation)
		{
			jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : hitURL,
			data : { id : id } 
			}).done(function(data){
				console.log(data);
				currentRow.parents('tr').remove();
				if(data.status = true) { alert("City successfully deleted"); }
				else if(data.status = false) { alert("City deletion failed"); }
				else { alert("Access denied..!"); }
			});
		}
	});
        
        
        jQuery(document).on("click", ".deleteDiscipline", function(){
		var id = $(this).data("id"),
			hitURL = baseURL + "jobprovider/discipline/deleteDiscipline",
			currentRow = $(this);
		
		var confirmation = confirm("Are you sure to delete this Discipline ?");
		
		if(confirmation)
		{
			jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : hitURL,
			data : { id : id } 
			}).done(function(data){
				console.log(data);
				currentRow.parents('tr').remove();
				if(data.status = true) { alert("Discipline successfully deleted"); }
				else if(data.status = false) { alert("Discipline deletion failed"); }
				else { alert("Access denied..!"); }
			});
		}
	});
	
        
        jQuery(document).on("click", ".deleteJob", function(){
		var id = $(this).data("id"),
			hitURL = baseURL + "jobprovider/job/deleteJob",
			currentRow = $(this);
		
		var confirmation = confirm("Are you sure to delete this Job ?");
		
		if(confirmation)
		{
			jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : hitURL,
			data : { id : id } 
			}).done(function(data){
				console.log(data);
				currentRow.parents('tr').remove();
				if(data.status = true) { alert("Job successfully deleted"); }
				else if(data.status = false) { alert("Job deletion failed"); }
				else { alert("Access denied..!"); }
			});
		}
	});
        
        
         jQuery(document).on("click", ".deleteJobtype", function(){
		var id = $(this).data("id"),
			hitURL = baseURL + "admin/jobtype/deleteJobtype",
			currentRow = $(this);
		
		var confirmation = confirm("Are you sure to delete this Job type ?");
		
		if(confirmation)
		{
			jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : hitURL,
			data : { id : id } 
			}).done(function(data){
				console.log(data);
				currentRow.parents('tr').remove();
				if(data.status = true) { alert("Job type successfully deleted"); }
				else if(data.status = false) { alert("Job type deletion failed"); }
				else { alert("Access denied..!"); }
			});
		}
	});
        
	
	jQuery(document).on("click", ".searchList", function(){
		
	});
	
});
