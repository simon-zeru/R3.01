<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <title>Vue principale du backoffice</title>
  <meta name="author" content="Jean-Pierre Chevallet" />
  <link rel="stylesheet" type="text/css" href="public/design/style.css">
</head>

<body>
  <header>
    <h1>Bricomachin: backoffice</h1>
  </header>
  <aside>
    <!-- Menu  -->
    <?php include(__DIR__ . '/menu.viewpart.php'); ?>
  </aside>
  <main>
    <h2>Mise à jour d'un article</h2>
    <?php if ($article): ?>
      <form method="post">
        <input type="hidden" name="ctrl" value="article.update">
        
        <label for="ref">ID :</label>
        <input type="text" id="ref" name="ref" value="<?php echo htmlspecialchars($article->getRef()); ?>" readonly> <br>

        <label for="libelle">Libelle:</label>
        <input type="text" id="libelle" name="libelle" value="<?php echo htmlspecialchars($article->getLibelle()); ?>"> <br>

        <label for="categorie_id">Categorie:</label>
        <input type="text" id="categorie_id" name="categorie_id" value="<?php echo htmlspecialchars($article->getCategorie()->getId()); ?>"> <br>

        <label for="prix">Prix:</label>
        <input type="text" id="prix" name="prix" value="<?php echo htmlspecialchars($article->getPrix()); ?>"> <br>

        <label for="image">Image:</label>
        <input type="text" id="image" name="image" value="<?php echo htmlspecialchars($article->getImage()); ?>"> <br>

        <input type="submit" value="Mettre à jour">
      </form>
    <?php endif; ?>

    <?php if (isset($error) && count($error) != 0) : ?>
      <output class="error">
        <p>La modification n'a pas été réalisée à cause des erreurs suivantes : </p>
        <ul>
          <?php foreach ($error as $ligne) : ?>
            <li><?= $ligne ?></li>
          <?php endforeach; ?>
        </ul>
      </output>
    <?php endif; ?>

    <?php if (isset($message) && $message != "") : ?>
      <output>
        <?= $message ?>
      </output>
    <?php endif; ?>
  </main>
</body>

</html>