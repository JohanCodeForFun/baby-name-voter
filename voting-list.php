<!DOCTYPE html>
<html lang="en">

<?php
require __DIR__ . "/vendor/autoload.php";

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$mysqli = new mysqli($_ENV["DATABASE_HOSTNAME"],
                     $_ENV["DATABASE_USERNAME"],
                     $_ENV["DATABASE_PASSWORD"],
                     $_ENV["DATABASE_NAME"]);
?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="styles.css">
</head>

<body>
  <div class="container">
    <h1 class="text-center pt-4">Here is your list of names:</h1>
    <div class="d-flex flex-column flex-md-row p-4 gap-4 py-md-5 align-items-center justify-content-center">
      <div class="list-group">
        <?php
        $names = $_POST['names'];
        $namesArray = preg_split("/[\s,]+/", $names);

        sort($namesArray);

        foreach ($namesArray as $name) {
          echo "<a href=\"#\" class=\"list-group-item list-group-item-action d-flex gap-3 py-3\" aria-current=\"true\">
        <img src=\"https://github.com/twbs.png\" alt=\"twbs\" width=\"32\" height=\"32\" class=\"rounded-circle flex-shrink-0\">
        <div class=\"d-flex gap-2 w-100 justify-content-between\">
          <div>
            <h6 class=\"mb-0\">" . htmlspecialchars(trim($name)) . "</h6>
            <p class=\"mb-0 opacity-75\">Which have the meaning of...</p>
          </div>
        </div>
      </a>";
        }
        ?>
      </div>
    </div>
    <div class="d-flex justify-content-center">
      <form action="vote-baby-names.php" method="post">
        <?php
        $connection_string = "{$_ENV['DATABASE_HOSTNAME']} port=5432 dbname={$_ENV['DATABASE_NAME']} user={$_ENV['DATABASE_USERNAME']} password={$_ENV['DATABASE_PASSWORD']}";

        $connection = pg_connect($connection_string);

        $username = 'new_username';
        $password = 'new_password';

        foreach ($namesArray as $name) {
          echo '<input type="hidden" name="names[]" value="' . htmlspecialchars(trim($name)) . '">';

          $sql = "INSERT INTO users (username, password) VALUES ('" . pg_escape_string($connection, $username) . "', '" . pg_escape_string($connection, $password) . "') RETURNING id";
          $result = pg_query($connection, $sql);

          $row = pg_fetch_row($result);
          $newUserId = $row[0];

          $sql = "INSERT INTO names (name, user_id) VALUES ('" . pg_escape_string($connection, $name) . "', $newUserId)";

          $result = pg_query($connection, $sql);

          if (!$result) {
            echo "Name " . $name . " failed to insert.";
            exit;
          }
        }
        ?>
        <button type="submit" class="btn btn-primary">Create and share the vote!</button>
      </form>
    </div>
  </div>

</body>

</html>