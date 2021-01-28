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
<section id='perfil' class="ftco-section ftco-portfolio ">
    <div class="container">
        <div class="row">
            <br>
            <div class="text-center col-12">
                <?php if (isset($_GET["msg"])) {
                    $msg_show = true;
                    switch ($_GET["msg"]) {
                        case 0:
                            $message = "Username já existe!";
                            $class = "alert-warning";
                            break;
                        case 1:
                            $message = "Campo por preencher!";
                            $class = "alert-warning";
                            break;
                        default:
                            $msg_show = false;
                    }
                    echo "<div class=\"alert $class alert-dismissible fade show\" role=\"alert\">
        " . $message . "
        <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
            <span aria-hidden=\"true\">&times;</span>
        </button>
</div>";
                    if ($msg_show) {
                        echo '<script>window.onload=function (){$(\'.alert\').alert();}</script>';
                    }
                } ?>

                <h1>Editar Username</h1>
                <form method="post" action="scripts/sc_updateperfil.php" id="perfil" >
                    <p>Edite o seu username abaixo.</p>
                    <input type="text" name="edit_username" class="form-control" value="<?= $_SESSION['username'] ?>">
                   <br><button class="btn btn-primary" type="submit" value="Editar">Alterar Username</button>
                </form>
                <br>
                <p>Apague a sua conta:</p>
                <a href="scripts/sc_deleteaccount.php"><button class="btn btn-danger">Apagar Conta</button></a>
                <br>
            </div>
        </div>
    </div>
</section>
</body>
</html>