<?php
	require "database.php";
	require "model/User.php";
	require "model/Xiaomi.php";
	require "model/vivoy53.php";

	if(isset($_POST["id"])){
		$id = $_POST["id"];
		$sql = "DELETE from phukien where id = ".$id;
		$db->query($sql);
	}
	

	if(isset($_POST['logout'])){
		require_once "index.php";
	}
	
$user = null;
	if(isset($_POST["username"]) && isset($_POST["password"])){
		$username = $_POST["username"];
		$password = $_POST["password"];
		$sql = "SELECT * from user where username='$username' and password='$password'";
		$user = $db->query($sql)->fetch_object("User");
	} else {
		
	}
	$sql = "SELECT * FROM `phukien`";
	$result = $db->query($sql)->fetch_all(MYSQLI_ASSOC);

 	
	$phukiens = array();
	for($i = 0; $i < count($result); $i++) {
		$phukien = $result[$i];
		if($phukien['type'] == 'bao da op lung'){
			array_push($phukiens, new vivoy53($phukien['id'],$phukien['name'],$phukien['price'],
				$phukien['image']));
		}
	
		if($phukien['type'] == 'cuc sac du phong'){
			array_push($phukiens, new Xiaomi($phukien['id'],$phukien['name'],$phukien['price'],
				$phukien['image']));
	}
		if($phukien['type'] == 'op lung'){
			array_push($phukiens, new vivoy53($phukien['id'],$phukien['name'],$phukien['price'],
				$phukien['image']));
		}
	
		if($phukien['type'] == 'phone'){
			array_push($phukiens, new Xiaomi($phukien['id'],$phukien['name'],$phukien['price'],$phukien['image']));
	}
	if($phukien['type'] == 'gay chup anh'){
			array_push($phukiens, new Xiaomi($phukien['id'],$phukien['name'],$phukien['price'],
				$phukien['image']));
	}
	}


// Delete
	if(isset($_POST["id"])){
        $id = $_POST["id"];
        $sql = "DELETE from `phukien` where id= ".$id;
        $db->query($sql);
        }

		
?>

<!DOCTYPE html>
<html>
<head>
	<title>WebPhukien</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
	<div class="header">
		<h1 class="brand">MyShop</h1>

		<form style="margin-left: 300px;"class="example" action="search.php" method="post"style="margin:auto;max-width:300px">
		  <input style="border-radius: 5px;height: 25px;"type="text" placeholder="Search.." name="search">
		  <input type="submit" name="submit">
		  <!-- <button type="submit"><i class="fa fa-search"></i></button> -->
		</form>
		<?php 
			if($user == null) {
		?>		
				<div>
				<form action="loginUserAdmin.php"method="post">
					<button onclick="onLoginClicked()">Login</button>
				</form>
				</div>
		<?php
			} else { 
		?>		
				<div class="user-info">
					<marquee style="color: red;"><p class="name">wecome to myshop <?php echo $user->getShortName() ?></p></marquee>
					<form action="" method="post"><button><img style="width: 20px;height: 20px;"src="images/accessories/out.png"name="logout"></button></form>
				</div>
		<?php 
			}
		?>
	</div>
	
<br>
	<br>
	<br>
	<div id="menu">
		  <ul>
		    <li><a class="nav-link"href="index.php"><b>Trang chủ</b></a></li>
		    <li><a class="nav-link"href="pk.php"><b>Phụ kiện</b></a></li>
		    <li><a class="nav-link"href="lienhe.php"><b>Liên hệ</b></a></li>
		   <li> <form action="add.php"method="post">
			<button style="border-radius: 5px;"type="submit"onClick="edit()">Add</button>
			</form>
		</li>
		  </ul>
	</div>
	
	 
		<script type="text/javascript">
		var image = ["3.jpg","5.gif","6.png"];
		var position = 0;
		setInterval(function(){
			position = position +1;
			document.getElementById("myImage").src = image[position];
			if(position==2){
				position = 0;
			}
},3000);
	</script>
		<div>
			<img id = "myImage"src = "3.jpg" style="width: 95%;margin-left: 25px;">
		</div>
		<img src="2.jpg"style="width: 80%;margin-left: 120px;margin-top: 20px;border-radius: 10px;">
		

    <form action="" method="post">
        <div class="container-pk">
            <?php 
                for($i = 0; $i < count($phukiens); $i++){
            ?>
                
                <div class="item-pk">
                    <img class="item-pk-icon" src=<?php echo $phukiens[$i]->getImagePath(); ?>>
                    <p class="item-pk-name"><?php echo $phukiens[$i]->name ?></p>
                    <p class="item-pk-type"><?php echo $phukiens[$i]->getType()?></p>
                    <p class="item-pk-price"><?php echo $phukiens[$i]->getDisplayPrice() ?></p>
                    <p class="item-pk-old-price"><?php echo $phukiens[$i]->getDisplayOldPrice() ?></p>
                    <p><form action="editF.php" method="post"><button name="edit-id" value="<?php echo $phukiens[$i]->id; ?>" onclick="onEditClicked()">Edit</button></>
                    <button name='id' value="<?php echo $phukiens[$i]->id; ?>">Delete</button>
              		</p>
                 	</div>		
		<?php
         }
       ?>

        </div>
    </form>
	<div class="footer">
		<p>My web</p>
	</div>
	<script src="index.js"></script>
</body>
</html>