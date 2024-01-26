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

// Check if the form in sell.php was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the sold products data
    $productNames = $_POST['productName'];
    $quantities = $_POST['quantity'];

    // Sell each product and update the stock
    for ($i = 0; $i < count($productNames); $i++) {
        $productName = $conn->real_escape_string($productNames[$i]);
        $quantity = intval($quantities[$i]);

        // Update the stock by subtracting the sold quantity and adjusting the space
        $updateStockQuery = "UPDATE stock SET 
            quantity = GREATEST(quantity - $quantity, 0),
            space = GREATEST(space - space, 0),
            price = price
        WHERE productName = '$productName'";
        $conn->query($updateStockQuery) or die("Error updating stock record: " . $conn->error);

        // Insert the sold product into the sold_products table
        $insertSoldProductQuery = "INSERT INTO sold_products (productName, quantity) VALUES ('$productName', $quantity)";
        $conn->query($insertSoldProductQuery) or die("Error inserting sold product record: " . $conn->error);
    }

    echo '<script type="text/javascript">window.onload = function () { alert("Products Successfully Sold."); } </script>';
}

// Retrieve the current stock information
$stockQuery = "SELECT productName, price, space, quantity FROM stock";
$stockResult = $conn->query($stockQuery);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StockFlow Inventory Management ltd.</title>
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
    <h2>Buy Information</h2>

    <!-- Display product details in the table -->
    <table>
        <tr>
            <th>Product Name</th>
            <th>Price</th>
            <th>Space</th>
            <th>Quantity Available</th>
        </tr>
        <?php
        if ($stockResult->num_rows > 0) {
            while ($row = $stockResult->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row['productName'] . '</td>';
                echo '<td>' . $row['price'] . '</td>';
                echo '<td>' . $row['space'] . '</td>';
                echo '<td>' . $row['quantity'] . '</td>';
                echo '</tr>';
            }
        } else {
            echo '<tr><td colspan="4">No products available in buy.</td></tr>';
        }
        ?>
    </table>

    <div id="sell-button">
        <center><br>
            <a href="../buy/buy_product.php"><button class="btn">Buy More</button></a>
        </center>
    </div>
</body>

</html>

<?php
// Close the database connection
$conn->close();
?>
