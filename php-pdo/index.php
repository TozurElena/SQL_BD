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
    $result = $bdd->query('SELECT * FROM meteo');
      // $donnees = $result->fetch();
      // print_r($donnees);
     
      echo '<table border="1">';
      echo '<thead>';
        echo '<tr>';
          echo '<th> Ville';
          echo '</th>';
          echo '<th> Max';
          echo '</th>';
          echo '<th> Min';
          echo '</th>';

        echo '</tr>';
      echo '</thead>';
      echo '<tbody>';
      while ($donnees = $result->fetch()) {
        echo '<tr>';
        echo "<td>{$donnees['ville']}</td>";
        echo "<td>{$donnees['haut']}</td>";
        echo "<td>{$donnees['bas']}</td>" ;
        echo '</tr>';
      }
      echo '</tbody>';
      echo '</table>';
    
    $result->closeCursor();
       
  ?>

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
  
	if (isset($_POST['ville'], $_POST['max'], $_POST['min'])) {
		 $sqlQuery = 'INSERT INTO meteo(ville, haut, bas) VALUES (:ville, :haut, :bas)';
    //preparation
    $insertVille = $bdd->prepare($sqlQuery);
    //Execution. La ville en base de données
    $insertVille->execute([
      'ville' => $_POST['ville'],
      'haut' => $_POST['max'],
      'bas' => $_POST['min'],
    ]);
    $insertVille->closeCursor();		
	} else echo('Erreur  ');

  // header("Location:/sql/php-pdo/index.php");
  
?> 
</body>
</html>