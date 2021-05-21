<?php
session_start();

//Verifico il submit dal signup
if (isset($_POST['signup'])) {
    include 'eseguiQuery.php';

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
        $result = querySelect($sql);

        //Controllo il risultato della query
        if ($result->num_rows > 0) {
            //Email già presente
            header("Location: ../signup.php?error=4");
        } else {
            //Controllo che la stessa email non sia presente nemmeno nella tabella Admin
            //Query
            $sql = "SELECT * FROM Admin WHERE email= '$email'";

            //Connessione
            $result = querySelect($sql);

            //Controllo il risultato della query
            if ($result->num_rows > 0) {
                //Email già presente
                header("Location: ../signup.php?error=4");
            } else {
                //Email non presente ancora, inserisco il nuovo utente nei clienti (gli do 10 stelle di iscrizione omaggio)
                $tmpD = date("d/m/Y", strtotime($dataNascita));
                $tmpP = md5($psw);

                $sql = "INSERT INTO `cliente`(`Nome`, `Cognome`, `DataNascita`, `Indirizzo`, `Stelle`, `Email`, `PSW`) VALUES ('$nome','$cognome','$tmpD','$indirizzo','10','$email','$tmpP')";

                //Connessione
                $result = queryInsert($sql);

                if (!$result) {
                    //Errore nella query
                    header("Location: ../signup.php?error=5");
                } else {
                    $_SESSION["loginC"] = true;
                    $_SESSION["Nome"] = $nome;
                    $_SESSION['Email'] = $email;

                    if(isset($_SESSION['loginA'])){
                        unset($_SESSION['loginA']);
                    }

                    //Prendo l'id dell'utente registrato
                    $sql = "SELECT `idC` FROM `cliente` WHERE `Email` = '$email'";

                    //Connessione
                    $result = querySelect($sql);

                    //Controllo il risultato della query
                    if ($result->num_rows > 0) {
                        //Email presente
                        while ($row = $result->fetch_assoc()) {
                            $id = $row['idC'];
                        }
                    }

                    //Ottengo la data con l'ora
                    $dataOggi = date("d/m/Y H:i:s");
                    $descizione = "Un utente si è registrato";

                    //Inserisco il nuovo record nella tabella Log
                    $sql = "INSERT INTO `log`(`Descrizione`, `DataOra`, `idC1`) VALUES ('$descizione','$dataOggi','$id')";
                    $result = queryInsert($sql);

                    header("Location: ../index.php");
                }
            }
        }
    }
} else {
    header("Location: ../signup.php");
}
