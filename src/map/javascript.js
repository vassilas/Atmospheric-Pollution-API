//5b65417a1cbfb532bf0eed0ddf2d28c4
function displayMarkers(){
	
	$.ajax({
		url : '/includes/display_stations.php' ,
		dataType: "json" ,
		type : "GET",
		data : { "api_key" :'5b65417a1cbfb532bf0eed0ddf2d28c4'},
		success: function(data)
		{

			var lengh = data.length;  
			//markersData.lenght = lengh ;
			var i = 0 ;
			
			for ( i = 0; i < lengh; i++) 
			{	
				var latlng = new google.maps.LatLng(data[i].latitude, data[i].longitude);
				createMarker(latlng, data[i].name, data[i].code);
			}
			
			
		}
	});

	
}


function createMarker(latlng, name, station_code){
	var marker = new google.maps.Marker({
		map: map,
		position: latlng,
		title: name
	});
	
	var abs_value ;
	var avarage_value ;
	var standard_deviation_value ;
	
	// Variable to define the HTML content to be inserted in the infowindow
	

	// This event expects a click on a marker
	// When this event is fired the infowindow content is created
	// and the infowindow is opened
	google.maps.event.addListener(marker, 'click', function() {

//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++	
		//ABSOLUTE VALUE	   
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++	   
		$.ajax({
			url: "/includes/absolute_value.php",
			//async: false ,
			//timeout: 2000 ,
			dataType: 'json', 
			contentType: "application/json; charset=utf-8", 
			type: 'GET' ,
			data: {
				"api_key" :'5b65417a1cbfb532bf0eed0ddf2d28c4',
				"pollution_type2" : $('#map_pollution_type_id').val() ,
				"station_code2" : station_code,
				"year2" : $('#map_year_id').val()  ,
				"month2" : $('#map_month_id').val() ,
				"day2" : $('#map_day_id').val() ,
				"hour2" :  $('#map_hour_id').val()
			},
			success: function(data)
			{
				abs_value = data[0].absolute_value ;
				
				
				//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++	
						//AVARAGE + STANDARD_DEVIATION
				//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++		   
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
								"station_code3" : station_code ,
								"year3" : $('#map_year_id').val()  ,
								"month3" : $('#map_month_id').val() ,
								"day3" : $('#map_day_id').val() ,
							},
							success: function(data)
							{
								avarage_value = data[0].avarage ;
								standard_deviation_value = data[0].standard_deviation ;
								
								show_marker(marker,name,station_code,abs_value,avarage_value,standard_deviation_value);
							},
	
						})
			},

		})
		
		show_marker(marker,name,station_code,abs_value,avarage_value,standard_deviation_value);

	});
}


function show_marker(marker,name,station_code,abs_value,avarage_value,standard_deviation_value)
{
	 var iwContent = '<div id="iw_container">' +
		'Station Name : ' + name + 
		'<br />Station Code : ' + station_code + 
		'<br />Absolute Value : ' + abs_value +
		'<br />Avarage Value : ' + avarage_value +
		'<br />Standard Deviation Value : ' + standard_deviation_value +
		'</div>';
		
	// including content to the infowindow
	infoWindow.setContent(iwContent);

	// opening the infowindow in the current map and at the current marker location
	infoWindow.open(map, marker);
	
}

/*
function sleep(miliseconds){
   var currentTime = new Date().getTime();

   while (currentTime + miliseconds >= new Date().getTime()) {
   }
}

*/

function initialize() {
	var mapOptions = {
		center: new google.maps.LatLng(39.13488999933833, 23.143730384655782),
		zoom: 7,
		mapTypeId: 'roadmap',
	};

	map = new google.maps.Map(document.getElementById('mapCanvas'), mapOptions);

	// a new Info Window is created
	infoWindow = new google.maps.InfoWindow();

	// Event that closes the InfoWindow with a click on the map
	google.maps.event.addListener(map, 'click', function() {
		infoWindow.close();
	});

	// Finally displayMarkers() function is called to begin the markers creation
	displayMarkers();
}

//setInterval(function(){displayMarkers()}, 4000); // if uncomment this comment displaymarkers() in init()

google.maps.event.addDomListener(window, 'load', initialize);





$(document).ready(function() 
{
	$("#navigation_bar").load("/navigation_bar/navigation_bar.html");
	
});