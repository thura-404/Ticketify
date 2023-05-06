<html>
<head>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 0 auto;
        }

        .header {
            background-color: #333;
            color: white;
            padding: 20px;
            text-align: center;
        }

        .header h1 {
            font-size: 36px;
        }

        .content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 40px;
        }

        .form {
            width: 60%;
            background-color: #f0f0f0;
            padding: 20px;
        }

        .form label {
            display: block;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .form input, .form select {
            display: block;
            width: 100%;
            height: 40px;
            border: 1px solid #ccc;
            margin-bottom: 20px;
        }

        .form button {
            display: block;
            width: 100%;
            height: 40px;
            background-color: #333;
            color: white;
            border: none;
            cursor: pointer;
        }

        .form button:hover {
            background-color: #444;
        }

        .image {
            width: 30%;
        }

        .image img {
            width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Bus Ticket Booking System</h1>
        </div>
        <div class="content">
            <div class="form">
                <form action="book.php" method="post">
                    <label for="from">From</label>
                    <input type="text" id="from" name="from" required>

                    <label for="to">To</label>
                    <input type="text" id="to" name="to" required>

                    <label for="date">Date</label>
                    <input type="date" id="date" name="date" required>

                    <label for="time">Time</label>
                    <select id="time" name="time" required>
                        <option value="">Select a time</option>
                        <option value="08:00">08:00</option>
                        <option value="10:00">10:00</option>
                        <option value="12:00">12:00</option>
                        <option value="14:00">14:00</option>
                        <option value="16:00">16:00</option>
                        <option value="18:00">18:00</option>
                    </select>

                    <button type="submit">Book Now</button>
                </form>
            </div>
            <div class="image">
                <img src="bus.jpg" alt="Bus image">
            </div>
        </div>
    </div>

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Custom script -->
    <script src="script.js"></script>
</body>
</html>