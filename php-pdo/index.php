<?php
 try
    {
	  // On se connecte à MySQL
	    $bdd = new PDO('mysql:host=localhost;dbname=weatherapp;charset=utf8', 'root', '');
    }
    catch(Exception $e)
    {
	    // En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur : '.$e->getMessage());
    }
  ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Weatherapp</title>
</head>
<body>
  <h1>Les températures du jour (minima et maxima) pour des villes belges.</h1>

  <?php
   //réalisation requete
    $result = $bdd->query('SELECT * FROM meteo');
  ?>
  <!-- Creation tableau -->
    <form action="" method="POST">
      <table border="1">
        <thead>
          <tr>
            <th></th>
            <th> Ville</th>
            <th> Max</th>
            <th> Min</th>
          </tr>
        </thead>
        <tbody>
        <?php while ($donnees = $result->fetch()) : ?>
        <tr>
          <td><input type="checkbox" name="cityDel[]" value=<?php echo $donnees['ville'];?>></td>       
          <td> <?php echo ($donnees['ville']); ?></td>
          <td><?php echo ($donnees['haut']); ?></td>
          <td><?php echo ($donnees['bas']); ?></td>
        </tr>
        <?php endwhile;
        $result->closeCursor();
        ?>
        </tbody>
      </table>
      <?php
      if(isset($_POST['cityDel'])){
        foreach($_POST['cityDel'] as $value) {
         $deleteCity = $bdd->prepare('DELETE FROM meteo WHERE ville = :ville');
         $deleteCity->execute(['ville' => $value]);
        }
      }
      ?>
      <input type="submit" name="submit" value="Supprimer les villes">
    </form>

<h2>Ajouter d'autres villes</h2>
<form method="POST" action="">
	<label for="ville">Ville: </label>
	<input type="text" name="ville">
	<label for="max"><br>Temperature max:</label>
	<input type="number" name="max" >
  <label for="min"><br>Temperature min:</label>
	<input type="number" name="min" >
	<input type="submit" name="submit" value="Add">
</form>

<?php
  $ville = isset($_POST['ville']) ? $_POST['ville'] : 'Une ville est requise';
  $haut = isset($_POST['max']) ? $_POST['max'] : 'Une temperature max est requise';
  $bas = isset($_POST['min']) ? $_POST['min'] : 'Une temperature min est requise';
  //requete 
	$sqlQuery = 'INSERT INTO meteo(ville, haut, bas) VALUES (:ville, :haut, :bas)';
    //preparation
  $insertVille = $bdd->prepare($sqlQuery);
  //Execution. La ville en base de données
  $insertVille->execute([
      'ville' => $ville,
      'haut' => $haut,
      'bas' => $bas,
    ]) or die();
    		
	header("Location:/sql/php-pdo/index.php");
  $insertVille->closeCursor();
  
?> 

</body>
</html>