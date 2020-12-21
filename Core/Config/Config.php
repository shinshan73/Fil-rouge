<?php

$dbconfig = [
    "host" => "mysql:host=localhost:3306;dbname=project-poo",
    "login" => "root",
    "pass" => "",
    "options" => array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
    ),
];
