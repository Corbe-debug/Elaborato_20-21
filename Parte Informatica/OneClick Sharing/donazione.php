<?php
session_start();
include 'validator/eseguiQuery.php';

if (isset($_SESSION["loginC"])) {
?>

    <!DOCTYPE HTML>
    <html lang="it">

    <head>
        <link rel="stylesheet" href="css/styleDonazione.css" />
        <script src="js/script.js"></script>
        <meta charset="utf-8">

        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
        <link rel="shortcut icon" type="image/jpg" href="img/logo.ico" />

        <title>OneClick Sharing - Donazione</title>
    </head>

    <body style="background-color:#dfebdf">
        <!----------Header con link per login e signup------>
        <header>
            <nav class="nav"> <a class="logo" href="index.php"> <img src="img/logo_small.png" alt="logo"> </a>
                <ul>
                    <li><a href="funzionamento.php">Come funziona?</a></li>
                    <li><a href="visualizza.php">Visualizza i vestiti</a></li>

                    <?php
                    //Ottengo l'id del cliente tramite email
                    $sql = "SELECT * FROM Cliente WHERE Email = '$_SESSION[Email]'";

                    //Connessione
                    $result = querySelect($sql);
                    $temp = $result->num_rows;

                    if ($temp > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $idC = $row["idC"];
                            break;
                        }

                        echo ("<li><a href='profilo.php?id=$idC'>Profilo</a></li>");
                    }
                    ?>
                </ul>
                <div class="login">
                    <form action="validator/login.inc.php" method="POST">
                        <input type="text" name="email" placeholder="Email">
                        <input type="password" name="psw" placeholder="Password">
                        <button type="submit" name="login-submit">Login</button>
                    </form>
                    <form action="signup.php">
                        <input id="btnRegistrati" type="submit" value="Registrati" />
                    </form>
                    <form action="validator/logout.inc.php" method="post">
                        <button type="submit" name="logout-submit">Logout</button>
                    </form>
                </div>
            </nav>
        </header>

        <div class="donazione-form">
            <form action="validator/donazione.inc.php" onsubmit="return ontrollaDonazione()" method="post" enctype="multipart/form-data">
                <h2>Dona un vestito</h2>
                <p>Compila ogni campo per donare!</p>
                <hr>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-tag" aria-hidden="true"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control" id="Tipo" name="Tipo" placeholder="Tipo di vestito" required="required">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-tag" aria-hidden="true"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control" id="Marca" name="Marca" placeholder="Marca" required="required">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-tag" aria-hidden="true"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control" id="Taglia" name="Taglia" placeholder="Taglia" required="required">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-tag" aria-hidden="true"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control" id="Colore" name="Colore" placeholder="Colore" required="required">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-file-text-o" aria-hidden="true"></i>
                            </span>
                        </div>
                        <textarea rows="4" cols="50" class="form-control" id="Descrizione" name="Descrizione" placeholder="Descrizione" required="required"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-star" aria-hidden="true"></i>
                            </span>
                        </div>
                        <input type="number" min="1" max="5" class="form-control" id="Valutazione" name="Valutazione" placeholder="Valutazione" required="required">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-picture-o" aria-hidden="true"></i>
                            </span>
                        </div>
                        <label>&nbsp;Carica un' immagine dell'indumento</label>
                        <input type="file" name="IMG" id="IMG" required="required">
                    </div>

                    <br>

                    <?php
                    echo ('<div class="form-group">
                        <button type="submit" name="donazione" class="btn btn-primary btn-lg">Dona</button>
                        </div>');

                    //Visualizzo errori
                    if (isset($_GET['error'])) {
                        switch ($_GET['error']) {
                            case 1:
                                echo "<script>alert('Campi incompleti')</script>";
                                break;
                            case 2:
                                echo "<script>alert('Non hai caricato un immagine')</script>";
                                break;
                            case 3:
                                echo "<script>alert('Errore nella donazione, riprova')</script>";
                                break;
                        }
                    }
                    ?>
            </form>
        </div>
    </body>

    </html>


<?php
} else {
    header("Location: index.php");
}
?>