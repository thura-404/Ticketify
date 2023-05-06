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

        if(!isset($_REQUEST['Departure']) && !isset($_REQUEST['Arrival']))
        {
            echo("<script>window.location='Home.php'</script>");
        }
        else
        {
            $Departure  = $_REQUEST['Departure'];
            $Arrival    = $_REQUEST['Arrival'];
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
			
			<link rel="stylesheet" href="Style2.css">

			<title>Ticketify</title>
		</head>
		<body>
		<?php include "Heading.php" ?>

        <section class="Categories Product">
        <h1 class="Heading">Choose <span>Ticket</span></h1>
            <div class="container_ticket">

                <?php
                    $result = Match_Data("t.ID, CONCAT(c1.Name, ' to ', c2.Name) AS Trip, b.Type AS `Bus`, o.Name AS `Operator`, o.Photo AS `Photo`, tr.DTime, t.Price",
                                            "Ticket t
                                            JOIN Trip tr ON t.TripID = tr.ID
                                            JOIN City c1 ON tr.DCity = c1.ID
                                            JOIN City c2 ON tr.ACity = c2.ID
                                            JOIN Bus b ON t.BusID = b.ID
                                            JOIN Operator o ON t.OperatorID = o.ID",
                                            "tr.DCity",$Departure,
                                            "AND",
                                            "tr.ACity",$Arrival);
                    $count	= mysqli_num_rows($result);

                    for ($i=0; $i < $count; $i++) 
                    { 
                        $rows 	=	mysqli_fetch_array($result);
                        $ID 	= 	$rows["ID"];
                    ?>
                        <div class="ticket">
                            <div class="logo">
                                <img src="<?php echo $rows['Photo']; ?>" alt="Bus Operator Logo" width="100">
                            </div>
                            <div class="details">
                                <h3><?php echo $rows['Operator']; ?></h3>
                                <p>Departure Time: <?php  echo date("g:i A", strtotime($rows['DTime'])); ?></p>
                                <p>Bus Type: <?php echo $rows['Bus']; ?></p>
                                <p>Trip: <?php  echo $rows['Trip']; ?></p>
                            </div>
                            <div class="price"><?php  echo $rows['Price']; ?> MMK</div>
                            <a href="<?php echo "Seats.php?Ticket=" . $ID . "&&Operator=" . urlencode($rows['Operator']) . "&&Bus=" . urlencode($rows['Bus']) . "&&Trip=" . urlencode($rows['Trip']) . "&&Time=" . urlencode($rows['DTime']) . "&&Price=" . urlencode($rows['Price']) . "" ?>" class="button"><span>Select Seats</span></a>
                        </div>
                    <?php
                    }
                ?>
            </div>  
		</section>

        
		
		<?php include "Footer.php" ?>
		</body>
	</html>