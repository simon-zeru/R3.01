<?php
// Controleur pour l'action sur les articles
// 
// Inclusion du framework
include_once('framework/view.fw.php');
// Inclusion du modèle
include_once('model/Article.class.php');

// Récupération des données du formulaire

if (isset($_POST['id']) && isset($_POST['titre']) && isset($_POST['contenu'])) {
    $id = $_POST['id'];
    $titre = $_POST['titre'];
    $contenu = $_POST['contenu'];
    $image = $_FILES['image']['name'];
    $imagePath = $imgPath . $image;
    // Mise à jour de l'article
    $article = new Article();
    $article->update($id, $titre, $contenu, $imagePath);
    // Enregistrement de l'image
    move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);
    // Redirection vers la liste des articles
    header('Location: article.list.ctrl.php');
} else {
    // Redirection vers la liste des articles
    header('Location: article.list.ctrl.php');
}

// 
?>
