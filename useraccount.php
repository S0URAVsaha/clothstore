<?php
session_start();
include "mysqlconn.php";
include 'category.php';
?>
<html>
<head>
<title>home</title>
<link rel="stylesheet" type="text/css" href="style.css"/>
</head>
<body>
    <div id="container">
    <div id="header">
        <h2><i>&nbsp;fashionista</i></h2>
        <div class="menu">
                  <table class="menu">
              <tr>
                <td><a href="home.php">Home</a></td>
                <td><a href="contact.php">Contact</a></td>
                <td valign="center" align="right" >
                    <form action="search.php" method="post" >
              <div class="container-1">
                  <input type="text" name="search" placeholder="Search a Product" size="40" required/>
                <input type="submit" name="src" value="Search" />
              </div>
            </form>
                </td>
                <td><div id="shopping_cart">
<?php
if(isset($_SESSION['login_name'])){
    echo 'Login as ';
    loggeduser();
    echo "
    <a href='logout.php'>logout</a><br>";

?>
                        &nbsp;<b style="color: green">Shopping Cart - </b>Total Item:<?php totalitems(); ?>
                        &nbsp;<a href="cart.php">Go to Cart</a>
<?php }else  {  echo "Welcome guest! &nbsp;&nbsp;<a href='login.php'>login here</a>";} ?>                    
                    </div></td>
              </tr>
                  </table>
        </div>
    </div>
        <div id="leftmargin">
            <center><h3>Category</h3></center> 
            <div id="maincat">
<?php
maincategory();
?>
            </div>
 <div id="caption">
<?php
if(isset($_GET["cat"])){
    subcategory();
}else{}

?>
            </div>  

        </div>
        
        <div id="mainbody">
            <center><div style="color: red;"><h2>Thank You For Your Order. We will get you SOON!</h2></div>
                <button  style=" border-style: dotted; font-size: 12px; width:150px; height:25px; background-color:gainsboro;"><a href="home.php" style=" text-decoration: none; color:black;">Continue Shopping</a></button>
</center>
<?php

?>

        </div>   
</body>
<div id="footer"></div>
</div>
</html>

