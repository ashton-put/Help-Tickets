<?php
include 'top.php';

// start the session to remember the user
session_start();

// grab user info from login.php
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

// set the user_id
$user_id = $_SESSION["user_id"];

// fetch username based on user_id
$statement = $pdo->prepare("SELECT username FROM Users WHERE user_id = ?");
$statement->execute([$user_id]);
$user = $statement->fetch();
?>

<!-- main element -->
<main>
    <h2> Home Page </h2>
    <br>
    <section class="message">
    </section>
    <br>
    <!-- print personalized hello message -->
    <h3> Hello, <?php echo $user['username']; ?></h3>
    <br>

    <!-- some text -->
    <br>
    <p>Thank you a ton for participating and helping us out with the Hackathon!</p>
    <br>
    <p>If any issues arise with this website, please find Ashton, the CS Crew Treasurer.</p>
    <br>
    <br>
    <section class="message">
    </section>
    <br>
</main>

<?php
include 'footer.php';
?>