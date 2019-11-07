<?php
//connectie met de database maken
class Connection{

    public function DB(){
        return new PDO("mysql:host=localhost; dbname=forum_php", "root", "");
    }
}

?>
