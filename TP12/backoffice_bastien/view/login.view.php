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
    <h2>Login</h2>
    <form action="index.php" method="post">
      <input type="hidden" name="ctrl" value="login">
      <p>
        <label for="login">Login</label>
        <input id="login" type="text" name="login" value="">
      </p>
      <p>
        <label for="password">Password</label>
        <input id="password" type="password" name="password" value="">
      </p>
      <button type="submit" name="ok">ok</button>
    </form>
  </main>
</body>

</html>