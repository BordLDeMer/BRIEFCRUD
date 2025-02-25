<?php
// Informations de connexion à la BDD
$host = "localhost";
$dbname = "produits";
$username = "root";
$password = "";


try {
    // Création d'une instance PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);

    // Configuration de PDO en cas d'exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // s'il y a une erreur
    die("Erreur de connexion: " . $e->getMessage());
}