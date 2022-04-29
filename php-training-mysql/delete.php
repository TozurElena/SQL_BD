
<!-- /**** Supprimer une randonnée ****/ -->
<!-- CONNEXION À LA BASE DE DONNÉES -->
<?php
try {
  // Connexion à MySQL
  $bd = new PDO('mysql:host=localhost;dbname=becode;charset=utf8', 'root', '');
} catch (Exception $e) {
  die('Erreur : ' . $e->getMessage());
}

// <!-- supprimer -->
$deleteRandonne = $bd->prepare('DELETE FROM hiking WHERE id = :id');
$deleteRandonne->execute(['id' => $_GET['id']]);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  echo '<p style="color:green;>La randonnée a été supprimée avec succès!</p>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Supprimer une randonnée</title>
  <link rel="stylesheet" href="css/basics.css" media="screen" title="no title" charset="utf-8">
</head>
<body>
  <a href="read.php">Liste des données</a>
  <h1>Supprimer cette randonnée?</h1>
  <form action="" method="post">
    <button type="submit" name="delete">Supprimer</button>
  </form>

</body>
</html>
