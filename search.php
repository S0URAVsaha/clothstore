<?php
session_start();
include "mysqlconn.php";
include 'category.php';
?>
<html>
<head>
<title>search result</title>
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
                <td align="right"><a href="contact.php">Contact</a></td>
                <td valign="center" align="right" >
                    <form action="" method="post" >
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
<?php }else  {  echo "Welcome guest! &nbsp;&nbsp;<a href='login.php'>Login here</a>"
    . "&nbsp;&nbsp;<a href='signup.php'>(Register?)</a>";} ?>                    
                    </div></td>
              </tr>
                  </table>
        </div>
    </div>
        <div id="leftmargin">
            <center><h3>Category</h3></center> 
            <div id="maincat">
<?php
maincategory();
?>
            </div>
 <div id="caption">
<?php
if(isset($_GET["cat"])){
    subcategory();
}else{}

?>
            </div>  

        </div>
        
        <div id="mainbody">
            <center><p>Search results</p></center>
<div id="">
<?php
if(isset($_GET["cat"])){
getproductbymaincategory();
}else{
if(isset($_GET["scat"])){
    getproductbysubcategory();
}else{
    if(isset($_POST['src'])){
    if(!empty($_POST['search'])){
        global $mysqli;
    $search_sql="SELECT * FROM product WHERE p_name LIKE '%".$_POST['search']."%' OR color LIKE '%".$_POST['search']."%'";
    //echo $search_sql;
    $result= mysqli_query($mysqli,$search_sql);
 if(mysqli_num_rows($result)!=0){

        while ($row = mysqli_fetch_array($result)) {
        $p_id=$row['p_id'];
        $p_name=$row['p_name'];
        $p_image=$row['p_image'];
        $price=$row['price'];
        if(!$row){
            echo 'no item';
        }  else {

           echo "
               <div class='single_product'>
               <img src='$p_image' width='230' height='280'/>
                       <div class='text'>                           
                       <a href='detail.php?pcat=$p_id' ><button style='color:white; border-style: inherit; background-color:orange; width:90; height:25;'><font size='2px'>Detail</button></a>
</div>

$p_name
<p>Tk $price</p>

</div>
           ";
 }
    }
    }else{
        echo "no result found";
    }
    }
    }else{
?>
    <div id="product_box">
<?php
    getproduct();
    cart();
    
//if($_GET['pcat']==true){    
    //header("Location: http://localhost/clothstore/clothstore/detail.php" );
//}
}}}
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

