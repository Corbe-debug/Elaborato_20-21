<?php
session_start();
?>


<!DOCTYPE html>
<html lang="it">

<head>
    <link rel="stylesheet" href="css/styleSignup.css" />
    <script src="js/script.js"></script>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <link rel="shortcut icon" type="image/jpg" href="img/logo.ico" />

    <title>OneClick Sharing - Registrati</title>
    <style>
        body {
            background-color: #579558;
            color: #fff;
        }
    </style>
</head>

<body>
    <div class="signup-form">
        <form action="validator/signup.inc.php" onsubmit="return controllaSignup()" method="post">
            <h2>Registrati</h2>
            <p>Compila ogni campo per registrarti!</p>
            <p>(Registrandoti otterrai 10 stelle omaggio per comprare subito vestiti)</p>
            <hr>
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <span class="fa fa-user"></span>
                        </span>
                    </div>
                    <input type="text" class="form-control" id="Nome" name="Nome" placeholder="Nome" required="required">
                </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <span class="fa fa-user"></span>
                        </span>
                    </div>
                    <input type="text" class="form-control" id="Cognome" name="Cognome" placeholder="Cognome" required="required">
                </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="fa fa-birthday-cake"></i>
                        </span>
                    </div>
                    <input type="date" class="form-control" id="DataNascita" name="DataNascita" placeholder="Selezionare la data" required="required">

                    <script>
                        //Imposta come massimo oggi
                        var today = new Date().toISOString().split('T')[0];
                        document.getElementsByName("DataNascita")[0].setAttribute('max', today);
                    </script>
                </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="fa fa-home"></i>
                        </span>
                    </div>
                    <input type="text" class="form-control" id="Indirizzo" name="Indirizzo" placeholder="Indirizzo" required="required">
                </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="fa fa-envelope"></i>
                        </span>
                    </div>
                    <input type="email" class="form-control" id="Email" name="Email" placeholder="Email" required="required">
                </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="fa fa-lock"></i>
                        </span>
                    </div>
                    <input type="password" class="form-control" id="PSW" name="PSW" placeholder="Password" required="required">
                </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="fa fa-lock"></i>
                            <i class="fa fa-check"></i>
                        </span>
                    </div>
                    <input type="password" class="form-control" id="ConfirmPSW" name="ConfirmPSW" placeholder="Conferma Password" required="required">
                </div>
            </div>
            <?php
            echo ('<p class="form-group">
                <button type="submit" name="signup" class="btn btn-primary btn-lg">Registrati</button>
                </p>');
            ?>
        </form>
        <p class="text-center">Hai già un account? <a href="index.php">Log in</a></p>
        <p class="text-center">Torna <a href="index.php">indietro</a></p>
    </div>

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
                echo "<script>alert('Password diverse')</script>";
                break;
            case 4:
                echo "<script>alert('Email già presa')</script>";
                break;
        }
    }
    ?>

</body>

</html>