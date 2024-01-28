<?php

session_start();

$mysqli = require __DIR__ . "/database.php";

function getProduct($mysqli, $id) {
    
    $sql = "SELECT * FROM product WHERE product_id = ?";
    
    $stmt = $mysqli->stmt_init();
    
    if ( ! $stmt->prepare($sql)) {
        die("SQL error: " . $mysqli->error);
    }
    
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        
        $result = $stmt->get_result();
        
        return $result->fetch_assoc();
        
    } else {
        
        if ($mysqli->errno === 1062) {
            die("email already taken");
        } else {
            die($mysqli->error . " " . $mysqli->errno);
        }
    }
}

$product = getProduct($mysqli, $_GET['product_id']);



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
  <main class="singleProject my-md">
    <div class="container">
      <div class="layout">
        <div class="column column--1of3">
          <div class="card text-center">
            <div class="card__body dev">

              <h2 class="dev__name">Essential Info</h2>
              <p class="dev__title">Technology: Django, VueJS</p>
              <?php
              echo '<p class="dev__title">Price: ' . $product['price'] . ' USD</p>';
              echo '<a href="stripe_php/stripe_checkout.php?product_id={$product["product_id"]}" class="btn btn--sub btn--lg">Buy Now | ' . $product['price'] . ' $</a>';

              ?>

             
            </div>
          </div>
        </div>
        <div class="column column--2of3">
          <?php
          echo '<img class="singleProject__preview" src="' . $product['image_link'] . '" alt="portfolio thumbnail" />';
          echo '<a href="profile.html" class="singleProject__developer">By: ' . $product['owner_name'] . '</a>';
          echo '<h2 class="singleProject__title">' . $product['product_name'] . '</h2>';
          echo '<h3 class="singleProject__subtitle">About the Project</h3>';
          echo '<div class="singleProject__info">';
          echo $product['product_description'];
          echo '</div>';

          ?>
        </div>
      </div>
    </div>
    </div>
  </main>
</body>

</html>
