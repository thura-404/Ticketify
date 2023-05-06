<?php

    session_start();
	include("Connect.php");
	include("SQL.php");

	if (!isset($_SESSION['Staff_ID'])) 
	{
		echo "<script>window.alert('Alert : >> Please Login To Your Account! <<')</script>";
		$_SESSION['loc'] = $_SERVER['REQUEST_URI'];
		echo "<script>window.location='E_Login.php'</script>";
	}
    else
    {
        $Position = mysqli_fetch_array(Multi_Select("*", "Employee", "ID", $_SESSION['Staff_ID']));
    }

	if (isset($_REQUEST['New'])) 
	{
		if (isset($_REQUEST['Update'])) 
		{
			$_SESSION['Update']	= $_REQUEST['Update'];
		}
	}
	elseif (isset($_REQUEST['Delete'])) 
	{
		$Delete 	= $_REQUEST['Delete'];

		if (Delete_Data("Trip","ID",$Delete)) 
		{
			echo "<script>window.alert('Trip Successfully Deleted.')</script>";
			echo "<script>window.location='Trip.php'</script>";
		}
		else
		{
			echo "<script>window.alert('Error >> " . mysqli_error($connection) . " <<')</script>";
			echo "<script>window.location='Trip.php'</script>";
		}
	}

	if (isset($_POST['btnSave']))
	{
		$ID 		= Max_ID("ID","Trip");
		$DCity		= $_POST['cboFirst'];
		$ACity		= $_POST['cboSecond'];
		$Time		= $_POST['txtTime'];

        if (Insert_Data("Trip",
                        "(ID, DCity, ACity, DTime)",
                        "('$ID', '$DCity', '$ACity', '$Time')"))
        {
            echo "<script>window.alert('Trip Successfully Saved.')</script>";
            echo "<script>window.location='Trip.php'</script>";
        }
        else
        {
            echo "<script>window.alert('Error >>" . mysqli_error($connection) . "<<')</script>";
            echo "<script>window.location='Trip.php'</script>";
        }

		
	}

    if (isset($_POST['btnUpdate'])) 
    {
        $Time       = $_POST['txtTime'];
        $DCity      = $_POST['txtDCity'];
        $ACity      = $_POST['txtACity'];

        $Data = Multi_Select("*","Trip","NOT ID",$_SESSION['Update']);

        if (mysqli_num_rows(Match_Data("Time","Trip","DCity",$DCity,"AND ACity = '" . $ACity . "' AND DTime = '" . $Time . "' AND NOT","ID",$_SESSION['Update'])) > 0) 
        {
            echo "<script>window.alert('Error : A Trip with the same time already exists!')</script>";
            echo "<script>window.location='Trip.php'</script>";
        }
        else 
        {
            if(Update_Data("Trip", "DTime = '$Time'", "ID", $_SESSION['Update']))
            {
                echo "<script>window.alert('ALert : City details successfully updated.')</script>";
                echo "<script>window.location='Trip.php'</script>";
                unset($_SESSION['Update']);
            }
            else
            {
                echo "<script>window.alert('Error : Please try again later!')</script>";
                echo "<script>window.location='Trip.php'</script>";
            }
        }

        
    }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="New.css">
        <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css">
        <script src="https://kit.fontawesome.com/976970d2ed.js" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>
        <script  src="DataTables/datatables.min.js"></script>
        <link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css" />

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        
        <script>
            $(document).ready( function ()
            {
                $('#tableid').DataTable();

                $('.Choose').chosen();
                $('#List').chosen();
                
                

                $("#Main").click(function()
                {
                    window.location = "Trip.php";
                });

                // Triggered when the value of the departure select box is changed
                $('#Choose').change(function(){
                    var departureCity = $(this).val(); 
                    $.ajax({
                        type: 'post',
                        url: 'Test.php',
                        data: {Departure: departureCity},
                        success: function(result){
                            // Update the options in the arrival select box
                            $('#List').html(result);
                            // Re-initialize the Chosen plugin on the updated select element
                            $('#List').trigger('chosen:updated');
                        }
                    });
                });
            } );

            
            function showPreview(event)
			{
			  if(event.target.files.length > 0){
			    var src = URL.createObjectURL(event.target.files[0]);
			    var preview = document.getElementById("file-ip-1-preview");
			    preview.src = src;
			    preview.style.display = "block";
			  }
			}

         
        </script>

    

    <?php include "Sidebar.php"; ?>
    
    <section class="home-section">
        <form action="Trip.php" method="post" enctype="multipart/form-data">
            <div class="Item">
                <div class="Header">
                    <table>
                        <tr>
                            <th><h1 class="Page">Trip</h1></th>

                            <th>
                                <a href="Trip.php?New">
                                    <div class="Expand">
                                        <input type="button" class="Text" value="New Record">
                                        <button class="Icon"><i class='fas fa-plus'></i></button>
                                    </div>
                                </a>
                            </th>
                        </tr>
                    </table>
                </div>

                <?php 
                    if (isset($_REQUEST['New'])) 
                    {
                ?>
                    <div class="Form">

                    <?php 

                        if (isset($_REQUEST['Update'])) 
                        {
                            $Rows		= mysqli_fetch_array(Multi_Select("*","Trip","ID",$_SESSION['Update']));
                        }
                        else
                        {
                    ?>

                            <div class="Input_Field">
                                <label>Departure</label>

                                <div class="Custom_Select">
                                    <select name="cboFirst" id="Choose" required class="Choose form-control">
                                        <option disabled selected hidden value="">Choose</option>
                                        <?php 
                                            $RResult 	= Single_Select("*", "City");
                                            $RCount		= mysqli_num_rows($RResult);
                                            
                                            
                                            for ($i=0; $i < $RCount; $i++) 
                                            { 
                                                $RRows	= mysqli_fetch_array($RResult);

                                                echo "<option value='" . $RRows['ID'] . "'>" . $RRows['Name'] . "</option>";
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="Input_Field">
                                <label>Arrival</label>

                                <div class="Custom_Select">
                                    <select name="cboSecond" id="List" required class="List form-control"  class="country_list">
                                        <option disabled selected hidden value="">Choose</option>
                                        
                                    </select>
                                </div>
                            </div>

                    <?php
                        }

                    ?>

                    <div class="Input_Field">
                        <label>Time</label>

                        <?php 
                            if (isset($_REQUEST['Update'])) 
                            {
                                echo "<input type='Time' name='txtTime' value='" . $Rows['DTime'] . "' class='Input' required>";
                                echo "<input type='hidden' name='txtDCity' value='" . $Rows['DCity'] . "' class='Input' required>";
                                echo "<input type='hidden' name='txtACity' value='" . $Rows['ACity'] . "' class='Input' required>";
                            }
                            else
                            {
                                echo "<input type='Time' name='txtTime' class='Input' required>";
                            }
                        ?>
                    </div>

                    <div class="Input_Field">
                        <?php 
                            if (isset($_REQUEST['Update'])) 
                            {
                                echo "<input type='submit' name='btnUpdate' class='Btn' value='Update'>";
                            }
                            else
                            {
                                echo "<input type='submit' name='btnSave' class='Btn' value='Save'>";
                            }
                        ?>
                        
                        <input type="submit" id="Main" name="btnCancle" class="Btn" value="Cancle">
                    </div>
                </div>

                <div class="Data">
                    <table id="tableid" class="display">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Departure</th>
                                <th>Arrival</th>
                                <th>Time</th>
                                <th>Tools</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php 
                                $result	= Single_Select("t.ID AS ID, t.DTime AS Time, dep.Name AS DepartureCity, arr.Name AS ArrivalCity","trip t
                                INNER JOIN city dep ON t.DCity = dep.ID
                                INNER JOIN city arr ON t.ACity = arr.ID");
                                $count	= mysqli_num_rows($result);

                                for ($i=0; $i < $count; $i++) 
                                { 
                                    $rows 	=	mysqli_fetch_array($result);
                                    $ID 	= 	$rows["ID"];

                                    if (isset($_REQUEST['Update'])) 
                                    {
                                        
                                        if ($ID == $_SESSION['Update']) 
                                        {
                                            echo "<tr class='Update'>";
                                            echo "<td>" . $ID . "</td>";
                                            echo "<td>" . $rows['DepartureCity'] . "</td>";
                                            echo "<td>" . $rows['ArrivalCity'] . "</td>";
                                            echo("<td>" . date("g:i A", strtotime($rows["Time"]))  . "</td>");
                                            echo("<td>
                                                    <a href='Trip.php?New&&Update=$ID'><i class='fas fa-pencil-alt'></i></a>
                                                    |
                                                    <a href='Trip.php?Delete=$ID'><i class='far fa-trash-alt'></i></a>
                                                </td>");
                                            echo "</tr>";
                                        }
                                        else
                                        {
                                            echo "<tr>";
                                            echo "<td>" . $ID . "</td>";
                                            echo "<td>" . $rows['DepartureCity'] . "</td>";
                                            echo "<td>" . $rows['ArrivalCity'] . "</td>";
                                            echo("<td>" . date("g:i A", strtotime($rows["Time"])) . "</td>");
                                            echo("<td>
                                                    <a href='Trip.php?New&&Update=$ID'><i class='fas fa-pencil-alt'></i></a>
                                                    |
                                                    <a href='Trip.php?Delete=$ID'><i class='far fa-trash-alt'></i></a>
                                                </td>");
                                            echo "</tr>";
                                        }
                                    }
                                    else
                                    {
                                        echo "<tr>";
                                        echo "<td>" . $ID . "</td>";
                                        echo "<td>" . $rows['DepartureCity'] . "</td>";
                                        echo "<td>" . $rows['ArrivalCity'] . "</td>";
                                        echo("<td>" . date("g:i A", strtotime($rows["Time"])) . "</td>");
                                        echo("<td>
                                                <a href='Trip.php?New&&Update=$ID'><i class='fas fa-pencil-alt'></i></a>
                                                |
                                                <a href='Trip.php?Delete=$ID'><i class='far fa-trash-alt'></i></a>
                                            </td>");
                                        echo "</tr>";
                                    }
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
                <?php
                    }
                    else
                    {
                ?>
                    <div class="Records">
                        <table id="tableid" class="display">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Departure</th>
                                <th>Arrival</th>
                                <th>Time</th>
                                <th>Tools</th>
                            </tr>
                        </thead>

                        <tbody>
                        
                            <?php 
                                $result = Single_Select("t.ID AS ID, t.DTime AS Time, dep.Name AS DepartureCity, arr.Name AS ArrivalCity","trip t
                                                        INNER JOIN city dep ON t.DCity = dep.ID
                                                        INNER JOIN city arr ON t.ACity = arr.ID");
                                $count	= mysqli_num_rows($result);

                                for ($i=0; $i < $count; $i++) 
                                { 
                                    $rows 	=	mysqli_fetch_array($result);
                                    $ID 	= 	$rows["ID"];


                                    echo("<tr>");
                                    echo("<td>" . $ID . "</td>");
                                    echo "<td>" . $rows['DepartureCity'] . "</td>";
                                    echo "<td>" . $rows['ArrivalCity'] . "</td>";
                                    echo("<td>" . date("g:i A", strtotime($rows["Time"])) . "</td>");
                                    echo("<td>
                                            <a href='Trip.php?New&&Update=$ID' class='Link'>
                                                <button class='Link_Icon'><i class='fas fa-pencil-alt'></i></button>
                                                <input	type='button' class='Link_Text' value='Update'>
                                            </a>
                                            <a href='Trip.php?Delete=$ID' class='Link'>
                                                <button class='Link_Icon'><i class='far fa-trash-alt'></i></button>
                                                <input	type='button' class='Link_Text' value='Delete'>
                                            </a>
                                        </td>");
                                    echo("</tr>");
                                    }
                            ?>
                                
                            </tbody>
                        </table>
                    </div>	
                <?php
                    }
                ?>						
            </div>
        </form>
    </section>  

        <script>

            let sidebar = document.querySelector(".sidebar");
            let closeBtn = document.querySelector("#btn");
            let searchBtn = document.querySelector(".bx-search");

            closeBtn.addEventListener("click", ()=>{
                sidebar.classList.toggle("open");
                menuBtnChange();//calling the function(optional)
            });

            searchBtn.addEventListener("click", ()=>{ 
                sidebar.classList.toggle("open");
                menuBtnChange(); 
            });

            function menuBtnChange() {
                if(sidebar.classList.contains("open"))
                {
                    closeBtn.classList.replace("bx-menu", "bx-menu-alt-right");
                }else 
                {
                    closeBtn.classList.replace("bx-menu-alt-right","bx-menu");
                }
            }
        </script>
    </body>
</html>
