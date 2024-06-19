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
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, password, username FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $hashed_password, $username);
        $stmt->fetch();
        
        // Verify password
        if (password_verify($password, $hashed_password)) {
            // Password is correct, start a session
            $_SESSION['user_id'] = $id;
            $_SESSION['username'] = $username;
            header("Location: accountpage.php"); // Redirect to a dashboard or home page
            exit();
        } else {
            $message = "<div class='error-message'>Invalid password</div>";
        }
    } else {
        $message = "<div class='error-message'>No account found with that email</div>";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/1165876da6.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="loginn.css">
    <script src="https://fontawesome.com/v4/get-started/" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:ital,wght@0,100;0,200;0,300;0,400;0,500;1,100;1,200;1,400&family=Poppins:wght@200;300;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.2/css/fontawesome.min.css" integrity="sha384-BY+fdrpOd3gfeRvTSMT+VUZmA728cfF9Z2G42xpaRkUGu2i3DyzpTURDo5A6CaLK" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jim+Nightshade&display=swap" rel="stylesheet">
    <title>Login Form</title>
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
                    <h2>Log in</h2>
                    <?php echo $message; ?>
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                        <div class="input-field">
                            <input type="text" name="email" required>
                            <label>Email</label>
                        </div>
                        <div class="input-field">
                            <input type="password" name="password" required>
                            <label>Password</label>
                        </div>
                        <button type="submit">Log in</button>
                        </form>
                    <div class="bottom-link">If you do not have an account
                        <a href="signup.php">Sign up</a>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
