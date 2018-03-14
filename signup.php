<?php
include "mysqlconn.php";
include 'category.php';
?>
<html>
<head>
<title>signup</title>
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
                <?php if(isset($_SESSION['u_level'])){ ?> <td><a href="admin.php">Admin Panel</a></td> <?php } ?>
                <td><div id="shopping_cart">Welcome Guest! 
                        
                    </div></td>
              </tr>
                  </table>
        </div>
    </div>
        
        <div id="">
            <form action="" method="POST">
        <table bgcolor="#FFF">  
    <tr align="right"><h3>INSERT YOUR INFO</h3></tr>
  
    <tr>
        <td align="right"><b>Full Name</b></td>
        <td><input type="text" name="fname" required/></td>
    </tr>
    <tr>
        <td align="right"><b>Mobile Number</b></td>
        <td><input type="tel" name="mnumb" required/></td>
    </tr>
    <tr>
        <td align="right"><b>Email</b></td>
        <td><input type="email" name="email" required/></td>
    </tr>
    <tr>
        <td align="right"><b>Password</b></td>
        <td><input type="password" name="password" required/></td>
    </tr>
    <tr>
        <td align="right"><b>Address</b></td>
        <td><textarea name="address" cols="18" rows="4" required/></textarea></td>
    </tr>
    <tr>
        <td align="right"><b>City</b></td>
        <td><input type="text" name="city" required/></td>
    </tr>
    
        <tr><td></td><td><input type="submit" name="submit" /><input type="reset" /></td></tr>
        </table>
    </form>
        <?php
        if(isset($_POST["submit"])){
        $email =($_POST["email"]);
        $password = hash('sha256',$_POST['password']);
        $city =($_POST["city"]);
            if (preg_match("/^[a-zA-Z ]*$/",$_REQUEST['fname'])) {
            $fname =($_POST["fname"]);
            
               if(strlen($_REQUEST['mnumb']) == 11 and substr($_REQUEST['mnumb'], 0, 2) == "01") {
               $mnumb=($_POST["mnumb"]);
               
                if (preg_match("/^[a-zA-Z0-9&:#,-. ]*$/",$_REQUEST['address'])) {
                    $address =($_POST["address"]);
               
               if(empty($_POST["fname"]) or empty($_POST["mnumb"]) or empty($_POST["email"]) or empty($_POST["password"]) or empty($_POST["address"]) or empty($_POST["city"])){
                   echo "fill up all fields";
               }else{
                  $sql = "INSERT INTO member ( fullname,mnumb,email,password,address,city)

    VALUES('$fname','$mnumb','$email','$password','$address','$city')";

    if ($mysqli->query($sql) === TRUE) {
        echo "New record created successfully You will redirect to login page after 3sec";
        //header('Refresh: 5;url=login.php');
        echo '<META HTTP-EQUIV="Refresh" Content="4; URL=login.php">';
} else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    
    }
    $mysqli->close();
    }
                }else{
                   echo "Only letters, white space - & : # , . allowed in ADDRESS";
               }
               }else{
                   echo "Invalid Mobile Number";
               }
               
                }else{
        
                    echo " Only letters and white space allowed in NAME";
                }
}
        
            ?>

</div>

</body>
<div id="footer"></div>   
    </div>
</html>

