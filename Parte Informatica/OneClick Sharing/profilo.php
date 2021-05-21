<?php
session_start();
include 'validator/eseguiQuery.php';

//Controllo che sia settata la sessione admin o cliente loggato
if ((isset($_SESSION["loginA"])) || (isset($_SESSION["loginC"]))) {
    //Cliente o admin loggato, tutto ok

    //Verifico che l'id passato nell'url corrisponde a un cliente o meno
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $sql = "SELECT * FROM Cliente WHERE idC = $id";

        //Connessione
        $result = querySelect($sql);

        if ($result) {
            //Cliente presente
            $row = $result->fetch_assoc();

            //Recupero le varie informazioni di quel cliente
            $nome = $row["Nome"];
            $cognome = $row["Cognome"];
            $dataNascita = $row["DataNascita"];
            $indirizzo = $row["Indirizzo"];
            $stelle = $row["Stelle"];
            $email = $row["Email"];
        } else {
            //Cliente non disponibile
            //Ritorno all'index
            header("Location: index.php");
        }
    } else {
        //Ritorno all'index
        header("Location: index.php");
    }
} else {
    //Ritorno all'index
    header("Location: index.php");
}
?>

<!DOCTYPE HTML>
<html lang="it">

<head>
    <link rel="stylesheet" href="css/styleProfilo.css" />
    <script src="js/script.js"></script>
    <meta charset="utf-8">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/jpg" href="img/logo_small_icon_only_inverted.png" />

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

    <title>OneClick Sharing - Acquista</title>
</head>

<body onload="showSlides()" style="background-color:#dfebdf">
    <!----------Header con link per login e signup------>
    <header>
        <nav class="nav"> <a class="logo" href="index.php"> <img src="img/logo_small.png" alt="logo"> </a>
            <ul>
                <li><a href="funzionamento.php">Come funziona?</a></li>
                <li><a href="visualizza.php">Visualizza i vestiti</a></li>

                <?php
                if (isset($_SESSION["loginA"])) {
                    echo ('<li><a href="#">Log utenti</a></li>');
                } else if (isset($_SESSION["loginC"])) {
                    echo ('<li><a href="donazione.php">Dona un vestito</a></li>');
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

    <div class="container">
        <div class="main-body">
            <div class="row gutters-sm">
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center text-center">
                                <img src="img/imgUtente.png" alt="Admin" class="rounded-circle" width="150">
                                <div class="mt-3">
                                    <?php
                                    echo ("<h4>$cognome $nome</h4>");
                                    ?>
                                    <p class="text-secondary mb-1">Utente registrato</p>
                                    <?php
                                    echo ("<p class='text-muted font-size-sm'>$indirizzo</p>");
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Nome completo</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <?php
                                    echo ("$cognome $nome");
                                    ?>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Email</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <?php
                                    echo ("$email");
                                    ?>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Data di nascita</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <?php
                                    echo ("$dataNascita");
                                    ?>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Stelle disponibili</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <?php
                                    echo ("$stelle <i class='fa fa-star' aria-hidden='true'></i>");
                                    ?>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Indirizzo</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <?php
                                    echo ("$indirizzo");
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</body>