<?php
// include "mysqlconn.php";

// global $mysqli;
// $sql="select * from member";
// $result=  mysqli_query($mysqli, $sql);
// $row = array();
// while($r = mysqli_fetch_assoc($result)) {
//     $row[] = $r;
// }
// $a= json_encode($row);

?>
<?php header('Access-Control-Allow-Origin: *'); ?>

<html>
<head>
	<title></title>
	<script type="text/javascript">
	var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        var myObj = JSON.parse(this.responseText);
        document.getElementById("demo").innerHTML = myObj[2];
    }
};
xmlhttp.open("GET", "https://www.srv.com/req.php", true);
xmlhttp.send();
	</script>
</head>
<body>
	<div id="demo"></div>
<?php //$b = json_decode($a);
	//echo $b[0];
 ?>
</body>
</html>
<?php //echo $a; 
?>