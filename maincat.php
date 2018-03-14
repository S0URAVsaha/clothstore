<?php
session_start();
include "mysqlconn.php";
include 'category.php';
if(isset($_SESSION['u_level'])){
?>
<html>
<head>
<title>insert maincategory</title>
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
<?php if(isset($_SESSION['u_level'])){ ?> <td><a href="admin.php">Admin Panel</a></td> <?php } ?>
                <td><div id="shopping_cart">
<?php
if(isset($_SESSION['login_name'])){
    echo 'Login as ';
    loggeduser();
    echo "
    <a href='logout.php'>logout</a><br>";
}
?>
                                          
                    </div></td>
              </tr>
                  </table>
        </div>
    </div>
<div id="leftmargin">
            <center><h3>Category</h3></center> 
            <div id="maincat">
                <table>
                    <li><a href="admin.php">Admin Panel</a></li>
                 <li><a href="maincat.php">insert New category</a></li>
                 <li><a href="subcat.php">insert New subcategory</a></li>
                <li><a href="insert.php">insert New Product</a></li>
                <li><a href="productlist.php">Show all Product</a></li>
                <li><a href="delivery.php">Show all Delivery</a></li>
                <li><a href="userlevel.php">Manager Members</a></li></table>
            </div>
 <div id="caption">
            </div>  

        </div>
        
        <div id="mainbody">
            <center><p>Insert main category</p></center>
<form action="" method="POST">
      <table align=left width=100% border=0 cellspacing=10 cellpadding=5 >
                <tr>
                    <td>Main Category Name:</td>
                    <td><input type="text" name="cname" ></td>
          <td> <input type="submit" name="submit" value="Submit"></td></tr> </table> 
              </form>
        </div>   
<?php

if(isset($_POST['submit'])){
     $cname=$_POST['cname'];
     
    if(empty($cname)) {
          echo "Please enter category name";
      
    }
    else{
          global $mysqli;
      	 $sql="INSERT into maincategory(mc_name)values('$cname')";

      	  if ($mysqli->query($sql) === TRUE) {
        echo "New category inserted successfully <a href='home.php'>click here to view home</a>";
        //echo '<META HTTP-EQUIV="Refresh" Content="1; URL=productlist.php">';
} else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    
    }
      }

$mysqli->close();

      }
    ?>
        </div>
<?php  
}else{
    echo 'Restricted';
}
 ?>
</body>
<div id="footer"></div>
</div>
</html>


