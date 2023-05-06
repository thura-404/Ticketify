<?php 
	session_start();
	include('Connect.php');
	include("SQL.php");

	if (isset($_POST['Departure'])) 
	{
		$Result = Multi_Select("*", "City", "NOT ID", $_POST['Departure']);
		$Count = mysqli_num_rows($Result);

		for ($i = 0; $i < $Count; $i++) 
		{ 
			$Row = mysqli_fetch_array($Result);
			echo "<option value='" . $Row['ID'] . "'>" . $Row['Name'] . "</option>";
		}
	}
	
	if (isset($_POST['HDep'])) 
	{
		$Result = Multi_Select("DISTINCT c.Name, c.ID", "City c
								JOIN Trip t ON t.ACity = c.ID
								JOIN Ticket ti ON ti.TripID = t.ID", 
								"t.DCity", $_POST['HDep']);
		$Count = mysqli_num_rows($Result);

		for ($i = 0; $i < $Count; $i++) 
		{ 
			$Row = mysqli_fetch_array($Result);
			echo "<option value='" . $Row['ID'] . "'>" . $Row['Name'] . "</option>";
		}
	}

	if (isset($_POST['TDep']) && !isset($_POST['TArr'])) 
	{
		$Result = Multi_Select("DISTINCT C.Name AS Name, C.ID AS ID", "trip T JOIN city C ON T.ACity = C.ID", "T.DCity", $_POST['TDep']);
		$Count = mysqli_num_rows($Result);

		for ($i = 0; $i < $Count; $i++) 
		{ 
			$Row = mysqli_fetch_array($Result);
			echo "<option value='" . $Row['ID'] . "'>" . $Row['Name'] . "</option>";
		}
	} 
	elseif (isset($_POST['TDep']) && isset($_POST['TArr'])) 
	{
		$Result = Single_Select("DTime", "Trip WHERE DCity = " .$_POST['TDep'] . " AND ACity = " . $_POST['TArr'] . "");
		$Count = mysqli_num_rows($Result);

		for ($i = 0; $i < $Count; $i++) 
		{ 
			$Row = mysqli_fetch_array($Result);
			$Time 	= $Row['DTime'];
			echo "<option value='" . $Time . "'>" . date("g:i A", strtotime($Time)) . "</option>";
		}
	}


	if (isset($_POST['TDep'])) 
	{
		
	}
	
	if (isset($_POST['ID'])) 
	{
		$Result = Multi_Select("Code", "NRC", "No", $_POST['ID']);
		$Count 	= mysqli_num_rows($Result);

		for ($i=0; $i < $Count; $i++) 
		{ 
			$Row = mysqli_fetch_array($Result);
			echo "<option value='" . $Row['Code'] . "'>" . $Row['Code'] . "</option>";
		}
	}

	

	if (isset($_POST['City'])) 
	{
		$Result = Multi_Select("Township", "Township", "City", $_POST['City']);
		$Count 	= mysqli_num_rows($Result);

		for ($i=0; $i < $Count; $i++) 
		{ 
			$Row = mysqli_fetch_array($Result);
			echo "<option value='" . $Row['Township'] . "'>" . $Row['Township'] . "</option>";
		}
	}

	if(isset($_POST['Size']))
	{
		if(isset($_POST['Type']))
		{
			$Size 	= $_POST['Size'];
			$Type 	= $_POST['Type'];

			$Price 	= mysqli_fetch_array(Match_Data("Price", "Type", "Type", $Type, "AND", "Size", $Size));

			echo  $Price['Price'] ;
		}
	}

	if(isset($_POST['Index']))
	{
		if(isset($_POST['Quantity']))
		{
			$index 	= $_POST['Index'];
			$_SESSION['Cart'][$index]['Quantity'] = $_POST['Quantity'];
		}
	}

	if(isset($_POST['BIndex']))
	{
		if(isset($_POST['BQuantity']))
		{
			$index 	= $_POST['BIndex'];
			$_SESSION['Birthday'][$index]['Quantity'] 	= $_POST['BQuantity'];

			$Price 	= mysqli_fetch_array(Match_Data("Price", "Type", "Type", $_SESSION['Birthday'][$index]['Type'], "AND", "Size", $_SESSION['Birthday'][$index]['Size']));

			$_SESSION['Birthday'][$index]['Price'] 		= $Price[0];

			echo ($Price[0] * $_POST['BQuantity']);
		}
		else
		{
			$index 	= $_POST['BIndex'];

			$Price 	= mysqli_fetch_array(Match_Data("Price", "Type", "Type", $_SESSION['Birthday'][$index]['Type'], "AND", "Size", $_SESSION['Birthday'][$index]['Size']));

			echo $Price[0];
		}
	}
?>