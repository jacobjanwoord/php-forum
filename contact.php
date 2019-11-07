<?php

session_start();

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>forum</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="./styles/main-style.css" rel="stylesheet" type="text/css"/>
    <link href="./styles/contact-style.css" rel="stylesheet" type="text/css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>

<body>
<div id="page-container">

<header role="banner">
    <nav class="navbar navbar-expand-md navbar-light bg-light">
        <div class="container-fluid"> <!-- navbar image and dropdown toggler -->
            <a class="navbar-brand" href="index.php"><img src="./img/logo.PNG" id="logo"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div> <!-- navbar items -->
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto" id="links">
                <li class="nav-item">
                    <a class="nav-link"href="index.php">Home</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link"href="contact.php">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"href="login.php">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"href="new-question.php">New question</a>
                </li>
            </ul>
        </div>
    </nav>
</header> <!-- ending of header -->


<!-- middle section -->
<section id="contact-main">
    <div class="container-fluid" id="contact-people">
        <div class="row">
            <div class="col-12" id="contact-sisi">
                <img src="./img/sisi.bmp" alt="Sisimaile">
                <h2>Sisimaile Lolohea</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                <p>e-mail: example@example.com<br>
                    adres: lorem ipsum<br>
                    mobile: 06-12345678</p>
            </div>
        </div>

        <div class="row" id="contact-jjw">
            <div class="col-12">
                <img src="./img/jjw.jpeg" alt="Sisimaile">
                <h2>Jacob Jan Woord</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                <p>e-mail: example@example.com<br>
                    adres: lorem ipsum<br>
                    mobile: 06-87654321</p>
            </div>
        </div>

        <!-- link om in/uit te loggen -->
        <?php
            if (isset($_SESSION['user_id'] ) ) {
                echo "<html>";
                echo "<a href='logout.php'>Click here to log out</a>";
            }else{
                echo "<html>";
                echo "<a href='login.php'>Click here to log in</a>";
            }
        ?>

    </div>

</section>

<section id="footer">
<footer> <!-- footer logo -->
    <div class="container-fluid"  id="bottom-logo">
        <div class="row text-center col-12">
            <div id="btm-logo">
                <a href="index.php"><img src="./img/logo.PNG"></a>
            </div>
        </div>
        <hr width="80%" size="10px">
    </div>

    <div class="container-fluid" id="contact-footer"> <!-- footer text -->
        <div class="row text-center">
            <div class="col-12 col-md-6">
                <h6>Sisimaile Lolohea</h6>
                <p>adr: ---<br>
                tel: ---<br>
                mail: ---</p>
            </div>

            <div class="col-12 col-md-6">
                <h6>Jacob Jan Woord</h6>
                <p>adr: ---<br>
                tel: ---<br>
                mail: ---</p>
            </div>
        </div>
    </div>

    <div class="container-fluid" id="credits"> <!-- footer credits -->
        <p>© StaplesICT Emmeloord, 2019 | BRANDING BY Sisimaile and Jacob Jan | WEBSITE BY Sisimaile and Jacob Jan</p>
    </div>

</footer>
</section> <!-- ending of footer -->


</div> <!-- ending of the page container -->

</body>
</html>
