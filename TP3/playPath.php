<?php
    $path = $_GET['music'];

    $music = "./data/" . $path . ".mp3";
    $image = "./data/" . $path . ".jpeg";

    for($i = 0; $i < 10; $i++) {

    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Playing : <?= $path ?></title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <header>
        <h1>Playing : <?= $path ?></h1>
    </header>
    <main>
        <nav>
            <a href="staticJukebox.html">
                Retour
            </a>
        </nav>
        <section>

            <figure>

                <img src="<?=$image?>" alt="cover" />
                <audio src="<?=$music?>" controls="">  
                </audio>

            </figure>
        </section>
    </main>
    <footer>
    </footer>
</body>
</html>