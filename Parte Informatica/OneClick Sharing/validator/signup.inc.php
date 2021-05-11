<?php
session_start();

//Verifico il submit dal signup
if (isset($_POST['login-signup'])) {
    include 'connection.php';

    //Prendo i vari valori e li controllo
    $nome = $_POST["Nome"];
    $cognome = $_POST["Cognome"];
    $dataNascita = $_POST["DataNascita"];
    $indirizzo = $_POST["Indirizzo"];
    $email = $_POST["Email"];
    $psw = $_POST["PSW"];
    $confirmPsw = $_POST["ConfirmPSW"];

    if (($nome == "") || ($nome == "")) {
        //Campi incompleti
        header("Location: ../signup.php?error=1");
    } else if (($cognome == "") || ($cognome == "")) {
        //Campi incompleti
        header("Location: ../signup.php?error=1");
    } else if (($dataNascita == "") || ($dataNascita == "")) {
        //Campi incompleti
        header("Location: ../signup.php?error=1");
    } else if (($indirizzo == "") || ($indirizzo == "")) {
        //Campi incompleti
        header("Location: ../signup.php?error=1");
    }else if (($email == "") || ($email == "")) {
        //Campi incompleti
        header("Location: ../signup.php?error=1");
    }else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        //Email non valida
        header("Location: ../signup.php?error=2");
    }else if (($psw == "") || ($psw == "")) {
        //Campi incompleti
        header("Location: ../signup.php?error=1");
    }else if (($confirmPsw == "") || ($confirmPsw == "")) {
        //Campi incompleti
        header("Location: ../signup.php?error=1");
    } else if($psw != $confirmPsw){
        //Password diverse
        header("Location: ../signup.php?error=3");
    }
}
