<?php
    session_start();

    require "../Autoloader.php";
    Autoloader::register();
 
    require "header.php";

    use App\Sondage;
    $sondages = new Sondage();
?>

<section class="myParticipations">

    <h2>Mes participations</h2>
    <br>
    <?php
        $myPart = $sondages->getMyParticipate($_SESSION['user']['id']);
        foreach($myPart as $sond){
            echo "<a href='sondPage.php?id=$sond->sondage_id'>$sond->sondage_title</a>";
        }
    ?>
    
</section>

<?php

require "footer.php";