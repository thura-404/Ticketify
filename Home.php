	<?php
		session_start();
		include("Connect.php");
		include("SQL.php");

		if(isset($_POST['btnLogout']))
		{
			unset($_SESSION['User_ID']);
			unset($_SESSION['User_Name']);
			unset($_SESSION['User_Email']);
			unset($_SESSION['access_token']);
		}
		elseif (isset($_POST['btnLogin'])) 
		{
			$_SESSION['Location'] 	= $_SERVER['REQUEST_URI'];
			echo("<script>window.location='User_Login.php'</script>");
		}	


		if (isset($_POST['btnBook'])) 
		{
			$Departure 	= $_POST['cboDeparture'];
			$Arrival 	= $_POST['cboArrival'];
			$_SESSION['Date']	= $_POST['txtDate'];

			echo("<script>window.location='Book.php?Departure=" . $Departure . "&&Arrival=" . $Arrival . "'</script>");
		}
	?>

	<!DOCTYPE html>
	<html>
		<head>
			<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial-scale=1">

			<script src="https://kit.fontawesome.com/976970d2ed.js"></script>
			<link rel="stylesheet" href="New.css">

			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css">
			<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>


			<link  rel="stylesheet"  href="https://unpkg.com/swiper@8/swiper-bundle.min.css"/>
			
			<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"> -->
			<link rel="stylesheet" href="Style2.css">

			<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
			<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"> -->


			<title>Ticketify</title>
		</head>
		<body>

		<script>
			$(document).ready( function ()
			{
				$('#Departure').chosen();
                $('#Arrival').chosen();

				$('select[name=cboDeparture]').change(function() {
                    var departureCity = $(this).val();
                    $.ajax({
                        type: 'post',
                        url: 'Test.php',
                        data: {
                        HDep: departureCity
                        },
                        success: function(result) {
                        // Update the options in the arrival select box
                        $('select[name=cboArrival]').html(result);
                        // Re-initialize the Chosen plugin on the updated select element
                        $('select[name=cboArrival]').trigger('chosen:updated');
                        // Set the "choose" option as selected in the arrival select box
                        $('select[name=cboArrival]').val('').trigger('chosen:updated');
                        }
                    });
                });
			} );
		</script>

		<?php include "Heading.php" ?>

		<section class="Home" id="Home">
			<div class="Content">
				<h3>Go farther, together.</h3>
				<p>"The world is a book, and those who do not travel read only a page." - Saint Augustine</p>
				<div class="container">
					<form action="Home.php" method="post" enctype="multipart/form-data">
						<div class="Input_Field">
							<label>Departure</label>

							<div class="Custom_Select">
								<select name="cboDeparture" id="Departure" required class="form-control">
									<option disabled selected hidden value="">Choose</option>
									<?php 
										$RResult = Single_Select("DISTINCT c.Name, c.ID", "City c
																JOIN Trip t ON t.DCity = c.ID
																JOIN Ticket ti ON ti.TripID = t.ID");
										$RCount = mysqli_num_rows($RResult);
										
										for ($i=0; $i < $RCount; $i++) 
										{ 
											$RRows = mysqli_fetch_array($RResult);

											echo "<option value='" . $RRows['ID'] . "'>" . $RRows['Name'] . "</option>";
										}
									?>
								</select>
							</div>
						</div>

						<div class="Input_Field">
							<label>Arrival</label>

							<div class="Custom_Select">
								<select name="cboArrival" id="Arrival" required class="form-control"  class="country_list">
									<option disabled selected hidden value="">Choose</option>
								</select>
							</div>
						</div>

						<div class="Input_Field">
                            <label>Date</label>

                            <input type="date" id="date" name="txtDate" min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>" max="<?php echo date('Y-m-d', strtotime('+5 days')); ?>" class="Input">
                        </div>	
						
						<input type="submit" class="Btn" name="btnBook" value="Book Now">
					</form>
					
				</div>
				
				
			</div>
		</section>

		<section class="Feature">
			<h1 class="Heading">Our <span>Features</span></h1>

			<div class="Box_Container">	
				<div class="Box">
					<img src="HomePhotos/feature-img-1.png" alt="" srcset="">
					<h3>Hassle-free booking</h3>
					<p>Our platform makes it easy for you to book your bus tickets online, without any stress or hassle.</p>
				</div>

				<div class="Box">
					<img src="HomePhotos/feature-img-3.png" alt="" srcset="">
					<h3>Easy Payment</h3>
					<p>My Mobile... My bank... My Wallet... <br> Pay with Mobile pay (KBZ Pay, Wave Pay)</p>
				</div>

				<div class="Box">
					<img src="HomePhotos/feature-img-2.png" alt="" srcset="">
					<h3>Reliable and punctual service</h3>
					<p>Our buses are always on time, so you can rest assured that you'll reach your destination on schedule.</p>
				</div>
			</div>
		</section>

		<?php include "Footer.php" ?>

		<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
		<!-- <script src="Script.js"></script> -->

		<script>

			let	Login_Form = document.querySelector('.Login_Form');

			document.querySelector('#Login_Btn').onclick = () =>
			{
				Login_Form.classList.toggle('Active');
				Search_From.classList.remove('Active');
				Shopping_Cart.classList.remove('Active');
				Navbar.classList.remove('Active');
			}

			window.onscroll = () =>
			{
				Search_From.classList.remove('Active');
				Shopping_Cart.classList.remove('Active');
				Login_Form.classList.remove('Active');
				Navbar.classList.remove('Active');
			}

			var swiper = new Swiper(".Product_Slider", 
			{
				loop: true,
				spaceBetween: 20,
				autoplay:
				{
					delay: 3500,
					disableOnInteraction: false,
				},
				breakpoints: 
				{
				0: 
				{
					slidesPerView: 1,
				},
				768: 
				{
					slidesPerView: 2,
				},
				1020: 
				{
					slidesPerView: 3,
				},
				},
			});

			let Preview_Container 	= document.querySelector('.Product_Preview');
			let Preview_Box			= Preview_Container.querySelectorAll('.Preview');
			let Box_Container		= document.querySelector('.Box_Container');
			let Box_A	 			= Box_Container.querySelectorAll('.Box');

			document.querySelectorAll('.Box_Container .Box').forEach(Box => {
				Box.onclick = () => {
					Preview_Container.style.display = 'flex';
					let Name = Box.getAttribute('data-name');

					Preview_Box.forEach(Preview => {
						let Target = Preview.getAttribute('data-target');
						if (Name == Target) {
							Preview.classList.toggle('Active');
						}
					});
				};
			});

			Preview_Box.forEach(close => {
				close.querySelector('.fa-times').onclick = () => {
					close.classList.remove('Active');

					Preview_Container.style.display = 'none';
				}
			});

			Box_A.forEach(close => {
				close.querySelector('.fa-eye').onclick = () => {
					Preview_Container.style.display = 'flex';
					Preview.classList.toggle('Active');
				}
			});
		</script>

			
		</body>
	</html>