<?php
session_start();
include "mysqlconn.php";
include 'category.php';
?>
<html>
<head>
<title>checkout</title>
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
                <td valign="center" align="right" >
                    <form action="search.php" method="post" >
              <div class="container-1">
                  <input type="text" name="search" placeholder="Search a Product" size="40" required/>
                <input type="submit" name="src" value="Search" />
              </div>
            </form>
                </td>
                <?php if(isset($_SESSION['u_level'])){ ?> <td><a href="admin.php">Admin Panel</a></td> <?php } ?>
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
<?php }else  {  echo "Welcome guest! &nbsp;&nbsp;<a href='login.php'>login</a>";} ?>                    
                    </div></td>
              </tr>
                  </table>
        </div>
    </div>
      
        <div id="">
             
            
<table align="center" width="1000" bgcolor="#FFF0F5">
    <tr align="right"><h3>Review Order</h3></tr>
                    <tr align="center">
                        <th>Product</th>
                        <th>Size</th>
                        <th>Quantity</th>
                        <th>Total Price</th>                       
                    </tr>          
<?php
global $mysqli;
$u_check=$_SESSION['login_status'];
$get_item= "select * from cart where u_id=$u_check";
        $run1= mysqli_query($mysqli, $get_item);
        while($row1= mysqli_fetch_array($run1)){
            $qty=$row1['qty'];
            $s=$row1['size'];
            $single_price=$row1['single_price'];
            $subtotal=$row1['subtotal'];
            $p_id=$row1['p_id'];
            $p_name=$row1['p_name'];
            $total=$subtotal+$total;
?>
                    <tr align="center"><td><?php echo $p_name ?></td>
                        <td><?php echo $s ?></td>
                        <td><?php echo $qty ?></td>
                <td><?php echo "TK" .$subtotal;?></td>
                    </tr>
            
<?php
if(isset($_POST['confirm'])){
    $u_check=$_SESSION['login_status'];
            $pcode =($_POST["post_code"]);
            if (preg_match("/^[a-zA-Z ]*$/",$_REQUEST['reciever_name'])) {
            $fname =($_POST["reciever_name"]);
            
               if(strlen($_REQUEST['reciever_mbl']) == 11 and substr($_REQUEST['reciever_mbl'], 0, 2) == "01") {
               $mnumb=($_POST["reciever_mbl"]);
               
                if (preg_match("/^[a-zA-Z0-9&:#,-. ]*$/",$_REQUEST['address'])) {
                    $address =($_POST["address"]);
               
               if(empty($_POST["reciever_name"]) or empty($_POST["reciever_mbl"]) or empty($_POST["address"]) or empty($_POST["post_code"]) ){
                   echo "fill up all fields";
               }else{
                   global $mysqli;
                  $sql = "INSERT INTO checkout ( u_id,reciever_name,reciever_mbl,delivery_address,post_code,p_id,p_name,p_size,p_qty,p_price,subtotal)
    VALUES('$u_check','$fname','$mnumb','$address','$pcode','$p_id','$p_name','$s','$qty','$single_price','$subtotal')";
    $run= mysqli_query($mysqli, $sql);
    if ($run) {
        //echo "New record created successfully You will redirect to login page after 3sec";
        //header('Refresh: 5;url=login.php');
        echo '<META HTTP-EQUIV="Refresh" Content="0; URL=useraccount.php">';
} else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    
    }
    }
                }else{
                   echo "Only letters, white space - & : # , . allowed in ADDRESS";
               }
               }else{
                   echo "Invalid Mobile Number";
               }
               
                }else{
        
                    echo " Only letters and white space allowed in NAME";
                }
                $get="delete from cart where u_id='$u_check'";
                $run2=  mysqli_query($mysqli,$get);
        }
        
                }

?>
                    <tr align="center">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><hr><b>Subtotal</b>&nbsp;&nbsp;<?php echo "TK" .$total; ?></td>
                    </tr></table>
        </div>
        
        <div>   
        <table align=left width=50% border=0 cellspacing=10 cellpadding=5 >  
    <tr align="right"><h3>Payment System</h3></tr>
  
    <tr>
    <p style="color:green; border-style: none"><b>***Cash on delivery***</b></p>
        </tr>
        </table>
            <br>
    </div>
    
    <div>
        <form action="" method="POST">
        <table align=left width=80% border=0 cellspacing=10 cellpadding=5 bgcolor="aliceblue">  
    <tr align="left"><h3>Delivery Info</h3></tr>
  
    <tr>
        <td align="left"><b>Name</b></td>
        <td><input type="text" name="reciever_name" placeholder="enter full name" style="width: 250px; height: 30px;" required/></td>
    </tr>
     <tr>
        <td align="left"><b>Mobile Number</b></td>
        <td><input type="tel" name="reciever_mbl" placeholder="we will contact if necessary" style="width: 250px; height: 30px;" required/></td>
    </tr>
        <td align="left"><b>Delivery Address</b></td>
        <td><textarea name="address" cols="35" rows="5" placeholder="give detail address here" required/></textarea></td>
    </tr>
    <tr>
        <td align="left"><b>Post Code</b></td>
        <td><input type="text" name="post_code" style="width: 100px; height: 30px;" required/></td>
    </tr>
    <tr><td></td><td align="right"><input type="submit" name="confirm" value="Place Order" style=" font-weight: bold; font-size: 14px; color:#FFF; width:100px; height:40px; background-color:orange; border-style: inherit"/></td></tr>
        </table>
    </form>
    </div>
</body>
<div id="footer"></div>
</div>
</html>

