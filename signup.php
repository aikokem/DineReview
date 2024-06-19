<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$database = "website_db";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $conn->real_escape_string($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $username = $conn->real_escape_string($_POST['username']);

    $checkEmail = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $checkEmail->bind_param("s", $email);
    $checkEmail->execute();
    $checkEmail->store_result();

    if ($checkEmail->num_rows > 0) {
        $message = "<div class='error-message'>Error: Email already registered</div>";
    } else {
        $stmt = $conn->prepare("INSERT INTO users (email, password, username) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $email, $password, $username);

        if ($stmt->execute()) {
            // Сохранение данных пользователя в сессии
            $_SESSION['user_id'] = $stmt->insert_id;
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;

            // Перенаправление на account.php
            header("Location: accountpage.php");
            exit();
        } else {
            $message = "<div class='error-message'>Error: " . $stmt->error . "</div>";
        }

        $stmt->close();
    }

    $checkEmail->close();
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/1165876da6.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="signupp.css">
    <script src="https://fontawesome.com/v4/get-started/" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:ital,wght@0,100;0,200;0,300;0,400;0,500;1,100;1,200;1,400&family=Poppins:wght@200;300;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.2/css/fontawesome.min.css" integrity="sha384-BY+fdrpOd3gfeRvTSMT+VUZmA728cfF9Z2G42xpaRkUGu2i3DyzpTURDo5A6CaLK" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jim+Nightshade&display=swap" rel="stylesheet">
    <title>Registration Form</title>
    <style>
        .success-message {
            color: #4CAF50;
            font-size: 1.2em;
            margin: 10px 0;
            padding: 10px;
            border: 2px solid #4CAF50;
            background-color: #DFF2BF;
            border-radius: 5px;
            text-align: center;
        }
        .error-message {
            color: #F44336;
            font-size: 1.2em;
            margin: 10px 0;
            padding: 10px;
            border: 2px solid #F44336;
            background-color: #FFBABA;
            border-radius: 5px;
            text-align: center;
        }
    </style>
</head>
<body>
<main>
        <div class="form">
            <div class="form-box">
                <div class="form-details">
                    <img class="picture_logo" src="logo2.png" alt="image"> 
                </div>
                <div class="form-content">
                    <h2>Sign up</h2>
                    <?php echo $message; ?>
                    <form action="signup.php" method="POST">
                        <div class="input-field">
                            <input type="text" name="email" required>
                            <label>Email</label>
                        </div>
                        <div class="input-field">
                            <input type="password" name="password" required>
                            <label>Password</label>
                        </div>
                        <div class="input-field">
                            <input type="text" name="username" required>
                            <label>Username</label>
                        </div>
                        <button type="submit">Sign up</button>
                    </form>
                    <div class="bottom-link">If you already have an account
                        <a href="login.php">Log in</a>
                    </div>
                </div>
            </div>
        </div>
    </main>
    
</body>
</html>