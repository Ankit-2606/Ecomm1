<?php
session_start();
include '../utils/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cartId = intval($_POST['cart_id']);
    $quantity = intval($_POST['quantity']);

    $query = "UPDATE cart SET Quantity = ? WHERE Id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $quantity, $cartId);
    $stmt->execute();

    header("Location: cart.php");
    exit();
}
?>
