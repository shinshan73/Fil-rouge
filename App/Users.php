<?php
namespace App;
use Core\Database;
class Users extends Database
{
    function getMyData($myId){
        $data = $this->query("SELECT * FROM user WHERE user_id = $myId", true);
        echo json_encode($data);
    }

    function changeMyData(array $changing, $myId){
        $this->prepare("UPDATE user SET pseudo = :pseudo, email = :email, password = :password WHERE user_id = $myId", $changing);
    }
}