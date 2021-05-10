<?php
session_start();
include 'connection.php';

//Verifico il submit dal login
if (isset($_POST['login-submit'])) {

    //Prendo i valori di email e password e li controllo
    $email = $_POST["email"];
    $psw = $_POST["psw"];

    if (($email == "") || ($psw == "")) {
        //Campi incompleti
        header("Location: ../index.php?error=1");
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        //Email non valida
        header("Location: ../index.php?error=2");
    } else {
        //Controllo se è presente un'email così nel Database, prima controllando nella tabella Cliente

        //Query
        $sql = "SELECT * FROM Cliente WHERE email= '$email'";

        //Connessione
        $conn = connect('db_oneclicksharing');
        $result = $conn->query($sql);

        //Controllo il risultato della query
        if ($result->num_rows > 0) {
            //Email presente
            while ($row = $result->fetch_assoc()) {
                //Controllo se la password è corretta
                if ($row['PSW'] == md5($psw)) {
                    //Login effettuata
                    header("Location: ../index.php?ok=1");
                    $_SESSION['loginC'] = true;
                    break;
                } else {
                    //Password sbagliata
                    header("Location: ../index.php?error=3");
                    break;
                }
            }
        } else {
            //Email non presente nella tabella Cliente, provo a cercarla nella tabella Admin
            mysqli_close($conn);

            //Query
            $sql = "SELECT * FROM Admin WHERE email= '$email'";

            //Connessione
            $conn = connect('db_oneclicksharing');
            $result = $conn->query($sql);

            //Controllo il risultato della query
            if ($result->num_rows > 0) {
                //Email presente
                while ($row = $result->fetch_assoc()) {
                    //Controllo se la password è corretta
                    if ($row['PSW'] == md5($psw)) {
                        //Login effettuata
                        header("Location: ../index.php?ok=1");
                        $_SESSION['loginA'] = true;
                    } else {
                        //Password sbagliata
                        header("Location: ../index.php?error=3");
                        break;
                    }
                }
            } else {
                //Email non trovata (ne Cliente, ne Admin)
                header("Location: ../index.php?error=4");
            }
        }
    }
} else {
    //Ritorno all'index
    header("Location: ../index.php");
}
