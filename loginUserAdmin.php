
<?php
require "database.php";
require "model/User.php";
session_start();
// $user = null;
	if(isset($_POST["username"]) && isset($_POST["password"])){
		$username = $_POST["username"];
		$password = $_POST["password"];
		$sql = "SELECT * from user where username='$username' and password='$password'";
		$user = $db->query($sql)->fetch_object("User");
	
	 if($user && $user->canBuyPhuKien()){
	 	$_SESSION['user']=new User($user->id, null, $user->fullName, null, null, null);
	 	header("location: indexUser.php");
	 } 
	 	if($user && $user->canManagePhuKien()){
	 	$_SESSION['admin']=new User($user->id, null, $user->fullName, null, null, null);
		header("location: indexAdmin.php");
	 	}
	 	else if($username== "" || $password == ""){
                echo "<script> alert(' Please enter full information!'); </script>";
            }
            else{
                echo "<script> alert(' Username or Password wrong!'); </script>";
            }  
        }

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<form id="login-form" class="login" method="post">
		<h1>Login</h1>
		<input type="text" name="username" placeholder="Username">
		<input type="password" name="password" placeholder="Password">
		<button type="submit">Login</button>
	</form>
</body>
</html>