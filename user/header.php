<?php
// session_start(); // Ensure the session is started
 include $_SERVER['DOCUMENT_ROOT'] . '/Ecomm1/utils/config.php';

$current_page = isset($_SERVER['PHP_SELF']) ? basename($_SERVER['PHP_SELF']) : ''; // Get the current page name safely


$cart_count = 0;
$total_price = 0.00;

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];  // Store the username in a variable
} else {
    $username = 'Guest';  // If not logged in, set the username to "Guest"
}

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];

    // Query to get the total quantity of items in the cart
    $query = "SELECT SUM(Quantity) AS total_items, SUM(p.Price * c.Quantity) AS total_price 
              FROM cart c 
              JOIN products p ON c.Product_Id = p.Id 
              WHERE c.User_Id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    // Get cart count and total price
    $cart_count = $row['total_items'] ?? 0; // Set to 0 if null
    $total_price = $row['total_price'] ?? 0.00; // Set to 0 if null
    $stmt->close();
}

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
                            <a class="nav-link" href="/Ecomm1/user/products.php">Products</a>
                        </li>

                        <?php
                        // Always show "Logout" on the products.php page
                        if ($current_page === 'products.php') {
                            echo '<li class="nav-item">
                                    <form method="post" action="../user/form/logout.php" class="d-inline">
    <button type="submit" class="btn nav-link text-dark border-0">Logout</button>
</form>

                                  </li>';
                        } else {
                            // Show Login/Logout based on session
                            if (isset($_SESSION['username'])) {
                                echo '<li class="nav-item">
                                        <form method="post" action="../user/form/logout.php" class="d-inline">
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
                            <a class="nav-link" href="../user/cart.php">
                                <i class="fa-solid fa-cart-shopping"></i>
                                <sup class="badge bg-danger"><?php echo $cart_count; ?></sup>
                            </a>
                        </li>
                        <li class="nav-item">
    <span class="nav-link text-dark">Total: $<?php echo number_format($total_price, 2); ?></span>
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