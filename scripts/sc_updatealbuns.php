<?php
session_start();
// Falta verificar se existem os outros campos do formulário
if (isset($_POST["titulo"]) && isset($_POST["ano"]) && isset($_POST["des_short"]) && isset($_POST["des_long"]) && ($_POST["titulo"] != "") && (isset($_SESSION["idalbum"]))) {
    $titulo = $_POST["titulo"];
    $ano = $_POST["ano"];
    $des_short = $_POST["des_short"];
    $des_long = $_POST["des_long"];
    $banda = $_POST["banda"];
    $idalbum = $_SESSION["idalbum"];

    // We need the function!
    require_once ("../connections/connection.php");

    // Create a new DB connection
    $link = new_db_connection();

    /* create a prepared statement */
    $stmt = mysqli_stmt_init($link);

    $query = "UPDATE albuns
              SET titulo = ?, ano = ?, banda_idbanda = ?, description_short = ?, description_long = ?
               
              WHERE idalbuns = ?";

    if (mysqli_stmt_prepare($stmt, $query)) {
        /* Bind paramenters */
        mysqli_stmt_bind_param($stmt, "siissi", $titulo, $ano, $banda, $des_short, $des_long , $idalbum);
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
}
 header("Location: ../discografia.php#album");