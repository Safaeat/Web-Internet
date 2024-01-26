<!DOCTYPE html>
<html lang="en">
<?php
include("../nav/navBar.php");
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
<h1>Demanded Product list</h1>
    <div style="padding-bottom: 100px;">
        <table style="border: 1px solid black;border-collapse: collapse;">
            <tr>
                <th style="padding-right: 150px;">name</th>
                <th style="padding-right: 150px;">price</th>
                <th style="padding-right: 50px;">quantity</th>
            </tr>
            <?php 
                $servername = "localhost";
                $username = "root"; 
                $password ="";  
                $dbname ="ims"; 
                
                $conn = new mysqli($servername,$username,$password,$dbname); 
                $SQLsw ="SELECT productName,price,quantity from sell_products ORDER BY quantity DESC"; 
                $res = $conn->query($SQLsw);
                foreach ($res as $row)
                {
                    echo"<tr>";
                    //echo $row['names']; 
                    echo "<td>".$row['productName']."</td>";
                    echo "<td>".$row['price']."</td>";
                    echo "<td>".$row['quantity']."</td>";
                    echo"</tr>";
                }
            ?>
        </table>
    </div>
    <div>
        <center><br>
            <a href="cashflow_analysis.php"><button class="btn">Cash flow analysis</button></a>
        </center>
    </div>
</body>
</html>