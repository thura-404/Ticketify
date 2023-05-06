<?php

    session_start();
	include("Connect.php");
	include("SQL.php");

	if (!isset($_SESSION['Staff_ID'])) 
	{
		echo "<script>window.alert('Alert : >> Please Login To Your Account! <<')</script>";
		$_SESSION['loc'] = "Employee.php";
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

		if (Delete_Data("Timetable","ID",$Delete)) 
		{
			echo "<script>window.alert('Timetable Successfully Deleted.')</script>";
			echo "<script>window.location='Time_Tables.php'</script>";
		}
		else
		{
			echo "<script>window.alert('Error >> " . mysqli_error($connection) . " <<')</script>";
			echo "<script>window.location='Time_Tables.php'</script>";
		}
	}

	if (isset($_POST['btnSave']))
	{
		$ID 		= Max_ID("ID","Timetable");
		$Departure		= $_POST['txtDeparture'];
		$Arrival		= $_POST['txtArrival'];
		$Time		= $_POST['txtTime'];

        if(mysqli_num_rows(Match_Data("*", "Timetable", "Departure = '" .$Departure . "' AND Arrival", $Arrival, "AND", "Time", $Time)) > 0)
        {
            echo "<script>window.alert('Records Already Exists.')</script>";
            echo "<script>window.location='Time_Tables.php?New'</script>";	
        }
        else
        {
            if (Insert_Data("Timetable",
                            "(ID, Departure, Arrival, Time)",
                            "('$ID', '$Departure', '$Arrival', '$Time')"))
            {
                echo "<script>window.alert('Timetable Successfully Saved.')</script>";
                echo "<script>window.location='Time_Tables.php'</script>";	
            }
            else
            {
                echo "<script>window.alert('Error >> " . mysqli_error($connection) . " <<')</script>";
                echo "<script>window.location='Time_Tables.php'</script>";
            }
        }
	}

    if (isset($_POST['btnUpdate'])) 
    {
        $Time      = $_POST['txtTime'];
       
       
        if(Update_Data("Timetable", "Time = '$Time'", "ID", $_SESSION['Update']))
        {
            echo "<script>window.alert('ALert : Timetable details successfully updated.')</script>";
            echo "<script>window.location='Time_Tables.php'</script>";
            unset($_SESSION['Update']);
        }
        else
        {
            echo "<script>window.alert('Error : Please try again later!')</script>";
            header($_SERVER['REQUEST_URI']);
        }

    }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="New.css">
        <link rel="stylesheet" href="select2.min.css" />
        <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
        
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css">

		<script src="https://kit.fontawesome.com/976970d2ed.js" crossorigin="anonymous"></script>

		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

		<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.cs">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

		<script  src="DataTables/datatables.min.js"></script>
		<link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css" />

        <style>
        .select2-dropdown {top: 22px !important;}
        </style>

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <script>
            $(document).ready( function ()
            {
                $('#tableid').DataTable();


                $("#Main").click(function()
                    {
                        window.location = "Employee.php";
                    });


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

    <script src="select2.min.js">
        $("#Data").select2( {
            placeholder: "Select Country",
            allowClear: true
        });
    </script>

    <?php include "Sidebar.php"; ?>
    
    <section class="home-section">
        <form action="Time_Tables.php" method="post" enctype="multipart/form-data">
            <div class="Item">
                <div class="Header">
                    <table>
                        <tr>
                            <th><h1 class="Page">Timetable</h1></th>

                            <th>
                                <a href="Time_Tables.php?New">
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
                            $Rows		= mysqli_fetch_array(Multi_Select("*","Timetable","ID",$_SESSION['Update']));
                        }
                        else
                        {
                    ?>

                        <div class="Input_Field">
                            <label>Depature</label>

                            <input type="text" name="txtDeparture" class="Input" required />								
                        </div>			

                        <div class="Input_Field">
                            <label>Arrival</label>

                            <input type="text" name="txtArrival" class="Input" required />								
                        </div>
                        
                    <?php
                        }

                    ?>

                    <div class="Input_Field">
                        <label>Time</label>

                        <?php 
                            if (isset($_REQUEST['Update'])) 
                            {
                                echo "<input type='Time' name='txtTime' value='" . $Rows['Time'] . "' class='Input' required>";
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
                                $result	= Single_Select("*","Timetable");
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
                                            echo "<td>" . $rows['Departure'] . "</td>";
                                            echo("<td>" . $rows["Arrival"] . "</td>");
                                            echo("<td>" . $rows["Time"] . "</td>");
                                            echo("<td>
                                                    <a href='Time_Tables.php?New&&Update=$ID'><i class='fas fa-pencil-alt'></i></a>
                                                    |
                                                    <a href='Time_Tables.php?Delete=$ID'><i class='far fa-trash-alt'></i></a>
                                                </td>");
                                            echo "</tr>";
                                        }
                                        else
                                        {
                                            echo "<tr>";
                                            echo "<td>" . $ID . "</td>";
                                            echo("<td>" . $rows["Departure"] . "</td>");
                                            echo("<td>" . $rows["Arrival"] . "</td>");
                                            echo("<td>" . $rows["Time"] . "</td>");
                                            echo("<td>
                                                    <a href='Time_Tables.php?New&&Update=$ID'><i class='fas fa-pencil-alt'></i></a>
                                                    |
                                                    <a href='Time_Tables.php?Delete=$ID'><i class='far fa-trash-alt'></i></a>
                                                </td>");
                                            echo "</tr>";
                                        }
                                    }
                                    else
                                    {
                                        echo "<tr>";
                                        echo "<td>" . $ID . "</td>";
                                        echo "<td>" . $rows['Departure'] . "</td>";
                                        echo("<td>" . $rows["Arrival"] . "</td>");
                                        echo("<td>" . $rows["Time"] . "</td>");
                                        echo("<td>
                                                <a href='Time_Tables.php?New&&Update=$ID'><i class='fas fa-pencil-alt'></i></a>
                                                |
                                                <a href='Time_Tables.php?Delete=$ID'><i class='far fa-trash-alt'></i></a>
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
                                $result = Single_Select("*","Timetable");
                                $count	= mysqli_num_rows($result);

                                for ($i=0; $i < $count; $i++) 
                                { 
                                    $rows 	=	mysqli_fetch_array($result);
                                    $ID 	= 	$rows["ID"];


                                    echo("<tr>");
                                    echo("<td>" . $ID . "</td>");
                                    echo("<td>" . $rows["Departure"] . "</td>");
                                    echo("<td>" . $rows["Arrival"] . "</td>");
                                    echo("<td>" . $rows["Time"] . "</td>");
                                    echo("<td>
                                            <a href='Time_Tables.php?New&&Update=$ID' class='Link'>
                                                <button class='Link_Icon'><i class='fas fa-pencil-alt'></i></button>
                                                <input	type='button' class='Link_Text' value='Update'>
                                            </a>
                                            <a href='Time_Tables.php?Delete=$ID' class='Link'>
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

    <script src="select2.min.js"></script>
    <script>
    $("#Data").select2( {
        placeholder: "Choose",
        allowClear: true
        } );
    </script>

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
