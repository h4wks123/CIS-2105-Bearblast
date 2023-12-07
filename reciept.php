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

$sql = "SELECT `orders`.*, `food_product`.`product_name`, `delivery`.`current_address`, `delivery`.`departure_time`, `delivery`.`delivery_status` 
        FROM `orders` 
        JOIN `food_product` ON `orders`.`food_product_id` = `food_product`.`food_product_id` 
        JOIN `delivery` ON `orders`.`delivery_id` = `delivery`.`delivery_id`
        WHERE `orders`.`customer_id` = '$users_idC'
        ORDER BY `orders`.`order_date_time` DESC";

$result = $conn->query($sql);

?>

<head>
    <meta charset="UTF-8" />
    <title>Homepage</title>
    <link rel="stylesheet" href="css\bearblast.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />

    <style>
        thead,
        tbody {
            background-color: white;
        }

        th {
            color: black;
        }
    </style>

</head>

<body>
    </br></br>
    <?php
    $current_delivery_id = null;

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {

            if ($row["delivery_id"] != $current_delivery_id) {
                if (!is_null($current_delivery_id)) {

                    $total_query = "SELECT ROUND(SUM(`total_price`), 2) as total FROM `orders` WHERE `delivery_id` = '$current_delivery_id'";
                    $total_row = $conn->query($total_query)->fetch_assoc();
                    $total = $total_row["total"];

                    $date_query = "SELECT `order_date`, `order_date_time` FROM `orders` WHERE `delivery_id` = '$current_delivery_id' LIMIT 1";
                    $delivery_query = "SELECT `current_address`, `delivery_status` FROM `delivery` WHERE `delivery_id` = '$current_delivery_id' LIMIT 1";
                    $date_row = $conn->query($date_query)->fetch_assoc();
                    $delivery_row = $conn->query($delivery_query)->fetch_assoc();
                    $date = $date_row["order_date"];
                    $time = $date_row["order_date_time"];
                    $address = $delivery_row["current_address"];
                    $status = $delivery_row["delivery_status"];

                    echo "<tr><td></td><td></td><td></td><td><b>TOTAL PRICE</b></td><td><b>$total</b></td></tr>
                    <tr><td colspan='5'></td></tr>
                    <tr><td><b>Date Ordered:</b></td><td>$date</td><td></td><td><b>Time:</b></td><td>$time</td></tr>
                    <tr><td><b>Current Address:</b></td><td colspan='2'>$address</td><td><b>Status:</b></td><td>$status</td></tr>
                </table></div>";
                }

                echo "<div class='container' style='width: 60%; margin-left: 30%;'>
                <table class='table' style='width: 100%;'>
                <thead><tr>
                <th style='width: 20%;'>Order Quantity</th>
                <th style='width: 20%;'></th>
                <th style='width: 20%;'>Product Name</th>
                <th style='width: 20%;'></th>
                <th style='width: 20%;'>Product Price</th>
                </tr></thead><tbody>";
                $current_delivery_id = $row["delivery_id"];
            }

            echo "<tr>
            <form action='" . $_SERVER['PHP_SELF'] . "' method='POST'>
            <td>" . $row["order_quantity"] . "x" . "</td>
            <td></td>                
            <td>" . $row["product_name"] . "</td>
            <td></td>
            <td>" . $row["total_price"] . "</td>
            </tr>";
        }

        // get total spent on the last delivery_id
        $total_query = "SELECT ROUND(SUM(`total_price`), 2) as total FROM `orders` WHERE `delivery_id` = '$current_delivery_id'";
        $total_row = $conn->query($total_query)->fetch_assoc();
        $total = $total_row["total"];

        $date_query = "SELECT `order_date`, `order_date_time` FROM `orders` WHERE `delivery_id` = '$current_delivery_id' LIMIT 1";
        $delivery_query = "SELECT `current_address`, `delivery_status` FROM `delivery` WHERE `delivery_id` = '$current_delivery_id' LIMIT 1";
        $date_row = $conn->query($date_query)->fetch_assoc();
        $delivery_row = $conn->query($delivery_query)->fetch_assoc();
        $date = $date_row["order_date"];
        $time = $date_row["order_date_time"];
        $address = $delivery_row["current_address"];
        $status = $delivery_row["delivery_status"];

        echo "<tr><td></td><td></td><td></td><td><b>TOTAL PRICE</b></td><td><b>$total</b></td></tr>
        <tr><td colspan='5'></td></tr>
        <tr><td><b>Date Ordered:</b></td><td>$date</td><td></td><td><b>Time:</b></td><td>$time</td></tr>
        <tr><td><b>Current Address:</b></td><td colspan='2'>$address</td><td><b>Status:</b></td><td>$status</td></tr>
    </table></div>";
    }
    ?>


</body>


</html>