-- Affiche toutes les donn é es.
SELECT
  *
FROM
  `students`;
-- Affiche uniquement les pr é noms.
SELECT
  prenom
FROM
  `students`;
-- Affiche les pr é noms, les dates de naissance et l ’ é cole de chacun.
SELECT
  `prenom`,
  `datenaissance`,
  `school`
FROM
  `students`;
-- Affiche uniquement les é l è ves qui sont de sexe f é minin
SELECT
  *
FROM
  `students`
WHERE
  `genre` = 'F';
-- Affiche uniquement les é l è ves qui font partie de l ’ é cole Andy.
  -- Affiche uniquement les pr é noms des é tudiants,par ordre inverse à l ’ alphabet (DESC).
SELECT
  `prenom`
FROM
  `students`
ORDER BY
  `prenom` DESC;
-- Ensuite, la m ê me chose mais en limitant les r é sultats à 2.
SELECT
  `prenom`
FROM
  `students`
ORDER BY
  `prenom` DESC
LIMIT
  2;
-- Ajoute Ginette Dalor, n é e le 01 / 01 / 1930 et affecte - la à Central, toujours en SQL.
INSERT INTO
  `students`(
    `nom`,
    `prenom`,
    `datenaissance`,
    `genre`,
    `school`
  )
VALUES
  ('Dalor', 'Ginette', '1930-01-01', 'F', '1');
-- Modifie Ginette (toujours en SQL) et change son sexe et son pr é nom en “ Omer ”.
UPDATE
  `students`
SET
  `prenom` = 'Omer',
  `genre` = 'M'
WHERE
  `prenom` = 'Ginette';
-- Supprimer la personne dont l ’ ID est 3.
DELETE FROM
  `students`
WHERE
  `idStudent` = 3;
-- Modifier le contenu de la colonne School de sorte que "1" soit remplac é par "Central" et "2" soit remplac é par "Anderlecht".(attention au type de la colonne !)
ALTER TABLE
  students
MODIFY
  `school` varchar(45);
UPDATE
  students
SET
  `school` = "Central"
WHERE
  `school` = '1';
UPDATE
  students
SET
  `school` = 'Anderlecht'
WHERE
  `school` = '2';