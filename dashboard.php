<?php
// start the session
session_start();

// check if user is logged in
if (!isset($_SESSION["user_id"])) {
  echo "<div style=\"background-color: #f2f2f2; padding: 20px; border: 1px solid #ccc; border-radius: 5px; text-align: center;\">";
  echo "<p style=\"font-size: 24px; color: #333;\">You have not logged in.</p>";
  echo "<a href=\"login.html?redirect=true\" style=\"display: inline-block; background-color: #333; color: #fff; padding: 10px 20px; border-radius: 5px; text-decoration: none; font-size: 16px;\">Click here to go to the login page</a>";

  echo "</div>";
    
    exit();
}

// retrieve user ID from session
$user_id = $_SESSION["user_id"];

// connect to the database
$conn = mysqli_connect("localhost", "root", "", "rentit");

// check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// prepare SQL statement to retrieve user data including profile picture path
$sql = "SELECT * FROM users WHERE id = $user_id";

// execute SQL statement
$result = mysqli_query($conn, $sql);

// check if any rows were returned
if (mysqli_num_rows($result) > 0) {
    // retrieve user data
    $row = mysqli_fetch_assoc($result);    
    $profile_picture_path = $row["profile_picture_path"];
} else {
    // user not found
    echo "User not found.";
    exit();
}

// close connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Rent It</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
    
    <header>
        <div class="container">
            <h1>Rent It</h1>
            <nav>
                <ul>
                    <li><a href="home.php"><img src="photos/demo-home.webp" alt="Home" class="profile-icon"></a></li>                    
                    <li><a href="contact.php"><img src="photos/demo-contact.jpg" alt="Contact Us" class="profile-icon"></a></li>
                    <li><a href="cart.php"><img src="photos/demo-cart.webp" alt="My Cart" class="profile-icon"></a></li>
                    <li><a href="myprofile.php"><img src="<?php echo $profile_picture_path; ?>" alt="My Profile" class="profile-icon"></a></li>
                </ul>
            </nav>
        </div>
        
    </header>
    
    <section id="hero">
        <div class="container">
            <h2>Find Your Next Adventure</h2>
            <p>With Rent It, you can easily rent a wide variety of outdoor gear and equipment for your next adventure.</p>
            <a href="#" class="btn">View Rentals</a>
        </div>
    </section>
    
    <section id="features">
        <div class="container">
            <div class="feature-box">
                <i class="fa fa-campground"></i>
                <h3>Camping Gear</h3>
                <p>We offer tents, sleeping bags, stoves, and other camping gear for your next outdoor excursion.</p>
            </div>
            <div class="feature-box">
                <i class="fa fa-bicycle"></i>
                <h3>Bicycles</h3>
                <p>Our rental bikes are perfect for exploring the local area or tackling your next epic ride.</p>
            </div>
            <div class="feature-box">
                <i class="fa fa-boat"></i>
                <h3>Watercraft</h3>
                <p>From kayaks to stand-up paddleboards, we have all the gear you need to explore the water.</p>
            </div>
            <div class="feature-box">
                <i class="fa fa-diamond"></i>
                <h3>Wedding Rentals</h3>
                <p>We offer a wide range of wedding rentals, including dresses, tuxedos, and decorations to make your special day unforgettable.</p>
              </div>
              
        </div>
    </section>
    
    <section id="rentals">
        <div class="container">
            <h2>Popular Rentals</h2>
            <div class="rental-item">
                <img src="photos/tent.jpg" alt="Tent Rental">
                <h3>Tent Rental</h3>
                <p>Our tents are spacious, easy to set up, and perfect for any camping trip.</p>
                <a href="#" class="btn">Rent Now</a>
            </div>
            <div class="rental-item">
                <img src="photos/bike.jpg" alt="Bike Rental">
                <h3>Bike Rental</h3>
                <p>Our rental bikes are well-maintained and perfect for exploring the local area.</p>
                <a href="#" class="btn">Rent Now</a>
            </div>
            <div class="rental-item">
                <img src="photos/kayak.jpg" alt="Kayak Rental">
                <h3>Kayak Rental</h3>
                <p>Our kayaks are stable, easy to paddle, and perfect for exploring the local waterways.</p>
                <a href="#" class="btn">Rent Now</a>
            </div>
            <div class="rental-item">
                <img src="photos/wedding.jpg" alt="Wedding and One-Time Costumes Rental">
                <h3>Wedding and One-Time Costumes Rental</h3>
                <p>Looking for a unique outfit for a special occasion? Check out our selection of wedding and one-time costumes for rent!</p>
                <a href="#" class="btn">Rent Now</a>
            </div>
        </div>
    </section>
    
    <footer>
        <div class="container">
            <p>&copy; 2023 Rent It</p>
        </div>
    </footer>
</body>
</html>
