<?php
ini_set('display_errors', true);
error_reporting(E_ALL);
function new_db_connection()
{
    // Defining work environment
    $env = "server";
    //$env = "localhost";

    if ($env == "server") {
        $hostname = 'nunoclarib.me';
        $username = "nunoclarib";
        $password = "Ncpribe021@#";
        $dbname = "deca_19l4_mp_11";
    }
    if ($env == "localhost") {
        $hostname = 'localhost';
        $username = "root";
        $password = "";
        $dbname = "miniprojeto";
    }

// Connection
    $local_link = mysqli_connect($hostname, $username, $password, $dbname);

// Error
    if (!$local_link) {
        die("Connection failed: " . mysqli_connect_error());
    }

// Defining charset to prevent character error
    mysqli_set_charset($local_link, "utf8");

    // Return the link
    return $local_link;
}
