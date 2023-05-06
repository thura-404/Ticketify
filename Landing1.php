<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bus Ticket Reservation System</title>
    <link rel="stylesheet" href="Landing.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="Landing.js"></script>
</head>
<body>
    <header class="header">
        <nav class="navbar">
            <div class="navbar__logo">
                <a href="#" class="logo">Bus Ticket Reservation</a>
            </div>
            <ul class="navbar__menu">
                <li><a href="#home">Home</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#services">Services</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
            <div class="navbar__toggle">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>
        </nav>
        <div class="hero">
            <h1>Book Your Bus Tickets Now</h1>
            <p>Travel in comfort and style with our bus reservation system</p>
            <a href="#booking" class="btn">Book Now</a>
        </div>
    </header>
    <section id="home">
        <div class="container">
            <h2>Welcome to Our Bus Reservation System</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed consequat arcu sed lorem facilisis, at ultrices massa dictum. Donec iaculis diam sit amet enim faucibus, vel tincidunt velit ultricies.</p>
        </div>
    </section>
    <section id="about">
        <div class="container">
            <h2>About Us</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed consequat arcu sed lorem facilisis, at ultrices massa dictum. Donec iaculis diam sit amet enim faucibus, vel tincidunt velit ultricies.</p>
        </div>
    </section>
    <section id="services">
        <div class="container">
            <h2>Our Services</h2>
            <ul>
                <li>Comfortable and spacious seating</li>
                <li>On-time departures and arrivals</li>
                <li>Friendly and professional staff</li>
                <li>Free Wi-Fi and entertainment systems</li>
            </ul>
        </div>
    </section>
    <section id="contact">
        <div class="container">
            <h2>Contact Us</h2>
            <form>
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>

                <label for="message">Message:</label>
                <textarea id="message" name="message" required></textarea>

                <button type="submit">Send</button>
            </form>
        </div>
    </section>
    <section id="booking">
    <div class="container">
        <h2>Book Your Bus Tickets</h2>
        <form method="POST" action="book.php">
            <div class="form-group">
                <label for="from">From:</label>
                <input type="text" id="from" name="from" required>
            </div>
            <div class="form-group">
                <label for="to">To:</label>
                <input type="text" id="to" name="to" required>
            </div>
            <div class="form-group">
                <label for="date">Date:</label>
                <input type="date" id="date" name="date" required>
            </div>
            <div class="form-group">
                <label for="time">Time:</label>
                <input type="time" id="time" name="time" required>
            </div>
            <div class="form-group">
                <label for="seats">Number of seats:</label>
                <input type="number" id="seats" name="seats" required>
            </div>
            <div class="form-group">
                <button type="submit" class="btn">Book Now</button>
            </div>
        </form>
    </div>
</section>

