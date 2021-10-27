# SandwichShop

## This is the repository for the SandwichShop PHP exercise in week 25/10 - 27/10 at BeCode. 

>Goal of the exercise is to make working serverbased code in php not using other scripting languages and getting a rudimentary sandwich shop running. 
>This is a solo-learning exercise and the learning objectives are as follows:
>Be able to tell the difference between the superglobals $_GET, $_POST, $_COOKIE and $_SESSION variable.
>Be able to write basic validation for PHP.
>Be able to sent an email with PHP.

## Timeline: 
>Day 1 : finished steps 1-4 
>Day 2 : Got hung up and stuck on step 5 for a long time, then figured it out and made prep for getting step 6 working as well. 
>Day 3 : "finished" before lunch, but code is too messy, doing a lot of cleanup to make the code pretty and functional at the same time. Wrote README. need to do this at the start of the projects in the future. 



###Features were worked on as follows: 
#### Step 1: Validation	
>Validate that the field e-mail is filled in and a valid e-mail address	DONE
>Make sure that the street, street number, city and zipcode is a required field.	DONE
>Make sure that street number and zipcode are only numbers.	DONE  &
>  --> validation used has been from w3schools: https://www.w3schools.com/php/php_form_validation.asp 
>After sending the form, when you have errors show them in a nice error box above the form, you can use the bootstrap alerts for inspiration.	DONE
>If the form is invalid make sure all the values the user entered are still displayed in the form, so he doesn't need to fill them all in again!	DONE through superglobal SESSION,
>If the form is valid (for now) just show the user a message above the form that his order has been sent DONE

#### Step 2: Make sure the address is saved
Save all the address information as long as the user doesn't close the browser. When he closes the browser it is oké to lose his information.

#### Step 3: Switch between drinks and food
There are 2 different $product arrays, one with drinks, the other with food. Depending on which link at the top of the page you click, you should be able to order food or drinks (never both). The food items should be the default.

#### Step 4: Calculate the delivery time
Calculate the expected delivery time for the product. For normal delivery all orders are fulfilled in 2 hours, for express delivery it is only 45 minutes. Add this expected time to the confirmation message. If you are wondering: they deliver with drones.

#### Step 5: Total revenue counter
Add a counter at the bottom of the page that shows the total amount of money that has been spent on this page from this browser. Should you use a COOKIE or a SESSION variable for this?

#### Step 6: Send the e-mail
Use the mail() function in PHP to send an e-mail with a summary of the order. The e-mail should contain all information filled in by the user + the total price of all ordered items. Display the expected delivery time. Make sure to not forget the extra cost for express delivery! Sent this e-mail to the user + a predefined e-mail of the restaurant owner. 

