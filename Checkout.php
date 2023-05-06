<?php 
	session_start();
	include("Connect.php");
	include("SQL.php");

	if (isset($_POST['btnBook']))
	{
		$ID 		= Max_ID("ID","Purchase");
		$Name		= $_POST['txtName'];
		$Phone		= $_POST['txtPhone'];
		$Email		= $_POST['txtEmail'];

		$NRC 		= $_POST['cboFirst'] . "/" . $_POST['cboSecond'] . $_POST['cboThird'] . $_POST['txtFourth'];

		if (Insert_Data("Purchase",
						"(ID, TicketID, Date, Customer, Ph, NRC)",
						"('$ID', '" . $_SESSION['Ticket'] . "', '" . $_SESSION['Date'] . "', '$Name', '$Phone', '$NRC')"))
		{
			$seats = $_SESSION['selected_seats'];

			foreach ($seats as $seat) 
			{
				if (Insert_Data("Record", "(ID, Seat)", "('" . $ID . "', '$seat')")) 
				{
					
				} else 
				{
					echo "<script>window.alert('Error >>" . mysqli_error($connection) . "<<')</script>";
					echo "<script>window.location='Home.php'</script>";
				}
			}
			echo "<script>window.alert('Your Ticket Details Successfully Saved.')</script>";
			echo "<script>window.location='Home.php'</script>";	
		}
		else
		{
			echo "<script>window.alert('Error >>" . mysqli_error($connection) . "<<')</script>";
			echo "<script>window.location='Home.php'</script>";
		}
	}
	
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="select2.min.css" />

		<script src="https://kit.fontawesome.com/976970d2ed.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css">

		<link  rel="stylesheet"  href="https://unpkg.com/swiper@8/swiper-bundle.min.css"/>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
		<link rel="stylesheet" href="Style2.css">
		<link rel="stylesheet" href="Checkout.css">

		<title>Ticketify</title>
	</head>
	<body>

	<script>
		$(document).ready( function ()
		{

			jQuery('#Choose').change(function(){
				var Id = jQuery(this).val(); 
				jQuery.ajax({
					type:'post',
					url:'Test.php',
					data:'ID='+Id,
					success:function(result){
						jQuery('#Data').html(result);
						jQuery('.country_list').chosen();
					}
				});
			});
		} );
	</script>

		<?php include "heading.php" ?>
		
		<form action="Checkout.php" method="post">
			<div class="Checkout_Page">
				<div class="Billing_Details">
					<div class="Checkout_Form">
						<h4>Customer Details</h4>

						<div class="Form_Group">
							<label for="txtName">Customer Name</label>
							<input type="text" name="txtName" value="" required>
						</div>
						
						<div class="Form_Group">
							<label for="txtEmail">Contanct Email</label>
							<input type="email" name="txtEmail" value="" required>
						</div>

						<div class="Form_Group">
							<label for="txtPhone">Phone No.</label>
							<input type="text" name="txtPhone" value="" required>
						</div>
						
						<div class="Form_Group">
							<label for="">NRC</label>
						</div>

						<div class="Form_Inline">
							<div class="Form_Group">
								<select name="cboFirst" id="Choose" required class="Choose form-control">
									<option disabled selected hidden value="">Choose</option>
									<?php 
										for ($i=0; $i < 14; $i++) 
										{ 
											echo "<option value='" . ($i + 1) . "'>" . ($i + 1) . "</option>";
										}
									?>
								</select>
							</div>	

							<div class="Form_Group">
								<select name="cboSecond" id="Data" required class="form-control country_list">
									<option disabled selected hidden value="">Choose</option>
									
								</select>
							</div>
						</div>

						<div class="Form_Inline">
							<div class="Form_Group">
								<div class="Custom_Select">
                                    <select name="cboThird" id="Third" required class="form-control">
                                        <option disabled selected hidden value="">Choose</option>
                                        <option value="(N)">(N)</option>
                                        <option value="(P)">(P)</option>
                                        <option value="(E)">(E)</option>
                                    </select>
                                </div>
							</div>	

							<div class="Form_Group">
								<input type="number" name="txtFourth" id="Fourth" class="Input" onKeyDown='if(this.value.length>=6) return false;' required />
							</div>
						</div>

						
					</div>
				</div>
				<div class="Order_Summary">
					<div class="Checkout_Total">
						<h4>Ticket Details</h4>
						<ul>

							
							<li>Operator : <span><?php echo $_SESSION['Operator']?></span></li>
							<li>Bus Type : <span><?php echo $_SESSION['Bus']?></span></li>
							<li>Trip : <span><?php echo $_SESSION['Trip']?></span></li>
							<li>Date : <span><?php echo $_SESSION['Date']?></span></li>
							<li>Time : <span><?php echo date("g:i A", strtotime($_SESSION['Time']));?></span></li>
							<li>Price : <span><?php echo $_SESSION['Price']?> MMK</span></li>
							
							<li><hr></li>
							<li><hr></li>
							<li><hr></li>
							<li><hr></li>
							<li>Total Amount : <span><?php echo $_SESSION['Price']*count($_SESSION['selected_seats'])?> MMK</span></li>
						</ul>
					</div>
				</div>
				<div class="Order_Summary">
					<div class="Checkout_Total Payment">
						<h4>Payment Summary</h4>
						<ul id="Bullshit">
							<li><input type="radio" name="rdoMobile"  value="KBZ" id="KBZ" class="Hide_Radio" checked="checked" required="required"><label for="KBZ"><img src="Payment/KBZ.jpg" alt=""></label></li>
							<li><input type="radio" name="rdoMobile"  value="Wave" id="Wave"  class="Hide_Radio" required="required"><label for="Wave"><img src="Payment/WaveMoney.png" alt="" class="Wave"></label></li>
						</ul>
						<img src="Payment/KBZPay.jpg" id="QR">
						<ul>
							<li><input type="submit" name="btnBook" value="Book Now!"></li>
						</ul>
					</div>
				</div>
			</div>
		</form>

		<?php include "footer.php" ?>

		<script >
			$(document).ready( function ()
            {

                $('input[type="radio"]').change(function(){
					if($('#Payment').is(':checked'))
					{
						$('#Bullshit').css('display', 'block');
					}

					if($('#KBZ').is(':checked'))
					{
						$('#QR').fadeIn();
						$("#QR").attr("src","Payment/KBZPay.jpg");
					}

					if($('#Wave').is(':checked'))
					{
						$('#QR').fadeIn();
						$("#QR").attr("src","Payment/Wave.png");
					}

					if($('#COD').is(':checked'))
					{
						$('#Bullshit').css('display', 'none');
						$('#QR').fadeOut();
					}
				});

				
            });
		</script>
		
		<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
		<script src="Script.js"></script>
	</body>
</html>