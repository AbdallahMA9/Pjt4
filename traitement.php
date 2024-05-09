<?php
if (
    empty($_POST['titre']) ||
    empty($_POST['artiste']) ||
    empty($_POST['description']) ||
    empty($_POST['image']) ||
    strlen($_POST['description']) < 3 ||
    !filter_var($_POST['image'], FILTER_VALIDATE_URL)
) {
    header('Location: ajouter.php?erreur=true');
} else {
    include 'bdd.php';
    $bdd = connexion();
    
    $titre = htmlspecialchars($_POST['titre']);
    $description = htmlspecialchars($_POST['description']);
    $artiste = htmlspecialchars($_POST['artiste']);
    $image = htmlspecialchars($_POST['image']);

    $requete = $bdd->prepare('INSERT INTO oeuvres (titre, description, artiste, image) VALUES (?, ?, ?, ?)');
    $requete->execute([$titre, $description, $artiste, $image]);
    header('Location: oeuvre.php?id='.$bdd->lastInsertId());
}
?>
