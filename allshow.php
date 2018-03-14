<!DOCTYPE html>
<html lang="en">
<?php 
include("mysqlconn.php");
?>
<body>
<h1>Product  Details</h1>	

<?php 
$sql= "SELECT*FROM product ";

$res = mysql_query($sql);

	while ($row = mysql_fetch_array($res)) {

		$pid=$row['p_id'];
		$pname=$row['p_name'];
		$subcat=$row['subcat'];
     $details=$row['p_details'];
     $fabric=$row['fabric'];
     $color=$row['color'];
     $gender=$row['gender'];
     $wash=$row['wash_care'];
     $price=$row['price'];
     $image=$row['p_image'];
     $size1n=$row['size1name'];
     $size1q=$row['size1qty'];
     $size2n=$row['size2name'];
     $size2q=$row['size2qty'];
     $size3n=$row['size3name'];
     $size3q=$row['size3qty'];
     $size4n=$row['size4name'];
     $size4q=$row['size4qty'];
     $size5n=$row['size5name'];
     $size5q=$row['size5qty'];
		echo "Product ID-".$pid."-".$pname."-".$subcat."-".$details."-".$fabric."-".$color."-".$gender."-".$wash."-".$price."tk-".$image."-"."Small-".$size1q."piece"."-"."Medium-".$size2q."piece-"."Large".$size3q."piece-"."XL".$size4q."piece-"."XXL".$size5q."piece" ;
		echo " ";
		echo ("<a href='edit.php?edit=$pid'>Edit</a>");
		
		echo "<br>";
        echo "<br>";
         
}
?>
<?php 
     if (isset($_POST['id'])) {
     	$did=$_POST['id'];
     	

     	$dlt="DELETE FROM product WHERE p_id='$did'";
     	 if (mysql_query($dlt)) {
               ?>
               <script>var ret=window.confirm('Delete Successfull'); if (ret==true) {
                 window.location.replace('productlist.php');}
               </script> <?php 
         }     

}

 ?>

<form action="productlist.php" method="POST">
	Enter the ID of The Product you Want to delete:<br>
<input type="text" name="id">
<br>
<input type="submit" name="submit">

</form>

 


 
</body>
  