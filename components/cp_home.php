<?php
if (isset($_SESSION['username'])){

if (isset($_GET["msg"])) {
    $msg_show = true;
    switch ($_GET["msg"]) {
        case 0:
            $message = "O ficheiro é muito grande, terá de ter menos de 500MB!";
            $class = "alert-warning";
            $upload = true;
            break;
        case 1:
            $message = "Erro ao realizar o upload.";
            $class = "alert-danger";
            $upload = true;
            break;
        case 2:
            $message = "Este tipo de ficheiro não é suportado.";
            $class = "alert-warning";
            $upload = true;
            break;
        case 3:
            $message = "Não foi submetido nenhum ficheiro...";
            $class = "alert-warning";
            $upload = true;
            break;
        default:
            $msg_show = false;
    }
}
?>
<section class="ftco-section ftco-intro" id="home">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 text-center">
                <?php
                if (isset($_GET["msg"]) && $upload == true) {
                    echo "<br><div id='alertmsg' class=\"alert $class alert-dismissible fade show\" role=\"alert\">
                            " . $message . "
                            <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                                <span aria-hidden=\"true\">&times;</span>
                            </button>
                    </div>";

                    if ($msg_show) {
                        echo '<script>window.onload=function (){$(\'.alert\').alert();}</script>';
                    }
                } ?>

                <form method="post" action="upload.php" enctype="multipart/form-data">
                    <h2><span>Submete</span> uma foto!</h2><br>
                    <input type="file" name="fileupload"><br><br>
                    <button type="submit" name="submit" class="btn btn-primary">Submeter</button>
                </form>



            </div>
            <div class="row justify-content-end">
                <div class="col-md-12 py-md-5 pt-4 p-md-5 d-flex">
                    <div class="row">
                    <?php
                    require_once "connections/connection.php"; // We need the function!

                    $link = new_db_connection(); // Create a new DB connection

                    $stmt = mysqli_stmt_init($link); // create a prepared statement

                    $query = "SELECT imagem FROM imagens"; // Define the query

                    if (mysqli_stmt_prepare($stmt, $query)) { // Prepare the statement

                        mysqli_stmt_execute($stmt); // Execute the prepared statement

                        mysqli_stmt_bind_result($stmt, $imagem);

                        while (mysqli_stmt_fetch($stmt)) {
                            echo '<div class="col-4 mt-3"><img src="uploads/' . $imagem . '" class="img-fluid"></div>';
                        }

                        mysqli_stmt_close($stmt); // Close statement
                    } else {
                        echo("Error description: " . mysqli_error($link));
                    }

                    } else{
    echo '
        <div class="row justify-content-center mt-5">
            <div class="col-md-12 text-center">
                    <h2 style="font-family: Poppins; color: #8FFFCE;">Submete uma foto aqui! Para isso é necessário realizar o <a href="login.php#login" style="color: black">login.</a></h2><br>
            </div>
            </div>';
                    }
                ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
