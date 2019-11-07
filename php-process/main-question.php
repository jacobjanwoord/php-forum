<?php

session_start();

include_once('dbh.php');


class Question{

    private $db;

    public function  __construct(){
        $this->db = new Connection();
        $this->db = $this->db->DB();
    }

    // maakt nieuwe question aan
    public function New_question($title, $message, $user_id, $date_created, $open){
        if (!empty($title) && !empty($message)) {
            //checked of er all een question met de ingevoerde title is
            $db = $this->db;
            $st = $db->prepare("SELECT * FROM question WHERE (title=:title)");
            $st->bindParam("title", $title, PDO::PARAM_STR);
            $st->execute();
            $resultCheckNew = $st->rowCount();
            if ($resultCheckNew > 0) {
                 header("Location: new-question.php?question-already-exists");
            } else {
                //voegt een nieuwe question toe aan de database
                $db = $this->db;
                $st = $db->prepare("INSERT INTO question (title, message, user_id, date_created, open) VALUES (:title, :message, :user_id, :date_created, :open)");
                $st->bindParam("title", $title, PDO::PARAM_STR);
                $st->bindParam("message", $message, PDO::PARAM_STR);
                $st->bindParam("user_id", $user_id, PDO::PARAM_STR);
                $st->bindParam("date_created", $date_created, PDO::PARAM_STR);
                $st->bindParam("open", $open, PDO::PARAM_STR);
                $st->execute();
                header("Location: index.php?question=created");
            }
        } else {
            echo "title or message is empty";
        }
    }// end of  New_question function

    //zoekt voor een nieuwe functie
    public function Select_question($search_input){
        if (!empty($search_input)) {
            $db = $this->db;
            $st = $db->prepare("SELECT * FROM question WHERE (title=:title)");
            $st->bindParam("title", $search_input, PDO::PARAM_STR);
            $st->execute();
            $total_q = $st->rowCount();
            $_SESSION['total_q'] = $total_q;

            while($row = $st->fetch(PDO::FETCH_ASSOC)) {
                $select_result[] = [$row['id'], $row['title'], $row['message'], $row['user_id'], $row['date_created'], $row['open']];
            }
            $_SESSION['result'] = $select_result;
            header("Location: feed.php?question-result");
        } else {
            echo "you didn't search for anything";
            header("Location: index.php?failed-search-result");
        }
    }

    //zoek functie die gebruikt maakt van de search input
    public function Search_question($search_input){
        if (!empty($search_input)) {
            $term = "%$search_input%";

            $db = $this->db;
            $st = $db->prepare("SELECT title FROM question WHERE title LIKE :title");
            $st->bindParam("title", $term, PDO::PARAM_STR);
            $st->execute();
            $total_s = $st->rowCount();
            $_SESSION['total_s'] = $total_s;

            while($row = $st->fetch(PDO::FETCH_ASSOC)) {
                $search_result[] = $row['title'];
            }
            $_SESSION['search_result'] = $search_result;
            header("Location: search-list.php?search-result");
        }else {
            header("Location: search-list.php?search-input-empty");
        }
    }

    // admin section
    //deleting question by admin
    public function Delete_question($user_id_ad, $title_result){
        if ($user_id_ad === 'admin') {
            $db = $this->db;
            $std = $db->prepare("DELETE FROM `question` WHERE (title=:title)");
            $std->bindParam("title", $title_result, PDO::PARAM_STR);
            $std->execute();
        }
    }

    //setting question to open by admin
    public function Set_open_question($user_id_ad, $title_result){
        if ($user_id_ad === 'admin') {
            $db = $this->db;
            $sto = $db->prepare("UPDATE `question` SET open = true WHERE (title=:title)");
            $sto->bindParam("title", $title_result, PDO::PARAM_STR);
            $sto->execute();
        }
    }

    //setting question to closed by admin
    public function Set_closed_question($user_id_ad, $title_result){
        if ($user_id_ad === 'admin') {
            $db = $this->db;
            $sto = $db->prepare("UPDATE `question` SET open = false WHERE (title=:title)");
            $sto->bindParam("title", $title_result, PDO::PARAM_STR);
            $sto->execute();
        }
    }

    //listing questions
    public function List_question(){
        $db = $this->db;
        $st = $db->prepare("SELECT * FROM question");
        $st->execute();
        $total_list = $st->rowCount();
        $_SESSION['total_list'] = $total_list;
        while($row = $st->fetch(PDO::FETCH_ASSOC)) {
            $list_result[] = [$row['id'], $row['title'], $row['message'], $row['user_id'], $row['date_created'], $row['open']];
        };
        $_SESSION['list_result'] = $list_result;
    }//end of admin section

} // end of question class




//start of response class
class Response{

    private $db;

    function __construct(){
        $this->db = new Connection();
        $this->db = $this->db->DB();
    }

    // maakt  en nieuwe response aan
    public function New_response($feed_name_res, $user_id_res, $message_res, $date_created_res){
        if (!empty($message_res)) {
            //kijkt of er al een repsonse is die dezelfde message heeft en bij dezelfde question hoort
            $db = $this->db;
            $st = $db->prepare("SELECT * FROM response WHERE (message=:message) AND (feed_name=:feed_name)");
            $st->bindParam("message", $message_res, PDO::PARAM_STR);
            $st->bindParam("feed_name", $feed_name_res, PDO::PARAM_STR);
            $st->execute();
            $resultCheckNew = $st->rowCount();
            if ($resultCheckNew > 0) {
                 header("Location: feed.php?response-already-exists");
            } else {
                //voegt een nieuwe response aan de database toe
                $db = $this->db;
                $st = $db->prepare("INSERT INTO `response`(`feed_name`, `user_id`, `message`, `date_created`) VALUES (:feed_name, :user_id, :message, :date_created)");
                $st->bindParam("feed_name", $feed_name_res, PDO::PARAM_STR);
                $st->bindParam("user_id", $user_id_res, PDO::PARAM_STR);
                $st->bindParam("message", $message_res, PDO::PARAM_STR);
                $st->bindParam("date_created", $date_created_res, PDO::PARAM_STR);
                $st->execute();
                header("Location: feed.php?response=created");
            }
        } else {
            echo "message is empty";
        }
    }// end of  New_response function

    //zoek functie voor responses
    public function Search_responses($search_input){
        if (!empty($search_input)) {
            $db = $this->db;
            $st = $db->prepare("SELECT * FROM response WHERE (feed_name=:feed_name)");
            $st->bindParam("feed_name", $search_input, PDO::PARAM_STR);
            $st->execute();
            $total_r = $st->rowCount();
            $_SESSION['total_r'] = $total_r;
            while($row = $st->fetch(PDO::FETCH_ASSOC)) {
                $response_result[] = [$row['id'], $row['feed_name'], $row['user_id'], $row['message'], $row['date_created']];
            }
            $_SESSION['response'] = $response_result;
            header("Location: feed.php?result");
        } else {
            echo "you didn't search for anything";
            header("Location: index.php?failed-search-result");
        }
    }

    //deleting response
    public function Delete_response($user_id_ad){
        if ($user_id_ad === 'admin') {
            $db = $this->db;
            $std = $db->prepare("DELETE FROM `response` WHERE (message=:message)");
            $std->bindParam("message", $_SESSION['res_message'], PDO::PARAM_STR);
            $std->execute();
        }
    }

}//end of response class



?>
