<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM livres WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$book = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titre = htmlspecialchars($_POST['titre']);
    $auteur = htmlspecialchars($_POST['auteur']);
    $categorie = htmlspecialchars($_POST['categorie']);

    $stmt = $conn->prepare("UPDATE livres SET titre = ?, auteur = ?, categorie = ? WHERE id = ?");
    $stmt->bind_param("sssi", $titre, $auteur, $categorie, $id);

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
    <title>Modifier le livre</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body class="container mt-5">
    <h1>Modifier le livre</h1>
    <form method="POST">
        <div class="mb-3">
            <label for="titre" class="form-label">Titre</label>
            <input type="text" name="titre" value="<?= $book['titre'] ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="auteur" class="form-label">Auteur</label>
            <input type="text" name="auteur" value="<?= $book['auteur'] ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="categorie" class="form-label">Categorie</label>
            <input type="text" name="categorie" value="<?= $book['categorie'] ?>" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Sauvegarder les modifications</button>
    </form>
</body>

</html>