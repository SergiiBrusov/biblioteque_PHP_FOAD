<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titre = htmlspecialchars($_POST['titre']);
    $auteur = htmlspecialchars($_POST['auteur']);
    $categorie = htmlspecialchars($_POST['categorie']);

    $stmt = $conn->prepare("INSERT INTO livres (titre, auteur, categorie) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $titre, $auteur, $categorie);

    if ($stmt->execute()) {
        header('Location: dashboard.php');
        exit;
    } else {
        echo "<div class='alert alert-danger'>Erreur: " . $conn->error . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un livre</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body class="container mt-5">
    <h1>Ajouter un livre</h1>
    <form method="POST">
        <div class="mb-3">
            <label for="titre" class="form-label">Titre</label>
            <input type="text" name="titre" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="auteur" class="form-label">Auteur</label>
            <input type="text" name="auteur" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="categorie" class="form-label">Categorie</label>
            <input type="text" name="categorie" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
</body>

</html>