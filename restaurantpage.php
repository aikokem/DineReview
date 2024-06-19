<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "website_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the restaurant ID from the URL
$restaurant_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($restaurant_id > 0) {
    // SQL query to get the restaurant data
    $sql = "
    SELECT 
        r.name, r.location, r.cuisine_type, r.average_rating,
        p.average_price,
        ph.photo_url
    FROM 
        restaurants r
    LEFT JOIN 
        pricerange p ON r.id = p.restaurant_id
    LEFT JOIN 
        photos_restaurants ph ON r.id = ph.restaurant_id
    WHERE 
        r.id = $restaurant_id
    ";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $restaurant_name = $row["name"];
            $location = $row["location"];
            $cuisine_type = $row["cuisine_type"];
            $average_rating = $row["average_rating"];
            $average_price = $row["average_price"];
            $photo_url = $row["photo_url"];
        }
    } else {
        echo "No results found.";
    }
} else {
    echo "Invalid restaurant ID.";
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="restaurantpage.css">
    <link rel="stylesheet" href="global.css">
    <title>Restaurant page</title>
</head>
<body>
    <header>
        <div class="container">
            <img src="Atyrau.png" class="atyrau">
            <nav>
                <a href="mainpage.php"><img src="Logo1.png" class="logo"></a>
                <ul>
                    <li><a href="signup.php">Sign up</a></li>
                    <li><a href="login.php">Log in</a></li>
                </ul>
            </nav>
            <div class="search-form">
                <form id="searchForm" action="cataloguepage.php" method="GET">
                    <input class="search-form_txt" type="text" name="query">
                    <button class="search-form_btn" type="submit">
                        <img class="search-form_image" src="searchbtn.png" alt="image">
                    </button>
                </form>
            </div>
            
            <button class="filter_btn"><img class="fllter_btn_img" src="filter.png" alt="image"></button>
            <div class="filter-container">
                <div class="filter">
                    <p class="textf">Cuisine</p>
                    <ul class="list">
                        <li class="item-list">
                            <span class="item">
                                <input class="checkbox" checked="checked" type="checkbox" id="kazakh">
                                <label for="kazakh" class="item-text">Kazakh</label>
                            </span>
                        </li>
                        <li class="item-list">
                            <span class="item">
                                <input class="checkbox" checked="checked" type="checkbox" id="italian">
                                <label for="italian" class="item-text">Italian</label>
                            </span>
                        </li>
                        <li class="item-list">
                            <span class="item">
                                <input class="checkbox" checked="checked" type="checkbox" id="european">
                                <label for="european" class="item-text">European</label>
                            </span>
                        </li>
                        <li class="item-list">
                            <span class="item">
                                <input class="checkbox" checked="checked" type="checkbox" id="eastern">
                                <label for="eastern" class="item-text">Eastern</label>
                            </span>
                        </li>
                        <li class="item-list">
                            <span class="item">
                                <input class="checkbox" checked="checked" type="checkbox" id="uzbek">
                                <label for="uzbek" class="item-text">Uzbek</label>
                            </span>
                        </li>
                        <li class="item-list">
                            <span class="item">
                                <input class="checkbox" checked="checked" type="checkbox" id="japan">
                                <label for="japan" class="item-text">Japan</label>
                            </span>
                        </li>
                    </ul>
                    <button class="button">
                        <p>Find</p>
                        <div class="arrow">›</div>
                    </button>
                </div>
            </div>
            
        </div>
    </header>
    <main>
        <div class="text_namerestaurant">
            <h1 class="restaurant_name">
              <?php echo htmlspecialchars($restaurant_name); ?>
            </h1>
        </div>
        <div class="about_restaurant">
                <div class="rating_rectangle"><p><?php echo htmlspecialchars($average_rating); ?></p></div>
                <span class="line"></span>
                <div class="text_restaurant"><h3>#1 OUT OF 10 RESTAURANTS</h3></div>
                <span class="line_2"></span>
                <p class="text_avrprice">Average price: <?php echo htmlspecialchars($average_price); ?>tg</p>
                <span class="line_3"></span>
                <div class="text_address"><img  class="address" src="location.png" alt="address"><p><?php echo htmlspecialchars($location); ?></p></div>
                <span class="line_4"></span>
                <p class="text_cuisine"><?php echo htmlspecialchars($cuisine_type); ?> cuisine</p>
        </div>
        <div class="image">
            <img src="<?php echo htmlspecialchars($photo_url); ?>" alt="Restaurant image">
        </div>
        <div class="restaurant_description">
            <div class="detail_text">
                <h2>RATING</h2>
                <h2>DETAILS</h2>
                <h2>LOCATION</h2>
            </div>
            <div class="lines">
                <span class="line_5"></span>
                <span class="line_5"></span>
            </div>
            <div class="rating_text"> 
                <p><?php echo $average_rating; ?>/5<p>
                <p>Price range: <?php echo $average_price; ?>tg</p>
                <div class="text_address_2"><img  class="address" src="location.png" alt="address"><p><?php echo $location; ?></p></div>
            </div>
            <p class="cuisine_text">Cuisine: <?php echo $cuisine_type; ?></p>
        </div>
        <h1 class="review_text_1">REVIEWS</h1>
        <div class="review_search">
            <form class="form_review" action="" method="get">
               <input class="review_bar" type="search" id="site-search" name="query" placeholder="SEARCH REVIEW">
               <button class="search-form_btn" type="submit">
                    <img class="search-form_image_2" src="searchbtn.png" alt="image">
               </button>
            </form>
            <a href="reviewpage.php?id=<?php echo $restaurant_id; ?>">
               <button class="review_btn"><p>WRITE REVIEW</p></button>
            </a>
            <span class="review_line"></span>
            <div class="user_review">
                <div class="account_image">
                    <img src="user_photo.png" alt="account_image">
                    <img src="user_photo.png" alt="account_image">
                    <img src="user_photo.png" alt="account_image">
                </div>
                <div class="user_name">
                    <p>User name</p>
                    <p>User name</p>
                    <p>User name</p>
                </div>
                <div class="rating_stars">
                    <div class="rating">
                        <input value="5" name="rate" id="star5" type="radio">
                        <label title="text" for="star5"></label>
                        <input value="4" name="rate" id="star4" type="radio">
                        <label title="text" for="star4"></label>
                        <input value="3" name="rate" id="star3" type="radio" checked="">
                        <label title="text" for="star3"></label>
                        <input value="2" name="rate" id="star2" type="radio">
                        <label title="text" for="star2"></label>
                        <input value="1" name="rate" id="star1" type="radio">
                        <label title="text" for="star1"></label>
                    </div>
                    <div class="rating">
                        <input value="5" name="rate" id="star5" type="radio">
                        <label title="text" for="star5"></label>
                        <input value="4" name="rate" id="star4" type="radio">
                        <label title="text" for="star4"></label>
                        <input value="3" name="rate" id="star3" type="radio" checked="">
                        <label title="text" for="star3"></label>
                        <input value="2" name="rate" id="star2" type="radio">
                        <label title="text" for="star2"></label>
                        <input value="1" name="rate" id="star1" type="radio">
                        <label title="text" for="star1"></label>
                      </div>
                      <div class="rating">
                        <input value="5" name="rate" id="star5" type="radio">
                        <label title="text" for="star5"></label>
                        <input value="4" name="rate" id="star4" type="radio">
                        <label title="text" for="star4"></label>
                        <input value="3" name="rate" id="star3" type="radio" checked="">
                        <label title="text" for="star3"></label>
                        <input value="2" name="rate" id="star2" type="radio">
                        <label title="text" for="star2"></label>
                        <input value="1" name="rate" id="star1" type="radio">
                        <label title="text" for="star1"></label>
                      </div>
                      <div class="review_text">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur semper molestie quam at egestas. Praesent dignissim neque tellus, id fringilla sem sagittis sed. </p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur semper molestie quam at egestas. Praesent dignissim neque tellus, id fringilla sem sagittis sed. </p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur semper molestie quam at egestas. Praesent dignissim neque tellus, id fringilla sem sagittis sed. </p>
                    </div>
                      </div>
                </div>
            </div>
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
<script src="HomePageDine.js"></script>
</body>
</html>
