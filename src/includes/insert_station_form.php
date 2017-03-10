<table>
	<tr>
		<td>
			<div id="insert_station_form"> 
				
				<h2>Insert Station</h2>
				<form  action="/includes/insert_station.php" method="POST">
					Station code (ex. "PAT1") <input type="text" name="code"/><br />
					Station name (ex. "ΠΑΤΡΑ") <input type="text" name="name" /><br /><br />
					<h3>COORDINATES</h3>
					Latitude (ex. "12.097223") <input id="latitude" type="text" name="latitude" /><br />
					longitude (ex. "-15.09003") <input id="longitude" type="text" name="longitude" /><br /><br />
					<b>Closest matching address:</b>
					<div id="address"></div>
					<input type="submit" value="INSERT" />
				</form>
				
			</div>
		</td>
		<td>
			<div id="map">
				<?php require("google_map.php"); ?>
			</div>
		</td>
	</tr>
</table>







