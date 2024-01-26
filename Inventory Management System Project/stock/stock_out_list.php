<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ims";
include("../nav/navBar.php");

// Create a connection to the MySQL database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve products with quantity less than 5
$lowStockQuery = "SELECT id, productName, quantity FROM stock WHERE quantity < 5";
$lowStockResult = $conn->query($lowStockQuery);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Low Stock Products</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        .btn {
            background-color: green;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <h2>Low Stock Products (Quantity < 5)</h2>

    <!-- Display low stock product details in the table -->
    <table>
        <tr>
            <th>Product Name</th>
            <th>Quantity</th>
        </tr>
        <?php
        if ($lowStockResult->num_rows > 0) {
            while ($row = $lowStockResult->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['productName']}</td>
                        <td>{$row['quantity']}</td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='2'>No low stock products.</td></tr>";
        }
        ?>
    </table>

    <div id="back-button">
        <center><br>
            <a href="http://localhost/ims/buy/buy_product.php"><button class="btn">Buy Products</button></a>
        </center>
    </div>
</body>

</html>

<?php
// Close the database connection
$conn->close();
?>
