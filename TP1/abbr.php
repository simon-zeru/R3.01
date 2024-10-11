<?php
$URL = "http://www-etu-info.iut2.upmf-grenoble.fr/~zerus/R3.01/TP1/abbr.php";
$URL_API = "http://www-etu-info.iut2.upmf-grenoble.fr/~zerus/R3.01/TP1/api/sign-in.php";
$languages = array (
    'PHP' => 'HyperText Preprocessor',
    'HTML' => 'HyperText Markup Language',
    'CSS' => 'Cascading Style Sheets',
    'XML' => 'eXtended Markeup Language',
);
function abbr($a) : string {
    global $languages;
    return $languages[$a] ?? 'langage inconnu';
}

function abbr_all() {
    global $languages; 
    echo '<table>';
    foreach($languages as $language => $abbr) {
        echo '<tr><th>' . $language . '</th><td>' . abbr($language) . '</td></tr>';
    }
    echo '</table>';
}

$result = '';

$abbr = $_GET['abbr'] ?? '';
$result = abbr($abbr);



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Abréviations</title>
    <style media="screen">
        abbr,th {
            color: blue;
        }
    </style>
</head>
<body>
<h1>Exemple d'utilisation des abréviations en HTML</h1>

<p>Le langage <abbr title="Hypertext PreProcessor">PHP</abbr> produit généralement
    du <abbr title="HyperText Markeup Language">HTML</abbr> mais peu produire aussi
    du <abbr title="eXtended Markeup Language">XML</abbr> ou même
    du <abbr title="Cascading Style Sheets">CSS</abbr>.
</p>
<p>Voici toutes les abbréviations connues : </p>
<?php
    abbr_all()
?>


<form method="GET" action="<?php echo $URL; ?>">
    <label for="abbr">Entrez une abréviation :</label>
    <input type="text" id="abbr" name="abbr" required>
    <button type="submit">Soumettre</button>
</form>
<?php if ($result): ?>
    <p>Résultat : <?php echo $result; ?></p>
<?php endif; ?>
<form method="POST" action="<?= $URL_API ?>">
    <label for="login">Entrez votre identifiant</label>
    <input type="text" id="login" name="login" required>
    <label for="password">Entrez votre mot de passe</label>
    <input type="password" id="password" name="password">
    <button type="submit">Soumettre</button>
</form>
</body>
</html>