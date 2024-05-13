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
    Here is your list of names:
  </h1>

  <ul>
    <?php
    $names = $_POST['names'];
    $namesArray = explode(",", $names);

    foreach ($namesArray as $name) {
      echo "<li>" . htmlspecialchars(trim($name)) . "</li>";
    }
    ?>
</ul>

<form action="vote-baby-names.php" method="post">
    <?php
    foreach ($namesArray as $name) {
        echo '<input type="hidden" name="names[]" value="' . htmlspecialchars(trim($name)) . '">';
    }
    ?>
    <input type="submit" value="Vote for Baby Names">
</form>

</body>
</html>