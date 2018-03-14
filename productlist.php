<?php
session_start();
include "mysqlconn.php";
include 'category.php';
if(isset($_SESSION['u_level'])){
?>
<html>
<head>
<title>view all product</title>
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
            <center><p>Product detail</p></center>
<?php 
     if (isset($_GET['delete'])) {
     	$d_id=$_GET['delete'];
     	
        global $mysqli;
     	$dlt="DELETE FROM product WHERE p_id='$d_id'";
     	 if ($mysqli->query($dlt) === TRUE) {
               ?>
               <script>var ret=window.confirm('Delete Successfull'); if (ret==true) {
                 window.location.replace('productlist.php');}
               </script> <?php 
         }     

}

 ?>
            <?php 
global $mysqli;
$sql= "SELECT*FROM product ";

$res = mysqli_query($mysqli,$sql);

	while ($row = mysqli_fetch_array($res)) {

		$pid=$row['p_id'];
		$pname=$row['p_name'];
		$subcat=$row['subcat'];
     $fabric=$row['fabric'];
     $color=$row['color'];
     $gender=$row['gender'];
     $wash=$row['wash_care'];
     $price=$row['price'];
     $image=$row['p_image'];
     $size1n=$row['size1name'];
     $size1q=$row['size1qty'];
     $size2n=$row['size2name'];
     $size2q=$row['size2qty'];
     $size3n=$row['size3name'];
     $size3q=$row['size3qty'];
     $size4n=$row['size4name'];
     $size4q=$row['size4qty'];
     $size5n=$row['size5name'];
     $size5q=$row['size5qty'];
     $nosize=$row['nosize'];
     $totalquantity=$row['totalquantity'];
     ?>
               <details><summary><?php echo $pname; ?> <i><u><?php  if($totalquantity<10){ echo" <mark>$totalquantity  Product left</mark>"; }else {echo" <b>$totalquantity</b> Product left";}?></u></i></summary><form action="" method="post">
                <table align="center" width="820" bgcolor="#FFF0F5" border=0 cellspacing=2 cellpadding=4>
                    <tr>
                        <td><b><u>ProductID: <?php echo $pid; ?></u></b>
                        <li>Product Name: <?php echo $pname; ?></li>
                        <li>sub Catagory: <?php echo $subcat; ?></li>
                        <li>Fabric: <?php echo $fabric; ?></li>
                        <li>Color: <?php echo $color; ?></li>
                        <li>Gender: <?php echo $gender; ?></li>
                        <li>Wash Care: <?php echo $wash; ?></li>
                        <li>Price: <?php echo $price; ?></li>
                        <li>Image: <?php echo $image; ?></li>
                        <li>Total Quantity: <?php echo $totalquantity; ?></li></td><td></td>
                        <td><li>Size1name: <?php echo $size1n; ?></li>
                        <li>Size1Qty: <?php echo $size1q; ?></li>
                        <li>Size2name: <?php echo $size2n; ?></li>
                        <li>Size2Qty: <?php echo $size2q; ?></li>
                        <li>Size3name: <?php echo $size3n; ?></li>
                        <li>Size3Qty: <?php echo $size3q; ?></li>
                        <li>Size4name: <?php echo $size4n; ?></li>
                        <li>Size4Qty: <?php echo $size4q; ?></li>
                        <li>Size5name: <?php echo $size5n; ?></li>
                        <li>Size5Qty: <?php echo $size5q; ?></li>
                        <li>No Size: <?php echo $nosize; ?></li>
                        </td>
                        </tr></table></form></details>
		
<?php		echo ("<a href='edit.php?edit=$pid'>Edit</a>");
                echo ("&nbsp;&nbsp;<a href='?delete=$pid'>delete</a>");
		
		echo "<br>";
        echo "<br>";
         
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

