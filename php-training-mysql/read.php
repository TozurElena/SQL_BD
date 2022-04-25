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
    <link rel="stylesheet" href="css/basics.css" media="screen" title="no title" charset="utf-8">
  </head>
  <body>
    <h1>Liste des randonnées</h1>
    <?php
   //réalisation requete
    $result = $bd->query('SELECT * FROM hiking');
  ?>
    <table>
      <!-- Afficher la liste des randonnées -->
      <thead>
          <tr>
            <th> Name</th>
            <th> Dificulty</th>
            <th> Distance</th>
            <th> Duration</th>
            <th> Dénivelé</th>
          </tr>
        </thead>
        <tbody>
        <?php while ($donnees = $result->fetch()) : ?>
        <tr>
          <td><?php echo ($donnees['name']);?></td> 
          <td><?php echo ($donnees['difficulty']); ?></td>
          <td><?php echo ($donnees['distance']); ?></td>
          <td><?php echo ($donnees['duration']); ?></td>
          <td><?php echo ($donnees['height_difference']); ?></td>
        </tr>
        <?php endwhile;
        $result->closeCursor();
        ?>
        </tbody>
    </table>
  </body>
</html>
