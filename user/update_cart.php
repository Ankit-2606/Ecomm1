<?php
session_start();
include '../utils/config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../user/login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cartId = intval($_POST['cart_id']);
    $quantity = intval($_POST['quantity']);

    // Update the cart quantity
    $updateQuery = "UPDATE cart SET Quantity = ? WHERE Id = ?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("ii", $quantity, $cartId);
    $stmt->execute();

    $stmt->close();
    $conn->close();

    // Redirect to cart.php with a success message
    header("Location: cart.php?status=updated");
    exit();
}
?>
