<?php
session_start();
include "mysqlconn.php";
include 'category.php';
?>
<html>
<head>
<title>detail</title>
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
<?php }else  {  echo "Welcome guest! &nbsp;&nbsp;<a href='login.php' style='color:green;'>Login here</a>"
    . "&nbsp;&nbsp;<a href='signup.php'>(Register?)</a>";} ?>                    </div></td>
              </tr>
                  </table>
        </div>
    </div>
        
        <div id="detail_body">
            <center><p>Product details</p></center>
            <div id="detail_pic">
<?php            
   
   if(isset($_GET['pcat'])){
    $cat_id= $_GET['pcat'];
    global $mysqli;

    $get="select * from product where p_id='$cat_id'";  
    $run= mysqli_query($mysqli, $get);
    
    while ($row = mysqli_fetch_array($run)) {
        $p_id=$row['p_id'];
        $p_name=$row['p_name'];
        $p_image=$row['p_image'];
        $price=$row['price'];
        $fabric=$row['fabric'];
        $color=$row['color'];
        $gender=$row['gender'];
        $wash=$row['wash_care'];
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
        $totalqty=$row['totalquantity'];
        $nosize=$row['nosize'];
        
        echo "
                   <div class='image'><img src='$p_image' width='500' height='500' float='left'/> </div>";?>
                       </div><div id='detail_box'>
<?php


if(isset($_POST['add_to_cart'])){
        if(isset($_SESSION['login_status'])){
            $u_check=$_SESSION['login_status'];
            if(isset($u_check)){
                global $mysqli;
                if(isset($_POST['sal'])){
        $pidfromcart=$_GET['pcat'];
        $get="select * from product where p_id='$pidfromcart'";  
    $run= mysqli_query($mysqli, $get);
    while ($row = mysqli_fetch_array($run)) {
    $price=$row['price'];
    $p_name=$row['p_name'];
    $size1qty=$row['size1qty'];
        $size2name=$row['size2name'];
        $size2qty=$row['size2qty'];
        $size3name=$row['size3name'];
        $size3qty=$row['size3qty'];
        $size4name=$row['size4name'];
        $size4qty=$row['size4qty'];
        $size5name=$row['size5name'];
        $size5qty=$row['size5qty'];
        $nosize=$row['nosize'];
        $totalquantity=$row['totalquantity'];
    
    }
        $s=$_POST['sal'];
        //echo '$s';
        $qty=$_POST['qty'];
        
        $subtotal=$qty*$price;
        
        $check_pro="select * from cart where p_id='$pidfromcart' and u_id='$u_check'";
        $run_check= mysqli_query($mysqli, $check_pro);
        if(mysqli_num_rows($run_check)>0){
            echo "<b style='color:red;'>Already Inserted</b>";
        }else{
        if(($s=="S") or ($s=="30")){
            if($size1qty>=$qty){
        $insert_item= "insert into cart (p_id,u_id,size,qty,single_price,subtotal,p_name) values ('$pidfromcart','$u_check','$s','$qty','$price','$subtotal','$p_name')";
        //echo $insert_item;
        $run= mysqli_query($mysqli, $insert_item);
            }else{echo '<b style=color:red>Only ' .$size1qty .' Item Left</b>';}
        }
        elseif(($s=="M") or ($s=="32")){
            $qty=$_POST['qty'];
            if($size2qty>=$qty){
        $insert_item= "insert into cart (p_id,u_id,size,qty,single_price,subtotal,p_name) values ('$pidfromcart','$u_check','$s','$qty','$price','$subtotal','$p_name')";
        //echo $insert_item;
        $run= mysqli_query($mysqli, $insert_item);
            }else{echo '<b style=color:red>Only ' .$size2qty .' Item Left</b>';}
        }elseif(($s=="L") or ($s=="34")){
            $qty=$_POST['qty'];
            if($size3qty>=$qty){
        $insert_item= "insert into cart (p_id,u_id,size,qty,single_price,subtotal,p_name) values ('$pidfromcart','$u_check','$s','$qty','$price','$subtotal','$p_name')";
        //echo $insert_item;
        $run= mysqli_query($mysqli, $insert_item);
            }else{echo '<b style=color:red>Only ' .$size3qty .' Item Left</b>';}
        }
        elseif(($s=="XL") or ($s=="36")){
            $qty=$_POST['qty'];
            if($size4qty>=$qty){
        $insert_item= "insert into cart (p_id,u_id,size,qty,single_price,subtotal,p_name) values ('$pidfromcart','$u_check','$s','$qty','$price','$subtotal','$p_name')";
        //echo $insert_item;
        $run= mysqli_query($mysqli, $insert_item);
            }else{echo '<b style=color:red>Only ' .$size4qty .' Item Left</b>';}
        }
        elseif(($s=="XXL") or ($s=="38")){
            $qty=$_POST['qty'];
            if($size5qty>=$qty){
        $insert_item= "insert into cart (p_id,u_id,size,qty,single_price,subtotal,p_name) values ('$pidfromcart','$u_check','$s','$qty','$price','$subtotal','$p_name')";
        //echo $insert_item;
        $run= mysqli_query($mysqli, $insert_item);
            }else{echo '<b style=color:red>Only ' .$size5qty .' Item Left</b>';}
        }
        elseif($s=="Free Size"){
            $qty=$_POST['qty'];
            if($totalquantity>=$qty){
        $insert_item= "insert into cart (p_id,u_id,size,qty,single_price,subtotal,p_name) values ('$pidfromcart','$u_check','$s','$qty','$price','$subtotal','$p_name')";
        //echo $insert_item;
        $run= mysqli_query($mysqli, $insert_item);
            }else{echo '<b style=color:red>Only ' .$totalquantity .' Item Left</b>';}
        }
        }
        
               }
            }
            }else {
           echo '<META HTTP-EQUIV="Refresh" Content="0; URL=login.php">'; 
        }
    }


                   
echo "<p>$p_name</p>
<hr>
<p><h3>Tk $price</h3></p>";

    if($insert_item){
        echo '<META HTTP-EQUIV="Refresh" Content="0; URL=cart.php">'; 
                        //echo "<button  style=' border-style: dotted; font-size: 12px; width:150px; height:25px; background-color:orange;'><a href='cart.php' style=' text-decoration: none; color:white;'>Go to cart</a></button>";
    }else{
        ?>
<form method="post" action="">
    <table><?php 
    if($totalqty>0){
        if($nosize==0){
        echo 'Size<br>';?>
        <?php if($size1qty>0){ ?><tr><INPUT TYPE="radio" NAME="sal" color="#FFF" value="<?php echo $size1name;?>"><?php echo"<a href='#?size1qty=$size1qty' style='color:black; text-decoration: none;' title='$size1qty item left'><b> $size1name </b></a>";?></tr>&nbsp;&nbsp;&nbsp;<?php } ?>
        <?php if($size2qty>0){ ?><tr><INPUT TYPE="radio" NAME="sal" color="#FFF" value="<?php echo $size2name;?>"><?php echo"<a href='#?size2qty=$size2qty' style='color:black; text-decoration: none;' title='$size2qty item left'><b> $size2name </b></a>";?></tr>&nbsp;&nbsp;&nbsp;<?php } ?>
        <?php if($size3qty>0){ ?><tr><INPUT TYPE="radio" NAME="sal" color="#FFF" value="<?php echo $size3name;?>"><?php echo"<a href='#?size3qty=$size3qty' style='color:black; text-decoration: none;' title='$size3qty item left'><b> $size3name </b></a>";?></tr>&nbsp;&nbsp;&nbsp;<?php } ?>
        <?php if($size4qty>0){ ?><tr><INPUT TYPE="radio" NAME="sal" color="#FFF" value="<?php echo $size4name;?>"><?php echo"<a href='#?size4qty=$size4qty' style='color:black; text-decoration: none;' title='$size4qty item left'><b> $size4name </b></a>";?></tr>&nbsp;&nbsp;&nbsp;<?php } ?>
        <?php if($size5qty>0){ ?><tr><INPUT TYPE="radio" NAME="sal" color="#FFF" value="<?php echo $size5name;?>"><?php echo"<a href='#?size5qty=$size5qty' style='color:black; text-decoration: none;' title='$size5qty item left'><b> $size5name </b></a>";?></tr><?php } ?>
        <?php         }else{?><tr><INPUT TYPE="hidden" NAME="sal" color="#FFF" value="Free Size"></tr><?php } ?>
         <br><br>
         <tr bgcolor="#FFF0F5">Qty&nbsp;<input type="number" min="1" max="10" size="5" name="qty" required></tr>
        
            <tr>
                <br><br><td bgcolor="#FFF0F5" align="center"><a><input type="submit" name="add_to_cart" value="ADD to Cart" style=" font-weight: bold; color:#FFF; width:80px; height:40px; background-color:yellowgreen; border-style: inherit;"></a></td>
            <?php 
            ?></tr><?php }else{            
                echo '<b style=color:red>SOLD OUT !</b>'; 
            }}?> 
    </table>
</form>
<?php
             
         //echo " <a href='detail.php?pcat=$p_id' ><button style='float:left; color:#FFF; width:80px; height:40px; background-color:orange;'><font size='2px'><b>Detail</b></button></a>
                       
echo "                   <br><br><br><hr>
                         <center><u>Description</u></center><br>
                         <table><tr><td>Fabric:&nbsp;&nbsp;</td><td>$fabric</td></tr>
                             <tr><td>Color:&nbsp;&nbsp;</td><td>$color</td></tr>
                                 <tr><td>Wash Care:&nbsp;&nbsp;</td><td>$wash</td></tr>
                                     <tr><td>Gender:&nbsp;&nbsp;</td><td>$gender</td></tr></table>
                             
           ";?>
</div>
<?php }
    }
    if(isset($_POST['add_to_cart'])){
        if($insert_item){
        //$totalqty=$_GET['totalquantity'];
        //echo $totalqty;
        $qty=$_POST['qty'];
        $pidfromcart=$_GET['pcat'];
        //echo $pidfromcart;
        $calculation=$totalqty-$qty;
        //echo $calculation;
        if($calculation>'-1'){
        $sql= "UPDATE product SET totalquantity='$calculation' WHERE p_id='$pidfromcart'";
        $res=mysqli_query($mysqli,$sql);
        }
    }
    }
    
    if(isset($_POST['add_to_cart'])){
        if($insert_item){
        $s=$_POST['sal'];
        //echo $s;
        if(($s=="S") or ($s=="30")){
            $qty=$_POST['qty'];
            $pidfromcart=$_GET['pcat'];
            $calculation=$size1qty-$qty;
            if($calculation>'-1'){
            $sql= "UPDATE product SET size1qty='$calculation' WHERE p_id='$pidfromcart'";
            $res=mysqli_query($mysqli,$sql);
            }
        }elseif(($s=="M") or ($s=="32")){
            $qty=$_POST['qty'];
            $pidfromcart=$_GET['pcat'];
            $calculation=$size2qty-$qty;
            if($calculation>'-1'){
            $sql= "UPDATE product SET size2qty='$calculation' WHERE p_id='$pidfromcart'";
            $res=mysqli_query($mysqli,$sql);
            }
    }elseif(($s=="L") or ($s=="34")){
            $qty=$_POST['qty'];
            $pidfromcart=$_GET['pcat'];
            $calculation=$size3qty-$qty;
            if($calculation>'-1'){
            $sql= "UPDATE product SET size3qty='$calculation' WHERE p_id='$pidfromcart'";
            $res=mysqli_query($mysqli,$sql);
            }
    }elseif(($s=="XL") or ($s=="36")){
            $qty=$_POST['qty'];
            $pidfromcart=$_GET['pcat'];
            $calculation=$size4qty-$qty;
            if($calculation>'-1'){
            $sql= "UPDATE product SET size4qty='$calculation' WHERE p_id='$pidfromcart'";
            $res=mysqli_query($mysqli,$sql);
            }
    }elseif(($s=="XXL") or ($s=="38")){
            $qty=$_POST['qty'];
            $pidfromcart=$_GET['pcat'];
            $calculation=$size5qty-$qty;
            if($calculation>'-1'){
            $sql= "UPDATE product SET size5qty='$calculation' WHERE p_id='$pidfromcart'";
            $res=mysqli_query($mysqli,$sql);
            }
    }
    }
    }
?>
</div>

</body>
<div id="footer"></div>   
    </div>
</html>

