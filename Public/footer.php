    <footer>
        <?php
        if (!empty($_SESSION['user'])) {

            echo "<ul>
                        <li><a href='mySonds.php'>Mes sondages créés</a></li>
                        <li><a href='participate.php'>Mes participations</a></li>
                        <li><a href='search.php'>Ajouter un ami</a></li>
                        <li><a href='disconnect.php'>Se déconnecter</a></li>
                    </ul>";
        }
        ?>

    </footer>
    <script src="../js/login.js"></script>
    <script src="../js/sondage.js"></script>
    <script src="../js/friends.js"></script>
    <script src="../js/search.js"></script>
    </body>

    </html>