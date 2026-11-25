<?php
    require_once__DIR__ . '/connexion.php';

    $nomRechercher=$_GET['nom'] ?? '';
    $etudiants=[];
    if($nomRechercher !==''){
        $sql = "SELECT id, nom, prenom, age, formation, moyenne
        FROM etudiants
        WHERE nom LIKE :nom
        ORDER BY nom, prenom";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
        'nom' => '%' . $nomRecherche . '%'
        ]);

        $etudiants = $stmt->fetchAll();
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
    <form method="GET">
<label for="nom">Nom à rechercher :</label>
<input id="nom" type="text" name="nom">
<button type="submit">Rechercher</button>
</form>
   <?php if($nomRecherche !==''):?>
      <?php if(count($etudiants)>0):?>
            <table border="1">
                <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Age</th>
                <th>Formation</th>
                <th>Moyenne</th>
                
                </tr>
                 <?php foreach($etudiants as $etud):?>
                    <tr>
                        <td><?= (int) $etud['id']?></td>
                        <td><?= htmlspecialchars($etud['nom'])?></td>
                        <td><?=htmlspecialchars($etud['prenom'])?></td>
                        <td><?=htmlspecialchars($etud['age'])?></td>
                        <td><?=htmlspecialchars($etud['formation'])?></td>
                        <td><?=htmlspecialchars($etud['moyenne'])?></td>
                    
                    </tr>
                <?php endforeach;?>
            
            
            </table>
        <?php else: ?>
            <p>Aucun etudiant trouve !</p>
        <?php endif; ?>
            <?php endif; ?>

</body>
</html>