<!-- Admin Page -->
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

$partial = "Ready";
$sql = "SELECT 
orders.*, food_product.product_name, users.first_name, users.last_name
FROM orders 
JOIN food_product ON orders.food_product_id = food_product.food_product_id 
JOIN users ON orders.customer_id = users.users_id 
WHERE orders.status = '$partial'";

$total_earnings_query = "SELECT ROUND(SUM(`total_price`), 2) as total_earnings FROM `orders` WHERE orders.status = '$partial'";

if (isset($_POST['filter-submit'])) {
    // Get the filter date from the form
    $filter_date = $_POST['filter-date'];

    // Modify the SQL query to filter by the specified date
    $sql .= " AND DATE(orders.order_date) = '$filter_date'";
    $total_earnings_query .= " AND DATE(orders.order_date) = '$filter_date'";
}

$result = $conn->query($sql);
$total_earnings_result = mysqli_query($conn, $total_earnings_query);
$total_earnings = mysqli_fetch_assoc($total_earnings_result)['total_earnings'];
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
    <br><br><br>

    <!-- TABLE -->
    <table class="table table-striped" style="width: 70%; table-layout: fixed; margin-left: 340px;">
        <thead>
            <tr>
                <th scope="col">Customer Name</th>
                <th scope="col">Product Name</th>
                <th scope="col">Quantity</th>
                <th scope="col">Order Date</th>
                <th scope="col">Total Price</th>
            </tr>
        </thead>

        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                    <form action='" . $_SERVER['PHP_SELF'] . "' method='POST'>s
                    <td>" . $row["first_name"] . " " . $row["last_name"] . "</td>
                    <td>" . $row["product_name"] . "</td>
                    <td>" . $row["order_quantity"] . "</td>
                    <td>" . $row["order_date"] . "</td>
                    <td>" . $row["total_price"] . "</td>
                    </tr>";
            }
        }
        ?>
    </table>

    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input style="margin-left: 360px; background-color:#E5F1FF; border-radius: 5px; height: 35px;  padding-right: 20px; padding-left: 20px;" type="date" id="filter-date" name="filter-date">
        <p style="margin-left: 75px; display: inline-block; background-color:#E5F1FF; border-radius: 5px; height: 35px; line-height: 35px; padding-right: 20px; padding-left: 20px;"><b>Total earnings:</b> <?php echo $total_earnings; ?></p>
        <button style="margin-left: 75px; width: 120px; color:#FFF;" type="submit" name="filter-submit" class='btn btn-success'>Filter</button>
    </form>

</body>