<?php
session_start();
?>

<!DOCTYPE HTML>
<html lang="it">

<head>
    <link rel="stylesheet" href="css/styleIndex.css" />
    <script src="js/script.js"></script>
    <meta charset="utf-8">
    
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/jpg" href="img/logo_small_icon_only_inverted.png" />

    <title>OneClick Sharing</title>
</head>

<body onload="showSlides()">

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


    <!----------Schermata di benevenuto------>
    <center>
        <br>

        <?php
        if (isset($_SESSION["loginA"])) {
            echo ("<h1 class='welcomeText'>Bentornato admin</h1>");
            echo ("<p class='welcomeText'>Visualizza i vestiti presenti oppure i log degli utenti</p>");
        } else if (isset($_SESSION["loginC"])) {
            echo ("<h1 class='welcomeText'>Benvenuto $_SESSION[Nome]</h1>");
            echo ("<p class='welcomeText'>Visualizza i vestiti presenti, compra oppure dona un vestito</p>");
        } else {
            echo ("<h1 class='welcomeText'>Benvenuto su OneClick Sharing</h1>");
            echo ("<p class='welcomeText'>Accedi oppure visualizza alcuni degli indumenti disponibili</p>");
        }
        ?>

        <!---Slider vestiti disponibili--->
        <br><br>
        <div class="slideshow-container">
            <div class="mySlides fade">
                <img src="img/logo_small_icon_only_inverted.png" class="imgSlider" width="512" height="512" alt="Immagine non disponibile">
                <br><br><br><br>
                <div class="text">Foto1</div>
            </div>
            <div class="mySlides fade">
                <img src="img/logo_small_icon_only_inverted.png" class="imgSlider" width="512" height="512" alt="Immagine non disponibile">
                <br><br><br><br>
                <div class="text">Foto2</div>
            </div>
        </div>

        <br>

        <div style="text-align:center">
            <span class="dot"></span>
            <span class="dot"></span>
        </div>
    </center>

    <?php
    if (isset($_GET['error'])) {
        switch ($_GET['error']) {
            case 1:
                echo "<script>alert('Campi incompleti')</script>";
                break;
            case 2:
                echo "<script>alert('Email non valida')</script>";
                break;
            case 3:
                echo "<script>alert('Password sbagliata')</script>";
                break;
            case 4:
                echo "<script>alert('Email non trovata')</script>";
                break;
        }
    }
    ?>
</body>
</html>