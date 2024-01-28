<?php 
 
// Product Details  
$productName = "Codex Demo Product";  
$productID = "DP12345";  
$productPrice = 55; 
$currency = "usd"; 
  
/* 
 * Stripe API configuration 
 * Remember to switch to your live publishable and secret key in production! 
 * See your keys here: https://dashboard.stripe.com/account/apikeys 
 */ 
define('STRIPE_API_KEY', 'sk_test_51MHVQBAdq6oIFVy0HNG2jMOnq1cjeSlCDcN2E7LIgYH509yFxGlsiuVbFGSE0VRFO6hyXTiXFZ3rn6xcbK5tyKhq00kpCYn2wF'); 
define('STRIPE_PUBLISHABLE_KEY', 'pk_test_51MHVQBAdq6oIFVy0RASZyfpYZvApx4QZCu2i3ZOu14JxPsXqHewSeCryhsIg9TkHgvhIrXVXK5BzGwxI4KooCuz700shkFy8AJ'); 
define('STRIPE_SUCCESS_URL', 'https://localhost.com/payment_success.php'); //Payment success URL 
define('STRIPE_CANCEL_URL', 'https://localhost.com/payment-cancel.php'); //Payment cancel URL 
    
 
?>