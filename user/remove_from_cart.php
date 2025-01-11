<?php
session_start();
include '../utils/config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../user/login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cartId = intval($_POST['cart_id']);

    // Delete the product from the cart
    $deleteQuery = "DELETE FROM cart WHERE Id = ?";
    $stmt = $conn->prepare($deleteQuery);
    $stmt->bind_param("i", $cartId);
    $stmt->execute();

    $stmt->close();
    $conn->close();

    // Redirect to cart.php with a success message
    header("Location: cart.php?status=removed");
    exit();
}
?>
