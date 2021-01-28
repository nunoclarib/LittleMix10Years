<?php
session_start();
require_once '../connections/connection.php';

if (isset($_POST['password_verify']) && (isset($_SESSION["id"]))) {

    $password = $_POST['password_verify'];
    $id = $_SESSION["id"];

    $link = new_db_connection();

    $stmt = mysqli_stmt_init($link);

    $query = "SELECT password_hash FROM utilizadores WHERE idutilizadores = ?";

    if (mysqli_stmt_prepare($stmt, $query)) {

        mysqli_stmt_bind_param($stmt, 'i', $id);

        if (mysqli_stmt_execute($stmt)) {

            mysqli_stmt_bind_result($stmt, $password_hash);

            if (mysqli_stmt_fetch($stmt)) {
                // Verifica se a password_hash corresponde à password
                if (password_verify($password, $password_hash)) {
                    // Feedback de sucesso
                    header("Location: ../updateperfil.php#perfil");
                } else {
                    // Password está errada
                    header("Location: ../verifypass.php?msg=0#perfil");
                }
            }
            mysqli_stmt_close($stmt);
            mysqli_close($link);
        }
        else {
            // Acção de erro
            echo "Error:" . mysqli_stmt_error($stmt);
        }
    } else {
        // Acção de erro
        echo "Error:" . mysqli_error($link);
        mysqli_close($link);
    }
}
