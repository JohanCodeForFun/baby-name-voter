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

  <form action="process-vote.php" method="post" id="form">
    <?php
    $names = $_POST['names'];
    $points = array(8, 5, 3);

    foreach ($names as $index => $name) {
      $point = isset($points[$index]) ? $points[$index] : 0;
      echo "<div class='name-container'>
      <input type='checkbox' name='votes[{$name}]' value='{$point}'>{$name}
      </div>";
    }
    ?>
    <input type="submit" value="Vote for Baby Names">
  </form>

  <script>
    const points = [8, 5, 3];
    const availablePoints = [...points];
    const checkboxes = document.querySelectorAll('input[type="checkbox"]');

    checkboxes.forEach((checkbox) => {
      const pointsSpan = document.createElement('span');
      pointsSpan.classList.add('points');
      checkbox.parentNode.appendChild(pointsSpan);

      checkbox.addEventListener('change', (event) => {
        if (event.target.checked) {
          event.target.value = availablePoints.shift() || 0;
          pointsSpan.textContent = ` (${event.target.value} points)`;
        } else {
          availablePoints.push(event.target.value);
          availablePoints.sort((a, b) => b - a);
          pointsSpan.textContent = '';
          event.target.value = 0;
        }
      });
    });
  </script>

</body>

</html>