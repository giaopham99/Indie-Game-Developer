<?php

include('database.php');
if (!isset($_SESSION)) {
    session_start();
}

$userID = filter_input(INPUT_POST, 'userID', FILTER_VALIDATE_INT);

$user_id = $_SESSION['user_id'];

$query = "SELECT * FROM user_info WHERE id = $user_id";
$info = $db->query($query);
$info = $info->fetch();

$query = "SELECT * FROM address WHERE user_id = $user_id";
$addressInfo = $db->query($query);
$addressInfo = $addressInfo->fetch();

$query = "SELECT * FROM payment WHERE user_id = $user_id";
$paymentInfo = $db->query($query);
$paymentInfo = $paymentInfo->fetch();

$substrCardNum = substr($paymentInfo['card_num'], -4);

$substrPhone = "(".substr($info['phone'],0,3).") ".substr($info['phone'],3,3)."-".substr($info['phone'],-4);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf8">
    <title>My Account</title>
    <link rel="icon" href="images/favicon.ico">
    <link rel="stylesheet" href="myAccount.css">
</head>

<body>
    <div id="main">
        <img id="icon" src="images/icon.png"><br>
        <!--Start Navigation Bar-->
        <nav id="text_nav" class="top_nav">
            <ul>
                <li class="li_left" id="currPage"><a href="home.php">Home</a></li>
                <li class="li_left"><a href="about_us.php">About Us</a></li>
                <li class="li_left"><a href="contact_us.php">Contact Us</a></li>
                <li class="li_right"><img id="pfp" src="images/profilepic.png">
                    <ul>
                        <?php
                        if (!isset($_SESSION['first'])) { ?>
                            <li><a href="login.php">Sign Up/Log In</a></li> <!-- when logged in should be deactivated -->
                        <?php } ?>
                        <li><a href="">My Account</a></li>
                        <?php
                        if (isset($_SESSION['first'])) { ?>
                            <li><a href="logout.php">Log Out</a></li>
                        <?php } ?>
                    </ul>
                </li>
                <?php 
                            if(isset($_SESSION['first'])){?><li class="li_right"><a href="cart.php"><img id="cart" src="images/cart.png"></a></li><?php } ?>
            </ul>
        </nav>
        <!--End Navigation Bar-->

        <div id="myAccount">
            <div id="accountInfo">
                <div class="floatLeft">
                    <div id="personalInfo">
                        <form action="editPersonal.php" method="post">
                            <h2 class="infoHeaders">Personal Information</h2>
                            <p><strong>First Name:</strong>
                                <?php echo $info['first']; ?>
                            </p>
                            <p><strong>Last Name:</strong>
                                <?php echo $info['last']; ?>
                            </p>
                            <p><strong>Phone Number:</strong>
                                <?php echo $substrPhone; ?>
                            </p>
                            <input type="submit" value="Edit Personal Information">
                        </form>
                    </div><br>
                    <div id="emailAndPass">
                        <form action="editEmailAndPass.php" method="post">
                            <h2 class="infoHeaders">E-Mail and Password</h2>
                            <p><strong>Email:</strong>
                                <?php echo $info['email']; ?>
                            </p>
                            <p><strong>Password:</strong> *****</p>
                            <input type="submit" value="Edit E-Mail and Password">
                        </form>
                    </div><br>
                </div>
                <div class="floatRight">
                    <div id="addressAndPayment">
                        <form action="editAddressPHP.php" method="post">
                            <h2 class="infoHeaders">Address and Payment Information</h2>
                            <p><strong> Billing Address:</strong><br>
                                <p><strong>Street:</strong>
                                    <input type="text" placeholder="<?php echo $addressInfo['street'] ?>" name="street"><br>
                                    <?php if (isset($street_error)) { ?>
                                        <span class="error"><?php echo $street_error ?></span>
                                    <?php } ?>
                                </p>
                                <p><strong>City:</strong>
                                    <input type="text" placeholder="<?php echo $addressInfo['city'] ?>" name="city"><br>
                                    <?php if (isset($city_error)) { ?>
                                        <span class="error"><?php echo $city_error ?></span>
                                    <?php } ?>
                                </p>
                                <p><strong>State:</strong>
                                    <input type="text" placeholder="<?php echo $addressInfo['state'] ?>" name="state"><br>
                                    <?php if (isset($state_error)) { ?>
                                        <span class="error"><?php echo $state_error ?></span>
                                    <?php } ?>
                                </p>
                                <p><strong>Zipcode:</strong>
                                    <input type="text" placeholder="<?php echo $addressInfo['zipcode'] ?>" name="zipcode">
                                    <?php if (isset($zipcode_error)) { ?>
                                        <span class="error"><?php echo $zipcode_error ?></span>
                                    <?php } ?>
                                </p>
                                <input type="submit" value="Save">
                            </p>
                        </form>
                        <form action="editPayment.php" method="post">
                            <p><strong>Payment Information:</strong><br>
                                <?php echo $paymentInfo['card_type']; ?>
                                **** **** **** <?php echo $substrCardNum; ?>
                            </p>
                            <input type="submit" value="Edit Payment Information">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div id="social_media">
            <a href="#"><img class="social_media" src="images/discord.png"></a>
            <a href="#"><img class="social_media" src="images/reddit.png"></a>
            <a href="#"><img class="social_media" src="images/twitter.png"></a>
            <a href="#"><img class="social_media" src="images/instagram.png"></a>
            <br>
            <p>&copy; Smoke Games</p>
        </div>
    </div>
</body>
<footer>

</footer>

</html>