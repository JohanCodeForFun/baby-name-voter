<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="styles.css">
</head>

<body>
  <div class="container">
    <h1 class="text-center pt-4">Here are the results!</h1>

    <div class="d-flex flex-column flex-md-row p-4 gap-4 py-md-5 align-items-center justify-content-center">
      <div class="list-group">
        <?php
        $votes = $_POST['votes'];

        arsort($votes);

        foreach ($votes as $name => $vote) {
          echo "<a href=\"#\" class=\"list-group-item list-group-item-action d-flex gap-3 py-3\" aria-current=\"true\">
        <img src=\"https://github.com/twbs.png\" alt=\"twbs\" width=\"32\" height=\"32\" class=\"rounded-circle flex-shrink-0\">
        <div class=\"d-flex gap-2 w-100 justify-content-between\">
          <div>
            <h6 class=\"mb-0\">" . htmlspecialchars(trim($name)) . ": " . htmlspecialchars(trim($vote)) . "points.</h6>
            <p class=\"mb-0 opacity-75\">Which have the meaning of...</p>
          </div>
        </div>
      </a>";
        }
        ?>
      </div>
    </div>
  </div>

</body>

</html>