<?php
session_start();

if (isset($_POST["edit_username"]) && ($_POST["edit_username"] != "") && (isset($_SESSION["id"])) ) {
    $username = $_POST["edit_username"];
    $id = $_SESSION["id"];

   // $password= $_POST['password'];
    // password_hash($password);

    // We need the function!
    require_once ("../connections/connection.php");

    // Create a new DB connection
    $link = new_db_connection();

    /* create a prepared statement */
    $stmt = mysqli_stmt_init($link);

    $query = "UPDATE utilizadores
              SET username = ?
              WHERE idutilizadores = ?";

    if (mysqli_stmt_prepare($stmt, $query)) {
        /* Bind paramenters */
        mysqli_stmt_bind_param($stmt, "si", $username, $id);
        /* execute the prepared statement */
            if (!mysqli_stmt_execute($stmt)) {
                echo "Error:" . mysqli_stmt_error($stmt);
                header("Location: ../updateperfil.php?msg=0.php#perfil");
            } else {

                $_SESSION["username"] = $username;
                header("Location: ../perfil.php#perfil");
            }
        /* close statement */
        mysqli_stmt_close($stmt);
    } else {
        echo("Error description: " . mysqli_error($link));
    }
    /* close connection */
    mysqli_close($link);
} else{
    header("Location: ../updateperfil.php?msg=1#perfil");
}



