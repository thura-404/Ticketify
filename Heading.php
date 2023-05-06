<header class="Header">
			<a href="Home.php" class="Logo"><i class="fa-solid fa-ticket"></i> Ticketify</a>

			<nav class="Navbar">
				<a href="Home.php">Home</a>
			</nav>

			<div class="Icons">
				<div class="fas fa-user" id="Login_Btn"></div>
			</div>

			<form action="Home.php" class="Login_Form" method='post'>
                <?php
                    if (isset($_SESSION['User_ID'])) 
                    {
                ?>
                        <h3><?php echo $_SESSION['User_Name'] ?></h3>
                        <p><?php echo $_SESSION['User_Email'] ?></p>


                        <input type="submit" value="Logout" name="btnLogout" class="Btn">
                <?php
                    }
                    else
                    {
                ?>
                        <h3>Already a user?</h3>

                        <input type="submit" value="Login" name="btnLogin" class="Btn">
                <?php
                    }
                ?>
				
			</form>
		</header>