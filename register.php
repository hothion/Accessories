<?php
require"database.php";
session_start();

if(isset($_POST["register"])){
	$username=$_POST["username"];
	$password=$_POST["password"];
	$fullName=$_POST["fullName"];
	$email=$_POST["email"];
	$role=$_POST["role"];

	$sql = "INSERT INTO(username, password,fullName,email,role)
				VALUES('$username', 'password','fullName',$email', '$role')";
	$db->query($sql);

	$_SESSION['username'] = $username;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: index.php');
}else if($username== "" || $password == ""||$fullName== "" || $email == ""|| $role=""){
	 echo "<script> alert(' Please enter full information!'); </script>";
}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<form style="margin-top:50px;border-radius: 5px;"id="register-form" class="login" method="post">
		<h1>Register</h1>
		<input type="text" name="username" placeholder="Username" required=" Vui long dien day du thong tin">
		<input type="password" name="password" placeholder="Password" required=" Vui long dien day du thong tin">
		<input type="text" name="fullName" placeholder="FullName" required=" Vui long dien day du thong tin">
		<input type="email" name="email" placeholder="Enter your email" required=" Vui long dien day du thong tin">
		<input type="text" name="role" placeholder="Role" required=" Vui long dien day du thong tin">
		<button type="submit" class="button" name="register">Register</button>
	</form>
</body>
</html>