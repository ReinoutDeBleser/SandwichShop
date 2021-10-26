<?php
//this line makes PHP behave in a more strict way
declare(strict_types=1);

//we are going to use session variables, so we need to enable sessions
session_start();
//
function whatIsHappening() {
    echo '<h2>$_GET</h2>';
    var_dump($_GET);
    echo '<h2>$_POST</h2>';
    var_dump($_POST);
    echo '<h2>$_COOKIE</h2>';
    var_dump($_COOKIE);
    echo '<h2>$_SESSION</h2>';
    var_dump($_SESSION);
}

//your products with their price.
$products =  [
    ['name' => 'Club Ham', 'price' => 3.20],
    ['name' => 'Club Cheese', 'price' => 3],
    ['name' => 'Club Cheese & Ham', 'price' => 4],
    ['name' => 'Club Chicken', 'price' => 4],
    ['name' => 'Club Salmon', 'price' => 5]
];

switch ($_GET["food"]) {
    case ("1"): {
        $products =  [
            ['name' => 'Club Ham', 'price' => 3.20],
            ['name' => 'Club Cheese', 'price' => 3],
            ['name' => 'Club Cheese & Ham', 'price' => 4],
            ['name' => 'Club Chicken', 'price' => 4],
            ['name' => 'Club Salmon', 'price' => 5]
        ];
        break;
    }
    case ("0"): {
        $products =  [
            ['name' => 'Cola', 'price' => 2],
            ['name' => 'Fanta', 'price' => 2],
            ['name' => 'Sprite', 'price' => 2],
            ['name' => 'Ice-tea', 'price' => 3],
        ];
        break;
    }
    default:{
        $products =  [
            ['name' => 'Club Ham', 'price' => 3.20],
            ['name' => 'Club Cheese', 'price' => 3],
            ['name' => 'Club Cheese & Ham', 'price' => 4],
            ['name' => 'Club Chicken', 'price' => 4],
            ['name' => 'Club Salmon', 'price' => 5]
        ];
    }

}



$email = $emailErr = "";

if ($_SESSION["email"] !== "") {
    $email = $_SESSION["email"];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["email"])) {
        echo $emailErr = '<div class="alert alert-primary" role="alert"> Email is required</div>';
    } else {
        $email = $_POST["email"];
        $_SESSION["email"]= $email;
        // check if e-mail address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo $emailErr = '<div class="alert alert-primary" role="alert">Invalid email format </div>';
        }
    }
}

$street = $streetErr = "";

if ($_SESSION["street"] !== ""){
    $street = $_SESSION["street"];
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["street"])) {
        echo $streetErr = '<div class="alert alert-primary" role="alert"> Street is required </div>';
    } else {
        $street = $_POST["street"];
        $_SESSION["street"] = $street;
        // check if e-mail address is well-formed
        if (!preg_match('/^[\p{L} ]+$/u', $street)){
            echo $streetErr = '<div class="alert alert-primary" role="alert"> Invalid street format </div>';
        }
    }
}

$city = $cityErr = "";

if ($_SESSION["city"] !== ""){
    $city = $_SESSION["city"];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["city"])) {
        echo $cityErr = '<div class="alert alert-primary" role="alert"> City is required </div>';

    } else {
        $city = $_POST["city"];
        $_SESSION["city"] = $city;
        // check if city address is well-formed
        if (!preg_match('/^[\p{L} ]+$/u', $city)){
           echo $cityErr = '<div class="alert alert-primary" role="alert"> Invalid city format </div>';
        }
    }
}

$streetnumber = $streetnumberErr = "";

if ($_SESSION["streetnumber"] !== ""){
    $streetnumber = $_SESSION["streetnumber"];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["streetnumber"])) {
        echo $streetnumberErr = '<div class="alert alert-primary" role="alert"> Streetnumber is required <br></div>';

    } else {
        $streetnumber= $_POST["streetnumber"];
        $_SESSION["streetnumber"] = $streetnumber;
        // check if e-mail address is well-formed
        if (!filter_var($streetnumber, FILTER_SANITIZE_NUMBER_INT)) {
            echo $streetnumberErr = '<div class="alert alert-primary" role="alert"> Invalid streetnumber format </div>';
        }
    }
}
$zipcode = $zipcodeErr = "";

if ($_SESSION["zipcode"] !== ""){
    $zipcode = $_SESSION["zipcode"];
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["zipcode"])) {
        echo $zipcodeErr = '<div class="alert alert-primary" role="alert"> Zipcode is required </div>';
    } else {
        $zipcode = $_POST["zipcode"];
        $_SESSION["zipcode"] = $zipcode;
        // check if e-mail address is well-formed
        if (!filter_var($zipcode, FILTER_SANITIZE_NUMBER_INT)) {
            echo $zipcodeErr = '<div class="alert alert-primary" role="alert">Invalid zipcode format </div>';        }
    }
}



$valid = "";

if ($_SESSION["totalValue"] !== null) {
    $totalValue = $_SESSION["totalValue"];
}
else {$totalValue = 0;
}
$i = 0;
$addedValue = 0;

//Todo: I am trying to make this work.
// foreach of the elements in the $products-variable which is an array,
// i define an index in a new array product which contains the objects contained in $products as a new variable.
// as such i'm trying to gather the price of the $product when it is checked in the isset $_POST("product[$i]")
// though trying this appears to give issues.

// name="products[echo $i]" is what is written in the form-view. this means that the names of the elements we're trying to refer to are only being made after they've already been checked.
// this means I should probably
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    foreach ($products as $i => $product) {
        if (isset($product)) {
            $productPrice = $product['price'];
            $totalValue += $productPrice;
            $_SESSION['totalValue'] = $totalValue;
        }
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            if (
                                $emailErr === "" &&
                                $streetErr === "" &&
                                $cityErr === "" &&
                                $streetnumberErr === "" &&
                                $zipcodeErr === ""
                            )
                                if (isset($_POST['express_delivery'])){
                                    echo $valid = '<div class="alert alert-primary" role="alert"> Your order has been sent. ETA: 45 minutes </div>';
                                }
                                else {
                                    echo $valid = '<div class="alert alert-primary" role="alert"> Your order has been sent. ETA: 2 hours </div>';
                                }
                            echo $valid = "";
                        }


//with foreach loop using the structure of the checkbox generator to cycle through all checked values
// and returning a 0 value if unchecked so that they are still able to be added to the $_SESSION;

$_SESSION["test"] = "SICCO";
whatIsHappening();

require 'form-view.php';