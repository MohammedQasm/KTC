<?php
include 'config.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $myquiry = $conn->prepare("SELECT id, password FROM users WHERE email = ?");
    $myquiry->bind_param("s", $email);
    $myquiry->execute();
    $result = $myquiry->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $hashed_password = $user['password'];

        if (password_verify($password, $hashed_password)) {
          session_start();
          $_SESSION['email'] = $email;
          header("Location: profile.php");
          exit();
      } else {
            echo "<script>alert('Incorrect email or password');</script>";
        }
    } else {
      echo "<script>alert('Incorrect email or password');</script>";
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
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link
      rel="stylesheet"
      type="text/css"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
    />
    <link rel="stylesheet" href="css/shared.css" />
    <link rel="stylesheet" href="css/login.css">
    <link rel="shortcut icon" href="img/icons/bus.ico" type="image/x-icon" />
    <title>KTC</title>
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
                <a href="login.php" class="nav-link active">Login</a>
              </li>
              <li class="nav-item">
                <a href="signup.php" class="nav-link">SignUp</a>
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

    <main class="my-5 p-4">
        <aside id="show-part">
          <img src="img/login.png" width="610px" />
          <p>Login KTC, Book tickets that fit your needs.</p>
        </aside>
        <aside id="login-part">
          <h1 class="mt-2 mb-4">Login to your KTC Account</h1>
          <img src="img/icons/bus.ico" alt="KTC Logo" />
          <form action="login.php" method="post">
    <div id="inputs">
        <input type="text" name="email" placeholder="Enter your email" required />
        <input type="password" name="password" minlength="8" maxlength="64" required placeholder="Password" class="mt-2" />
    </div>

    <button type="submit" id="submit-button">Sign in</button>

    <p class="quetion-paragraph">Don't have an account?</p>
    <a href="signup.php" id="signup-button">Create a KTC account.</a>
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
      </aside>
    </footer>
    <script src="js/bootstrap.bundle.min.js"></script>
  </body>
</html>
