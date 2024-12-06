<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des livres</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body class="container mt-5">
    <h1>Livres</h1>
    <a href="add_book.php" class="btn btn-success mb-3">Ajouter un livre</a>
    <a href="logout.php" class="btn btn-danger mb-3">Se déconnecter</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titre</th>
                <th>Auteur</th>
                <th>Categorie</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $result = $conn->query("SELECT * FROM livres");
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['titre']}</td>
                        <td>{$row['auteur']}</td>
                        <td>{$row['categorie']}</td>
                        <td>
                            <a href='edit_book.php?id={$row['id']}' class='btn btn-warning'>Modifier</a>
                            <a href='delete_book.php?id={$row['id']}' class='btn btn-danger' onclick='return confirm(\"Êtes-vous sûr ?\");'>Supprimer</a>
                        </td>
                      </tr>";
            }
            ?>
        </tbody>
    </table>
</body>

</html>