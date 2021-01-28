<?php
session_start();
if ( (isset($_POST["comentario"])) && (isset($_SESSION["username"]))  && (isset($_SESSION['idalbum'])) ) {

    require_once ("../connections/connection.php"); // We need the function!

    $username_comment = $_SESSION["username"];

    $link = new_db_connection(); // Create a new DB connection

    $stmt1 = mysqli_stmt_init($link); // create a prepared statement

    $query = "SELECT idutilizadores FROM utilizadores WHERE username = ?"; // Define the query

    if (mysqli_stmt_prepare($stmt1, $query)) { // Prepare the statement

        mysqli_stmt_bind_param($stmt1, "s", $username_comment);

        mysqli_stmt_execute($stmt1); // Execute the prepared statement

        mysqli_stmt_bind_result($stmt1, $idutilizadores);

        mysqli_stmt_fetch($stmt1);
        echo $idutilizadores;

        mysqli_stmt_close($stmt1); // Close statement
    } else {
        echo("Error description: " . mysqli_error($link));
    }

    $texto = $_POST["comentario"];
    $idalbum = $_SESSION["idalbum"];

    echo $texto;
    echo $idalbum;

    $stmt = mysqli_stmt_init($link); // create a prepared statement

    $query = "INSERT INTO comentarios 
              (idcomentarios, comentario, utilizadores_idutilizadores, albuns_idalbuns)
                VALUES (NULL, ?, $idutilizadores, $idalbum)"; // Define the query

    if (mysqli_stmt_prepare($stmt, $query)) { // Prepare the statement

        mysqli_stmt_bind_param($stmt, "s", $texto);

        mysqli_stmt_execute($stmt); // Execute the prepared statement

        mysqli_stmt_close($stmt); // Close statement
    } else {
        echo("Error description: " . mysqli_error($link));
    }
    mysqli_close($link); // Close connection


}
header("Location: ../discografia_info.php?id=$idalbum#comentarios");
