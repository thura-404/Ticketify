<!DOCTYPE html>
<html>
<head>
    <style>
        .seat {
            width: 2rem;
            height: 2rem;
            border: 1px solid black;
            display: inline-block;
            margin: 0.5rem;
        }
        .row {
            margin-bottom: 0.5rem;
        }
        .row:nth-child(2n) .seat:nth-child(2) {
            margin-right: 1rem;
        }

        .seat-select-box {
            background-color: #f1f1f1;
            padding: 1.25rem;
            border-radius: 0.3125rem;
            width: 37.5rem;
        }
        
        .seat-row {
            display: flex;
            align-items: center;
            margin-bottom: 0.625rem;
        }
        
        .seat {
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #fff;
            border-radius: 0.3125rem;
            margin-right: 0.625rem;
            width: 3.75rem;
            height: 3.75rem;
        }
        
        .seat-space {
            width: 1.25rem;
        }
        
        input[type="checkbox"] {
            display: none;
        }
        
        input[type="checkbox"]:checked + label {
            background-color: #6eb5ff;
            color: #fff;
        }
        
        label {
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        label:hover {
            background-color: #ddd;
        }
    </style>
</head>
<body>
    <?php
    session_start();
    if (isset($_POST['submit'])) {
        $_SESSION['selected_seats'] = $_POST['selected_seats'];
    }
    ?>
    <form method="post">

        <?php $seats = 0; for ($i = 1; $i <= 8; $i++): ?>
            <div class="seat-row">
                <?php  for ($j = 1; $j <= 3; $j++): ?>
                    <?php 
                        $seats++;
                        if ($j == 2)
                        {
                    ?>
                            <div class="seat">
                                <input type="checkbox" name="selected_seats[]" id="<?php echo $seats; ?>" value="<?php echo $seats; ?>">
                                <label for="<?php echo $seats; ?>"><?php echo $seats; ?></label>
                            </div>

                            <div class="seat-space"></div>
                    <?php
                        }
                        else
                        {
                    ?>
                            <div class="seat">
                                <input type="checkbox" name="selected_seats[]" id="<?php echo $seats; ?>" value="<?php echo $seats; ?>">
                                <label for="<?php echo $seats; ?>"><?php echo $seats; ?></label>
                            </div>
                    <?php
                        }
                    ?>
                <?php endfor; ?>
            </div>

        <?php endfor; ?>

        <input type="submit" name="submit" value="Save Selected Seats">
    </form>
</body>
</html>