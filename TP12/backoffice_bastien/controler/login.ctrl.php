<?php
// 
// Inclusion du framework
include_once("framework/view.fw.php");

// 
///////////////////////////////////////////////////////
// A COMPLETER
///////////////////////////////////////////////////////

// Vérifier si le formulaire de connexion a été soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $login = $_POST['login'];
  $password = $_POST['password'];

  // Vérifier les informations d'identification
  if ($login == 'admin' && $password == 'admin') {
    $_SESSION['connected'] = true;
  } else {
    $_SESSION['connected'] = false;
  }
}

// Vérifier si l'utilisateur est connecté
if (isset($_SESSION['connected']) && $_SESSION['connected'] == true) {
  $connected = true;
} else {
  $connected = false;
}

////////////////////////////////////////////////////////////////////////////
// Construction de la vue
////////////////////////////////////////////////////////////////////////////
$view = new View();

if ($connected) {
  $view->assign('title', 'Vous êtes connecté');
  $view->assign('message','Vous pouvez utiliser les boutons du menu.');
} else {
  $view->assign('title', "Vous n'êtes pas connecté.");
  $view->assign('message','Vous devez vous logger.');
}
$view->display('message');
?>