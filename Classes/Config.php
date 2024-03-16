<?php
function get_connection()
{
    $host = "localhost";
    $username = "root";
    $dbname = "db_banque";
    $pass = "code";
    $pdo = null;
    try {
        $pdo = new PDO('mysql:host=' . $host . ';dbname=' . $dbname . '', $username, $pass);

        return $pdo;
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

function generateRandomCode($custommer) {
    $length = 16;
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $code = '';
    for ($i = 0; $i < $length; $i++) {
        $code .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $code.$custommer;
}

// Utilisation de la fonction pour générer un code aléatoire de 16 caractères

?>

