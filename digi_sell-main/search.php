<?php
session_start();

$mysqli = require __DIR__ . "/database.php";

// print_r($_POST);

if (empty($_POST['search'])) {
    die('Search is required');
}

$search = $_POST['search'];

$sql = "SELECT * FROM product WHERE product_name LIKE '%$search%'";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<div class='card project'>
        <a href='' class='project'>
          <div class='card__body'>
            <h3 class='project__title'>{$row["product_name"]}</h3>
            <p><a class='project__author'>Listed By {$row["owner_name"]}</a></p>
            <p class='project--rating'>
              <span style='font-weight: bold;'>Price:</span> {$row["price"]} <span style='font-weight: bold;'>USD</span>
            </p>

          </div>
           <a class='btn btn--main--outline'  style='margin: 20px;' href='single_listing.php?product_id={$row["product_id"]}'>View</a>
          <a class='btn btn--main--outline'  style='margin: 20px;' href='single_listing.php?product_id={$row["product_id"]}'>Buy Now</a>
        </a>
      </div>";

}
    }
 else {
    echo "0 results";
}

$mysqli->close();



?>