<?php
include('../config/constants.php');
include('../user/bootstrap_headder.php');

// Assuming $conn is your database connection

$errors = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone_number']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    // Validate name
    if (empty($name)) {
        $errors[] = "Name is required";
    }

    // Validate email
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Valid email is required";
    }

    // Validate phone number
    if (empty($phone) || !preg_match("/^[0-9]{10}$/", $phone)) {
        $errors[] = "Valid 10-digit phone number is required";
    }

    // Validate message
    if (empty($message)) {
        $errors[] = "Message is required";
    }

    if (empty($errors)) {
        // If there are no errors, insert the data into the database
        $insertQuery = "INSERT INTO message(name, email, phone_number, message) VALUES ('$name', '$email', '$phone', '$message')";

        if (mysqli_query($conn, $insertQuery)) {
            // Successful insertion
            header('location: ' . siteurl);
            exit();
        } else {
            // Error in insertion
            echo "Error: " . mysqli_error($conn);
        }
    }
}
?>

<title>Contact Us</title>
<style>
  body {
    background-color: lavender;
    overflow: auto;
    margin: 0; /* Remove default margin */
  }

  .ct {
    margin-top: 5%;
  }

  .main {
    min-height: 100vh;
    overflow-y: auto;
  }

  h1 {
    text-align: center;
    font-size: 36px;
    font-family: "Lucida Sans", "Lucida Sans Regular", "Lucida Grande", "Lucida Sans Unicode", Geneva, Verdana, sans-serif;
  }

  .info {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    align-items: flex-start;
  }

  .information {
    padding: 0;
    left: 25px;
    position: relative;
    margin: 25px;
    margin-top: 150px;
  }

  .information h2,
  .information h3 {
    margin-bottom: 10px;
  }

  .form {
    width: 50%;
    margin: auto;
  }

  /* Form input fields */
  input[type="text"],
  input[type="email"],
  input[type="phone number"],
  textarea {
    width: 100%;
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 4px;
    resize: vertical;
    margin-bottom: 10px;
  }

  /* Form label */
  label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
  }

  /* Submit and Reset button container */
  .button-container {
    display: flex;
    justify-content: space-between;
  }

  /* Submit button */
  input[type="submit"],
  input[type="reset"] {
    width: 48%;
    padding: 12px;
    border-radius: 10px;
    cursor: pointer;
    margin-bottom: 10px;
  }

  /* Clear button on hover */
  input[type="submit"]:hover,
  input[type="reset"]:hover {
    background-color: #b73fc0;
  }

  /* Form group */
  .form-group::after {
    content: "";
    clear: both;
    display: table;
  }

  /* Form group label */
  .form-group label {
    float: left;
    width: 100%;
  }

  /* Form group input */
  .form-group input,
  ..form-group textarea {
    float: left;
    width: 100%;
  }

  .footer {
    background-color: #f2f2f2;
    padding: 20px;
    text-align: center;
    font-size: 16px;
    color: #555;
    height: 12vh;
    margin-top: auto; /* Align the footer to the bottom */
  }

  footer {
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
  }
</style>


</head>

<body>
  <?php
  include('navbar.php');
  ?>
  <div class="ct">

    <div class="main mt-3">
      <h1>Contact Us</h1>
      <div class="info">
        <div class="information">
          <h2>Information of Hotel</h2>
          <h3>Phonenumber: +977 9800000000</h3>
          <h3>Mobile number: +977 9800000000</h3>
          <h3>Email: orangehotel@gmail.com</h3>
          <h3>Location: Vyas-4, Damauli Tanahun</h3>
        </div>
        <div class="form">
          <h2>Any Queries? Let Us Know.</h2>
          <form action="#" method="post" onsubmit="return validateForm()">
            <div class="form-group">
              <label for="name">Name:</label>
              <input type="text" id="name" name="name" required placeholder="Enter your name" />
            </div>
            <div class="form-group">
              <label for="email">Email:</label>
              <input type="email" id="email" name="email" placeholder="abc@gmail.com" required />
            </div>
            <div class="form-group">
              <label for="phone_number">Phone Number:</label>
              <input type="phone number" id="phone_number" name="phone_number" placeholder="1234567890" required />
            </div>
            <div class="form-group">
              <label for="message">Message:</label>
              <textarea id="message" name="message" rows="5" required placeholder="Leave your message"></textarea>
            </div>
            <div class="button-container">
              <input type="reset" value="Cancel" class="btn btn-secondary" />
              <input type="submit" value="Submit" name= "submit" class="btn btn-primary" />
            </div>
          </form>
          
        </div>
      </div>
    </div>
  </div>
  <div class="footer">
    <footer>
      <p>&copy; 2023 hotel. All rights reserved.</p>
    </footer>
  </div>
</body>

</html>
