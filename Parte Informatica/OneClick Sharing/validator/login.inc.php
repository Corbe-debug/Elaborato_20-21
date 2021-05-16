<?php
session_start();
//Verifico il submit dal login
if (isset($_POST['login-submit'])) {
    include 'connection.php';

    //Prendo i valori di email e password e li controllo
    $email = $_POST["email"];
    $psw = $_POST["psw"];

    if (($email == "") || ($psw == null)) {
        //Campi incompleti
        header("Location: ../index.php?error=1");
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        //Email non valida
        header("Location: ../index.php?error=2");
    } else {
        //Controllo se è presente un'email così nel Database, prima controllando nella tabella Cliente

        //Query
        $sql = "SELECT * FROM Cliente WHERE Email= '$email'";

        //Connessione
        $conn = connect('db_oneclicksharing');
        $result = $conn->query($sql);

        //Controllo il risultato della query
        if ($result->num_rows > 0) {
            //Email presente
            //Controllo che l'email non sia quella del master (utilizzato per fk nulle)
            if ($email != "DB") {
                while ($row = $result->fetch_assoc()) {
                    //Controllo se la password è corretta
                    if ($row['PSW'] == md5($psw)) {
                        //Login effettuata

                        //Imposto le sessioni per il login, nome e email
                        $_SESSION['loginC'] = true;
                        $_SESSION['Nome'] = $row['Nome'];
                        $_SESSION['Email'] = $email;
                        header("Location: ../index.php");
                    } else {
                        //Password sbagliata
                        header("Location: ../index.php?error=3");
                    }
                }
            } else {
                //Login non possibile
                header("Location: ../index.php");
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
                        header("Location: ../index.php");
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
