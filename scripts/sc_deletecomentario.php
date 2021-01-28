<?php
session_start();

$id = $_GET["idcom"];
$idalbum = $_SESSION['idalbum'];
$user = $_GET["user"];

if (isset($_GET["idcom"]) && isset($_SESSION['idalbum']) && ($_GET["user"]==$_SESSION['username'])) {
    require_once("../connections/connection.php");

    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);

    $query = "DELETE FROM comentarios
              WHERE idcomentarios = ?";

    if (mysqli_stmt_prepare($stmt, $query)) {
        /* Bind paramenters */
        mysqli_stmt_bind_param($stmt, "i", $id);
        /* execute the prepared statement */
        if (!mysqli_stmt_execute($stmt)) {
            echo "Error:" . mysqli_stmt_error($stmt);
        }
        /* close statement */
        mysqli_stmt_close($stmt);
    } else {
        echo("Error description: " . mysqli_error($link));
    }
    /* close connection */
    mysqli_close($link);

    header("Location: ../discografia_info.php?id=$idalbum&user=$user#comentarios");

} else {
    header("Location: ../discografia_info.php?id=$idalbum&user=$user#comentarios");
}