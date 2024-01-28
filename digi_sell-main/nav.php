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


?>

<header class="header">
    <div class="container container--narrow">
      <a href="" class="header__logo">
        <img src="images/logo.svg" alt="Digi Sell" />
      </a>
      <nav class="header__nav">
        <input type="checkbox" id="responsive-menu" />
        <label for="responsive-menu" class="toggle-menu">
          <span>Menu</span>
          <div class="toggle-menu__lines"></div>
        </label>
        <ul class="header__menu">
          <li class="header__menuItem"><a href="index.php">Home</a></li>
          <li class="header__menuItem"><a href="listings.html">Listings</a></li>
          <?php if (isset($user)): ?>
          <li class="header__menuItem"><a href="add_product.html">Add Listing</a></li>
          <li class="header__menuItem"><a href="profile.html">Profile</a></li>
          <li class="header__menuItem"><?= htmlspecialchars($user["username"]) ?></li>
          <li class="header__menuItem"><a href="logout.php" class="btn btn--sub">Logout</a></li>


          <?php else: ?>

          <li class="header__menuItem"><a href="login.php" class="btn btn--sub">Login/Sign Up</a></li>

          <?php endif; ?>

        </ul>
      </nav>
    </div>
  </header>