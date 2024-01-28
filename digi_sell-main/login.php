<?php

$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $mysqli = require __DIR__ . "/database.php";
    
    $sql = sprintf("SELECT * FROM user
                    WHERE email = '%s'",
                   $mysqli->real_escape_string($_POST["email"]));
    
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();
    
    if ($user) {
        
        if (password_verify($_POST["password"], $user["password_hash"])) {
            
            session_start();
            
            session_regenerate_id();
            
            $_SESSION["user_id"] = $user["id"];
            
            $_SESSION["username"] = $user["username"];

            
            header("Location: index.php");
            exit;
        }
    }
    
    $is_invalid = true;
}

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
    <div class="auth">
      <div class="card">
        <div class="auth__header text-center">
          <a href="">
            <img src="images/logo.svg" alt="icon" />
          </a>
          <h3>Account Login</h3>
          <p>Hello, Welcome Back!</p>
          <p style="color:red;"> 
            <?php 
            if ($is_invalid): ?>
             Invalid login
            <?php endif; ?>
        </p>
        </div>

       

        <form action="#" class="form auth__form" method="post">
            <!-- Input:Email -->
            <div class="form__field">
            <label for="formInput#email">Email Address: </label>
            <input
              class="input input--email"
              id="email"
              type="email"
              name="email"
              placeholder="e.g. user@domain.com"
            />
          </div>

          <!-- Input:Password -->
          <div class="form__field">
            <label for="formInput#password">Password: </label>
            <input
              class="input input--password"
              id="password"
              type="password"
              name="password"
              placeholder="••••••••"
            />
          </div>
          <div class="auth__actions">
            <input class="btn btn--sub btn--lg" type="submit" value="Log In" />
          </div>
        </form>
        <div class="auth__alternative">
          <p>Don’t have an Account?</p>
          <a href="signup.html">Sign Up</a>
        </div>
      </div>
    </div>
  </body>
</html>

