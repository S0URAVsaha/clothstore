<?php
session_start();


if($_SESSION['login_status'] == true){
	
	session_destroy();
        header('Location: http://localhost:8888/clothstore/clothstore/home.php') ;
}else{
	
        header('Location: http://localhost:8888/clothstore/clothstore/home.php') ;
}
?>
