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

// Variables to hold restaurant details
$restaurant_name = $location = $photo_url = '';

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

// Handle review submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['review_text']) && isset($_POST['rate'])) {
        $review_text = $conn->real_escape_string($_POST['review_text']);
        $rating = intval($_POST['rate']);
        $review_date = date('Y-m-d');
        $review_type = $conn->real_escape_string($_POST['trip-start']);
        $user_name = 'Anonymous'; // Add logic to get the user's name if logged in

        $sql = "INSERT INTO reviews (restaurant_id, rating, review_text, review_date, review_type, user_name) VALUES ($restaurant_id, $rating, '$review_text', '$review_date', '$review_type', '$user_name')";
        if ($conn->query($sql) === TRUE) {
            echo "Review submitted successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    // Handle photo submission
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $sql = "INSERT INTO photos (restaurant_id, photo_url) VALUES ($restaurant_id, '$target_file')";
            if ($conn->query($sql) === TRUE) {
                echo "Photo uploaded successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}

$conn->close();
?>
 
<!DOCTYPE html> 
<html lang="en"> 
<head> 
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <link rel="stylesheet" href="global.css"> 
    <link rel="stylesheet" href="reviewpage.css"> 
    <title>Review Page</title> 
    <style>@import url('https://fonts.googleapis.com/css2?family=IBM+Plex+Serif:ital@1&family=Kite+One&display=swap'); 
@import url('https://fonts.googleapis.com/css2?family=Jim+Nightshade&display=swap'); 
@import url('https://fonts.googleapis.com/css2?family=Jim+Nightshade&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Seaweed+Script&display=swap'); 
@import url('https://fonts.googleapis.com/css2?family=Baskervville:ital@0;1&family=Jim+Nightshade&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Seaweed+Script&display=swap'); 
@import url('https://fonts.googleapis.com/css2?family=Baskervville:ital@0;1&family=Jim+Nightshade&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Seaweed+Script&family=Spline+Sans:wght@300..700&display=swap'); 
*{ 
    margin: 0; 
    padding: 0; 
    font-family: 'Poppins', sans-serif; 
    box-sizing: border-box; 
     
} 
 
.container{ 
    width: 100%; 
    min-height: 200px; 
    background-image: url(website.png); 
    background-size: cover; 
    background-position: center; 
} 
.atyrau{ 
    width: 75px; 
    margin-left: 1180px; 
    margin-bottom: -20px; 
} 
nav{ 
    width: 100%; 
    display: flex; 
    align-items: center; 
    justify-content: space-between; 
    padding: 10px 0; 
} 
.logo{ 
    width: 220px; 
    cursor: pointer; 
    margin-left: 30px; 
} 
nav ul{ 
    list-style: none; 
    width: 100%; 
    text-align: right; 
    padding-right: 60px; 
} 
nav ul li{ 
    display: inline-block; 
    margin-left: 40px; 
} 
nav ul li a{ 
    color: white; 
    text-decoration: none; 
    font-family: "Kite One", sans-serif; 
    font-size: 27px; 
} 
.search-form{ 
    display: inline-flex; 
    padding: 0 20px; 
    justify-content: space-between; 
    align-items: center; 
    height: 40px; 
    border-radius: 30px; 
    overflow: hidden; 
    background-color: white; 
    margin-left: 290px; 
    margin-top: -15px; 
    flex-direction: column-reverse; 
} 
 
.search-form_txt{ 
    border: none; 
    width: 660px; 
    outline: none; 
    font-size: 20px; 
    padding-right: 10px; 
    background-color: transparent; 
} 
 
.search-form_btn{ 
    border: none; 
    background-color: transparent; 
} 
 
.search-form_image{ 
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
    top: 100px; 
    left: 1030px; 
} 
 
.filter-container { 
    position: absolute; 
    left: 1180px; 
    top: 165px; 
    transform: translateX(-50%); 
    padding: 10px; 
    background-color: #f9f9f9; 
    width: 310px; 
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
} 
 
.list { 
    display: grid; 
    grid-template-columns: 1fr 1fr; 
    gap: 10px; 
    background-color: #fff; 
    margin-top: 15px; 
    padding: 16px; 
    width: 300px; 
    border-radius: 10px; 
    position: relative; 
    right: 20px; 
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
 
.text_1 { 
    position: relative; 
    top: 100px; 
    left: 110px; 
    width: 360px; 
} 
 
.line_1 { 
    display: block; 
    height: 700px; 
    width: 2px; 
    background-color: black; 
    position: relative; 
    left: 500px; 
    bottom: 45px; 
} 
 
.rectangle_1 { 
    display: block; 
    width: 300px; 
    height: 450px; 
    background-color: white; 
    position: relative; 
    left: 110px; 
    bottom: 540px; 
    border: 1px solid; 
    border-radius: 10px; 
 
} 
 
.restaurant_img { 
    width: 250px; 
    height: 230px; 
} 
 
.about_restaurant { 
    position: relative; 
    bottom: 950px; 
    left: 137px; 
    display: flex; 
    flex-direction: column; 
    gap: 10px; 
    width: 500px; 
} 
 
.address { 
    width: 23px; 
    height: 25px; 
} 
 
.text_address { 
    display: flex; 
    flex-direction: row; 
    gap: 10px; 
} 
 
.rating:not(:checked) > input { 
    position: absolute; 
    appearance: none; 
  } 
   
  .rating:not(:checked) > label { 
    float: right; 
    cursor: pointer; 
    font-size: 45px; 
    color: #666; 
  } 
   
  .rating:not(:checked) > label:before { 
    content: '★'; 
  } 
   
  .rating > input:checked + label:hover, 
  .rating > input:checked + label:hover ~ label, 
  .rating > input:checked ~ label:hover, 
  .rating > input:checked ~ label:hover ~ label, 
  .rating > label:hover ~ input:checked ~ label { 
    color: #e58e09; 
  } 
   
  .rating:not(:checked) > label:hover, 
  .rating:not(:checked) > label:hover ~ label { 
    color: #ff9e0b; 
  } 
   
  .rating > input:checked ~ label { 
    color: #ffa723; 
  } 
   
 
.rate { 
    position: absolute; 
    left: 540px; 
    top: 300px; 
    display: flex; 
    flex-direction: column; 
    align-items: flex-start; 
} 
 
.date { 
    display: flex; 
    flex-direction: column; 
    position: absolute; 
    left: 540px; 
    top: 430px; 
    gap: 10px; 
} 
 
.date_type { 
    border-radius: 8px; 
    width: 180px; 
    padding: 4px; 
} 
 
.with { 
    display: flex; 
    flex-direction: column; 
    position: absolute; 
    top: 560px; 
    left: 540px; 
} 
 
.buttons { 
    display: flex; 
    flex-direction: row; 
    gap: 30px; 
    margin-top: 15px; 
} 
 
.buttons button { 
    padding: 10px; 
    background-color: white; 
    border: 1px solid; 
    border-radius: 8px; 
    cursor: pointer; 
    font-weight: 600; 
} 
 
.buttons button.active { 
    background-color: #333; 
    color: white; 
} 
 
.write_review { 
    display: flex; 
    flex-direction: column; 
    position: absolute; 
    top: 680px; 
    left: 540px; 
} 
 
.write_review form { 
    position: relative; 
    top: 10px; 
 
} 
 
.write_review_input { 
    width: 450px; 
    height: 100px; 
} 
 
.write_review button { 
    background-color: white; 
    padding: 6px; 
    border: 1px solid; 
    position: relative; 
    top: 10px; 
    border-radius: 10px; 
    font-size: 15px; 
} 
 
 
.photo { 
    display: flex; 
    flex-direction: column; 
    position: absolute; 
    top: 900px; 
    left: 540px; 
    gap: 10px; 
} 
 
.rectangle_photo { 
    display: block; 
    width: 350px; 
    height: 190px; 
    background-color: #c7c7c7; 
} 
 
.photo_upload { 
    width: 50px; 
    height: 40px;
    position: relative; 
    left: 150px; 
    top: 60px; 
} 
 
.footer1 { 
    width: 100%; 
    margin-bottom: 0%; 
    margin-left: 0%; 
    margin-right: 0%; 
} 
 
.footerphoto { 
    width: 100%; 
 
} 
 
.footerbottom { 
    text-align: center; 
} 
 
.rectangle { 
    background-color: #7D4545; 
    width: 100%; 
    height: 250px; 
    display: inline-block; 
    align-items: center; 
    justify-content: center; 
} 
.footer1{ 
    width: 100%; 
    height: 320px; 
    background-image: url(footer2pic.png); 
    background-size: cover; 
    background-position: center; 
    display: flex; 
    justify-content: center; 
    align-items:center; 
    padding-top: 100px; 
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
.social-icons:hover{ 
    background-color: #7D4545; 
} 
.social-icons li img { 
    width: 22px; 
    height: 22px; 
} 
.footer-content li{ 
    text-decoration: none; 
    list-style: none; 
} 
 
.send_review { 
    background-color: black; 
    color: white; 
    padding: 10px; 
    border-radius: 8px; 
    border: 1px solid; 
    position: absolute; 
    top: 1200px; 
    left: 900px; 
    cursor: pointer; 
     
} 
 
.photo button { 
    text-decoration: none; 
    border: none; 
    background-color: #c7c7c7; 
    cursor: pointer; 
} 
 
.photo_photo { 
    display: flex; 
    flex-direction: column-reverse; 
    gap:70px; 
}</style>
</head> 
<body> 
    <header> 
        <div class="container"> 
            <nav> 
                <a href="mainpage.php"><img src="Logo1.png" class="logo"> </a>
                <ul> 
                    <li><a href="signup.php">Sign up</a></li> 
                    <li><a href="login.php">Log in</a></li> 
                </ul> 
            </nav> 
            <div class="search-form"> 
                <form id="searchForm" action="cataloguepage.html" method="GET"> 
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
        <div class="text_1">
            <h1>What are your impressions of your visit?</h1>
        </div>
        <span class="line_1"></span>
        <span class="rectangle_1"></span>
        <div class="about_restaurant">
            <img class="restaurant_img" src="<?php echo htmlspecialchars($photo_url); ?>" alt="Restaurant image">
            <h2><?php echo htmlspecialchars($restaurant_name); ?></h2>
            <div class="text_address"><img class="address" src="Vector (3).png" alt="address"><p><?php echo htmlspecialchars($location); ?></p></div>
        </div>
        <div class="rate">
            <h2>How would you rate your stay here?</h2>
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
        </div>
        <div class="date">
            <h2>When did you go?</h2>
            <label for="start"></label>
            <input class="date_type" type="date" id="start" name="trip-start" value="" min="2024-01-01" max="2024-12-31" />
        </div>
        <div class="with">
            <h2>Who were you there with?</h2>
            <div class="buttons">
                <button id="btn_1_1">business</button>
                <button>romantic</button>
                <button>family</button>
                <button>friends</button>
                <button>alone</button>
            </div>
        </div>
        <div class="write_review">
            <form action="reviewpage.php?id=<?php echo $restaurant_id; ?>" method="POST" enctype="multipart/form-data">
                <div class='write_review_1'>
                    <label for="review_text"><h2>Write Your Review</h2></label><br>
                    <textarea id="review_text" name="review_text" placeholder="Write your review here" required></textarea>
                </div>
                <div>
                    <button type="submit" value='Submit'>Submit</button>
                </div>
            </form>
        </div>
        <div class="photo">
            <h2>Add photo</h2>
            <form id="photoForm" action="reviewpage.php?id=<?php echo $restaurant_id; ?>" method="POST" enctype="multipart/form-data">
                <span class="rectangle_photo">
                    <div class="photo_photo">
                        <div class="label_photo">
                            <label for="image"></label>
                            <input type="file" id="image" name="image" accept="image/*">
                        </div>
                    </div>
                    <button class="add_photo_btn" type="submit">Submit</button>
                </span>
            </form>
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
                     <li><a href="*"><img src="youtube.png"></a></li> 
                    </ul> 
                </div> 
            </div>     
        </div> 
    </footer> 
    <script> 
        document.addEventListener('DOMContentLoaded', () => { 
    const buttons = document.querySelectorAll('.buttons button'); 
     
    buttons.forEach(button => { 
        button.addEventListener('click', () => { 
            button.classList.toggle('active'); 
        }); 
    }); 
}); 
    </script> 
</body> 
</html>