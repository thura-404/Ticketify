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

		if (Delete_Data("Employee","ID",$Delete)) 
		{
			echo "<script>window.alert('Employee Successfully Deleted.')</script>";
			echo "<script>window.location='Employee.php'</script>";
		}
		else
		{
			echo "<script>window.alert('Error >> " . mysqli_error($connection) . " <<')</script>";
			echo "<script>window.location='Employee.php'</script>";
		}
	}

	if (isset($_POST['btnSave']))
	{
		$ID 		= Max_ID("ID","Employee");
		$Name		= $_POST['txtName'];
		$Father		= $_POST['txtFather'];
		$Mother		= $_POST['txtMother'];
		$Gender		= $_POST['cboGender'];
		$Marital	= $_POST['cboMarital'];
		$Birthday	= $_POST['txtBirthday'];
		$Password	= $_POST['txtPassword'];
		$Phone		= $_POST['txtPhone'];
		$Email		= $_POST['txtEmail'];
		$Role		= $_POST['cboRole'];
		$Address	= $_POST['txtAddress'];

		$NRC 		= $_POST['cboFirst'] . "/" . $_POST['cboSecond'] . $_POST['cboThird'] . $_POST['txtFourth'];
		

		$Photo		= "StaffPhotos/" . $ID . "_" . $Name .".png";


		if (!copy($_FILES['filPhoto']['tmp_name'], $Photo)) 
		{
			echo "<script>window.alert('Error Uploading Photo!')</script>";
			echo "<script>window.location='Employee.php'</script>";
		}
		else
		{
			if (Insert_Data("Employee",
							"(ID, Name, Father, Mother, Gender, Marital, Birthday, Password, Ph, Email, Position, NRC, Address, Reg_Date, Photo)",
							"('$ID', '$Name', '$Father', '$Mother', '$Gender', '$Marital', '$Birthday', '$Password', '$Phone', '$Email', '$Role', '$NRC', '$Address', '" . date("Y/m/d") . "', '$Photo')"))
			{
				echo "<script>window.alert('Employee Successfully Saved.')</script>";
				echo "<script>window.location='Employee.php'</script>";	
			}
			else
			{
				echo "<script>window.alert('Error >>" . mysqli_error($connection) . "<<')</script>";
				echo "<script>window.location='Employee.php'</script>";
			}
		}
	}

    if (isset($_POST['btnUpdate'])) 
    {
        $Phone      = $_POST['txtPhone'];
        $Email      = $_POST['txtEmail'];
        $Role       = $_POST['cboRole'];
        $Address    = $_POST['txtAddress'];

        if(mysqli_num_rows(Match_Data("*", "Employee", "Email", $Email, "AND NOT", "ID", $_SESSION['Update'])) > 0)
        {
            echo "<script>window.alert('ALert : Employee with the same email already exists!')</script>";
            echo "<script>window.location='Employee.php'</script>";
        }
        else
        {
            if(Update_Data("Employee", "Ph = '$Phone', Email = '$Email', Position = '$Role', Address = '$Address'", "ID", $_SESSION['Update']))
            {
                echo "<script>window.alert('ALert : Employee details successfully updated.')</script>";
                echo "<script>window.location='Employee.php'</script>";
                unset($_SESSION['Update']);
            }
            else
            {
                echo "<script>window.alert('Error : Please try again later!')</script>";
                header($_SERVER['REQUEST_URI']);
            }
        }

    }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="New.css">
        <link rel="stylesheet" href="select2.min.css" />
        <link rel="stylesheet" href="select2.min.js" />
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
        <form action="Purchase.php" method="post" enctype="multipart/form-data">
            <div class="Item">
                <div class="Header">
                    <table>
                        <tr>
                            <th><h1 class="Page">Confirm Ticket</h1></th>
                            <th></th>
                        </tr>
                    </table>
                </div>

                
                <div class="Records">
                    <table id="tableid" class="display">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Customer</th>
                            <th>Trip</th>
                            <th>Operator Bus</th>
                            <th>Seats</th>
                            <th>Time</th>
                            <th>Date</th>
                        </tr>
                    </thead>

                    <tbody>
                    
                        <?php 
                            $result = Single_Select("p.ID,
                                                    p.Customer,
                                                    CONCAT(d.Name, ' to ', a.Name) AS Route,
                                                    CONCAT(o.Name, ' , ', b.Type) AS Operator_Bus,
                                                    GROUP_CONCAT(r.Seat ORDER BY r.Seat ASC SEPARATOR ', ') AS Seats,
                                                    t.DTime,
                                                    p.Date","Purchase p
                                                    JOIN Ticket ti ON p.TicketID = ti.ID
                                                    JOIN Trip t ON ti.TripID = t.ID
                                                    JOIN Bus b ON ti.BusID = b.ID
                                                    JOIN Operator o ON ti.OperatorID = o.ID
                                                    JOIN City d ON t.DCity = d.ID
                                                    JOIN City a ON t.ACity = a.ID
                                                    JOIN Record r ON p.ID = r.ID
                                                    GROUP BY p.ID;");
                            $count	= mysqli_num_rows($result);

                            for ($i=0; $i < $count; $i++) 
                            { 
                                $rows 	=	mysqli_fetch_array($result);
                                $ID 	= 	$rows["ID"];


                                echo("<tr>");
                                echo("<td>" . $ID . "</td>");
                                echo("<td>" . $rows["Customer"] . "</td>");
                                echo("<td>" . $rows["Route"] . "</td>");
                                echo("<td>" . $rows["Operator_Bus"] . "</td>");
                                echo("<td>" . $rows["Seats"] . "</td>");
                                echo("<td>" . date("g:i A", strtotime($rows["DTime"])) . "</td>");
                                echo("<td>" . $rows["Date"] . "</td>");
                                echo("</tr>");
                                }
                        ?>
                            
                        </tbody>
                    </table>	
                </div>					
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
