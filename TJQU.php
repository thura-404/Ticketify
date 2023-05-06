<!DOCTYPE html>
<html>
  <head>
    <title>Available Bus Tickets</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
      /* CSS for responsive design */
      body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
      }
      .container {
        max-width: 70rem;
        margin: 0 auto;
        padding: 2rem;
      }
      .ticket {
        display: flex;
        flex-direction: row;
        margin: 1rem 0;
        background-color: #fff;
        border-radius: 0.5rem;
        box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,0.1);
      }
      .ticket .logo {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 20%;
        padding: 1rem;
        background-color: #f2f2f2;
        border-top-left-radius: 0.5rem;
        border-bottom-left-radius: 0.5rem;
      }
      .ticket .details {
        width: 60%;
        padding: 1rem;
      }
      .ticket .price {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 20%;
        padding: 1rem;
        font-weight: bold;
        font-size: 2.4rem;
        color: #1e90ff;
        border-top-right-radius: 0.5rem;
        border-bottom-right-radius: 0.5rem;
      }
      .ticket .details h3 {
        margin-top: 0;
        margin-bottom: 0.5rem;
        font-size: 1.8rem;
      }
      .ticket .details p {
        margin: 0;
        font-size: 1.6rem;
        color: #999;
      }
      .button {
        display: inline-flex;
        justify-content: center;
        align-items: center;
        background-color: #1e90ff;
        color: #fff;
        padding: 1rem 1.5rem;
        border-radius: 0.5rem;
        text-decoration: none;
        font-weight: bold;
        transition: background-color 0.3s ease;
      }
      .button:hover {
        background-color: #0077b3;
      }
      .button span {
        padding: 0 0.5rem;
        font-size: 1.6rem;
        text-align: center;
      }
    </style>
  </head>
  <body>
    <div class="container">
      <div class="ticket">
        <div class="logo">
          <img src="https://www.example.com/logo.png" alt="Bus Operator Logo" width="100">
        </div>
        <div class="details">
          <h3>Bus Operator Name</h3>
          <p>Departure Time: 9:00 AM</p>
          <p>Bus Type: AC</p>
          <p>Trip: Yangon to Mandalay</p>
        </div>
        <div class="price">$50</div>
          <a href="#" class="button"><span>Select Seats</span></a>
        </div>
        <!-- Repeat the above ticket div for each available ticket -->
      </div>
    </div>
  </body>
</html>