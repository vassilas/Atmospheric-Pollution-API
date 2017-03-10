$(document).ready(function() 
{
	$("#navigation_bar").load("/navigation_bar/navigation_bar.html");
	
	// DISPLAY REQUEST STATUS ( FOR USER )
	$("#display_requests_button").click('submit',function()
	{
		$.ajax
		({
			url: "/includes/display_requests.php",
			dataType: 'json',
			contentType: "application/json; charset=utf-8",
			success: function(data)
			{
				$("#tbody_requests_stations").html("<tr><td>"+data[0].user_api_key+"</td><td>"+data[0].request_1+"</td><td>"+data[0].request_2+"</td><td>"+data[0].request_3+"</td></tr>");
			}
			
		});
	});
	
	
});