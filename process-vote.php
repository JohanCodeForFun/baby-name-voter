<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <h1>
    Here is your result of vote:
  </h1>

  <ul>
    <?php
    $votes = $_POST['votes'];

    foreach ($votes as $vote) {
      echo "<li>" . htmlspecialchars(trim($vote)) . "</li>";
    }
    ?>
</ul>

</body>
</html>