<?php
session_start();

//Verifico il submit dalla donazione
if (isset($_POST['donazione'])) {
    include 'eseguiQuery.php';

    //Prendo i vari valori e li controllo
    $tipo = $_POST["Tipo"];
    $marca = $_POST["Marca"];
    $taglia = $_POST["Taglia"];
    $colore = $_POST["Colore"];
    $descrizione = $_POST["Descrizione"];
    $valutazione = $_POST["Valutazione"];
    $img =  $_FILES["IMG"];

    //Controllo immagine
    $whitelist_type = array('image/jpeg', 'image/png', 'image/gif');
    $fileinfo = finfo_open(FILEINFO_MIME_TYPE);

    if (($tipo == "") || ($tipo == null)) {
        //Campi incompleti
        header("Location: ../donazione.php?error=1");
    } else if (($marca == "") || ($marca == null)) {
        //Campi incompleti
        header("Location: ../donazione.php?error=1");
    } else if (($taglia == "") || ($taglia == null)) {
        //Campi incompleti
        header("Location: ../donazione.php?error=1");
    } else if (($colore == "") || ($colore == null)) {
        //Campi incompleti
        header("Location: ../donazione.php?error=1");
    } else if (($descrizione == "") || ($descrizione == null)) {
        //Campi incompleti
        header("Location: ../donazione.php?error=1");
    } else if (($valutazione == "")) {
        //Campi incompleti
        header("Location: ../donazione.php?error=1");
    } else if (($img == "") || ($img == null)) {
        //Campi incompleti
        header("Location: ../donazione.php?error=1");
    } elseif (!in_array(finfo_file($fileinfo, $img['tmp_name']), $whitelist_type)) {
        //Il file caricato non è un immagine
        header("Location: ../donazione.php?error=2");
    } else {
        //Controllo che effettivamente l'utente ha effettuato il login
        if (isset($_SESSION["loginC"])) {
            $emailC = $_SESSION["Email"];

            //Inserisco il nuovo vestito
            //Prendo l'id dell'utente che dona
            $sql = "SELECT `idC` FROM `cliente` WHERE `Email` = '$emailC'";

            //Connessione
            $result = querySelect($sql);

            //Controllo il risultato della query
            if ($result->num_rows > 0) {
                //Email presente
                while ($row = $result->fetch_assoc()) {
                    $id = $row['idC'];

                    //Controllo se esiste già un immagine con quel nome
                    if (file_exists('../img/imgVestiti/' . $img['name'])) {
                        //E' già presente un immagine con quel nome, aggiungo l'id del cliente davanti al nome della foto tante volte qquanto è necessario
                        while (true) {
                            $img['name'] = $id . $img['name'];

                            if (!file_exists('../img/imgVestiti/' . $img['name'])) {
                                //Ok, ora il nome va bene
                                break;
                            }
                        }
                    }

                    $dataOggi = date("d/m/Y");

                    //Caricamento nella cartella interna imgVestiti
                    if (move_uploaded_file($img['tmp_name'], '../img/imgVestiti/' . $img['name'])) {
                        //Inserimento
                        $tempImg = $img['name'];
                        $sql = "INSERT INTO `vestito`(`Tipo`, `Marca`, `Taglia`, `Colore`, `Descrizione`, `Valutazione`, `Disponibile`, `PathImmagine`, `DataDonazione`, `DataAcquisto`, `idC1`, `idC2`) VALUES ('$tipo','$marca','$taglia','$colore','$descrizione','$valutazione','1','$tempImg','$dataOggi','null','$id','0')";

                        //Connessione
                        $result = queryInsert($sql);

                        if ($result) {
                            //Vestito donato
                            //Ottengo l'id del vetsito appena donato
                            $sql = "SELECT * FROM `vestito` WHERE `PathImmagine` = '$tempImg'";

                            //Connessione
                            $result = querySelect($sql);

                            //Controllo il risultato della query
                            if ($result->num_rows > 0) {
                                //Email presente
                                while ($row = $result->fetch_assoc()) {
                                    $idVestitoDonato = $row['idV'];
                                    break;
                                }
                            }

                            //Ottengo la data con l'ora
                            $dataOggi = date("d/m/Y H:i:s");
                            $descizione = "Un utente ha donato un vestito con id: " . $idVestitoDonato;

                            //Inserisco il nuovo record nella tabella Log
                            $sql = "INSERT INTO `log`(`Descrizione`, `DataOra`, `idC1`) VALUES ('$descizione','$dataOggi','$id')";
                            $result = queryInsert($sql);


                            header("Location: ../index.php?ok=2");
                            $_SESSION["donazione"] = true;
                        } else {
                            //Errore, riprova
                            header("Location: ../donazione.php?error=3");
                        }
                    }
                }
            }
        }
    }
} else {
    header("Location: ../donazione.php");
}
