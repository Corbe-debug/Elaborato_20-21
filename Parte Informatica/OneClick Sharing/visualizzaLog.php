<?php
session_start();
include 'validator/visualizzaLog.inc.php';

//Controllo se l'admin è loggato
if (!isset($_SESSION["loginA"])) {
    //Ritorno all'index
    header("Location: index.php");
}

//Ottengo la tabella contenente i log
$header = "<tr> <th>Id Log</th><th>Descrizione</th><th>Data e ora</th> <th>Id Cliente</th></tr>";
$table = getLogTable();

//Stampo una stringa nel caso in cui non vi siano dei record da stampare
if ($table == "null") {
    $table = "<h3>Non ci sono log, ritorna più tardi.</h3>";
} else {
    $table = $header . $table;
}
?>

<!DOCTYPE html>
<html lang="it">
<html>

<head>
    <link rel="stylesheet" href="css/styleVisualizzaLog.css" />
    <script src="js/script.js"></script>
    <meta charset="utf-8">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/jpg" href="img/logo_small_icon_only_inverted.png" />

    <title>OneClick Sharing - Log</title>
</head>

<body style="background-color:#dfebdf">
    <!----------Header con link per login e signup------>
    <header>
        <nav class="nav"> <a class="logo" href="index.php"> <img src="img/logo_small.png" alt="logo"> </a>
            <ul>
                <li><a href="funzionamento.php">Come funziona?</a></li>
                <li><a href="visualizza.php">Visualizza i vestiti</a></li>

                <?php
                if (isset($_SESSION["loginA"])) {
                    echo ('<li><a href="visualizzaLog.php">Log utenti</a></li>');
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

    <center>
        <div id="container">
            <h2 class="welcomeText">Visualizza i log dei clienti</h2>
            <br>
            <hr class="linea">
            <br>
            <br>
            <div id="container2">
                <table id= "tStyle">
                    <?php
                    echo $table;
                    ?>
                </table>

            </div>

        </div>
        <button id="i_bback" name="n_bback" onclick="window.location.href='index.php'"> Indietro </button>
        <br>
        <br>
    </center>

</body>

</html>