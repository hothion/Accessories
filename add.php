<?php
require"database.php";


if(isset($_POST['add'])){
	   $name=$_POST['name'];
	   $price=$_POST['price'];
	   $type=$_POST['type'];
    
    $target_file = "" . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    // strtolower: convert string to lowercase
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    	$uploadOk = 0;
    }

       $stm = "INSERT INTO phukien VALUES (null, '$name', $price, '$type', '$target_file')";
		 $db->query($stm);
		 /*$sql="select * from phukien;";
		 $kq=$db->query($sql)->fetch_all();*/

    }

		 

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
	

	<form action=""method="post" enctype="multipart/form-data">
					<h1 style="margin-left:350px;">Add Information</h1>
					<br>
					<label>Name:</label>
					<input type="text" name="name" placeholder="Name">
					<label>Price:</label>
					<input type="text" name="price" placeholder="Price">
					<label>Type:</label>
					<input type="text" name="type" placeholder="Type">
					
        <input type="file" name="fileToUpload" id="fileToUpload">
        
    
					<button style="margin-top: 20px;"type="submit" name="add" onClick="update()"><strong>Update</strong></button>
					<button><a href="index.php"class="none">Home</a>
					</button>
					
				</form>
			
</div>
</body>
</html>
