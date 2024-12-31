<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Ecomm1</title>
    <!-- Linking the main CSS file -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHq6+6H1b6N46eT6b3XCH4Ck6YEgCjTZpTAXEv5C5Hbw/sEg58bdDO5Nl+J3UHW7TlcCvc/A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #17a2b8;
            padding: 1rem 2rem;
        }

        .navbar .logo a {
            color: #fff;
            text-decoration: none;
            font-size: 1.5rem;
            font-weight: 600;
        }

        .navbar .nav-links {
            list-style: none;
            display: flex;
        }

        .navbar .nav-links li {
            margin: 0 1rem;
        }

        .navbar .nav-links a {
            color: #fff;
            text-decoration: none;
            font-size: 1rem;
        }

        .hero {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 30vh;
            background: url('../images/hero-bg.jpg') no-repeat center center/cover;
            color: black;
            text-align: center;
        }

        /* .hero h1 {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        .hero p {
            font-size: 1.2rem;
            margin-bottom: 2rem;
        }

        .hero .btn-primary {
            padding: 0.8rem 1.5rem;
            background-color: #ff5722;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-size: 1rem;
        } */

        .categories {
            padding: 2rem;
            text-align: center;
        }

        .categories h2 {
            font-size: 2rem;
            margin-bottom: 1.5rem;
            margin-top: 0rem;
            color: #333;
             
        }

        .category-container {
            display: flex;
            justify-content: center;
            gap: 2rem;
        }

        .category-item {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s;
        }

        .category-item:hover {
            transform: scale(1.05);
        }

        .category-item img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .category-item h3 {
            margin: 1rem 0;
        }

        .category-item .btn-secondary {
            display: inline-block;
            margin-bottom: 1rem;
            padding: 0.5rem 1rem;
            background-color: #333;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }

        footer {
            background-color: #17a2b8;
            /* color: #fff; */
            text-align: center;
            padding: 1rem;
            margin-top: 2rem;
        }

        .footer-content .social-links {
            list-style: none;
            display: flex;
            justify-content: center;
            margin: 1rem 0;
            padding: 0;
        }

        .footer-content .social-links li {
            margin: 0 0.5rem;
        }

        .footer-content .social-links a {
            color: #fff;
            font-size: 1.5rem;
        }
    </style>
</head>

<body>
    <header>
    <nav class="navbar navbar-expand-lg navbar-light bg-info">
            <div class="logo">
            <img src="/Ecomm1/user/logo3.png" alt="Logo" class="img-fluid" style="max-height: 80px;">
            </div>
            <ul class="nav-links">
                <li><a href="../user/products.php">Products</a></li>
                <li><a href="../user/form/Register.php">Register</a></li>
                <li><a href="../user/about.php">About</a></li>
                <li><a href="../user/contact.php">Contact</a></li>
                <li><a href="../user/form/login.php">Login</a></li>
            </ul>
        </nav>
    </header>
     <!-- <section class="hero">
        <div class="hero-content">
        <img src="/Ecomm1/user/logo3.png" alt="Logo" class="img-fluid" style="max-height: 50px;">
            <p>Your one-stop destination for the best products.</p>
        </div>
    </section> -->
    <section class="categories">
        <h2> Shop By Category</h2>
        <div class="category-container">
            <div class="category-item">
            <img src="/ecomm1/images/mobileshome.png" class="card-img-top" alt="<?php echo htmlspecialchars($product['Name']); ?>">
                <h3>Mobiles</h3>
                <a href="../user/products.php?category=mobile" class="btn-secondary">Explore</a>
            </div>
            <div class="category-item">
            <img src="/ecomm1/images/laptopshome.png" class="card-img-top" alt="<?php echo htmlspecialchars($product['Name']); ?>">
                <h3>Laptops</h3>
                <a href="../user/products.php?category=mobile" class="btn-secondary">Explore</a>
            </div>
            <div class="category-item">
            <img src="/ecomm1/images/headphoneshome.png" class="card-img-top" alt="<?php echo htmlspecialchars($product['Name']); ?>">
                <h3>Headphones</h3>
                <a href="../user/products.php?category=headphone" class="btn-secondary">Explore</a>
            </div>
        </div>
    </section>

    

    
    <footer>
        <div class="footer-content ">
            <p>&copy; 2024 Ecomm1. All rights reserved.</p>
            <ul class="social-links">
                <li><a href="#"><i class="fab fa-facebook"></i></a></li>
                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                <li><a href="#"><i class="fab fa-instagram"></i></a></li>
            </ul>
        </div>
    </footer>
</body>

</html>
