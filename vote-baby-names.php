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
        <form action="process-vote.php" method="post" id="form">
          <?php
          $names = $_POST['names'];
          $points = array(8, 5, 3);

          // new connection
          $connection_string = "{$_ENV['DATABASE_HOSTNAME']} port=5432 dbname={$_ENV['DATABASE_NAME']} user={$_ENV['DATABASE_USERNAME']} password={$_ENV['DATABASE_PASSWORD']}";
          $connection = pg_connect($connection_string);

          // Prepare the SQL query
          $sql = "SELECT name FROM names;";

          // Execute the query
          $result = pg_query($connection, $sql);

          // Check if the query was successful
          if (!$result) {
            echo "An error occurred.\n";
            exit;
          }

          // Fetch all rows as an associative array
          $rows = pg_fetch_all($result);

          // Loop through the rows and display the name and points
          foreach ($rows as $row) {
            echo $row['name'] . "\n";
          }

          foreach ($rows as $index => $row) {
            $point = isset($points[$index]) ? $points[$index] : 0;
            echo
            "<label class='list-group-item d-flex gap-2'>
          <input class='form-check
          -input flex-shrink-0' type='checkbox' name='votes[{$row['name']}]' value='{$point}'>
          <span>
            {$row['name']}
            <span class='points'></span>
            <small class='d-block text-body-secondary'>Which have the meaning of...</small>
          </span>
        </label>";
          }

          // UPDATE the query
          $sql = "UPDATE names SET points = points + 1 WHERE name = $1;";
          $result = pg_query_params($connection, $sql, array($name));
          
          ?>
          <button type="submit" class="btn btn-primary">Vote for Baby Names</button>
        </form>

      </div>
    </div>

  </div>

  <script>
    const points = [8, 5, 3];
    const availablePoints = [...points];
    const checkboxes = document.querySelectorAll('input[type="checkbox"]');

    checkboxes.forEach((checkbox) => {
      const pointsSpan = checkbox.parentNode.querySelector('.points');

      checkbox.addEventListener('change', (event) => {
        if (!event.target.checked) {
          availablePoints.push(event.target.value);
          availablePoints.sort((a, b) => b - a);
          pointsSpan.textContent = '';
          event.target.value = 0;
          return;
        }

        if (availablePoints.length === 0) {
          event.target.value = 0;
          return;
        }

        event.target.value = availablePoints.shift();
        pointsSpan.textContent = ` (${event.target.value} points)`;
      });
    });
  </script>

</body>

</html>