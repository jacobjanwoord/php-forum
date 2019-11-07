<?php

session_start();
include_once('dbh.php');


class User{

    private $db;

    //connectie maken met de database
    public function  __construct(){
        $this->db = new Connection();
        $this->db = $this->db->DB();
    }

    //de functie om in te loggen
    public function Login($username, $password){
        try {
            $db = $this->db;
            $query = $db->prepare("SELECT username FROM user WHERE (username=:username) AND password=:password");
            $query->bindParam("username", $username, PDO::PARAM_STR);
            $enc_password = hash('sha256', $password);
            $query->bindParam("password", $enc_password, PDO::PARAM_STR);
            $query->execute();
            if ($query->rowCount() > 0) {
                $result = $query->fetch(PDO::FETCH_OBJ);
                $_SESSION['user_id'] = $username;
                header("Location: index.php?login=succes");
            } else {
                header("Location: login.php?login=error");
            }
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }

    //de functie om een nieuw account aan te maken
    public function Aanmelden($username, $password){
        if (!empty($username) && !empty($password)){
            $db = $this->db;
            $st = $db->prepare("SELECT * FROM user WHERE (username=:username)");
            $st->bindParam("username", $username, PDO::PARAM_STR);
            $st->execute();
            $resultCheckNew = $st->rowCount();
            if ($resultCheckNew > 0) {
                 header("Location: aanmelden.php?username-already-exists");
            } else {
                $st = $this->db->prepare("INSERT INTO user (username, password) VALUES (?, ?)");
                $st->bindParam(1, $username);
                $enc_pwd_input = hash('sha256', $password);
                $st->bindParam(2, $enc_pwd_input);
                $st->execute();
                header("Location: login.php?signup=success");
            exit();
        }
        } else {
            echo "username or password is empty";
        }
    }
}


 ?>
