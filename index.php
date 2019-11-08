<?php

include_once('php-process/main-question.php');

unset ($_SESSION["search_result"]);

//functie die het zoekresultaat stuurt naar het process om te verwerken
if (isset($_POST['submit'])) {
$search_input = $_POST['search_bar'];

$question = new Question();
$question->Search_question($search_input);
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
    <link href="./styles/home-style.css" rel="stylesheet" type="text/css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>

<body>
<div id="page-container">

<header role="banner">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid" id="navbar"> <!-- navbar image and dropdown toggler -->
            <a class="navbar-brand" href="index.php"><img src="./img/logo.PNG" id="logo"></a>
            <button class="navbar-toggler" id="toggle" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div> <!-- navbar items -->
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto" id="links">
                <li class="nav-item active">
                    <a class="nav-link"href="index.php">Home</a>
                </li>
                <li class="nav-item">
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
</header>

<section id="home-page">

    <div class="search-bar">
        <form class="question_search" action="index.php" method="post">
            <input type="text" name="search_bar" placeholder="Search ...">
            <input type="submit" class="logbtn" name="submit" placeholder="send"></input>
        </form>
    </div>
    <section id="main-content">
        <h1>Forum</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed porta, magna vel sagittis consequat, sem dui imperdiet ante, et porttitor dui risus a enim. Cras laoreet orci volutpat, congue quam vitae, ultricies ipsum. Nam diam elit, placerat eget rhoncus euismod, tincidunt vitae ligula. Suspendisse hendrerit, neque non bibendum bibendum, quam velit hendrerit sapien, nec porta est nibh nec ex. Ut fermentum lacus quis felis euismod, ac vehicula ligula vehicula. Pellentesque vestibulum dignissim urna a porttitor. Vivamus rutrum, magna vitae venenatis pharetra, quam nibh luctus lectus, id finibus lacus turpis eu felis. Phasellus nec purus non diam convallis vestibulum et eget felis. Integer pellentesque faucibus nisi a mattis. In quis bibendum tellus, ac aliquet nisl.

Ut est neque, tempus eget fringilla vitae, posuere nec elit. Nulla est est, rhoncus in consectetur vel, vulputate et sapien. Suspendisse potenti. Ut et ex eget orci laoreet rutrum. Nullam feugiat efficitur fringilla. Aenean ante mauris, imperdiet et neque eu, porta cursus tortor. In tempus, neque sit amet rutrum porttitor, elit quam rutrum massa, et fringilla urna lorem sed dui. Duis tincidunt sit amet tellus nec vehicula. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Interdum et malesuada fames ac ante ipsum primis in faucibus. Curabitur tincidunt sollicitudin purus, dictum tincidunt velit rutrum eu.</p>

<?php
//button om naar de login pagina te gaan of uit te loggen
    if (isset($_SESSION['user_id'] ) ) {
        echo "<html>";
        echo "<form action='logout.php'>
                <input type='submit' class='logbtn' value='log out' />
                </form>";
    }else{
        echo "<html>";
        echo "<form action='login.php'>
                <input type='submit' class='logbtn' value='log in' />
                </form>";
    }
?>
<!-- link naar de pagina met de lijst van all questions -->
        <a href="title-list.php">list of all questions.</a>
    </section>

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
        <p>© StaplesICT Emmeloord, 2019 | BRANDING BY Sisimaile and Jacob Jan | WEBSITE BY Sisimaile and Jacob Jan </p>
    </div>

</footer>
</section>
</div> <!-- ending of the page container -->

</body>
</html>
