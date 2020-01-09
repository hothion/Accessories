<?php
require"database.php";
// require"indexAdmin.php";


if(isset($_POST['edit-id'])){
			 echo "<script> document.getElementById('edit_form').style.display='flex';</script>";
		        $sql = "SELECT * FROM phukien WHERE id =".$_POST['edit-id'];
		        $result = mysqli_query($db, $sql);
		        $phukiens = mysqli_fetch_array($result);
            }
		if(isset($_POST['edit'])){
		$id=$_POST['id_edit'];	
        $name=$_POST['name'];
	    $price=$_POST['price'];
	    $type=$_POST['type'];
		
        $sql="UPDATE phukien set name='$name', price=$price, type='$type' WHERE id=".$_POST['id_edit'];
        if ($db->query($sql) === TRUE) {
            header("Location: indexAdmin.php");
        } else {
            echo "Error updating record: " . $db->error;
        }
        }
    ?>
    <!DOCTYPE html>
    <html>
    <head>
    	<title></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    </head>
    <body>
        <form action="" id="edit_form"method="post">
    
    		<div>
          <label>ID
          </label>
            <input readonly name="id_edit" value="<?php echo $phukiens['id']?>" placeholder="">
        </div>
        <div>
        	<label>Name
        	</label>
            <input type="text"name="name"value="<?php echo $phukiens['name']?>" placeholder="">
        </div>
            <div>
            <label for="">Price</label>
            <input type="input" name="price" value="<?php echo $phukiens['price']?>" placeholder="">
            </div>
            <div>
            <label for="">Type</label>
            <input type="type" name="type" value="<?php echo $phukiens['type']?>" placeholder="">
            </div>
            <div>
           <button type="submit" name="edit" value="<?php echo $phukiens['id'];?>" class="btn btn-primary">OK</button>
            
           </div>
         </form>
    </body>
    
    </html>