<?php
session_start();
require_once "Config.php";

class Login
{
    public static function login($username, $password)
    {
        $pdo = get_connection();
        $response = array(); // Initialisation du tableau de réponse

        // Préparation de la requête SQL
        $stmt = $pdo->prepare("SELECT username, `password` FROM `user` WHERE `username` = ? and `password` = ?");
        
        // Exécution de la requête avec les valeurs fournies
        $stmt->execute([$username, $password]);

        // Vérification si une ligne a été retournée
        if ($stmt->rowCount() > 0) {
            $_SESSION['username']=$username;
            $_SESSION['password']=$password;
            // Si une ligne a été retournée, l'utilisateur est authentifié avec succès
            header('Location:../front-end/views/custommer/index.php');
            exit();
        } else {
            echo '<div class="alert alert-danger mt-3" role="alert">
            Veuillez vérifier vos identifiants
               </div>';
        }

        // Retourner la réponse
        return $response;
    }
}
?>
