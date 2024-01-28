<?php 

session_start();

print_r($_POST);
$mysqli = require __DIR__ . "/database.php";



$sql = "INSERT INTO product (owner_id, image_link, product_name, price, product_description, owner_name)
        VALUES (?, ?, ?, ?, ?, ?)";

$stmt = $mysqli->stmt_init();

if ( ! $stmt->prepare($sql)) {
    die("SQL error: " . $mysqli->error);
}


$owner = $_SESSION["user_id"];
$username = $_SESSION["username"];

$stmt->bind_param("ssssss", $owner, $_POST['image_link'], $_POST['product_name'], $_POST['product_price'], $_POST['prod_description'], $username);

if ($stmt->execute()) {

    header("Location: add_product_success.html");
    exit;
    
} else {
    
    if ($mysqli->errno === 1062) {
        die("Failed to add product");
    } else {
        die($mysqli->error . " " . $mysqli->errno);
    }
}

?>