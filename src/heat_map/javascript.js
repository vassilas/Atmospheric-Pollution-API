//API_KEY : 5b65417a1cbfb532bf0eed0ddf2d28c4
points = new google.maps.MVCArray();


function displayHeatMap(){
	
	
	$.ajax({
		url: "/includes/avarage_value.php",
		dataType: 'json', 
		//async: false ,
		//timeout: 2000 ,
		contentType: "application/json; charset=utf-8", 
		type: 'GET' ,
		data: {
				"api_key" :'5b65417a1cbfb532bf0eed0ddf2d28c4',
				"pollution_type3" : $('#map_pollution_type_id').val() ,
				"year3" : $('#map_year_id').val()  ,
				"month3" : $('#map_month_id').val() ,
				"day3" : $('#map_day_id').val() ,
			},
		success: function(data)
		{
			var lengh = data.length; 
			var i = 0 ;
			
			for ( i = 0; i < lengh; i++) 
			{	

				avarage_value = data[i].avarage ;
				var latlng = new google.maps.LatLng(data[i].latitude, data[i].longitude);
				
				var heatPoint = {location: latlng, weight: avarage_value};
				points.push(heatPoint); 		
				//show_marker(marker,name,station_code,abs_value,avarage_value,standard_deviation_value);
			}
			
			if(i==lengh)initialize();
		},
	
	})
}


function initialize() {
	var mapOptions = {
		center: new google.maps.LatLng(39.13488999933833, 23.143730384655782),
		zoom: 7,
		mapTypeId: 'roadmap',
	};

	map = new google.maps.Map(document.getElementById('mapCanvas'), mapOptions);

	heatmap = new google.maps.visualization.HeatmapLayer({ //heatmap details
		data: points, //[],
		dissipating: true,
		map: map,
		radius: 100,
		maxIntensity: 20 ,
		opacity : 0.5 ,
	});

}

google.maps.event.addDomListener(window, 'load', displayHeatMap);