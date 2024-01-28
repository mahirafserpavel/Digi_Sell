<?php
session_start();

$mysqli = require __DIR__ . "/database.php";


function getProductsByUser($mysqli, $user_id) {
    
    $sql = "SELECT * FROM product
            WHERE owner_id = {$user_id}";
    
    $result = $mysqli->query($sql);
    
    $products = [];
    
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
    
    return $products;
}

$products = getProductsByUser($mysqli, $_SESSION["user_id"]);

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
  <link rel="stylesheet" href="styles/custom.css" />


  <title>DIGI SELL</title>
</head>

<body>
  <!-- Header Section -->
  <?php include "nav.php"; ?>


  <!-- Main Section -->
  <main class="profile my-md">
    <div class="container">
      <div class="layout">
        <div class="column column--1of3">
          <div class="card text-center">
            <div class="card__body dev">
              <img class="avatar avatar--xl" src="https://png.pngitem.com/pimgs/s/506-5067022_sweet-shap-profile-placeholder-hd-png-download.png" />
              <?php
                           echo '<h2 class="dev__name">' .$_SESSION["username"] . '</h2>';

              ?>
              <p class="dev__title">FullStack Developer</p>
              <p class="dev__location">Dhaka, Bangladesh</p>
              <!-- <a href="#" class="btn btn--sub btn--lg">Send Message </a> -->
            </div>
          </div>
        </div>
        <div class="column column--2of3">
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
                <a class='btn btn--main--outline'  style='margin: 20px;' href='single_listing.php?product_id={$product["product_id"]}'>Delete Now</a>
              </a>
            </div>";
    
    }
  ?>
        </div>
      </div>
    </section>
        </div>
      </div>
    </div>
  </main>
</body>

</html>