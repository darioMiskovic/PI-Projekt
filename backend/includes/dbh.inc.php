<?php

$server ='localhost';
$korisnik="root";
$lozinka = "";
$baza = "loginsystem";

try {
    $konekcija = new PDO("mysql:host=$server;dbname=$baza", $korisnik, $lozinka);
    
} catch (PDOException $ex) {
    echo ("Nismo se uspjeli spojiti na bazu.");
    die();
}
?>