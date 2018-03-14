<?php
session_start();
include "mysqlconn.php";
include 'category.php';
if(isset($_SESSION['u_level'])){
?>
<html>
<head>
<title>insert new product</title>
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
                <li><a href="userlevel.php">Manager Members</a></li></table></div>
 <div id="caption">
            </div>  

        </div>
        
        <div id="mainbody">
            <center><p>Insert Product</p></center>
<form action="" method="POST">
      <table align=left width=100% border=0 cellspacing=10 cellpadding=5 >
                <tr>
                    <td> Product Name:</td>
                    <td><input type="text" name="pname" ></td>
              </tr>
              <tr>
        <td>Product Subcategory</td>
            <td><select name="subcat">
                <option>Select a subcategory</option>
                <?php
                
                $sql="SELECT * FROM subcategory";
                $result=mysqli_query($mysqli, $sql);
                while($row_brand=mysqli_fetch_array($result)){
                    $sc_id=$row_brand['sc_id'];
                    $sc_name=$row_brand['sc_name'];
                    echo "<option value='$sc_id'>$sc_name</option>";
                }
                ?>
            </select>
        </td>
    </tr>
              
              <tr>
                  <td>Product Fabric:</td>
                  <td><input type="text" name="fabric"></td>
              </tr>
              <tr>
                  <td>Product Color:</td>
                  <td><input type="text" name="color"></td>
              </tr>
              <tr>
                  <td>Gender:</td>
                  <td><input type="text" name="gender" ></td>
              </tr>
              <tr>
                  <td>Product Wash Care:</td>
                  <td><input type="text" name="wash"></td>
              </tr>
              <tr>
                  <td>Product Price:</td>
                <td><input type="text" name="price"></td>
              </tr>
              <tr>
                <td>Product Image:</td>
                <td><input type="file" name="image" ></td>
              </tr>
              <tr>
                  <td>Total Quantity:</td>
                  <td><input type="text" name="totalquantity" ></td>
              </tr>
              <tr>
                  <td>No Size:</td>
                  <td><input type="checkbox" name="nosize" value="1"></td>
              </tr>
              
              <tr><td><b>If product have no size then ignore rest just submit</b></td></tr>
              <tr><td>
               Product Size1 Name:<br>
                <input type="text" name="size1n" placeholder="S or 30">
              </td>
              <td>
                Quantity:<br>
                <input type="text" name="size1q"  style="width: 40px; "></td>
              </tr>
              <tr>
                <td>Product Size2 Name:<br>
                <input type="text" name="size2n" placeholder="M or 32">
                </td>
                <td>Quantity:<br>
                    <input type="text" name="size2q" style="width: 40px; ">
                </td>
              </tr>
              <tr><td>
                Product Size3 Name:<br>
                <input type="text" name="size3n" placeholder="L or 34">
              </td>
              <td>
                Quantity:<br>
                <input type="text" name="size3q" style="width: 40px; ">
              </td></tr>
              <tr><td>
               Product Size4 Name:<br>
                <input type="text" name="size4n" placeholder="XL or 36">
              </td>
              <td>
                Quantity:<br>
                <input type="text" name="size4q" style="width: 40px; ">
              </td></tr>
              <tr><td>
                Product Size5 Name:<br>
                <input type="text" name="size5n" placeholder="XXL or 38">
                  </td>
                  <td>
                Quantity:<br>
                <input type="text" name="size5q" style="width: 40px; " >
                  </td></tr>

              <tr><td> <input type="submit" name="submit" value="Submit"></td></tr> </table>  

      </form>
<?php
if(isset($_POST['submit'])){
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
      
       if(empty($pname) || empty($subcat)||empty($fabric)||empty($color)||empty($gender)||empty($price)||empty($image)||empty($totalquantity)) {
          echo "Please enter all  data";
      
    }
      else{
          global $mysqli;
      	 $sql="INSERT into product (p_name,subcat,fabric,color,gender,wash_care,price,p_image,size1name,size1qty,size2name,size2qty,size3name,size3qty,size4name,size4qty,size5name,size5qty,nosize,totalquantity)values('$pname','$subcat','$fabric','$color','$gender','$wash','$price','$image','$size1n','$size1q','$size2n','$size2q','$size3n','$size3q','$size4n','$size4q','$size5n','$size5q','$nosize','$totalquantity')";

      	  if ($mysqli->query($sql) === TRUE) {
        echo "New product inserted successfully <a href='productlist.php'>click here to view product table</a>";
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

