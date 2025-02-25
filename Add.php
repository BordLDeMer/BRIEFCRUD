'<?php

require "config.php";
session_start();

//Vérification du formulaire

if($_SERVER ['REQUEST_METHOD'] === 'POST') {
    $dénomination = isset($_POST['dénomination']) ? trim($_POST['dénomination']) : "";
    $prix = isset($_POST['prix']) ? trim($_POST['prix']) : "";
    $stock = isset($_POST['stock']) ? trim($_POST['stock']) : "";

    if ($dénomination !== ''|| $prix !== ''|| $stock !== '') {
        //Stockage de la session

        $_SESSION['message'] = "Vous avez ajouté un produit " . $dénomination;

        $stmt = $pdo->prepare('INSERT INTO produits (id, dénomination, prix, stock) values(NULL,?,?,?);)');
        $stmt->execute([$dénomination, $prix, $stock]);

// Stockage des informations nom, prix, stock dans la session pour les récupérer plus tard
        $_SESSION['nom'] = $dénomination;
        $_SESSION['prix'] = $prix;
        $_SESSION['stock'] = $stock;
        //redirection vers la meme page

        header('Location: index.php');
        exit();
    } else {

        //Message d'erreur
        $_SESSION['message-dénomination'] = "Veuillez indiquer le nom! " . $dénomination;
        $_SESSION['message-email'] = "Erreur du prix " . $prix;
        $_SESSION['message'] = "Article non disponible " . $stock;
    }

}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css"> <!-- Lien vers le fichier CSS -->
    <title>Ajouter un Produit</title>
</head>
<body>
<h1>Ajouter un Nouveau Produit</h1>

<!-- Formulaire d'ajout -->
<form action="add.php" method="POST">
    <label for="dénomination">Dénomination :</label>
    <input type="text" name="dénomination" id="dénomination" required><br>

    <label for="prix">Prix :</label>
    <input type="number" name="prix" id="prix" step="0.01" required><br>

    <label for="stock">Stock :</label>
    <input type="number" name="stock" id="stock" required><br>

    <button type="submit">Ajouter</button>
</form>

<a href="index.php">Retour à la liste des produits</a>
</body>
</html>
