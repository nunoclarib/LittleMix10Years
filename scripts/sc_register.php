<?php
require_once '../connections/connection.php';

if (isset($_POST["name"]) && isset($_POST["surname"]) && isset($_POST["username"]) && isset($_POST["email"]) && isset($_POST["password"])) {

    $nome = $_POST['name'];
    $apelido = $_POST['surname'];
    $username = $_POST['username'];
    $email = $_POST['email'];

    $password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $link = new_db_connection();

    $stmt = mysqli_stmt_init($link);

    $query = "INSERT INTO utilizadores (nome, apelido, username, email, password_hash) VALUES (?,?,?,?,?)";

    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'sssss', $nome, $apelido, $username, $email, $password_hash);

        // Devemos validar também o resultado do execute!
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt);
            mysqli_close($link);



            // Acção de sucesso
            header("Location: ../login.php?msg=1#login");
        } else {
            // Acção de erro
            mysqli_stmt_error($stmt);
            header("Location: ../login.php?msg=0#login");
        }
    } else {
        // Acção de erro
        echo "Error:" . mysqli_error($link);
        mysqli_close($link);
    }
} else {
    echo "Campos do formulário por preencher";
}