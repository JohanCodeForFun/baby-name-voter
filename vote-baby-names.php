<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <h1>
    Here is your list of names:
  </h1>

  <form action="process-vote.php" method="post">
      <?php
      $names = $_POST['names'];

      foreach ($names as $name) {
        echo "<input type='checkbox' name='votes[]' value='{$name}'>{$name}";
      }
      ?>.
    <input type="submit" value="Vote for Baby Names">
  </form>

</body>

</html>