<?php
// récupère les informations de la query string
$city = $_GET['city'] ?? 'Dallas';

 ?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="design/style.css">
    <title>My contacts</title>
  </head>
  <body>
    <h1>My contacts from <?= $city ?></h1>
    <table>
      <tr>
        <th>Name</th>
        <th>Phone</th>
      </tr>
        <tr>
          <td>Olivia</td>
          <td>19738054509</td>
        </tr>
    </table>
  </body>
</html>
