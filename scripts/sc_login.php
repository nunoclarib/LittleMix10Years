<?php
require_once '../connections/connection.php';

if (isset($_POST["username"]) && isset($_POST["password"])) {

    $username = $_POST['username'];
    $password = $_POST['password'];


    $link = new_db_connection();

    $stmt = mysqli_stmt_init($link);

    $query = "SELECT password_hash, administracao_idadministracao, idutilizadores FROM utilizadores WHERE username LIKE ?";

    if (mysqli_stmt_prepare($stmt, $query)) {

        mysqli_stmt_bind_param($stmt, 's', $username);

        if (mysqli_stmt_execute($stmt)) {

            mysqli_stmt_bind_result($stmt, $password_hash, $perfil, $idutilizadores);

            if (mysqli_stmt_fetch($stmt)) {
                // Verifica se a password_hash corresponde à password
                if (password_verify($password, $password_hash)) {
                    // Guardar sessão de utilizador
                    session_start();
                    $_SESSION["username"] = $username;
                    $_SESSION["role"] = $perfil;
                    $_SESSION["id"] = $idutilizadores;

                    // Feedback de sucesso
                    header("Location: ../index.php");
                } else {
                    // Password está errada
                    echo "Incorrect credentials!";
                    header("Location: ../login.php?msg=2#login");
                }
            } else {
                // Username não existe
                echo "Incorrect credentials!";
                header("Location: ../login.php?msg=2#login");
            }
            mysqli_stmt_close($stmt);
            mysqli_close($link);
        } else {
            // Acção de erro
            echo "Error:" . mysqli_stmt_error($stmt);
        }
    } else {
        // Acção de erro
        echo "Error:" . mysqli_error($link);
        mysqli_close($link);
    }
} else {
    echo "Campos do formulário por preencher";
}