<?php
// Controleur pour l'action sur les articles
// 
// Inclusion du framework
include_once("framework/view.fw.php");
// Inclusion du modèle
include_once("model/article.class.php");

// Nom du répertoire ou stocker les images téléchargées
$imgPath = "/public/img/";

$error = array();
$view = new View();
// Récupération de l'identifiant de l'article
if (isset($_GET['ref'])) {
    $ref = $_GET['ref'];
    // Lecture de l'article
    try {
        $article = Article::read($ref);
    } catch (Exception $e) {
        $error[] = $e->message;
    }
    // Envoi de la variable
    $view->assign("article", $article);
    $view->assign("error", $error);
    // Affichage de la vue
    $view->display("article.read");
} else {
    $error[] = "Pas de référence indiquée";
    $view->assign("article.read", $error);
}

// Affichage de la vue
$view->display("article.read");

?>
