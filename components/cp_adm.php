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
<section id='adm' class="ftco-section ftco-portfolio">
    <div class="container">
        <h1>Gerir Albuns</h1>
        <br>
        <div class="row">
            <?php
            require_once 'connections/connection.php';

                $link = new_db_connection(); // Create a new DB connection

                $stmt = mysqli_stmt_init($link); // create a prepared statement

                $query = "SELECT idalbuns, titulo, description_short , capa_album, ano, nome FROM albuns 
INNER JOIN banda ON banda_idbanda = idbanda 
ORDER BY ano DESC";

                if (mysqli_stmt_prepare($stmt, $query)) { // Prepare the statement

                    mysqli_stmt_execute($stmt); // Execute the prepared statement

                    mysqli_stmt_bind_result($stmt, $id, $title, $d_short, $cover, $ano, $banda); // Bind results

                    while (mysqli_stmt_fetch($stmt)) { // Fetch values
                        echo '
           <div class="col-md-4 portfolio-wrap ftco-animate">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <a href="admalbum.php?id=' . $id . '#adm"><div class="img js-fullheight" style="background-image: url(images/' . $cover . ');">
                        </div></a>
                    </div>
                    <div class="col-md-12">
                        <div class="text">
                            <div class="px-0 pt-5">
                                <div class="desc">
                                    <div class="top top-relative">
                                    <span class="subheading text-center">' . $banda . '</span>
                                        <span class="subheading text-center">' . $ano . '</span>
                                        <h2 class="mb-4"><a href="discografia_info.php?id=' . $id . '">' . $title . '</a></h2>
                                      
                                    </div>
                                    <div class="absolute relative">
                                        <p>' . $d_short . '</p>
                                        <div class="text-center"><a href="admalbum.php?id=' . $id . '#adm"><button class="btn btn-primary">Editar Album</button></a></div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
      ';
                    }
                    mysqli_stmt_close($stmt); // Close statement
                } else {
                    echo("Error description: " . mysqli_error($link));
                }

                mysqli_close($link); // Close connection


            ?>
        </div>
    </div>
</section>

