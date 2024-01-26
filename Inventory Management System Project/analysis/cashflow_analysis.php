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
<h1>Cash flow analysis</h1>
    <table>
        <tr>
            <th>Quarter</th>
            <th>Q1 of 2023</th>
            <th>Q2 of 2023</th>
            <th>Q3 of 2023</th>
            <th>Q4 of 2023</th>
        </tr>
        <tr>
            <th>Revenue</th>
            <td>$5,000</td>
            <td>$20,000</td>
            <td>$24,960</td>
            <td>$31,270</td>
        </tr>
        <tr>
            <th>Total cost</th>
            <td>$26,000</td>
            <td>$27,400</td>
            <td>$17,370</td>
            <td>$10,000</td>
        </tr>
        <tr>
            <th>Cash flow</th>
            <td>$-21,000</td>
            <td>$-7,400</td>
            <td>$7,590</td>
            <td>$21,270</td>
        </tr>
        <tr>
            <th>Cumulative Cashflow</th>
            <td>$-21,000</td>
            <td>$-28,400</td>
            <td>$-20,810</td>
            <td>$460</td>
        </tr>
    </table>
    <div>
        <center><br>
            <a href="demand_analysis.php"><button class="btn">Demand analysis</button></a>
        </center>
    </div>
</body>
</html>