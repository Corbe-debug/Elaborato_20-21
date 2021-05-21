<?php
include 'connection.php';


function querySelect($sql){
  //Connessione
  $conn = connect('db_oneclicksharing');
  $result = $conn->query($sql);

  $conn->close();
  return $result;
}

function queryInsert($sql){
    //Connessione
    $conn = connect('db_oneclicksharing');
    $result = $conn->query($sql);
  
    $conn->close();
    return $result;
}
?>