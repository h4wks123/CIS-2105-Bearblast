<!-- Customer Page -->
<?php
ob_start();
//--Nav-Bar--//
include("sidenavadmin.php");

$host = "localhost";
$user = "root";
$pass = "";
$db = "bearblast";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$partial = "Partial";
$sql = "SELECT 
orders.*, food_product.product_name, users.first_name, users.last_name
FROM orders 
JOIN food_product ON orders.food_product_id = food_product.food_product_id 
JOIN users ON orders.customer_id = users.users_id 
WHERE orders.status = '$partial'";

$result = $conn->query($sql);

?>

<head>
    <meta charset="UTF-8" />
    <title>Homepage</title>
    <link rel="stylesheet" href="css\bearblast.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />

    <style>
        input {
            background-color: transparent;
            border: transparent;
        }
    </style>

</head>

<body>
    <br><br>

    <!-- TABLE -->
    <table class="table table-striped" style="width: 70%; table-layout: fixed; margin-left: 340px;">
        <thead>
            <tr>
                <th scope="col" style="width: 10%;">Customer Name</th>
                <th scope="col" style="width: 10%;">Product Name</th>
                <th scope="col" style="width: 10%;">Quantity</th>
                <th scope="col" style="width: 10%;">Order Date</th>
                <th scope="col" style="width: 10%;">Total Price</th>
                <th scope="col" style="width: 10%;">Status</th>
                <th scope="col" style="width: 10%;"></th>
            </tr>
        </thead>


        <tbody>

            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $button_class = "";
                    $button_name = "";
                    if ($row["status"] == "Ready") {
                        $button_class = "btn btn-success";
                        $button_name = "Ready";
                    } else {
                        $button_class = "btn btn-info";
                        $button_name = "Partial";
                    }
                    echo "<tr>
        <form action='" . $_SERVER['PHP_SELF'] . "' method='POST'>s
        <td>" . $row["first_name"] . " " . $row["last_name"] . "</td>
        <td>" . $row["product_name"] . "</td>
        <td>" . $row["order_quantity"] . "</td>
        <td>" . $row["order_date"] . "</td>
        <td>" . $row["total_price"] . "</td>
        <td>";
                    if ($row["status"] == "Ready") {
                        echo "<button type='submit' class='btn btn-success' style='width: 120px; color:#FFF;' name='ready' value='" . $row["order_id"] . "'>Ready</button>";
                    } else {
                        echo "<button type='submit' class='btn btn-info' style='width: 120px; color:#FFF;' name='partial' value='" . $row["order_id"] . "'>Partial</button>";
                    }
                    echo "</td>
        <td><button type='submit' class='btn btn-danger' name='delete' value='" . $row["order_id"] . "'>Delete</button></td>
        </form>
        </tr>";
                }

                if (isset($_POST['delete'])) {
                    $id = $_POST['delete'];

                    // Get the quantity of the deleted order
                    $quantity_query = "SELECT `order_quantity` FROM `orders` WHERE `order_id` = $id";
                    $quantity_result = $conn->query($quantity_query);
                    $quantity_row = $quantity_result->fetch_assoc();
                    $quantity = $quantity_row['order_quantity'];

                    // Update the food quantity in the food_product table
                    $product_id_query = "SELECT `food_product_id` FROM `orders` WHERE `order_id` = $id";
                    $product_id_result = $conn->query($product_id_query);
                    $product_id_row = $product_id_result->fetch_assoc();
                    $product_id = $product_id_row['food_product_id'];

                    $update_query = "UPDATE `food_product` SET `food_quantity` = `food_quantity` + $quantity WHERE `food_product_id` = $product_id";
                    $conn->query($update_query);

                    if ($product_id_row['food_quantity'] == 0) {
                        $avail = "Available";
                        $update_query2 = "UPDATE `food_product` SET `availability` = '$avail' WHERE `food_product_id` = $product_id";
                        $conn->query($update_query2);
                    }

                    // Delete the order
                    $delete_query = "DELETE FROM `orders` WHERE `order_id` = $id";
                    if ($conn->query($delete_query) === TRUE) {
                        header("Refresh:0");
                    } else {
                        echo "Error deleting record: " . $conn->error;
                    }
                }

                if (isset($_POST['ready'])) {
                    $id = $_POST['ready'];
                    $availability = "Partial";
                    $sql = "UPDATE `orders` SET status = '$availability' WHERE order_id='$id'";
                    if ($conn->query($sql) === TRUE) {
                        header("Refresh:0");
                    } else {
                        echo "Error updating record: " . $conn->error;
                    }
                }

                if (isset($_POST['partial'])) {
                    $id = $_POST['partial'];
                    $availability = "Ready";
                    $sql = "UPDATE `orders` SET status = '$availability' WHERE order_id='$id'";
                    if ($conn->query($sql) === TRUE) {
                        header("Refresh:0");
                    } else {
                        echo "Error updating record: " . $conn->error;
                    }
                }
            } else {
                echo "<tr><td colspan='7' style='text-align:center;'>No orders available</td></tr>";
            }

            ob_end_flush();

            ?>

        </tbody>

        </br></br>
    </table>
    <!-- Input new products uwu -->

    </table>

</body>

</html>