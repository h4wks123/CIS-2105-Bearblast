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

$sql = "SELECT `order_id`, `customer_id`, `food_product_id`, `order_quantity`, `total_price`, `order_date`, `order_date_time` FROM `orders` WHERE `customer_id` = '$users_idC'";

$result = $conn->query($sql);

?>

<head>
    <meta charset="UTF-8" />
    <title>Homepage</title>
    <link rel="stylesheet" href="css\bearblast.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <script src="bearblast.js"></script>

    <style>
        input {
            background-color: transparent;
            border: transparent;
        }
    </style>

</head>

<body>

    <br><br><br><br>

    <!-- TABLE -->
    <table class="table table-striped" style="width: 70%; margin-left: 340px;">
        <thead>
            <tr>
                <th scope="col" style="width: 13%;">Product Name</th>
                <th scope="col" style="width: 20%;">Product Description</th>
                <th scope="col" style="width: 12%;">Order Quantity</th>
                <th scope="col" style="width: 10%;">Order Price</th>
                <th scope="col" style="width: 10%;">Date Ordered</th>
                <th scope="col" style="width: 10%;"></th>
            </tr>
        </thead>


        <tbody>

            <?php
            if ($result->num_rows > 0) {

                $total = 0;

                while ($row = $result->fetch_assoc()) {

                    $temp = $row["food_product_id"];
                    $check = "Pending";
                    $pname_query = "SELECT orders.order_id, orders.order_date, orders.total_price, food_product.product_name, food_product.description
                                    FROM orders
                                    JOIN food_product ON orders.food_product_id = food_product.food_product_id
                                    WHERE orders.customer_id = $users_idC AND orders.status = 'Pending' AND orders.order_id = " . $row['order_id'];
                    $pname_result = $conn->query($pname_query);
                    $pname_row = $pname_result->fetch_assoc();
                    if ($pname_row !== null) {
                        $pname = $pname_row['product_name'];
                        $pdesc = $pname_row['description'];

                        echo "<tr>
                        <form action='" . $_SERVER['PHP_SELF'] . "' method='POST'>
                        <td>" . $pname . "</td>
                        <td>" . $pdesc . "</td>
                        <td>" . $row["order_quantity"] . "</td>
                        <td>" . $row["total_price"] . "</td>
                        
                        <td>" . $row["order_date"] . "</td>
                        
                        <td>
                        <input type='hidden' name='product_ids' value='" . $row["food_product_id"] . "'>
                        <input type='hidden' name='quantity' value='" . $row["order_quantity"] . "'>
                        <button type='submit' class='btn btn-danger' name='delete' value='" . $row["order_id"] . "'>Delete</button></td>
                        
                        </form>
                        </tr>";
                    }
                }

                // Delete functionality kekw
                if (isset($_POST['delete'])) {
                    $id = $_POST['delete'];
                    $product_id = $_POST['product_ids'];

                    $quantity_query = "SELECT `order_quantity` FROM `orders` WHERE `order_id` = $id";
                    $quantity_result = $conn->query($quantity_query);
                    $quantity_row = $quantity_result->fetch_assoc();
                    $quantity = $quantity_row['order_quantity'];

                    $quantity_query2 = "SELECT `food_quantity` FROM `food_product` WHERE `food_quantity` = 0 AND `food_product_id` = $product_id";
                    $quantity_result2 = $conn->query($quantity_query2);

                    if ($quantity_result2->num_rows > 0) {
                        $update_avail = "UPDATE `food_product` SET `availability` = 'Available' WHERE `food_product_id` = $product_id";
                        $conn->query($update_avail);
                    }


                    $update_query = "UPDATE `food_product` SET `food_quantity` = `food_quantity` + $quantity WHERE `food_product_id` = $product_id";
                    $conn->query($update_query);

                    $delete_query = "DELETE FROM `orders` WHERE `order_id` = $id";
                    if ($conn->query($delete_query) === TRUE) {
                        header("Refresh:0");
                    } else {
                        echo "Error deleting record: " . $conn->error;
                    }
                }
            } else {
                echo "<tr><td colspan='8' style='text-align:center;'>No products available</td></tr>";
            }

            ?>

    </table>

    <thead>
        <table class="table table-striped" style="width: 70%; margin-left: 340px;">

            <tr>
                <th scope="col" style="text-align: center">Current Address</th>
                <th scope="col" style="text-align: center">Total Price</th>
                <th></th>
            </tr>

    </thead>

    <?php
    $status = "Pending";
    $total_query = "SELECT ROUND(SUM(`total_price`), 2) as total FROM `orders` WHERE `customer_id` = '$users_idC' AND `status` = '$status'";
    $result2 = $conn->query($total_query);
    $SUM = $result2->fetch_assoc();
    $total = $SUM['total'];

    $hasPendingProduct = false;
    $status2 = "Ongoing";

    $pending_product_query = "SELECT `delivery_status` FROM `delivery` WHERE `customer_id` = $users_idC AND `delivery_status` = '$status2'";
    $pending_product_result = $conn->query($pending_product_query);

    if ($pending_product_result && $pending_product_result->num_rows > 0) {
        $hasPendingProduct = true;
    }

    if (isset($_POST['confirm']) && !empty($_POST['address_info']) && $total > 0 && $hasPendingProduct == false) {
        $saledate = date('Y-m-d');
        $status = "Pending";
        $order_query = "SELECT `order_id` FROM `orders` WHERE `customer_id` = $users_idC AND `status` = '$status'";
        $result3 = $conn->query($order_query);
        $order = $result3->fetch_assoc();
        $status2 = "Partial";
        $saletime = date('Y-m-d H:i:s');
        $curaddress = $_POST['address_info'];

        $departure_time = date('Y-m-d H:i:s');
        $delivery_query = "INSERT INTO `delivery` (`customer_id`, `departure_time`, `current_address`) VALUES ($users_idC, '$departure_time', '$curaddress')";
        $conn->query($delivery_query);
        $delivery_id = $conn->insert_id;

        $update_query = "UPDATE `orders` SET `status` = '$status2' ,`order_date_time`= '$saletime', `delivery_id` = $delivery_id WHERE `customer_id` = $users_idC AND `status` = '$status'";
        $conn->query($update_query);
    }


    echo "<form action='" . $_SERVER['PHP_SELF'] . "' method='POST'>
<td><input name=\"address_info\" type=\"text\" placeholder=\"Current Address\" class=\"form-control\"></td>
<td><center>$total</center></td>
<td style='width: 200px;'><center><button type='submit' class='btn btn-primary' name='confirm'>Confirm Order</button></center></td>
</form>";

    ?>

    </table>

    <br>
    <?php
    if (isset($_POST['confirm'])) {
        if (empty($_POST['address_info'])) {
            echo '<div class="error-container">
        <div class="card text-white bg-danger mb-3" style="position: fixed; bottom: 10px; right: 10px;">
        <div class="card-header">Error
        <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="closeContainer()">
        <span aria-hidden="true">&times;</span>
        </button></div>
        <div class="card-body">
          <p class="card-text">Please fill out the missing details</br> of your current address!</p>
        </div>
      </div>
      </div>';
        } else if ($total < 1) {
            echo '<div class="error-container">
        <div class="card text-white bg-danger mb-3" style="position: fixed; bottom: 10px; right: 10px;">
        <div class="card-header">Error
        <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="closeContainer()">
        <span aria-hidden="true">&times;</span>
        </button></div>
        <div class="card-body">
          <p class="card-text">Please order a product before </br> confirming!</p>
        </div>
      </div>
      </div>';
        } else if ($hasPendingProduct == true) {
            echo '<div class="error-container">
            <div class="card text-white bg-danger mb-3" style="position: fixed; bottom: 10px; right: 10px;">
            <div class="card-header">Error
            <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="closeContainer()">
            <span aria-hidden="true">&times;</span>
            </button></div>
            <div class="card-body">
              <p class="card-text">Your last order is still ongoing! <br>Please order after it has been completed!</p>
            </div>
          </div>
          </div>';
        } else {
            header("Location: " . $_SERVER['PHP_SELF'] . "?success=true");
            exit();
        }
    }

    if (isset($_GET['success']) && $_GET['success'] == 'true') {
        echo '<div class="error-container">
    <div class="card text-white bg-success mb-3" style="position: fixed; bottom: 10px; right: 10px;">
    <div class="card-header">Success
    <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="closeContainer()">
    <span aria-hidden="true">&times;</span>
    </button></div>
    <div class="card-body">
      <p class="card-text">Please check your reciept and delivery </br> status to keep track with your orders!</p>
    </div>
  </div>
  </div>';
    }
    ob_end_flush();
    ?>
</body>

</html>