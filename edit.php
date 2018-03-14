<?php
session_start();
include "mysqlconn.php";
include 'category.php';
if(isset($_SESSION['u_level'])){
?>
<html>
<head>
<title>edit product</title>
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
<?php if(isset($_SESSION['u_level'])){ ?> 
                <td><a href="admin.php">Admin Panel</a></td> <?php } ?>
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
            
<?php 
    	if (isset($_GET['edit'])) {
        $id=$_GET['edit'];
        global $mysqli;
        $query="SELECT * FROM product WHERE p_id='$id'";
        $res=mysqli_query($mysqli,$query);
       
        while ($row=mysqli_fetch_array($res)) {

     $pname=$row['p_name'];
     $subcat=$row['subcat'];
     $fabric=$row['fabric'];
     $color=$row['color'];
     $gender=$row['gender'];
     $wash=$row['wash_care'];
     $price=$row['price'];
     $p_image=$row['p_image'];
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

        }
}
      if (isset($_POST['submit'])) {
      $pid=$_GET['edit'];
      echo "ID".$pid ;
     $pname=$_POST['pname'];
     $subcat=$_POST['subcat'];
     $fabric=$_POST['fabric'];
     $color=$_POST['color'];
     $gender=$_POST['gender'];
     $wash=$_POST['wash'];
     $price=$_POST['price'];
     $image=$_POST['image'];
     $size1n=$_POST['size1n'];
     $size1q=$_POST['size1q'];
     $size2n=$_POST['size2n'];
     $size2q=$_POST['size2q'];
     $size3n=$_POST['size3n'];
     $size3q=$_POST['size3q'];
     $size4n=$_POST['size4n'];
     $size4q=$_POST['size4q'];
     $size5n=$_POST['size5n'];
     $size5q=$_POST['size5q'];
     $nosize=$_POST['nosize'];
     $totalquantity=$_POST['totalquantity'];
     
     global $mysqli;
      $sql="UPDATE product SET p_name='$pname',subcat='$subcat',fabric='$fabric',color='$color',gender='$gender',wash_care='$wash',price='$price',p_image='$image',size1name='$size1n',size1qty='$size1q',size2name='$size2n',size2qty='$size2q',size3name='$size3n',size3qty='$size3q',size4name='$size4n',size4qty='$size4q',size5name='$size5n',size5qty='$size5q',nosize='$nosize',totalquantity='$totalquantity' WHERE p_id='$pid'";
        $run1= mysqli_query($mysqli, $sql);
        if ($run1) {
               echo "&nbsp;Updated Successfully <a href='productlist.php'>click here to view product table</a>";
        //echo '<META HTTP-EQUIV="Refresh" Content="1; URL=productlist.php">';
} else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    
    }
      }

   
    ?>
          <h1>UPDATE PRODUCT DETAILS HERE</h1>
              <form action="" method="POST">

            <table align=left width=100% border=0 cellspacing=10 cellpadding=5 >
                <tr>
                    <td> Product Name:</td>
                    <td><input type="text" name="pname" value="<?php echo $pname; ?>"></td>
              </tr>
              <tr>
                  <td>Product Subcatagory:</td>
                  <td><input type="text" name="subcat" value="<?php echo $subcat; ?>"></td>
              </tr>
              
              <tr>
                  <td>Product Fabric:</td>
                  <td><input type="text" name="fabric" value="<?php echo $fabric; ?>"></td>
              </tr>
              <tr>
                  <td>Product Color:</td>
                  <td><input type="text" name="color" value="<?php echo $color; ?>"></td>
              </tr>
              <tr>
                  <td>Gender:</td>
                  <td><input type="text" name="gender" value="<?php echo $gender; ?>"></td>
              </tr>
              <tr>
                  <td>Product Wash Care:</td>
                  <td><input type="text" name="wash" value="<?php echo $wash; ?>"></td>
              </tr>
              <tr>
                  <td>Product Price:</td>
                <td><input type="text" name="price" value="<?php echo $price; ?>"></td>
              </tr>
              <tr>
                <td>Product Image:</td>
                <td><input type="text" name="image" value="<?php echo $p_image; ?>"></td>
              </tr>
              <tr>
                  <td>Total Quantity:</td>
                  <td><input type="text" name="totalquantity" value="<?php echo $totalquantity; ?>"></td>
              </tr>
              <tr>
                  <td>No Size:</td>
                  <td><input type="text" name="nosize" value="<?php echo $nosize; ?>"></td>
              </tr>
              
              <tr><td><b>If product have no size then ignore rest just submit</b></td></tr>
              <tr><td>
               Product Size1 Name:<br>
                <input type="text" name="size1n" value="<?php echo $size1n ?>">
              </td>
              <td>
                Quantity:<br>
                <input type="text" name="size1q"  style="width: 40px;" value="<?php echo $size1q ?>"></td>
              </tr>
              <tr>
                <td>Product Size2 Name:<br>
                <input type="text" name="size2n" value="<?php echo $size2n ?>">
                </td>
                <td>Quantity:<br>
                    <input type="text" name="size2q" style="width: 40px; " value="<?php echo $size2q ?>">
                </td>
              </tr>
              <tr><td>
                Product Size3 Name:<br>
                <input type="text" name="size3n" value="<?php echo $size3n ?>">
              </td>
              <td>
                Quantity:<br>
                <input type="text" name="size3q" style="width: 40px;" value="<?php echo $size3q ?>">
              </td></tr>
              <tr><td>
               Product Size4 Name:<br>
                <input type="text" name="size4n" value="<?php echo $size4n ?>">
              </td>
              <td>
                Quantity:<br>
                <input type="text" name="size4q" style="width: 40px; " value="<?php echo $size4q ?>">
              </td></tr>
              <tr><td>
                Product Size5 Name:<br>
                <input type="text" name="size5n" value="<?php echo $size5n ?>">
                  </td>
                  <td>
                Quantity:<br>
                <input type="text" name="size5q" style="width: 40px; " value="<?php echo $size5q ?>" >
                  </td></tr>

              <tr><td> <input type="submit" name="submit" value="Submit"></td></tr> </table>  
              </form>           

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

