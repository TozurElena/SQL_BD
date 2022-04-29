<!-- CONNEXION À LA BASE DE DONNÉES -->
<?php
try {
  // Connexion à MySQL
  $bd = new PDO('mysql:host=localhost;dbname=becode;charset=utf8', 'root', '');
} catch (Exception $e) {
  die('Erreur : ' . $e->getMessage());
}
// récuperer données de l'id
$reqDonnes = $bd->prepare('SELECT * FROM hiking WHERE id = :id');
$reqDonnes->execute(['id' => $_GET['id']]);

$donnes = $reqDonnes->fetch(PDO::FETCH_ASSOC);
// variables
$name = isset($_POST['name']) ? $_POST['name'] : NULL;
$difficulty = isset($_POST['difficulty']) ? $_POST['difficulty'] : NULL;
$distance = isset($_POST['distance']) ? $_POST['distance'] : NULL;
$duration = isset($_POST['duration']) ? $_POST['duration'] : NULL;
$height_difference = isset($_POST['height_difference']) ? $_POST['height_difference'] : NULL;
// update donnée
$updateRando = $bd->prepare('UPDATE hiking SET name = :name, difficulty = :difficulty, distance = :distance, duration = :duration, height_difference = :height_difference WHERE id = :id ');
$updateRando->execute([
	'name' => $name,
	'difficulty' => $difficulty,
	'distance' => $distance,
	'duration' => $duration,
	'height_difference' => $height_difference,
	'id' => $_GET['id'],
]);
// if ($_SERVER['REQUEST_METHOD' == 'POST']) {
// 	echo 'La randdonnée a été modifiée avec succès!';
// }
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Modifier une randonnée</title>
	<link rel="stylesheet" href="css/basics.css" media="screen" title="no title" charset="utf-8">
</head>
<body>
	<a href="read.php">Liste des données</a>
	<h1>Modifier</h1>
	<form action="" method="post">
		<input type="hidden" id="id" name="id" value="<?php echo($_GET['id']); ?>">
		<div>
			<label for="name">Name</label>
			<input type="text" name="name" value="<?php echo($donnes['name']); ?>">
			<!-- <span style="color:red;"> * <?php echo $nameErr; ?></span> -->
		</div>

		<div>
			<label for="difficulty">Difficulté</label>
			<select name="difficulty">
				<option value="null">Choississez une difficulté</option>
				<option value="très facile">Très facile</option>
				<option value="facile">Facile</option>
				<option value="moyen">Moyen</option>
				<option value="difficile">Difficile</option>
				<option value="très difficile">Très difficile</option>
			</select>
		</div>
		
		<div>
			<label for="distance">Distance</label>
			<input type="text" name="distance" value="<?php echo($donnes['distance']); ?>">
		</div>
		<div>
			<label for="duration">Durée</label>
			<input type="duration" name="duration" value="<?php echo($donnes['duration']); ?>">
		</div>
		<div>
			<label for="height_difference">Dénivelé</label>
			<input type="text" name="height_difference" value="<?php echo($donnes['height_difference']); ?>">
		</div>
		<button type="submit" name="button">Modifier</button>
	</form>
</body>
</html>
