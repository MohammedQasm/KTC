<?php
session_start();
if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
} else {
    header("Location: login.php");
    exit();
}

include 'config.php';

$myquiry = $conn->prepare("SELECT id, full_name, email, date_register FROM users WHERE email = ?");
$myquiry->bind_param("s", $email);
$myquiry->execute();
$result = $myquiry->get_result();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            padding-top: 80px;
        }
        .container {
            max-width: 800px;
            margin: auto;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
           
            <a class="navbar-brand" href="#">User Profile</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="card mt-5">
            <div class="card-header">
                <h5 class="card-title">User Profile</h5>
            </div>
            <div class="card-body">
                <?php
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $user_id = $row['id'];
                    echo "<p><strong>User ID:</strong> " . $user_id . "</p>";
                    echo "<p><strong>Full Name:</strong> " . $row['full_name'] . "</p>";
                    echo "<p><strong>Email:</strong> " . $row['email'] . "</p>";
                    echo "<p><strong>Date Registered:</strong> " . $row['date_register'] . "</p>";
                } else {
                    echo "User not found.";
                }
                ?>
            </div>
        </div>
    </div>

    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
