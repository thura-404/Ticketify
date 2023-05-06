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

		if (Delete_Data("Ticket","ID",$Delete)) 
		{
			echo "<script>window.alert('Ticket Successfully Deleted.')</script>";
			echo "<script>window.location='Ticket.php'</script>";
		}
		else
		{
			echo "<script>window.alert('Error >> " . mysqli_error($connection) . " <<')</script>";
			echo "<script>window.location='Ticket.php'</script>";
		}
	}

	if (isset($_POST['btnSave']))
	{
		$ID 		= Max_ID("ID","Ticket");
		$DCity		= $_POST['cboDeparture'];
		$ACity		= $_POST['cboArrival'];
		$Time		= $_POST['cboTime'];
		$Operator	= $_POST['cboOperator'];
		$Bus    	= $_POST['cboBus'];
		$Price		= $_POST['txtPrice'];

        $TripResult = Single_Select("ID","Trip WHERE DCity = " . $DCity . "  AND ACity = " . $ACity . " AND DTime = '" . $Time . "'");
        $TripRow    = mysqli_fetch_array($TripResult);
        $Trip       = $TripRow['ID'];

        if (mysqli_num_rows(Single_Select("*","Ticket
                                                WHERE 
                                                TripID      = " . $Trip . "     AND
                                                OperatorID  = " . $Operator . " AND
                                                BusID       = " . $Bus . "")) > 0) 
        {
            echo "<script>window.alert('Error: The Ticket Record Already Exists!')</script>";
            echo "<script>window.location='Ticket.php'</script>";
        }
        else 
        {
            if (Insert_Data("Ticket",
                            "(ID, TripID, BusID, OperatorID, Price)",
                            "('$ID', '" . $Trip . "', '$Bus', '$Operator', '$Price')"))
            {
                echo "<script>window.alert('Ticket Successfully Saved.')</script>";
                echo "<script>window.location='Ticket.php'</script>";
            }
            else
            {
                echo "<script>window.alert('Error >>" . mysqli_error($connection) . "<<')</script>";
                echo "<script>window.location='Ticket.php'</script>";
            }
        }
	}

    if (isset($_POST['btnUpdate'])) 
    {
        $Price       = $_POST['txtPrice'];
        
        if(Update_Data("Ticket", "Price = '$Price'", "ID", $_SESSION['Update']))
        {
            echo "<script>window.alert('ALert : Ticket details successfully updated.')</script>";
            echo "<script>window.location='Ticket.php'</script>";
            unset($_SESSION['Update']);
        }
        else
        {
            echo "<script>window.alert('Error : Please try again later!')</script>";
            echo "<script>window.location='Ticket.php'</script>";
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
                console.log('jQuery ' + jQuery.fn.jquery + ' loaded!');

                $('#tableid').DataTable();

                $('#Departure').chosen();
                $('#Arrival').chosen();
                $('#Time').chosen();
                $('#Operator').chosen();
                $('#Bus').chosen();

              
                


                $("#Main").click(function() {
                    window.location = "Ticket.php";
                });

                $('select[name=cboDeparture]').change(function() {
                    var departureCity = $(this).val();
                    $.ajax({
                        type: 'post',
                        url: 'Test.php',
                        data: {
                        TDep: departureCity
                        },
                        success: function(result) {
                        // Update the options in the arrival select box
                        $('select[name=cboArrival]').html(result);
                        // Re-initialize the Chosen plugin on the updated select element
                        $('select[name=cboArrival]').trigger('chosen:updated');
                        // Set the "choose" option as selected in the arrival select box
                        $('select[name=cboArrival]').val('').trigger('chosen:updated');
                        // Clear the options in the time select box
                        $('select[name=cboTime]').html('');
                        // Set the "choose" option as selected in the time select box
                        $('select[name=cboTime]').append('<option value="">Choose</option>').trigger('chosen:updated');
                        }
                    });
                });

                // Triggered when the value of the arrival select box is changed
                $('select[name=cboArrival]').change(function() {
                    var departureCity = $('select[name=cboDeparture]').val();
                    var arrivalCity = $(this).val();
                    // Check if both select boxes have a value selected
                    if (departureCity && arrivalCity) {
                        $.ajax({
                        type: 'post',
                        url: 'Test.php',
                        data: {
                            TDep: departureCity,
                            TArr: arrivalCity
                        },
                        success: function(result) {
                            // Update the options in the time select box
                            $('select[name=cboTime]').html(result);
                            // Re-initialize the Chosen plugin on the updated select element
                            $('select[name=cboTime]').trigger('chosen:updated');
                        }
                        });
                    } else {
                        // Either of the select boxes has the "choose" option selected, so clear the options in the time select box
                        $('select[name=cboTime]').html('');
                        // Set the "choose" option as selected in the time select box
                        $('select[name=cboTime]').append('<option value="">Choose</option>').trigger('chosen:updated');
                    }
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
        <form action="Ticket.php" method="post" enctype="multipart/form-data">
            <div class="Item">
                <div class="Header">
                    <table>
                        <tr>
                            <th><h1 class="Page">Ticket</h1></th>

                            <th>
                                <a href="Ticket.php?New">
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
                            $Rows		= mysqli_fetch_array(Multi_Select("*","Ticket","ID",$_SESSION['Update']));
                        }
                        else
                        {
                    ?>

                    

                            <div class="Input_Field">
                                <label>Departure</label>

                                <div class="Custom_Select">
                                    <select name="cboDeparture" id="Departure" required class="form-control">
                                        <option disabled selected hidden value="">Choose</option>
                                        <?php 
                                            $RResult = Single_Select("DISTINCT C.Name AS Name, C.ID AS ID", "Trip T INNER JOIN City C ON T.DCity = C.ID");
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
                                <label>Time</label>

                                <div class="Custom_Select">
                                    <select name="cboTime" id="Time" required class="form-control"  class="country_list">
                                        <option disabled selected hidden value="">Choose</option>
                                    </select>
                                </div>
                            </div>

                            <div class="Input_Field">
                                <label>Operator</label>

                                <div class="Custom_Select">
                                    <select name="cboOperator" id="Operator" required class="form-control" data-placeholder="Choose an operator...">
                                        <option></option>
                                        <?php
                                            $RResult = Single_Select("*", "Operator");
                                            $RCount = mysqli_num_rows($RResult);
                                            for ($i=0; $i < $RCount; $i++) { 
                                                $RRows = mysqli_fetch_array($RResult);
                                                echo "<option value='" . $RRows['ID'] . "'>" . $RRows['Name'] . "</option>";
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="Input_Field">
                                <label>Bus Type</label>

                                <div class="Custom_Select">
                                    <select name="cboBus" id="Bus" required class="form-control" data-placeholder="Choose a bus type...">
                                        <option></option>
                                        <?php
                                            $RResult = Single_Select("*", "Bus");
                                            $RCount = mysqli_num_rows($RResult);
                                            for ($i=0; $i < $RCount; $i++) { 
                                                $RRows = mysqli_fetch_array($RResult);
                                                echo "<option value='" . $RRows['ID'] . "'>" . $RRows['Type'] . "</option>";
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>


                    <?php
                        }

                    ?>

                    <div class="Input_Field">
                        <label>Price</label>

                        <?php 
                            if (isset($_REQUEST['Update'])) 
                            {
                                echo "<input type='number' name='txtPrice' value='" . $Rows['Price'] . "' class='Input' min='0' max='99999' step='500' onKeyDown='if(this.value.length>=5) return false;' required>";
                            }
                            else
                            {
                                echo "<input type='number' name='txtPrice' class='Input' min='0' max='99999' step='500' onKeyDown='if(this.value.length>=5) return false;' required>";
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
                                <th>Trip</th>
                                <th>Time</th>
                                <th>Operator</th>
                                <th>Bus Type</th>
                                <th>Price</th>
                                <th>Tools</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php 
                                $result	= $result = Single_Select("t.ID, CONCAT(c1.Name, ', ', c2.Name) AS `Trip`, b.Type AS `Bus`, o.Name AS `Operator`, t.Price, tr.DTime ",
                                                                    "Ticket t 
                                                                    INNER JOIN Trip tr ON t.TripID = tr.ID 
                                                                    INNER JOIN Bus b ON t.BusID = b.ID 
                                                                    INNER JOIN Operator o ON t.OperatorID = o.ID 
                                                                    INNER JOIN City c1 ON tr.DCity = c1.ID 
                                                                    INNER JOIN City c2 ON tr.ACity = c2.ID");
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
                                            echo "<td>" . $rows['Trip'] . "</td>";
                                            echo "<td>" . date("g:i A", strtotime($rows["DTime"])) . "</td>";
                                            echo "<td>" . $rows['Operator'] . "</td>";
                                            echo "<td>" . $rows['Bus'] . "</td>";
                                            echo "<td>" . $rows['Price'] . "</td>";
                                            echo("<td>
                                                    <a href='Ticket.php?New&&Update=$ID'><i class='fas fa-pencil-alt'></i></a>
                                                    |
                                                    <a href='Ticket.php?Delete=$ID'><i class='far fa-trash-alt'></i></a>
                                                </td>");
                                            echo "</tr>";
                                        }
                                        else
                                        {
                                            echo "<tr>";
                                            echo "<td>" . $ID . "</td>";
                                            echo "<td>" . $rows['Trip'] . "</td>";
                                            echo "<td>" . date("g:i A", strtotime($rows["DTime"])) . "</td>";
                                            echo "<td>" . $rows['Operator'] . "</td>";
                                            echo "<td>" . $rows['Bus'] . "</td>";
                                            echo "<td>" . $rows['Price'] . "</td>";
                                            echo("<td>
                                                    <a href='Ticket.php?New&&Update=$ID'><i class='fas fa-pencil-alt'></i></a>
                                                    |
                                                    <a href='Ticket.php?Delete=$ID'><i class='far fa-trash-alt'></i></a>
                                                </td>");
                                            echo "</tr>";
                                        }
                                    }
                                    else
                                    {
                                        echo "<tr>";
                                        echo "<td>" . $ID . "</td>";
                                        echo "<td>" . $rows['Trip'] . "</td>";
                                        echo "<td>" . date("g:i A", strtotime($rows["DTime"])) . "</td>";
                                        echo "<td>" . $rows['Operator'] . "</td>";
                                        echo "<td>" . $rows['Bus'] . "</td>";
                                        echo "<td>" . $rows['Price'] . "</td>";
                                        echo("<td>
                                                <a href='Ticket.php?New&&Update=$ID'><i class='fas fa-pencil-alt'></i></a>
                                                |
                                                <a href='Ticket.php?Delete=$ID'><i class='far fa-trash-alt'></i></a>
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
                                <th>Trip</th>
                                <th>Time</th>
                                <th>Operator</th>
                                <th>Bus Type</th>
                                <th>Price</th>
                                <th>Tools</th>
                            </tr>
                        </thead>

                        <tbody>
                        
                            <?php 
                                $result = Single_Select("t.ID, CONCAT(c1.Name, ', ', c2.Name) AS `Trip`, b.Type AS `Bus`, o.Name AS `Operator`, t.Price, tr.DTime ",
                                                        "Ticket t 
                                                        INNER JOIN Trip tr ON t.TripID = tr.ID 
                                                        INNER JOIN Bus b ON t.BusID = b.ID 
                                                        INNER JOIN Operator o ON t.OperatorID = o.ID 
                                                        INNER JOIN City c1 ON tr.DCity = c1.ID 
                                                        INNER JOIN City c2 ON tr.ACity = c2.ID");
                                $count	= mysqli_num_rows($result);

                                for ($i=0; $i < $count; $i++) 
                                { 
                                    $rows 	=	mysqli_fetch_array($result);
                                    $ID 	= 	$rows["ID"];


                                    echo("<tr>");
                                    echo("<td>" . $ID . "</td>");
                                    echo "<td>" . $rows['Trip'] . "</td>";
                                    echo "<td>" . date("g:i A", strtotime($rows["DTime"])) . "</td>";
                                    echo "<td>" . $rows['Operator'] . "</td>";
                                    echo "<td>" . $rows['Bus'] . "</td>";
                                    echo "<td>" . $rows['Price'] . "</td>";
                                    echo("<td>
                                            <a href='Ticket.php?New&&Update=$ID' class='Link'>
                                                <button class='Link_Icon'><i class='fas fa-pencil-alt'></i></button>
                                                <input	type='button' class='Link_Text' value='Update'>
                                            </a>
                                            <a href='Ticket.php?Delete=$ID' class='Link'>
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
