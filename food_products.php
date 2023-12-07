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

</head>

<body>
    <br><br>

    <!-- TABLE -->
    <table class="table table-striped" style="width: 70%; table-layout: fixed; margin-left: 340px;">
        <thead>
            <tr>
                <th scope="col" style="width: 10%;">Name</th>
                <th scope="col" style="width: 20%;">Description</th>
                <th scope="col" style="width: 10%;">Quantity</th>
                <th scope="col" style="width: 10%;">Availability</th>
                <th scope="col" style="width: 5%;">Price</th>
                <th scope="col" style="width: 7.5%;"></th>
                <th scope="col" style="width: 7.5%;"></th>
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
        <td><input type='text' style='width: 120px;' name='name' value='" . $row["product_name"] . "'></td>
        <td><input type='text' style='width: 270px;' name='description' value='" . $row["description"] . "'></td>
        
        <td>
            <div class=\"wrapper\">
                <button class=\"minus\"  style=\"width: 25px;\" onclick=\"decrementCounter(this)\">-</button>
                &nbsp&nbsp
                <input style='width: 35px;' type='text' class='num' name='quantity' value='" . $row["food_quantity"] . "' readonly>
                <button class=\"plus\"  style=\"width: 25px;\" onclick=\"incrementCounter(this)\">+</button> 
            </div>                   
        </td>
        <td>";
                    if ($row["food_quantity"] == "0") {
                        $availability = "Unavailable";
                        $sql = "UPDATE `food_product` SET availability='$availability' WHERE food_product_id='" . $row["food_product_id"] . "'";
                        $conn->query($sql);
                        echo "<button type='submit' class='btn btn-warning' style= color:#FFF;' name='unavailable'>Unavailable</button>";
                    }
                    // Kung dili kay awww
                    else {
                        if ($row["availability"] == "Available") {
                            echo "<button type='submit' class='btn btn-info' style= color:#FFF;' name='available'>Available</button>";
                        } else {
                            echo "<button type='submit' class='btn btn-warning' style= color:#FFF;' name='unavailable'>Unavailable</button>";
                        }
                    }
                    echo "</td>
        <td><input type='text' style='width: 50px;' name='price' value='" . $row["product_price"] . "'></td>
        <td><button type='submit' class='btn btn-danger' name='delete' value='" . $row["food_product_id"] . "'>Delete</button></td>
        <td>
            <input type='hidden' name='id' value='" . $row["food_product_id"] . "'>
            <button type='submit' class='btn btn-success' name='update'>Update</button>
        </td>
        </form>
        </tr>";
                }

                // Edit functionality uwu
                if (isset($_POST['update'])) {
                    $id = $_POST['id'];
                    $name = $_POST['name'];
                    $description = $_POST['description'];
                    $quantity = $_POST['quantity'];
                    $price = $_POST['price'];

                    $sql = "UPDATE `food_product` SET product_name='$name', description='$description', food_quantity='$quantity', product_price='$price' WHERE food_product_id='$id'";

                    if ($conn->query($sql) === TRUE) {
                        header("Refresh:0");
                    } else {
                        echo "Error updating user details: " . $conn->error;
                    }
                }

                // Delete functionality kekw
                if (isset($_POST['delete'])) {
                    $id = $_POST['delete'];
                    $sql = "DELETE FROM `food_product` WHERE food_product_id = $id";

                    if ($conn->query($sql) === TRUE) {
                        header("Refresh:0");
                    } else {
                        echo "Error deleting record: " . $conn->error;
                    }
                }

                // Available to Unavailable functionality lmao
                if (isset($_POST['available'])) {
                    $id = $_POST['id'];
                    $availability = "Unavailable";

                    $sql = "UPDATE `food_product` SET availability = '$availability' WHERE food_product_id='$id'";

                    if ($conn->query($sql) === TRUE) {
                        header("Refresh:0");
                    } else {
                        echo "Error updating record: " . $conn->error;
                    }
                }

                // Unavailable to Available functionality lmao
                if (isset($_POST['unavailable'])) {
                    $id = $_POST['id'];
                    $availability = "Available";

                    $sql = "UPDATE `food_product` SET availability = '$availability' WHERE food_product_id='$id'";

                    if ($conn->query($sql) === TRUE) {
                        header("Refresh:0");
                    } else {
                        echo "Error updating record: " . $conn->error;
                    }
                }
            } else {
                echo "<tr><td colspan='8' style='text-align:center;'>No products available</td></tr>";
            }

            ?>

        </tbody>

        </br></br>
    </table>
    <!-- Input new products uwu -->

    <table class="table table-striped" style="width: 70%; table-layout: fixed; margin-left: 340px;">
        <thead>
            <tr>
                <th scope="col" style="width: 10%;">Name</th>
                <th scope="col" style="width: 20%;">Description</th>
                <th scope="col" style="width: 10%;">Quantity</th>
                <th scope="col" style="width: 10%;">Availability</th>
                <th scope="col" style="width: 5%;">Price</th>
                <th scope="col" style="width: 15%;"></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <form method="POST">
                    <td><input type="text" name="name2" style="width: 120px;"></td>
                    <td><input type="text" name="description2" style="width: 270px;"></td>
                    <td>
                        <div class="wrapper">
                            <button class="minus" style="width: 25px;" onclick="decrementCounter(this)">-</button>
                            <input style="width: 35px;" type="text" class="num" name="quantity2" value="0" readonly>
                            <button class="plus" style="width: 25px;" onclick="incrementCounter(this)">+</button>
                        </div>
                    </td>
                    <td>
                        <button type="submit" style="width: 120px; color:#FFF;" class="btn btn-info" style="color: #FFF" name="available2">Available</button>
                    </td>
                    <td><input type="text" name="price2" style="width: 50px;"></td>
                    <td>
                        <button type="submit" style="width: 173px; color:#FFF;" class="btn btn-primary" name="insert">Insert</button>
                    </td>
                </form>
            </tr>
        </tbody>
    </table>

    <?php
    if (isset($_POST['insert'])) {

        $name = $_POST['name2'];
        $description = $_POST['description2'];
        $quantity = $_POST['quantity2'];
        $price = $_POST['price2'];
        $availability2 = "Available";

        $sql = "INSERT INTO `food_product`(`product_name`, `description`, `food_quantity`, `availability`, `product_price`) VALUES ('$name', '$description', '$quantity', '$availability2', '$price')";

        if ($conn->query($sql) === TRUE) {
            header("Refresh:0");
        } else {
            echo "Error inserting product: " . $conn->error;
        }
    }

    ob_end_flush();

    ?>

</body>

</html>