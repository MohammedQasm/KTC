<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST['full-name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    
    $myquiry = $conn->prepare("INSERT INTO users (full_name, email, password) VALUES (?, ?, ?)");

    
    $myquiry->bind_param("sss", $full_name, $email, $hashed_password);

    
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    try {
    
        $myquiry->execute();
    
        header("Location: login.php");
        exit();
    } catch (mysqli_sql_exception $e) {
        
        if ($e->getCode() == 1062) { // 1062 is the error code for duplicate entry
            echo "<script>alert('Email already exists. Please use a different email.');</script>";
        } else {
            
            echo "<script>alert('An error occurred. Please try again later.');</script>";
        }
    }

    $myquiry->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Quicksand:wght@700&family=Roboto:wght@900&display=swap"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    />
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/shared.css" />
    <link rel="stylesheet" href="css/signup.css" />
    <link rel="shortcut icon" href="img/icons/bus.ico" type="image/x-icon" />
    <title>KTC Sign Up</title>
  </head>
  <body>
    <header id="main-header">
      <nav class="navbar navbar-expand-md bg-dark navbar-dark fixed-top">
        <div class="container">
          <a href="index.html" class="navbar-brand">KTC</a>
          <button
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarNav"
            class="navbar-toggler"
          >
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <!-- agar ms-auto labdain hamu itemakan dacheta lay chap -->
            <ul class="navbar-nav">
              <li class="nav-item">
                <a href="buses.html" class="nav-link">Buses</a>
              </li>
              <li class="nav-item">
                <a href="taxi.html" class="nav-link">Taxi</a>
              </li>
            </ul>
            <ul class="navbar-nav ms-auto">
              <li class="nav-item">
                <a href="index.html" class="nav-link">Home</a>
              </li>
              <li class="nav-item">
                <a href="login.php" class="nav-link">Login</a>
              </li>
              <li class="nav-item">
                <a href="signup.php" class="nav-link active">SignUp</a>
              </li>

              <li class="nav-item dropdown">
                <a
                  class="nav-link dropdown-toggle"
                  href="#"
                  role="button"
                  data-bs-toggle="dropdown"
                  >Language</a
                >
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="#">Kurdish</a></li>
                  <li><a class="dropdown-item" href="#">English</a></li>
                  <li><a class="dropdown-item" href="#">Arabic</a></li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </header>
    <main class="m-5 p-4">
      <aside id="show-part">
        <h1>Join KTC</h1>
        <img src="img/login.png" width="610px" />
        <p>Join with KTC, And Book tickets that fit your needs.</p>
      </aside>
      <aside id="login-part">
        <h1>Create an account</h1>
        <p>Faster booking and boarding by saving your information.</p>
        <img src="img/icons/bus.ico" alt="KTC Logo" />
        <form action="signup.php" method="post">
    <div id="inputs">
        <input type="text" name="full-name" placeholder="Full Name" required />
        <input type="email" name="email" placeholder="E-mail" required />
        <input type="password" name="password" minlength="8" maxlength="64" required placeholder="Password" />
    </div>
    <button type="submit" id="submit-button">Sign Up</button>
    <div id="signup-With">
        <p>Or Sign Up With</p>
        <a href=""><i class="fa-brands fa-facebook fa-2xl" style="color: #d5d5d6"></i></a>
        <a href=""><i class="fa-brands fa-google fa-2xl" style="color: #d5d5d6"></i></a>
        <a href=""><i class="fa-brands fa-twitter fa-2xl" style="color: #d5d5d6"></i></a>
    </div>

    <p>Have an account?</p>
    <a href="login.php" id="sigin-button">Sign In</a>
</form>

      </aside>
    </main>

    <footer class="footer">
      <aside class="footer-col">
        <h4>company</h4>
        <ul>
          <li><a href="#">about us</a></li>
          <li><a href="#">our services</a></li>
          <li><a href="#">privacy policy</a></li>
          <li><a href="#">affiliate program</a></li>
        </ul>
      </aside>

      <aside class="footer-col">
        <h4>get help</h4>
        <ul>
          <li><a href="#">FAQ</a></li>
          <li><a href="#">shipping</a></li>
          <li><a href="#">returns</a></li>
          <li><a href="#">order status</a></li>
          <li><a href="#">payment options</a></li>
        </ul>
      </aside>

      <aside class="footer-col">
        <h4>online shop</h4>
        <ul>
          <li><a href="#">watch</a></li>
          <li><a href="#">bag</a></li>
          <li><a href="#">shoes</a></li>
          <li><a href="#">dress</a></li>
        </ul>
      </aside>

      <aside class="footer-col">
        <h4>follow us</h4>
        <aside class="social-links">
          <a href="#"><i class="fab fa-facebook-f"></i></a>
          <a href="#"><i class="fab fa-twitter"></i></a>
          <a href="#"><i class="fab fa-instagram"></i></a>
          <a href="#"><i class="fab fa-linkedin-in"></i></a>
        </aside>
        <p>© KTC Inc, All rights reserved.</p>
      </aside>
    </footer>
    <script src="js/bootstrap.bundle.min.js"></script>
  </body>
</html>
