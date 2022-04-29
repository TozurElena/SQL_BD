<!-- CONNEXION À LA BASE DE DONNÉES -->
<?php
try {
  // Connexion à MySQL
  $bd = new PDO('mysql:host=localhost;dbname=becode;charset=utf8', 'root', '');
} catch (Exception $e) {
  die('Erreur : ' . $e->getMessage());
}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Randonnées</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/basics.css" media="screen" title="no title" charset="utf-8">
  </head>
  <body>
    <h1>Liste des randonnées</h1>
    <?php
   //réalisation requete
    $result = $bd->query('SELECT * FROM hiking');
  ?>
    <table class="table">
      <!-- Afficher la liste des randonnées -->
      <thead>
          <tr>
            <th> Name</th>
            <th> Dificulty</th>
            <th> Distance</th>
            <th> Duration</th>
            <th> Dénivelé</th>
            <th> Supprimer une randonnée</th>
          </tr>
        </thead>
        <tbody>
        <?php while ($donnees = $result->fetch()) : ?>
        <tr>
          <td><a href="update.php?id=<?php echo ($donnees['id']);?>"><?php echo ($donnees['name']);?></a></td> 
          <td><?php echo ($donnees['difficulty']); ?></td>
          <td class="text-center"><?php echo ($donnees['distance']); ?></td>
          <td class="text-center"><?php echo ($donnees['duration']); ?></td>
          <td class="text-center"><?php echo ($donnees['height_difference']); ?></td>
          <td class="text-center"><a href='delete.php?id=<?php echo ($donnees['id']);?>'>Supprimer</a></td>
        </tr>
        <?php endwhile;
        $result->closeCursor();
        ?>
        </tbody>
    </table>
  </body>

  <a href="create.php" >Ajouter une randonnée</a>
</html>
