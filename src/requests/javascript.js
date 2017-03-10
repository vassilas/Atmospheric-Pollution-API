$(document).ready(function() 
{
	$("#navigation_bar").load("/navigation_bar/navigation_bar.html");
	
	
	// REQUEST 1
	$("#display_stations_button").click(function(){
		
		$.ajax({
			url : '/includes/display_stations.php' ,
			dataType: "json" ,
			type : "GET",
			data : { "api_key" :'5b65417a1cbfb532bf0eed0ddf2d28c4'},
			success: function(data)
			{

				var lengh = data.length;  
				var i = 0 ;				
				for ( i = 0; i < lengh; i++) {
					 if(i==0)$("#tbody_display_stations").html("<tr><td>"+data[i].code+"</td><td>"+data[i].name+"</td><td>"+data[i].latitude+"</td><td>"+data[i].longitude+"</td></tr>");
					 else $("#tbody_display_stations").append("<tr><td>"+data[i].code+"</td><td>"+data[i].name+"</td><td>"+data[i].latitude+"</td><td>"+data[i].longitude+"</td></tr>");

				}
			}
		});
		
		//$("#display_stations_container").load('/includes/display_stations.php');
	});
	
	
	
	
	//REQUEST 2
	$("#absolute_value_button").click(function(){
		
		$.ajax({
			url: "/includes/absolute_value.php",
			dataType: 'json', 
			contentType: "application/json; charset=utf-8", 
			type: 'GET' ,
			data: {
				"api_key" :'5b65417a1cbfb532bf0eed0ddf2d28c4',
				"pollution_type2" : $('#pollution_type2').val() ,
				"station_code2" : $('#station_code2').val() ,
				"year2" : $('#year2').val()  ,
				"month2" : $('#month2').val() ,
				"day2" : $('#day2').val() ,
				"hour2" :  $('#hour2').val()
			},
			success: function(data){
				var i = 0 ;
				for( i = 0 ; i < data.length ; i++)
				{
					if(i == 0) $("#tbody_absolute_value").html("<tr><td>"+data[i].latitude+"</td><td>"+data[i].longitude+"</td><td>"+data[i].absolute_value+"</td></tr>");
					else $("#tbody_absolute_value").append("<tr><td>"+data[i].latitude+"</td><td>"+data[i].longitude+"</td><td>"+data[i].absolute_value+"</td></tr>");
				}
			}
		});
	});	
	
	
	// REQUEST 3
	$("#avarage_value_button").click('submit',function(){
		
		
		$.ajax({
			url: "/includes/av_value.php",
			dataType: 'json', 
			contentType: "application/json; charset=utf-8", 
			type: 'GET' ,
			data: {
				"api_key" :'5b65417a1cbfb532bf0eed0ddf2d28c4',
				"pollution_type3" : $('#pollution_type3').val() ,
				"station_code3" : $('#station_code3').val() ,
				"year3" : $('#year3').val()  ,
				"month3" : $('#month3').val() ,
				"day3" : $('#day3').val() ,
			},
			success: function(data){
				var i = 0 ;
				for( i = 0 ; i < data.length ; i++)
				{
					if(i == 0) $("#tbody_avarage_value").html("<tr><td>"+data[i].latitude+"</td><td>"+data[i].longitude+"</td><td>"+data[i].avarage+"</td><td>"+data[i].standard_deviation+"</td></tr>");
					else $("#tbody_avarage_value").append("<tr><td>"+data[i].latitude+"</td><td>"+data[i].longitude+"</td><td>"+data[i].avarage+"</td><td>"+data[i].standard_deviation+"</td></tr>");
				}
			}
		});

	});
	
	
	
	
});
