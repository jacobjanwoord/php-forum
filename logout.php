<?php

//logout functie

session_start();
session_destroy();
header("location: login.php?you-are-logged-out");

 ?>
