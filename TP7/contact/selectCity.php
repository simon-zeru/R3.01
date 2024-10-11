<?php


// Source de la base
$dataSourceName = "sqlite:" . __DIR__ . "/data/contact.db";

// initialise le client PDO
$db = new PDO($dataSourceName);

const QUERY = 'SELECT DISTINCT city FROM contact';
try {
  $requete = $db->prepare(QUERY);
} catch (PDOException $e) {
  die('PDO query Error on "' . QUERY . '" ' . $e->getMessage());
}

$requete->execute();
$data = $requete->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Select City</title>
  <link rel="stylesheet" href="design/style.css">
</head>

<body>
  <h1>My contacts: select a city</h1>
  <form action="./contact.php" method="GET">
    <table>
      <?php foreach ($data as $contact): ?>
        <tr>
          <td>
            <label for="<?= htmlspecialchars($contact['city']) ?>">
              <?= htmlspecialchars($contact['city']) ?>
              <input type="radio" name="city" value="<?= htmlspecialchars($contact['city']) ?>" id="<?= htmlspecialchars($contact['city']) ?>" required>
            </label>
          </td>
        </tr>
      <?php endforeach; ?>
    </table>
    <button type="submit">Submit</button>
  </form>
</body>

</html>