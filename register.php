<!DOCTYPE html>
<html>

<head>
    <title>Registration Form</title>
</head>

<body>

    <?php
    if (isset($_POST['reg_button'])) {
        $host = "localhost";
        $username = "root";
        $password = "";
        $dbname = "bearblast";
        $conn = new mysqli($host, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $email = $_POST['email'];

        // Check if email already exists
        $checkEmailQuery = "SELECT * FROM users WHERE email = '$email'";
        $result = $conn->query($checkEmailQuery);
        if ($result->num_rows > 0) {
            echo '<div class="error-container">
            <div class="card text-white bg-danger mb-3" style="position: fixed; bottom: 10px; right: 10px;">
                <div class="card-header">Error
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="closeContainer()">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="card-body">
                    <p class="card-text">Email already exists!</p>
                </div>
            </div>
        </div>';
        } else {

            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $phonenumber = $_POST['phonenumber'];
            $password = $_POST['password'];
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $usertype = "Customer";

            $sql = "INSERT INTO users (email, first_name, last_name, phone_number, password, usertype) 
            VALUES ('$email', '$firstname', '$lastname', '$phonenumber', '$hashed_password', '$usertype')";
            if ($conn->query($sql) === TRUE) {
                echo '<div class="error-container">
            <div class="card text-white bg-success mb-3" style="position: fixed; bottom: 10px; right: 10px;">
                <div class="card-header">Success
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="closeContainer()">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="card-body">
                    <p class="card-text">Your account has been successfully created!</p>
                </div>
            </div>
        </div>';
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

            $conn->close();
        }
    }
    ?>

    <!doctype html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <title>User Register</title>
        <link rel="stylesheet" href="css\bearblast.css">
        <script src="bearblast.js"></script>
    </head>

    <body style="background-image: url('images/log_regbg.jpeg');
             background-repeat: no-repeat;
             background-size: cover;">

        <!-- Start of form -->
        <form action="" method="post">
            <div class="container col-4 border border-1 p-3" style="margin-top: 4rem; opacity: 0.8;">

                <!-- Login heading -->
                <div>
                    <center>
                        <img src="images\bearblast.png" style="height: 120px;">
                        <h2>Create an Account!</h2>
                    </center>
                </div>

                <!-- Email address-->
                <div class="mb-3">
                    <input name="email" type="email" placeholder="Email" class="form-control">
                </div>

                <!-- Username field -->
                <div class="mb-3">
                    <input name="firstname" type="username" placeholder="Firstname" class="form-control">
                </div>

                <div class="mb-3">
                    <input name="lastname" type="username" placeholder="Lastname" class="form-control">
                </div>

                <!-- PhoneNumber field -->
                <div class="mb-3">
                    <input name="phonenumber" type="number" placeholder="Phonenumber" class="form-control" min="1000000000" max="9999999999" required>
                </div>

                <!-- Password field -->
                <div class="mb-3">
                    <input name="password" type="password" placeholder="Password" class="form-control">
                </div>

                <!-- Submit button -->
                <div class="mb-3" style="text-align:center">
                    <button name="reg_button" class="login-button" type="submit">Submit</button>
                </div>

                <hr />
                <!-- Login link -->
                <div class="" style="text-align:center">
                    <p>Already have an account? <a href="login.php">Log In</a></p>
                </div>
            </div>
        </form>
        <script src="js\bootstrap.bundle.js" crossorigin="anonymous">
        </script>
        </div>
    </body>

    </html>