<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$database = "website_db";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];
$email = $_SESSION['email'];

$conn->close();
?>

<!DOCTYPE html> 
<html lang="en"> 
<head> 
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <link rel="stylesheet" href="global.css"> 
    <link rel="stylesheet" href="accountpage.css"> 
    <title>Account page</title> 
  
</head> 
<body> 
    <header> 
        <div class="container"> 
            <nav> 
                <a href="mainpage.php"><img src="logo_new.png" class="logo"></a> 
                <p class="account_text_1">Account</p> 
            </nav> 
            <div class="search-form"> 
                <form id="searchForm" action="cataloguepage.html" method="GET"> 
                    <input class="search-form_txt" type="text" name="query"> 
                    <button class="search-form_btn" type="submit"> 
                        <img class="search-form_image" src="searchbtn.png" alt="image"> 
                    </button> 
                </form> 
            </div> 

        <button class="filter_btn"><img class="fllter_btn_img" src="filter_black.png" alt="image"></button> 
        <button class="filter_btn">
                <img class="fllter_btn_img" src="filter.png" alt="image">
            </button>
            <div class="filter-container">
                <div class="filter">
                    <p class="textf">Cuisine</p>
                    <ul class="list">
                        <?php foreach ($cuisine_data as $cuisine): ?>
                        <li class="item-list">
                            <span class="item">
                                <input class="checkbox" type="checkbox" id="<?= strtolower($cuisine['type']); ?>">
                                <label for="<?= strtolower($cuisine['type']); ?>" class="item-text"><?= htmlspecialchars($cuisine['type']); ?></label>
                            </span>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                    <a id="findButton" class="button" href="cataloguepage.php">
                        <p>Find</p>
                        <div class="arrow">></div>
                    </a>
                </div>
            </div>
        </div> 
    </div> 
</header> 
<main>
        <div class="header_img">
            <img src="accountpage.png" alt="header_img">
            <div class="account_picture"><img src="account_picture.png" alt="account_picture"></div>
        </div>
        <div class="account_text">
            <p>Username: <?php echo htmlspecialchars($username); ?></p>
            <p>Email: <?php echo htmlspecialchars($email); ?></p>
        </div>
        <div class="activity">
            <p class="activity_text">Activity</p>
            <button id="reviewsBtn"><p>Reviews</p></button>
            <button id="photosBtn"><p>Photos</p></button>
        </div>

        <div id="content">
            <div id="title">Activity</div>
            <p>Nothing here yet...</p>
        </div>
    </main>
<footer> 
    <div class="footer1"> 
        <h1>Stay With Us</h1> 
        <h3>Sign up here to leave your review </h3> 

  <div class="signup_form"> 
        <input class="search-form_footer" type="text" placeholder="Your email address"> 
    </div> 
    <div class="signing"> 
    <button class="signup_btn"><a href="*"><h6>Sign Up</h6></a></button> 
</div> 
    </div> 
    <div class="footerbottom"> 
        <div class="rectangle"> 
            <img src="logo2.png" class="logo_of_footer"> 
            <div class="footer-content"> 
                <ul class="social-icons"> 
                 <li><a href="*"><img src="instagram.png"></a></li> 
                 <li><a href="*"><img src="facebook.png"></a></li> 
                 <li><a href="*"><img src="tiktok.png"></a></li> 
                 <li><a href="*"><img src="twitter.png"></a></li> 
                 <li><a href="*"><img src="youtube (1).png"></a></li> 
                </ul> 
            </div> 
        </div>     
    </div> 
</footer> 
<script> 
     document.getElementById('reviewsBtn').addEventListener('click', function() { 
        console.log("Reviews button clicked"); 
        fetch('reviews_1.php') 
            .then(response => response.text()) 
            .then(data => document.getElementById('content').innerHTML = data); 
    }); 

    document.getElementById('photosBtn').addEventListener('click', function() { 
        console.log("Photos button clicked"); 
        fetch('photos.php') 
            .then(response => response.text()) 
            .then(data => document.getElementById('content').innerHTML = data); 
    }); 

    document.addEventListener('DOMContentLoaded', function() {
            var findButton = document.getElementById('findButton');

            findButton.addEventListener('click', function(event) {
                event.preventDefault();

                var checkboxes = document.querySelectorAll('.checkbox');
                var selectedFilters = [];

                checkboxes.forEach(function(checkbox) {
                    if (checkbox.checked) {
                        selectedFilters.push(checkbox.id);
                    }
                });

                var queryString = selectedFilters.map(filter => `cuisine=${filter}`).join('&');
                findButton.href = 'cataloguepage.php?' + queryString;
                window.location.href = findButton.href;
            });
        });

</script> 
</body> 
</html>