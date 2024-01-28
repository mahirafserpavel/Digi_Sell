<?php 

print_r($_POST);

if (empty($_POST['username'])){
    die('Username is required');
} 

if (empty($_POST['email'])) {
    die('Email is required');
} 
if (empty($_POST['password'])) {
    die('Password is required');
} 

if ($_POST['password'] != $_POST['confirmpassword']) {
    die('Passwords do not match');
}

$password_hash =  password_hash($_POST['password'], PASSWORD_DEFAULT);

var_dump($password_hash);

$mysqli = require __DIR__ . "/database.php";

$sql = "INSERT INTO user (username, email, password_hash)
        VALUES (?, ?, ?)";

$stmt = $mysqli->stmt_init();

if ( ! $stmt->prepare($sql)) {
    die("SQL error: " . $mysqli->error);
}

$stmt->bind_param("sss", $_POST['username'], $_POST['email'], $password_hash);

if ($stmt->execute()) {

    header("Location: signup_success.html");
    exit;
    
} else {
    
    if ($mysqli->errno === 1062) {
        die("email already taken");
    } else {
        die($mysqli->error . " " . $mysqli->errno);
    }
}

?>