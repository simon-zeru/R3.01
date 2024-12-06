<?php
// Controleur pour l'action sur les articles
// 
// Inclusion du framework
include_once("framework/view.fw.php");
// Inclusion du modèle
include_once("model/Article.class.php");

$error = array();
$view = new View();
// Récupération de l'identifiant de l'article
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // Suppression de l'article
    $article = new Article();
    try {
        $article->delete($id);
    } catch(Exception $e) {
        $error[] = $e->message;
    }
}

// Affichage de la vue
$view->display("article.delete");

// 
?>
