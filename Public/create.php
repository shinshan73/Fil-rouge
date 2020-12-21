<?php
session_start();
require "header.php";

if(empty($_SESSION["user"])){
    header('location:login.php');
}

?>

<section id="container-create">

<form action="" id="createSond">
    <input type="text" name="sondage_title" placeholder="Titre" id="title">
    <input type="text" name="sondage_question1" placeholder="Question 1" id="q1">
    <input type="text" name="sondage_question2" placeholder="Question 2" id="q2">
    <input type="text" name="sondage_question3" placeholder="Question 3" id="q3">
    <input type="text" name="sondage_question4" placeholder="Question 4" id="q4">
    
    <button id="create">Créer le sondage</button>
</form>
    
</section>






<?php
require "footer.php";