$(document).ready(function() 
{
	$("#navigation_bar").load("/navigation_bar/navigation_bar.html");
	
	var refresh_time_1 = 5000 ;
	var refresh_time_2 = 5000 ;
	
	// DISPLAY REQUEST STATUS ( FOR ADMIN )
	$("#display_stats_button").click('submit',function()
	{
		setInterval(function(){
		
			$.ajax
			({
				url: "/includes/display_stats.php",
				dataType: 'json',
				contentType: "application/json; charset=utf-8",
				success: function(data)
				{
					var i = 0 ;
					for( i = 0 ; i < data.length ; i++)
					{
						if(i==0)$("#tbody_stats").html("<tr><td>"+data[i].user_api_key+"</td><td>"+data[i].request_1+"</td><td>"+data[i].request_2+"</td><td>"+data[i].request_3+"</td></tr>");
						else $("#tbody_stats").append("<tr><td>"+data[i].user_api_key+"</td><td>"+data[i].request_1+"</td><td>"+data[i].request_2+"</td><td>"+data[i].request_3+"</td></tr>");
					}
					
				}
				
			});
			
		}, refresh_time_1);

	});

	
	
	
	// DISPLAY REQUEST STATUS ( FOR ADMIN )
	$("#display_topten_button").click('submit',function()
	{
		setInterval(function(){
		
			$.ajax
			({
				url: "/includes/topten_stats.php",
				dataType: 'json',
				contentType: "application/json; charset=utf-8",
				success: function(data)
				{
					var i = 0 ;
					for( i = 0 ; ( i < data.length && i < 10 ) ; i++)
					{
						if(i==0)$("#tbody_topten_stats").html("<tr><td>"+data[i].user_api_key+"</td><td>"+data[i].count+"</td></tr>");
						else $("#tbody_topten_stats").append("<tr><td>"+data[i].user_api_key+"</td><td>"+data[i].count+"</td></tr>");
					}
					
				}
				
			});
			
		}, refresh_time_2);

	});
	
	
});