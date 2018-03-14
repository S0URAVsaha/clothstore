<?php
include 'mysqlconn.php';

function maincategory(){
    global $mysqli;
    $get = "select * from maincategory";
    $run= mysqli_query($mysqli,$get);
    
    while ($row = mysqli_fetch_array($run)) {
        $mc_id=$row['mc_id'];
        $mc_name=$row['mc_name'];
        
        echo "<li><a href='?cat=$mc_id'><b>$mc_name</b></a></li>";
    }
}


function subcategory(){
    if(isset($_GET['cat'])){
    $cat_id= $_GET['cat'];
    global $mysqli;

    $get="select * from subcategory where maincat='$cat_id'";  
    $run= mysqli_query($mysqli, $get);
    
    while ($row = mysqli_fetch_array($run)) {
        $sc_id=$row['sc_id'];
        $sc_name=$row['sc_name'];
        
        echo "<li><a href='?scat=$sc_id'>$sc_name</a></li>";
    }
    }
}

function search(){
    if(isset($_POST['src'])){
    if(!empty($_POST['search'])){
        global $mysqli;
    $search_sql="SELECT * FROM product WHERE p_name LIKE '%".$_POST['search']."%' OR color LIKE '%".$_POST['search']."%'";
    //echo $search_sql;
    $result= mysqli_query($mysqli,$search_sql);
    //echo $result;
    ?>
    <p><b>Search result</b></p>
    <?php if(mysqli_num_rows($result)!=0){

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
    }
}

function getproduct(){
    global $mysqli;
    $get = "select * from product order by RAND() LIMIT 27";
    $run= mysqli_query($mysqli,$get);
    
    
    while ($row = mysqli_fetch_array($run)) {
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
  
}

function getproductbysubcategory(){
    if(isset($_GET['scat'])){
    $cat_id= $_GET['scat'];
    global $mysqli;
    $get="select * from product where subcat='$cat_id'";  
    $run= mysqli_query($mysqli, $get);
    //print_r($run);
    //$row = mysqli_fetch_array($run);
    
    //if(empty($row)){ 
        //echo "empty";
    //}
    //else{
    if($run->num_rows > 0){
    while ($row = mysqli_fetch_array($run)) {
        //print_r($row);
        $p_id=$row['p_id'];
        $p_name=$row['p_name'];
        $p_image=$row['p_image'];
        $price=$row['price'];

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
        }  else {
            echo "No Product";
        }
    }   
}


function loggeduser(){
    
            $u_check=$_SESSION['login_status'];
            $fullname=$_SESSION['login_name'];;
            echo $fullname;
            //echo $u_check;
    
}

function cart(){
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
    
    }
        $s=$_POST['sal'];
        //echo '$s';
        $qty=$_POST['qty'];
        
        $subtotal=$qty*$price;
        
        $check_pro="select * from cart where p_id='$pidfromcart' and u_id='$u_check'";
        $run_check= mysqli_query($mysqli, $check_pro);
        if(mysqli_num_rows($run_check)>0){
            echo "Already inserted";
        }else{
 
        $insert_item= "insert into cart (p_id,u_id,size,qty,single_price,subtotal,p_name) values ('$pidfromcart','$u_check','$s','$qty','$price','$subtotal','$p_name')";
        //echo $insert_item;
        $run= mysqli_query($mysqli, $insert_item);
        }
        
               }
            }
            }else {
           echo '<META HTTP-EQUIV="Refresh" Content="0; URL=login.php">'; 
        }
    }
}

function totalitems(){
    if(isset($_SESSION['login_status'])){
        $u_check=$_SESSION['login_status'];
        global $mysqli;
        $get="select * from cart where u_id=$u_check";
        $run= mysqli_query($mysqli, $get);
        $count = mysqli_num_rows($run);
        echo $count;
    }elseif (isset($_POST['add_to_cart'])){
        $u_check=$_SESSION['login_status'];
        global $mysqli;
        $get="select * from cart where u_id=$u_check";
        $run= mysqli_query($mysqli, $get);
        $count = mysqli_num_rows($run);
        echo $count;
    }  //echo $count;
}

function totalprice(){
    $total= 0;
    global $mysqli;
    $u_check=$_SESSION['login_status'];
    $get="select * from cart where u_id=$u_check";
    $result= mysqli_query($mysqli, $get);
    while($price=mysqli_fetch_array($result)){
        $p_id=$price['p_id'];
        $p_price="select * from product where p_id='$p_id'";
        $run= mysqli_query($mysqli, $p_price);
        
        while($price1= mysqli_fetch_array($run)){
            $product_price=array($price1['price']);
            $values= array_sum($product_price);
            $total +=$values;
        }
    }
    echo $total;
}

function getproductbymaincategory(){
    if(isset($_GET['cat'])){
    $mcat_id= $_GET['cat'];
    global $mysqli;
    $get = "select * from product where subcat in( select sc_id from subcategory where maincat in(select mc_id from maincategory where mc_id=$mcat_id))";
    //$get = "select * from product Inner join subcategory on product.subcat=subcategory.sc_id Inner join maincategory on  subcategory.maincat=$mcat_id LIMIT 9";  
    $run= mysqli_query($mysqli, $get);
    //SELECT * FROM test WHERE 
   //id IN(SELECT id FROM test group by id HAVING count(id) > 1)
    echo mysql_error();
    if($run->num_rows > 0){
    while ($row = mysqli_fetch_array($run)) {
        //print_r($row);
        $p_id=$row['p_id'];
        //echo $p_id;
        $p_name=$row['p_name'];
        $p_image=$row['p_image'];
        $price=$row['price'];
    
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
    }  else {
            echo "No Product";
        }
    }   
}

?>
