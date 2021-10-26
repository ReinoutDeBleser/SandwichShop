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

if (isset($_GET["food"]) && $_GET["food"] === "0"){
        $products =  [
            ['name' => 'Cola', 'price' => 2],
            ['name' => 'Fanta', 'price' => 2],
            ['name' => 'Sprite', 'price' => 2],
            ['name' => 'Ice-tea', 'price' => 3],
        ];
    }
    else{
        $products =  [
            ['name' => 'Club Ham', 'price' => 3.20],
            ['name' => 'Club Cheese', 'price' => 3],
            ['name' => 'Club Cheese & Ham', 'price' => 4],
            ['name' => 'Club Chicken', 'price' => 4],
            ['name' => 'Club Salmon', 'price' => 5]
        ];
}
$email = $emailErr = "";

if (isset($_SESSION["email"]) && !empty($_SESSION["email"])){
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

if (isset($_SESSION["street"]) && !empty($_SESSION["street"])){
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

if (isset($_SESSION["city"]) && !empty($_SESSION["city"])){
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

if (isset($_SESSION["streetnumber"]) && !empty($_SESSION["streetnumber"])){
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

if (isset($_SESSION["zipcode"]) && !empty($_SESSION["zipcode"])){
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

if (isset($_SESSION["totalValue"]) && !empty($_SESSION["totalValue"])) {
    $totalValue = $_SESSION["totalValue"];
}
else {$totalValue = 0;
}
$i = 0;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            if (
                                $emailErr === "" &&
                                $streetErr === "" &&
                                $cityErr === "" &&
                                $streetnumberErr === "" &&
                                $zipcodeErr === ""
                            ) {
                                foreach($products AS $i => $product) {
                                    if (isset($_POST["products"][$i])){
                                        $addedName[$i] = $product['name'];
                                        //echo $addedName[$i];
                                        print_r($addedName[$i]);
                                        $addedValue[$i] = $product['price'];
                                        echo $addedValue[$i];
                                        $totalValue = $product['price'];
                                        $_SESSION['totalValue']= $totalValue;
                                    }
                                }
                                print_r($addedValue);

                                if (isset($_POST['express_delivery'])){
                                    echo $valid = '<div class="alert alert-primary" role="alert"> Your order has been sent. ETA: 45 minutes </div>';
                                    $totalValue += 5;
                                    $_SESSION['totalValue']= $totalValue;
                                    $express = "5 €";
                                }
                                else {
                                    echo $valid = '<div class="alert alert-primary" role="alert"> Your order has been sent. ETA: 2 hours </div>';
                                }
//                              $receiver = "reinout.de.bleser@gmail.com";
//                              $subject = "Purchase overview";
//                              $body = "\n
//                              Hi there $email\n
//                              We will send your order to $street $streetnumber, $city, $zipcode \n
//                              Thanks for your business dear customer\n
//                              The items you ordered were
//                              $addedValue[$i]\n
//                              Your total order price was $totalValue";
//                              $sender = "From:reinout.de.bleser@gmail.com";
//                              if (mail($receiver, $subject, $body, $sender)) {
//                                  echo "Email sent successfully to $receiver";
//                              } else {
//                                  echo "Sorry, failed while sending mail!";
//                              }
                            }
                            else {
                                echo $valid = "";
                            }
                        }


//with foreach loop using the structure of the checkbox generator to cycle through all checked values
// and returning a 0 value if unchecked so that they are still able to be added to the $_SESSION;

whatIsHappening();

require 'form-view.php';