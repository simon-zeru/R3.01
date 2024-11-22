<?php
// 
// Inclusion du framework
include_once('framework/view.fw.php');
// Inclusion du modèle
include_once('model/article.class.php');
include_once('model/categorie.class.php');


// 
///////////////////////////////////////////////////////
// A COMPLETER
///////////////////////////////////////////////////////

// Numero de page
$page = 1;
$pagePrec = 1;
$pageSuiv = 1;
// Pas de filtrage par catégorie
$idCategorie = 0;
$nomCategorie = "Tous les produits";
$articles = array();

// 

////////////////////////////////////////////////////////////////////////////
// Construction de la vue
////////////////////////////////////////////////////////////////////////////
$view = new View();

// Passe les paramètres à la vue
$view->assign('nomCategorie',$nomCategorie);
$view->assign('articles',$articles);
$view->assign('idCategorie',$idCategorie);
$view->assign('page',$page);
$view->assign('pagePrec',$pagePrec);
$view->assign('pageSuiv',$pageSuiv);
// Charge la vue
$view->display("articles")
?>
