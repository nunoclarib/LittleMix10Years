<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('images/artistas.jpg');"
         data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-end">
            <div class="col-md-9 ftco-animate pb-5">
                <h2 class="mb-3 bread">The Girls</h2>
                <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home <i
                                    class="ion-ios-arrow-forward"></i></a></span> <span>As Artistas <i
                                class="ion-ios-arrow-forward"></i></span></p>
            </div>
        </div>
    </div>
</section>
<section id="artists" class="ftco-section">
    <div class="container">
        <div class="row justify-content-center">
            <?php
            require_once 'connections/connection.php';

            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                if ($_GET['id'] < 5 && $_GET['id'] > 0) {


                    $query = "SELECT nome, apelido, imagem, description, description_long, data_nas, cidade FROM membros_banda WHERE idmembros_banda = ?";

                    $link = new_db_connection();

                    $stmt = mysqli_stmt_init($link);

                    if (mysqli_stmt_prepare($stmt, $query)) { // Prepare the statement

                        mysqli_stmt_bind_param($stmt, 'i', $id); // Bind results

                        mysqli_stmt_execute($stmt); // Execute the prepared statement

                        mysqli_stmt_bind_result($stmt, $nome, $apelido, $imagem, $description, $des, $data, $cidade); // Bind results

                        while (mysqli_stmt_fetch($stmt)) { // Fetch values
                            echo '<div class="col-lg-10 order-md-last ftco-animate">
                <h2 class="mb-3 h1">' . $nome . ', ' . $apelido . '</h2>
                <p>' . $description . '</p>
                <div class="text-center">
                    <img src="images/' . $imagem . '" alt="" class="img-fluid">
                </div>
                <p></p>
                <h2 class="mb-3 mt-5 h1"></h2>
                <p>'.$des.'</p>
                <p><b>Data de Nascimento: </b>'.$data.'</p>
                <p><b>Cidade de Origem: </b>'.$cidade.'</p>
                
                <div class="tag-widget post-tag-container mb-5 mt-5">
                    <div class="tagcloud">
                        <a href="#" class="tag-cloud-link">'.$nome.'</a>
                        <a href="#" class="tag-cloud-link">'.$apelido.'</a>
                    </div>
                </div>
                </div>';
                        }
                        mysqli_stmt_close($stmt); // Close statement
                    } else {
                        echo("Error description: " . mysqli_error($link));
                    }
                    mysqli_close($link); // Close connection
                } else {
                    include_once "cp_404.php";
                }
            } else {
                include_once "cp_404.php";
            }

            ?>
        </div>
    </div>
</section>