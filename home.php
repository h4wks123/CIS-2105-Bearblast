<!-- Customer Page -->
<?php
ob_start();
//--Nav-Bar--//
include("sidenavcustomer.php");

$host = "localhost";
$user = "root";
$pass = "";
$db = "bearblast";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT `food_product_id`, `product_name`, `description`, `food_quantity`, `availability`, `product_price` FROM `food_product`";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Homepage</title>
    <link rel="stylesheet" href="css\bearblast.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />

</head>


<body style="background-image:
                linear-gradient(
                    rgba(0,0,0,0.5),
                    rgba(0,0,0,0.5)
                ),
                url('images/homepage.jpg');
             background-repeat: no-repeat;
             background-size: cover;">

    <div class="name" style="width: 45%; 
                     position: absolute; 
                     top: 110px; 
                     left: 280px;
                     background-color: rgba(152, 175, 199, 0.9);
                     font-size: 40px;
                     text-shadow: 2px 2px 0 #000;
                     padding: 20px 0;
                     letter-spacing: 20px;
                     border-top-right-radius: 20px;
                     border-bottom-right-radius: 20px;">
        <b>&nbsp;&nbsp;&nbsp;&nbsp;WELCOME TO </b>
    </div>

    <div class="name" style="width: 45%; 
                     position: absolute; 
                     top: 320px; 
                     right: 340px;
                     background-color: rgba(84, 98, 111, 0.9);
                     font-size: 70px;
                     text-shadow: 2px 2px 0 #000;
                     padding: 20px 0;
                     letter-spacing: 20px;
                     border-radius: 20px;">
        <b>&nbsp;&nbsp;BEARBLAST!</b>
    </div>

    <div class="name" style="width: 50%; 
                     position: absolute; 
                     top: 560px; 
                     right: 0px;
                     background-color: rgba(152, 175, 199, 0.8);
                     font-size: 25px;
                     text-shadow: 1px 1px 0 #000;
                     padding: 10px 0;
                     letter-spacing: 10px;
                     border-top-left-radius: 20px;
                     border-bottom-left-radius: 20px;">
        <b>&nbsp;&nbsp;&nbsp;Enjoy our drinks like no other!</b>
    </div>
</body>


</html>