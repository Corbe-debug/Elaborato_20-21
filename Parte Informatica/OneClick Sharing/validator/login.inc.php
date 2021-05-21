<?php
session_start();
//Verifico il submit dal login
if (isset($_POST['login-submit'])) {
    include 'eseguiQuery.php';

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
        $result = querySelect($sql);

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

                        if(isset($_SESSION['loginA'])){
                            unset($_SESSION['loginA']);
                        }

                        //Salvo informazioni nella tabella log
                        //Ottengo l'id del cliente loggato
                        $sql = "SELECT * FROM Cliente WHERE Email = '$_SESSION[Email]'";

                        //Connessione
                        $result = querySelect($sql);
                        $temp = $result->num_rows;

                        if ($temp > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $idC = $row["idC"];
                                break;
                            }

                            //Ottengo la data con l'ora
                            $dataOggi = date("d/m/Y H:i:s");
                            $descizione = "Un utente ha effettuato il login";

                            //Inserisco il nuovo record nella tabella Log
                            $sql = "INSERT INTO `log`(`Descrizione`, `DataOra`, `idC1`) VALUES ('$descizione','$dataOggi','$idC')";
                            $result = queryInsert($sql);

                            header("Location: ../index.php");
                        }
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

            //Query
            $sql = "SELECT * FROM Admin WHERE email= '$email'";

            //Connessione
            $result = querySelect($sql);

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
