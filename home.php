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
                <td align="right"><a href="contact.php">Contact</a></td>
                <?php if(isset($_SESSION['u_level'])){ ?> <td align="right"><a href="admin.php">Admin Panel</a></td> <?php } ?>
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
<?php }else  {  echo "Welcome guest! &nbsp;&nbsp;<a href='login.php' style='color:green;'>Login here</a>"
    . "&nbsp;&nbsp;<a href='signup.php'>(Register?)</a>";} ?>                    
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
            <center><p>Product</p></center>
<div id="">
<?php
if(isset($_GET["cat"])){
getproductbymaincategory();
}else{
if(isset($_GET["scat"])){
    getproductbysubcategory();
}else{

?>
    <div id="product_box">
<?php
    getproduct();
    cart();

    
//if($_GET['pcat']==true){    
    //header("Location: http://localhost/clothstore/clothstore/detail.php" );
//}
}}
?>
    </div>
    
            </div>

            
            <!--<div id="caption">Men wear</div>
            <div id="caption">Women wear</div>-->
        </div>   
</body>
<div id="footer"></div>
</div>
</html>

