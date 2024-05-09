
<?php require 'footer.php'; ?>
<?php
require 'header.php';
//require 'oeuvres.php';
require 'bdd.php';
$bdd = connexion();
$oeuvres = $bdd->query('SELECT * FROM oeuvres');


// Si l'URL ne contient pas d'id, on redirige sur la page d'accueil
if(empty($_GET['id'])) {
    header('Location: index.php');
}


try {
    $requete = $bdd->prepare('SELECT * FROM oeuvres WHERE id = ? ');
    $requete->execute([$_GET['id']]);
    $oeuvre = $requete->fetch();

    // Si aucune oeuvre trouvée, on redirige vers la page d'accueil
    /*if(is_null($oeuvre)) {
        header('Location: index.php');
    }*/
    if(!$oeuvre) {
        header('Location: index.php');
    }
} catch (Exception $e) {
    // En cas d'erreur lors de l'exécution de la requête, redirige vers la page d'accueil
    header('Location: index.php');
    exit; // Termine le script pour éviter toute exécution supplémentaire
}
?>

<article id="detail-oeuvre">
    <div id="img-oeuvre">
        <img src="<?= $oeuvre['image'] ?>" alt="<?= $oeuvre['titre'] ?>">
    </div>
    <div id="contenu-oeuvre">
        <h1><?= $oeuvre['titre'] ?></h1>
        <p class="description"><?= $oeuvre['artiste'] ?></p>
        <p class="description-complete">
             <?= $oeuvre['description'] ?>
        </p>
    </div>
</article>

<?php require 'footer.php'; ?>
