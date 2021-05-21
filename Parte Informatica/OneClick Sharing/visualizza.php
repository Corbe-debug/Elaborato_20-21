<?php
session_start();
include 'validator/eseguiQuery.php'
?>

<!DOCTYPE HTML>
<html lang="it">

<head>
    <link rel="stylesheet" href="css/styleVisualizza.css" />
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

    <title>OneClick Sharing - Visualizza</title>

    <style type="text/css">
        h2 {
            font-family: "Raleway", sans-serif;
            color: #000;
            font-size: 26px;
            font-weight: 300;
            text-align: center;
            text-transform: uppercase;
            position: relative;
            margin: 30px 0 80px;
        }

        h2::after {
            content: "";
            width: 100px;
            position: absolute;
            margin: 0 auto;
            height: 4px;
            background: rgba(0, 0, 0, 0.2);
            left: 0;
            right: 0;
            bottom: -20px;
        }

        .carousel {
            margin: 50px auto;
            padding: 0 70px;
        }

        .carousel .item {
            min-height: 330px;
            text-align: center;
            overflow: hidden;
        }

        .carousel .item .img-box {
            height: 160px;
            width: 100%;
            position: relative;
        }

        .carousel .item img {
            max-width: 100%;
            max-height: 100%;
            display: inline-block;
            position: absolute;
            bottom: 0;
            margin: 0 auto;
            left: 0;
            right: 0;
        }

        .carousel .item h4 {
            font-size: 18px;
            margin: 10px 0;
        }

        .carousel .item .btn {
            color: #333;
            border-radius: 0;
            font-size: 11px;
            text-transform: uppercase;
            font-weight: bold;
            background: none;
            border: 1px solid #ccc;
            padding: 5px 10px;
            margin-top: 5px;
            line-height: 16px;
        }

        .carousel .item .btn:hover,
        .carousel .item .btn:focus {
            color: #fff;
            background: #000;
            border-color: #000;
            box-shadow: none;
        }

        .carousel .item .btn i {
            font-size: 14px;
            font-weight: bold;
            margin-left: 5px;
        }

        .carousel .thumb-wrapper {
            text-align: center;
        }

        .carousel .thumb-content {
            padding: 15px;
        }

        .carousel .carousel-control {
            height: 100px;
            width: 40px;
            background: none;
            margin: auto 0;
            background: rgba(0, 0, 0, 0.2);
        }

        .carousel .carousel-control i {
            font-size: 30px;
            position: absolute;
            top: 50%;
            display: inline-block;
            margin: -16px 0 0 0;
            z-index: 5;
            left: 0;
            right: 0;
            color: rgba(0, 0, 0, 0.8);
            text-shadow: none;
            font-weight: bold;
        }

        .carousel .item-price {
            font-size: 13px;
            padding: 2px 0;
        }

        .carousel .item-price strike {
            color: #999;
            margin-right: 5px;
        }

        .carousel .item-price span {
            color: #86bd57;
            font-size: 110%;
        }

        .carousel .carousel-control.left i {
            margin-left: -3px;
        }

        .carousel .carousel-control.left i {
            margin-right: -3px;
        }

        .carousel .carousel-indicators {
            bottom: -50px;
        }

        .carousel-indicators li,
        .carousel-indicators li.active {
            width: 10px;
            height: 10px;
            margin: 4px;
            border-radius: 50%;
            border-color: transparent;
        }

        .carousel-indicators li {
            background: rgba(0, 0, 0, 0.2);
        }

        .carousel-indicators li.active {
            background: rgba(0, 0, 0, 0.6);
        }

        .star-rating li {
            padding: 0;
        }

        .star-rating i {
            font-size: 14px;
            color: #ffc000;
        }
    </style>
</head>

<body onload="showSlides()" style="background-color:#dfebdf">
    <!----------Header con link per login e signup------>
    <header>
        <nav class="nav"> <a class="logo" href="index.php"> <img src="img/logo_small.png" alt="logo"> </a>
            <ul>
                <li><a href="funzionamento.php">Come funziona?</a></li>
                <?php
                if (isset($_SESSION["loginA"])) {
                    echo ('<li><a href="visualizzaLog.php">Log utenti</a></li>');
                } else if (isset($_SESSION["loginC"])) {
                    echo ('<li><a href="donazione.php">Dona un vestito</a></li>');
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

    <?php

    if (isset($_SESSION['Email'])) {
        //Otengo l'id del cliente con una specifica email
        $sql = "SELECT * FROM Cliente WHERE Email = '$_SESSION[Email]'";

        //Connessione
        $result = querySelect($sql);

        $temp = $result->num_rows;
        while ($row = $result->fetch_assoc()) {
            $idC = $row["idC"];
        }

        //Query per verificare quanti vestiti sono presenti sul sito
        $sql = "SELECT * FROM Vestito WHERE Disponibile = 1 AND idC1 != $idC";
    } else {
        $sql = "SELECT * FROM Vestito WHERE Disponibile = 1";
    }

    //Connessione
    $result = querySelect($sql);
    $temp = $result->num_rows;

    if ($temp > 0) {

        //Calcolo quante stelle il cliente ha ancora da spendere solo se l'utente ha effettuato il login
        $credito = null;
        if (isset($_SESSION["loginC"])) {
            $s = "SELECT Stelle FROM Cliente WHERE Email = '$_SESSION[Email]'";

            //Connessione
            $r = querySelect($s);
            $k = $r->num_rows;

            if ($k > 0) {
                $ro = $r->fetch_assoc();
                $credito = $ro["Stelle"];
            }
        }

    ?>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Visualizza i vestiti disponibili</h2>
                    <?php
                    if (!isset($credito)) {
                        echo ('<center><h3 style="color:red;">Attenzione!, per acquistare qualche vestito, effettua il login o registrati</h3></center>');
                    } else if ($credito == 0) {
                        echo ('<center><h3 style="color:red;">Attenzione!, il tuo credito è di: 0 <i class="fa fa-star" aria-hidden="true"></i>, dona qualche vestito per poter acquistare.</h3></center>');
                    } else {
                        $c = intval($credito);
                        echo ("<center><h3>Credito rimasto: $c  <i class='fa fa-star' aria-hidden='true'></i></h3></center>");
                    }

                    echo (' <div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="0">');


                    //////////////////////////////////////////PARTE VISUALIZZAZIONE IMMAGINI////////////////////////////////////////

                    //Apertura del tag per la visualizzazione delle immagini (il numero di vestiti è maggiore di 0)
                    echo ('<div class="carousel-inner">');

                    //Apertura del tag pagina
                    echo ('<div class="item carousel-item active">
                                <div class="row">');

                    //In base al numero di vestiti creo n immagini da visualizzare
                    while ($row = $result->fetch_assoc()) {
                        //Ottengo il path dell'immagine da visualizzare
                        $img = "img/imgVestiti/" . $row["PathImmagine"];
                        //Ottengo il tipo di vestito
                        $tipo = $row["Tipo"];
                        //Ottengo la valutazione del vestito (castandola in int)
                        $valutazione = intval($row["Valutazione"]);
                        //Ottengo l'id dell'immagine
                        $id = $row["idV"];


                        //Visualizzazione di un'immagine con i vari valori
                        echo ("<div class='col-sm-3'>
                                        <div class='thumb-wrapper'>
                                            <div class='img-box'>");
                        if (($credito - $valutazione) < 0) {
                            //Credito insufficiente
                            echo ("<img src='$img' class='img-responsive img-fluidì alt='Non è stata trovata nessuna immagine'>");
                        } else {
                            //Credito ok
                            echo (" <a href='acquista.php?id=$id'><img src='$img' class='img-responsive img-fluidì alt='Non è stata trovata nessuna immagine'></>");
                        }
                        echo ("</div>
                                        <div class='thumb-content'>
                                            <h4>$tipo</h4>
                                            <div class='star-rating'>
                                                <ul class='list-inline'>");

                        //Controllo per la valutazione
                        if ($valutazione == 5) {
                            //Valutazione = 5 (5 stelle piene visualizzate)
                            for ($i = 0; $i < 5; $i++) {
                                echo ("<li class='list-inline-item'><i class='fa fa-star'></i></li>");
                            }
                        } else {
                            //Se la valutazione è minore di 5, vedrò n stelle piene e 5-n stelle vuote
                            $diff = 5 - $valutazione;
                            for ($k = 0; $k < $valutazione; $k++) {
                                echo ("<li class='list-inline-item'><i class='fa fa-star'></i></li>");
                            }
                            for ($z = 0; $z < $diff; $z++) {
                                echo ("<li class='list-inline-item'><i class='fa fa-star-o'></i></li>");
                            }
                        }

                        //Visualizzazione pulsante acquista sotto il vestito (solo se l'utente è loggato)
                        if (isset($_SESSION["loginC"])) {
                            if (($credito - $valutazione) < 0) {
                                //Il cliente non ha abbastanza stelle
                                echo ("</ul>
                                </div>
                                    <p style='color: red;'>Stelle insufficienti</p>
                                </div>
                                </div>
                                </div>");
                            } else {
                                //Tutto ok
                                echo ("</ul>
                                        </div>
                                            <a href='acquista.php?id=$id' class='btn btn-primary'>Acquista</a>
                                        </div>
                                        </div>
                                        </div>");
                            }
                        } else {
                            //Il cliente non è loggato
                            echo ("</ul>
                            </div>
                                <p>Accedi per acquistare</p>
                            </div>
                            </div>
                            </div>");
                        }
                    }
                    echo ("</div>");
                    echo ("</div>");

                    //Chiusura tag  pagina
                    echo ("</div>");
                    ?>
                </div>
            </div>
        </div>
        </div>
    <?php
    } else {
        //Nessun vestito disponibile nel database, output messaggio
        echo ("<center><h3>Nessun vestito disponibile, torna più tardi!</h3></center>");
    }
    ?>
</body>
</html>