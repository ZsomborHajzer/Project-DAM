<?php


try {
    $dbHandler = new PDO("mysql:host=mysql;dbname=Project Term 2;charset=utf8", "root", "qwerty");
    $dbHandler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $ex) {
    echo "Connection failed: " . $ex->getMessage();
}
