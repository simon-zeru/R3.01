<?php


$login = $_POST['login'] ?? '';
$password = $_POST['password'] ?? '';
$submit = $_POST['submit'] ?? '';


session_start(); // Envoie un identifiant unique au serveur


if (isset($_SESSION['login']) && $_SESSION['login'] == $login) {
    include("view/main.php");
} 

if ($submit == "login") {
    if ($login == "randomLogin" && $password == "randomPassowrd") {
        $_SESSION['login'] = $login;
        include("view/main.php");

    } else {
        include("view/login.html");
    }
   
} else if ($submit == "new") {
    include('vies/not_implemented.html');
} else {
    include("view/login.html");
}




?>
