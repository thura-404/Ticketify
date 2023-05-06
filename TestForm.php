<!DOCTYPE html>
<html>
<head>
	<title>Online Ticket Reservation</title>
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	<style type="text/css">
		body {
			background-color: #f7f7f7;
			font-family: Arial, sans-serif;
		}

		.container {
			max-width: 500px;
			margin: 0 auto;
			display: flex;
			flex-direction: column;
			align-items: center;
			justify-content: center;
			height: 100vh;
		}

		h1 {
			text-align: center;
			font-size: 36px;
			margin-bottom: 20px;
		}

		form {
			background-color: #fff;
			padding: 20px;
			border-radius: 5px;
			box-shadow: 0 5px 10px rgba(0,0,0,.1);
			text-align: center;
			margin-top: 20px;
			width: 100%;
			max-width: 400px;
		}

		label {
			display: block;
			margin-bottom: 10px;
			font-size: 18px;
			font-weight: bold;
			text-transform: uppercase;
			color: #555;
			text-align: left;
		}

		select {
			width: 100%;
			padding: 10px;
			font-size: 16px;
			border: none;
			border-radius: 5px;
			box-shadow: 0 3px 6px rgba(0,0,0,.1);
			margin-bottom: 20px;
			-webkit-appearance: none;
			-moz-appearance: none;
			appearance: none;
			background-color: #f7f7f7;
			background-image: url("https://cdn4.iconfinder.com/data/icons/ionicons/512/icon-ios7-arrow-down-512.png");
			background-repeat: no-repeat;
			background-position: right 10px center;
		}

		select:focus {
			outline: none;
			box-shadow: 0 3px 6px rgba(0,0,0,.2);
		}

		button {
			background-color: #4CAF50;
			color: #fff;
			font-size: 16px;
			font-weight: bold;
			padding: 10px 20px;
			border: none;
			border-radius: 5px;
			box-shadow: 0 3px 6px rgba(0,0,0,.1);
			cursor: pointer;
			transition: background-color .3s ease;
		}

		button:hover {
			background-color: #3e8e41;
		}
	</style>
</head>
<body>
	<div class="container">
		<h1>Online Ticket Reservation</h1>
		<form>
			<label for="dCity">Departure City:</label>
			<select name="dCity" id="dCity">
				<option value="" disabled selected>Select Departure City</option>
				<option value="Yangon">Yangon</option>
				<option value="Mandalay">Mandalay</option>
				<option value="Lashio">Lashio</option>
			</select>

			<label for="aCity">Arrival City:</label>
			<select name="aCity" id="aCity">
				<option value="" disabled selected>Select Arrival City</option>
				<option value="Yangon">Yangon</option>
				<option value="Mandalay">Mandalay</option>
				<option value="Lashio">Lashio</option>
			</select>

			<label for="dDate">Departure Date:</label>
			<input type="date" id="dDate" name="dDate" placeholder="Enter Departure Date" required>

			<label for="aDate">Arrival Date:</label>
			<input type="date" id="aDate" name="aDate" placeholder="Enter Arrival Date" required>

			<label for="tType">Ticket Type:</label>
			<input type="radio" id="econ" name="tType" value="economy" checked>
			<label for="econ">Economy</label>
			<input type="radio" id="bus" name="tType" value="business">
			<label for="bus">Business</label>
			<input type="radio" id="first" name="tType" value="first">
			<label for="first">First Class</label>

			<label for="numPass">Number of Passengers:</label>
			<input type="number" id="numPass" name="numPass" min="1" max="10" placeholder="Enter Number of Passengers" required>

			<button type="submit">Search Flights</button>
		</form>
	</div>
</body>

