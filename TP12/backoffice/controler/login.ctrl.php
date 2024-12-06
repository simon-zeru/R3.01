<?php
// 
// Inclusion du framework
include_once("framework/view.fw.php");

$connected = false;

if (isset($_SESSION['connected'])) {
  $connected = $_SESSION['connected'];
}


$login = $_POST['login'];
$password = $_POST['password'];

if (isset($login) && isset($password)) {
  if ($login == 'admin' && $password == 'admin') {
    $connected = true;
  }
  $_SESSION['connected'] = true;
}

// 

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