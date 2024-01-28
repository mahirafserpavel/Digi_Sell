<?php 
// Include configuration file   
require_once 'config.php';  


?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Mumble UI -->
    <link rel="stylesheet" href="../uikit/styles/uikit.css" />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../styles/app.css" />
    <link rel="stylesheet" href="../styles/custom.css" />

    <script src="https://js.stripe.com/v3/"></script>


    <title>DIGI SELL</title>
  </head>

  <body>
    <div class="auth">
      <div class="card">
        <div class="auth__header text-center">
          <h3>Product Name</h3>
          <p>Product Description</p>
          <p>Price: </p>
          <br>
          <br>
          <!-- <button class="stripe-button" id="payButton">
            <div class="btn btn--sub spinner hidden" id="spinner"></div>
         <span id="buttonText">Pay Now</span>
        </button> -->
        <button id="payButton" class="btn btn--sub">Pay Now</button>

        </div>
      </div>
    </div>
    <script>
// Set Stripe publishable key to initialize Stripe.js
const stripe = Stripe('<?php echo STRIPE_PUBLISHABLE_KEY; ?>');

// Select payment button
const payBtn = document.querySelector("#payButton");

// Payment request handler
payBtn.addEventListener("click", function (evt) {
    setLoading(true);

    createCheckoutSession().then(function (data) {
        if(data.sessionId){
            stripe.redirectToCheckout({
                sessionId: data.sessionId,
            }).then(handleResult);
        }else{
            handleResult(data);
        }
    });
});
    
// Create a Checkout Session with the selected product
const createCheckoutSession = function (stripe) {
    return fetch("payment_init.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify({
            createCheckoutSession: 1,
        }),
    }).then(function (result) {
        return result.json();
    });
};

// Handle any errors returned from Checkout
const handleResult = function (result) {
    if (result.error) {
        showMessage(result.error.message);
    }
    
    setLoading(false);
};

// Show a spinner on payment processing
function setLoading(isLoading) {
    if (isLoading) {
        // Disable the button and show a spinner
        payBtn.disabled = true;
        document.querySelector("#spinner").classList.remove("hidden");
        document.querySelector("#buttonText").classList.add("hidden");
    } else {
        // Enable the button and hide spinner
        payBtn.disabled = false;
        document.querySelector("#spinner").classList.add("hidden");
        document.querySelector("#buttonText").classList.remove("hidden");
    }
}

// Display message
function showMessage(messageText) {
    const messageContainer = document.querySelector("#paymentResponse");
	
    messageContainer.classList.remove("hidden");
    messageContainer.textContent = messageText;
	
    setTimeout(function () {
        messageContainer.classList.add("hidden");
        messageText.textContent = "";
    }, 5000);
}
</script>
  </body>
</html>



