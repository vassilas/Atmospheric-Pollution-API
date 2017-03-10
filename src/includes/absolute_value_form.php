<div id="absolute_value_form">
	<h2>Absolute Value </h2>

	<form action="includes/absolute_value.php" method="GET">


		Station code (optional) : <input type="text" name="station_code"/><br />
		Year : <input type="text" name="year" style="width: 70px"/>
		Month : <input type="text" name="month" style="width: 50px"/>
		Day : <input type="text" name="day" style="width: 50px"/>
		Hour : <input type="text" name="hour" style="width: 50px"/>
		<br />Pollution Type 
		<select name="pollution_type">
			<option value="CO">CO</option>
			<option value="NO">NO</option>
			<option value="NO2">NO2</option>
			<option value="O3">O3</option>
			<option value="SO2">SO2</option>
			<option value="NOX">NOX</option>
			<option value="Smoke">Smoke</option>
		</select><br />
		
		<input type="button" value="Absolute value" id="absolute_value_button" />
	</form>
</div>

