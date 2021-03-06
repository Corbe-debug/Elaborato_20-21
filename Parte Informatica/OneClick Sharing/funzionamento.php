<?php
session_start();
include 'validator/eseguiQuery.php';
?>

<!DOCTYPE HTML>
<html lang="it">

<head>
    <link rel="stylesheet" href="css/styleFunzionamento.css" />
    <script src="js/script.js"></script>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/jpg" href="img/logo_small_icon_only_inverted.png" />
    <title>OneClick Sharing</title>

</head>

<body style="background-color:#dfebdf">
    <!----------Header con link per login e signup------>
    <header>
        <nav class="nav"> <a class="logo" href="index.php"> <img src="img/logo_small.png" alt="logo"> </a>
            <ul>
                <li><a href="visualizza.php">Visualizza i vestiti</a></li>
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

    <center>
        <br>
        <h1>Benvenuto su OneClick Sharing</h1>
        <div id="text">
            <h3>La nostra azienda ha creato un modello di condivisione e scambio seguendo il principio della ???sharing economy???, promuovendo forme di consumo pi?? consapevoli basate sul riutilizzo.
                <br><br>
                Su questo sito ?? possibile visualizzare, comprare e donare vestiti usati.
                <br><br>
                La moneta di scambio utilizzata ?? la stella "???". Ogni vestito viene valutato dal venditore tramite delle stelle e ogni cliente potr?? acquistare un vestito
                tramite le stesse.
                <br><br>
                Un nuovo modo di acquistare e vendere, per un mondo sempre pi?? green.
            </h3>
        </div>
    </center>
</body>

</html>