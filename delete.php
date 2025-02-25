<?php
// Importation de la configuration pour la connexion à la base de données
require 'config.php';

// Vérifier si l'ID est présent dans l'URL
if (isset($_GET['id'])) {
    // Récupérer l'ID du produit
    $id = $_GET['id'];

    // Vérifier si l'ID est valide (un nombre entier)
    if (is_numeric($id)) {
        // Requête SQL pour supprimer le produit
        $query = 'DELETE FROM produits WHERE id = :id';
        $stmt = $pdo->prepare($query);

        // Lier le paramètre ID à la requête
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        // Exécuter la requête
        if ($stmt->execute()) {
            // Si la suppression est réussie, rediriger vers la liste des produits
            header('Location: index.php'); // Redirige vers la page des produits
            exit;
        } else {
            echo "Erreur lors de la suppression du produit.";
        }
    } else {
        echo "ID invalide.";
    }
} else {
    echo "Aucun ID fourni.";
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

    <button type="submit">Supprimer</button>
</form>

<a href="index.php">Retour à la liste des produits</a>
</body>
</html>