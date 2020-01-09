<?php
require "database.php";
require "model/Xiaomi.php";

$sql = "SELECT * FROM `phukien`";
	$result = $db->query($sql)->fetch_all(MYSQLI_ASSOC);
	$phukiens = array();
	for($i = 0; $i < count($result); $i++) {
		$phukien = $result[$i];
		
	if($phukien['type'] == 'cuc sac du phong'){
			array_push($phukiens, new Xiaomi($phukien['id'],$phukien['name'],$phukien['price'],
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
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<form action="" method="post">

<div class="container-pk">
 	<?php
 for($i = 0; $i < count($phukiens); $i++){
            ?>
          
           <div class="item">
           <img class="item-pk-icon" src=<?php echo $phukiens[$i]->getImagePath(); ?>>
            <p class="item-pk-name"><?php echo $phukiens[$i]->name ?></p>
            <p class="item-pk-type"><?php echo $phukiens[$i]->getType()?></p>
            <p class="item-pk-price"><?php echo $phukiens[$i]->getDisplayPrice() ?></p>
            <p class="item-pk-old-price"><?php echo $phukiens[$i]->getDisplayOldPrice() ?></p>

            </div>  
			<?php
              }
            ?> 

            <a href="index.php"class="back">Back</a>

</div>

</form>
</body>
</html>
               

