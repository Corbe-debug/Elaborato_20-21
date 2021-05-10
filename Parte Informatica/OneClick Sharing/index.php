<?php
session_start();
?>

<!DOCTYPE HTML>
<html>

<head>
    <link rel="stylesheet" href="css/style.css" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>OneClick Sharing</title>
    <link rel="shortcut icon" type="image/jpg" href="img/logo.ico" />
</head>

<body>
    <!----------Header con link per login e signup------>
    <header>
        <nav class="nav"> <a class="logo" href="#"> <img src="img/logo.png" alt="logo"> </a>
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
                <form action="includes/logout.inc.php" method="post">
                    <button type="submit" name="logout-submit">Logout</button>
                </form>
            </div>
        </nav>
    </header>


    <!----------Schermata di benevenuto con foto vestiti presenti------>
    <center>
        <h2 class="welcomeText">Benvenuto su OneClick Sharing</h2>
        <h3 class="welcomeText">Accedi o visualizza alcuni degli indumenti disponibili</h3>

        <!-- Gallery -->
        <div class="row">
            <div class="col-lg-4 col-md-12 mb-4 mb-lg-0">
                ciao
                <img src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(73).jpg" class="w-100 shadow-1-strong rounded mb-4" alt="CIAAAAAAAAAAA" />

                <img src="https://mdbootstrap.com/img/Photos/Vertical/mountain1.jpg" class="w-100 shadow-1-strong rounded mb-4" alt="" />
            </div>

            <div class="col-lg-4 mb-4 mb-lg-0">
                <img src="https://mdbootstrap.com/img/Photos/Vertical/mountain2.jpg" class="w-100 shadow-1-strong rounded mb-4" alt="" />

                <img src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(73).jpg" class="w-100 shadow-1-strong rounded mb-4" alt="" />
            </div>

            <div class="col-lg-4 mb-4 mb-lg-0">
                <img src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(18).jpg" class="w-100 shadow-1-strong rounded mb-4" alt="" />

                <img src="https://mdbootstrap.com/img/Photos/Vertical/mountain3.jpg" class="w-100 shadow-1-strong rounded mb-4" alt="" />
            </div>
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
                echo "<script>alert('Loggato corettamente')</script>";
                break;
        }
    }

    if (isset($_SESSION["loginA"])) {
    }
    ?>
</body>

</html>