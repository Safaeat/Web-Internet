<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StockFlow|User Login</title>
    <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      padding: 0;
   }

   .container {
      width: 20%;
      margin: 0 auto;
      background-color: #fff;
      padding: 8px;
      margin-top: 50px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
   }

    h2 {
      text-align: center;
      color: #333;
   }

   form {
      max-width: 200px;
      margin: 0 auto;
   }

   label {
      display: block;
      margin-bottom: 8px;
      color: #333;
   }

   input {
      width: 100%;
      padding: 10px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
   }

   select {
      width: 100%;
      padding: 10px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
   }

   #registration_number_field {
      display: none;
   }

   input[type="submit"] {
      background-color: #4caf50;
      color: #fff;
      padding: 10px 15px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
   }

   input[type="submit"]:hover {
      background-color: #45a049;
   }

   .error {
      color: #ff0000;
      margin-top: 10px;
   }
   </style>

</head>
<body>
    <nav><center>
        <h1>StockFlow Inventory Management Ltd.</h1>
    </center>
    </nav>
    <h2>User Login</h2>
    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <label for="username">Username:</label>
        <input type="text" name="username" required><br>

        <label for="password">Password:</label>
        <input type="password" name="password" required autocomplete="off"><br>

        <label for="user_type">User Type:</label>
        <select name="user_type" id="user_type" required>
            <option value="" disabled selected>Choose an option</option>
            <option value="shop_owner">Shop Owner</option>
            <option value="buyer">Buyer</option>
        </select><br>

        <!-- Conditionally show the registration number field based on the selected user type -->
        <div id="registration_number_field" style="display: none;">
            <label for="registration_number">Registration Number:</label>
            <input type="text" name="registration_number">
        </div>

        <script>
            // JavaScript to show/hide the registration number field based on the selected user type
            document.getElementById('user_type').addEventListener('change', function() {
                var registrationField = document.getElementById('registration_number_field');
                registrationField.style.display = (this.value === 'shop_owner') ? 'block' : 'none';
            });
        </script>

        <input type="submit" value="Login">
    </form>

    <?php
    // Database connection details
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "ims";

    // Establishing the connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST["username"];
        $password = $_POST["password"];
        $userType = $_POST["user_type"];

        // Query to check if the user exists
        $sql = "SELECT * FROM reg WHERE Name='$username' AND Type='$userType'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            // Verify password
            if (password_verify($password, $row["Password"])) {
                // If the user is a shop owner, check registration number
                if ($userType === "shop_owner") {
                    $enteredRegistrationNumber = $_POST["registration_number"];
                    if ($enteredRegistrationNumber == $row["Registration"]) {
                        $_SESSION["username"] = $username;
                        echo "Login successful! Welcome, $username!";
                        echo '<script type="text/javascript">window.onload = function () { window.location.href = "../buy/buy_product.php"; } </script>';
                        exit();
                    } else {
                        echo "Invalid registration number for Shop Owner.";
                    }
                } else {
                    // For buyers, no need to check registration number
                    $_SESSION["username"] = $username;
                    echo '<script type="text/javascript">window.onload = function () { alert("Login successful! Welcome Back!"); } </script>';
                    echo '<script type="text/javascript">window.onload = function () { alert("Login successful! Welcome Back!"); window.location.href = "../user/index.html"; } </script>';
                    exit();
                    
                }
            } else {
                echo '<script type="text/javascript">window.onload = function () { alert("Invalid password."); } </script>';
            }
        } else {
            echo '<script type="text/javascript">window.onload = function () { alert("User not found."); } </script>';
        }
    }

    // Close the database connection
    $conn->close();
    ?>
</body>
</html>
