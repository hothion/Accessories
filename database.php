<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "phu_kien";
$db = new mysqli($servername, $username, $password, $database);
$sql = "SELECT * FROM `phukien`";
$result = $db->query($sql)->fetch_all(MYSQLI_ASSOC);

?>