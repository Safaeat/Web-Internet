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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect user input
    $name = $_POST["Name"];
    $age = $_POST["Age"];
    $password = password_hash($_POST["Password"], PASSWORD_DEFAULT); // Hashing the password for security
    $contactNumber = $_POST["Contact"];
    $userType = $_POST["Type"];
    $registrationNumber = '';

    // Check if the user type is 'shop_owner'
    if ($userType == 'shop_owner') {
        $registrationNumber = $_POST["Registration"];

        // SQL query to insert data into the users table
        $sql = "INSERT INTO reg (Name, Age, Password, Contact, Registration, Type) 
        VALUES ('$name', $age, '$password', '$contactNumber', '$registrationNumber', '$userType')";
    }else{
        // SQL query to insert data into the users table
        $sql = "INSERT INTO reg (Name, Age, Password, Contact, Type) 
        VALUES ('$name', $age, '$password', '$contactNumber', '$userType')";
    }

    if ($conn->query($sql) === TRUE) {
        echo '<script type="text/javascript">window.onload = function () { alert("Registration successful!"); } </script>';
    } else {
        echo '<script type="text/javascript">window.onload = function () { alert("Registration Unsuccessful!"); } </script>';
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

.container {
    width: 50%;
    margin: 0 auto;
    background-color: #fff;
    padding: 20px;
    margin-top: 50px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h2 {
    text-align: center;
    color: #333;
}

form {
    max-width: 400px;
    margin: 0 auto;
}

label {
    display: block;
    margin-bottom: 8px;
    color: #333;
}

input,
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
    <h2>User Registration</h2>
    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <label for="Name">Name:</label>
        <input type="text" name="Name" required><br>

        <label for="Age">Age:</label>
        <input type="number" name="Age" required><br>

        <label for="Password">Password:</label>
        <input type="password" name="Password" required autocomplete="off"><br>

        <label for="Contact">Contact Number:</label>
        <input type="text" name="Contact" required><br>

        <label for="Type">User Type:</label>
        <select name="Type" id="user_type" required>
            <option value="" disabled selected>Choose an option</option>
            <option value="shop_owner">Shop Owner</option>
            <option value="buyer">Buyer</option>
        </select><br>

        <!-- Conditionally show the registration number field based on the selected user type -->
        <div id="registration_number_field">
            <label for="Registration">Registration Number:</label>
            <input type="text" name="Registration">
        </div>

        <script>
            // JavaScript to show/hide the registration number field based on the selected user type
            document.getElementById('user_type').addEventListener('change', function() {
                var registrationField = document.getElementById('registration_number_field');
                registrationField.style.display = (this.value === 'shop_owner') ? 'block' : 'none';
            });

            // Initially check the user type and set the display accordingly
            var initialUserType = document.getElementById('user_type').value;
            var initialRegistrationField = document.getElementById('registration_number_field');
            initialRegistrationField.style.display = (initialUserType === 'shop_owner') ? 'block' : 'none';
        </script>

        <input type="submit" value="Register">
    </form>
</body>
</html>

