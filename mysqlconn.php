<?php
$mysqli = new mysqli("localhost","root","root", "clothstore");
if($mysqli->connect_errno){
	echo "Failed to connect to MySQL";
}
?>