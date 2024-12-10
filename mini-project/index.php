<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
$servername = "localhost";
$username = "root"; // Your database username
$password = ""; // Your database password
$dbname = "restaurant"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $tableNum = $_POST['tableNum'];
    $quantity = $_POST['quantity'];
    $totalPrice = 250 * $quantity; // Assuming Rs 250 per item
    $paymentMethod = $_POST['paymentMethod'];

    // Insert data into the database
    $sql = "INSERT INTO orders (name, email, table_num, quantity, total_price, payment_method) 
            VALUES ('$name', '$email', $tableNum, $quantity, $totalPrice, '$paymentMethod')";

    if ($conn->query($sql) === TRUE) {
        // Output JavaScript for the alert box
        echo "<script>
                alert('Order confirmed!');
                window.location.href = 'order_form.html'; // Redirect to the form page after alert
              </script>";
    } else {
        echo "<script>
                alert('Error: " . addslashes($conn->error) . "');
              </script>";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous" />
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="cs.css" />
    <style>
        .menu-item {
            margin-bottom: 20px;
            text-align: center;
        }

        .menu-item img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
        }

        .menu-item h5 {
            margin-top: 10px;
        }

        .notification {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: #28a745;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            display: none;
            z-index: 1000;
        }

        .cart-link {
            color: #fff;
            text-decoration: underline;
            cursor: pointer;
        }

        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0, 0, 0);
            background-color: rgba(0, 0, 0, 0.4);
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>

<body>

    <div id="sectionHome">
        <nav class="navbar navbar-expand-lg navbar-light bg-white">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <img src="https://d1tgh8fmlzexmh.cloudfront.net/ccbp-responsive-website/food-munch-img.png" class="food-munch-logo" />
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav ml-auto">
                        <a class="nav-link active" id="navItem1" href="#wcuSection">
                            Why Choose Us?
                            <span class="sr-only">(current)</span>
                        </a>
                        <a class="nav-link" href="#sectionHome1 " id="navItem2">View Cart</a>
                        <a class="nav-link" href="#delivery_and_payment" id="navItem3">Delivery & Payment</a>
                        <a class="nav-link" href="#follow_us" id="navItem4">Follow Us</a>
                    </div>
                </div>
            </div>
        </nav>

        <div class="banner-section-bg-container d-flex justify-content-center flex-column">
            <div class="text-center">
                <h1 class="banner-heading mb-3">Get Delicious Food Anytime</h1>
                <p class="banner-caption mb-4">Eat Smart & Healthy</p>
                <button class="custom-button" onclick="display('sectionHome1')">View Menu</button>
                <button class="custom-outline-button">Order Now</button>
            </div>
        </div>


        <div class="wcu-section pt-5 pb-5" id="wcuSection">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h1 class="wcu-section-heading">Why Choose Us?</h1>
                        <p class="wcu-section-description">
                            We use both original recipes and classic versions of famous food
                            items.
                        </p>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="wcu-card p-3 mb-3">
                            <img src="https://d1tgh8fmlzexmh.cloudfront.net/ccbp-responsive-website/food-serve.png" class="wcu-card-image" />
                            <h1 class="wcu-card-title mt-3">Food Service</h1>
                            <p class="wcu-card-description">
                                Experience fine dining at the comfort of your home. All our
                                orders are carefully packed and arranged to give you the nothing
                                less than perfect.
                            </p>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="wcu-card p-3 mb-3">
                            <img src="https://d1tgh8fmlzexmh.cloudfront.net/ccbp-responsive-website/fruits-img.png" class="wcu-card-image" />
                            <h1 class="wcu-card-title mt-3">Fresh Food</h1>
                            <p class="wcu-card-description">
                                The Fresh Food group provides fresh-cut fruits and vegetables
                                directly picked from our partner farms and farm houses so that
                                you always get them tree to plate.
                            </p>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="wcu-card p-3 mb-3">
                            <img src="https://d1tgh8fmlzexmh.cloudfront.net/ccbp-responsive-website/offers-img.png" class="wcu-card-image" />
                            <h1 class="wcu-card-title mt-3">Best Offers</h1>
                            <p class="wcu-card-description">
                                Food Coupons & Offers upto
                                <span class="offers">50% OFF</span>
                                and Exclusive Promo Codes on All Online Food Orders.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="healthy-food-section pt-5 pb-5">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-5">
                        <div class="text-center">
                            <img src="https://d1tgh8fmlzexmh.cloudfront.net/ccbp-responsive-website/healthy-food-plate-img.png" class="healthy-food-section-img" />
                        </div>
                    </div>
                    <div class="col-12 col-md-7">
                        <h1 class="healthy-food-section-heading">
                            Fresh, Healthy, Organic, Delicious Fruits
                        </h1>
                        <p class="healthy-food-section-description">
                            Say no to harmful chemicals and go fully organic with our range of
                            fresh fruits and veggies. Pamper your body and your senses with
                            the true and unadulterated gifts from mother nature. with the true
                            and unadulterated gifts from mother nature.
                        </p>
                    </div>
                </div>
            </div>
        </div>


        <div id="delivery_and_payment">
            <div class="delivery-and-payment-section pt-5 pb-5">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-md-5 order-1 order-md-2">
                            <div class="text-center">
                                <img src="https://d1tgh8fmlzexmh.cloudfront.net/ccbp-responsive-website/delivery-payment-section-img.png" class="delivery-and-payment-section-img" />
                            </div>
                        </div>
                        <div class="col-12 col-md-7 order-2 order-md-1">
                            <h1 class="delivery-and-payment-section-heading">
                                Delivery and Payment
                            </h1>
                            <p class="delivery-and-payment-section-description">
                                Enjoy hassle-free payment with the plenitude of payment options
                                available for you. Get live tracking and locate your food on a
                                live map. It's quite a sight to see your food arrive to your door.
                                Plus, you get a 5% discount on every order every time you pay
                                online.
                            </p>
                            <div class="mt-3">
                                <img src="https://d1tgh8fmlzexmh.cloudfront.net/ccbp-responsive-website/visa-card-img.png" class="payment-card-img" />
                                <img src="https://d1tgh8fmlzexmh.cloudfront.net/ccbp-responsive-website/master-card-img.png" class="payment-card-img" />
                                <img src="https://d1tgh8fmlzexmh.cloudfront.net/ccbp-responsive-website/paypal-card-img.png" class="payment-card-img" />
                                <img src="https://d1tgh8fmlzexmh.cloudfront.net/ccbp-responsive-website/american-express-img.png" class="payment-card-img" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="follow_us">
            <div class="thanking-customers-section pt-5 pb-5">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-md-7 d-flex flex-column justify-content-center">
                            <h1 class="thanking-customers-section-heading">
                                Thank you for being a valuable customer to us.
                            </h1>
                            <p class="thanking-customers-section-description">
                                We have a surprise gift for you
                            </p>
                            <div class="d-md-none">
                                <img src="https://d1tgh8fmlzexmh.cloudfront.net/ccbp-responsive-website/thanking-customers-section-img.png" class="thanking-customers-section-img" />
                            </div>
                            <div>
                                <button type="button" class="custom-button" data-toggle="modal" data-target="#exampleModal">
                                    Redeem Gift
                                </button>
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog mt-5">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title thanking-customers-section-modal-title" id="exampleModalLabel">
                                                    Gift Voucher
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <img src="https://d1tgh8fmlzexmh.cloudfront.net/ccbp-responsive-website/gift-voucher-img.png" class="w-100" />
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                    Close
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-5 d-none d-md-block">
                            <img src="https://d1tgh8fmlzexmh.cloudfront.net/ccbp-responsive-website/thanking-customers-section-img.png" class="thanking-customers-section-img" />
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="footer-section pt-5 pb-5">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center">
                        <img src="https://d1tgh8fmlzexmh.cloudfront.net/ccbp-responsive-website/food-munch-logo-light.png" class="food-munch-logo" />
                        <h1 class="footer-section-mail-id">orderfood@foodmunch.com</h1>
                        <p class="footer-section-address">
                            123 Jyothi Nagar,ckm, India.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="sectionHome1">
        <div class="explore-background mb-5">
            <div class="container ">
                <div class="row">
                    <a class="view-heading" onclick="display('sectionHome')" target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="60" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
                        </svg>
                    </a>
                    <div class="col-12 pb-5 text-center">
                        <h1 class="explore-heading">Explore Menu</h1>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4 shadow mt-3 mb-3">
                        <div class="explore-part-container pt-3  text-center">
                            <img src="https://imgmedia.lbb.in/media/2023/05/645df3ddad09c45b4771cf01_1683878877966.jpg" class="non-veg-starter-image" />
                            <h1 class="non-veg-heading">Non-Veg Starters</h1>
                            <a class="view-heading" onclick="display('section2')" target="_blank">View All
                                <svg xmlns="http://www.w3.org/2000/svg" width="35" height="40" fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8" />
                                </svg>
                            </a>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4 shadow mt-3 mb-3">
                        <div class="explore-part-container pt-3  text-center">
                            <img src="https://i.pinimg.com/originals/a4/2b/3a/a42b3a59c5e3a4dc92e1b833ba1782f9.jpg" class="non-veg-starter-image" />
                            <h1 class="non-veg-heading">Veg Starters</h1>
                            <a class="view-heading" onclick="display('section3')" target="_blank">View All
                                <svg xmlns="http://www.w3.org/2000/svg" width="35" height="40" fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8" />
                                </svg>
                            </a>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4 shadow mt-3 mb-3">
                        <div class="explore-part-container pt-3  text-center">
                            <img src="https://cdn.diffords.com/contrib/encyclopedia/2022/10/63492b3330994.jpg" class="non-veg-starter-image" />
                            <h1 class="non-veg-heading">Drinks & Desserts</h1>
                            <a class="view-heading" onclick="display('section4')" target="_blank">View All
                                <svg xmlns="http://www.w3.org/2000/svg" width="35" height="40" fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8" />
                                </svg>
                            </a>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4 shadow mt-3 mb-3">
                        <div class="explore-part-container pt-3  text-center">
                            <img src="https://www.lecremedelacrumb.com/wp-content/uploads/2022/09/easy-creamy-potato-soup-12-2.jpg" class="non-veg-starter-image" />
                            <h1 class="non-veg-heading">Soups</h1>
                            <a class="view-heading" onclick="display('section5')" target="_blank">View All
                                <svg xmlns="http://www.w3.org/2000/svg" width="35" height="40" fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8" />
                                </svg>
                            </a>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4 shadow mt-3 mb-3">
                        <div class="explore-part-container pt-3  text-center">
                            <img src="https://thumbs.dreamstime.com/z/indian-curry-dishes-17901001.jpg" class="non-veg-starter-image" />
                            <h1 class="non-veg-heading">Currey</h1>
                            <a class="view-heading" onclick="display('section6')" target="_blank">View All
                                <svg xmlns="http://www.w3.org/2000/svg" width="35" height="40" fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8" />
                                </svg>
                            </a>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4 shadow mt-3 mb-3">
                        <div class="explore-part-container pt-3  text-center">
                            <img src="https://www.salonebly.com/fleetcart/storage/media/CSOTD6XSgyqyzKOzE2Tk3finRuhpUF6qR3LYqzgp.jpeg" class="non-veg-starter-image" />
                            <h1 class="non-veg-heading">Noodles</h1>
                            <a class="view-heading" onclick="display('section7')" target="_blank">View All
                                <svg xmlns="http://www.w3.org/2000/svg" width="35" height="40" fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="section2">
        <div>
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <a class="view-heading" onclick="display('sectionHome1')" target="_blank">
                            <svg xmlns="http://www.w3.org/2000/svg" width="23" height="60" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
                            </svg>
                        </a>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4 shadow mt-2 mb-3 pb-5">
                        <div class="explore-part-container  pb-3 ">
                            <img src="https://flawlessfood.co.uk/wp-content/uploads/2021/03/Tandoori-Chicken-Tikka-Kebab-433-1536x1017.jpg" class="biriyani-image " />
                            <h1 class="non-veg-heading mt-3 ml-2">Kabab <span class="heading-span ">4.3
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                    </svg>
                                </span></h1>
                            <p class="para-north">North, Southern, Andhra </p>
                            <p class=" para-north" style="font-weight:bold; color:green;"> Rs 25</p>
                            <button class="button-part-1 order-now-btn" onclick="openOrderForm()">Order Now</button>
                            <button class="button-part-2 add-to-cart1">Add to Cart</button>
                        </div>
                    </div>

                    <div id="orderForm" class="modal">
                        <div class="modal-content">
                            <span class="close" onclick="closeOrderForm()">&times;</span>
                            <h2>Order Form</h2>
                            <form id="orderFormDetails" action="index.php" method="POST">
    <label for="name">Name:</label><br>
    <input type="text" id="name" name="name" required><br><br>

    <label for="email">Email:</label><br>
    <input type="email" id="email" name="email" required><br><br>

    <label for="tableNum">Table Number (1-10):</label><br>
    <input type="number" id="tableNum" name="tableNum" min="1" max="10" required><br><br>

    <label for="quantity">Quantity:</label><br>
    <input type="number" id="quantity" name="quantity" value="1" min="1" required><br><br>

    <p>Total Price: Rs <span id="totalPrice">250</span></p>

    <label for="paymentMethod">Payment Method:</label><br>
    <select id="paymentMethod" name="paymentMethod" required>
        <option value="cash">Cash</option>
        <option value="card">Card</option>
        <option value="phonepay">PhonePay</option>
        <option value="googlepay">Google Pay</option>
    </select><br><br>

    <button type="submit">Submit</button>
</form>

                        </div>
                    </div>

                    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
                    <script>
                        let pricePerUnit = 80; // Price for one quantity
                        let modal = document.getElementById("orderForm");
                        let totalPriceElement = document.getElementById("totalPrice");
                        let qrCodeContainer = document.getElementById("qrCodeContainer");
                        let qrCodeElement = document.getElementById("qrCode");
                        // Function to open the order form modal
                        function openOrderForm() {
                            modal.style.display = "block";
                        }
                        // Function to close the order form modal
                        function closeOrderForm() {
                            modal.style.display = "none";
                            qrCodeContainer.style.display = "none"; // Hide QR Code on close
                            qrCodeElement.innerHTML = ""; // Clear QR Code content
                        }
                        // Function to calculate total price based on quantity
                        function calculateTotal() {
                            let quantity = document.getElementById("quantity").value;
                            let totalPrice = pricePerUnit * quantity;
                            totalPriceElement.innerText = totalPrice;
                        }
                        // Event listener for quantity change
                        document.getElementById("quantity").addEventListener("input", calculateTotal);
                        // Function to handle payment method changes
                        function handlePaymentMethod() {
                            let paymentMethod = document.getElementById("paymentMethod").value;
                            if (paymentMethod === "phonepay") {
                                let total = totalPriceElement.innerText;
                                qrCodeContainer.style.display = "block";
                                generateQRCode(upi://pay?pa=ReceiverUPIID@bank&pn=ReceiverName&am=${total}&cu=INR);
                            } else {
                                qrCodeContainer.style.display = "none";
                                qrCodeElement.innerHTML = ""; // Clear QR Code
                            }
                        }

                        // Function to generate a QR code
                        function generateQRCode(data) {
                            qrCodeElement.innerHTML = ""; // Clear any existing QR code
                            new QRCode(qrCodeElement, {
                                text: data,
                                width: 200,
                                height: 200,
                            });
                        }

                        // Function to generate the bill
                        function generateBill() {
                            let name = document.getElementById("name").value;
                            let email = document.getElementById("email").value;
                            let tableNum = document.getElementById("tableNum").value;
                            let quantity = document.getElementById("quantity").value;
                            let total = totalPriceElement.innerText;
                            let paymentMethod = document.getElementById("paymentMethod").value;

                            if (paymentMethod === "phonepay") {
                                alert(Scan the QR code to complete your payment.);
                            } else {
                                alert(`Thank you ${name} for your order!
                                Email: ${email}
                                Table Number: ${tableNum}
                                Quantity: ${quantity}
                                Total: Rs ${total}
                                Payment Method: ${paymentMethod}
                                
                                Your order will be processed shortly.`);
                            }
                        }
                        // Function to submit the order
                        function submitOrder() {
                            let form = document.getElementById("orderFormDetails");
                            let paymentMethod = document.getElementById("paymentMethod").value;
                            let isFormValid = form.checkValidity();

                            if (paymentMethod === "phonepay") {
                                // If PhonePay is selected, prompt to scan QR code
                                alert("Please scan the QR code to complete your payment before submitting.");
                                return; // Stop further execution
                            }

                            if (isFormValid) {
                                // If form is valid and not PhonePay, submit the order
                                alert("Order Submitted Successfully!");
                                closeOrderForm(); // Close the modal
                            } else {
                                // If form is invalid, notify the user
                                alert("Please fill in all required fields.");
                            }
                        }
                    </script>


                    <div class="col-12 col-md-6 col-lg-4 shadow mt-3 mb-3 pb-5">
                        <div class="explore-part-container  pb-3 ">
                            <img src="https://cdn.shopify.com/s/files/1/0524/2113/2440/files/Untitled_design_-_2023-06-09T144444.193.jpg?v=1686302118" class="biriyani-image " />
                            <h1 class="non-veg-heading mt-3 ml-2">Biriyani <span class="heading-span ">4.3
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                    </svg>
                                </span></h1>
                            <p class="para-north">North, Southern, Andhra </p>
                            <p class=" para-north" style="font-weight:bold; color:green;"> Rs 250</p>
                            <button class="button-part-1 order-now-btn" onclick="openOrderForm()">Order Now</button>
                            <button class="button-part-2  add-to-cart1">Add to Cart</button>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4 shadow mt-3 mb-3 pb-5">
                        <div class="explore-part-container pb-3 ">
                            <img src="https://atasteofflavours.com/wp-content/uploads/2021/02/IMG_1608-scaled.jpg" class="biriyani-image " />
                            <h1 class="non-veg-heading mt-3 ml-2">Tandoori <span class="heading-span ">4.3
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                    </svg>
                                </span></h1>
                            <p class="para-north">North, Southern, Andhra </p>
                            <p class=" para-north" style="font-weight:bold; color:green;"> Rs 250</p>
                            <button class="button-part-1 order-now-btn" onclick="openOrderForm()">Order Now</button>
                            <button class="button-part-2  add-to-cart1">Add to Cart</button>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4 shadow mt-3 mb-3 pb-5">
                        <div class="explore-part-container pb-3 ">
                            <img src="https://pikturenama.com/wp-content/uploads/2021/04/Low-res-Andhra-Pepper-Chicken-5.jpg" class="biriyani-image " />
                            <h1 class="non-veg-heading mt-3 ml-2">Chicken Pepper Dry<span class="heading-span ">4.3
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                    </svg>
                                </span></h1>
                            <p class="para-north">North, Southern, Andhra </p>
                            <p class=" para-north" style="font-weight:bold; color:green;"> Rs 250</p>
                            <button class="button-part-1 order-now-btn" onclick="openOrderForm()">Order Now</button>
                            <button class="button-part-2  add-to-cart1">Add to Cart</button>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4 shadow mt-3 mb-3 pb-5">
                        <div class="explore-part-container pb-3 ">
                            <img src="https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEhOlmtxjgICQa-aKeXotMhrdw853gM9irtYEazQ6rGZPJa-jLjXA1Z6XCwNF5My5AYs1Gn9v_fFpuJOq03tAuR4huSar9MDgt5ngi5G5W3GhHbG6fSqxVgqVj9IWQTU3w0fdS9d58_CWR3mzBYRkTV1_oXlsWrv8KkUlO7QiYk1m14EN3T9QC1VuBvyfQ/w1200-h630-p-k-no-nu/Adobe_Express_20230228_1656140_1.png" class="biriyani-image " />
                            <h1 class="non-veg-heading mt-3 ml-2"> Chicken Lollipop <span class="heading-span ">4.3
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                    </svg>
                                </span></h1>
                            <p class="para-north">North, Southern, Andhra </p>
                            <p class=" para-north" style="font-weight:bold; color:green;"> Rs 250</p>
                            <button class="button-part-1 order-now-btn" onclick="openOrderForm()">Order Now</button>
                            <button class="button-part-2  add-to-cart1">Add to Cart</button>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4 shadow mt-3 mb-3 pb-5">
                        <div class="explore-part-container  pb-3 ">
                            <img src="https://www.tastingtable.com/img/gallery/the-untraditional-meat-thats-popular-for-israeli-shawarma/l-intro-1672315523.jpg" class="biriyani-image " />
                            <h1 class="non-veg-heading mt-3 ml-2">Roll <span class="heading-span ">4.3
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                    </svg>
                                </span></h1>
                            <p class="para-north">North, Southern, Andhra </p>
                            <p class=" para-north" style="font-weight:bold; color:green;"> Rs 250</p>
                            <button class="button-part-1 order-now-btn" onclick="openOrderForm()">Order Now</button>
                            <button class="button-part-2  add-to-cart1">Add to Cart</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="notification" id="cartNotification">
        Item added to cart. <span class="cart-link" onclick="viewCart()">View Cart</span>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const addToCartButtons = document.querySelectorAll(".add-to-cart");
            const notification = document.getElementById("cartNotification");

            addToCartButtons.forEach(button => {
                button.addEventListener("click", () => {
                    const item = {
                        name: "Hakka Noodles",
                        price: 200, // Add the item's price
                        quantity: 1 // Default quantity
                    };
                    addToCart(item);
                    showNotification();
                });
            });

            function showNotification() {
                notification.style.display = "block";
                setTimeout(() => {
                    notification.style.display = "none";
                }, 3000);
            }

            function addToCart(item) {
                let cart = JSON.parse(localStorage.getItem("cart")) || [];
                cart.push(item);
                localStorage.setItem("cart", JSON.stringify(cart));
            }
        });

        function viewCart() {
            window.location.href = "cart.html"; // Navigate to the cart page
        }
    </script>

    <div id="section3">
        <div>
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <a class="view-heading" onclick="display('sectionHome1')" target="_blank">
                            <svg xmlns="http://www.w3.org/2000/svg" width="23" height="60" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
                            </svg>
                        </a>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4 shadow mt-3 mb-3 pb-5">
                        <div class="explore-part-container  pb-3 ">
                            <img src="https://rasoirani.com/wp-content/uploads/2020/04/veg-hyderabadi-biryani.jpg" class="biriyani-image " />
                            <h1 class="non-veg-heading mt-2">Pallav <span class="heading-span ">4.3
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                    </svg>
                                </span></h1>
                            <p class="para-north">North, Southern, Andhra </p>
                            <p class=" para-north" style="font-weight:bold; color:green;"> Rs 250</p>
                            <button class="button-part-1 order-now-btn" onclick="openOrderForm()">Order Now</button>
                            <button class="button-part-2  add-to-cart1">Add to Cart</button>
                        </div>
                    </div>

                    <div id="orderForm" class="modal">
                        <div class="modal-content">
                            <span class="close" onclick="closeOrderForm()">&times;</span>
                            <h2>Order Form</h2>
                            <form id="orderFormDetails" action="index.php.php" method="POST">
                                <label for="name">Name:</label><br>
                                <input type="text" id="name" name="name" required><br><br>
                            
                                <label for="email">Email:</label><br>
                                <input type="email" id="email" name="email" required><br><br>
                            
                                <label for="tableNum">Table Number (1-10):</label><br>
                                <input type="number" id="tableNum" name="tableNum" min="1" max="10" required><br><br>
                            
                                <label for="quantity">Quantity:</label><br>
                                <input type="number" id="quantity" name="quantity" value="1" min="1" required><br><br>
                            
                                <p>Total Price: Rs <span id="totalPrice">250</span></p>
                            
                                <label for="paymentMethod">Payment Method:</label><br>
                                <select id="paymentMethod" name="paymentMethod" required>
                                    <option value="cash">Cash</option>
                                    <option value="card">Card</option>
                                    <option value="phonepay">PhonePay</option>
                                    <option value="googlepay">Google Pay</option>
                                </select><br><br>
                            
                                <button type="submit">Submit</button>
                            </form>
                            
                            
                        </div>
                    </div>

                    <script>
                        let pricePerUnit = 80; // Price for one quantity
                        let modal = document.getElementById("orderForm");
                        let totalPriceElement = document.getElementById("totalPrice");

                        // Function to open the order form modal
                        function openOrderForm() {
                            modal.style.display = "block";
                        }

                        // Function to close the order form modal
                        function closeOrderForm() {
                            modal.style.display = "none";
                        }

                        // Function to calculate total price based on quantity
                        function calculateTotal() {
                            let quantity = document.getElementById("quantity").value;
                            let totalPrice = pricePerUnit * quantity;
                            totalPriceElement.innerText = totalPrice;
                        }

                        // Event listener for quantity change
                        document.getElementById("quantity").addEventListener("input", calculateTotal);

                        // Function to generate the bill
                        function generateBill() {
                            let name = document.getElementById("name").value;
                            let email = document.getElementById("email").value;
                            let tableNum = document.getElementById("tableNum").value;
                            let quantity = document.getElementById("quantity").value;
                            let total = totalPriceElement.innerText;
                            let paymentMethod = document.getElementById("paymentMethod").value;

                            // If PhonePay is selected, redirect to PhonePay
                            if (paymentMethod === "phonepay") {
                                window.location.href = "phonepay://pay?amount=" + total + "&receiver=ReceiverName"; // Sample PhonePay URL
                            }

                            alert(`Thank you ${name} for your order!
    Email: ${email}
    Table Number: ${tableNum}
    Quantity: ${quantity}
    Total: Rs ${total}
    Payment Method: ${paymentMethod}
    
    Your order will be processed shortly.`);
                        }

                        // Function to submit the order
                        function submitOrder() {
                            let form = document.getElementById("orderFormDetails");
                            if (form.checkValidity()) {
                                alert("Order Submitted Successfully!");
                                closeOrderForm();
                            } else {
                                alert("Please fill in all fields.");
                            }
                        }

                        // Function to cancel the order
                        function cancelOrder() {
                            closeOrderForm();
                        }
                    </script>
                    <div class="col-12 col-md-6 col-lg-4 shadow mt-3 mb-3 pb-5">
                        <div class="explore-part-container  pb-3 ">
                            <img src="https://www.shikararestaurant.com/wp-content/uploads/2018/01/masla-dosa.jpg" class="biriyani-image " />
                            <h1 class="non-veg-heading mt-3 ">Dosa <span class="heading-span ">4.3
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                    </svg>
                                </span></h1>
                            <p class="para-north">North, Southern, Andhra </p>
                            <p class=" para-north" style="font-weight:bold; color:green;"> Rs 250</p>
                            <button class="button-part-1 order-now-btn" onclick="openOrderForm('orderFormSection1')">Order Now</button>
                            <button class="button-part-2 add-to-cart1">Add to Cart</button>
                        </div>
                    </div>

                    <div id="orderFormSection1" class="modal">
                        <div class="modal-content">
                            <span class="close" onclick="closeOrderForm('orderFormSection1')">&times;</span>
                            <h2>Order Form</h2>
                            <form id="orderFormDetails" action="index.php" method="POST">
    <label for="name">Name:</label><br>
    <input type="text" id="name" name="name" required><br><br>

    <label for="email">Email:</label><br>
    <input type="email" id="email" name="email" required><br><br>

    <label for="tableNum">Table Number (1-10):</label><br>
    <input type="number" id="tableNum" name="tableNum" min="1" max="10" required><br><br>

    <label for="quantity">Quantity:</label><br>
    <input type="number" id="quantity" name="quantity" value="1" min="1" required><br><br>

    <p>Total Price: Rs <span id="totalPrice">250</span></p>

    <label for="paymentMethod">Payment Method:</label><br>
    <select id="paymentMethod" name="paymentMethod" required>
        <option value="cash">Cash</option>
        <option value="card">Card</option>
        <option value="phonepay">PhonePay</option>
        <option value="googlepay">Google Pay</option>
    </select><br><br>

    <button type="submit">Submit</button>
</form>

                        </div>
                    </div>
                    <script>
                        let pricePerUnit = 250; // Price for one quantity

                        // Function to open the order form modal
                        function openOrderForm(modalId) {
                            let modal = document.getElementById(modalId);
                            modal.style.display = "block";
                            calculateTotal(modalId); // Recalculate the price when the form opens
                        }

                        // Function to close the order form modal
                        function closeOrderForm(modalId) {
                            let modal = document.getElementById(modalId);
                            modal.style.display = "none";
                        }

                        // Function to calculate total price based on quantity
                        function calculateTotal(modalId) {
                            let quantity = document.getElementById("quantity" + modalId).value;
                            let totalPrice = pricePerUnit * quantity;
                            document.getElementById("totalPrice" + modalId).innerText = totalPrice;
                        }

                        // Event listener for quantity change (specific to each modal)
                        function addQuantityListener(modalId) {
                            document.getElementById("quantity" + modalId).addEventListener("input", function() {
                                calculateTotal(modalId);
                            });
                        }

                        // Function to generate the bill
                        function generateBill(modalId) {
                            let name = document.getElementById("name" + modalId).value;
                            let email = document.getElementById("email" + modalId).value;
                            let tableNum = document.getElementById("tableNum" + modalId).value;
                            let quantity = document.getElementById("quantity" + modalId).value;
                            let total = document.getElementById("totalPrice" + modalId).innerText;
                            let paymentMethod = document.getElementById("paymentMethod" + modalId).value;

                            // If PhonePay is selected, redirect to PhonePay
                            if (paymentMethod === "phonepay") {
                                window.location.href = "phonepay://pay?amount=" + total + "&receiver=ReceiverName"; // Sample PhonePay URL
                            }

                            alert(`Thank you ${name} for your order!
    Email: ${email}
    Table Number: ${tableNum}
    Quantity: ${quantity}
    Total: Rs ${total}
    Payment Method: ${paymentMethod}
    
    Your order will be processed shortly.`);
                        }

                        // Function to submit the order
                        function submitOrder(modalId) {
                            let form = document.getElementById("orderFormDetails" + modalId);
                            if (form.checkValidity()) {
                                alert("Order Submitted Successfully!");
                                closeOrderForm(modalId);
                            } else {
                                alert("Please fill in all fields.");
                            }
                        }

                        // Function to cancel the order
                        function cancelOrder(modalId) {
                            closeOrderForm(modalId);
                        }

                        // Add quantity listener for each modal instance
                        // For Section 1
                        addQuantityListener('Section1');
                        // For Section 2, repeat the above line with a different section ID if you have another section
                    </script>

                    <div class="col-12 col-md-6 col-lg-4 shadow mt-3 mb-3 pb-5">
                        <div class="explore-part-container pb-3 ">
                            <img src="https://pipingpotcurry.com/wp-content/uploads/2017/03/Vegetable-Sambar-Instant-Pot-Piping-Pot-Curry.jpg" class="biriyani-image " />
                            <h1 class="non-veg-heading mt-3">Idly Sambar <span class="heading-span ">4.3
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                    </svg>
                                </span></h1>
                            <p class="para-north">North, Southern, Andhra </p>
                            <p class=" para-north" style="font-weight:bold; color:green;"> Rs 250</p>
                            <button class="button-part-1 order-now-btn" onclick="openOrderForm()">Order Now</button>
                            <button class="button-part-2  add-to-cart1">Add to Cart</button>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4 shadow mt-3 mb-3 pb-5">
                        <div class="explore-part-container pb-3 ">
                            <img src="https://bonmasala.com/wp-content/uploads/2022/11/puliyogare-recipe-BoN.jpg" class="biriyani-image " />
                            <h1 class="non-veg-heading mt-3">Puliyogre<span class="heading-span ">4.3
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                    </svg>
                                </span></h1>
                            <p class="para-north">North, Southern, Andhra </p>
                            <p class=" para-north" style="font-weight:bold; color:green;"> Rs 250</p>
                            <button class="button-part-1 order-now-btn" onclick="openOrderForm()">Order Now</button>
                            <button class="button-part-2  add-to-cart1">Add to Cart</button>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4 shadow mt-3 mb-3 pb-5">
                        <div class="explore-part-container pb-3 ">
                            <img src="https://www.shutterstock.com/image-photo/homemade-masala-fried-puri-poori-260nw-1079957924.jpg" class="biriyani-image " />
                            <h1 class="non-veg-heading mt-3"> Puri <span class="heading-span ">4.3
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                    </svg>
                                </span></h1>
                            <p class="para-north">North, Southern, Andhra </p>
                            <p class=" para-north" style="font-weight:bold; color:green;"> Rs 250</p>
                            <button class="button-part-1 order-now-btn" onclick="openOrderForm()">Order Now</button>
                            <button class="button-part-2  add-to-cart1">Add to Cart</button>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4 shadow mt-3 mb-3 pb-5">
                        <div class="explore-part-container  pb-3 ">
                            <img src="https://kj1bcdn.b-cdn.net/media/81875/malabar-paratha.jpg" class="biriyani-image " />
                            <h1 class="non-veg-heading mt-3">Parota <span class="heading-span ">4.3
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                    </svg>
                                </span></h1>
                            <p class="para-north">North, Southern, Andhra </p>
                            <p class=" para-north" style="font-weight:bold; color:green;"> Rs 250</p>
                            <button class="button-part-1 order-now-btn" onclick="openOrderForm()">Order Now</button>
                            <button class="button-part-2  add-to-cart1">Add to Cart</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const addToCartButtons = document.querySelectorAll(".add-to-cart1");
            const notification = document.getElementById("cartNotification");

            addToCartButtons.forEach(button => {
                button.addEventListener("click", () => {
                    const item = {
                        name: "Hakka Noodles",
                        price: 200, // Add the item's price
                        quantity: 1 // Default quantity
                    };
                    addToCart(item);
                    showNotification();
                });
            });

            function showNotification() {
                notification.style.display = "block";
                setTimeout(() => {
                    notification.style.display = "none";
                }, 3000);
            }

            function addToCart(item) {
                let cart = JSON.parse(localStorage.getItem("cart")) || [];
                cart.push(item);
                localStorage.setItem("cart", JSON.stringify(cart));
            }
        });

        function viewCart() {
            window.location.href = "cart.html"; // Navigate to the cart page
        }
    </script>

    <div id="section4">
        <div>
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <a class="view-heading" onclick="display('sectionHome1')" target="_blank">
                            <svg xmlns="http://www.w3.org/2000/svg" width="23" height="60" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
                            </svg>
                        </a>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4 shadow mt-3 mb-3 pb-5">
                        <div class="explore-part-container  pb-3 ">
                            <img src="https://www.themixer.com/en-us/wp-content/uploads/sites/2/2022/11/391.-Mudslide-Cocktail-Recipe_Featured-Image_Canva_Mizina.jpg" class="biriyani-image " />
                            <h1 class="non-veg-heading mt-3 ml-2">Classic Mudslide<span class="heading-span ">4.3
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                    </svg>
                                </span></h1>
                            <p class="para-north">North, Southern, Andhra </p>
                            <p class=" para-north" style="font-weight:bold; color:green;"> Rs 250</p>
                            <button class="button-part-1 order-now-btn" onclick="openOrderForm()">Order Now</button>
                            <button class="button-part-2  add-to-cart1">Add to Cart</button>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4 shadow mt-3 mb-3 pb-5">
                        <div class="explore-part-container  pb-3 ">
                            <img src="https://www.mashed.com/img/gallery/chocolate-martini-cocktail-recipe/intro-1660575728.jpg" class="biriyani-image " />
                            <h1 class="non-veg-heading mt-3 ml-2">Chocolate Martini<span class="heading-span ">4.3
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                    </svg>
                                </span></h1>
                            <p class="para-north">North, Southern, Andhra </p>
                            <p class=" para-north" style="font-weight:bold; color:green;"> Rs 250</p>
                            <button class="button-part-1 order-now-btn" onclick="openOrderForm()">Order Now</button>
                            <button class="button-part-2  add-to-cart1">Add to Cart</button>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4 shadow mt-3 mb-3 pb-5">
                        <div class="explore-part-container pb-3 ">
                            <img src="https://ichef.bbci.co.uk/food/ic/food_16x9_832/recipes/white_russian_36079_16x9.jpg" class="biriyani-image " />
                            <h1 class="non-veg-heading mt-3 ml-2">White Russian <span class="heading-span ">4.3
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                    </svg>
                                </span></h1>
                            <p class="para-north">North, Southern, Andhra </p>
                            <p class=" para-north" style="font-weight:bold; color:green;"> Rs 250</p>
                            <button class="button-part-1 order-now-btn" onclick="openOrderForm()">Order Now</button>
                            <button class="button-part-2  add-to-cart1">Add to Cart</button>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4 shadow mt-3 mb-3 pb-5">
                        <div class="explore-part-container pb-3 ">
                            <img src="https://www.thespruceeats.com/thmb/VCPHQWd8eoN7-rAIuk0K64ZUv7U=/2746x1831/filters:fill(auto,1)/chocolate-mousse-recipe-1375149-hero-01-d3bae0e0fca6401983596d717cf4e309.jpg" class="biriyani-image " />
                            <h1 class="non-veg-heading mt-3 ml-2">Mousse<span class="heading-span ">4.3
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                    </svg>
                                </span></h1>
                            <p class="para-north">North, Southern, Andhra </p>
                            <p class=" para-north" style="font-weight:bold; color:green;"> Rs 250</p>
                            <button class="button-part-1 order-now-btn" onclick="openOrderForm()">Order Now</button>
                            <button class="button-part-2  add-to-cart1">Add to Cart</button>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4 shadow mt-3 mb-3 pb-5">
                        <div class="explore-part-container pb-3 ">
                            <img src="https://wallpapercrafter.com/desktop/121702-sweets-food-bowls-ice-cream-berries-fruit.jpg" class="biriyani-image " />
                            <h1 class="non-veg-heading mt-3 ml-2"> Ice cream<span class="heading-span ">4.3
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                    </svg>
                                </span></h1>
                            <p class="para-north">North, Southern, Andhra </p>
                            <p class=" para-north" style="font-weight:bold; color:green;"> Rs 250</p>
                            <button class="button-part-1 order-now-btn" onclick="openOrderForm()">Order Now</button>
                            <button class="button-part-2  add-to-cart1">Add to Cart</button>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4 shadow mt-3 mb-3 pb-5">
                        <div class="explore-part-container  pb-3 ">
                            <img src="http://www.baltana.com/files/wallpapers-18/Cookies-HD-Desktop-Wallpaper-46632.jpg" class="biriyani-image " />
                            <h1 class="non-veg-heading mt-3 ml-2">Cookies<span class="heading-span ">4.3
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                    </svg>
                                </span></h1>
                            <p class="para-north">North, Southern, Andhra </p>
                            <p class=" para-north" style="font-weight:bold; color:green;"> Rs 250</p>
                            <button class="button-part-1 order-now-btn" onclick="openOrderForm()">Order Now</button>
                            <button class="button-part-2  add-to-cart1">Add to Cart</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const addToCartButtons = document.querySelectorAll(".add-to-cart2");
            const notification = document.getElementById("cartNotification");

            addToCartButtons.forEach(button => {
                button.addEventListener("click", () => {
                    const item = {
                        name: "Hakka Noodles",
                        price: 200, // Add the item's price
                        quantity: 1 // Default quantity
                    };
                    addToCart(item);
                    showNotification();
                });
            });

            function showNotification() {
                notification.style.display = "block";
                setTimeout(() => {
                    notification.style.display = "none";
                }, 3000);
            }

            function addToCart(item) {
                let cart = JSON.parse(localStorage.getItem("cart")) || [];
                cart.push(item);
                localStorage.setItem("cart", JSON.stringify(cart));
            }
        });

        function viewCart() {
            window.location.href = "cart.html"; // Navigate to the cart page
        }
    </script>

    <div id="section5">
        <div>
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <a class="view-heading" onclick="display('sectionHome1')">
                            <svg xmlns="http://www.w3.org/2000/svg" width="23" height="60" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
                            </svg>
                        </a>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4 shadow mt-3 mb-3 pb-5">
                        <div class="explore-part-container  pb-3 ">
                            <img src="http://3.bp.blogspot.com/-qLHtp6EvUbI/UqNU7sLJpxI/AAAAAAAABSQ/DDAmdR0baho/s1600/2tomato+soup.jpg" class="biriyani-image " />
                            <h1 class="non-veg-heading mt-3 ml-2">Tomato Soup <span class="heading-span ">4.3
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                    </svg>
                                </span></h1>
                            <p class="para-north">North, Southern, Andhra </p>
                            <p class=" para-north" style="font-weight:bold; color:green;"> Rs 250</p>
                            <button class="button-part-1 order-now-btn" onclick="openOrderForm()">Order Now</button>
                            <button class="button-part-2  add-to-cart1">Add to Cart</button>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4 shadow mt-3 mb-3 pb-5">
                        <div class="explore-part-container  pb-3 ">
                            <img src="https://www.drweil.com/wp-content/uploads/2016/12/diet-nutrition_recipes_roasted-vegetable-soup_2725x1804_000071339861.jpg" class="biriyani-image " />
                            <h1 class="non-veg-heading mt-3 ml-2">Vegetable Soups <span class="heading-span ">4.3
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                    </svg>
                                </span></h1>
                            <p class="para-north">North, Southern, Andhra </p>
                            <p class=" para-north" style="font-weight:bold; color:green;"> Rs 250</p>
                            <button class="button-part-1 order-now-btn" onclick="openOrderForm()">Order Now</button>
                            <button class="button-part-2  add-to-cart1">Add to Cart</button>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4 shadow mt-3 mb-3 pb-5">
                        <div class="explore-part-container pb-3 ">
                            <img src="https://www.allrecipes.com/thmb/UeFtapHyGFBo4Lx-72GxgjrOGnk=/1500x0/filters:no_upscale():max_bytes(150000):strip_icc()/13978-lentil-soup-DDMFS-4x3-edfa47fc6b234e6b8add24d44c036d43.jpg" class="biriyani-image " />
                            <h1 class="non-veg-heading mt-3 ml-2">Lentil Soup<span class="heading-span ">4.3
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                    </svg>
                                </span></h1>
                            <p class="para-north">North, Southern, Andhra </p>
                            <p class=" para-north" style="font-weight:bold; color:green;"> Rs 250</p>
                            <button class="button-part-1 order-now-btn" onclick="openOrderForm()">Order Now</button>
                            <button class="button-part-2  add-to-cart1">Add to Cart</button>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4 shadow mt-3 mb-3 pb-5">
                        <div class="explore-part-container pb-3 ">
                            <img src="https://www.unileverfoodsolutions.lk/dam/global-ufs/mcos/meps/sri-lanka/calcmenu/recipes/LK-recipes/general/chicken-and-sweet-corn-soup/main-header.jpg" class="biriyani-image " />
                            <h1 class="non-veg-heading mt-3 ml-2">Sweet corn soup <span class="heading-span ">4.3
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                    </svg>
                                </span></h1>
                            <p class="para-north">North, Southern, Andhra </p>
                            <p class=" para-north" style="font-weight:bold; color:green;"> Rs 250</p>
                            <button class="button-part-1 order-now-btn" onclick="openOrderForm()">Order Now</button>
                            <button class="button-part-2  add-to-cart1">Add to Cart</button>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4 shadow mt-3 mb-3 pb-5">
                        <div class="explore-part-container pb-3 ">
                            <img src="https://thumbs.dreamstime.com/b/broccoli-soup-tasty-wooden-background-43700270.jpg" class="biriyani-image " />
                            <h1 class="non-veg-heading mt-3 ml-2"> Broccoli soup<span class="heading-span ">4.3
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                    </svg>
                                </span></h1>
                            <p class="para-north">North, Southern, Andhra </p>
                            <p class=" para-north" style="font-weight:bold; color:green;"> Rs 250</p>
                            <button class="button-part-1 order-now-btn" onclick="openOrderForm()">Order Now</button>
                            <button class="button-part-2  add-to-cart1">Add to Cart</button>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4 shadow mt-3 mb-3 pb-5">
                        <div class="explore-part-container  pb-3 ">
                            <img src="https://www.preparedfoodphotos.com/wp-content/uploads/FrenchOnionSoup001_ADL-2.jpg" class="biriyani-image " />
                            <h1 class="non-veg-heading mt-3 ml-2">French Onion soup <span class="heading-span ">4.3
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                    </svg>
                                </span></h1>
                            <p class="para-north">North, Southern, Andhra </p>
                            <p class=" para-north" style="font-weight:bold; color:green;"> Rs 250</p>
                            <button class="button-part-1 order-now-btn" onclick="openOrderForm()">Order Now</button>
                            <button class="button-part-2  add-to-cart1">Add to Cart</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const addToCartButtons = document.querySelectorAll(".add-to-cart3");
            const notification = document.getElementById("cartNotification");

            addToCartButtons.forEach(button => {
                button.addEventListener("click", () => {
                    const item = {
                        name: "Hakka Noodles",
                        price: 200, // Add the item's price
                        quantity: 1 // Default quantity
                    };
                    addToCart(item);
                    showNotification();
                });
            });

            function showNotification() {
                notification.style.display = "block";
                setTimeout(() => {
                    notification.style.display = "none";
                }, 3000);
            }

            function addToCart(item) {
                let cart = JSON.parse(localStorage.getItem("cart")) || [];
                cart.push(item);
                localStorage.setItem("cart", JSON.stringify(cart));
            }
        });

        function viewCart() {
            window.location.href = "cart.html"; // Navigate to the cart page
        }
    </script>

    <div id="section6">
        <div>
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <a class="view-heading" onclick="display('sectionHome1')">
                            <svg xmlns="http://www.w3.org/2000/svg" width="23" height="60" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
                            </svg>
                        </a>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4 shadow mt-3 mb-3 pb-5">
                        <div class="explore-part-container  pb-3 ">
                            <img src="https://4.bp.blogspot.com/-QgO4sHd7Dl4/WIpnATPabII/AAAAAAAACkA/80ehgUy-9RAgnL1-2JDCs2nBEf7CQoFngCLcB/s1600/Butter%2BChicken%2BRecipe.JPG" class="biriyani-image " />
                            <h1 class="non-veg-heading mt-3 ml-2">Butter Chicken <span class="heading-span ">4.3
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                    </svg>
                                </span></h1>
                            <p class="para-north">North, Southern, Andhra </p>
                            <p class=" para-north" style="font-weight:bold; color:green;"> Rs 250</p>
                            <button class="button-part-1 order-now-btn" onclick="openOrderForm()">Order Now</button>
                            <button class="button-part-2  add-to-cart1">Add to Cart</button>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4 shadow mt-3 mb-3 pb-5">
                        <div class="explore-part-container  pb-3 ">
                            <img src="https://www.seriouseats.com/thmb/HaBfNjG3Fr61qU6_1h9lHY_3Yl0=/1500x1125/filters:fill(auto,1)/__opt__aboutcom__coeus__resources__content_migration__serious_eats__seriouseats.com__recipes__images__2016__03__20160328-channa-masala-recipe-6-ae4913c04d5b43e9acef2917a74aa5fc.jpg" class="biriyani-image " />
                            <h1 class="non-veg-heading mt-3 ml-2">Veg Chana Masala <span class="heading-span ">4.3
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                    </svg>
                                </span></h1>
                            <p class="para-north">North, Southern, Andhra </p>
                            <p class=" para-north" style="font-weight:bold; color:green;"> Rs 250</p>
                            <button class="button-part-1 order-now-btn" onclick="openOrderForm()">Order Now</button>
                            <button class="button-part-2  add-to-cart1">Add to Cart</button>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4 shadow mt-3 mb-3 pb-5">
                        <div class="explore-part-container pb-3 ">
                            <img src="https://templeofspices.com.au/wp-content/uploads/2020/03/Vegetable-Korma-Curry-4-scaled.jpg" class="biriyani-image " />
                            <h1 class="non-veg-heading mt-3 ml-2">Veg Korma <span class="heading-span ">4.3
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                    </svg>
                                </span></h1>
                            <p class="para-north">North, Southern, Andhra </p>
                            <p class=" para-north" style="font-weight:bold; color:green;"> Rs 250</p>
                            <button class="button-part-1 order-now-btn" onclick="openOrderForm()">Order Now</button>
                            <button class="button-part-2  add-to-cart1">Add to Cart</button>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4 shadow mt-3 mb-3 pb-5">
                        <div class="explore-part-container pb-3 ">
                            <img src="https://madscookhouse.com/wp-content/uploads/2020/10/Paneer-Butter-Masala-Nut-Free.jpg" class="biriyani-image " />
                            <h1 class="non-veg-heading mt-3 ml-2">Paneer Masala<span class="heading-span ">4.3
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                    </svg>
                                </span></h1>
                            <p class="para-north">North, Southern, Andhra </p>
                            <p class=" para-north" style="font-weight:bold; color:green;"> Rs 250</p>
                            <button class="button-part-1 order-now-btn" onclick="openOrderForm()">Order Now</button>
                            <button class="button-part-2  add-to-cart1">Add to Cart</button>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4 shadow mt-3 mb-3 pb-5">
                        <div class="explore-part-container pb-3 ">
                            <img src="https://i.ytimg.com/vi/FtCdvlVhzds/maxresdefault.jpg" class="biriyani-image " />
                            <h1 class="non-veg-heading mt-3 ml-2"> Egg Curry <span class="heading-span ">4.3
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                    </svg>
                                </span></h1>
                            <p class="para-north">North, Southern, Andhra </p>
                            <p class=" para-north" style="font-weight:bold; color:green;"> Rs 250</p>
                            <button class="button-part-1 order-now-btn" onclick="openOrderForm()">Order Now</button>
                            <button class="button-part-2  add-to-cart1">Add to Cart</button>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4 shadow mt-3 mb-3 pb-5">
                        <div class="explore-part-container  pb-3 ">
                            <img src="https://i.ytimg.com/vi/mJ8kw-5ifzE/maxresdefault.jpg" class="biriyani-image " />
                            <h1 class="non-veg-heading mt-3 ml-2">Mutton Curry<span class="heading-span ">4.3
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                    </svg>
                                </span></h1>
                            <p class="para-north">North, Southern, Andhra </p>
                            <p class=" para-north" style="font-weight:bold; color:green;"> Rs 250</p>
                            <button class="button-part-1 ">Order Now</button>
                            <button class="button-part-2  add-to-cart1">Add to Cart</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const addToCartButtons = document.querySelectorAll(".add-to-cart4");
            const notification = document.getElementById("cartNotification");

            addToCartButtons.forEach(button => {
                button.addEventListener("click", () => {
                    const item = {
                        name: "Hakka Noodles",
                        price: 200, // Add the item's price
                        quantity: 1 // Default quantity
                    };
                    addToCart(item);
                    showNotification();
                });
            });

            function showNotification() {
                notification.style.display = "block";
                setTimeout(() => {
                    notification.style.display = "none";
                }, 3000);
            }

            function addToCart(item) {
                let cart = JSON.parse(localStorage.getItem("cart")) || [];
                cart.push(item);
                localStorage.setItem("cart", JSON.stringify(cart));
            }
        });

        function viewCart() {
            window.location.href = "cart.html"; // Navigate to the cart page
        }
    </script>

    <div id="section7">
        <div>
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <a class="view-heading" onclick="display('sectionHome1')">
                            <svg xmlns="http://www.w3.org/2000/svg" width="23" height="60" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
                            </svg>
                        </a>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4 shadow mt-3 mb-3 pb-5">
                        <div class="explore-part-container  pb-3 ">
                            <img src="https://img-global.cpcdn.com/recipes/0ae7c7664f915ab6/1502x1064cq70/veg-hakka-noodles-recipe-main-photo.jpg" class="biriyani-image " />
                            <h1 class="non-veg-heading mt-3 ">Hakka Noodles <span class="heading-span ">4.3
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                    </svg>
                                </span></h1>
                            <p class="para-north">North, Southern, Andhra </p>
                            <p class=" para-north" style="font-weight:bold; color:green;"> Rs 250</p>
                            <button class="button-part-1 ">Order Now</button>
                            <button class="button-part-2  add-to-cart1">Add to Cart</button>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4 shadow mt-3 mb-3 pb-5">
                        <div class="explore-part-container pb-3 ">
                            <img src="https://jackslobodian.com/wp-content/uploads/2021/03/Vegetable-Vegan-Chow-Mein-2.jpg" class="biriyani-image " />
                            <h1 class="non-veg-heading mt-3 ">Veg Noodles <span class="heading-span ">4.3
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                    </svg>
                                </span></h1>
                            <p class="para-north">North, Southern, Andhra </p>
                            <p class=" para-north" style="font-weight:bold; color:green;"> Rs 250</p>
                            <button class="button-part-1 ">Order Now</button>
                            <button class="button-part-2  add-to-cart1">Add to Cart</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const addToCartButtons = document.querySelectorAll(".add-to-cart5");
            const notification = document.getElementById("cartNotification");

            addToCartButtons.forEach(button => {
                button.addEventListener("click", () => {
                    const item = {
                        name: "Hakka Noodles",
                        price: 200, // Add the item's price
                        quantity: 1 // Default quantity
                    };
                    addToCart(item);
                    showNotification();
                });
            });

            function showNotification() {
                notification.style.display = "block";
                setTimeout(() => {
                    notification.style.display = "none";
                }, 3000);
            }

            function addToCart(item) {
                let cart = JSON.parse(localStorage.getItem("cart")) || [];
                cart.push(item);
                localStorage.setItem("cart", JSON.stringify(cart));
            }
        });

        function viewCart() {
            window.location.href = "cart.html"; // Navigate to the cart page
        }
    </script>

    <script type="text/javascript" src="https://assets.ccbp.in/frontend/static-website/ccbp-ui-kit.js">
    </script>

</body>
</html>