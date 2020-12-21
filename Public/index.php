<?php
    session_start();

    require "../Autoloader.php";
    Autoloader::register();
 
    require "header.php";

    use App\Sondage;
    $sondages = new Sondage();
?>

<section class="all-sondages">
    <h2>Sondages en Cours</h2>
    <?php
        $actSond = $sondages->getActiveSonds();
        foreach ($actSond as $key) {
            echo " <article class='link-container'>
                        <a href='sondPage.php?id=$key->sondage_id'>$key->sondage_title</a>
                        <p>Date de création : $key->creation_date</p>
                    </article>";
        }
    ?>

    <h2>Sondages terminés</h2>

    <?php
        $unSond = $sondages->getInactiveSonds();
        foreach ($unSond as $key) {
            echo " <article class='link-container'>
                        <a href='sondPage.php?id=$key->sondage_id'>$key->sondage_title</a>
                        <p>Date de création : $key->creation_date</p>
                    </article>" ;
        }
    ?>
</section>

<?php
require "footer.php";