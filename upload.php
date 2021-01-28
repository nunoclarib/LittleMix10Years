<?php

if (isset($_POST['submit'])){
    $file = $_FILES['fileupload'];
   // print_r($file); // consegue-se ver o nome, o tipo, tmp_name, erro e size da imagem
    // colocar esses dados que estão num array numa variável
    $fileName = $_FILES['fileupload']['name'];
    $fileTmpName = $_FILES['fileupload']['tmp_name'];
    $fileSize = $_FILES['fileupload']['size'];
    $fileError = $_FILES['fileupload']['error'];
    $fileType = $_FILES['fileupload']['type'];

    // separa a parte do nome da foto e do .jpg e coloca num array
    $fileExt = explode('.',$fileName);
    // transformar letras grandes em pequenas
    // vai buscar o .jpg por exemplo (end)
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg','jpeg','png','gif');

    // se o fileactualext for igual aos valores no array
    if (in_array($fileActualExt, $allowed)){
        // se não ocorrer um erro
        if ($fileError===0){
            // se o ficheiro for menor que 500KB
            if ($fileSize < 500000){
                // cria um nome de acordo com os microsegundos no momento + o .jpg
                $fileNameNew = uniqid('',true).".".$fileActualExt;

                $fileDestination = 'uploads/'.$fileNameNew;

                // move o ficheiro da localização temporal para a localização final
                move_uploaded_file($fileTmpName, $fileDestination);

                header("Location: index.php");
            }
            else{
                echo 'Ficheiro muito grande';
                header("Location: index.php?msg=0");
            }
        }
        else{
            echo 'Erro ao fazer upload';
            header("Location: index.php?msg=1");
        }
    }
    else{
        echo 'Não é suportado este tipo de ficheiro';
        header("Location: index.php?msg=2");
    }

}
else{
    echo'Não existe file';
    header("Location: index.php?msg=3");
}

if (isset($fileNameNew)){
    session_start();
    require_once 'connections/connection.php';

    $link = new_db_connection();

    $stmt = mysqli_stmt_init($link);

    $query = "INSERT INTO imagens VALUES ( NULL, '$fileNameNew' )";

    if (mysqli_stmt_prepare($stmt, $query)) {

        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_bind_result($stmt, $id, $imagem);

            mysqli_stmt_fetch($stmt);

            header('Location : index.php');

        }
        mysqli_stmt_close($stmt);
    } else {
        echo("Error description: " . mysqli_error($link));
    }

    mysqli_close($link);
}


