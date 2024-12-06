<?php
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'bibliotheque';


$conn = new mysqli($host, $user, $password);


if ($conn->connect_error) {
    die("Erreur de connexion: " . $conn->connect_error);
}


$conn->query("CREATE DATABASE IF NOT EXISTS $dbname");


$conn->select_db($dbname);


$conn->query("CREATE TABLE IF NOT EXISTS utilisateurs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100),
    prenom VARCHAR(100),
    date_naissance DATE,
    email VARCHAR(100) UNIQUE,
    mot_de_passe VARCHAR(255)
)");

$conn->query("CREATE TABLE IF NOT EXISTS livres (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(200),
    auteur VARCHAR(200),
    categorie VARCHAR(100)
)");
