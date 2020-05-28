<?php
session_start();

$db_user = "Kama";
$db_passwd = "Rjlcooadc13";
$db_host = "localhost";
$db_port = "3306";
$db_name = "exo";
$db_dataSourceName = "mysql:host=$db_host;port=$db_port;dbname=$db_name";

$PDO = new PDO($db_dataSourceName, $db_user, $db_passwd);
$PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// Je mets ma méthode en POST car le pseudo va être posté
// Récupérer l'id du formulaire
$pseudo = $_POST['pseudo'];
var_dump($_POST);
$pwd = $_POST['password'];

$preparedRequest = $PDO->prepare(
    "SELECT * "
        . "FROM user "
        . "WHERE userId = :pseudo AND password = :pwd"
);
$preparedRequest->execute(
    array(
        "pseudo" => $pseudo,
        "pwd" => $pwd

    )
);

$users = $preparedRequest->fetchAll();
// Je vérifie les infos d'un utilisateur, à savoir son mdp et son pseudo
if (count($users) == 1) {
    $_SESSION['userId'] = $pseudo;
}

header("location: minichat.php");
