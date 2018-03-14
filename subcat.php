<?php
session_start();
include "mysqlconn.php";
include 'category.php';
//if(isset($_SESSION['u_level'])){
?>
<html>
<head>
<title>insert subcategory</title>
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
<?php //if(isset($_SESSION['u_level'])){ ?> <td><a href="admin.php">Admin Panel</a></td> <?php //} ?>
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
            <center><p>Subcategory</p></center>
<form action="" method="POST">
      <table align=left width=100% border=0 cellspacing=10 cellpadding=5 >
                <tr>
                    <td> Subcategory Name:</td>
                    <td><input type="text" name="sname" ></td>
              </tr>
              <tr>
        <td>Product Main Category</td>
            <td><select name="maincat">
                <option>Select a Main Category</option>
                <?php
                
                $sql="SELECT * FROM maincategory";
                $result=mysqli_query($mysqli, $sql);
                while($row_brand=mysqli_fetch_array($result)){
                    $mc_id=$row_brand['mc_id'];
                    $mc_name=$row_brand['mc_name'];
                    echo "<option value='$mc_id'>$mc_name</option>";
                }
                ?>
            </select>
        </td>
    </tr>
              
      <tr><td> <input type="submit" name="submit" value="Submit"></td></tr> </table> 
              </form>
        </div>   
<?php

if(isset($_POST['submit'])){
     $sname=$_POST['sname'];
      $mcid=$_POST['maincat'];
    if(empty($sname)||empty($mcid)) {
          echo "Please enter all data"; 
      
    }
    else{
          global $mysqli;
      	 $sql="INSERT into subcategory(sc_name,maincat)values('$sname','$mcid')";

      	  if ($mysqli->query($sql) === TRUE) {
        echo "New subcategory inserted successfully <a href='home.php'>click here to view home</a>";
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
//}else{
//    echo 'Restricted';
//}
 ?>
</body>
<div id="footer"></div>
</div>
</html>




