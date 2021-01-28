<?php
if (!isset($_SESSION)) {
    session_start();

}
if (isset($_SESSION["username"])) {

    unset($_SESSION["username"]);
    unset($_SESSION['role']);
    unset($_SESSION['id']);

}
header('Location: ../index.php');
