<?php
session_start();
?>

<!DOCTYPE HTML>
<html>

<head>
    <link rel="stylesheet" href="css/styleIndex.css" />
    <script src="js/script.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/jpg" href="img/logo_small_icon_only_inverted.png" />
    <title>OneClick Sharing</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Verdana, sans-serif;
        }

        .mySlides {
            display: none;
        }

        img {
            vertical-align: middle;
        }

        /* Slideshow container */
        .slideshow-container {
            max-width: 1000px;
            position: relative;
            margin: auto;
        }

        /* Caption text */
        .text {
            color: black;
            font-size: 15px;
            padding: 8px 12px;
            position: absolute;
            bottom: 8px;
            width: 100%;
            text-align: center;
        }

        /* The dots/bullets/indicators */
        .dot {
            height: 15px;
            width: 15px;
            margin: 0 2px;
            background-color: #bbb;
            border-radius: 50%;
            display: inline-block;
            transition: background-color 0.6s ease;
        }

        .active {
            background-color: #717171;
        }

        /* Fading animation */
        .fade {
            -webkit-animation-name: fade;
            -webkit-animation-duration: 1.5s;
            animation-name: fade;
            animation-duration: 1.5s;
        }

        @-webkit-keyframes fade {
            from {
                opacity: .4
            }

            to {
                opacity: 1
            }
        }

        @keyframes fade {
            from {
                opacity: .4
            }

            to {
                opacity: 1
            }
        }

        /* On smaller screens, decrease text size */
        @media only screen and (max-width: 300px) {
            .text {
                font-size: 11px
            }
        }
    </style>

</head>

<body onload="showSlides()" style="background-color:#deeade">
    <!----------Header con link per login e signup------>
    <header>
        <nav class="nav"> <a class="logo" href="#"> <img src="img/logo_small.png" alt="logo"> </a>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="#">About me</a></li>
                <li><a href="#">Contact</a></li>
                <?php

                if (isset($_SESSION["loginA"])) {
                    echo ('<li><a href="#">Log</a></li>');
                } ?>
            </ul>
            <div class="login">
                <form action="validator/login.inc.php" method="POST">
                    <input type="text" name="email" placeholder="Email">
                    <input type="password" name="psw" placeholder="Password">
                    <button type="submit" name="login-submit">Login</button>
                </form>
                <a href="signup.php">Registrati</a>
                <form action="validator/logout.inc.php" method="post">
                    <button type="submit" name="logout-submit">Logout</button>
                </form>
            </div>
        </nav>
    </header>


    <!----------Schermata di benevenuto con alcune foto dei vestiti presenti------>
    <center>
        <br>

        <?php
        if (isset($_SESSION["loginA"])) {
            echo ("<h1 class='welcomeText'>Bentornato admin</h1>");
            echo ("<h3 class='welcomeText'>Visualizza i vestiti presenti oppure i log degli utenti</h3>");
        } else if (isset($_SESSION["loginC"])) {
            echo ("<h1 class='welcomeText'>Benvenuto $_SESSION[Nome]</h1>");
            echo ("<h3 class='welcomeText'>Visualizza i vestiti presenti, compra oppure dona un vestito</h3>");
        } else {
            echo ("<h1 class='welcomeText'>Benvenuto su OneClick Sharing</h1>");
            echo ("<h3 class='welcomeText'>Accedi oppure visualizza alcuni degli indumenti disponibili</h3>");
        }
        ?>


        <!---Slider--->
        <br><br>
        <div class="slideshow-container">
            <div class="mySlides fade">
                <img src="img/logo.png" style="width:auto">
                <br><br><br><br>
                <div class="text">Foto1</div>
            </div>
            <div class="mySlides fade">
                <img src="img/logo_small_icon_only_inverted.png" style="width:auto">
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
    //Output errori
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
    } else if (isset($_GET['ok'])) {
        switch ($_GET['ok']) {
            case 1:
                //echo "<script>alert('')</script>";
                break;
        }
    }
    ?>
</body>

</html>