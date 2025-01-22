<?php
session_start();
include '../utils/config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../user/form/login.php?message=Please log in to proceed to checkout");
    exit();
}

$userId = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Fetch all cart items for the user
    $cartQuery = "SELECT c.Product_Id, c.Quantity, p.Price 
                  FROM cart c 
                  JOIN products p ON c.Product_Id = p.Id 
                  WHERE c.User_Id = ?";
    $stmt = $conn->prepare($cartQuery);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $cartItems = $stmt->get_result();

    if ($cartItems->num_rows === 0) {
        die("No items in the cart to checkout.");
    }

    // Calculate total amount
    $totalAmount = 0;
    $items = [];
    while ($row = $cartItems->fetch_assoc()) {
        $totalAmount += $row['Price'] * $row['Quantity'];
        $items[] = $row;
    }

    // Create an order
    $orderQuery = "INSERT INTO orders (User_Id, Total_Amount) VALUES (?, ?)";
    $stmt = $conn->prepare($orderQuery);
    $stmt->bind_param("id", $userId, $totalAmount);
    $stmt->execute();
    $orderId = $stmt->insert_id;

    // Add items to order_items table
    $orderItemQuery = "INSERT INTO order_items (Order_Id, Product_Id, Quantity, Price) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($orderItemQuery);
    foreach ($items as $item) {
        $stmt->bind_param("iiid", $orderId, $item['Product_Id'], $item['Quantity'], $item['Price']);
        $stmt->execute();
    }

    // Clear the cart
    $clearCartQuery = "DELETE FROM cart WHERE User_Id = ?";
    $stmt = $conn->prepare($clearCartQuery);
    $stmt->bind_param("i", $userId);
    $stmt->execute();

    $stmt->close();
    $conn->close();

    // Redirect to order confirmation page
    header("Location: order_confirmation.php?order_id=$orderId");
    exit();
}
?>
