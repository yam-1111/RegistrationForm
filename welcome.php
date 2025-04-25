<!--verify if user is login---->
<?php
session_start();
// Redirect to login if user is not logged in
if (!isset($_SESSION['user'])) {
    header('Location: index.html');
    exit;
}
$user = $_SESSION['user'];
?>

<!--Registration page-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./assets/images/favicon.ico" type="image/x-icon">
    <!---->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!--custom css-->
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/registration.css">
    <!--scripts-->
    <script src="./assets/js/script.js"></script>

    <title>SM Raffle Bonanza</title>
</head>

<body>
    <header>
        <nav class="navbar bg-blue justify-content-between">
            <img class="navbar-brand-img" src="./assets/images/logo@2x.png" alt="">
            <div class="ml-auto nav-link">
                <a href="./index.html" class="btn btn-link">Home</a>
                <a href="./registation-form.html" class="btn btn-link">Register</a>
                <a href="./login.html" class="btn btn-link">Login</a>
            </div>
        </nav>
    </header>

    <main class="d-flex flex-column align-items-center">
        <section class="container-fluid text-center">
            <div class="py-3">
                <h3 class="card-title promo-text">Welcome! </h3>
            </div>
                   <!-- User Profile Section -->
        <div class="container mt-4">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body text-center">
                            <img src="<?php echo htmlspecialchars($user['profile_picture']); ?>" 
                                 alt="Profile Picture" 
                                 class="img-fluid rounded-circle mb-3" 
                                 style="width: 150px; height: 150px;">
                            <h4 class="mb-2"><?php echo htmlspecialchars($user['fullname']); ?></h4>
                            <p class="text-muted"><?php echo htmlspecialchars($user['email']); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>


            <div class="container-fluid border-bottom">
                <div class="row justify-content-center">


                </div>
            </div>
        </section>
        <section class="container-fluid bg-light py-3">
            <div class="row justify-content-center">
                <div class="col-12">

                </div>
            </div>
        </section>
    </main>

</body>

<!--footer-->
<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <!-- SM Logo -->
            <img src="./assets/images/logo-footer.svg" alt="SM Logo" class="img-fluid sm-logo">

            <!-- Wrapper for Footer Content -->
            <div class="col-md-10 offset-md-2 footer-content">
                <div class="row">
                    <!-- Contact Info -->
                    <div class="col-md-4">
                        <h5>Contact Us</h5>
                        <p>7th Floor, MOA Square, Marina Way, Seashell Lane, cor Coral Way, Mall of Asia Complex, Pasay
                            City,
                            Philippines</p>
                        <p><i class="fas fa-envelope"></i> <a href="mailto:customercare@smsupermalls.com">
                                customercare@smsupermalls.com</a></p>
                        <!-- Social Media Icons -->
                        <div class="social-icons">
                            <a href="#"><i class="fab fa-facebook"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                            <a href="#"><i class="fab fa-x-twitter"></i></a>
                            <a href="#"><i class="fab fa-youtube"></i></a>
                            <a href="#"><i class="fab fa-linkedin"></i></a>
                            <a href="#"><i class="fab fa-tiktok"></i></a>
                        </div>
                    </div>

                    <!-- Quick Links -->
                    <div class="col-md-3">
                        <h5>Quick Links</h5>
                        <ul class="list-unstyled">
                            <li><a href="#">Malls</a></li>
                            <li><a href="#">Shops</a></li>
                            <li><a href="#">SM Deals</a></li>
                            <li><a href="#">SM Mall Sales & Events</a></li>
                            <li><a href="#">SM Cinema</a></li>
                            <li><a href="#">Cyberzone</a></li>
                            <li><a href="#">Careers</a></li>
                        </ul>
                    </div>

                    <!-- Latest in SM -->
                    <div class="col-md-3">
                        <h5>The Latest in SM</h5>
                        <ul class="list-unstyled">
                            <li><a href="#">SM Stories</a></li>
                            <li><a href="#">Sales & Promos</a></li>
                            <li><a href="#">Shopping</a></li>
                            <li><a href="#">Eat & Drink</a></li>
                            <li><a href="#">Entertainment</a></li>
                            <li><a href="#">Lifestyle</a></li>
                            <li><a href="#">News</a></li>
                        </ul>
                    </div>

                    <!-- DPO/DPS Section -->
                    <div class="col-md-2 text-center">
                        <img id="dpo" src="./assets/images/dpo_logo.png" alt="DPO DPS Badge" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>


<!-- Bottom Bar -->
<div class="bottom-bar">
    <div class="row">
        <div class="col-md-12">
            <p>
                <i class="fa-circle-info"></i> Note: This project is for educational purposes only and is <strong>not
                    affiliated</strong> with or endorsed by SM Supermalls.
            </p>
        </div>
    </div>
</div>

</html>