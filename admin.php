<?php
session_start();
include "mysqlconn.php";
include 'category.php';
if(isset($_SESSION['u_level'])){

?>
<html>
<head>
<title>admin panel</title>
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
            <center><p>Order Items</p></center>
<div id="">
    <?php

 if(isset($_POST['submit'])){
    $u_check=$_SESSION['login_status'];
            $employee =($_POST["employee"]);
            $d_id=$_POST['o_id'];
            $sql="select * from checkout where o_id=$d_id";
 $result=  mysqli_query($mysqli, $sql);
 while ($row = mysqli_fetch_array($result)) {
     $u_id=$row['u_id'];
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
     $date=$row['date'];
     $total=$subtotal+$total;
 
            if(!empty($_POST["employee"])){
            global $mysqli;
                  $sql = "INSERT INTO delivery ( e_id,o_id,u_id,reciever_name,reciever_mbl,delivery_address,post_code,p_id,p_name,p_size,p_qty,p_price,subtotal)

    VALUES('$employee','$d_id','$u_id','$reciever_name','$reciever_mbl','$delivery_address','$post_code','$p_id','$p_name','$s','$qty','$single_price','$subtotal')";
    $run= mysqli_query($mysqli, $sql);
    if ($run) {
        //echo "New record created successfully";
        //$d_id=$_POST['o_id'];
        $dlt="DELETE FROM checkout WHERE o_id='$d_id'";
        $run1= mysqli_query($mysqli, $dlt);
        //header('Refresh: 5;url=login.php');
        //echo '<META HTTP-EQUIV="Refresh" Content="0; URL=admin.php">';
} else {
        echo "Error: " . $sql . "<br>" . $conn->error;
}
    }
 }
 }
 ?>
    <form action="" method="POST">
      <table align=center width='820px' border=0 cellspacing=8 cellpadding=4 bgcolor="#ccccc">
          <tr>
              <td><b>Delivery Order:</b></td>
            <td><select name="o_id">
                <option>OrderID</option>
                <?php
                
                $sql="SELECT * FROM checkout";
                $result=mysqli_query($mysqli, $sql);
                while($row_brand=mysqli_fetch_array($result)){
                    $o_id=$row_brand['o_id'];
                    //$e_name=$row_brand['e_name'];
                    echo "<option value='$o_id'>$o_id</option>";
                }
                ?>
            </select>
        </td>

            <td><select name="employee">
                <option>Assign Employee</option>
                <?php
                
                $sql="SELECT * FROM employee";
                $result=mysqli_query($mysqli, $sql);
                while($row_brand=mysqli_fetch_array($result)){
                    $e_id=$row_brand['e_id'];
                    $e_name=$row_brand['e_name'];
                    echo "<option value='$e_id'>$e_name</option>";
                }
                ?>
            </select>
        </td>
    
        <td><input type="submit" name="submit" value="submit"/></td></tr>
      </table></form>


<?php
 global $mysqli;
 $sql="select * from checkout order by date DESC";
 $result=  mysqli_query($mysqli, $sql);
 while ($row = mysqli_fetch_array($result)) {
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
     $date=$row['date'];
     $total=$subtotal+$total;

?>
        <form action="" method="post">
                <table align="center" width="820" bgcolor="#FFF0F5" border=0 cellspacing=8 cellpadding=4>
                    <tr aling="left">
                        <td><b><u>OrderID: <?php echo $o_id; ?></u></b>&nbsp;<?php echo $date; ?>
                    <li>UserID: <?php echo $u_id; ?></li>
                    <li>Receiver Name: <?php echo $reciever_name; ?></li>
                        <li>Receiver Mobile: <?php echo $reciever_mbl; ?></li>
                        <li>Address: <?php echo $delivery_address; ?></li>
                        <li>Post Code: <?php echo $post_code; ?></li><?php echo ("&nbsp;&nbsp;<a href='?delete=$o_id'>Delete</a>"); ?></td>
                        <td><li>ProductID: <?php echo $p_id; ?></li>
                        <li>Product Name: <?php echo $p_name; ?></li>
                        <li>Size: <?php echo $s; ?></li>
                        <li>Quantity: <?php echo $qty; ?></li>
                        <li>Price: <?php echo $single_price; ?></li>
                        <li>Subtotal: <?php echo $subtotal; ?></li></td>
                        </tr></table></form>
<?php
 } ?>    
    
    
 
    </div>
    
            </div>

<?php 
     if (isset($_GET['delete'])) {
     	$d_id=$_GET['delete'];
     	
        global $mysqli;
     	$dlt="DELETE FROM checkout WHERE o_id='$d_id'";
     	 if ($mysqli->query($dlt) === TRUE) {
               ?>
               <script>var ret=window.confirm('Delete Successfull'); if (ret==true) {
                 window.location.replace('admin.php');}
               </script> <?php 
         }     

}


 ?>
        </div> 
<?php  
}else{
   echo 'Restricted' ;
}
 ?>
</body>
<div id="footer"></div>
</div>
</html>


