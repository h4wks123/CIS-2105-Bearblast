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

$sql = "SELECT delivery.*, users.first_name, users.last_name FROM `delivery` JOIN users ON delivery.customer_id = users.users_id ";

if (isset($_POST['filter-submit'])) {
    // Get the filter date from the form
    $filter_date = $_POST['filter-date'];

    // Modify the SQL query to filter by the specified date
    $sql .= " AND DATE(delivery.delivery_date) = '$filter_date'";
}

$result = $conn->query($sql);

?>

<html>

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
    <br><br><br><br>

    <table class="table table-striped" style="width: 70%; table-layout: fixed; margin-left: 340px;">
        <thead>
            <tr>
                <th scope="col" style="width: 15%;">Ongoing Name</th>
                <th scope="col" style="width: 10%;">Departure Time</th>
                <th scope="col" style="width: 10%;">Departure Date</th>
                <th scope="col" style="width: 20%;">Current Address</th>
                <th scope="col" style="width: 15%;">Delivery Status</th>
            </tr>
        </thead>

        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
            <form action='" . $_SERVER['PHP_SELF'] . "' method='POST'>
            <td>" . $row["first_name"] . " " . $row["last_name"] . "</td>
            <td>" . $row["departure_time"] . "</td>
            <td>" . $row["delivery_date"] . "</td>
            <td>" . $row["current_address"] . "</td>
            <td>";
                if ($row["delivery_status"] == "Ongoing") {
                    echo "<button type='submit' class='btn btn-info' style='width: 120px; color:#FFF;' name='Ongoing' value='" . $row["delivery_id"] . "'>Ongoing</button>";
                } else {
                    echo "<button type='submit' class='btn btn-warning' style='width: 120px; color:#FFF;' name='Completed' value='" . $row["delivery_id"] . "'>Completed</button>";
                }
                echo "</td>
            </form>
            </tr>";
            }
        }

        // Available to Unavailable functionality
        if (isset($_POST['Ongoing'])) {
            $id = $_POST['Ongoing'];
            $status = "Completed";

            $sql = "UPDATE `delivery` SET delivery_status = '$status' WHERE delivery_id='$id'";

            if ($conn->query($sql) === TRUE) {
                header("Refresh:0");
            } else {
                echo "Error updating record: " . $conn->error;
            }
        }

        // Unavailable to Available functionality
        if (isset($_POST['Completed'])) {
            $id = $_POST['Completed'];
            $status = "Ongoing";

            $sql = "UPDATE `delivery` SET delivery_status = '$status' WHERE delivery_id='$id'";

            if ($conn->query($sql) === TRUE) {
                header("Refresh:0");
            } else {
                echo "Error updating record: " . $conn->error;
            }
        }

        ?>
    </table>

    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input style="margin-left: 360px; background-color:#E5F1FF; border-radius: 5px; height: 35px; padding-right: 20px; padding-left: 20px;" type="date" id="filter-date" name="filter-date">
        <button style="margin-left: 75px; width: 120px; color:#FFF;" type="submit" name="filter-submit" class='btn btn-success'>Filter</button>
    </form>

</body>

</html>