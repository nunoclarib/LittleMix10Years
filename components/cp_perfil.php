<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('images/artistas2.jpg');"
         data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-end">
            <div class="col-md-9 ftco-animate pb-5">
                <h2 class="mb-3 bread">Perfil</h2>
                <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home <i
                                    class="ion-ios-arrow-forward"></i></a></span> <span>Perfil <i
                                class="ion-ios-arrow-forward"></i></span></p>
            </div>
        </div>
    </div>
</section>

<section id='perfil' class="ftco-section ftco-portfolio backperfil">
    <div class="container">
        <div class="row ">
            <?php
            require_once 'connections/connection.php';

            if (isset($_SESSION["id"])) {

                $id = $_SESSION["id"];

                $link = new_db_connection();

                $stmt = mysqli_stmt_init($link);

                $query = "SELECT nome, apelido, email FROM utilizadores WHERE idutilizadores = ?";

                if (mysqli_stmt_prepare($stmt, $query)) {

                    mysqli_stmt_bind_param($stmt, 'i', $id);

                    if (mysqli_stmt_execute($stmt)) {

                        mysqli_stmt_bind_result($stmt, $nome, $apelido, $email);

                        if (mysqli_stmt_fetch($stmt)) {
                            echo '<div class="col-sm-12 text-center">
                <div class="team-member">
                    <a href="#"><img class="mx-auto rounded-circle" src="images/avatar.png"></a><br><br>
                    <h1 class="text-white" style="font-family: Poppins">' . $nome . ' ' . $apelido . '</h1>
                    <h3 class="text-white" style="font-family: Poppins">@' . $_SESSION["username"] . '</h3>
                    <h4 class="text-white" style="font-family: Poppins">Email: ' . $email . '</h4>
                    <br>
                    <a href="verifypass.php#perfil"><button class="btn btn-primary">Editar Perfil</button></a>
                    <br><br>
                    <h4 class="text-white" style="font-family: Poppins">Descrição</h4>
                    <p class="text-white" style="font-family: Poppins">Hey, sou eu!</p>
                    <br>
                  
                </div>
            </div>';


                        } else {
                            echo "Error:" . mysqli_stmt_error($stmt);
                        }
                        mysqli_stmt_close($stmt);
                        mysqli_close($link);
                    } else {
                        echo "Error:" . mysqli_stmt_error($stmt);
                    }
                } else {
                    echo "Error:" . mysqli_error($link);
                    mysqli_close($link);
                }
            } else {
                header("Location: ../login.php#login");
            }
            ?>
        </div>
    </div>
</section>