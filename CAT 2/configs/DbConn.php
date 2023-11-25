<?php
require_once "constants.php";
try{
    $DbConn = new PDO ("mysql:host=$hostname; dbname=$db_name", $username, $userpass); 
    $DbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully!";
}
catch(PDOException $e){
    echo "Connection failed:" .$e->getMessage();
}
?>