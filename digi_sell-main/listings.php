<?php

session_start();

$mysqli = require __DIR__ . "/database.php";

if (isset($_SESSION["user_id"])) {
    
    
    $sql = "SELECT * FROM user
            WHERE id = {$_SESSION["user_id"]}";
            
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();

    $_SESSION["username"] = $user["username"];

}

function getProducts($mysqli) {
    
    $sql = "SELECT * FROM product";
    
    $result = $mysqli->query($sql);
    
    $products = [];
    
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
    
    return $products;
}

$products = getProducts($mysqli);

$cookie_name = "digisell";
$cookie_value = "Visited Digisell" . date("Y-m-d H:i:s") . "email: " . $user["email"] . "";
setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); 



?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- Mumble UI -->
  <link rel="stylesheet" href="uikit/styles/uikit.css" />
  <!-- Custom CSS -->
  <link rel="stylesheet" href="styles/app.css" />

  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>

  <script type="text/javascript" src="search.js"></script>



  <title>DIGI SELL</title>
</head>

<body>
  <!-- Header Section -->
  <?php include "nav.php"; ?>


  <!-- Main Section -->
  <main class="projects">
    <section class="hero-section text-center">
      <div class="container container--narrow">
        <div class="hero-section__box">
          <h2>Search for <span>Digital Products</span></h2>
        </div>

        <div class="hero-section__search">
          <form class="form" action="" method="post">
            <div class="form__field">
              <label for="formInput#search">Search By Products </label>
              <input class="input input--text" id="search" type="text" name="search"
                placeholder="Search by Project Title" />
            </div>

            <input class="btn btn--sub btn--lg" type="submit" value="search" />
          </form>
        </div>
      </div>
    </section>
    <!-- Search Result: DevList -->
    <section class="projectsList">
      <div class="container">
        <div class="">
          <div class="" id="display">
          <?php
        foreach ($products as $product) {
        echo "<div class='card project'>
              <a href='' class='project'>
                <div class='card__body'>
                  <h3 class='project__title'>{$product["product_name"]}</h3>
                  <p><a class='project__author'>Listed By {$product["owner_name"]}</a></p>
                  <p class='project--rating'>
                    <span style='font-weight: bold;'>Price:</span> {$product["price"]} <span style='font-weight: bold;'>USD</span>
                  </p>

                </div>
                 <a class='btn btn--main--outline'  style='margin: 20px;' href='single_listing.php?product_id={$product["product_id"]}'>View</a>
                <a class='btn btn--main--outline'  style='margin: 20px;' href='single_listing.php?product_id={$product["product_id"]}'>Buy Now</a>
              </a>
            </div>";
    
    }
  ?>
        </div>
      </div>
    </section>

  </main>
</body>

</html>