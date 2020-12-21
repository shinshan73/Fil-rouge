<?php

namespace App;
use Core\Database;

class Chat extends Database{

    function sendMessage ($data){
        $this->prepare('INSERT INTO chat (pseudo, message, date_envoi, sondage_id) VALUES(:pseudo, :message, NOW(), :sondage_id)', $data);
    }

    function getMessages($sond_id){
        $query = $this->query("SELECT * FROM chat WHERE sondage_id = $sond_id ORDER BY id DESC");
        echo json_encode($query);
    }
}