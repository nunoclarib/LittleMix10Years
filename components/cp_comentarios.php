<div class="pt-5 mt-5" id="comentarios">
    <ul class="comment-list">
        <?php
        $idalbum = $_SESSION['idalbum'];

        $link = new_db_connection(); // Create a new DB connection

        $stmt = mysqli_stmt_init($link); // create a prepared statement

        $query = "SELECT idcomentarios, comentario, data, nome, titulo, username FROM comentarios
              INNER JOIN utilizadores ON utilizadores_idutilizadores = idutilizadores 
              INNER JOIN albuns ON albuns_idalbuns = idalbuns  WHERE idalbuns = ?"; // Define the query

        if (mysqli_stmt_prepare($stmt, $query)) { // Prepare the statement
            mysqli_stmt_bind_param($stmt, 'i', $idalbum); // Bind results
            mysqli_stmt_execute($stmt); // Execute the prepared statement

            mysqli_stmt_bind_result($stmt, $idcomentario, $comentario, $data, $autor, $album, $username); // Bind results

            while (mysqli_stmt_fetch($stmt)) { // Fetch values
                echo '<li class="comment">
            <div class="vcard bio">
                <img src="images/avatar.png" alt="Image placeholder">
            </div>
            <div class="comment-body">
                <h3 class="d-inline">' . $autor . ' </h3><small> @' . $username . '</small>
                <h3>Album: ' . $album . '</h3>
                <p>' . $comentario . '</p>
                <div class="meta">' . $data . '</div>
                <div class="text-right">
                <a href="scripts/sc_deletecomentario.php?idcom=' . $idcomentario . '&user=' . $username . '"><button class="btn btn-primary">x Apagar</button></a>
              </div>
            </div>
        </li>';
            }
            mysqli_stmt_close($stmt); // Close statement
        } else {
            echo("Error description: " . mysqli_error($link));

        }

        mysqli_close($link); // Close connection

        ?>
    </ul>
    <?php if (isset($_SESSION['username']) && isset($_SESSION['idalbum'])) { ?>
        <div class="row">
            <div class="comment-form-wrap pt-5 col-sm-12">
                <form action="scripts/sc_comentarios.php" method="post" class="p-5 bg-light">

                    <div class="form-group">
                        <h4 class="mb-5" style="font-family: Poppins">Comenta aqui as tuas opiniões sobre o álbum</h4>
                        <textarea name="comentario" id="message" cols="30" rows="5" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Post Comment" class="btn py-3 px-4 btn-primary">
                    </div>

                </form>
            </div>
        </div>

        <?php
    } else {
        echo '<div class="pt-5 mt-5 text-center"><h3 class="mb-5">Efetue o  login para comentar.</h3></div>';
    }
    ?>
</div>
