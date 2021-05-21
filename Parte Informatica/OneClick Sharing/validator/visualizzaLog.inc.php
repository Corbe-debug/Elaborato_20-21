<html>

<head>
    <style>
        th,
        td {
            padding: 15px;
            text-align: left;
        }
    </style>
</head>

</html>

<?php
include 'eseguiQuery.php';

function getLogTable()
{
    //Query per prendere tutti i vari i log
    $sql = "SELECT * FROM Log";

    //Connessione
    $result = querySelect($sql);
    $temp = $result->num_rows;
    $table = "";

    if ($temp > 0) {
        while ($row = $result->fetch_assoc()) {
            //Creazione della tabella con i record
            $table .= "<tr> <td> $row[idL]</td> <td> $row[Descrizione]</td> <td> $row[DataOra]</td>

            <td> <a href='profilo.php?id=$row[idC1]'>$row[idC1]</a></td> </tr>";
        }

        return $table;
    } else {
        $table = "null";
        return $table;
    }
}
