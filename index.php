<?php
	require "database.php";
	require "model/User.php";
	require "model/Xiaomi.php";
	require "model/vivoy53.php";

	session_start();
	if(isset($_POST["id"])){
		$id = $_POST["id"];
		$sql = "DELETE from phukien where id = ".$id;
		$db->query($sql);
	}
	if (isset($_POST["register"])){
    
	$username =$_POST["username"];
	$password =$_POST["password"];
	$fullName =$_POST["fullName"];
	$email =$_POST["email"];
	$role =$_POST["role"];

	$sql= "INSERT INTO  user values('$username','$password','$fullName', '$email', '$role')";
	$db->query($sql);
	echo "<script> alert(' dang ki thanh cong'); </script>";		
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


	for($i = 0; $i < count($phukiens); $i++){
		$carts = array();
		if(isset($_POST[$i])){
			$name = $carts[$i]->name;
			$type = $carts[$i]->getType();
			$price = $carts[$i]->getDisplayPrice();

			$sql = "INSERT into cart values(null, '$name', $price, '$type')";
            $db->query($sql);
		}
	}

// Delete
	if(isset($_POST["id"])){
        $id = $_POST["id"];
        $sql = "DELETE from `phukien` where id= ".$id;
        $db->query($sql);
        }

	if(isset($_POST['cart'])){
		$sql = "SELECT * from cart";
       	$result = $db->query($sql)->fetch_all();
	}

	
//Add to cart
	if(isset($_POST["insertCart"])){
        $i=$_POST["insertCart"]-1;     
        $id=$i+1;
        $check=false;
        for($j = 0; $j < count($result1); $j++) {
            if ($result1[$j][1]==$id){
                $check=true;
                $sql1 = "UPDATE cart SET quantity = ".($result1[$j][5]+1).", total=".($result1[$j][5]+1)*($result1[$j][4])." WHERE id_cart=".$id;
                $db->query($sql1);
            }
            else{
            break;
        }
    }
    if($check==false){
            $img=$result[$i]['image'];
            $price=$result[$i]['price'];
            $name=$result[$i]['name'];
            $quantity=1;
			$total=$price*$quantity;
            $sql1 = "INSERT into cart values(null,".$id.",'".$img."','".$name."',".$price.",".$quantity.",".$total.")";
            $db->query($sql1);
    }
    }

		if(isset($_POST['edit-id'])){
			echo "<script> document.getElementById('edit_form').style.display='flex';</script>";
		        $sql = "SELECT * FROM phukien WHERE id =".$_POST['edit-id'];
		        $result = $db->query($sql)->fetch_all(MYSQLI_ASSOC);
		        $phk = ($result);

		        
		    }
		if(isset($_POST['edit'])){
		$id=$_POST['id_edit'];	
        $name=$_POST['name'];
	    $price=$_POST['price'];
	    $type=$_POST['type'];
		$image=$_POST['image'];
        $sql='UPDATE phukien set name="'.$name.'", price='.$price.', type='.$type.'image="images/accessories/'.$image.'" WHERE id='.$_POST['id_edit'].'';
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

		<form style="margin-left: 300px;"class="example" action="search.php" method="post"style="margin:auto;max-width:350px">
		  <input style="border-radius: 5px;height: 25px;"type="text" placeholder="Search.." name="search">
		  <input type="submit" name="submit">
		  <!-- <button type="submit"><i class="fa fa-search"></i></button> -->
		</form>
		<?php 
			if($user == null) {
		?>		
				<div>
					<form action="loginUserAdmin.php"method="post">
					<button style="border-radius:5px;font-size: 13px;top: 20px;"onclick="onLoginClicked()">Login</button>
					</form>
					<form action="register.php"method="post">
					<button style="border-radius:5px;font-size: 13px;top: 25px;"onclick="onRegisterClicked()">Register</button>
					</form>
				</div>
		<?php
			} else { 
		?>		
				<div class="user-info">
					<marquee style="color: red;"><p class="name">wecome to myshop <?php echo $user->getShortName() ?></p></marquee>
					<div class="cart-info">
					<form action="cart.php" method="post">
						<button style="background: none;"><img style="width: 25px;height: 30px;"src="images/accessories/cart.jpg"name="cart" class="cart"></button>
					</form>
						<!-- <span class="cart-number"></span> -->
					</div>
					<form action="" method="post"><button><img style="width: 20px;height: 20px;"src="images/accessories/out.png"name="logout"></button></form>
				</div>
		<?php 
			}
		?>
	</div>
	
	<form id="login-form" class="login" method="post">
		<h1>Login</h1>
		<input type="text" name="username" placeholder="Username">
		<input type="password" name="password" placeholder="Password">
		<button type="submit">Login</button>
	</form>

	<form id="register-form" class="login" method="post">
		<h1>Register</h1>
		<input type="text" name="username" placeholder="Username" required=" Vui long dien day du thong tin">
		<input type="password" name="password" placeholder="Password" required=" Vui long dien day du thong tin">
		<input type="text" name="fullName" placeholder="FullName" required=" Vui long dien day du thong tin">
		<input type="email" name="email" placeholder="Enter your email" required=" Vui long dien day du thong tin">
		<input type="text" name="role" placeholder="Role" required=" Vui long dien day du thong tin">
		<button type="submit" class="button" name="register">Register</button>
	</form>

	<br>
	<br>
	<br>
	<div id="menu">
		  <ul>
		    <li><a class="nav-link"href="index.php"><b>Trang chủ</b></a></li>
		    <li><a class="nav-link"href="pk.php"><b>Phụ kiện</b></a></li>
		    <li><a class="nav-link"href="lienhe.php"><b>Liên hệ</b></a></li>
		   <li> <form method="post">
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
        <div class="pk-container">
            <?php 
                for($i = 0; $i < count($phukiens); $i++){
            ?>
                
                <div class="item-pk">
                    <img class="item-pk-icon" src=<?php echo $phukiens[$i]->getImagePath(); ?>>
                    <p class="item-pk-name"><?php echo $phukiens[$i]->name ?></p>
                    <p class="item-pk-type"><?php echo $phukiens[$i]->getType()?></p>
                    <p class="item-pk-price"><?php echo $phukiens[$i]->getDisplayPrice() ?></p>
                    <p class="item-pk-old-price"><?php echo $phukiens[$i]->getDisplayOldPrice() ?></p>
                    <?php 
                    if($user && $user->canManagePhuKien()){
                    
					//for($i=0;$i<count($result);$i++){?>
                    <div class="EditAndDe">
                    <form action=""method="post"class="item-pk-edit">
                   <button type="submit" name="edit-id"value="<?php echo $phukiens[$i]->id;?>">Edit</button>
					</form>
					<button class="item-pk-delete" name='id' value="<?php echo $phukiens[$i]->id; ?>">Delete
					</button>
					</div>
					
        <form method="post" id=edit_form style="display:none">
    	<div>
          <label for="">ID
          </label>
            <input type="text"name="id_edit" value="<?php echo $phk['id']?>" placeholder="">
        </div>
        <div>
        	<label for="">Name
        	</label>
            <input type="text"name="name"value="<?php echo $phk['name']?>" placeholder="">
        </div>
            <div>
            <label for="">Price</label>
            <input type="input" name="price" value="<?php echo $phk['price']?>" placeholder="">
            </div>
            <div>
            <label for="">Type</label>
            <input type="type" name="type" value="<?php echo $phk['type']?>" placeholder="">
            </div>
            <div>
            <label for="">Picture</label>
            <input type="file"name="image"value="<?php echo $phk['image']?>" placeholder="">
            </div>
            <div>
           <button type="submit" name="edit" value="<?php echo $phk['id'];?>" class="btn btn-primary">OK</button>
            
           </div>
         </form>
	 
					
		<?php
                        }
                    ?>			
		<?php
                   if($user && $user->canBuyPhuKien()) {?>
                  <form action=""method="post">
	               <input type="number" name="quantity" value="1" min="1" max="<?=$phukien['quantity']?>" placeholder="Quantity" required>
			        <input type="hidden" name="id" value="<?=$phukien['id']?>">
			        <button class="add" name="insert_cart" value="<?php echo $shoes[$i]->id;?>">Add</button>
			        </form>
	        		<?php
                        }
                    ?>
                
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