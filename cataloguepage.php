<?php
// Подключение к базе данных
$servername = "localhost";
$username = "root";
$password = "";
$database = "website_db";

$conn = new mysqli($servername, $username, $password, $database);

// Проверка соединения
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// Запрос для получения уникальных типов кухни
$sql = "SELECT DISTINCT cuisine_type FROM restaurants";
$result = $conn->query($sql);

// Проверка результата
if ($result->num_rows > 0) {
    $cuisine_type = [];
    while($row = $result->fetch_assoc()) {
        $cuisine_type[] = $row['cuisine_type'];
    }
} else {
    $cuisine_type = [];
}

$sqlai = "
SELECT 
    r.id AS restaurant_id, 
    r.name, 
    r.average_rating, 
    GROUP_CONCAT(DISTINCT r.cuisine_type ORDER BY r.cuisine_type ASC SEPARATOR ', ') AS cuisine_types, 
    GROUP_CONCAT(DISTINCT p.photo_url ORDER BY p.photo_url ASC SEPARATOR ', ') AS photo_urls 
FROM 
    restaurants r 
JOIN 
    photos_restaurants p ON r.id = p.restaurant_id 
GROUP BY 
    r.id, r.name, r.average_rating
";

$result = $conn->query($sqlai);

$restaurants = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $restaurants[] = [
            'id' => $row['restaurant_id'], // Include the restaurant ID
            'name' => $row['name'],
            'average_rating' => $row['average_rating'],
            'cuisine_types' => $row['cuisine_types'],
            'photo_urls' => explode(', ', $row['photo_urls'])
        ];
    }
} else {
    echo "No restaurants found.";
}


$conn->close();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/1165876da6.js" crossorigin="anonyomus"></script>
    <link rel="stylesheet" href="catalogueofproducts.css">
    <script src="https://fontawesome.com/v4/get-started/"
    crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>


    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:ital,wght@0,100;0,200;0,300;0,400;0,500;1,100;1,200;1,400&family=Poppins:wght@200;300;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.2/css/fontawesome.min.css" integrity="sha384-BY+fdrpOd3gfeRvTSMT+VUZmA728cfF9Z2G42xpaRkUGu2i3DyzpTURDo5A6CaLK" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Jim+Nightshade&display=swap" rel="stylesheet">
    <title>Catalogue</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=IBM+Plex+Serif:ital@1&family=Kite+One&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Jim+Nightshade&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Jim+Nightshade&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Seaweed+Script&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Baskervville:ital@0;1&family=Jim+Nightshade&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Seaweed+Script&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Baskervville:ital@0;1&family=Jim+Nightshade&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Seaweed+Script&family=Spline+Sans:wght@300..700&display=swap');

        body {
       background-color: #EDEDED;
   }
        *{
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            box-sizing: border-box;
        }
        .container {
    width: 100%;
    min-height: 200px;
    background-image: url(headerimg.png);
    background-size: cover;
    background-position: center;
    position: relative; /* Ensure positioned children are relative to this container */
}

nav {
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 10px 0;
}

.logo {
    width: 220px;
    cursor: pointer;
    margin-left: 30px;
    margin-top: 44px;
}

nav ul {
    list-style: none;
    width: 100%;
    text-align: right;
    padding-right: 60px;
    margin-top: 68px;
}



nav ul li {
    display: inline-block;
    margin-left: 40px;
}

nav ul li a {
    color: white;
    text-decoration: none;
    font-family: "Kite One", sans-serif;
    font-size: 27px;
}
.search-form {
    display: inline-flex;
    padding: 0 20px;
    justify-content: space-between;
    align-items: center;
    height: 40px;
    border-radius: 30px;
    overflow: hidden;
    background-color: white;
    position: absolute;
    left: 50%;
    top: 80px;
    transform: translateX(-50%);
}

.search-form_txt {
    border: none;
    width: 660px;
    outline: none;
    font-size: 20px;
    padding-right: 10px;
    background-color: transparent;
}

.search-form_btn {
    border: none;
    background-color: transparent;
}

.search-form_image {
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: transparent;
    cursor: pointer;
    width: 25px;
}


        .filter_btn{
            border: none;
            background-color: transparent;
        }
        .fllter_btn_img{
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: transparent;
            cursor: pointer;
            width: 25px;
            position: absolute;
            top: 88px;
            left: 1050px;
        }

        .title{
            margin: 60px 95px;
            font-family: "Poppins", sans-serif;
            width: 400px;
            height: 66px;
            letter-spacing: -0.03em;
            color: #000000;
        }

        .tit {
            font-weight: 600;
            font-size: 32px;
        }
        
        main{
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }
        

.course {
	background-color: #fff;
	border-radius: 10px;
	box-shadow: 0 10px 10px rgba(0, 0, 0, 0.2);
	display: flex;
	max-width: 100%;
	margin: 20px;
	overflow: hidden;
	width: 700px;
}

.hidden {
    display: none;
}


        main{
            margin-top: 35px;
            margin-left: 200px;
        }
       
        .info-container{
            border: none;
            border-radius: 8px;
            padding-left: 40px;
            padding-top: 25px;
            width: 750px; 
            height: 213px;
            background-color: #ffff;
        }
        .restaurant-name {
            font-size: 28px;
            font-weight: 700;
            margin-top: 0; 
        }

        .rating-container {
            background-color: #fff;
            border-radius: 4px;
            margin-top:-10px;
            display: flex;
            list-style: none;
            margin-right: 20px;
        }

        .rating-container .average_rating a {
            font-weight: bold;
            background-color: #306F21;
            border-radius: 3px;
            font-size: 10px;
            padding: 1px 8px;
            text-decoration: none;
            color: #000000;
        }


        .line {
            border-top: 1.99px solid #000;
            margin: 15px 0;
        }

        .info {
            font-size: 18px;
            line-height: 1.5;
            font-weight: 500;
        }
        .rating-container button{
            border: none;
            background-color: #fff;
        }
        .rating-container button a{
            text-decoration: none;
            color: #000000;
            font-size: 11px;
            font-weight: 700;
            font-family:"Poppins", sans-serif;
        }
        .rating-container li a{
            color: #000000;
            font-size: 12px;
        }
        


        .footerbottom {
    text-align: center;
}
.footerphoto {
    width: 100%;

}

.rectangle {
    background-color: #7D4545;
    width: 100%;
    height: 250px;
    align-items: center;
    justify-content: center;
    display: inline-block;
}
.footer1{
    width: 100%;
    height: 250px;
    background-image: url(footer2pic.png);
    background-size: cover;
    background-position: center;
    display: flex;
    justify-content: center;
    align-items:center;
}
.footer1 h1{
    font-family: "Seaweed Script", cursive;
    margin-bottom: 220px;
    font-size: 40px;
    font-weight: 599;
    margin-top: 60px;
}
.footer1 h3{
    font-family: "Baskervville", serif;
    font-weight: 600;
    font-style: normal;
    position: absolute;
    font-size: 20px;
    margin-bottom: 100px;
}
.signup_form{
    display: inline-flex;
    padding: 0 20px;
    justify-content: space-between;
    align-items: center;
    height: 32px;
    border-radius: 1px;
    overflow: hidden;
    background-color: white;
    position: absolute;
    margin-left: -100px;
}
.search-form_footer{
    border: none;
    width: 300px;
    outline: none;
    font-size: 16px;
    padding-right: 10px;
    background-color: transparent;
    font-family: "Baskervville", serif;
}
.signing{
    background-color: transparent;
    position: relative;
}
.signup_btn{
    background-color: #7D4545;
    padding: 8px;
    border: none;
    padding-left: 30px;
    padding-right: 30px;
    margin-right: -2000px;
    position: inherit;
    left: 30px;
    
}
.signup_btn a{
    text-decoration: none;
    color: white;
    font-size: 20px;
}
.signup_btn:hover{
    background-color: #d18585;
}
.signup_btn h6{
    font-family: "Spline Sans", sans-serif;
    font-weight: 200;   
}
.logo_of_footer{
    width: 280px;
    display: flex;
    margin: 35px auto 20px;
}
.footer-content{
    display: flex;
    justify-content: center;
}

.social-icons {
    display: flex;
    list-style: none;
    padding: 0;       
    margin: 0; 
    justify-content: center; 
    align-items: center;
    margin-right: -25px;
}

.social-icons li {
    margin-right: 25px; 
}
.social-icons li img {
            width: 22px;
            height: 22px;
}
.social-icons li a {
    display: block;
}

.photo {
    position: relative;
    width: 485px;
}

.slider {
    position: relative;
    margin: auto;
    overflow: hidden;
    
}

.slides {
    display: flex;
    transition: transform 0.5s ease-in-out;
}

.slides img {
    border: 0;
    height: 220px;
    width: 100%;
}

.prev, .next {
    cursor: pointer;
    position: absolute;
    top: 50%;
    width: auto;
    padding: 0; /* Removed padding */
    margin-top: -22px;
    color: white;
    font-weight: 400;
    font-size: 40px;
    transition: 0.6s ease;
    border: none; /* Removed border */
    background-color: transparent; /* Removed background */
    user-select: none;
}

.next {
    right: 0;
}

.favorites-button {
    position: absolute;
    top: 10px; /* Adjust as needed */
    right: 10px; /* Adjust as needed */
    background: none;
    border: none;
    cursor: pointer;
}

.favorites-button img {
    width: 30px; /* Adjust size as needed */
    height: 30px; /* Adjust size as needed */
}

footer {
    position: relative;
    bottom: 0;
    left: 0;
    width: 100%;
    margin: 80px 0 0 0;
}


        .filter-menu {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 250px;
            position: absolute;
            left: 95px;
        }

        .filter-menu h2 {
            font-size: 20px;
            margin-bottom: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }


        .filter-menu ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .filter-menu li {
            margin-bottom: 10px;
            display: flex;
            align-items: center;
        }

        .filter-menu label {
            margin-left: 8px;
            font-size: 16px;
        }

        .filter-menu .show-all {
            font-size: 16px;
            color: #007BFF;
            text-decoration: none;
            display: inline-block;
            margin-top: 10px;
            cursor: pointer;
        }

        .filter-menu .show-all:hover {
            text-decoration: underline;
        }

        
        .filter-container {
    position: absolute;
    left: 1159px;
    top: 172px;
    transform: translateX(-50%);
    padding: 10px;
    background-color: #f9f9f9;
    width: 301px;
    border: 1px solid #ddd;
    border-radius: 10px;
    display: none; 
    background-color: #fff;
}

.filter {
    padding: 10px;
}

.textf {
    font-size: 20px;
    font-weight: bold;
    margin-bottom: 10px;
    font-family: "Kite One", sans-serif;
}

.list {
    gap: 10px;
    background-color: #fff;
    margin-top: 15px;
    width: 282px;
    border-radius: 10px;
    position: relative;
    right: 11px;
}

.item-list {
    display: flex;
    align-items: center;
    padding: 8px;
    list-style: none;
    cursor: pointer;
    transition: 0.3s;
}

.item-list:hover {
    background-color: #e7edfe;
}

.checkbox {
    height: 16px;
    width: 16px;
    border: 1.5px solid #c0c0c0;
    border-radius: 4px;
    margin-right: 12px;
}

.item-text {
    font-size: 16px;
    font-weight: 400;
    color: #333;
}

.button {
    width: 95px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: flex-start;
    gap: 10px;
    padding: 0 15px;
    background-color: #fff;
    border-radius: 10px;
    border: 1.5px solid black;
    cursor: pointer;
    transition-duration: 0.2s;
    margin-top: 20px;
    position: relative;
    left: 50%;
    transform: translateX(-50%);
}

.button p {
    font-size: large;
    text-decoration: none;
    text-transform: none;
    color: #000000;
}

.arrow {
    position: absolute;
    right: 0;
    width: 30px;
    height: 100%;
    font-size: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #000000;
}

.button:hover {
    background-color: #4d4d4d;
    transition-duration: 0.2s;
}

.button:hover .arrow {
    animation: slide-right 0.6s ease-out both;
}

@keyframes slide-right {
    from {
        transform: translateX(0);
    }
    to {
        transform: translateX(5px);
    }
}



    </style>
</head>
<body>
    <header>
        <div class="container">
            <nav>
                <a href="mainpage.php"><img src="Logo1.png" class="logo"></a>
                <div class="search-form">
                    <input class="search-form_txt" type="text" oninput="searchRestaurants(this.value)">
                    <button class="search-form_btn"><img class="search-form_image" src="searchbtn.png" alt="image"></button>
                </div>
                <ul>
                    <li><a href="accountpage.php">Account</a></li>
                </ul>
                <button class="filter_btn"><img class="fllter_btn_img" src="filter.png" alt="image"></button>
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
    </nav>
</div>
    
    </header>
    
    <div class="title">
        <h1 class="tit">
            Restaurants in Atyrau
        </h1>
    </div>
    
        <div class="filter-menu">
            <h2>Cuisines</h2>
            <ul>
            <?php foreach ($cuisine_type as $cuisine_type): ?>
                <li>
                    <input type="checkbox" id="<?= strtolower($cuisine_type) ?>" onclick="filterProduct('<?= strtolower($cuisine_type) ?>')">
                    <label for="<?= strtolower($cuisine_type) ?>"><?= $cuisine_type ?></label>
                </li>
            <?php endforeach; ?>
        </ul>
            <a class="show-all">Show all</a>
        </div>

        <main>
        <?php foreach ($restaurants as $restaurant): ?>
            <div class="courses-container">
                <div class="course">
                    <div class="photo">
                        <div class="slider">
                            <div class="slides">
                                <?php foreach ($restaurant['photo_urls'] as $photo_url): ?>
                                    <img class="picture" src="<?= $photo_url ?>" alt="image">
                                <?php endforeach; ?>
                            </div>
                            <button class="prev" onclick="plusSlides(-1)">&#10094;</button>
                            <button class="next" onclick="plusSlides(1)">&#10095;</button>
                        </div>
                        <button class="favorites-button" onclick="toggleFavorite('<?= $restaurant['name'] ?>')">
                            <img src="heart.svg" alt="Heart Icon" class="heart">
                        </button>
                    </div>
                    <div class="info-container">
                        <div class="restaurant-name"><?= $restaurant['name'] ?></div>
                        <div class="rating-container">
                            <span class="average_rating"><a href="#"><?= $restaurant['average_rating'] ?></a></span>
                            <span class="dot">•</span>
                            <li><a href="restaurantpage.php?id=<?= $restaurant['id'] ?>#review_text_1">Reviews</a></li>
                            <span class="dot">•</span>
                            <button><a href="restaurantpage.php?id=<?= $restaurant['id'] ?>">Open Now</a></button>
                        </div>
                        <div class="line"></div>
                        <div class="info">
                            <p>The type of cuisine is <?= $restaurant['cuisine_types'] ?>. You can spend your best dinner here.</p>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
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
                    <li><a href="*"><img src="youtube.png"></a></li>
                    </ul>
                    
                </div>
            </div>
                

                
        </div>
    </footer>
<script>
    document.addEventListener('DOMContentLoaded', function() {
            // Function to parse URL parameters
            function getUrlParameter(name) {
                name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
                var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
                var results = regex.exec(location.search);
                return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
            }

            // Retrieve cuisine filter from URL
            var cuisineFilter = getUrlParameter('cuisine');

            // If cuisine filter exists, check the corresponding checkbox and filter products
            if (cuisineFilter) {
                var checkbox = document.getElementById(cuisineFilter);
                if (checkbox) {
                    checkbox.checked = true;
                }
                filterProduct();
            }
        });

        // Function to filter products based on cuisine
        function filterProduct() {
            var checkboxes = document.querySelectorAll('.filter-menu input[type="checkbox"]');
            var selectedCuisines = [];

            // Get selected cuisines
            checkboxes.forEach(checkbox => {
                if (checkbox.checked) {
                    selectedCuisines.push(checkbox.id);
                }
            });

            // If no checkboxes are selected, show all courses
            if (selectedCuisines.length === 0) {
                showAll();
                return;
            }

            var courses = document.querySelectorAll('.course');
            courses.forEach(course => {
                var info = course.querySelector('.info');
                var cuisine = info.innerText.toLowerCase();
                var showCourse = false;

                // Check if the course cuisine matches any of the selected cuisines
                selectedCuisines.forEach(selectedCuisine => {
                    if (cuisine.includes(selectedCuisine)) {
                        showCourse = true;
                    }
                });

                // Display or hide the course based on whether it matches any selected cuisine
                if (showCourse) {
                    course.style.display = 'flex';
                } else {
                    course.style.display = 'none';
                }
            });
        }
    function searchRestaurants(query) {
            query = query.toLowerCase();
            const restaurantNames = document.querySelectorAll('.restaurant-name');
            
            restaurantNames.forEach(name => {
                // Convert the restaurant name to lowercase for comparison
                const restaurantName = name.textContent.toLowerCase();
                
                // Check if the restaurant name contains the search query
                if (restaurantName.includes(query)) {
                    // Show the restaurant if it matches the search query
                    name.closest('.courses-container').style.display = 'block';
                } else {
                    // Hide the restaurant if it doesn't match the search query
                    name.closest('.courses-container').style.display = 'none';
                }
            });
        }

        document.addEventListener('DOMContentLoaded', (event) => {
    const sliders = document.querySelectorAll('.slider');
    
    sliders.forEach((slider) => {
        let slideIndex = 0;
        const slides = slider.querySelector('.slides');
        const totalSlides = slider.querySelectorAll('.slides img').length;
        
        function showSlides(n) {
            slideIndex += n;
            if (slideIndex >= totalSlides) {
                slideIndex = 0;
            } else if (slideIndex < 0) {
                slideIndex = totalSlides - 1;
            }
            slides.style.transform = 'translateX(' + (-slideIndex * 100) + '%)';
        }
        
        function plusSlides(n) {
            showSlides(n);
        }

        slider.querySelector('.prev').addEventListener('click', () => {
            plusSlides(-1);
        });

        slider.querySelector('.next').addEventListener('click', () => {
            plusSlides(1);
        });
    });
});


function toggleFavorite(restaurantName) {
    const heartImg = event.target.closest('.favorites-button').querySelector('.heart');
    let favorites = JSON.parse(localStorage.getItem('favorites')) || [];
    
    if (favorites.includes(restaurantName)) {
        favorites = favorites.filter(name => name !== restaurantName);
        heartImg.src = 'heart.svg'; // Set to unliked image
    } else {
        favorites.push(restaurantName);
        heartImg.src = 'likedheart.svg'; // Set to liked image
    }

    localStorage.setItem('favorites', JSON.stringify(favorites));
}
document.addEventListener("DOMContentLoaded", function() {
    // Add event listener to the "Show all" button
    var showAllButton = document.querySelector('.show-all');
    showAllButton.addEventListener('click', showAll);
});

function showAll() {
    var checkboxes = document.querySelectorAll('.filter-menu input[type="checkbox"]');
    checkboxes.forEach(checkbox => {
        checkbox.checked = true;
    });

    // Trigger the filter function for each checked checkbox
    filterProduct();
}

// Function to filter products based on cuisine
function filterProduct() {
    var checkboxes = document.querySelectorAll('.filter-menu input[type="checkbox"]');
    var selectedCuisines = [];

    // Get selected cuisines
    checkboxes.forEach(checkbox => {
        if (checkbox.checked) {
            selectedCuisines.push(checkbox.id);
        }
    });

    // If no checkboxes are selected, show all courses
    if (selectedCuisines.length === 0) {
        showAll();
        return;
    }

    var courses = document.querySelectorAll('.course');
    courses.forEach(course => {
        var info = course.querySelector('.info');
        var cuisine = info.innerText.toLowerCase();
        var showCourse = false;

        // Check if the course cuisine matches any of the selected cuisines
        selectedCuisines.forEach(selectedCuisine => {
            if (cuisine.includes(selectedCuisine)) {
                showCourse = true;
            }
        });

        // Display or hide the course based on whether it matches any selected cuisine
        if (showCourse) {
            course.style.display = 'flex';
        } else {
            course.style.display = 'none';
        }
    });
}



</script>
<script src="HomePageDine.java"></script>
</body>
</html>