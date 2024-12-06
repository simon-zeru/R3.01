<?php
// Réaction à tous les boutons du menu
// 
// Inclusion du framework
include_once('framework/view.fw.php');
// Inclusion du modèle
include_once('model/article.class.php');

$viewName = $_GET['viewName'];

if (isset($viewName)) {
    $view = new View();
    $view->display($viewName);
} else {
    $view = new View();
    $view->display("menu");
}


