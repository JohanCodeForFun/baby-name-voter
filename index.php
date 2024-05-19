<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Baby Name Voter</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="styles.css">
</head>

<body>
  <div class="container col-xl-10 col-xxl-8 px-4 py-5">
    <div class="row align-items-center g-lg-5 py-5">
      <div class="col-lg-7 text-center text-lg-start">
        <h1 class="display-4 fw-bold lh-1 text-body-emphasis mb-3">Baby Name Voter</h1>
        <p class="col-lg-10 fs-4">Have trouble deciding on the right name for your expected or new baby? Or have friend's who can't make up their mind about the right name?</p>
        <p class="col-lg-10 fs-4">Write a list of names that you like. Create a vote. Share it with your friend. See what name is liked best and not at all!</p>
      </div>
      <div class="col-md-10 mx-auto col-lg-5">
        <form class="p-4 p-md-5 border rounded-3 bg-body-tertiary" action="voting-list.php" method="post">
          <textarea class="form-control" rows="5" name="names" id="names" placeholder="Your favorable names:" id="floatingTextarea"></textarea>
          <label for="floatingTextarea">Your favorable names:</label>
          <button class="w-100 btn btn-lg btn-primary" type="submit">Create voting list!</button>
        </form>
      </div>
    </div>
  </div>
</body>

</html>