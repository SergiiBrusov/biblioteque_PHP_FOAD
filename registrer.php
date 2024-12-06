<?php require 'db.php'; ?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body class="container mt-5">
    <h1>Inscription</h1>
    <form method="POST">
        <div class="mb-3">
            <label for="nom" class="form-label">Prenom</label>
            <input type="text" name="nom" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="prenom" class="form-label">Nom</label>
            <input type="text" name="prenom" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="dob" class="form-label">La date de naissance</label>
            <input type="date" name="dob" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nom = htmlspecialchars($_POST['nom']);
        $prenom = htmlspecialchars($_POST['prenom']);
        $dob = $_POST['dob'];
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO utilisateurs (nom, prenom, date_naissance, email, mot_de_passe) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $nom, $prenom, $dob, $email, $password);

        if ($stmt->execute()) {
            echo "<div class='alert alert-success mt-3'>Succes! <a href='index.php'>Connexion</a></div>";
        } else {
            echo "<div class='alert alert-danger mt-3'>Error: " . $conn->error . "</div>";
        }
    }
    ?>
</body>

</html>