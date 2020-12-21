<?php
session_start();

require "../Autoloader.php";
Autoloader::register();

require "header.php";
?>

<section class="mySonds-container">
    <h2>Mes sondages</h2>
    <br>
    <br>
    <h3>Sondages actifs</h3>
    <br>
    <section id="sonds-actives" class='zisection'>

    </section>
    <br>
    <h3>Sondages inactifs</h3>
    <br>
    <section id="sonds-inactives" class='zisection'>

    </section>
</section>


<script src="../js/mysonds.js"></script>

<?php
require "footer.php";
