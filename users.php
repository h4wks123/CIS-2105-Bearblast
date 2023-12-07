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

$sql = "SELECT users_id, email, first_name, last_name, phone_number, usertype from users";
$result = $conn->query($sql);

?>

<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Homepage</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link rel="stylesheet" href="css\bearblast.css">

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
    <table class="table table-striped" style="width: 70%; table-layout: fixed; margin-left: 340px;">
        <thead>
            <tr>
                <th scope="col" style="width: 20%;">Email</th>
                <th scope="col" style="width: 10%;">Firstname</th>
                <th scope="col" style="width: 10%;">Lastname</th>
                <th scope="col" style="width: 10%;">Phonenumber</th>
                <th scope="col" style="width: 10%;"></th>
                <th scope="col" style="width: 10%;"></th>
                <th scope="col" style="width: 10%;"></th>
            </tr>
        </thead>
        <tbody>

            <?php

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
        <form action='" . $_SERVER['PHP_SELF'] . "' method='POST'>
        <td><input type='text' style='width: 225px;' name='email' value='" . $row["email"] . "'></td>
        <td><input type='text' style='width: 100px;' name='firstname' value='" . $row["first_name"] . "'></td>
        <td><input type='text' style='width: 100px;' name='lastname' value='" . $row["last_name"] . "'></td>
        <td><input type='text' style='width: 100px;' name='phonenumber' value='" . $row["phone_number"] . "'></td>
        <td>";
                    if ($row["usertype"] == "Customer") {
                        echo "<button type='submit' class='btn btn-info' style='color:#FFF;' name='customer'>Customer</button>";
                    } else {
                        echo "<button type='submit' class='btn btn-warning' style='color:#FFF;' name='admin'>Admin</button>";
                    }
                    echo "</td>
        <td><button onclick='deleteRow(" . $row["users_id"] . ")'type='submit' class='btn btn-danger' name='delete' value='" . $row["users_id"] . "'>Delete</button></td>
        <td>
          <input type='hidden' name='id' value='" . $row["users_id"] . "'>
          <button type='submit' class='btn btn-success' name='update'>Update</button>
        </td>
      </form>
    </tr>";
                }

                //     if (isset($_POST['customer'])) {
                //         $id = $_POST['id'];
                //         $usertype = "Admin";

                //         $sql = "UPDATE `users` SET usertype = '$usertype' WHERE users_id='$id'";

                //         if ($conn->query($sql) === TRUE) {
                //             header("Refresh:0");
                //         } else {
                //             echo "Error updating record: " . $conn->error;
                //         }
                //     }

                // if (isset($_POST['admin'])) {
                //     $id = $_POST['id'];
                //     $usertype = "Customer";

                //     $sql = "UPDATE `users` SET usertype = '$usertype' WHERE users_id='$id'";

                //     if ($conn->query($sql) === TRUE) {
                //         header("Refresh:0");
                //     } else {
                //         echo "Error updating record: " . $conn->error;
                //     }
                // }
            } else {
                echo "<tr><td colspan='7'>No results found</td></tr>";
            }

            // Edit functionality uwu
            if (isset($_POST['update'])) {
                $id = $_POST['id'];
                $email = $_POST['email'];
                $firstname = $_POST['firstname'];
                $lastname = $_POST['lastname'];
                $phonenumber = $_POST['phonenumber'];

                $sql = "UPDATE `users` SET email='$email', first_name='$firstname', last_name='$lastname', phone_number='$phonenumber' WHERE users_id='$id'";

                if ($conn->query($sql) === TRUE) {
                    header("Refresh:0");
                } else {
                    echo "Error updating user details: " . $conn->error;
                }
            }

            // Delete functionality kekw
            if (isset($_POST['delete'])) {
                $id = $_POST['delete'];
                $sql = "DELETE FROM `users` WHERE users_id = $id";

                if ($conn->query($sql) === TRUE) {
                    header("Refresh:0");
                } else {
                    echo "Error deleting record: " . $conn->error;
                }
            }

            ob_end_flush();
            ?>

        </tbody>
    </table>
</body>

</html>