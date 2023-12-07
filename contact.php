<?php
ob_start();
//--Nav-Bar--//
include("sidenavcustomer.php");
?>

<html>

<head>
    <title>Contact Us</title>
    <link rel="stylesheet" href="css\bearblast.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />

    <style>
        .getInTouch {
            text-align: center;
            padding-top: 50px;
            margin-bottom: 20px;
        }

        .getInForm {
            padding-left: 22%;
            padding-right: 10%;
            align-self: center;
        }

        .fieldForm {
            background-color: white;
            padding: 55px;
            width: 540px;
            height: 620px;
        }


        .grid-container-element {
            display: grid;
            grid-template-columns: auto auto;
            grid-gap: 20px;
            width: 100%;
            height: auto;
        }

        .grid-child-element {
            margin: 0px;
            height: auto;
            width: auto;
        }

        .grid-child-element2 {
            margin: 0px;
            background-color: #013a5e;
            color: white;
            padding: 50px;
            height: 620px;
            width: 540px;
        }

        p {
            font-size: 15px;
        }

        body {
            background-color: rgba(238, 226, 203, 1);
            background: linear-gradient(90deg, rgba(238, 226, 203, 1) 20%, rgba(173, 142, 121, 1) 100%);
        }
    </style>


</head>

<body>
    </br></br>
    <div style="width: 25%; height: 25%; margin-left: 250px;">
        <div class="getInForm">
            <div class="grid-container-element">
                <div class="grid-child-element">
                    <form class="fieldForm">
                        <h2>Send a Message</h2><br>
                        <label for="fname">
                            <h4>First name</h4>
                        </label>
                        <label for="lname" style="text-indent: 120px">
                            <h4>Last name</h4>
                        </label><br>

                        <input type="text" id="fname" name="fname" placeholder="Enter your first name" style="width: 180px; height: 35px;" readonly>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="text" id="lname" name="lname" placeholder="Enter your last name" style="width: 180px; height: 35px;" readonly><br>
                        <br>
                        <label for="fname">
                            <h4>Email</h4>
                        </label>
                        <label for="lname" style="text-indent: 170px">
                            <h4>Mobile Number</h4>
                        </label><br>

                        <input type="text" id="fname" name="fname" placeholder="Enter your email" style="width: 180px; height: 35px;" readonly>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="text" id="lname" name="lname" placeholder="Enter your mobile" style="width: 180px; height: 35px;" readonly><br><br>

                        <label for="lname">
                            <h4>Message</h4>
                        </label><br>
                        <textarea placeholder="Write your message here" style="width: 420px; height: 110px; resize: none;" readonly></textarea>
                        <!-- <input type="text" id="fname" name="fname" placeholder="Write your message here" style="width: 685px; height: 250px; resize: none;">-->
                        <br><br><br>
                        <button style="width: 420px; height: 50px; background-color: #010b61; color: white;">Send</button>
                    </form>
                </div>

                <div class="grid-child-element2">
                    <h2>Contact Info</h2><br>
                    <p>Hi there, We are available 24/7 by fax, e-mail or by phone. Drop us line so we can talk further about that.<br>
                        For more info or inquiry about our products project, and pricing. Feel free to get in touch with us.</p><br>
                    <p><img src="images/location.png" width="25" height="25">&nbsp;&nbsp;Mandaue City, Cebu, Philippines</p>
                    <p><img src="images/gmail.png" width="25" height="25">&nbsp;&nbsp;<u>michaeljohn.bacalso2@gmail.com</u></p>
                    <p><img src="images/redphone.png" width="25" height="25">&nbsp;&nbsp;<u>0977 022 8436</u></p>
                    <img src="images/facebook.png" width="25" height="25">&nbsp;&nbsp;<img src="images/twitter.png" width="25" height="25">&nbsp;&nbsp;
                    <img src="images/instagram.png" width="25" height="25">&nbsp;&nbsp;<img src="images/linkedin.png" width="25" height="25"><br><br>
                    <p><iframe style="width: 450px; height: 160px;" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d981.762344989377!2d123.7208826!3d10.1766418!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33a979445dd1d3c5%3A0xcb922f4c684dd0e5!2sBREGGETTE%20CARENDERIA!5e0!3m2!1sen!2sph!4v1683829613166!5m2!1sen!2sph" width="550" height="200" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </p>

                </div>
            </div>
        </div>
    </div>

</body>

</html>