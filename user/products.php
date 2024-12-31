<?php
session_start();

// Check if the user is requesting a logout
if (isset($_GET['logout'])) {
    session_destroy(); // Destroy the session
    header("Location: login.php"); // Redirect to the login page
    exit();
}


include '../utils/config.php';

// Fetch products from the database
$category = isset($_GET['Category']) ? $_GET['Category'] : '';
$query = $category ? "SELECT * FROM products WHERE Category='$category'" : "SELECT * FROM products";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query Failed: " . mysqli_error($conn));
}

$products = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <?php include 'header.php'; ?>
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center">Our Products</h1>
        <div class="mb-4 text-center">
            <a href="products.php" class="btn btn-info">All</a>
            <a href="products.php?category=Mobile" class="btn btn-primary">Mobile</a>
            <a href="products.php?category=Laptop" class="btn btn-primary">Laptop</a>
            <a href="products.php?category=Headphone" class="btn btn-primary">Headphone</a>
        </div>
        <div class="row">
            <?php if (!empty($products)) { ?>
                <?php foreach ($products as $product): ?>
                    <div class="col-md-4">
                        <div class="card mb-4 shadow-sm">
                            <img src="/Ecomm1/images/<?php echo htmlspecialchars($product['Image']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($product['Name']); ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($product['Name']); ?></h5>
                                <p class="card-text"><?php echo htmlspecialchars($product['Description']); ?></p>
                                <p class="text-muted">Price: $<?php echo htmlspecialchars($product['Price']); ?></p>
                                <a href="#" class="btn btn-info">Add to Cart</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php } else { ?>
                <p class="text-center">No products found in this category.</p>
            <?php } ?>
        </div>
    </div>
</body>

</html> 