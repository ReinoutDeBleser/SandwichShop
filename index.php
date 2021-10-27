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

$email = $street = $streetnumber = $city = $zipcode = $valid = "";
$totalValue = $i =  0;


$emailErrReq = '<div class="alert alert-primary" role="alert"> Email is required</div>';
$emailErrInv = '<div class="alert alert-primary" role="alert">Invalid email format </div>';
$streetErrReq = '<div class="alert alert-primary" role="alert"> Street is required </div>';
$streetErrInv = '<div class="alert alert-primary" role="alert"> Invalid street format </div>';
$cityErrReq = '<div class="alert alert-primary" role="alert"> City is required </div>';
$cityErrInv = '<div class="alert alert-primary" role="alert"> Invalid city format </div>';
$streetnumberErrReq = '<div class="alert alert-primary" role="alert"> Streetnumber is required <br></div>';
$streetnumberErrInv = '<div class="alert alert-primary" role="alert"> Invalid streetnumber format </div>';
$zipcodeErrReq = '<div class="alert alert-primary" role="alert"> Zipcode is required </div>';
$zipcodeErrInv = '<div class="alert alert-primary" role="alert">Invalid zipcode format </div>';

$errorsReq = [
    ['name' => 'emailErrReq', 'value' => $emailErrReq],

    ['name' => 'streetErrReq', 'value' => $streetErrReq],

    ['name' => 'cityErrReq', 'value' => $cityErrReq],

    ['name' => 'streetnumberErrReq', 'value' => $streetnumberErrReq],

    ['name' => 'zipcodeErrReq', 'value' => $zipcodeErrReq],

    ];
$errorsInt = [
    ['name' => 'emailErrInv', 'value' => $emailErrInv],
    ['name' => 'streetErrInv', 'value' => $streetErrInv],
    ['name' => 'cityErrInv', 'value' => $cityErrInv],
    ['name' => 'streetnumberErrInv', 'value' => $streetnumberErrInv],
    ['name' => 'zipcodeErrInv', 'value' => $zipcodeErrInv]
];
$array = [];

if (isset($_GET["food"]) && $_GET["food"] === "0") {
    $products = [
        ['name' => 'Cola', 'price' => 2],
        ['name' => 'Fanta', 'price' => 2],
        ['name' => 'Sprite', 'price' => 2],
        ['name' => 'Ice-tea', 'price' => 3],
    ];
} else {
    $products = [
        ['name' => 'Club Ham', 'price' => 3.20],
        ['name' => 'Club Cheese', 'price' => 3],
        ['name' => 'Club Cheese & Ham', 'price' => 4],
        ['name' => 'Club Chicken', 'price' => 4],
        ['name' => 'Club Salmon', 'price' => 5]
    ];
}
//flexible variables created.
$variables = ["email", "street", "city", "streetnumber", "zipcode"];

foreach ($variables as $v)
    if (isset($_SESSION[$v]) && !empty($_SESSION[$v])) {
        $$v = $_SESSION[$v];
    }

if (isset($_SESSION["totalValue"]) && !empty($_SESSION["totalValue"])) {
    $totalValue = $_SESSION["totalValue"];
} else {
    $totalValue = 0;
}
// creative constraint: can't echo errors in index, has to happen in form-view
// figure out how to make it so that if no errors or all fields valid that email gets sent & total value calc'd
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //Validation for email
    foreach ($variables as $w){
        //echo $w;
        if (empty($_POST[$w])) {
            //will throw REQUIRED error if empty
            //how should this be implemented? not really clear to me
            $var = $$w;
            "$".$var."ErrReq";
            echo $wat;
        } else {
            $$w = $_POST[$w];
            $_SESSION[$w] = $$w;
            // check if e-mail address is well-formed
            switch ($w) {
                case "email":
                {if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        //will throw INVALID error if invalid format (or characters?) are used.
                    echo $emailErrInv;
                    $array[] = 'emailErrInv';
                    break;
                }}
                case "street":
                {if (!preg_match('/^[\p{L} ]+$/u', $street)) {
                    echo $streetErrInv;
                    $array[] = 'streetErrInv';
                    break;
                }}
                case ("city"):
                {if (!preg_match('/^[\p{L} ]+$/u', $city)) {
                    echo $cityErrInv;
                    $array[] = 'cityErrInv';
                    break;
                }}
                case "streetnumber":
                {  if (!filter_var($streetnumber, FILTER_SANITIZE_NUMBER_INT)) {
                    echo $streetnumberErrInv;
                    $array[] = 'streetnumberErrInv';
                    break;
                }}
                case "zipcode":
                {if (!filter_var($zipcode, FILTER_SANITIZE_NUMBER_INT)) {
                    echo $zipcodeErrInv;//create an element in the HTML you can't do that with the cookie.
                    $array[] = 'zipcodeErrInv';
                    break;
                }}
        }
                //will throw INVALID error if invalid format (or characters?) are used.

    }
    }
//    if (empty($_POST["email"])) {
//        //will throw REQUIRED error if empty
//        //how should this be implemented? not really clear to me
//        echo $emailErrReq;
//    } else {
//        $email = $_POST["email"];
//        $_SESSION["email"] = $email;
//        // check if e-mail address is well-formed
//        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
//            //will throw INVALID error if invalid format (or characters?) are used.
//            echo $emailErrInv;
//        }
//    }
//    if (empty($_POST["street"])) {
//        echo $streetErrReq;
//    } else {
//        $street = $_POST["street"];
//        $_SESSION["street"] = $street;
//        // check if e-mail address is well-formed
//        if (!preg_match('/^[\p{L} ]+$/u', $street)) {
//            echo $streetErrInv;
//        }
//    }
//    if (empty($_POST["city"])) {
//        echo $cityErrReq;
//        $array[] = 'cityErrReq';
//    } else {
//        $city = $_POST["city"];
//        $_SESSION["city"] = $city;
//        // check if city address is well-formed
//        if (!preg_match('/^[\p{L} ]+$/u', $city)) {
//            echo $cityErrInv;
//            $array[] = 'cityErrInv';
//        }
//    }
//    if (empty($_POST["streetnumber"])) {
//        echo $streetnumberErrReq;
//        $array[] = 'streetnumberErrReq';
//
//    } else {
//        $streetnumber = $_POST["streetnumber"];
//        $_SESSION["streetnumber"] = $streetnumber;
//        // check if e-mail address is well-formed
//        if (!filter_var($streetnumber, FILTER_SANITIZE_NUMBER_INT)) {
//            echo $streetnumberErrInv;
//            $array[] = 'streetnumberErrInv';
//        }
//    }
//    if (empty($_POST["zipcode"])) {
//        echo $zipcodeErrReq;
//        $array[] = "zipcodeErrReq";
//    } else {
//        $zipcode = $_POST["zipcode"];
//        $_SESSION["zipcode"] = $zipcode;
//        // check if e-mail address is well-formed
//        if (!filter_var($zipcode, FILTER_SANITIZE_NUMBER_INT)) {
//            echo $zipcodeErrInv;//create an element in the HTML you can't do that with the cookie.
//            $array[] = 'zipcodeErrInv';
//        }
//    }
    //Todo: make the requirements work.
// create an array, then add values.
    if (count($array) == 0){
        //Todo: object structuring and destructuring DONE.
        //with foreach loop using the structure of the checkbox generator to cycle through all checked values
        //and returning a 0 value if unchecked so that they are still able to be added to the $_SESSION;
        foreach ($products as $i => $product) {
            if (isset($_POST["products"][$i])) {

                $addedName[$i] = [$product['name'], $product['price']];
                $addedValue[$i] = $product['price'];
                $totalValue += $product['price'];
                $_SESSION['totalValue'] = $totalValue;
            }
        }
        if (isset($_POST['express_delivery'])) {
            echo $valid = '<div class="alert alert-primary" role="alert"> Your order has been sent. ETA: 45 minutes </div>';
            $express = 5;
            $totalValue += $express;
            $_SESSION['totalValue'] = $totalValue;
        } else {
            echo $valid = '<div class="alert alert-primary" role="alert"> Your order has been sent. ETA: 2 hours </div>';
        }
        //Todo: email  used to work in echo format.
        echo "Hi there $email,<br>
              We will send your order to $street $streetnumber, $city, $zipcode,<br>
              Thanks for your business dear customer,<br>
              The items you ordered were:<br>";
        foreach ($products as $i => $product) {
            if (isset($_POST["products"][$i])) {
                echo $addedName[$i] . " cost you " . $addedValue[$i] . "€ <br>";
            }
        }
//array creation for clicked boxes to order from. validation of those elements and the sending of the email with the correct information.
        if (isset($_POST['express_delivery'])) {
            echo "Express delivery cost you $express € <br>";
        }
        $receiver = "reinout.de.bleser@gmail.com";
        $subject = "Purchase overview";
        $body = "Hi there $email,\n
                We will send your order to $street $streetnumber, $city, $zipcode,\n
                Thanks for your business dear customer,\n
                The items you ordered were:\n".

                "The total cost of your order was $totalValue €";


        $sender = "From:reinout.de.bleser@gmail.com";
        if (mail($receiver, $subject, $body, $sender)) {
            echo "Email sent successfully to $receiver";
        } else {
            echo "Sorry, failed while sending mail!";
        }
    } else {
        echo $valid = "";
    }
}

whatIsHappening();

require 'form-view.php';