<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "website_db";

$conn = new mysqli($servername, $username, $password, $database);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT cuisine_type, COUNT(*) AS restaurant_count FROM restaurants GROUP BY cuisine_type LIMIT 6";
$result = $conn->query($sql);

$cuisine_data = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $cuisine_data[] = [
            'type' => $row['cuisine_type'],
            'count' => $row['restaurant_count']
        ];
    }
}

$sql = "
    SELECT DISTINCT
        r.id AS restaurant_id,
        r.name, 
        p.photo_url, 
        r.average_rating 
    FROM 
        restaurants r
    JOIN 
        photos_restaurants p 
    ON 
        r.id = p.restaurant_id 
    WHERE 
        r.average_rating > 4.0
    LIMIT 6
";
$result = $conn->query($sql);

$restaurants = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $restaurants[] = [
            'id' => $row['restaurant_id'],
            'name' => $row['name'],
            'photo_url' => $row['photo_url'],
            'average_rating' => $row['average_rating']
        ];
    }
}

$sql_recommended = "
    SELECT DISTINCT
        r.id AS restaurant_id,
        r.name, 
        p.photo_url, 
        r.average_rating 
    FROM 
        restaurants r
    JOIN 
        photos_restaurants p 
    ON 
        r.id = p.restaurant_id 
    WHERE
        r.price_range = '$$' 
    LIMIT 4
";
$result_recommended = $conn->query($sql_recommended);

$recommended_restaurants = [];
if ($result_recommended->num_rows > 0) {
    while($row = $result_recommended->fetch_assoc()) {
        $recommended_restaurants[] = [
            'id' => $row['restaurant_id'],
            'name' => $row['name'],
            'photo_url' => $row['photo_url'],
            'average_rating' => $row['average_rating']
        ];
    }
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <script src="https://kit.fontawesome.com/1165876da6.js" crossorigin="anonyomus"></script>
    <link rel="stylesheet" href="main.css">
    <script src="https://fontawesome.com/v4/get-started/" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:ital,wght@0,100;0,200;0,300;0,400;0,500;1,100;1,200;1,400&family=Poppins:wght@200;300;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.2/css/fontawesome.min.css" integrity="sha384-BY+fdrpOd3gfeRvTSMT+VUZmA728cfF9Z2G42xpaRkUGu2i3DyzpTURDo5A6CaLK" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jim+Nightshade&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <div class="container">
            <img src="Atyrau.png" class="atyrau">
            <nav>
                <img src="Logo1.png" class="logo">
                <ul>
                    <li><a href="signup.php">Sign up</a></li>
                    <li><a href="login.php">Log in</a></li>
                </ul>
            </nav>
            
            <div class="search-form">
                <form id="searchForm" action="cataloguepage.php" method="GET">
                    <input class="search-form_txt" type="text" placeholder="Type to search">
                    <button class="search-form_btn" type="submit">
                        <img class="search-form_image" src="searchbtn.png" alt="image">
                    </button>
                </form>
            </div>
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
        <div class="titlecuisine">
            <h1 class="cuisinetext">Cuisines</h1>
        </div>
    </header>
    <main>
        <div class="cuisines">
            <?php foreach ($cuisine_data as $cuisine): ?>
            <div class="a">
                <h1><?= htmlspecialchars($cuisine['type']); ?></h1>
                <h5><?= $cuisine['count']; ?> places</h5>
                <a href="cataloguepage.php?cuisine=<?= strtolower($cuisine['type']); ?>"><img class="l" src="arrow.png"></a>
            </div>
            <?php endforeach; ?>
        </div>
    </main>
    <popular>
    <div class="popular_restaurants">
            <?php foreach ($restaurants as $restaurant): ?>
            <div class="p">
                <a href="restaurantpage.php?id=<?= htmlspecialchars($restaurant['id']); ?>"><img class="noun" src="<?= htmlspecialchars($restaurant['photo_url']); ?>" alt="<?= htmlspecialchars($restaurant['name']); ?>"></a>
                <div class="name"><h3><?= htmlspecialchars($restaurant['name']); ?></h3></div>
                <h5><?= htmlspecialchars($restaurant['average_rating']); ?></h5>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="see_more">
            <button class="see">
                <a href="cataloguepage.php">more<img class="arrower" src="morearrow.png" alt="image"></a>
            </button>
        </div>
    </popular>
    <recomendations>
        <div class="recomendations">
            <h1>RECOMMENDATIONS</h1>
        </div>
        <div class="longer">
            <h4>Explore curated lists of top restaurants, cafes, pubs, and bars in Delhi NCR, based on your preferences</h4>
        </div>
    </recomendations>
        <div class="recomend">
    <?php foreach ($recommended_restaurants as $restaurant): ?>
    <div class="f">
        <a href="restaurantpage.php?id=<?= htmlspecialchars($restaurant['id']); ?>"><img class="nou" src="<?= htmlspecialchars($restaurant['photo_url']); ?>" alt="<?= htmlspecialchars($restaurant['name']); ?>"></a>
        <div class="names">
            <h3><?= htmlspecialchars($restaurant['name']); ?></h3>
        </div>
        <h5><?= htmlspecialchars($restaurant['average_rating']); ?></h5>
    </div>
    <?php endforeach; ?>
</div>
    <footer>
        <div class="footer1">
            <h1>Stay With Us</h1>
            <h3>Sign up here to leave your review</h3>
            <div class="signup_form">
                <form id="search-form_footer" action="signup.php" method="GET">
                    <input class="search-form_footer" type="text" placeholder="Your email address">
                </form>
            </div>
            <div class="signing">
                <button class="signup_btn"><a href="signup.php"><h6>Sign Up</h6></a></button>
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
                        <li><a href="*"><img src="youtube.png"></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <script>
    const filterBtn = document.querySelector(".filter_btn"); 
    const filterContainer = document.querySelector(".filter-container"); 
 
filterBtn.addEventListener("click", () => { 
    filterContainer.classList.toggle("open"); 
     
    if (filterContainer.classList.contains("open")) { 
        filterContainer.style.display = "block"; 
    } else { 
        filterContainer.style.display = "none"; 
    } 
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
