<?php
session_start();
include "mysqlconn.php";
include 'category.php';
if(isset($_SESSION['u_level'])){
//echo "$_SESSION['u_level']";
?>
<html>
<head>
<title>manage users</title>
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
            <center><p>Manage User</p></center>
<div id="">
    <?php
 if (isset($_POST['submit'])) {
     $uid=$_POST['u_id'];
     if(!empty($_POST["u_id"])){
     global $mysqli;
                  $sql = "UPDATE member SET u_level='admin' WHERE u_id='$uid'";
                  $run= mysqli_query($mysqli, $sql);
                  if ($run) {
                  }
     }
 }
 
 if (isset($_POST['delete'])) {
     $uid=$_POST['u_id'];
     if(!empty($_POST["u_id"])){
     global $mysqli;
                  $sql = "UPDATE member SET u_level='0' WHERE u_id='$uid'";
                  $run= mysqli_query($mysqli, $sql);
                  if ($run) {
                  }
     }
 }
 ?>
    <form action="" method="post"><table>
            <tr>
                <td><select name="u_id">
                <option>UserID</option>
                <?php
                
                $sql="SELECT * FROM member ";
                $result=mysqli_query($mysqli, $sql);
                while($row_brand=mysqli_fetch_array($result)){
                    $u_id=$row_brand['u_id'];
                    //$e_name=$row_brand['e_name'];
                    echo "<option value='$u_id'>$u_id</option>";
                }
                ?>
            </select>
        </td>
                <td>
                        <input type="submit" name="submit" value="choose as admin">
                </td>
                <td>
                        <input type="submit" name="delete" value="remove from admin">
                </td>
            </tr>
        </table></form>
    
<form action="" method="post">
                <table align="center" width="700" bgcolor="#ccccc" border=0 cellspacing=2 cellpadding=0>
                    <tr align="">
                        <th>UserID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Address</th>   
                        <th>User-Level</th> 
                    </tr>
<?php
 global $mysqli;
 $sql="select * from member order by u_id";
 $result=  mysqli_query($mysqli, $sql);
 while ($row = mysqli_fetch_array($result)) {
     $u_id=$row['u_id'];
     $fullname=$row['fullname'];
     $email=$row['email'];
     $mnumb=$row['mnumb'];
     $address=$row['address'];
     $city=$row['city'];
     $level=$row['u_level'];
?>
    
                    <tr align="center" width="700" bgcolor="white" border=0 cellspacing=0 cellpadding=0>
                        <td><?php echo $u_id; ?></td>
                        <td><?php echo $fullname; ?></td>
                        <td><?php echo $email; ?></td>
                        <td><?php echo $mnumb; ?></td>
                        <td><?php echo $address; ?></td>
                        <td><?php echo $level; ?></td>
                    </tr>
    
 <?php }
 
}else{
    echo 'Restricted';
}
                    
 ?>
   </table></form>         
    </div>
    
            </div>

            
            <!--<div id="caption">Men wear</div>
            <div id="caption">Women wear</div>-->
        </div>   
</body>
<div id="footer"></div>
</div>
</html>



