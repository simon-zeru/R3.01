<!DOCTYPE html>
<html lang="en" dir="ltr">

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
        <!-- Menu -->
        <?php include(__DIR__ . '/menu.viewpart.php'); ?>
    </aside>
    <main>
        <h2>Logout Confirmation</h2>
        <form action="index.php" method="post">
            <input type="hidden" name="ctrl" value="logout">
            <p>Are you sure you want to logout?</p>
            <button type="submit" name="confirm" value="yes">Yes</button>
            <button type="submit" name="confirm" value="no">No</button>
        </form>
    </main>
</body>

</html>