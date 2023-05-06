<?php
	session_start();
	include("Connect.php");
	include("SQL.php");

	

	if(isset($_REQUEST['Ticket']))
	{
		$_SESSION['Ticket']		= $_REQUEST['Ticket'];
		$_SESSION['Operator'] 	= urldecode($_GET['Operator']);
		$_SESSION['Bus'] 		= urldecode($_GET['Bus']);
		$_SESSION['Trip'] 		= urldecode($_GET['Trip']);
		$_SESSION['Time'] 		= urldecode($_GET['Time']);
		$_SESSION['Price'] 		= urldecode($_GET['Price']);

		$ticketID = $_SESSION['Ticket'];
		$bookedSeats = array();

		// Query the Ticket table to get the ID of the current ticket
		$sql = "SELECT ID FROM Purchase WHERE TicketID = '$ticketID' AND Date = '" . $_SESSION['Date'] . "'";
		$result = mysqli_query($connection, $sql);

		if (mysqli_num_rows($result) > 0) {
			$row = mysqli_fetch_assoc($result);
			$ticketID = $row['ID'];

			// Query the Record table to get the seats that are already booked for the current ticket
			$sql = "SELECT Seat FROM Record WHERE ID = '$ticketID'";
			$result = mysqli_query($connection, $sql);

			while ($row = mysqli_fetch_assoc($result)) {
				$bookedSeats[] = $row['Seat'];
			}
		}
	}
	else 
	{
		echo "<script>window.location='Home.php'</script>";
	}

	if (isset($_POST['btnNext'])) {
		if (!empty($_POST['selected_seats']))
		{
			$_SESSION['selected_seats'] = $_POST['selected_seats'];

			echo "<script>window.location='Checkout.php'</script>";
		} else {
			// No seats selected, show error message
			echo "<script>window.alert('Please select at least one seat.')</script>";
			echo "<script>window.location='Seats.php'</script>";
		}
	}
	
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<script src="https://kit.fontawesome.com/976970d2ed.js"></script>

		<link  rel="stylesheet"  href="https://unpkg.com/swiper@8/swiper-bundle.min.css"/>
		<link rel="stylesheet" href="select2.min.css" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
		<link rel="stylesheet" href="Style2.css">
		<link rel="stylesheet" href="New.css">

		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

		<title>Ticketify</title>
	</head>
	<body>

	<script>
		$(document).ready( function ()
		{
			jQuery('#Choose').change(function(){
				var Dept = jQuery(this).val(); 
				jQuery.ajax({
					type:'post',
					url:'Test.php',
					data:'Dept='+Dept,
					success:function(result){
						jQuery('#Data').html(result);
						jQuery('.country_list').chosen();
					}
				});
			});
		} );
    </script>

	<script src="select2.min.js">
        $("#Data").select2( {
            placeholder: "Choose",
            allowClear: true
        });
    </script>

	<?php include "Heading.php" ?>

	<section class="Categories Product" id="Home">
	<h1 class="Heading">Choose <span>Seats</span></h1>
		<form action="<?php echo "Seats.php?Ticket=" . $_SESSION['Ticket'] . "&&Operator=" . $_SESSION['Operator'] . "&&Bus=" . $_SESSION['Bus'] . "&&Trip=" . $_SESSION['Trip'] . "&&Time=" . $_SESSION['Time'] . "&&Price=" . $_SESSION['Price'] . "" ?>" method="post" enctype="multipart/form-data">
			<div class="seat-select-box">

				<?php $seats = 0; for ($i = 1; $i <= 8; $i++): ?>
					<div class="seat-row">
						<?php  for ($j = 1; $j <= 3; $j++): ?>
							<?php 
								$seats++;
								$disabled = '';
								if (in_array($seats, $bookedSeats)) {
									$disabled = 'disabled';
								}
								if ($j == 2)
								{
							?>
									<div class="seat">
										<input type="checkbox" name="selected_seats[]" id="<?php echo $seats; ?>" value="<?php echo $seats; ?>" <?php echo $disabled; ?>>
										<label for="<?php echo $seats; ?>"><?php echo $seats; ?></label>
									</div>

									<div class="seat-space"></div>
							<?php
								}
								else
								{
							?>
									<div class="seat">
										<input type="checkbox" name="selected_seats[]" id="<?php echo $seats; ?>" value="<?php echo $seats; ?>" <?php echo $disabled; ?>>
										<label for="<?php echo $seats; ?>"><?php echo $seats; ?></label>
									</div>
							<?php
								}
							?>
						<?php endfor; ?>
					</div>

				<?php endfor; ?>

				<div class="Input_Field">
					<input type='submit' name='btnNext' class='Btn' value='Next'>
				</div>
			</div>
		</form>	
	</section>

	<?php include "Footer.php" ?>

	<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
	<script src="Script.js"></script>

		
	</body>
</html>