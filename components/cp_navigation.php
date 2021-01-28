<?php
session_start();

$autentication = false;

if (isset($_SESSION['username'])) {
    $autentication = true;
}
?>


<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
        <a class="navbar-brand" href="index.php">10 Years of Little Mix</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
                aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a href="index.php" class="nav-link">
                        <div class="p-2">Home</div>
                    </a></li>
                <li class="nav-item"><a href="discografia.php" class="nav-link bg">
                        <div class="p-2">A Discografia</div>
                    </a></li>
                <li class="nav-item"><a href="artistas.php" class="nav-link">
                        <div class="p-2">As Artistas</div>
                    </a></li>
                <?php
                if ( isset($_SESSION['role']) ) {
                        if ($_SESSION['role'] == '2'){
                            echo'<li class="nav-item"><a class="nav-link" href="adm.php"><div class="p-2">Administração</div></a></li>';
                    }
                }
                if ($autentication == true) {

                    ?>
                    <li class="nav-item <?= ' dropdown ' ?> ">
                        <a href="login.php" class="nav-link pb-0 " <?= ' data-toggle="dropdown" ' ?> >
                                <div class="bglogin p-2 borderlogin text-dark <?= ' dropdown-toggle '?>"><?= $_SESSION['username'] ?></div>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="perfil.php#perfil">Perfil</a></li>
                            <li><a class="dropdown-item" href="scripts/sc_logout.php">Logout</a></li>
                        </ul>
                    </li>
                    <?php
                } else{
                    echo '<li class="nav-item"><a href="login.php#login" class="nav-link">
                                    <div class="bglogin p-2 borderlogin text-dark">Login</div>
                                </a>
                    </li>';
                }

                ?>
            </ul>

        </div>
    </div>
</nav>

