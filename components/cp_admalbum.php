<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('images/loginimg.jpg');"
         data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-end">
            <div class="col-md-9 ftco-animate pb-5">
                <h2 class="mb-3 bread">Página de Administração</h2>
                <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home <i
                                    class="ion-ios-arrow-forward"></i></a></span> <span>Página de Administração <i
                                class="ion-ios-arrow-forward"></i></span></p>
            </div>
        </div>
    </div>
</section>
<section id='adm' class="ftco-section ftco-intro">
    <div class="container">
        <div class="row">
                <h1 class="d-block">Gerir Album</h1>
        </div>
<?php
if (isset($_GET['id']) && $_GET['id'] < 7 && $_GET['id'] > 0) {
    $id_album = $_GET['id'];
    require_once("connections/connection.php");

    // Create a new DB connection
    $link = new_db_connection();
    /* create a prepared statement */
    $stmt = mysqli_stmt_init($link);

    $query = "SELECT titulo, ano, description_short, description_long, capa_album, banda_idbanda 
              FROM albuns
              WHERE idalbuns = ?";

    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, "i", $id_album);
        /* execute the prepared statement */
        if (mysqli_stmt_execute($stmt)) {
            /* bind result variables */
            mysqli_stmt_bind_result($stmt,  $titulo, $ano, $description_short, $description_long, $capa_album, $banda );

            /* fetch values */
            if (!mysqli_stmt_fetch($stmt)) {
                // Isto significa que não há resultado da query
                header("Location: admalbum.php#adm");
            }
            else{
                $_SESSION["idalbum"] = $id_album;

            }

        } else {
            // Acção de erro
            echo "Error:" . mysqli_stmt_error($stmt);
        } /* close statement */
        mysqli_stmt_close($stmt);
    } else {
        echo("Error description: " . mysqli_error($link));
        /* close connection */
        mysqli_close($link);
    }

?>
        <div class="row justify-content-end">
            <div class="col-md-8 py-md-5 pt-4 p-md-5">
                <form method="post" action="scripts/sc_updatealbuns.php">
                    <label>Título:</label>
                    <input type="text" name="titulo" class="form-control" value="<?=$titulo?>"><br>
                    <label>Ano de Lançamento:</label>
                    <input type="text" name="ano" class="form-control" value="<?=$ano?>"><br>
                    <label>Banda:</label>
                    <select name="banda" class="form-control">
                        <?php
                        // Create a new DB connection
                        $link = new_db_connection();

                        /* create a prepared statement */
                        $stmt = mysqli_stmt_init($link);

                        $query = "SELECT idbanda, nome
                                  FROM banda ORDER BY idbanda";

                        if (mysqli_stmt_prepare($stmt, $query)) {
                            /* execute the prepared statement */
                            if (mysqli_stmt_execute($stmt)) {
                                /* bind result variables */
                                mysqli_stmt_bind_result($stmt, $idbanda, $nome);

                                /* fetch values */
                                while (mysqli_stmt_fetch($stmt)) {
                                    if ($banda == $idbanda) {
                                        $selected = "selected";
                                    } else {
                                        $selected = "";
                                    }
                                    echo '<option value="'.$idbanda.'" '.$selected.'>'.$nome.'</option>';
                                }

                            }  else {
                                // Acção de erro
                                echo "Error:" . mysqli_stmt_error($stmt);
                            }
                            /* close statement */
                            mysqli_stmt_close($stmt);
                        } else {
                            echo("Error description: " . mysqli_error($link));
                        }
                        /* close connection */
                        mysqli_close($link);
                        ?>
                    </select><br>
                    <label>Pequena Descrição:</label>
                    <textarea name="des_short" id="des2" cols="30" rows="3" class="form-control" ><?= $description_short?></textarea><br>
                    <label>Texto:</label>
                    <textarea name="des_long" id="des1" cols="30" rows="5" class="form-control" ><?= $description_long?></textarea><br>
                    <button type="submit" class="btn btn-primary"> Alterar Álbum </button>
                </form>
            </div>

            <div class="col-md-4 ">
                <img src="images/<?=$capa_album?>" alt="" class="img-fluid">
            </div>

        </div>

<?php
} else {
    include_once 'cp_404.php';
}
?>
    </div>
</section>
