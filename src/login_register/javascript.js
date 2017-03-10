$(document).ready(function() 
{
	$("#navigation_bar").load("/navigation_bar/navigation_bar.html");
	
	$("#login_button").click(function(){
		
		$.ajax({
			url : '/includes/log_in.php' ,
			dataType: "json" ,
			contentType: "application/json; charset=utf-8", 
			type : "GET",
			data: {
				"log_in_email" : $('#username').val(),
				"log_in_passwd" : $('#password').val()
			},
			success: function(data)
			{
				$("#response").html("<h1>"+data[0].msg+"</h1>");
				//$("#response").load("/includes/log_in.php");
				//$("#response").append("<h1>"+$('#username').val()+" , "+$('#password').val()+"</h1>");
			}
		});
		
	});
	
	$("#register_button").click(function(){
		
		$.ajax({
			url : '/includes/register.php' ,
			dataType: "json" ,
			contentType: "application/json; charset=utf-8", 
			type : "GET",
			data: {
				"register_email" : $('#username').val(),
				"register_passwd" : $('#password').val()
			},
			success: function(data)
			{
				$("#response").html("<h1>"+data[0].msg+"</h1>");
				//$("#response").load("/includes/register.php");
				//$("#response").append("<h1>"+$('#username').val()+" , "+$('#password').val()+"</h1>");
			}
		});
		
	});
	
	
	
	$("#logout_button").click(function(){
		
		$.ajax({
			url : '/includes/log_out.php' ,
			dataType: "json" ,
			contentType: "application/json; charset=utf-8", 
			success: function(data)
			{
				$("#response").html("<h1>"+data[0].msg+"</h1>");
				//$("#response").load("/includes/register.php");
				//$("#response").append("<h1>"+$('#username').val()+" , "+$('#password').val()+"</h1>");
			}
		});
		
	});
	
	
});