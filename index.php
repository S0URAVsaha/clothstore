<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        
        function category1(){
    global $mysqli;
    $get = "select * from subcategory Inner join maincategory on subcategory.maincat=maincategory.mc_id";  
    $run= mysqli_query($mysqli,$get);
    
    while ($row = mysqli_fetch_array($run)) {
        $sc_id=$row['sc_id'];
        $sc_name=$row['sc_name'];
        $maincat=$row['maincat'];
        
        echo "<li><a href='home.php?cat=$sc_id'>$sc_name</a></li>"
                . "<a href='detail.php?pcat=$p_id'><b>$p_name</b></a>";
    }
}

        
        function detailproduct(){
    if(isset($_GET['pcat'])){
    $cat_id= $_GET['pcat'];
    global $mysqli;

    $get="select * from product where p_id='$cat_id'";  
    $run= mysqli_query($mysqli, $get);
    
    while ($row = mysqli_fetch_array($run)) {
        $p_id=$row['p_id'];
        $p_name=$row['p_name'];
        $p_image=$row['p_image'];
        $p_detail=$row['p_details'];
        $price=$row['price'];
        $size1name=$row['size1name'];
        $size1qty=$row['size1qty'];
        $size2name=$row['size2name'];
        $size2qty=$row['size2qty'];
        $size3name=$row['size3name'];
        $size3qty=$row['size3qty'];

        echo "
                   <img src='$p_image' width='500' height='500' float='left'/>
                       <div id='detail_box'>
                       <p>$p_name</p>
                           <hr>
                           
                      <p><h3>Tk $price</h3></p>
                      <b>Size</b>&nbsp;&nbsp;&nbsp; "
                //. "<a href='#?size1name=$size1name'><INPUT TYPE='radio'><b>$size1name</b></input></a>"
                //. "&nbsp;&nbsp;&nbsp;<a href='#?size1name=$size2name'><INPUT TYPE='radio'><b>$size2name</b></input></a>"
                //. "&nbsp;&nbsp;&nbsp;<a href='#?size1name=$size3name'><INPUT TYPE='radio'><b>$size3name</b></input></a>";
        ?>
<!--<form method="post" action="detail.php"<?php //echo htmlspecialchars($_SERVER["PHP_SELF"]);?>>
    
<INPUT TYPE="radio" NAME="size1name" value="<?php//echo"<a href='#?size1name=$size2name'> $size1name </a>";?>"><?php// echo"<a href='#?size1name=$size2name'> $size1name </a>";?>
<INPUT TYPE="radio" NAME="size1name" value="size2name"><?php// echo"<a href='#?size1name=$size2name'> $size2name  </a>";?>
<INPUT TYPE="radio" NAME="size1name" value="size3name"><?php// echo"<a href='#?size1name=$size2name'> $size3name </a>";?>
 </form>-->
<?php
                          
         echo " <br><br><br><a href='detail.php?pidfromcart=$p_id' ><button style='float:left; color:#FFF; width:80px; height:40px; background-color:orange;'><font size='2px'><b>Add to Cart</b></button></a>
                       
                       <br><br><br><hr>
                       <center><u>Description</u></center>
                       <p>$p_detail</p>                        
</div>
           ";

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
    if(isset($_GET['pidfromcart'])){
        if ($_SESSION['login_status'] == true) {
            $u_check=$_SESSION['login_status'];
            if(isset($u_check)){
                    if(isset($_GET['size1name']) or isset($_GET['size2name']) or isset($_GET['size3name'])){
        $pidfromcart=$_GET['pidfromcart'];
        $s1=$_GET['size1name'];
        $s2=$_GET['size2name'];
        $s3=$_GET['size3name'];
        global $mysqli;
        $insert_item= "insert into cart (p_id,u_id,size) values ('$pidfromcart','$u_check','$s1 or $s2 or $s3')";
        $run= mysqli_query($mysqli, $insert_item);
        }
            }
            }else {
           echo '<META HTTP-EQUIV="Refresh" Content="0; URL=login.php">'; 
        }
    }  
}

function totalitems(){
    if ($_SESSION['login_status'] == true) {
    if (isset($_GET['pidfromcart'])){
        $u_check=$_SESSION['login_status'];
        global $mysqli;
        $get="select * from cart where u_id=$u_check";
        $run= mysqli_query($mysqli, $get);
        $count = mysqli_num_rows($run);
    }else{
        $u_check=$_SESSION['login_status'];
        global $mysqli;
        $get="select * from cart where u_id=$u_check";
        $run= mysqli_query($mysqli, $get);
        $count = mysqli_num_rows($run);
    }
    echo $count;
}
}
function detailproduct2(){
    if(isset($_GET['pcat'])){
    $cat_id= $_GET['pcat'];
    global $mysqli;

    $get="select * from product where p_id='$cat_id'";  
    $run= mysqli_query($mysqli, $get);
    
    while ($row = mysqli_fetch_array($run)) {
        $p_id=$row['p_id'];
        $p_name=$row['p_name'];
        $p_image=$row['p_image'];
        $p_detail=$row['p_details'];
        $price=$row['price'];
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
        
        echo "
                   <img src='$p_image' width='500' height='500' float='left'/>
                       <div id='detail_box'>
                       <p>$p_name</p>
                           <hr>
                           
                      <p><h3>Tk $price</h3></p>
                      <b>Size</b>&nbsp;&nbsp;&nbsp;";
        ?>
<form method="post" action="">
    <table>
        <tr><INPUT TYPE="radio" NAME="sal" value="<?php echo $size1name;?>"><?php echo"<a href='#?size1qty=$size1qty'> $size1name </a>";?></tr>
        <tr><INPUT TYPE="radio" NAME="sal" value="<?php echo $size2name;?>"><?php echo"<a href='#?size2qty=$size2qty'> $size2name </a>";?></tr>
        <tr><INPUT TYPE="radio" NAME="sal" value="<?php echo $size3name;?>"><?php echo"<a href='#?size3qty=$size3qty'> $size3name </a>";?></tr>
        <tr><INPUT TYPE="radio" NAME="sal" value="<?php echo $size4name;?>"><?php echo"<a href='#?size4qty=$size4qty'> $size4name </a>";?></tr>
        <tr><INPUT TYPE="radio" NAME="sal" value="<?php echo $size5name;?>"><?php echo"<a href='#?size5qty=$size5qty'> $size5name </a>";?></tr>
        <tr> 
            <td bgcolor="#FFF0F5"><input type="text" name="qty"></td>
            <td bgcolor="#FFF0F5" align="center"><a><input type="submit" name="add_to_cart" value="ADD to Cart"></a></td>
          </tr>
    </table>
</form>
<?php
             
         //echo " <br><br><br><a href='detail.php?pidfromcart=$p_id' ><button style='float:left; color:#FFF; width:80px; height:40px; background-color:orange;'><font size='2px'><b>Add to Cart</b></button></a>
                       
echo "                   <br><br><br><hr>
                         <center><u>Description</u></center>
                         <p>$p_detail</p>                        
</div>
           ";

}
    }
}

function mobilenumbercheck(){

   if(!isset($_REQUEST['text_message']) || empty($_REQUEST['text_message'])) {
      //Here is null or undefined or an empty string
      $errors[] = "Please enter your mobile number for text messages";
   }

   if(!is_numeric($_REQUEST['text_message'])) {
      $errors[] = "Please provide a valid number";
   }

   if(strlen($_REQUEST['text_message']) !== 11) {
      //Here is not 11 characters long
      $errors[] = "Please provide 11 character number";   
   }

   if(substr($_REQUEST['text_message'], 0, 2) !== "07") {

      $errors[] = "Please provide number with 07 in the first two digits";   
   }   


   if(count($errors) > 0) {

      echo "Resolve this errors: ";
      print_r($errors);
   }
   else {
      echo "You did everything perfect";
   }

}


            ?>

        ?>
    </body>
</html>
