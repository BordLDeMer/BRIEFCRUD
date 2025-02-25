<?php
// Importation de la configuration pour la connexion à la base de données
require 'config.php';

// Vérifier si un ID de produit est passé dans l'URL
if (isset($_GET['id'])) {
    // Récupérer l'ID du produit depuis l'URL
    $id = $_GET['id'];

    // Requête pour récupérer le produit avec cet ID
    $query = 'SELECT * FROM produits WHERE id = :id';
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    // Vérifier si le produit existe
    $produit = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$produit) {
        // Si le produit n'existe pas, rediriger vers la liste des produits ou afficher un message d'erreur
        echo "Produit non trouvé.";
        exit;
    }
} else {
    // Si aucun ID n'est passé, rediriger vers la liste des produits ou afficher un message d'erreur
    echo "Aucun produit sélectionné.";
    exit;
}

// Traitement du formulaire de modification
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer les nouvelles données soumises
    $denomination = $_POST['denomination'];
    $prix = $_POST['prix'];
    $stock = $_POST['stock'];

    // Requête pour mettre à jour le produit dans la base de données
    $updateQuery = 'UPDATE produits SET dénomination = ?, prix = ?, stock = ? WHERE id = ?';
    $updateStmt = $pdo->prepare($updateQuery);
    $updateStmt->execute([$denomination, $prix, $stock, $id]);

    // Exécuter la requête de mise à jour
    if ($updateStmt->execute()) {
        // Si la mise à jour est réussie, rediriger vers la page de liste des produits
        header('Location: index.php'); // Remplace "index.php" par la page de la liste des produits
        exit;
    } else {
        // Afficher un message d'erreur si la mise à jour échoue
        echo "Erreur lors de la mise à jour du produit.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css"> <!-- Lien vers le fichier CSS -->
    <title>Modifier Produit</title>
</head>
<body>
<h1>Modifier le produit</h1>

<form action="edit.php?id=<?= $produit['id']; ?>" method="POST">
    <label for="denomination">Dénomination :</label>
    <input type="text" name="denomination" id="denomination" value="<?= htmlspecialchars($produit['dénomination']); ?>" required><br>

    <label for="prix">Prix :</label>
    <input type="number" name="prix" id="prix" value="<?= htmlspecialchars($produit['prix']); ?>" step="0.01" required><br>

    <label for="stock">Stock :</label>
    <input type="number" name="stock" id="stock" value="<?= htmlspecialchars($produit['stock']); ?>" required><br>

    <button type="submit">Enregistrer</button>
</form>

<a href="index.php">Retour à la liste des produits</a>
</body>
</html>
