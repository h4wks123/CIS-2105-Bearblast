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
    <script src="bearblast.js"></script>

    <style>
        input {
            background-color: transparent;
            border: transparent;
        }
    </style>

    <script>
        function incrementCounter(btn, maxQuantity) {
            var wrapperEl = btn.parentNode;
            var numEl = wrapperEl.querySelector('.num');
            var quantity = parseInt(numEl.value);
            if (quantity < maxQuantity) {
                quantity += 1;
            }
            numEl.value = quantity;
            event.preventDefault();
        }


        function decrementCounter(btn) {
            var wrapperEl = btn.parentNode;
            var numEl = wrapperEl.querySelector('.num');
            var quantity = parseInt(numEl.value);
            if (quantity > 0) {
                quantity -= 1;
            }
            numEl.value = quantity;
            event.preventDefault();
        }
    </script>
</head>

<body>
    <br><br><br><br>

    <!-- TABLE -->
    <table class="table table-striped" style="width: 73.5%; margin-left: 340px;">
        <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Description</th>
                <th scope="col">Quantity</th>
                <th scope="col">Availability</th>
                <th scope="col">Price</th>
                <th scope="col"></th>
            </tr>
        </thead>


        <tbody>

            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $button_class = "";
                    $button_name = "";
                    if ($row["availability"] == "available") {
                        $button_class = "btn btn-info";
                        $button_name = "Available";
                    } else {
                        $button_class = "btn btn-warning";
                        $button_name = "Unavailable";
                    }
                    echo "<tr>
        <form action='" . $_SERVER['PHP_SELF'] . "' method='POST'>
        <td width='150px'>" . $row["product_name"] . "</td>
        <td width='500px'>" . $row["description"] . "</td>
        
        <td>
            <div class=\"wrapper\">
                <button class=\"minus\" onclick=\"decrementCounter(this)\">-</button>
                &nbsp&nbsp
                <input style='width: 36px;' type='text' class='num' name='quantity' value='0' readonly>
                <button class= \"plus\" onclick=\"incrementCounter(this, value='" . $row["food_quantity"] . "')\">+</button>
            </div>                   
        </td>

        <td>";
                    // Kung wala stocks kay unavailable
                    if ($row["food_quantity"] == "0") {
                        $availability = "Unavailable";
                        $sql = "UPDATE `food_product` SET availability='$availability' WHERE food_product_id='" . $row["food_product_id"] . "'";
                        $conn->query($sql);
                        echo "<button type='submit' class='btn btn-warning' style='width: 120px; color:#FFF;' name='unavailable'>Unavailable</button>";
                    } else if ($row["food_quantity"] > "0" && $row["availability"] != "Unavailable") { // Kung naa kay available
                        $availability = "Available";
                        $sql = "UPDATE `food_product` SET availability='$availability' WHERE food_product_id='" . $row["food_product_id"] . "'";
                        $conn->query($sql);
                        echo "<button type='submit' class='btn btn-info' style='width: 120px; color:#FFF;' name='available'>Available</button>";
                    }
                    // Kung naa kay available
                    else {
                        if ($row["availability"] == "Available") {
                            echo "<button type='submit' class='btn btn-info' style='width: 120px; color:#FFF;' name='available'>Available</button>";
                        } else {
                            echo "<button type='submit' class='btn btn-warning' style='width: 120px; color:#FFF;' name='unavailable'>Unavailable</button>";
                        }
                    }
                    echo "</td>

        <td width='50px'>" . $row["product_price"] . "</td>

        <td>
        <input type='hidden' name='id' value='" . $row["food_product_id"] . "'>
        <input type='hidden' name='productprice' value='" . $row["product_price"] . "'>
        <input type='hidden' name='availability2' value='" . $row["availability"] . "'>
        <button type='submit' class='btn btn-primary' style='color: white;' name='order'>Order</button>
        </td>
        
        </form>
        </tr>";
                }

                if (isset($_POST['order']) && isset($_POST['quantity']) && $_POST['availability2'] == "Available" && $_POST['quantity'] > 0) {
                    $product_id = $_POST['id'];
                    $order_quantity = $_POST['quantity'];
                    $product_price = $_POST['productprice'];
                    $total_price = $product_price * $order_quantity;
                    $date_ordered = date("Y-m-d H:i:s");

                    $sql = "INSERT INTO `orders`(`food_product_id`, `customer_id`, `order_quantity`, `total_price`, `order_date`) VALUES ('$product_id', '$users_idC', '$order_quantity', '$total_price', '$date_ordered')";

                    $quantity2 = "SELECT `food_quantity` FROM `food_product` WHERE `food_product_id` = '$product_id'";
                    $quantity_result = $conn->query($quantity2);
                    $quantity_row = $quantity_result->fetch_assoc();
                    $quantity = $quantity_row['food_quantity'] - $order_quantity;

                    $sql2 = "UPDATE `food_product` SET `food_quantity`='$quantity' WHERE `food_product_id` = '$product_id'";

                    if ($conn->query($sql) === TRUE && $conn->query($sql2) === TRUE) {
                        header("Refresh:0");
                    }
                } else if (isset($_POST['availability2']) && $_POST['availability2'] == "Unavailable") {
                    echo '<div class="error-container">
                    <div class="card text-white bg-danger mb-3" style="position: fixed; bottom: 10px; right: 10px;">
                    <div class="card-header">Error
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="closeContainer()">
                    <span aria-hidden="true">&times;</span>
                    </button></div>
                    <div class="card-body">
                      <p class="card-text">Product is not available at the moment</br>please order when available!</p>
                    </div>
                  </div>
                  </div>';
                } else if (isset($_POST['quantity']) && $_POST['quantity'] <= 0) {
                    echo '<div class="error-container">
                    <div class="card text-white bg-danger mb-3" style="position: fixed; bottom: 10px; right: 10px;">
                    <div class="card-header">Error
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="closeContainer()">
                    <span aria-hidden="true">&times;</span>
                    </button></div>
                    <div class="card-body">
                      <p class="card-text">Please input the quantity of your order</br> thank you!</p>
                    </div>
                  </div>
                  </div>';
                }
            } else {
                echo "<tr><td colspan='8' style='text-align:center;'>No products available</td></tr>";
            }

            ob_end_flush();

            ?>
    </table>
</body>

</html>