<?php

    include_once('php-process/main-question.php');


    //voert delete question  functie uit
    //user_id is de ingeloggede user
    //question_title_result is de titel van de question
    if (isset($_POST['delete'])) {
        $user_id_ad = $_SESSION['user_id'];
        $title_result = $_SESSION['question_title_result'];

        $object = new Question;
        $object->Delete_question($user_id_ad, $title_result);

    //voert set question to open functie uit
    //user_id is de ingeloggede user
    //question_title_result is de titel van de question
    } elseif (isset($_POST['setopen'])) {
        $user_id_ad = $_SESSION['user_id'];
        $title_result = $_SESSION['question_title_result'];

        $object = new Question;
        $object->Set_open_question($user_id_ad, $title_result);

    //voert set  question to closed functie uit
    //user_id is de ingeloggede user
    //question_title_result is de titel van de question
    } elseif (isset($_POST['setclosed'])) {
        $user_id_ad = $_SESSION['user_id'];
        $title_result = $_SESSION['question_title_result'];

        $object = new Question;
        $object->Set_closed_question($user_id_ad, $title_result);

    //voert delete response functie uit
    //user_id is de ingeloggede user
    } elseif (isset($_POST['delete_r'])){
        $user_id_ad = $_SESSION['user_id'];

        $object = new Response;
        $object->Delete_response($user_id_ad);

    //voert nieuw response functie uit
    //feed_name_res is de title van de question
    //user_id is de ingeloggede user
    //guestion text is de message input
    //date_created is de dag van aanmaken
    } elseif (isset($_POST['new_response'])){
            if (isset($_SESSION['user_id'])) {
                $feed_name_res = $_SESSION['question_title_result'];
                $user_id_res = $_SESSION['user_id'];
                $message_res = $_POST['question_text'];
                $date_created_res = date('Y-m-d');

                $object = new Response();
                $object->New_response($feed_name_res, $user_id_res, $message_res, $date_created_res);
            } else {
                header("Location: login.php?please-login");
            }
    }else {

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
    <link href="./styles/feed-style.css" rel="stylesheet" type="text/css"/>
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

<section id="feed">

<!-- main question -->
<section id="main-question">
    <!-- haalt de resultaten van de question zoek functie op en zet ze op de pagina -->
    <?php if ($_SESSION['total_q'] >= '1') {
        foreach ($_SESSION['result'] as $question_result) {
            $id_result = $question_result['0'];
            $title_result = $question_result['1'];
            $message_result = $question_result['2'];
            $user_id_result = $question_result['3'];
            $date_created_result = $question_result['4'];
            $open_result = $question_result['5'];
            $_SESSION['question_title_result'] = $question_result['1'];
        }
    } else {
        header("Location: title-list.php?no-result");
    }?>
    <h1><?php  echo $title_result; ?> - <?php echo $id_result; ?><!-- title from the feed--></h1>
    <p><?php echo $message_result; ?> <!-- message from the question --></p>
    <h6>date created: <?php echo $date_created_result; ?> -  author: <?php echo $user_id_result; ?> open/closed: <?php
        if ($open_result == 0) {
            echo 'closed';
        }else{
            echo 'open';
        }
        // zet de admin functies op de pagina (delete, setopen, setclosed)
if (isset($_SESSION['user_id'])) {

    if ($_SESSION['user_id'] === 'admin') {
        echo "<html>";
        echo "<form class='admin-function' action='feed.php' method='post'>
            <input type='submit' class='logbtn' name='delete' value='delete question'/>
            <input type='submit' name='setopen' value='set question to open' class='logbtn'/>
            <input type='submit' name='setclosed' value='set question to closed' class='logbtn'/>
        </form>";
    } else {

    }
} else {

}
    ?></h6>
</section>

<!-- all the responses -->
<section id="response">

    <div id=response-one>
        <!-- haalt alle responses op en zet ze op de pagina -->
        <?php if ($_SESSION['total_r'] >= '1') {
            foreach ($_SESSION['response'] as $response){
            $res_message = $response['3'];
            $res_user = $response['2'];
            $res_date = $response['4'];
            $_SESSION['res_message'] = $res_message;

            echo '<div class="responses">';
            echo "$res_message <br> author: $res_user - date-created: $res_date";
            echo '</div>';

            if (isset($_SESSION['user_id'])) {
                if ($_SESSION['user_id'] === 'admin') {
                echo "<html>";
                echo "<form class='admin-function' action='feed.php' method='post'>
                    <input type='submit' class='logbtn' name='delete_r' value='delete response'/>
                </form>";
                } else {

                }
        }else {

        }

            echo "<html>";
            echo "<hr width='80%'' size='10px'>";
        };
    } else {
        echo "there are no responses yet.";
    }
        ?>
    </div>

</section>

<!-- forum for creating a new response -->
<section id="create-response">
    <?php if ($open_result === '1'  ) {
        echo "<html>";
    echo "<form class='new-response-form' action='feed.php' method='post'>
        <h1>New response</h1>

        <div class='form-group'>
            <textarea class='form-control' name='question_text' rows='8' cols='165' placeholder='Your awnser.'></textarea>
        </div>

        <input type='submit' class='logbtn' value='post response' name='new_response'/>
    </form>";
} else {
    echo "you can't respond on this question.";
}
    ?>
</section>

<!-- end of the feed -->
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
</section><!-- ending of footer -->

</div> <!-- ending of the page container -->

</body>
</html>
