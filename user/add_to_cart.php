<?php
session_start();
include '../utils/config.php'; // Include your database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_SESSION['user_id'])) {
        die("User not logged in");
    }

    $userId = $_SESSION['user_id'];
    $productId = intval($_POST['product_id']);

    // Check if the product exists
    $productQuery = "SELECT Id FROM products WHERE Id = ?";
    $stmt = $conn->prepare($productQuery);
    $stmt->bind_param("i", $productId);
    $stmt->execute();
    $productResult = $stmt->get_result();

    if ($productResult->num_rows === 0) {
        die("Invalid product");
    }

    // Check if the product is already in the cart
    $checkCartQuery = "SELECT * FROM cart WHERE User_Id = ? AND Product_Id = ?";
    $stmt = $conn->prepare($checkCartQuery);
    $stmt->bind_param("ii", $userId, $productId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Update quantity if exists
        $updateQuery = "UPDATE cart SET Quantity = Quantity + 1 WHERE User_Id = ? AND Product_Id = ?";
        $stmt = $conn->prepare($updateQuery);
        $stmt->bind_param("ii", $userId, $productId);
        $stmt->execute();
    } else {
        // Insert new item
        $insertQuery = "INSERT INTO cart (User_Id, Product_Id, Quantity) VALUES (?, ?, 1)";
        $stmt = $conn->prepare($insertQuery);
        $stmt->bind_param("ii", $userId, $productId);
        $stmt->execute();
    }

    $stmt->close();
    $conn->close();

    // Redirect back to the products page
    header("Location: cart.php?status=success");
    exit();
} else {
    die("Invalid request");
}
?>
