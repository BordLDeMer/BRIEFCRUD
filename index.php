<?php
// importation du config.php
require 'config.php';

// Requête SQL pour récupérer les produits
$query = 'SELECT * FROM produits';
$stmt = $pdo->prepare($query);
$stmt->execute();

// Récupérer tous les produits dans un tableau associatif
$produits = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BRIEF CRUD</title>
</head>
<body>
<?php if(!empty($produits)): ?>
    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>date de naissance</th>
        </tr>
        </thead>
        <tbody>
        <!------   PHP ---------------->
        <?php foreach ($produits as $p) : ?>
            <tr>
                <td><?=htmlspecialchars($p['id'])?></td>
                <td><?=htmlspecialchars($p['dénomination'])?></td>
                <td><?=htmlspecialchars($p['prix'])?></td>
                <td><?=htmlspecialchars($p['stock'])?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>Aucun produit</p>
<?php endif; ?>
</body>
</html>
