<?php
session_start();
include '../utils/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cartId = intval($_POST['cart_id']);

    $query = "DELETE FROM cart WHERE Id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $cartId);
    $stmt->execute();

    header("Location: cart.php");
    exit();
}
?>
