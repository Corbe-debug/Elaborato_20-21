<?php
session_start();
include 'connection.php';

//Verifico il submit dal logout
if (isset($_POST['logout-submit'])) {
    //Distruggo tutte le sessioni presenti
    session_destroy();

    header("Location: ../index.php");
}
