
<?php

    require_once__DIR__ . '/connexion.php';
    $message='';
    if($_SERVER['REQUEST_METHOD']=='POST'){
         $nom=$_POST['nom']?? '';
        $prenom=$_POST['prenom'] ?? '';
        $age=$_POST['age'] ?? '';
        $formation=$_POST['formation'] ?? '';
        $moyenne=$_POST['moyenne'] ?? '';
    }
   
    if($nom==='' || $prenom=== '' || $formation===''){
        $message="Tous les champs sont obligatoire";
    }
    else if(!is_numeric($age) || $age <16){
        $message="Age doit etre superieur a 16";
    }
    else if (!is_numeric($moyenne) || $moyenne<0 || $moyenne>20){
        $message="La moyenne doit etre entre 0 et 20";
    }
    else {
        $sql = "INSERT INTO etudiants
        (nom, prenom, age, formation, moyenne)
        VALUES
        (:nom, :prenom, :age, :formation, :moyenne)";
        $stmt = $pdo->prepare($sql);

        $stmt->execute([
        'nom' => $nom,
        'prenom' => $prenom,
        'age' => $age,
        'formation' => $formation,
        'moyenne' => $moyenne
        ]);
        $message="Etudiant ajouté avec succé .";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Ajouter un étudiant :</h1>
    <form method="POST">
<label>Nom :</label>
<input type="text" name="nom" required>
<label>Prénom :</label>
<input id="prenom" type="text" name="prenom" required>
<label >Âge :</label>
<input type="number" name="age" min="16" max="100" required>
<label >Formation :</label>
<input type="text" name="formation" required>
<label >Moyenne :</label>
<input type="number" name="moyenne" min="0" max="20" step="0.01" required>
<button type="submit">Ajouter</button>
</form>
</body>

</html>