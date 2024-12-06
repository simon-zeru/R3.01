<?php
// Inclusion du framework et modèle
include_once('framework/view.fw.php');
include_once('model/article.class.php');

// Initialisation
$error = [];
$message = "";
$article = null;


// Récupération de la ref dans la session
$ref = $_SESSION['ref'] ?? null;

if (!$ref) {
    $error[] = "Merci de sélectionner un article dans Acceder";
    $view['error'] = $error;
}

if ($ref) {
    try {
        $article = Article::read($ref);
        var_dump($article);
        var_dump($article->getPrix());
    } catch (Exception $e) {
        $error[] = "Article non trouvé: " . $e->getMessage();
    }
}

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $article) {
    $libelle = $_POST['libelle'] ?? $article->getLibelle();
    $categorie_id = $_POST['categorie'] ?? $article->getCategorie()->getId();
    $prix = $_POST['prix'] ?? $article->getPrix();
    $image = $_POST['image'] ?? $article->getImage();

    if (empty($libelle) || empty($categorie_id) || empty($prix) || empty($image)) {
        $error[] = "Tous les champs sont obligatoires.";
    } else {
        try {
            $article->setLibelle($libelle);
            $article->setCategorieId($categorie_id);
            $article->setPrix($prix);
            $article->setImage($image);
            
            // Sauvegarde
            $message = $article->update();
            $_SESSION['ref'] = $article->getRef();
        } catch (Exception $e) {
            $error[] = $e->getMessage();
        }
    }
}

// Passage des données à la vue
$view['article'] = $article;
$view['error'] = $error;
$view['message'] = $message;

// Affichage de la vue
include('view/article.update.view.php');
