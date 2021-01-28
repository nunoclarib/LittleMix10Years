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
<section class="ftco-section ftco-portfolio" id="album">
    <div class="container">
        <div class="row">
            <?php
            require_once 'connections/connection.php';

            $link = new_db_connection(); // Create a new DB connection

            $stmt = mysqli_stmt_init($link); // create a prepared statement

            $query = "SELECT idalbuns, titulo, description_short , capa_album, ano, nome FROM albuns INNER JOIN banda ON banda_idbanda = idbanda ORDER BY ano DESC";

            if (mysqli_stmt_prepare($stmt, $query)) { // Prepare the statement

                mysqli_stmt_execute($stmt); // Execute the prepared statement

                mysqli_stmt_bind_result($stmt, $id,$title, $d_short, $cover, $ano, $banda); // Bind results

                while (mysqli_stmt_fetch($stmt)) { // Fetch values
                    echo '
           <div class="col-md-6 portfolio-wrap ftco-animate">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <a href="discografia_info.php?id='.$id.'#album"><div class="img js-fullheight" style="background-image: url(images/' . $cover . ');">

                        </div></a>
                    </div>
                    <div class="col-md-12">
                        <div class="text">
                            <div class="px-0 pt-5">
                                <div class="desc">
                                    <div class="top top-relative">
                                    <span class="subheading text-center">' . $banda . '</span>
                                        <span class="subheading text-center">' . $ano . '</span>
                                        <h2 class="mb-4"><a href="discografia_info.php?id='.$id.'">' . $title . '</a></h2>
                                      
                                    </div>
                                    <div class="absolute relative">
                                        <p>' . $d_short . '</p>
                                        <p><a href="discografia_info.php?id='.$id.'#album" class="custom-btn">Ver mais...</a></p>
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
