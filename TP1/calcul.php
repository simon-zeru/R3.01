<?php
    $a = $_GET['a'] ?? NULL;
    $b = $_GET['b'] ?? NULL;
    $op = $_GET['op'] ?? NULL;

    $result;

    if ($a && $b && $op) {
        
        switch ($op) {
            case '+':
                $result = $a + $b;
                break;
            case '-':
                $result = $a - $b;
                break;
            case 'x':
                $result = $a * $b;
                break;
            case '*':
                $result = $a * $b;
                break;
            case '/':
                $result = $a / $b;
                break;
            default:
                echo "opérateur inconnu";
                $result = NULL;
                break;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calcul</title>
</head>
<body>
    <p>
        <?php echo "$a $op $b = $result" ?>
    </p>
</body>
</html>