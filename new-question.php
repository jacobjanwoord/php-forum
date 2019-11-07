<?php


include_once('php-process/main-question.php');


    //voert de New_question functie uit
    if (isset($_POST['submit'])) {
        $title = $_POST['title'];
        $message = $_POST['message'];
        $user_id = $_SESSION['user_id'];
        $date_created = date('Y-m-d');
        $open = True;

        $object = new Question();
        $object->New_question($title, $message, $user_id, $date_created, $open);
    }

    if( isset($_SESSION['user_id'] ) ) {

    } else {
        header("Location: login.php?please-login");
    }
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
    <link href="./styles/new-question-style.css" rel="stylesheet" type="text/css"/>
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
                <li class="nav-item">
                    <a class="nav-link"href="contact.php">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"href="login.php">Login</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link"href="new-question.php">New question</a>
                </li>
            </ul>
        </div>
    </nav>
</header>

<section id="new-question">
    <!-- form voor nieuwe question -->
    <form class="new-question-form" action="new-question.php" method="post">

        <h1>New question</h1>

        <div class="text-container">
            <input type="text" placeholder="title (e.g. What is OOP?)" name="title">
        </div>

        <div class="form-group">
            <textarea class="form-control" rows="8" cols="165" placeholder="detailed version of your question." name="message"></textarea>
        </div>

        <input type="submit" class="logbtn" value="post question" name="submit"/>

    </form>
</section>

<section id="footer">
<footer> <!-- footer logo -->
    <div class="container-fluid"  id="bottom-logo">
        <div class="row text-center col-12">
            <div id="btm-logo">
                <a href="index.php"><img src="./img/logo.PNG"></a>
            </div>
            <div class="message">
                <p>Welcome
                <?php
                    if( isset($_SESSION['user_id'] ) ) {
                        echo $_SESSION["user_id"];
                    } else {

                    }
                ?>
                </p>
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
</section>
</div> <!-- ending of the page container -->

</body>
</html>
