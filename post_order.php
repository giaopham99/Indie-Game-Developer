<?php
require_once('database.php');
if (!isset($_SESSION)) {
    session_start();
}
$email = $_SESSION['email'];
$user_id = $_SESSION['user_id'];
$query = "DELETE FROM cart WHERE user_id= $user_id";
    $db->exec($query);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf8">
        <title>Thank You For Your Purchase!</title>
        <link rel="icon" href="images/favicon.ico">
        <link rel="stylesheet" href="home.css">
        <link rel="stylesheet" href="post_order.css">
    </head>
    <body>
        <div id="main">
            <a href="home.php"><img id="icon" src="images/icon.png"></a>
            <a href="home.php"><img id="title_logo" src="images/title.png"></a><br>
            <nav id="text_nav" class="top_nav">
                <ul>
                    <li class="li_left" id="currPage" ><a href="home.php">Home</a></li>
                    <li class="li_left"><a href="about_us.php">About Us</a></li>
                    <li class="li_left"><a href="contact_us.php">Contact Us</a></li>
                    <li class="li_right"><img id="pfp" src="images/profilepic.png">
                        <ul>
                            <?php 
                            if(!isset($_SESSION['first'])){?>
                            <li><a href="login.php">Sign Up/Log In</a></li> <!-- when logged in should be deactivated -->
                            <?php } ?>
                            <?php 
                            if(isset($_SESSION['first'])){?><li><a href="myAccount.php">My Account</a></li><?php } ?>
                            <?php 
                            if(isset($_SESSION['first'])){?>
                            <li><a href="logout.php">Log Out</a></li>
                            <?php } ?>
                        </ul>
                    </li>
                    <?php 
                            if(isset($_SESSION['first'])){?><li class="li_right"><a href="cart.php"><img id="cart" src="images/cart.png"></a></li><?php } ?>    
                </ul>
            </nav>
            <h3>Thank you for your purchase!</h3>
            <h4>Your key(s) for your newly purchased game(s) can be found in the inbox of the email connected to your account: <?php echo $email; ?>. Be sure to check your spam folder if you do not see it in your inbox!</h4>
            <div id="social_media">
                <a href="#" ><img class="social_media" src="images/discord.png"></a>
                <a href="#" ><img class="social_media" src="images/reddit.png"></a>
                <a href="#" ><img class="social_media" src="images/twitter.png"></a>
                <a href="#" ><img class="social_media" src="images/instagram.png"></a>
                <br>
                <p>&copy; Smoke Games</p>
            </div>
        </div>
    </body>           
</html>
