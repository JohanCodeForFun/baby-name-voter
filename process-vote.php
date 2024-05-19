<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="styles.css">
</head>

<body>
  <h1>
    Here is your result of vote:
  </h1>

  <ul>
    <?php
    $votes = $_POST['votes'];

    arsort($votes);

    foreach ($votes as $name => $vote) {
      echo "<li>" . htmlspecialchars(trim($name)) . ": " . htmlspecialchars(trim($vote)) . "points.</li>";
    }
    ?>
</ul>

</body>
</html>