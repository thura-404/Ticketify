<div class="sidebar">
        <div class="logo-details">
                <div class="logo_name">Ticketify</div>
                <i class='bx bx-menu' id="btn" ></i>
        </div>


        <ul class="nav-list">
            
        <?php
        if(isset($Position))
        {
            if($Position['Position'] == "HR")
            {
        ?>
                <li>
                    <a href="Role.php">
                        <i class='bx bx-grid-alt'></i>
                        <span class="links_name">Role</span>
                    </a>
                    <span class="tooltip">Role</span>
                </li>

                <li>
                    <a href="Staff.php">
                        <i class='bx bx-user' ></i>
                        <span class="links_name">Staff</span>
                    </a>
                    <span class="tooltip">Staff</span>
                </li>
        <?php
            }
            elseif ($Position['Position'] == "Manager")
            {
        ?>

                <!--<li>
                    <i class='bx bx-search' ></i>
                    <input type="text" placeholder="Search...">
                    <span class="tooltip">Search</span>
                </li>-->

                <!-- <li>
                    <a href="Search.php">
                    <i class='bx bx-folder' ></i>
                        <span class="links_name">Search & Report</span>
                    </a>
                    <span class="tooltip">Search & Report</span>
                </li> -->

                <li>
                    <a href="Employee.php">
                        <i class='bx bx-user' ></i>
                        <span class="links_name">Employee</span>
                    </a>
                    <span class="tooltip">Employee</span>
                </li>
                
                <li>
                    <a href="City.php">
                    <i class='bx bxs-buildings'></i>
                        <span class="links_name">City</span>
                    </a>
                    <span class="tooltip">City</span>
                </li>

                <li>
                    <a href="Trip.php">
                    <i class='bx bx-trip' ></i>
                        <span class="links_name">Trip</span>
                    </a>
                    <span class="tooltip">Trip</span>
                </li>
                
                <li>
                    <a href="Bus.php">
                        <i class='bx bx-bus'></i>
                        <span class="links_name">Bus</span>
                    </a>
                    <span class="tooltip">Bus</span>
                </li>
                
                <li>
                    <a href="Operator.php">
                    <i class='bx bxs-user-badge'></i>
                        <span class="links_name">Operator</span>
                    </a>
                    <span class="tooltip">Operator</span>
                </li>

                <li>
                    <a href="Ticket.php">
                    <i class='bx bx-food-menu'></i>
                        <span class="links_name">Ticket</span>
                    </a>
                    <span class="tooltip">Ticket</span>
                </li>

                <li>
                    <a href="Purchase.php">
                        <i class='bx bxs-purchase-tag-alt'></i>
                        <span class="links_name">Purchase</span>
                    </a>
                    <span class="tooltip">Purchase</span>
                </li>

        <?php
            }
            elseif ($Position['Position'] == "Receptionist") 
            {
        ?>
                <li>
                    <a href="Search.php">
                    <i class='bx bx-folder' ></i>
                        <span class="links_name">Search & Report</span>
                    </a>
                    <span class="tooltip">Search & Report</span>
                </li>

                <li>
                    <a href="Product.php">
                        <i class='bx bx-heart' ></i>
                        <span class="links_name">Product</span>
                    </a>
                    <span class="tooltip">Product</span>
                </li>

                <li>
                    <a href="#">
                        <i class='bx bx-cog' ></i>
                        <span class="links_name">Setting</span>
                    </a>
                    <span class="tooltip">Setting</span>
                </li>
        <?php
            }
            elseif ($Position['Position'] == "Driver") {
        ?>
                <li>
                    <a href="Delivery.php">
                    <i class='bx bxs-truck'></i>
                        <span class="links_name">Delivery</span>
                    </a>
                    <span class="tooltip">Delivery</span>
                </li>

                <li>
                    <a href="#">
                        <i class='bx bx-cog' ></i>
                        <span class="links_name">Setting</span>
                    </a>
                    <span class="tooltip">Setting</span>
                </li>
        <?php
            }
        }
        ?>    
        

        <li class="profile">

        <?php
            if(isset($Position))        
            {
        ?>
            <div class="profile-details">
                <div class="name_job">
                    <div class="name"><?php echo $Position['Name'] ; ?></div>
                    <div class="job"><?php echo $Position['Position'] ; ?></div>
                </div>
            </div>
        <?php
            }
        ?>
            <form action="E_Login.php" method="post">
                <button class="submit" name="btnLogout"><i class='bx bx-log-out' id="log_out" ></i></button>
            </form>
            
        </li>

        </ul>
    </div>