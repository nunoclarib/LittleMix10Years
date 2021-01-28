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
<br>
<section id='perfil' class="ftco-section ftco-portfolio">
    <div class="container">
        <div class="row">
            <div class="text-center col-12">
                <?php
                if (isset($_GET["msg"])) {
                    $msg_show = true;
                    switch ($_GET["msg"]) {
                        case 0:
                            $message = "Password errada! Tente Novamente.";
                            $class = "alert-warning";
                            break;
                        case 1:
                            $message = "Campos da password por preencher";
                            $class = "alert-warning";
                            break;
                        default:
                            $msg_show = false;
                    }
                    ?>
                    <?php echo "<div class=\"alert $class alert-dismissible fade show\" role=\"alert\">
        " . $message . "
        <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
            <span aria-hidden=\"true\">&times;</span>
        </button>
</div>";
                    if ($msg_show) {
                        echo '<script>window.onload=function (){$(\'.alert\').alert();}</script>';
                    }
                } ?>

                <h1>Verificar password</h1>
                <form method="post" action="scripts/sc_verifypass.php" id="perfil">
                    <p>Porfavor, verifique no campo abaixo a sua password</p>
                    <input type="password" name="password_verify" placeholder="verfica password">
                    <input type="submit" value="Verificar">

                </form>
            </div>
            <br>
        </div>
    </div>
</section>
</body>
</html>