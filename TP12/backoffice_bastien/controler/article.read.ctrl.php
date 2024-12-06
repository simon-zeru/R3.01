<?php
// Controleur pour l'action sur les articles
// 
// Inclusion du framework
include_once("framework/view.fw.php");
// Inclusion du modèle
include_once("model/article.class.php");
// Nom du répertoire ou stocker les images téléchargées
$imgPath = "/public/img/";

$error = [];
$message = "";
if (isset($_GET['ref'])) {
    $ref = $_GET['ref'];
    $_SESSION['ref'] = $ref;
} else {
    $ref = $_SESSION['ref'] ?? null;
}

if ($ref) {
    try {
        $article = Article::read($ref);
        $message = "Article trouvé : " . $article->getLibelle();
    } catch (Exception $e) {
        $error[] = $e->getMessage();
        $message = null;
    }
}
// Inclusion de la vue
include("view/article.read.view.php");
?>