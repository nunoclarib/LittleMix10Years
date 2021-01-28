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

<section class="ftco-section ftco-intro">
    <div class="container">
        <?php
        require_once 'connections/connection.php';

        $switch = 0;

        $link = new_db_connection(); // Create a new DB connection

        $stmt = mysqli_stmt_init($link); // create a prepared statement

        $query = "SELECT idmembros_banda, nome, apelido, imagem, description FROM membros_banda ORDER BY nome";

        if (mysqli_stmt_prepare($stmt, $query)) { // Prepare the statement

            mysqli_stmt_execute($stmt); // Execute the prepared statement

            mysqli_stmt_bind_result($stmt, $id, $nome, $apelido, $imagem, $description); // Bind results

            while (mysqli_stmt_fetch($stmt)) { // Fetch values

                if ($switch == 0) {
                    echo '<div class="row justify-content-end">
           <div class="col-md-8 py-md-5 pt-4 p-md-5">
                <h2> ' . $nome . ' <span> ' . $apelido . '</span>,</h2>
                <p>' . $description . '</p>
                <p><a href="artistas_info.php?id='.$id.'#artists" class="btn btn-primary">Mais sobre a ' . $nome . '</a></p>
            </div>
            
            <div class="col-md-4 d-flex">
                <a href="artistas_info.php?id='.$id.'#artists"><img src="images/'.$imagem.'" alt="" class="img-fluid"></a>
                
            </div>
          
        </div><br>';
                    $switch = 1;
                } elseif ($switch == 1) {
                    echo '<div class="row justify-content-end">
            <div class="col-md-4 d-flex">
                <!--<div class="img" style="background-image: url(images/' . $imagem . ');"></div>-->
                <a href="artistas_info.php?id='.$id.'#artists"><img src="images/'.$imagem.'" alt="" class="img-fluid"></a>
            </div>
            
            <div class="col-md-8 py-md-5 pt-4 p-md-5">
                <h2> ' . $nome . ' <span> ' . $apelido . '</span>,</h2>
                <p>' . $description . '</p>
                <p><a href="artistas_info.php?id='.$id.'#artists" class="btn btn-primary">Mais sobre a ' . $nome . '</a></p>
            </div>
           
        </div><br>';
                    $switch = 0;
                }

            }
            mysqli_stmt_close($stmt); // Close statement
        } else {
            echo("Error description: " . mysqli_error($link));
        }

        mysqli_close($link); // Close connection


        ?>
    </div>
</section>
<!--
<section class="services-section py-5 py-md-0">
    <div class="container">
        <div class="row no-gutters d-flex">
            <div class="col-md-6 col-lg-3 d-flex align-self-stretch ftco-animate">
                <div class="media block-6 services d-block">
                    <div class="icon"><span class="flaticon-layers"></span></div>
                    <div class="media-body">
                        <h3 class="heading mb-3">Web Design</h3>
                        <p>	203 Fake St. Mountain View, San Francisco, California, USA</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 d-flex align-self-stretch ftco-animate">
                <div class="media block-6 services active d-block">
                    <div class="icon"><span class="flaticon-web-programming"></span></div>
                    <div class="media-body">
                        <h3 class="heading mb-3">Web Development</h3>
                        <p>A small river named Duden flows by their place and supplies.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 d-flex align-self-stretch ftco-animate">
                <div class="media block-6 services d-block">
                    <div class="icon"><span class="flaticon-idea"></span></div>
                    <div class="media-body">
                        <h3 class="heading mb-3">Graphic Design</h3>
                        <p>A small river named Duden flows by their place and supplies.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 d-flex align-self-stretch ftco-animate">
                <div class="media block-6 services active-2 d-block">
                    <div class="icon"><span class="flaticon-contract"></span></div>
                    <div class="media-body">
                        <h3 class="heading mb-3">Writing</h3>
                        <p>A small river named Duden flows by their place and supplies.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="testimony-section">
    <div class="container">
        <div class="row ftco-animate justify-content-center">
            <div class="col-md-5 d-flex">
                <div class="testimony-img" style="background-image: url(images/bg_2.jpg);"></div>
            </div>
            <div class="col-md-7 py-5 pl-md-5">
                <div class="heading-section heading-section-white pt-4 ftco-animate">
                    <h2 class="mb-0">Customer Says</h2>
                </div>
                <div class="carousel-testimony owl-carousel ftco-owl">
                    <div class="item">
                        <div class="testimony-wrap pb-4">
                            <div class="text">
                                <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                            </div>
                            <div class="d-flex">
                                <div class="user-img" style="background-image: url(images/person_1.jpg)">
                                </div>
                                <div class="pos ml-3">
                                    <p class="name">Jeff Nucci</p>
                                    <span class="position">Businessman</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="testimony-wrap pb-4">
                            <div class="text">
                                <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                            </div>
                            <div class="d-flex">
                                <div class="user-img" style="background-image: url(images/person_1.jpg)">
                                </div>
                                <div class="pos ml-3">
                                    <p class="name">Jeff Nucci</p>
                                    <span class="position">Businessman</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="testimony-wrap pb-4">
                            <div class="text">
                                <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                            </div>
                            <div class="d-flex">
                                <div class="user-img" style="background-image: url(images/person_1.jpg)">
                                </div>
                                <div class="pos ml-3">
                                    <p class="name">Jeff Nucci</p>
                                    <span class="position">Businessman</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="testimony-wrap pb-4">
                            <div class="text">
                                <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                            </div>
                            <div class="d-flex">
                                <div class="user-img" style="background-image: url(images/person_1.jpg)">
                                </div>
                                <div class="pos ml-3">
                                    <p class="name">Jeff Nucci</p>
                                    <span class="position">Businessman</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="testimony-wrap pb-4">
                            <div class="text">
                                <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                            </div>
                            <div class="d-flex">
                                <div class="user-img" style="background-image: url(images/person_1.jpg)">
                                </div>
                                <div class="pos ml-3">
                                    <p class="name">Jeff Nucci</p>
                                    <span class="position">Businessman</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section ftco-intro bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 text-center">
                <h2 class="mb-0 font-primary">We've done work of <span class="number" data-number="300">0</span> Portfolio</h2>
            </div>
        </div>
    </div>
</section>