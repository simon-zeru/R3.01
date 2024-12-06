<?php
// Controleur pour l'action sur les articles
// 
// Inclusion du framework
include_once("framework/view.fw.php");
// Inclusion du modèle
include_once("model/article.class.php");

// 
///////////////////////////////////////////////////////
// A COMPLETER
///////////////////////////////////////////////////////

// Récupération de l'identifiant de l'article à supprimer
$ref = $_SESSION['ref'] ?? null;
$error = [];
$message = "";

// Vérification de l'existence de l'article
if (!$ref) {
    $error[] = "Merci de sélectionner un article dans Acceder";
    $view['error'] = $error;
}

if ($ref && isset($_GET['confirm_delete']) && $_GET['confirm_delete'] === 'yes') {
    try {
        $article = Article::read($ref);
        $message = $article->delete();
        $_SESSION['ref'] = null;
    } catch (Exception $e) {
        $error[] = "Article non trouvé: " . $e->getMessage();
    }
}

// Inclusion de la vue
include("view/article.delete.view.php");
?>
