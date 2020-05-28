<!-- Affiche le formulaire de messages et les 10 derniers messages -->
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

function GetMessages()
{
    global $PDO; //Va chercher le PDO à l'extérieur de la fonction
    $response = $PDO->query("SELECT * FROM minichat");
    // Je récupère pseudo & messages de la table
    return $response->fetchAll();
};
$messages = GetMessages();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>L'OM, en vente ? Pas en vente ? #FakeorFake</title>
</head>

<body>
    <?php if (!isset($_SESSION['userId'])) { ?>

        <div class="row">

            <form action="minichat_login.php" method="POST" class="col-4 ml-2 mt-2">
                <div class="form-group">
                    <label for="yourPseudo">Pseudo</label>
                    <input type="text" class="form-control" id="yourPseudo" name="pseudo">
                </div>
                <div class="form-group">
                    <label for="yourPassword">Password</label>
                    <input type="password" name="password" class="form-control" id="yourPassword">
                </div>
                <button type="submit" class="btn btn-primary">Login</button>

            </form>

        <?php } else { ?>

            <form action="minichat_post.php" class="col-4 ml-2 mt-2" method="POST">
                <div class="form-group">
                    <label for="yourText">Message</label>
                    <textarea class="form-control" id="yourMsg" rows="3" name="chat"></textarea> </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="button" class="btn btn-outline-dark">Log out</button>
                <a href="minichat_logout.php">Log out</a>

            </form>
        </div>
    <?php }
    foreach ($messages as $msg) {
    ?>

        <p><b><?= $msg['pseudo']; ?></b> </p>
        <p><?= $msg['chat']; ?></p>
    <?php } ?>

    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>