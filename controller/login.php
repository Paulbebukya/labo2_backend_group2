<?php
if (isset($_POST['login'])) {
    $username = $_POST['username'];

    $password = md5($_POST['password']);

    if (!empty($username) && !empty($password)) {
        require_once '../back-end/Classes/Login.php'; // Correction du chemin vers le fichier de la classe Login
        $login = new Login();
        $result = $login->login($username, $password);
    } else {
        echo "<script>alert('Veuillez remplir tous les champs');</script>";
    }
}
