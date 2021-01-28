<?php
session_start();

if (isset($_SESSION['id']) ) {
    require_once "../connections/connection.php";

    $id = $_SESSION['id'];

    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);

    $query = "DELETE FROM utilizadores
              WHERE idutilizadores = ?";

    if (mysqli_stmt_prepare($stmt, $query)) {
        /* Bind paramenters */
        mysqli_stmt_bind_param($stmt, "i", $id);
        /* execute the prepared statement */
        if (!mysqli_stmt_execute($stmt)) {
            echo "Error:" . mysqli_stmt_error($stmt);

        }
        else{
            unset($_SESSION['username']);
            unset($_SESSION['role']);
            unset($_SESSION['id']);
        }
        /* close statement */
        mysqli_stmt_close($stmt);
    } else {
        echo("Error description: " . mysqli_error($link));
    }
    /* close connection */
    mysqli_close($link);

    header("Location: ../index.php");

} else {
    header("Location: ../update_perfil.php#perfil");
}