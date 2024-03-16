<?php
require_once "../../../back-end/Classes/Config.php";
$pdo = get_connection();
$message = [];

if (isset($_POST['save'])) {
    $name = $_POST['name'];
    $adress = $_POST['adress'];
    $phone_number = $_POST['phone_number'];

    if (!empty($name) && !empty($adress) && !empty($phone_number)) {

        $query = $pdo->prepare("SELECT `name` from customer where  name= ?");
        $query->execute([$name]);
        $data = $query->fetch(PDO::FETCH_ASSOC);
        if ($query->rowCount() == 0) {
            $query = $pdo->prepare("INSERT INTO customer (`name`,`adress`, phone_number) VALUES (?,?,?)");
            $query->execute([$name, $adress, $phone_number]);
            if ($query) {
                $customerName = substr($name, 0, 3);
                $randomCode = generateRandomCode($customerName);
                $query = $pdo->prepare("SELECT id from customer where `name`= ? and `phone_number`=?");
                $query->execute([$name, $phone_number]);

                if ($query->rowCount() > 0) {
                    $data = $query->fetch(PDO::FETCH_ASSOC);
                    $date_created = date("Y-m-d H:i:s");
                    $id = $data['id'];
                    $query = $pdo->prepare("INSERT INTO account (`code_account`,date_created,id_customer) VALUES (?,?,?)");
                    $query->execute([$randomCode, $date_created, $id]);
                    if ($query) {
                        $message['success'] = "Successfully added";
                        $message['randomCode'] = "LE NUMERO DE COMPTE DU CLIENT :" . $name . " EST : " . $randomCode;
                    } else {
                        $message['error'] = "Error pending ";
                    }
                } else {
                    $message['error'] = "Error pending ";
                }
            }
        } else {
            $message['error'] = "Le nom est deja prit par un autre client";
        }
    } else {
        echo "<script>alert('Veuillez remplir tous les champs');</script>";
    }
}
$query = $pdo->prepare("SELECT c.id, c.name, c.adress, c.phone_number, a.code_account, a.date_created 
        FROM customer c
        INNER JOIN account a ON c.id = a.id_customer");
$query->execute();
$dataTables = $query->fetchAll(PDO::FETCH_ASSOC);
if (count($dataTables) > 0) {
    $dataTables;
} else {
    $message['error'] = "aucune donnees";
}
