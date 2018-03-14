<?php
session_start();
include "mysqlconn.php";
include 'category.php';
if(isset($_SESSION['u_level'])){

?>
<html>
<head>
<title>delivery product</title>
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
                <td><a href="admin.php">Admin Panel</a></td>
                <td><div id="shopping_cart">
<?php
if(isset($_SESSION['login_name'])){
    echo 'Login as ';
    loggeduser();
    echo "
    <a href='logout.php'>logout</a><br>";

}else  {  echo "Welcome guest! &nbsp;&nbsp;<a href='login.php'>login</a>";} ?>                    
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
            <center><p>Delivery Items</p></center>
<div id="">
    <?php
 if (isset($_POST['submit'])) {
     $oid=$_POST['o_id'];
     if(!empty($_POST["o_id"])){
     global $mysqli;
                  $sql = "UPDATE delivery SET status='delivered' WHERE o_id='$oid'";
                  $run= mysqli_query($mysqli, $sql);
                  if ($run) {
        //echo "New record created successfully";
             

                  }
     }
 }
 ?>
    <form action="" method="post"><table><tr>
                <td><select name="o_id">
                <option>OrderID</option>
                <?php
                
                $sql="SELECT * FROM delivery where status!='delivered'";
                $result=mysqli_query($mysqli, $sql);
                while($row_brand=mysqli_fetch_array($result)){
                    $o_id=$row_brand['o_id'];
                    //$e_name=$row_brand['e_name'];
                    echo "<option value='$o_id'>$o_id</option>";
                }
                ?>
            </select>
        </td>
                <td>
                        <input type="submit" name="submit" value="Delivered"></td></tr></table></form>



<?php
 global $mysqli;
 $sql="select * from delivery order by o_id DESC";
 $result=  mysqli_query($mysqli, $sql);
 while ($row = mysqli_fetch_array($result)) {
     $e_id=$row['e_id'];
     $o_id=$row['o_id'];
     $p_id=$row['p_id'];
     $p_name=$row['p_name'];
     $qty=$row['p_qty'];
     $s=$row['p_size'];
     $single_price=$row['p_price'];
     $subtotal=$row['subtotal'];
     $u_id=$row['u_id'];
     $reciever_name=$row['reciever_name'];
     $reciever_mbl=$row['reciever_mbl'];
     $delivery_address=$row['delivery_address'];
     $post_code=$row['post_code'];
     $status=$row['status'];
     $total=$subtotal+$total;

?>
    <details><summary>Order: <b><?php echo $o_id; ?></b> is taken by <u>Employee:<b><?php echo $e_id; ?></b></u> &nbsp;&nbsp;&nbsp;&nbsp;<span style="color: green;"><i><?php echo $status; ?></i></span></summary><form action="" method="post">
                <table align="center" width="820" bgcolor="lightyellow" border=0 cellspacing=8 cellpadding=4>
                    <tr aling="left">
                        <td><b><u>EmployeeID: <?php echo $e_id; ?></u></b>
                    <li>OrderID: <?php echo $o_id; ?></li>
                    <li>Receiver Name: <?php echo $reciever_name; ?></li>
                        <li>Receiver Mobile: <?php echo $reciever_mbl; ?></li>
                        <li>Address: <?php echo $delivery_address; ?></li>
                        <li>Post Code: <?php echo $post_code; ?></li></td>
                        <td><li>ProductID: <?php echo $p_id; ?></li>
                        <li>Product Name: <?php echo $p_name; ?></li>
                        <li>Size: <?php echo $s; ?></li>
                        <li>Quantity: <?php echo $qty; ?></li>
                        <li>Price: <?php echo $single_price; ?></li>
                        <li>Subtotal: <?php echo $subtotal; ?></li></td>
                        </tr></table></form></details>
 <?php } 
}else{
    echo 'Restricted';
}
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


