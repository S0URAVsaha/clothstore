<?php
session_start();

include "mysqlconn.php";
include 'category.php';
?>
<html>
<head>
<title>cart items</title>
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
<?php }else  {  echo "Welcom guest! &nbsp;&nbsp;<a href='login.php'>login</a>";} ?>                    
                    </div></td>
              </tr>
                  </table>
        </div>
    </div>
        
        <div id="">
            <form action="" method="post">
                <table align="center" width="1000" bgcolor="snow" border=0 cellspacing=8 cellpadding=4>
                    <tr align="center">
                        <th>Remove</th>
                        <th>Product</th>
                        <th>Size</th>
                        <th>Quantity</th>
                        <th>Price</th>                       
                    </tr>
<?php
$total= 0;
    global $mysqli;
    $u_check=$_SESSION['login_status'];
    $get="select * from cart where u_id=$u_check";
    $result= mysqli_query($mysqli, $get);
    while($price=mysqli_fetch_array($result)){
        $p_id=$price['p_id'];
        $p_price="select * from product where p_id='$p_id'";
        $run= mysqli_query($mysqli, $p_price);
        
        while($row= mysqli_fetch_array($run)){
            
            $p_name=$row['p_name'];
            $p_image=$row['p_image'];
            $single_price=$row['price'];
            $totalqty=$row['totalquantity'];
            $size1name=$row['size1name'];
        $size1qty=$row['size1qty'];
        $size2name=$row['size2name'];
        $size2qty=$row['size2qty'];
        $size3name=$row['size3name'];
        $size3qty=$row['size3qty'];
        $size4name=$row['size4name'];
        $size4qty=$row['size4qty'];
        $size5name=$row['size5name'];
        $size5qty=$row['size5qty'];
            
 ?>
                    <tr align="center">
                        <td><input type="checkbox" name="remove[]" value="<?php echo $p_id; ?>"</td>
                        <td><?php echo $p_name?><br>
                        <?php echo "<img src='$p_image' width='60' height='60'/>";?></td>
                        
        <?php
        /*if(isset($_POST['update_cart'])){
            $u_check=$_SESSION['login_status'];
            $qty=$_POST['qty'];
            
            $update_qty="update cart set qty=$qty";
            $run_qty=  mysqli_query($mysqli,$update_qty);
            $_SESSION['qty']=$qty;
            
            $total=$total*$qty;
        }*/ 
        $get_item= "select * from cart where u_id=$u_check and p_id=$p_id";
        //echo $insert_item;
        $run1= mysqli_query($mysqli, $get_item);
        while($row1= mysqli_fetch_array($run1)){
            $qty=$row1['qty'];
            $s=$row1['size'];
        //$_SESSION['qty']=$qty;

            $tk=$single_price*$qty;
            $total=$tk+$total;
        
        }
            
        
        
if(isset($_POST['update_cart'])){
        $calculation=$totalqty+$qty;
        $sql= "UPDATE product SET totalquantity='$calculation' WHERE p_id='$p_id'";
        $res=mysqli_query($mysqli,$sql);

      //echo $s;
        if(($s=="S") or ($s=="30")){
            $calculation=$size1qty+$qty;
            $sql= "UPDATE product SET size1qty='$calculation' WHERE p_id='$p_id'";
            $res=mysqli_query($mysqli,$sql);
        }elseif(($s=="M") or ($s=="32")){
            
            $calculation=$size2qty+$qty;
            $sql= "UPDATE product SET size2qty='$calculation' WHERE p_id='$p_id'";
            $res=mysqli_query($mysqli,$sql);
    }elseif(($s=="L") or ($s=="34")){
            
            $calculation=$size3qty+$qty;
            $sql= "UPDATE product SET size3qty='$calculation' WHERE p_id='$p_id'";
            $res=mysqli_query($mysqli,$sql);
    }elseif(($s=="XL") or ($s=="36")){
            
            $calculation=$size4qty+$qty;
            $sql= "UPDATE product SET size4qty='$calculation' WHERE p_id='$p_id'";
            $res=mysqli_query($mysqli,$sql);
    }elseif(($s=="XXL") or ($s=="38")){
            
            $calculation=$size5qty+$qty;
            $sql= "UPDATE product SET size5qty='$calculation' WHERE p_id='$p_id'";
            $res=mysqli_query($mysqli,$sql);
    }

}
?>
                        
                        <td><?php echo $s ?></td>
                        <td><?php echo $qty ?></td>
                <td><?php echo "TK" .$single_price;?></td>
                    </tr>
                    
<?php 
        }
    }
    ?><br>
                    
                    <tr><td><br></td></tr><tr></tr><tr></tr><tr></tr>
                    <tr align="center">
                        
                        <td><input type="submit" name="update_cart" value="Remove Item" style=" border-color:white; font-size: 12px; color:brown; width:110px; height:25px; background-color:white;"</td>
                        <td></td>
                        <td align="left"><input type="submit" name="continue" value="Continue Shopping" style=" border-style: dotted; font-size: 12px; color:green; width:125px; height:25px; background-color:white;"</td>
                        <td></td>
                        
                        
                        <td><button style=" font-weight: bold; font-size: 14px; width:100px; height:35px; background-color: orange; border-style: inherit"><a href="checkout.php" style=" text-decoration: none; color:white;">Checkout</a></button></td>
                    </tr>
                </table>
            </form>
<?php
//remove item from cart
$u_check=$_SESSION['login_status'];
if(isset($_POST['update_cart'])){
    foreach ($_POST['remove'] as $remove_id){
        $get="delete from cart where p_id='$remove_id' and u_id='$u_check'";
        $run=  mysqli_query($mysqli,$get);
        if($run){
echo '<META HTTP-EQUIV="Refresh" Content="0; URL=cart.php">';       

}}}


if(isset($_POST['continue'])){
echo '<META HTTP-EQUIV="Refresh" Content="0; URL=home.php">';
}
?>
</div>

</body>
<div id="footer"></div>   
    </div>
</html>

