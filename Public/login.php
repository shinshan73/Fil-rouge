<?php
session_start();

require "../Autoloader.php";
Autoloader::register();

require "header.php";
?>
<section id="login-container">
    <form id="login-form">
        <input type="email" placeholder="Email" name="email" id="email">
        <input type="password" placeholder="Password" name="password" id="password">
        <button id="login">Log In</button>
    </form>
    <p>Pas de compte ? <a href="signup.php">S'inscrire</a></p>
</section>



<?php
require "footer.php";
