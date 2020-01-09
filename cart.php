<?php
require "database.php";
require "model/vivoy53.php";
require "model/Xiaomi.php";



session_start();

    $idproduct = $_GET['id'];
    $newproduct= array();
    if(isset($_SESSION['cart'])){
        $newproduct = json_decode($_SESSION['cart'],true);
        for($i = 0; $i < count($result); $i++) {
        if ( $result[$i]['id'] == $idproduct) {
          array_push($newproduct, new vivoy53($result[$i]['id'], $result[$i]['name'], $result[$i]['price'],$result[$i]['image'],$result[$i]['quantity']));
     }
    }
       }else{
        $newproduct= array();
        for($i = 0; $i < count($result); $i++) {
        if ( $result[$i]['id'] ==$idproduct) {
            array_push($newproduct, new Xiaomi($result[$i]['id'], $result[$i]['name'], $result[$i]['price'],$result[$i]['image'],$result[$i]['quantity']));
     }
    }
       }
    function sum($result){
        $sum=0;
        for($i = 0; $i < count($result); $i++) {
            $sum+=(($result[$i]['price'])*($result[$i]['quantity']));
        }
        return $sum;
    }


$_SESSION['cart'] = json_encode($newproduct);

    
if(isset($_POST["dele"])){
        $id = $_POST["dele"];
        $sql = "DELETE from `phukien` where id= ".$id;
        $db->query($sql);
        }
        
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<title></title>
<style type="text/css">
            
        .line{
                display: flex;
                width: 500px;
                justify-content: space-between;
                position: relative;
                margin: auto;
                align-items: center;
                text-align: center;
            }
            .btn{
                align-items: center;
                text-align: center;
                border-radius: 4px;
                background: red;
            }
            .ipt{
                height: 25px;
                weight: 100px;
            }
            .btn1{
                width: 100px;
                height: 30px;
                align-items: center;
                text-align: center;
                border-radius: 4px;
                background: red;
            }
            table,tr,th,td {
                border: black;
            }

            #tbl tr {
                height: 50px;
            }

            #tbl tr th {
                background: grey;
                flex: 0 0 25%;
                font-size: 15px;
                color: lime;
                text-transform: capitalize;
                font-weight: 400;
                font-weight: bold;
            }

            #tbl tr td {
                text-align: center;
                padding-left: 10px;
            }

            #tbl {
                margin-right: 60px;
                flex-grow: 2;
                align-items: center;
                text-align: center;
                margin-top: 0px;
                margin-bottom: 0px;
            }

            .pay{
                width: 600px;
                position: relative;
                margin: auto;
                border-style: solid;
                border-width: 1px;
                border-radius: 5px;
                font-size: 20px;
                margin-top: 50px;
            }

            .pay h1{
                color: darkblue;
                font-weight: bold;
                font-size: 20px;
                text-align: center;
            }

            .pay p{
                color: black;
                font-size: 18px;
                text-align: left;
                margin-left: 100px;
            }

            .pay button{
                float: right;
                border-style: solid;
                border-width: 1px;
                border-color: black;
                background-color: seagreen;
                color: white;
                font-weight: bold;
                font-size: 18px;
                margin-top: 20px;
            }

            
            .cart {
            position: relative;
            border: none;
            height: 30px;
            background: white;
            color: black;
            font-size: 15px;
        }

        .delete {
                border-width: 1px;
                background-color: red;
            }
        .delete:hover{
            border-color: black;
            color:whitesmoke;
        }  
        
        </style>
</head>
<body>
    <table style="margin-top: 50px;width: 97%;margin-left: 15px;" id="tbl" class="table table-striped">
        <tr>
            <th>ID</th>
            <th>Image</th>
            <th>Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total</th>
            <th>Delete</th>
        </tr>
    
<?php
    $new=json_decode($_SESSION['cart'],true);
    for($i = 0; $i < count($new); $i++){
        ?>
        <tr>
        <th scope="row"><?php echo $i+1?></th>
          <td>
          <img width="100"src=<?php echo "images/accessories/".$new[$i]['image']?>>
          </td>
          <td>
            <p><?php echo $new[$i]['name'] ?></p>
          </td>
          <td>
            <p><?php echo $new[$i]['price'] ?></p>
          </td>
          <td>
            <p><?php echo $new[$i]['quantity'] ?></p>
            </td>
            <td>
            <p><?php echo (($new[$i]['price'])*($new[$i]['quantity'])) ?></p>
            </td>
          <td>
        
          <button name="dele"><a style="text-decoration: none;" href="?id=<?php echo $new[$i]->id ?>"> Delete</a></button>
          </td>
         </tr>
    <?php
        }
        ?>
   </table>
   </div>
    <div class="pay">
    <h1>CỘNG GIỎ HÀNG</h1>
    <p>Tạm tính: <?php echo sum($new);?></p>
    <p>Phí giao hàng: <?php echo (sum($new)*0.01);?></p>
    <p>Tổng: <?php echo (sum($new)+(sum($new)*0.01));?></p>
    <form action = "" method="post">
    <button style="text-align: center;" name="order">Thanh toán</button>
    </form>
    </div>

   <a style="text-decoration: none"href="index.php">Home</a>
    <a style="text-decoration: none"href="indexUser.php">UserHome</a>
</body>
</html>


        
    