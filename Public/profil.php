<?php
session_start();

require "../Autoloader.php";
Autoloader::register();

require "header.php";

 if(empty($_SESSION["user"])){
    header('location:login.php');
}

?>

<section class="profil">

    <form id="infos">
        <label for="pseudo">Votre Pseudo :</label>
        <input type="text" name="pseudo" id="pseudo" readonly>
        <br>
        <label for="email">Votre Email :</label>
        <input type="text" name="email" id="email" readonly>
        <br>
        <label for="pass">Votre mot de passe :</label>
        <input type="password" name="password" id="pass-1" readonly>
        <br>
    </form>
    <div id="mdp-confirm" style="display: none;">
        <label for="pass">Confirmer votre mot de passe :</label>
        <br>
        <input type="password" name="password" id="pass-2">
    </div>
    <br>
    <button id="change">Changer mes informations</button>
    <button id="confirm" style="display: none;">Confirmer les changements</button>

   
    
    <button id="friendsButton">Cacher tes amis</button>
    <ul id="friendsList"></ul>
</section>

<?php
require "footer.php";
?>



<script src="../js/user.js"></script>