<?php
session_start();

//Verifico il submit dal signup
if (isset($_POST['signup'])) {
    include 'connection.php';

    //Prendo i vari valori e li controllo
    $nome = $_POST["Nome"];
    $cognome = $_POST["Cognome"];
    $dataNascita = $_POST["DataNascita"];
    $indirizzo = $_POST["Indirizzo"];
    $email = $_POST["Email"];
    $psw = $_POST["PSW"];
    $confirmPsw = $_POST["ConfirmPSW"];

    if (($nome == "") || ($nome == null)) {
        //Campi incompleti
        header("Location: ../signup.php?error=1");
    } else if (($cognome == "") || ($cognome == null)) {
        //Campi incompleti
        header("Location: ../signup.php?error=1");
    } else if (($dataNascita == "") || ($dataNascita == null)) {
        //Campi incompleti
        header("Location: ../signup.php?error=1");
    } else if (($indirizzo == "") || ($indirizzo == null)) {
        //Campi incompleti
        header("Location: ../signup.php?error=1");
    } else if (($email == "") || ($email == null)) {
        //Campi incompleti
        header("Location: ../signup.php?error=1");
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        //Email non valida
        header("Location: ../signup.php?error=2");
    } else if (($psw == "") || ($psw == null)) {
        //Campi incompleti
        header("Location: ../signup.php?error=1");
    } else if (($confirmPsw == "") || ($confirmPsw == null)) {
        //Campi incompleti
        header("Location: ../signup.php?error=1");
    } else if ($psw != $confirmPsw) {
        //Password diverse
        header("Location: ../signup.php?error=3");
    } else {

        //Tutto ok, controllo che l'email non sia già presente ne nella tabella Cliente ne Admin
        //Query
        $sql = "SELECT * FROM Cliente WHERE email= '$email'";

        //Connessione
        $conn = connect('db_oneclicksharing');
        $result = $conn->query($sql);

        //Controllo il risultato della query
        if ($result->num_rows > 0) {
            //Email già presente
            header("Location: ../signup.php?error=4");
        } else {
            //Controllo che la stessa email non sia presente nemmeno nella tabella Admin
            mysqli_close($conn);

            //Query
            $sql = "SELECT * FROM Admin WHERE email= '$email'";

            //Connessione
            $conn = connect('db_oneclicksharing');
            $result = $conn->query($sql);

            //Controllo il risultato della query
            if ($result->num_rows > 0) {
                //Email già presente
                header("Location: ../signup.php?error=4");
            } else {
                //Email non presente ancora, inserisco il nuovo utente nei clienti
                $tmpD = date("d/m/Y", strtotime($dataNascita));
                $tmpP = md5($psw);

                $sql = "INSERT INTO `cliente`(`Nome`, `Cognome`, `DataNascita`, `Indirizzo`, `Stelle`, `Email`, `PSW`) VALUES ('$nome','$cognome','$tmpD','$indirizzo','0','$email','$tmpP')";

                //Connessione
                $conn = connect('db_oneclicksharing');
                $result = $conn->query($sql);

                if (!$result) {
                    //Errore nella query
                    header("Location: ../signup.php?error=5");
                } else{
                    header("Location: ../signup.php");
                    $_SESSION['registrato'] = true;
                }
            }
        }
    }
} else{
    header("Location: ../signup.php");
}
