<?php
// Réaction à tous les boutons du menu
// 
// Inclusion du framework
include_once('framework/view.fw.php');
// Inclusion du modèle
include_once('model/article.class.php');

// 
///////////////////////////////////////////////////////
// A COMPLETER
///////////////////////////////////////////////////////

// 
$view = $_GET['viewName'];
if ($view) {
    header("Location: index.php?ctrl=$view&viewName=$view");
    exit();
}