<?php
session_start();
// Enregistre le message dans la BDD et redirige vers minichat 

$db_user = "Kama";
$db_passwd = "Rjlcooadc13";
$db_host = "localhost";
$db_port = "3306";
$db_name = "exo";
$db_dataSourceName = "mysql:host=$db_host;port=$db_port;dbname=$db_name";

$PDO = new PDO($db_dataSourceName, $db_user, $db_passwd);
$PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// On va d'abord chercher à récupérer les champs entrés par l'utilisateur
$pseudo = $_SESSION['userId'];
$message = $_POST['chat'];

// Je vais ensuite chercher à entrer dans la base de donnée les informations enregistrées par les utilisateurs grâce au PDO
// J'insère donc le pseudo et le message
$preparedRequest = $PDO->prepare("INSERT INTO minichat(pseudo, chat) VALUES (:pseudo, :chat)");
// Requête prête, je l'éxecute dans un tableau clé valeur en utilisant les ID attribués à mes variables
$preparedRequest->execute(
    // Faire appel à la variable de la méthode POST
    array(
        "pseudo" => $pseudo,
        "chat" => $message
    )
);

header("location: minichat.php");
