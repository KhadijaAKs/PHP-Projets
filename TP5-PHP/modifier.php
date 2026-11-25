 <?php
        require_once __DIR__ . '/connexion.php';
        $id=filter_input(INPUT_GET,'id',FILTER_VALIDATE_INT);
        if(!$id || $id<=0){
            exit("Identifiant invalide ! ");
        }
        $sql="select * from etudiants where id= :id";
        $stmt=$pdo->prepare($sql);
        $stmt->execute(['id'=>$id]);
        $etudiant=$stmt->fetch();
        if(!$etudiant){
            exit("Etudiant introuvable ");
        }
        $message='';
            $message='';
        $nom=$_POST['nom'];
        $prenom=$_POST['prenom'];
        $age=$_POST['age'];
        $formation=$_POST['formation'];
        $moyenne=$_POST['moyenne'];
        if($nom==='' || $prenom=== '' || $formation===''){
            $message="Tous les champs sont obligatoire";
        }
        else if(!is_numeric($age) || $age <16){
            $message="Age doit etre superieur a 16";
        }
        else if (!is_numeric($moyenne) || $moyenne<0 || $moyenne>20){
            $message="La moyenne doit etre entre 0 et 20";
        }
        else{
            $sql="
            update etudiants set nom= :nom, prenom= :prenom, age= :age, formation=:formation, moyenne= :moyenne
            where id= :id";
            $stmt=$pdo->prepare($sql);
            $stmt->execute([
                'nom'=>$nom,
                'prenom'=>$prenom,
                'age'=>$age,
                'formation'=>$formation,
                'moyenne'=>$moyenne,
                'id'=>$id
            ]);
            $message="Etudiant modifié avec succée ";
            $stmt=$pdo->prepare("selct * from etudiants where id=:id");
            $stmt->execute(['id'=>$id]);
            $etudiant=$stmt->fetch();
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
    <form method="post">
        <label>Nom :</label>
    <input type="text" name="nom" value="<?= htmlspecialchars($etudiant['nom']) ?>" required>
    <label>Prénom :</label>
    <input type="text" name="prenom" value="<?= htmlspecialchars($etudiant['prenom']) ?>" required>
    <label>Age :</label>
    <input type="number" name="age" value="<?= htmlspecialchars($etudiant['age']) ?>" required>
    <label>Formation :</label>
    <input type="text" name="formation" value="<?= htmlspecialchars($etudiant['formation']) ?>" required>
    <label>Moyenne :</label>
    <input type="number" name="moyenne" value="<?= htmlspecialchars($etudiant['moyenne']) ?>" required>
    <button type="submit">Modifier</button>
    </form>
</body>
</html>