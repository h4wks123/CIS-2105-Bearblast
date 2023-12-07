<?php
ob_start();
//--Nav-Bar--//
include("sidenavcustomer.php");
?>

<html>

<head>
    <title>Homepage</title>
    <link rel="stylesheet" href="css\bearblast.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
</head>

<body>
    <div style="
    height: 25%;
    position: absolute;
    z-index: -1;
    background-image: url('images/about3.jpg');
    background-color: rgba(163, 134, 91, 0.8);
    background-size: cover;
    background-position: center center;
    filter: blur(2px);
    width: 100%;
    height: 80px;
    top: 0;
">
    </div>

    </div>
    <div style="width: 100%; 
             position: absolute; 
             top: 80px; 
             background-color: rgba(163, 134, 91, 0.8);
             padding: 20px 0;
             z-index: -1;
             text-align: center;
             color: whitesmoke;
             box-sizing: border-box;
             overflow: hidden;
             ">

        <span style="display: block; position: relative; right: -5%;">
            <a style="display: inline-block; margin-left: 65px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="currentColor" class="bi bi-credit-card" viewBox="0 0 16 16">
                    <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v1h14V4a1 1 0 0 0-1-1H2zm13 4H1v5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V7z" />
                    <path d="M2 10a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1v-1z" />
                </svg>
                <p style="margin-top: 10px; font-size: 24px; font-weight: bold; text-shadow: 2px 2px 0 #000;">CREDIBLE</p>
            </a>
            <a style="display: inline-block; margin-left: 65px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="currentColor" class="bi bi-fast-forward-btn" viewBox="0 0 16 16">
                    <path d="M8.79 5.093A.5.5 0 0 0 8 5.5v1.886L4.79 5.093A.5.5 0 0 0 4 5.5v5a.5.5 0 0 0 .79.407L8 8.614V10.5a.5.5 0 0 0 .79.407l3.5-2.5a.5.5 0 0 0 0-.814l-3.5-2.5Z" />
                    <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm15 0a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4Z" />
                </svg>
                <p style="margin-top: 10px; font-size: 24px; font-weight: bold; text-shadow: 2px 2px 0 #000;">FAST</p>
            </a>
            <a style="display: inline-block; margin-left: 65px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="currentColor" class="bi bi-phone-vibrate" viewBox="0 0 16 16">
                    <path d="M10 3a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h4zM6 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h4a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H6z" />
                    <path d="M8 12a1 1 0 1 0 0-2 1 1 0 0 0 0 2zM1.599 4.058a.5.5 0 0 1 .208.676A6.967 6.967 0 0 0 1 8c0 1.18.292 2.292.807 3.266a.5.5 0 0 1-.884.468A7.968 7.968 0 0 1 0 8c0-1.347.334-2.619.923-3.734a.5.5 0 0 1 .676-.208zm12.802 0a.5.5 0 0 1 .676.208A7.967 7.967 0 0 1 16 8a7.967 7.967 0 0 1-.923 3.734.5.5 0 0 1-.884-.468A6.967 6.967 0 0 0 15 8c0-1.18-.292-2.292-.807-3.266a.5.5 0 0 1 .208-.676zM3.057 5.534a.5.5 0 0 1 .284.648A4.986 4.986 0 0 0 3 8c0 .642.12 1.255.34 1.818a.5.5 0 1 1-.93.364A5.986 5.986 0 0 1 2 8c0-.769.145-1.505.41-2.182a.5.5 0 0 1 .647-.284zm9.886 0a.5.5 0 0 1 .648.284C13.855 6.495 14 7.231 14 8c0 .769-.145 1.505-.41 2.182a.5.5 0 0 1-.93-.364C12.88 9.255 13 8.642 13 8c0-.642-.12-1.255-.34-1.818a.5.5 0 0 1 .283-.648z" />
                </svg>
                <p style="margin-top: 10px; font-size: 24px; font-weight: bold; text-shadow: 2px 2px 0 #000;">CONVENIENT</p>
            </a>
            <a style="display: inline-block; margin-left: 65px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="currentColor" class="bi bi-router" viewBox="0 0 16 16">
                    <path d="M5.525 3.025a3.5 3.5 0 0 1 4.95 0 .5.5 0 1 0 .707-.707 4.5 4.5 0 0 0-6.364 0 .5.5 0 0 0 .707.707Z" />
                    <path d="M6.94 4.44a1.5 1.5 0 0 1 2.12 0 .5.5 0 0 0 .708-.708 2.5 2.5 0 0 0-3.536 0 .5.5 0 0 0 .707.707ZM2.5 11a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1Zm4.5-.5a.5.5 0 1 0 1 0 .5.5 0 0 0-1 0Zm2.5.5a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1Zm1.5-.5a.5.5 0 1 0 1 0 .5.5 0 0 0-1 0Zm2 0a.5.5 0 1 0 1 0 .5.5 0 0 0-1 0Z" />
                    <path d="M2.974 2.342a.5.5 0 1 0-.948.316L3.806 8H1.5A1.5 1.5 0 0 0 0 9.5v2A1.5 1.5 0 0 0 1.5 13H2a.5.5 0 0 0 .5.5h2A.5.5 0 0 0 5 13h6a.5.5 0 0 0 .5.5h2a.5.5 0 0 0 .5-.5h.5a1.5 1.5 0 0 0 1.5-1.5v-2A1.5 1.5 0 0 0 14.5 8h-2.306l1.78-5.342a.5.5 0 1 0-.948-.316L11.14 8H4.86L2.974 2.342ZM14.5 9a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 1 .5-.5h13Z" />
                    <path d="M8.5 5.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0Z" />
                </svg>
                <p style="margin-top: 10px; font-size: 24px; font-weight: bold; text-shadow: 2px 2px 0 #000;">CONNECT</p>
            </a>
        </span>
    </div>

    <div class="container" style="background: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.3)), url('images/about1.jpg');
                              background-size: cover;
                              background-repeat: no-repeat;
                              height: 400px;
                              width: 500px;
                              position: absolute;
                              top: 40%;
                              left: 20%;
                              border-radius: 5%;"></div>

    <div class="container" style="background: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.3)), url('images/about2.jpg');
                             background-size: cover;
                             background-repeat: no-repeat;
                             height: 275px;
                             width: 315px;
                             position: absolute;
                             top: 50%;
                             left: 42%;
                             border-radius: 5%;">
    </div>

    <div class="container" style="position: absolute; text-align: justify; width: 25%; height: 50%; top: 40%; left: 65%; border-radius: 5%; letter-spacing: 1.5px; margin: 20px; background-color: rgba(163, 134, 91, 0.8); line-height: 1.5;">
        <h1 style="font-size: 55px; text-shadow: 2px 2px 0 #000;">THE TEAM</h1>
        <p>Bearblast is a restaurant known for its unique and bold dishes,
            all made with the freshest ingredients and a lot of love.
            At Bearblast, we believe that eating should be an experience
            and strive to create an inviting and energetic atmosphere.
            Our team of talented chefs and friendly servers are dedicated
            to providing a blastful experience that you won't forget.</p>
    </div>

</body>

</html>