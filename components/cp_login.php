<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('images/loginimg.jpg');"
         data-stellar-background-ratio="0.5">
    <div class="overlay">
    </div>
    <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-end">
            <div class="col-md-9 ftco-animate pb-5">
                <h2 class="mb-3 bread">Login</h2>
                <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home <i
                                    class="ion-ios-arrow-forward"></i></a></span> <span>Login e Registo <i
                                class="ion-ios-arrow-forward"></i></span></p>
            </div>
        </div>
    </div>
</section>
<section id="login">
    <div class="container py-3">
        <?php
        if (isset($_GET["msg"])) {
            $msg_show = true;
            switch ($_GET["msg"]) {
                case 0:
                    $message = "Ocorreu um erro no registo, tente um novo username ou email.";
                    $class = "alert-warning";
                    $login = true;
                    break;
                case 1:
                    $message = "Registo efectuado com sucesso!";
                    $class = "alert-success";
                    $login = true;
                    break;
                case 2:
                    $message = "Ocorreu um erro no login, a palavra passe ou o username estão errados.";
                    $class = "alert-warning";
                    $login = false;
                    break;
                case 3:
                    $message = "login efectuado com sucesso";
                    $class = "alert-success";
                    $login = false;
                    break;
                default:
                    $msg_show = false;
            }
        }




        ?>
        <div class="row">
            <div class="col-lg-6 col-12 pb-3">
                <div class="card-body">
                    <div class="login-form">
                        <form id="loginform" action="scripts/sc_login.php" method="post" class="form-horizontal"
                              style="border: 1px solid lightgrey">
                            <div class="col-xs-8 col-xs-offset-4 text-center">
                                <h2 style="font-family: 'Poppins', Arial, sans-serif">Login</h2>
                            </div>

                            <div class="form-group">
                                <?php
                                if (isset($_GET["msg"]) && $login == false) {
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
                                <label class="control-label col-xs-4">Username</label>
                                <div class="col-xs-8">
                                    <input type="text" class="form-control" name="username" required="required">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-4">Password</label>
                                <div class="col-xs-8">
                                    <input type="password" class="form-control" name="password" required="required">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-xs-8 col-xs-offset-4">
                                    <br>
                                    <div class="text-center">Esqueceu-se da palavra passe? <a href="#">Clica aqui</a>
                                    </div>
                                    <br>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary btn-lg">Entrar</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-12 pb-3">

                <div class="card-body">
                    <div class="signup-form">
                        <form id="registerform" action="scripts/sc_register.php" method="post"
                              class="form-horizontal" style="border: 1px solid lightgrey">
                            <div class="col-xs-8 col-xs-offset-4 text-center">
                                <h2 style="font-family: 'Poppins', Arial, sans-serif">Registo</h2>
                            </div>

                            <div class="form-group">
                                <?php
                                if (isset($_GET["msg"])&& $login == true) {
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
                                <label class="control-label col-xs-4">Nome</label>
                                <div class="col-xs-8">
                                    <input type="text" class="form-control" name="name" required="required">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-xs-4">Apelido</label>
                                <div class="col-xs-8">
                                    <input type="text" class="form-control" name="surname" required="required">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-xs-4">Username</label>
                                <div class="col-xs-8">
                                    <input type="text" class="form-control" name="username" required="required">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-4">Email</label>
                                <div class="col-xs-8">
                                    <input type="email" class="form-control" name="email" required="required"
                                           onchange="email_validate(this.value);">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-4">Password</label>
                                <div class="col-xs-8">
                                    <input id="password" type="password" class="form-control" name="password"
                                           required="required" onkeyup="checkPass(); return false;">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-4">Confirmar Password</label>
                                <div class="col-xs-8">
                                    <input id="password_confirm" type="password" class="form-control"
                                           name="password_confirm"
                                           required="required" onkeyup="checkPass(); return false;">
                                    <span id="confirmMessage" class="confirmMessage"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-8 col-xs-offset-4">
                                    <p><label class="checkbox-inline"><input type="checkbox" required="required"> I
                                            accept the <a href="#">Terms of Use</a> &amp; <a href="#">Privacy
                                                Policy</a>.</label></p>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary btn-lg">Registar</button>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
        <hr>
    </div>
</section>