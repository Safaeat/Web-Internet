<?php 
echo "<head>
<style>
  /* Add a black background color to the top navigation */
.topnav {
background-color: #333;
overflow: hidden;
margine: 0px;
}

/* Style the links inside the navigation bar */
.topnav a {
float: left;
color: #f2f2f2;
text-align: center;
padding: 14px 16px;
text-decoration: none;
font-size: 17px;
}

/* Change the color of links on hover */
.topnav a:hover {
background-color: #ddd;
color: black;
}

/* Add a color to the active/current link */
.topnav a.active {
background-color: #04AA6D;
color: white;
}
</style>
</head>
<body>
<h1 style=\"font-family:arial\">StockFlow</h1>
<div class=\"topnav\">
  <a href=\"../stock/stock_list.php\">Stock list</a>
  <a href=\"../stock/stock_out_list.php\">Stock Out</a>
  <a href=\"../buy/buy_product.php\">Buy products</a>
  <a href=\"../sell/sell.php\">Sell products</a>
  <a href=\"../analysis/demand_analysis.php\">Analysis</a>
  <a href=\"../analysis/cashflow_analysis.php\">Cashflow</a>
  <a href=\"../index.html\">Log Out</a>
</div>
</body>
";

?>