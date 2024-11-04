<?php
    $password = $_POST['password'];


    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    file_put_contents("passwd.txt", $hashedPassword);

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Password updated</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <section>
    <h2>Password updated</h2>
  </section>
</body>

</html>