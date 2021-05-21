<?php
session_start();
include 'validator/eseguiQuery.php';
?>

<!DOCTYPE HTML>
<html lang="it">

<head>
    <link rel="stylesheet" href="css/styleAcquista.css" />
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

    <!--Dettagli prodotto selezionato!-->
    <?php
    //Prima di tutto verifico se è presente la sessione login (se l'utente ha effettuato il login al sito)
    if (isset($_SESSION["loginC"])) {
        //Ok, verifico che nell'indirizzo sia presente un id di un vestito disponibile (che può essere acquistato dall'utente)
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            //Prendo tutti gli id dei vestiti disponibili presenti sul Database e vedo se almeno uno è uguale a quello presente nel get
            $sql = "SELECT idV FROM Vestito WHERE Disponibile = '1'";

            //Connessione
            $result = querySelect($sql);
            $temp = $result->num_rows;

            $controllo = false;

            if ($temp > 0) {
                while ($row = $result->fetch_assoc()) {
                    if ($row["idV"] == $id) {
                        $controllo = true;
                        break;
                    }
                }
                if ($controllo) {
                    //Id trovato, visualizzo i vari dati
                    $sql = "SELECT * FROM Vestito WHERE idV = $id AND idC1 != $idC";

                    //Connessione
                    $result = querySelect($sql);
                    $temp = $result->num_rows;

                    if ($temp > 0) {
                        //Recupero le varie informazioni di quel vestito
                        $row = $result->fetch_assoc();
                        $tipo = $row["Tipo"];
                        $marca = $row["Marca"];
                        $taglia = $row["Taglia"];
                        $colore = $row["Colore"];
                        $descrizione = $row["Descrizione"];
                        $valutazione = $row["Valutazione"];
                        $img = "img/imgVestiti/" . $row["PathImmagine"];
                        $_SESSION["idVestito"] = $id;

    ?>
                        <form action="validator/acquista.inc.php" method="POST">
                            <div class="container">
                                <br>
                                <hr>
                                <div class="card">
                                    <div class="row">
                                        <aside class="col-sm-5 border-right">
                                            <article class="gallery-wrap">
                                                <div class="img-small-wrap">
                                                    <?php
                                                    echo ("<div class='item-gallery'> <img src=$img> </div>");
                                                    ?>
                                                </div>
                                            </article>
                                        </aside>
                                        <aside class="col-sm-7">
                                            <article class="card-body p-5">
                                                <?php
                                                echo ("<h3 class='title mb-3'>$tipo</h3>");
                                                ?>
                                                <p class="price-detail-wrap">
                                                    <span class="price h3 text-warning">
                                                        <?php
                                                        echo ("<span class='num'>$valutazione</span>&nbsp;&nbsp;<i class='fa fa-star' aria-hidden='true'></i>");
                                                        ?>
                                                    </span>
                                                </p> <!-- price-detail-wrap .// -->
                                                <dl class="item-property">
                                                    <dt>Descrizione</dt>
                                                    <dd>
                                                        <?php
                                                        echo ("<p>$descrizione</p>     
                                                </dd>
                                            </dl>
                                            <dl class='param param-feature'>
                                                <dt>Marca</dt>
                                                <dd>$marca</dd>
                                            </dl> <!-- item-property-hor .// -->
                                            <dl class='param param-feature'>
                                                <dt>Colore</dt>
                                                <dd>$colore</dd>
                                            </dl> <!-- item-property-hor .// -->
                                            <dl class='param param-feature'>
                                                <dt>Taglia</dt>
                                                <dd>$taglia</dd>
                                            </dl> <!-- item-property-hor .// -->");
                                                        ?>
                                                        <button type="submit" name="acquista-submit" style="background-color:#579558;" class=" btn btn-lg btn-primary text-uppercase">Compra ora</button>
                                            </article> <!-- card-body.// -->
                                        </aside> <!-- col.// -->
                                    </div> <!-- row.// -->
                                </div> <!-- card.// -->
                            </div>
                            <!--container.//-->
                        </form>
    <?php
                    } else {
                        //Ritorno a visualizza.php
                        header("Location: visualizza.php");
                    }
                } else {
                    //Id non trovato
                    //Ritorno a visualizza.php
                    header("Location: visualizza.php");
                }
            } else {
                //Ritorno a visualizza.php
                header("Location: visualizza.php");
            }
        } else {
            //Ritorno a visualizza.php
            header("Location: visualizza.php");
        }
    } else {
        //Ritorno a visualizza.php
        header("Location: visualizza.php");
    }
    ?>
</body>

</html>