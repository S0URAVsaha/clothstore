<?php
session_start();
include "mysqlconn.php";
include 'category.php';
if(isset($_SESSION['login_status'])){
    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=home.php">';
}else{
?>
<html>
<head>
<title>login</title>
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
                <td><div id="shopping_cart">
                        
                    </div></td>
              </tr>
                  </table>
        </div>
    </div>
        
        <div id="">
            <table align=center width=100% border=0 cellspacing=0 cellpadding=5>
                             <tr>
                              <td bgcolor="#FFF"> 
                              <form action="" method="POST">
                              Fullname: <input type="text" name="fullname" /> <br><br>
                              Password: <input type="password" name="password" /> <br><br>
                              <input type="submit" name="login" value="login"/>
                              </form>
                              <br> &nbsp;&nbsp;&nbsp;<font face=verdana size=3><a  href=signup.php>Register</a></font>
                                </td>
                           </tr>
                        </table>
<?php
            if(isset($_POST["login"])){
               if(empty($_POST["fullname"]) or empty($_POST["password"])){
                   echo "1Enter fullname and password";
               }else{
               $fullname=$_POST["fullname"];
               $password = hash('sha256',$_POST['password']);
               $get = "select * from member where fullname='$fullname' and password = '$password'"; 
               $result=$mysqli->query($get);  
               
               if($result->num_rows > 0){
                   while($run=  mysqli_fetch_array($result)){
                   $u_id=$run['u_id'];
                   $u_level=$run['u_level'];
                   }
                   if($u_level=='0'){
                   $_SESSION["login_name"] = $fullname;
                   $_SESSION["login_status"] = $u_id;
                            //if(isset($_SESSION['login_status'])){ 
                            echo '<META HTTP-EQUIV="Refresh" Content="0; URL=home.php">';
                            //echo $name;
                            //echo "<a href='#?uid=$u_id' >You are logged in   </br> <a href='logout.php'>logout</a>";
                            //}
                            //else{
                
                    //echo "you are Not logged in";
            //}
                   }elseif($u_level=='admin'){
                       
                   $_SESSION["u_level"] = $u_level;
                   $_SESSION["login_name"] = $fullname;
                   $_SESSION["login_status"] = $u_id;
                            //if(isset($_SESSION['login_status'])){ 
                            echo '<META HTTP-EQUIV="Refresh" Content="0; URL=admin.php">';
                   }
               }else{
                            echo "Wrong Info";
                            session_unset();
               }
    }
    $mysqli->close();
            }
}
?>
        </div>
</body>
<div id="footer"></div>   
    </div>
</html>


