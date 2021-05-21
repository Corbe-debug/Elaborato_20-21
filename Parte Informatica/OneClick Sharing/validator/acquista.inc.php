<?php
session_start();

//Verifico il submit dall'acquisto
if (isset($_POST['acquista-submit'])) {
    //Verifico che sia settata la sessione dell'id vestito da acquistare e la sessione del login
    if ((isset($_SESSION['idVestito'])) && (isset($_SESSION['loginC']))) {
        //Procedo con l'acquisto
        include 'eseguiQuery.php';

        //Prendo l'id del vestito
        $idV = $_SESSION['idVestito'];

        //Prendo l'id del cliente loggato
        $sql = "SELECT * FROM Cliente WHERE Email = '$_SESSION[Email]'";

        //Connessione
        $result = querySelect($sql);
        $temp = $result->num_rows;

        if ($temp > 0) {
            while ($row = $result->fetch_assoc()) {
                $idC = $row["idC"];
                $credito = intval($row["Stelle"]);
                break;
            }

            //In base alla valutazione del vestito, diminuisco il credito residuo del cliente
            $sql = "SELECT * FROM Vestito WHERE idV = '$idV'";

            //Connessione
            $result = querySelect($sql);
            $temp = $result->num_rows;

            if ($temp > 0) {
                while ($row = $result->fetch_assoc()) {
                    $valutazione = intval($row["Valutazione"]);
                    $idDonatore = $row["idC1"];

                    //Controllo se c'è abbastanza credito
                    if (($credito - $valutazione) >= 0) {
                        //Tutto ok, procedo con la modifica del flag disponibile sul vestito
                        $sql = "UPDATE Vestito SET Disponibile='0' WHERE idV =  '$idV'";
                        $conn = connect('db_oneclicksharing');
                        $result = $conn->query($sql);

                        if ($result) {
                            //Flag modificato, procedo con la modifica della chiave esterna idC2 con l'id del cliente che l'ha comprato
                            $sql = "UPDATE Vestito SET idC2='$idC' WHERE idV =  '$idV'";
                            $conn = connect('db_oneclicksharing');
                            $result = $conn->query($sql);

                            //Modifico la data di acquisto da null
                            $dataOggi = date("d/m/Y");
                            $sql = "UPDATE Vestito SET DataAcquisto='$dataOggi' WHERE idV =  '$idV'";
                            $conn = connect('db_oneclicksharing');
                            $result = $conn->query($sql);

                            //Diminuisco il credito del cliente
                            $diff = ($credito - $valutazione);

                            $sql = "UPDATE Cliente SET Stelle='$diff' WHERE idC =  '$idC'";
                            $conn = connect('db_oneclicksharing');
                            $result = $conn->query($sql);

                            //Aumento il credito del donatore
                            //Ottego il credito del donatore
                            $sql = "SELECT * FROM Cliente WHERE idC = '$idDonatore'";

                            //Connessione
                            $result = querySelect($sql);

                            $row = $result->fetch_assoc();
                            $creditoDonatore =  intval($row['Stelle']);
                            $nuovoCredito =  $creditoDonatore + $valutazione;

                            //Aggiorno il credito, sommando il "costo" del vestito scelto
                            $sql = "UPDATE Cliente SET Stelle='$nuovoCredito' WHERE idC =  '$idDonatore'";
                            $conn = connect('db_oneclicksharing');
                            $result = $conn->query($sql);

                            //Elimino le sessioni non più necessarie
                            unset($_SESSION['idVestito']);

                            //Ottengo la data con l'ora
                            $dataOggi = date("d/m/Y H:i:s");
                            $descizione = "Un utente ha comprato un vestito con id:  $idV";

                            //Inserisco il nuovo record nella tabella Log
                            $sql = "INSERT INTO `log`(`Descrizione`, `DataOra`, `idC1`) VALUES ('$descizione','$dataOggi','$idC')";
                            $result = queryInsert($sql);

                            //Ritorno a visualizza.php
                            $_SESSION['acquisto'] = true;
                            header("Location: ../index.php?ok=1");
                        }
                    } else {
                        //Credito insufficiente, messsaggio
                        echo "<script>alert('Credito insufficiente')</script>";
                        //Ritorno a visualizza.php
                        header("Location: ../visualizza.php");
                    }
                }
            } else {
                //Ritorno a visualizza.php
                header("Location: ../visualizza.php");
            }
        }
    } else {
        //Ritorno a visualizza.php
        header("Location: ../visualizza.php");
    }
} else {
    //Ritorno a visualizza.php
    header("Location: ../visualizza.php");
}
