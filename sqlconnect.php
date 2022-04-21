<?php
try
{
	// On se connecte à MySQL
	$bdd = new PDO('mysql:host=localhost;dbname=becode;charset=utf8', 'root', '');
  foreach($bdd->query('SELECT * FROM students') as $row) {
    print_r($row); echo '<br/>';
  }
  
}
catch(Exception $e)
{
	// En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur : '.$e->getMessage());
}
?>