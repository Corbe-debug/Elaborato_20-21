<?php
session_start();
include 'eseguiQuery.php';

//Verifico il submit dal logout
if (isset($_POST['logout-submit'])) {

    //Solo se l'utente è loggato
    if (isset($_SESSION['Email'])) {
        //Prendo l'id dell'utente loggato
        $sql = "SELECT `idC` FROM `cliente` WHERE `Email` = '$_SESSION[Email]'";

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
        $descizione = "Un utente si è disconnesso";

        //Inserisco il nuovo record nella tabella Log
        $sql = "INSERT INTO `log`(`Descrizione`, `DataOra`, `idC1`) VALUES ('$descizione','$dataOggi','$id')";
        $result = queryInsert($sql);
    }

    //Distruggo tutte le sessioni presenti
    session_destroy();

    header("Location: ../index.php");
} else {
    header("Location: ../index.php");
}
