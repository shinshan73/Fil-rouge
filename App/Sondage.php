<?php

namespace App;

use Core\Database;

class Sondage extends Database
{
    function createSond(array $data)
    {
        $myId =  $_SESSION["user"]["id"];
        $prepare = $this->pdo->prepare("INSERT INTO sondages (sondage_title, sondage_question1, sondage_question2, sondage_question3, sondage_question4, creation_date, status_sondage, sondage_creator)
                                        VALUES (:sondage_title, :sondage_question1, :sondage_question2, :sondage_question3, :sondage_question4, NOW(), 'On', $myId)");
        $prepare->execute($data);

        //init result datas
        $query = $this->pdo->query("SELECT sondage_id FROM sondages ORDER BY sondage_id DESC");
        $id = $query->fetch(\PDO::FETCH_OBJ);
        $this->pdo->query("INSERT INTO results (sondage_id, result_1, result_2, result_3, result_4, total_entries) VALUES ($id->sondage_id, 0, 0, 0, 0, 0) ");
    }

    function getSonds()
    {
        $query = $this->pdo->query("SELECT * FROM sondages");
        $response = $query->fetchAll(\PDO::FETCH_OBJ);

        echo json_encode($response);
    }

    function getOneSond($id)
    {
        $query = $this->pdo->query("SELECT * FROM sondages WHERE sondage_id = $id");
        $response = $query->fetch(\PDO::FETCH_OBJ);

        return ($response);
    }

    function getSondsNoAjax()
    {
        $query = $this->pdo->query("SELECT * FROM sondages");
        $response = $query->fetchAll(\PDO::FETCH_OBJ);

        return ($response);
    }


    function getActiveSonds()
    {
        $query = $this->pdo->query("SELECT * FROM sondages WHERE status_sondage = 'On'");
        $response = $query->fetchAll(\PDO::FETCH_OBJ);

        return ($response);
    }

    function getInactiveSonds()
    {
        $query = $this->pdo->query("SELECT * FROM sondages WHERE status_sondage = 'Off'");
        $response = $query->fetchAll(\PDO::FETCH_OBJ);

        return ($response);
    }

    function getMySonds($myId)
    {
        $query = $this->pdo->query("SELECT * FROM sondages 
                                    INNER JOIN user
                                    WHERE sondage_creator = $myId
                                    AND sondage_creator = user.user_id");
        $response = $query->fetchAll(\PDO::FETCH_OBJ);

        echo json_encode($response);
    }

    function getMyParticipate($myId)
    {
        $query = $this->pdo->query("SELECT * FROM sondages 
                                    INNER JOIN user
                                    INNER JOIN participation
                                    WHERE participation.user_id = $myId 
                                    AND participation.sondage_id = sondages.sondage_id 
                                    AND participation.user_id = user.user_id");
        $response = $query->fetchAll(\PDO::FETCH_OBJ);

        return ($response);
    }

    function checkIfParticipated($myId, $idSond){
        $query = $this->pdo->query("SELECT * FROM sondages 
                                    INNER JOIN user
                                    INNER JOIN participation
                                    WHERE participation.user_id = $myId 
                                    AND participation.sondage_id = $idSond
                                    AND participation.sondage_id = sondages.sondage_id 
                                    AND participation.user_id = user.user_id");
        if($query->rowCount() > 0){
            $response = true;
        }else{
            $response = false;
        }

        return ($response);
    }

    function getResults($sondId)
    {
        $query = $this->pdo->query("SELECT * FROM results
                                    INNER JOIN sondages
                                    WHERE sondages.sondage_id = $sondId
                                    AND results.sondage_id = sondages.sondage_id");
        $response = $query->fetch(\PDO::FETCH_OBJ);

        return ($response);
    }

    function Vote($nInput, $sond_id)
    {
        $query = $this->pdo->query("SELECT * FROM results WHERE sondage_id = $sond_id");
        $response = $query->fetch(\PDO::FETCH_OBJ);

        $points1 = $response->result_1;
        $points2 = $response->result_2;
        $points3 = $response->result_3;
        $points4 = $response->result_4;
        $total = $response->total_entries; 

        switch ($nInput) {
            case "1":
                $this->pdo->query("UPDATE results SET result_1 = ($points1 + 1) WHERE sondage_id = $sond_id");  
                $this->pdo->query("UPDATE results SET total_entries = ($total + 1) WHERE sondage_id = $sond_id");  
                break;
            case "2":
                $this->pdo->query("UPDATE results SET result_2 = ($points2 + 1) WHERE sondage_id = $sond_id");  
                $this->pdo->query("UPDATE results SET total_entries = ($total + 1) WHERE sondage_id = $sond_id"); 
                break;
            case "3":
                $this->pdo->query("UPDATE results SET result_3 = ($points3 + 1) WHERE sondage_id = $sond_id ");  
                $this->pdo->query("UPDATE results SET total_entries = ($total + 1) WHERE sondage_id = $sond_id"); 
                break;
            case "4":
                $this->pdo->query("UPDATE results SET result_4 = ($points4 + 1) WHERE sondage_id = $sond_id");  
                $this->pdo->query("UPDATE results SET total_entries = ($total + 1) WHERE sondage_id = $sond_id"); 
                break;
        }

        $this->pdo->query("INSERT INTO participation (user_id, sondage_id) VALUES (". $_SESSION['user']['id'].", $sond_id)");
    }

    function endSond($sond_id){
        $this->pdo->query("UPDATE sondages SET status_sondage = 'Off' WHERE sondage_id = $sond_id");
    }
}
