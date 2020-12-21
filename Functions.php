<?php
session_start();
require "./Autoloader.php";
Autoloader::register();


use App\Chat;
use App\Friends;
use App\Sondage;
use App\Users;


$chat = new Chat();
$friends = new Friends();
$sondage = new Sondage();
$users = new Users();

// Fonctions à appeler avec ajax

switch ($_GET["function"]) {
    case "login":
        var_dump($_POST);
        $verif = $users->pdo->prepare("SELECT * FROM user WHERE email = :email AND password = :password");
        $verif->bindParam(':email', $_POST["email"], PDO::PARAM_STR);
        $verif->bindParam(':password', $_POST["password"], PDO::PARAM_STR);
        $verif->execute();

        if ($verif->rowCount() > 0) {
            $infos = $verif->fetch(PDO::FETCH_OBJ);
            $_SESSION["user"]["id"] = $infos->user_id;
            $_SESSION["user"]["pseudo"] = $infos->pseudo;
            $_SESSION["user"]["email"] = $infos->email;
            var_dump($_SESSION);
            var_dump($infos);
        } else {
            echo "pas content";
        }

        break;

    case "signup":
        var_dump($_POST);
        $users->prepare("INSERT INTO user (pseudo, email, password) VALUES (:pseudo, :email, :password)", $_POST);
        break;

    case "sendMessage":
        var_dump($_POST);
        $_POST['pseudo'] = $_SESSION['user']['pseudo'];
        var_dump($_POST);
        $chat->sendMessage($_POST);
        break;

    case "getMsg":
        $chat->getMessages($_POST["sondage_id"]);
        break;

    case "createSond":
        var_dump($_POST);
        $sondage->createSond($_POST);
        break;

    case "vote":
        $id = $_POST["data"][0];
        $sond_id = $_POST["data"][1];
        var_dump($id);
        var_dump($sond_id);
        $sondage->Vote($id, $sond_id);
        echo json_encode("");
        break;

    case "MySonds":
        $sondage->getMySonds($_SESSION["user"]["id"]);
        break;

    case "endSond":
        var_dump($_POST["id"]);
        $sondage->endSond($_POST["id"]);
        break;

    case "getMyInfos":
        $users->getMyData($_SESSION['user']['id']);
        break;

    case 'updateInfos':
        $users->changeMyData($_POST, $_SESSION['user']['id']);
        $_SESSION['user']['pseudo'] = $_POST['pseudo'];
        $_SESSION['user']['email'] = $_POST['email'];
    break;

    case "friendsList":
        $query = $users->pdo->prepare("SELECT user_id, pseudo FROM user WHERE user_id IN (SELECT friend_user_id FROM friendship WHERE user_id = :user_id)");
        $query->bindParam(':user_id', $_SESSION["user"]["id"], PDO::PARAM_STR);
        $query->execute();
        $response = $query->fetchAll(\PDO::FETCH_OBJ);
        echo json_encode($response);
        break;

    case "search":
        $pseudo = $_GET["pseudo"]."%";

        $query = $users->pdo->prepare("SELECT user_id, pseudo FROM user WHERE pseudo LIKE :pseudo AND user_id != :id");
        $query->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
        $query->bindParam(':id', $_SESSION["user"]["id"], PDO::PARAM_STR);
        $query->execute();

        $response = $query->fetchAll(\PDO::FETCH_OBJ);
        echo json_encode($response);
        break;

    case "addInFriendList":
        $query = $users->pdo->prepare("INSERT INTO friendship (user_id, friend_user_id) VALUES (:id, :friend_id)");
        $query->bindParam(':id', $_SESSION["user"]["id"], PDO::PARAM_STR);
        $query->bindParam(':friend_id', $_POST["friend_user_id"], PDO::PARAM_STR);
        $query->execute();
        break;

    case "deleteInFriendList":
        echo $_POST['friend_user_id'];
        $query = $users->pdo->prepare("DELETE FROM friendship WHERE user_id = :user_id AND friend_user_id = :friend_user_id");
        $query->bindParam(':user_id', $_SESSION["user"]["id"], PDO::PARAM_STR);
        $query->bindParam(':friend_user_id', $_POST["friend_user_id"], PDO::PARAM_STR);
        echo $query->execute();
        break;

}
