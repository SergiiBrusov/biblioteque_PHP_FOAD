<?php
session_start();
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, mot_de_passe FROM utilisateurs WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($user_id, $hashed_password);

    if ($stmt->num_rows > 0) {
        $stmt->fetch();
        if (password_verify($password, $hashed_password)) {
            $_SESSION['user_id'] = $user_id;
            header('Location: dashboard.php');
            exit;
        } else {
            echo "<div class='alert alert-danger'>Mot de passe incorrec</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>Utilisateur non trouvé.</div>";
    }
}
