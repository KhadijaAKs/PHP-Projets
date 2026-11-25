<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $mot_de_passe="Admin@2025";
    echo password_hash($mot_de_passe,PASSWORD_DEFAULT);
    
    
    
    ?>
</body>
</html>