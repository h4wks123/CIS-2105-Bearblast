<!-- Customer and Admin Page -->
<?php
session_start();

// Establish connection to the database
$host = "localhost";
$user = "root";
$pass = "";
$db = "bearblast";

$conn = mysqli_connect($host, $user, $pass, $db);

//Check if connection is established
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $id = $row['users_id'];
        $hashed_password = $row['password'];
        $usertype = $row['usertype'];

        if (password_verify($password, $hashed_password)) {
            $_SESSION['email'] = $email;
            $_SESSION['users_id'] = $id;
            if ($usertype == 'Admin') {
                header("Location: users.php");
            } else {
                header("Location: home.php");
            }
        } else {
            echo '<div class="error-container">
            <div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
                <div class="card-header">
                    Error
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="closeContainer()">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="card-body">
                    <p class="card-text">Invalid email or password!</p>
                </div>
            </div>
        </div>';
        }
    } else {
        echo '<div class="error-container">
        <div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
            <div class="card-header">
                Error
                <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="closeContainer()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="card-body">
                <p class="card-text">Email not found!</p>
            </div>
        </div>
    </div>';
    }
}

$conn->close();

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>User Login</title>
    <link rel="stylesheet" href="css\bearblast.css">
    <script src="bearblast.js"></script>

</head>

<body style="background-image: url('images/log_regbg.jpeg');
             background-repeat: no-repeat;
             background-size: cover;">

    <!-- Start of form -->
    <form action="" method="post">
        <div class="container col-4 border border-1 p-5" style="margin-top: 7.5rem; opacity: 0.8;">

            <!-- Login heading -->
            <center>
                <img src="images\bearblast.png" style="height: 120px;">
                <h2>Welcome to Bearblast!</h2>
            </center>

            <!-- Email address or username field -->
            <div class="mb-4">
                <input name="email" type="text" placeholder="Email" class="form-control">
            </div>

            <!-- Password field -->
            <div class="mb-4">
                <input name="password" type="password" placeholder="Password" class="form-control">
            </div>

            <!-- Submit button -->
            </br>
            <div class="mb-4" style="text-align:center">
                <button class="login-button" type="submit">Submit</button>
            </div>

            <hr />
            <!-- Sign up link -->
            <div class="" style="text-align:center">
                <p>No account? <a href="register.php">Sign up</a></p>
            </div>
        </div>
    </form>

    <!-- Connect to jquery -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>