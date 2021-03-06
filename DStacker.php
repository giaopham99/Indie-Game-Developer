<?php
require_once('database.php');
if (!isset($_SESSION)) {
    session_start();
}
$user_id = $_SESSION['user_id'];
$query = "SELECT price FROM games WHERE name = 'DStacker' LIMIT 1";
$name = 'DStacker';
$statement = $db->prepare($query);
$statement->execute();
$price = $statement->fetch();
$statement->closeCursor();
?>

    <!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf8">
        <title>DStacker</title>
        <link rel="icon" href="images/favicon.ico">
        <link rel="stylesheet" href="game_page.css">
        <link rel="stylesheet" href="home.css">
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
            <div id="game_description">
                <img id="game" src="images/DStacker.png"><br>
                <h1>DStacker</h1>
                <p>
                    DStacker, short for DoubleStacker, is a fresh take on the popular game Tetris&reg where shapes fall to both sides simultaneously instead of just one side. 
                    It's double the fun and double the difficulty! 
                    For fun with friends, one person can take control of each side, and players can swap out shapes with each other to maximize their points and ensure victory! 
                    Buy now!
                </p>
                <h2>Price: $<?php echo reset($price); ?></h2>
                <form action="add_to_cart.php" method="post">
                    <input type="hidden" name="name" value="<?php echo $name; ?>">
                    <input type="hidden" name="price" value="<?php echo reset($price); ?>">
                    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                    <input type="image" id="add" src="images/add_to_cart.png"><br>
                </form>
            </div>
            <div id="social_media">
                <a href="#" ><img class="social_media" src="images/discord.png"></a>
                <a href="#" ><img class="social_media" src="images/reddit.png"></a>
                <a href="#" ><img class="social_media" src="images/twitter.png"></a>
                <a href="#" ><img class="social_media" src="images/instagram.png"></a>
                <br>
                <p>&copy; Smoke Games</p><br>
            </div>
        </div>
    </body>
</html>

