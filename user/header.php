<?php
// session_start(); // Ensure the session is started
$current_page = isset($_SERVER['PHP_SELF']) ? basename($_SERVER['PHP_SELF']) : ''; // Get the current page name safely
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Header</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg navbar-light bg-info">
        <div class="container-fluid">
        <img src="/Ecomm1/user/logo3.png" alt="Logo" class="img-fluid" style="max-height: 80px;">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/Ecomm1/user/index1.php">Home</a>

                    
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../products.php">Products</a>
                    </li>
                    
                    <?php
                        // Always show "Logout" on the products.php page
                        if ($current_page === 'products.php') {
                            echo '<li class="nav-item">
                                    <form method="post" action=".php" class="d-inline">
                                        <button type="submit" class="btn nav-link text-dark border-0">Logout</button>
                                    </form>
                                  </li>';
                        } else {
                            // Show Login/Logout based on session
                            if (isset($_SESSION['username'])) {
                                echo '<li class="nav-item">
                                        <form method="post" action="logout.php" class="d-inline">
                                            <button type="submit" class="btn nav-link text-dark border-0">Logout</button>
                                        </form>
                                      </li>';
                            } else {
                                echo '<li class="nav-item">
                                        <a class="nav-link" href="login.php">Login</a>
                                      </li>';
                                echo '<li class="nav-item">
                                        <a class="nav-link" href="register.php">Register</a>
                                      </li>';
                            }
                        }
                        ?>

                    <li class="nav-item">
                        <a class="nav-link" href="#">Contacts</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fa-solid fa-cart-shopping"></i><sup>1</sup></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Total Price:</a>
                    </li>
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-light" type="submit">Search</button>
                </form>
            </div>
        </div>
    </div>
    </nav>
<div class="class bg-info">
    
</div>

</body>
