<?php
session_start();
include "mysqlconn.php";
include 'category.php';
?>
<html>
<head>
<title>Contact us</title>
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
                <td><a href="contact.php">Contact us</a></td>
                <td><div id="shopping_cart">
<?php
cart();
if(isset($_SESSION['login_name'])){
    echo 'Login as ';
    loggeduser();
    echo "
    <a href='logout.php'>logout</a><br>";

?>
                        &nbsp;<b style="color: green">Shopping Cart - </b>Total Item:<?php totalitems(); ?>   
                        &nbsp;<a href="cart.php">Go to Cart</a>
<?php }else  {  echo "Welcome guest! &nbsp;&nbsp;<a href='login.php'>login</a>";} ?>                    
                    </div></td>
              </tr>
                  </table>
        </div>
    </div>
        
        <html>
            <head></head>
            <body>
                <h4>Sourav Saha</h4>
                <p class="para1">Contact number: 01731828299<br> Email-id: rocking.sourav99@gmail.com</p>
                <h3>Farzana Meher</h3>
                <p class="para2">Contact number: 01768516162 <br> Email-id: meher.farzana19@gmail.com
                 </p>
                <h4>Momin Shohag</h4>
                <p class="para3">Contact number: 01620708746<br> Emai-id: asamomin@gmail.com</p>
                <h5>Fariah Rashid</h5>
                <p class="para4">Contact number: 01679223797<br> Email-id: fariahrashid06@gmail.com</p>
                
            <style>
h6{
    color:#036;
    text-decoration:underline;
    font-style:italic;
    font-family:serif;
    font-size:150%;
    

}
h3{
    color:#c95145;
    font-family:serif;
    font-style:italic;
    text-decoration:underline;
    text-align:center;
    font-size:150%;
    
}


h4{ 
    color:#036;
    text-decoration:underline;
    font-style:italic;
    font-family:serif;
    font-size:150%;
    line-height:2px;
}
h5{
    color:#c95145;
    text-decoration:underline;
    font-style:italic;
   font-family:serif;
   text-align:center;
    font-size:150%;
    line-height:.1px;
}
p.para1{
    color:#444;
    font-family:Times New Roman;
    font-size:20px;
    
}


p.para2{
    color:#444;
    font-family:Times New Roman;
    font-size:20px;
    margin-left:420px;
    
    
}p.para3{
    color:#444;
    font-family:Times New Roman;
    font-size:20px;
    
}
p.para4{
    color:#444;
    font-family:Times New Roman;
    font-size:20px;
    margin-left:420px;
    

}

</style>

                    
                    
                 
