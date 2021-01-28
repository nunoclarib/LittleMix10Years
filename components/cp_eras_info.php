<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('images/discografia.jpg');"
         data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-end">
            <div class="col-md-9 ftco-animate pb-5">
                <h2 class="mb-3 bread">A Discografia</h2>
                <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home <i
                                    class="ion-ios-arrow-forward"></i></a></span> <span>Discografia <i
                                class="ion-ios-arrow-forward"></i></span></p>
            </div>
        </div>
    </div>
</section>
<section id="album" class="ftco-section">
    <div class="container">
        <div class="row justify-content-center">
            <?php
            require_once 'connections/connection.php';

            if (isset($_GET['id'])) {
            $id = $_GET['id'];

            if ($_GET['id'] < 7 && $_GET['id'] > 0) {

            $query = "SELECT titulo, description_long , capa_album, ano, nome, description_short FROM albuns 
                              INNER JOIN banda ON banda_idbanda = idbanda 
                              WHERE idalbuns = ?";

            $link = new_db_connection();

            $stmt = mysqli_stmt_init($link);

            if (mysqli_stmt_prepare($stmt, $query)) { // Prepare the statement

                mysqli_stmt_bind_param($stmt, 'i', $id); // Bind results

                mysqli_stmt_execute($stmt); // Execute the prepared statement

                mysqli_stmt_bind_result($stmt, $title, $description, $image, $ano, $banda, $description_short); // Bind results

                while (mysqli_stmt_fetch($stmt)) { // Fetch values
                    echo '<div class="col-lg-10 order-md-last ftco-animate">
                <h2 class="mb-3 h1" style="font-family: Poppins">' . $title . '</h2>
                <p>' . $description_short . '</p>
                <h4 class="mb-3 mt-5 h1 text-center" style="font-family: Poppins">' . $banda . '</h4>
                <div class="text-center">
                    <img src="images/' . $image . '" alt="" class="img-fluid">
                </div>
                <div class="text-center"><br><p>' . $ano . '</p></div>
                
                <p>' . $description . '</p>
                <div class="tag-widget post-tag-container mb-5 mt-5">
                    <div class="tagcloud">
                        <a href="#" class="tag-cloud-link">' . $title . '</a>
                        <a href="#" class="tag-cloud-link">' . $banda . '</a>
                        <a href="#" class="tag-cloud-link">' . $ano . '</a>
                    </div>
                </div>
</div>';
                }
                $_SESSION['idalbum'] = $_GET['id'];
                mysqli_stmt_close($stmt); // Close statement
            } else {
                echo("Error description: " . mysqli_error($link));
            }
            mysqli_close($link); // Close connection

            ?>

        </div>
        <div class="row text-center">
            <div class="col-12">
                <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#albuminfo">
                    Créditos do Álbum
                </button>
            </div>
            <div id="albuminfo" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Créditos do Album</h4>
                            <button type="button" class="close text-right" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body text-left">
                            <div class="row">
                                <?php
                                $query = "SELECT nome, editora, songs_written, titulo FROM membros_banda_has_albuns 
          INNER JOIN membros_banda ON idmembros_banda = membros_banda_idmembros_banda 
          INNER JOIN albuns ON albuns_idalbuns = idalbuns WHERE idalbuns= ? ORDER BY nome";

                                $link = new_db_connection();

                                $stmt = mysqli_stmt_init($link);

                                if (mysqli_stmt_prepare($stmt, $query)) { // Prepare the statement

                                    mysqli_stmt_bind_param($stmt, 'i', $id); // Bind results

                                    mysqli_stmt_execute($stmt); // Execute the prepared statement

                                    mysqli_stmt_bind_result($stmt, $nome, $editora, $songs_written, $titulo); // Bind results

                                    while (mysqli_stmt_fetch($stmt)) { // Fetch values
                                        echo '<div class="col-6">';
                                        echo '<h2>' . $nome . '</h2>';
                                        echo '<h4>' . $titulo . '</h4>';

                                        echo '<p>Número de Músicas escritas para o álbum : <b>' . $songs_written . '</b></p>';
                                        echo '<small>Editora: ' . $editora . '</small><br><br>';
                                        echo '</div>';
                                    }
                                    mysqli_stmt_close($stmt); // Close statement
                                } else {
                                    echo("Error description: " . mysqli_error($link));
                                }
                                mysqli_close($link); // Close connection

                                ?>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal"></button>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <?php include_once 'components/cp_comentarios.php';
        } else {
            include_once "cp_404.php";
        }
        }



        ?>

    </div>
    </div>
</section>